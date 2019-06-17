<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
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
			'password' => Hash::make('qwerty')
			]);
	
		$companies_amount = DB::table('company')->count();
		
		# Adds Admins to all the companies
		foreach (range(2,$companies_amount) as $company_index) {
			DB::table('users')->insert([
				'user_type_id' => 2,
				'user_company_id' => $company_index,
				'last_name' => $faker->lastName,
				'first_name' => $faker->firstName,
				'username' => $faker->userName,
				'password' => Hash::make('qwerty')
			]);
			
			# Adds managers to all the microlocations
			$microlocations = DB::table('microlocations')
								->where('microlocations.microlocation_company_id','=',$company_index)
								->get();
			
			
			foreach ($microlocations as $ml_index) {
				DB::table('users')->insert([
					'user_type_id' => 3,
					'user_company_id' => $company_index,
					'user_microlocation_id' => $ml_index->microlocation_id,
					'last_name' => $faker->lastName,
					'first_name' => $faker->firstName,
					'username' => $faker->userName,
					'password' => Hash::make('qwerty')
				]);
				
				# Create regular users
				foreach (range(1,1) as $index) {
					DB::table('users')->insert([
						'user_type_id' => 4,
						'user_company_id' => $company_index,
						'user_microlocation_id' => $ml_index->microlocation_id,
						'last_name' => $faker->lastName,
						'first_name' => $faker->firstName,
						'username' => $faker->userName,
						'password' => Hash::make('qwerty')
					]);
				}
			}
			
			
		}
		
		
    }
}
