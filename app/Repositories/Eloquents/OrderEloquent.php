<?php

/**
 * Created by PhpStorm.
 * UserRequest: mohammedsobhei
 * Date: 5/2/18
 * Time: 11:43 PM
 */

namespace App\Repositories\Eloquents;

use App\CartProduct;
use App\CartProductCustom;
use App\Events\UpdateOrderStatusEvent;
use App\MerchantDeliveryMethod;
use App\Order;
use App\OrderProduct;
use App\OrderProductCustom;
use App\OrderStatus;
use App\OrderUser;
use App\Payment;
use App\Product;
use App\ProductCustomization;
use App\Repositories\Interfaces\Repository;
use App\ServiceClient;
use App\ServiceRequest;
use App\User;
use Carbon\Carbon;
use Damas\Paytabs\paytabs;
use function foo\func;
use Illuminate\Support\Collection;
use function MongoDB\BSON\toJSON;

class OrderEloquent implements Repository
{
    private $model, $orderUser, $orderStatus, $product, $serviceClient, $serviceRequest, $notificationSystem, $payment;

    public function __construct(Order $model, OrderUser $orderUser, OrderStatus $orderStatus, Product $product, ServiceClient $serviceClient, ServiceRequest $serviceRequest, NotificationSystemEloquent $notificationSystem, PaymentEloquent $paymentEloquent)
    {
        $this->model = $model;
        $this->product = $product;
        $this->serviceClient = $serviceClient;
        $this->serviceRequest = $serviceRequest;
        $this->notificationSystem = $notificationSystem;
        $this->orderUser = $orderUser;
        $this->orderStatus = $orderStatus;
        $this->payment = $paymentEloquent;
    }

    // for cpanel //client
    function anyData($status)
    {
        if ($status == 'current') {
            $orders = $this->model->where('driver_status', '!=', 'delivered')->where('last_status', '!=', 'canceled')->where('last_status', '!=', 'rejected')->where('last_status', '!=', 'pending')->orderByDesc('created_at');
        } elseif ($status == 'late') {
            $late_orders = $this->model->where('driver_status', '!=', 'delivered')->where('last_status', '!=', 'canceled')->where('last_status', '!=', 'rejected')->get();

            $orders = collect();

            foreach ($late_orders as $late_order) {
                $new = $late_order->statuses->where('edit_at', 'last_status')->where('status', 'new')->first();
                $accepted = $late_order->statuses->where('edit_at', 'last_status')->where('status', 'accepted')->first();
                $ready = $late_order->statuses->where('edit_at', 'last_status')->where('status', 'finished')->first();
                $driver_accepted = $late_order->statuses->where('edit_at', 'driver_status')->where('status', 'accepted')->first();
                $driver_receive = $late_order->statuses->where('edit_at', 'driver_status')->where('status', 'receive')->first();
                $driver_delivered = $late_order->statuses->where('edit_at', 'driver_status')->where('status', 'delivered')->first();
                // late new order
                if (isset($new) && !isset($accepted) && $new['duration'] > '00:05:00')
                    $orders->push($late_order);

                elseif (isset($accepted) && !isset($ready) && $accepted['duration'] > '00:40:00')
                    $orders->push($late_order);

                elseif (isset($ready) && !isset($driver_accepted) && $ready['duration'] > '00:30:00')
                    $orders->push($late_order);

                elseif (isset($driver_receive) && !isset($driver_delivered) && $driver_receive['duration'] > '00:30:00')
                    $orders->push($late_order);
            }
        } elseif($status == 'delivered'){
            $orders = $this->model->where('driver_status', $status)->orderByDesc('created_at');
        } else
            $orders = $this->model->where('last_status', $status)->orderByDesc('created_at');

        return datatables()->of($orders)
            ->filter(function ($query) {
            })->addColumn('location', function ($order) {
                return '<a href="' . url(admin_user_tab_url() . '/user/' . $order->order_user->user_id) . '" class="btn btn-circle btn-icon-only blue user-det" title="Address">
                                        <i class="fa fa-map"></i>
                                    </a>';
            })->addColumn('items_no', function ($order) {
                return $order->order_products->count();
            })->addColumn('order_status', function ($order) {
                return $order->order_status['status'];
            })->addColumn('current_status', function ($order) {
                $status = null;
                $icon = null;
                if (isset($order->order_status)) {
                    if ($order->order_status['status'] == 'new') {
                        $status = trans(lang_app_site() . '.CP.New');
                    }
                    elseif ($order->order_status['status'] == 'accepted' || $order->order_status['status'] == 'progress') {
                        $status = trans(lang_app_site() . '.CP.In Progress');
                    }
                    elseif ($order->order_status['status'] == 'finished') {
                        $status = trans(lang_app_site() . '.CP.Completed');
                    }
                    elseif ($order->order_status['status'] == 'store_arrival') {
                        $status = trans(lang_app_site() . '.CP.store_arrival');
                    }
                    elseif ($order->order_status['status'] == 'pickup' || $order->order_status['status'] == 'receive') {
                        $status = trans(lang_app_site() . '.CP.Delivering');
                        $icon = '<i class="fas fa-shipping-fast text-dark mr-2"></i>';
                    }
                    elseif($order->order_status['status'] == 'client_arrival') {
                        $status = trans(lang_app_site() . '.CP.client_arrival');
                    }
                    elseif($order->order_status['status'] == 'delivered') {
                        $status = trans(lang_app_site() . '.CP.delivered');
                    }

                    return '<div class="row">' . $icon . '<span class="font-weight-bolder">' . $status . '</span></div>
                            <div class="row">'. $order->order_status['duration'] . '</div>';
                }

                return '';
            })->addColumn('driver_source', function ($order) {
                if (isset($order->driver))
                    return $this->getDeliveryMethod($order->driver_source);
                return '-';
            })->addColumn('order_id', function ($order) {
                return '<a href="' . url(((getAuth()->type == 'admin') ? admin_report_tab_url() : getAuth()->type) . '/order/' . $order->id) . '">' . $order->id . '</a>';
            })->addColumn('merchant_name', function ($order) {
                if (isset($order->merchant))
                    return '<div class="row"><a href="' . url(((getAuth()->type == 'admin') ? admin_user_tab_url() : getAuth()->type) . '/user-det/' . $order->merchant->id) . '" class="text-dark-50">' . $order->merchant->username . '</a></div>
                            <div class="row"><span>' . $order->store->name . '</span></div>';
                return '';
            })->addColumn('client_name', function ($order) {
                if (isset($order->order_user))
                    return '<a href="' . url(((getAuth()->type == 'admin') ? admin_user_tab_url() : getAuth()->type) . '/user-det/' . $order->order_user->user_id) . '" class="text-dark-50">' . $order->order_user->client->username . '</a>';
                return '';
            })->addColumn('job_id', function ($order) {
                if (isset($order->driver->job_id)) {
                    $chars = 7;
                    $job_id = '';

                    for ($i = 0; $i < $chars - strlen($order->driver->job_id); $i++) {
                        $job_id = $job_id . '0';
                    }

                    return $job_id . '<p class="d-inline font-weight-boldest">' . $order->driver->job_id . '</p>';
                }
                return '-';
            })->addColumn('driver_name', function ($order) {
                if (isset($order->driver))
                    return '<a href="' . url(((getAuth()->type == 'admin') ? admin_user_tab_url() : getAuth()->type) . '/user-det/' . $order->driver->id) . '" class="text-dark-50">' . $order->driver->username . '</a>';
                return '-';
            })->editColumn('duration', function ($order) {
                if (isset($order->duration))
                    return $order->duration;
                return '';
            })->addColumn('status_duration', function ($order) {
                if (isset($order->order_status['duration']))
                    return $order->order_status['duration'];
                return '';  
            })->addColumn('action', function ($order) {

                $action = '';
                $reassigned = '';
                if ($order->last_status != 'pickup' && $order->last_status != 'rejected') {

                    $action = '<a href="' . url(getAuth()->type . '/cancel-order/' . $order->id) . '"
                                                                class="btn btn-danger btn-icon-only cancelOrder" title="cancel">
                                                                <i class="fa fa-times"></i>
                                                                </a>';
                }
                if (getAuth()->type == 'admin' && $order->last_status == 'accepted' && $order->driver_status == 'new') {

                    $reassigned = '<a href="' . url(getAuth()->type . '/assign-driver/' . $order->id) . '" target="_blank" title="Assign driver"
                                                           class="btn btn-icon-only admin-assigned-driver"><i
                                                                    class="fa fa-reply"></i></a>';
                }
                return $reassigned . '<a href="' . url(((getAuth()->type == 'admin') ? admin_report_tab_url() : getAuth()->type) . '/order/' . $order->id) . '" target="_blank"
                                                           class="btn btn-icon-only"><i
                                                                    class="fa fa-eye"></i></a>' . $action;
            })->addIndexColumn()
            ->rawColumns([
                'location',
                'items_no',
                'order_status',
                'current_status',
                'driver_source',
                'order_id',
                'merchant_name',
                'client_name',
                'job_id',
                'driver_name',
                'status_duration',
                'action'
            ])->toJson();
    }

