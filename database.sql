/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50024
Source Host           : localhost:3306
Source Database       : gc_ddl

Target Server Type    : MYSQL
Target Server Version : 50024
File Encoding         : 65001

Date: 2009-12-27 14:16:03
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
INSERT INTO `gcddl_config` VALUES ('sitename', 's:15:\"global $config;\";', 'What is the name of your DDL site?', '');
INSERT INTO `gcddl_config` VALUES ('slogan', 's:49:\"visit our website for modifications and templates\";', 'What is the slogan of your site?', '');
INSERT INTO `gcddl_config` VALUES ('description', 's:22:\"an advanced ddl script\";', 'Describe your DDL site a bit.', '');
INSERT INTO `gcddl_config` VALUES ('keywords', 's:11:\"open,source\";', 'List some keywords, so that when people search these, your site will come up easier.', '');
INSERT INTO `gcddl_config` VALUES ('debug_mode', 'i:0;', 'Do you want to enabled Debug Mode?', 'a:2:{i:0;s:2:\"No\";i:1;s:3:\"Yes\";}');
INSERT INTO `gcddl_config` VALUES ('login_attempts', 'i:5;', 'How many times do you want to allow a user to try logging in before locking them out (via Cookie)?', 'a:5:{i:1;s:1:\"1\";i:3;s:1:\"3\";i:5;s:1:\"5\";i:7;s:1:\"7\";i:10;s:2:\"10\";}');
INSERT INTO `gcddl_config` VALUES ('allow_dupes', 'i:1;', 'Do you want to allow duplicate downloads to be submitted?', 'a:2:{i:0;s:2:\"No\";i:1;s:3:\"Yes\";}');
INSERT INTO `gcddl_config` VALUES ('allow_dupes_every_when', 'i:1;', 'Every when do you want to allow duplicate downloads to be submitted?', 'a:5:{i:0;s:5:\"Never\";i:1;s:6:\"1 Week\";i:2;s:7:\"2 Weeks\";i:3;s:7:\"3 Weeks\";i:4;s:7:\"1 Month\";}');

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
-- Table structure for `gcddl_queue`
-- ----------------------------
DROP TABLE IF EXISTS `gcddl_queue`;
CREATE TABLE `gcddl_queue` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `url` text NOT NULL,
  `sid` int(11) NOT NULL,
  `cat` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of gcddl_queue
-- ----------------------------

-- ----------------------------
-- Table structure for `gcddl_queue`
-- ----------------------------
DROP TABLE IF EXISTS `gcddl_queue`;
CREATE TABLE `gcddl_queue` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `url` text NOT NULL,
  `sid` int(11) NOT NULL,
  `cat` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of gcddl_queued
-- ----------------------------

-- ----------------------------
-- Table structure for `gcddl_sites`
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of gcddl_sites
-- ----------------------------

-- ----------------------------
-- Table structure for `gcddl_users`
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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of gcddl_users
-- ----------------------------
INSERT INTO `gcddl_users` VALUES ('1', 'test', '098f6bcd4621d373cade4e832627b4f6', 'test@test.com', '0', '1');
