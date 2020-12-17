<?php

namespace App\Http\Requests\Cms\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'email'    => 'required|max:50|regex:/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required'    => 'Vui lòng nhập email.',
            'email.regex'       => 'Định dạng email không chính xác.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
        ];
    }
}
