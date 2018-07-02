<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Mockery\CountValidator\Exception;

class Paciente extends Model
{
    //protected $dateFormat = 'Y-m-d';

    protected $casts = ['id_hc' => 'integer'];

    protected $dates = ['fecha_nac',
                        'fecha_alta',
                        'proxima_cita',
                        'fecha_ini_trat_bnz',
                        'fecha_ini_trat_nifur',
                        'fecha_cambios_ecg',
                        'fecha_rx_torax',
                        'fecha_cambios_rxt',
                        'fecha_cambio_gcli',
                        'fecha_ult_consulta',
                        ];
    //Campos completables
    protected $fillable = [
    			'tipo_doc',
                'numero_doc',
                'apellido',
                'nombre',
                'fecha_nac',
                'fecha_alta',
                'sexo',
                'estado_civil',
                'citacion',
                'proxima_cita',
                'serologia_ing',
                'tres_negativas',
                'cardio_isquemica_desc',
                'titulos_sero_ing',
                'trat_etio',
                'fecha_ini_trat_bnz',
                'trat_bnz',
                'efectos_adv_bnz',
                'efec_rash_bnz',
                'efec_intgas_bnz',
                'efec_afhep_bnz',
                'efec_afneur_bnz',
                'efec_afhem_bnz',
                'susp_bnz',
                'efec_otros_bnz',
                'trat_nifur',
                'fecha_ini_trat_nifur',
                'efectos_adv_nifur',
                'efec_rash_nifur',
                'efec_intgas_nifur',
                'efec_afhep_nifur',
                'efec_afneur_nifur',
                'efec_afhem_nifur',
                'efec_otros_nifur',
                'susp_nifur',
                'otros_trat',
                'trat_etio_obs',
                'sin_patologia',
                'tuberculosis',
                'epoc',
                'dbt',
                'colageno',
                'obesidad',
                'alcoholismo',
                'hipotiroidismo',
                'hipertiroidismo',
                'cardio_congenitas',
                'valvulopatias',
                'cardio_isquemica',
                'ht_arterial_leve',
                'ht_arterial_mode',
                'ht_arterial_severa',
                'acv',
                'otras_pat_asoc',
                'tension_art_bsist',
                'tension_art_bdiast',
                'frec_cardi_basal',
                'asintomatico',
                'palpitaciones',
                'precordialgia_atipica',
                'angor',
                'disnea',
                'disnea1',
                'disnea2',
                'disnea3',
                'disnea4',
                'mareos',
                'perdida_conoc',
                'insuf_cardiaca',
                'tipo_insuf_card',
                'otros_sintomas_ing',
                'nuevos_sintomas',
                'obs_sintomas',
                'ecg',
                'tipo_ecg',
                'nuevos_cambios_ecg',
                'fecha_cambios_ecg',
                'tipo_cambio_ecg',
                'obs_ecg',
                'fecha_rx_torax',
                'rx_torax',
                'indice_cardiotorax',
                'obs_rxt',
                'cambios_rxt',
                'fecha_cambios_rxt',
                'nueva_rxt',
                'grupo_clinico_ing',
                'cambio_grupo_cli',
                'fecha_cambio_gcli',
                'nuevo_grupo_cli',
                'fecha_ult_consulta',
                'vivo',
                'causa_muerte',
                'trat_sintomat',
                'evolucion',
            		];

//    public function users()
 //   {
 //   	return $this->belongsToMany('App\User', 'paciente_user')->withPivot('user_id', 'paciente_id');
 //   }

   

    public function consultas()
    {
        return $this->hasMany('App\Consulta', 'id_paciente', 'id');
    }

    public function tratamientos()
    {   
        return $this->hasMany('App\Tratamiento', 'id_paciente', 'id');
    }

    public function estudioPacientes()
    {   
        return $this->hasMany('App\EstudioPaciente', 'id_hc', 'id');
    }

    public function epidemiologia()
    {
        return $this->hasOne('App\Epidemiologia', 'id_paciente', 'id');
    }

    public function direcciones()
    {
        return $this->hasMany('App\Direccion', 'id_paciente', 'id');
    }

    public function telefonos()
    {
        return $this->hasMany('App\Telefono', 'id_paciente', 'id');
    }


