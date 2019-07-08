<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InventoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory', function (Blueprint $table) {
            $table->increments('inventory_id')->unsigned();
			$table->integer('inventory_microlocation_id')->unsigned();
			$table->integer('inventory_material_id')->unsigned();
			$table->integer('inventory_weight');
            $table->timestamps();
            
			$table->foreign('inventory_material_id')->references('material_id')->on('material_names');
			$table->foreign('inventory_microlocation_id')->references('microlocation_id')->on('microlocations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory');
    }
}
