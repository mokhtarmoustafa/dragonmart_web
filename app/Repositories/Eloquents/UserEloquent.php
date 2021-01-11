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
use App\Mail\VerifyMail;
use App\MerchantBank;
use App\MerchantDeliveryMethod;
use App\Product;
use App\ProviderCategory;
use App\Repositories\Interfaces\UserRepository;
use App\Repositories\Uploader;
use App\Service;
use App\ServiceProviderCategory;
use App\ShipmentCost;
use App\Store;
use App\StoreCategory;
use App\StoreDriver;
use App\User;
use App\Vehicle;
use App\VerifyUser;
use Carbon\Carbon;
use DB;
use Excel;
use Hash;
use Mobily;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Lcobucci\JWT\Parser;
use Mail;
use Snowfire\Beautymail\Beautymail;
use App\ProductCategory;
use App\Adv;
use App\StoreImage;

class UserEloquent extends Uploader implements UserRepository
{

    private $model, $deviceToken, $notificationSystem;

    public $appends = [];

    public function __construct(User $model, DeviceToken $deviceToken, NotificationSystemEloquent $notificationSystemEloquent)
    {
        $this->model = $model;
        $this->deviceToken = $deviceToken;
        $this->notificationSystem = $notificationSystemEloquent;

        $this->appends = $model->appends;
    }

    // generate access token
    public function access_token()
    {

        if (\request()->get('grant_type') == 'password') {
            if (!\request()->filled('email')) {
                return response_api(false, 422, null, []);
            }
            \request()->request->add(['username' => \request()->get('email')]);
        }

        $proxy = Request::create(
            'oauth/token',
            'POST'
        );


        $response = Route::dispatch($proxy);

        $token_obj = json_decode($response->getContent());

        $statusCode = json_decode($response->getStatusCode());
        // return [
        //         'status' => false,
        //         'statusCode' => 422,
        //         'message' => $response->getContent()." dsfsd",
        //         'items' => []
        //     ];
        if (isset($token_obj->error)) {
            return [
                'status' => false,
                'statusCode' => $statusCode,
                'message' => $token_obj->message,
                'items' => []
            ];
        }

        if (!isset($token_obj->access_token))
            return [
                'status' => false,
                'statusCode' => 422,
                'message' => 'error',
                'items' => []
            ];
        \request()->headers->set('Authorization', 'Bearer ' . $token_obj->access_token);
        //$login
        $request = \request()->create(
            'api/v1/profile/login',
            'GET'
        );
        //

        $response = Route::dispatch($request);

        $data = json_decode($response->getContent());
        $statusCode = json_decode($response->getStatusCode());

        if ($statusCode == 200) {
            $user = $data->items;
            //
        }

        $token = new \stdClass();
        if (!isset($user)) {
            return response_api(false, 422, trans('auth.failed'), []);
        }

        if (\request()->has('app_type')) {
            if (\request()->get('app_type') == 'driver' && $user->type != 'driver')
                return response_api(false, 422, 'This app for drivers only', []);
        } else {
            if ($user->type == 'driver') {
                return response_api(false, 422, trans('auth.failed'), []);
            }
        }



        $user = $this->model->find($user->id)->makeHidden(['merchant_categories', 'merchant_products', 'store_images', 'order_bought', 'order_pending', 'order_canceled', 'shipments']);


        if (!$user->is_confirm_code && $user->type != 'merchant') {
            $confirm_code = rand(1000, 9999);
            $user->verification_code = $confirm_code;

            if ($user->save()) {
                Mobily::send($user['mobile'], 'Code: ' . $confirm_code);
            }
            return [
                'status' => false, // to go to verification code
                'statusCode' => 405,
                'message' => trans('app.not_verification_code'),
                'items' => ['token' => $token, 'user' => $user]
            ];
        }
        //        if (!$user->is_active && $user->type != 'merchant')
        //            return response_api(false, 407, trans('app.not_approval'), ['token' => $token, 'user' => $user]);

        $token = new \stdClass();
        //
        $token->token_type = $token_obj->token_type;
        $token->expires_in = $token_obj->expires_in;
        $token->access_token = $token_obj->access_token;
        $token->refresh_token = $token_obj->refresh_token;


        if (\request()->filled('device_type')) {
            $device = $this->deviceToken->where('user_id', $user->id)->where('device_id', \request()->get('device_id'))->first();

            if (!isset($device))
                // register device token
                $device = new DeviceToken();
            $device->user_id = $user->id;

            if (\request()->filled('device_id'))
                $device->device_id = \request()->get('device_id');
            $device->device_token = \request()->get('device_token');
            $device->type = \request()->get('device_type');
            $device->status = 'on';

            $device->save();
        }

        if (\request()->has('lang')) {
            $user->lang = \request()->get('lang');
            $user->save();
        }

        $user['Branches'] = Store::where('merchant_id', $user->id)->get();
        $user['address'] = DB::table('user_address')->where('user_id', $user->id)->get();

        return [
            'status' => true,
            'statusCode' => 200,
            'message' => trans('app.success'),
            'items' => ['token' => $token, 'user' => $user]
        ];
    }

    // generate refresh token
    public function refresh_token()
    {

        $proxy = Request::create(
            'oauth/token',
            'POST'
        );

        $response = Route::dispatch($proxy);
        $token_obj = json_decode($response->getContent());
        $statusCode = json_decode($response->getStatusCode());

        if (isset($token_obj->error)) {
            return [
                'status' => false,
                'statusCode' => $statusCode,
                'message' => $token_obj->message,
                'items' => []
            ];
        }

        \request()->headers->set('Accept', 'application/json');
        \request()->headers->set('Authorization', 'Bearer ' . $token_obj->access_token);
        //
        $request = \request()->create(
            'api/v1/profile',
            'GET'
        );
        //
        $token = new \stdClass();
        //
        $token->token_type = $token_obj->token_type;
        $token->expires_in = $token_obj->expires_in;
        $token->access_token = $token_obj->access_token;
        $token->refresh_token = $token_obj->refresh_token;

        $response = Route::dispatch($request);

        $data = json_decode($response->getContent());
        $statusCode = json_decode($response->getStatusCode());

        if ($statusCode == 200) {
            $user = $data->items;
        }

        return [
            'status' => true,
            'statusCode' => 200,
            'message' => trans('app.success'),
            'items' => [
                'token' => $token, 'user' => $user
            ]
        ];
    }

    // for cpanel
    function merchantDriverData($merchant_id)
    {
        $currentUser = auth()->guard('admin')->user()->find($merchant_id);

        $drivers = [];
        if (isset($currentUser->store))
            $drivers = StoreDriver::where('store_id', $currentUser->store->id)->pluck('driver_id');
        $users = $this->model->where('type', 'driver')->whereIn('id', $drivers)->orderByDesc('created_at');

        return datatables()->of($users)
            ->filter(function ($query) {


                if (request()->filled('username')) {
                    $query->where('username', 'LIKE', '%' . request()->get('username') . '%');
                }

                if (request()->filled('email')) {
                    $query->where('email', 'LIKE', '%' . request()->get('email') . '%');
                }

                if (request()->filled('mobile')) {
                    $query->where('mobile', 'LIKE', '%' . request()->get('mobile') . '%');
                }

                if (request()->filled('type')) {
                    $query->where('type', request()->get('type'));
                }
                if (request()->filled('is_active')) {
                    $query->where('is_active', request()->get('is_active'));
                }
            })
            ->editColumn('image', function ($user) {
                if (isset($user->image))
                    return '<img src="' . $user->image100 . '" width="50px" class="img-circle">';
                return '<img src="' . url('assets/apps/img/man.svg') . '" width="50px" class="img-circle">';
            })
            ->editColumn('email_verified_at', function ($user) {
                $active = '';
                $not_active = 'selected';
                if (isset($user->email_verified_at)) {
                    $active = 'selected';
                    $not_active = '';
                }
                return '<select class="form-control input-md is_email_verified" data-id="' . $user->id . '" name="is_verified">
                                        <option value="1" ' . $active . '>Verified</option>
                                        <option value="0" ' . $not_active . '>Unverified</option>

                                    </select>';
            })
            ->editColumn('is_confirm_code', function ($user) {

                return ($user->is_confirm_code) ? '<span class="label label-success">Confirmed</span>' : '<span class="label label-danger">Unconfirmed</span>';
            })->editColumn('is_active', function ($user) {

                if ($user->is_active) {
                    return '<span class="label label-sm label-success">Active</span>';
                }

                return '<span class="label label-sm label-warning"> Disable</span>';
                //                $active = '';
                //                $not_active = 'selected';
                //                if ($user->is_active) {
                //                    $active = 'selected';
                //                    $not_active = '';
                //                }
                //                return '<select class="form-control input-md status" data-id="' . $user->id . '" name="status">
                //                                        <option value="0" ' . $not_active . '>Disable</option>
                //                                        <option value="1" ' . $active . '>Active</option>
                //
                //                                    </select>';
            })->addColumn('action', function ($user) use ($currentUser) {

                if (!$user->is_active) {
                    $color = "green";
                    $title = "Activate user";
                    $icon = "check";
                } else {
                    $color = "red";
                    $title = "Suspend user";
                    $icon = "power-off";
                }
                if ($currentUser->type == 'merchant') {
                    return '<a href="' . url(merchant_vw() . '/user/' . $user->id) . '" class="btn btn-circle btn-icon-only blue user-det" title="Address">
                                        <i class="fa fa-map"></i>
                                    </a><a href="' . url(admin_user_tab_url() . '/user-det/' . $user->id) . '" class="btn btn-circle btn-icon-only purple" title="View">
                                        <i class="fa fa-eye"></i>
                                    </a>';
                } else {
                    return '<a href="' . url(admin_user_tab_url() . '/user/' . $user->id) . '" class="btn btn-circle btn-icon-only blue user-det" title="Address">
                                        <i class="fa fa-map"></i>
                                    </a><a href="' . url(admin_user_tab_url() . '/user-det/' . $user->id) . '" class="btn btn-circle btn-icon-only purple" title="View">
                                        <i class="fa fa-eye"></i>
                                    </a><a href="javascript:;" class="btn btn-circle btn-icon-only ' . $color . ' set_active" data-id="' . $user->id . '" title="' . $title . '">
                                        <i class="fa fa-' . $icon . '"></i>
                                    </a>';
                }
            })->addIndexColumn()
            ->rawColumns(['image', 'email_verified_at', 'is_confirm_code', 'is_active', 'action'])->toJson();
    }

