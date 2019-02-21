<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    public $timestamps = true;
	protected $table = 'doctors';
	protected $fillable = [
		'name',
		'type_procedure'
	];
	
}
