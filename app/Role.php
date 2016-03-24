<?php

namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    //Campos permitidos para Mass Assignment
    protected $fillable = [
    			'name', 
    			'display_name', 
    			'description'
    ];
}