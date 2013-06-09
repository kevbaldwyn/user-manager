<?php

return array(

	'mail' => array(
	
		/**
		 * array('email', 'name')
		 * to set a custom email from field for sending emails from the package (password reset etc) use this
		 * to use the default configuration in laravel set to 'default'
		 */
		'from' => 'default',

		'subject' => array(
			'password-reset' => 'Password Reset Request'
		),

		'template' => array(
			'reset-password' => 'user-manager::emails.reset-password'
		),

		'redirect' => array(
			'on-password-reset' => '/'
		)
	
	)

);