<?php

namespace App\Http\Requests\Api\Product;

use Illuminate\Foundation\Http\FormRequest;

class GetProductsRequest extends FormRequest
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
            //$type = popular, $type = top_selling, $type = new_product
            'category_id' => 'nullable|exists:product_categories,id',
            'product_name' => 'nullable',
            'type' => 'nullable|in:popular,top_selling,new_product',
            'merchant_name'=>'nullable',
            'city_id'=>'nullable|exists:cities,id',
            'price_from'=>'nullable|numeric',
            'price_to'=>'nullable|numeric',
            'page_size' => 'nullable|numeric|gt:0',
            'page_number' => 'nullable|numeric|gt:0',
        ];
    }


    public function attributes()
    {
        return [
            'category_id' => trans('app.category'),
            'product_name' => trans('app.product'),
            'merchant_name' => trans('app.merchant'),
            'city_id' => trans('app.city'),
            'price_from' => trans('app.price_from'),
            'price_to' => trans('app.price_to'),
        ];
    }
}
