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
            'type_output' => 'controller',
            'input_component_id' => 1,
            'type_input' => 'actuator'
        ]);
        DB::table('connections')->insert([
            'id' => 2,
            'output_component_id' => 1,
            'type_output' => 'actuator',
            'input_component_id' => 1,
            'type_input' => 'controlled_process'
        ]);
        DB::table('connections')->insert([
            'id' => 3,
            'output_component_id' => 1,
            'type_output' => 'controlled_process',
            'input_component_id' => 1,
            'type_input' => 'sensor'
        ]);
        DB::table('connections')->insert([
            'id' => 4,
            'output_component_id' => 1,
            'type_output' => 'sensor',
            'input_component_id' => 1,
            'type_input' => 'controller'
        ]);
    }
}
