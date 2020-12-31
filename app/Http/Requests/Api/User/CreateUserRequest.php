<?php

namespace App\Http\Requests\Api\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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

//        echo phpinfo();
//        return;
        return [
            //
            'type' => 'required|in:driver,client,merchant,service_provider',
            'username' => 'required',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|unique:users,mobile',
            'country_code_length' => 'required|numeric|gt:0',
            'password' => 'required|min:6',
            'lang' => 'nullable|in:ar,en',

            'image' => 'required_if:type,driver|image|max:5120',
            'city_id' => 'required_if:type,driver,merchant,service_provider|exists:cities,id',
            'address' => 'nullable',//_if:type,driver,merchant,service_provider
            'latitude' => 'nullable',//_if:type,driver,merchant,service_provider
            'longitude' => 'nullable',//_if:type,driver,merchant,service_provider

            'categories.*' => 'required_if:type,merchant|exists:product_categories,id',
            'provider_categories.*' => 'required_if:type,service_provider|exists:provider_categories,id',
            'has_delivery' => 'required_if:type,merchant|in:0,1',

            //vehicle
            'vehicle_photo' => 'required_if:type,driver|image|max:5120',
            'license_driving' => 'required_if:type,driver|image|max:5120',
            'document' => 'required_if:type,driver|image|max:5120',// car license
            'vehicle_id_no' => 'required_if:type,driver|image|max:5120',
            'vehicle_no' => 'required_if:type,driver',
            'vehicle_type_id' => 'required_if:type,driver|exists:car_types,id',
            'vehicle_model' => 'required_if:type,driver',
            'vehicle_color' => 'required_if:type,driver',
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
            'city_id' => trans('app.city'),
            'address' => trans('app.address'),
            'latitude' => trans('app.location'),
            'longitude' => trans('app.location'),
            'categories.*' => trans('app.categories'),
            'provider_categories.*' => trans('app.categories'),
            'has_delivery' => trans('app.has_delivery'),
            'vehicle_photo' => trans('app.vehicle_photo'),
            'license_driving' => trans('app.license_driving'),
            'document' => trans('app.document'),
            'vehicle_id_no' => trans('app.vehicle_id_no'),
            'vehicle_no' => trans('app.vehicle_no'),
            'vehicle_type_id' => trans('app.vehicle_type_id'),
            'vehicle_model' => trans('app.vehicle_model'),
            'vehicle_color' => trans('app.vehicle_color'),

            'lang' => trans('app.lang'),

        ];
    }
}
