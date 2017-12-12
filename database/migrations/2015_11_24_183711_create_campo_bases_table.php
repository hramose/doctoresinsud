<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampoBasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campos_base', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',255);
            $table->string('descripcion', 500)->nullable();
            $table->enum('tipo', ['texto', 'número entero', 'número con decimales', 'Verdadero/Falso']);
            $table->integer('id_unidad')->unsigned();
            $table->float('ref_min')->nullable();
            $table->float('ref_max')->nullable();
            $table->timestamps();

           // $table->foreign('id_unidad')->references('id')->on('unidad_medidas');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('campos_base');
    }
}
