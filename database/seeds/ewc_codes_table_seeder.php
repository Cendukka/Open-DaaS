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
		$faker = Faker::create();
		DB::table('ewc_codes')->insert([
			'ewc_code' => '000000',
			'description' => 'Default EWC Code'
		]);
		foreach (range(1,49) as $index) {
			DB::table('ewc_codes')->insert([
				'ewc_code' => sprintf('%02d', rand(1, 20)) . sprintf('%02d', rand(1, 30)) . sprintf('%02d', rand(1, 99)),
				'description' => $faker->text(100)
			]);
		}
    }
}
