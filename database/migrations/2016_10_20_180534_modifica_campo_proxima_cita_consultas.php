<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModificaCampoProximaCitaConsultas extends Migration
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
            $table->date('proxima_cita')->nullable()->change();
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
            $table->date('proxima_cita')->nullable(false)->change();
        });
    }
}
