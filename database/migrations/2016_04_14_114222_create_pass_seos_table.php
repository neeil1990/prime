<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePassSeosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pass_seos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('positions');
            $table->integer('status');
            $table->string('name_project');
            $table->string('id_glavn_user');
            $table->text('ssa');
            $table->text('ftp');
            $table->text('admin_url');
            $table->text('admin_login');
            $table->text('admin_pass');
            $table->string('login');
            $table->string('password');
            $table->string('value_serialize');
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
        Schema::drop('pass_seos');
    }
}
