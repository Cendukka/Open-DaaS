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
			$table->integer('issue_id')->unsigned()->nullable();
			$table->integer('textile_id')->unsigned();
			$table->char('issue_ewc_code',6)->nullable();
			$table->integer('issue_weight');
	
			$table->foreign('issue_id')->references('issue_id')->on('inventory_issue');
			$table->foreign('textile_id')->references('textile_id')->on('textile_inventory');
			$table->foreign('issue_ewc_code')->references('ewc_code')->on('ewc_codes');
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
