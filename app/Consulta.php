<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Consulta extends Model
{

    protected $table = 'item_hcs';

    protected $fillable = [
                'id_sede',
                'id_usuario',
                'id_paciente',
                'titulo',
                'fecha',
                'descripcion',
                'proxima_cita',
                'frecuencia_cardiaca',
                'presion_sistolica',
                'presion_diastolica',
            ];

    public function paciente()
    {
        return $this->hasOne('App\Paciente', 'id', 'id_paciente');
    }

    public function medico()
    {
        return $this->belongsTo('App\User', 'id_usuario', 'id');
    }

    public function sede()
    {
        return $this->belongsTo('App\Sede', 'id_sede', 'id');
    }

    public function sintomas()
    {
        return $this->belongsToMany('App\Sintoma', 'consultas_sintomas')->withPivot('consulta_id', 'sintoma_id');

    }

    public function patologias()
    {
        return $this->belongsToMany('App\Patologia', 'consultas_patologias')->withPivot('consulta_id', 'patologia_id');

    }

    public function saveSintomas($sintomas = [])
    {
        if(!empty($sintomas))
        {
            $this->sintomas()->sync($sintomas);
        } else {
            $this->sintomas()->detach();
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

    public function getProximaCitaAttribute($value)
    {
        return in_array($value, array('0000-00-00', null)) ? null : Carbon::parse($value);
    }

}
