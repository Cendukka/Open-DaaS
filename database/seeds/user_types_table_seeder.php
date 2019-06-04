<?php

use Illuminate\Database\Seeder;

class user_types_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('user_types')->insert(['user_typename' => 'Admin']);
		DB::table('user_types')->insert(['user_typename' => 'Manager']);
		DB::table('user_types')->insert(['user_typename' => 'User']);
    }
}