    function revenueOrdersData()
    {
        $orders = $this->model->where('last_status', 'pickup')->orderByDesc('created_at');
        return datatables()->of($orders)
            ->filter(function ($query) {

                if (request()->filled('order_no')) {
                    $query->where('id', request()->get('order_no'));
                }
                if (request()->filled('driver_type_id')) {
                    $query->where('driver_source', request()->get('driver_type_id'));
                }
                if (request()->filled('merchant_name')) {

                    $merchant_ids = User::where('type', 'merchant')->where('username', 'LIKE', '%' . request()->get('merchant_name') . '%')->pluck('id');
                    $query->whereIn('merchant_id', $merchant_ids);
                }
                if (request()->filled('order_date_from') && request()->filled('order_date_to')) {

                    $query->whereDate('actual_received_date', '>=', request()->get('order_date_from'))->whereDate('actual_received_date', '<=', request()->get('order_date_to'));
                }
            })->addColumn('location', function ($order) {
                return '<a href="' . url(admin_user_tab_url() . '/user/' . $order->OrderUser->user_id) . '" class="btn btn-circle btn-icon-only blue user-det" title="Address">
                                        <i class="fa fa-map"></i>
                                    </a>';
            })->addColumn('items_no', function ($order) {
                return $order->OrderProducts->count();
            })->editColumn('driver_source', function ($order) {
                return $this->getDeliveryMethod($order->driver_source);
            })->addColumn('order_id', function ($order) {
                return '<a href="' . url(((getAuth()->type == 'admin') ? admin_report_tab_url() : getAuth()->type) . '/order/' . $order->id) . '">' . $order->id . '</a>';
            })->addColumn('merchant_name', function ($order) {
                if (isset($order->Merchant))
                    return '<a href="' . url(((getAuth()->type == 'admin') ? admin_user_tab_url() : getAuth()->type) . '/user-det/' . $order->Merchant->id) . '">' . $order->Merchant->username . '</a>';
                return '';
            })->addColumn('client_name', function ($order) {
                if (isset($order->OrderUser))
                    return '<a href="' . url(((getAuth()->type == 'admin') ? admin_user_tab_url() : getAuth()->type) . '/user-det/' . $order->OrderUser->user_id) . '">' . $order->OrderUser->Client->username . '</a>';
                return '';
            })->addColumn('driver_name', function ($order) {
                if (isset($order->Driver))
                    return '<a href="' . url(((getAuth()->type == 'admin') ? admin_user_tab_url() : getAuth()->type) . '/user-det/' . $order->Driver->id) . '">' . $order->Driver->username . '</a>';
                return '';
            })->addColumn('action', function ($order) {
                $action = '';

                if ((getAuth()->type == 'merchant' && $order->last_status == 'new') || (getAuth()->type == 'admin' && $order->last_status != 'finished')) {

                    $action = '<a href="' . url(getAuth()->type . '/cancel-order/' . $order->id) . '"
                                                                class="btn btn-danger btn-icon-only btn-circle cancelOrder"
                                                                title="cancel"><i
                                                                    class="fa fa-times"></i>
                                                                    </a>';
                }
                return '<a href="' . url(((getAuth()->type == 'admin') ? admin_report_tab_url() : getAuth()->type) . '/order/' . $order->id) . '" target="_blank"
                                                           class="btn purple btn-icon-only btn-circle"><i
                                                                    class="fa fa-eye"></i></a>' . $action;
            })->editColumn('last_status', function ($order) {

                if ($order->last_status == 'new') {
                    return '<span class="label label-sm label-warning">New Order</span>';
                }
                if ($order->last_status == 'accepted') {
                    return '<span class="label label-sm label-primary">Accepted Order</span>';
                }
                if ($order->last_status == 'progress') {
                    return '<span class="label label-sm label-danger">Progress Order</span>';
                }
                if ($order->last_status == 'finished') {
                    return '<span class="label label-sm label-success">Completed Order</span>';
                }
            })->addIndexColumn()
            ->rawColumns(['order_id', 'driver_name', 'client_name', 'merchant_name', 'location', 'last_status', 'action'])->toJson();
    }

    function getDeliveryMethod($type)
    {
        switch ($type) {
            case 'app_driver':
                return 'Dragonmart Driver';
            case 'freelancer_driver':
                return 'Freelance';
            case 'store_driver':
                return 'Store Driver';
            default:
                return '';
        }
    }

