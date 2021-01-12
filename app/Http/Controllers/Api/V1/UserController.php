<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\User\ConfirmCodeRequest;
use App\Http\Requests\Api\User\CreateUserRequest;
use App\Http\Requests\Api\User\ForgetRequest;
use App\Http\Requests\Api\User\LoginRequest;
use App\Http\Requests\Api\User\ResendConfirmCodeRequest;
use App\Http\Requests\Api\User\ResetPasswordDeepLinkRequest;
use App\Http\Requests\Api\User\SendVerificationCodeRequest;
use App\Http\Requests\Api\User\UpdateUserRequest;
use App\Repositories\Eloquents\UserEloquent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\User;
use App\Admin;
use App\ResetPassword;
use Carbon\Carbon;
use Mobily;
use Illuminate\Support\Facades\Hash;
use App\ProductCategory;
use App\Product;

class UserController extends Controller
{
    //
    private $user;

    public function __construct(UserEloquent $userEloquent)
    {
        $this->user = $userEloquent;
    }

    // generate access token
    public function access_token(LoginRequest $request)
    {
        return $this->user->access_token();
    }

    // generate refresh token
    public function refresh_token()
    {
        return $this->user->refresh_token();
    }

    // Sign up
    public function postUser(CreateUserRequest $request)
    {
        // return phpinfo();
        return $this->user->create($request->all());
    }

    // User update
    public function putUser(UpdateUserRequest $request)
    {
        return $this->user->update($request->all());
    }

    // get User by id
    public function getProfile($id = null)
    {
        // $user = User::where('id', $id)->first(['id', 'username', 'email', 'mobile', 'image', 'type', 'is_driver_available', 'lang', 'city_id']);
        // return $user;
        return $this->user->getById($id);
    }

    // get merchants list
    public function getMerchants(Request $request)
    {
        return $this->user->getMerchants($request->all());
    }
    // get merchants CAT
    public function getMerchantCat(Request $request)
    {
        return $this->user->getMerchantCat($request->all());
    }

    // get service providers list
    public function getServiceProviders(Request $request)
    {
        return $this->user->getServiceProviders($request->all());
    }

    // get merchants list
    public function getMerchantsList()
    {
        return $this->user->getMerchantsList();
    }

    // get drivers list
    public function getDriversList($is_my_drivers = true)
    {
        return $this->user->getDriversList($is_my_drivers);
    }

    // post confirm code
    public function postConfirmCode(ConfirmCodeRequest $request)
    {
        return $this->user->confirm_code($request->all());
    }

    // resent confirm code
    public function resendConfirmCode(ResendConfirmCodeRequest $request)
    {
        return $this->user->resend_confirm_code($request->all());
    }

    //forget password "We have to establish an email account from mail server"
    public function forget(ForgetRequest $request)
    {
        return $this->user->forget($request->all());
    }

    //reset password using deep link
    public function resetPasswordDeepLink(ResetPasswordDeepLinkRequest $request, $id)
    {
        if ($request->has('client_id') && $request->get('client_id') == getClientId() && $request->has('client_secret') && $request->get('client_secret') == getClientSecret())
            return $this->user->resetPasswordDeepLink($request->all(), $id);
        return response_api(false, 422, null, []);
    }

    // logout user
    public function logout(Request $request)
    {
        return $this->user->logout();
    }

    public function sendVerificationCode(SendVerificationCodeRequest $request)
    {
        return $this->user->send_confirm_code($request->all());
    }

    public function checkChangeMobile(Request $request)
    {
        return $this->user->check_change_mobile($request->all());
    }


    public function NewAddress(Request $request)
    {
        return $this->user->NewAddress($request->all());
    }

    public function sendFPVerificationCode(Request $attributes)
    {

        $attributes['email_Phone'] = preg_replace("/^0/", "+966", $attributes['email_Phone']);
        $attributes['email_Phone'] = preg_replace("/^966/", "+966", $attributes['email_Phone']);
        $attributes['email_Phone'] = preg_replace("/^00966/", "+966", $attributes['email_Phone']);

        $user = User::Where('email', $attributes['email_Phone'])->orWhere('mobile', $attributes['email_Phone'])->first();

        $reset = $this->checkCode($user);
        if (is_object($reset)) {
            $user_id = $user->id;
            return response_api(true, 200, "Send Verification Code success", ["user_id" => $user_id]);
        } else {
            return response_api(false, 422, $reset, []);
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

        $code = $attributes['pin'];
        $user_id = $attributes['user_id'];

        $reset_password = ResetPassword::where('user_id', $user_id)->orderBy('id', 'desc')->first();

        if (isset($reset_password)) {
            if ($code == $reset_password->code) {
                return response_api(true, 200, "Reset Password", ["user_id" => $user_id]);
            } else {
                $msg = 'الرمز المدخل غير صحيح ، الرجاء التأكد من الرمز';
                return response_api(false, 422, $msg, []);
            }
        } else {
            return response_api(false, 422, "Error",  []);
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


            return response_api(true, 200, "Reset Password success", []);
        }

        return response_api(false, 422, "Reset Password failed", []);
    }


    public function getCategories($id)
    {
        $cats =  ProductCategory::where('store_id',  $id)
            ->whereNull('deleted_at')
            ->select(['id', 'name', 'name_ar'])
            ->orderByRaw('-order_by DESC')
            ->orderByDesc('created_at')->get();

        return $cats;
    }

    public function getProductsByCatId($catId)
    {
        $products =  Product::where('category_id',  $catId)
            ->select(['id', 'name', 'name_en', 'price'])
            ->orderByDesc('created_at')->paginate(15);

        return $products;
    }
}
