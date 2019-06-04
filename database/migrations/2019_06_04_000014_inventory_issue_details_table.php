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
            $table->bigIncrements('issue_detail_id')->unsigned();
			$table->bigInteger('inventory_issue_id')->unsigned()->nullable();
			$table->bigInteger('textile_id')->unsigned();
			$table->string('ewc_code')->nullable();
			$table->integer('issue_weight');
	
			$table->foreign('inventory_issue_id')->references('inventory_issue_id')->on('inventory_issue');
			$table->foreign('textile_id')->references('textile_id')->on('textile_inventory');
			$table->foreign('ewc_code')->references('ewc_code')->on('ewc_codes');
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
