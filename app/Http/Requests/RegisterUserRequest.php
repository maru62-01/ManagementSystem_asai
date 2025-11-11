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
            'sex' => 'required|in:1,2,3', // 男性=1, 女性=2, その他=3など
            'old_year' => 'required|integer|min:2000|max:' . date('Y'),
            // integer→整数かどうか判断
            // max:' . date('Y'),→現在の年を取得してそれ以上であったらエラー
            'old_month' => 'required|min:1|max:12',
            'old_day' => 'required|min:1|max:31',
            // 'subject' => 'required|exists:subjects,id', // 科目はsubjectsテーブルのidと一致する必要がある
            'role' => 'required|in:1,2,3,4', // 講師(国語)=1など
            'password' => 'required|string|min:8|max:30',
            'password_confirmation' => 'required|string|min:8|max:30|same:password',
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

    public function messages()
    {
        return [
            'over_name.required' => '姓を入力してください。',
            'over_name.string' => '姓は文字列で入力してください。',
            'over_name.max' => '姓は10文字以内で入力してください。',

            'under_name.required' => '名を入力してください。',
            'under_name.string' => '名は文字列で入力してください。',
            'under_name.max' => '名は10文字以内で入力してください。',

            'over_name_kana.required' => '姓（カナ）を入力してください。',
            'over_name_kana.regex' => '姓（カナ）はカタカナで入力してください。',
            'over_name_kana.max' => '姓（カナ）は30文字以内で入力してください。',

            'under_name_kana.required' => '名（カナ）を入力してください。',
            'under_name_kana.regex' => '名（カナ）はカタカナで入力してください。',
            'under_name_kana.max' => '名（カナ）は30文字以内で入力してください。',

            'mail_address.required' => 'メールアドレスを入力してください。',
            'mail_address.email' => '有効なメールアドレス形式で入力してください。',
            'mail_address.max' => 'メールアドレスは100文字以内で入力してください。',
            'mail_address.unique' => 'そのメールアドレスはすでに使用されています。',

            'old_year.required' => '年を入力してください。',
            'old_year.integer' => '年は数値で入力してください。',
            'old_year.min' => '2000年以降の年を入力してください。',
            'old_year.max' => '現在の年を入力してください。',

            'old_month.required' => '月を入力してください。',
            'old_month.integer' => '月は数値で入力してください。',
            'old_month.min' => '月は1〜12の間で入力してください。',
            'old_month.max' => '月は12以下で入力してください。',

            'old_day.required' => '日を入力してください。',
            'old_day.integer' => '日は数値で入力してください。',
            'old_day.min' => '日は1〜31の間で入力してください。',
            'old_day.max' => '日は31以下で入力してください。',

            'role.required' => '役割を選択してください。',
            'role.in' => '役割の選択が正しくありません（講師・生徒などから選んでください）',

            // 'subject.required' => '科目を選択してください',
            // 'subject.exists' => '選択した科目が存在しません',

            'sex.required' => '性別を選択してください。',
            'sex.in' => '性別の選択が正しくありません（男性・女性・その他から選んでください）',


            'password.required' => 'パスワードを入力してください。',
            'password.string' => 'パスワードは文字列で入力してください。',
            'password.min' => 'パスワードは8文字以上で入力してください。',
            'password.max' => 'パスワードは30文字以内で入力してください。',


            'password_confirmation.required' => '確認用パスワードを入力してください。',
            'password_confirmation.string' => '確認用パスワードは文字列で入力してください。',
            'password_confirmation.min' => '確認用パスワードは8文字以上で入力してください。',
            'password_confirmation.max' => '確認用パスワードは30文字以内で入力してください。',
        ];
    }
}
