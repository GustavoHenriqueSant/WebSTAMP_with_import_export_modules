<?php

use Illuminate\Database\Seeder;

class ConnectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('connections')->insert([
            'id' => 1,
            'output_component_id' => 1,
            'type_output' => 'Controller',
            'input_component_id' => 0,
            'type_input' => 'Actuator'
        ]);
        DB::table('connections')->insert([
            'id' => 2,
            'output_component_id' => 0,
            'type_output' => 'Actuator',
            'input_component_id' => 1,
            'type_input' => 'Controlled Process'
        ]);
        DB::table('connections')->insert([
            'id' => 3,
            'output_component_id' => 0,
            'type_output' => 'Controlled Process',
            'input_component_id' => 1,
            'type_input' => 'Sensor'
        ]);
        DB::table('connections')->insert([
            'id' => 4,
            'output_component_id' => 1,
            'type_output' => 'Sensor',
            'input_component_id' => 0,
            'type_input' => 'Controller'
        ]);
    }
}
