<?php

namespace App\Http\Controllers\API\students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Models\students\Student;
use App\Models\courses\Course;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\payments\Payment;


class ApiStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::withCount('courses')->orderBy('created_at','desc')->get();
        return  $students;
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
        if (isset($req->adminRequest)) {
            $rules = array(
                "name" => "required",
                "lang" => ['required', Rule::in(['ar', 'en'])],
                "email" => "required|email|unique:students,email",
                "password" => "required",
                "mobile" => "required|unique:students,mobile",
                "birthday" => "nullable|date",
                "gender" => "nullable|in:male,female,other",
            );
        } else {
            $rules = array(
                "name" => "required",
                "lang" => ['required', Rule::in(['ar', 'en'])],
                "password" => "required",
                "mobile" => "required|unique:students,mobile",
                "birthday" => "nullable|date",
                "gender" => "nullable|in:male,female,other",
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
    
        if ($validator->passes()) {
            $student = new Student;
            $student->name = $req->name;
            $student->mobile = $req->mobile;
    
            if ($req->lang == 'ar') {
                $student->name_ar = $req->name;
            } else if ($req->lang == 'en') {
                $student->name_en = $req->name;
            }
    
            $student->password = Hash::make($req->password);
    
            if (isset($req->country_id)) {
                $student->country_id = $req->country_id;
            }
            if (isset($req->state_id)) {
                $student->state_id = $req->state_id;
            }
            if (isset($req->city_id)) {
                $student->city_id = $req->city_id;
            }
            if (isset($req->longitude)) {
                $student->longitude = $req->longitude;
            }
            if (isset($req->latitude)) {
                $student->latitude = $req->latitude;
            }
            if (isset($req->email)) {
                $student->email = $req->email;
            }
            if (isset($req->address)) {
                $student->address = $req->address;
            }
            if (isset($req->des)) {
                if ($req->lang == 'ar') {
                    $student->des_ar = $req->des;
                } else if ($req->lang == 'en') {
                    $student->des_en = $req->des;
                }
            }
    
            // New fields
            $student->birthday = $req->birthday;
            $student->gender = $req->gender;
    
            $student->status = 1;
            if ($student->save()) {
                $token = $student->createToken('stu')->plainTextToken;
                $res['message'] = "Student stored successfully.";
                $res['code'] = 200;
                $res['data'] = $student;
                $res['type'] = "bearer";
                $res['token'] = $token;
                return $res;
            } else {
                $res['message'] = " Database error, please contact developer...";
                $res['code'] = 500;
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
        $student = Student::find($id);
        $res = [];
        if ($student) {

            $res['message'] = "Student fetched successfully.";
            $res['code'] = 200;
            $res['data'] = $student;
            return $res;
        } else {
            $res['message'] = " Student Not Found.";
            $res['code'] = 500;
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
            $res['message'] = "Please send the lang paramerter to continue updating... ";
            $res['code'] = 500;
            return $res;
        }

        $student = Student::find($id);
        $res = [];
        if ($student) {

            try{
                if ($student->update($req->except(['lang']))) {
                    $res['message'] = " Student updated successfully.";
                    $res['code'] = 200;
                    $res['data'] = $student;
                    return $res;
                } else {
                    $res['message'] = " Database Error, while updating the Student...";
                    $res['code'] = 500;
                    return $res;
                }
            }catch(\Exception  $e ){
                $res['message'] =$e->getMessage();
                $res['code'] = 500;
                saveAppLog($res['message']);
                return $res;
            }
           

            // $institute->name = isset($req->name) ? $req->name ;

            // if ($req->lang == 'ar') {
            //     $institute->name_ar = $req->name;
            // } else if ($req->lang == 'en') {
            //     $institute->name_en = $req->name;
            // }

            // $institute->mobile = $req->mobile;
            // $institute->contact_person_mobile = $req->contact_person_mobile;
            // $institute->email = $req->email;



            // // Check For Logo 
            // if ($req->hasFile('logo')) {
            //     $logo_path = $req->file('logo')->store('institutes');
            //     $institute->logo = $logo_path;
            // }

            // Check For Document  
            // if ($req->hasFile('document')) {
            //     $document_path = $req->file('document')->store('institutes');
            //     $institute->document = $document_path;
            // }

            // Check For Cover  
            // if ($req->hasFile('cover')) {
            //     $cover_path = $req->file('cover')->store('institutes');
            //     $institute->cover = $cover_path;
            // }

            // if ($req->lang == 'ar') {
            //     $institute->des_ar = $req->des;
            //     $institute->lang = json_encode(['ar' => true]);
            // } else if ($req->lang == 'en') {
            //     $institute->des_eng = $req->des;
            //     $institute->lang = json_encode(['en' => true]);
            // }
            // $institute->address = $req->address;
            // $institute->longitude = $req->longitude;
            // $institute->latitude = $req->latitude;
            // $institute->city_id = $req->city_id;
            // $institute->state_id = $req->state_id;
            // $institute->country_id = $req->country_id;

            // if (isset($req->adminRequest)) {
            //     $institute->mobileVerified = 1;
            //     $institute->emailVerified = 1;
            //     $institute->createdBy = Auth::user()->id;
            // } else {
            //     $institute->mobileVerified = $req->mobileVerified;
            //     $institute->emailVerified = $req->emailVerified;
            //     $institute->createdBy = "self";
            // }


            // $institute->password = Hash::make($req->password);

            // $institute->status = 0;
            // if ($institute->save()) {
            //     return [
            //         'code' => 200,
            //         "message" => "User Added Successfully.",
            //         "data" =>  $institute
            //     ];
            // } else {
            //     return [
            //         'code' => 500,
            //         "message" => "Database Error, While inserting the student.",
            //     ];
            // }
            // }

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
        $res = [];
        if (!isset($id)) {
            $res['code'] = 500;
            $res['message'] = "please send the student ID to delete the student.";
            return $res;
        }


        $student = Student::find($id);
        if ($student) {
            $student->status = 0;
            if ($student->save()) {
                $res['code'] = 200;
                $res['message'] = "Student Deleted Success.";
                return $res;
            } else {
                $res['code'] = 500;
                $res['message'] = "Database error while deleting the student, please try after some time.";
                return $res;
            }
        } else {
            $res['code'] = 500;
            $res['message'] = "Student Not Found.";
            return $res;
        }
    }


    public function getStudentAllCourses(Request $req, $student_id)
    {

        $res = [];
        if (!isset($student_id)) {
            $res['code'] = 200;
            $res['message'] = "please send the student ID to fetch courses.";
            return $res;
        }


        $student = Student::find($student_id);
        if ($student) {
            $res['code'] = 200;
            $res['message'] = "Fetched Successfully.";
            $res['data'] = $student->courses;
            return $res;
        } else {
            $res['code'] = 500;
            $res['message'] = "Student Not Found.";
            return $res;
        }
    }

    public function  enrollStudentInCourse(Request $req, $student_id, $course_id)
    {
        $res = [];

        $student = Student::find($student_id);
        if (!$student) {
            $res['code'] = 500;
            $res['message'] = "Student Not Found.";
            return $res;
        }

        $course = Course::find($course_id);
        if (!$course) {
            $res['code'] = 500;
            $res['message'] = "Course Not Found.";
            return $res;
        }


        if ($course->hasExpired()) {
            $res['code'] = 500;
            $res['message'] = "Sorry this course has been expired...";
            return $res;
        } else {

            $alreadyEnrolled = $student->courses->contains($course_id);
            if ($alreadyEnrolled) {
                $res['code'] = 500;
                $res['message'] = "Sorry, You have already enrolled in this course...";
                return $res;
            }

            $student->courses()->attach($course);
            $res['code'] = 200;
            $res['message'] = "You have successfully enrolled.";
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



            if (Auth::guard('student')->attempt([
                "email" => $req->email,
                "password" => $req->password
            ])) {
                $user = Auth::guard('student')->user();

                if( $user->status==0){
                    return [
                        'message' => 'You are blocked by admin.',
                        'code' => 500               
                    ];

                }

                $token = $user->createToken('stu')->plainTextToken;
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


            if (Auth::guard('student')->attempt([
                "mobile" => $req->mobile,
                "password" => $req->password
            ])) {
                $user = Auth::guard('student')->user();
                $token = $user->createToken('stu')->plainTextToken;
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



    // @ written by Nikhil on 20 July 2023
    public function courseSearch(Request $req)
    {

        $language_id = 1001;
        $longitude = null;
        $latitude = null;
        $minPrice = null;
        $maxPrice = null;
        $courseName = "";
        $courseTitle = "";
        $res = [];
        $perPage = 5;

        if (isset($req->lang)) {
            if ($req->lang == "ar") {
                $language_id = 1002;
            }
        }
        if (isset($req->longitude)) {
            $longitude = $req->longitude;
        }
        if (isset($req->latitude)) {
            $latitude = $req->latitude;
        }

        if (isset($req->per_page)) {
            $perPage = $req->per_page;
        }

        if (isset($req->name)) {
            $courseName  = $req->name;
        }
        if (isset($req->title)) {
            $courseTitle = $req->title;
        }



        // If location is not sent then show latest courses 
        if ($longitude == null && $latitude == null) {

            $query = Course::query();

            if ($courseName) {
                $query->where('name', 'like', $courseName . '%');
            }

            if ($courseTitle) {
                $query->where('title', 'like', $courseTitle . '%');
            }

            // Add the language_id condition to the query
            $query->where('language_id', $language_id);

            // Continue building the query
            $query->latest();

            // Apply pagination to the query
            $latestCourses = $query->get();
            $res['code'] = 200;
            $res['message'] = "Courses Fetched Successfully";
            $res['data'] = $latestCourses;
            return $res;
        }


        if ($longitude != null && $latitude != null) {

            $latitude = $req->latitude;
            $longitude = $req->longitude; // Longitude of the target location
            $distance = 5; // Distance in kilometers


            $nearestInstitutes = DB::table('institutes')
            ->selectRaw(
                'id, name, address, latitude, longitude, 
                (6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance',
                [$latitude, $longitude, $latitude]
            )
            ->orderByRaw('distance, id') 
            ->get();

            
            $nearestInstituteIds = $nearestInstitutes->pluck('id')->toArray();


            $nearestCourses = [];
            foreach ($nearestInstituteIds as $nearestInstituteId) {
                $courses = Course::with('institute')->where('language_id',$language_id)->whereIn('institute_id', [$nearestInstituteId])->get()->toArray();
                $nearestCourses = array_merge($nearestCourses, $courses);
            }
            
            $res['code'] = 200;
            $res['message'] = "Courses Fetched Successfully";
            $res['data'] = $nearestCourses;
            return $res;
          

        }
    }

    public function getStudentOrders( Request $req , $student_id){

        $res=[];
        $res['code']=200;
        $res['data']=Payment::with(['institute','course','student'])->where('student_id',$student_id)->orderBy('created_at','desc')->get();
        return $res ;

    }


    public function search(Request $req)
    {

        $res = [];
        if (!isset($req->search)) {
            $res['message'] = "Please send the value to be searched. ";
            $res['code'] = 500;
            return $res;
        }
        // if (isset($req->lang) && $req->lang == "ar") {
        //     $data = Institute::where('name_ar', 'like', $req->search . '%')->get();
        // }else{
        //     $data = Institute::where('name_en', 'like', $req->search . '%')->get();

        // }

        $data = Student::where('name', 'like', $req->search . '%')->get();


        $res['code'] = 200;
        $res['data'] = $data;
        $res['message'] = "Fetched Successfully.";
        return $res;
    }

    public function exportAttendance(Request $req ){

    }

}
