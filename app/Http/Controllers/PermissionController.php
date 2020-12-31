<?php

namespace App\Http\Controllers;

use App\Http\Requests\Permission\CreatePermissionRequest;
use App\Http\Requests\Permission\CreatePermissionRoleRequest;
use App\Http\Requests\Permission\UpdatePermissionRequest;
use App\Repositories\Eloquents\PermissionEloquent;
use App\Repositories\Eloquents\RoleEloquent;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    //
    protected $role, $permission;

    public function __construct(RoleEloquent $role, PermissionEloquent $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
        view()->share(['main_title' => 'Roles']);

    }

    // Permissions

    public function permissions()
    {
        $data = [
            'sub_title' => 'Permissions'
        ];
        return view(admin_permission_vw() . '.index', $data);
    }

    public function permissionData()
    {
        return $this->permission->anyData();
    }

    public function addPermission()
    {
        $permission_master = $this->permission->getAllMaster();

        $data = [
            'title' => 'Roles',
            'sub_title' => 'Add new permissions',
            'permission_master' => $permission_master,
            'back_url' => url(admin_role_url() . '/roles'),
        ];

        return view(admin_permission_vw() . '.add', $data);
    }

    public function postAddPermission(CreatePermissionRequest $request)
    {

        $is_sidebar = ($request->filled('is_sidebar') && $request->get('is_sidebar') == 'on') ?: 0;
        $request->request->add(['is_sidebar' => $is_sidebar]);

        return $this->permission->create($request->all());
    }

    public function editPermission($id)
    {
        $permission = $this->permission->getById($id);
        $permission_master = $this->permission->getAllMaster();

        $data = [
            'title' => 'Roles',
            'sub_title' => 'Edit permission (' . $permission->display_name . ')',
            'permission' => $permission,
            'permission_master' => $permission_master,
            'back_url' => url(admin_role_url() . '/roles'),
        ];

        return view(admin_permission_vw() . '.edit', $data);
    }

    public function putEditPermission(UpdatePermissionRequest $request, $permission_id)
    {

        $is_sidebar = ($request->filled('is_sidebar') && $request->get('is_sidebar') == 'on') ?: 0;
        $request->request->add(['is_sidebar' => $is_sidebar]);

        return $this->permission->update($request->all(), $permission_id);
    }

    public function addPermissionRole($role_id)
    {
        $role = $this->role->getById($role_id);
        $perms = $this->permission->getAll(\request()->all());

        $data = [
            'title' => 'Roles',
            'sub_title' => 'Add new permission (' . $role->display_name . ')',
            'perms' => $perms,
            'role' => $role,
            'icon' => 'fa fa-user-secret',
            'back_url' => url(admin_role_url() . '/roles'),
        ];

        return view(admin_role_vw() . '.add-permissions', $data);
    }

    public function getPermissionRole($role_id)
    {
        $role = $this->role->getById($role_id);

        $role_permissions = null;
        if (isset($role->perms)) {
            $role_permissions = array_map('strval', $role->perms->pluck('id')->toArray());
        }

        return response_api(isset($role) && isset($role->perms),200,null, $role_permissions);
    }

    public function postAddRolePermissions(CreatePermissionRoleRequest $request, $role_id)
    {
        return $this->permission->addRolePerm($request->all(),$role_id);

    }

    public function deletePermission($id)
    {
        return $this->permission->delete($id);
    }

    public function permissionSidebar(Request $request)
    {

        return $this->permission->setSidebar($request->get('permission_id'));
    }
}