    function userData()
    {
        $currentUser = auth()->guard('admin')->user();

        if ($currentUser->type == 'merchant') {
            $drivers = [];
            if (isset($currentUser->store))
                $drivers = StoreDriver::where('store_id', $currentUser->store->id)->pluck('driver_id');
            $users = $this->model->where('type', 'driver')->whereIn('id', $drivers)->orderByDesc('created_at');
        } else
            $users = $this->model->where('type', 'client')->orderByDesc('created_at');

        return datatables()->of($users)
            ->filter(function ($query) {


                if (request()->filled('username')) {
                    $query->where('username', 'LIKE', '%' . request()->get('username') . '%');
                }

                if (request()->filled('email')) {
                    $query->where('email', 'LIKE', '%' . request()->get('email') . '%');
                }

                if (request()->filled('mobile')) {
                    $query->where('mobile', 'LIKE', '%' . request()->get('mobile') . '%');
                }

                if (request()->filled('type')) {
                    $query->where('type', request()->get('type'));
                }
                if (request()->filled('is_active')) {
                    $query->where('is_active', request()->get('is_active'));
                }
            })
            ->editColumn('image', function ($user) {
                if (isset($user->image))
                    return '<img src="' . $user->image100 . '" width="50px" class="img-circle">';
                return '<img src="' . url('assets/apps/img/man.svg') . '" width="50px" class="img-circle">';
            })
            ->editColumn('email_verified_at', function ($user) {
                $active = '';
                $not_active = 'selected';
                if (isset($user->email_verified_at)) {
                    $active = 'selected';
                    $not_active = '';
                }
                return '<select class="form-control input-md is_email_verified" data-id="' . $user->id . '" name="is_verified">
                                        <option value="1" ' . $active . '>Verified</option>
                                        <option value="0" ' . $not_active . '>Unverified</option>

                                    </select>';
            })
            ->editColumn('is_confirm_code', function ($user) {

                return ($user->is_confirm_code) ? '<span class="label label-success">Confirmed</span>' : '<span class="label label-danger">Unconfirmed</span>';
            })->editColumn('is_active', function ($user) {

                if ($user->is_active) {
                    return '<span class="label label-inline label-sm label-success">Active</span>';
                }

                return '<span class="label label-inline label-sm label-warning"> Disable</span>';
                //                $active = '';
                //                $not_active = 'selected';
                //                if ($user->is_active) {
                //                    $active = 'selected';
                //                    $not_active = '';
                //                }
                //                return '<select class="form-control input-md status" data-id="' . $user->id . '" name="status">
                //                                        <option value="0" ' . $not_active . '>Disable</option>
                //                                        <option value="1" ' . $active . '>Active</option>
                //
                //                                    </select>';
            })->addColumn('action', function ($user) use ($currentUser) {

                if (!$user->is_active) {
                    $color = "green";
                    $title = "Activate user";
                    $icon = "check";
                } else {
                    $color = "red";
                    $title = "Suspend user";
                    $icon = "power-off";
                }
                if ($currentUser->type == 'merchant') {
                    return '<a href="' . url(merchant_vw() . '/user/' . $user->id) . '" class="btn btn-circle btn-icon-only blue user-det" title="Address">
                                        <i class="fa fa-map"></i>
                                    </a><a href="' . url(merchant_vw() . '/user-det/' . $user->id) . '" class="btn btn-circle btn-icon-only purple" title="View">
                                        <i class="fa fa-eye"></i>
                                    </a>';
                } else {
                    return '<a href="' . url(admin_user_tab_url() . '/user/' . $user->id) . '" class="btn btn-circle btn-icon-only blue user-det" title="Address">
                                        <i class="fa fa-map"></i>
                                    </a><a href="' . url(admin_user_tab_url() . '/user-det/' . $user->id) . '" class="btn btn-circle btn-icon-only purple" title="View">
                                        <i class="fa fa-eye"></i>
                                    </a><a href="javascript:;" class="btn btn-circle btn-icon-only ' . $color . ' set_active" data-id="' . $user->id . '" title="' . $title . '">
                                        <i class="fa fa-' . $icon . '"></i>
                                    </a>';
                }
            })->addIndexColumn()
            ->rawColumns(['image', 'email_verified_at', 'is_confirm_code', 'is_active', 'action'])->toJson();
    }

    function driverData()
    {
        $currentUser = auth()->guard('admin')->user();

        if ($currentUser->type == 'merchant' || \request()->has('merchant_id')) {
            // $drivers = [];
            if (\request()->has('merchant_id')) {
                $drivers = StoreDriver::where('merchant_id', \request()->get('merchant_id'))->pluck('driver_id');
            } else
                $drivers = StoreDriver::where('merchant_id', $currentUser->user_id)->pluck('driver_id');

            $users = $this->model->with('Vehicle')->where('type', 'driver')->whereIn('id', $drivers)->orderByDesc('created_at');
        } else
            $users = $this->model->with('Vehicle')->where('type', 'driver')->orderBy('job_id', 'asc');

        return datatables()->of($users)
            ->filter(function ($query) use ($currentUser) {

                if (request()->filled('username')) {
                    $query->where('username', 'LIKE', '%' . request()->get('username') . '%');
                }

                if (request()->filled('email')) {
                    $query->where('email', 'LIKE', '%' . request()->get('email') . '%');
                }

                if (request()->filled('mobile')) {
                    $query->where('mobile', 'LIKE', '%' . request()->get('mobile') . '%');
                }

                if (request()->filled('type')) {
                    $query->where('type', request()->get('type'));
                }
                if (request()->filled('is_active')) {
                    $query->where('is_active', request()->get('is_active'));
                }
                if (request()->filled('driver_type_id') && $currentUser->type == 'merchant') {
                    $query->where('driver_type_id', request()->get('driver_type_id'));
                }
            })->editColumn('image', function ($user) {
                if (isset($user->image))
                    return '<img src="' . $user->image100 . '" width="50px" class="img-circle">';
                return '<img src="' . url('assets/apps/img/man.svg') . '" width="50px" class="img-circle">';
            })->addColumn('driver_name', function ($user) {
                return '<a href="' . url(((getAuth()->type == 'admin') ? admin_user_tab_url() : getAuth()->type) . '/user-det/' . $user->id) . '">' . $user->username . '</a>';
            })->editColumn('job_id', function ($user) {
                if (isset($user->job_id)) {

                    $chars = 7;
                    $job_id = '';

                    for ($i = 0; $i < $chars - strlen($user->job_id); $i++) {
                        $job_id = $job_id . '0';
                    }

                    return $job_id . '<p class="d-inline font-weight-boldest">' . $user->job_id . '</p>';
                }
                return null;
            })->editColumn('mobile', function ($user) {
                if (isset($user->mobile))
                    return '<span dir="ltr">' . $user->mobile . '</span>';
                return '<img src="' . url('assets/apps/img/man.svg') . '" width="50px" class="img-circle">';
            })->addColumn('driver_type', function ($user) {

                return (isset($user->driver_type_id)) ? $user->driver_type->name : '';
            })->addColumn('car_type', function ($user) {

                return (isset($user->vehicle->car_type)) ? $user->vehicle->car_type->title : '';
            })->addColumn('vehicle_color', function ($user) {

                return (isset($user->vehicle)) ? $user->vehicle->color : '';
            })->addColumn('vehicle_number', function ($user) {

                return (isset($user->vehicle)) ? $user->vehicle->no : '';
            })->editColumn('is_active', function ($user) {
                return $user->is_active;
            })->addColumn('action', function ($user) use ($currentUser) {

                if (!$user->is_active) {
                    $color = "green";
                    $title = "Activate user";
                    $icon = "check";
                } else {
                    $color = "red";
                    $title = "Suspend user";
                    $icon = "power-off";
                }
                $edit = '';
                $activation = '<a href="javascript:;" class="btn btn-circle btn-icon-only ' . $color . ' set_active" data-id="' . $user->id . '" title="' . $title . '">
                                        <i class="fa fa-' . $icon . '"></i>
                                    </a>';
                if ($currentUser->type == 'merchant') {
                    if ($user->driver_type_id == 3) {
                        $edit = '<a href="' . url(((getAuth()->type == 'admin') ? admin_user_tab_url() : getAuth()->type) . '/user-driver/' . $user->id . '/edit') . '" class="btn btn-circle btn-icon-only blue edit-driver-info-mdl" title="Edit driver">
                                        <i class="fa fa-edit"></i>';
                    }
                    return '<a href="' . url(merchant_vw() . '/user/' . $user->id) . '" class="btn btn-circle btn-icon-only blue user-det" title="Address">
                                        <i class="fa fa-map"></i>
                                    </a>
                                    <a href="' . url(merchant_vw() . '/user-det/' . $user->id) . '" class="btn btn-circle btn-icon-only purple" title="View">
                                        <i class="fa fa-eye"></i>
                                    </a>' . $activation . $edit;
                } else {

                    if ($user->driver_type_id == 1) {
                        $edit = '<a href="' . url(((getAuth()->type == 'admin') ? admin_user_tab_url() : getAuth()->type) . '/user-driver/' . $user->id . '/edit') . '" class="btn btn-circle btn-icon-only blue edit-driver-info-mdl" title="Edit driver">
                                        <i class="fa fa-edit"></i>';
                    }
                    return '<a href="' . url(admin_user_tab_url() . '/user/' . $user->id) . '" class="btn btn-circle btn-icon-only blue user-det" title="Address">
                                        <i class="fa fa-map"></i>
                                    </a><a href="' . url(admin_user_tab_url() . '/user-det/' . $user->id) . '" class="btn btn-circle btn-icon-only purple" title="View">
                                        <i class="fa fa-eye"></i>
                                    </a>' . $activation . $edit;
                }
            })->addIndexColumn()
            ->rawColumns(['driver_name', 'image', 'job_id', 'mobile', 'email_verified_at', 'is_confirm_code', 'is_active', 'action'])->toJson();
    }

