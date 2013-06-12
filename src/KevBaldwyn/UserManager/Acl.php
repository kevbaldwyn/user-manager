<?php namespace KevBaldwyn\UserManager;

/*
Acl::hasAccess(); // current user, current request
Acl::requesting($route)->hasAccess(); // current user, specific request
Acl::user($user)->requesting($route)->hasAccess(); // specific user, specific request
Acl::user($user)->hasAccess(); // specific user, current request
*/

use Config, Auth, Redirect;
use Cartalyst\Sentry\Users\Eloquent\User;
use Illuminate\Routing\Route;
use Illuminate\Routing\Router;

class Acl {

	private $user;
	private $router;
	private $routeName;


	public function __construct(User $user, Router $router) {
		$this->router = $router;

		$this->user($user);
		$this->requesting($router);
	}


	public function user(User $user) {
		$this->user = $user;
		return $this;
	}


	public function requesting($route) {
		if($route instanceof Router) {
			$this->routeName = $route->currentRouteName();
		}else{
			$this->routeName = $route;
		}

		return $this;
	}


	public function hasAccess() {
		
		if(!preg_match('/[a-zA-Z\-\._]*/', $this->routeName)) {
			throw new Exception('Illegal route name when checking permssion, route must have a name.');
		}

		// check the route is within the list of permissionable routes
		if(static::permissionable($this->routeName)) {
			
			// check they are logged in first
			if (Auth::guest()) {
				return false;
			}

			// check if the user can access it
			return $this->user->hasAccess($this->routeName);

		}
		
		return true;

	}


	public static function permissionable($permissionKey) {
		
		function array_flat($array, $prefix = '') {
		    $result = array();

		    foreach ($array as $key => $value) {
		    	if(is_numeric($key)) {
		    		$key = $value;
		    		$value = null;
		    	}
		        $new_key = $prefix . (empty($prefix) ? '' : '.') . $key;

		        if (is_array($value)) {
		            $result = array_merge($result, array_flat($value, $new_key));
		        }else{
		            $result[$new_key] = $value;
		        }
		    }

		    return $result;
		}

		return array_key_exists($permissionKey, array_flat(Config::get('sentry-auth::permissions')));

	}

	
	public function getUser() {
		return $this->user;
	}


	public function getRoute() {
		return $this->router;
	}

}
