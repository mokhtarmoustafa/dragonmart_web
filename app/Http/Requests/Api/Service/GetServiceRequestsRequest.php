<?php

namespace App\Http\Requests\Api\Service;

use Illuminate\Foundation\Http\FormRequest;

class GetServiceRequestsRequest extends FormRequest
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
            'status' => 'required|in:pending,accepted,rejected,finished',//pending', 'accepted', 'rejected
        ];
    }

    public function attributes()
    {
        return [
            'status' => trans('app.status'),
        ];
    }
}
