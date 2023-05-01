<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductSizeRequest extends FormRequest
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
        $request = request();
        return [
            'size' => ['required', Rule::unique('product_size', 'size')->where(function ($query) use ($request) {
                return $query->where('product_id', $request->product_id);
            })],
            'type_size' => ['required'],
            'price_import' => ['required', 'numeric', 'lt:price_sell'],
            'price_sell' => ['required', 'numeric', 'gt:price_import'],
            'img.*' =>  request('id') ? '' : 'required|file|mimes:jpeg,jpg,png,gif|max:5000',
        ];
    }
    public function attributes()
    {
        return [
            'size' => 'Kích cõ sản phẩm',
            'type_size' => 'Loại kích thước',
            'price_import' => 'Giá nhập',
            'price_sell' => 'Giá bán',
            'img' => 'Ảnh sản phẩm'
        ];
    }
}
