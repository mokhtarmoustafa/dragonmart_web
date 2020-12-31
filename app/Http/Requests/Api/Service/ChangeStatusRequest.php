<?php

namespace App\Http\Requests\Api\Service;

use Illuminate\Foundation\Http\FormRequest;

class ChangeStatusRequest extends FormRequest
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

        if (auth()->user()->type == 'client')
            return [
                //
                'request_id' => 'required|exists:service_clients,id,user_id,' . auth()->user()->id,
                'status' => 'required|in:canceled,confirm_finished'
            ];
        else {
            return [
                //
                'request_id' => 'required|exists:service_clients,id',
                'status' => 'required|in:accepted,rejected,finished',
                'reject_reason' => 'required_if:status,rejected'
            ];
        }
    }


    public function attributes()
    {
        return [
            'request_id' => trans('app.order'),
            'status' => trans('app.status'),
            'reject_reason' => trans('app.reject_reason'),
        ];
    }
}
