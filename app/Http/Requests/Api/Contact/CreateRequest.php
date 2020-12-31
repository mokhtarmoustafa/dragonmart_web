<?php

namespace App\Http\Requests\Api\Contact;

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
            'name' => 'required',
            'email' => 'required|email',
            'title' => 'required',
//            'phone' => 'required',
            'message' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'name' => trans('app.contact.name'),
            'email' => trans('app.contact.email'),
            'title' => trans('app.contact.title'),
            'message' => trans('app.contact.message'),
        ];
    }
}
