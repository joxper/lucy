<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('models')) {
            Schema::create('models', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('manufacturer_id')->unsigned();
                $table->string('name', 255);
                $table->timestamps();

                $table->foreign('manufacturer_id')->references('id')->on('manufacturers')->onDelete('cascade');
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
        Schema::dropIfExists('models');
    }
}
