<?php

namespace App\Http\Requests\Api\Service;

use Illuminate\Foundation\Http\FormRequest;

class CreateServicesRequest extends FormRequest
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
//            `user_id`, `category_id`, `text`, `price`,
            'category_id' => 'required|exists:provider_categories,id',
            'text' => 'required',
            'price' => 'required|numeric|gt:0',
        ];
    }

    public function attributes()
    {
        return [
            'category_id' => trans('app.category'),
            'text' => trans('app.service'),
            'price' => trans('app.price'),
        ];
    }
}
