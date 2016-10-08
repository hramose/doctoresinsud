<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
