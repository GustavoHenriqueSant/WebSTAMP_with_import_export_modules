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
            'accidents_id' => 2,
            'hazards_id' => 1
        ]);
        DB::table('accidents_hazards')->insert([
            'id' => 2,
            'accidents_id' => 1,
            'hazards_id' => 2
        ]);
        DB::table('accidents_hazards')->insert([
            'id' => 3,
            'accidents_id' => 3,
            'hazards_id' => 3
        ]);
    }
}
