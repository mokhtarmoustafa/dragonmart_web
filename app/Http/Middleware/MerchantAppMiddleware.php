<?php

namespace App\Http\Middleware;

use Closure;

class MerchantAppMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->type != 'merchant')
            return response_api(false, 422, 'This event for merchant', []);
        return $next($request);
    }
}