    function serviceProviderData()
    {
        $currentUser = auth()->guard('admin')->user();

        $users = $this->model->where('type', 'service_provider')->orderByDesc('created_at');
        return datatables()->of($users)
            ->filter(function ($query) {


                if (request()->filled('username')) {
                    $query->where('username', 'LIKE', '%' . request()->get('username') . '%');
                }

                if (request()->filled('email')) {
                    $query->where('email', 'LIKE', '%' . request()->get('email') . '%');
                }

                if (request()->filled('mobile')) {
                    $query->where('mobile', 'LIKE', '%' . request()->get('mobile') . '%');
                }

                if (request()->filled('is_active')) {
                    $query->where('is_active', request()->get('is_active'));
                }
            })
            ->editColumn('image', function ($user) {
                if (isset($user->image))
                    return '<img src="' . $user->image100 . '" width="50px" class="img-circle">';
                return '<img src="' . url('assets/apps/img/man.svg') . '" width="50px" class="img-circle">';
            })
            ->editColumn('email_verified_at', function ($user) {
                $active = '';
                $not_active = 'selected';
                if (isset($user->email_verified_at)) {
                    $active = 'selected';
                    $not_active = '';
                }
                return '<select class="form-control input-md is_email_verified" data-id="' . $user->id . '" name="is_verified">
                                        <option value="1" ' . $active . '>Verified</option>
                                        <option value="0" ' . $not_active . '>Unverified</option>

                                    </select>';
            })
            ->editColumn('is_confirm_code', function ($user) {

                return ($user->is_confirm_code) ? '<span class="label label-inline label-success">Confirmed</span>' : '<span class="label label-inline label-danger">Unconfirmed</span>';
            })->addColumn('city', function ($user) {

                return (isset($user->city_id)) ? $user->city->name_en : '';
            })->editColumn('is_active', function ($user) {

                if ($user->is_active) {
                    return '<span class="label label-inline label-sm label-success">Active</span>';
                }

                return '<span class="label label-inline label-sm label-warning"> Disable</span>';
            })->addColumn('action', function ($user) use ($currentUser) {

                if (!$user->is_active) {
                    $color = "green";
                    $title = "Activate user";
                    $icon = "check";
                } else {
                    $color = "red";
                    $title = "Suspend user";
                    $icon = "power-off";
                }
                //                <a href="' . url(admin_vw() . '/user-det/' . $user->id) . '" class="btn btn-circle btn-icon-only purple" title="View">
                //                                        <i class="fa fa-eye"></i>
                //                                    </a>

                return '<a href="' . url(admin_user_tab_url() . '/user/' . $user->id) . '" class="btn btn-circle btn-icon-only blue user-det" title="Address">
                                        <i class="fa fa-map"></i>
                                    </a><a href="javascript:;" class="btn btn-circle btn-icon-only ' . $color . ' set_active" data-id="' . $user->id . '" title="' . $title . '">
                                        <i class="fa fa-' . $icon . '"></i>
                                    </a>';
            })->addIndexColumn()
            ->rawColumns(['image', 'email_verified_at', 'is_confirm_code', 'is_active', 'action'])->toJson();
    }

    function merchantData()
    {
        $currentUser = auth()->guard('admin')->user();

        if ($currentUser->type == 'merchant') {
            $drivers = [];
            if (isset($currentUser->store))
                $drivers = StoreDriver::where('store_id', $currentUser->store->id)->pluck('driver_id');
            $users = $this->model->where('type', 'driver')->whereIn('id', $drivers)->orderByDesc('created_at');
        } else
            $users = $this->model->where('type', 'merchant')->orderByDesc('created_at');
        return datatables()->of($users)
            ->filter(function ($query) {


                if (request()->filled('username')) {
                    $query->where('username', 'LIKE', '%' . request()->get('username') . '%');
                }

                if (request()->filled('email')) {
                    $query->where('email', 'LIKE', '%' . request()->get('email') . '%');
                }

                if (request()->filled('mobile')) {
                    $query->where('mobile', 'LIKE', '%' . request()->get('mobile') . '%');
                }

                if (request()->filled('type')) {
                    $query->where('type', request()->get('type'));
                }
                if (request()->filled('is_active')) {
                    $query->where('is_active', request()->get('is_active'));
                }
            })
            ->editColumn('image', function ($user) {
                if (count($user->store_images) > 0)
                    return '<img src="' . $user->store_images[0]->image100 . '" width="50px" class="img-circle">';
                return '<img src="' . url('assets/apps/img/shop.png') . '" width="50px" class="img-circle">';
            })
            ->editColumn('email_verified_at', function ($user) {
                $active = '';
                $not_active = 'selected';
                if (isset($user->email_verified_at)) {
                    $active = 'selected';
                    $not_active = '';
                }
                return '<select class="form-control input-md is_email_verified" data-id="' . $user->id . '" name="is_verified">
                                        <option value="1" ' . $active . '>Verified</option>
                                        <option value="0" ' . $not_active . '>Unverified</option>

                                    </select>';
            })
            ->editColumn('is_confirm_code', function ($user) {

                return ($user->is_confirm_code) ? '<span class="label label-success">Confirmed</span>' : '<span class="label label-danger">Unconfirmed</span>';
            })->editColumn('city.name_en', function ($user) {

                return (isset($user->city)) ? $user->city->name_en : '';
            })->editColumn('is_active', function ($user) {

                if ($user->is_active) {
                    return '<span class="label label-sm label-inline label-success">Active</span>';
                }

                return '<span class="label label-sm label-inline label-warning"> Disable</span>';
                //                $active = '';
                //                $not_active = 'selected';
                //                if ($user->is_active) {
                //                    $active = 'selected';
                //                    $not_active = '';
                //                }
                //                return '<select class="form-control input-md status" data-id="' . $user->id . '" name="status">
                //                                        <option value="0" ' . $not_active . '>Disable</option>
                //                                        <option value="1" ' . $active . '>Active</option>
                //
                //                                    </select>';
            })->addColumn('action', function ($user) use ($currentUser) {

                if (!$user->is_active) {
                    $color = "green";
                    $title = "Activate user";
                    $icon = "check";
                } else {
                    $color = "red";
                    $title = "Suspend user";
                    $icon = "power-off";
                }
                if ($currentUser->type == 'merchant') {
                    return '<a href="' . url(merchant_vw() . '/user/' . $user->id) . '" class="btn btn-circle btn-icon-only blue user-det" title="Address">
                                        <i class="fa fa-map"></i>
                                    </a>
                                    <a href="' . url(admin_user_tab_url() . '/user-det/' . $user->id) . '" class="btn btn-circle btn-icon-only purple" title="View">
                                        <i class="fa fa-eye"></i>
                                    </a>';
                } else {
                    return '<a href="' . url(admin_user_tab_url() . '/user/' . $user->id) . '" class="btn btn-circle btn-icon-only blue user-det" title="Address">
                                        <i class="fa fa-map"></i>
                                    </a><a href="' . url(admin_user_tab_url() . '/user-det/' . $user->id) . '" class="btn btn-circle btn-icon-only purple" title="View">
                                        <i class="fa fa-eye"></i>
                                    </a><a href="javascript:;" class="btn btn-circle btn-icon-only ' . $color . ' set_active" data-id="' . $user->id . '" title="' . $title . '">
                                        <i class="fa fa-' . $icon . '"></i>
                                    </a><a href="' . url('/') . '/site/store/' . $user->id . '" target="_blank" class="btn btn-circle btn-icon-only purple" title="Menu">
                                        <i class="flaticon-grid-menu"></i>
                                    </a>';
                }
            })->addIndexColumn()
            ->rawColumns(['image', 'email_verified_at', 'is_confirm_code', 'is_active', 'action'])->toJson();
    }

