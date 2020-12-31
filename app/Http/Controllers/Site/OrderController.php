<?php

namespace App\Http\Controllers\Site;

use App\Http\Requests\Api\Order\PayOrderRequest;
use App\Order;
use App\OrderUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquents\OrderEloquent;
use App\Repositories\Eloquents\CartEloquent;
use Auth;
use Session;


class OrderController extends Controller
{
    //
    private $order;
    private $cart;

    public function __construct(OrderEloquent $orderEloquent, CartEloquent $cartEloquent)
    {
        parent::__construct();
        $this->cart = $cartEloquent;
        $this->order = $orderEloquent;
    }


    public function directorderpage(Request $request)
    {


        if (Auth::user()) {


            $r['status'] = 'pending';
            $orders = $this->order->getOrderClient($r);

            return view(site_vw() . '.order.list', compact('orders'));
        }

        Session::flash('message', 'You must be login to complete order!');
        Session::flash('alert-class', 'alert-danger');
        return redirect(site_url() . '/login')->withCookie(cookie('referrer', site_url() . '/shipping-cart', 5));
    }

//pay one order from list (client)
    public function payOneOrder($order_id)
    {
        $order = Order::where('last_status', 'pending')->find($order_id);

        if (!isset($order) || $order->order_user->user_id != auth()->user()->id)
            return redirect()->back();

        return $this->order->payOneOrder($order_id);
    }

    public function list(Request $request)
    {


        if (Auth::user()) {
            // set all cart to checkout

            // get all cart
            $card = $this->cart->getAuthCart();
            $card = json_encode($card);
            $card = json_decode($card);
            $card = $card->original->items;


            if ($card) {
                $arr = [];

                foreach ($card as $c) {
                    foreach ($c->products_cart as $prod) {
                        $arr[] = $prod->id;
                    }
                }
                $r['cart_product_id'] = $arr;
                $this->order->checkout_cart($r);
            }


            // get initial order
//            $r['status'] = 'pending';
//            $orders = $this->order->getOrderClient($r);
            $user_order_ids = OrderUser::where('user_id', auth()->user()->id)->pluck('id');
            $orders_ = Order::whereNull('last_status')->whereIn('user_order_id', $user_order_ids)->latest()->first();
            $orders [] = $orders_;

            return view(site_vw() . '.order.list', compact('orders'));
        }

        Session::flash('message', 'You must be login to complete order!');
        Session::flash('alert-class', 'alert-danger');
        return redirect(site_url() . '/login')->withCookie(cookie('referrer', site_url() . '/shipping-cart', 5));
    }

    public function listCheckOut($order_id)
    {


        if (Auth::user()) {
            // set all cart to checkout
            // get initial order
            $user_order_ids = OrderUser::where('user_id', auth()->user()->id)->pluck('id');
            $orders_ = Order::whereNull('last_status')->whereIn('user_order_id', $user_order_ids)->find($order_id);
            if (!isset($orders_))
                return redirect()->back();
            $orders [] = $orders_;
            return view(site_vw() . '.order.list', compact('orders'));
        }

        Session::flash('message', 'You must be login to complete order!');
        Session::flash('alert-class', 'alert-danger');
        return redirect(site_url() . '/login')->withCookie(cookie('referrer', site_url() . '/shipping-cart', 5));
    }


    public function ordersCategory($status, $from = null, $to = null)
    {


        $r['status'] = $status;
        if ($from != null && $to != null) {
            $r['from'] = $from;
            $r['to'] = $to;
        }
        $orders = $this->order->getOrderClient($r);

        ///dd($orders[1]->services);

        return view(site_vw() . '.order.orders-category', compact('orders'));
    }


    public function addOrderOneProduct(Request $request)
    {


        if (Auth::user()) {
            return $this->order->addDirectOrder($request->all());
        } else {

            $url = url(site_url() . '/product-page/' . $request->product_id);

            $m2 = url(site_url() . '/login?redirectpage=' . $url);

            return response(['status' => false, 'redirect' => $m2]);
        }

    }


    public function addOrder(Request $request)
    {


        return $this->order->create($request->all());


    }
}
