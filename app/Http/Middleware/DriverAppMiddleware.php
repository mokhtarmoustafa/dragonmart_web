<?php

namespace App\Http\Middleware;

use Closure;

class DriverAppMiddleware
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
        if (auth()->user()->type != 'driver')
            return response_api(false, 422, 'This event for driver', []);
        return $next($request);
    }
}
