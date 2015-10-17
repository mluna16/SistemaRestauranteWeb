<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditStatusOrder extends Migration {

    public function up()
    {
        DB::statement("ALTER TABLE ".env('DB_DATABASE').".order MODIFY COLUMN state ENUM('listo','espera','entregado','devuelto')");

    }

    public function down()
    {
        DB::statement("ALTER TABLE ".env('DB_DATABASE').".order MODIFY COLUMN state ENUM('listo','espera','entregado')");
    }
}
