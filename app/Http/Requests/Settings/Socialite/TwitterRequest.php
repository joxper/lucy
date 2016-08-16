<?php

namespace App\Http\Requests\Settings\Socialite;

use App\Http\Requests\Request;

class TwitterRequest extends Request
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

        if ((bool) $this->input('twitter_enable')) {
            $rules = [
                'twitter_client_id' => 'required',
                'twitter_client_secret' => 'required',
            ];
        }

        return $rules;
    }
}
