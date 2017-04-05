<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::table('accidents', function ($table) {
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });

        Schema::table('accidents_hazards', function ($table) {
            $table->foreign('accidents_id')->references('id')->on('accidents')->onDelete('cascade');
            $table->foreign('hazards_id')->references('id')->on('hazards')->onDelete('cascade');
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
