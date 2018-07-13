<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                'name' => '超级管理员',
                'email' => 'cjgly@gmail.com',
                'password' => bcrypt('secret'),
                'api_token' => str_random(60),
                'roleId' => 1,
                'is_active' => 1
            ]
        );
    }
}
