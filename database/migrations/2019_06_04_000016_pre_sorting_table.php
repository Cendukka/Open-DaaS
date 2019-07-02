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
            $table->increments('pre_sorting_id')->unsigned();
			$table->integer('pre_sorting_receipt_id')->unsigned();
			$table->integer('presorted_material_id')->unsigned();
			$table->integer('pre_sorting_user_id')->unsigned();
			$table->integer('pre_sorting_weight');
			$table->dateTime('pre_sorting_date');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

			$table->foreign('pre_sorting_receipt_id')->references('receipt_id')->on('inventory_receipt');
			$table->foreign('presorted_material_id')->references('presorted_material_id')->on('presorted_material');
			$table->foreign('pre_sorting_user_id')->references('user_id')->on('users');
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
