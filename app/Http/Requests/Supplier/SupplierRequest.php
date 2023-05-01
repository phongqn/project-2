<?php

namespace App\Http\Requests\Supplier;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
                'min: 2',
                'max:255',
                Rule::unique('suppliers', 'name')->ignore(request()->id, 'id')

            ],
            'email' => [
                'required',
                'email:rfc,dns',
                Rule::unique('suppliers', 'email')->ignore(request()->id, 'id')
            ],
            'phone' => [
                'required',
                'numeric',
            ],
            'address' => [
                'required',
                'string',
                'min:6',
                'max:255'
            ],
            'country' => [
                'required',
                'string',
                'min:4',
                'max:255'
            ]
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'Tên nhà cung cấp',
            'email' => 'Email nhà cung cấp',
            'phone' => 'Số điện thoại nhà cung cấp',
            'address' => 'Địa chỉ nhà cung cấp',
            'country' => 'Quốc gia nhà cung cấp'
        ];
    }
}
