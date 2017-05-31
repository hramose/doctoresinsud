<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Epidemiologia extends Model
{
    //
    protected $dates = [
        'fecha_cuando_volvio_ende',
        'fecha_det_chagas',
    ];

    protected $guarded = [
        'id',
        'id_paciente',
    ];

    public function paciente()
    {
        return $this->hasOne('App\Paciente', 'id', 'id_paciente');
    }

    public function setFechaDetChagasAttribute($value)
    {
        if ($value) {
            $this->attributes['fecha_det_chagas'] = Carbon::createFromFormat('d/m/Y',trim($value))->format('Y-m-d');
        } else {
            $this->attributes['fecha_det_chagas'] = null;
        }
    }

    public function getFechaDetChagasAttribute($value)
    {
        return  in_array($value, array('0000-00-00', null)) ? null : Carbon::parse($value);
    }

    public function setFechaCuandoVolvioEndeAttribute($value)
    {
        if ($value) {
            $this->attributes['fecha_cuando_volvio_ende'] = Carbon::createFromFormat('d/m/Y',trim($value))->format('Y-m-d');
        } else {
            $this->attributes['fecha_cuando_volvio_ende'] = null;
        }
    }

    public function getFechaCuandoVolvioEndeAttribute($value)
    {
        return  in_array($value, array('0000-00-00', null)) ? null : Carbon::parse($value);
    }

}
