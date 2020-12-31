<?php
/**
 * Created by PhpStorm.
 * UserRequest: mohammedsobhei
 * Date: 5/2/18
 * Time: 11:43 PM
 */

namespace App\Repositories\Eloquents;

use App\Admin;
use App\Repositories\Interfaces\Repository;
use App\Repositories\Uploader;

use Carbon\Carbon;
use DB;
use Excel;
use Hash;

use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
//use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Lcobucci\JWT\Parser;
use Password;

use Mail;

class AdminEloquent extends Uploader implements Repository
{

    private $model;

    public function __construct(Admin $model)
    {
        $this->model = $model;
    }

    function adminData()
    {

        $admins = $this->model->where('type', 'admin')->orderByDesc('created_at');

        return datatables()->of($admins)
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
            ->editColumn('logo', function ($admin) {

                if (isset($admin->logo))
                    return '<img src="' . $admin->logo100 . '">';
                return '<img src="' . url('assets/apps/img/man.svg') . '" width="70px">';
            })
            ->editColumn('status', function ($admin) {

                if ($admin->status) {
                    return '<span class="label label-sm label-success">Active</span>';
                }

                return '<span class="label label-sm label-warning"> Disable</span>';
//                $active = '';
//                $not_active = 'selected';
//                if ($admin->status) {
//                    $active = 'selected';
//                    $not_active = '';
//                }
//                return '<select class="form-control input-md status" data-id="' . $admin->id . '" name="status">
//                                        <option value="0" ' . $not_active . '>disable</option>
//                                        <option value="1" ' . $active . '>active</option>
//
//                                    </select>';
            })->addColumn('action', function ($admin) {

                if (!$admin->status) {
                    $color = "green";
                    $title = "Activate user";
                    $icon = "check";

                } else {
                    $color = "red";
                    $title = "Suspend user";
                    $icon = "power-off";

                }
                $action = '';
                if ($admin->level == 'admin')
                    $action = '<a href="javascript:;" class="btn btn-circle btn-icon-only ' . $color . ' set_active" data-id="' . $admin->id . '" title="' . $title . '">
                                        <i class="fa fa-' . $icon . '"></i>
                                    </a>';
                return '
                                    <a href="' . url(admin_vw() . '/admin/' . $admin->id . '/edit') . '" class="btn btn-circle btn-icon-only blue edit-admin-mdl">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="' . url(admin_vw() . '/admin/' . $admin->id) . '" class="btn btn-circle btn-icon-only purple admin-det" title="View">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    ' . $action;
            })->addIndexColumn()
            ->rawColumns(['logo', 'status', 'action'])->toJson();
    }

    function adminActive($id)
    {

        $admin = $this->model->find($id);

        if (isset($admin)) {
            $admin->status = !$admin->status;

            if ($admin->save()) {

                return response_api(true, 200, null, $admin);
            }
        }
        return response_api(false, 422);

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
            ->editColumn('status', function ($user) {

                $active = '';
                $not_active = 'selected';
                if ($user->status) {
                    $active = 'selected';
                    $not_active = '';
                }
                return '<select class="form-control input-md status" data-id="' . $user->id . '" name="status">
                                        <option value="0" ' . $not_active . '>disable</option>
                                        <option value="1" ' . $active . '>active</option>

                                    </select>';
            })->addColumn('action', function ($merchant) {

                return '<a href="' . url(admin_vw() . '/admin/' . $merchant->id . '/edit') . '" class="btn btn-circle btn-icon-only purple edit-merchant-mdl">
                                        <i class="fa fa-edit"></i>
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
        // TODO: Implement create() method.
        $admin = new Admin();
        $admin->name = $attributes['name'];
        $admin->username = $attributes['username'];
        $admin->mobile = $attributes['mobile'];
        $admin->email = $attributes['email'];
        $admin->password = bcrypt($attributes['password']);//bcrypt($attributes['password']);
        $admin->level = 'admin';//$attributes['level'];

        if ($admin->save()) {
            if (isset($attributes['logo'])) {
                $admin->logo = $this->storeImageThumb('admins', $admin->id, $attributes['logo']);
                $admin->save();


            }
            $this->sendResetPasswordEmail($attributes);
            $admin = $this->model->find($admin->id);
//            $this->reset_password($admin);

            if ($admin->level == 'admin') {
                // user has one roles in my case
                if (count($admin->roles) > 0) {
                    $admin->detachRoles($admin->roles);
                }

                foreach ($attributes['role'] as $role)
                    $admin->attachRole($role);
            }


            return response_api(true, 200, trans('app.created') . ', Tell ' . $admin->username . ' to check his email to reset password', $admin);

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

//    function reset_password(Admin $admin)
//    {
//        $token = str_random(60);
//        //create a new token to be sent to the user.
//        DB::table('admin_password_resets')->insert([
//            'email' => \request()->get('email'),
//            'token' => bcrypt($token), //change 60 to any length you want
//            'created_at' => Carbon::now()
//        ]);
////
////        $tokenData = DB::table('admin_password_resets')
////            ->where('email', \request()->get('email'))->first();
//
////        $email = \request()->get('email');
//        $admin->sendPasswordResetNotification($token);

//    }

    function update(array $attributes, $id = null)
    {
        // TODO: Implement update() method.

        $admin = $this->model->find($id);

        if (isset($attributes['name']))
            $admin->name = $attributes['name'];
        if (isset($attributes['username']))
            $admin->username = $attributes['username'];
        if (isset($attributes['mobile'])){
            $attributes['mobile'] = preg_replace("/^0/" , "+966" ,$attributes['mobile']);
            $attributes['mobile'] = preg_replace("/^966/" , "+966" ,$attributes['mobile']);
            $attributes['mobile'] = preg_replace("/^00966/" , "+966" ,$attributes['mobile']);
            $admin->mobile = $attributes['mobile'];
        }
        if (isset($attributes['email']))
            $admin->email = $attributes['email'];
        if (isset($attributes['password']))
            $admin->password = bcrypt($attributes['password']);
        if (isset($attributes['level']))
            $admin->level = $attributes['level'];

        if ($admin->save()) {

            if (isset($attributes['logo'])) {
                $admin->logo = $this->storeImageThumb('admins', $admin->id, $attributes['logo']);
                $admin->save();
            }
//            if ($admin->level == 'admin') {
            // user has one roles in my case
            if (count($admin->roles) > 0) {
                $admin->detachRoles($admin->roles);
            }
            if (isset($attributes['role']))
                foreach ($attributes['role'] as $role)
                    $admin->attachRole($role);
//            }
            return response_api(true, 200, trans('app.updated'), $admin);

        }
        return response_api(false, 422, trans('app.not_updated'));
    }

    function editAdminProfile(array $attributes)
    {
        // TODO: Implement update() method.

        $admin = $this->model->find(auth()->guard('admin')->user()->id);

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

    function merchantActive($id)
    {

        $merchant = $this->model->where('type', 'merchant')->find($id['merchant_id']);

        if (isset($merchant)) {
            $merchant->status = !$merchant->status;

            if ($merchant->save()) {
                if (!$merchant->status) {
                    $action = 'user_deactivate';
//                    $this->notificationSystem->sendNotification(null, $user->id, $user->id, $action);
                    $this->logout($merchant->id);
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


    function count()
    {
        return $this->model->count();
    }


}
