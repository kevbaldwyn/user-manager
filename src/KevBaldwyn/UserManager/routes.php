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

	Route::resource('users', 'KevBaldwyn\UserManager\Controllers\UsersController');

});