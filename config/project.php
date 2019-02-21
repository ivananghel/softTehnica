<?php

return [

	/**
	 * Name of the application
	 */
	'name'			=> env('APP_NAME', 'NEW Project'),

	/**
	 * Date format used in output for datatables
	 *
	 * Must be a valid SQL date format string
	 */
	'date_format'   => 'Y-m-d H:i',
	'period'   		=> 60*60,
	'datepicker'	=> 'yy-mm-dd',
	'formatAPI'		=> 'U',
	'formatUI'      => 'Y-m-d',
	'uploadPath'	=> 'uploads/',
	'faIconsPath'	=> 'fa-icons/png/256/',
	//TODO Change Links
	'sociallinks'	=> array(
		'facebook'	=> '',
		'twitter'	=> '',
		'google'	=> ''
	),
	'contcat_info' => array(
		'email' => '',
		'phone' => '',
		'site'	=> '',
	),

	'terms_link'	=> '',
	'privacy_link'	=> '',

	'recovery_email_subject'	=> 'hello'
];