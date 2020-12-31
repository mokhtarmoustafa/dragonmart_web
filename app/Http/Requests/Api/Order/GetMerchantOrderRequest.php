<?php

namespace App\Http\Requests\Api\Order;

use Illuminate\Foundation\Http\FormRequest;

class GetMerchantOrderRequest extends FormRequest
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
            'page_size' => 'nullable|numeric|gt:0',
            'page_number' => 'nullable|numeric|gt:0',
            'status' => 'required|in:pending,active,canceled,finished,new,accepted,rejected,pickup', // for driver - new,accepted,rejected,pickup
        ];
    }

    public function attributes()
    {
        return [
            'status' => trans('app.status'),
        ];
    }
}
