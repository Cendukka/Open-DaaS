<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class supplier_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$faker = Faker::create('fi_FI');
		foreach (range(1,20) as $index) {
			DB::table('supplier')->insert([
				'supplier_name' => $faker->company,
				'supplier_street_address' => $faker->streetAddress,
				'supplier_postal_code' => $faker->postcode,
				'supplier_city' => $faker->city,
				'contact_person' => $faker->name,
				'email' => $faker->companyEmail,
				'phone_number' => $faker->phoneNumber
			]);
		}
    }
}
