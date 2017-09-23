<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagoPaypalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pago_paypal', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('payment_id')->unsigned()->index('pago_paypal_payment_id_foreign');
			$table->string('cuenta', 191);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pago_paypal');
	}

}
