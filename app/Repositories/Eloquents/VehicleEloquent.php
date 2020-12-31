<?php
/**
 * Created by PhpStorm.
 * UserRequest: mohammedsobhei
 * Date: 5/2/18
 * Time: 11:43 PM
 */

namespace App\Repositories\Eloquents;

use App\CarType;
use App\Manufacturer;
use App\Product;
use App\Repositories\Interfaces\Repository;
use App\Repositories\Uploader;
use App\Vehicle;

class VehicleEloquent implements Repository
{

    private $model, $carType;

    public function __construct(Manufacturer $model, CarType $carType)
    {
        $this->model = $model;
        $this->carType = $carType;
    }

    // for cpanel
//    function anyData()
//    {
//        $cities = $this->model->orderByDesc('created_at');
//        return datatables()->of($cities)
//            ->filter(function ($query) {
//
//                if (request()->filled('search')) {
//                    $search = request()->get('search');
//                    $query->where('name', 'LIKE', '%' . $search['value'] . '%');
//                }
//
//            })
//            ->editColumn('icon', function ($manufacture) {
//                return '<img src="' . $manufacture->icon32 . '" class="img-circle">';
//            })
//            ->addColumn('action', function ($manufacture) {
//                return '<a href="' . url(admin_constant_url() . '/manufacture/' . $manufacture->id) . '" class="btn btn-circle btn-icon-only purple edit" title="Edit">
//                                        <i class="fa fa-edit"></i>
//                                    </a>
//                                    <a href="' . url(admin_constant_url() . '/manufacture/' . $manufacture->id) . '" class="btn btn-circle btn-icon-only red delete" title="Delete">
//                                        <i class="fa fa-times"></i>
//                                    </a>';
//            })->addIndexColumn()
//            ->rawColumns(['icon', 'action'])->toJson();
//    }

    function getAll(array $attributes)
    {
        // TODO: Implement getAll() method.
    }

    function getById($id)
    {
        $manufacture = $this->model->find($id);

        if (isset($manufacture)) {
            return response_api(true, 200, null, $manufacture);
        }
        return response_api(false, 422);
    }

    public function getManufacturers()
    {
        $manufacturers = $this->model->all();
        return response_api(true, 200, null, $manufacturers);
    }

    public function getCarTypes($manufacture_id)
    {
        $car_types = $this->carType->where('manufacturer_id', $manufacture_id)->get();
        return response_api(true, 200, null, $car_types);
    }

    function create(array $attributes)
    {

    }

    function update(array $attributes, $id = null)
    {
        // TODO: Implement create() method.

    }

    function delete($id)
    {
        // TODO: Implement delete() method.
//        $manufacture = $this->model->find($id);
//        if (isset($manufacture) && $manufacture->delete()) {
//            return response_api(true, 200);
//        }
//        return response_api(false, 422);

    }


}