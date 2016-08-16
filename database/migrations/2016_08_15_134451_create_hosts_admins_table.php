<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHostsAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('hosts_admins')) {
            Schema::create('hosts_admins', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('host_id')->unsigned();
                $table->integer('user_id')->unsigned();
                $table->timestamps();

                $table->foreign('host_id')->references('id')->on('hosts')->onDelete('cascade');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('hosts_admins');
    }
}
