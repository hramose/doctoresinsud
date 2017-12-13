<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo_doc', 3);
            $table->string('numero_doc', 10);
            $table->string('apellido');
            $table->string('nombre');
            $table->date('fecha_nac');
            $table->date('fecha_alta');
            $table->string('sexo',1);
            $table->string('estado_civil',1);
            $table->string('citacion',10);
            $table->date('proxima_cita');
            $table->string('serologia_ing',2);
            $table->boolean('tres_negativas');
            $table->string('cardio_isquemica_desc',45);
            $table->string('titulos_sero_ing',3);
            $table->string('trat_etio',1);
            $table->date('fecha_ini_trat_bnz');
            $table->boolean('trat_bnz');
            $table->boolean('efectos_adv_bnz');
            $table->boolean('efec_rash_bnz');
            $table->boolean('efec_intgas_bnz');
            $table->boolean('efec_afhep_bnz');
            $table->boolean('efec_afneur_bnz');
            $table->boolean('efec_afhem_bnz');
            $table->boolean('susp_bnz');
            $table->string('efec_otros_bnz',10);
            $table->boolean('trat_nifur');
            $table->date('fecha_ini_trat_nifur');
            $table->boolean('efectos_adv_nifur');
            $table->boolean('efec_rash_nifur');
            $table->boolean('efec_intgas_nifur');
            $table->boolean('efec_afhep_nifur');
            $table->boolean('efec_afneur_nifur');
            $table->boolean('efec_afhem_nifur');
            $table->string('efec_otros_nifur',10);
            $table->boolean('susp_nifur');
            $table->boolean('otros_trat');
            $table->text('trat_etio_obs');
            $table->boolean('sin_patologia');
            $table->boolean('tuberculosis');
            $table->boolean('epoc');
            $table->boolean('dbt');
            $table->boolean('colageno');
            $table->boolean('obesidad');
            $table->boolean('alcoholismo');
            $table->boolean('hipotiroidismo');
            $table->boolean('hipertiroidismo');
            $table->boolean('cardio_congenitas');
            $table->boolean('valvulopatias');
            $table->boolean('cardio_isquemica');
            $table->boolean('ht_arterial_leve');
            $table->boolean('ht_arterial_mode');
            $table->boolean('ht_arterial_severa');
            $table->boolean('acv');
            $table->text('otras_pat_asoc');
            $table->smallInteger('tension_art_bsist');
            $table->smallInteger('tension_art_bdiast');
            $table->smallInteger('frec_cardi_basal');
            $table->boolean('asintomatico');
            $table->boolean('palpitaciones');
            $table->boolean('precordialgia_atipica');
            $table->boolean('angor');
            $table->boolean('disnea');
            $table->boolean('disnea1');
            $table->boolean('disnea2');
            $table->boolean('disnea3');
            $table->boolean('disnea4');
            $table->boolean('mareos');
            $table->boolean('perdida_conoc');
            $table->boolean('insuf_cardiaca');
            $table->string('tipo_insuf_card',1);
            $table->string('otros_sintomas_ing',50);
            $table->string('nuevos_sintomas',1);
            $table->text('obs_sintomas');
            $table->string('ecg',1);
            $table->string('tipo_ecg',50);
            $table->string('nuevos_cambios_ecg',2);
            $table->date('fecha_cambios_ecg');
            $table->string('tipo_cambio_ecg',50);
            $table->text('obs_ecg');
            $table->date('fecha_rx_torax');
            $table->string('rx_torax',5);
            $table->float('indice_cardiotorax');
            $table->text('obs_rxt');
            $table->string('cambios_rxt',5);
            $table->date('fecha_cambios_rxt');
            $table->string('nueva_rxt',5);
            $table->string('grupo_clinico_ing',1);
            $table->string('cambio_grupo_cli',1);
            $table->date('fecha_cambio_gcli');
            $table->string('nuevo_grupo_cli',3);
            $table->date('fecha_ult_consulta');
            $table->string('vivo',20);
            $table->string('causa_muerte',20);
            $table->string('trat_sintomat',1);
            $table->text('evolucion');
            $table->timestamps();
            // $table->string('telefono');
           // $table->string('direccion');
           // $table->enum('sexo', array('m',"f"));
           // $table->string('email');
           // $table->string('origen');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pacientes');
    }
}

