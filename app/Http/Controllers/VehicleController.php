<?php

namespace App\Http\Controllers;

use App\Repositories\Eloquents\VehicleEloquent;

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
