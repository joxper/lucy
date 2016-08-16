<?php

namespace App\Http\Requests\Settings;

use App\Http\Requests\Request;

class RegRequest extends Request
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
        $rules = [];

        if ((bool) $this->input('activate')) {
            $rules['token_lifetime'] = 'numeric|required';
        }

        return $rules;
    }
}
