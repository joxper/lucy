<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('clients')) {
            Schema::create('clients', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name', 255);
                $table->string('asset_tag_prefix', 255);
                $table->string('license_tag_prefix', 255);
                $table->timestamps();
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
        Schema::dropIfExists('clients');
    }
}
