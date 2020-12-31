<?php

namespace App\Http\Controllers;

use App\City;
use App\Setting;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $currentUser;
    public $cities;
    public $settings;
    public $url, $vw;

    public function __construct()
    {
        $this->currentUser = auth()->guard('admin')->user();
        $this->cities = City::all();
        $this->settings = Setting::all();


        view()->share(['currentUser' => $this->currentUser, 'cities' => $this->cities ,'settings' => $this->settings]);
    }
}
