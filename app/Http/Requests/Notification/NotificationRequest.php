<?php

namespace App\Http\Requests\Notification;

use Illuminate\Foundation\Http\FormRequest;

class NotificationRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'min:2',
                'max:255',
            ],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
            ],

            'phone' => [
                'required',
                'numeric',
                'min:10',
            ],
            'address' => [
                'required',
                'string',
                'min:6',
                'max:255'
            ],

            'map' => [
                'required',
                'string',
                'min:8'
            ]
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên cửa hàng',
            'email' => 'Địa chỉ email',
            'phone' => 'Số điện thoại',
            'address' => 'Địa chỉ cửa hàng',
            'map' => 'Bản đồ cửa hàng'
        ];
    }
}
