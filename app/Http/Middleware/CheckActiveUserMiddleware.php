<?php

namespace App\Http\Middleware;

use Closure;

class CheckActiveUserMiddleware
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
        if (!auth()->user()->is_active)
            return response_api(false,407,trans('app.not_approval'),[]);
        return $next($request);
    }
}
