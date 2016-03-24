<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreaTablaCamposbaseEstudios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('camposbase_estudios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('estudio_id')->unsigned()->index();
            $table->integer('campo_base_id')->unsigned()->index();
            $table->foreign('estudio_id')->references('id')->on('estudios');
            $table->foreign('campo_base_id')->references('id')->on('campos_base');
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
        //
        Schema::drop('camposbase_estudios');
    }
}
