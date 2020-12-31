<?php
/**
 * Created by PhpStorm.
 * User: mohammedsobhei
 * Date: 1/7/18
 * Time: 12:29 PM
 */

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\Repository;
use App\Role;


class RoleEloquent implements Repository
{

    private $model;

    public function __construct(Role $model)
    {
        $this->model = $model;
    }

    function anyData()
    {
        $roles = $this->model->query()->orderByDesc('updated_at');

        return datatables()->of($roles)
            ->filter(function ($query) {
//                if (request()->filled('name')) {
//                    $query->where('name', 'LIKE', '%' . request()->get('name') . '%');
//                }
//
//                if (request()->filled('display_name')) {
//                    $query->where('display_name', 'LIKE', '%' . request()->get('display_name') . '%');
//                }
            })->addColumn('action', function ($role) {

                $action = '';
                if ($role->name != 'Administrator')
                    $action = '<a href="' . url(admin_role_url() . '/edit-role/' . $role->id) . '" class="btn btn-circle btn-icon-only purple edit-role-mdl " title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="' . url(admin_role_url() . '/delete-role/' . $role->id) . '" class="btn btn-circle btn-icon-only red delete" title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </a>';
                return '<a href="' . url(admin_role_url() . '/add-permission-role/' . $role->id) . '"
                                       class="btn btn-circle btn-icon-only green" title="Add permissions">
                                        <i class="fa fa-cogs"></i>
                                    </a>
                                    
                                    ' . $action;
            })->addIndexColumn()->rawColumns(['action'])->toJson();
    }


    function getAll(array $attribute)
    {
        // TODO: Implement getAll() method.
        return $this->model->all();
    }

    function getById($id)
    {
        // TODO: Implement getById() method.
        return $this->model->find($id);
    }

    function create(array $attributes)
    {
        $role = new Role();
        $role->name = $attributes['name'];
        $role->display_name = $attributes['display_name'];
        $role->description = $attributes['description'];
        // TODO: Implement create() method.
        if ($role->save())
            return response_api(true, 200);
        return response_api(false, 422);
    }

    function update(array $attributes, $id = null)
    {
        // TODO: Implement update() method.
        $role = $this->model->find($id);
        if (isset($attributes['name']))
            $role->name = $attributes['name'];
        if (isset($attributes['display_name']))
            $role->display_name = $attributes['display_name'];
        if (isset($attributes['description']))
            $role->description = $attributes['description'];
        // TODO: Implement create() method.
        if ($role->save())
            return response_api(true, 200);
        return response_api(false, 422);
    }

    function delete($id)
    {
        // TODO: Implement delete() method.
        $role = $this->model->find($id);

        if (isset($role) && $role->delete())
            return response_api(true, 200, trans('app.role_deleted'), []);
        return response_api(false, 422, null, []);

    }


}