<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ewc_codes_table_seeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $ewc_codes = [
            '000000' => 'Default EWC Code',
            '180104' => 'Yritysperäinen tekstiilijäte vastaanotettaessa (ainakin sairaala- ja pesulatekstiilit)',
            '191208' => 'Pilaantuneet tekstiilit polttoon',
            '191212' => 'Keräykseen kuulumattomat materiaalit polttoon',
            '200110' => 'Uudelleenkäytettävät vaatteet (kirpparimyynti yms)',
            '200111' => 'Poistotekstiili (kuluttajaperäinen, vastaanotettaessa ja uudelleenkäytettäessä)',
        ];

        foreach ($ewc_codes as $code => $description) {
            DB::table('ewc_codes')->insert([
                'ewc_code' => $code,
                'description' => $description
            ]);
        }
    }
}
