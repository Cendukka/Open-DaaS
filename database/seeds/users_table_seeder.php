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
			'user_company_id' => NULL,
			'user_microlocation_id' => NULL,
			'last_name' => 'Zitting',
			'first_name' => 'Jaakko',
			'username' => 'Admin.Jaakko',
			'email' => 'jaakko.zitting@lsjh.fi',
			'password' => Hash::make('qwerty')
        ]);

        $LSJH_Users = [
            [
                'user_type_id' => 2,
                'user_microlocation_id' => NULL,
                'last_name' => 'Kokkonen',
                'first_name' => 'Marko',
                'username' => 'marko.kokkonen',
                'email' => 'marko.kokkonen@lsjh.fi',
            ],
            [
                'user_type_id' => 2,
                'user_microlocation_id' => NULL,
                'last_name' => 'Mäkiö',
                'first_name' => 'Inka',
                'username' => 'inka.makio',
                'email' => 'inka.makio@turkuamk.fi',
            ],
            [
                'user_type_id' => 3,
                'user_microlocation_id' => 1,
                'last_name' => 'Salmi',
                'first_name' => 'Sallamari',
                'username' => 'sallamari.salmi',
                'email' => 'sallamari.salmi@lsjh.fi',
            ],
            [
                'user_type_id' => 3,
                'user_microlocation_id' => 1,
                'last_name' => 'Kaivonen',
                'first_name' => 'Sosanna',
                'username' => 'sosanna.kaivonen',
                'email' => 'sosanna.kaivonen@lsjh.fi',
            ],
            [
                'user_type_id' => 3,
                'user_microlocation_id' => 1,
                'last_name' => 'Merikukka',
                'first_name' => 'Päivi',
                'username' => 'päivi.merikukka',
                'email' => 'päivi.merikukka@lsjh.fi',
            ],
            [
                'user_type_id' => 3,
                'user_microlocation_id' => 2,
                'last_name' => 'Lintula',
                'first_name' => 'Päivi',
                'username' => 'päivi.lintula',
                'email' => 'päivi.lintula@tstry.fi',
            ],
            [
                'user_type_id' => 3,
                'user_microlocation_id' => 2,
                'last_name' => 'Raussi',
                'first_name' => 'Heidi',
                'username' => 'heidi.raussi',
                'email' => 'heidi.raussi@tstry.fi',
            ],
        ];

        foreach ($LSJH_Users as $user) {
            DB::table('users')->insert([
                'user_type_id' => $user['user_type_id'],
                'user_company_id' => 1,
                'user_microlocation_id' => $user['user_microlocation_id'],
                'last_name' => $user['last_name'],
                'first_name' => $user['first_name'],
                'username' => $user['username'],
                'email' => $user['email'],
                'password' => Hash::make('qwerty')
            ]);
        }

		$companies = DB::table('company')->where('company_id','!=',1)->get();

		# Adds Manager to all the companies
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
