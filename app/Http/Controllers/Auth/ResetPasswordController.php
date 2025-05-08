<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\institutes\Institute;
use App\Models\PasswordReset;
use App\Models\students\Student;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;


class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;


    public function forgetPassword(Request $req ){

        $res=[];

        if(!isset($req->type)){

            $res['message']=" Please send the type parameter.";
            $res['code']=500;
            return $res;
        }

        if(!isset($req->email)){

            $res['message']=" Please send the email parameter.";
            $res['code']=500;
            return $res;
        }


        try{


            $user=null;
            if($req->type=="institute"){

                $user= Institute::where('email',$req->email)->get();
            }else if ($req->type=="student"){
                $user= Student::where('email',$req->email)->get();

            }else{
                $res['message']="type is not valid.";
                $res['code']=500;
                return $res ;
            }

            if(count($user)==1){

                $token = Str::random(40);
                $domain= URL::to('/');
                $url =  $domain.'/forget-password?token='.$token ;
                $create_at = Carbon::now()->format('Y-m-d H:i');

                PasswordReset::updateOrCreate([
                    "email"=>$req->email 
                ],[
                    "email"=>$req->email ,
                    "token"=>$token,
                    "type"=>$req->type,
                    "created_at"=>$create_at
                ]);

           
                $res['code']=200;
                $res['message']="Please check your email ";
                return $res ;

             
            }else{
                $res['message']="Email Not Found or multiple emails found with the same email address.";
                $res['code']=500;
                return $res ;
            }

        }catch(\Exception $e ){
            $res['message']=$e->getMessage();
            $res['code']=500;
            saveAppLog($res['message'],basename(__FILE__));
            return $res ; 

        }
       
    }
}
