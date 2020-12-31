<?php

namespace App\Http\Requests\Product;

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
            'name' => 'required',
            'price' => 'required|numeric|gt:0',
            'original_quantity' => 'required|numeric|gt:0',
            'category_id' => 'required|exists:product_categories,id',
            'is_offer' => 'nullable|in:off,on',
            'offer_percentage' => 'required_if:is_offer,on|between:0,100',
            'is_sponsor' => 'nullable|in:off,on',
            'sponsor_duration' => 'required_if:is_sponsor,on',
            'custom_id.*' => 'nullable|exists:customizations,id',
            'custom_price.*' => 'nullable|numeric|gt:0',
            'custom_text.*' => 'nullable',
            'custom_description.*' => 'nullable',
        ];
    }

//    public function attributes()
//    {
//        return [
//            'name' => 'product name',
//            'price' => 'product price',
//            'original_quantity' => 'quantity',
//            'is_offer' => 'offer',
//            'offer_percentage' => 'offer %',
//            'is_sponsor' => 'sponsor',
//            'sponsor_duration' => 'sponsor duration',
//            'category_id' => 'product category',
//            'custom_id.*' => 'custom',
//            'custom_price.*' => 'custom price',
//            'custom_text.*' => 'custom text',
//            'custom_description.*' => 'custom description'
//        ];
//    }

    public function attributes()
    {
        return [
            'name' => trans('app.site.product.name'),
            'price' => trans('app.site.product.price'),
            'original_quantity' => trans('app.site.product.original_quantity'),
            'is_offer' => trans('app.site.product.is_offer'),
            'offer_percentage' => trans('app.site.product.offer_percentage'),
            'is_sponsor' => trans('app.site.product.is_sponsor'),
            'sponsor_duration' => trans('app.site.product.sponsor_duration'),
            'category_id' => trans('app.site.product.category'),
            'custom_id.*' => trans('app.site.product.custom'),
            'custom_price.*' => trans('app.site.product.custom_price'),
            'custom_text.*' => trans('app.site.product.custom_text'),
            'custom_description.*' => trans('app.site.product.custom_description'),
        ];
    }
}
