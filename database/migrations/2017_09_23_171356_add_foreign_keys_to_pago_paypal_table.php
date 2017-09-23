<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPagoPaypalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pago_paypal', function(Blueprint $table)
		{
			$table->foreign('payment_id')->references('id')->on('payments')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pago_paypal', function(Blueprint $table)
		{
			$table->dropForeign('pago_paypal_payment_id_foreign');
		});
	}

}
