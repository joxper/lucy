<?php

namespace App\Http\Requests\Modules;

use App\Http\Requests\Request;

class IssueRequest extends Request
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
            'asset_id' => 'required',
            'project_id' => 'required',
            'user_id' => 'required',
            'issue_type' => 'required',
            'priority' => 'required',
            'status' => 'required',
            'name' => 'required',
            'description' => 'required',
            'duedate' => 'required',
            'timespent' => 'required',
            'dateadded' => 'required',
        ];
    }
}
