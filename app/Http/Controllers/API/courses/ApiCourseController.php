<?php

namespace App\Http\Controllers\API\courses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\courses\Course;
use App\Models\courses\Category;
use App\Models\institutes\Institute;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\File;
use App\Models\settings\Setting;
use Illuminate\Support\Facades\DB;
use App\Rules\ValidInstitute;


class ApiCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {


        try {


            $res = [];
            $res['code'] = 200;
            $res['message'] = "Courses fetched successfully.";
            $res['data'] = Course::withCount('students')->with('institute')->orderBy('created_at', 'desc')
                ->get();
    
            return  $res;


        } catch (\Exception $e) {
            $message = "Server Error " . $e->getMessage();
            saveAppLog($message, basename(__FILE__));
            $res['code'] = 403;
            $res['message'] = $message;
            return $res;
        }

      
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
        $res = [];
        $rules = array(
            "name" => ["required"],
            "title" => ["required"],
            "start_date" => ["required", "date"],
            "end_date" => ["required", "date", "after_or_equal:start_date"],
            "course_type" => "required|integer",
            "institute_id" => ["required", "exists:institutes,id", new ValidInstitute],
            "price" => "required|integer",
            "instructor" => "required",
            "lang" => ['required', Rule::in(['ar', 'en'])],
            "specified_for" => ['required', Rule::in(['male', 'female', 'both'])],
        );
    
        $messages = [
            "name.required" => "This field is required.",
            "title.required" => "This field is required.",
            "start_date.required" => "This field is required.",
            "end_date.required" => "This field is required.",
            "end_date.after_or_equal" => "The end date must be after or equal to the start date.",
            "course_type.required" => "The course type field is required.",
            "course_type.integer" => "The course type must be an integer.",
            "institute_id.required" => "The institute ID field is required.",
            "institute_id.exists" => "The selected institute ID is invalid.",
            "price.required" => "The price field is required.",
            "specified_for.required" => "The specified_for field is required.",
            "price.integer" => "The price must be an integer.",
            "lang.required" => "The language field is required.",
            "lang.in" => "Invalid language selection.",
        ];
    
        $validator = Validator::make($req->all(), $rules, $messages);
    
        if ($validator->fails()) {
            return [
                "status" => "failed",
                "code" => 500,
                "errors" => $validator->errors()
            ];
        }
    
