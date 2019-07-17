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
        DB::table('issue_types')->insert(['issue_typename' => 'Transport']);
		DB::table('issue_types')->insert(['issue_typename' => 'Incineration']);
		DB::table('issue_types')->insert(['issue_typename' => 'Charity']);
		DB::table('issue_types')->insert(['issue_typename' => 'For sale']);
    }
}
