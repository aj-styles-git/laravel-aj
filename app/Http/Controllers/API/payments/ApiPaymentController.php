<?php

namespace App\Http\Controllers\API\payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\payments\Payment;
use App\Models\courses\Course;
use App\Models\students\Student;
use App\Models\payments\Approval as WithdrawRequest;
use App\Models\coupons\Coupon;
use App\Models\coupons\CouponUsage;
use App\Models\institutes\Institute;
use App\Models\payments\Wallet;
use App\Models\payments\WalletMetaData;
use App\Models\settings\Setting;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Rules\ValidStudent;
use App\Rules\ValidInstitute;
use App\Rules\ValidCourse;
use Illuminate\Support\Facades\Http;
use LDAP\Result;

spl_autoload_register(function ($class) {
    $root = dirname(__DIR__);
    $classFile = $root . '/lib/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($classFile)) {
        require_once $classFile;
    }
});

class ApiPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // $url = "https://restapi.paylink.sa/api/auth";
    private $PAYMENT_URL = "https://restpilot.paylink.sa";


    public function index()
    {
        $res = [];
        $payment = Payment::with(['institute', 'course', 'student'])->orderBy('created_at', 'desc')->get();
        $res['message'] = "Payments fetched successfully.";
        $res['code'] = 200;
        $res['data'] = $payment;
        return $res;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    // Send push notification if the institute approved by admin 
    private function notify($id, $payload = "success")
    {

        $filePath = app_path('notifications.json');
        if (File::exists($filePath)) {
            $jsonContents = File::get($filePath);

            try {
                $data = json_decode($jsonContents, true);


                $inst = Institute::find($id);
                $default_lang = "en";



                // payload
                if ($payload == "success") {
                    $title = $data['order_received']['title_en'];
                    $msg = $data['order_received']['msg_en'];

                    if (isset($inst->default_lang)) {
                        $default_lang = $inst->default_lang;
                    }

                    if ($default_lang == "ar") {
                        $title = $data['order_received']['title_ar'];
                        $msg = $data['order_received']['msg_ar'];
                    }

                    if ($inst->device_token != null && $inst->device_token != "") {
                        $inst->push_notificaions()->create([
                            "message" => $msg,
                            "title" => $title
                        ]);
                        sendPushNotifications([$inst->device_token], $title, $msg);
                    }
                } else if ($payload == "failed") {
                    $title = $data['order_failed']['title_en'];
                    $msg = $data['order_failed']['msg_en'];

                    if (isset($inst->default_lang)) {
                        $default_lang = $inst->default_lang;
                    }

                    if ($default_lang == "ar") {
                        $title = $data['order_failed']['title_ar'];
                        $msg = $data['order_failed']['msg_ar'];
                    }

                    if ($inst->device_token != null && $inst->device_token != "") {
                        $inst->push_notificaions()->create([
                            "message" => $msg,
                            "title" => $title
                        ]);
                        sendPushNotifications([$inst->device_token], $title, $msg);
                    }
                } else if ($payload == "withdraw_request_approved") {
                    $title = $data['withdraw_request_approved']['title_en'];
                    $msg = $data['withdraw_request_approved']['msg_en'];

                    if (isset($inst->default_lang)) {
                        $default_lang = $inst->default_lang;
                    }

                    if ($default_lang == "ar") {
                        $title = $data['withdraw_request_approved']['title_ar'];
                        $msg = $data['withdraw_request_approved']['msg_ar'];
                    }

                    if ($inst->device_token != null && $inst->device_token != "") {
                        $inst->push_notificaions()->create([
                            "message" => $msg,
                            "title" => $title
                        ]);
                        sendPushNotifications([$inst->device_token], $title, $msg);
                    }
                } else if ($payload == "withdraw_request_rejected") {
                    $title = $data['withdraw_request_rejected']['title_en'];
                    $msg = $data['withdraw_request_rejected']['msg_en'];

                    if (isset($inst->default_lang)) {
                        $default_lang = $inst->default_lang;
                    }

                    if ($default_lang == "ar") {
                        $title = $data['withdraw_request_rejected']['title_ar'];
                        $msg = $data['withdraw_request_rejected']['msg_ar'];
                    }

                    if ($inst->device_token != null && $inst->device_token != "") {
                        $inst->push_notificaions()->create([
                            "message" => $msg,
                            "title" => $title
                        ]);
                        sendPushNotifications([$inst->device_token], $title, $msg);
                    }
                }
            } catch (\Exception $e) {
                saveAppLog($e->getMessage(), basename(__FILE__));
            }
            return true;
        } else {

            saveAppLog("In the app directory notifications.json file is missing.", basename(__FILE__));
            return false;
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $req)
    {

        $res = [];
        $rules = array(
            "transection_id" => "required|unique:orders",
            "institute_id" => ["required", "exists:institutes,id", new ValidInstitute],
            'student_id' => ['required', 'exists:students,id', new ValidStudent],
            'course_id' => ['required', 'exists:courses,course_id', new ValidCourse],
            "discount" => "required",
            "status" => "required",
            "amount" => "required",
            "course_lang" => "required"

        );

        $validator = Validator::make($req->all(), $rules);

        if ($validator->fails()) {
            return [
                "status" => "failed",
                "code" => 500,
                "errors" => $validator->errors()
            ];
        }


        if ($validator->passes()) {

            try {

                DB::beginTransaction();
                $order =  new Payment;
                $institute =  Institute::find($req->institute_id);
                $blockedStatues = [0, 2];

                if (in_array($institute->status, $blockedStatues)) {
                    $res['code'] = 500;
                    $res['message'] = "You are blocked or pending.";
                    return $res;
                }
                $order->transection_id = $req->transection_id;
                $order->institute_id = $req->institute_id;
                $order->student_id = $req->student_id;
                $order->course_id = $req->course_id;
                $order->discount = $req->discount;
                $order->amount = $req->amount;
                if (isset($req->coupon_id)) {
                    $order->coupon_id = $req->coupon_id;
                    $coupon = Coupon::find($order->coupon_id);
                    if ($coupon) {
                        $record = CouponUsage::where([['coupon_id', '=', $order->coupon_id], ['student_id', '=', $req->student_id]])->first();
                        if ($record) {

                            $record->count = $record->count + 1;
                            $record->save();
                        } else {

                            $record = new CouponUsage;
                            $record->student_id = $req->student_id;
                            $record->coupon_id = $req->coupon_id;
                            $record->count = 1;
                            $record->save();
                        }
                    }
                };

                // Order received notification for the institute
                if ($req->status == 0) {
                    $this->notify($req->institute_id, "Failed");
                } else if ($req->status == 1) {
                    $this->notify($req->institute_id, "Success");
                } else {
                    $res['code'] = 500;
                    $res['message'] = "Status of the payment is not valid.";
                    return $res;
                }


                $order->status = $req->status;

                // check the admin commission 
                $settings = Setting::where('label', 'global_commission')
                    ->orWhere('label', 'global_commission_type')
                    ->get();

                foreach ($settings as $setting) {
                    if ($setting['label'] == 'global_commission') {
                        $global_commision = $setting['value'];
                    }
                    if ($setting['label'] == 'global_commission_type') {
                        $global_commision_type = $setting['value'];
                    }
                }

                // 1= Percentage 
                // other flat discount 
                // if admin has set the commission for the institute
                if ($institute->admin_commission != null && $institute->admin_commission != "") {

                    $order->commission_amount = ($institute->admin_commission / 100) * $req->amount;
                    $order->institute_amount = $req->amount - $order->commission_amount;
                } else {

                    if ($global_commision_type == 'percentage') {
                        $order->commission_amount = ($global_commision / 100) * $req->amount;
                    } else {
                        $order->commission_amount = $global_commision;
                    }

                    $order->institute_amount = $req->amount - $order->commission_amount;
                }


                // If the status is success then store the record in the statements 
                if ($req->status == 1) {

                    // get the last balance from the statements 
                    $latestRecord = WalletMetaData::where('institute_id', $req->institute_id)->latest()->first();
                    $balance = $order->institute_amount;
                    if ($latestRecord) {

                        $balance = $latestRecord['wallet_amount'] + $order->institute_amount;
                    }

                    $statement = new WalletMetaData;
                    $statement->transection_id = $req->transection_id;
                    $statement->institute_id = $req->institute_id;
                    $statement->amount = $order->institute_amount;
                    $statement->wallet_amount = $balance;
                    $statement->status = 1;
                    $statement->transection_type = "Credited";
                    $statement->message = "Product Sold";
                    $statement->save();

                    // Assign the course to the student now because payment is done 

                    if ($req->course_lang == "ar") {
                        $language_id = 1002;
                    } else if ($req->course_lang == "en") {
                        $language_id = 1001;
                    } else {
                        DB::rollBack();
                        $res['code'] = 500;
                        $res['message'] = "Please send valid course_lang parameter.";
                        return $res;
                    }

                    $course = Course::where([['course_id', '=', $req->course_id], ['language_id', '=', $language_id]])->get()->first();

                    if (!$course) {
                        DB::rollBack();
                        $res['code'] = 500;
                        $res['message'] = "Course Not Found with specified language.";
                        return $res;
                    }

                    if ($course->status == 2 || $course->status == 0 || $course->status == 3) {
                        DB::rollBack();
                        $res['code'] = 500;
                        $res['message'] = "Course is either blocked, pending, or rejected.";
                        return $res;
                    }

                    // Check if the Student has already enrolled 
                    $alreadyEnrolled = $course->students()
                        ->wherePivot('student_id', $req->student_id)
                        ->wherePivot('language_id', $language_id)
                        ->first();

                    if ($alreadyEnrolled) {
                        DB::rollBack();
                        $res['code'] = 500;
                        $res['message'] = "You are already enrolled.";
                        return $res;
                    }

                    $course->students()->attach($req->student_id, [
                        "language_id" => $language_id,
                        "payment_status" => $req->status
                    ]);
                }

                $order->save();
                DB::commit();
                $res['code'] = 200;
                $res['message'] = "Course booked successfully.";
                return $res;
            } catch (\Exception $e) {
                DB::rollBack();
                $res['message'] = $e->getMessage();
                $res['code'] = 500;
                saveAppLog($res['message']);
                return $res;
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $res = [];
        $order = Payment::with(['institute', 'course', 'student'])->find($id);
        if ($order) {

            $res['code'] = 200;
            $res['message'] = " Order Fetched Successfully";
            $res['data']["order_details"] = $order;

            $settings = Setting::whereIn('label', ['address', 'email', 'phone'])->get();
            $res['data']["address"] = isset($settings[0]['value']) ?  $settings[0]['value'] : "";
            $res['data']["email"] = isset($settings[1]['value']) ?  $settings[1]['value'] : "";
            $res['data']["phone"] = isset($settings[2]['value']) ?  $settings[2]['value'] : "";
            return $res;
        } else {
            $res['code'] = 500;
            $res['message'] = "Opps!, Order Not Found";
        }
        return $res;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function getAllPendingApprovals()
    {
        $approvals = WithdrawRequest::with('institute')
            ->leftJoin('wallet', 'withdraw_requests.institute_id', '=', 'wallet.institute_id')
            ->select('withdraw_requests.*', 'wallet.amount as wallet_amount')
            ->where('withdraw_requests.status', 0)->orderBy('created_at', 'desc')
            ->get();


        $res = [];
        // $approvals = Approval::with(['institute', 'wallet'])->where('status', '0')->get();
        $res['message'] = "Approvals fetched successfully.";
        $res['code'] = 200;
        $res['data'] = $approvals;
        return $res;
    }
    public function approvalRequest(Request $req)
    {


        $res = [];
        if (!isset($req->institute_id) || !isset($req->amount)) {
            $res['message'] = "Please send the sufficeint params...";
            $res['code'] = 500;
            return $res;
        }

        $institute = Institute::find($req->institute_id);

        if (!$institute) {
            $res['message'] = "Institute ID does not exists...";
            $res['code'] = 500;
            return $res;
        }

        // check if institute have wallet balance or not 
        if ($institute) {

            // Check if this user has already requested for approval 
            $hasAlreadyRequested = Approval::where([['institute_id', '=', $req->institute_id], ['status', '=', 0]])->get();

            if (count($hasAlreadyRequested) > 0) {
                $res['message'] = "You cannot request again, Your request is pending for approval... ";
                $res['code'] = 500;
                return $res;
            }

            $wallet = Wallet::find($req->institute_id);

            if ($wallet->amount > $req->amount) {
                $generateRequest = new Approval;
                $generateRequest->institute_id = $req->institute_id;
                $generateRequest->status = 0;
                $generateRequest->amount = $req->amount;
                $generateRequest->save();
                $res['message'] = "Request for approval created Successfully...";
                $res['data'] = $generateRequest;
                return $res;
            } else {
                $res['message'] = "You have no balance to debit...";
                $res['code'] = 500;
                return $res;
            }
        }
    }

    public function changeApprovalStatus(Request $req)
    {

        $res = [];
        if (!isset($req->status) || !isset($req->id) || !isset($req->reason_id)) {
            $res['message'] = "Not valid params.";
            $res['code'] = 500;
            return $res;
        }

        // Admin Approved request 
        if ($req->status == 1) {

            if (!isset($req->transaction_id)) {
                $res['message'] = "Please send a valid transaction ID.";
                $res['code'] = 500;
                return $res;
            }

            try {

                DB::beginTransaction();
                $withdraw_req = WithdrawRequest::find($req->id);
                $withdraw_req->status = 1;
                $this->notify($withdraw_req->institute_id, "withdraw_request_approved");
                $withdraw_req->save();

                $statement = WalletMetaData::where('withdraw_request_id', $withdraw_req->id)->first();
                $statement->status = 1;
                $statement->message = "Withdraw Request Approved.";
                $statement->reason_id = $req->reason_id;
                $statement->transection_id = $req->transaction_id;


                $statement->save();
                DB::commit();

                $res['code'] = 200;
                $res['message'] = "Request Approved Successfully.";
                return $res;
            } catch (\Exception $e) {

                $res['code'] = 500;
                $res['message'] = "Something went wrong on server...";
                return $res;
            }
        } else if ($req->status == 2) {
            // Rejected
            try {
                $withdraw_req = WithdrawRequest::find($req->id);
                $withdraw_req->status = 2;
                $this->notify($withdraw_req->institute_id, "withdraw_request_rejected");

                // Find the record 
                $previous_statement = WalletMetaData::where('withdraw_request_id', $withdraw_req->id)->first();


                $data = WalletMetaData::where('institute_id',  $withdraw_req->institute_id)
                    ->orderBy('created_at', 'desc')
                    ->get();


                if (count($data) <= 0) {
                    $res['code'] = 500;
                    $res['message'] = " You do not have sufficeint balance.";
                    return $res;
                }

                $inst_wallet_amount = $data[0]['wallet_amount'];
                // Rejected by admin 
                $previous_statement->status = 2;

                if ($previous_statement) {
                    $newStatement = $previous_statement->toArray();
                    unset($newStatement['id']);
                    unset($newStatement['reason']);
                    unset($newStatement['created_at']);
                    unset($newStatement['updated_at']);
                    $newStatement['transection_type'] = "Credited";
                    $newStatement['message'] = "Rejected By Admin";
                    $newStatement['reason_id'] = $req->reason_id;
                    $newStatement['status'] = 1;
                    $newStatement['wallet_amount'] = $inst_wallet_amount +  $withdraw_req->amount;
                    $new_statement = WalletMetaData::create($newStatement);
                }
                $withdraw_req->save();
                $new_statement->save();

                DB::commit();
                $res['message'] = "Status Updated Successfully";
                $res['code'] = 200;
                return $res;
            } catch (\Exception $e) {
                $res['code'] = 500;
                $res['message'] = "Something went wrong on server...";
                return $res;
            }
        } else {
            $res['message'] = "Not valid status to update...";
            $res['code'] = 500;
            return $res;
        }
    }


    private function getPaymentAuthToken()
    {


        $url = $this->PAYMENT_URL . "/api/auth";

        $apiId = getSetting('paylinksa_app_id');
        $secretKey = getSetting('paylinksa_secret_key');

        // Get the Auth Token 
        $params = [
            'apiId' => $apiId,
            'secretKey' => $secretKey,
            'persistToken' => false
        ];
        $response = Http::post($url, $params);
        return $response['id_token'];
    }
    public function  iniciatePayment(Request $req)
    {
        $req->validate([
            'amount' => 'required',
            'student_id' => 'required',
            'course_name' => 'required',
            'lang' => 'required',
            'course_id' => 'required',
        ]);

        $lang_id = getLanguageId($req->lang);

        if (!$lang_id) {
            return failedResponse(" Invalid Language ID.");
        }
     

        $course = Course::where([['course_id', '=', $req->course_id], ['language_id', '=', $lang_id]])->get()->first();

        if (!$course) {
       
            $res['code'] = 500;
            $res['message'] = "Course Not Found with specified language.";
            return $res;
        }

        if ($course->status == 2 || $course->status == 0 || $course->status == 3) {
           
            $res['code'] = 500;
            $res['message'] = "Course is either blocked, pending, or rejected.";
            return $res;
        }

        // Check if the Student has already enrolled 
        $alreadyEnrolled = $course->students()
            ->wherePivot('student_id', $req->student_id)
            ->wherePivot('language_id', $lang_id)
            ->first();

        if ($alreadyEnrolled) {
          
            $res['code'] = 500;
            $res['message'] = "You are already enrolled.";
            return $res;
        }



        $token = $this->getPaymentAuthToken();


        $headers = [
            'Authorization' => 'Bearer ' . $token,
        ];

        $url = $this->PAYMENT_URL . "/api/addInvoice";

        $currency = getSetting('currency');
        $amount = $req->amount;
        $student = Student::find($req->student_id);
        $params = array(
            "amount" => $amount,
            "currency" => $currency,
            "callBackUrl" => "https://www.example.com/?",
            "clientEmail" => $student->email,
            "clientMobile" => $student->mobile,
            "clientName" => $student->name,
            "orderNumber" => time(),
            "products" => array(
                array(
                    "price" => 150,
                    "qty" => 1,
                    "title" => $req->course_name
                )
            )
        );

        // Now iniciate the payment 
        $response = Http::accept('application/json')->withToken($token)->post(
            $url,
            $params
        );
        return $response;
    }


    public function downloadInvoice(Request $req, $id)
    {
        $data = [];
        $order = Payment::with(['institute', 'course', 'student'])->find($id);

        if ($order) {

            try {



                $data["order_details"] = $order;

                $settings = Setting::whereIn('label', ['address', 'email', 'phone'])->get();
                $data["address"] = isset($settings[0]['value']) ?  $settings[0]['value'] : "";
                $data["email"] = isset($settings[1]['value']) ?  $settings[1]['value'] : "";
                $data["phone"] = isset($settings[2]['value']) ?  $settings[2]['value'] : "";


                $dompdf = new Dompdf();

                $html = View::make('pages.globals.invoice_pdf', $data)->render();
                $dompdf->loadHtml($html);

                $dompdf->set_option('isRemoteEnabled', true);

                $dompdf->setBasePath(public_path());

                $dompdf->render();

                $pdfContent = $dompdf->output();


                $fileName = "DW_" . $order->id . "_" . time() . ".pdf";
                $pdfPath = 'invoices/' . $fileName;
                Storage::put($pdfPath, $pdfContent);

                $pdfUrl = Storage::url($pdfPath);

                $res['code'] = 200;
                $res['message'] = "Invoice Downloaded Successfully.";
                $res['link'] = $pdfUrl;

                return $res;
            } catch (\Exception $e) {
                $res['code'] = 500;
                $res['message'] = $e->getMessage();
                saveAppLog($res['message'], basename(__FILE__));
                return $res;
            }
        } else {
            $res['code'] = 500;
            $res['message'] = "Opps!, Order Not Found";
        }
        return $res;
    }

    public function getInstituteOrders(Request $req, $id)
    {

        $res = [];
        $res['code'] = 200;
        $res['data'] = Payment::with(['institute', 'course', 'student'])->where('institute_id', $id)->orderBy('created_at', 'desc')->get();
        return $res;
    }
}
