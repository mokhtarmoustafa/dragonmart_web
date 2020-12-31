<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //

        $menu = file_get_contents(base_path()."/resources/views/partials/lang/menu.json");
        $menu = json_decode($menu , true);


        View::share('AsideMenu' , $menu['menu'] );
        View::share('Version' , 'V2' );
    }
}
