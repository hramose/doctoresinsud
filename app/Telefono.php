<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telefono extends Model
{
    //
    protected $guarded = [
        'id',
        'id_paciente',
    ];

    public function paciente()
    {
        return $this->hasOne('App\Paciente', 'id', 'id_paciente');
    }
}
