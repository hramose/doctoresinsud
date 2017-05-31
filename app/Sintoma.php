<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sintoma extends Model
{
    //
    protected $fillable = [
            'nombre',
            'descripcion',
        ];

    public function consultas()
    {
        return $this->belongsToMany('App\Consulta', 'consultas_sintomas')->withPivot('sintoma_id', 'consulta_id');

    }

}
