<?php

namespace App\Http\Controllers\Api\V1;

use App\Repositories\Eloquents\CityEloquent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CityController extends Controller
{
    //

    private $city;

    public function __construct(CityEloquent $city)
    {
        $this->city = $city;
    }

    public function getCities()
    {
        return $this->city->getCities([]);
    }
}
