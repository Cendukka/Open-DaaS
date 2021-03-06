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
                'last_name' => 'Zitting',
                'first_name' => 'Jaakko',
                'username' => 'jaakko.zitting',
                'email' => 'jaakko.zitting@lsjh.fi',
            ],
            [
                'user_type_id' => 3,
                'user_microlocation_id' => 1,
                'last_name' => 'Laaksonen',
                'first_name' => 'Juho',
                'username' => 'juho.laaksonen',
                'email' => 'juho.laaksonen@edu.turkuamk.fi',
            ],
            [
                'user_type_id' => 3,
                'user_microlocation_id' => 2,
                'last_name' => 'Wirtanen',
                'first_name' => 'Miikka',
                'username' => 'miikka.wirtanen',
                'email' => 'miikka.wirtanen@edu.turkuamk.fi',
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

        $Luode_Locations = [
            [
                'type_id' => '3', # Vastaanotto ja lajittelu:
                'name' => 'Luode Poistotekstiilihalli',
                'address' => 'Kilpisjärventie 9',
                'postal' => '99490',
                'city' => 'Kilpisjärvi',
            ],
            [
                'type_id' => '3',
                'name' => 'Luodeojan Poistotekstiilihalli',
                'address' => 'Iitontie 7',
                'postal' => '99490',
                'city' => 'Iitto',
            ],
            [
                'type_id' => '1',# Vain vastaanotto:
                'name' => 'Luodemäen jätekeskus',
                'address' => 'Ropinsalmentie 541',
                'postal' => '99490',
                'city' => 'Ropinsalmi',
            ],

            [
                'type_id' => '1',
                'name' => 'Luodelan jätekeskus',
                'address' => 'Paraisentie 173',
                'postal' => '99490',
                'city' => 'Parainen',
            ],
        ];

        $Luode_Users = [
            [
                'user_type_id' => 2,
                'user_microlocation_id' => NULL,
                'last_name' => 'Kaivonen',
                'first_name' => 'Susanna',
                'username' => 'Susanna.Kaivonen',
                'email' => 'Susanna.Kaivonen@lsjh.fi',
            ],
            [
                'user_type_id' => 3,
                'user_microlocation_id' => 13,
                'last_name' => 'Rantanen',
                'first_name' => 'Sallamari',
                'username' => 'sallamari.rantanen',
                'email' => 'sallamari.rantanen@turkuamk.fi',
            ],
            [
                'user_type_id' => 3,
                'user_microlocation_id' => 14,
                'last_name' => 'Laine',
                'first_name' => 'Mika',
                'username' => 'mika.laine',
                'email' => 'mika.laine@rauma.fi',
            ],
        ];

        DB::table('company')->insert([
            'company_name' => 'Lounais-Suomen Jätehuolto Oy',
            'company_street_address' => 'Kuormakatu 17',
            'company_postal_code' => '20380',
            'company_city' => 'Turku'
        ]);
        DB::table('company')->insert([
            'company_name' => 'Luode-Suomen Jätehuolto Oy',
            'company_street_address' => 'Käsivarrentie 17',
            'company_postal_code' => '99490',
            'company_city' => 'Kilpisjärvi'
        ]);

        # Admin User
        DB::table('users')->insert([
            'user_type_id' => 1,
            'user_company_id' => NULL,
            'user_microlocation_id' => NULL,
            'last_name' => 'Admin',
            'first_name' => 'Admin',
            'username' => 'Admin.Jaakko',
            'email' => 'admin.jaakko@lsjh.fi',
            'password' => Hash::make('qwerty')
        ]);

        # Microlocations
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

        # LSJH Users
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
        # Luode Microlocations
        foreach ($Luode_Locations as $lml) {
            DB::table('microlocations')->insert([
                'microlocation_company_id' => 2,
                'microlocation_type_id' => $lml['type_id'],
                'microlocation_name' => $lml['name'],
                'microlocation_street_address' => $lml['address'],
                'microlocation_postal_code' => $lml['postal'],
                'microlocation_city' => $lml['city']
            ]);
        }

        # Luode Users
        foreach ($Luode_Users as $luser) {
            DB::table('users')->insert([
                'user_type_id' => $luser['user_type_id'],
                'user_company_id' => 2,
                'user_microlocation_id' => $luser['user_microlocation_id'],
                'last_name' => $luser['last_name'],
                'first_name' => $luser['first_name'],
                'username' => $luser['username'],
                'email' => $luser['email'],
                'password' => Hash::make('qwerty')
            ]);
        }


    }
}
