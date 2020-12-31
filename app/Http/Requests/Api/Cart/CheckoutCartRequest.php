<?php

namespace App\Http\Requests\Api\Cart;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutCartRequest extends FormRequest
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
            'cart_product_id.*' => 'required|exists:cart_products,id'
        ];
    }

    public function attributes()
    {
        return [
            'cart_product_id.*' => trans('app.product')
        ];
    }
}
