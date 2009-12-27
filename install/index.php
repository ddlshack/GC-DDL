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
		$safe=true;
		require_once "../config.php";
		mysql_connect($db['server'], $db['username'], $db['password']) or die(mysql_error());
		mysql_select_db($db['database']) or die(mysql_error());
		
		$mysql=<<<MYSQL

DROP TABLE IF EXISTS `gcddl_categories`;
CREATE TABLE `gcddl_categories` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
);

DROP TABLE IF EXISTS `gcddl_config`;
CREATE TABLE `gcddl_config` (
  `name` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `desc` text NOT NULL,
  `possible` text NOT NULL,
  PRIMARY KEY  (`name`)
);

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
		foreach(explode(";", $mysql) as $query) {
			if(trim($query)) {
				mysql_query($query) or die(mysql_error());
			}
		}
		
		echo 'Database structure inserted<br /><a href="?step=3">Continue &raquo;</a>';
		break;
	
	case 3:
		// Collect data from user about site etc.
		print_r($_POST);
		if($_POST) {
			if(empty($POST['sitename']) || empty($POST['slogan']) || empty($POST['siteurl']) || empty($POST['sitepath'])) {
				echo 'Error: Blank fields<br /><a href="?step=3">&laquo; Try Again</a>';
			} else {
				mysql_query("INSERT INTO `gcddl_config` VALUES ('sitename', '".mysql_real_escape_string(serialize($_POST['sitename']))."', 'What is the name of your DDL site?', '')");
				mysql_query("INSERT INTO `gcddl_config` VALUES ('slogan', '".mysql_real_escape_string(serialize($_POST['slogan']))."', 'What is the slogan of your site?', '')");
				mysql_query("INSERT INTO `gcddl_config` VALUES ('siteurl', '".mysql_real_escape_string(serialize($_POST['siteurl']))."', 'What is the url to your site, with no leading slash?', '')");
				mysql_query("INSERT INTO `gcddl_config` VALUES ('sitepath', '".mysql_real_escape_string(serialize($_POST['sitepath']))."', 'What is the path to your sites root directory, with no leading slash?', '')");
				
				echo 'Site configured successfully<br /><a href="?step=4">Continue &raquo;</a>';
			}
		} else {
			
			$dir=dirname(__FILE__);
			echo 'Please Tell us some information about your site:<br /><br />';
			echo '<form action="?step=3" method="post">
			Site Name:
			<input type="text name="sitename" />
			<br />
			
			Slogan:
			<input type="text name="slogan" />
			<br />
			
			Site URL:
			<input type="text name="siteurl" value="'.htmlentities('http://'.($_SERVER['HTTPS']=='on' ? 's' : '').$_SERVER['HTTP_HOST'].dirname(dirname($_SERVER['REQUEST_URI']))).'" />
			(No trailing slash)<br />
			
			Site Path:
			<input type="text name="sitepath" value="'.htmlentities($dir).'" />
			(no trailing slash)<br />
			
			<input type="submit" value="Continue &raquo;" />
			
			</form>';
		}
}
?>
