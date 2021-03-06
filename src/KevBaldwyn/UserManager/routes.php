<?php

Route::group(array('prefix' => \Config::get('avid::admin.route_prefix')), function() {

	// groups
	Route::get('groups/{id}/delete', array('uses' => 'KevBaldwyn\UserManager\Controllers\GroupsController@delete',
										   'as'   => App::make('Group')->getScaffoldRoute('delete')))
				->where('id', '[0-9]+');

	Route::any('groups/{id}/manage-users', array('uses' => 'KevBaldwyn\UserManager\Controllers\GroupsController@manageUsers',
												 'as'   => App::make('Group')->getScaffoldRoute('manage-users')))
				->where('id', '[0-9]+');

	Route::resource('groups', 'KevBaldwyn\UserManager\Controllers\GroupsController');


	// users
	Route::get('users/{id}/delete', array('uses' => 'KevBaldwyn\UserManager\Controllers\UsersController@delete',
										   'as'   => App::make('User')->getScaffoldRoute('delete')))
				->where('id', '[0-9]+');

	Route::get('users/{id}/reset-password', array('uses' => 'KevBaldwyn\UserManager\Controllers\UsersController@resetPasswordAdmin',
												  'as'   => App::make('User')->getScaffoldRoute('resetPassword')));

	Route::get('users/{id}/send-activation', array('uses' => 'KevBaldwyn\UserManager\Controllers\UsersController@sendActivationAdmin',
												   'as'   => App::make('User')->getScaffoldRoute('send-activation')));

	Route::resource('users', 'KevBaldwyn\UserManager\Controllers\UsersController');

	Route::any('users/{id}/manage-groups', array('uses' => 'KevBaldwyn\UserManager\Controllers\UsersController@manageGroups',
												 'as'   => App::make('User')->getScaffoldRoute('manage-groups')))
				->where('id', '[0-9]+');
});

Route::get('users/reset-password', array('uses' => 'KevBaldwyn\UserManager\Controllers\UsersController@getResetPassword',
										 'as'   => 'users.reset-password'));

Route::post('users/reset-password', 'KevBaldwyn\UserManager\Controllers\UsersController@postResetPassword');

Route::get('users/activate', array('uses' => 'KevBaldwyn\UserManager\Controllers\UsersController@activate',
								   'as'   => 'users.activate'));

Route::any('login', array('uses' => 'KevBaldwyn\UserManager\Controllers\UsersController@login',
						  'as'   => 'login'));

Route::get('logout', array('uses' => 'KevBaldwyn\UserManager\Controllers\UsersController@logout',
						   'as'   => 'logout'));