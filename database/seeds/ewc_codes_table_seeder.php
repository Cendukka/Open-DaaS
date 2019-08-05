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
            '00000' => 'Default EWC Code',
            '040222' => 'Tekstiilituotantojäte yksityiseltä toimittajalta',
            '040221' => 'Tekstiilituotantojäte yksityiseltä toimittajalta',
            '150109' => 'Tekstiilipakkaukset, köydet, liinat yms yksityiseltä toimittajalta',
            '160306' => 'Epäkurantit tuotantoerät tai käyttämättömät tuotteet yksityseltä toimittajalta',
            '180104' => 'Sairaalalakanat tai muut ei-tartuntavaaralliset terveydenhuollon tekstiilit',
            '191208' => 'Pilaantuneet tekstiilit polttoon',
            '191212' => 'Keräykseen kuulumattomat materiaalit polttoon',
            '200110' => 'Uudelleenkäytettävät vaatteet',
            '200111' => 'Poistotekstiili uudelleenkäyttöön',

        ];

        foreach ($ewc_codes as $code => $description) {
            DB::table('ewc_codes')->insert([
                'ewc_code' => $code,
                'description' => $description
            ]);
        }
    }
}
