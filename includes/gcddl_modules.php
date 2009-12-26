<?php

class Modules {
	var $modules = array();
	
	function register_module($name) {
		if(!array_key_exists($name, $this->modules)) {
			eval("\$handle = new gcddl_$name();");
			$this->modules[$name]=array(
				'handle' => $handle;
			);
		}
	}
}
