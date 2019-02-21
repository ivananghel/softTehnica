<?php

Route::auth();
Route::group(['middleware' => 'web'], function() {
	
	 Route::get('/', 'FrontController@index');
	 Route::post('save-booking'	, 'FrontController@store');

});

Route::group(['middleware' => 'auth'], function() {
	Route::get('/admin', 'HomeController@index');
	Route::group(['middleware' => ['role:admin']], function() {
		Route::post('/users/datatable'	, 'UserController@datatable');
		Route::resource('/users'		, 'UserController', ['except' => ['show']]);
		Route::resource('/doctors'		, 'DoctorController', ['except' => ['show']]);
		Route::post('/doctors/datatable'	, 'DoctorController@datatable');
		Route::resource('/bookings'		, 'BookingController', ['except' => ['show']]);
		Route::post('/bookings/datatable'	,'BookingController@datatable');
	});

});
