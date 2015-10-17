<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as faker;


class ReturnedTypeSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('returned_type')->insert([
            'descripcion' => 'Mala Presentacion'
        ]);
        DB::table('returned_type')->insert([
            'descripcion' => 'Comida Fria'
        ]);
        DB::table('returned_type')->insert([
            'descripcion' => 'No era lo solicitado'
        ]);
        DB::table('returned_type')->insert([
            'descripcion' => 'Tiene insectos'
        ]);
    }

}
