<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('tickets')) {
            Schema::create('tickets', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('ticket');
                $table->integer('client_id')->unsigned();
                $table->integer('user_id')->unsigned();
                $table->integer('admin_id')->unsigned();
                $table->integer('asset_id')->unsigned();
                $table->string('email', 128);
                $table->string('subject', 500);
                $table->string('status', 50);
                $table->string('priority', 50);
                $table->dateTime('timestamp');
                $table->text('notes');
                $table->string('ccs');
                $table->timestamps();

                $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('admin_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('tickets');
    }
}
