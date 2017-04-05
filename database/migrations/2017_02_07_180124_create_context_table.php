<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContextTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('context_tables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('controlaction_id')->unsigned;
            $table->string('context');
            $table->string('ca_provided');
            $table->string('ca_not_provided');
            $table->string('wrong_time_order');
            $table->string('ca_too_early');
            $table->string('ca_too_late');
            $table->string('ca_too_soon');
            $table->string('ca_too_long');
            $table->timestamps();
            //$table->foreign('controlaction_id')->references('id')->on('control_actions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('context_tables');
    }
}
