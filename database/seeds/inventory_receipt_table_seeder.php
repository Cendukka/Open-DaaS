<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class inventory_receipt_table_seeder extends Seeder
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
		$microlocations_amount = DB::table('microlocations')->count();
		$communities_amount = DB::table('community')->count();
		$suppliers_amount = DB::table('supplier')->count();
		$users_amount = DB::table('users')->count();
		$ewc_codes = DB::table('ewc_codes')->select('ewc_code')->get();
		
		$sum = $companies_amount+$microlocations_amount+$communities_amount+$suppliers_amount;
		
		foreach (range(1,$sum) as $index) {
			$select = rand(1,4);
			DB::table('inventory_receipt')->insert([
				'receipt_from_company_id' => ($select == 1 ? rand(1,$companies_amount) : NULL),
				'receipt_from_microlocation_id' => ($select == 2 ? rand(1,$microlocations_amount) : NULL),
				'receipt_from_community_id' => ($select == 3 ? rand(1,$communities_amount) : NULL),
				'receipt_from_supplier_id' => ($select == 4 ? rand(1,$suppliers_amount) : NULL),
				'receipt_to_microlocation_id' => rand(1,$microlocations_amount),
				'receipt_user_id' => rand(1,$users_amount),
				'distance_km' => rand(10,500),
				'receipt_weight' => rand(100,1000),
				'receipt_date' => $faker->dateTimeBetween($startDate = '-10 years', $endDate = 'now', $timezone = null),
				'ewc_code' => $ewc_codes[rand(1,count($ewc_codes)-1)]->ewc_code,
			]);
		}
    }
}
