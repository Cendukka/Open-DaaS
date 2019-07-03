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
		$microlocation_amount = DB::table('microlocations')->count();
		$receipts = DB::table('inventory_receipt')->join('material_names','receipt_material_id','material_id')->where('material_name','=','Raw Waste')->get();
		$presorted_amount = DB::table('presorted_material')->count();
		$users_amount = DB::table('users')->count();
		
		foreach (range(1,$microlocation_amount * 2 + $receipts->count() * 6) as $index) {
			DB::table('pre_sorting')->insert([
				'pre_sorting_receipt_id' => $receipts[rand(0,$receipts->count()-1)]->receipt_id,
				'presorted_material_id' => rand(1,$presorted_amount),
				'pre_sorting_user_id' => rand(1,$users_amount),
				'pre_sorting_weight' => rand(100,500),
				'pre_sorting_date' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null),
			]);
		}
    }
}
