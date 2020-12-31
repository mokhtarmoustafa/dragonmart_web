<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

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
//    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    public function __construct()
    {
//        $this->middleware('guest:admin')->except('logout');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function showLoginForm()
    {
        if (auth()->viaRemember() || auth()->check()) {
            //
            return redirect()->intended(admin_vw() . '/home');
        }


        return view(admin_vw() . '.login');
    }

    public function loginAdmin(Request $request)
    {
        // Validate the form data
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required|min:6'
        ]);
        

        $request->email = preg_replace("/^0/" , "+966" ,$request->email);
        $request->email = preg_replace("/^966/" , "+966" ,$request->email);
        $request->email = preg_replace("/^00966/" , "+966" ,$request->email);
        
        // Attempt to log the user in
        if (auth()->guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // if successful, then redirect to their intended location

            if (auth()->guard('admin')->user()->type == 'admin')
                return redirect()->intended(admin_dashboard_url());
            return redirect()->intended(merchant_dashboard_url());


        }else if (auth()->guard('admin')->attempt(['mobile' => $request->email, 'password' => $request->password], $request->remember)) {
            // if successful, then redirect to their intended location

            if (auth()->guard('admin')->user()->type == 'admin')
                return redirect()->intended(admin_dashboard_url());
            return redirect()->intended(merchant_dashboard_url());


        }


        session()->flash('error', 'Check username or password.');
        // if unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public
    function logout()
    {
        auth()->guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}

