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
            $table->integer('id_sede');
            $table->integer('id_usuario');
            $table->integer('id_paciente');
            $table->string('titulo');
            $table->text('descripcion');
            $table->string('path');
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
        Schema::drop('item_hcs');
    }
}
