<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'address' => ['required', 'string', 'min:2', 'max:255'],
            'district' => ['required'],
            'city' => ['required'],
            'phone' => [
                'required', 'numeric',
                'min:10'
            ],
            'email' => [
                'required',
                'email:rfc,dns',
            ],
            'country' => ['required'],
            'payment_method'  => ['required'],
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'Tên',
            'address' => 'Địa chỉ',
            'district' => 'Quận/Huyện',
            'city' => 'Thành phố',
            'phone' => 'Số điện thoại',
            'country' => 'Quốc gia',
            'payment_method' => 'Phương thức thanh toán',
            'email'=>'Email'
        ];
    }
}
