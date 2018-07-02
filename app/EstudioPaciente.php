<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class EstudioPaciente extends Model
{
    //
    protected $fillable = ['id_hc',
        'id_estudio',
        'fecha',
        'titulo',
        'descripcion',
    ];

    protected $table = 'estudios_pacientes';


    public function valores()
    {
        return $this->hasMany('App\EstudioPacienteValor', 'estudios_pacientes_id');
    }

    public function imagenes()
    {
        return $this->hasMany('App\ImagenEstudio', 'id_estudio');
    }

    public function estudio()
    {
        return $this->hasOne('App\Estudio', 'id', 'id_estudio');
    }

    public function paciente()
    {
        return $this->hasOne('App\Paciente', 'id_hc');
    }

    public function setFechaAttribute($value)
    {
        
        if ($value) {
            $this->attributes['fecha'] = Carbon::createFromFormat('d/m/Y', trim($value))->format('Y-m-d');
        } else {
            $this->attributes['fecha'] = null;
        }
    }

    public function getFechaAttribute($value)
    {
        return  in_array($value, array('0000-00-00', null)) ? null : Carbon::parse($value);
    }
    public function verifExist($date, $idHc, $study)
    {
       
        $query = $this->where('fecha', $date)
                    ->where('id_hc', $idHc)
                    ->where('id_estudio', $study)
                    ->get();
        
        if(count($query) == 0){
            return true;
        }else{
            return false;
        }
    }  
}