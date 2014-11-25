<?php

class Cookie {



	public static function put($key, $value, $expire) {
		if (setcookie($key, $value, time() + $expire, '/') {
			return true;
		} 
		
		return false;
	}

	public static function exists($key) {
		return (isset($_COOKIE[$key] = $value)) ? true : false;
	}

	public static function get($key) {
		return $_COOKIE[$key];
	}

	public static function delete($key) {
		self::put($key, '', $time()-1);
	}
}




?>