<?php

namespace App\Http\Requests\Discount;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class DiscountRequest extends FormRequest
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
                Rule::unique('discounts', 'name')->ignore(request()->id, 'id')
            ],
            'code' => [
                'required',
                'string',
                'min:2',
                'max:255',
                Rule::unique('discounts', 'code')->ignore(request()->id, 'id')
            ],
            'price' => [
                'required',
                'numeric',
                'min:1'
            ],
            'begin' => [
                'required',
                'date',

            ],
            'end' => [
                'required',
                'date',
                'after_or_equal:begin'
            ],
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'Tên mã giảm giá',
            'code' => 'Mã giảm giá',
            'price' => 'Số tiền giảm',
            'begin' => 'Ngày bắt đầu',
            'end' => 'Ngày kết thúc'
        ];
    }
}
