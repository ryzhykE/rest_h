<?php

	function controllerLoader($className) {
		$path = "lib/Controllers/" . $className . ".php";

		if( file_exists($path)) {
			include_once $path;
		} else {
			return false;
		}
	}


	//Register autoloaders:
	spl_autoload_register("controllerLoader");
