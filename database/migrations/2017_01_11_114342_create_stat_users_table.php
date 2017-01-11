<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stat_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user');
            $table->integer('id_project');
            $table->integer('osvoeno_procent');
            $table->date('date_day');
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
        Schema::drop('stat_users');
    }
}
