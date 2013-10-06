<?php

use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
    Schema::create('users', function(\Illuminate\Database\Schema\Blueprint $table)
    {
      $table->engine = 'InnoDB';

      $table->bigInteger('id', true, true);
      $table->string('username', 16);
      $table->string('email', 60);
      $table->string('alt_email', 60)->nullable();
      $table->string('password');
      $table->timestamps();
      $table->softDeletes();

      $table->unique('username');
      $table->unique('email');
      $table->unique('alt_email');
    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
    Schema::drop('users');
	}

}