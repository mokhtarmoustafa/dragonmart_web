<?php

namespace App\Http\Requests\Api\Order;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
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
        return [
            //
            'user_order_id' => 'required|exists:order_users,id,user_id,' . auth()->user()->id,
            'procurement_method' => 'required|in:delivery,pickup',
            'address' => 'required_if:procurement_method,delivery',
            'latitude' => 'required_if:procurement_method,delivery',
            'longitude' => 'required_if:procurement_method,delivery',
            'received_datetime' => 'nullable|date_format:Y-m-d H:i:s',
        ];
    }

    public function attributes()
    {
        return [
            'user_order_id' => trans('app.order'),
            'procurement_method' => trans('app.procurement_method'),
            'address' => trans('app.address'),
            'latitude' => trans('app.location'),
            'longitude' => trans('app.longitude'),
            'received_datetime' => trans('app.received_datetime'),
        ];
    }
}
