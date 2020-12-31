<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\Cart\CheckoutCartRequest;
use App\Http\Requests\Api\Order\ChangeStatusRequest;
use App\Http\Requests\Api\Order\ConfirmOrderRequest;
use App\Http\Requests\Api\Order\CreateOrderRequest;
use App\Http\Requests\Api\Order\DirectOrderRequest;
use App\Http\Requests\Api\Order\DropOffRequest;
use App\Http\Requests\Api\Order\GetClientOrderRequest;
use App\Http\Requests\Api\Order\GetMerchantOrderRequest;
use App\Http\Requests\Api\Order\PayOrderRequest;
use App\Repositories\Eloquents\OrderEloquent;
use App\Repositories\Eloquents\PaymentEloquent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    //

    private $order;

    public function __construct(OrderEloquent $orderEloquent)
    {
        $this->order = $orderEloquent;
    }

    public function postOrder(CreateOrderRequest $request)
    {
        return $this->order->create($request->all());
    }

    // customer will send orders to merchants
    public function checkoutCart(CheckoutCartRequest $request)
    {
        return $this->order->checkout_cart($request->all());
    }

    // customer will add product to order directly (initial order)
    public function addDirectOrder(DirectOrderRequest $request)
    {
        return $this->order->addDirectOrder($request->all());
    }

    // merchant will confirm request by adding drivers
    public function confirmOrder(ConfirmOrderRequest $request)
    {
        return $this->order->confirmOrder($request->all());
    }

    public function changeStatus(ChangeStatusRequest $request)
    {
        return $this->order->changeStatus($request->all());
    }

    // driver will make drop off to notify client and merchant that order was reached
    public function dropOff(DropOffRequest $request)
    {
        return $this->order->dropOff($request->all());
    }

    public function getUserOrder($user_order_id)
    {
        return $this->order->getUserOrder($user_order_id);
    }

    //order details
    public function getOrder($order_id)
    {
        return $this->order->getById($order_id);
    }

    //pay one order from list (client)
    public function payOneOrder(PayOrderRequest $request)
    {
        return $this->order->payOneOrder($request->get('order_id'));
    }


    // get buyer requests, or by driver
    public function getOrders(GetMerchantOrderRequest $request)
    {
        return $this->order->getOrders($request->all());

    }

    // get client orders
    public function getOrderClient(GetClientOrderRequest $request)
    {
        return $this->order->getOrderClient($request->all());

    }
}
