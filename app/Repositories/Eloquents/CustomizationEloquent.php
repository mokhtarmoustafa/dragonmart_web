<?php
/**
 * Created by PhpStorm.
 * UserRequest: mohammedsobhei
 * Date: 5/2/18
 * Time: 11:43 PM
 */

namespace App\Repositories\Eloquents;

use App\Customization;
use App\Repositories\Interfaces\Repository;

class CustomizationEloquent implements Repository
{

    private $model;

    public function __construct(Customization $model)
    {
        $this->model = $model;
    }

    // for cpanel
    function anyData()
    {
        $customizations = $this->model->orderByDesc('created_at');
        return datatables()->of($customizations)
            ->filter(function ($query) {

                if (request()->filled('search')) {
                    $search = request()->get('search');
                    $query->where('name', 'LIKE', '%' . $search['value'] . '%');
                }

            })
            ->addColumn('action', function ($customization) {
                return '<a href="' . url(admin_vw() . '/customization/' . $customization->id . '/edit') . '" class="btn btn-circle btn-icon-only purple edit edit-customization-mdl" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    ';
            })->addIndexColumn()
            ->rawColumns(['action'])->toJson();

//        <a href="' . url(admin_constant_url() . '/customization/' . $customization->id) . '" class="btn btn-circle btn-icon-only red delete" title="Delete">
//                                        <i class="fa fa-trash"></i>
//                                    </a>
    }

    function getAll(array $attributes)
    {
        // TODO: Implement getAll() method.
        return $this->model->all();
    }


    function getById($id)
    {
        $customization = $this->model->find($id);

        if (isset($customization)) {
            return response_api(true, 200, null, $customization);
        }
        return response_api(false, 422);
    }

    function create(array $attributes)
    {
        // TODO: Implement create() method.
        $customization = new Customization();
        $customization->name = $attributes['name'];
        if ($customization->save()) {
            return response_api(true, 200);
        }
        return response_api(false, 422);
    }

    function update(array $attributes, $id = null)
    {
        // TODO: Implement create() method.

        $customization = $this->model->find($id);
        if (!isset($customization))
            $customization = new Customization();

        $customization->name = $attributes['name'];
        if ($customization->save()) {

            return response_api(true, 200);
        }
        return response_api(false, 422);

    }

    function delete($id)
    {
        // TODO: Implement delete() method.
        $customization = $this->model->find($id);
        if (isset($customization) && $customization->delete()) {
            return response_api(true, 200);
        }
        return response_api(false, 422);

    }


}
