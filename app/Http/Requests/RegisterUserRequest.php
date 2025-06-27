<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            'over_name' => 'required|string|max:10',
            'under_name' => 'required|string|max:10',
            'over_name_kana' => 'required|regex:/^[ァ-ヶー]+$/u|max:30',
            'under_name_kana' => 'required|regex:/^[ァ-ヶー]+$/u|max:30',
            'mail_address' => 'required|email|max:100|unique:users,mail_address',
            'sex' => 'required|in:男性,女性,その他',
            'old_year' => 'required|integer|min:2000|max:' . date('Y'),
            // integer→整数かどうか判断
            // max:' . date('Y'),→現在の年を取得してそれ以上であったらエラー
            'old_month' => 'required|integer|min:1|max:12',
            'old_day' => 'required|integer|min:1|max:31',
            'role' => 'required|in:講師(国語),講師(数学),教師(英語),生徒',
            'password' => 'required|string|min:8|max:30',
            // 'subject' => 'required|array', // 科目は配


            //
        ];
    }

    // バリデーションのルールを全部チャックし終わったあとのバリデーション
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $year = $this->input('old_year');
            $month = $this->input('old_month');
            $day = $this->input('old_day');

            if (!checkdate((int)$month, (int)$day, (int)$year)) {
                $validator->errors()->add('birth_day', '正しい日付を入力してください。');
            }
        });
    }
}
