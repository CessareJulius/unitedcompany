<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembershipsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
        if (!Schema::hasTable('memberships_users')) {
            Schema::create('memberships_users',function(Blueprint $table) {
                $table->increments('id');            
                $table->integer('user_id')->unsigned();
                $table->integer('membership_id')->unsigned();
                $table->timestamp('fecha_suscripcion')->nullable();
                $table->string('status');
                
                $table->timestamp('expiration')->nullable();
                $table->foreign('user_id')->references('id')->on('users');
                $table->foreign('membership_id')->references('id')->on('memberships');
                
                

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
        Schema::dropIfExists('memberships_users');
    }
}
