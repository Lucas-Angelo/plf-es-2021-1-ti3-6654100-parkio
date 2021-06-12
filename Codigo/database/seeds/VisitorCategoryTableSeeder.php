<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VisitorCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('visitor_category')->insert([
            [
                'description' => 'Visitante Comum',
                'time' => 20
            ]
        ]);
    }
}
