<?php

namespace App\Http\Requests\Merchant;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'username' => 'required|unique:admins,username,' . request()->route('id'),
            'email' => 'required|email|unique:admins,email,' . request()->route('id'),
            'mobile' => 'required|unique:admins,mobile,' . request()->route('id'),
//            'password' => 'nullable|min:6|confirmed',
            'logo' => 'nullable|image',
//            'city' => 'nullable|exits:cities,id',
        ];
    }

    public function attributes()
    {
        return [
            'name' => trans('app.name'),
            'username' => trans('app.username'),
            'email' => trans('app.email'),
            'mobile' => trans('app.mobile'),
            'logo' => trans('app.logo'),
        ];
    }
}
