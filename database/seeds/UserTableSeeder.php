<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 100) as $index) {
            DB::table('users')->insert([
                'login' => 'user'.$index,
                'email' => 'someemail'.$index.'@mail.ru',
                'password' => bcrypt('123456'),
                'remember_token' =>NULL,
            ]);
        }
    }
}
