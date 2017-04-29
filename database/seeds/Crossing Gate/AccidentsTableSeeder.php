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
        DB::table('accidents')->insert([
            'id' => 1,
            'name' => 'Collision between car and train, causing damage loss and human injury or death.',
            'description' => 'Description',
            'project_id' => 1
        ]);
        DB::table('accidents')->insert([
            'id' => 2,
            'name' => 'Collision between cars, causing damage loss and human injury or death.',
            'description' => 'Description',
            'project_id' => 1
        ]);
        DB::table('accidents')->insert([
            'id' => 3,
            'name' => 'Collision between car and crossing gate.',
            'description' => 'Description',
            'project_id' => 1
        ]);
        DB::table('accidents')->insert([
            'id' => 4,
            'name' => 'Train derailment.',
            'description' => 'Description',
            'project_id' => 1
        ]);
    }
}
