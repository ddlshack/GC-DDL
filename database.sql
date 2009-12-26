/*
MySQL Data Transfer
Source Host: localhost
Source Database: gcddl
Target Host: localhost
Target Database: gcddl
Date: 21/12/2009 2:50:51 PM
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for gcddl_categories
-- ----------------------------
DROP TABLE IF EXISTS `gcddl_categories`;
CREATE TABLE `gcddl_categories` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for gcddl_sites
-- ----------------------------
DROP TABLE IF EXISTS `gcddl_sites`;
CREATE TABLE `gcddl_sites` (
  `id` int(11) NOT NULL auto_increment,
  `sname` varchar(255) NOT NULL,
  `surl` text NOT NULL,
  `semail` varchar(255) NOT NULL,
  `firstsub` int(11) NOT NULL,
  `lastsub` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for gcddl_users
-- ----------------------------
DROP TABLE IF EXISTS `gcddl_users`;
CREATE TABLE `gcddl_users` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `reg_date` int(11) NOT NULL,
  `is_admin` int(8) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `gcddl_categories` VALUES ('1', 'app', 'Applications');
INSERT INTO `gcddl_categories` VALUES ('2', 'movie', 'Movies');
INSERT INTO `gcddl_categories` VALUES ('3', 'music', 'Music');
INSERT INTO `gcddl_categories` VALUES ('4', 'game', 'Games');
INSERT INTO `gcddl_categories` VALUES ('5', 'xxx', 'XXX');
INSERT INTO `gcddl_categories` VALUES ('6', 'tv', 'Television Shows');
INSERT INTO `gcddl_categories` VALUES ('7', 'ebook', 'eBooks');
INSERT INTO `gcddl_categories` VALUES ('8', 'other', 'Others');
INSERT INTO `gcddl_config` VALUES ('sitename', 's:18:\"File Empire DDL\\\'s\";', 'What is the name of your site?', '');
INSERT INTO `gcddl_config` VALUES ('slogan', 's:6:\"asdasd\";', 'The slogan or catch phrase of your site.', '');
INSERT INTO `gcddl_config` VALUES ('description', 's:6:\"sdaasd\";', 'The description of your site.', '');
INSERT INTO `gcddl_config` VALUES ('keywords', 's:6:\"asdasd\";', 'When people search these terms, they should see your site. Separate by commas.', '');
INSERT INTO `gcddl_config` VALUES ('downloads_per_page', 'i:1;', 'How many downloads per page do you want to show?', 'integer');
INSERT INTO `gcddl_config` VALUES ('login_attempts', 'i:10;', 'How many times do you wish to allow an administrator to try logging in before locking them out of the system (via cookie)?', 'integer');
INSERT INTO `gcddl_config` VALUES ('allow_dupes', 'i:0;', 'Do you want to allow duplicate downloads?', 'a:2:{i:1;s:3:\"Yes\";i:0;s:2:\"No\";}');
INSERT INTO `gcddl_config` VALUES ('allow_dupes_every_when', 'i:2;', 'Every how many weeks should a person wait to submit the same downloads more than once?', 'a:4:{i:0;s:7:\"Forever\";i:1;s:6:\"1 Week\";i:2;s:7:\"2 Weeks\";i:3;s:7:\"3 Weeks\";}');
INSERT INTO `gcddl_queued` VALUES ('1', 'test', 'test.ca/asdasd', '1', '1', '1261354099');
INSERT INTO `gcddl_sites` VALUES ('1', 'sadasddsa', 'test.ca', 'asdasd', '1261354099', '1261354099');
INSERT INTO `gcddl_users` VALUES ('1', 'test', '68358d5d9cbbf39fe571ba41f26524b6', 'test@test.com', '1259408939', '1');
