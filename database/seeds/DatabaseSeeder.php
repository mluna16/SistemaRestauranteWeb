<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
		$this->call('AdminUserSeeder');
        $this->call('LocalTableSeeder');
        $this->call('CocinaUserSeeder');
        $this->call('MesoneroUserSeeder');
        $this->call('CajaUserSeeder');
        $this->call('ProductTableSeeder');
	}

}
