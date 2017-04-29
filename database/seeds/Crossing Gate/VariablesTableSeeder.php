<?php

use Illuminate\Database\Seeder;

class VariablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('variables')->insert([
        	'id' => 1,
        	'name' => 'Crossing Gate Position',
        	'project_id' => 1,
            'controller_id' => 0
        ]);
        DB::table('variables')->insert([
        	'id' => 2,
        	'name' => 'Crossing Gate Situation',
        	'project_id' => 1,
            'controller_id' => 0
        ]);
        DB::table('variables')->insert([
        	'id' => 3,
        	'name' => 'Train Position',
        	'project_id' => 1,
            'controller_id' => 1
        ]);
    }
}
