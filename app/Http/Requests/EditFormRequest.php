<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditFormRequest extends FormRequest
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
            'post_title' => 'required|max:100|string|',
            'post_body' => 'required|max:5000|string',

            //
        ];
    }
    public function messages()
    {
        return [
            'post_title.required' => 'タイトルは必須項目です。',
            'post_title.string' => 'タイトルは文字列で入力してください。',
            'post_title.max' => 'タイトルは100文字以内で入力してください。',
            'post_body.required' => '内容は必須項目です。',
            'post_body.string' => '内容は文字列で入力してください。',
            'post_body.max' => '最大文字数は5000文字です。',
        ];
    }
}
