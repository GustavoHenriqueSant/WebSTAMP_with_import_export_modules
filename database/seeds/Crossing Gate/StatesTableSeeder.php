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
            'name' => 'Vehicle Passing',
            'variable_id' => 2
        ]);
        DB::table('states')->insert([
            'id' => 5,
            'name' => 'No vehicle passing',
            'variable_id' => 2
        ]);
        DB::table('states')->insert([
            'id' => 6,
            'name' => 'Closer of crossing gate',
            'variable_id' => 3
        ]);
        DB::table('states')->insert([
            'id' => 7,
            'name' => 'In crossing gate',
            'variable_id' => 3
        ]);
        DB::table('states')->insert([
            'id' => 8,
            'name' => 'Far from crossing gate',
            'variable_id' => 3
        ]);
    }
}
