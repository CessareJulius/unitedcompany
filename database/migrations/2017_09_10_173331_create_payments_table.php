<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('payments')) {
            Schema::create('payments',function(Blueprint $table) {
                $table->increments('id');
                $table->timestamp('fecha_solicitud')->nullable();
                $table->timestamp('fecha_pago')->nullable();
                $table->string('razon_pago');
                $table->string('status');
                $table->integer('user_id')->unsigned();

            });

        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
