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
            'name' => 'The crossing gate does not close when train is approaching the level crossing.',
            'description' => 'Description'
        ]);
        DB::table('hazards')->insert([
            'id' => 2,
            'name' => 'Minimum distance between vehicles is not assured.',
            'description' => 'Description'
        ]); 
        DB::table('hazards')->insert([
            'id' => 3,
            'name' => 'Poor signaling and poor street lighting.',
            'description' => 'Description'
        ]);
        DB::table('hazards')->insert([
            'id' => 4,
            'name' => 'Vehicle on the railway.',
            'description' => 'Description'
        ]);
        DB::table('hazards')->insert([
            'id' => 5,
            'name' => 'Vehicle is passing through the crossing gate.',
            'description' => 'Description'
        ]);
    }
}
