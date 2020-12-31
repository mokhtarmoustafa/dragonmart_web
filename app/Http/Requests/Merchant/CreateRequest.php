<?php

namespace App\Http\Requests\Merchant;

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
//            'name' => 'required',
            'username' => 'required|unique:admins,username',
            'email' => 'required|email|unique:admins,email',
            'mobile' => 'required|unique:admins,mobile',
//            'password' => 'required|min:6|confirmed',
            'logo' => 'nullable|image',
//            'city' => 'required|exists:cities,id',

        ];
    }

    public function attributes()
    {
        return [
            'username' => trans('app.username'),
            'email' => trans('app.email'),
            'mobile' => trans('app.mobile'),
            'logo' => trans('app.logo'),
        ];
    }
}
