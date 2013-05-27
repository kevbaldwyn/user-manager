<?php namespace KevBaldwyn\UserManager;

use Illuminate\Support\ServiceProvider;

class UserManagerServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('kevbaldwyn/user-manager');
		
		$this->registerModelEvents();

		include(__DIR__.'/routes.php');

	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{

	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}


	private function registerModelEvents() {
		
		$model = '\\' . \Config::get('cartalyst/sentry::groups.model');
		$model::saving(function($group) {

			if($group->permissions_array_expected) {
				$perms = array();
				if(is_array($group->permissions_array)) {
					foreach($group->permissions_array as $key => $value) {
						$k = str_replace(':', '.', $key);
						$perms[$k] = $value;
					}
					unset($group->permissions_array);
				}

				unset($group->permissions_array_expected);
				unset($group->permissions);

				$group->permissions = $perms;

			}
			
		});

	}

}