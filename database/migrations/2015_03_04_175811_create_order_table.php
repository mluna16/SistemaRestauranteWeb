<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order', function(Blueprint $table)
		{
            $table->increments('id');

            $table->enum('state',['listo','espera','entregado']); // Listo - en espera - entregado
            $table->integer('created_by')->unsigned();
            $table->integer('id_local')->unsigned();
            $table->integer('id_product')->unsigned();

            //Recordar discriminarporel modelo - Bug buscar solicion por migrations a eso
            //$keys = array('id', 'created_by', 'email');
            //$table->dropPrimary('PRIMARY');
            //$table->primary($keys);

            //clave foraneas

            $table->foreign('created_by')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('id_local')
                ->references('id')
                ->on('local')
                ->onDelete('cascade');

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
		Schema::drop('order');
	}

}
