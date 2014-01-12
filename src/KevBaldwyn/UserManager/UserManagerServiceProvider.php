<?php namespace KevBaldwyn\UserManager;

use Auth;
use Illuminate\Support\ServiceProvider;
use KevBaldwyn\UserManager\Acl;

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

		\User::observe(new Observers\PermissionsObserver);
		\Group::observe(new Observers\PermissionsObserver);

		include(__DIR__.'/routes.php');
		include(__DIR__.'/filters.php');

		$app = $this->app;
		$this->app->bind('user-manager.acl', function() use ($app) {
			$user = (!is_null(Auth::getUser())) ? Auth::getUser() : new \User();
			return new Acl($user, $app['router']);
		});
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		
		$this->app['command.kevbaldwyn:create-user'] = $this->app->share(function($app) {
			return new Commands\CreateUserCommand($app);
		});
				
		$this->commands('command.kevbaldwyn:create-user');
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

}