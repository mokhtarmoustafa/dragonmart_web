<?php
/**
 * Created by PhpStorm.
 * UserRequest: mohammedsobhei
 * Date: 5/2/18
 * Time: 11:43 PM
 */

namespace App\Repositories\Eloquents;

use App\Admin;
use App\DeviceToken;
use App\Mail\DeepLinkResetPasswordMail;
use App\MerchantDeliveryMethod;
use App\Repositories\Interfaces\Repository;
use App\Repositories\Uploader;
use App\Store;
use App\StoreCategory;
use App\User;
use DB;
use Excel;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Lcobucci\JWT\Parser;
use Mail;
use Illuminate\Mail\Message;
use Password;

class MerchantEloquent extends Uploader implements Repository
{


    private $model, $deviceToken, $user, $notificationSystem;

    public function __construct(Admin $model, User $user, DeviceToken $deviceToken, NotificationSystemEloquent $notificationSystemEloquent)
    {
        $this->model = $model;
        $this->user = $user;
        $this->deviceToken = $deviceToken;
        $this->notificationSystem = $notificationSystemEloquent;
    }

    function merchantData()
    {

        $merchants = $this->model->where('type', 'merchant')->orderByDesc('created_at');

        return datatables()->of($merchants)
            ->filter(function ($query) {

                if (request()->filled('name')) {
                    $query->where('name', 'LIKE', '%' . request()->get('name') . '%');
                }
                if (request()->filled('username')) {
                    $query->where('username', 'LIKE', '%' . request()->get('username') . '%');
                }
                if (request()->filled('mobile')) {
                    $query->where('mobile', 'LIKE', '%' . request()->get('mobile') . '%');
                }

                if (request()->filled('email')) {
                    $query->where('email', 'LIKE', '%' . request()->get('email') . '%');
                }

                if (request()->filled('status')) {
                    $query->where('status', request()->get('status'));
                }

            })
            ->editColumn('logo', function ($merchant) {

                if (isset($merchant->logo))
                    return '<img src="' . $merchant->logo100 . '">';
                return '<img src="' . url('assets/apps/img/man.svg') . '" width="70px">';
            })
            ->editColumn('status', function ($merchant) {

                if ($merchant->is_active) {
                    return '<span class="label label-sm label-success">Active</span>';
                }

                return '<span class="label label-sm label-warning"> Disable</span>';
//                $active = '';
//                $not_active = 'selected';
//                if ($user->status) {
//                    $active = 'selected';
//                    $not_active = '';
//                }
//                return '<select class="form-control input-md status" data-id="' . $user->id . '" name="status">
//                                        <option value="0" ' . $not_active . '>Disable</option>
//                                        <option value="1" ' . $active . '>Active</option>
//
//                                    </select>';
            })->addColumn('action', function ($merchant) {

                if (!$merchant->is_active) {
                    $color = "green";
                    $title = "Activate user";
                    $icon = "check";

                } else {
                    $color = "red";
                    $title = "Suspend user";
                    $icon = "power-off";

                }
                return '
                                    <a href="' . url(admin_merchants_url() . '/' . $merchant->id . '/edit') . '" class="btn btn-circle btn-icon-only blue edit-merchant-mdl">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="' . url(admin_merchants_url() . '/' . $merchant->id) . '" class="btn btn-circle btn-icon-only purple" title="View">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="javascript:;" class="btn btn-circle btn-icon-only ' . $color . ' set_active" data-id="' . $merchant->id . '" title="' . $title . '">
                                        <i class="fa fa-' . $icon . '"></i>
                                    </a>
                                    ';
            })->addIndexColumn()
            ->rawColumns(['logo', 'status', 'action'])->toJson();
    }

