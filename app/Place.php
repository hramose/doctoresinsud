<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    //
 
    public function epidemiologias()
    {
        return $this->belongsToMany('App\Epidemiologia', 'places_epidemiologia')->withPivot('id_place', 'id_epidemiologia');

    } 

}
