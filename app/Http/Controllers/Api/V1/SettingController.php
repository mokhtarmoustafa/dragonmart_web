<?php

namespace App\Http\Controllers\Api\V1;

use App\Repositories\Eloquents\SettingEloquent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    //

    private $setting;

    public function __construct(SettingEloquent $settingEloquent)
    {
        $this->setting = $settingEloquent;
    }

    public function getSetting($key)
    {
        return $this->setting->getByKey($key);
    }
}
