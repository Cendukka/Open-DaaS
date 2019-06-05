<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class users_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$faker = Faker::create('fi_FI');
		DB::table('users')->insert([
			'user_type_id' => 1,
			'user_company_id' => '1',
			'last_name' => 'ADMIN',
			'first_name' => 'LSJH',
			'username' => 'admin',
			'password' => 'salasana'
			]);
	
		$companies_amount = DB::table('company')->count();
	
		foreach (range(2,$companies_amount) as $index) {
			DB::table('users')->insert([
				'user_type_id' => 2,
				'user_company_id' => $index,
				'last_name' => $faker->lastName,
				'first_name' => $faker->firstName,
				'username' => $faker->userName,
				'password' => $faker->password,
			]);
		}
	
		foreach (range(2,$companies_amount*3) as $index) {
			DB::table('users')->insert([
				'user_type_id' => 3,
				'user_company_id' => rand(2,$companies_amount),
				'last_name' => $faker->lastName,
				'first_name' => $faker->firstName,
				'username' => $faker->userName,
				'password' => $faker->password,
			]);
		}
    }
}
