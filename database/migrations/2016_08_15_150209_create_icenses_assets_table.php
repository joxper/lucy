<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIcensesAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('icenses_assets')) {
            Schema::create('icenses_assets', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('license_id')->unsigned();
                $table->integer('asset_id')->unsigned();
                $table->timestamps();

                $table->foreign('license_id')->references('id')->on('licenses')->onDelete('cascade');
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
        Schema::dropIfExists('icenses_assets');
    }
}
