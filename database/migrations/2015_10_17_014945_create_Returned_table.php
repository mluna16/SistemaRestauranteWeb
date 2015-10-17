<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReturnedTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('returned', function(Blueprint $table)
        {
            $table->increments('id');

            $table->integer('id_order')->unsigned();
            $table->integer('id_product')->unsigned();
            $table->integer('id_local')->unsigned();
            $table->integer('type')->default(1);
            $table->string('motivo');


            $table->foreign('id_order')
                ->references('id')
                ->on('local')
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
        Schema::drop('returned');

    }

}