    function reportOrdersData($status)
    {
        if (getAuth()->type == 'merchant') {
            if ($status == 'current') {
                $orders = $this->model->where('merchant_id', getAuth()->user_id)->where(function ($query) {
                    $query->where('driver_status', '!=', 'delivered')->where('last_status', '!=', 'canceled')->where('last_status', '!=', 'rejected')->where('last_status', '!=', 'pending')->where('last_status', '!=', 'pickup')->orderByDesc('created_at');
                })->orderByDesc('created_at');
            } else
                $orders = $this->model->where('merchant_id', getAuth()->user_id)->where('last_status', $status)->orderByDesc('created_at');
        } else {

            if ($status == 'current') {
                $orders = $this->model->where(function ($query) {
                    $query->where('last_status', 'accepted')->orWhere('last_status', 'progress');
                })->orderByDesc('created_at');
            } else
                $orders = $this->model->where('last_status', $status)->orderByDesc('created_at');
        }
        return datatables()->of($orders)
            ->filter(function ($query) {

                if (request()->filled('order_no')) {
                    $query->where('id', request()->get('order_no'));
                    //                    $query->where('id', 'LIKE', '%' . request()->get('order_no') . '%');
                }
                if (request()->filled('driver_type_id')) {
                    $query->where('driver_source', request()->get('driver_type_id'));
                    //                    $query->where('id', 'LIKE', '%' . request()->get('order_no') . '%');
                }
                if (request()->filled('merchant_name')) {

                    $merchant_ids = User::where('type', 'merchant')->where('username', 'LIKE', '%' . request()->get('merchant_name') . '%')->pluck('id');
                    $query->whereIn('merchant_id', $merchant_ids);
                    //                    $query->where('id', 'LIKE', '%' . request()->get('order_no') . '%');
                }
                if (request()->filled('order_date_from') && request()->filled('order_date_to')) {

                    $query->whereDate('created_at', '>=', request()->get('order_date_from'))->whereDate('created_at', '<=', request()->get('order_date_to'));
                    //                    $query->where('id', 'LIKE', '%' . request()->get('order_no') . '%');
                }
                if (request()->filled('received_date_from') && request()->filled('received_date_to')) {

                    $user_order_id = OrderUser::whereDate('received_datetime', '>=', request()->get('received_date_from'))->whereDate('received_datetime', '<=', request()->get('received_date_to'))->pluck('id');
                    $query->whereIn('user_order_id', $user_order_id);
                }

                if (request()->filled('driver_name')) {

                    $driver_ids = User::where('type', 'driver')->where('username', 'LIKE', '%' . request()->get('driver_name') . '%')->pluck('id');

                    $query->whereIn('driver_id', $driver_ids);
                }
            })->addColumn('items_no', function ($order) {
                return $order->order_products->count();
            })->addColumn('order_status', function ($order) {
                return $order->order_status['status'];
            })->addColumn('driver_status', function ($order) {
                return $order->driver_status;
            })->addColumn('current_status', function ($order) {
                $status = null;
                $icon = null;
                if (isset($order->order_status)) {
                    if ($order->order_status['status'] == 'new') {
                        $status = trans(lang_app_site() . '.CP.New');
                    }
                    elseif ($order->order_status['status'] == 'accepted' || $order->order_status['status'] == 'progress') {
                        $status = trans(lang_app_site() . '.CP.In Progress');
                    }
                    elseif ($order->order_status['status'] == 'finished') {
                        $status = trans(lang_app_site() . '.CP.Completed');
                    }
                    elseif ($order->order_status['status'] == 'store_arrival') {
                        $status = trans(lang_app_site() . '.CP.store_arrival');
                    }
                    elseif ($order->order_status['status'] == 'pickup' || $order->order_status['status'] == 'receive') {
                        $status = trans(lang_app_site() . '.CP.Delivering');
                        $icon = '<i class="fas fa-shipping-fast text-dark mr-2"></i>';
                    }
                    elseif($order->order_status['status'] == 'client_arrival') {
                        $status = trans(lang_app_site() . '.CP.client_arrival');
                    }
                    elseif($order->order_status['status'] == 'delivered') {
                        $status = trans(lang_app_site() . '.CP.delivered');
                    }

                    return '<div class="row">' . $icon . '<span class="font-weight-bolder">' . $status . '</span></div>
                            <div class="row">'. $order->order_status['duration'] . '</div>';
                }

                return '';
            })->editColumn('driver_source', function ($order) {
                return $this->getDeliveryMethod($order->driver_source);
            })->addColumn('order_id', function ($order) {
                return '<a href="' . url(((getAuth()->type == 'admin') ? admin_report_tab_url() : getAuth()->type) . '/order/' . $order->id) . '">' . $order->id . '</a>';
            })->addColumn('merchant_name', function ($order) {
                if (isset($order->merchant)) {
                    if (getAuth()->type == 'merchant') {
                        return '<a href="' . url(((getAuth()->type == 'admin') ? admin_user_tab_url() : getAuth()->type) . '/profile') . '">' . $order->merchant->username . '</a>';
                    }
                    return '<a href="' . url(((getAuth()->type == 'admin') ? admin_user_tab_url() : getAuth()->type) . '/user-det/' . $order->merchant->id) . '">' . $order->merchant->username . '</a>';
                }
                return '';
            })->addColumn('client_name', function ($order) {
                if (isset($order->order_user))
                    return '<a href="' . url(((getAuth()->type == 'admin') ? admin_user_tab_url() : getAuth()->type) . '/user-det/' . $order->order_user->user_id) . '">' . $order->order_user->client->username . '</a>';
                return '';
            })->addColumn('driver_name', function ($order) {
                if (isset($order->driver))
                    return '<a href="' . url(((getAuth()->type == 'admin') ? admin_user_tab_url() : getAuth()->type) . '/user-det/' . $order->driver->id) . '">' . $order->driver->username . '</a>';
                return '';
            })->editColumn('status_duration', function ($order) {
                if (isset($order->order_status['duration']))
                    return $order->order_status['duration'];
                return '';
            })->addColumn('duration', function ($order) {
                return $order->order_status['duration'];
            })->addColumn('action', function ($order) {

                $action = '';
                $reassigned = '';
                if ((getAuth()->type == 'merchant' && $order->last_status == 'new') || (getAuth()->type == 'admin' && $order->last_status != 'finished')) {

                    $action = '<a href="' . url(getAuth()->type . '/cancel-order/' . $order->id) . '"
                                                                class="mr-3 cancelOrder"
                                                                title="cancel order">
                                                                    <i class="fa fa-times"></i>
                                                                </a>';
                }
                if (getAuth()->type == 'merchant') {
                    if ($order->last_status == 'new') {
                        $action .= '<a href="' . url(getAuth()->type . '/accept-order/' . $order->id) . '"
                                                                class="btn btn-success btn-icon-only btn-circle acceptOrder"
                                                                title="accept order">
                                                                    <i class="fa fa-check"></i>
                                                                </a>';
                    } elseif ($order->last_status == 'accepted') {
                        $action .= '<a href="' . url(getAuth()->type . '/ready-order/' . $order->id) . '"
                                      class="btn btn-success btn-icon-only btn-circle readyOrder"
                                      title="Order is Ready">
                                            <i class="fas fa-thumbs-up"></i>
                                    </a>';
                    } elseif ($order->last_status == 'finished') {
                        $action .= '<a href="' . url(getAuth()->type . '/handover-order/' . $order->id) . '"
                        class="btn btn-success btn-icon-only btn-circle handoverOrder"
                        title="Hand it">
                            <i class="fas fa-people-carry icon-xl"></i>
                        </a>';
                    }
                }
                if (getAuth()->type == 'admin' && $order->last_status == 'accepted') {

                    $reassigned = '<a href="' . url(getAuth()->type . '/assign-driver/' . $order->id) . '" target="_blank" title="Assign driver"
                                                            class="btn blue btn-icon-only btn-circle admin-assigned-driver">
                                                                <i class="fa fa-reply"></i>
                                                            </a>';
                }
                return $reassigned . '<a href="' . url(((getAuth()->type == 'admin') ? admin_report_tab_url() : getAuth()->type) . '/order/' . $order->id) . '" target="_blank"
                                                            class="btn">
                                                                <i class="fa fa-eye"></i>
                                                            </a>' . $action;
            })->editColumn('last_status', function ($order) {

                if ($order->last_status == 'new') {
                    return '<span class="label label-sm label-warning">New Order</span>';
                }
                if ($order->last_status == 'accepted') {
                    return '<span class="label label-sm label-primary">Accepted Order</span>';
                }
                if ($order->last_status == 'progress') {
                    return '<span class="label label-sm label-danger">Progress Order</span>';
                }
                if ($order->last_status == 'finished') {
                    return '<span class="label label-sm label-success">Completed Order</span>';
                }
            })->addIndexColumn()
            ->rawColumns(['order_id', 'order_status', 'driver_status', 'current_status', 'driver_name', 'client_name', 'merchant_name', 'location', 'last_status', 'action', 'duration'])->toJson();
    }