    function export()
    {

        Excel::create('Admins data', function ($excel) {

            $excel->sheet('Sheet 1', function ($sheet) {

                $collection = $this->model;
                if (request()->filled('name')) {
                    $collection = $collection->where('username', 'LIKE', '%' . request()->get('name') . '%');
                }
                if (request()->filled('email')) {
                    $collection = $collection->where('email', 'LIKE', '%' . request()->get('email') . '%');
                }
                if (request()->filled('level')) {
                    $collection = $collection->where('level', request()->get('level'));
                }
                $sheet->cell('A1', function ($cell) {
                    $cell->setValue('Full name');
                });
                $sheet->cell('B1', function ($cell) {
                    $cell->setValue('Email');
                });
                $sheet->cell('C1', function ($cell) {
                    $cell->setValue('Level');
                });
                $data = $collection->get();

                if (!empty($data)) {
                    foreach ($data as $key => $value) {
                        $i = $key + 2;
                        $sheet->cell('A' . $i, $value['username']);
                        $sheet->cell('B' . $i, $value['email']);
                        $sheet->cell('C' . $i, $value['level']);
                    }
                }

            });
        })->export('xls');
    }

    function getAll(array $attributes)
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

        $password = $attributes['password'];
        // TODO: Implement create() method.
        $admin = new Admin();
        $admin->name = $attributes['username'];
        $admin->username = $attributes['username'];
        $admin->mobile = $attributes['mobile'];
        $admin->email = $attributes['email'];
        // send password to mobile
        $admin->password = bcrypt($password);//bcrypt($attributes['password']);
        $admin->type = 'merchant';

