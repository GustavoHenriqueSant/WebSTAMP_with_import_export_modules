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
        DB::table('losses_hazards')->insert([
            'id' => 1,
            'losses_id' => 2,
            'hazards_id' => 1
        ]);
        DB::table('losses_hazards')->insert([
            'id' => 2,
            'losses_id' => 1,
            'hazards_id' => 2
        ]);
        DB::table('losses_hazards')->insert([
            'id' => 3,
            'losses_id' => 3,
            'hazards_id' => 3
        ]);
    }
}
