<?php

use Illuminate\Database\Seeder;

class SystemGoalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('system_goals')->insert([
            'id' => 1,
            'name' => 'Provide an easy way to control the door.',
            'description' => 'Description',
            'project_id' => 1
        ]); 
        DB::table('system_goals')->insert([
            'id' => 2,
            'name' => 'Ensure the safety of passengers in boarding and landing at stations.',
            'description' => 'Description',
            'project_id' => 1
        ]); 
        DB::table('system_goals')->insert([
            'id' => 3,
            'name' => 'Avoid any type of injury to passengers.',
            'description' => 'Description',
            'project_id' => 1
        ]);
        DB::table('system_goals')->insert([
            'id' => 4,
            'name' => 'Make a safe trip between stations.',
            'description' => 'Description',
            'project_id' => 1
        ]);
    }
}
