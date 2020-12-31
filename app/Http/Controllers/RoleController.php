<?php

namespace App\Http\Controllers;

use App\Http\Requests\Role\CreateRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Repositories\Eloquents\RoleEloquent;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $role;

    public function __construct(RoleEloquent $role)
    {
        $this->role = $role;
        view()->share(['main_title' => 'Roles']);


    }

    // roles
    public function roleData()
    {
        return $this->role->anyData();
    }

    public function roles()
    {

        $roles = $this->role->getAll(\request()->all());

        $data = [
            'title' => 'Roles',
            'roles' => $roles,
            'icon' => 'icon-settings',

        ];
        return view(admin_role_vw() . '.index', $data);
    }

    public function addRole()
    {
        $view = view()->make('modal', [
            'modal_id' => 'add-role',
            'modal_title' => 'Add New Role',
            'form' => [
                'method' => 'POST',
                'url' => url(admin_role_url() . '/add-role'),
                'form_id' => 'formAdd',
                'fields' => [
                    'name' => 'text',
                    'display_name' => 'text',
                    'description' => 'textarea',
                ],
                'fields_name' => [
                    'name' => 'Name',
                    'display_name' => 'Display name',
                    'description' => 'Description',
                ]
            ]
        ]);

        $html = $view->render();

        return $html;
    }


    public function postAddRole(CreateRoleRequest $request)
    {

        return $this->role->create($request->all());
    }

    public function editRole($id)
    {
        $role = $this->role->getById($id);

        $html = 'This role does not exist';
        if (isset($role)) {
            $view = view()->make('modal', [
                'modal_id' => 'edit-role',
                'modal_title' => 'Edit Role',
                'form' => [
                    'method' => 'PUT',
                    'url' => url(admin_role_url() . '/edit-role/' . $id),
                    'form_id' => 'formEdit',
                    'fields' => [
                        'name' => 'text',
                        'display_name' => 'text',
                        'description' => 'textarea',
                    ],
                    'values' => [
                        'name' => $role->name,
                        'display_name' => $role->display_name,
                        'description' => $role->description,
                    ],
                    'fields_name' => [
                        'name' => 'Name',
                        'display_name' => 'Display name',
                        'description' => 'Description',
                    ]
                ]
            ]);

            $html = $view->render();
        }
        return $html;
    }

    public function putRole(UpdateRoleRequest $request, $id)
    {
        return $this->role->update($request->all(), $id);
    }

    public function delete($id)
    {
        return $this->role->delete($id);
    }

}
