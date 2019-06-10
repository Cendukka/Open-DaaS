<?php

use Illuminate\Database\Seeder;

class material_names_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$mat_names = ['Villa', 'Trikoo', 'Pellava', 'Puuvilla', 'Farkku', 'Elastiini', 'Polyesteri', 'Refined', 'Raw Waste'];
		foreach ($mat_names as $mat) {
			DB::table('material_names')->insert(['material_name' => $mat]);
		}
		
		
    }
}
