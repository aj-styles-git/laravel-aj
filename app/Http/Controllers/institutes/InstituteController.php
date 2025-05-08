<?php

namespace App\Http\Controllers\institutes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\institutes\Institute;
use App\Models\courses\Course;
use App\Models\courses\Category;
use App\Models\students\Student;
use App\Models\countries\Country;
use App\Models\states\State;
use App\Models\citites\City;
use App\Models\payments\Approval;
use App\Models\coupons\Coupon;
use App\Models\payments\Payment;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class InstituteController extends Controller
{


    public function index()
    {
        $title = "Institutes ";
        $description = "Institutes ";
        $institutes = Institute::withCount('courses')->get();

        return view('pages.institutes.institutes', compact('title', 'description', 'institutes'));
    }

    public function allCourses()
    {
        $title = "Institutes ";
        $description = "Institutes ";
        $courses = Course::withCount('students')->get();
        return view('pages.courses.courses', compact('title', 'description', 'courses'));
    }
    
    public function allcategories()
    {
        $title = "Categories ";
        $description = "Categories ";
        return view('pages.courses.couse_categories', compact('title', 'description'));
    }


    public function courseDetail(Request $req, $course_id)
    {
        $title = "Course Detail ";
        $description = "Course Detail ";
        $course = Course::where([['course_id', '=', $course_id]])->get();
        $course_count=$course->count();
        $course = $course->first();
        if ($course) {

            return view('pages.courses.course_detail', compact('title', 'description', 'course','course_count'));
        } else {
            $courses = Course::withCount('students')->get();

            return view('pages.courses.courses', compact('title', 'description', 'courses'));
        }
    }

    public function studentProfile(Request $req, $student_id)
    {
        $title = "Course Detail ";
        $description = "Course Detail ";
        $student = Student::find($student_id);
        if ($student) {

            return view('pages.students.student_profile', compact('title', 'description', 'student'));
        } else {
            $students = Student::all();

            return view('pages.students.students', compact('title', 'description', 'students'));
        }
    }

    public function editProfile(Request $req, $student_id)
    {
        $title = "Edit Student ";
        $description = "Edit ";
        $student = Student::find($student_id);
        if ($student) {
            return view('pages.students.student_edit', compact('title', 'description', 'student'));
        } else {
            $students = Student::all();

            return view('pages.students.students', compact('title', 'description', 'students'));
        }
    }
    public function editCoupon(Request $req, $id)
    {
        $title = "Edit Coupon ";
        $description = "Edit ";
        $coupon = Coupon::find($id);
        if ($coupon) {
            $institutes=Institute::where('status','1')->get();
            return view('pages.coupons.edit_coupon', compact('title', 'description','institutes','coupon'));
        } else {
            $coupons = Coupon::all();

            return view('pages.coupons.coupons', compact('title', 'description'));
        }
    }

    public function allTransections()
    {
        $title = "Institutes ";
        $description = "Institutes ";
        $transections = Payment::all();
        return view('pages.payments.transections', compact('title', 'description', 'transections'));
    }

    public function addInstitute()
    {
        $title = " Add Institute";
        $description = "Institutes ";
        $countries = Country::where("status", 1)->get();
        $states = State::where("status", 1)->get();
        
       // return "Hello";
        return view('pages.institutes.add_update', compact('title', 'description', 'countries', 'states'));
    }
    public function editInstitute(Request $req, $id)
    {
        $title = "Edit Institute";
        
        $description = "Institutes";
        $institute = Institute::find($id);
        if ($institute) {
            $countries = Country::where("status", 1)->get();
            $states = State::where("status", 1)->get();
            // $cities= City::where('status',1)->get();
            // dd($cities);

            return view('pages.institutes.institute_edit', compact('title', 'description', 'countries', 'states','institute'));
        } else {
            return redirect()->back();
        }
    }


    public function allApprovals()
    {
        $title = " Add Institute";
        $description = "Institutes ";
        $approvals = Approval::where('status', '0')->get();
        return view('pages.payments.approvals', compact('title', 'description', 'approvals'));
    }

    public function allStudents()
    {
        $title = " Add Institute";
        $description = "Institutes ";
        $students = Student::all();
        return view('pages.students.students', compact('title', 'description', 'students'));
    }
    public function allCoupons()
    {
        $title = " Add Institute";
        $description = "Institutes ";
        // $students=Student::all();
        return view('pages.coupons.coupons', compact('title', 'description'));
    }

    public function commissions()
    {
        $title = " Commisions ";
        $description = "Commisions  ";
        // $students=Student::all();
        return view('pages.app_settings.commissions', compact('title', 'description'));
    }
    public function admins()
    {
        $title = " Admins ";
        $description = "Admins  ";
        // $students=Student::all();
        return view('pages.app_settings.admins', compact('title', 'description'));
    }
    public function personalInfo()
    {
        $title = "Personal Info ";
        $description = "Personal Info  ";

        return view('pages.app_settings.personal_info', compact('title', 'description'));
    }
    public function apikeys()
    {
        $title = "Personal Info ";
        $description = "Personal Info  ";

        return view('pages.app_settings.api_keys', compact('title', 'description'));
    }
    public function notify()
    {
        $title = "Personal Info ";
        $description = "Personal Info  ";


        return view('pages.notifications.notify', compact('title', 'description'));
    }

    public function email()
    {
        $title = "Personal Info ";
        $description = "Personal Info  ";


        return view('pages.notifications.email', compact('title', 'description'));
    }

    public function addCoupon()
    {
        $title = " Add Institute";
        $description = "Institutes ";
        $institutes = Institute::where('status',1)->get();
        return view('pages.coupons.add_update_coupon', compact('title', 'description', 'institutes'));
    }

   
    public function addCourse()
    {
        $title = " Add Course";
        $description = "Course ";
        $institutes = Institute::all();
        $categories = Category::all();

        return view('pages.courses.add_update_course', compact('title', 'description', 'institutes',"categories"));
    }
    public function editCourse(Request $req , $id )
    {
        $title = " Edit Course ";
        $description = "Edit Course ";

        // default lang is en 
        $lang_id=1001;

        if (Session::has('page_lang') &&  Session::get('page_lang') == "ar" ) {
            $lang_id=1002;
        } 


        $course = Course::where([["course_id",'=',$id], ['language_id','=',$lang_id]])->get();

        // dd($course);
        $course=$course->first();
        // if($course){
            $institutes= Institute::all();
            $categories= Category::all();
            return view('pages.courses.edit_course', compact('title', 'description',"course",'institutes', 'categories'));

        // }else {
        //     return redirect()->back();
        // }
    }


    public function addStudent()
    {
        $title = " Add Institute";
        $description = "Institutes ";
        $countries = Country::all();

        return view('pages.students.add_update_student', compact('title', 'description', 'countries'));
    }

    public function dashboard()
    {
        $title = " Dashboard ";
        $description = "Institutes ";

        $institute_count = Institute::count();
        $course_count = Course::count();
        $student_count = Student::count();
        // $course_count = Course::where('status', 1)->count();

        return view('pages.dashboard.overall', compact('title', 'description', 'institute_count', 'course_count', 'student_count'));
    }
    public function instituteProfile(Request $req, $id)
    {

        $institute = Institute::find($id);
        if ($institute) {
            $title = " Profile Institute";
            $description = "Institutes ";
            $languageCount= $institute->name_en!="" && $institute->name_ar!="" ? 2 : 1 ;  
            return view('pages.institutes.profile', compact('title', 'description', 'institute','languageCount'));
        } else {
            return view('error-404-cover');
        }
    }



    public function changeLanguage(Request $request, $lang)
    {


        // $locale = $request->input('locale');
        if ($lang) {
            App::setLocale($lang);
            session()->put('locale', $lang);
            return redirect()->route('all_institutes', ['lang' => $lang]);
        }
    }

    public function changePageLanguage(Request $request)
    {

        $language = $request->input('page_lang');

        // Save the selected language to the session
        session(['page_lang' => $language]);

        // Set the application locale
        app()->setLocale($language);

        // Redirect back to the same page
        return redirect()->back();
    }

    public function updateLayout(Request $req ){
        $dir = $req->input('layout_dir');
        session(['layout_dir' =>  $dir]);
        return redirect()->back();
    }

    // add menthhod foe show document
    public function showDocument($id)
    {
        $institute = Institute::find($id);

        if (!$institute) {
            return redirect()->back()->with('error', 'Institute not found.');
        }

        return view('pages.institutes.document', compact('institute'));
    }

    public function uploadDocument(Request $request, $id)
{
    $request->validate([
        'document' => 'required|mimes:pdf,jpg,jpeg,png|max:2048', // Max size: 2MB
    ]);

    $institute = Institute::find($id);

    if (!$institute) {
        return redirect()->back()->with('error', 'Institute not found.');
    }

    if ($request->hasFile('document')) {
        $file = $request->file('document');
        $path = $file->store('documents', 'public');

        // Save the document path to the database
        $institute->document = $path;
        $institute->save();
    }

    return redirect()->route('institute.document', $id)->with('success', 'Document uploaded successfully.');
}
}
