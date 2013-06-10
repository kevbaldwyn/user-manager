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
			'password-reset' => 'Password Reset Request',
			'activate'       => 'Please Activate Your Account'
		),

		'template' => array(
			'reset-password' => 'user-manager::emails.reset-password',
			'activation'     => 'user-manager::emails.activation'
		)
	
	),

	'redirect' => array(
		'on-password-reset'   => '/',
		'on-login'            => '/',
		'on-logout'           => '/',
		'on-activation'       => '/',
		'on-activation-error' => '/'
	),

	'messages' => array(
		'error'   => array('invalid-password-reset-token' => 'The password reset token is invalid',
						   'password-reset'               => 'Unable to reset password',
						   'password'                     => 'Please specify a password',

						   'login-password' => 'A user with that email address exists but the password is incorrect',
						   'bad-combo'      => 'Incorrect email address and password combination',

						   'activation-failed'  => 'There was an error activating the user',
						   'activation-notoken' => 'No user to activate, please be sure to follow the link in the activation email'),

		'success' => array('request-password-reset' => 'Your password reset request has been sent',
						   'password-reset'         => 'Your password has been reset',
						   'logged-in'              => 'You have been logged in',
						   'logged-out'             => 'You have been logged out',
						   'admin-send-activation'  => 'The activation email has been sent',
						   'activation'             => 'Your account has been activated')
	)

);