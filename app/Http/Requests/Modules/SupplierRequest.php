<?php

namespace App\Http\Requests\Modules;

use App\Http\Requests\Request;

class SupplierRequest extends Request
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
            'name' => 'required',
            'address' => 'required',
            'contact_name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'web' => 'required',
            'notes' => 'required',
        ];
    }
}
