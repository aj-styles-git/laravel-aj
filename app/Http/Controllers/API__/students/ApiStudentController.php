<?php

namespace App\Http\Controllers\API\students;

use App\Http\Controllers\Controller;
use App\Models\students\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Auth;


class ApiStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students=Student::all();
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
    public function store(Request $request)
    {
        //
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
        $res=[];
        if($student){

            $res['message']="Student fetched successfully.";
            $res['code']=200;
            $res['data']=$student; 
            return $res ; 
        }else {
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

    public function login(Request $req)
    {

        $res = [];
        if (!isset($req->email) ||  !isset($req->email)) {

            $res['message'] = " Parameter required either email or mobile , password";
            $res['code'] = 500;
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
                $token = $user->createToken('inst')->plainTextToken;
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


}
