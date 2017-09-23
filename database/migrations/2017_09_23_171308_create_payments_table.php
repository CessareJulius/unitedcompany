<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('payments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->dateTime('fecha_solicitud')->nullable();
			$table->dateTime('fecha_pago')->nullable();
			$table->string('razon_pago', 191);
			$table->string('status', 191);
			$table->integer('user_id')->unsigned();
			$table->float('total', 10, 0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('payments');
	}

}
