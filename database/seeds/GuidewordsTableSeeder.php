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
            'id' => 1,
            'guideword' => 'Control input or external information wrong or missing'
        ]);
        DB::table('guidewords')->insert([
            'id' => 2,
            'guideword' => 'Inadequate Control Algorithm'
        ]);
        DB::table('guidewords')->insert([
            'id' => 3,
            'guideword' => 'Process Model inconsistent, incorrect or incomplete'
        ]);
        DB::table('guidewords')->insert([
            'id' => 4,
            'guideword' => 'Inappropriate, ineffective or missing control action'
        ]);
        DB::table('guidewords')->insert([
            'id' => 5,
            'guideword' => 'Inadequate Operation'
        ]);
        DB::table('guidewords')->insert([
            'id' => 6,
            'guideword' => 'Delayed Operation'
        ]);
        DB::table('guidewords')->insert([
            'id' => 7,
            'guideword' => 'Conflicting Control Actions'
        ]);
        DB::table('guidewords')->insert([
            'id' => 8,
            'guideword' => 'Component Failures'
        ]);
        DB::table('guidewords')->insert([
            'id' => 9,
            'guideword' => 'Changes over time'
        ]);
        DB::table('guidewords')->insert([
            'id' => 10,
            'guideword' => 'Process Input missing or wrong'
        ]);
        DB::table('guidewords')->insert([
            'id' => 11,
            'guideword' => 'Unidentified or out-of-range disturbance'
        ]);
        DB::table('guidewords')->insert([
            'id' => 12,
            'guideword' => 'Process output contributes to hazard'
        ]);
        DB::table('guidewords')->insert([
            'id' => 13,
            'guideword' => 'Feedback delays'
        ]);
        DB::table('guidewords')->insert([
            'id' => 14,
            'guideword' => 'Measurement inaccuracies'
        ]);
        DB::table('guidewords')->insert([
            'id' => 15,
            'guideword' => 'Incorrect or no information provided'
        ]);
        DB::table('guidewords')->insert([
            'id' => 16,
            'guideword' => 'Inadequate Operation'
        ]);
        DB::table('guidewords')->insert([
            'id' => 17,
            'guideword' => 'Feedback Delays'
        ]);
        DB::table('guidewords')->insert([
            'id' => 18,
            'guideword' => 'Inadequate or missing feedback'
        ]);
    }
}
