<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePassContextsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pass_contexts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_project');
            $table->string('id_glavn_user');
            $table->text('loginYandex');
            $table->text('passYandex');
            $table->string('loginGoogle');
            $table->string('passGoogle');
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
        Schema::drop('pass_contexts');
    }
}
