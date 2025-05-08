<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\students\Student;
use App\Models\institutes\Institute;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()

    {
        session()->put('page_lang', 'en');
        session()->put('layout_dir', 'ltr');
        $this->middleware('guest')->except('logout');
    }


    public function socailLogin(Request $req)
    {

        $res = [];
        if (!isset($req->token)) {

            $res['code'] = 500;
            $res['message'] = " Please send the token";
            return  $res;
        }
        if (!isset($req->type)) {

            $res['code'] = 500;
            $res['message'] = " Please send the type ( student or institute ).";
            return  $res;
        }


        try {
            $googleUser = Socialite::driver('google')->stateless()->userFromToken($req->input('token'));

            if ($req->type == "student") {

                $email = $googleUser->getEmail();
                $user = Student::where('email', $googleUser->getEmail())->first();

                // User with this email alread exist just simple login him 
                if ($user) {
                    $token = $user->createToken('stu')->plainTextToken;
                    return [
                        'token' => $token,
                        "type" => 'bearer',
                        'code' => 200,
                        "data" => $user
                    ];
                } else {

                    // create the new user and then login 
                    $user = new Student;
                    $user->name = $googleUser->getName();
                    $user->email = $googleUser->getEmail();

                    $user->status = 1;
                    $user->emailVerified = 1;

                    $user->save();

                    $token = $user->createToken('stu')->plainTextToken;
                    return [
                        'token' => $token,
                        "type" => 'bearer',
                        'code' => 200,
                        "data" => $user
                    ];
                }
            } else if ($req->type == "institute") {
            }
        } catch (\Exception $e) {
            $res['code'] = 500;
            $res['message'] = $e->getMessage();
            return  $res;
        }
    }
}
