<?php

namespace App\Http\Requests\Modules;

use App\Http\Requests\Request;

class LogsSmRequest extends Request
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
            'user_id' => 'required',
            'client_id' => 'required',
            'mobile' => 'required',
            'sms' => 'required',
            'timestamp' => 'required',
        ];
    }
}
