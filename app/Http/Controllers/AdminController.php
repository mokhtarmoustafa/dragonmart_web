<?php

namespace App\Http\Controllers;

use App\Admin;
use App\City;
use App\DriverType;
use App\Http\Requests\Admin\EditAdminRequest;
use App\Http\Requests\Merchant\CreateRequest;
use App\Http\Requests\Merchant\UpdateRequest;
use App\ProductCategory;
use App\Repositories\Eloquents\AdminEloquent;
use App\Repositories\Eloquents\MerchantEloquent;
use App\Repositories\Eloquents\UserEloquent;
use App\Role;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    private $merchant, $admin;

    public function __construct(MerchantEloquent $merchantEloquent, AdminEloquent $adminEloquent)
    {
        parent::__construct();

        $this->merchant = $merchantEloquent;
        $this->admin = $adminEloquent;
    }

    public function adminActive($id)
    {
        return $this->admin->adminActive($id);
    }

    public function adminProfile()
    {
        $data = [
            'main_title' => 'admins',
            'sub_title' => 'Profile',
            'icon' => 'icon-user',
            'roles' => Role::all(),
        ];
        return view(admin_vw() . '.profile', $data);
    }

    public function editAdminProfile(EditAdminRequest $request)
    {
        return $this->admin->editAdminProfile($request->all());
    }

    public function adminsList()
    {

        $data = [
            'main_title' => 'admins',
            'sub_title' => 'Admins list',
            'icon' => 'icon-users',
        ];
        return view(admin_vw() . '.admins.index', $data);
    }


    public function adminData()
    {
        return $this->admin->adminData();
    }


//
    public function adminDet($id)
    {

        $admin = $this->admin->getById($id);

        $html = 'This admin does not exist';
        if (isset($admin)) {
            $view = view()->make(admin_vw() . '.admins.admin_det', ['admin' => $admin,'roles'=>Role::all(), 'admin_roles' => $admin->roles()->pluck('role_id')->toArray()]);

            $html = $view->render();
        }
        return $html;
    }


    public function editAdmin($id)
    {

        $admin = $this->admin->getById($id);

        $html = 'This admin does not exist';
        if (isset($admin)) {
            $view = view()->make('modal', [
                'modal_id' => 'edit-admin',
                'modal_title' => 'Edit Admin',
                'roles_id' => Role::all()->pluck('id')->toArray(),

                'form' => [
                    'method' => 'PUT',
                    'url' => url(admin_user_tab_url() . '/admin/' . $id),
                    'form_id' => 'formEdit',
                    'fields' => [
                        'logo' => 'image',
                        'name' => 'text',
                        'username' => 'text',
                        'mobile' => 'text',
                        'email' => 'email',
                        // 'password' => 'password',
                        // 'password_confirmation' => 'password',
                        'role[]' => Role::all(),

                    ],
                    'values' => [
                        'logo' => $admin->logo,
                        'name' => $admin->name,
                        'username' => $admin->username,
                        'mobile' => $admin->mobile,
                        'email' => $admin->email,
                        // 'password' => '',
                        // 'password_confirmation' => '',
                        'role[]' => $admin->roles()->get(),
                        'role_res[]' => $admin->roles()->pluck('id')->toArray(),
                    ],
                    'fields_name' => [
                        'logo' => 'Logo',
                        'name' => 'Name',
                        'username' => 'Username',
                        'mobile' => 'Phone',
                        'email' => 'Email',
                        // 'password' => 'Password',
                        // 'password_confirmation' => 'Confirm Password',
                        'role[]' => 'Role',

                    ]
                ]
            ]);

            $html = $view->render();
        }
        return $html;
    }

//
    public function updateAdmin(UpdateRequest $request, $id)
    {
        return $this->admin->update($request->all(), $id);
    }

//
    public function createAdmin()
    {
        $view = view()->make('modal', [
            'modal_id' => 'add-admin',
            'modal_title' => 'Add New Admin',
            'form' => [
                'method' => 'POST',
                'url' => url(admin_user_tab_url() . '/admin/store'),
                'form_id' => 'formAdd',
                'fields' => [
                    'logo' => 'image',
                    'name' => 'text',
                    'username' => 'text',
                    'mobile' => 'text',
                    'email' => 'email',
                   'password' => 'password',
                   'password_confirmation' => 'password',
                    'role[]' => Role::all(),

                ],
                'fields_name' => [
                    'logo' => 'Logo',
                    'name' => 'Name',
                    'username' => 'Username',
                    'mobile' => 'Phone',
                    'email' => 'Email',
                   'password' => 'Password',
                   'password_confirmation' => 'Confirm Password',
                    'role[]' => 'Role',

                ]
            ]
        ]);

        $html = $view->render(); 

        return $html;
    }

