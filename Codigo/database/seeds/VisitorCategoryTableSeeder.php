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
                'description' => 'Parente',
                'time' => 320
            ],[
                'description' => 'Entregador',
                'time' => 30
            ],[
                'description' => 'Obra',
                'time' => 500
            ]
        ]);
    }
}
