<?php

namespace App\Http\Middleware;

use App\Permission;
use Closure;

use App;

class LocalizationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (session()->has('lang')) {
            App::setLocale(session()->get('lang'));
        } else { // This is optional as Laravel will automatically set the fallback language if there is none specified
            App::setLocale(config()->get('app.fallback_locale'));
        }

//        $permissions = App\Permission::all();
        if ($request->segment(1) != 'api' && auth()->guard('admin')->check()) {
            $role = getAuth()->roles->first();

            $permissions_sidebar = null;
            if (isset($role->perms)) {
                $permissions_sidebar = $role->perms->where('parent_id', null)->where('is_sidebar', 1)->pluck('id');
                $perms_child = $role->perms->where('parent_id', '<>', null)->where('is_sidebar', 1)->pluck('id');
                $permissions_sidebar = Permission::with(['children' => function ($q) use ($perms_child) {
                    $q->where('is_sidebar', 1)->whereIn('id', $perms_child);
                }])->whereIn('id', $permissions_sidebar)->orderBy('sort_num', 'ASC')->get();
            }

            view()->share(['permissions_sidebar' => $permissions_sidebar]);
        }
        return $next($request);
    }
}
