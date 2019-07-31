<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class microlocations_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$faker = Faker::create('fi_FI');
		$companies_amount = DB::table('company')->count();
		$types_amount = DB::table('microlocation_types')->count();

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

		foreach (range(2,$companies_amount) as $index) {
			DB::table('microlocations')->insert([
				'microlocation_company_id' => $index,
				'microlocation_type_id' => rand(1,$types_amount),
				'microlocation_name' => $faker->domainWord,
				'microlocation_street_address' => $faker->streetAddress,
				'microlocation_postal_code' => $faker->postcode,
				'microlocation_city' => $faker->city
			]);
		}
		foreach (range(2,$companies_amount*2) as $index) {
			DB::table('microlocations')->insert([
				'microlocation_company_id' => rand(1,$companies_amount),
				'microlocation_type_id' => rand(1,$types_amount),
				'microlocation_name' => $faker->domainWord,
				'microlocation_street_address' => $faker->streetAddress,
				'microlocation_postal_code' => $faker->postcode,
				'microlocation_city' => $faker->city
			]);
		}
    }
}
