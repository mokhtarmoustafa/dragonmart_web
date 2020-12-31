<?php

namespace App\Http\Requests\Api\Order;

use Illuminate\Foundation\Http\FormRequest;

class DropOffRequest extends FormRequest
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
            'order_id' => 'required|exists:orders,id,driver_id,' . auth()->user()->id
        ];
    }

    public function attributes()
    {
        return [
            'order_id' => trans('app.order'),
        ];
    }
}
