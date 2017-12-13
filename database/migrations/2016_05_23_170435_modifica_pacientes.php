<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModificaPacientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pacientes', function (Blueprint $table) {
            //Agrega la propiedad nullable de los siguientes campos:
            $table->date('fecha_ini_trat_nifur')->nullable()->change();
            $table->date('fecha_cambios_rxt')->nullable()->change();
            $table->date('fecha_alta')->nullable()->change();
            $table->date('fecha_ini_trat_bnz')->nullable()->change();
            $table->date('fecha_cambios_ecg')->nullable()->change();
            $table->date('fecha_rx_torax')->nullable()->change();
            $table->date('fecha_nac')->nullable()->change();
            $table->date('proxima_cita')->nullable()->change();
            $table->date('fecha_ult_consulta')->nullable()->change();
            $table->date('fecha_cambio_gcli')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pacientes', function (Blueprint $table) {
            //Quita la propiedad nullable de los siguientes campos:
            $table->date('fecha_ini_trat_nifur')->nullable(false)->change();
            $table->date('fecha_cambios_rxt')->nullable(false)->change();
            $table->date('fecha_alta')->nullable(false)->change();
            $table->date('fecha_ini_trat_bnz')->nullable(false)->change();
            $table->date('fecha_cambios_ecg')->nullable(false)->change();
            $table->date('fecha_rx_torax')->nullable(false)->change();
            $table->date('fecha_nac')->nullable(false)->change();
            $table->date('proxima_cita')->nullable(false)->change();
            $table->date('fecha_ult_consulta')->nullable(false)->change();
            $table->date('fecha_cambio_gcli')->nullable(false)->change();

        });
    }
}
