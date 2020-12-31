<?php

namespace App\Http\Requests\Api\Service;

use Illuminate\Foundation\Http\FormRequest;

class GetReviewsRequest extends FormRequest
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
            'service_provider_id' => 'required|exists:users,id,type,service_provider',
            'client_name' => 'nullable',
            'service_name' => 'nullable',
        ];
    }

    public function attributes()
    {
        return [
            'service_provider_id' => trans('app.service_provider'),
            'service_name' => trans('app.service'),
            'client_name' => trans('app.client'),
        ];
    }
}
