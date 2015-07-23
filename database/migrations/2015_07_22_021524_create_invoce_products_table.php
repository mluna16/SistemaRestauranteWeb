<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoceProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('invoce_products', function(Blueprint $table)
		{
			$table->increments('id');

            $table->integer('idinvoice')->unsigned();
            $table->foreign('idinvoice')
                ->references('id')
                ->on('invoice')
                ->onDelete('cascade');

            $table->integer('idproduct')->unsigned();
            $table->foreign('idproduct')
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
		Schema::drop('invoce_products');
	}

}