    function merchantShipmentData($merchant_id)
    {
        //
        $merchant = $this->model->find($merchant_id);
        $delivery_method = $merchant->MerchantDriverType->pluck('id')->toArray();

        if (in_array(3, $delivery_method) == true) {
            $shipments = ShipmentCost::where('merchant_id', $merchant_id)->orderBy('from', 'ASC');
        } else {
            $shipments = ShipmentCost::where('type', 'admin')->orderBy('from', 'ASC');
        }

        return datatables()->of($shipments)
            ->filter(function ($query) {
            })
            ->addColumn('from_to', function ($shipment) {
                return $shipment->from . ' - ' . $shipment->to;
            })->addIndexColumn()->toJson();
    }

    function merchantCategoryData($merchant_id)
    {
        $categories = StoreCategory::with('Category')->where('merchant_id', $merchant_id)->orderByDesc('created_at');
        return datatables()->of($categories)
            ->filter(function ($query) {
            })
            ->addColumn('action', function ($category) {
                return '<a href="' . url(admin_user_tab_url() . '/merchant-category/' . $category->id) . '" class="btn btn-circle btn-icon-only red delete-merchant-category" title="Delete">
                                        <i class="fa fa-times"></i>
                                    </a>';
            })->addIndexColumn()
            ->rawColumns(['action'])->toJson();
    }

    function userActive($id)
    {

        $user = $this->model->find($id['user_id']);

        if (isset($user)) {
            $user->is_active = !$user->is_active;

            if ($user->save()) {

                if ($user->type == 'merchant') {
                    $merchant_admin = Admin::where('type', 'merchant')->where('user_id', $user->id)->first();
                    $merchant_admin->status = !$merchant_admin->status;
                    $merchant_admin->save();
                }
                if (!$user->is_active) {
                    //                    $this->notificationSystem->sendNotification(null, $user->id, $user->id, 'user_disabled');
                    //                    $this->logout($user->id);
                    return response_api(true, 200, null, $user);
                }

                //                $this->notificationSystem->sendNotification(null, $user->id, $user->id, 'user_approved');

                return response_api(true, 200, null, $user);
            }
        }
        return response_api(false, 422);
    }

    function verifyEmail($id)
    {

        $user = $this->model->find($id['user_id']);

        if (isset($user)) {

            if (!isset($user->email_verified_at))
                $user->email_verified_at = Carbon::now();
            else
                $user->email_verified_at = null;

            if ($user->save()) {
                return response_api(true, 200);
            }
        }
        return response_api(false, 422);
    }

    // get all users
    function getAll(array $attributes)
    {
        // TODO: Implement getAll() method.
        return $this->model->all();
    }

    // get user by email
    function getByEmail($email)
    {
        // TODO: Implement getAll() method.
        return $this->model->where('email', $email)->first();
    }

    //user profile view
    function getById($id)
    {

        if ($id == "login") {

            $login = true;
            $id = auth()->user()->id;
        } else {
            $login = false;
            $id = (!isset($id) && auth()->check()) ? auth()->user()->id : $id;
        }


        // TODO: Implement getById() method.



        if (\request()->segment(1) == 'api') {
            $user = $this->model->where('id', $id)->first(['id', 'username', 'mobile', 'image', 'type', 'is_driver_available', 'lang', 'city_id']);
            
        } else {
            $user = $this->model->find($id);
        }


        // $Cats =  ProductCategory::where('product_categories.store_id',  $id)
        //          ->whereNull('products.deleted_at')
        //          ->select(['product_categories.id', 'product_categories.name' , 'product_categories.name_ar'])
        //          ->join('products', 'products.category_id', '=', 'product_categories.id')
        //          ->orderByRaw('-order_by DESC')
        //          ->orderByDesc('product_categories.created_at')->get();

        if ($user['type'] == "merchant") {

            $user->makeHidden(['address', 'service_rate', 'count_pending_request', 'count_accepted_request', 'count_rejected_request', 'count_finished_request',
                                'services', 'image100', 'image300', 'vehicle', 'count_order_sent', 'count_product_sent', 'total_revenue', 'order_bought', 'order_pending',
                                'order_canceled', 'count_available_orders']);

            $user['stores'] = $user->Stores->makeHidden(['merchant_id', 'description', 'open_times', 'close_times', 'state_times', 'deleted_at', 'created_at', 'updated_at', 'categories']);
            //get Categories
            // get all of the category for the merchant
            // $Cats =  ProductCategory::where('store_id',  $id)
            //     ->whereNull('deleted_at')
            //     ->select(['id', 'name', 'name_ar'])
            //     ->orderByRaw('-order_by DESC')
            //     ->orderByDesc('created_at')->get();
            
            $user['product_categories'] = $user->ProductCategories->makeHidden(['reference_id', 'order_by', 'description', 'icon', 'store_id', 'parent_id', 'deleted_at', 'created_at', 'updated_at', 'icon32']);
            
            // $remove_cat  = array();
            // if (!$login) {
                // for ($i = 0; $i < count($Cats); $i++) {
                //     $Cat = json_decode(json_encode($Cats[$i]), true);
                //     $Product = Product::whereNull('deleted_at')->where('category_id',  $Cats[$i]['id'])->orderByDesc('created_at')->get(['id', 'name', 'price', 'available_quantity', 'merchant_id']);
                //     if (count($Product) > 0) {
                //         $Cats[$i]['Products'] = $Product;
                //     } else {
                //         $Cats[$i]['Products'] = array();
                //     }
                // }

            // }
            // End get Categories

            // $user['adv'] = Adv::where('merchant_id', $id)->orderByDesc('created_at')->get();

            $user['advertisements'] = $user->Advertisements->where('status', 1)->makeHidden(['merchant_id', 'status', 'deleted_at', 'created_at', 'updated_at', 'image100', 'image300', 'merchant']);

            // $dayname = gmdate("l", strtotime('+ 3 hour'));
            // $dayBeforename = gmdate("l", strtotime('-1 day + 3 hour'));


            // $Branches = Store::where('merchant_id', $user->id)->whereNotNull('open_times')->get();

            // $BranchesArray =  array();

            // $dayBefore = gmdate("d h:i a", strtotime('-1 day + 3 hour'));

            // foreach ($Branches as $Branche) {
            //     $day = gmdate("Y-m-d h:i a", strtotime('+ 3 hour'));
            //     $dayHOR = gmdate("h", strtotime('+ 3 hour'));
            //     $dayPER = gmdate("a", strtotime('+ 3 hour'));
            //     $Branche['close_times'] = json_decode($Branche['close_times'], true);
            //     $Branche['open_times'] = json_decode($Branche['open_times'], true);
            //     $Branche['state_times'] = json_decode($Branche['state_times'], true);

            //     $PER = date("a", strtotime($Branche['close_times'][$dayBeforename]));
            //     $hor = date("h", strtotime($Branche['close_times'][$dayBeforename]));
            //     $CTB = date("Y-m-d h:i a", ($PER == "am" && $hor == "12") || $PER == "pm" ? strtotime($Branche['close_times'][$dayname]) : strtotime($Branche['close_times'][$dayBeforename]));
            //     $CTB = date("Y-m-d h:i a", ($PER == "am" && $hor == "12") || $PER == "pm" ? strtotime($CTB) : strtotime('-1 day', strtotime($CTB)));

            //     $CT = strtotime($Branche['close_times'][$dayname]);
            //     $DDay = ($PER == "am" && $hor == "12") || $PER == "pm" ? $dayname :  $dayBeforename;

            //     if ($Branche['state_times'][$DDay] == 1) {
            //         $close_times = date("Y-m-d h:i a", strtotime($Branche['close_times'][$DDay]));
            //         $close_times = date("Y-m-d h:i a", ($PER == "am" && $hor == "12") || $PER == "pm" ? strtotime('+1 day',  strtotime($close_times)) : strtotime('-1 day', strtotime($close_times)));
            //         $open_times = date("Y-m-d h:i a", strtotime($Branche['open_times'][$dayname]));
            //         $open_times = strtotime($open_times);
            //         $cc = strtotime($close_times);
            //         $day = strtotime($day);

            //         if ($DDay == $dayBeforename) {
            //             if ($dayPER == "am" && $dayHOR < "12") {
            //                 $cc = date("Y-m-d h:i a", strtotime('+1 day', strtotime($close_times)));
            //             } else if ($dayPER == "pm" &&  $dayHOR <= "12") {
            //                 $cc = date("Y-m-d h:i a", strtotime('+2 day', strtotime($close_times)));
            //             }

            //             $cc = strtotime($cc);

            //             if ($cc >= $day && $open_times <= $day) {
            //                 array_push($BranchesArray, $Branche);
            //             }
            //         } else if ($DDay == $dayname) {
            //             //                 print($dayPER . " % ");
            //             // print($dayHOR . " % ");
            //             // print($day . " % ");
            //             //     print($open_times. " - ");
            //             //     print(date("Y-m-d h:i a" , $cc). " / ");


            //             if ($cc >= $day && $open_times <= $day) {
            //                 array_push($BranchesArray, $Branche);
            //             }
            //         }
            //     }
            // }
            // $user['Branches'] = $Branches;

            $user->makeHidden(['merchant_products', 'merchant_categories', 'city']);
        }

        $user['address'] = DB::table('user_address')->where('user_id', $user->id)->get();


        if (\request()->segment(1) != 'admin' && \request()->segment(1) != 'merchant') {
            if (\request()->segment(1) == 'api' || \request()->ajax()) {
                if (isset($user)) {
                    return response_api(true, 200, null, $user);
                }
                return response_api(true, 200, null, []);
            }
        }
        return $user;
    }


