<?php

namespace App\Http\Middleware;

use Closure;

class ServiceProviderMiddleware
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
        if (auth()->user()->type != 'service_provider')
            return response_api(false, 422, 'This event for service provider', []);
        return $next($request);
    }
}
