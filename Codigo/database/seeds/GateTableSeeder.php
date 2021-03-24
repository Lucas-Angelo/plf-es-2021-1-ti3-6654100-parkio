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
        $fields = [];
        for($i=0;$i<4;$i++) {
            array_push($fields, [
                "description" => "Portaria ".($i+1)
            ]);
        }
        DB::table('gate')->insert($fields);
    }
}
