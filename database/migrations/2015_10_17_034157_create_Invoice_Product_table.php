<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceProductTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('invoice_product',function(Blueprint $table){
            $table->increments('id');

            $table->integer('id_product')->unsigned();
            $table->integer('id_invoice')->unsigned();
            $table->integer('costo');

            $table->foreign('id_invoice')
                ->references('id')
                ->on('invoice')
                ->onDelete('cascade');

            $table->foreign('id_product')
                ->references('id')
                ->on('product')
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
		Schema::drop('invoice_product');
	}

}
