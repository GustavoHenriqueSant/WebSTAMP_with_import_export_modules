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
            'name' => 'Ensure a safe passage along the level crossing.',
            'description' => 'Description',
            'project_id' => 1
        ]); 
        DB::table('system_goals')->insert([
            'id' => 2,
            'name' => 'Avoid collisions.',
            'description' => 'Description',
            'project_id' => 1
        ]); 
        DB::table('system_goals')->insert([
            'id' => 3,
            'name' => 'Protect the train, vehicles and passengers.',
            'description' => 'Description',
            'project_id' => 1
        ]);
    }
}
