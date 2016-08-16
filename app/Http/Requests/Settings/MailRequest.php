<?php

namespace App\Http\Requests\Settings;

use App\Http\Requests\Request;

class MailRequest extends Request
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

        if ((bool) $this->input('mail_enable')) {
            $rules['mail_from_address'] = 'required|email';
            $rules['mail_from_name'] = 'required';

            if ('sendmail' == $this->input('mail_driver')) {
                $rules['mail_sendmail_path'] = 'required';
            } elseif ('smtp' == $this->input('mail_driver')) {
                $rules['mail_host'] = 'required';
                $rules['mail_port'] = 'required|numeric';
                $rules['mail_username'] = 'required';
                $rules['mail_password'] = 'required';
            }
        }

        return $rules;
    }
}
