<?php namespace KevBaldwyn\UserManager\Models;

use Illuminate\Support\MessageBag;

class Group extends \KevBaldwyn\SentryAuth\Models\Group {
	
	use \KevBaldwyn\Avid\ModelScaffolding;

	protected $guarded = array('id', 'created_at', 'updated_at');
	
	
	public function __construct(array $attributes = array()) {
		parent::__construct($attributes);
		
		$this->_InitModelScaffolding(array('notEditable'     => array('permissions')));
	}	


	public function save(array $options = array()) {
		try {
			return parent::save($options);
		}catch(\Cartalyst\Sentry\Groups\NameRequiredException $e) {
			// a validation object to store some errors in
			$messages = new MessageBag();

			// assign the error to the name field
			$messages->add($this->__get('nameField'), $e->getMessage());
			$this->__set('errors', $messages);

			return false;
		}
	}


}