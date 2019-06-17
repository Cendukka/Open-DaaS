<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InventoryIssueDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_issue_details', function (Blueprint $table) {
            $table->increments('issue_detail_id')->unsigned();
			$table->integer('detail_issue_id')->unsigned()->nullable();
			$table->integer('detail_inventory_id')->unsigned();
			$table->char('detail_ewc_code',6)->nullable();
			$table->integer('detail_weight');
	
			$table->foreign('detail_issue_id')->references('issue_id')->on('inventory_issue');
			$table->foreign('detail_inventory_id')->references('inventory_id')->on('inventory');
			$table->foreign('detail_ewc_code')->references('ewc_code')->on('ewc_codes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory_issue_details');
    }
}
