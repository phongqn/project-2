<?php

namespace App\Http\Requests\Banner;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BannerRequest extends FormRequest
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
                'min:4',
                'max:255',
                Rule::unique('banners', 'name')->ignore(request()->id, 'id')
            ],
            'file' => [
                'file',
                'mimes:jpeg,jpg,png,gif',
                'max:5000',
                request()->isMethod('POST') ? 'required' : 'nullable'
            ],
            'status' => [
                'required',
            ],
            'index' => [
                'required',
                Rule::unique('banners', 'index')->ignore(request()->id, 'id'),

            ]

        ];
    }
    public function attributes()
    {
        return [
            'name' => 'Tên banner',
            'file' => 'Ảnh banner',
            'status' => 'Trạng thái',
            'index' => 'Số thứ tự',
        ];
    }
}
