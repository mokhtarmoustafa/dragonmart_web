<?php

namespace App\Http\Requests\Api\Cart;

use App\Product;
use Illuminate\Foundation\Http\FormRequest;

class CreateProductCartRequest extends FormRequest
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
        if ((request()->isJson())) {

            return [
                //
                'data.*.product_id' => 'required|exists:products,id',
                'data.*.quantity' => 'required|numeric|gte:1',
//                'cart_id' => 'nullable|exists:carts,id,user_id,' . auth()->user()->id,
                'data.*.custom_id' => 'nullable|exists:product_customizations,id',
            ];
        }
        return [
            //
            'data.*.product_id' => 'required|exists:products,id',
            'data.*.quantity' => 'required|numeric|gte:1',
//            'cart_id' => 'nullable|exists:carts,id,user_id,' . auth()->user()->id,
            'data.*.custom_id' => 'nullable|exists:product_customizations,id,product_id,' . request()->get('product_id'),
        ];
    }

    public function attributes()
    {
        return [
            'data.*.product_id' => trans('app.product'),
            'data.*.quantity' => trans('app.site.product.quantity'),
            'data.*.custom_id' => trans('app.site.product.customization'),
        ];
    }
}
