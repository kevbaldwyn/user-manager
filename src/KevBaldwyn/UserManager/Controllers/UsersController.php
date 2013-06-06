<?php namespace KevBaldwyn\UserManager\Controllers;

use Config;
use View;
use Request;
use Redirect;
use Input;
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
	
	
	public function index() {
		
		$model = static::model();
		
		return View::make($this->viewPath . '.index', array('model' => $model,
															'list'  => $model->all()));
	}
	

	public function create() {
		
		$model = static::model();
		
		return View::make($this->viewPath . '.create', array('model' => $model,
															 'ignore' => $model->getNotEditable()));
		
	}
	

	public function edit($id) {

		$model = static::model()->find($id);
		
		return View::make($this->viewPath . '.edit', array('model' => $model,
														   'ignore' => $model->getNotEditable()));
		
	}
	
	
	
}