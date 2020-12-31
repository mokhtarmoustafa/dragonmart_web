<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use App\DriverType;

use DB;



class MerchantController extends Controller
{
    //

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        // $active_drivers = Order::select(DB::raw('count(*) as `count`'), 'orders.driver_id', 'users.username')
        //     ->join('users', 'orders.driver_id', '=', 'users.id')
        //     ->join('store_drivers', 'store_drivers.driver_id', '=', 'orders.driver_id')
        //     ->where('store_drivers.merchant_id', getAuth()->id)
        //     ->groupBy('orders.driver_id', 'users.username')
        //     ->orderByDesc('count')
        //     ->take(10)->get();

        // $data = [
        //     'active_drivers' => $active_drivers,
        //     'new_orders' => Order::where('merchant_id', auth()->guard('admin')->user()->user_id)->where('last_status', 'new')->count(),
        //     'current_orders' => Order::where('merchant_id', auth()->guard('admin')->user()->user_id)->where(function ($query) {
        //         $query->where('last_status', 'accepted')->orWhere('last_status', 'progress');
        //     })->count(),
        //     'completed_orders' => Order::where('merchant_id', auth()->guard('admin')->user()->user_id)->where('last_status', 'finished')->count(),

        // ];

        $driver_types = DriverType::all();
        $new = Order::where('merchant_id', auth()->guard('admin')->user()->user_id)->where('last_status', 'new')->count();
        $current = Order::where('merchant_id', auth()->guard('admin')->user()->user_id)->where(function ($query) {
            $query->where('last_status', 'accepted')->orWhere('last_status', 'progress');
        })->count();
        $completed = Order::where('merchant_id', auth()->guard('admin')->user()->user_id)->where('last_status', 'pickup')->count();

        $rejected = Order::where('merchant_id', auth()->guard('admin')->user()->user_id)->where('last_status', 'rejected')->count();

        $data = [
            'main_title' => 'Orders',
            'icon' => 'fa fa-shopping-cart',
            'driver_types' => $driver_types,
            'new' => $new,
            'current' => $current,
            'completed' => $completed,
            'rejected' => $rejected,
        ];
        // return view(merchant_order_vw() . '.index', $data);


        return view('merchant.'.getVersion().'.home', $data);
    }



}
