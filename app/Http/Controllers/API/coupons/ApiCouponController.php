<?php

namespace App\Http\Controllers\API\coupons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\coupons\Coupon;
use App\Models\coupons\CouponUsage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Rules\ValidInstitute;
use App\Rules\ValidCourse;


class ApiCouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $res = [];
        $coupons = Coupon::with(['institute', 'courses'])->withCount('courses')->orderBy('created_at', 'desc')->get();
        $res['message'] = "Coupons fetched successfully.";
        $res['code'] = 200;

        // Manually load all the courses associated with each coupon
        foreach ($coupons as $coupon) {
            $coupon->load('courses'); // Load the 'courses' relationship for each coupon
        }

        $res['data'] = $coupons;
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

        $rules = array(
            "code" => "required|unique:coupons,code",
            "type" => ['required', Rule::in(['1', '0'])],
            "institute_id" => ["required", "exists:institutes,id", new ValidInstitute],
            "course_id" => ['required'],
            "amount" => "required|integer",
            "max_usage" => "required|integer",
            "start_date" => ["required"],
            "end_date" => ["required"],
        );




        $validator = Validator::make($req->all(), $rules);


        if ($validator->fails()) {
            return [
                "status" => "failed",
                "code" => 500,
                "errors" => $validator->errors()
            ];
        }

        if ($req->type == 0) {

            // It means that percentage discount is to be given 
            if ($req->amount > 100) {
                $res['message'] = "You can not give discount greater than the course price...";
                $res['code'] = 500;
                return $res;
            }
        }




        if ($validator->passes()) {

            try {

                $coupon = new Coupon;
                $coupon->institute_id = $req->institute_id;
                $coupon->code = $req->code;
                $coupon->coupon_type = $req->type;
                $coupon->course_id = $req->course_id;
                $coupon->amount = $req->amount;
                $coupon->max_usage = $req->max_usage;


                $startDateTime = Carbon::createFromFormat('m-d-Y H:i', $req->start_date);
                $endDateTime = Carbon::createFromFormat('m-d-Y H:i', $req->end_date);

                // Assuming $coupon is an instance of your Coupon model
                $coupon->start_date = $startDateTime;
                $coupon->end_date = $endDateTime;

                $coupon->save();

                $course_ids = explode(",", $req->course_id);
                if (!is_array($course_ids)) {
                    $course_ids = [$course_ids]; // Convert single value to an array with one element
                }

                foreach ($course_ids as $id) {

                    $coupon->courses()->attach($id);
                }

                $res['message'] = "Coupon have saved successfully...";
                $res['code'] = 200;
                return $res;
            } catch (\Exception $e) {

                $res['message'] = $e->getMessage();
                $res['code'] = 500;
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

        $res = [];
        $coupons = Coupon::where('id', $id)->with(['institute', 'courses'])->withCount('courses')->orderBy('created_at', 'desc')->first();
        if ($coupons) {

            $res['message'] = "Coupons fetched successfully.";
            $res['code'] = 200;


            $res['data'] = $coupons;
            return $res;
        } else {
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        $res = [];
        $coupon = Coupon::find($id);
        if ($coupon) {

            try {
                $coupon->update($req->all());
                $res['code'] = 200;
                $res['message'] = "Coupon Updated Successfully.";
            } catch (\Exception $e) {
                $res['message'] = $e->getMessage();
                $res['code'] = 500;
                return $res;
            }
        } else {
            $res['code'] = 500;
            $res['message'] = "Coupon not found.";
        }
        return $res;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = [];
        $coupon = Coupon::find($id);
        if ($coupon) {

            $coupon->status = 0;
            $coupon->save();
            $res['code'] = 200;
            $res['message'] = "Coupon Deleted Successfully.";
        } else {
            $res['code'] = 500;
            $res['message'] = "Coupon not found.";
        }
        return $res;
    }

    public function getTopCoupons()
    {
        $res = [];
        $coupons = Coupon::where([['institute_id', '=', 0], ['course_id', '=', 0]])->with(['institute', 'course'])->get();

        if ($coupons) {
            $res['message'] = "Top Coupons fetched successfully.";
            $res['code'] = 200;
            $res['data'] = $coupons;
            return $res;
        } else {
            $res['message'] = "No Coupons Found.";
            $res['code'] = 500;
        }
    }

    public function verifyCoupon(Request $req)
    {
        $res = [];

        // return $req->all();
        $rules = array(
            "code" => "required",
            "student_id" => "required",
        );

        $validator = Validator::make($req->all(), $rules);


        if ($validator->fails()) {
            return [
                "status" => "Coupon is not valid.",
                "code" => 500,
                "errors" => $validator->errors()
            ];
        }


        // check the coupon code 
        $coupon = Coupon::where([['code', '=', $req->code]])->first();

        if ($coupon) {

            if ($coupon->status == 0) {
                $res['message'] = "This coupon is bloked by admin.";
                $res['code'] = 500;
                return $res;
            }

            // Coupon is global and can be applied to any course 
            if ($coupon->institute_id == 0 && $coupon->course_id == 0) {
                if ($coupon->hasExpired()) {
                    $res['message'] = " Coupon is expired.";
                    $res['code'] = 500;
                    return $res;
                } else {

                    // check the max limit of the coupon 
                    $max_usage = $coupon->max_usage;
                    $record = CouponUsage::where([['student_id', '=', $req->student_id], ['coupon_id', '=', $req->coupon_id]])->first();
                    if ($record) {

                        // If the max limit is exceeded 
                        if ($record->count >= $max_usage) {
                            $res['message'] = " Max Limit Exceeded.";
                            $res['code'] = 500;
                            return $res;
                        }
                    }
                    $res['message'] = "Valid coupon.";
                    $res['code'] = 200;
                    $res['data'] = $coupon;
                    return $res;
                }
            } else {

                // coupon is not global created by the institute to any course 
                if (!isset($req->institute_id) && !isset($req->course_id)) {
                    $res['message'] = "Please send course and institute id.";
                    $res['code'] = 500;
                    return $res;
                }

                // Coupon not valid for the course 
                if ($coupon->course_id != 0 && $coupon->course_id != $req->course_id) {
                    $res['code'] = 500;
                    $res['message'] = "This coupon is not valid for this course";
                    return $res;
                    // coupon not valid for the institute 
                } else if ($coupon->institute_id != 0 && $coupon->institute_id != $req->institute_id) {
                    $res['code'] = 500;
                    $res['message'] = "This coupon is not valid for this institute";
                    return $res;
                    // Coupon is not valid for both 
                } else if ($coupon->institute_id != 0 && $coupon->course_id != 0 && $coupon->institute_id != $req->institute_id &&  $coupon->course_id != $req->course_id) {
                    $res['code'] = 500;
                    $res['message'] = "This coupon is not valid for this course and institute.";
                    return $res;
                }


                if ($coupon->hasExpired()) {
                    $res['message'] = " Coupon is expired.";
                    $res['code'] = 500;
                    return $res;
                } else {

                    // check the max limit of the coupon 
                    $max_usage = $coupon->max_usage;
                    $record = CouponUsage::where([['student_id', '=', $req->student_id], ['coupon_id', '=', $req->coupon_id]])->first();
                    if ($record) {

                        // If the max limit is exceeded 
                        if ($record->count >= $max_usage) {
                            $res['message'] = " Max Limit Exceeded.";
                            $res['code'] = 500;
                            return $res;
                        }
                    }

                    $res['message'] = "Valid coupon.";
                    $res['code'] = 200;
                    $res['data'] = $coupon;
                    return $res;
                }
            }
        } else {
            $res['message'] = "No Coupons Found.";
            $res['code'] = 500;
            return $res;
        }
    }

    public function getInstituteAllCoupons(Request $req, $institute_id)
    {

        $res = [];
        $data = [];
        $currentDate = Carbon::now();

        $valid_coupons = Coupon::where([['institute_id', '=', $institute_id], ['end_date', '>=',  $currentDate]])->get();
        $expired_coupons = Coupon::where([['institute_id', '=', $institute_id], ['end_date', '<',  $currentDate]])->get();

        $data['valid'] = $valid_coupons;
        $data['expired'] = $expired_coupons;
        $res['code'] = 200;
        $res['data'] = $data;
        return $res;
    }
}
