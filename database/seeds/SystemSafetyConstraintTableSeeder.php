<?php

use Illuminate\Database\Seeder;

class SystemSafetyContraintTableSeeder extends Seeder
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
            'name' => 'System Safety Contraint 1',
            'description' => 'Description',
            'project_id' => 1
        ]); 
        DB::table('system_safety_constraint')->insert([
            'id' => 2,
            'name' => 'System Safety Contraint 2',
            'description' => 'Description',
            'project_id' => 1
        ]);
        DB::table('system_safety_constraint')->insert([
            'id' => 3,
            'name' => 'System Safety Contraint 3',
            'description' => 'Description',
            'project_id' => 1
        ]);
    }
}
