<?php

namespace App\Http\Controllers\API\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\institutes\Institute;
use App\Models\courses\Course;
use App\Models\courses\Category;
use App\Models\students\Student;
use App\Models\countries\Country;
use App\Models\states\State;
use App\Models\citites\City;
use App\Models\coupons\Coupon;
use App\Models\payments\Approval;
use App\Models\payments\Payment;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\payments\WalletMetaData;

class ApiDashboardController extends Controller
{


    public function dashboard(Request $req)
    {

        $res = [];
        $data = [];


        $startDate = $req->input('start_date');
        $endDate = $req->input('end_date');



        try {


            if (isset($startDate) && isset($endDate)) {
                $institutes = Institute::query();
                $institutes->whereDate('created_at', '>=', $startDate)
                    ->whereDate('created_at', '<=', $endDate);

                $data['institutes']['total_institute'] = $institutes->count();
                $data['institutes']['data'] = $institutes->select(['name','email','address','status'])->get();
                $institutesGroupedByStatus = $institutes->select('status', \DB::raw('count(*) as total'))
                    ->groupBy('status')
                    ->get();
                $data['institutes']['status'] = $institutesGroupedByStatus;

                // Course Data 
                $courses = Course::query();
                if ($startDate && $endDate) {
                    $courses->whereDate('created_at', '>=', $startDate)
                        ->whereDate('created_at', '<=', $endDate);
                }

                $totalCourses = $courses->count();
                $data['courses']['data'] = $courses->select('name','title','price','sale_price','course_type')->get();
                
                $data['courses']['total_courses'] = $totalCourses;
           

                // Student Data 
                $students = Student::query();
                if ($startDate && $endDate) {
                    $students->whereDate('created_at', '>=', $startDate)
                        ->whereDate('created_at', '<=', $endDate);
                }

                $totalStudents = $students->count();
                $data['students']['data'] =$students->select('name','email','mobile','address','status')->get();

                $data['students']['total_students'] = $totalStudents;
              

                // Orders  Code 
                $payments = Payment::query();
                if ($startDate && $endDate) {
                    $payments->whereDate('created_at', '>=', $startDate)
                        ->whereDate('created_at', '<=', $endDate);
                }

                $totalPayments = $payments->count();
                $data['orders']['data'] = $payments->select('id','transection_id','amount','commission_amount','status')->get();
                $data['orders']['total_orders'] = $totalPayments;



                // Orders count for graph 
                $currentYear = Carbon::now()->year;
                $counts = [];

                // Loop through months to get counts for each month
                for ($month = 1; $month <= 12; $month++) {
                    $count = DB::table('orders')
                        ->whereYear('created_at', $currentYear)
                        ->whereMonth('created_at', $month)
                        ->count();

                    array_push($counts, $count);
                }

                $data['orders']['graph_data'] = $counts;




                $recentOrders = Payment::join('institutes', 'orders.institute_id', '=', 'institutes.id')
                    ->select('orders.id', 'orders.transection_id', 'institutes.name as institute_name', 'orders.status', 'orders.amount', 'orders.created_at')
                    ->orderBy('orders.created_at', 'desc')
                    ->take(10)
                    ->get();


                $data['orders']['recent'] = $recentOrders;


                $totalSales = Payment::sum('amount');
                $data['orders']['total_sales'] = $totalSales;


                $total_commission = Payment::sum('commission_amount');
                $data['orders']['total_commission'] = $total_commission;




                $today = Carbon::today();
                $totalSalesToday = Payment::whereDate('created_at', $today)->sum('amount');
                $data['orders']['today_sale'] = $totalSalesToday;
            } else {
                $institutes = Institute::query();
                $data['institutes']['data'] = $institutes->select('name', 'email', 'address','status')->get();
               
                $data['institutes']['total_institute'] = $institutes->count();



                // Course Data 
                $courses = Course::query();

                $data['courses']['data']  = $courses->select('name','title','price','sale_price','course_type')->get();
                $totalCourses = $courses->count();

              

                $data['courses']['total_courses'] = $totalCourses;
        
      

                // Student Data 
                $students = Student::query();
                $data['students']['data']= $students->select('name','email','mobile','address','status')->get();


                $totalStudents = $students->count();
              

                $data['students']['total_students'] = $totalStudents;
             


                // Orders  Code 
                $payments = Payment::query();

                $data['orders']['data'] = $payments->select('id','transection_id','amount','commission_amount','status')->get();
                $totalPayments = $payments->count();

        


                $data['orders']['total_orders'] = $totalPayments;
    


                // Orders count for graph 

                $currentYear = Carbon::now()->year;
                $counts = [];

                // Loop through months to get counts for each month
                for ($month = 1; $month <= 12; $month++) {
                    $count = DB::table('orders')
                        ->whereYear('created_at', $currentYear)
                        ->whereMonth('created_at', $month)
                        ->count();

                    array_push($counts, $count);
                }

                $data['orders']['graph_data'] = $counts;




                $recentOrders = Payment::join('institutes', 'orders.institute_id', '=', 'institutes.id')
                    ->select('orders.id', 'orders.transection_id', 'institutes.name as institute_name', 'orders.status', 'orders.amount', 'orders.created_at')
                    ->orderBy('orders.created_at', 'desc')
                    ->take(10)
                    ->get();


                $data['orders']['recent'] = $recentOrders;


                $totalSales = Payment::sum('amount');
                $data['orders']['total_sales'] = $totalSales;


                $total_commission = Payment::sum('commission_amount');
                $data['orders']['total_commission'] = $total_commission;


                $today = Carbon::today();
                $totalSalesToday = Payment::whereDate('created_at', $today)->sum('amount');
                $data['orders']['today_sale'] = $totalSalesToday;
            }
        } catch (\Exception $e) {
            saveAppLog($e->getMessage(), basename(__FILE__));
        }




        $res['code'] = 200;
        $res['data'] = $data;
        return $res;
    }


