<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class company_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$faker = Faker::create('fi_FI');
		DB::table('company')->insert([
			'company_name' => 'Lounais-Suomen Jätehuolto Oy',
			'company_street_address' => 'Kuormakatu 17',
			'company_postal_code' => '20380',
			'company_city' => 'Turku'
		]);
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
