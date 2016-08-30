<?php

use Illuminate\Database\Seeder;

class AccidentsHazardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accidents_hazards')->insert([
            'id' => 1,
            'accident_id' => 2,
            'hazard_id' => 1
        ]);
        DB::table('accidents_hazards')->insert([
            'id' => 2,
            'accident_id' => 1,
            'hazard_id' => 2
        ]);
        DB::table('accidents_hazards')->insert([
            'id' => 3,
            'accident_id' => 3,
            'hazard_id' => 3
        ]);
    }
}
