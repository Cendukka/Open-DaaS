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
		$receipts = DB::table('inventory_receipt')->join('material_names','receipt_material_id','material_id')->where('material_type','=','raw waste')->get();
		$materials = DB::table('material_names')->where('material_type','=','presorted')->orWhere('material_type','=','refined')->get();
		
		foreach (range(1,$microlocation_amount * 2 + $receipts->count() * 6) as $index) {
            $receipt = $receipts->random();
			DB::table('pre_sorting')->insert([
				'pre_sorting_receipt_id' => $receipt->receipt_id,
				'pre_sorting_material_id' => $materials->random()->material_id,
				'pre_sorting_user_id' => DB::table('users')->where('user_microlocation_id','=',$receipt->receipt_to_microlocation_id)->get()->random()->user_id,
				'pre_sorting_weight' => rand(200,600),
				'pre_sorting_date' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null),
			]);
		}
    }
}
