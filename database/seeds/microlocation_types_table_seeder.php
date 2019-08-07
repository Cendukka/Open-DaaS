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
		DB::table('microlocation_types')->insert(['microlocation_typename' => 'Vastaanotto']);
		DB::table('microlocation_types')->insert(['microlocation_typename' => 'Lajittelu']);
		DB::table('microlocation_types')->insert(['microlocation_typename' => 'Vastaanotto ja Lajittelu']);
		DB::table('microlocation_types')->insert(['microlocation_typename' => 'Varasto']);
    }
}
