<?php

namespace App\Http\Requests\Api\Service;

use Illuminate\Foundation\Http\FormRequest;

class GetServicesRequest extends FormRequest
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
            'category_id' => 'nullable|exists:provider_categories,id',
            'service_name' => 'nullable',
//            'type' => 'nullable|in:popular,top_selling,new_product',
            'service_provider_id' => 'nullable|exists:users,id,type,service_provider',
            'service_provider_name' => 'nullable',
            'city_id' => 'nullable|exists:cities,id',
            'price_from' => 'nullable|numeric',
            'price_to' => 'nullable|numeric',
            'page_size' => 'nullable|numeric|gt:0',
            'page_number' => 'nullable|numeric|gt:0',
        ];
    }

    public function attributes()
    {
        return [
            'category_id' => trans('app.category'),
            'service_provider_id' => trans('app.service_provider'),
            'service_provider_name' => trans('app.service_provider'),
            'service_name' => trans('app.service'),
            'city_id' => trans('app.city'),
            'price_from' => trans('app.price_from'),
            'price_to' => trans('app.price_to'),
        ];
    }
}
