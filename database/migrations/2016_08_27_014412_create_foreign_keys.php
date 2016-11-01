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
        Schema::table('accidents', function ($table) {
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });

        Schema::table('accidents_hazards', function ($table) {
            $table->foreign('accidents_id')->references('id')->on('accidents')->onDelete('cascade');
            $table->foreign('hazards_id')->references('id')->on('hazards')->onDelete('cascade');
        });

        Schema::table('teams', function ($table) {
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });

        Schema::table('components', function ($table) {
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });

        Schema::table('system_goals', function ($table) {
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });

        Schema::table('control_actions', function ($table) {
            $table->foreign('component_id')->references('id')->on('components')->onDelete('cascade');
        });

        Schema::table('variables', function ($table) {
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('component_id')->references('id')->on('components')->onDelete('cascade');
        });

        Schema::table('states', function ($table) {
            $table->foreign('variable_id')->references('id')->on('variables')->onDelete('cascade');
        });
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
