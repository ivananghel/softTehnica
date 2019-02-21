<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Booking;
use Datatables;

class BookingController extends Controller
{
     /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
      public function index() {
      	return view('bookings.index', [
      		'active_menu' => 'bookings',
      	]);
      }

      public function datatable() {

      	$query = Booking::with('doctor');

      	return Datatables::of($query)
         ->filterColumn('booking', function($query, $keyword) {
                      
                    $query->where('booking', strtotime($keyword));
          })
      	->editColumn('created_at', function(Booking $booking){
      		return $booking->created_at->format(config('project.formatUI'));
      	})
        ->editColumn('booking', function(Booking $booking){
          return date(config('project.date_format'),$booking->booking);
        })
      	->make(true);
      }
  }
