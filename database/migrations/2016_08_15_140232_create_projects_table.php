<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('projects')) {
            Schema::create('projects', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('client_id')->unsigned();
                $table->string('tag', 255);
                $table->string('name', 255);
                $table->text('notes');
                $table->text('description');
                $table->string('startdate', 20);
                $table->string('deadline', 20);
                $table->integer('progress');
                $table->timestamps();

                $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
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
        Schema::dropIfExists('projects');
    }
}
