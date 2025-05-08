<?php

namespace App\Http\Controllers\API\location;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\countries\Country;
use App\Models\states\State;
use App\Models\citites\City;


class ApiLocationController extends Controller
{
    public function getCountries()
    {
        $res=[];
        $res['code']=200;
        $res['data']=Country::where('status',1)->get();
        return $res ; 

    }

    public function getStates( Request $req )
    {

        $res=[];
        if(!isset($req->country_id)){

            $res['code']=500;
            $res['message']="Please send the country id";
            return $res ; 
        }


        $res['code']=200;
        $res['data']=State::with('country')->where([['status','=',1],['country_id','=',$req->country_id]])->get();
        return $res ; 

    }


    public function getCities( Request $req  )
    {
        $res=[];
        if(!isset($req->state_id)){

            $res['code']=500;
            $res['message']="Please send the state id";
            return $res ; 
        }

        $res['code']=200;
        $res['data']=City::where([['status','=',1],['state_id','=',$req->state_id]])->get();
        return $res ; 

    }



}
