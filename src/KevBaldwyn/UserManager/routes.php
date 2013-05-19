<?php

Route::group(array('prefix' => 'admin'), function() {

	Route::resource('groups', 'Kevbaldwyn\UserManager\Controllers\GroupsController');

});