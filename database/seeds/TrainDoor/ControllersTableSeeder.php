<?php

use Illuminate\Database\Seeder;

class ControllersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('controllers')->insert([
            'id' => 1,
            'name' => 'Train Door Controller',
            'type' => 'Automatized',
            'project_id' => 1
        ]);
    }
}
