<?php

namespace App\Http\Controllers\API\app_settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;

class ApiMailController extends Controller
{
    

    public function welcome_mail(){
        $res =[];
        $data=[
            "subject"=>"Welcome Email",
            "Body"=>" THis is welcome mail "
        ];


        try{

            if(Mail::to("nikhilkumarnk1142@gmail.com")->send(new WelcomeEmail($data))){
                $res['code']=200;
                $res['message']="Email Sent Successfully.";
                return $res ;
            }else{
                $res['code']=500;
                $res['message']="Server Error, while sending the email.";
                return $res ;
            }
        

        }catch( \Exception $e ){

            $res['code']=500;
            $res['message']=$e->getMessage();
            saveAppLog($res['message'],basename(__FILE__));
            return $res ; 

        }

    }
}