    function getProductByCat($id)
    {
        $Products = Product::whereNull('deleted_at')->where('category_id',  $id)->orderByDesc('created_at')->get(['id', 'name', 'price', 'available_quantity', 'merchant_id']);

        if (\request()->segment(1) != 'admin' && \request()->segment(1) != 'merchant')
            if (\request()->segment(1) == 'api' || \request()->ajax()) {
                if (isset($user)) {
                    return response_api(true, 200, null, $Products);
                }
                return response_api(true, 200, null, []);
            }
        return $Products;
    }



    // sign up user
    function createDriver(array $attributes)
    {
        if (getAuth()->type == 'merchant' && !getAuth()->merchant->has_merchant_driver)
            return response_api(false, 422, null, []);

        $attributes['mobile'] = preg_replace("/^0/", "+966", $attributes['mobile']);
        $attributes['mobile'] = preg_replace("/^966/", "+966", $attributes['mobile']);
        $attributes['mobile'] = preg_replace("/^00966/", "+966", $attributes['mobile']);

        // TODO: Implement create() method.
        $user = new User();
        $user->username = $attributes['username'];
        $user->email = $attributes['mobile'] . '@saudidragonmart.com';
        $user->password = bcrypt('123456'); // send sms to driver 
        $user->mobile = $attributes['mobile'];
        $user->is_confirm_code = 1;
        $user->is_reset_password = 1;
        $user->type = 'driver';
        $confirm_code = generateVerificationCode();
        $user->verification_code = $confirm_code;
        $user->address = $attributes['address'];
        $user->city_id = $attributes['city_id'];
        $user->job_id = $attributes['job_id'];

        if (getAuth()->type == 'merchant')
            $user->driver_type_id = 3; // my team driver
        else
            $user->driver_type_id = 1; // dragonmart driver
        //        // user will approved automatically
        $user->is_active = 1;



        if ($user->save()) {
            //            $this->sendResetPasswordEmail($attributes);
            //  SMS confirm_code and password

            Mobily::send($attributes['mobile'], 'مرحباً بك في عائلة دراغون مارت (اسم المستخدم : ' . $attributes['mobile'] . ') (كلمة المرور : 123456)  #وين_ماكنت_صرنا_اقرب_لك ');

            // un comment when the driver creation works.
            // Mail::to($attributes['email'])->send(new DeepLinkResetPasswordMail(url('user/' . $user->id)));


            $user->image = $this->storeImageThumb('users', $user->id, $attributes['image']);
            sleep(1);

            //            $user->latitude = $attributes['latitude'];
            //            $user->longitude = $attributes['longitude'];
            $user->save();
            $vehicle = new Vehicle();
            $vehicle->driver_id = $user->id;
            $vehicle->photo = $this->storeImageThumb('vehicles', $user->id, $attributes['vehicle_photo']);
            sleep(1);


            $vehicle->license_driving = $this->storeImageThumb('vehicles', $user->id, $attributes['license_driving']);
            sleep(1);

            $vehicle->document = $this->storeImageThumb('vehicles', $user->id, $attributes['document']); // car license
            sleep(1);

            $vehicle->id_no = $this->storeImageThumb('vehicles', $user->id, $attributes['vehicle_id_no']);
            sleep(1);

            $vehicle->manufacturer = $attributes['manufacturer'];
            $vehicle->vehicle_type = $attributes['vehicle_type'];
            $vehicle->no = $attributes['vehicle_no'];
            $vehicle->model = $attributes['vehicle_model'];
            $vehicle->color = $attributes['vehicle_color'];
            $vehicle->save();

            $user = $this->model->find($user->id);

            if (getAuth()->type == 'merchant') {
                $store_driver = new StoreDriver();
                $store_driver->driver_id = $user->id;
                $store_driver->store_id = getAuth()->store->id;
                $store_driver->merchant_id = getAuth()->user_id;
                $store_driver->save();
            }
            return response_api(true, 200, trans('app.driver_created'), $user); //
        }
        return response_api(false, 422, null, []);
    }

    function updateDriver(array $attributes, $id)
    {
        // TODO: Implement create() method.
        $user = User::where('type', 'driver')->find($id);

        if (!isset($user))
            return response_api(false, 422, trans('app.not_updated'), []);
        $user->username = $attributes['username'];
        $user->email = $attributes['mobile'] . '@saudidragonmart.com';
        //        $user->password = bcrypt(generateVerificationCode()); // send sms to driver
        $user->mobile = $attributes['mobile'];
        //        $user->type = 'driver';
        //        $confirm_code = '111111';//$this->generateVerificationCode();
        //        $user->verification_code = $confirm_code;
        $user->address = $attributes['address'];
        $user->city_id = $attributes['city_id'];
        $user->job_id = $attributes['job_id'];

        //        // user will approved automatically
        //        $user->is_active = 1;

        if ($user->save()) {
            //            $this->sendResetPasswordEmail($attributes);
            //  SMS confirm_code and password
            //            Mail::to($attributes['email'])->send(new DeepLinkResetPasswordMail(url('user/' . $user->id)));


            if (isset($attributes['image'])) {
                $user->image = $this->storeImageThumb('users', $user->id, $attributes['image']);
                sleep(1);
            }

            //            $user->latitude = $attributes['latitude'];
            //            $user->longitude = $attributes['longitude'];
            $user->save();
            $vehicle = new Vehicle();

            if (isset($user->Vehicle))
                $vehicle = Vehicle::find($user->Vehicle->id);
            $vehicle->driver_id = $user->id;
            if (isset($attributes['vehicle_photo'])) {
                $vehicle->photo = $this->storeImageThumb('vehicles', $user->id, $attributes['vehicle_photo']);
                sleep(1);
            }
            if (isset($attributes['license_driving'])) {

                $vehicle->license_driving = $this->storeImageThumb('vehicles', $user->id, $attributes['license_driving']);
                sleep(1);
            }
            if (isset($attributes['document'])) {

                $vehicle->document = $this->storeImageThumb('vehicles', $user->id, $attributes['document']); // car license
                sleep(1);
            }
            if (isset($attributes['vehicle_id_no'])) {

                $vehicle->id_no = $this->storeImageThumb('vehicles', $user->id, $attributes['vehicle_id_no']);
                sleep(1);
            }
            $vehicle->manufacturer = $attributes['manufacturer'];
            $vehicle->vehicle_type = $attributes['vehicle_type'];
            $vehicle->no = $attributes['vehicle_no'];
            $vehicle->model = $attributes['vehicle_model'];
            $vehicle->color = $attributes['vehicle_color'];
            $vehicle->save();

            $user = $this->model->find($user->id);

            if (getAuth()->type == 'merchant') {
                $store_driver = new StoreDriver();
                $store_driver->driver_id = $user->id;
                $store_driver->store_id = getAuth()->store->id;
                $store_driver->merchant_id = getAuth()->user_id;
                $store_driver->save();
            }
            return response_api(true, 200, trans('app.updated'), $user); //
        }
        return response_api(false, 422, trans('app.not_updated'), []);
    }

    public
    function sendResetPasswordEmail($request)
    {
        $response = Password::broker()->sendResetLink(
            ['email' => $request['email']]
        );
        //
        //        return $response == \Illuminate\Support\Facades\Password::RESET_LINK_SENT
        //            ? true
        //            : false;
    }

