<?php

namespace App\Http\Requests\expense;

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
            'amount'=>'required|numeric|gt:0',
            'expense_date'=>'required|date',
        ];
    }

    public function attributes()
    {
        return [
            'amount' => trans('app.expense_amount'),
            'expense_date' => trans('app.expense_date'),
        ];
    }
}
