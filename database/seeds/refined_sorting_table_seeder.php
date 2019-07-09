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
		$receipts = DB::table('inventory_receipt')->get();
		$pre_sortings = DB::table('pre_sorting')->get();
		$materials = DB::table('material_names')->where('material_type','=','textile')->get();
		$users_amount = DB::table('users')->count();
	
		foreach (range(1,$microlocation_amount * 2 + $receipts->count() + $pre_sortings->count()) as $index) {
		    $pre_refined = rand(0,1);
		    $receipt = $receipts->random();
            $pre_sorting = $pre_sortings->random();

		    $user = DB::table('users')
                ->when($pre_refined, function($query) use ($receipt){
                    $query->where('user_microlocation_id','=',$receipt->receipt_to_microlocation_id);
                })
                ->when(!$pre_refined, function($query) use ($pre_sorting){
                    $query
                        ->join('pre_sorting','users.user_id','=','pre_sorting_user_id')
                        ->where('user_id','=',$pre_sorting->pre_sorting_user_id);
                })
		        ->get()
                ->random();

			DB::table('refined_sorting')->insert([
				'refined_receipt_id' => ($pre_refined ? $receipt->receipt_id : NULL),
				'pre_sorting_id' => ($pre_refined ? NULL : $pre_sorting->pre_sorting_id),
				'refined_material_id' => $materials->random()->material_id,
				'refined_user_id' => $user->user_id,
				'refined_weight' => rand(100,500),
				'refined_date' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null),
				'description' => $faker->text(40)
			]);
		}
	}
}