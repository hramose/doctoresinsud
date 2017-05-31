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

	protected $table = 'estudios_pacientes_valores';

	public function estudioPaciente()
	{
		return $this->belongsTo('App\EstudioPaciente', 'id', 'estudios_pacientes_id');
	}

	public function campoBase()
	{
		return $this->hasOne('App\CampoBase', 'id', 'campos_base_id');
	}
}