<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Booking;
use App\Http\Requests;
use Validator;

class FrontController extends Controller
{
	public $Bookings;
      /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
      public function index(){
      	$doctors = Doctor::all();
      	return view('front.index',[
      		'doctors' => $doctors
      	]);
      }

      public function store(Request $request){

      	$input = $request->only('client_name','client_phone','client_email','client_comment');
      	$check = self::ckeckBooking($request);

      	if( $check){
      		return response()->view('message.success', array('message' =>'You already have a booking ' . date('Y-m-d H:i' , $check->booking) .' <br> Doctor name : '. $check->doctor->name ));
      	}

      	self::ValidateBooking($request);

      	$doctor = Doctor::findOrFail($request->medic_id);
      	$bookking = new Booking();
      	$bookking->doctor()->associate($doctor);
      	$bookking->booking = strtotime($request->booking);
      	$bookking->fill($input);
      	$bookking->save();
      	return response()->view('message.success', array('message' => trans('Booking has been successfully created') ));
      }

      public function ValidateBooking(Request $request)
      {

      	Validator::extend('booking', function ($attribute, $value , $parameters ) {
      		$startU = strtotime($value);
      		$result  = Booking::where($parameters[0], $parameters[1])
      		->where(function ($query) use ($startU) {
      			$query->where(function ($q) use ($startU) {
      				$q->where('booking',    '>',  $startU 	-  	config('project.period'))
      				->where('booking',   	'<', $startU 	+ 	config('project.period'));
      			});
      		});
      		if($result->count()){

      			$begin  = strtotime(date('Y/m/d 00:00:00' ,$startU));
      			$end    = strtotime(date('Y/m/d 23:59:59' , $startU));

      			$this->Bookings  = Booking::where($parameters[0], $parameters[1])
      			->where(function ($query) use ($begin, $end) {
      				$query->where(function ($q) use ($begin, $end) {
      					$q->where('booking'	, '>=', $begin)
      					->where('booking'	, '<=', $end);
      				});
      			})->get();

      		}

      		return $result->count() === 0;
      	});

      	Validator::replacer('booking', function() {
      		$date = [];
      		foreach ($this->Bookings as $booking) {
      			$date[] = date('Y/m/d H:i' , $booking->booking );
      		}
      		return  'This doctor is already busy here is the list of the following reservations :  <br> '. implode("<br>",$date) . '<br> for the next booking the interval is one hour';
      	});

      	$rules = config('validations.web.booking.create');

      	$rules['booking'] = 'required|booking:doctor_id,'.$request->medic_id;


      	$this->validate($request, $rules);
      }

      public function ckeckBooking(Request $request)
      {

      	$begin  = strtotime(date('Y-m-d 00:00:00' , strtotime($request->booking)));
      	$end    = strtotime(date('Y-m-d 23:59:59' , strtotime($request->booking)));

      	return Booking::where('client_name', $request->client_name)
      	->where('doctor_id', $request->medic_id)
      	->where(function ($query) use ($begin, $end) {
      		$query->where(function ($q) use ($begin, $end) {
      			$q->where('booking', '>=', $begin)
      			->where('booking', '<=', $end);
      		});
      	})->first();

      }
  }
