<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDireccionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direcciones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('calle')->nullable();
            $table->string('altura',10)->nullable();
            $table->string('piso',10)->nullable();
            $table->string('departamento',10)->nullable();
            $table->string('localidad');
            $table->string('provincia');
            $table->string('pais');
            $table->string('codigo_postal',45)->nullable();
            $table->boolean('activo');
            $table->integer('id_paciente')->unsigned()->index();
            $table->timestamps();

            $table->foreign('id_paciente')->references('id')->on('pacientes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('direcciones');
    }
}
