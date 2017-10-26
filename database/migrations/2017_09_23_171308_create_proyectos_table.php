<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProyectosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('proyectos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('titulo');
			$table->string('idea_negocio', 191);
			$table->string('objetivo', 191);
			$table->integer('presupuesto');
			$table->string('herramientas', 191);
			$table->string('ubicacion', 191);
			$table->integer('user_id')->unsigned()->index('proyectos_user_id_foreign');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('proyectos');
	}

}
