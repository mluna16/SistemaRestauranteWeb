<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');

            $table->string('last_name');
            $table->string('first_name');
			$table->string('email')->unique();
            $table->boolean('status',true);
            $table->string('password', 60);
			$table->mediumText('img_profile');
            $table->enum('type',['admin','cocina','mesonero','caja']);
            $table->integer('created_by');
            $table->boolean('first_time')->default(true);
            $table->rememberToken();
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
		Schema::drop('users');
	}

}
