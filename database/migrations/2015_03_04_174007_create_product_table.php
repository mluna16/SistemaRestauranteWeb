<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product', function(Blueprint $table)
		{
			$table->increments('id');

            $table->smallInteger('category');
            $table->string('name');
            $table->string('description');
            $table->integer('cost');
            $table->integer('limit');

            $table->integer('created_by')->unsigned();
            $table->foreign('created_by')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->integer('local_for')->unsigned();
            $table->foreign('local_for')
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
		Schema::drop('product');
	}

}
