<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\Home\FilterRequest;
use App\Repositories\Eloquents\HomeEloquent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class HomeController extends Controller
{
    //

    private $home;

    public function __construct(HomeEloquent $homeEloquent)
    {
        $this->home = $homeEloquent;
    }

    public function getUserHome(FilterRequest $request)
    {

        return $this->home->getUserHome($request->all());
    }
}
