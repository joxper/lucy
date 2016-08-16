<?php

namespace App\Http\Requests\Modules;

use App\Http\Requests\Request;

class HostsCheckRequest extends Request
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
            'host_id' => 'required',
            'name' => 'required',
            'type' => 'required',
            'port' => 'required',
            'monitoring' => 'required',
            'email' => 'required',
            'sms' => 'required',
            'status' => 'required',
        ];
    }
}
