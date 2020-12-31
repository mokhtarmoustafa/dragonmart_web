<?php
/**
 * Created by PhpStorm.
 * UserRequest: mohammedsobhei
 * Date: 5/2/18
 * Time: 11:43 PM
 */

namespace App\Repositories\Eloquents;

use App\City;
use App\Events\UpdateOrderStatusEvent;
use App\Order;
use App\OrderStatus;
use App\Payment;
use App\Product;
use App\Repositories\Interfaces\Repository;
use App\Repositories\Uploader;
use Damas\Paytabs\paytabs;

class PaymentEloquent extends Uploader implements Repository
{

    private $model, $notificationSystem;

    public function __construct(Payment $model, NotificationSystemEloquent $notificationSystem)
    {
        $this->model = $model;
        $this->notificationSystem = $notificationSystem;

    }


    function getAll(array $attributes)
    {
        // TODO: Implement getAll() method.
    }

    function getById($id)
    {

    }

    function create(array $attributes)
    {

    }

    function createPayment($payment_reference, $result)
    {
        $payments = $this->model->where('p_id', intval($payment_reference))->get();
        foreach ($payments as $payment) {
            $payment->transaction_id = $result->transaction_id;
            $payment->invoice_id = $result->pt_invoice_id;
            $payment->payment_reference = $payment_reference;
            $payment->status = 'paid';
            $payment->order_status = 'new';
            $payment->save();
        }
//
        $payment_orders_id = $this->model->where('p_id', intval($payment_reference))->pluck('order_id');
//
        $orders = Order::where('last_status', 'pending')->whereIn('id', $payment_orders_id)->get();
        foreach ($orders as $order) {
            $order_status = OrderStatus::where('order_id', $order->id)->where('status', 'pending')->first();
            $order_status->status = 'new';
            $order_status->save();
            event(new UpdateOrderStatusEvent($order, 'new', null));
            $this->notificationSystem->sendNotification($order->order_user->user_id, $order->merchant_id, $order->id, 'send_order');

        }
        return response_api(true, 200, null, $payment);

//        return response_api(false, 422, null, []);

    }

    function refund($payment_reference, $amount, $refund_reason)
    {

        $payment = $this->model->where('status', 'paid')->where('p_id', $payment_reference)->first();
        if (!isset($payment)) return false;
        $pt = Paytabs::getInstance(env('MERCHANT_EMAIL'), env('MERCHANT_SECRET_KEY'));
        $result = $pt->refund_payment([
            'refund_amount' => $amount,
            'refund_reason' => $refund_reason,
            'transaction_id' => $payment->transaction_id,
            'order_id' => $payment->reference_no,
        ]);

//        if ($refunded) {
            $payment->status = 'refund';
            $payment->refund_amount = $amount;
            $payment->save();
//        }
        return true;
    }

    function update(array $attributes, $id = null)
    {
        // TODO: Implement create() method.

    }

    function delete($id)
    {
        // TODO: Implement delete() method.
    }


}
