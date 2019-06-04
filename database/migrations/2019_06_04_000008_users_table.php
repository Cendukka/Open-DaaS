<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('user_id')->unsigned();
			$table->bigInteger('user_type_id')->unsigned();
			$table->bigInteger('user_company_id')->unsigned();
			$table->string('last_name');
			$table->string('first_name');
			$table->string('username');
			$table->string('password');
	
			$table->foreign('user_type_id')->references('user_type_id')->on('user_types');
			$table->foreign('user_company_id')->references('company_id')->on('company');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}