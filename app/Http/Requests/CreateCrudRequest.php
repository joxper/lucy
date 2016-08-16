<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateCrudRequest extends Request
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
            'table' => 'required|unique:modules,table_name|alpha_dash|string',
            'icon' => 'required',
        ];
    }
}
