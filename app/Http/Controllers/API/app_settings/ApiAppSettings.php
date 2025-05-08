<?php

namespace App\Http\Controllers\API\app_settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\app_settings\Reason;
use App\Models\app_settings\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ApiAppSettings extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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

    public function getReasons(Request $req)
    {
        $res = [];
        if (!isset($req->type) || !isset($req->lang)  || !isset($req->page_id)) {

            $res['code'] = 500;
            $res['message'] = " Missing params Type and Lang and Page ID.";
            return $res;
        }



        $data = Reason::where([['reason_type', '=', $req->type], ['page_id', '=', $req->page_id]])->get();

        $res['data'] = $data;
        $res['code'] = 200;
        return $res;
    }


    public function updateSettings(Request $req)
    {


        $res = [];

        try {

            $items = $req->all();

            foreach ($items as $key => $item) {

                $dbRecord = Setting::where([['label', '=', $key]])->get();
                $record = $dbRecord->first();
                $record->value = $item;
                $record->save();
            }

            $res['message'] = "Settings Updated Successfully.";
            $res['code'] = 200;
            return $res;
        } catch (\Exception $e) {

            $mes = $e->getMessage();
            $res['code'] = 500;
            $res['message'] = $mes;
            saveAppLog($mes);
            return $res;
        }
    }


    public function getSettings(Request $req)
    {


        $res = [];

        try {

            $items = $req->all();

            $arr = [];
            foreach ($items as $key => $item) {

                $dbRecord = Setting::where([['label', '=', $key]])->get();
                $record = $dbRecord->first();
                array_push($arr, $record);
            }

            $res['message'] = "Settings Fetched Successfully.";
            $res['code'] = 200;
            $res['data'] = $arr;
            return $res;
        } catch (\Exception $e) {

            $mes = $e->getMessage();
            $res['code'] = 500;
            $res['message'] = $mes;
            saveAppLog($mes);
            return $res;
        }
    }

    public function createAdmin(Request $req)
    {

        $res = [];
        if (!isset($req->admin_level) || !isset($req->name)  || !isset($req->password) || !isset($req->email)) {

            $res['code'] = 500;
            $res['message'] = " Missing params password and admin_level and name, email ";
            return $res;
        }


        // check email exist of not 
        $check = User::where('email', $req->email);
        if ($check->count() > 0) {
            $res['code'] = 500;
            $res['message'] = "Email Already Exists.";
            return $res;
        }


        $admin = new User;
        try {
            $admin->name = $req->name;
            $admin->password  = Hash::make($req->password);
            $admin->admin_level = $req->admin_level;
            $admin->email = $req->email;
            $admin->save();
            $res['code'] = 200;
            $res['message'] = " Admin Created Successfully.";
            return $res;
        } catch (\Exception $e) {
            $mes = $e->getMessage();
            saveAppLog($mes);
            $res['code'] = 500;
            $res['message'] = $mes;
            return $res;
        }
    }
    public function updateAdmin(Request $req, $id )
    {

        $res = [];
        

        $admin = User::find($id);
        try {

            if ($req->has('password')) {
                $admin->password = Hash::make($req->password);
            }
            $admin->update($req->all());

            $res['code'] = 200;
            $res['message'] = " Admin Updated Successfully.";
            return $res;
        } catch (\Exception $e) {
            $mes = $e->getMessage();
            saveAppLog($mes);
            $res['code'] = 500;
            $res['message'] = $mes;
            return $res;
        }
    }

    
    public function getAdmins( ){
        

        $res['code'] = 200;
        $res['message'] = " Admin fetched Successfully.";
        $res['data']=User::all();
        return $res;

    }
    public function getAdmin(Request $req, $id  ){
        

        $res['data']=User::find($id);
        $res['code'] = 200;
        $res['message'] = " Admin fetched Successfully.";
        return $res;

    }
}
