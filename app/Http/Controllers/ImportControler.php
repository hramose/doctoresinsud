<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\CampoBase;
use App\Consulta;
use App\ConsultaPatologia;
use App\ConsultaSintoma;
use App\Epidemiologia;
use App\Estudio;
use App\EstudioPaciente;
use App\EstudioPacienteValor;
use App\HistorialCampo;
use App\ImagenEstudio;
use App\Medicamento;
use App\Paciente;
use App\Patologia;
use App\Permission;
use App\Sintoma;
use App\TipoDato;
use App\Tratamiento;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class ImportControler extends Controller
{
    public function labImport()
    {
        $epi = DB::select('select * from serio_import');
        $count = 0;
        foreach ($epi as $import){
            $pac = new Paciente();
            $pac =  $pac->getPacienteByHistoryClinic($import->HISTCLI);
            $count++;
            
            if(count($pac) == 1 && $import->FECHA != "SE" ){
                $serio = new EstudioPaciente();
                $serio->id_hc = $pac[0]->id;
                dump($count);
                
                if($import->FECHA != '.' && $import->FECHA != ''){
                    $serio->fecha = $import->FECHA;           
                }else{
                    $serio->fecha = "0/0/0000";
                }
                
                $serio->titulo = $import->ESTUDIO;
                $serio->descripcion = $import->CODIGO;
                $serio->id_estudio = 4;
                $serio->save();

                $values0 = new EstudioPacienteValor();
                $values0->estudios_pacientes_id = $serio->id;
                $values0->campos_base_id = 105;
                $values0->valor = $import->EVOLSERO;
                $values0->obs = "Sin Observacion";
                $values0->save();

                $values1 = new EstudioPacienteValor();
                $values1->estudios_pacientes_id = $serio->id;
                $values1->campos_base_id = 81;
                $values1->valor = $import->ELISA;
                $values1->obs = "Sin Observacion";
                $values1->save();

                $values2 = new EstudioPacienteValor();
                $values2->estudios_pacientes_id = $serio->id;
                $values2->campos_base_id = 82;
                $values2->valor = $import->ELISATITU;
                $values2->obs = "Sin Observacion";
                $values2->save();

                $values3 = new EstudioPacienteValor();
                $values3->estudios_pacientes_id = $serio->id;
                $values3->campos_base_id = 83;
                $values3->valor = $import->HAI;
                $values3->obs = "Sin Observacion";
                $values3->save();

                $values4 = new EstudioPacienteValor();
                $values4->estudios_pacientes_id = $serio->id;
                $values4->campos_base_id = 84;
                $values4->valor = $import->HAITITU;
                $values4->obs = "Sin Observacion";
                $values4->save();

                $values5 = new EstudioPacienteValor();
                $values5->estudios_pacientes_id = $serio->id;
                $values5->campos_base_id = 85;
                $values5->valor = $import->TIF;
                $values5->obs = "Sin Observacion";
                $values5->save();

                $values6 = new EstudioPacienteValor();
                $values6->estudios_pacientes_id = $serio->id;
                $values6->campos_base_id = 86;
                $values6->valor = $import->TIFTITU;
                $values6->obs = "Sin Observacion";
                $values6->save();

                $values7 = new EstudioPacienteValor();
                $values7->estudios_pacientes_id = $serio->id;
                $values7->campos_base_id = 87;
                $values7->valor = $import->MG;
                $values7->obs = "Sin Observacion";
                $values7->save();

                $values8 = new EstudioPacienteValor();
                $values8->estudios_pacientes_id = $serio->id;
                $values8->campos_base_id = 89;
                $values8->valor = $import->ADTITU;
                $values8->obs = "Sin Observacion";
                $values8->save();

                $values9 = new EstudioPacienteValor();
                $values9->estudios_pacientes_id = $serio->id;
                $values9->campos_base_id = 88;
                $values9->valor = $import->AD;
                $values9->obs = "Sin Observacion";
                $values9->save();
                //==================================================================
                $serio1 = new EstudioPaciente();
                $serio1->id_hc = $pac[0]->id;
                
                //AAAA-MM-DD
                //[0]->DIA,[1]->MES,[2]->AÑO
               if($import->FECHA != '.' && $import->FECHA != ''){
                    $serio1->fecha = $import->FECHA;           
                }else{
                    $serio1->fecha = "0/0/0000";
                }
                $serio1->titulo = $import->ESTUDIO;
                $serio1->descripcion = $import->CODIGO;
                $serio1->id_estudio = 3;
                $serio1->save();

                $valued0 = new EstudioPacienteValor();
                $valued0->estudios_pacientes_id = $serio->id;
                $valued0->campos_base_id = 91;
                $valued0->valor = $import->GB;
                $valued0->obs = "Sin Observacion";
                $valued0->save();

                $valued0 = new EstudioPacienteValor();
                $valued0->estudios_pacientes_id = $serio->id;
                $valued0->campos_base_id = 92;
                $valued0->valor = $import->HB;
                $valued0->obs = "Sin Observacion";
                $valued0->save();

                $valued0 = new EstudioPacienteValor();
                $valued0->estudios_pacientes_id = $serio->id;
                $valued0->campos_base_id = 93;
                $valued0->valor = $import->GLUCEMIA;
                $valued0->obs = "Sin Observacion";
                $valued0->save();

                $valued0 = new EstudioPacienteValor();
                $valued0->estudios_pacientes_id = $serio->id;
                $valued0->campos_base_id = 94;
                $valued0->valor = $import->UREMIA;
                $valued0->obs = "Sin Observacion";
                $valued0->save();

                $valued0 = new EstudioPacienteValor();
                $valued0->estudios_pacientes_id = $serio->id;
                $valued0->campos_base_id = 95;
                $valued0->valor = $import->CREATININA;
                $valued0->obs = "Sin Observacion";
                $valued0->save();

                $valued0 = new EstudioPacienteValor();
                $valued0->estudios_pacientes_id = $serio->id;
                $valued0->campos_base_id = 96;
                $valued0->valor = $import->ACURICO;
                $valued0->obs = "Sin Observacion";
                $valued0->save();

                $valued0 = new EstudioPacienteValor();
                $valued0->estudios_pacientes_id = $serio->id;
                $valued0->campos_base_id = 97;
                $valued0->valor = $import->COLESTEROL;
                $valued0->obs = "Sin Observacion";
                $valued0->save();

                $valued0 = new EstudioPacienteValor();
                $valued0->estudios_pacientes_id = $serio->id;
                $valued0->campos_base_id = 98;
                $valued0->valor = $import->HDL;
                $valued0->obs = "Sin Observacion";
                $valued0->save();

                $valued0 = new EstudioPacienteValor();
                $valued0->estudios_pacientes_id = $serio->id;
                $valued0->campos_base_id = 99;
                $valued0->valor = $import->LDL;
                $valued0->obs = "Sin Observacion";
                $valued0->save();

                $valued0 = new EstudioPacienteValor();
                $valued0->estudios_pacientes_id = $serio->id;
                $valued0->campos_base_id = 100;
                $valued0->valor = $import->TGL;
                $valued0->obs = "Sin Observacion";
                $valued0->save();

                $valued0 = new EstudioPacienteValor();
                $valued0->estudios_pacientes_id = $serio->id;
                $valued0->campos_base_id = 101;
                $valued0->valor = $import->GOT;
                $valued0->obs = "Sin Observacion";
                $valued0->save();

                $valued0 = new EstudioPacienteValor();
                $valued0->estudios_pacientes_id = $serio->id;
                $valued0->campos_base_id = 102;
                $valued0->valor = $import->GPT;
                $valued0->obs = "Sin Observacion";
                $valued0->save();

                $valued0 = new EstudioPacienteValor();
                $valued0->estudios_pacientes_id = $serio->id;
                $valued0->campos_base_id = 103;
                $valued0->valor = $import->ORINA;
                $valued0->obs = "Sin Observacion";
                $valued0->save();

                $valued0 = new EstudioPacienteValor();
                $valued0->estudios_pacientes_id = $serio->id;
                $valued0->campos_base_id = 104;
                $valued0->valor = $import->ORINAOBSER;
                $valued0->obs = "Sin Observacion";
                $valued0->save();

                $valued0 = new EstudioPacienteValor();
                $valued0->estudios_pacientes_id = $serio->id;
                $valued0->campos_base_id = 109;
                $valued0->valor = "0";
                $valued0->obs = "Sin valor registrado";
                $valued0->save();
                dump("Guardado");
               
            }
           
        }
        //dump($epi);
    }
    public function paciImport()
    {
        $pacientesImport = DB::select('select * from pacientes_defimport');
        $contador = 0;
        foreach ($pacientesImport as $import){
            $contador++;
            $paciente = new Paciente();
            //dump($import->HISTCLI);
            $paciente = $paciente->getPacienteByHistoryClinic($import->HISTCLI);
            if($import->HISTCLI != ''){
                 $epidemiImport = DB::select('select * from epidiom_import where HISTCLI= ' . $import->HISTCLI);
                 if(count($epidemiImport) != 0 && count($paciente) != 0){
                    //dump($epidemiImport);

                    $epidemiologia = new Epidemiologia();
                    $epidemiologia = $epidemiologia->getPacienteById($paciente[0]->id);
                   // dump($epidemiologia);
                }

                //$contador++;
                if (count($paciente) != 0){
                    $epidemiologia = new Epidemiologia();
                    $epidemiologia = $epidemiologia->getPacienteById($paciente[0]->id);
                    $epidemiImport = DB::select('select * from epidiom_import where HISTCLI = ' . $paciente[0]->id_hc);
                    if(count($epidemiologia) == 0 && count($epidemiImport) != 0 ){
                          //======================================================\\
                         // ~REGISTRO DE NUEVA EPIDEMIOLOGIA SI EL PACIENTE EXISTE~\\
                        //==========================================================\\
                        $nEpidiom = new Epidemiologia();
                        $nEpidiom->estado_civil = $epidemiImport[0]->ESTCIVIL;
                        $nEpidiom->sexo= $epidemiImport[0]->SEXO;
                        $nEpidiom->localidad_nac= $epidemiImport[0]->LOCNAC;
                        $nEpidiom->provincia_nac= $epidemiImport[0]->PROVNAC;
                        $nEpidiom->pais_nac= $epidemiImport[0]->PAISNAC;
                        $nEpidiom->lugar_nac_urbanizado= $epidemiImport[0]->URBANIZ;
                        $nEpidiom->tipo_vivienda_nac= $epidemiImport[0]->TIPOVIV;
                        $nEpidiom->anios_area_endemica= $epidemiImport[0]->EDADRESI;
                        $nEpidiom->tipo_residencia_ende= $epidemiImport[0]->TIPORESI;
                        $nEpidiom->volvio_area_ende= $epidemiImport[0]->VOLVIO;
                        $nEpidiom->volvio_reciente_ende= $epidemiImport[0]->RECIENT;
                        //$nEpidiom->volvio_reciente_ende_anos= $epidemiImport[0]->CUANVOLVIVIO;
                        $nEpidiom->fecha_cuando_volvio_ende= $epidemiImport[0]->CUANVOLVIO;
                        $nEpidiom->otras_areas_ende= $epidemiImport[0]->OTRASAREAS;
                        $nEpidiom->otras_areas_ende_lugar= $epidemiImport[0]->OTRASDONDE;
                        $nEpidiom->otras_areas_ende_tiempo= $epidemiImport[0]->OTRASTIEMP;
                        $nEpidiom->antefam_muerte_sub_no= $epidemiImport[0]->MSNO;
                        $nEpidiom->antefam_muerte_sub_ns= $epidemiImport[0]->MSNS;
                        $nEpidiom->antefam_muerte_sub_padre= $epidemiImport[0]->MSPADRE;
                        $nEpidiom->antefam_muerte_sub_madre= $epidemiImport[0]->MSPADRE;
                        $nEpidiom->antefam_muerte_sub_hermano= $epidemiImport[0]->MSPADRE;
                        $nEpidiom->antefam_muerte_sub_hijo= $epidemiImport[0]->MSHIJO;
                        $nEpidiom->antefam_muerte_sub_otros= $epidemiImport[0]->MSOTROS;
                        $nEpidiom->antefam_muerte_sub_desc= $epidemiImport[0]->MSDESC;
                        $nEpidiom->antefam_afcardi_no= $epidemiImport[0]->CARDNO;
                        $nEpidiom->antefam_afcardi_ns= $epidemiImport[0]->CARDNS;
                        $nEpidiom->antefam_afcardi_padre= $epidemiImport[0]->CARDPADRE;
                        $nEpidiom->antefam_afcardi_madre= $epidemiImport[0]->CARDMADRE;
                        $nEpidiom->antefam_afcardi_hermano= $epidemiImport[0]->CARDHERMA;
                        $nEpidiom->antefam_afcardi_hijo= $epidemiImport[0]->CARDHIJO;
                        $nEpidiom->antefam_afcardi_otros= $epidemiImport[0]->CARDOTROS;
                        $nEpidiom->antefam_afcardi_desc= $epidemiImport[0]->CARDDESC;

                        $nEpidiom->antefam_chagas_no= $epidemiImport[0]->CHANO;
                        $nEpidiom->antefam_chagas_ns= $epidemiImport[0]->CHANS;
                        $nEpidiom->antefam_chagas_padre= $epidemiImport[0]->CHAPADRE;
                        $nEpidiom->antefam_chagas_madre= $epidemiImport[0]->CHAMADRE;
                        $nEpidiom->antefam_chagas_hermano= $epidemiImport[0]->CHAHERMANO;
                        $nEpidiom->antefam_chagas_hijo= $epidemiImport[0]->CHAHIJO;
                        $nEpidiom->antefam_chagas_otros= $epidemiImport[0]->CHAOTROS;
                        $nEpidiom->antefam_chagas_desc= $epidemiImport[0]->CHADESC;
                        $nEpidiom->antefam_descrip= $epidemiImport[0]->FLIARRELAC;
                        $nEpidiom->embarazo= $epidemiImport[0]->EMBARAZO;
                        $nEpidiom->dador_sangre= $epidemiImport[0]->DADOR;
                        $nEpidiom->dador_sangre_cant= $epidemiImport[0]->NRODONSA;
                        $nEpidiom->dador_sangre_hosp= $epidemiImport[0]->HOSPITAL;
                        $nEpidiom->recep_sangre= $epidemiImport[0]->RECEPNRO;
                        $nEpidiom->recep_sangre_hosp= $epidemiImport[0]->HOSPRECS;
                        $nEpidiom->recep_sangre_motivo= $epidemiImport[0]->MOTRECEP;
                        $nEpidiom->conoce_vinchuca= $epidemiImport[0]->CONOCVIN;
                        $nEpidiom->puerta_entrada= $epidemiImport[0]->PUERTAEN;
                        $nEpidiom->sabe_chagasico= $epidemiImport[0]->SABECHAG;
                        $nEpidiom->motivo_det_chagas= $epidemiImport[0]->MOTSACHA;
                        $nEpidiom->fecha_det_chagas= $epidemiImport[0]->CUANSACH;
                        $nEpidiom->confirmacion_chagas= $epidemiImport[0]->CHAGAS;
                        $nEpidiom->conyuge= $epidemiImport[0]->CONYUGE;
                        $nEpidiom->cant_hijos= $epidemiImport[0]->NROHIJOS;
                        $nEpidiom->cant_pers_casa= $epidemiImport[0]->NROOTROS;
                        $nEpidiom->cant_habit_casa= $epidemiImport[0]->NROHABIT;
                        $nEpidiom->agua= $epidemiImport[0]->AGUA;
                        $nEpidiom->canieria= $epidemiImport[0]->CANERIA;
                        $nEpidiom->sanitario= $epidemiImport[0]->SANITARIO;
                        $nEpidiom->trabajo= $epidemiImport[0]->TRABAJO;
                        $nEpidiom->tipo_trabajo= $epidemiImport[0]->TIPTRACH;
                        $nEpidiom->rechazado_empleo_chagas= $epidemiImport[0]->RECHEMP;
                        $nEpidiom->nombre_empresa_rech= $epidemiImport[0]->NOMEMPRC;
                        $nEpidiom->obra_social= $epidemiImport[0]->OBRASOCH;
                        $nEpidiom->cant_conviv_trabajan= $epidemiImport[0]->FLIATRAB;
                        $nEpidiom->grados_aprobados= $epidemiImport[0]->GRADOAPROB;
                        $nEpidiom->escolaridad= $epidemiImport[0]->ESCOLAR;
                        $nEpidiom->id_paciente= $paciente[0]->id;
                        $nEpidiom->save();
                        dump("Guardado Epidiom" ."-".$contador);
                    }
                }elseif(count($paciente) == 0){
                    $nPaciente = new Paciente();
                    $epidemiImport = DB::select('select * from epidiom_import WHERE HISTCLI = ' . $import->HISTCLI);
                    if(Count($epidemiImport)!= 0){
                        $nPaciente->tipo_doc = $epidemiImport[0]->DOCNRO;
                        $nPaciente->numero_doc= $epidemiImport[0]->DOCTIPO;                         
                        $nPaciente->sexo= $epidemiImport[0]->SEXO;
                        $nPaciente->estado_civil= $epidemiImport[0]->ESTCIVIL;
                        //========================================\\
                        //~~TOMADO DE LA TABLA PACIENTE PRINCIPAL~~\\
                        //=========================================\\
                        $nPaciente->fecha_nac= $import->FECHANAC;
                        $nPaciente->fecha_alta= $import->FECHALTA;
                        $nPaciente->id_hc = $import->HISTCLI;
                        $nPaciente->apellido= $import->APELLIDO;
                        $nPaciente->nombre= $import->NOMBRE;                   
                        $nPaciente->citacion= $import->CITACION;
                        $nPaciente->proxima_cita= $import->FECHCITA;
                        $nPaciente->serologia_ing = $import->SEROING;
                        $nPaciente->cardio_isquemica_desc= $import->TITSERO;
                        $nPaciente->fecha_ini_trat_bnz= $import->FECHATEBNZ;
                        $nPaciente->trat_etio= $import->TE;
                        $nPaciente->titulos_sero_ing= $import->SEROING; 
                        $nPaciente->efect_otros_bnz<= $import->BENZOTROS;
                        $nPaciente->fecha_ini_trat_nifur<= $import->FECHATENIF;
                        $nPaciente->efect_otros_nifur<= $import->NIFOTROS;
                        $nPaciente->otras_pat_asoc= $import->OTRASPA;
                        $nPaciente->tension_art_bsist= $import->TABSIST;
                        $nPaciente->frec_cardi_basal= $import->FCBASAL;
                        $nPaciente->tipo_insuf_card= $import->TIPOIC;
                        $nPaciente->fecha_cambios_rxt= $import->FECHACRT;
                        $nPaciente->nueva_rxt= $import->NRT;
                        $nPaciente->grupo_clinico_ing= $import->GCLI;
                        $nPaciente->cambio_grupo_cli= $import->CGCL;
                        $nPaciente->fecha_cambio_gcli= $import->FECHACGCL;
                        $nPaciente->nuevo_grupo_cli= $import->NGCL;
                        if( $import->FECHULTCON != 17200614){
                            $nPaciente->fecha_ult_consulta= $import->FECHULTCON;
                        }                    
                        $nPaciente->vivo= $import->VIVO;
                        $nPaciente->causa_muerte= $import->CAUSAMUER;
                        $nPaciente->trat_sintomat= $import->TS;
                        $nPaciente->evolucion= $import->EVOLUCION;
                        $nPaciente->otros_sintomas_ing= $import->OTROSSIN;
                        $nPaciente->nuevos_sintomas= $import->NSI;
                        $nPaciente->obs_sintomas= $import->OBSERVSI;
                        $nPaciente->ecg= $import->ECG;
                        $nPaciente->tipo_ecg= $import->TIPOECG;
                        $nPaciente->nuevos_cambios_ecg= $import->NEC;
                        $nPaciente->fecha_cambios_ecg= $import->FECHANEC;
                        $nPaciente->obs_ecg= $import->OBSERVECG;
                        $nPaciente->fecha_rx_torax= $import->FECHART;
                        $nPaciente->rx_torax= $import->RT;
                        $nPaciente->indice_cardiotorax= $import->ICT;
                        $nPaciente->obs_rxt= $import->OBSERVRT;
                        $nPaciente->cambios_rxt= $import->CRT;
                        //==========================================\\
                        //~~VALORES CON DATOS EN VERDADERO Y FALSO~~\\
                        //===========================================\\  

                        $nPaciente->tres_negativas = $import->TRESNEG;                           
                        $nPaciente->trat_bnz= $import->BENZ;
                        $nPaciente->efectos_adv_bnz= $import->BENZEFADV;
                        $nPaciente->efec_rash_bnz= $import->BENZEFADV;
                        $nPaciente->efec_intgas_bnz= $import->BENZRASH;
                        $nPaciente->efec_afhep_bnz= $import->BENZINTGAS;
                        $nPaciente->efec_afneur_bnz= $import->BENZAFHEP;
                        $nPaciente->efec_afhem_bnz= $import->BENZAFNEUR;
                        $nPaciente->susp_bnz= $import->BENZSUSP;                   
                        $nPaciente->trat_nifur<= $import->NIFUR;                    
                        $nPaciente->efectos_adv_nifur<= $import->NIFUREFADV;
                        $nPaciente->efect_rash_nifur<= $import->NIFRASH;
                        $nPaciente->efect_intgas_nifur<= $import->NIFINTGAS;
                        $nPaciente->efect_afhep_nifur<= $import->NIFAFHEP;
                        $nPaciente->efect_afneur_nifur<= $import->NIFAFNEUR;
                        $nPaciente->efect_afhem_nifur<= $import->NIFAFHEM;                   
                        $nPaciente->susp_nifur = $import->NIFSUSP;
                        $nPaciente->otros_trat= $import->OTROSTE;
                        $nPaciente->trat_etio_obs= $import->OBSERVTE;
                        $nPaciente->sin_patologia= $import->SINPA;
                        $nPaciente->tuberculosis= $import->TBC;
                        $nPaciente->epoc= $import->EPOC;
                        $nPaciente->dbt= $import->DBT;
                        $nPaciente->colageno= $import->COLAGENO;
                        $nPaciente->obesidad= $import->OBESIDAD;
                        $nPaciente->alcoholismo= $import->ALCOHOL;
                        $nPaciente->hipotiroidismo= $import->HIPOTIR;
                        $nPaciente->hipertiroidismo= $import->HIPERTIR;
                        $nPaciente->cardio_congenitas= $import->CARDCONG;
                        $nPaciente->valvulopatias= $import->VALVULAR;
                        $nPaciente->cardio_isquemica= $import->CARDISQ;
                        $nPaciente->ht_arterial_leve= $import->HTAL;
                        $nPaciente->ht_arterial_mode= $import->HTAM;
                        $nPaciente->ht_arterial_severa= $import->HTAS;
                        $nPaciente->acv= $import->ACV;               
                        $nPaciente->asintomatico= $import->ASINTOMA;
                        $nPaciente->palpitaciones= $import->PALPITACIO;
                        $nPaciente->precordialgia_atipica= $import->PRECORATIP;
                        $nPaciente->angor= $import->ANGOR;
                        $nPaciente->disnea= $import->DISNEA;
                        $nPaciente->disnea1= $import->DISNEA1;
                        $nPaciente->disnea2= $import->DISNEA2;
                        $nPaciente->disnea3= $import->DISNEA3;
                        $nPaciente->disnea4= $import->DISNEA4;
                        $nPaciente->mareos= $import->MAREOS;
                        $nPaciente->perdida_conoc= $import->PC;
                        $nPaciente->insuf_cardiaca= $import->IC;

                        $nPaciente->save();
                        dump("Guardado Paciente" ."-".$contador);
                        //========================================================\\
                        //~~~~~~~~~~~~~~~REGISTRO DE EPIDEMIOLOGIA~~~~~~~~~~~~~~~~\\
                        //========================================================\\
                        $nEpidiom = new Epidemiologia();
                        $nEpidiom->estado_civil = $epidemiImport[0]->ESTCIVIL;
                        $nEpidiom->sexo= $epidemiImport[0]->SEXO;
                        $nEpidiom->localidad_nac= $epidemiImport[0]->LOCNAC;
                        $nEpidiom->provincia_nac= $epidemiImport[0]->PROVNAC;
                        $nEpidiom->pais_nac= $epidemiImport[0]->PAISNAC;
                        $nEpidiom->lugar_nac_urbanizado= $epidemiImport[0]->URBANIZ;
                        $nEpidiom->tipo_vivienda_nac= $epidemiImport[0]->TIPOVIV;
                        $nEpidiom->anios_area_endemica= $epidemiImport[0]->EDADRESI;
                        $nEpidiom->tipo_residencia_ende= $epidemiImport[0]->TIPORESI;
                        $nEpidiom->volvio_area_ende= $epidemiImport[0]->VOLVIO;
                        $nEpidiom->volvio_reciente_ende= $epidemiImport[0]->RECIENT;
                        //$nEpidiom->volvio_reciente_ende_anos= $epidemiImport[0]->CUANVOLVIVIO;
                        $nEpidiom->fecha_cuando_volvio_ende= $epidemiImport[0]->CUANVOLVIO;
                        $nEpidiom->otras_areas_ende= $epidemiImport[0]->OTRASAREAS;
                        $nEpidiom->otras_areas_ende_lugar= $epidemiImport[0]->OTRASDONDE;
                        $nEpidiom->otras_areas_ende_tiempo= $epidemiImport[0]->OTRASTIEMP;
                        $nEpidiom->antefam_muerte_sub_no= $epidemiImport[0]->MSNO;
                        $nEpidiom->antefam_muerte_sub_ns= $epidemiImport[0]->MSNS;
                        $nEpidiom->antefam_muerte_sub_padre= $epidemiImport[0]->MSPADRE;
                        $nEpidiom->antefam_muerte_sub_madre= $epidemiImport[0]->MSPADRE;
                        $nEpidiom->antefam_muerte_sub_hermano= $epidemiImport[0]->MSPADRE;
                        $nEpidiom->antefam_muerte_sub_hijo= $epidemiImport[0]->MSHIJO;
                        $nEpidiom->antefam_muerte_sub_otros= $epidemiImport[0]->MSOTROS;
                        $nEpidiom->antefam_muerte_sub_desc= $epidemiImport[0]->MSDESC;
                        $nEpidiom->antefam_afcardi_no= $epidemiImport[0]->CARDNO;
                        $nEpidiom->antefam_afcardi_ns= $epidemiImport[0]->CARDNS;
                        $nEpidiom->antefam_afcardi_padre= $epidemiImport[0]->CARDPADRE;
                        $nEpidiom->antefam_afcardi_madre= $epidemiImport[0]->CARDMADRE;
                        $nEpidiom->antefam_afcardi_hermano= $epidemiImport[0]->CARDHERMA;
                        $nEpidiom->antefam_afcardi_hijo= $epidemiImport[0]->CARDHIJO;
                        $nEpidiom->antefam_afcardi_otros= $epidemiImport[0]->CARDOTROS;
                        $nEpidiom->antefam_afcardi_desc= $epidemiImport[0]->CARDDESC;

                        $nEpidiom->antefam_chagas_no= $epidemiImport[0]->CHANO;
                        $nEpidiom->antefam_chagas_ns= $epidemiImport[0]->CHANS;
                        $nEpidiom->antefam_chagas_padre= $epidemiImport[0]->CHAPADRE;
                        $nEpidiom->antefam_chagas_madre= $epidemiImport[0]->CHAMADRE;
                        $nEpidiom->antefam_chagas_hermano= $epidemiImport[0]->CHAHERMANO;
                        $nEpidiom->antefam_chagas_hijo= $epidemiImport[0]->CHAHIJO;
                        $nEpidiom->antefam_chagas_otros= $epidemiImport[0]->CHAOTROS;
                        $nEpidiom->antefam_chagas_desc= $epidemiImport[0]->CHADESC;
                        $nEpidiom->antefam_descrip= $epidemiImport[0]->FLIARRELAC;
                        $nEpidiom->embarazo= $epidemiImport[0]->EMBARAZO;
                        $nEpidiom->dador_sangre= $epidemiImport[0]->DADOR;
                        $nEpidiom->dador_sangre_cant= $epidemiImport[0]->NRODONSA;
                        $nEpidiom->dador_sangre_hosp= $epidemiImport[0]->HOSPITAL;
                        $nEpidiom->recep_sangre= $epidemiImport[0]->RECEPNRO;
                        $nEpidiom->recep_sangre_hosp= $epidemiImport[0]->HOSPRECS;
                        $nEpidiom->recep_sangre_motivo= $epidemiImport[0]->MOTRECEP;
                        $nEpidiom->conoce_vinchuca= $epidemiImport[0]->CONOCVIN;
                        $nEpidiom->puerta_entrada= $epidemiImport[0]->PUERTAEN;
                        $nEpidiom->sabe_chagasico= $epidemiImport[0]->SABECHAG;
                        $nEpidiom->motivo_det_chagas= $epidemiImport[0]->MOTSACHA;
                        $nEpidiom->fecha_det_chagas= $epidemiImport[0]->CUANSACH;
                        $nEpidiom->confirmacion_chagas= $epidemiImport[0]->CHAGAS;
                        $nEpidiom->conyuge= $epidemiImport[0]->CONYUGE;
                        $nEpidiom->cant_hijos= $epidemiImport[0]->NROHIJOS;
                        $nEpidiom->cant_pers_casa= $epidemiImport[0]->NROOTROS;
                        $nEpidiom->cant_habit_casa= $epidemiImport[0]->NROHABIT;
                        $nEpidiom->agua= $epidemiImport[0]->AGUA;
                        $nEpidiom->canieria= $epidemiImport[0]->CANERIA;
                        $nEpidiom->sanitario= $epidemiImport[0]->SANITARIO;
                        $nEpidiom->trabajo= $epidemiImport[0]->TRABAJO;
                        $nEpidiom->tipo_trabajo= $epidemiImport[0]->TIPTRACH;
                        $nEpidiom->rechazado_empleo_chagas= $epidemiImport[0]->RECHEMP;
                        $nEpidiom->nombre_empresa_rech= $epidemiImport[0]->NOMEMPRC;
                        $nEpidiom->obra_social= $epidemiImport[0]->OBRASOCH;
                        $nEpidiom->cant_conviv_trabajan= $epidemiImport[0]->FLIATRAB;
                        $nEpidiom->grados_aprobados= $epidemiImport[0]->GRADOAPROB;
                        $nEpidiom->escolaridad= $epidemiImport[0]->ESCOLAR;
                        $nEpidiom->id_paciente= $nPaciente->id;
                        $nEpidiom->save(); 
                       dump("Guardado Epidio" ."-".$contador);
                    }          
                }
                $deleted = DB::delete('delete from  pacientes_defimport where id = '. $import->id);
                dump($contador);
            }     
        }
    }
    public function ergoImport()
    {
        $ergometria = DB::select('select * from peg_import');
        $count = 0;
        foreach ($ergometria as $import){
            $estudio = new EstudioPaciente();
            $paciente = new Paciente();
            $paciente = $paciente->getPacienteByHistoryClinic($import->HISTCLI);
            
            if(count($paciente)!= 0){
                
                $estudio->id_hc = $paciente[0]->id;
                $estudio->id_estudio =  2;
                if($import->FECHA != 0 && $import->FECHA != 1){
                    $estudio->fecha = $import->FECHA;
                }
                
                $estudio->titulo = $import->NROPEG;
                $estudio->save();
                
                $valores = new EstudioPacienteValor();
                $valores->valor = $import->PEG ;
                $valores->estudios_pacientes_id = $estudio->id;
                $valores->campos_base_id = 31;
                $valores->save();
                
                $valores = new EstudioPacienteValor();
                $valores->valor = $import->FC100 ;
                $valores->estudios_pacientes_id = $estudio->id;
                $valores->campos_base_id = 32;
                $valores->save();
                
                $valores = new EstudioPacienteValor();
                $valores->valor = $import->FC85 ;
                $valores->estudios_pacientes_id = $estudio->id;
                $valores->campos_base_id = 33;
                $valores->save();
                
                $valores = new EstudioPacienteValor();
                $valores->valor = $import->FCBASAL ;
                $valores->estudios_pacientes_id = $estudio->id;
                $valores->campos_base_id = 34;
                $valores->save();
                
                $valores = new EstudioPacienteValor();
                $valores->valor = $import->FCFINAL ;
                $valores->estudios_pacientes_id = $estudio->id;
                $valores->campos_base_id = 35;
                $valores->save();
                
                $valores = new EstudioPacienteValor();
                $valores->valor = $import->TABSIST ;
                $valores->estudios_pacientes_id = $estudio->id;
                $valores->campos_base_id = 36;
                $valores->save();
                
                $valores = new EstudioPacienteValor();
                $valores->valor = $import->TABDIAST ;
                $valores->estudios_pacientes_id = $estudio->id;
                $valores->campos_base_id = 37;
                $valores->save();
                
                $valores = new EstudioPacienteValor();
                $valores->valor = $import->TAFSIST ;
                $valores->estudios_pacientes_id = $estudio->id;
                $valores->campos_base_id = 38;
                $valores->save();
                //---------------------------------------------
                $valores = new EstudioPacienteValor();
                $valores->valor = $import->TAFDIAST ;
                $valores->estudios_pacientes_id = $estudio->id;
                $valores->campos_base_id = 39;
                $valores->save();
                //-----------------------------------------
                $valores = new EstudioPacienteValor();
                $valores->valor = $import->ITTBASAL ;
                $valores->estudios_pacientes_id = $estudio->id;
                $valores->campos_base_id = 40;
                $valores->save();
                
                $valores = new EstudioPacienteValor();
                $valores->valor = $import->ITTMAX ;
                $valores->estudios_pacientes_id = $estudio->id;
                $valores->campos_base_id = 41;
                $valores->save();
                
                $valores = new EstudioPacienteValor();
                $valores->valor = $import->CARGAKGM ;
                $valores->estudios_pacientes_id = $estudio->id;
                $valores->campos_base_id = 42;
                $valores->save();
                
                $valores = new EstudioPacienteValor();
                $valores->valor = $import->CARGAMETS ;
                $valores->estudios_pacientes_id = $estudio->id;
                $valores->campos_base_id = 43;
                $valores->save();
                
                $valores = new EstudioPacienteValor();
                $valores->valor = $import->ANORCRON;
                $valores->estudios_pacientes_id = $estudio->id;
                $valores->campos_base_id = 44;
                $valores->save();
                
                $valores = new EstudioPacienteValor();
                $valores->valor = $import->ANORTA;
                $valores->estudios_pacientes_id = $estudio->id;
                $valores->campos_base_id = 45;
                $valores->save();
                
                $valores = new EstudioPacienteValor();
                $valores->valor = $import->ANORARR;
                $valores->estudios_pacientes_id = $estudio->id;
                $valores->campos_base_id = 46;
                $valores->save();
                
                $valores = new EstudioPacienteValor();
                $valores->valor = $import->ANORANGOR;
                $valores->estudios_pacientes_id = $estudio->id;
                $valores->campos_base_id = 47;
                $valores->save();
                
                $valores = new EstudioPacienteValor();
                $valores->valor = $import->ANORST;
                $valores->estudios_pacientes_id = $estudio->id;
                $valores->campos_base_id = 48;
                $valores->save();
                
                $valores = new EstudioPacienteValor();
                $valores->valor = $import->ANORSINT;
                $valores->estudios_pacientes_id = $estudio->id;
                $valores->campos_base_id = 49;
                $valores->save();
                
                $valores = new EstudioPacienteValor();
                $valores->valor = $import->TIPOSINT;
                $valores->estudios_pacientes_id = $estudio->id;
                $valores->campos_base_id = 50;
                $valores->save();
                
                $valores = new EstudioPacienteValor();
                $valores->valor = $import->HTASIST;
                $valores->estudios_pacientes_id = $estudio->id;
                $valores->campos_base_id = 51;
                $valores->save();
                
                $valores = new EstudioPacienteValor();
                $valores->valor = $import->HTADIAST;
                $valores->estudios_pacientes_id = $estudio->id;
                $valores->campos_base_id = 52;
                $valores->save();
                
                $valores = new EstudioPacienteValor();
                $valores->valor = $import->CAIDATA;
                $valores->estudios_pacientes_id = $estudio->id;
                $valores->campos_base_id = 53;
                $valores->save();
                
                $valores = new EstudioPacienteValor();
                $valores->valor = $import->TAPLANA;
                $valores->estudios_pacientes_id = $estudio->id;
                $valores->campos_base_id = 54;
                $valores->save();
                
                $valores = new EstudioPacienteValor();
                $valores->valor = $import->ARRAURIC;
                $valores->estudios_pacientes_id = $estudio->id;
                $valores->campos_base_id = 55;
                $valores->save();
                
                $valores = new EstudioPacienteValor();
                $valores->valor = $import->AABASAL;
                $valores->estudios_pacientes_id = $estudio->id;
                $valores->campos_base_id = 56;
                $valores->save();
                
                $valores = new EstudioPacienteValor();
                $valores->valor = $import->TIPOAABAS;
                $valores->estudios_pacientes_id = $estudio->id;
                $valores->campos_base_id = 57;
                $valores->save();
                
                $valores = new EstudioPacienteValor();
                $valores->valor = $import->AAESF;
                $valores->estudios_pacientes_id = $estudio->id;
                $valores->campos_base_id = 58;
                $valores->save();
                
                $valores = new EstudioPacienteValor();
                $valores->valor = $import->TIPOAAESF;
                $valores->estudios_pacientes_id = $estudio->id;
                $valores->campos_base_id = 59;
                $valores->save();
                
                $valores = new EstudioPacienteValor();
                $valores->valor = $import->AAREC;
                $valores->estudios_pacientes_id = $estudio->id;
                $valores->campos_base_id = 60;
                $valores->save();
                
                $valores = new EstudioPacienteValor();
                $valores->valor = $import->TIPOAAREC;
                $valores->estudios_pacientes_id = $estudio->id;
                $valores->campos_base_id = 61;
                $valores->save();
                
                $valores = new EstudioPacienteValor();
                $valores->valor = $import->ARRVENTR;
                $valores->estudios_pacientes_id = $estudio->id;
                $valores->campos_base_id = 62;
                $valores->save();
                
                $valores = new EstudioPacienteValor();
                $valores->valor = $import->AVBASAL;
                $valores->estudios_pacientes_id = $estudio->id;
                $valores->campos_base_id = 63;
                $valores->save();
                
                $valores = new EstudioPacienteValor();
                $valores->valor = $import->TIPOAVBAS;
                $valores->estudios_pacientes_id = $estudio->id;
                $valores->campos_base_id = 64;
                $valores->save();
                
                $valores = new EstudioPacienteValor();
                $valores->valor = $import->AVESF;
                $valores->estudios_pacientes_id = $estudio->id;
                $valores->campos_base_id = 65;
                $valores->save();
                
                $valores = new EstudioPacienteValor();
                $valores->valor = $import->TIPOAVESF;
                $valores->estudios_pacientes_id = $estudio->id;
                $valores->campos_base_id = 66;
                $valores->save();
                
                $valores = new EstudioPacienteValor();
                $valores->valor = $import->AVREC;
                $valores->estudios_pacientes_id = $estudio->id;
                $valores->campos_base_id = 67;
                $valores->save();
                
                $valores = new EstudioPacienteValor();
                $valores->valor = $import->TIPOAVREC;
                $valores->estudios_pacientes_id = $estudio->id;
                $valores->campos_base_id = 68;
                $valores->save();
                
                $valores = new EstudioPacienteValor();
                $valores->valor = $import->SUSPPROT;
                $valores->estudios_pacientes_id = $estudio->id;
                $valores->campos_base_id = 69;
                $valores->save();
                
                $valores = new EstudioPacienteValor();
                $valores->valor = $import->SUSPAM;
                $valores->estudios_pacientes_id = $estudio->id;
                $valores->campos_base_id = 70;
                $valores->save();
                
                $valores = new EstudioPacienteValor();
                $valores->valor = $import->SUSPARR;
                $valores->estudios_pacientes_id = $estudio->id;
                $valores->campos_base_id = 71;
                $valores->save();

                $valores = new EstudioPacienteValor();
                $valores->valor = $import->SUSPSINT;
                $valores->estudios_pacientes_id = $estudio->id;
                $valores->campos_base_id = 72;
                $valores->save();
               
                $valores = new EstudioPacienteValor();
                $valores->valor = $import->SUSPSINT;
                $valores->estudios_pacientes_id = $estudio->id;
                $valores->campos_base_id = 73;
                $valores->save();
               
                $valores = new EstudioPacienteValor();
                $valores->valor = $import->SUSPCRON;
                $valores->estudios_pacientes_id = $estudio->id;
                $valores->campos_base_id = 74;
                $valores->save();
               
                $valores = new EstudioPacienteValor();
                $valores->valor = $import->MEDICACION;
                $valores->estudios_pacientes_id = $estudio->id;
                $valores->campos_base_id = 75;
                $valores->save();
               
                $valores = new EstudioPacienteValor();
                $valores->valor = $import->TIPOMEDIC;
                $valores->estudios_pacientes_id = $estudio->id;
                $valores->campos_base_id = 76;
                $valores->save();
                
                $valores = new EstudioPacienteValor();
                $valores->valor = $import->OTROS;
                $valores->estudios_pacientes_id = $estudio->id;
                $valores->campos_base_id = 77;
                $valores->save();
                dump($count);
                $count++;
                $ergometria = DB::delete('delete from peg_import where ID = '. $import->ID);
            }        
            
            DB::Delete('delete from peg_import where ID = '. $import->ID);
            dump("Eliminado de tabla temporal");
            dump("ESTUDIO GUARDADO");
        }
    }
    public function ecoImport()
    {
        $ecocardiograma = DB::select('select * from ecocard_import');
        $contador = 0;
        foreach ($ecocardiograma as $import){
            $paciente = new Paciente();
            $paciente = $paciente->getPacienteByHistoryClinic($import->id_hc);
            //dump($paciente);
            if(count($paciente) !=  0 && $import->id_hc != 0){
               
                $colDate = "COL 4";
                $estudio = new EstudioPaciente();
                $estudio->id_hc = $paciente[0]->id;
                if($import->$colDate != 'N' &&  $import->$colDate != 'd'){
                     $estudio->fecha = $import->$colDate;
                } 
                $estudio->titulo = "ECO";
                $estudio->id_estudio = 1;
                $estudio->save();
                dump("==========================");
                dump("~~~~~ESTUDIO GUARDADO~~~~~");
                dump("==========================");
                $colValue = 5;
                $const = "COL ";
                for ($i = 1; $i <= 30; $i++) {
                    $valores = new EstudioPacienteValor();
                    $col = $const . $colValue;
                    $valores->valor = $import->$col ;
                    $valores->estudios_pacientes_id = $estudio->id;
                    $valores->campos_base_id = $i;
                    $valores->save();
                   // dump("valor guardado");
                    $colValue++;
                }
            }
            $contador++;
            dump($contador);
            DB::delete('delete from ecocard_import where id = ' . $import->id);
        }
    }
    public function tratImport()
    {
        $tratImport = DB::select('select * from trat_importdef2');
        $contador = 0;
        foreach ($tratImport as $import){
            if($import->COL_2 != ""){
                $paciente = new Paciente();      
                $paciente =  $paciente->getPacienteByHistoryClinic($import->COL_1);
               
                
                
               // if (count($verif) == 0){
                    
                    if(count($paciente) != 0){
                        $tratamiento = new Tratamiento();
                        //dump($import->COL_2);
                        $tratamiento->fecha_trat = $import->COL_2;
                        $tratamiento->droga = $import->COL_3;
                        $tratamiento->dosis = $import->COL_4;
                        $tratamiento->flia_droga =  $import->COL_5;
                        $tratamiento->id_hc = $paciente[0]->id_hc;
                        $tratamiento->obs_trat = $import->COL_6 ;
                        $tratamiento->id_paciente = $paciente[0]->id;
                        //$tratamiento->save     
                        //dump("guardado");
                        //dump($tratamiento->fecha_trat);
                        $verif = new Tratamiento();
                        $verif = $verif->getTratamientoImporter($paciente[0]->id_hc, $tratamiento->fecha_trat, $import->COL_3);
                        if(count($verif) == 0){
                            $tratamiento->save();
                            dump($contador . "-Guardado");
                        }
                        DB::delete('delete from trat_importdef2 where id = '. $import->ID);
                        $contador++; 
                    }        
                //}                
            }         
        }
    }
}
