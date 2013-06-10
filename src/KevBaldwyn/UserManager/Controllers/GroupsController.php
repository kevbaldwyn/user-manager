<?php namespace KevBaldwyn\UserManager\Controllers;

use Config;
use View;
use Request;
use Redirect;
use Input;
use KevBaldwyn\Avid\Model;
use Illuminate\Support\Contracts\MessageProviderInterface;
use Illuminate\Database\Eloquent\Collection;

class GroupsController extends \KevBaldwyn\Avid\Controller {
	
	
	public function __construct(MessageProviderInterface $messages) {
		
		parent::__construct($messages);
		
		$this->setViewPath('user-manager::groups');
	}


	public static function model() {
		return Model::make(Config::get('cartalyst/sentry::groups.model'));
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


	public function manageUsers($id) {

		$model    = static::model()->find($id);
		$users    = new Collection(Model::make(Config::get('cartalyst/sentry::users.model'))->findAllInGroup($model));
		$allUsers = Model::make(Config::get('cartalyst/sentry::users.model'))->all();


		if(Request::getMethod() == 'PUT') {

			// remove all from this group
			foreach($allUsers as $user) {
				$user->removeGroup($model);
			}

			// add in correct users to this group
			if(count(Input::get('user')) > 0) {
				foreach(Input::get('user') as $userId => $true) {
					// needs a new instance!?
					Model::make(Config::get('cartalyst/sentry::users.model'))->find($userId)
																			 ->addGroup($model);
				}
			}

			$this->messages->add('success', 'The groups users have been updated.')
						   ->flash();
						   
			return Redirect::route(static::model()->getScaffoldRoute('index'));

		}


		return View::make($this->viewPath . '.manage-users', array('model'    => $model,
														   		   'users'    => $users,
														   		   'allUsers' => $allUsers));
	}


}