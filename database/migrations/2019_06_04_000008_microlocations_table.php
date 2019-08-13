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
            $table->increments('microlocation_id')->unsigned();
			$table->integer('microlocation_company_id')->unsigned();
			$table->integer('microlocation_type_id')->unsigned();
			$table->string('microlocation_name',191)->nullable();
			$table->string('microlocation_street_address',191);
			$table->char('microlocation_postal_code',5);
			$table->string('microlocation_city',50);
            $table->integer('disabled')->unsigned()->default(0);
	
			$table->foreign('microlocation_company_id')->references('company_id')->on('company');
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
