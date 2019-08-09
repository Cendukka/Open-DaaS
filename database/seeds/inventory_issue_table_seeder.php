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
		$microlocations = DB::table('microlocations')->get();
		$companies = DB::table('company')->get();
		$type_amount = DB::table('issue_types')->count();
		$users = DB::table('users')->get();
	
		foreach (range(1,$microlocations->count()*3) as $index) {
		    $ml = $microlocations->random();
		    $type = rand(1,$type_amount);
			DB::table('inventory_issue')->insert([
				'issue_from_microlocation_id' => $ml->microlocation_id,
				'issue_to_microlocation_id' => ($type==1 ? $microlocations->filter(function ($value, $key) use ($ml) {return $value->microlocation_company_id == $ml->microlocation_company_id;})->random()->microlocation_id : NULL),
				'issue_to_company_id' => ($type==2 ? $companies->filter(function ($value, $key) use ($ml) {return $value->company_id != $ml->microlocation_company_id;})->random()->company_id : NULL),
				'issue_type_id' => $type,
				'issue_user_id' => $users->filter(function ($value, $key) use ($ml) {return $value->user_company_id == $ml->microlocation_company_id;})->random()->user_id,
				'issue_date' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null),
			]);
		}
	}
}







