<?php
/**
 * Created by PhpStorm.
 * UserRequest: mohammedsobhei
 * Date: 5/2/18
 * Time: 11:43 PM
 */

namespace App\Repositories\Eloquents;

use App\City;
use App\Product;
use App\Repositories\Interfaces\Repository;
use App\Repositories\Uploader;

class CityEloquent extends Uploader implements Repository
{

    private $model;

    public function __construct(City $model)
    {
        $this->model = $model;
    }

    // for cpanel
    function anyData()
    {
        $cities = $this->model->orderByDesc('created_at');
        return datatables()->of($cities)
            ->filter(function ($query) {

                if (request()->filled('search')) {
                    $search = request()->get('search');
                    $query->where('name', 'LIKE', '%' . $search['value'] . '%');
                }

            })
            ->editColumn('icon', function ($city) {
                return '<img src="' . $city->icon32 . '" class="img-circle">';
            })
            ->addColumn('action', function ($city) {
                return '<a href="' . url(admin_constant_url() . '/city/' . $city->id) . '" class="btn btn-circle btn-icon-only purple edit" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="' . url(admin_constant_url() . '/city/' . $city->id) . '" class="btn btn-circle btn-icon-only red delete" title="Delete">
                                        <i class="fa fa-times"></i>
                                    </a>';
            })->addIndexColumn()
            ->rawColumns(['icon', 'action'])->toJson();
    }

    function getAll(array $attributes)
    {
        // TODO: Implement getAll() method.
    }

    function getCities(array $attributes)
    {
//        $page_size = isset($attributes['page_size']) ? $attributes['page_size'] : max_pagination();
//        $page_number = isset($attributes['page_number']) ? $attributes['page_number'] : 1;

        $collection = $this->model->all();

//        $count = $collection->count();
//        $page_count = page_count($count, $page_size);
//        $page_number = $page_number - 1;
//        $page_number = $page_number > $page_count ? $page_number = $page_count - 1 : $page_number;
//        $object = $collection->take($page_size)->skip((int)$page_number * $page_size)->get();
//        $object = $collection->get();

        if (request()->segment(1) == 'api' || request()->ajax()) {
            if (count($collection) > 0)
                return response_api(true, 200, null, $collection);
            return response_api(true, 200, null, []);
        }
        return $collection;

    }


    function getById($id)
    {
        $city = $this->model->find($id);

        if (isset($city)) {
            return response_api(true, 200, null, $city);
        }
        return response_api(false, 422,null,[]);
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
//        $city = $this->model->find($id);
//        if (isset($city) && $city->delete()) {
//            return response_api(true, 200);
//        }
//        return response_api(false, 422);

    }


}