    function merchantOrdersData($merchant_id)
    {
        $orders = $this->model->where(function ($query) {
            $query->where('last_status', 'new')->orWhere('last_status', 'accepted')->orWhere('last_status', 'progress')->orWhere('last_status', 'finished');
        })->where('merchant_id', $merchant_id)->orderByDesc('created_at');

        return datatables()->of($orders)
            ->filter(function ($query) {

                //                if (request()->filled('name')) {
                //                    $query->where('name', 'LIKE', '%' . request()->get('name') . '%');
                //                }

            })->addColumn('location', function ($order) {
                return '<a href="' . url(((getAuth()->type == 'admin') ? admin_user_tab_url() : getAuth()->type) . '/user/' . $order->order_user->user_id) . '" class="btn btn-circle btn-icon-only blue user-det" title="Address">
                                        <i class="fa fa-map"></i>
                                    </a>';
            })->editColumn('driver_source', function ($order) {
                return $this->getDeliveryMethod($order->driver_source);
            })->addColumn('items_no', function ($order) {
                return $order->order_products->count();
            })->addColumn('order_id', function ($order) {
                return '<a href="' . url(((getAuth()->type == 'admin') ? admin_report_tab_url() : getAuth()->type) . '/order/' . $order->id) . '">' . $order->id . '</a>';
            })->addColumn('driver_name', function ($order) {
                if (isset($order->driver))
                    return '<a href="' . url(((getAuth()->type == 'admin') ? admin_user_tab_url() : getAuth()->type) . '/user-det/' . $order->driver->id) . '">' . $order->driver->username . '</a>';
                return '';
            })->addColumn('merchant_name', function ($order) {
                if (isset($order->merchant))
                    return '<a href="' . url(((getAuth()->type == 'admin') ? admin_user_tab_url() : getAuth()->type) . '/user-det/' . $order->merchant->id) . '">' . $order->merchant->username . '</a>';
                return '';
            })->addColumn('client_name', function ($order) {
                if (isset($order->order_user))
                    return '<a href="' . url(((getAuth()->type == 'admin') ? admin_user_tab_url() : getAuth()->type) . '/user-det/' . $order->order_user->user_id) . '">' . $order->order_user->client->username . '</a>';
                return '';
            })->addColumn('action', function ($order) {
                $action = '';
                $reassigned = '';
                if ((getAuth()->type == 'merchant' && $order->last_status == 'new') || (getAuth()->type == 'admin' && $order->last_status != 'finished')) {

                    $action = '<a href="' . url(getAuth()->type . '/cancel-order/' . $order->id) . '"
                                                                class="btn btn-danger btn-icon-only btn-circle cancelOrder"
                                                                title="cancel"><i
                                                                    class="fa fa-times"></i>
                                                                    </a>';
                }
                if (getAuth()->type == 'admin' && $order->last_status == 'accepted') {

                    $reassigned = '<a href="' . url(getAuth()->type . '/assign-driver/' . $order->id) . '" target="_blank" title="Assign driver"
                                                           class="btn blue btn-icon-only btn-circle admin-assigned-driver"><i
                                                                    class="fa fa-reply"></i></a>';
                }
                return $reassigned . '<a href="' . url(((getAuth()->type == 'admin') ? admin_report_tab_url() : getAuth()->type) . '/order/' . $order->id) . '" target="_blank"
                                                           class="btn purple btn-icon-only btn-circle"><i
                                                                    class="fa fa-eye"></i></a>' . $action;
            })
            ->editColumn('last_status', function ($order) {

                if ($order->last_status == 'new') {
                    return '<span class="label label-sm label-warning">New Order</span>';
                }
                if ($order->last_status == 'accepted') {
                    return '<span class="label label-sm label-primary">Accepted Order</span>';
                }
                if ($order->last_status == 'progress') {
                    return '<span class="label label-sm label-danger">Progress Order</span>';
                }
                if ($order->last_status == 'finished') {
                    return '<span class="label label-sm label-success">Completed Order</span>';
                }
            })
            ->addIndexColumn()
            ->rawColumns(['order_id', 'driver_name', 'merchant_name', 'client_name', 'location', 'last_status', 'action'])->toJson();
    }

    function clientOrdersData($client_id)
    {
        $order_user_id = $this->orderUser->where('user_id', $client_id)->pluck('id');
        $orders = $this->model->whereNotNull('last_status')->whereIn('user_order_id', $order_user_id)->orderByDesc('created_at');

        return datatables()->of($orders)
            ->filter(function ($query) {

                //                if (request()->filled('name')) {
                //                    $query->where('name', 'LIKE', '%' . request()->get('name') . '%');
                //                }

            })->addColumn('location', function ($order) {
                return '<a href="' . url(((getAuth()->type == 'admin') ? admin_user_tab_url() : getAuth()->type) . '/user/' . $order->OrderUser->user_id) . '" class="btn btn-circle btn-icon-only blue user-det" title="Address">
                                        <i class="fa fa-map"></i>
                                    </a>';
            })->addColumn('items_no', function ($order) {
                return $order->OrderProducts->count();
            })->addColumn('order_id', function ($order) {
                return '<a href="' . url(((getAuth()->type == 'admin') ? admin_report_tab_url() : getAuth()->type) . '/order/' . $order->id) . '">' . $order->id . '</a>';
            })->addColumn('driver_name', function ($order) {
                if (isset($order->Driver))
                    return '<a href="' . url(((getAuth()->type == 'admin') ? admin_user_tab_url() : getAuth()->type) . '/user-det/' . $order->Driver->id) . '">' . $order->Driver->username . '</a>';
                return '';
            })->addColumn('merchant_name', function ($order) {
                if (isset($order->Merchant))
                    return '<a href="' . url(((getAuth()->type == 'admin') ? admin_user_tab_url() : getAuth()->type) . '/user-det/' . $order->Merchant->id) . '">' . $order->Merchant->username . '</a>';
                return '';
            })->addColumn('client_name', function ($order) {
                if (isset($order->OrderUser))
                    return '<a href="' . url(((getAuth()->type == 'admin') ? admin_user_tab_url() : getAuth()->type) . '/user-det/' . $order->OrderUser->user_id) . '">' . $order->OrderUser->Client->username . '</a>';
                return '';
            })->editColumn('last_status', function ($user) {

                if ($user->last_status == 'new') {
                    return '<span class="label label-sm label-warning">New Order</span>';
                }
                if ($user->last_status == 'accepted') {
                    return '<span class="label label-sm label-primary">Accepted Order</span>';
                }
                if ($user->last_status == 'progress') {
                    return '<span class="label label-sm label-danger">Progress Order</span>';
                }
                if ($user->last_status == 'finished') {
                    return '<span class="label label-sm label-success">Completed Order</span>';
                }
            })->addColumn('action', function ($order) {
                $action = '';
                if ($order->last_status != 'finished') {

                    $action = '<a href="' . url(getAuth()->type . '/cancel-order/' . $order->id) . '"
                                                                class="btn btn-danger btn-icon-only btn-circle cancelOrder"
                                                                title="cancel"><i
                                                                    class="fa fa-times"></i>
                                                                    </a>';
                }
                return '<a href="' . url(((getAuth()->type == 'admin') ? admin_report_tab_url() : getAuth()->type) . '/order/' . $order->id) . '" target="_blank"
                                                           class="btn purple btn-icon-only btn-circle"><i
                                                                    class="fa fa-eye"></i></a>' . $action;
            })
            ->addIndexColumn()
            ->rawColumns(['order_id', 'driver_name', 'merchant_name', 'client_name', 'location', 'last_status', 'action'])->toJson();
    }

    function getAll(array $attributes)
    {
        // TODO: Implement getAll() method.
        return $this->model->all();
    }


    function getById($id)
    {
        if (auth()->user()->type == 'merchant')
            $order = $this->model->where('merchant_id', auth()->user()->id)->find($id);
        else if (auth()->user()->type == 'driver') {
            //            driver_id

            if (auth()->user()->driver_type_id == 2 && auth()->user()->is_active && auth()->user()->is_driver_available) { // free lance


                $merchants = MerchantDeliveryMethod::where('driver_type_id', 2)->pluck('merchant_id');
                $order = $this->model->with('OrderUser')->where('driver_source', 'third_part')->whereIn('merchant_id', $merchants);
            } else {
                // dragonmart and my team driver
                $order = $this->model->with('OrderUser')->where('driver_id', auth()->user()->id);
            }
            $order = $order->where('id', $id)->first();
            //            $order = $this->model->with('OrderUser')->where('driver_id', auth()->user()->id)->find($id);

        } else if (auth()->user()->type == 'client') {
            $order = $this->model->with('OrderUser')->find($id);
            if (isset($order) && $order->OrderUser->user_id != auth()->user()->id) {
                return response_api(false, 422, null, []);
            }
        }

        if (isset($order)) {
            return response_api(true, 200, null, $order);
        }
        return response_api(false, 422, null, []);
    }


