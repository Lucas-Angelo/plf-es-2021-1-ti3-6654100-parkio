<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * https://laravel.com/docs/7.x/seeding
     * https://github.com/fzaninotto/Faker
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')->insert([[
            'name' => 'Administrator',
            'login' => 'admin',
            'type' => 'A',
            'password' => md5('admin')
        ]]);
    }
}
