<?php

namespace App\Http\Requests\Api\Order;

use Illuminate\Foundation\Http\FormRequest;

class ChangeStatusRequest extends FormRequest
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
        if (auth()->user()->type == 'merchant')
            return [
                //
                'order_id' => 'required|exists:orders,id',
                'status' => 'required|in:new,accepted,progress,finished,canceled,rejected,pickup',
                'reject_reason' => 'required_if:status,rejected',
            ];
        else if (auth()->user()->type == 'driver')
            return [
                //
                'order_id' => 'required|exists:orders,id',
                'status' => 'required|in:accepted,progress,rejected,pickup',
                'reject_reason' => 'required_if:status,rejected',
            ];
        else if (auth()->user()->type == 'client')
            return [
                //
                'order_id' => 'required|exists:orders,id',
                'status' => 'required|in:new,finished,canceled',
            ];
    }

    public function attributes()
    {
        return [
            'order_id' => trans('app.order'),
            'status' => trans('app.order_status'),
            'reject_reason' => trans('app.reject_reason'),
        ];
    }
}