    function getUserOrder($user_order_id)
    {
        $user_order = OrderUser::where('user_id', auth()->user()->id)->find($user_order_id);

        if (isset($user_order)) {
            return response_api(true, 200, null, $user_order);
        }
        return response_api(false, 422, null, []);
    }

    function getOrders(array $attributes)
    {

        $page_size = isset($attributes['page_size']) ? $attributes['page_size'] : max_pagination();
        $page_number = isset($attributes['page_number']) ? $attributes['page_number'] : 1;

        if (auth()->user()->type == 'merchant')
            $collection = $this->model->where('merchant_id', auth()->user()->id);
        if (auth()->user()->type == 'driver') {

            if (auth()->user()->driver_type_id == 2 && auth()->user()->is_active && auth()->user()->is_driver_available) { // free lance


                $merchants = MerchantDeliveryMethod::where('driver_type_id', 2)->pluck('merchant_id');
                $collection = $this->model->where('driver_source', 'third_part')->where('driver_status', '<>', 'rejected')->whereIn('merchant_id', $merchants);
            } else {
                // dragonmart and my team driver
                $collection = $this->model->where('driver_id', auth()->user()->id)->where('driver_status', '<>', 'rejected');
            }
        }

        if (isset($attributes['search'])) {

            $users = User::where('username', 'LIKE', '%' . $attributes['search'] . '%')->orWhere('mobile', 'LIKE', '%' . $attributes['search'] . '%')->pluck('id');
            $order_users = OrderUser::whereIn('user_id', $users)->pluck('id');

            $collection = $collection->whereIn('user_order_id', $order_users)->orWhere('user_order_id', $attributes['search']);
        }
        if ($attributes['status'] == 'pending') //  new
        {
            if (auth()->user()->type == 'driver')
                $collection = $collection->where(function ($query) {
                    $query->where('last_status', 'accepted')->where('driver_status', 'pending');
                });
            else {
                $collection = $collection->where('last_status', 'new');
            }
        } else if (auth()->user()->type == 'merchant' && ($attributes['status'] == 'active' || $attributes['status'] == 'finished')) //
        {
            if ($attributes['status'] == 'finished') {
                $collection = $collection->where('last_status', 'finished');
            } else // active
                $collection = $collection->where(function ($query) {
                    $query->where('last_status', 'progress')->orWhere('last_status', 'accepted');
                });
        } else {
            if (auth()->user()->type == 'driver') {
                if ($attributes['status'] == 'accepted')
                    $collection = $collection->where(function ($query) {
                        $query->where('driver_status', 'accepted')->orWhere('driver_status', 'pickup');
                    })->where('last_status', '<>', 'finished');
                if ($attributes['status'] == 'finished')
                    $collection = $collection->where('last_status', 'finished')->where('driver_id', auth()->user()->id);
            } else
                $collection = $collection->where('last_status', $attributes['status']);
        }


        $count = $collection->count();
        $page_count = page_count($count, $page_size);
        $page_number = $page_number - 1;
        $page_number = $page_number > $page_count ? $page_number = $page_count - 1 : $page_number;
        $object = $collection->take($page_size)->skip((int)$page_number * $page_size)->orderByDesc('created_at')->get();

        if (request()->segment(1) == 'api' || request()->ajax()) {
            if (count($object) > 0)
                return response_api(true, 200, null, $object, $page_count, $page_number);
            return response_api(true, 200, null, []);
        }
        return $object;
    }

    function getOrderClient(array $attributes)
    {

        $page_size = isset($attributes['page_size']) ? $attributes['page_size'] : max_pagination();
        $page_number = isset($attributes['page_number']) ? $attributes['page_number'] : 1;

        $client_service_ids = $this->serviceClient->where('user_id', auth()->user()->id)->pluck('id');
        $collection_request = $this->serviceRequest->whereIn('service_client_id', $client_service_ids);

        $user_order_ids = OrderUser::where('user_id', auth()->user()->id)->pluck('id');
        $collection_order = $this->model->whereIn('user_order_id', $user_order_ids);

        if (isset($attributes['search'])) {

            $users = User::where('username', 'LIKE', '%' . $attributes['search'] . '%')->orWhere('mobile', 'LIKE', '%' . $attributes['search'] . '%')->pluck('id');

            $order_users = OrderUser::whereIn('user_id', $users)->pluck('id');
            $collection_order = $collection_order->whereIn('user_order_id', $order_users)->orWhere('user_order_id', $attributes['search']);

            $client_service_ids = $this->serviceClient->where('user_id', $users)->pluck('id');
            $collection_request = $collection_request->whereIn('service_client_id', $client_service_ids)->orWhere('service_client_id', $attributes['search']);
        }


        if (\request()->segment(1) != 'api') { // web site


            if (isset($attributes['from']) && isset($attributes['to'])) {


                $collection_order = $collection_order->where(function ($query) use ($attributes) {
                    $query->whereDate('created_at', '>=', $attributes['from'])->whereDate('created_at', '<=', $attributes['to']);
                });
            }
        }


        if ($attributes['status'] == 'pending') // initial,pending, new, accept, progress
        {
            $collection_order = $collection_order->where(function ($query) {
                $query->whereNull('last_status')->orWhere('last_status', 'pending')->orWhere('last_status', 'new')->orWhere('last_status', 'accepted')->orWhere('last_status', 'progress');
            });

            $service_client_ids = $collection_request->where(function ($query) {
                $query->where('status', 'pending')->orWhere('status', 'accepted'); //->orWhere('status', 'progress');
            })->pluck('service_client_id');
        } else {
            $collection_order = $collection_order->where('last_status', $attributes['status']);

            if ($attributes['status'] == 'finished')
                $service_client_ids = $collection_request->where(function ($query) {
                    $query->where('status', 'finished')->orWhere('status', 'confirm_finished');
                })->pluck('service_client_id');
            else
                $service_client_ids = $collection_request->where('status', $attributes['status'])->pluck('service_client_id');;
        }


        $collection_request = $this->serviceClient->where('user_id', auth()->user()->id)->whereIn('id', $service_client_ids);

        $collection = collect($collection_order->get())->merge($collection_request->get());
        $collection = collect($collection->sortByDesc('created_at')->values()->all());

        $count = count($collection);
        $page_count = page_count($count, $page_size);
        $page_number = $page_number - 1;
        $page_number = $page_number > $page_count ? $page_number = $page_count - 1 : $page_number;
        $object = $collection->forPage((int)$page_number * $page_size, $page_size);


        if (request()->segment(1) == 'api' || request()->ajax()) {
            if (count($object) > 0)
                return response_api(true, 200, null, $object, $page_count, $page_number);
            return response_api(true, 200, null, []);
        }
        return $object;
    }

