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
            $table->bigIncrements('refined_sorting_id')->unsigned();
			$table->bigInteger('refined_sorting_inventory_receipt_id')->unsigned()->nullable();
			$table->bigInteger('pre_sorting_id')->unsigned()->nullable();
			$table->bigInteger('textile_id')->unsigned();
			$table->bigInteger('refined_sorting_user_id')->unsigned();
			$table->bigInteger('refined_sorting_status_id')->unsigned();
			$table->integer('refined_sorting_weight');
			$table->dateTime('refined_sorting_date');
	
			$table->foreign('refined_sorting_inventory_receipt_id')->references('inventory_receipt_id')->on('inventory_receipt');
			$table->foreign('pre_sorting_id')->references('pre_sorting_id')->on('pre_sorting');
			$table->foreign('textile_id')->references('textile_id')->on('textile_inventory');
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
