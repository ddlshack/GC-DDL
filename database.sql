/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50024
Source Host           : localhost:3306
Source Database       : gc_ddl

Target Server Type    : MYSQL
Target Server Version : 50024
File Encoding         : 65001

Date: 2009-12-26 21:12:15
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `gcddl_categories`
-- ----------------------------
DROP TABLE IF EXISTS `gcddl_categories`;
CREATE TABLE `gcddl_categories` (
  `id` int(11) NOT NULL auto_increment,
  `cat_slug` varchar(255) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of gcddl_categories
-- ----------------------------
INSERT INTO `gcddl_categories` VALUES ('1', 'app', 'Applications');
INSERT INTO `gcddl_categories` VALUES ('2', 'movie', 'Movies');
INSERT INTO `gcddl_categories` VALUES ('3', 'music', 'Music');
INSERT INTO `gcddl_categories` VALUES ('4', 'game', 'Games');
INSERT INTO `gcddl_categories` VALUES ('5', 'xxx', 'XXX');
INSERT INTO `gcddl_categories` VALUES ('6', 'tv', 'Television Shows');
INSERT INTO `gcddl_categories` VALUES ('7', 'ebook', 'eBooks');
INSERT INTO `gcddl_categories` VALUES ('8', 'other', 'Others');

-- ----------------------------
-- Table structure for `gcddl_config`
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
-- Records of gcddl_config
-- ----------------------------
INSERT INTO `gcddl_config` VALUES ('sitename', 's:18:\"File Empire DDL\\\'s\";', 'What is the name of your site?', '');
INSERT INTO `gcddl_config` VALUES ('slogan', 's:6:\"asdasd\";', 'The slogan or catch phrase of your site.', '');
INSERT INTO `gcddl_config` VALUES ('description', 's:6:\"sdaasd\";', 'The description of your site.', '');
INSERT INTO `gcddl_config` VALUES ('keywords', 's:6:\"asdasd\";', 'When people search these terms, they should see your site. Separate by commas.', '');
INSERT INTO `gcddl_config` VALUES ('downloads_per_page', 'i:1;', 'How many downloads per page do you want to show?', 'integer');
INSERT INTO `gcddl_config` VALUES ('login_attempts', 'i:10;', 'How many times do you wish to allow an administrator to try logging in before locking them out of the system (via cookie)?', 'integer');
INSERT INTO `gcddl_config` VALUES ('allow_dupes', 'i:0;', 'Do you want to allow duplicate downloads?', 'a:2:{i:1;s:3:\"Yes\";i:0;s:2:\"No\";}');
INSERT INTO `gcddl_config` VALUES ('allow_dupes_every_when', 'i:2;', 'Every how many weeks should a person wait to submit the same downloads more than once?', 'a:4:{i:0;s:7:\"Forever\";i:1;s:6:\"1 Week\";i:2;s:7:\"2 Weeks\";i:3;s:7:\"3 Weeks\";}');
INSERT INTO `gcddl_config` VALUES ('debug_mode', 'i:0;', 'Do you want to enable debug mode?', 'a:2:{i:1;s:5:\"False\";i:0;s:4:\"True\";}');
INSERT INTO `gcddl_config` VALUES ('date_format', 's:5:\"d-m-Y\";', 'How do you want your date to appear on the front page? (This follows the PHP Date format)', '');

-- ----------------------------
-- Table structure for `gcddl_downloads`
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
-- Records of gcddl_downloads
-- ----------------------------

-- ----------------------------
-- Table structure for `gcddl_queued`
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
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of gcddl_queued
-- ----------------------------
INSERT INTO `gcddl_queued` VALUES ('1', 'Test 1', 'http://test.ca/test1', '1', '1', '1261778690');
INSERT INTO `gcddl_queued` VALUES ('2', 'Test 2', 'http://test.ca/test2', '1', '1', '1261778690');
INSERT INTO `gcddl_queued` VALUES ('3', 'Test 3', 'http://test.ca/test3', '1', '2', '1261778690');
INSERT INTO `gcddl_queued` VALUES ('4', 'Test 4', 'http://test.ca/test4', '1', '2', '1261778690');
INSERT INTO `gcddl_queued` VALUES ('5', 'Test 5', 'http://test.ca/test5', '1', '3', '1261778690');
INSERT INTO `gcddl_queued` VALUES ('6', 'Test 6', 'http://test.ca/test6', '1', '3', '1261778690');
INSERT INTO `gcddl_queued` VALUES ('7', 'Test 7', 'http://test.ca/test7', '1', '4', '1261778690');
INSERT INTO `gcddl_queued` VALUES ('8', 'Test 8', 'http://test.ca/test8', '1', '4', '1261778691');
INSERT INTO `gcddl_queued` VALUES ('9', 'Test 9', 'http://test.ca/test9', '1', '6', '1261778691');
INSERT INTO `gcddl_queued` VALUES ('10', 'Test 20', 'http://test.ca/test10', '1', '6', '1261778691');
INSERT INTO `gcddl_queued` VALUES ('11', 'Test 1', 'http://test.ca/test1', '1', '1', '1261778741');
INSERT INTO `gcddl_queued` VALUES ('12', 'Test 2', 'http://test.ca/test2', '1', '1', '1261778741');
INSERT INTO `gcddl_queued` VALUES ('13', 'Test 3', 'http://test.ca/test3', '1', '2', '1261778741');
INSERT INTO `gcddl_queued` VALUES ('14', 'Test 4', 'http://test.ca/test4', '1', '2', '1261778741');
INSERT INTO `gcddl_queued` VALUES ('15', 'Test 5', 'http://test.ca/test5', '1', '3', '1261778741');
INSERT INTO `gcddl_queued` VALUES ('16', 'Test 6', 'http://test.ca/test6', '1', '3', '1261778741');
INSERT INTO `gcddl_queued` VALUES ('17', 'Test 7', 'http://test.ca/test7', '1', '4', '1261778741');
INSERT INTO `gcddl_queued` VALUES ('18', 'Test 8', 'http://test.ca/test8', '1', '4', '1261778741');
INSERT INTO `gcddl_queued` VALUES ('19', 'Test 9', 'http://test.ca/test9', '1', '6', '1261778741');
INSERT INTO `gcddl_queued` VALUES ('20', 'Test 20', 'http://test.ca/test10', '1', '6', '1261778741');
INSERT INTO `gcddl_queued` VALUES ('21', 'ZomG LoL', 'http://lolercakes.com/zomg-lol', '2', '3', '1261779256');
INSERT INTO `gcddl_queued` VALUES ('22', 'asdasdads', 'http://testlol.com/ad', '5', '1', '1261781277');

-- ----------------------------
-- Table structure for `gcddl_sites`
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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of gcddl_sites
-- ----------------------------
INSERT INTO `gcddl_sites` VALUES ('1', 'sadasddsa', 'test.ca', 'asdasd', '1261354099', '1261778741');
INSERT INTO `gcddl_sites` VALUES ('2', 'LolerCakes', 'lolercakes.com', 'admin@lolercakes.com', '1261779256', '1261779256');
INSERT INTO `gcddl_sites` VALUES ('3', 'asdas', 'testlol.ca', 'asdasd', '1261781133', '1261781133');
INSERT INTO `gcddl_sites` VALUES ('4', 'asdasd', 'testlol.com', 'asdasddas', '1261781197', '1261781197');
INSERT INTO `gcddl_sites` VALUES ('5', 'asdsdaads', 'http://testlol.com/', 'asdasddas', '1261781277', '1261781277');

-- ----------------------------
-- Table structure for `gcddl_users`
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
-- Records of gcddl_users
-- ----------------------------
INSERT INTO `gcddl_users` VALUES ('1', 'test', '68358d5d9cbbf39fe571ba41f26524b6', 'test@test.com', '1259408939', '1');
