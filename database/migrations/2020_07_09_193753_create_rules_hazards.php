<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRulesHazards extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("rules_safetyConstraints_hazards", function(Blueprint $table){
            $table->integer("rule_id")->unsigned();
            $table->integer("sc_id")->unsigned();
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
        Schema::dropIfExists("rules_safetyConstraints_hazards");
    }
}
