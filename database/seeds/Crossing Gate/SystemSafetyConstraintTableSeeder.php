<?php

use Illuminate\Database\Seeder;

class SystemSafetyConstraintTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('system_safety_constraint')->insert([
            'id' => 1,
            'name' => 'The crossing gate must be closed when approaching the level crossing.',
            'description' => 'Description',
            'project_id' => 1
        ]); 
        DB::table('system_safety_constraint')->insert([
            'id' => 2,
            'name' => 'Minimum distance between vehicles must be assured.',
            'description' => 'Description',
            'project_id' => 1
        ]);
        DB::table('system_safety_constraint')->insert([
            'id' => 3,
            'name' => 'Minimum distance between vehicles must be assured.',
            'description' => 'Description',
            'project_id' => 1
        ]);
        DB::table('system_safety_constraint')->insert([
            'id' => 4,
            'name' => 'Vehicles must not be in the railway when train is approaching the level crossing .',
            'description' => 'Description',
            'project_id' => 1
        ]);
        DB::table('system_safety_constraint')->insert([
            'id' => 5,
            'name' => 'Vehicles must not pass though the crossing gate when it is being closed.',
            'description' => 'Description',
            'project_id' => 1
        ]);
    }
}
