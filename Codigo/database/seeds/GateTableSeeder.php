<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gate')->insert([
            [
                "description" => "Portaria 1"
            ]
        ]);
    }
}
