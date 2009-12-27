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
		
		echo "<br />\n<br />\n";
		
		// Mysql Check
		if(!function_exists("mysql_query")) {
			echo 'Mysql extension not installed!';
			$error=true;
		} else {
			echo 'Mysql extension installed!';
		}
		
		echo "<br />\n<br />\n";
		if(!is_writable('../config.php')) {
			echo 'config.php isnt writable! Please chmod to 775 or 777!';
			$error=true;
		} else {
			echo 'config.php writable!';
		}
		
		echo "<br />\n<br />\n";
		
		/* CHECK OTHER DEPENDANCIES HERE */
		
		// Continue
		if($error) {
			echo 'Fix errors and refresh this page.';
		} else {
			echo '<form method="get"><input type="hidden" name="step" value="1" /><input type="submit" value="Continue" /></form>';
		}
		
		break;
	
	case 1:
		if($_POST) {
			// Test mysql connection, then redirect to step 2
			if(mysql_connect($_POST['server'], $_POST['username'], $_POST['password']) and mysql_select_db($_POST['database'])) {
				echo 'Mysql connection successful.<br /><a href="?step=2">Continue &raquo;</a>';
			} else {
				echo 'Cannot connect: '.mysql_error();
				echo '<br /><a href="?step=1">&laquo;Try Again</a>';
			}
			
			$writevars = var_export(array('server' => $_POST['server'], 'username' => $_POST['username'],
				'password' => $_POST['password'], 'database' => $_POST['database']), true);
			
			$configfile=<<<FILE
<?php
if (!\$safe) {
    exit;
}
\$installed = true;
\$db = $writevars;
?>
FILE;
			
			$fp = fopen('../config.php', 'w');
			fwrite($fp, $configfile);
			fclose($fp);
		} else {
			echo '<form action="?step=1" method="post">
				Server:
				<input type="text" name="server" value="localhost" />
				<br />
				
				Username:
				<input type="text" name="username" />
				<br />
				
				Password:
				<input type="password" name="password" />
				<br />
				
				Database:
				<input type="text" name="database" />
				<br />
				
				<input type="submit" value="Configure Mysql" />
			</form>';
		}
		break;
		
	case 2:
		// Create mysql structure
		require_once "../config.php";
		mysql_connect($db['server'], $db['username'], $db['password']) or die(mysql_error());
		mysql_select_db($db['database']) or die(mysql_error());
		
		$mysql=<<<MYSQL
-- ----------------------------
-- Table structure for gcddl_categories
-- ----------------------------
DROP TABLE IF EXISTS `gcddl_categories`;
CREATE TABLE `gcddl_categories` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
);

-- ----------------------------
-- Table structure for gcddl_config
-- ----------------------------
DROP TABLE IF EXISTS `gcddl_config`;
CREATE TABLE `gcddl_config` (
  `name` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `desc` text NOT NULL,
  `possible` text NOT NULL,
  PRIMARY KEY  (`name`)
);

-- ----------------------------
-- Table structure for gcddl_downloads
-- ----------------------------
DROP TABLE IF EXISTS `gcddl_downloads`;
CREATE TABLE `gcddl_downloads` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `url` text NOT NULL,
  `sid` int(11) NOT NULL,
  `cat` int(11) NOT NULL,
  `views` int(11) NOT NULL default '0',
  `date` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
);

-- ----------------------------
-- Table structure for gcddl_queued
-- ----------------------------
DROP TABLE IF EXISTS `gcddl_queued`;
CREATE TABLE `gcddl_queued` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `url` text NOT NULL,
  `sid` int(11) NOT NULL,
  `cat` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
);

-- ----------------------------
-- Table structure for gcddl_sites
-- ----------------------------
DROP TABLE IF EXISTS `gcddl_sites`;
CREATE TABLE `gcddl_sites` (
  `id` int(11) NOT NULL auto_increment,
  `sname` varchar(255) NOT NULL,
  `surl` varchar(255) NOT NULL,
  `semail` varchar(255) NOT NULL,
  `firstsub` int(11) NOT NULL,
  `lastsub` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
);

-- ----------------------------
-- Table structure for gcddl_users
-- ----------------------------
DROP TABLE IF EXISTS `gcddl_users`;
CREATE TABLE `gcddl_users` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(255) NOT NULL,
  `password` char(32) NOT NULL,
  `email` varchar(255) NOT NULL,
  `reg_date` int(11) NOT NULL,
  `is_admin` int(1) NOT NULL,
  PRIMARY KEY  (`id`)
);
MYSQL;
		mysql_query($mysql);
		
		echo 'Database structure inserted<br /><a href="?step=3">Continue $raquo;</a>';
}
?>
