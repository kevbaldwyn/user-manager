<?php namespace KevBaldwyn\UserManager\Models;

use Illuminate\Support\MessageBag;

class User extends \KevBaldwyn\SentryAuth\Models\User {
	
	use \KevBaldwyn\Avid\ModelScaffolding;

	protected $guarded = array('id', 'created_at', 'updated_at', 'reset_password_code',	'activation_code', 'persist_code');
	
	
	public function __construct(array $attributes = array()) {
		parent::__construct($attributes);
		
		$this->_InitModelScaffolding(array('notEditable'     => array('permissions', 'activated_at', 'last_login', 'password'),
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
	
}