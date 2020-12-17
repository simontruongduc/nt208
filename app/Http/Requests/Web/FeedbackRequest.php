<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class FeedbackRequest
 *
 * @package App\Http\Requests\Web
 */
class FeedbackRequest extends FormRequest
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
            'name'    => 'required|max:30',
            'subject' => 'required|max:30',
            'email'   => 'email|required|max:50|regex:/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/',
            'message' => 'required|string|max:10000',
        ];
    }

    /**
     * @return array|string[]
     */
    public function messages()
    {
        return [
            'name.required'    => 'Vui lòng nhập họ và tên.',
            'subject.required' => 'Vui lòng nhập tiêu đề.',
            'email.required'   => 'Vui lòng nhập email.',
            'email.email'      => 'Vui lòng nhập đúng định dạng email.',
            'email.max'        => 'Tối đa 50 ký tự.',
            'email.regex'      => 'Email sai định dạng.',
            'message.required' => 'Vui lòng nhập nội dung.',
            'message.max'      => 'Tối đa 10000 ký tự.',
        ];
    }

    public function messages()
    {
        return [
            'name.required'        => 'Vui lòng nhập họ tên.',
            'email.regex'           => 'Định dạng email không chính xác.',
        ];
    }
}