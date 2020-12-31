<?php

namespace App\Http\Controllers\Api\V1;

use App\Repositories\Eloquents\VehicleEloquent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VehicleController extends Controller
{
    //

    private $vehicle;

    public function __construct(VehicleEloquent $vehicleEloquent)
    {
        $this->vehicle = $vehicleEloquent;
    }

    public function getManufacturers()
    {
        return $this->vehicle->getManufacturers();
    }

    public function getCarTypes($manufacturer_id)
    {
        return $this->vehicle->getCarTypes($manufacturer_id);
    }
}
