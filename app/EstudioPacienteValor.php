<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstudioPacienteValor extends Model
{
    //
    protected $fillable = [
				'valor',
				'obs',
				'estudios_pacientes_id',
				'campos_base_id'
			];

}

public function estudioPaciente()
{
	return $this->belongsTo('App\EstudioPaciente', 'estudios_pacientes_id');
}
, 
public function campoBase()
{
	return $this->hasOne('App\CampoBase', 'campos_base_id');
}