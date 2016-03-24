<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class item_hc extends Model
{


	protected $fillable = [
    			'id_sede',
    			'id_medico',
    			'id_telefono',
    			'titulo',
    			'descripcion',
    			'etipo'
    		];

    		
    public function Item_hc()
    {
        return $this->hasOne('App\Paciente');
    }

}