    function createServiceProvider(array $attributes)
    {
        // TODO: Implement create() method.
        $user = new User();
        $user->username = $attributes['username'];
        $user->email = $attributes['email'];
        $user->password = bcrypt(generateVerificationCode()); // send sms to driver
        $user->mobile = $attributes['mobile'];
        $user->type = 'service_provider';
        $confirm_code = generateVerificationCode();
        $user->verification_code = $confirm_code;
        $user->address = $attributes['address'];
        $user->city_id = $attributes['city_id'];

        // user will approved automatically
        $user->is_active = 1;

        if ($user->save()) {

            //  SMS confirm_code and password

            //            Mobily::send($attributes['mobile'], 'Pass: ' . $user->password . ' - Code: ' . $confirm_code);
            Mobily::send($attributes['mobile'], 'reset password: ' . url('user/' . $user->id));

            foreach ($attributes['provider_categories'] as $category) {
                $service_category = new ServiceProviderCategory();
                $service_category->user_id = $user->id;
                $service_category->category_id = $category;
                $service_category->save();
            }
            $user = $this->model->find($user->id);

            return response_api(true, 200, trans('app.service_provider_created'), $user); //
        }
        return response_api(false, 422, null, []);
    }

    function create(array $attributes)
    {

        // TODO: Implement create() method.

        $attributes['mobile'] = preg_replace("/^0/", "+966", $attributes['mobile']);
        $attributes['mobile'] = preg_replace("/^966/", "+966", $attributes['mobile']);
        $attributes['mobile'] = preg_replace("/^00966/", "+966", $attributes['mobile']);



        $user = new User();
        $user->username = $attributes['username'];
        $user->email = $attributes['email'];
        $user->password = bcrypt($attributes['password']);
        $user->mobile = $attributes['mobile'];
        $user->country_code_length = $attributes['country_code_length'];
        $user->type = $attributes['type'];
        $confirm_code = rand(1000, 9999);
        $user->verification_code = $confirm_code;

        //مؤقتاً
        // $user->is_confirm_code = 1;
        // $user->is_active = 1;

        if (isset($attributes['bio']))
            $user->bio = $attributes['bio'];
        if (isset($attributes['lang']))
            $user->lang = $attributes['lang'];

        // $user->address = $attributes['address'];
        // $user->latitude = $ attributes['latitude'];
        // $user->longitude =$attributes['longitude'];
        // user will approved automatically
        // if ($attributes['type'] == 'client')


        if ($user->save()) {

            //  SMS confirm_code

            Mobily::send($attributes['mobile'], 'Code: ' . $confirm_code);

            //مؤقتاً
            // Mobily::send($attributes['mobile'], 'تم تفعيل حسابك تلقائياً. الرجاء إعادة تشغيل التطبيق.');

            if ($attributes['type'] == 'driver') {

                // $user->image = $this->storeImageThumb('users', $user->id, $attributes['image']);
                // sleep(1);

                // $user->driver_type_id = 2; // freelancer
                // $user->save();

                // $vehicle = new Vehicle();
                // $vehicle->driver_id = $user->id;
                // $vehicle->photo = $this->storeImageThumb('vehicles', $user->id, $attributes['vehicle_photo']);
                // sleep(1);

                // $vehicle->license_driving = $this->storeImageThumb('vehicles', $user->id, $attributes['license_driving']);
                // sleep(1);

                // $vehicle->document = $this->storeImageThumb('vehicles', $user->id, $attributes['document']); // car license
                // sleep(1);

                // $vehicle->id_no = $this->storeImageThumb('vehicles', $user->id, $attributes['vehicle_id_no']);
                // sleep(1);

                // $vehicle->car_type_id = $attributes['vehicle_type_id'];
                // $vehicle->no = $attributes['vehicle_no'];
                // $vehicle->model = $attributes['vehicle_model'];
                // $vehicle->color = $attributes['vehicle_color'];
                // $vehicle->save();

            }
            if ($attributes['type'] == 'merchant' || $attributes['type'] == 'service_provider') {
                $user->city_id = $attributes['city_id'];
                $user->address = $attributes['address'];
                $user->latitude = $attributes['latitude'];
                $user->longitude = $attributes['longitude'];

                if ($attributes['type'] == 'merchant') {
                    $user->has_delivery = $attributes['has_delivery'];
                    if (isset($attributes['has_delivery']) && $attributes['has_delivery']) {
                        $merchant_delivery = new MerchantDeliveryMethod();
                        $merchant_delivery->merchant_id = $user->id;
                        $merchant_delivery->driver_type_id = 3;
                        $merchant_delivery->save();
                    }
                }
                //else
                //$user->image = $this->storeImageThumb('users', $user->id, $attributes['image']);

                $user->save();

                if ($attributes['type'] == 'merchant') {
                    // add control panel account for merchant
                    $admin = new Admin();
                    $admin->name = $attributes['username'];
                    $admin->username = $attributes['username'];
                    $admin->mobile = $attributes['mobile'];
                    $admin->email = $attributes['email'];
                    $admin->password = bcrypt($attributes['password']);
                    $admin->type = 'merchant';
                    $admin->user_id = $user->id;
                    $admin->status = 0;
                    $admin->save();

                    // add default store with category
                    $store = new Store();
                    $store->merchant_id = $user->id;
                    $store->name = $attributes['username'];
                    $store->save();
                    foreach ($attributes['categories'] as $category) {

                        $store_category = new StoreCategory();
                        $store_category->store_id = $store->id;
                        $store_category->merchant_id = $user->id;
                        $store_category->category_id = $category;
                        $store_category->save();
                    }
                } else {
                    foreach ($attributes['provider_categories'] as $category) {

                        $provider_category = new ServiceProviderCategory();
                        $provider_category->user_id = $user->id;
                        $provider_category->category_id = $category;
                        $provider_category->save();
                    }
                }
            }

            VerifyUser::create([
                'user_id' => $user->id,
                'token' => str_random(40),
                'email' => $attributes['email'],
            ]);

            // Mail::to($user->email)->send(new VerifyMail($user));

            // $beautymail = app()->make(Beautymail::class, ['settings' => null]);


            // $beautymail->send('emails.verify_email', ['user' => $user], function ($message) use ($user) {
            //     $message
            //         ->from('info@macrotop.website')
            //         ->to($user->email, 'Dragonmart')
            //         ->subject('Verify Email Dragonmart!');
            // });

            if (\request()->has('device_type')) {
                $device = $this->deviceToken->where('user_id', $user->id)->where('device_id', \request()->get('device_id'))->where('type', \request()->get('device_type'))->first();

                if (!isset($device))
                    // register device token
                    $device = new DeviceToken();
                $device->user_id = $user->id;

                if (\request()->has('device_id'))
                    $device->device_id = \request()->get('device_id');
                $device->device_token = \request()->get('device_token');
                $device->type = \request()->get('device_type');
                $device->status = 'off';
                $device->save();
            }

            $user = $this->model->find($user->id);

            if ($attributes['type'] == 'driver') {
                return response_api(true, 200, trans('app.user_created') . ',' . trans('app.waiting_admin_approved'), $user); //
            }
            return response_api(true, 200, trans('app.user_created') . ',' . trans('app.sent_email_verification'), $user); //
        }
        return response_api(false, 422, null, []);
    }

