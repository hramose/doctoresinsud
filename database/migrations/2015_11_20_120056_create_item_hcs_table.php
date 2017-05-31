<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemHcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_hcs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_sede')->unsigned()->index();
            $table->integer('id_usuario')->unsigned()->index();
            $table->integer('id_paciente')->unsigned()->index();
            $table->date('fecha');
            $table->string('titulo');
            $table->text('descripcion');
            $table->timestamps();

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
        Schema::drop('item_hcs');
    }
}
