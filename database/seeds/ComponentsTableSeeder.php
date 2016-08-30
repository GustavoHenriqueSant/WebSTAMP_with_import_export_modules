<?php

use Illuminate\Database\Seeder;

class ComponentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('components')->insert([
            'id' => 1,
            'name' => 'Train Door Actuator',
            'type' => 'Actuator',
            'project_id' => 1
        ]);
        DB::table('components')->insert([
            'id' => 2,
            'name' => 'Train Door',
            'type' => 'ControlledProcess',
            'project_id' => 1
        ]);
        DB::table('components')->insert([
            'id' => 3,
            'name' => 'Train Door Controller',
            'type' => 'Controller',
            'project_id' => 1
        ]);
        DB::table('components')->insert([
            'id' => 4,
            'name' => 'Train Door Sensor',
            'type' => 'Sensor',
            'project_id' => 1
        ]);
    }
}
