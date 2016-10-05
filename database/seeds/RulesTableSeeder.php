<?php

use Illuminate\Database\Seeder;

class RulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rules')->insert([
            'id' => 1,
            'index' => 1,
            'state_id' => 1,
            'controlaction_id' => 1
        ]);
        DB::table('rules')->insert([
            'id' => 2,
            'index' => 1,
            'state_id' => 0,
            'controlaction_id' => 1
        ]);
        DB::table('rules')->insert([
            'id' => 3,
            'index' => 1,
            'state_id' => 6,
            'controlaction_id' => 1
        ]);
        DB::table('rules')->insert([
            'id' => 4,
            'index' => 1,
            'state_id' => 8,
            'controlaction_id' => 1
        ]);
        DB::table('rules')->insert([
            'id' => 5,
            'index' => 1,
            'state_id' => 10,
            'controlaction_id' => 1
        ]);
    }
}
