<?php

namespace App\Http\Requests\Category;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
                Rule::unique('categories', 'name')->ignore(request()->id, 'id')
            ],
            // 'parent_id' => 'required'
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'Tên danh mục',
            'category_id'=>'Danh mục cha'
        ];
    }
}