    //update user
    function update(array $attributes, $id = null)
    {
        // TODO: Implement create() method.

        $user = isset($id) ? $this->model->find($id) : auth()->user();
        $admin = isset($id) ? Admin::where('user_id', $id)->first() : null;

        $message = trans('app.user_updated');

        if (isset($attributes['username'])) {
            $user->username = $attributes['username'];
            if (!is_null($admin))
                $admin->username = $attributes['username'];
        }

        if (isset($attributes['email']) && $user->email != $attributes['email']) {

            $email = $user->email;

            VerifyUser::create([
                'user_id' => $user->id,
                'token' => str_random(40),
                'email' => $attributes['email'],
            ]);

            $user->email = $attributes['email'];
            // Mail::to($attributes['email'])->send(new VerifyMail($user));
            $user->email = $email;
            $message = trans('app.email_updated');
        }
        if (isset($attributes['password'])) {

            if (Hash::check($attributes['old_password'], $user->password)) {
                $user->password = bcrypt($attributes['password']);
                if (!is_null($admin))
                    $admin->password = bcrypt($attributes['password']);
            } else {
                return response_api(false, 422, 'password_not_match', []);
            }
        }

        if (isset($attributes['mobile'])) {

            $attributes['mobile'] = preg_replace("/^0/", "+966", $attributes['mobile']);
            $attributes['mobile'] = preg_replace("/^966/", "+966", $attributes['mobile']);
            $attributes['mobile'] = preg_replace("/^00966/", "+966", $attributes['mobile']);


            $user->mobile = $attributes['mobile'];

            if (!is_null($admin))
                $admin->mobile = $attributes['mobile'];
        }


        if (isset($attributes['country_code_length']))
            $user->country_code_length = $attributes['country_code_length'];

        if (isset($attributes['address']))
            $user->address = $attributes['address'];

        if (isset($attributes['city_id']))
            $user->city_id = $attributes['city_id'];

        if (isset($attributes['latitude']))
            $user->latitude = $attributes['latitude'];

        if (isset($attributes['longitude']))
            $user->longitude = $attributes['longitude'];

        if (isset($attributes['has_delivery']))
            $user->has_delivery = $attributes['has_delivery'];

        if (isset($attributes['is_driver_available']))
            $user->is_driver_available = $attributes['is_driver_available'];

        if (isset($attributes['commission_rate']) && getAuth()->type == 'admin')
            $user->commission_rate = $attributes['commission_rate'];
        if (isset($attributes['refund_commission_rate']) && $user->id == getAuth()->user_id)
            $user->refund_commission_rate = $attributes['refund_commission_rate'];

        if (isset($attributes['bio']))
            $user->bio = $attributes['bio'];

        if (isset($attributes['lang']))
            $user->lang = $attributes['lang'];

        if ($user->type == 'merchant') {

            if (isset($attributes['description'])) {

                $store = Store::find($user->store->id);
                $store->description = $attributes['description'];
                $store->save();
            }
            if (isset($attributes['categories']) && count($attributes['categories']) > 0) {
                StoreCategory::where('merchant_id', $user->id)->delete();
                foreach ($attributes['categories'] as $category) {


                    $store_category = new StoreCategory();
                    $store_category->store_id = $user->Store->id;
                    $store_category->merchant_id = $user->id;
                    $store_category->category_id = $category;
                    $store_category->save();
                }
            }

            // add bank info
            //`merchant_id`, `bank_name`, `branch_code`, `bank_address`, `account_name`, `account_number`,

            if (isset($attributes['bank_name'])) {
                $bank = MerchantBank::where('merchant_id', $user->id)->first();
                if (!isset($bank))
                    $bank = new MerchantBank();
                $bank->merchant_id = $user->id;
                if (isset($attributes['bank_name']))
                    $bank->bank_name = $attributes['bank_name'];
                if (isset($attributes['branch_code']))
                    $bank->branch_code = $attributes['branch_code'];
                if (isset($attributes['bank_address']))
                    $bank->bank_address = $attributes['bank_address'];
                if (isset($attributes['account_name']))
                    $bank->account_name = $attributes['account_name'];
                if (isset($attributes['account_number']))
                    $bank->account_number = $attributes['account_number'];
                $bank->save();
            }

            // Commercial info
            if (isset($attributes['commercial_name']))
                $user->commercial_name = $attributes['commercial_name'];

            if (isset($attributes['commercial_register']))
                $user->commercial_register = $attributes['commercial_register'];

            if (isset($attributes['tax_number']))
                $user->tax_number = $attributes['tax_number'];
            if (isset($attributes['is_commercial']))
                $user->is_commercial = $attributes['is_commercial'];
            else
                $user->is_commercial = 0;
        }
        //        if (isset($attributes['min_order_amount']))
        //            $user->min_order_amount = $attributes['min_order_amount'];


        if (isset($attributes['image'])) {

            if (isset($user->image)) {
                $this->deleteImage('users', $user->id, $user->getOriginal('image'));
            }
            $user->image = $this->storeImageThumb('users', $user->id, $attributes['image']);
        }


        if (isset($attributes['vehicle_image'])) {

            if ($user->type == 'driver') {

                $vehicle = Vehicle::where('driver_id', $user->id)->first();
                if (isset($vehicle->photo)) {
                    $this->deleteImage('vehicles', $user->id, $vehicle->getOriginal('photo'));
                }


                $vehicle->photo = $this->storeImageThumb('vehicles', $user->id, $attributes['vehicle_image']);
                $vehicle->save();
                //                dd($vehicle);

            }
        }

        if ($user->save()) {

            if (!is_null($admin))
                $admin->save();

            $user = $this->model->find($user->id)->makeHidden(['store', 'merchant_categories', 'merchant_products', 'store_images', 'order_bought', 'order_pending', 'order_canceled', 'shipments']);
            return response_api(true, 200, $message, $user);
        }
        return response_api(false, 422, null, []);
    }

    //confirm code
    public
    function confirm_code(array $attributes)
    {
        $user = $this->model->find($attributes['user_id']);

        $userByMobile = $this->model->where('id', '<>', $attributes['user_id'])->where('mobile', $attributes['mobile'])->first();
        //update mobile
        if (isset($user)) {

            // 'The mobile was being token'
            if (isset($userByMobile)) {
                return response_api(false, 422, trans('app.mobile_token'));
            }
            if ($user->verification_code == $attributes['verification_code']) {
                $user->mobile = $attributes['mobile'];
                if (isset($attributes['lang']))
                    $user->lang = $attributes['lang'];
                $user->is_confirm_code = true;
                $user->is_active = true;
                $user->save();
                \request()->request->add([
                    'grant_type' => 'password',
                    'client_id' => getClientId(),
                    'client_secret' => getClientSecret(),
                    'email' => $user->email,
                    'password' => $attributes['password'],

                ]);

                return $this->access_token();
            } else {                                        //'There is an error in confirmation code'
                return response_api(false, 422, trans('app.error_confirmation'));
            }
        }
    }

    //resend confirm code
    public
    function resend_confirm_code(array $attributes)
    {
        $user = $this->model->find($attributes['user_id']);
        $userByMobile = $this->model->where('id', '<>', $attributes['user_id'])->where('mobile', $attributes['mobile'])->first();
        if (isset($userByMobile)) {
            return response_api(false, 422, trans('app.mobile_token'));
        }
        if (isset($user)) {
            // send SMS

            $confirm_code = generateVerificationCode();
            $user->verification_code = $confirm_code;
            if ($user->save()) {
                try {
                    //SMS::Send($attributes['mobile'], ' Dragonmart code: ' . $confirm_code);
                    Mobily::send($user->mobile, 'Code: ' . $confirm_code);

                    return response_api(true, 200, trans('app.resend_code_success'), $user);
                } catch (\Exception $e) {
                }
            }
        }
        return response_api(false, 422, null, []);
    }

    public
    function send_confirm_code(array $attributes)
    {
        // send SMS
        $user = auth()->user();
        $confirm_code = generateVerificationCode();
        $user->verification_code = $confirm_code;
        $user->new_mobile = $attributes['mobile'];
        if ($user->save()) {
            try {
                //SMS::Send($attributes['mobile'], ' Dragonmart code: ' . $confirm_code);
                Mobily::send($attributes['mobile'], 'Code: ' . $confirm_code);

                return response_api(true, 200, trans('app.resend_code_success'), $user);
            } catch (\Exception $e) {
            }
        }

        return response_api(false, 422, null, []);
    }

    public
    function check_change_mobile(array $attributes)
    {
        // send SMS
        $user = auth()->user();
        if ($user->new_mobile == $attributes['mobile'] && $user->verification_code == $attributes['verification_code']) {
            $user->mobile = $attributes['mobile'];
            $user->country_code_length = $attributes['country_code_length'];
            if ($user->save()) {
                try {
                    return response_api(true, 200, trans('app.mobile_updated'), $user);
                } catch (\Exception $e) {
                }
            }
        }

        return response_api(false, 422, trans('app.verification_code_error'), []);
    }

    // delete user
    function delete($id)
    {
        // TODO: Implement delete() method.
        $user = $this->model->find($id);
        return isset($user) && $user->delete();
    }

    public
    function forget(array $attributes)
    {

        $response = Password::sendResetLink($attributes);

        switch ($response) {
            case Password::RESET_LINK_SENT:
                return response_api(true, 200, 'Email was sent', []);
            case Password::INVALID_USER:
                return response_api(false, 422, 'Send reset password was failed', []);
        }
        return response_api(false, 422, 'Send reset password was failed', []);
    }

    public
    function resetPasswordDeepLink(array $attributes, $id)
    {

        $user = User::where('is_reset_password', 0)->find($id);

        if (isset($user)) {
            $user->password = bcrypt($attributes['password']);
            $user->is_reset_password = 1;
            if ($user->save()) {
                $user = $this->model->find($user->id);
                return response_api(true, 200, 'password has been set successfully', $user);
            }
            return response_api(false, 422, null, []);
        }
    }


    //logout
    public
    function logout($user_id = null)
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

    function getMerchant(array $attributes)
    {


        $store_categories = StoreCategory::all();
        $collection = $this->model->where('type', 'merchant')->where('is_active', 1);


        if (isset($attributes['category_id'])) {
            $store_categories = $store_categories->where('category_id', $attributes['category_id']);
            $stores_id = $store_categories->pluck('store_id');
            $merchant_ids = Store::whereIn('id', $stores_id)->pluck('merchant_id');
            $user_ids = $collection->whereIn('id', $merchant_ids)->pluck('id');
            $collection = User::where('type', 'merchant')->whereIn('id', $user_ids);
        }

        if (isset($attributes['merchant_name'])) {
            $collection = $collection->where('username', 'LIKE', '%' . $attributes['merchant_name'] . '%');
        }


        if (isset($attributes['merchant_id'])) {
            $collection = $collection->where('id', $attributes['merchant_id']);
        }


        $object = $collection->orderBy('created_at', 'desc')->get();

        if (request()->segment(1) == 'api' || request()->ajax()) {
            if (count($object) > 0)
                return response_api(true, 200, null, $object);
            return response_api(true, 200, null, []);
        }

        return $object;
    }


