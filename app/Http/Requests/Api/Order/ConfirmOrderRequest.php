<?php

namespace App\Http\Requests\Api\Order;

use App\Order;
use Illuminate\Foundation\Http\FormRequest;

class ConfirmOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rule = [
            'order_id' => 'required|exists:orders,id,last_status,new,merchant_id,' . auth()->user()->id,
        ];
        $order = Order::with('OrderUser')->find(request()->get('order_id'));
        if (isset($order)){
            if ($order->OrderUser->procurement_method == 'delivery'){
                $rule ['driver_source'] = 'required|in:my_driver,any_driver,third_part';
                $rule ['driver_id'] = 'required_if:driver_source,my_driver|exists:users,id,type,driver,is_driver_available,1';
            }
        }
        return $rule;
    }

    public function attributes()
    {
        return [
            'order_id' => trans('app.order'),
            'driver_source' => trans('app.driver_source'),
            'driver_id' => trans('app.driver'),
        ];
    }
}
