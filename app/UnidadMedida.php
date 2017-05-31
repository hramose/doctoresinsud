<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnidadMedida extends Model
{
    //
    protected $fillable = [
    			'unidad',
    			];

    public function camposBase()
    {
    	return $this->hasMany('App\CampoBase');
    }
}
