<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PreSortingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pre_sorting', function (Blueprint $table) {
            $table->bigIncrements('pre_sorting_id')->unsigned();
			$table->bigInteger('pre_sorting_inventory_receipt_id')->unsigned();
			$table->bigInteger('presorted_material_id')->unsigned();
			$table->bigInteger('pre_sorting_user_id')->unsigned();
			$table->bigInteger('pre_sorting_status_id')->unsigned();
			$table->integer('pre_sorting_weight');
			$table->dateTime('pre_sorting_date');
	
			$table->foreign('pre_sorting_inventory_receipt_id')->references('inventory_receipt_id')->on('inventory_receipt');
			$table->foreign('presorted_material_id')->references('presorted_material_id')->on('presorted_material');
			$table->foreign('pre_sorting_user_id')->references('user_id')->on('users');
			$table->foreign('pre_sorting_status_id')->references('status_type_id')->on('status_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pre_sorting');
    }
}
