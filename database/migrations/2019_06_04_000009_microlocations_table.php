<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MicrolocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('microlocations', function (Blueprint $table) {
            $table->bigIncrements('microlocation_id')->unsigned();
			$table->bigInteger('company_id')->unsigned();
			$table->bigInteger('microlocation_type_id')->unsigned();
			$table->string('microlocation_name')->nullable();
			$table->string('microlocation_street_address');
			$table->string('microlocation_postal_code');
			$table->string('microlocation_city');
	
			$table->foreign('company_id')->references('company_id')->on('company');
			$table->foreign('microlocation_type_id')->references('microlocation_type_id')->on('microlocation_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('microlocations');
    }
}
