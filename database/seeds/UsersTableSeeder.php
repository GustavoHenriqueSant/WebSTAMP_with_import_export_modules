<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Filipe Ribeiro',
            'email' => 'filipe.parisoto@gmail.com',
            'password' => '@P4r1s0to'
        ]);
    }
}
