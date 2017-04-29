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
            'accidents_id' => 1,
            'hazards_id' => 1
        ]);
        DB::table('accidents_hazards')->insert([
            'id' => 2,
            'accidents_id' => 1,
            'hazards_id' => 3
        ]);
        DB::table('accidents_hazards')->insert([
            'id' => 3,
            'accidents_id' => 1,
            'hazards_id' => 4
        ]);
        DB::table('accidents_hazards')->insert([
            'id' => 4,
            'accidents_id' => 2,
            'hazards_id' => 1
        ]);
        DB::table('accidents_hazards')->insert([
            'id' => 5,
            'accidents_id' => 2,
            'hazards_id' => 2
        ]);
        DB::table('accidents_hazards')->insert([
            'id' => 6,
            'accidents_id' => 2,
            'hazards_id' => 3
        ]);
        DB::table('accidents_hazards')->insert([
            'id' => 7,
            'accidents_id' => 3,
            'hazards_id' => 5
        ]);
        DB::table('accidents_hazards')->insert([
            'id' => 8,
            'accidents_id' => 4,
            'hazards_id' => 1
        ]);
        DB::table('accidents_hazards')->insert([
            'id' => 9,
            'accidents_id' => 4,
            'hazards_id' => 3
        ]);
        DB::table('accidents_hazards')->insert([
            'id' => 10,
            'accidents_id' => 4,
            'hazards_id' => 4
        ]);
    }
}
