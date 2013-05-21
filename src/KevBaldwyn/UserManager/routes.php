<?php

Route::group(array('prefix' => \Config::get('avid::admin.route_prefix')), function() {

	Route::resource('groups', 'Kevbaldwyn\UserManager\Controllers\GroupsController');

});