    /**
     * @param array $attributes
     * @return \Illuminate\Http\JsonResponse
     */
    function create(array $attributes)
    {

        $order_user = OrderUser::where('user_id', auth()->user()->id)->find($attributes['user_order_id']);

        if (!isset($order_user)) return response_api(false, 422, null, []);
        $orders = Order::where('user_order_id', $attributes['user_order_id'])->get();
        //        $orders = Order::whereNull('last_status')->where('user_order_id', $attributes['user_order_id'])->get();
        $count = 0;
        $order_user->calculated_price = 0;
        $order_user->total_shipment_price = 0;

        foreach ($orders as $order) {
            if (!isset($order) && isset($order->last_status))
                continue;

            //            $order_user = OrderUser::where('user_id', auth()->user()->id)->find($attributes['user_order_id']);
            $order_user->procurement_method = $attributes['procurement_method'];
            $order_user->calculated_price += $order->products_price;
            $order_user->total_shipment_price += $order->shipment_price;
            if (isset($attributes['address']))
                $order_user->address = $attributes['address'];
            if (isset($attributes['latitude']))
                $order_user->latitude = $attributes['latitude'];
            if (isset($attributes['longitude']))
                $order_user->longitude = $attributes['longitude'];

            if (!isset($attributes['received_datetime'])) {
                $received_datetime = Carbon::now();
            } else {
                $received_datetime = $attributes['received_datetime'];
            }
            $order_user->received_datetime = $received_datetime;

            if ($order_user->save()) {

                //                $order_status = new OrderStatus();
                //                $order_status->order_id = $order->id;
                //                $order_status->status = 'new';
                //                $order_status->save();
                //
                //                event(new UpdateOrderStatusEvent($order, 'new', null));
                //
                //                $this->notificationSystem->sendNotification(auth()->user()->id, $order->merchant_id, $order->id, 'send_order');

                $order_status = new OrderStatus();
                $order_status->order_id = $order->id;
                $order_status->status = 'pending'; // submit order but not paid
                $order_status->save();

                event(new UpdateOrderStatusEvent($order, 'pending', null));

                // start payment

                $count++;
            }
        }

        if ($count > 0) {

            //            return response_api(true, 200, 'Order was sent to merchant.', $orders);
            return response_api(true, 200, 'Please pay to start order.', $this->payment($orders));
        }
        return response_api(false, 422, 'Sending failure', []);
    }

    public function payOneOrder($order_id)
    {
        $user_order_id = OrderUser::where('user_id', auth()->user()->id)->pluck('id');
        if (count($user_order_id) > 0)
            $order = Order::where('last_status', 'pending')->where('id', $order_id)->whereIn('user_order_id', $user_order_id)->get();


        if (request()->segment(1) == 'api') {
            if (count($order) > 0) {
                return response_api(true, 200, null, $this->payment($order));
            }
            return response_api(false, 422, null, []);
        }

        $payment = $this->payment($order);
        return (isset($payment)) ? redirect($payment->payment_url) : redirect()->back();
    }

    function payment($orders)
    {
        //        $order = $this->model->where('last_status', 'pending')->find($order_id);
        //        if (!isset($order)) return null;

        //        dd($orders);
        $cc_phone_number = substr_replace(auth()->user()->mobile, "", -9);
        $phone_number = substr(auth()->user()->mobile, -9);

        $products = '';
        $quantity = 0;
        $total_price = 0;
        $product_price = 0;

        foreach ($orders as $order) {

            foreach ($order->order_products as $order_product) {
                $products .= $order_product->product->name . ',';
                $quantity += $order_product->quantity;
                $product_price += $order_product->price * $order_product->quantity;
            }

            $total_price = $product_price;
        }

        if (!isset($cc_phone_number) || empty($cc_phone_number))
            $cc_phone_number = '966';
        $address = auth()->user()->address;
        if (!isset($address) || empty($address)) {
            $address = 'Riyadh';
        }
        if (!isset($phone_number) || empty($phone_number))
            $phone_number = '555555555';

        $pt = Paytabs::getInstance('info@directiongoals.com', 'VzQbRYgrq2gvMeuuNnyo31Ld7ZtHmiMhRCtJBJa1MrxyF13spCRsDCGKCarYsdfkQJ4rseteF0Nl2QNrsFU5hBQULhSev8zlRDNj');
        $result = $pt->create_pay_page(array(
            "merchant_email" => 'info@directiongoals.com',
            'secret_key' => 'VzQbRYgrq2gvMeuuNnyo31Ld7ZtHmiMhRCtJBJa1MrxyF13spCRsDCGKCarYsdfkQJ4rseteF0Nl2QNrsFU5hBQULhSev8zlRDNj',
            'title' => auth()->user()->username,
            'cc_first_name' => auth()->user()->username,
            'cc_last_name' => auth()->user()->username,
            'email' => auth()->user()->email,
            'cc_phone_number' => $cc_phone_number,
            'phone_number' => $phone_number,
            'billing_address' => $address,
            'city' => "Manama",
            'state' => "Capital",
            'postal_code' => $cc_phone_number . "00",
            'country' => "SAU",
            'address_shipping' => $address,
            'city_shipping' => "Manama",
            'state_shipping' => "Capital",
            'postal_code_shipping' => $cc_phone_number . "00",
            'country_shipping' => "USA",
            "products_per_title" => $products,
            'currency' => "SAR", // SAR
            "unit_price" => $product_price,
            'quantity' => 1,
            'other_charges' => "0",
            'amount' => $total_price . ".00",
            'discount' => "0",
            "msg_lang" => "english",
            "reference_no" => $orders[0]->user_order_id,
            "site_url" => url('/'),
            'return_url' => url('/result-data'),
            "cms_with_version" => "API USING PHP"
        ));

        if ($result->response_code == 4012) {
            foreach ($orders as $order) {
                $product_price = 0;

                foreach ($order->order_products as $order_product) {
                    $product_price += $order_product->price;
                }
                $payment = Payment::where('order_id', $order->id)->where('status', 'pending')->first();
                if (!isset($payment))
                    $payment = new Payment();

                $payment->user_id = auth()->user()->id;
                $payment->order_id = $order->id;
                $payment->p_id = $result->p_id;
                $payment->reference_no = $order->user_order_id;
                $payment->amount = $total_price;
                $payment->currency = 'SAR';
                $payment->order_status = $order->last_status;
                $payment->save();
            }
            ///
            ///
            ///
            return $result;
        }
        return [];
    }

    function checkout_cart(array $attributes)
    {
        $order_user = new OrderUser();
        $order_user->user_id = auth()->user()->id;
        if ($order_user->save()) {
            $orders = [];

            foreach ($attributes['cart_product_id'] as $cart_product_id) {
                $cart_product = CartProduct::with('Cart')->where('status', 'pending')->find($cart_product_id);
                if (!isset($cart_product) || !isset($cart_product->Cart) || $cart_product->Cart->user_id != auth()->user()->id) continue;

                $order = Order::where('user_order_id', $order_user->id)->where('merchant_id', $cart_product->merchant_id)->first();
                $cart_product_customs = CartProductCustom::where('cart_product_id', $cart_product_id)->get();

                if (!isset($order))
                    $order = new Order();

                $merchant = User::find($cart_product->merchant_id);
                $order->user_order_id = $order_user->id;
                $order->store_id = $cart_product->store_id;
                $order->merchant_id = $cart_product->merchant_id;
                $order->commission_rate = $merchant->commission_rate;
                $order->products_price += $cart_product->price * $cart_product->quantity;
                if ($order->save()) {
                    $orders[] = $order->id;
                    $order_product = new OrderProduct();
                    //                    `order_id`, `cart_product_id`,
                    $order_product->order_id = $order->id;
                    $order_product->cart_product_id = $cart_product_id;
                    $order_product->price = $cart_product->price;
                    $order_product->quantity = $cart_product->quantity;
                    //                    $order_product->custom_id = $cart_product->custom_id;

                    if ($order_product->save()) {
                        if (count($cart_product_customs) > 0)
                            foreach ($cart_product_customs as $cart_product_custom) {
                                $order_product_custom = new OrderProductCustom();
                                $order_product_custom->order_product_id = $order_product->id;
                                $order_product_custom->custom_id = $cart_product_custom->custom_id;
                                $order_product_custom->price = $cart_product_custom->price;
                                $order_product_custom->save();
                            }
                        $cart_product->status = 'completed'; // means out of cart
                        $cart_product->save();
                    }
                }
            }

            $orders = array_unique($orders);

            $orders = Order::whereIn('id', $orders)->get();
            return response_api(true, 200, 'Add initial order successfully.', $orders);
        }
        return response_api(false, 422, 'Add order failure', []);
    }

