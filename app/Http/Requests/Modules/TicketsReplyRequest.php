<?php

namespace App\Http\Requests\Modules;

use App\Http\Requests\Request;

class TicketsReplyRequest extends Request
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
            'ticket_id' => 'required',
            'user_id' => 'required',
            'message' => 'required',
            'timestamp' => 'required',
        ];
    }
}
