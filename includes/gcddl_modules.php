<?php

class Modules {
	private var $modules = array();
	
	function register_module($name) {
		if(!array_key_exists($name, $this->modules)) {
			$realname='gcddl_'.$name;
			$this->modules[$name]=array(
				'handle' => new $realname();
			);
		}
	}
}
