<?php

namespace App\Http\Requests\Api\User;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordDeepLinkRequest extends FormRequest
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
//            'user_id' => 'required|exists:users,id,is_reset_password,0',
            'password' => 'required|min:6|confirmed'
        ];
    }

    public function attributes()
    {
        return [
            'password' => trans('app.password'),
        ];
    }
}
