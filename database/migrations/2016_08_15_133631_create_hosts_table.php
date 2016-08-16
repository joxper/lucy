<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('hosts')) {
            Schema::create('hosts', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('client_id')->unsigned();
                $table->string('name', 255);
                $table->string('address', 255);
                $table->string('status', 60);
                $table->timestamps();

                $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
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
        Schema::dropIfExists('hosts');
    }
}
