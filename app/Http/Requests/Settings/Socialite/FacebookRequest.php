<?php

namespace App\Http\Requests\Settings\Socialite;

use App\Http\Requests\Request;

class FacebookRequest extends Request
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

        if ((bool) $this->input('facebook_enable')) {
            $rules = [
                'facebook_client_id' => 'required',
                'facebook_client_secret' => 'required',
            ];
        }

        return $rules;
    }
}
