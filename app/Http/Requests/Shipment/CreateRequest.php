<?php

namespace App\Http\Requests\Shipment;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'price' => 'required|numeric|gte:0',
            'from' => 'required|numeric|gte:0',
            'to' => 'required|numeric|gte:0',
            'min_order_amount' => 'nullable|numeric|gte:0',
        ];
    }
}
