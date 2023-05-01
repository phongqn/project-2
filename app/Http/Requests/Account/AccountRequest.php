<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
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
            'phone' => [
                'required',
                'numeric',
                'min:10',
            ],
            'address' => [
                'required',
                'string',
                'min:2',
                'max:255',
            ],
            'district' => [
                'required',
                'string',
                'min:2',
                'max:255',
            ],
            'city' => [
                'required',
                'string',
                'min:2',
                'max:255',
            ],
            'country' => [
                'required',
                'string',
                'min:2',
                'max:255',
            ]
        ];
    }
    public function attributes()
    {
        return [
            'phone' => 'Số điện thoại',
            'address' => 'Địa chỉ',
            'district' => 'Quận, Huyện',
            'city' => 'Thành phố',
            'country' => 'Quốc gia'
        ];
    }
}
