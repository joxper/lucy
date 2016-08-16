<?php

namespace App\Http\Requests\Modules;

use App\Http\Requests\Request;

class ProjectRequest extends Request
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
            'tag' => 'required',
            'name' => 'required',
            'notes' => 'required',
            'description' => 'required',
            'startdate' => 'required',
            'deadline' => 'required',
            'progress' => 'required',
        ];
    }
}
