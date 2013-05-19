<?php namespace Kevbaldwyn\UserManager\Controllers;

use Config;
use KevBaldwyn\Avid\Model;
use Illuminate\Support\Contracts\MessageProviderInterface;

class GroupsController extends \KevBaldwyn\Avid\Controller {
	
	
	public function __construct(MessageProviderInterface $messages) {
		
		parent::__construct($messages);
		
		$this->setViewPath('user-manager::groups');
	}

	public static function model() {
		return Model::make(Config::get('cartalyst/sentry::groups.model'));
	}
	
}