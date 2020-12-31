<?php

namespace App\Http\Requests\Api\Home;

use Illuminate\Foundation\Http\FormRequest;

class FilterRequest extends FormRequest
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
            'product_name' => 'nullable',
            'merchant_name' => 'nullable',
            'city_id' => 'nullable|exists:cities,id',
            'category_id' => 'nullable|exists:product_categories,id',
            'price_from' => 'nullable|numeric',
            'price_to' => 'nullable|numeric',
        ];
    }

    public function attributes()
    {
        return [
            'product_name' => trans('app.product'),
            'merchant_name' => trans('app.merchant'),
            'city_id' => trans('app.city'),
            'category_id' => trans('app.category'),
            'price_from' => trans('app.price_from'),
            'price_to' => trans('app.price_to'),
        ];
    }
}
