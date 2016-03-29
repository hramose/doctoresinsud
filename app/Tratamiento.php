<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tratamiento extends Model
{
    protected $fillable = [
				'fecha_trat',
				'droga',
				'dosis',
				'flia_droga',
				'id_hc',
				'obs_trat',
    			];

public function paciente()
{
	return $this->hasOne('App\Paciente', 'id_hc');
}
   
}
