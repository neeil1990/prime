<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceAndPassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_and_passes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('positions');
            $table->string('name_project');
            $table->string('login');
            $table->string('password');
            $table->text('dop_infa');
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
        Schema::drop('service_and_passes');
    }
}
