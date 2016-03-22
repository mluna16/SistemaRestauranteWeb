<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExtraOrden extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ExtraOrder', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('id_order')->unsigned();
            $table->integer('id_product')->unsigned();

            $table->foreign('id_product')
                ->references('id')
                ->on('product')
                ->onDelete('cascade');

            $table->foreign('id_order')
                ->references('id')
                ->on('order')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ExtraOrder');
    }
}
