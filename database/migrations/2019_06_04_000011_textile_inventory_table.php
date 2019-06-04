<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TextileInventoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('textile_inventory', function (Blueprint $table) {
            $table->bigIncrements('textile_id')->unsigned();
			$table->bigInteger('textile_microlocation_id')->unsigned();
            $table->string('fraction');
			$table->integer('textile_weight');
	
			$table->foreign('textile_microlocation_id')->references('microlocation_id')->on('microlocations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('textile_inventory');
    }
}
