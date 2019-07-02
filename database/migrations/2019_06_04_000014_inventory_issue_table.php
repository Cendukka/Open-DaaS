<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InventoryIssueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_issue', function (Blueprint $table) {
            $table->increments('issue_id')->unsigned();
			$table->integer('issue_from_microlocation_id')->unsigned();
			$table->integer('issue_to_microlocation_id')->unsigned()->nullable();
			$table->integer('issue_type_id')->unsigned();
            $table->dateTime('issue_date');
			$table->integer('issue_user_id')->unsigned();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));


			$table->foreign('issue_from_microlocation_id')->references('microlocation_id')->on('microlocations');
			$table->foreign('issue_to_microlocation_id')->references('microlocation_id')->on('microlocations');
			$table->foreign('issue_type_id')->references('issue_type_id')->on('issue_types');
			$table->foreign('issue_user_id')->references('user_id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory_issue');
    }
}
