<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RefinedSortingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refined_sorting', function (Blueprint $table) {
            $table->increments('refined_sorting_id')->unsigned();
			$table->integer('refined_sorting_receipt_id')->unsigned()->nullable();
			$table->integer('pre_sorting_id')->unsigned()->nullable();
			$table->integer('refined_inventory_id')->unsigned();
			$table->integer('refined_sorting_user_id')->unsigned();
			$table->integer('refined_sorting_status_id')->unsigned();
			$table->integer('refined_sorting_weight');
			$table->dateTime('refined_sorting_date');
	
			$table->foreign('refined_sorting_receipt_id')->references('receipt_id')->on('inventory_receipt');
			$table->foreign('pre_sorting_id')->references('pre_sorting_id')->on('pre_sorting');
			$table->foreign('refined_inventory_id')->references('inventory_id')->on('inventory');
			$table->foreign('refined_sorting_user_id')->references('user_id')->on('users');
			$table->foreign('refined_sorting_status_id')->references('status_type_id')->on('status_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('refined_sorting');
    }
}
