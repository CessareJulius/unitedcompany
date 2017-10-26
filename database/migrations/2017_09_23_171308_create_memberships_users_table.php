<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMembershipsUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('memberships_users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index('memberships_users_user_id_foreign');
			$table->integer('membership_id')->unsigned()->index('memberships_users_membership_id_foreign');
			$table->dateTime('fecha_suscripcion')->nullable();
			$table->string('status', 191);
			$table->dateTime('expiration')->nullable();
			$table->integer('notifiable')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('memberships_users');
	}

}
