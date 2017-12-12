<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgregaCamposConsulta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_hcs', function (Blueprint $table) {
            //
            $table->date('proxima_cita');
            $table->smallInteger('presion_sistolica');
            $table->smallInteger('presion_diastolica');
            $table->smallInteger('frecuencia_cardiaca');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item_hcs', function (Blueprint $table) {
            //
            $table->dropColumn('proxima_cita');
            $table->dropColumn('presion_sistolica');
            $table->dropColumn('presion_diastolica');
            $table->dropColumn('frecuencia_cardiaca');
        });
    }
}
