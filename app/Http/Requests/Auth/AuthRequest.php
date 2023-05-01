<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
            'password' => 'required|min:8|max:16|confirmed:password_confirmation',
            'password_confirmation' => 'required|min:8|max:16',
        ];
    }
    public function attributes()
    {
        return [
            'password' => 'Mật khẩu',
            'password_confirmation' => 'Xác nhận mật khẩu',
        ];
    }
}
