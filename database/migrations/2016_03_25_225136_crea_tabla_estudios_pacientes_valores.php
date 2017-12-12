<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreaTablaEstudiosPacientesValores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudios_pacientes_valores', function (Blueprint $table) {
            $table->increments('id')->unsigned()->index();
            $table->string('valor', 100);
            $table->string('obs', 200);
            $table->timestamps();
            $table->integer('estudios_pacientes_id')->unsigned()->index();
            $table->integer('campos_base_id')->unsigned()->index();

           // $table->foreign('estudios_pacientes_id')->references('id')->on('estudios_pacientes');
           // $table->foreign('campos_base_id')->references('id')->on('campos_base');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('estudios_pacientes_valores');
    }
}