    // GET FOR CAT
    function getMerchants(array $attributes)
    {
        $page_size = isset($attributes['page_size']) ? $attributes['page_size'] : max_pagination();
        $page_number = isset($attributes['page_number']) ? $attributes['page_number'] : 1;
        $page_size = 100;
        $old_page_number = $page_number;


        $store_categories = StoreCategory::all();
        $collection = $this->model->where('type', 'merchant')->where('is_active', 1);

        if (isset($attributes['latitude']) && isset($attributes['longitude'])) {

            $merchantIds = $this->getNearMerchants($attributes['latitude'], $attributes['longitude'], $attributes['distance']);
            $collection = $collection->whereIn('id', $merchantIds);

            // return response_api(true, 200, null,  $this->getNearMerchants($attributes['latitude'], $attributes['longitude'], $attributes['distance']));

        }

        if (isset($attributes['category_id'])) {
            $store_categories = $store_categories->where('category_id', $attributes['category_id']);
            $stores_id = $store_categories->pluck('store_id');
            $merchant_ids = Store::whereIn('id', $stores_id)->pluck('merchant_id');
            $user_ids = $collection->whereIn('id', $merchant_ids)->pluck('id');
            $collection = User::where('type', 'merchant')->whereIn('id', $user_ids);
        }

        if (isset($attributes['merchant_name'])) {
            $collection = $collection->where('username', 'LIKE', '%' . $attributes['merchant_name'] . '%');
        }
        if (\request()->segment(1) != 'api') { // web site

            if (isset($attributes['city_id'])) {
                $collection = $collection->where('city_id', $attributes['city_id']);
            }
            if (isset($attributes['merchant_ids'])) {
                $collection = $collection->whereIn('id', $attributes['merchant_ids']);
            }
            if (isset($attributes['categories_ids'])) {
                $store_categories = $store_categories->whereIn('category_id', $attributes['categories_ids']);
                $stores_id = $store_categories->pluck('store_id');
                $merchant_ids = Store::whereIn('id', $stores_id)->pluck('merchant_id');
                $user_ids = $collection->whereIn('id', $merchant_ids)->pluck('id');
                $collection = User::where('type', 'merchant')->whereIn('id', $user_ids);
            }
        }


        $count = $collection->count();
        $page_count = page_count($count, $page_size);
        $page_number = $page_number - 1;
        $page_number = $page_number > $page_count ? $page_number = $page_count - 1 : $page_number;
        $object = $collection->take($page_size)->skip((int)$page_number * $page_size)->orderBy('created_at', 'desc')->get();

        if (request()->segment(1) == 'api' || request()->ajax()) {
            if (count($object) > 0)
                return response_api(true, 200, null, $object, $page_count, $page_number);
            return response_api(true, 200, null, []);
        }
        //        return $object;

        $arr['items'] = $object;
        $arr['total_pages'] = $page_count;
        $arr['current_page'] = $old_page_number;

        return (object)$arr;
    }

    function getServiceProviders(array $attributes)
    {
        $page_size = isset($attributes['page_size']) ? $attributes['page_size'] : max_pagination();
        $page_number = isset($attributes['page_number']) ? $attributes['page_number'] : 1;
        $old_page = $attributes['page_number'];

        $service_provider_categories = ServiceProviderCategory::all();
        $collection = $this->model->where('type', 'service_provider')->where('is_active', 1);

        if (isset($attributes['latitude']) && isset($attributes['longitude'])) {

            $serviceProviderIds = $this->getNearServiceProviders($attributes['latitude'], $attributes['longitude']);
            $collection = $collection->whereIn('id', $serviceProviderIds);
        }

        if (isset($attributes['category_id'])) {
            $service_provider_categories = $service_provider_categories->where('category_id', $attributes['category_id']);
            $user_ids = $service_provider_categories->pluck('user_id');
            $collection = $collection->whereIn('id', $user_ids);
        }

        if (isset($attributes['service_provider_name'])) {
            $collection = $collection->where('username', 'LIKE', '%' . $attributes['service_provider_name'] . '%');
        }


        $count = $collection->count();
        $page_count = page_count($count, $page_size);
        $page_number = $page_number - 1;
        $page_number = $page_number > $page_count ? $page_number = $page_count - 1 : $page_number;
        $object = $collection->take($page_size)->skip((int)$page_number * $page_size)->orderBy('created_at', 'desc')->get();

        if (request()->segment(1) == 'api' || request()->ajax()) {
            if (count($object) > 0)
                return response_api(true, 200, null, $object, $page_count, $page_number);
            return response_api(true, 200, null, []);
        }
        $arr['items'] = $object;
        $arr['total_pages'] = $page_count;
        $arr['current_page'] = $old_page;
        return (object)$arr;
    }

    public
    function getMerchantsList()
    {
        $merchants = $this->model->where('is_active', 1)->where('type', 'merchant')->select(['id', 'username'])->get()->makeHidden($this->appends);
        foreach ($merchants as $key => $merchant) {
            $merchants[$key]["Cat"] = ProductCategory::where('store_id',  $merchant->id)->select(['id', 'name', 'name_ar'])->orderByDesc('created_at')->get();
        }



        return response_api(true, 200, null, $merchants);
    }


    public function getMerchantCat(array $attributes)
    {
        $merchants = $this->model->where('is_active', 1)->where('id', $attributes['id'])->select(['id', 'username'])->get()->makeHidden($this->appends);
        foreach ($merchants as $key => $merchant) {
            $merchants[$key]["Cat"] = ProductCategory::where('store_id',  $merchant->id)->select(['id', 'name', 'name_ar'])->orderByDesc('created_at')->get();
        }



        return response_api(true, 200, null, $merchants);
    }


    public
    function getDriversList($is_my_drivers)
    {
        $drivers = $this->model->where('is_active', 1)->where('type', 'driver')->select(['id', 'username']);

        if (\request()->segment(1) == 'api')
            $merchant_drivers = StoreDriver::where('merchant_id', auth()->user()->id)->pluck('driver_id');
        else
            $merchant_drivers = StoreDriver::where('merchant_id', getAuth()->user_id)->pluck('driver_id');

        if ($is_my_drivers) {
            $drivers = $drivers->whereIn('id', $merchant_drivers)->get()->makeHidden($this->appends);
        } else
            $drivers = $drivers->whereNotIn('id', $merchant_drivers)->get()->makeHidden($this->appends);

        return response_api(true, 200, null, $drivers);
    }


    public
    function getNearServiceProviders($lat, $long) // start = 1, end = 2
    {
        $service_provider_id = [];
        if (isset($lat) && isset($long)) {
            $service_providers = $this->model->where('type', 'service_provider')->where('is_active', 1)->get();
            $service_provider_near_me_id = [];
            $service_provider_near = [];

            foreach ($service_providers as $service_provider) {
                $distance = distance($lat, $long, $service_provider->latitude, $service_provider->longitude);


                //                $setting = Setting::find(7); // المسافة التقريبية بكيلو متر

                //                $predict_distance = (isset($setting)) ? intval($setting['title']) : 1;

                if ($distance <= 100) {
                    $service_provider_near_me_id['service_provider_id'] = $service_provider->id;
                    $service_provider_near_me_id['distance'] = $distance;
                    $service_provider_near[] = $service_provider_near_me_id;
                }
            }

            usort($service_provider_near, function ($a, $b) {
                return $a['distance'] - $b['distance'];
            });

            foreach ($service_provider_near as $service_provider) {
                $service_provider_id[] = $service_provider['service_provider_id'];
            }
        }

        return $service_provider_id;
    }

    public
    function getNearMerchants($lat, $long, $dist = 35) // start = 1, end = 2
    {
        $merchant_id = [];
        if (isset($lat) && isset($long)) {
            $merchants = $this->model->where('type', 'merchant')->where('is_active', 1)->get();
            $merchant_near_me_id = [];
            $merchant_near = [];

            foreach ($merchants as $merchant) {


                $Branches = Store::where('merchant_id', $merchant->id)->get();

                foreach ($Branches as $Branche) {

                    $distance = distance($lat, $long, $Branche->lat, $Branche->lng);

                    if ($distance <= $dist) {
                        if (!in_array($merchant->id, $merchant_near)) {
                            $merchant_near_me_id['merchant_id'] = $merchant->id;
                            $merchant_near_me_id['distance'] = $distance;
                            $merchant_near[] = $merchant_near_me_id;
                        }
                    }
                }

                //                $setting = Setting::find(7); // المسافة التقريبية بكيلو متر

                //                $predict_distance = (isset($setting)) ? intval($setting['title']) : 1;


            }

            usort($merchant_near, function ($a, $b) {
                return $a['distance'] - $b['distance'];
            });

            foreach ($merchant_near as $merchant) {
                $merchant_id[] = $merchant['merchant_id'] . " - " . $merchant['distance'];
            }
        }

        return $merchant_id;
    }







    // count users
    function count()
    {
        return $this->model->count();
    }


    function NewAddress(array $attributes)
    {

        $address =  DB::table('user_address')->insertGetId([
            'user_id' => $attributes['user_id'],
            'name' => $attributes['name'],
            'lat' => $attributes['lat'],
            'lng' => $attributes['lng'],
            'address' => $attributes['address'],
        ]);

        if ($address) {
            $address = DB::table('user_address')->where('id', $address)->first();
            return response_api(true, 200, null, $address);
        } else {
            return response_api(false, 400, null, []);
        }
    }
}