    function addDirectOrder(array $attributes)
    {
        $product = $this->product->find($attributes['product_id']);

        if (!isset($product))
            return response_api(false, 422, 'Add order failure', []);

        // check the available quantity
        if ($product->available_quantity < $attributes['quantity']) {
            return response_api(false, 422, 'This quantity does not exists in the store', []);
        }
        $order_user = new OrderUser();
        $order_user->user_id = auth()->user()->id;
        if ($order_user->save()) {
            $order = Order::where('user_order_id', $order_user->id)->where('merchant_id', $product->merchant_id)->first();

            if (!isset($order))
                $order = new Order();

            $order->commission_rate = $product->merchant->commission_rate;

            $total_price = $product->price;
            //            $total_price = 0;

            if ($product->has_custom) {

                if (isset($attributes['custom_id'])) {
                    foreach ($attributes['custom_id'] as $custom_id) {

                        $product_custom = ProductCustomization::where('product_id', $product->id)->find($custom_id);

                        if ($product_custom->price == 0) {
                            $price = 0;
                        } else
                            $price = $product_custom->price;


                        $total_price += $price;
                    }
                }

                //                if (isset($attributes['custom_id']))
                //                    $product_custom = ProductCustomization::where('product_id', $product->id)->find($attributes['custom_id']);
                //                else
                //                    $product_custom = ProductCustomization::where('product_id', $product->id)->where('is_default', 1)->first();
                //                if (!isset($product_custom->price)) {
                //                    $price = $product->price;
                //                } else
                //                    $price = $product->price + $product_custom->price;

            }

            // if is offer set price offer in cart
            if ($product->is_offer) {
                $total_price = $total_price - (($total_price * $product->offer_percentage) / 100.0);
            }


            $order->user_order_id = $order_user->id;
            $order->store_id = $product->store_id;
            $order->merchant_id = $product->merchant_id;
            $order->products_price += $total_price * $attributes['quantity'];
            if ($order->save()) {

                $order_product = new OrderProduct();
                $order_product->order_id = $order->id;
                $order_product->cart_product_id = $product->id;
                $order_product->price = $total_price;
                $order_product->quantity = $attributes['quantity'];

                //                    $order_product->custom_id = $product_custom->id;

                $order_product->type = 'order';
                if ($order_product->save()) {
                    if (isset($product_custom)) {


                        foreach ($attributes['custom_id'] as $custom_id) {
                            $product_custom = ProductCustomization::where('product_id', $product->id)->find($custom_id);

                            $order_product_custom = new OrderProductCustom();
                            $order_product_custom->order_product_id = $order_product->id;
                            $order_product_custom->custom_id = $custom_id;
                            $order_product_custom->price = $product_custom->price;
                            $order_product_custom->save();
                        }
                    }

                    $order_user->calculated_price = $total_price * $attributes['quantity'];
                    $order_user->save();
                    return response_api(true, 200, 'Add initial order successfully.', $order);
                }
            }
        }
        return response_api(false, 422, 'Add order failure', []);
    }

    function confirmOrder(array $attributes)
    {
        $order = $this->model->where('merchant_id', auth()->user()->id)->find($attributes['order_id']);

        if (isset($attributes['driver_source'])) {
            $order->driver_source = $attributes['driver_source'];
            if ($attributes['driver_source'] == 'my_driver')
                $order->driver_id = $attributes['driver_id'];
        }
        $order->last_status = 'accepted';
        //        $order->driver_status = 'new';
        if ($order->save()) {

            $order_status = new OrderStatus();
            $order_status->order_id = $order->id;
            $order_status->status = 'accepted';
            $order_status->save();
            $this->notificationSystem->sendNotification(auth()->user()->id, $order->order_user->user_id, $order->id, 'accept_order');
            if (isset($attributes['driver_id']))
                $this->notificationSystem->sendNotification(auth()->user()->id, $attributes['driver_id'], $order->id, 'accept_order');

            if (isset($attributes['driver_source']) && $attributes['driver_source'] == 'third_part') {
                $driver_free_lance = User::where('type', 'driver')->where('driver_type_id', 2)->where('is_active', 1)->where('is_driver_available', 1)->pluck('id');
                foreach ($driver_free_lance as $freelance)
                    $this->notificationSystem->sendNotification(auth()->user()->id, $freelance, $order->id, 'send_order');
            }

            //            event(new UpdateOrderStatusEvent($order, 'new'));
            return response_api(true, 200, 'The order was accepted successfully.', $order);
        }
        return response_api(false, 422, 'The order was not accepted.', []);
    }

    function update(array $attributes, $id = null)
    {
    }

    function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function dropOff(array $attributes)
    {
        $order = $this->model->where('last_status', 'progress')->where('driver_status', 'pickup')->find($attributes['order_id']);

        if (isset($order)) { // send notification client and merchant
            $this->notificationSystem->sendNotification(auth()->user()->id, $order->merchant_id, $order->id, 'drop_off_driver');
            $this->notificationSystem->sendNotification(auth()->user()->id, $order->order_user->user_id, $order->id, 'drop_off_driver');

            return response_api(true, 200, 'driver was drop off order.', []);
        }
        return response_api(false, 422, 'You can not make drop off for this order.', []);
    }

    // by admin panel (merchant or super admin)
    public function canceledOrder($order_id)
    {
        if (getAuth()->type == 'admin') {
            $order = $this->model->where(function ($query) {
                $query->where('last_status', 'new')->orWhere('last_status', 'accepted')->orWhere('last_status', 'progress');
            })->find($order_id);
        } else {
            $order = $this->model->where('merchant_id', getAuth()->user_id)->where('last_status', 'new')->find($order_id);
        }

        if (!isset($order))
            return response_api(false, 422, 'Order does not exists', []);

        if (getAuth()->type == 'admin') {
            $order_status = new OrderStatus();
            $order_status->order_id = $order_id;
            $order_status->status = 'canceled';
            $order_status->save();

            $order->last_status = 'canceled';
            $order->save();

            //            dd($order);
            $this->notificationSystem->sendNotification(null, $order->merchant_id, $order->id, 'canceled_order');
            $this->notificationSystem->sendNotification(null, $order->order_user->user_id, $order->id, 'canceled_order');
            return response_api(true, 200, null, []);
        }
        if (getAuth()->type == 'merchant' && $order->last_status != 'new')
            return response_api(false, 422, 'Order does not exists', []);

        $order_status = new OrderStatus();
        $order_status->order_id = $order_id;
        $order_status->status = 'rejected';
        $order_status->save();
        $order->last_status = 'rejected';
        $order->save();
        $this->notificationSystem->sendNotification(null, $order->order_user->user_id, $order->id, 'reject_order');

        return response_api(true, 200, null, []);
    }

    // merchant can accept order from admin panel
    public function acceptOrder(array $attributes, $order_id)
    {
        $order = $this->model->where('merchant_id', getAuth()->user_id)->where('last_status', 'new')->find($order_id);

        if (!isset($order))
            return response_api(false, 422, 'Order does not exists', []);

        $order_status = new OrderStatus();
        $order_status->order_id = $order_id;
        $order_status->user_id = $order->merchant_id;
        $order_status->status = 'accepted';
        $order_status->edit_at = 'last_status';
        $order_status->save();

        $order->last_status = 'accepted';
        $order->driver_status = 'new';
        $order->save();

        if (isset($attributes['delivery_method'])) {
            $order->driver_source = $attributes['delivery_method'];

            if ($attributes['delivery_method'] == 'store_driver')
                $order->driver_id = $attributes['driver_id'];

            $order->save();

            if (isset($attributes['driver_id']))
                $this->notificationSystem->sendNotification(getAuth()->user_id, $attributes['driver_id'], $order->id, 'accept_order');

            if ($attributes['delivery_method'] == 'freelancer_driver') {
                $driver_free_lance = User::where('type', 'driver')->where('driver_type_id', 2)->where('is_active', 1)->where('is_driver_available', 1)->pluck('id');
                foreach ($driver_free_lance as $freelance)
                    $this->notificationSystem->sendNotification(getAuth()->user_id, $freelance, $order->id, 'send_order');
            }
        }

        $this->notificationSystem->sendNotification(getAuth()->user_id, $order->order_user->user_id, $order->id, 'accept_order');
        return response_api(true, 200, null, []);
    }

