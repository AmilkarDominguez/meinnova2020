<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
            'collector_id' => 'required|integer',
            'sale_id'      => 'required|integer',
            'state'        => 'required|string|max:255',
            'payment'      => 'required|numeric|between:0,99999999.99',
            'entry_date'   => 'required',
        ];
    }
}
