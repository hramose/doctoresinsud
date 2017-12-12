<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgregaForeingKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('item_hcs', function ($table) {

            $table->foreign('id_sede')->references('id')->on('sedes');
            $table->foreign('id_usuario')->references('id')->on('users');
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
        //
        Schema::table('item_hcs', function ($table) {
            $table->dropForeign(['id_sede']);
            $table->dropForeign(['id_usuario']);
            $table->dropForeign(['id_paciente']);
        });
    }
}
