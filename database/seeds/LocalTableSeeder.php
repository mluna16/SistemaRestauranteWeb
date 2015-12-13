<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;


class LocalTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $id = \DB::table('local')->insertGetid(array(
            'name'	=> 'EL Restaurante',
            'Location' => 'Porlamar',
            'number_tables' => 12,
            'owner'	=> 1,

        ));
        \DB::table('local_image')->insert(array(
            'name' =>  'imgDemo',
            'route' =>  public_path().'/images/local/',
            'type' => 'jpeg',
            'size' => '44.529296875',
            'id_local' => $id

        ));
    }

}
