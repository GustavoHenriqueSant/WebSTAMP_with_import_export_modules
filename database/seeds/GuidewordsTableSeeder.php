<?php

use Illuminate\Database\Seeder;

class GuidewordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('guidewords')->insert([
            'guideword' => 'Control input or external information wrong or missing'
        ]);
        DB::table('guidewords')->insert([
            'guideword' => 'Inadequate Control Algorithm'
        ]);
        DB::table('guidewords')->insert([
            'guideword' => 'Process Model inconsistent, incorrect or incomplete'
        ]);
        DB::table('guidewords')->insert([
            'guideword' => 'Inappropriate, ineffective or missing control action'
        ]);
        DB::table('guidewords')->insert([
            'guideword' => 'Inadequate Operation'
        ]);
        DB::table('guidewords')->insert([
            'guideword' => 'Delayed Operation'
        ]);
        DB::table('guidewords')->insert([
            'guideword' => 'Conflicting Control Actions'
        ]);
        DB::table('guidewords')->insert([
            'guideword' => 'Component Failures'
        ]);
        DB::table('guidewords')->insert([
            'guideword' => 'Changes over time'
        ]);
        DB::table('guidewords')->insert([
            'guideword' => 'Process Input missing or wrong'
        ]);
        DB::table('guidewords')->insert([
            'guideword' => 'Unidentified or out-of-range disturbance'
        ]);
        DB::table('guidewords')->insert([
            'guideword' => 'Process output contributes to hazard'
        ]);
        DB::table('guidewords')->insert([
            'guideword' => 'Feedback delays'
        ]);
        DB::table('guidewords')->insert([
            'guideword' => 'Measurement inaccuracies'
        ]);
        DB::table('guidewords')->insert([
            'guideword' => 'Incorrect or no information provided'
        ]);
        DB::table('guidewords')->insert([
            'guideword' => 'Inadequate Operation'
        ]);
        DB::table('guidewords')->insert([
            'guideword' => 'Feedback Delays'
        ]);
        DB::table('guidewords')->insert([
            'guideword' => 'Inadequate or missing feedback'
        ]);
    }
}
