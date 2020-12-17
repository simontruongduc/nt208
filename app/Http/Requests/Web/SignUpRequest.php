<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
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
            'email'            => 'required|max:50|regex:/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/',
            'password'         => 'required|min:8|max:30',
            'confirm_password' => 'same:password',
        ];
    }

    public function messages()
    {
        return [
            'email.required'        => 'Vui lòng nhập email.',
            'email.regex'           => 'Định dạng email không chính xác.',
            'password.required'     => 'Vui lòng nhập mật khẩu.',
            'password.min'          => 'Mật khẩu tối thiểu 8 ký tự.',
            'password.max'          => 'Mật khẩu tối đa 30 ký tự.',
            'confirm_password.same' => 'Mật khẩu không khớp.',
        ];
    }
}