    /*    public function setidHcAttribute($value)
        {
            if (is_numeric($value)) {
                $this->attributes['id_hc'] = $value;
            } else {
                throw new Exception('El valor ' . $value . 'no es numerico. No se puede asignar a pacientes.id_hc');
            }
        }*/
/*
    public function setFechaNacAttribute($value)
    {
        if ($value) {
            $this->attributes['fecha_nac'] = Carbon::createFromFormat('d/m/Y', trim($value))->format('Y-m-d');
        } else {
            $this->attributes['fecha_nac'] = null;
        }
    }

    public function setFechaAltaAttribute($value)
    {
        if ($value) {
            $this->attributes['fecha_alta'] = Carbon::createFromFormat('d/m/Y', trim($value))->format('Y-m-d');
        } else {
            $this->attributes['fecha_alta'] = null;
        }
    }

    public function setFechaUltConsultaAttribute($value)
    {
        if ($value) {
            $this->attributes['fecha_ult_consulta'] = Carbon::createFromFormat('d/m/Y', trim($value))->format('Y-m-d');
        } else {
            $this->attributes['fecha_ult_consulta'] = null;
        }
    }

    public function setFechaCambioGcliAttribute($value)
    {
        if ($value) {
            $this->attributes['fecha_cambio_gcli'] = Carbon::createFromFormat('d/m/Y', trim($value))->format('Y-m-d');
        } else {
            $this->attributes['fecha_cambio_gcli'] = null;
        }
    }

    public function setProximaCitaAttribute($value)
    {
        if ($value) {
            $this->attributes['proxima_cita'] = Carbon::createFromFormat('d/m/Y', trim($value))->format('Y-m-d');
        } else {
            $this->attributes['proxima_cita'] = null;
        }

    }

    public function setFechaCambiosEcgAttribute($value)
    {
        if ($value) {
            $this->attributes['fecha_cambios_ecg'] = Carbon::createFromFormat('d/m/Y',trim($value))->format('Y-m-d');
        } else {
            $this->attributes['fecha_cambios_ecg'] = null;
        }
    }

    public function setFechaIniTratBnzAttribute($value)
    {
        if ($value) {
            $this->attributes['fecha_ini_trat_bnz'] = Carbon::createFromFormat('d/m/Y',trim($value))->format('Y-m-d');
        } else {
            $this->attributes['fecha_ini_trat_bnz'] = null;
        }
    }

    public function setFechaIniTratNifurAttribute($value)
    {
        if ($value) {
            $this->attributes['fecha_ini_trat_nifur'] = Carbon::createFromFormat('d/m/Y',trim($value))->format('Y-m-d');
        } else {
            $this->attributes['fecha_ini_trat_nifur'] = null;
        }
    }

    public function setFechaRxToraxAttribute($value)
    {
        if ($value) {
            $this->attributes['fecha_rx_torax'] = Carbon::createFromFormat('d/m/Y',trim($value))->format('Y-m-d');
        } else {
            $this->attributes['fecha_rx_torax'] = null;
        }
    }

    public function setFechaCambiosRxtAttribute($value)
    {
        if ($value) {
            $this->attributes['fecha_cambios_rxt'] = Carbon::createFromFormat('d/m/Y',trim($value))->format('Y-m-d');
        } else {
            $this->attributes['fecha_cambios_rxt'] = null;
        }
    }
*/
    public function getNombreAttribute($value)
    {
        return ucwords(mb_strtolower($value));
    }

    public function getApellidoAttribute($value)
    {
        return ucwords(mb_strtolower($value));
    }

    public function getProximaCitaAttribute($value)
    {
        return  in_array($value, array('0000-00-00', null)) ? null : Carbon::parse($value);
    }

    public function getFechaIniTratNifurAttribute($value)
    {
        return  in_array($value, array('0000-00-00', null)) ? null : Carbon::parse($value);
    }

    public function getFechaCambiosRxtAttribute($value)
    {
        return in_array($value, array('0000-00-00', null)) ? null : Carbon::parse($value);
    }

    public function getFechaAltaAttribute($value)
    {
        return in_array($value, array('0000-00-00', null)) ? null : Carbon::parse($value);
    }

    public function getFechaIniTratBnzAttribute($value)
    {
        return in_array($value, array('0000-00-00', null)) ? null : Carbon::parse($value);
    }

    public function getFechaCambiosEcgAttribute($value)
    {
        return in_array($value, array('0000-00-00', null)) ? null : Carbon::parse($value);
    }

    public function getFechaRxToraxAttribute($value)
    {
        return in_array($value, array('0000-00-00', null)) ? null : Carbon::parse($value);
    }

    public function getFechaNacAttribute($value)
    {
        return in_array($value, array('0000-00-00', null)) ? null : Carbon::parse($value);
    }

    public function getFechaUltConsultaAttribute($value)
    {
        return in_array($value, array('0000-00-00', null)) ? null : Carbon::parse($value);
    }

    public function getFechaCambioGcliAttribute($value)
    {
        return in_array($value, array('0000-00-00', null)) ? null : Carbon::parse($value);
    }
    public function getPacienteByHistoryClinic($idHist)
    {
        return $this->where('id_hc', $idHist)->get();
    }
    //  public function saveMedico($user)
    // {
    //     if(!empty($user))
    //     {
    //         $this->users()->sync($user);
    //     } else {
    //         $this->users()->detach();
    //     }
    // }
}
