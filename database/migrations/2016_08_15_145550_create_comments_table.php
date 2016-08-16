<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('comments')) {
            Schema::create('comments', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->unsigned();
                $table->integer('client_id')->unsigned();
                $table->integer('project_id')->unsigned();
                $table->integer('ticket_id')->unsigned();
                $table->integer('issue_id')->unsigned();
                $table->text('comment');
                $table->dateTime('timestamp');
                $table->timestamps();

                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
                $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
                $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
                $table->foreign('issue_id')->references('id')->on('issues')->onDelete('cascade');
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
        Schema::dropIfExists('comments');
    }
}
