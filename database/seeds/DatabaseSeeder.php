<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            SubjectsTableSeeder::class,
        ]); //$this->call→シーダーを呼び出す命令　UsersTableSeeder::class→呼び出すクラスの名前
    }
}
