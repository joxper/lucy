<?php

namespace App\Http\Requests\Modules;

use App\Http\Requests\Request;

class DeviceRequest extends Request
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
            'category_id' => 'required',
            'client_id' => 'required',
            'user_id' => 'required',
            'admin_id' => 'required',
            'supplier_id' => 'required',
            'label_id' => 'required',
            'purchase_date' => 'required',
            'warranty_months' => 'required',
            'tag' => 'required',
            'serial' => 'required',
            'notes' => 'required',
        ];
    }
}
