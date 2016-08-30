<?php

use Illuminate\Database\Seeder;

class ControlActionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('control_actions')->insert([
            'id' => 1,
            'name' => 'Open door command',
            'description' => 'Description',
            'component_id' => 3
        ]);
        DB::table('control_actions')->insert([
            'id' => 2,
            'name' => 'Close door command',
            'description' => 'Description',
            'component_id' => 3
        ]);
    }
}
