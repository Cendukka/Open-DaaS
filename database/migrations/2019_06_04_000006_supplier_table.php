<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SupplierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier', function (Blueprint $table) {
            $table->increments('supplier_id')->unsigned();
			$table->string('supplier_name',191);
			$table->string('supplier_street_address',50);
			$table->char('supplier_postal_code',5);
			$table->string('supplier_city',50);
			$table->string('contact_person',50);
			$table->string('email',191);
			$table->string('phone_number',50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supplier');
    }
}
