<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

	// protected $dates = ['fecha_trat',];

	public function paciente()
	{
		return $this->hasOne('App\Paciente', 'id');
	}

	public function setFechaTratAttribute($value)
	{
		if ($value) {
			$this->attributes['fecha_trat'] = Carbon::createFromFormat('d/m/Y', trim($value))->format('Y-m-d');
		} else {
			$this->attributes['fecha_trat'] = null;
		}
	}
       
	public function getFechaTratAttribute($value)
	{
		return  in_array($value, array('0000-00-00', null)) ? null : Carbon::parse($value);
	}
    public function getTratamientoImporter($id, $date, $flia){
        return $this->where('id_hc', $id)
                    ->where('fecha_trat', $date)
                    ->where('droga', $flia)
                    ->get();
    }
        
}
