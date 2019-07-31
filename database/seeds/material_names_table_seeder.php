<?php

use Illuminate\Database\Seeder;

class material_names_table_seeder extends Seeder{
    public function run(){
    	$mat_names = [
            # Raw waste
            '1V. Poistotekstiili' => 'raw waste',

            # Pre-sorted textile
            '1V. Kierrätyskelpoinen' => 'refined',
            '1V Uudelleenkäyttökelpoinen' => 'refined',

            # ???
            # 2V. Selluloosakuidut
            # 2V. Synteettiset
            # 2V. Villa
            # 2V. Sekoitteet

    	    # Refine Sorted Textiles
            '3V. 100% Polyamidi' => 'textile',
            '3V. 100% Polyesteri' => 'textile',
            '3V. 100% Puuvilla' => 'textile',
            '3V. 100% Villa' => 'textile',
            '3V. 100% Viskoosi' => 'textile',
            '3V. CO/PES 63' => 'textile',
            '3V. Villasekoite' => 'textile',
            '3V. Luonnonkuituseo' => 'textile',
            '3V. Tekokuituseos' => 'textile',
            '3V. Tuntematon' => 'textile',

            # Pre-sorted waste
            '1V. Pilaantunut tekstiili' => 'presorted',
            '1V. Keräykseen kuulumaton' => 'presorted',
            '1V. Kierrätyskelvoton' => 'presorted',
        ];
        foreach($mat_names as $mat => $type){
			DB::table('material_names')->insert([
			    'material_name' => $mat,
			    'material_type' => $type,
            ]);
		}




    }
}
