<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class microlocations_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$faker = Faker::create('fi_FI');
		$companies_amount = DB::table('company')->count();
		$types_amount = DB::table('microlocation_types')->count();

		foreach (range(2,$companies_amount) as $index) {
			DB::table('microlocations')->insert([
				'microlocation_company_id' => $index,
				'microlocation_type_id' => rand(2,$types_amount),
				'microlocation_name' => $faker->domainWord,
				'microlocation_street_address' => $faker->streetAddress,
				'microlocation_postal_code' => $faker->postcode,
				'microlocation_city' => $faker->city
			]);
		}
		foreach (range(2,$companies_amount*2) as $index) {
			DB::table('microlocations')->insert([
				'microlocation_company_id' => rand(2,$companies_amount),
				'microlocation_type_id' => rand(1,$types_amount),
				'microlocation_name' => $faker->domainWord,
				'microlocation_street_address' => $faker->streetAddress,
				'microlocation_postal_code' => $faker->postcode,
				'microlocation_city' => $faker->city
			]);
		}
    }
}