//
    public function storeAdmin(CreateRequest $request)
    {
        return $this->admin->create($request->all());
    }


    public function merchantList()
    {
        $data = [
            'main_title' => 'merchants',
            // 'sub_title' => 'merchants',
            'icon' => 'icon-users',
        ];
        return view(admin_merchants_vw() . '.index', $data);
    }

    public function merchantDet($id)
    {
        $merchant = Admin::where('type', 'merchant')->find($id);
        $driver_types = DriverType::all();
        $categories = ProductCategory::all();
        $data = [
            'main_title' => 'merchants',
            // 'sub_title' => 'merchants',
            'icon' => 'icon-users',
            'merchant' => $merchant,
            'driver_types' => $driver_types,
            'categories' => $categories,
        ];
        return view(admin_merchants_vw() . '.view', $data);
    }

    public function merchantData()
    {
        return $this->merchant->merchantData();
    }

    public function merchantActive(Request $request)
    {
        return $this->merchant->merchantActive($request->only('merchant_id'));
    }

//
    public function editMerchant($id)
    {

        $merchant = $this->merchant->getById($id);

        $html = 'This merchant does not exist';
        if (isset($merchant)) {
            $view = view()->make('modal', [
                'modal_id' => 'edit-merchant',
                'modal_title' => 'Edit Merchant',
                'form' => [
                    'method' => 'PUT',
                    'url' => url(admin_user_tab_url() . '/merchant/' . $id),
                    'form_id' => 'formEditMerchant',
                    'fields' => [
                        'logo' => 'image',
                        'name' => 'text',
                        'username' => 'text',
                        'mobile' => 'text',
                        'email' => 'email',
                        'city' => City::all(),
                        // 'password' => 'password',
                        // 'password_confirmation' => 'password',
                    ],
                    'values' => [
                        'logo' => $merchant->logo,
                        'name' => $merchant->name,
                        'username' => $merchant->username,
                        'mobile' => $merchant->mobile,
                        'email' => $merchant->email,
                        'city' => $merchant->city->name_en,
                        // 'password' => '',
                        // 'password_confirmation' => '',
                    ],
                    'fields_name' => [
                        'logo' => 'Logo',
                        'name' => 'Name',
                        'username' => 'Username',
                        'mobile' => 'Phone',
                        'email' => 'Email',
                        'city' => 'City',
                        // 'password' => 'Password',
                        // 'password_confirmation' => 'Confirm Password',
                    ]
                ]
            ]);

            $html = $view->render();
        }
        return $html;
    }

//
    public function updateMerchant(UpdateRequest $request, $id)
    {
        return $this->merchant->update($request->all(), $id);
    }

//
    public function createMerchant()
    {

        $view = view()->make('modal', [
            'modal_id' => 'add-merchant',
            'modal_title' => 'Add New Merchant',
            'form' => [
                'method' => 'POST',
                'url' => url(admin_user_tab_url() . '/merchant'),
                'form_id' => 'formAddMerchant',
                'fields' => [
                    'logo' => 'image',
                    // 'name' => 'text',
                    'username' => 'text',
                    'mobile' => 'text',
                    'email' => 'email',
                    'city' => City::all(),

                   'password' => 'password',
                   'password_confirmation' => 'password',
                ],
                'fields_name' => [
                    'logo' => 'Logo',
                    // 'name' => 'Name',
                    'username' => 'Username',
                    'mobile' => 'Phone',
                    'email' => 'Email',
                    'city' => 'City',

                   'password' => 'Password',
                   'password_confirmation' => 'Confirm Password',
                ]
            ]
        ]);

        $html = $view->render();

        return $html;
    }

    public function storeMerchant(CreateRequest $request)
    {
        return $this->merchant->create($request->all());
    }

    public function merchantDeliveryMethod(Request $request)
    {
        return $this->merchant->merchantDeliveryMethod($request->all());
    }


    public function addMerchantCategory(Request $request, $merchant_id)
    {

        return $this->merchant->addMerchantCategory($request->all(), $merchant_id);
    }

    public function deleteMerchantCategory($category_id)
    {

        return $this->merchant->deleteMerchantCategory($category_id);
    }

}
