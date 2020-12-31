<?php

namespace App\Http\Requests\Api\Service;

use Illuminate\Foundation\Http\FormRequest;

class SendRequest extends FormRequest
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
            'user_order_id' => 'nullable|exists:service_clients,id,user_id,' . auth()->user()->id,
            'service_ids.*' => 'required|exists:services,id',
            'arrival_date' => 'required|date_format:Y-m-d H:i:s',
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'user_order_id' => trans('app.order'),
            'service_ids.*' => trans('app.service'),
            'arrival_date' => trans('app.arrival_date'),
            'address' => trans('app.address'),
            'latitude' => trans('app.location'),
            'longitude' => trans('app.location'),

        ];
    }
}
