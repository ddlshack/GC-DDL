<?php
/*
 * Functions are binded to events and then executed throughout the code
 * Any variables must be passed by reference and editted in the function directly,
 * because variable assignment by return values cannot be implimented
 * 
 * Any function name that can be passed to call_user_func_array() is valid,
 * including array($class, $method)
 */

class Hooks {
	private static $names = array(
		'Hookname' => 3, // Name => function arg number
	);
	
	var $hooks = array();
	
	function register_hook($name, $func) {
		if(!array_key_exists($name, $this->names)) return; // Invalid name
		$this->hooks[$name][]=$func;
	}
	
	function execute_hook($name, $args) { // $args=array(args);
		if(!array_key_exists($name, $this->names)) return; // Invalid Hook Name
		if(!array_key_exists($name, $this->hooks)) return; // No hooks to execute
		foreach($this->hooks[$name] as $func) {
			call_user_func_array($func, $args);
		}
	}
}
?>
