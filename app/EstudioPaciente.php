<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

    public function estudio()
    {
        return $this->hasOne('App\Estudio', 'id', 'id_estudio');
    }

    public function paciente()
    {
        return $this->hasOne('App\Paciente', 'id_hc');
    }
}