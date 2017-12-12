<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEpidemiologiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('epidemiologias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('estado_civil',50);
            $table->string('sexo',1);
            $table->string('localidad_nac');
            $table->string('provincia_nac');
            $table->string('pais_nac');
            $table->string('lugar_nac_urbanizado',1);
            $table->string('tipo_vivienda_nac',1);
            $table->integer('anios_area_endemica');
            $table->string('tipo_residencia_ende',2);
            $table->string('volvio_area_ende',1);
            $table->string('volvio_reciente_ende',1);
            $table->date('fecha_cuando_volvio_ende')->nullable();
            $table->string('otras_areas_ende',1);
            $table->string('otras_areas_ende_lugar',50);
            $table->smallInteger('otras_areas_ende_tiempo');
            $table->boolean('antefam_muerte_sub_no');
            $table->boolean('antefam_muerte_sub_ns');
            $table->boolean('antefam_muerte_sub_padre');
            $table->boolean('antefam_muerte_sub_madre');
            $table->boolean('antefam_muerte_sub_hermano');
            $table->boolean('antefam_muerte_sub_hijo');
            $table->boolean('antefam_muerte_sub_otros');
            $table->boolean('antefam_muerte_sub_desc');
            $table->boolean('antefam_afcardi_no');
            $table->boolean('antefam_afcardi_ns');
            $table->boolean('antefam_afcardi_padre');
            $table->boolean('antefam_afcardi_madre');
            $table->boolean('antefam_afcardi_hermano');
            $table->boolean('antefam_afcardi_hijo');
            $table->boolean('antefam_afcardi_otros');
            $table->boolean('antefam_afcardi_desc');
            $table->boolean('antefam_chagas_no');
            $table->boolean('antefam_chagas_ns');
            $table->boolean('antefam_chagas_padre');
            $table->boolean('antefam_chagas_madre');
            $table->boolean('antefam_chagas_hermano');
            $table->boolean('antefam_chagas_hijo');
            $table->boolean('antefam_chagas_otros');
            $table->boolean('antefam_chagas_desc');
            $table->string('antefam_descrip',20);
            $table->boolean('embarazo');
            $table->string('dador_sangre',1);
            $table->smallInteger('dador_sangre_cant');
            $table->string('dador_sangre_hosp', 100);
            $table->smallInteger('recep_sangre');
            $table->string('recep_sangre_hosp', 100);
            $table->string('recep_sangre_motivo', 50);
            $table->string('conoce_vinchuca', 1);
            $table->string('puerta_entrada', 20);
            $table->string('sabe_chagasico', 1);
            $table->string('motivo_det_chagas', 30);
            $table->date('fecha_det_chagas')->nullable();
            $table->string('confirmacion_chagas',1);
            $table->string('conyuge',1);
            $table->smallInteger('cant_hijos');
            $table->smallInteger('cant_pers_casa');
            $table->smallInteger('cant_habit_casa');
            $table->string('agua',1);
            $table->string('canieria',1);
            $table->string('sanitario',1);
            $table->string('trabajo',4);
            $table->string('tipo_trabajo',30);
            $table->string('rechazado_empleo_chagas',1);
            $table->string('nombre_empresa_rech',100);
            $table->string('obra_social',50);
            $table->smallInteger('cant_conviv_trabajan');
            $table->string('grados_aprobados',20);
            $table->string('escolaridad',2);
            $table->integer('id_paciente')->unsigned()->index();

            $table->timestamps();

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
        Schema::drop('epidemiologias');
    }
}
