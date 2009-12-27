/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50024
Source Host           : localhost:3306
Source Database       : gc_ddl

Target Server Type    : MYSQL
Target Server Version : 50024
File Encoding         : 65001

Date: 2009-12-26 21:43:54
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `gcddl_categories`
-- ----------------------------
DROP TABLE IF EXISTS `gcddl_categories`;
CREATE TABLE `gcddl_categories` (
  `id` int(11) NOT NULL auto_increment,
  `shortname` varchar(255) NOT NULL,
  `displayname` varchar(255) NOT NULL,
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
);

-- ----------------------------
-- Records of gcddl_config
-- ----------------------------
INSERT INTO `gcddl_config` VALUES ('sitename', 's:15:"global $config;";', 'What is the name of your DDL site?', '');
INSERT INTO `gcddl_config` VALUES ('slogan', 's:49:"visit our website for modifications and templates";', 'What is the slogan of your site?', '');
INSERT INTO `gcddl_config` VALUES ('description', 's:22:"an advanced ddl script";', 'Describe your DDL site a bit.', '');
INSERT INTO `gcddl_config` VALUES ('keywords', 's:11:"open,source";', 'List some keywords, so that when people search these, your site will come up easier.', '');

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
);

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
);

-- ----------------------------
-- Records of gcddl_queue
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
);

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
);

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
  `activation_key` varchar(10) NOT NULL DEFAULT '', 
  PRIMARY KEY  (`id`)
);

-- ----------------------------
-- Records of gcddl_users
-- ----------------------------
INSERT INTO `gcddl_users` VALUES ('1', 'test', '098f6bcd4621d373cade4e832627b4f6', 'test@test.com', '0', '1');
