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
        	'name' => 'Door Position',
        	'project_id' => 1,
            'controller_id' => 0
        ]);
        DB::table('variables')->insert([
        	'id' => 2,
        	'name' => 'Door Situation',
        	'project_id' => 1,
            'controller_id' => 0
        ]);
        DB::table('variables')->insert([
        	'id' => 3,
        	'name' => 'Train Position',
        	'project_id' => 1,
            'controller_id' => 1
        ]);
        DB::table('variables')->insert([
        	'id' => 4,
        	'name' => 'Train Motion',
        	'project_id' => 1,
            'controller_id' => 1
        ]);
        DB::table('variables')->insert([
        	'id' => 5,
        	'name' => 'Emergency',
        	'project_id' => 1,
            'controller_id' => 1
        ]);
    }
}
