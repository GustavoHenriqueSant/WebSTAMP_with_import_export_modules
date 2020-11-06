<?php

use Illuminate\Database\Seeder;

class AccidentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('losses')->insert([
            'id' => 1,
            'name' => 'Injury to a person by falling out of the train.',
            'description' => 'Description',
            'project_id' => 1
        ]);
        DB::table('losses')->insert([
            'id' => 2,
            'name' => 'Being hit by a closing door.',
            'description' => 'Description',
            'project_id' => 1
        ]);
        DB::table('losses')->insert([
            'id' => 3,
            'name' => 'Being trapped inside a train during an emergency.',
            'description' => 'Description',
            'project_id' => 1
        ]);
    }
}
