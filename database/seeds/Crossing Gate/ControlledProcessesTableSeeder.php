<?php

use Illuminate\Database\Seeder;

class ControlledProcessesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('controlled_processes')->insert([
            'id' => 1,
            'name' => 'Crossing Gate',
            'project_id' => 1
        ]);
    }
}
