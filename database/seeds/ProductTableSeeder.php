<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;

class ProductTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for($i=0;$i < 12;$i++){
            $id = \DB::table('Product')->insertGetid(array(
                'name'	=> $faker->streetName,
                'description' => $faker->text($maxNbChars = 240),
                'cost' => $faker->numberBetween($min = 80, $max = 1000),
                'created_by' => 1,
                'local_for' => 1
            ));

            \DB::table('product_image')->insert(array(
                'name' =>  \Hash::make('test'),
                'route' => 'C:\wamp\VirtualHost\SistemaRestauranteWeb\public/Images/Product/',
                'type' => 'jpeg',
                'size' => '44.529296875',
                'id_product' => $id

            ));
        }

    }

}
