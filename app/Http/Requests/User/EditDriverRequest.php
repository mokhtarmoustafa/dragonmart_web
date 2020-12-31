<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class EditDriverRequest extends FormRequest
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
            'mobile' => 'required|unique:users,mobile,' . request()->route('id'),

            'image' => 'nullable|image|max:5048',
            'city_id' => 'required|exists:cities,id',
            'address' => 'required',
//            'driver_type_id' => 'required|exists:driver_types,id',
//            'latitude' => 'required',
//            'longitude' => 'required',
            //vehicle
            'vehicle_photo' => 'nullable|image|max:2048',
            'license_driving' => 'nullable|image|max:2048',
//            'document' => 'required|image|max:2048',
            'vehicle_id_no' => 'nullable|image|max:2048',

            'vehicle_no' => 'required',
            'manufacturer' => 'required',
            'vehicle_type' => 'required',
            'vehicle_model' => 'required',
            'vehicle_color' => 'required',
        ];
    }
}
