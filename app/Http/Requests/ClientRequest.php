<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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

            'name'              => 'required|string|max:255',
            'nit'               => 'required|string|max:255',
            'state'             => 'required|string|max:255',
            'contact'           => 'required|string|max:255',  
            'catalog_zone_id'   => 'required|integer',
        ];
    }
}
