<?php

namespace App\Http\Requests\Modules;

use App\Http\Requests\Request;

class LicenseRequest extends Request
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
            'client_id' => 'required',
            'label_id' => 'required',
            'category_id' => 'required',
            'supplier_id' => 'required',
            'tag' => 'required',
            'name' => 'required',
            'serial' => 'required',
            'notes' => 'required',
        ];
    }
}
