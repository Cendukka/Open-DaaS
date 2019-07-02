<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
		$this->call([
			user_types_table_seeder::class,
			issue_types_table_seeder::class,
			ewc_codes_table_seeder::class,
			microlocation_types_table_seeder::class,
			presorted_material_table_seeder::class,
			supplier_table_seeder::class,
			company_table_seeder::class,
			microlocations_table_seeder::class,
			users_table_seeder::class,
			community_table_seeder::class,
			material_names_table_seeder::class,
			inventory_table_seeder::class,
			inventory_receipt_table_seeder::class,
			inventory_issue_table_seeder::class,
			inventory_issue_details_table_seeder::class,
			pre_sorting_table_seeder::class,
			refined_sorting_table_seeder::class
		]);
    }
}
