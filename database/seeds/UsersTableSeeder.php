<?php

use Illuminate\Database\Seeder;
use App\Models\Users\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'over_name' => '田中',
            'under_name' => '花子',
            'over_name_kana' => 'タナカ',
            'under_name_kana' => 'ハナコ',
            'mail_address' => 'hanako@gmail.com',
            'sex' => 1,
            'birth_day' => '1997-07-13',
            'role' => 4,
            'password' => bcrypt('password0713'), //ハッシュ化
            'remember_token' => Str::random(10), //保持するためのトークン
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ]);
    }
}
