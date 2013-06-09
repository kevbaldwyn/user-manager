<?php namespace KevBaldwyn\UserManager\Controllers;

use Config, View, Request, Redirect, Input, Auth, Validator;
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

		$ignore = $model->getNotEditable();
		array_push($ignore, 'password');
		
		return View::make($this->viewPath . '.edit', array('model' => $model,
														   'ignore' => $ignore));
		
	}


	public function login() {

		if(Input::getMethod() == 'POST') {
			$validator = Validator::make(Input::all(),
				array('email' => 'email|required'),
				array('password' => 'required')
			);

			$remember = (Input::has('remember')) ? Input::get('remember') : false;

			if($validator->passes()) {

				try {

					$user = static::model()->findByLogin(Input::get('email'));

					if(Auth::attempt(array('email'     => Input::get('email'),
										   'password'  => Input::get('password'),
										   'activated' => 1),
									$remember
									)) {


						$this->messages->add('success', Config::get('user-manager::messages.success.logged-in'))
									   ->flash();

						return Redirect::intended(Config::get('user-manager::redirect.on-login'));

					}else{

						if($user->activated) {
							$validator->messages()->add('password', Config::get('user-manager::messages.error.login-password'));
						}else{
							$validator->messages()->add('password', Config::get('user-manager::messages.error.bad-combo'));
						}
					}

				}catch(\Exception $e) {

					if($e instanceof \Cartalyst\Sentry\Users\WrongPasswordException) {
						$validator->messages()->add('password', Config::get('user-manager::messages.error.login-password'));
					}else{
						$validator->messages()->add('email', $e->getMessage());
					}

				}	

			}

			return Redirect::back()->withInput(Input::except('password'))->withErrors($validator);

		}

		return View::make($this->viewPath . '.login');
	}


	public function logout() {
		Auth::logout();

		$this->messages->add('success', Config::get('user-manager::messages.success.logged-out'))
					   ->flash();

		return Redirect::to(Config::get('user-manager::redirect.on-logout'));
	}


	public function resetPasswordAdmin($id) {

		$user = static::model()->find($id);
		
		$user->sendResetPasswordEmail();

		$this->messages->add('success', Config::get('user-manager::messages.success.request-password-reset'))
					   ->flash();

		return Redirect::back();
	}


	/**
	 * Render the form for either a reset request or the actual reset action
	 * @return View the form
	 */
	public function getResetPassword() {
		if(Input::has('token')) {
			$data = array('reset' => true);
		}else{
			$data = array('reset' => false);
		}

		return View::make($this->viewPath . '.reset-password', $data);

	}


	/**
	 * Do the actual action - either a reset request or the reset itself
	 * @return Void
	 */
	public function postResetPassword() {

		try {

			$user = static::model()->findByLogin(Input::get('email'));

			// doing the reset
			if(Input::has('token')) {

				if(!Input::has('password') || trim(Input::get('password')) == "") {
					throw new \Exception(Config::get('user-manager::messages.error.password'));
				}

				// Check if the reset password code is valid
			    if ($user->checkResetPasswordCode(Input::get('token'))) {
					
					// Attempt to reset the user password
			        if ($user->attemptResetPassword(Input::get('token'), Input::get('password'))) {
						// Password reset passed
						$this->messages->add('success', Config::get('user-manager::messages.success.password-reset'))
									   ->flash();

						return Redirect::to(Config::get('user-manager::redirect.on-password-reset'));
			        }else{
						// Password reset failed
						throw new \Exception(Config::get('user-manager::messages.error.password-reset'));
			        }
			    }else{
					// The provided password reset code is Invalid
					throw new \Exception(Config::get('user-manager::messages.error.invalid-password-reset-token'));
			    }
			
			}else{		
				
				// requesting reset		
				$user->sendResetPasswordEmail();

				$this->messages->add('success', Config::get('user-manager::messages.success.request-password-reset'))
							   ->flash();

				return Redirect::back();

			}

		}catch(\Exception $e) {
			$this->messages->add('error', $e->getMessage())
						   ->flash();

			return Redirect::back()->withInput();
		}

	}
	
	
	
}