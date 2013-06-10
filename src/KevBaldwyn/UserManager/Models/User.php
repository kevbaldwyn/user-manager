<?php namespace KevBaldwyn\UserManager\Models;

use Config;
use Mail;
use Illuminate\Support\MessageBag;

class User extends \KevBaldwyn\SentryAuth\Models\User {
	
	use \KevBaldwyn\Avid\ModelScaffolding;

	protected $guarded = array('id', 'created_at', 'updated_at', 'reset_password_code',	'activation_code', 'persist_code');
	
	
	public function __construct(array $attributes = array()) {
		parent::__construct($attributes);
		
		$this->_InitModelScaffolding(array('notEditable'     => array('permissions', 'activated_at', 'last_login'),
										   'nameField'       => 'email'));
	}	


	public function save(array $options = array()) {
		try {
			return parent::save($options);
		}catch(\Exception $e) {
			// a validation object to store some errors in
			$messages = new MessageBag();

			// assign the error to the name field
			$messages->add($this->__get('nameField'), $e->getMessage());
			$this->__set('errors', $messages);

			return false;
		}
	}


	public function sendResetPasswordEmail() {

		$resetCode = $this->getResetPasswordCode();
		
		$data = array('reset_code' => $resetCode,
					  'first_name' => $this->first_name,
					  'last_name'  => $this->last_name);

		Mail::send(Config::get('user-manager::mail.template.reset-password'), $data, function($message) {
			if(Config::get('user-manager::mail.from') == 'default') {
				$from = Config::get('mail.from');
			}else{
				$from = Config::get('user-manager::mail.from');
			}

		    $message->from($from['address'], $from['name']);
		    $message->to($this->email)->subject(Config::get('user-manager::mail.subject.password-reset'));

		});

	}


	public function sendActivationEmail() {
		$activationCode = $this->getActivationCode();
		
		$data = array('activation_code' => $activationCode,
					  'first_name'      => $this->first_name,
					  'last_name'       => $this->last_name);

		Mail::send(Config::get('user-manager::mail.template.activation'), $data, function($message) {
			if(Config::get('user-manager::mail.from') == 'default') {
				$from = Config::get('mail.from');
			}else{
				$from = Config::get('user-manager::mail.from');
			}

		    $message->from($from['address'], $from['name']);
		    $message->to($this->email)->subject(Config::get('user-manager::mail.subject.activaton'));

		});

	}

}