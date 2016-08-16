<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCredentialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('credentials')) {
            Schema::create('credentials', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('client_id')->unsigned();
                $table->integer('asset_id')->unsigned();
                $table->string('type', 255);
                $table->string('username', 255);
                $table->string('password', 255);
                $table->timestamps();

                $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
                $table->foreign('asset_id')->references('id')->on('assets')->onDelete('cascade');
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
        Schema::dropIfExists('credentials');
    }
}
