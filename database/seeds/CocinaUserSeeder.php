<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as faker;

class CocinaUserSeeder extends Seeder {

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
            'email'     =>  'cocina@luna.com',
            'password' => \Hash::make('12345'),
            'created_by' => 1,
            'status' => true,
            'type' => 'cocina'
        ));


    }

}
