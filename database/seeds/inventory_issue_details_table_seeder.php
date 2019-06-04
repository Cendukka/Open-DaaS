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
		$inventory_amount = DB::table('inventory_issue')->count();
		$textile_amount = DB::table('textile_inventory')->count();
		$ewc_codes = DB::table('ewc_codes')->get();
	
		foreach (range(1,$inventory_amount*3) as $index) {
			DB::table('inventory_issue_details')->insert([
				'inventory_issue_id' => rand(1,$inventory_amount),
				'textile_id' => rand(1,$textile_amount),
				'ewc_code' => $ewc_codes[rand(1,count($ewc_codes)-1)]->ewc_code,
				'issue_weight' => rand(100,1000),
			]);
		}
    }
}