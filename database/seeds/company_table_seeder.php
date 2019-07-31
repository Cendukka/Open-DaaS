<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class company_table_seeder extends Seeder {
    public function run() {
		$faker = Faker::create('fi_FI');
		foreach (range(1,9) as $index) {
			DB::table('company')->insert([
				'company_name' => $faker->company,
				'company_street_address' => $faker->streetAddress,
				'company_postal_code' => $faker->postcode,
				'company_city' => $faker->city
			]);
		}
    }
}
