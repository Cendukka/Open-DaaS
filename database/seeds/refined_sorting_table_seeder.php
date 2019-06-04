<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class refined_sorting_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
	{
		$faker = Faker::create('fi_FI');
		$receipt_amount = DB::table('inventory_receipt')->count();
		$pre_sorting_amount = DB::table('pre_sorting')->count();
		$textile_amount = DB::table('textile_inventory')->count();
		$users_amount = DB::table('users')->count();
		$status_amount = DB::table('status_types')->count();
	
		foreach (range(1,$receipt_amount+$pre_sorting_amount/2) as $index) {
			DB::table('refined_sorting')->insert([
				'refined_sorting_inventory_receipt_id' => rand(1,$receipt_amount),
				'pre_sorting_id' => rand(1,$pre_sorting_amount),
				'textile_id' => rand(1,$textile_amount),
				'refined_sorting_user_id' => rand(1,$users_amount),
				'refined_sorting_status_id' => rand(1,$status_amount),
				'refined_sorting_weight' => rand(100,500),
				'refined_sorting_date' => $faker->dateTimeBetween($startDate = '-10 years', $endDate = 'now', $timezone = null),
			]);
		}
	}
}