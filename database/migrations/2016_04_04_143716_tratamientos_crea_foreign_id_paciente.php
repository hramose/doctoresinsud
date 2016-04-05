<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TratamientosCreaForeignIdPaciente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tratamientos', function (Blueprint $table) {
            //
            //$table->integer('id_paciente')->unsigned()->index();

            //table->foreign('id_paciente')->references('id')->on('pacientes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tratamientos', function (Blueprint $table) {
            //
            $table->dropColumn('id_paciente');

           // $table->dropForeign('tratamientos_id_paciente_foreign');
        });
    }
}
