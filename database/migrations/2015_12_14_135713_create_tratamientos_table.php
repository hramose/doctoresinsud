<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTratamientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tratamientos', function (Blueprint $table) {
            $table->increments('id')->unsigned()->index();
	        $table->date('fecha_trat');
	        $table->string('droga',20);
	        $table->float('dosis');
	        $table->string('flia_droga',3);
            $table->integer('id_hc')->unsigned()->index();
            $table->string('obs_trat');
            $table->timestamps();

            $table->foreign('id_hc')->references('id')->on('pacientes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tratamientos');
    }
}
