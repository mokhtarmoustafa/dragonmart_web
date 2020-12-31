<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateDriverRequest extends FormRequest
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
            'username' => 'required',
            'mobile' => 'required|unique:users,mobile',

            'image' => 'required|image|max:5048',
            'city_id' => 'required|exists:cities,id',
            'address' => 'required',
//            'driver_type_id' => 'required|exists:driver_types,id',
//            'latitude' => 'required',
//            'longitude' => 'required',
            //vehicle
            'vehicle_photo' => 'required|image|max:2048',
            'license_driving' => 'required|image|max:2048',
//            'document' => 'required|image|max:2048',
            'vehicle_id_no' => 'required|image|max:2048',

            'job_id' => 'unique:users',
            'vehicle_no' => 'required',
            'manufacturer' => 'required',
            'vehicle_type' => 'required',
            'vehicle_model' => 'required',
            'vehicle_color' => 'required',
        ];
    }
}
