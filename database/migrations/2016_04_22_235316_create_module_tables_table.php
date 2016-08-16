<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuleTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_tables', function (Blueprint $table) {
            $table->increments('id');
            $table->string('column');
            $table->enum('method', ['bigInteger', 'integer', 'mediumInteger', 'smallInteger', 'tinyInteger', 'boolean', 'char', 'date', 'dateTime', 'enum', 'ipAddress', 'longText', 'macAddress', 'mediumText', 'rememberToken', 'softDeletes', 'string', 'text', 'time', 'timestamp', 'uuid', 'decimal', 'double', 'float']);
            $table->string('arguments')->nullable();
            $table->string('default')->nullable();
            $table->boolean('unsigned')->default(false);
            $table->boolean('nullable')->default(false);
            $table->string('comment')->nullable();
            $table->boolean('is_foreign')->default(false);
            $table->string('table_foreign')->nullable();
            $table->string('references_foreign')->nullable();
            $table->enum('relationship_foreign', ['one-to-one', 'one-to-many'])->nullable();
            $table->string('caption');
            $table->boolean('show')->default(true);
            $table->boolean('view')->default(true);
            $table->boolean('sortable')->default(true);
            $table->boolean('searchable')->default(true);
            $table->integer('module_id')->unsigned();
            $table->timestamps();

            $table->foreign('module_id')->references('id')->on('modules')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('module_tables');
    }
}
