<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistorialCampo extends Model
{
    //
    protected $table = 'historial_campo';
    

    public function  getHistorialByResource($recurso,$field,$tipo){
    	return $this
    	->select("field","valor","estado","historial_campo.created_at","users.name")
    	->join("users","users.id","=","historial_campo.user_id")
    	->where('recurso',$recurso)
    	->where('field',$field)
    	->where('tipo',$tipo)
    	->orderBy("historial_campo.id","DESC")
    	->get();
    }
}
