<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class lsjh_seeder extends Seeder {
    public function run() {
        $LSJH_Locations = [
            [
            'type_id' => '3', # Vastaanotto ja lajittelu:
            'name' => 'LSJH Poistotekstiilihalli',
            'address' => 'Hiidenkatu 9',
            'postal' => '20360',
            'city' => 'Turku',
            ],
            [
            'type_id' => '3',
            'name' => 'TST Texvex',
            'address' => 'Kanslerintie 19',
            'postal' => '20200',
            'city' => 'Turku',
            ],
            [
            'type_id' => '1', # Vain vastaanotto:
            'name' => 'Topinojan jätekeskus',
            'address' => 'Pitkäsaarenkatu 7',
            'postal' => '20380',
            'city' => 'Turku',
            ],
            [
            'type_id' => '1',
            'name' => 'Korvenmäen jätekeskus',
            'address' => 'Helsingintie 541',
            'postal' => '24100',
            'city' => 'Salo',
            ],
            [
            'type_id' => '1',
            'name' => 'Isosuon jätekeskus',
            'address' => 'Isosuontie 137',
            'postal' => '21220',
            'city' => 'Raisio',
            ],
            [
            'type_id' => '1',
            'name' => 'Rauhalan jätekeskus',
            'address' => 'Sydmontie 173',
            'postal' => '21600',
            'city' => 'Parainen',
            ],
            [
            'type_id' => '1',
            'name' => 'Auranmaan lajitteluasema',
            'address' => 'Aurantie 518',
            'postal' => '21450',
            'city' => 'Autra',
            ],
            [
            'type_id' => '1',
            'name' => 'Kemiönsaaren lajitteluasema',
            'address' => 'Storkärrintie 99',
            'postal' => '25870',
            'city' => 'Dragsfjärd',
            ],
            [
            'type_id' => '1',
            'name' => 'Korppoon lajitteluasema',
            'address' => 'Strömmantie 12',
            'postal' => '21710',
            'city' => 'Korppoo',
            ],
            [
            'type_id' => '1',
            'name' => 'Paimion lajitteluasema',
            'address' => 'Muurassuontie 4',
            'postal' => '21530',
            'city' => 'Paimio',
            ],
            [
            'type_id' => '1',
            'name' => 'Perniön lajitteluasema',
            'address' => 'Katajarannantie 7',
            'postal' => '25500',
            'city' => 'Perniö',
            ],
            [
            'type_id' => '1',
            'name' => 'Yläneen lajitteluasema',
            'address' => 'Katajarannantie 7',
            'postal' => '21900',
            'city' => 'Pöytyä',
            ],
        ];

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

        DB::table('company')->insert([
            'company_name' => 'Lounais-Suomen Jätehuolto Oy',
            'company_street_address' => 'Kuormakatu 17',
            'company_postal_code' => '20380',
            'company_city' => 'Turku'
        ]);

        foreach ($LSJH_Locations as $ml) {
            DB::table('microlocations')->insert([
                'microlocation_company_id' => 1,
                'microlocation_type_id' => $ml['type_id'],
                'microlocation_name' => $ml['name'],
                'microlocation_street_address' => $ml['address'],
                'microlocation_postal_code' => $ml['postal'],
                'microlocation_city' => $ml['city']
            ]);
        }

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


    }
}
