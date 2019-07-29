<?php

use Illuminate\Database\Seeder;

class material_names_table_seeder extends Seeder{
    public function run(){
    	$mat_names = [
            # Raw waste
            'Raw Waste' => 'raw waste',

            # Pre-sorted textile
            'Raw Textile' => 'refined',

    	    # Refine Sorted Textiles
            'Villa' => 'textile',
            'Trikoo' => 'textile',
            'Pellava' => 'textile',
            'Puuvilla' => 'textile',
            'Farkku' => 'textile',
            'Elastiini' => 'textile',
            'Polyesteri' => 'textile',

            # Material that is being removed from use
            'Old Textile' => 'retired',

            # Pre-sorted waste
            'Metal' => 'presorted',
            'Plastic' => 'presorted',
            'Glass' => 'presorted',
            'Electronics' => 'presorted',
        ];
        foreach($mat_names as $mat => $type){
			DB::table('material_names')->insert([
			    'material_name' => $mat,
			    'material_type' => $type,
            ]);
		}
		
		
    }
}
