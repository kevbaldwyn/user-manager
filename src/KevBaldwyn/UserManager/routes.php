<?php

Route::group(array('prefix' => \Config::get('avid::admin.route_prefix')), function() {

	Route::get('groups/{id}/delete', array('uses' => 'KevBaldwyn\UserManager\Controllers\GroupsController@delete',
										   'as'   => App::make('Group')->getScaffoldRoute('delete')))
				->where('id', '[0-9]+');

	Route::resource('groups', 'KevBaldwyn\UserManager\Controllers\GroupsController');

});