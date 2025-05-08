<?php

namespace App\Http\Controllers\API\institutes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\institutes\Institute;
use App\Models\students\Student;
use App\Models\payments\WalletMetaData;
use App\Models\payments\Wallet;
use App\Models\coupons\Coupon;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use App\Models\payments\Approval as WithdrawRequest;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Models\payments\Payment;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\settings\Setting;

class ApiInstituteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res = [];
        $res['code'] = 200;
        $res['message'] = "Institutes Fetched Successfully.";
        $res['data'] =  Institute::with(['country', 'state', 'city'])->orderBy('created_at', 'desc')->get();
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {


        if (isset($req->adminRequest)) {
            $rules = array(
                "name" => "required",
                "lang" => "required",
                "address" => "required",
                "email" => "required|unique:institutes,email",
                "password" => "required",
                "mobile" => "required|unique:institutes,mobile",
                "state_id" => "required",
                "city_id" => "required",
                "country_id" => "required",
            );
        } else {
            $rules = array(
                "lang" => "required",
                "mobile" => "required|unique:institutes,mobile",
                "email" => "required|unique:institutes,email",
                "password" => "required",

            );
        }


        $validator = Validator::make($req->all(), $rules);


        if ($validator->fails()) {
            return [
                "status" => "failed",
                "code" => 500,
                "errors" => $validator->errors()
            ];
        }

        // Request coming from mobile app 
        if (!isset($req->adminRequest)) {

            $institute = new Institute;
            $institute->name = isset($req->name) ? $req->name : "";
            $institute->email = isset($req->email) ? $req->email : "";
            $institute->mobile = $req->mobile;
            $institute->logo = "default/default_institute.jpg";
            $institute->password = Hash::make($req->password);

            if ($req->lang == 'ar') {
                $institute->des_ar = isset($req->des) ?  $req->des : "";
                $institute->lang = json_encode(['ar' => true]);
            } else if ($req->lang == 'en') {
                $institute->des_en = isset($req->des) ?  $req->des : "";
                $institute->lang = json_encode(['en' => true]);
            }

            $settings = Setting::whereIn('label', ['institute_approval'])->get();
            if (isset($settings[0]['value']) && $settings[0]['value'] == 'disabled') {

                $institute->status = 1;
            } else {
                $institute->status = 2;
            }




            if (isset($req->device_token)) {
                $institute->device_token = $req->device_token;
            }

            $institute->mobileVerified = isset($req->mobileVerified) ? $req->mobileVerified : 0;
            $institute->createdBy = isset($req->createdBy) ? $req->createdBy : "";
            if ($institute->save()) {
                $token = $institute->createToken('inst')->plainTextToken;

                return [
                    'code' => 200,
                    "message" => "Institute Added Successfully.",
                    'token' => $token,
                    "type" => "bearer",
                    "data" =>  $institute
                ];
            } else {
                return [
                    'code' => 500,
                    "message" => "Database Error, While inserting the student.",
                ];
            }
        }

        // if request is coming from Admin Panel 
        if ($validator->passes()) {

            try {

                $institute = new Institute;
                $institute->name = isset($req->name) ? $req->name : "";

                if ($req->lang == 'ar') {
                    $institute->name_ar = $req->name;
                } else if ($req->lang == 'en') {
                    $institute->name_en = $req->name;
                }

                $institute->mobile = $req->mobile;
                if (isset($req->contact_person_mobile)) {

                    $institute->contact_person_mobile = $req->contact_person_mobile;
                }

                $institute->email = $req->email;



                // Check For Logo 
                if ($req->hasFile('logo')) {
                    $logo_path = $req->file('logo')->store('institutes');
                    $institute->logo = $logo_path;
                } else {
                    $institute->logo = "default/default_institute.jpg";
                }

               // Check For Document  
                if ($req->hasFile('document')) {
                    $document_path = $req->file('document')->store('institutes', 'public');
                    // dd($document_path);
                    $institute->document = $document_path;
                }
// 
                // Check For Cover  
                if ($req->hasFile('cover')) {
                    $cover_path = $req->file('cover')->store('institutes');
                    $institute->cover = $cover_path;
                }

                if ($req->lang == 'ar') {
                    $institute->des_ar = isset($req->des) ? $req->des : "";
                    $institute->lang = json_encode(['ar' => true]);
                } else if ($req->lang == 'en') {
                    $institute->des_en= isset($req->des) ? $req->des : "";
                    $institute->lang = json_encode(['en' => true]);
                }
                $institute->address = isset($req->address) ? $req->address : "";
                $institute->longitude = isset($req->longitude) ? $req->longitude : "";
                $institute->latitude = isset($req->latitude) ? $req->latitude : "";
                $institute->city_id = isset($req->city_id) ? $req->city_id : "";
                $institute->state_id = isset($req->state_id) ? $req->state_id : "";
                $institute->country_id = isset($req->country_id) ? $req->country_id : "";
                $institute->mobileVerified =  0;
                $institute->createdBy = Auth::user()->id;

                $institute->password = Hash::make($req->password);

                $institute->status = 2;



                $institute->save();

                return [
                    'code' => 200,
                    "message" => "Institute Registered Successfully.",
                    "data" =>  $institute
                ];
            } catch (\Exception $e) {

                $res['code'] = 500;
                $res['message'] = "Server Error " . $e->getMessage();
                saveAppLog($res['message'], basename(__FILE__));
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
        $data = Institute::find($id);
        $res = [];
        if ($data) {
            $res['code'] = 200;
            $res['message'] = "Institute Fetched Successfully.";
            $res['data'] = $data;
            return $res;
        } else {
            $res['code'] = 500;
            $res['message'] = "Institute Not Found. ";
            return $res;
        }
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

    // Send push notification if the institute approved by admin 
    private function notify($id, $status)
    {


        $filePath = app_path('notifications.json');
        if (File::exists($filePath)) {
            $jsonContents = File::get($filePath);

            try {
                $data = json_decode($jsonContents, true);


                $inst = Institute::find($id);
                $default_lang = "en";


                // Approved 
                if ($status == 1) {

                    $title = $data['institute_approval']['title_en'];
                    $msg = $data['institute_approval']['msg_en'];

                    if (isset($inst->default_lang)) {
                        $default_lang = $inst->default_lang;
                    }

                    if ($default_lang == "ar") {
                        $title = $data['institute_approval']['title_ar'];
                        $msg = $data['institute_approval']['msg_ar'];
                    }

                    if ($inst->device_token != null && $inst->device_token != "") {
                        $inst->push_notificaions()->create([
                            "message" => $msg,
                            "title" => $title
                        ]);
                        sendPushNotifications([$inst->device_token], $title, $msg);
                    }
                }

                // Rejected 
                if ($status == 3) {
                    $title = $data['institute_rejected']['title_en'];
                    $msg = $data['institute_rejected']['msg_en'];

                    if (isset($inst->default_lang)) {
                        $default_lang = $inst->default_lang;
                    }

                    if ($default_lang == "ar") {
                        $title = $data['institute_rejected']['title_ar'];
                        $msg = $data['institute_rejected']['msg_ar'];
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {

        if (count($req->all()) < 1) {
            $res['message'] = "Please pass the parameters to update...";
            $res['code'] = 500;
            return $res;
        }

        if (!isset($req->lang)) {
            $res['message'] = "Please send the lang paramerter to continue updating...";
            $res['code'] = 500;
            return $res;
        }

        $institute = Institute::find($id);


        $res = [];
        if ($institute) {

            try {

                if ($req->has('lang')) {
                    $lang = $req->input('lang');
                    $obj = json_decode($institute->lang, true);
                    $obj[$lang] = true;
                    $obj = json_encode($obj);
                    $req->merge(['lang' => $obj]);

                    // For the name 
                    if ($lang == "en") {
                        $req->merge(['name_en' => $req->name]);
                    } else if ($lang == "ar") {
                        $req->merge(['name_ar' => $req->name]);
                    }

                    // For the Des
                    if ($lang == "en" && isset($req->des)) {
                        $req->merge(['des_en' => $req->des]);
                    } else if ($lang == "ar") {
                        $req->merge(['des_ar' => $req->des]);
                    }
                }


                // check if we are changing the status of the user 
                if ($req->has('status')) {
                    $this->notify($institute->id, $req->status);
                }


                if ($institute->update($req->except(['logo', 'cover', 'document']))) {
                    $res['message'] = " Institute Updated Successfully.";
                    $res['code'] = 200;
                    $res['data'] = $institute;
                } else {
                    $message = " Database Error, while updating the Institute...";
                    saveAppLog($message, basename(__FILE__));
                    $res['message'] = $message;
                    $res['code'] = 500;
                    return $res;
                }

                if ($req->hasFile('document')) {
                    $document_path = $req->file('document')->store('institutes');
                    $institute->document = $document_path;
                    $institute->save();
                }
                if ($req->hasFile('logo')) {
                    $document_path = $req->file('logo')->store('institutes');
                    $institute->logo = $document_path;
                    $institute->save();
                }
                if ($req->hasFile('cover')) {
                    $document_path = $req->file('cover')->store('institutes');
                    $institute->cover = $document_path;
                    $institute->save();
                }

                return $res;
            } catch (\Exception $e) {
                $message = "Server Error! " . $e->getMessage();
                saveAppLog($message, basename(__FILE__));
                $res['message'] = $message;
                $res['code'] = 500;
                return $res;
            }
        } else {
            $res['message'] = " Institute Not Found.";
            $res['code'] = 500;
            return $res;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Institute::find($id);
        $res = [];
        try {

            if ($data) {

                $data->status = 0;

                if ($data->save()) {
                    $res['code'] = 200;
                    $res['message'] = "Institute Blocked Successfully.";
                    return $res;
                } else {
                    $res['code'] = 500;
                    $res['message'] = "Server error, while deleting the record, Please try after some time.";
                    return $res;
                }
            } else {
                $res['code'] = 500;
                $res['message'] = "Institute Not Found. ";
                return $res;
            }
        } catch (\Exception $e) {
            $mess = $e . getMessage();
            $res['code'] = 500;
            $res['message'] = $mess;

            return $res;
        }
    }


    public function getInstituteAllCourses(Request $req, $institute_id)
    {
        $res = [];
        $institute = Institute::find($institute_id);
        if ($institute) {

            $res['code'] = 200;
            $res['message'] = "Courses Fetched Successfully";
            $res['data'] = $institute->courses()->withCount('students')->where('status', '!=', 0)->orderBy('created_at','desc')->get();
            return $res;
        } else {
            $res['code'] = 500;
            $res['message'] = "Institute Not Found. ";
            return $res;
        }
    }

    public function login(Request $req)
    {

        $res = [];
        if (!isset($req->email) ||  !isset($req->email)) {

            $res['message'] = " Parameter required either email or mobile";
            $res['code'] = 200;
            return $res;
        }


        if (isset($req->email)) {
            $rules = array(

                "email" => "required",
                "password" => "required",

            );

            $validator = Validator::make($req->all(), $rules);


            if ($validator->fails()) {
                return [
                    "status" => "failed",
                    "code" => 500,
                    "errors" => $validator->errors()
                ];
            }



            if (Auth::guard('institute')->attempt([
                "email" => $req->email,
                "password" => $req->password
            ])) {
                $user = Auth::guard('institute')->user();
                if ($user->status == 0) {
                    return [
                        'message' => 'You are blocked by Admin.',
                        'code' => 500
                    ];
                }

                if (isset($req->device_token)) {
                    $user->device_token = $req->device_token; // Update the device token
                    $user->save();
                }
                $payload = [
                    'institute_id' => $user->id
                ];


                $token = $user->createToken('inst', $payload)->plainTextToken;
                return [
                    'token' => $token,
                    "type" => 'bearer',
                    'code' => 200,
                    "data" => $user
                ];
            } else {
                return [
                    'res' => 'Authentication Failed',
                    'code' => 500,
                    'message' => 'No user found'
                ];
            }
        }


        if (isset($req->mobile)) {
            $rules = array(

                "mobile" => "required",
                "password" => "required",

            );


            $validator = Validator::make($req->all(), $rules);


            if ($validator->fails()) {
                return [
                    "status" => "failed",
                    "code" => 500,
                    "errors" => $validator->errors()
                ];
            }


            if (Auth::guard('institute')->attempt([
                "mobile" => $req->mobile,
                "password" => $req->password
            ])) {
                $user = Auth::guard('institute')->user();
                if ($user->status == 0) {
                    return [
                        'message' => 'You are blocked by Admin.',
                        'code' => 500
                    ];
                }

                if (isset($req->device_token)) {
                    $user->device_token = $req->device_token; // Update the device token
                    $user->save();
                }
                $token = $user->createToken('inst')->plainTextToken;
                return [
                    'token' => $token,
                    "type" => 'bearer',
                    "data" => $user,
                    "code" => 200,
                ];
            } else {
                return [
                    'res' => 'Authentication Failed',
                    'code' => 500,
                    'message' => 'No user found'
                ];
            }
        }
    }


    public function getWalletMetaData(Request $req, $institute_id)
    {

        $res = [];
        $institute = Institute::find($institute_id);
        if ($institute) {

            // $data = WalletMetaData::where('institute_id', $institute_id)->orderBy('created_at', 'desc')->get();
            $data = WalletMetaData::where('institute_id', $institute_id)
                ->orderBy('created_at', 'desc')
                ->get();
            $res['message'] = " Wallet Meta fetched successfully.";
            $res['code'] = 200;
            $res['data'] = $data;
            $res['current_balance'] = count($data) > 0 ? $data[0]['wallet_amount'] : 0;
            return $res;
        } else {
            $res['code'] = 500;
            $res['message'] = "Institute Not Found. ";
            return $res;
        }
    }

    public function search(Request $req)
    {

        $res = [];
        if (!isset($req->search)) {
            $res['message'] = "Please send the value to be searched. ";
            $res['code'] = 500;
            return $res;
        }
        if (isset($req->lang) && $req->lang == "ar") {
            $data = Institute::where('name_ar', 'like', $req->search . '%')->get();
        } else {
            $data = Institute::where('name_en', 'like', $req->search . '%')->get();
        }



        $res['code'] = 200;
        $res['data'] = $data;
        $res['message'] = "Fetched Successfully.";
        return $res;
    }

    public function getInstituteAllCoupons(Request $req, $institute_id)
    {

        $res = [];
        $institute = Institute::find($institute_id);
        if ($institute) {

            $data = Coupon::with(['institute', 'course'])->where('institute_id', $institute_id)->orderBy('created_at', 'desc')->get();
            $res['message'] = "Coupons  fetched successfully.";
            $res['code'] = 200;
            $res['data'] = $data;
            return $res;
        } else {
            $res['code'] = 500;
            $res['message'] = "Institute Not Found. ";
            return $res;
        }
    }

    public function forgetPassword(Request $req)
    {

        $res = [];
        if (!isset($req->email) || !isset($req->type)) {

            $res['code'] = 500;
            $res['message'] = " Please pass valid params. ( Email and Type ) ";

            return $res;
        }

        try {

            $data = Institute::where('email', $req->email)->get();
            if (count($data) > 0) {
                $token = Str::random(40);
                $domain = URL::to('/');
                $url = $domain . "/auth-forgotpassword-cover?token=" . $token;
                $datetime = Carbon::now()->format('Y-m-d h:i:s');
                PasswordReset::updateOrCreate(

                    [
                        "email" => $req->email
                    ],
                    [
                        "email" => $req->email,
                        "token" => $token,
                        "created_at" => $datetime,
                        "type" => 1
                    ]
                );

                $res['code'] = 200;
                $res['message'] = " Email Sent Successfully.";
                return $res;
            } else {
                $res['code'] = 500;
                $res['message'] = "Email does not found...";
                return $res;
            }
        } catch (\Exception $e) {

            $res['code'] = 500;
            $res['message'] = $e->getMessage();
            return $res;
        }
    }

    public function getWithdrawRequests(Request $req, $institute_id)
    {

        $approvals = WithdrawRequest::where([['institute_id', '=', $institute_id], ['status', '=', 0]])->get();

        $res = [];
        $res['message'] = "Approvals fetched successfully.";
        $res['code'] = 200;
        $res['data'] = $approvals;
        return $res;
    }
    public function WithdrawRequests(Request $req, $institute_id)
    {

        $res = [];
        $institute = Institute::find($institute_id);
        if (!$institute) {
            $res['code'] = 500;
            $res['message'] = "Institute Not Found. ";
            return $res;
        }
        if (!isset($req->amount)) {

            $res['code'] = 500;
            $res['message'] = " Please send the amount";
            return $res;
        }


        if ($req->amount < 50) {
            $res['code'] = 500;
            $res['message'] = " Amount must be greater than 50 Rs.";
            return $res;
        }




        $data = WalletMetaData::where('institute_id', $institute_id)
            ->orderBy('created_at', 'desc')
            ->get();


        if (count($data) <= 0) {
            $res['code'] = 500;
            $res['message'] = " You do not have sufficeint balance.";
            return $res;
        }

        $inst_wallet_amount = $data[0]['wallet_amount'];
        if ($inst_wallet_amount < $req->amount) {
            $res['code'] = 500;
            $res['message'] = " You do not have sufficeint balance.";
            return $res;
        }


        $request  = new WithdrawRequest;
        $statement  = new WalletMetaData;

        $request->institute_id = $institute_id;
        $request->amount = $req->amount;
        $request->status = 0;
        try {
            DB::beginTransaction();
            if ($request->save()) {
                $statement->withdraw_request_id = $request->id;
                $statement->institute_id = $institute_id;
                $statement->amount = $req->amount;
                $statement->wallet_amount = $inst_wallet_amount - $req->amount;
                $statement->status = 0;
                $statement->message = "Withdraw Request";
                $statement->transection_type = "Debited";
                if ($statement->save()) {
                    $res['code'] = 200;
                    $res['message'] = " Request has been iniciated.";
                    $res['data'] = $request;
                    DB::commit();
                    return $res;
                } else {
                    $res['code'] = 500;
                    $res['message'] = "Something went wrong on backend.";
                    return $res;
                }
            } else {
                $res['code'] = 500;
                $res['message'] = "Something went wrong on backend.";
                return $res;
            }
        } catch (\Exception $e) {
            DB::rollBack();
            $request->delete();
            $statement->delete();
            $msg = $e . getMessage();
            $fileName = basename(__FILE__);
            $res['code'] = 500;
            $res['message'] = $msg;
            saveAppLog($msg);
            return $res;
        }
    }

    public function downloadStatement(Request $req, $institute_id)
    {
        $data = [];
        $order = WalletMetaData::where('institute_id', $institute_id)->get();

        if ($order) {

            try {



                // $data["order_details"] = $order;

                $settings = Setting::whereIn('label', ['address', 'email', 'phone'])->get();
                $data["address"] = isset($settings[0]['value']) ?  $settings[0]['value'] : "";
                $data["email"] = isset($settings[1]['value']) ?  $settings[1]['value'] : "";
                $data["phone"] = isset($settings[2]['value']) ?  $settings[2]['value'] : "";


                $dompdf = new Dompdf();

                $html = View::make('pages.institutes.statements', compact('order', 'data'))->render();
                $dompdf->loadHtml($html);

                $dompdf->set_option('isRemoteEnabled', true);

                $dompdf->setBasePath(public_path());

                $dompdf->render();

                $pdfContent = $dompdf->output();


                // $fileName = "DW_" . $order->id . "_" . time() . ".pdf";
                $fileName = "DW_kjldfjksdfkljsdf.pdf";
                $pdfPath = 'invoices/' . $fileName;
                Storage::put($pdfPath, $pdfContent);

                $pdfUrl = Storage::url($pdfPath);

                $res['code'] = 200;
                $res['message'] = "Statement Downloaded Successfully.";
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

    public function getInstituteRating( Request $req , $id ){

        $inst = Institute::find($id);
        if($inst ){
            try{

                $res['code'] = 200;
                $res['data']= $inst->ratings()->with('student')->get()->toArray();
                $res['total_rating'] = $inst->ratings()->count();
                $res['average_rating'] = $inst->ratings()->avg('rating');
                $res['message'] = "Ratings fetched success.";
                return $res ;

            }catch(\Exception $e ){
                $res['code'] = 500;
                $res['message'] = $e->getMessage();
                saveAppLog($res['message']);
                return $res;
            }
          
        }else {
            $res['code'] = 500;
            $res['message'] = "Opps!, Order Not Found";
            return $res;

        }

    }
    public function postInstituteRating( Request $req , $id ){

        if(!isset( $req->student_id)){
            $res['code'] = 500;
            $res['message'] = "Provide Student ID.";
            return $res;
        }
        if(!isset( $req->comment)){
            $res['code'] = 500;
            $res['message'] = "Please provide comment.";
            return $res;
        }
        if(!isset( $req->rating)){
            $res['code'] = 500;
            $res['message'] = "Please provide rating, must be integer.";
            return $res;
        }

        $lang="en";
        if(isset( $req->lang) && isset( $req->lang)=="ar" ){
            $lang="ar";
        }


        $inst = Institute::find($id);
        $stu= Student::find($req->student_id);
        $isEnrolled = false ;
        // check student has bought any course of this institute or not 

        $enrolled_courses= $stu->courses;
        foreach ($enrolled_courses as $course) {
            if($course->institute->id==$id){
                $isEnrolled = true ;
            }
          
        }
        if($isEnrolled ==false ){
            $res['code'] = 500;
            $res['message'] = "You can't rate, you have not enrolled in any of the course.";
            return $res;
        }

        if($inst  && $stu  && $isEnrolled  ){
            try{

                $res['code'] = 200;
                $res['data']= $inst->ratings()->create([

                    "institute_id"=>$id,
                    "student_id"=>$req->student_id,
                    "comment"=>$req->comment,
                    "rating"=>$req->rating,
                    "lang"=>$req->lang,
                ]);
                $res['message'] = "Your rating posted successfully.";
                return $res ;

            }catch(\Exception $e ){
                $res['code'] = 500;
                $res['message'] = $e->getMessage();
                saveAppLog($res['message']);
                return $res;
            }
          
        }else {
            $res['code'] = 500;
            $res['message'] = "Opps!, Either instiute id or student id is not found.";
            return $res;

        }

    }

public function toggleStatus($id)
{
    $institute = Institute::find($id);

    if (!$institute) {
        return response()->json(['code' => 404, 'message' => 'Institute not found.']);
    }

    // Toggle the status (1 = Active, 0 = Blocked)
    $institute->status = $institute->status == 1 ? 0 : 1;
    $institute->save();

    $statusText = $institute->status == 1 ? 'Active' : 'Blocked';

    return response()->json(['code' => 200, 'message' => "Institute status updated to $statusText."]);
}
}
