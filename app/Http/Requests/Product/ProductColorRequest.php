<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductColorRequest extends FormRequest
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
        $rules['quantity'] = ['required', 'numeric', 'min:0', 'max:100'];
        if (!$request->id) {
            $rules['color_id'] = ['required', 'numeric', Rule::unique('product_color', 'color_id')->where(function ($query) use ($request) {
                return $query->where('product_size_id', $request->product_size_id);
            })];
        }
        return $rules;
    }
    public function attributes()
    {
        return [
            'quantity' => 'Số lượng',
            'color_id' => 'Màu sắc',
        ];
    }
}
