<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsultaPatologiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultas_patologias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('consulta_id')->unsigned()->index();
            $table->integer('patologia_id')->unsigned()->index();
            $table->foreign('consulta_id')->references('id')->on('item_hcs');
            $table->foreign('patologia_id')->references('id')->on('patologias');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('consultas_patologias');
    }
}
