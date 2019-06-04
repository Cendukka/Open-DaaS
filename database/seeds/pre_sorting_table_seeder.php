<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class pre_sorting_table_seeder extends Seeder
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
		$presorted_amount = DB::table('presorted_material')->count();
		$users_amount = DB::table('users')->count();
		$status_amount = DB::table('status_types')->count();
		
		foreach (range(1,$receipt_amount * 2) as $index) {
			DB::table('pre_sorting')->insert([
				'pre_sorting_inventory_receipt_id' => rand(1,$receipt_amount),
				'presorted_material_id' => rand(1,$presorted_amount),
				'pre_sorting_user_id' => rand(1,$users_amount),
				'pre_sorting_status_id' => rand(1,$status_amount),
				'pre_sorting_weight' => rand(100,500),
				'pre_sorting_date' => $faker->dateTimeBetween($startDate = '-10 years', $endDate = 'now', $timezone = null),
			]);
		}
    }
}
