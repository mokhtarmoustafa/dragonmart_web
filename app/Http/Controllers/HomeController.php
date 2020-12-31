<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderProduct;
use App\OrderUser;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $data = [
            'users_count' => User::where('type', 'client')->count(),
            'merchants_count' => User::where('type', 'merchant')->count(),
            'products_count' => Product::count(),
            'orders_count' => Order::where('last_status', '!=', 'pending')->where('last_status', '!=', 'canceled')->count(),
            //            'active_drivers' => $active_drivers,
        ];

        return view('admin.home', $data);
    }

    public function ordersCities()
    {
        $orders_cities = [];
        if (getAuth()->type == 'admin')
            $orders_cities = OrderUser::select(DB::raw('count(*) as `count`'), DB::raw('users.city_id'), DB::raw('cities.name_en'))
                ->join('users', 'order_users.user_id', '=', 'users.id')
                ->join('orders', 'orders.user_order_id', '=', 'order_users.id')
                ->leftJoin('cities', 'users.city_id', '=', 'cities.id')
                ->where('orders.last_status', 'finished')
                ->groupby(['users.city_id', 'cities.name_en'])
                ->orderBy('users.city_id', 'ASC')->get();
        if (getAuth()->type == 'merchant')
            $orders_cities = OrderUser::select(DB::raw('count(*) as `count`'), DB::raw('users.city_id'), DB::raw('cities.name_en'))
                ->join('users', 'order_users.user_id', '=', 'users.id')
                ->join('orders', 'orders.user_order_id', '=', 'order_users.id')
                ->leftJoin('cities', 'users.city_id', '=', 'cities.id')
                ->where('orders.merchant_id', getAuth()->id)
                ->where('orders.last_status', 'finished')
                ->groupby(['users.city_id', 'cities.name_en'])
                ->orderBy('users.city_id', 'ASC')->get();
        return response_api(true, 200, null, $orders_cities);
    }

    public function topSellings()
    {
        $topSellings = OrderProduct::select(DB::raw('count(cart_products.id) as `count`'), 'cart_products.product_id')
            ->join('cart_products', 'order_products.cart_product_id', '=', 'cart_products.id')
            ->join('orders', 'orders.id', '=', 'order_products.order_id')
            ->where('orders.last_status', 'finished')
            ->where('orders.merchant_id', getAuth()->id)
            ->groupby('cart_products.product_id')
            ->orderByDesc('count')
            ->get();
        return response_api(true, 200, null, $topSellings);
    }

    public function newProducts()
    {
        $new_products = [];
        if (getAuth()->type == 'admin')
            $new_products = Product::select(DB::raw('count(id) as `count`'), DB::raw('DATE_FORMAT(created_at, "%b") daily'), DB::raw('DATE_FORMAT(created_at, "%Y") year'), DB::raw('MONTH(created_at) d'))
                ->groupby('daily', 'd', 'year')
                ->orderBy('year', 'DESC')
                ->orderBy('d', 'DESC')
                ->get();
        return response_api(true, 200, null, $new_products);
    }

    public function saleProducts()
    {

        $saleProducts = OrderUser::select(DB::raw('count(*) as `count`'), DB::raw('DATE_FORMAT(order_users.created_at, "%b") daily'), DB::raw('DATE_FORMAT(order_users.created_at, "%Y") year'), DB::raw('MONTH(order_users.created_at) d'))
            ->join('orders', 'orders.user_order_id', '=', 'order_users.id')
            ->where('orders.last_status', 'finished')
            ->where('orders.merchant_id', getAuth()->id)
            ->groupby('daily', 'd', 'year')
            ->orderBy('year', 'ASC')
            ->orderBy('d', 'ASC')
            ->get();

        return response_api(true, 200, null, $saleProducts);
    }

    public function latestMerchants()
    {
        $latest_merchants = [];
        if (getAuth()->type == 'admin')
            $latest_merchants = User::where('type', 'merchant')->select(DB::raw('count(id) as `count`'), DB::raw('DATE_FORMAT(created_at, "%b") daily'), DB::raw('DATE_FORMAT(created_at, "%Y") year'), DB::raw('MONTH(created_at) d'))
                ->groupby('daily', 'd', 'year')
                ->orderBy('year', 'DESC')
                ->orderBy('d', 'DESC')
                ->get();
        return response_api(true, 200, null, $latest_merchants);
    }

    public function revenueOrder()
    {
        $revenue_orders = [];
        if (getAuth()->type == 'admin')
            $revenue_orders = Order::where('last_status', 'finished')->select(DB::raw('ROUND(SUM((commission_rate*products_price)/100.0 + shipment_price),2) as `revenue_`'), DB::raw('DATE_FORMAT(created_at, "%b") daily'), DB::raw('DATE_FORMAT(created_at, "%Y") year'), DB::raw('MONTH(created_at) d'))
                ->groupby('daily', 'd', 'year')
                ->orderBy('year', 'DESC')
                ->orderBy('d', 'DESC')
                ->get();
        return response_api(true, 200, null, $revenue_orders);
    }
}
