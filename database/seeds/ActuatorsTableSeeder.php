<?php

use Illuminate\Database\Seeder;

class ActuatorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('actuators')->insert([
            'id' => 1,
            'name' => 'Train Door Actuator',
            'project_id' => 1
        ]);
    }
}
