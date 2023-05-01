<?php

namespace App\Http\Requests\Contact;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
            'name' => [
                'required',
                'string',
                'min:2',
                'max:255',
            ],
            'email' => [
                'required',
                'email:rfc,dns',
            ],
            'message' => [
                'required',
                'string',
            ]
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'Tên bạn',
            'email' => 'Email của bạn',
            'message' => 'Lời nhắn'
        ];
    }
}
