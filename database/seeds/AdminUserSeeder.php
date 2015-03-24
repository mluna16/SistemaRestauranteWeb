<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as faker;


class AdminUserSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        \DB::table('users')->insert(array (
              'first_name'	=> 'Marcos',
              'last_name' => 'Luna',
              'status' => true,
              'email'	=> 'marcos@luna.com',
              'password' => \Hash::make('12345'),
              'type' => 'admin',
             'img_profile' => $faker->imageUrl($width = 50, $height = 50),

        ));
    }

}
