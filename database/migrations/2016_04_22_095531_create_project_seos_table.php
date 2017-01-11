<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectSeosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     *
     */
    public function up()
    {
        Schema::create('project_seos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('positions');
            $table->integer('status');
            $table->integer('procent_bonus');
            $table->integer('count_day_fine');
            $table->integer('procent_fine');
            $table->string('name_project');
            $table->string('budget');
            $table->string('osvoeno');
            $table->string('osvoeno_procent');
            $table->string('id_glavn_user');
            $table->string('procent_seo');
            $table->string('summa_zp');
            $table->string('startpoint');
            $table->string('lp');
            $table->string('start');
            $table->string('end');
            $table->string('aim');
            $table->string('region');
            $table->string('dogovor_number');
            $table->string('contact_person');
            $table->string('phone_person');
            $table->string('e_mail');
            $table->text('value_serialize');
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
        Schema::drop('project_seos');
    }
}
