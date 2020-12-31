<?php
/**
 * Created by PhpStorm.
 * User: mohammedsobhei
 * Date: 1/7/18
 * Time: 12:29 PM
 */

namespace App\Repositories\Eloquents;

use App\Permission;
use App\Repositories\Interfaces\Repository;


class PermissionEloquent implements Repository
{

    private $model, $role;

    public function __construct(Permission $model, RoleEloquent $role)
    {
        $this->model = $model;
        $this->role = $role;
    }

    function anyData()
    {
        $permissions = $this->model->query()->orderByDesc('updated_at');

        $num = 1;
        return datatables()->of($permissions)
            ->filter(function ($query) {

            })
            ->addColumn('num', function () use (&$num) {

                return $num++;
            })->editColumn('icon', function ($permission) {

                return '<i class="' . $permission->icon . '"></i>';
            })->editColumn('parent_id', function ($permission) {

                if (isset($permission->master))
                    return $permission->master->display_name;
                return null;
            })->editColumn('is_sidebar', function ($permission) {

                if ($permission->is_sidebar == 1)
                    $is_received = '<div class="md-checkbox"><input type="checkbox" id="checkbox' . $permission->id . '" class="md-check is_sidebar" checked data-id="' . $permission->id . '"><label for="checkbox' . $permission->id . '"><span></span><span class="check"></span><span class="box"></span>  </label></div>';
                else
                    $is_received = '<div class="md-checkbox"><input type="checkbox" id="checkbox' . $permission->id . '" class="md-check is_sidebar" data-id="' . $permission->id . '"><label for="checkbox' . $permission->id . '"><span></span><span class="check"></span><span class="box"></span>  </label></div>';

                return $is_received;
            })->addColumn('action', function ($permission) {
                return '
                                    <a href="' . url(admin_vw().'/edit-permission/' . $permission->id) . '" class="btn btn-circle btn-icon-only purple" title="تعديل">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="' . url(admin_vw().'/delete-permission/' . $permission->id) . '" class="btn btn-circle btn-icon-only red delete" title="حذف">
                                        <i class="fa fa-times"></i>
                                    </a>';
            })->addIndexColumn()->rawColumns(['is_sidebar', 'icon', 'action'])->toJson();
    }

    function setSidebar($permission_id)
    {
        $permission = $this->getById($permission_id);
        $permission->is_sidebar = !$permission->is_sidebar;

        if ($permission->save())
            return response_api(true, 200, null, []);
        return response_api(false, 422, null, []);

    }

    function getAll(array $attributes)
    {
        // TODO: Implement getAll() method.
        return $this->model->orderBy('sort_num', 'ASC')->get();
    }

    function getById($id)
    {
        // TODO: Implement getById() method.
        return $this->model->find($id);
    }

    function getAllMaster()
    {
        // TODO: Implement getById() method.
        return $this->model->whereNull('parent_id')->orderBy('sort_num', 'ASC')->get();
    }

    function create(array $attributes)
    {
        // TODO: Implement create() method.
        $added = $this->model->create($attributes);
        if ($added)
            return response_api(true, 200, null, []);
        return response_api(false, 422, null, []);
    }

    function update(array $attributes, $id = null)
    {
        // TODO: Implement update() method.
        return $this->model->find($id)->update($attributes);
    }

    function delete($id)
    {
        // TODO: Implement delete() method.
        $deleted = $this->model->find($id)->delete();
        if ($deleted)
            return response_api(true, 200, null, []);
        return response_api(false, 422, null, []);

    }

    function addRolePerm(array $attributes, $role_id)
    {
        $role = $this->role->getById($role_id);
        $role->perms()->sync([]);

        if (isset($attributes['permissions_id'])) {
            $permissions = $this->model->whereIn('id', $attributes['permissions_id'])->get();
            $role->perms()->sync($permissions);
        }
        return response_api(true, 200);
    }
}