<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BatchRequest extends FormRequest
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
        'product_id'            => 'required|integer',
        'user_id'               => 'required|integer',
        'provider_id'           => 'required|integer',
        'line_id'               => 'required|integer',
        'storage_id'            => 'required|integer',
        //'industry_id'         => 'required|integer',
        //'payment_status_id'   => 'required|integer',
        //'payment_type_id'     => 'required|integer', 
        'code'                  => 'required|string|max:255',
        'sanitary_registration' => 'required|string|max:255',
        'initial_stock'         => 'required|integer',
        'stock'                 => 'required|integer',
        'batch_price'           => 'required|numeric|between:0,99999999.99',
        'wholesaler_price'      => 'required|numeric|between:0,99999999.99',
        //'retail_price'        => 'required|numeric|between:0,99999999.99',
        'entry_date'            => 'required',
        'expiration_date'       => 'required',
        'state'                 => 'required|string|max:255',
        ];
    }
}
