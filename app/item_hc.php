<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class item_hc extends Model
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
        return $this->belongsTo('App\Paciente', 'id_paciente', 'id');
    }

    public function medico()
    {
        return $this->belongsTo('App\User', 'id_usuario', 'id');
    }

    public function sede()
    {
        return $this->belongsTo('App\Sede', 'id_sede', 'id');
    }

}
