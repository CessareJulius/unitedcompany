<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMembershipsUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('memberships_users', function(Blueprint $table)
		{
			$table->foreign('membership_id')->references('id')->on('memberships')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('user_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('memberships_users', function(Blueprint $table)
		{
			$table->dropForeign('memberships_users_membership_id_foreign');
			$table->dropForeign('memberships_users_user_id_foreign');
		});
	}

}
