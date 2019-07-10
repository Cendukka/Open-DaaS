<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InventoryReceiptTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_receipt', function (Blueprint $table) {
            $table->increments('receipt_id')->unsigned();
			$table->integer('receipt_material_id')->unsigned()->nullable();
			$table->integer('from_community_id')->unsigned()->nullable();
			$table->integer('from_supplier_id')->unsigned()->nullable();
			$table->integer('receipt_from_microlocation_id')->unsigned()->nullable();
			$table->integer('receipt_to_microlocation_id')->unsigned();
			$table->integer('receipt_user_id')->unsigned();
			$table->integer('distance_km');
			$table->integer('receipt_weight');
			$table->dateTime('receipt_date');
			$table->char('receipt_ewc_code',6);
	
			$table->foreign('receipt_material_id')->references('material_id')->on('material_names');
			$table->foreign('receipt_from_microlocation_id')->references('microlocation_id')->on('microlocations');
			$table->foreign('from_community_id')->references('community_id')->on('community');
			$table->foreign('from_supplier_id')->references('supplier_id')->on('supplier');
			$table->foreign('receipt_to_microlocation_id')->references('microlocation_id')->on('microlocations');
			$table->foreign('receipt_user_id')->references('user_id')->on('users');
			$table->foreign('receipt_ewc_code')->references('ewc_code')->on('ewc_codes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory_receipt');
    }
}
