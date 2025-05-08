<?php

use App\Models\institutes\Institute;
use App\Models\User;
use App\Models\AppLog;
use App\Models\Language;
use App\Models\settings\Setting;


// Save the errors occuring in the app to the database 
function saveAppLog($message = "", $fileName = "")
{
    $app_log = new AppLog;
    $app_log->message = $message;
    $app_log->file = $fileName;
    $app_log->save();
}


// send simple notification in the app to one user 
function sendNotification($type, $message, $recipientId)
{
    $recipient = null;
    $res = [];

    // Determine the recipient based on the type
    switch ($type) {
        case 'user':
            $recipient = User::find($recipientId);
            break;
        case 'institute':
            $recipient = Institute::find($recipientId);
            break;
            // Add more cases for other recipient types if needed
    }


    if ($recipient) {
        try {
            $notification = $recipient->notifications()->create([
                'message' => $message,
            ]);


            $res['code'] = 200;
            $res['message'] = "Notifications send successfully.";
            $res['data'] = $notification;
            return $res;
        } catch (\Exception $e) {


            $res['code'] = 500;
            $res['message'] = "Server Error " . $e->getMessage();
            return $res;
        }
    }
}



// send simple notification in the app to all the db users 
function sendNotificationAll($type, $name, $message, $redirect_url = "", $logo = "institutes/QCcqQlsjyNgJmAYEbguNuuaZ9aAD36siWZa1PpVE.png")
{
    $recipients = null;
    $res = [];



    // Determine the recipients based on the type
    switch ($type) {
        case 'user':
            $recipients = User::all();
            break;
        case 'institute':
            $recipients = Institute::all();
            break;
            // Add more cases for other recipients types if needed
    }


    if ($recipients) {
        try {
            foreach ($recipients as $recipient) {
                $notification = $recipient->notifications()->create([
                    'message' => $message,
                    'title' => $name,
                    'logo' => 'institutes/QCcqQlsjyNgJmAYEbguNuuaZ9aAD36siWZa1PpVE.png',
                ]);


                $notificationId = $notification->id;
                $redirectUrlWithId = $redirect_url . '?ni=' . $notificationId . '&is_read=true&src=notification';
                $notification->update(['redirect_url' => $redirectUrlWithId]);
            }


            $res['code'] = 200;
            $res['message'] = "Notifications send successfully.";
            $res['data'] = $recipients;
            return $res;
        } catch (\Exception $e) {

            $fileName = basename(__FILE__);
            $message = "Server Error " . $e->getMessage();
            saveAppLog($message, $fileName);
            $res['code'] = 500;
            $res['message'] = $message;
            return $res;
        }
    }
}


// Send the push notifications  
function sendPushNotifications($deviceTokens,$title="" , $message="")
{

 
    $res=[];
    $msg = urlencode($message);
    $data = array(
        'title' => $title,
        'sound' => "default",
        'msg' => $message,
        'body' => $message,
    );

    if(count($deviceTokens)==1){
        $fields = array(
            'to' => $deviceTokens[0],
            'notification' => $data,
            "priority" => "high",
        );
    }else{
        $fields = array(
            'registration_ids' => $deviceTokens,
            'notification' => $data,
            "priority" => "high",
        );
    }
  


    $headers = array(
        'Authorization: key=AAAA1SwmMd0:APA91bEVd_dsy0kE5uGW41MTDaU0pzG0oYfHIP_ZEOLRqu_4TX-ikrF2Bd-1gAecwS2DXNRhzj52fd5FdUC4V_B-0Bw5GSZrvnDCHXYJ-0pbblrfczYYPNvb0t4BLHbMhfmTaVTwWZSw',
        'Content-Type: application/json'
    );


    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);
    curl_close($ch);
    
    $result=json_decode($result);
    $res['device']=$deviceTokens;
    $res['fcm_res']=$result;

    return $res ; 


}


function getSetting($name){

    if($name==""){
        return "Please Provide name";
    }

    $setting=Setting::where('label',$name)->first();
    if(!$setting){
        return "Setting Does Not Exists.";

    }

    return $setting['value'];


}

function getLanguageId($code){

    if($code==""){
        return false;
    }

    $language=Language::where('code',$code)->first();
    if(!$language){
        return false;

    }

    return $language['id'];


}

function failedResponse($message=""){
    
    return [
        "code"=>500,
        "message"=>$message
    ];
}