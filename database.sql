-- ----------------------------
-- Table structure for `gcddl_categories`
-- ----------------------------
DROP TABLE IF EXISTS `gcddl_categories`;
CREATE TABLE `gcddl_categories` (
  `id` int(11) NOT NULL auto_increment,
  `cat_slug` varchar(255) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
);

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
-- Table structure for `gcddl_queued`
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
);
