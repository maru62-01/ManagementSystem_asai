<?php

namespace App\Http\Requests\BulletinBoard;

use Illuminate\Foundation\Http\FormRequest;

class PostFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool

     */
    // リクエストが認可されるかどうかを決定するため
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
            'post_category_id' => 'required|exists:sub_categories,id',

            'post_title' => 'required|max:100|string|',
            'post_body' => 'required|max:5000|string',
            // 'comment' => 'required|string|max:250',
            // 'main_category_name' => 'required|max:100|string|unique:main_categories,main_category',
            // 'main_category_id' => 'required|exists:main_categories,id',
            // 'sub_category_name' => 'required|string|max:100|unique:sub_categories,sub_category',
            // exists 指定されたIDがDB上に存在するかを確認


        ];
    }

    public function messages()
    {
        return [
            'post_category_id.required' => 'カテゴリーは必須項目です。',
            'post_category_id.exists' => '入力されたカテゴリーは登録されていません。',
            'post_title.required' => 'タイトルは必須項目です。',
            'post_title.string' => 'タイトルは文字列で入力してください。',
            'post_title.max' => 'タイトルは100文字以内で入力してください。',
            'post_body.required' => '内容は必須項目です。',
            'post_body.string' => '内容は文字列で入力してください。',
            'post_body.max' => '最大文字数は5000文字です。',
            // 'comment.required' => 'コメントは必須項目です。',
            // 'comment.string' => 'コメントは文字列で入力してください。',
            // 'comment.max' => 'コメントは250文字以内で入力してください。',

            // 'main_category_name.required' => 'メインカテゴリーは必須項目です。',
            // 'main_category_name.max' => 'メインカテゴリーは100文字以内です。',
            // 'main_category_name.string' => 'メインカテゴリーは文字列で入力してください。',
            // 'main_category_name.unique' => '入力されたメインカテゴリーはすでに登録済みです。',

            // 'main_category_id.required' => 'メインカテゴリーは必須項目です。',
            // 'main_category_id.exists' => '入力されたメインカテゴリーは登録されていません。',

            // 'sub_category_name.required' => 'サブカテゴリーは必須項目です。',
            // 'sub_category_name.string' => 'サブカテゴリーは文字列で入力してください。',
            // 'sub_category_name.max' => 'サブカテゴリーは100文字以内です。',
            // 'sub_category_name.unique' => '入力されたサブカテゴリー登録済みです。',





        ];
    }
}