        if ($admin->save()) {
            if (isset($attributes['logo'])) {
                $admin->logo = $this->storeImageThumb('admins', $admin->id, $attributes['logo']);
                $admin->save();
            }
            $admin = $this->model->find($admin->id);
//

            // proxy reset password admin/password/email

//            $this->sendResetPasswordEmail($attributes);
            // add merchant to user table mobile
            $user = new User();
            $user->username = $attributes['username'];
            $user->email = $attributes['email'];
            $user->password = bcrypt($password);//bcrypt($attributes['password']);
            $user->mobile = $attributes['mobile'];
            $user->type = 'merchant';
            $confirm_code = '111111';//$this->generateVerificationCode();
            $user->verification_code = $confirm_code;
            $user->city_id = $attributes['city'];

//        // user will approved automatically
            $user->is_active = 1;
            $user->save();

            // Mail::to($attributes['email'])->send(new DeepLinkResetPasswordMail(url('user/' . $user->id)));

            if (isset($attributes['logo'])) {
                $user->image = $this->storeImageThumb('users', $user->id, $attributes['logo']);
                $user->save();
            }
            $admin->user_id = $user->id;
            $admin->save();

            $store = new Store();
            $store->merchant_id = $user->id;
            $store->name = $attributes['username'];
            $store->save();
//            if ($admin->level == 'admin') {
//                // user has one roles in my case
//                if (count($admin->roles) > 0) {
//                    $admin->detachRoles($admin->roles);
//                }
//
//                foreach ($attributes['role'] as $role)
//                    $admin->attachRole($role);
//            }


            return response_api(true, 200, trans('app.created'), $admin);

        }
        return response_api(false, 422, trans('app.not_created'));
    }

    public function sendResetPasswordEmail($request)
    {
        $response = Password::broker('admins')->sendResetLink(
            ['email' => $request['email']]
        );
//
//        return $response == \Illuminate\Support\Facades\Password::RESET_LINK_SENT
//            ? true
//            : false;
    }

    function update(array $attributes, $id = null)
    {
        // TODO: Implement update() method.

        $admin = $this->model->find($id);

        if (isset($attributes['name']))
            $admin->name = $attributes['name'];
        if (isset($attributes['username']))
            $admin->username = $attributes['username'];
        if (isset($attributes['mobile']))
            $admin->mobile = $attributes['mobile'];
        if (isset($attributes['email']))
            $admin->email = $attributes['email'];
        if (isset($attributes['password']))
            $admin->password = bcrypt($attributes['password']);


        if ($admin->save()) {

            if (isset($attributes['logo'])) {
                $admin->logo = $this->storeImageThumb('admins', $admin->id, $attributes['logo']);
                $admin->save();
            }
//            if ($admin->level == 'admin') {
//                // user has one roles in my case
//                if (count($admin->roles) > 0) {
//                    $admin->detachRoles($admin->roles);
//                }
//
//                foreach ($attributes['role'] as $role)
//                    $admin->attachRole($role);
//            }
            return response_api(true, 200, trans('app.updated'), $admin);

        }
        return response_api(false, 422, trans('app.not_updated'));
    }

    function delete($id)
    {
        // TODO: Implement delete() method.
        $admin = $this->model->where('level', 'admin')->find($id);

        if (isset($admin) && $admin->delete())
            return response_api(true, 200, trans('app.deleted'), []);
        return response_api(false, 422, null, []);

    }

    function deleteMerchantCategory($id)
    {
        // TODO: Implement delete() method.
        $category = StoreCategory::find($id);

        if (isset($category) && $category->delete())
            return response_api(true, 200, trans('app.deleted'), []);
        return response_api(false, 422, null, []);

    }

    function merchantActive($id)
    {

        $merchant = $this->model->where('type', 'merchant')->find($id['merchant_id']);


        if (isset($merchant)) {
            $merchant->status = !$merchant->status;

            if ($merchant->save()) {
                $user = $this->user->find($merchant->user_id);
                $user->is_active = !$user->is_active;
                $user->save();
                if (!$merchant->status) {
                    return response_api(true, 200);
                }
                return response_api(true, 200);
            }
        }
        return response_api(false, 422);

    }

    public function logout($user_id = null)
    {
        if (!isset($user_id)) {
            $user_id = auth()->user()->id;

            $value = \request()->bearerToken();
            $id = (new Parser())->parse($value)->getHeader('jti');
            $token = DB::table('oauth_access_tokens')
                ->where('id', '=', $id)
                ->update(['revoked' => true]);
            DB::table('oauth_refresh_tokens')
                ->where('access_token_id', $id)
                ->update(['revoked' => true]);
        } else {
            $access_token_id = DB::table('oauth_access_tokens')
                ->where('user_id', '=', $user_id)->pluck('id');

            $token = DB::table('oauth_access_tokens')
                ->where('user_id', '=', $user_id)
                ->update(['revoked' => true]);

            DB::table('oauth_refresh_tokens')
                ->whereIn('access_token_id', $access_token_id)
                ->update(['revoked' => true]);
        }
        // token device
        // turn off mobile // registerId : mac address code
        $device_reset = false;
        if (\request()->filled('device_id'))
            $device_reset = $this->deviceToken->where('user_id', $user_id)->where('device_id', \request()->get('device_id'))->update(['status' => 'off']);
        if (\request()->filled('device_type'))
            $device_reset = $this->deviceToken->where('user_id', $user_id)->where('device_type', \request()->get('device_type'))->update(['status' => 'off']);

        if (!$device_reset)
            $this->deviceToken->where('user_id', $user_id)->update(['status' => 'off']);

        if ($token)
            return response_api(true, 200, null, []);
        return response_api(false, 422, null, []);
    }

    public function merchantDeliveryMethod(array $attributes)
    {
        MerchantDeliveryMethod::where('merchant_id', $attributes['merchant_id'])->forceDelete();
        foreach ($attributes['driver_type_id'] as $driver_type_id) {

            $delivery_method = new MerchantDeliveryMethod();
            $delivery_method->merchant_id = $attributes['merchant_id'];
            $delivery_method->driver_type_id = $driver_type_id;
            $delivery_method->save();
        }

        return response_api(true, 200, null, []);

    }

    public function addMerchantCategory(array $attributes, $merchant_id)
    {

        $store = Store::where('merchant_id', $merchant_id)->first();
        $category = StoreCategory::where('merchant_id', $merchant_id)->where('category_id', $attributes['category_id'])->first();
        if (!isset($category))
            $category = new StoreCategory();
        $category->store_id = $store->id;
        $category->merchant_id = $merchant_id;
        $category->category_id = $attributes['category_id'];
        $category->save();

        return response_api(true, 200, null, []);

    }

    function count()
    {
        return $this->model->count();
    }


}
