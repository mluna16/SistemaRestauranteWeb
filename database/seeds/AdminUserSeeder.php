<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class AdminUserSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert(array (
              'first_name'	=> 'Marcos',
              'last_name' => 'Luna',
              'status' => true,
              'email'	=> 'marcos@luna.com',
              'password' => \Hash::make('12345'),
              'type' => 'admin'
        ));
    }

}
