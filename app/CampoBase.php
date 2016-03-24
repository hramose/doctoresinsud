<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CampoBase extends Model
{
 	protected $table = 'campos_base';

    //Campos completables
    protected $fillable = [
    			'nombre',
    			'descripcion',
                'id_unidad',
    			'tipo',
    			'ref_min',
    			'ref_max',
    		];

    public function UnidadMedida()
    {
    	return $this->belongsTo('App\UnidadMedida');
    }

    public function Estudios()
    {
        return $this->belongsToMany('App\Estudio', 'camposbase_estudios')->withPivot('campo_base_id','estudio_id');
    }

    public function saveUnidadMedida($unidadMedida)
    {
        if(!empty($unidadMedida))
        {
            $this->UnidadesMedidas()->sync($unidadMedida);
        } else {
            $this->UnidadesMedidas()->detach();
        }
    }
}
