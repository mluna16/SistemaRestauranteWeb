<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalImageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
    public function up()
    {
        Schema::create('local_image', function(Blueprint $table)
        {
            $table->increments('id');

            $table->string("name");
            $table->string("route");
            $table->string("type");
            $table->string("size");

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
