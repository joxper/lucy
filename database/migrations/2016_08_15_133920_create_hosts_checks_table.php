<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHostsChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('hosts_checks')) {
            Schema::create('hosts_checks', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('host_id')->unsigned();
                $table->string('name', 255);
                $table->string('type', 60);
                $table->string('port', 60);
                $table->boolean('monitoring');
                $table->boolean('email');
                $table->boolean('sms');
                $table->string('status', 60);
                $table->timestamps();

                $table->foreign('host_id')->references('id')->on('hosts')->onDelete('cascade');
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
        Schema::dropIfExists('hosts_checks');
    }
}
