<?php

use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Seeder;


class users_table_seeder extends Seeder {
    public function run() {
		$faker = Faker::create('fi_FI');
		$companies = DB::table('company')->where('company_id','!=',1)->get();

		# Adds a Manager to all the companies
		foreach($companies as $company) {
            $microlocations = DB::table('microlocations')->where('microlocation_company_id','=',$company->company_id)->get();

		    $fn =$faker->firstName;
            $ln = $faker->lastName;
			DB::table('users')->insert([
				'user_type_id' => 2,
				'user_company_id' => $company->company_id,
                'user_microlocation_id' => NULL,
				'last_name' => $ln,
				'first_name' => $fn,
				'username' => $ln.'.'.$fn,
				'email' => $ln.'.'.$fn.'@test.com',
				'password' => Hash::make('qwerty')
			]);

            # Adds users to all the microlocations
			foreach ($microlocations as $ml) {
                $fn =$faker->firstName;
                $ln = $faker->lastName;
				DB::table('users')->insert([
					'user_type_id' => 3,
					'user_company_id' => $company->company_id,
					'user_microlocation_id' => $ml->microlocation_id,
                    'last_name' => $ln,
                    'first_name' => $fn,
                    'username' => $ln.'.'.$fn,
                    'email' => $ln.'.'.$fn.'@test.com',
					'password' => Hash::make('qwerty')
				]);
			}
		}
    }
}
