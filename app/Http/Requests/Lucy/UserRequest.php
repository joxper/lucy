<?php

namespace App\Http\Requests\Lucy;

use App\Http\Requests\Request;

class UserRequest extends Request
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
        $unique = '';
        if ($this->isMethod('put')) {
            $unique = ','.$this->segment(3);
        }

        $rules = [
            'avatar' => 'image',
            'email' => 'required|email|unique:users,email'.$unique,
            'username' => 'required|min:5|unique:users,username'.$unique,
            'first_name' => 'required',
            'last_name' => 'required',
        ];

        if ($this->isMethod('post')) {
            $rules['password'] = 'required|min:6';
        }

        return $rules;
    }
}
