<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class community_table_seeder extends Seeder
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
	
		foreach (range(1,$companies_amount*2) as $index) {
			DB::table('community')->insert([
				'community_company_id' => rand(1,$companies_amount),
				'community_city' => $faker->city
			]);
		}
    }
}
