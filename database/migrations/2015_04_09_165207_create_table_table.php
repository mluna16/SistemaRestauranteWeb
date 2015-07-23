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
            $table->boolean('facturar');

            $table->integer('id_order')->unsigned();
            $table->foreign('id_order')
                ->references('id')
                ->on('order')
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
        Schema::drop('table');

    }

}
