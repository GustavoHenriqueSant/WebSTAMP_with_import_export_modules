<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActuatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actuators', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('project_id')->unsigned();
            $table->timestamps();
        });
        /*Schema::table('actuators', function ($table) {
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('actuators');
    }
}
