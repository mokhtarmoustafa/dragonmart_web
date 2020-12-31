<?php

namespace App\Http\Requests\Api\User;

use Illuminate\Foundation\Http\FormRequest;

class CheckChangeMobileRequest extends FormRequest
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
            'mobile' => 'required|unique:users,mobile,id,' . auth()->user()->id,
            'verification_code' => 'required',
            'country_code_length' => 'required|numeric',
        ];
    }

    public function attributes()
    {
        return [
            'mobile' => trans('app.mobile'),
            'verification_code' => trans('app.verification_code'),
            'country_code_length' => trans('app.country_code_length'),

        ];
    }
}
