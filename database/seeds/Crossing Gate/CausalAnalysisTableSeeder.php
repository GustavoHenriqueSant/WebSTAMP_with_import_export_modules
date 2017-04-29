<?php

use Illuminate\Database\Seeder;

class CausalAnalysisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('causal_analysis')->insert([
            'scenario' => '[CONTROLLER] does receive the wrong value of [VARIABLE].',
            'associated_causal_factor' => 'Failure in the communication between [CONTROLLER] and the external system.',
            'requirement' => 'The communication between [CONTROLLER] and external system must be improved.',
            'role' => 'Engineers or network administrator.',
            'rationale' => 'This external system are out of the scope of the system under analysis.',
            'guideword_id' => '1',
            'safety_constraint_id' => '0'
        ]);
        DB::table('causal_analysis')->insert([
            'scenario' => 'Value of [VARIABLE] is missing.',
            'associated_causal_factor' => 'Failure in the communication between [CONTROLLER] and the external system.',
            'requirement' => 'The communication between [CONTROLLER] and external system must be improved.',
            'role' => 'Engineers or network administrator.',
            'rationale' => 'This external system are out of the scope of the system under analysis.',
            'guideword_id' => '1',
            'safety_constraint_id' => '0'
        ]);
        DB::table('causal_analysis')->insert([
            'scenario' => 'An incorrect algorithm was designed',
            'associated_causal_factor' => 'Algorithm wrong or incomplete or lack of knowledge of the system.',
            'requirement' => 'The algorithm must be revised and tested after each change to minimize errors.',
            'role' => 'Engineers and testers',
            'rationale' => 'Simulations of the system can help to validate the algorithm.',
            'guideword_id' => '2',
            'safety_constraint_id' => '0'
        ]);
        DB::table('causal_analysis')->insert([
            'scenario' => 'Algorithm ineffective, unsafe or incomplete after process changes.',
            'associated_causal_factor' => 'Algorithm was not updated to support changes of the process.',
            'requirement' => 'Algorithm must be updated, revised and tested after each change in the process to minimize errors.',
            'role' => 'Designers and operators.',
            'rationale' => 'Algorithm must be revised and adapted to support the process changes.',
            'guideword_id' => '2',
            'safety_constraint_id' => '0'
        ]);
        DB::table('causal_analysis')->insert([
            'scenario' => 'Algorithm updated incorrectly.',
            'associated_causal_factor' => 'Flaw in the modifications or algorithm was not updated to support the modifications.',
            'requirement' => 'After each modification in the algorithm, it must be revised and tested to minimize errors.',
            'role' => 'Designers, testers and operators.',
            'rationale' => 'Algorithm should be updated properly for each change.',
            'guideword_id' => '2',
            'safety_constraint_id' => '0'
        ]);
        DB::table('causal_analysis')->insert([
            'scenario' => 'Current state of the process model is inconsistent, incorrect or incomplete.',
            'associated_causal_factor' => 'Feedback of emergency missing or with wrong value.',
            'requirement' => 'Process model in the [CONTROLLER] must be consistent with the [CONTROLLED PROCESS] and external system status.',
            'role' => 'System’s designers',
            'rationale' => 'Not applicable (N/A)',
            'guideword_id' => '3',
            'safety_constraint_id' => ''
        ]);
        DB::table('causal_analysis')->insert([
            'scenario' => '[CONTROLLER] does not provide the control action or issued an incorrect.',
            'associated_causal_factor' => 'Problems in the process model and/or control algorithms.',
            'requirement' => 'Process model in [CONTROLLER] must be the same in the [CONTROLLED PROCESS] and the control ',
            'role' => 'Engineers',
            'rationale' => 'Not Applicable (N/A)',
            'guideword_id' => '4',
            'safety_constraint_id' => '0'
        ]);
        DB::table('causal_analysis')->insert([
            'scenario' => '[ACTUATOR] cannot act in [CONTROLLED PROCESS] or complete the execution of the Control Action.',
            'associated_causal_factor' => 'Failure in the [ACTUATOR].',
            'requirement' => 'The [ACTUATOR] must be maintained periodically.',
            'role' => 'Reliability engineers',
            'rationale' => 'Reliability analysis can minimize the failures.',
            'guideword_id' => '5',
            'safety_constraint_id' => '0'
        ]);
        DB::table('causal_analysis')->insert([
            'scenario' => '[ACTUATOR] performs a non-issued control action.',
            'associated_causal_factor' => 'Failure in the [ACTUATOR].',
            'requirement' => 'The [ACTUATOR] must be maintained periodically.',
            'role' => 'Reliability engineers',
            'rationale' => 'Reliability analysis can minimize the failures.',
            'guideword_id' => '5',
            'safety_constraint_id' => '0'
        ]);
        DB::table('causal_analysis')->insert([
            'scenario' => 'The issued control action delays to be enforced by the [ACTUATOR].',
            'associated_causal_factor' => 'Failure in the [ACTUATOR], electric failure or temporary loss of power',
            'requirement' => 'The [ACTUATOR] must be maintained periodically.',
            'role' => 'Reliability engineers',
            'rationale' => 'Reliability analysis can minimize the failures.',
            'guideword_id' => '6',
            'safety_constraint_id' => '0'
        ]);
        DB::table('causal_analysis')->insert([
            'scenario' => '[CONTROLLER2] issues a control action that conflicts with the one provided by the [CONTROLLER].',
            'associated_causal_factor' => 'Lack of resolution of controls or design error.',
            'requirement' => 'Analysis of conflicts should be done to avoid conflicting control actions.',
            'role' => 'Safety Engineer and Stakeholders.',
            'rationale' => 'Not Applicable (N/A)',
            'guideword_id' => '7',
            'safety_constraint_id' => '0'
        ]);
        DB::table('causal_analysis')->insert([
            'scenario' => 'The system components do not perform their functions.',
            'associated_causal_factor' => 'Failure in one or more components of the system.',
            'requirement' => 'Ongoing STPA analysis must be done in order to cover each change in the system.',
            'role' => 'Maintainer',
            'rationale' => 'Reliability analysis can be done for small components introduced in the system. Complex components must have their own STPA analysis.',
            'guideword_id' => '8',
            'safety_constraint_id' => '0'
        ]);
        DB::table('causal_analysis')->insert([
            'scenario' => '[CONTROLLED PROCESS] affected by natural or man made disasters.',
            'associated_causal_factor' => 'Depends of the disaster.',
            'requirement' => 'Some disasters can be mitigated.',
            'role' => 'Safety Engineers.',
            'rationale' => 'Not Applicable (N/A)',
            'guideword_id' => '11',
            'safety_constraint_id' => '0'
        ]);
        DB::table('causal_analysis')->insert([
            'scenario' => 'Temporary obstruction not allow the reading of the [CONTROLLED PROCESS].',
            'associated_causal_factor' => 'Obstruction for observing; Mean obstructed.',
            'requirement' => 'Alternative way to read the [CONTROLLED PROCESS] should be considered.',
            'role' => 'Design team',
            'rationale' => 'Not Applicable (N/A)',
            'guideword_id' => '13',
            'safety_constraint_id' => '0'
        ]);
        DB::table('causal_analysis')->insert([
            'scenario' => 'Current state of the [CONTROLLED PROCESS] cannot be read accurately.',
            'associated_causal_factor' => 'Obstruction for observing; Mean obstructed; Poor environment conditions or; Accuracy property is not guaranteed.',
            'requirement' => 'Most capable sensor or alternative way to read the [CONTROLLED PROCESS] should be considered.',
            'role' => 'Design team',
            'rationale' => '[SENSOR] may not be calibrated.',
            'guideword_id' => '14',
            'safety_constraint_id' => '0'
        ]);
        DB::table('causal_analysis')->insert([
            'scenario' => '[CONTROLLED PROCESS] cannot be read by the [SENSOR].',
            'associated_causal_factor' => 'Reading errors; Variations in the [CONTROLLED PROCESS] or; Precision and sensitivity properties are not guaranteed.',
            'requirement' => 'The correct type of sensor must be chosen according to the controlled process.',
            'role' => 'Design team',
            'rationale' => 'Not Applicable (N/A)',
            'guideword_id' => '15',
            'safety_constraint_id' => '0'
        ]);
        DB::table('causal_analysis')->insert([
            'scenario' => '[SENSOR] cannot get the status of the [CONTROLLED PROCESS].',
            'associated_causal_factor' => 'Failure in the [SENSOR].',
            'requirement' => 'The [SENSOR] must be maintained periodically.',
            'role' => 'Reliability engineers',
            'rationale' => 'Reliability analysis can minimize the failures.',
            'guideword_id' => '16',
            'safety_constraint_id' => '0'
        ]);
        DB::table('causal_analysis')->insert([
            'scenario' => 'Feedback delays to reach the [CONTROLLER]',
            'associated_causal_factor' => 'Limitations in the communication protocol or problem in the communication mean (Wire or Wireless)',
            'requirement' => 'Communication between [CONTROLLER] and [SENSOR] must be improved.',
            'role' => 'Engineers',
            'rationale' => 'Alternative communication means can be considered.',
            'guideword_id' => '17',
            'safety_constraint_id' => '0'
        ]);
        /*
        DB::table('causal_analysis')->insert([
            'scenario' => '',
            'associated_causal_factor' => '',
            'requirement' => '',
            'role' => '',
            'rationale' => '',
            'guideword_id' => '',
            'safety_constraint_id' => '0'
        ]);
        */
    }
}
