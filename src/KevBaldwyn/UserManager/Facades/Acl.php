<?php namespace KevBaldwyn\UserManager\Facades;

use Illuminate\Support\Facades\Facade;

class Acl extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{
		return 'user-manager.acl';
	}

}
