<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Password;
use Auth;
class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('guest');
//    }

    protected function sendResetLinkResponse(Request $request, $response)
    {
        return response_api(true, 200, trans(trans($response)), []);
    }
    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return response_api(false, 422, trans(trans($response)), []);

    }

    //defining which password broker to use, in our case its the admins
    protected function broker()
    {
        return Password::broker('users');
    }
}
