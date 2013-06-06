<?php namespace KevBaldwyn\UserManager\Models;

use Illuminate\Support\MessageBag;

class User extends \KevBaldwyn\SentryAuth\Models\User {
	
	use \KevBaldwyn\Avid\ModelScaffolding;

	protected $guarded = array('id', 'created_at', 'updated_at');
	
	
	public function __construct(array $attributes = array()) {
		parent::__construct($attributes);
		
		$this->_InitModelScaffolding(array('nameField' => 'email'));
	}	

}