<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('issues')) {
            Schema::create('issues', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('client_id')->unsigned();
                $table->integer('asset_id')->unsigned();
                $table->integer('project_id')->unsigned();
                $table->integer('user_id')->unsigned();
                $table->string('issue_type', 15);
                $table->string('priority', 60);
                $table->string('status', 60);
                $table->string('name', 255);
                $table->text('description');
                $table->string('duedate', 20);
                $table->integer('timespent');
                $table->dateTime('dateadded');
                $table->timestamps();

                $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
                $table->foreign('asset_id')->references('id')->on('assets')->onDelete('cascade');
                $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
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
        Schema::dropIfExists('issues');
    }
}
