<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DetailSaleProductRequest extends FormRequest
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
        //'name_product','amount', 'subtotal','state','sale_id', 'batch_id'
        return [
            'name_product' => 'required',
            'subtotal' => 'required|numeric|between:0,99999999.99',
            'amount' => 'required|integer',
            'sale_id' => 'required|integer',	
            'batch_id' => 'required|integer',		
            'state' => 'required|string|max:255'
        ];
    }
}
