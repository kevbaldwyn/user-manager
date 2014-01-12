<?php

Route::filter('auth.permission', function() {
	
	if(!Acl::hasAccess()) {
		return Redirect::guest('login');
	}

});