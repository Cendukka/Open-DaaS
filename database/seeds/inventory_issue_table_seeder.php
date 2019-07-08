<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class inventory_issue_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
	{
		$faker = Faker::create('fi_FI');
		$microlocations_amount = DB::table('microlocations')->count();
		$type_amount = DB::table('issue_types')->count();
		$users_amount = DB::table('users')->count();
	
		foreach (range(1,$microlocations_amount*5) as $index) {
			DB::table('inventory_issue')->insert([
				'issue_from_microlocation_id' => rand(1,$microlocations_amount),
				'issue_to_microlocation_id' => (rand(0,1) ? rand(1,$microlocations_amount) : NULL),
				'issue_type_id' => rand(1,$type_amount),
				'issue_user_id' => rand(1,$users_amount),
				'issue_date' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null),
			]);
		}
	}
}







