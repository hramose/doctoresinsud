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

    public function sintomas()
    {
        return $this->belongsToMany('App\Sintoma', 'consultas_sintomas')->withPivot('consulta_id', 'sintoma_id');

    }

    public function patologias()
    {
        return $this->belongsToMany('App\Patologia', 'consultas_patologias')->withPivot('consulta_id', 'patologia_id');

    }

    public function saveSintomas($sintomas)
    {
        if(!empty($sintomas))
        {
            $this->sintomas()->sync($sintomas);
        } else {
            $this->sintomas()->detach();
        }
    }

}