        if ($validator->passes()) {
            $course = new Course;
            try {
                $unique_id = Str::uuid();
                $course->course_id = $unique_id;
                $course->name = $req->name;
                $course->title = $req->title;
                $course->price = $req->price;
                $course->institute_id = $req->institute_id;
    
                // Parse dates correctly
                $startDateTime = Carbon::createFromFormat('Y-m-d', $req->start_date);
                $endDateTime = Carbon::createFromFormat('Y-m-d', $req->end_date);
    
                $course->start_date = $startDateTime;
                $course->end_date = $endDateTime;
                $course->course_type = (int)$req->course_type;
    
                if (isset($req->seats)) {
                    $course->seats = $req->seats;
                }
                 // 👇 Assign seats based on specified_for selection
                if ($req->specified_for === 'male') {
                    $course->seats_male = 1;
                    $course->seats_female = 0;
                } elseif ($req->specified_for === 'female') {
                    $course->seats_male = 0;
                    $course->seats_female = 1;
                } elseif ($req->specified_for === 'both') {
                    $course->seats_male = 1;
                    $course->seats_female = 1;
                }
                if (isset($req->sale_price)) {
                    $course->sale_price = $req->sale_price;
                }
                if (isset($req->category_id)) {
                    $course->category_id = $req->category_id;
                }
                if (isset($req->class_time)) { // Correctly handle class_time
                    $course->timing = $req->class_time;
                }
                if (isset($req->specified_for)) {
                    $course->specified_for = $req->specified_for;
                }
                if (isset($req->instructor)) {
                    $course->instructor = $req->instructor;
                }
                if (isset($req->course_link)) {
                    $course->course_link = $req->course_link;
                }
    
                if (isset($req->des)) {
                    $course->des = $req->des;
                }
    
                if (isset($req->topics)) {
                    $course->topics = $req->topics;
                }
    
                if ($req->hasFile('thumbnail')) {
                    $document_path = $req->file('thumbnail')->store('courses/thumbnails');
                    $course->thumbnail = $document_path;
                } else {
                    $course->thumbnail = "default/default_course.png";
                }
    
                if ($req->hasFile('document')) {
                    $document_path = $req->file('document')->store('courses/documents');
                    $course->document = $document_path;
                }
    
                if ($req->lang == 'en') {
                    $course->language_id = 1001;
                }
                if ($req->lang == 'ar') {
                    $course->language_id = 1002;
                }
    
                $settings = Setting::whereIn('label', ['course_approval'])->get();
                if (isset($settings[0]['value']) && $settings[0]['value'] == 'disabled') {
                    $course->status = 1;
                } else {
                    $course->status = 2;
                }
    
                if ($course->save()) {
                    $res['code'] = 200;
                    $res['message'] = "Course Saved Successfully";
                    $res['data'] = $course;
                    return $res;
                } else {
                    $res['code'] = 500;
                    $res['message'] = "Oops! Database error, please try again...";
                    return $res;
                }
            } catch (\Exception $e) {
                $message = "Server Error " . $e->getMessage();
                saveAppLog($message, basename(__FILE__));
                $res['code'] = 403;
                $res['message'] = $message;
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
    public function show(Request $req, $id)
    {

        $res = [];
        $lang_id = '1001';

        if (isset($req->lang)) {

            if ($req->lang == "ar") {

                $lang_id = '1002';
            } else if ($req->lang == "en") {
                $lang_id = '1001';
            } else {
                $res['message'] = "Language is incorrect";
                $res['code'] = 500;
                return $res;
            }
        }


        if(isset($req->_fields)){
            $data = Course::select(explode(',', $req->_fields))->where([['course_id', '=', $id], ['language_id', '=', $lang_id]])->get();

        }else{
            $data = Course::where([['course_id', '=', $id], ['language_id', '=', $lang_id]])->get();

        }
        $res = [];
        if ($data) {
            $res['code'] = 200;
            $res['message'] = "Course  Fetched Successfully.";
            $res['data'] = $data;
            return $res;
        } else {
            $res['code'] = 500;
            $res['message'] = "Course Not Found. ";
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

                    $title = $data['course_approval']['title_en'];
                    $msg = $data['course_approval']['msg_en'];

                    saveAppLog($title);
                    if (isset($inst->default_lang)) {
                        $default_lang = $inst->default_lang;
                    }

                    if ($default_lang == "ar") {
                        $title = $data['course_approval']['title_ar'];
                        $msg = $data['course_approval']['msg_ar'];
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
                    $title = $data['course_rejected']['title_en'];
                    $msg = $data['course_rejected']['msg_en'];

                    if (isset($inst->default_lang)) {
                        $default_lang = $inst->default_lang;
                    }

                    if ($default_lang == "ar") {
                        $title = $data['course_rejected']['title_ar'];
                        $msg = $data['course_rejected']['msg_ar'];
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
            $res['message'] = "Please send lang parameter...";
            $res['code'] = 500;
            return $res;
        }

        if ($req->lang == "ar") {
            $lang_id = 1002;
        } else if ($req->lang == "en") {
            $lang_id = 1001;
        } else {
            $res['message'] = "Invalid lang parameter...";
            $res['code'] = 500;
            return $res;
        }


        try {


            if (isset($req->start_date)) {

                $startDateTime = Carbon::createFromFormat('Y-m-d H:i', $req->start_date);
                $req->merge(['start_date' => $startDateTime]);
            }

            if (isset($req->end_date)) {

                $endDateTime = Carbon::createFromFormat('Y-m-d H:i', $req->end_date);
                $req->merge(['end_date' => $endDateTime]);
            }


            $req->merge(['language_id' => $lang_id]);
            $req->merge(['course_id' => $id]);





            $course = Course::where([
                'course_id' => $id,
                'language_id' => $lang_id
            ])->first();


            if ($course) {

                // check if we are changing the status of the user 
                if ($req->has('status')) {
                    $this->notify($course->institute_id, $req->status);
                }

                $course->update($req->all());

                if ($req->hasFile('thumbnail')) {
                    $document_path = $req->file('thumbnail')->store('institutes');
                    $course->thumbnail = $document_path;
                }

                $course->save();


                $res['message'] = "Course Updated Successfully.";
                $res['code'] = 200;
                $res['data'] = $course;
                return $res;
            } else {

                $inst_id = Course::where([
                    'course_id' => $id,
                ])->first();

                $inst_id = $inst_id['institute_id'];
                $req->merge(['institute_id' => $inst_id]);
                $course = Course::create($req->all());

                if ($req->hasFile('thumbnail')) {
                    $document_path = $req->file('thumbnail')->store('institutes');
                    $course->thumbnail = $document_path;
                }

                $course->save();

                $res['message'] = "Course Created Successfully with diffenet language.";
                $res['code'] = 500;
                return $res;
            }
        } catch (\Exception $e) {

            $res['code'] = 500;
            $res['message'] = $e->getMessage();
            saveAppLog($res['message'], basename(__FILE__));
            return $res;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $req, $id)
    {



        $res = [];

        if (!isset($req->language_id)) {
            $res['code'] = 500;
            $res['message'] = "Please Pass Lang.";
            return $res;
        }


        $data = Course::where([["course_id", '=', $id], ['language_id', '=', $req->language_id]])->get();
        $data = $data->first();

        $res = [];
        if ($data) {

            try {

                $data->status = 0;
                if ($data->save()) {
                    $res['code'] = 200;
                    $res['message'] = "Course Deleted Successfully.";
                    return $res;
                } else {
                    $res['code'] = 500;
                    $res['message'] = "Server error, while deleting the record, Please try after some time.";
                    return $res;
                }
            } catch (\Exception $e) {
                $mess = $e . getMessage();
                $res['code'] = 500;
                $res['message'] = $mess;
                saveAppLog($mess);
                return $res;
            }
        } else {
            $res['code'] = 500;
            $res['message'] = "Course Not Found. ";
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

        if (!isset($req->lang)) {
            $res['message'] = "Please send the Language code.";
            $res['code'] = 500;
            return $res;
        }

        if ($req->lang == 'ar') {
            $lang_id = 1002;
        } else if ($req->lang == 'en') {
            $lang_id = 1001;
        } else {
            $res['message'] = "Invalid language Code. ";
            $res['code'] = 500;
            return $res;
        }

        $data = Course::where([['name', 'like', $req->search . '%'], ['language_id', '=', $lang_id]])->get();

        $res['code'] = 200;
        $res['data'] = $data;
        $res['message'] = "Fetched Successfully.";
        return $res;
    }



    public function getAllCourseStudents(Request $req, $course_id)
    {
        $res = [];
        if (!isset($course_id)) {
            $res['code'] = 200;
            $res['message'] = "please send the course ID to fetch courses.";
            return $res;
        }


        $course = Course::where('course_id', $course_id)->get();
        $course = $course->first();
        if ($course) {

            $res['code'] = 200;
            $res['message'] = "Students Fetched Successfully. ";
            $res['data'] = $course->students;
            return $res;
        } else {
            $res['code'] = 500;
            $res['message'] = "Course Not Found.";
            return $res;
        }
    }
    public function getAllCoupons(Request $req, $course_id)
    {
        $res = [];
        $course = Course::where("course_id", $course_id)->get();

        $course = $course->first();

        if ($course) {
            $res['code'] = 200;
            $res['message'] = "Coupons Fetched Successfully.";
            $res['data'] = $course->coupons;
            return $res;
        } else {
            $res['code'] = 500;
            $res['message'] = "Course Not Found.";
            return $res;
        }
    }


    public function getAllCategories(Request $req)
    {
        $res = [];
        $cats = Category::all();


        if ($cats) {
            $res['code'] = 200;
            $res['message'] = "Category Fetched Successfully.";
            $res['data'] = $cats;
            return $res;
        } else {
            $res['code'] = 500;
            $res['message'] = "Category Not Found.";
            return $res;
        }
    }
    public function getCategory(Request $req, $id)
    {
        $res = [];
        $cats = Category::find($id);


        if ($cats) {
            $res['code'] = 200;
            $res['message'] = "Category Fetched Successfully.";
            $res['data'] = $cats;
            $res['courses'] = $cats->courses()->with('institute')->get();
            return $res;
        } else {
            $res['code'] = 500;
            $res['message'] = "Category Not Found.";
            return $res;
        }
    }
    public function addCategory(Request $req)
    {

        $res = [];
        $lang_id = '1001';

        $cat = new Category;


        if (isset($req->lang)) {

            if ($req->lang == "ar") {

                $cat->name = $req->name;
                $cat->name_ar = $req->name;
            } else if ($req->lang == "en") {

                $cat->name = $req->name;
                $cat->name_en = $req->name;
            } else {
                $res['message'] = "Language is incorrect";
                $res['code'] = 500;
                return $res;
            }
        } else {
            $res['message'] = "Please send lang.";
            $res['code'] = 500;
            return $res;
        }



        $cat->status = isset($req->status) ? $req->status : 1;

        try {

            $cat->save();
            $res['code'] = 200;
            $res['message'] = "Category Created Successfully.";
            $res['data'] = $cat;
            return $res;
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            saveAppLog($msg, basename(__FILE__));
            $res['code'] = 500;
            $res['message'] = $msg;
            return $res;
        }
    }


    public function updateCategory(Request $req, $id)
    {


        $res = [];

        $cat = Category::find($id);
        try {

            if ($cat) {

                $cat->update($req->all());
                $res['code'] = 200;
                $res['message'] = " Admin Updated Successfully.";
                return $res;
            } else {
                $res['code'] = 500;
                $res['message'] = "Not Found.";
                return $res;
            }
        } catch (\Exception $e) {
            $mes = $e->getMessage();
            saveAppLog($mes);
            $res['code'] = 500;
            $res['message'] = $mes;
            return $res;
        }
    }
}
