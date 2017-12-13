<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patologia extends Model
{
    //
    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function consultas()
    {
        return $this->belongsToMany('App\Consulta', 'consultas_patologias')->withPivot('patologia_id', 'consulta_id');

    }
}
