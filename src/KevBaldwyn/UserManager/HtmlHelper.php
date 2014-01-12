<?php namespace KevBaldwyn\UserManager;

use Config;
use Form;
use Input;

class HtmlHelper {

	public static function permissionsMatrix(Array $permissions = array()) {

		// check which are in the supplied list and build a list of form elements
		function recurse($arrayLevel, $perms, $passedRootKey = '') {
			$str = '';
			$oldInput = Input::old();
			if(array_key_exists('permissions_array', $oldInput)) {
				$oldPerms = $oldInput['permissions_array'];
				foreach($oldPerms as $key => $val) {
					$k = str_replace(':', '.', $key);
					$perms[$k] = $val;
				}
			}

			foreach($arrayLevel as $key => $var) {

				if(is_array($var)) {
					$rootKey = ($passedRootKey == '') ? $key : $passedRootKey . '.' . $key;
					
					$str .= '<h2>' . $key . '</h2>';
					$str .= recurse($var, $perms, $rootKey);
				}else{
					$permKey = ($passedRootKey == '') ? $var : $passedRootKey . '.' . $var;

					$str .= Form::checkbox('permissions_array[' . str_replace('.', ':' , $permKey) . ']', 1, ((array_key_exists($permKey, $perms) && $perms[$permKey] == 1) ? 1 : 0));
					$str .= Form::label($permKey, $var);
				}

			}

			return $str;

		}

		$str = Form::hidden('permissions_array_expected', true);
		$str .= recurse(Config::get('sentry-auth::permissions'), $permissions);
		return $str;

	}

}