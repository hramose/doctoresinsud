<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsultaSintomasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultas_sintomas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('consulta_id')->unsigned()->index();
            $table->integer('sintoma_id')->unsigned()->index();
            $table->foreign('consulta_id')->references('id')->on('item_hcs');
            $table->foreign('sintoma_id')->references('id')->on('sintomas');
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
        Schema::drop('consultas_sintomas');
    }
}
