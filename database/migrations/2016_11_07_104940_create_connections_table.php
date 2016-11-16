<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConnectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('connections', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('output_component_id')->unsigned();
            $table->string('type_output');
            $table->integer('input_component_id')->unsigned();
            $table->string('type_input');
            $table->timestamps();
        });
        
        /*
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
        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('connections');
    }
}
