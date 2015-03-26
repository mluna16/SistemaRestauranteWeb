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

        \DB::table('local')->insert(array (
            'name'	=> 'EL Restaurante',
            'Location' => 'Porlamar',
            'number_tables' => 12,
            'owner'	=> 1,
            'img_local' => $faker->imageUrl($width = 680, $height = 460),

        ));
    }

}
