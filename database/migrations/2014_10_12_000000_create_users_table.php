<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('specialism');
            $table->string('level');
            $table->string('personal_specialism');
            $table->string('seo_procent');
            $table->string('sum_many_first');
            $table->string('contecst_procent');
            $table->string('sum_many_last');
            $table->string('itog');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('status')->default(0);
            $table->boolean('visibal')->default(0);
            $table->boolean('admin')->default(0);
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
