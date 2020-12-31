<?php

namespace App\Http\Controllers\Auth;

use App\Cart;
use App\Repositories\Eloquents\CartEloquent;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Auth;
use App\Admin;
use App\Store;
use App\StoreCategory;
use App\ServiceProviderCategory ;
use Mail;
use App\VerifyUser;
use App\Mail\VerifyMail;
use Exception;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $cart;

    public function __construct(CartEloquent $cartEloquent)
    {
        $this->cart = $cartEloquent;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:12', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {


        return User::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
        ]);
    }



    function createUser(array $attributes)
    {


        // TODO: Implement create() method.
try {
        $user = new User();
        $user->username = $attributes['username'];

        $user->password = bcrypt($attributes['password']);
        $user->mobile = $attributes['mobile'];
        $user->type = $attributes['type'];
        $confirm_code = '111111'; //$this->generateVerificationCode();
        $user->verification_code = $confirm_code;

        if (isset($attributes['email']))
            $user->email = $attributes['email'];

        if (isset($attributes['bio']))
            $user->bio = $attributes['bio'];

//        // user will approved automatically
        if ($attributes['type'] == 'client')
            $user->is_active = 1;

        if ($user->save()) {

            //  SMS confirm_code


            $user->address = $attributes['address'];
            $user->latitude = $attributes['latitude'];
            $user->longitude = $attributes['longitude'];
            $user->save();

//
            if (($attributes['type'] == 'merchant' || $attributes['type'] == 'service_provider')) {
              if(isset($attributes['city_id']))
                $user->city_id = $attributes['city_id'];


                //  if ($attributes['type'] == 'merchant')
                //  $user->has_delivery = $attributes['has_delivery'];
//                else
//                    $user->image = $this->storeImageThumb('users', $user->id, $attributes['image']);

                $user->save();

                if ($attributes['type'] == 'merchant') {
                    // add control panel account for merchant
                    $admin = new Admin();
                    $admin->name = $attributes['username'];
                    $admin->username = $attributes['username'];
                    $admin->mobile = $attributes['mobile'];

                    $admin->password = bcrypt($attributes['password']);
                    $admin->type = 'merchant';
                    $admin->user_id = $user->id;
                    $admin->status = 0;

                    if (isset($attributes['email']))
                    $admin->email = $attributes['email'];


                    $admin->save();

                    // add default store with category
                    $store = new Store();
                    $store->merchant_id = $user->id;
                    $store->name = $attributes['username'];
                    $store->save();
                    foreach ($attributes['categories'] as $category) {

                        $store_category = new StoreCategory();
                        $store_category->store_id = $store->id;
                        $store_category->merchant_id = $user->id;
                        $store_category->category_id = $category;
                        $store_category->save();
                    }

                } else {
                    foreach ($attributes['provider_categories'] as $category) {

                        $provider_category = new ServiceProviderCategory();
                        $provider_category->user_id = $user->id;
                        $provider_category->category_id = $category;
                        $provider_category->save();
                    }
                }
            }

            VerifyUser::create([
                'user_id' => $user->id,
                'token' => str_random(40),
                'email' => $attributes['email'],
            ]);

            // Mail::to($user->email)->send(new VerifyMail($user));

            if (\request()->has('device_type')) {
                $device = $this->deviceToken->where('user_id', $user->id)->where('device_id', \request()->get('device_id'))->where('type', \request()->get('device_type'))->first();

                if (!isset($device))
                    // register device token
                    $device = new DeviceToken();
                $device->user_id = $user->id;

                if (\request()->has('device_id'))
                    $device->device_id = \request()->get('device_id');
                $device->device_token = \request()->get('device_token');
                $device->type = \request()->get('device_type');
                $device->status = 'off';
                $device->save();
            }

            $user = User::find($user->id);

            if ($attributes['type'] == 'driver') {
                return response_api(true, 200, trans('app.user_created') . ',' . trans('app.waiting_admin_approved'), $user);//
            }
            return response_api(true, 200, trans('app.user_created') . ',' . trans('app.sent_email_verification'), $user);//
        }
} catch (Exception $ex) {
    // return $e;
    if(isset($ex->errorInfo)){
    $errorCode = $ex->errorInfo[1];
    if($errorCode == 1062){
          return redirect()->back()->withErrors(['عفوا , رقم الجوال مسجل مسبقا']);
    }
  }

}

        return response_api(true, 422, null, []);

    }

    protected function createWebuser(Request $request)
    {


        // dd($request->all());

        $request['phone'] = preg_replace("/^0/" , "+966" ,$request['phone']);
        $request['phone'] = preg_replace("/^966/" , "+966" ,$request['phone']);
        $request['phone'] = preg_replace("/^00966/" , "+966" ,$request['phone']);



        $att = [
            'username' => $request['name'],
            'email' => $request['email'] == null ? rand(100, 99999)."@saudidragonmart.com": $request['email'],
            'password' =>$request['password'],
            'address' => $request['address'] == null ? '': $request['address'],
            'type' => $request['typeuser'] ,
            'mobile' => $request['dialcode'].$request['phone'] ,
            'latitude' => $request['latitude'] == null ? '38.92508148993897': $request['latitude']  ,
            'longitude' => $request['longitude'] == null ? '35.63450999999998': $request['longitude']
        ];

        if( $request['cat'] != ''){
            $att['categories'] =  $request['cat'] ;
        }

        if( $request['services'] != ''){
            $att['provider_categories'] =  $request['services'] ;
        }
        if( $request['city'] != ''){
            $att['city_id'] =  $request['city'] ;
        }


        $response = $this->createUser($att);

        // dd( $response->original['status']);

        //  $response = json_decode($response);


        if($response->original['status'] == true) {
            //   dd('hello');
            $arr = ['email' => $request['email'], 'password' => $request['password']];

            $arr ['email'] = $request['email'];
            $arr ['password'] = $request['password'];


            $user = User::where('email', $request['email'])->first();

            if ($user) {
                if ($user->type=='client' && Auth::guard('web')->attempt(['email' => $request['email'], 'password' => $request['password']], $request->get('remember'))) {


                    if ($request['crt_reg'] && $user->type == 'client') {

                        $c = json_decode($request['crt_reg']);
                        if (isset($c->cart) && $c->cart != '') {
                            foreach ($c->cart as $product) {
                                // dd($product);
                                $m['product_id'] = $product->id;
                                $m['quantity'] = $product->quantity;
                                if (isset($product->extra_id[0]) && $product->extra_id[0] > 0) {
                                    $m['custom_id'] = $product->extra_id;
                                }

                                $this->cart->create($m);

                            }
                        }
                    }




                    if($request->redirect_page != '' ){
                      return redirect()->back()->with('message', 'تم تسجيلك بنجاح سيتم التواصل معك قريبا');
                        // return redirect($request->redirect_page);
                    }


                }

                if ($user->type=='service_provider' && Auth::guard('web')->attempt(['email' => $request['email'], 'password' => $request['password']], $request->get('remember'))) {


                }

                if ($user->type=='merchant' ) {
                    $user = Auth::guard('admin')->attempt(['email' => $request['email'], 'password' => $request['password']], $request->get('remember'));

                    if($user){
                        return redirect()->back()->with('message', 'تم تسجيلك بنجاح سيتم التواصل معك قريبا');
                    }

                }


            }
        }
        // dd($user->items);

        return redirect()->back()->with('message', 'تم تسجيلك بنجاح سيتم التواصل معك قريبا');
        // return redirect()->intended('/');
    }
}
