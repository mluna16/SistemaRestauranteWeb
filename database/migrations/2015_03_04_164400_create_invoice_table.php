<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('invoice', function(Blueprint $table)
		{
			$table->increments('id');

            $table->string('client_id');
            $table->string('client_name');
            $table->string('client_phone');
            $table->integer('costo');

            $table->integer('created_by')->unsigned();
            $table->foreign('created_by')
                ->references('id')
                ->on('users')
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
		Schema::drop('invoice');
	}

}
