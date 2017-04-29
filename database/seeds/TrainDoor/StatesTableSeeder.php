<?php

use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->insert([
            'id' => 1,
            'name' => 'Fully Open',
            'variable_id' => 1
        ]);
        DB::table('states')->insert([
            'id' => 2,
            'name' => 'Partially Open',
            'variable_id' => 1
        ]);
        DB::table('states')->insert([
            'id' => 3,
            'name' => 'Fully Closed',
            'variable_id' => 1
        ]);
        DB::table('states')->insert([
            'id' => 4,
            'name' => 'Person or object in doorway',
            'variable_id' => 2
        ]);
        DB::table('states')->insert([
            'id' => 5,
            'name' => 'Nothing in doorway',
            'variable_id' => 2
        ]);
        DB::table('states')->insert([
            'id' => 6,
            'name' => 'Aligned at platform',
            'variable_id' => 3
        ]);
        DB::table('states')->insert([
            'id' => 7,
            'name' => 'Not aligned at platform',
            'variable_id' => 3
        ]);
        DB::table('states')->insert([
            'id' => 8,
            'name' => 'In Movement',
            'variable_id' => 4
        ]);
        DB::table('states')->insert([
            'id' => 9,
            'name' => 'Stopped',
            'variable_id' => 4
        ]);
        DB::table('states')->insert([
            'id' => 10,
            'name' => 'Evacuation Required',
            'variable_id' => 5
        ]);
        DB::table('states')->insert([
            'id' => 11,
            'name' => 'No Emergency',
            'variable_id' => 5
        ]);
    }
}