    public function instituteDashboard(Request $req, $id)
    {



        $res = [];
        $data = [];



        try {


            // Course Data 
            $totalCourses = Course::where('institute_id', $id)->count();
            $coursesGroupedByStatus = Course::select('status', \DB::raw('count(*) as total'))
                ->where('institute_id', $id)
                ->groupBy('status')
                ->get();

            $data['courses']['total_courses'] = $totalCourses;
            $data['courses']['status'] = $coursesGroupedByStatus;




            // Orders  Code 
            $totalPayments = Payment::where('institute_id', $id)->count();

            $paymentsGroupedByStatus = Payment::select('status', \DB::raw('count(*) as total'))
                ->where('institute_id', $id)
                ->groupBy('status')
                ->get();

            $data['orders']['total_orders'] = $totalPayments;
            $data['orders']['status'] = $paymentsGroupedByStatus;


            $recentOrders = Payment::with(['institute', 'course', 'student'])->where('institute_id', $id)
                ->orderBy('orders.created_at', 'desc')
                ->take(5)
                ->get();


            $data['orders']['recent'] = $recentOrders;





            // Coupons 
            $totalCoupons = Coupon::where('institute_id', $id)->count();
            $data['coupons']['total_coupons'] = $totalCoupons;


            // wallet balance 
            $wallet_bal = WalletMetaData::where('institute_id', $id)
                ->latest('created_at')
                ->first();

            $data['wallet']['current_balance'] = isset($wallet_bal['wallet_amount']) ? $wallet_bal['wallet_amount'] : 0;




            $res['code'] = 200;
            $res['data'] = $data;
            return $res;
        } catch (\Exception $th) {
            $res['message'] = $th->getMessage();
            $res['code'] = 500;
            saveAppLog($res['message'], basename(__FILE__));
            return $res;
        }
    }


    public function studentDashboard(Request $req, $id){


        $res=[];
        $data=[];
        $stu = Student::find($id);
        if(!$stu){

            $res['message']="Student Not Found";
            $res['code']=500;
            return $res  ; 
        }



        try{

            $res['data']['my_courses']=$stu->courses()->with('institute')->get();
            $res['data']['categories']=Category::all();

            $res['message']="Student Dashboard Fetched Success.";
            $res['code']=200;
            return $res ;

        }catch(\Exception $e ){
            $res['message']=$e->getMessage();
            $res['code']=500;
            saveAppLog($res['message'], basename(__FILE__));
            return $res ;

        }
    }
}
