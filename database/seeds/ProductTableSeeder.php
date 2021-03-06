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
            $limitInventory = $faker->numberBetween($min = 10, $max = 100);
            $id = \DB::table('product')->insertGetid(array(
                'name'	=> $faker->streetName,
                'description' => $faker->text($maxNbChars = 240),
                'cost' => $faker->numberBetween($min = 80, $max = 1000),
                'limit' => $limitInventory,
                'inventory' => $limitInventory,
                'created_by' => 1,
                'local_for' => 1
            ));

            \DB::table('product_image')->insert([
                'name' =>  'imgDemo',
                'route' => public_path().'/images/product/',
                'type' => 'jpeg',
                'size' => '44.529296875',
                'id_product' => $id

            ]);
        }

    }

}
