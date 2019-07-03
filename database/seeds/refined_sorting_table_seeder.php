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
		$microlocation_amount = DB::table('microlocations')->count();
		$receipt_amount = DB::table('inventory_receipt')->count();
		$pre_sorting_amount = DB::table('pre_sorting')->count();
		$material_amount = DB::table('material_names')->count();
		$users_amount = DB::table('users')->count();
	
		foreach (range(1,$microlocation_amount * 2 + $receipt_amount + $pre_sorting_amount) as $index) {
		    $pre_refined = rand(0,1);
			DB::table('refined_sorting')->insert([
				'refined_receipt_id' => ($pre_refined ? rand(1,$receipt_amount) : NULL),
				'pre_sorting_id' => ($pre_refined ? NULL : rand(1,$pre_sorting_amount)),
				'refined_material_id' => rand(1,$material_amount),
				'refined_user_id' => rand(1,$users_amount),
				'refined_weight' => rand(100,500),
				'refined_date' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null),
				'description' => $faker->text(40)
			]);
		}
	}
}