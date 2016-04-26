<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectContextsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     *
     */

    public function up()
    {
        Schema::create('project_contexts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('positions');
            $table->string('name_project');
            $table->string('ya_direct');
            $table->string('go_advords');
            $table->string('ost_bslsnse_ya');
            $table->string('ost_bslsnse_go');
            $table->string('id_glavn_user');
            $table->string('procent_seo');
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
        Schema::drop('project_contexts');
    }
}
