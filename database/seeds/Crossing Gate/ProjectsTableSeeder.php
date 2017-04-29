<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects')->insert([
            'id' => 1,
            'name' => 'STPA Project Test',
            'description' => 'Description'
        ]);
    }
}
