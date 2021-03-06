<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('tickets_replies')) {
            Schema::create('tickets_replies', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('ticket_id')->unsigned();
                $table->integer('user_id')->unsigned();
                $table->text('message');
                $table->dateTime('timestamp');
                $table->timestamps();

                $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
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
        Schema::dropIfExists('tickets_replies');
    }
}
