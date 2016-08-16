<?php

namespace App\Http\Requests\Modules;

use App\Http\Requests\Request;

class TicketsRuleRequest extends Request
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
            'ticketid' => 'required',
            'executed' => 'required',
            'name' => 'required',
            'cond_status' => 'required',
            'cond_priority' => 'required',
            'cond_timeelapsed' => 'required',
            'cond_datetime' => 'required',
            'act_status' => 'required',
            'act_priority' => 'required',
            'act_assignto' => 'required',
            'act_notifyadmins' => 'required',
            'act_addreply' => 'required',
            'reply' => 'required',
        ];
    }
}
