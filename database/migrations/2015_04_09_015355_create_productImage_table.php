<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductImageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('product_image', function(Blueprint $table)
        {
            $table->increments('id');

            $table->string("name");
            $table->string("route");
            $table->string("type");
            $table->string("size");

            $table->integer('id_product')->unsigned();
            $table->foreign('id_product')
                ->references('id')
                ->on('product')
                ->onDelete('cascade');

            $table->timestamps();

        });
    }



	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('product_image');

    }

}
