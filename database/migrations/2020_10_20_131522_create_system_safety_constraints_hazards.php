<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemSafetyConstraintsHazards extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("systemSafetyConstraint_hazards", function(Blueprint $table){
            $table->integer("ssc_id")->unsigned();
            $table->integer("hazard_id")->unsigned();
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
        Schema::dropIfExists("systemSafatyConstraint_hazards");
    }
}
