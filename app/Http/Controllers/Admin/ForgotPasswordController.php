<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Password;
use Mobily;
use App\User;
use App\Admin;
use App\ResetPassword;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

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

    public function __construct()
    {

        //        $this->middleware('guest:admin');
        //        config()->set("auth.defaults.passwords","admins");
    }

    public function showLinkRequestForm()
    {
        return view('auth.passwords.admin-email');
    }

    //defining which password broker to use, in our case its the admins
    protected function broker()
    {
        return Password::broker('admins');
    }

    public function reset()
    {
        $form = 'send_code';
        return view('admin.reset', compact('form'));
    }

    protected function sendVerificationCode(Request $attributes)
    {

        $attributes['email_Phone'] = preg_replace("/^0/", "+966", $attributes['email_Phone']);
        $attributes['email_Phone'] = preg_replace("/^966/", "+966", $attributes['email_Phone']);
        $attributes['email_Phone'] = preg_replace("/^00966/", "+966", $attributes['email_Phone']);

        $user = User::Where('email', $attributes['email_Phone'])->orWhere('mobile', $attributes['email_Phone'])->first();

        $reset = $this->checkCode($user);

        if (is_object($reset)) {
            $form = 'verify_code';
            $user_id = $user->id;
            return view('admin.reset', compact('form', 'user_id'));
        } else {
            return redirect('admin/reset')->with('msg', $reset);
        }
    }

    public function checkCode($user)
    {
        $reset_password = ResetPassword::where('user_id', $user->id)->orderBy('id', 'desc')->first();

        if ($reset_password !== null) {

            $totalDuration = Carbon::now()->diffInSeconds($reset_password->created_at);
            $totalDuration = gmdate('H:i:s', $totalDuration);

            if ($reset_password->state == 1) {

                if ($totalDuration > '03:00:00') {
                    $reset = $this->sendCode($user);

                    return $reset;
                } else {
                    return 'الرجاء الأنتظار ثلاث ساعات من آخر طلب إعادة تعيين كلمة المرور';
                }
            } else if ($reset_password->state == 0) {

                if ($totalDuration > '00:03:00') {
                    $reset = $this->sendCode($user);

                    return $reset;
                } else {

                    return $reset_password;
                }
            } else {
                return 'يوجد خطاء , حاول مرة أخرى من فضلك';
            }
        } else {
            $reset = $this->sendCode($user);

            return $reset;
        }
    }

    public function sendCode($user)
    {
        $confirm_code = rand(1000, 9999);

        $reset = ResetPassword::create([
            'user_id' => $user->id,
            'phone' => $user->mobile,
            'code' => $confirm_code,
            'state' => 0
        ]);

        Mobily::send($user->mobile, 'Code: ' . $confirm_code);

        return $reset;
    }

    public function verifyCode(Request $attributes)
    {

        $code = $attributes['digit1'] . $attributes['digit2'] . $attributes['digit3'] . $attributes['digit4'];
        $user_id = $attributes['user_id'];

        $reset_password = ResetPassword::where('user_id', $user_id)->orderBy('id', 'desc')->first();



        if (isset($reset_password)) {
            if ($code == $reset_password->code) {
                $form = 'reset_password';
                return view('admin.reset', compact('form', 'user_id'));
            } else {
                $msg = 'الرمز المدخل غير صحيح ، الرجاء التأكد من الرمز';
                return view('admin.verifycode', compact('reset_password', 'msg'));
            }
        } else {
            return $reset_password;
        }
    }

    public function resetpassword(Request $attributes)
    {
        $user = User::Where('id', $attributes['user_id'])->first();

        $user->password = Hash::make($attributes['password']);

        if ($user->save()) {
            $reset_password = ResetPassword::where('user_id', $attributes['user_id'])->orderBy('id', 'desc')->first();
            $admin = Admin::Where('user_id', $attributes['user_id'])->first();

            $reset_password->state = 1;
            $reset_password->save();

            if (!is_null($admin)) {
                $admin->password = Hash::make($attributes['password']);
                $admin->save();
            }
        }

        return redirect('admin/login');
    }
}
