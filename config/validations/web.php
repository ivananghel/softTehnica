<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 24.03.2017
 * Time: 15:52
 */

return [
	
	'user' => [
		'create' => [
			'first_name'                => 'required|max:255',
			'last_name'                 => 'required|max:255',
			'email'                     => 'required|email|unique:users,email',
			'upload_file'               => 'file|mimes:jpeg,jpg,png',
			'password'                  => 'required|min:4|max:255|confirmed',
			'password_confirmation'     => 'min:4|max:255'
		],
		'update' => [
			'first_name'                => 'required|max:255',
			'last_name'                 => 'required|max:255',
			'email'                     => 'required|email|unique:users,email',
			'photo'                     => 'file|mimes:jpeg,jpg,png',
			'password'                  => 'min:4|max:255|confirmed',
			'password_confirmation'     => 'min:4|max:255'
		]
	],
	'doctor' => [
		'create' => [
			'name'                		=> 'required|min:3',
			'type_procedure'            => 'required',

		],
		'update' => [
			'name'                		=> 'required|min:3',
			'type_procedure'            => 'required',
		]
	],

	'booking' => [
		'create' => [
			'type_procedure'             => 'required',
			'medic_id'            		 => 'required',
			'booking'            		 => 'required',
			'client_name'            	 => 'required',
			'client_phone'            	 => 'required|numeric',
			'client_email'            	 => 'required|email',

		]
		
	],

];