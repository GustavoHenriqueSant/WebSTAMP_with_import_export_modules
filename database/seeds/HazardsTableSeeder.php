<?php

use Illuminate\Database\Seeder;

class HazardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hazards')->insert([
            'id' => 1,
            'name' => 'Door close on a person in the doorway.',
            'description' => 'Description'
        ]);
        DB::table('hazards')->insert([
            'id' => 2,
            'name' => 'Door open when the train is moving or not in a station.',
            'description' => 'Description'
        ]); 
        DB::table('hazards')->insert([
            'id' => 3,
            'name' => 'Passengers/staff are unable to exit during an emergency.',
            'description' => 'Description'
        ]);
    }
}
