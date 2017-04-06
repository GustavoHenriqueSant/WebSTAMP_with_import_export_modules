<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        /*
        Schema::table('accidents_hazards', function ($table) {
            $table->foreign('accidents_id')->references('id')->on('accidents')->onDelete('cascade');
            $table->foreign('hazards_id')->references('id')->on('hazards')->onDelete('cascade');
        });
        
        Schema::table('accidents', function ($table) {
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });

        

        Schema::table('teams', function ($table) {
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });

        Schema::table('actuators', function ($table) {
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });

        Schema::table('controllers', function ($table) {
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });

        Schema::table('controlled_processes', function ($table) {
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });

        Schema::table('sensors', function ($table) {
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });

        Schema::table('system_goals', function ($table) {
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });

        Schema::table('control_actions', function ($table) {
            $table->foreign('controller_id')->references('id')->on('controllers')->onDelete('cascade');
        });

        Schema::table('variables', function ($table) {
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('controller_id')->references('id')->on('controllers')->onDelete('cascade');
        });

        Schema::table('states', function ($table) {
            $table->foreign('variable_id')->references('id')->on('variables')->onDelete('cascade');
        });

        Schema::table('rules', function ($table) {
            $table->foreign('variable_id')->references('id')->on('variables')->onDelete('cascade');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
            $table->foreign('controlaction_id')->references('id')->on('control_actions')->onDelete('cascade');
        });

        Schema::table('connections', function ($table) {
            $table->foreign('output_component_id')->references('id')->on('controllers')->onDelete('cascade');
            $table->foreign('output_component_id')->references('id')->on('actuators')->onDelete('cascade');
            $table->foreign('output_component_id')->references('id')->on('controlled_processes')->onDelete('cascade');
            $table->foreign('output_component_id')->references('id')->on('sensors')->onDelete('cascade');
            $table->foreign('input_component_id')->references('id')->on('controllers')->onDelete('cascade');
            $table->foreign('input_component_id')->references('id')->on('actuators')->onDelete('cascade');
            $table->foreign('input_component_id')->references('id')->on('controlled_processes')->onDelete('cascade');
            $table->foreign('input_component_id')->references('id')->on('sensors')->onDelete('cascade');
        });

        Schema::table('context_tables', function (Blueprint $table) {
            $table->foreign('controlaction_id')->references('id')->on('control_actions')->onDelete('cascade');
        });

        Schema::table('safety_constraints', function (Blueprint $table) {
            $table->foreign('controlaction_id')->references('id')->on('control_actions')->onDelete('cascade');
            $table->foreign('rule_id')->references('id')->on('rules')->onDelete('cascade');
        });

        Schema::table('causal_analysis', function (Blueprint $table) {
            $table->foreign('guideword_id')->references('id')->on('guidewords')->onDelete('cascade');
            $table->foreign('safety_constraint_id')->references('id')->on('safety_constraints')->onDelete('cascade');
        });*/

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
