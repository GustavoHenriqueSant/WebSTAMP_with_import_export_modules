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
        Schema::rename('accidents_hazards', 'losses_hazards');

        Schema::table('losses_hazards', function (Blueprint $table) {
            $table->renameColumn('accidents_id', 'losses_id');
        });
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
