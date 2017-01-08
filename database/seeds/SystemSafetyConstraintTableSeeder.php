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
            'name' => 'Door must not be opened when train is in motion.',
            'description' => 'Description',
            'project_id' => 1
        ]); 
        DB::table('system_safety_constraint')->insert([
            'id' => 2,
            'name' => 'When in Emergency situation, door must be opened.',
            'description' => 'Description',
            'project_id' => 1
        ]);
        DB::table('system_safety_constraint')->insert([
            'id' => 3,
            'name' => 'Door must not be closed when exist a person or object in the doorway.',
            'description' => 'Description',
            'project_id' => 1
        ]);
    }
}
