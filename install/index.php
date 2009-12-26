<?php

switch($_GET['step']) {
	default:
		$error = false;
		
		// PHP Version
		if(version_compare(PHP_VERSION, '5.0.0', '>=')) {
			echo 'PHP Version Ok: '.PHP_VERSION;
		} else {
			echo 'PHP Version Too Old: '.PHP_VERSION;
			$error=true;
		}
		
		// Mysql Version
		/* CHECK MYSQL AND OTHER CRAP HERE */
		
		// Continue
		if($error) {
			echo 'Fix errors and refresh this page.';
		} else {
			echo '<form method="get"><input type="hidden" name="step" value="1" /><input type="submit" value="Continue" /></form>';
		}
		
		break;
	
	case 1:
		break;
}
