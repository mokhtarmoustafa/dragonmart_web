<?php

namespace App\Http\Requests\Api\Rate;

use Illuminate\Foundation\Http\FormRequest;

class CreateRateRequest extends FormRequest
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
        if (request()->has('type') && request()->get('type') == 'service') {
            return [
                //
                'action_id' => 'required|exists:service_clients,id',
                'rate' => 'required|numeric',
//                'comment' => 'required',
            ];
        }
        return [
            //
            'action_id' => 'required|exists:products,id',
            'rate' => 'required|numeric'

        ];
    }


    public function attributes()
    {
        return [
            'rate' => trans('app.rate'),
        ];
    }
}
