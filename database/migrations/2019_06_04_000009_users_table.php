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
            $table->increments('user_id')->unsigned();
			$table->integer('user_company_id')->unsigned()->nullable();
			$table->integer('user_microlocation_id')->unsigned()->nullable();
			$table->integer('user_type_id')->unsigned();
			$table->string('last_name',50);
			$table->string('first_name',50);
            $table->string('email',50)->unique();
			$table->string('username',50)->unique();
            $table->string('password',191);
            $table->integer('is_disabled')->unsigned()->default(0);
            $table->rememberToken();
	
			$table->foreign('user_type_id')->references('user_type_id')->on('user_types');
			$table->foreign('user_company_id')->references('company_id')->on('company');
			$table->foreign('user_microlocation_id')->references('microlocation_id')->on('microlocations');
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