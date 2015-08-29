<?php
/**
 * Created by PhpStorm.
 * User: marcos
 * Date: 7/22/2015
 * Time: 8:29 PM
 */

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as faker;

class OrderSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $date = new Carbon\Carbon();

        for($i=0;$i < 50;$i++) {
            \DB::table('order')->insert(array(
                'created_by' => $faker->numberBetween(1,12),
                'state' => "espera",
                'id_product' => $faker->numberBetween(1,12),
                'id_local' => 1,
                'created_at' =>$date->now()->addDays(rand(-800,0))->addMinutes(rand(0,60*23))->addSeconds(rand(0,60)),
            ));
        }
    }

}
