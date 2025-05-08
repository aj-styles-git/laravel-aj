<?php

namespace App\Http\Controllers\API\app_settings;

use App\Http\Controllers\Controller;
use App\Models\institutes\Institute;
use App\Models\students\Student;
use Illuminate\Http\Request;

class ApiPushNotificationController extends Controller
{
    public  function sendPushNotifications(Request $req)
    {


        $res = [];
        $en = false;
        $ar = false;
        if (!isset($req->type)) {
            $res['code'] = 500;
            $res['message'] = "Please send the type.";
            return $res;
        }

        if (isset($req->message_en) &&  isset($req->title_en) && $req->title_en != ""  &&  $req->message_en) {
            $en = true;
        }
        if (isset($req->message_ar) &&  isset($req->title_ar) && $req->title_ar != ""  &&  $req->message_ar) {
            $ar = true;
        }

        if ($ar == false  && $en == false) {
            $res['code'] = 500;
            $res['message'] = "Please send the at least message or title in one language.";
            return $res;
        }


        $deviceTokensEn = [];
        $deviceTokensAr = [];

        if ($req->type == 1) {
            $institutes = Institute::all();
            foreach ($institutes as $institute) {
                if ($institute->device_token != "" && $institute->device_token != null) {

                    if ($institute->default_lang == "en") {
                        array_push($deviceTokensEn, $institute->device_token);
                        $institute->push_notificaions()->create([
                            "message" => $req->message_en,
                            "title" => $req->title_en
                        ]);
                    } else if ($institute->default_lang == "ar") {
                        array_push($deviceTokensAr, $institute->device_token);
                        $institute->push_notificaions()->create([
                            "message" => $req->message_ar,
                            "title" => $req->title_ar
                        ]);
                    }
                }
            }
        } else if ($req->type == 2) {
            $students = Student::all();
            foreach ($students as $student) {
                if ($student->device_token != "" && $student->device_token != null) {
                    if ($student->default_lang == "en") {
                        array_push($deviceTokensEn, $student->device_token);
                        $student->push_notificaions()->create([
                            "message" => $req->message_en,
                            "title" => $req->title_en
                        ]);
                    } else if ($student->default_lang == "ar") {
                        array_push($deviceTokensAr, $student->device_token);
                        $student->push_notificaions()->create([
                            "message" => $req->message_ar,
                            "title" => $req->title_ar
                        ]);
                    }
                }
            }
        } else if ($req->type == 3) {

            $institutes = Institute::all();
            $students = Student::all();
            foreach ($institutes as $institute) {
                if ($institute->device_token != "" && $institute->device_token != null) {


                    if ($institute->default_lang == "en") {
                        array_push($deviceTokensEn, $institute->device_token);
                        $institute->push_notificaions()->create([
                            "message" => $req->message_en,
                            "title" => $req->title_en
                        ]);
                    } else if ($institute->default_lang == "ar") {
                        array_push($deviceTokensAr, $institute->device_token);
                        $institute->push_notificaions()->create([
                            "message" => $req->message_ar,
                            "title" => $req->title_ar
                        ]);
                    }
                }
            }

            foreach ($students as $student) {
                if ($student->device_token != "" && $student->device_token != null) {

                    if ($student->default_lang == "en") {
                        array_push($deviceTokensEn, $student->device_token);
                        $student->push_notificaions()->create([
                            "message" => $req->message_en,
                            "title" => $req->title_en
                        ]);
                    } else if ($student->default_lang == "ar") {
                        array_push($deviceTokensAr, $student->device_token);
                        $student->push_notificaions()->create([
                            "message" => $req->message_ar,
                            "title" => $req->title_ar
                        ]);
                    }
                }
            }
        } else {
            $res['code'] = 500;
            $res['message'] = "Invalid type.";
            return $res;
        }


        if ($en) {

            $curlRes = sendPushNotifications($deviceTokensEn, $req->title_en, $req->message_en);
        }
        if ($ar) {
            $curlRes = sendPushNotifications($deviceTokensAr, $req->title_ar, $req->message_ar);
        }



        $res['code'] = 200;
        $res['message'] = "Push Notifications Sent Successfully.";
        $res['data'] = $curlRes;
        return $res;
    }

    public function getPushNotificaions(Request $req)
    {

        $res = [];
        if (!isset($req->type)) {
            $res['code'] = 500;
            $res['message'] = "Please send the type either student or institute.";
            return $res;
        }

        if (!isset($req->id)) {
            $res['code'] = 500;
            $res['message'] = "Please send the student id or institute id.";
            return $res;
        }

        $user=null ;
        if ($req->type == "student") {
            $user=Student::find($req->id);
        } else if ($req->type == "institute") {
            $user=Institute::find($req->id);

        } else {
            $res['code'] = 500;
            $res['message'] = "Please send the valid type.";
            return $res;
        }


        if($user){
            $data= $user->push_notificaions;
            $res['status']=200;
            $res['data']=$data ;
            return $res ;

        }else{
            $res['code'] = 500;
            $res['message'] = "Opps!, The data you sent did not match with our database.";
            return $res;
        }
    }
}
