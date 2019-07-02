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
            $table->increments('refined_id')->unsigned();
			$table->integer('refined_receipt_id')->unsigned()->nullable();
			$table->integer('pre_sorting_id')->unsigned()->nullable();
			$table->integer('refined_material_id')->unsigned();
			$table->integer('refined_user_id')->unsigned();
			$table->integer('refined_weight');
			$table->dateTime('refined_date');
			$table->string('refined_description',191);
            $table->timestamps();

			$table->foreign('refined_receipt_id')->references('receipt_id')->on('inventory_receipt');
			$table->foreign('pre_sorting_id')->references('pre_sorting_id')->on('pre_sorting');
			$table->foreign('refined_material_id')->references('material_id')->on('material_names');
			$table->foreign('refined_user_id')->references('user_id')->on('users');
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
