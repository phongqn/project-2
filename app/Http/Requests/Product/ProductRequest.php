<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'brand_id' => ['required'],
            'category_id' => ['required'],
            'supplier_id' => ['required'],
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'descipition' => ['required', 'string', 'min:6'],
            'img' =>  request('id') ? '' : 'required|file|mimes:jpeg,jpg,png,gif|max:5000',
        ];
    }
    public function attributes()
    {
        return [
            'brand_id' => 'Nhãn hàng',
            'category_id' => 'Danh mục',
            'supplier_id' => 'Nhà cung cấp',
            'descipition' => 'Mô tả sản phẩm',
            'img' => 'Ảnh sản phẩm'
        ];
    }
}
