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
            \DB::table('Product')->insert(array (
                'name'	=> $faker->streetName,
                'description' => $faker->text($maxNbChars = 240),
                'cost' => $faker->numberBetween($min = 80, $max = 1000),
                'img_product' => $faker->imageUrl($width = 640, $height = 480, 'food'),
                'created_by' => 1,
                'local_for' => 1
            ));
        }

    }

}
