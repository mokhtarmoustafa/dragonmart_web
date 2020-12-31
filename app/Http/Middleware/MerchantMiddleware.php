<?php

namespace App\Http\Middleware;

use Closure;

class MerchantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!auth()->guard('admin')->check() || auth()->guard('admin')->user()->type != 'merchant' ) {//|| !auth()->guard('admin')->user()->status

//            dd(1);
            if (auth()->guard('admin')->check() && !auth()->guard('admin')->user()->status) {
                auth()->guard('admin')->logout();
                session()->flash('error', 'User deactivate by admin');
            }

            if (!auth()->guard('admin')->check()) {
                return redirect('admin/login');
            }
            return redirect()->back();
        }
        view()->share(['currentUser' => auth()->guard('admin')->user()]);

        return $next($request);
    }
}
