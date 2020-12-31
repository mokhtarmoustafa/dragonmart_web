<?php

namespace App\Http\Requests\Api\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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

            'username' => 'nullable',
            'email' => 'nullable|email|unique:users,email,' . auth()->user()->id,
            'mobile' => 'nullable|unique:users,mobile,' . auth()->user()->id,
            'country_code_length' => 'nullable|numeric|gt:0',
            'password' => 'nullable|min:6',
            'image' => 'nullable|image',
            'vehicle_image' => 'nullable|image|max:5120',
            'lang' => 'nullable|in:ar,en',


        ];
    }

    public function attributes()
    {
        return [
            'username' => trans('app.username'),
            'email' => trans('app.email'),
            'mobile' => trans('app.mobile'),
            'password' => trans('app.password'),
            'country_code_length' => trans('app.country_code_length'),
            'image' => trans('app.user_image'),
            'vehicle_image' => trans('app.vehicle_photo'),
            'lang' => trans('app.lang'),


        ];
    }
}