    public function readyOrder(array $attributes, $order_id)
    {
        $order = $this->model->where('merchant_id', getAuth()->user_id)->where('last_status', 'accepted')->find($order_id);

        if (!isset($order))
            return response_api(false, 422, 'Order does not exists', []);

        $order_status = new OrderStatus();
        $order_status->order_id = $order_id;
        $order_status->user_id = $order->merchant_id;
        $order_status->status = 'finished';
        $order_status->edit_at = 'last_status';
        $order_status->save();

        $order->last_status = 'finished';
        $order->save();

        $this->notificationSystem->sendNotification(getAuth()->user_id, $order->order_user->user_id, $order->id, 'ready_order');
        return response_api(true, 200, null, []);
    }

    public function handOverOrder(array $attributes, $order_id)
    {
        $order = $this->model->where('merchant_id', getAuth()->user_id)->where('last_status', 'finished')->find($order_id);

        if (!isset($order))
            return response_api(false, 422, 'Order does not exists', []);

        $order_status = new OrderStatus();
        $order_status->order_id = $order_id;
        $order_status->user_id = $order->merchant_id;
        $order_status->status = 'pickup';
        $order_status->edit_at = 'last_status';
        $order_status->save();

        $order->last_status = 'pickup';
        $order->save();

        $this->notificationSystem->sendNotification(getAuth()->user_id, $order->order_user->user_id, $order->id, 'handover_order');
        return response_api(true, 200, null, []);
    }

    public function cancelProduct(array $attributes, $product_id)
    {
        
        $product = OrderProduct::find($product_id);
        
        if (!isset($product))
            return response_api(false, 422, 'Product does not exists', []);

        $product->delete();

        if (!$product->trashed()) {
            return response_api(false, 422, 'Product has not been deleted', []);
        }

        //$this->notificationSystem->sendNotification(getAuth()->user_id, $product->order_user->user_id, $product->id, 'product_deleted', $product->product->name);
        return response_api(true, 200, null, []);
    }

    public function changeStatus(array $attributes)
    {

        $order = $this->model->with('OrderUser')->find($attributes['order_id']);

        if (auth()->user()->type == 'merchant' || auth()->user()->type == 'client') {
            if ($attributes['status'] == 'accepted' || $attributes['status'] == 'rejected') {
                if ($order->merchant_id != auth()->user()->id || $order->last_status != 'new')
                    return response_api(false, 422, 'Change order status failure', []);
            }
            if ($attributes['status'] == 'finished' || $attributes['status'] == 'canceled') {
                if ($order->OrderUser->user_id != auth()->user()->id || ($attributes['status'] == 'canceled' && ($order->last_status != 'new' && $order->last_status != 'accepted')) || ($attributes['status'] == 'finished' && $order->last_status != 'progress'))
                    return response_api(false, 422, 'Change order status failure', []);
            }
            $order_status = new OrderStatus();
            $order_status->order_id = $attributes['order_id'];
            $order_status->status = $attributes['status'];
            if ($order_status->save()) {

                $reject_reason = null;
                if ($attributes['status'] == 'reject') {

                    $reject_reason = $attributes['reject_reason'];
                    $payment = Payment::where('order_id', $attributes['order_id'])->first();
                    $refunded_amount = $payment->amount;
                    $this->payment->refund($payment->p_id, $refunded_amount, $reject_reason);

                    $this->notificationSystem->sendNotification(auth()->user()->id, $order->OrderUser->user_id, $order->id, 'reject_order', $reject_reason);
                }
                if ($attributes['status'] == 'canceled') {
                    //
                    $payment = Payment::where('order_id', $attributes['order_id'])->first();

                    $refunded_amount = $payment->amount;

                    if ($order->last_status == 'accepted' && $order->driver_status == 'accepted') {
                        $refunded_amount = ($payment->amount - ($payment->amount * $order->Merchant->refund_commission_rate / 100.0));
                    }
                    $this->payment->refund($payment->p_id, $refunded_amount, 'cancel order');

                    $this->notificationSystem->sendNotification(auth()->user()->id, $order->merchant_id, $order->id, 'canceled_order');
                }
                if ($attributes['status'] == 'accepted') {
                    //
                    $this->notificationSystem->sendNotification(auth()->user()->id, $order->OrderUser->user_id, $order->id, 'accept_order');
                }
                if ($attributes['status'] == 'finished') {
                    //
                    $this->notificationSystem->sendNotification(auth()->user()->id, $order->merchant_id, $order->id, 'finished_order');
                    $this->notificationSystem->sendNotification(auth()->user()->id, $order->driver_id, $order->id, 'finished_order');
                }

                if ($attributes['status'] == 'finished') {
                    $order->actual_received_date = Carbon::now();
                    $order->save();
                }
                event(new UpdateOrderStatusEvent($order, $attributes['status'], $reject_reason));
                return response_api(true, 200, 'Change order status Successfully.', $order_status);
            }
            return response_api(false, 422, 'Change order status failure', []);
        } else if (auth()->user()->type == 'driver') { // (accepted,progress,rejected,pickup)

            $order->driver_id = auth()->user()->id;

            if ($attributes['status'] == 'progress') { // start navigation
                $order_status = new OrderStatus();
                $order_status->order_id = $attributes['order_id'];
                $order_status->status = $attributes['status'];
                if ($order_status->save()) {
                    $this->notificationSystem->sendNotification(auth()->user()->id, $order->merchant_id, $order->id, 'start_navigation');
                    $this->notificationSystem->sendNotification(auth()->user()->id, $order->OrderUser->user_id, $order->id, 'start_navigation');

                    event(new UpdateOrderStatusEvent($order, $attributes['status']));
                }
            } else {
                $order->driver_status = $attributes['status'];
                if ($attributes['status'] == 'accepted') {
                    $this->notificationSystem->sendNotification(auth()->user()->id, $order->merchant_id, $order->id, 'accepted_driver');
                }
                if ($attributes['status'] == 'pickup') {
                    $this->notificationSystem->sendNotification(auth()->user()->id, $order->merchant_id, $order->id, 'pickup_driver');
                }
                if ($attributes['status'] == 'rejected') {
                    $this->notificationSystem->sendNotification(auth()->user()->id, $order->merchant_id, $order->id, 'rejected_driver', $attributes['reject_reason']);
                }
            }

            if ($attributes['status'] == 'rejected')
                $order->driver_reject_reason = $attributes['reject_reason'];
            $order->save();
            return response_api(true, 200, 'Driver ' . $attributes['status'] . ' the request.', $order);
        }
    }


    public function assignDriver(array $attributes)
    {

        $order = $this->model->find($attributes['order_id']);

        $order->driver_source = $attributes['delivery_method'];
        if (isset($attributes['driver_id']))
            $order->driver_id = $attributes['driver_id'];

        if ($order->save()) {

            if ($attributes['delivery_method'] == 'third_part') {
                $driver_free_lance = User::where('type', 'driver')->where('driver_type_id', 2)->where('is_active', 1)->where('is_driver_available', 1)->pluck('id');

                foreach ($driver_free_lance as $freelance)
                    $this->notificationSystem->sendNotification(null, $freelance, $order->id, 'send_order');
            } else {

                $this->notificationSystem->sendNotification(null, $order->driver_id, $order->id, 'assign_driver');
                $this->notificationSystem->sendNotification(null, $order->merchant_id, $order->id, 'notify_merchant_assign_driver', $order->driver->username);
            }


            return response_api(true, 200, null, $order);
        }
        return response_api(false, 422, null, []);
    }
}
