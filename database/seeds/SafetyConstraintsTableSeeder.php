<?php

use Illuminate\Database\Seeder;

class SafetyConstraintsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('safety_constraints')->insert([
            'id' => 1,
            'unsafe_control_action' => 'Train door controller not provide open door command when emergency.',
            'safety_constraint' => 'In an emergency, the door always must open.',
            'rule_id' => 0,
            'controlaction_id' => 1
        ]); 
        DB::table('safety_constraints')->insert([
            'id' => 2,
            'unsafe_control_action' => 'Train door controller not provide open door command when person or obstacle is in the doorway.',
            'safety_constraint' => 'The door never must close if there is a person or object in the doorway.',
            'rule_id' => 0,
            'controlaction_id' => 1
        ]); 
        DB::table('safety_constraints')->insert([
            'id' => 3,
            'unsafe_control_action' => 'Train door controller provides open door command when train is in motion.',
            'safety_constraint' => 'The door only opens aligned at platform or in emergencies.',
            'rule_id' => 0,
            'controlaction_id' => 1
        ]); 
        DB::table('safety_constraints')->insert([
            'id' => 4,
            'unsafe_control_action' => 'Train door controller not provide close door command before moving.',
            'safety_constraint' => 'The train should be unable to move if the door is not completely closed.',
            'rule_id' => 0,
            'controlaction_id' => 2
        ]); 
        DB::table('safety_constraints')->insert([
            'id' => 5,
            'unsafe_control_action' => 'Train door controller provides close door command when person or objects are in the doorway.',
            'safety_constraint' => 'Sensors should prevent the door from closing when there is an obstacle in the doorway.',
            'rule_id' => 0,
            'controlaction_id' => 2
        ]); 
        DB::table('safety_constraints')->insert([
            'id' => 6,
            'unsafe_control_action' => 'Train door controller provides close door command when emergency.',
            'safety_constraint' => 'During an emergency, the doors should be fully open.',
            'rule_id' => 0,
            'controlaction_id' => 2
        ]); 
    }
}
