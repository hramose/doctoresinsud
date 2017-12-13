<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreaTablaEstudiosPaciente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('estudios_pacientes', function (Blueprint $table){
            $table->increments('id')->unsigned()->index();
            $table->integer('id_hc')->unsigned()->index();
            $table->integer('id_estudio')->unsigned()->index();
            $table->date('fecha');
            $table->string('titulo',50);
            $table->string('descripcion',200);
            $table->timestamps();

            $table->foreign('id_hc')->references('id')->on('pacientes');
            $table->foreign('id_estudio')->references('id')->on('estudios');
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
        Schema::drop('estudios_pacientes');
    }
}
