<?php

use Illuminate\Database\Seeder;

class status_types_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('status_types')->insert(['status_name' => 'Closed']);
		DB::table('status_types')->insert(['status_name' => 'Open']);
    }
}
