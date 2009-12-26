<?php
ob_start();
session_start();
// Security purposes.
$safe = true;
if (strstr($_SERVER['PHP_SELF'],'funcs.php')) {
    exit;
}

// Undo Magic Quotes
function stripslashes_deep(&$value) {
	$value = is_array($value) ? array_map('stripslashes_deep', $value) : stripslashes($value);
}

if(get_magic_quotes_gpc()) {
	stripslashes_deep($_POST);
	stripslashes_deep($_GET);
	stripslashes_deep($_REQUEST);
	stripslashes_deep($_COOKIE);
}

$dir = dirname(__FILE__) . '/';

if(file_exists($dir.'config.php')) {
    include $dir.'config.php';
} else {
    header("Location: install/");
    die;
}

mysql_connect($db[0],$db[1],$db[2]) or die (mysql_error());
mysql_select_db($db[3]) or die (mysql_error());

// Now we include all files in the includes/ directory that starts
// with fn_ and ends with .php
$includes = opendir($dir.'includes/');
if($includes) {
    while(($file = readdir($includes)) !== false) {
        if((substr($file,0,3) == 'fn_' || substr($file,0,6) == 'tmplt_') && substr($file,-4) == '.php') {
                include $dir.'includes/'.$file;
        }
    }
    closedir($includes);
} else {
    header("Location: install/");
    echo '<a href"install">Click here to start the installation.</a>';
	die;
}

// We now get all of the config stuff... and put them into
// a variable
$getconfig = mysql_query('select name,value from gc_ddl_config');
if (mysql_num_rows($getconfig) > 0) {
    while ($cfg = mysql_fetch_assoc($getconfig)) {
        $SETTINGS[$cfg['name']] = unserialize($cfg['value']);
    }
} else {
    header("Location: install/");
    echo '<a href"install">Click here to start the installation.</a>';
	die;
}
// Start up the phpBB2 Template Engine
$template = new Template($dir.'/templates/default/');
?>
