<?php

namespace App\Http\Requests\Brand;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BrandRequest extends FormRequest
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
                Rule::unique('brands', 'name')->ignore(request()->id, 'id')
            ],
            'file' => [
                'file',
                'max:5000',
                'mimes:jpeg,jpg,png,gif',
                request()->isMethod('POST') ? 'required' : 'nullable'
            ]

        ];
    }
    public function attributes()
    {
        return [
            'name' => 'Tên thương hiệu',
            'file' => 'Ảnh thương hiệu',
        ];
    }
}
