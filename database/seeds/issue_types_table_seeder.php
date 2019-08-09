<?php

use Illuminate\Database\Seeder;

class issue_types_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        DB::table('issue_types')->insert(['issue_typename' => 'Sisäinen siirto']);
		DB::table('issue_types')->insert(['issue_typename' => 'Ulkoinen siirto']);
		DB::table('issue_types')->insert(['issue_typename' => 'Hyväntekeväisyys']);
		DB::table('issue_types')->insert(['issue_typename' => 'Myynti']);
    }
}
