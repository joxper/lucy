<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('tickets_rules')) {
            Schema::create('tickets_rules', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('ticketid')->unsigned();
                $table->boolean('executed');
                $table->string('name', 255);
                $table->string('cond_status', 255);
                $table->string('cond_priority', 255);
                $table->string('cond_timeelapsed', 20);
                $table->dateTime('cond_datetime');
                $table->string('act_status', 255);
                $table->string('act_priority', 255);
                $table->integer('act_assignto')->unsigned();
                $table->boolean('act_notifyadmins');
                $table->boolean('act_addreply');
                $table->text('reply');
                $table->timestamps();

                $table->foreign('ticketid')->references('id')->on('tickets')->onDelete('cascade');
                $table->foreign('act_assignto')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('tickets_rules');
    }
}
