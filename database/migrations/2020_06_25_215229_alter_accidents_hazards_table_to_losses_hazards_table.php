<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAccidentsHazardsTableToLossesHazardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accidents_hazards', function (Blueprint $table) {
            $table->renameColumn('accidents_id', 'losses_id');
        });

        Schema::rename('accidents_hazards', 'losses_hazards');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('losses_hazards');
    }
}
