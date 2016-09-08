<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('assets')) {
            Schema::create('assets', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name', 255);
                $table->integer('category_id')->unsigned();
                $table->integer('client_id')->unsigned();
                $table->integer('user_id');
                $table->integer('admin_id');
                $table->integer('supplier_id')->unsigned();
                $table->integer('label_id')->unsigned();
                $table->date('purchase_date');
                $table->integer('warranty_months');
                $table->string('tag', 255);
                $table->string('serial', 255);
                $table->text('notes');
                $table->timestamps();

                $table->foreign('category_id')->references('id')->on('asset_categories')->onDelete('cascade');
                $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
                $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
                $table->foreign('label_id')->references('id')->on('labels')->onDelete('cascade');
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
        Schema::dropIfExists('assets');
    }
}
