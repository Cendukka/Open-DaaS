<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ewc_codes_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//		$faker = Faker::create();
		DB::table('ewc_codes')->insert(
		    [
		        'ewc_code' => '000000',
			    'description' => 'Default EWC Code'
            ],
            [
                'ewc_code' => '180104 ',
                'description' => 'Yritysperäinen tekstiilijäte vastaanotettaessa (ainakin sairaala- ja pesulatekstiilit)'
            ],
            [
                'ewc_code' => '191208 ',
                'description' => 'Pilaantuneet tekstiilit polttoon'
            ],
            [
                'ewc_code' => '191212 ',
                'description' => 'Keräykseen kuulumattomat materiaalit polttoon'
            ],
            [
                'ewc_code' => '200110 ',
                'description' => 'Uudelleenkäytettävät vaatteet (kirpparimyynti yms)'
            ],
            [
                'ewc_code' => '200111 ',
                'description' => 'Poistotekstiili (kuluttajaperäinen, vastaanotettaessa ja uudelleenkäytettäessä)'
            ]

        );
//		foreach (range(1,25) as $index) {
//			DB::table('ewc_codes')->insert([
//				'ewc_code' => sprintf('%02d', rand(1, 20)) . sprintf('%02d', rand(1, 30)) . sprintf('%02d', rand(1, 99)),
//				'description' => $faker->text(100)
//			]);
//		}
    }
}
