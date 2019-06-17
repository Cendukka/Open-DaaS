<?php

use Illuminate\Database\Seeder;

class inventory_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$microlocations_amount = DB::table('microlocations')->count();
		$materials_count = DB::table('material_names')->count();
		
		foreach (range(1,$microlocations_amount) as $ml_index) {
			foreach (range(1, $materials_count) as $mat_index) {
				DB::table('inventory')->insert([
					'inventory_microlocation_id' => $ml_index,
					'inventory_material_id' => $mat_index,
					'inventory_weight' => rand(0,500)*5*rand(0,2),
				]);
			}
		}
    }
}
