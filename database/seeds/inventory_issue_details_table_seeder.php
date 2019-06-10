<?php

use Illuminate\Database\Seeder;

class inventory_issue_details_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$issue_amount = DB::table('inventory_issue')->count();
		$material_amount = DB::table('material_names')->count();
		$ewc_codes = DB::table('ewc_codes')->get();
	
		foreach (range(1,$issue_amount) as $index) {
			DB::table('inventory_issue_details')->insert([
				'detail_issue_id' => $index,
				'detail_material_id' => rand(1,$material_amount),
				'detail_ewc_code' => $ewc_codes[rand(1,count($ewc_codes)-1)]->ewc_code,
				'detail_weight' => rand(100,1000),
			]);
		}
	
		foreach (range(1,$issue_amount*2) as $index) {
			DB::table('inventory_issue_details')->insert([
				'detail_issue_id' => rand(1,$issue_amount),
				'detail_material_id' => rand(1,$material_amount),
				'detail_ewc_code' => $ewc_codes[rand(1,count($ewc_codes)-1)]->ewc_code,
				'detail_weight' => rand(100,1000),
			]);
		}
    }
}