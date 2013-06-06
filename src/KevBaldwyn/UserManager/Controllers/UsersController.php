<?php namespace KevBaldwyn\UserManager\Controllers;

use Config;
use KevBaldwyn\Avid\Model;
use Illuminate\Support\Contracts\MessageProviderInterface;

class UsersController extends \KevBaldwyn\Avid\Controller {
	
	
	public function __construct(MessageProviderInterface $messages) {
		
		parent::__construct($messages);
		
		$this->setViewPath('user-manager::users');
	}


	public static function model() {
		return Model::make(Config::get('cartalyst/sentry::users.model'));
	}
	
	
	
}