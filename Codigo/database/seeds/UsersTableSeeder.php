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
        $faker = Faker\Factory::create();
        DB::table('user')->insert([[
            'name' => $faker->name,
            'login' => $faker->userName,
            'type' => 'A',
            'password' => md5($faker->password)
        ],[
            'name' => $faker->name,
            'login' => $faker->userName,
            'type' => 'A',
            'password' => md5($faker->password)
        ],[
            'name' => $faker->name,
            'login' => $faker->userName,
            'type' => 'A',
            'password' => md5($faker->password)
        ],[
            'name' => $faker->name,
            'login' => $faker->userName,
            'type' => 'A',
            'password' => md5($faker->password)
        ]]);
    }
}
