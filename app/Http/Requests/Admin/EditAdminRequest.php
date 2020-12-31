<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EditAdminRequest extends FormRequest
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
            'username' => 'required|unique:admins,username,' . auth()->guard('admin')->user()->id,
            'mobile' => 'required|unique:admins,mobile,' . auth()->guard('admin')->user()->id,
            'email' => 'required|email|unique:admins,email,' . auth()->guard('admin')->user()->id,
            'password' => 'nullable|min:6|confirmed',
        ];
    }

    public function attributes()
    {
        return [
            'name' => trans('app.name'),
            'username' => trans('app.username'),
            'email' => trans('app.email'),
            'mobile' => trans('app.mobile'),
            'password' => trans('app.password'),

        ];
    }

}
