<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
	//Campos permitidos de actualizar en la base via Mass Assignment
	protected $fillable = ['title', 'content', 'slug', 'status', 'user_id'];
	
    //Tickets pertenecen a usuarios
    public function user()
    {
    	return $this->belongsTo('App/User');
    }

	public function comments()
	{
		return $this->morphMany('App\Comment', 'post');
	}
}