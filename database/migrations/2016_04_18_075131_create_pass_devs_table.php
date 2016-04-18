<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePassDevsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pass_devs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('positions');
            $table->string('name_project');
            $table->string('id_glavn_user');
            $table->text('ssa');
            $table->text('ftp');
            $table->string('login');
            $table->string('password');
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
        Schema::drop('pass_devs');
    }
}
