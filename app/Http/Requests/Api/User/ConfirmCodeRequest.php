<?php

namespace App\Http\Requests\Api\User;

use Illuminate\Foundation\Http\FormRequest;

class ConfirmCodeRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'mobile' => 'required', // if doesn't exist I update mobile number
            'verification_code' => 'required|digits:4',
            'password' => 'required|min:6',
            'device_type'=>'required|in:android,ios',
            'device_token'=>'required',
            'device_id'=>'sometimes',
            'lang' => 'nullable|in:ar,en',

        ];
    }


    public function attributes()
    {
        return [
            'user_id' => trans('app.user'),
            'mobile' => trans('app.mobile'),
            'verification_code' => trans('app.verification_code'),
            'password' => trans('app.password'),
            'lang' => trans('app.lang'),

        ];
    }
}
