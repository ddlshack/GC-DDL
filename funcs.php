<?php
/* This file is here to set up the script with the nesecary dependencies
 * such as mysql, includes, basic security, etc.
 * 
 * It will take no ***ACTIVE*** role in the rest of the script executing;
 * this will be done by dependancies. It is merely a passive 'overseer'
 * of the whole script.
 */

ob_start();
session_start();
// Security purposes.
$safe = true;
if (strstr($_SERVER['PHP_SELF'],'funcs.php')) {
    exit;
}

// Undo Magic Quotes
if(get_magic_quotes_gpc()) {
	function stripslashes_deep($value) {
		return is_array($value) ? array_map('stripslashes_deep', $value) : stripslashes($value);
	}
	$_POST = stripslashes_deep($_POST);
	$_GET = stripslashes_deep($_GET);
	$_REQUEST = stripslashes_deep($_REQUEST);
	$_COOKIE = stripslashes_deep($_COOKIE);
}


// Include config file for mysql
$dir = dirname(__FILE__).'/';
if(file_exists($dir.'config.php') && $installed==true) {
    include $dir.'config.php';
} else {
    header("Location: install/");
    die;
}

mysql_connect($db['server'],$db['username'],$db['password']) or trigger_error('MySQL Error: '.mysql_error(), E_USER_ERROR);
mysql_select_db($db['database']) or trigger_error('MySQL Error: '.mysql_error(), E_USER_ERROR);

// We now get all of the config stuff... and put them into
// a variable
$getconfig = mysql_query('SELECT name,value FROM gc_ddl_config');
if (mysql_num_rows($getconfig) > 0) {
    while ($cfg = mysql_fetch_assoc($getconfig)) {
        $SETTINGS[$cfg['name']] = unserialize($cfg['value']);
    }
} else {
    header("Location: install/");
    echo '<a href"install">Click here to start the installation.</a>';
	die;
}

// Now we include all files in the includes/ directory that starts
// with fn_ and ends with .php
if(opendir($dir.'includes/')) {
    while(($file = readdir($includes)) !== false) {
        if((substr($file,0,6) == 'gcddl_' || substr($file,0,6) == 'tmplt_') && substr($file,-4) == '.php') {
                include $dir.'includes/'.$file;
        }
    }
    closedir($includes);
} else {
    header("Location: install/");
    echo '<a href"install">Click here to start the installation.</a>';
	die;
}

// Use custom error handling.
function error_handler($errno, $errstr, $errfile, $errline) {
	global $SETTINGS;
		
	if($SETTINGS['debug_mode']==true) {
		printf("<br />\n<b>%s</b>: %s in <b>%s</b> on line <b>%d</b><br /><br />\n", $errors, $errstr, $errfile, $errline);
	} else {
		error_log(sprintf("PHP %s:  %s in %s on line %d", $errors, $errstr, $errfile, $errline));
	}
}
set_error_handler('error_handler');

// Start up the phpBB2 Template Engine
$template = new Template($dir.'/templates/default/');

// Start up the modules system - maybe move to earlier in execution?
$modules = new Modules();

// Start up hooks
$hooks = new Hooks();
?>
