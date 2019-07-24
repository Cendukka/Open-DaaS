<?php

use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

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
			'user_microlocation_id' => '1',
			'last_name' => 'Zitting',
			'first_name' => 'Jaakko',
			'username' => 'Admin.Jaakko',
			'email' => 'jaakko.zitting@lsjh.fi',
			'password' => Hash::make('qwerty')
			]);
	
		$companies = DB::table('company')->get();
		
		# Adds Manager to all the companies
		foreach($companies as $company) {
            $microlocations = DB::table('microlocations')->where('microlocation_company_id','=',$company->company_id)->get();

		    $fn =$faker->firstName;
            $ln = $faker->lastName;
			DB::table('users')->insert([
				'user_type_id' => 2,
				'user_company_id' => $company->company_id,
                'user_microlocation_id' => $microlocations->random()->microlocation_id,
				'last_name' => $fn,
				'first_name' => $ln,
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
                    'last_name' => $fn,
                    'first_name' => $ln,
                    'username' => $ln.'.'.$fn,
                    'email' => $ln.'.'.$fn.'@test.com',
					'password' => Hash::make('qwerty')
				]);
			}
		}
    }
}
