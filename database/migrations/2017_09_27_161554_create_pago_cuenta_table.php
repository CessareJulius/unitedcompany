<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagoCuentaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pago_cuenta', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('payment_id')->unsigned();
			$table->string('referencia', 15);
		});
		Schema::table('pago_cuenta', function(Blueprint $table)
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
		Schema::drop('pago_cuenta');
		Schema::table('pago_paypal', function(Blueprint $table)
		{
			$table->dropForeign('pago_cuenta_payment_id_foreign');
		});
	}

}
