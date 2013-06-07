<?php namespace KevBaldwyn\UserManager\Observers;

class PermissionsObserver {

	public function saving($model) {

		// only try and update the permissions if it has been specified
		if($model->permissions_array_expected) {
			$perms = array();
			if(is_array($model->permissions_array)) {
				foreach($model->permissions_array as $key => $value) {
					$k = str_replace(':', '.', $key);
					$perms[$k] = $value;
				}
				unset($model->permissions_array);
			}

			// unset everything before specifying new permissions
			unset($model->permissions_array_expected);
			unset($model->permissions);

			$model->permissions = $perms;

		}

	}

}