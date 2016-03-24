<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estudio extends Model
{
    //
    protected $fillable = [
    	'nombre',
    	'obs',
    ];

    public function camposBase()
    {
    	return $this->belongsToMany('App\CampoBase', 'camposbase_estudios')->withPivot('estudio_id', 'campo_base_id');
    }


    public function saveCamposBase($campos_base)
    {






        if(!empty($campos_base))
        {
            $this->camposBase()->sync($campos_base);
        } else {
            $this->camposBase()->detach();
        }
    }
}
