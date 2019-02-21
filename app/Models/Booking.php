<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public $timestamps = true;
	protected $table = 'bookings';
	protected $fillable = [
		
		'client_name',
		'client_phone',
		'client_email',
		'client_comment',
		'booking'
	];

	public function doctor()
    {
        return $this->belongsTo(Doctor::class,'doctor_id','id');
    }
}
