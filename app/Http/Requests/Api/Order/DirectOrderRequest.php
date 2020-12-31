<?php

namespace App\Http\Requests\Api\Order;

use Illuminate\Foundation\Http\FormRequest;

class DirectOrderRequest extends FormRequest
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
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|gte:1',
            'custom_id' => 'nullable|exists:product_customizations,id,product_id,' . request()->get('product_id')
        ];
    }

    public function attributes()
    {
        return [
            'product_id' => trans('app.product'),
            'quantity' => trans('app.site.product.quantity'),
            'custom_id' => trans('app.site.product.customization'),
        ];
    }
}
