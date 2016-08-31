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
            'rule_index' => 1,
            'state_id' => 3,
            'project_id' => 1
        ]);
        DB::table('rules')->insert([
            'id' => 1,
            'rule_index' => 1,
            'state_id' => 5,
            'project_id' => 1
        ]);
        DB::table('rules')->insert([
            'id' => 1,
            'rule_index' => 1,
            'state_id' => 7,
            'project_id' => 1
        ]);
        DB::table('rules')->insert([
            'id' => 1,
            'rule_index' => 1,
            'state_id' => 9,
            'project_id' => 1
        ]);
        DB::table('rules')->insert([
            'id' => 1,
            'rule_index' => 1,
            'state_id' => 11,
            'project_id' => 1
        ]);

        DB::table('rules')->insert([
            'id' => 1,
            'rule_index' => 1,
            'state_id' => 12,
            'project_id' => 1
        ]);
    }
}
