<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCausalAnalysisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('causal_analysis', function (Blueprint $table) {
            $table->increments('id');
            $table->text('scenario');
            $table->text('associated_causal_factor');
            $table->text('requirement');
            $table->text('role');
            $table->text('rationale');
            $table->integer('guideword_id')->unsigned();
            //$table->foreign('guideword_id')->references('id')->on('guidewords')->onDelete('cascade');
            $table->integer('safety_constraint_id')->unsigned();
            //$table->foreign('safety_constraint_id')->references('id')->on('safety_constraints')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('causal_analysis');
    }
}
