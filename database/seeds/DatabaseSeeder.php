<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    public function run() {
        // Set this variable to 1 if you dont want to seed the database with test data
        $production = 0;
        if($production) {
            $this->call([
                user_types_table_seeder::class,
                issue_types_table_seeder::class,
                ewc_codes_table_seeder::class,
                microlocation_types_table_seeder::class,
                material_names_table_seeder::class,
                lsjh_seeder::class,
            ]);
        }
        else {
            $this->call([
                user_types_table_seeder::class,
                issue_types_table_seeder::class,
                ewc_codes_table_seeder::class,
                microlocation_types_table_seeder::class,
                material_names_table_seeder::class,
                lsjh_seeder::class,
                company_table_seeder::class,
                microlocations_table_seeder::class,
                users_table_seeder::class,
                community_table_seeder::class,
                inventory_receipt_table_seeder::class,
                inventory_issue_table_seeder::class,
                inventory_issue_details_table_seeder::class,
                pre_sorting_table_seeder::class,
                refined_sorting_table_seeder::class,
                inventory_table_seeder::class,
            ]);
        }
    }
}
