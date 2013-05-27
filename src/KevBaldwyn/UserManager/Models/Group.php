<?php namespace KevBaldwyn\UserManager\Models;

use Illuminate\Support\MessageBag;

class Group extends \KevBaldwyn\SentryAuth\Models\Group {
	
	use \KevBaldwyn\Avid\ModelScaffolding;

	protected $guarded = array('id', 'created_at', 'updated_at');
	
	
	public function __construct(array $attributes = array()) {
		parent::__construct($attributes);
		
		$this->_InitModelScaffolding(array('notEditable'     => array('permissions')));
	}	


	public static function boot() {

		static::saving(function($group) {

			// only try and update the permissions if it has been specified
			if($group->permissions_array_expected) {
				$perms = array();
				if(is_array($group->permissions_array)) {
					foreach($group->permissions_array as $key => $value) {
						$k = str_replace(':', '.', $key);
						$perms[$k] = $value;
					}
					unset($group->permissions_array);
				}

				// unset everything before specifying new permissions
				unset($group->permissions_array_expected);
				unset($group->permissions);

				$group->permissions = $perms;

			}
			
		});
		
		parent::boot();

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