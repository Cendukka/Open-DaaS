<?php

use Illuminate\Database\Seeder;

class presorted_material_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('presorted_material')->insert(['presorted_material_name' => 'Textile']);
		DB::table('presorted_material')->insert(['presorted_material_name' => 'Metal']);
		DB::table('presorted_material')->insert(['presorted_material_name' => 'Plastic']);
		DB::table('presorted_material')->insert(['presorted_material_name' => 'Glass']);
		DB::table('presorted_material')->insert(['presorted_material_name' => 'Electronics']);
    }
}
