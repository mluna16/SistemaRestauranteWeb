<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as faker;

class MesoneroUserSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create();
        \DB::table('users')->insert(array (
            'first_name' => $faker->firstName,
            'last_name'  => $faker->lastName,
            'email'     =>  'mesonero@luna.com',
            'password' => \Hash::make('12345'),
            'created_by' => 1,
            'status' => true,
            'type' => 'mesonero',
            'img_profile' => $faker->imageUrl($width = 50, $height = 50),

        ));

        for($i=0;$i < 9;$i++) {
            \DB::table('users')->insert(array(
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->unique()->email,
                'password' => \Hash::make('12345'),
                'created_by' => 1,
                'status' => true,
                'type' => 'mesonero',
                'img_profile' => $faker->imageUrl($width = 50, $height = 50),
            ));
        }
    }

}
