<?php

namespace App\Http\Requests\Cms\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
            'password'              => 'string|required|min:8|max:30',
            'password_confirmation' => 'string|required|same:password',
        ];
    }

    public function messages()
    {
        return [
            'password.required'              => 'Vui lòng nhập mật khẩu.',
            'password.min'                   => 'Mật khẩu ít nhất 8 ký tự.',
            'password.max'                   => 'Mật khẩu tối đa 30 ký tự.',
            'password_confirmation.required' => 'Vui lòng xác nhận lại mật khẩu.',
            'password_confirmation.same'     => 'Mật khẩu xác nhận không khớp.',
        ];
    }
}
