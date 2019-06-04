<?php

use Illuminate\Database\Seeder;

class textile_inventory_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$companies_amount = DB::table('company')->count();
		$microlocations_amount = DB::table('microlocations')->count();
		$fractions = ['Villa', 'Trikoo', 'Pellava', 'Puuvilla', 'Farkku', 'Elastiini', 'Polyesteri'];
		
		foreach (range(1,$microlocations_amount) as $ml_index) {
			foreach (range(0,count($fractions)-1) as $fraction_index) {
				DB::table('textile_inventory')->insert([
					'textile_microlocation_id' => $ml_index,
					'fraction' => $fractions[$fraction_index],
					'textile_weight' => rand(0,500)*5*rand(0,2),
				]);
			}
		}
    }
}
