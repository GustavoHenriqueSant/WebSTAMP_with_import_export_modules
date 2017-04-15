<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaSafetyConstraintTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('safety_constraints', function (Blueprint $table) {
            $table->increments('id');
            $table->text('unsafe_control_action');
            $table->text('safety_constraint');
            $table->text('type');
            $table->text('context');
            $table->integer('controlaction_id')->unsigned();
            $table->integer('rule_id')->unsigned();
            $table->timestamps();
            //$table->foreign('controlaction_id')->references('id')->on('control_actions')->onDelete('cascade');
            //$table->foreign('rule_id')->references('id')->on('rules')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('safety_constraints');
    }
}
