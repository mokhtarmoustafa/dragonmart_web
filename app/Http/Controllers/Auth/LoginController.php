<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Cart;
use App\Repositories\Eloquents\CartEloquent;
use Illuminate\Http\Request;
use Auth;
use Session;
use App\User;
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */




    private $cart;

    public function __construct(CartEloquent $cartEloquent)
    {
        $this->middleware('guest')->except('logout');
        $this->cart = $cartEloquent;
    }


    public function logout(Request $request)
    {
        //dd('mmm');
        $this->guard('web')->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/');
    }





    public function webLogin(Request $request)
    {





        $this->validate($request, [
            'email'   => 'required',
            'password' => 'required|min:6'
        ]);
        
        $request->email = $request['email'] = substr($request->email, 0, 3) == "966" ? "+".$request->email : $request->email;
        
        $user = User::where('email' , $request['email'])->orWhere('mobile' , $request['email'])->first();

        if($user) {


            /////
            if ($user->type == 'client' | $user->type == 'service_provider') {
                
                if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember')) || Auth::guard('web')->attempt(['mobile' => $request->email, 'password' => $request->password], $request->get('remember'))) {

                    $user = Auth::user();
                    //
                    if ($request['crt_login'] && $user->type == 'client') {

                        $c = json_decode($request['crt_login']);
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


                    //dd(url(site_url().$request->redirect_page));

                    if($request->redirect_page != '' ){
                        return redirect($request->redirect_page);
                    }


                    $referr = $request->cookie('referrer');
                    if ($referr) {
                        return redirect(url($referr));
                    }






                    return redirect(url(site_url() . '/home'));
                }

            }

            if ($user->type=='merchant' ) {
                $user = Auth::guard('admin')->attempt(['email' => $request['email'], 'password' => $request['password']], $request->get('remember'));

                if($user){
                    return redirect()->intended(merchant_dashboard_url());
                }

            }
        }


        Session::flash('message', __('auth.failed'));
        Session::flash('alert-class', 'alert-danger');
        return back()->withInput($request->only('email', 'remember'));
    }
}
