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

class TableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $date = new Carbon\Carbon();

        for($i=1;$i < 50;$i++) {
            \DB::table('table')->insert(array(
                'number_table' => $faker->numberBetween(1,5),
                'state' => "ocupado",
                'id_order' => $i,
                'id_local' => 1,
                'facturar' => false,
            ));
        }
    }

}
