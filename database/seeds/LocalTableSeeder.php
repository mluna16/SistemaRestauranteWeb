<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class LocalTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('local')->insert(array (
            'name'	=> 'EL Restaurante',
            'Location' => 'Porlamar',
            'number_tables' => 12,
            'owner'	=> 1,
        ));
    }

}
