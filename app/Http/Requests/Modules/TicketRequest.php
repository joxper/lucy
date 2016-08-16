<?php

namespace App\Http\Requests\Modules;

use App\Http\Requests\Request;

class TicketRequest extends Request
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
            'ticket' => 'required',
            'client_id' => 'required',
            'user_id' => 'required',
            'admin_id' => 'required',
            'asset_id' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'status' => 'required',
            'priority' => 'required',
            'timestamp' => 'required',
            'notes' => 'required',
            'ccs' => 'required',
        ];
    }
}
