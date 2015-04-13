<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
    public function up()
    {
        Schema::create('table', function(Blueprint $table)
        {
            $table->increments('id');

            $table->integer("number_table");
            $table->integer("number_seat");
            $table->enum('state',['ocupado','disponible']);


            $table->integer('id_invoice')->unsigned();
            $table->foreign('id_invoice')
                ->references('id')
                ->on('invoice')
                ->onDelete('cascade');

            $table->integer('id_local')->unsigned();
            $table->foreign('id_local')
                ->references('id')
                ->on('local')
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
		//
	}

}