<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
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
            'date' => 'required',
            'total' => 'required|numeric|between:0,99999999.99',
            'client_id' => 'required|integer',	
            'seller_id' => 'required|integer',	
            'user_id' => 'required|integer',	
            'state' => 'required|string|max:255'
        ];
    }
}
