<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVistoComentarioToOrder extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
    public function up()
    {
        Schema::table('order', function (Blueprint $table) {
            $table->string("comentario");
            $table->boolean("comentario_visto")->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order', function (Blueprint $table) {
            $table->removeColumn("comentario");
            $table->removeColumn("comentario_visto");

        });
    }
}
