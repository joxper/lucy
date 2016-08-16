<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHostsHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('hosts_history')) {
            Schema::create('hosts_history', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('check_id')->unsigned();
                $table->string('status', 20);
                $table->string('latency', 10);
                $table->dateTime('timestamp');
                $table->timestamps();

                $table->foreign('check_id')->references('id')->on('hosts_checks')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hosts_history');
    }
}
