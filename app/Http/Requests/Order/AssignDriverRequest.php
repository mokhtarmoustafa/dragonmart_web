<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class AssignDriverRequest extends FormRequest
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
            'order_id' => 'required|exists:orders,id,last_status,accepted',
            'delivery_method' => 'required|in:any_driver,third_part',
            'driver_id' => 'required_if:delivery_method,any_driver',
        ];
    }

    public function attributes()
    {
        return [
            'order_id' => trans('app.order'),
            'delivery_method' => trans('app.driver_source'),
            'driver_id' => trans('app.driver'),
        ];
    }
}
