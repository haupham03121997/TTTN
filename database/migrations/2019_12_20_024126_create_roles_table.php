<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('name')->unique();
            $table->string('display_name');
            
            $table->timestamps();
        });
        Schema::create('role_admin', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('admin_id');
            $table->integer('role_id');
            
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
        Schema::dropIfExists('roles');
        Schema::dropIfExists('role_admin');
    }
}
