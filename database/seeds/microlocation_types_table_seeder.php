<?php

use Illuminate\Database\Seeder;

class microlocation_types_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('microlocation_types')->insert(['microlocation_typename' => 'Collection Point']);
		DB::table('microlocation_types')->insert(['microlocation_typename' => 'Sorting Station']);
		DB::table('microlocation_types')->insert(['microlocation_typename' => 'Collection and Sorting']);
		DB::table('microlocation_types')->insert(['microlocation_typename' => 'Warehouse']);
    }
}
