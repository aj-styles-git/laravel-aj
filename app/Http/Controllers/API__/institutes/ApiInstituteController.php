<?php

namespace App\Http\Controllers\API\institutes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\institutes\Institute;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use Auth;

class ApiInstituteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return Institute::all();
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
                "longitude" => "required",
                "latitude" => "required",
                "city_id" => "required",
                "country_id" => "required",
            );
        } else {
            $rules = array(
                "name" => "required",
                "lang" => "required",
                "address" => "required",
                "email" => "required|unique:institutes,email",
                "password" => "required",
                "mobile" => "required|unique:institutes,mobile",
                "state_id" => "required",
                "longitude" => "required",
                "latitude" => "required",
                "city_id" => "required",
                "country_id" => "required",
                "document" => "required|file",
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

            $institute = new Institute;
            $institute->name = $req->name;

            if ($req->lang == 'ar') {
                $institute->name_ar = $req->name;
            } else if ($req->lang == 'en') {
                $institute->name_en = $req->name;
            }

            $institute->mobile = $req->mobile;
            $institute->contact_person_mobile = $req->contact_person_mobile;
            $institute->email = $req->email;



            // Check For Logo 
            if ($req->hasFile('logo')) {
                $logo_path = $req->file('logo')->store('institutes');
                $institute->logo = $logo_path;
            }

            // Check For Document  
            if ($req->hasFile('document')) {
                $document_path = $req->file('document')->store('institutes');
                $institute->document = $document_path;
            }

            // Check For Cover  
            if ($req->hasFile('cover')) {
                $cover_path = $req->file('cover')->store('institutes');
                $institute->cover = $cover_path;
            }

            if ($req->lang == 'ar') {
                $institute->des_ar = $req->des;
                $institute->lang = json_encode(['ar' => true]);
            } else if ($req->lang == 'en') {
                $institute->des_eng = $req->des;
                $institute->lang = json_encode(['en' => true]);
            }
            $institute->address = $req->address;
            $institute->longitude = $req->longitude;
            $institute->latitude = $req->latitude;
            $institute->city_id = $req->city_id;
            $institute->state_id = $req->state_id;
            $institute->country_id = $req->country_id;

            if (isset($req->adminRequest)) {
                $institute->mobileVerified = 1;
                $institute->emailVerified = 1;
                $institute->createdBy = Auth::user()->id;
            } else {
                $institute->mobileVerified = $req->mobileVerified;
                $institute->emailVerified = $req->emailVerified;
                $institute->createdBy = $req->createdBy;
            }


            $institute->password = Hash::make($req->password);

            $institute->status = 0;
            if ($institute->save()) {
                return [
                    'code' => 200,
                    "message" => "User Added Successfully.",
                    "data" =>  $institute
                ];
            } else {
                return [
                    'code' => 500,
                    "message" => "Database Error, While inserting the student.",
                ];
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
        $institute = Institute::find($id);
        if ($institute) {

            $res['message'] = " Institute fetched Successfully.";
            $res['data'] = $institute;
            $res['200'] = 200;
            return $res;
        } else {
            $res['message'] = " Institute Not Found.";
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
        $institute = Institute::find($id);

        $res = [];
        if ($institute) {

            if (isset($req->adminRequest)) {
                $rules = array(
                    "name" => "required",
                    "lang" => "required",
                    "address" => "required",
                    "email" => "required|unique:institutes,email",
                    "password" => "required",
                    "mobile" => "required|unique:institutes,mobile",
                    "state_id" => "required",
                    "longitude" => "required",
                    "latitude" => "required",
                    "city_id" => "required",
                    "country_id" => "required",
                );
            } else {
                $rules = array(
                    "name" => "required",
                    "address" => "required",
                    "email" => "required|unique:institutes,email",
                    "password" => "required",
                    "mobile" => "required|unique:institutes,mobile",
                    "state_id" => "required",
                    "longitude" => "required",
                    "latitude" => "required",
                    "city_id" => "required",
                    "country_id" => "required",
                    "document" => "required|file",
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

        
                $institute->name = $req->name;
    
                if ($req->lang == 'ar') {
                    $institute->name_ar = $req->name;
                } else if ($req->lang == 'en') {
                    $institute->name_en = $req->name;
                }
    
                $institute->mobile = $req->mobile;
                $institute->contact_person_mobile = $req->contact_person_mobile;
                $institute->email = $req->email;
    
    
    
                // Check For Logo 
                if ($req->hasFile('logo')) {
                    $logo_path = $req->file('logo')->store('institutes');
                    $institute->logo = $logo_path;
                }
    
                // Check For Document  
                if ($req->hasFile('document')) {
                    $document_path = $req->file('document')->store('institutes');
                    $institute->document = $document_path;
                }
    
                // Check For Cover  
                if ($req->hasFile('cover')) {
                    $cover_path = $req->file('cover')->store('institutes');
                    $institute->cover = $cover_path;
                }
    
                if ($req->lang == 'ar') {
                    $institute->des_ar = $req->des;
                    $institute->lang = json_encode(['ar' => true]);
                } else if ($req->lang == 'en') {
                    $institute->des_eng = $req->des;
                    $institute->lang = json_encode(['en' => true]);
                }
                $institute->address = $req->address;
                $institute->longitude = $req->longitude;
                $institute->latitude = $req->latitude;
                $institute->city_id = $req->city_id;
                $institute->state_id = $req->state_id;
                $institute->country_id = $req->country_id;
    
                if (isset($req->adminRequest)) {
                    $institute->mobileVerified = 1;
                    $institute->emailVerified = 1;
                    $institute->createdBy = Auth::user()->id;
                } else {
                    $institute->mobileVerified = $req->mobileVerified;
                    $institute->emailVerified = $req->emailVerified;
                    $institute->createdBy = $req->createdBy;
                }
    
    
                $institute->password = Hash::make($req->password);
    
                $institute->status = 0;
                if ($institute->save()) {
                    return [
                        'code' => 200,
                        "message" => "User Added Successfully.",
                        "data" =>  $institute
                    ];
                } else {
                    return [
                        'code' => 500,
                        "message" => "Database Error, While inserting the student.",
                    ];
                }
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
        $res = [];
        $institute = Institute::find($id);
        if ($institute) {
            $institute->delete();

            $res['message'] = " Institute Deleted Successfully.";
            $res['200'] = 200;
            return $res;
        } else {
            $res['message'] = " Institute Not Found.";
            $res['code'] = 500;
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


            if (Auth::guard('institute')->attempt([
                "mobile" => $req->mobile,
                "password" => $req->password
            ])) {
                $user = Auth::guard('institute')->user();
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
