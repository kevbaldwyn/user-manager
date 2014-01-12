<?php namespace KevBaldwyn\UserManager\Commands;

use Config;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use KevBaldwyn\Avid\Model;

class CreateUserCommand extends Command {


	protected $name = 'kevbaldwyn:create-user';
	protected $description = 'Create an admin user';
	
	protected $app;
	
	
	public function __construct($app) {
		parent::__construct();
		
		$this->app = $app;
		
	}
	
	public function fire() {
		
		$model = Model::make(Config::get('cartalyst/sentry::users.model'));
		$user = $model->create(array('first_name' => $this->argument('firstname'),
						   'email'      => $this->argument('email'),
						   'activated'  => '1',
						   'password'   => $this->argument('password')));

		$groupM = Model::make(Config::get('cartalyst/sentry::groups.model'));
		$group = $groupM->where('name', 'Admin')->first();
		
		$user->addGroup($group);

		$this->info('User added.');
		
	}

	protected function getArguments() {
		return array(
			array('firstname', InputOption::VALUE_REQUIRED, 'Users first name'),
			array('email', InputOption::VALUE_REQUIRED, 'Users email'),
			array('password', InputOption::VALUE_REQUIRED, 'Users password')
		);
	}

	protected function getOptions() {
		return array();
	}

}