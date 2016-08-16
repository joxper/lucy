<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->string('table_name');
            $table->string('primary_key')->default('id');
            $table->integer('version')->unsigned()->default(0);
            $table->integer('create_permission')->unsigned();
            $table->integer('delete_permission')->unsigned();
            $table->integer('edit_permission')->unsigned();
            $table->integer('show_permission')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamps();

            $table->foreign('create_permission')->references('id')->on('permissions')->onDelete('cascade');
            $table->foreign('delete_permission')->references('id')->on('permissions')->onDelete('cascade');
            $table->foreign('edit_permission')->references('id')->on('permissions')->onDelete('cascade');
            $table->foreign('show_permission')->references('id')->on('permissions')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('modules');
    }
}
