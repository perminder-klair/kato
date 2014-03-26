# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.6.13)
# Database: kato2
# Generation Time: 2014-03-26 15:48:50 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table demo
# ------------------------------------------------------------

DROP TABLE IF EXISTS `demo`;

CREATE TABLE `demo` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` text,
  `tags` text,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `demo` WRITE;
/*!40000 ALTER TABLE `demo` DISABLE KEYS */;

INSERT INTO `demo` (`id`, `title`, `description`, `tags`, `create_time`, `update_time`, `active`, `deleted`)
VALUES
	(7,'Demo-1','nice\r\n**bold**','test','2014-03-26 10:58:35','2014-03-26 10:59:05',1,0);

/*!40000 ALTER TABLE `demo` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table kato_auth_assignment
# ------------------------------------------------------------

DROP TABLE IF EXISTS `kato_auth_assignment`;

CREATE TABLE `kato_auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `biz_rule` text,
  `data` text,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `kato_auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `kato_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `kato_auth_assignment` WRITE;
/*!40000 ALTER TABLE `kato_auth_assignment` DISABLE KEYS */;

INSERT INTO `kato_auth_assignment` (`item_name`, `user_id`, `biz_rule`, `data`)
VALUES
	('admin','1',NULL,NULL);

/*!40000 ALTER TABLE `kato_auth_assignment` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table kato_auth_item
# ------------------------------------------------------------

DROP TABLE IF EXISTS `kato_auth_item`;

CREATE TABLE `kato_auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `biz_rule` text,
  `data` text,
  PRIMARY KEY (`name`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `kato_auth_item` WRITE;
/*!40000 ALTER TABLE `kato_auth_item` DISABLE KEYS */;

INSERT INTO `kato_auth_item` (`name`, `type`, `description`, `biz_rule`, `data`)
VALUES
	('admin',2,'Administrator',NULL,NULL);

/*!40000 ALTER TABLE `kato_auth_item` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table kato_auth_item_child
# ------------------------------------------------------------

DROP TABLE IF EXISTS `kato_auth_item_child`;

CREATE TABLE `kato_auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `kato_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `kato_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kato_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `kato_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table kato_block
# ------------------------------------------------------------

DROP TABLE IF EXISTS `kato_block`;

CREATE TABLE `kato_block` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(70) NOT NULL DEFAULT '',
  `slug` varchar(70) NOT NULL DEFAULT '',
  `content` text,
  `content_html` text,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `parent` varchar(70) DEFAULT NULL,
  `listing_order` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `kato_block` WRITE;
/*!40000 ALTER TABLE `kato_block` DISABLE KEYS */;

INSERT INTO `kato_block` (`id`, `title`, `slug`, `content`, `content_html`, `create_time`, `created_by`, `update_time`, `updated_by`, `parent`, `listing_order`, `status`, `deleted`)
VALUES
	(1,'Contact Intro','contact-intro','If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.','<p>If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.</p>\r\n','2013-10-27 18:14:48',0,'2014-03-11 12:50:15',1,'contact',NULL,1,0);

/*!40000 ALTER TABLE `kato_block` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table kato_blog
# ------------------------------------------------------------

DROP TABLE IF EXISTS `kato_blog`;

CREATE TABLE `kato_blog` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(70) NOT NULL DEFAULT '',
  `short_desc` varchar(160) DEFAULT NULL,
  `content` text,
  `content_html` text,
  `slug` varchar(70) DEFAULT NULL,
  `tags` text,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) unsigned NOT NULL,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `publish_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `published_by` int(11) unsigned DEFAULT NULL,
  `is_revision` tinyint(25) NOT NULL DEFAULT '0',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table kato_content_media
# ------------------------------------------------------------

DROP TABLE IF EXISTS `kato_content_media`;

CREATE TABLE `kato_content_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content_id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL,
  `media_type` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table kato_media
# ------------------------------------------------------------

DROP TABLE IF EXISTS `kato_media`;

CREATE TABLE `kato_media` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL DEFAULT '',
  `source` varchar(255) DEFAULT NULL,
  `source_location` varchar(255) DEFAULT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `extension` varchar(50) DEFAULT '',
  `mimeType` varchar(50) DEFAULT '',
  `byteSize` int(10) unsigned NOT NULL,
  `status` tinyint(5) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table kato_page
# ------------------------------------------------------------

DROP TABLE IF EXISTS `kato_page`;

CREATE TABLE `kato_page` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(70) NOT NULL DEFAULT '',
  `short_desc` varchar(160) DEFAULT NULL,
  `content` text,
  `content_html` text,
  `slug` varchar(70) DEFAULT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `level` tinyint(4) NOT NULL DEFAULT '1',
  `layout` varchar(25) NOT NULL DEFAULT 'default',
  `parent_id` int(10) NOT NULL DEFAULT '0',
  `type` tinyint(4) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `kato_page` WRITE;
/*!40000 ALTER TABLE `kato_page` DISABLE KEYS */;

INSERT INTO `kato_page` (`id`, `title`, `short_desc`, `content`, `content_html`, `slug`, `create_time`, `created_by`, `update_time`, `updated_by`, `level`, `layout`, `parent_id`, `type`, `status`, `deleted`)
VALUES
	(1,'About Us','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sodales imperdiet leo, a suscipit est lacinia vitae. Aliquam blandit, massa...','## Information About Us\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sodales imperdiet leo, a suscipit est lacinia vitae. Aliquam blandit, massa eget vulputate luctus, nulla tellus ultrices tellus, ac elementum nibh lorem non nulla. Nulla ut sagittis erat. Curabitur posuere eleifend porta. Duis dignissim eleifend lobortis. Mauris vulputate gravida elementum. Vestibulum non sagittis elit. Nulla eu adipiscing sem. Phasellus in volutpat sapien. Donec ut pretium ligula. Phasellus non accumsan ligula.','<h2>Information About Us</h2>\n\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sodales imperdiet leo, a suscipit est lacinia vitae. Aliquam blandit, massa eget vulputate luctus, nulla tellus ultrices tellus, ac elementum nibh lorem non nulla. Nulla ut sagittis erat. Curabitur posuere eleifend porta. Duis dignissim eleifend lobortis. Mauris vulputate gravida elementum. Vestibulum non sagittis elit. Nulla eu adipiscing sem. Phasellus in volutpat sapien. Donec ut pretium ligula. Phasellus non accumsan ligula.</p>\n','about-us','2013-10-27 09:48:13',0,'2014-03-10 17:11:18',1,1,'default',2,1,1,0);

/*!40000 ALTER TABLE `kato_page` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table kato_setting
# ------------------------------------------------------------

DROP TABLE IF EXISTS `kato_setting`;

CREATE TABLE `kato_setting` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `define` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `value` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `kato_setting` WRITE;
/*!40000 ALTER TABLE `kato_setting` DISABLE KEYS */;

INSERT INTO `kato_setting` (`id`, `define`, `value`)
VALUES
	(1,'site_name','Kato'),
	(2,'home_meta_description',NULL),
	(3,'home_meta_keywords',NULL),
	(4,'admin_email',NULL),
	(5,'twitter',NULL),
	(6,'facebook',NULL),
	(7,'telephone',NULL),
	(8,'mobile',NULL),
	(9,'address',NULL);

/*!40000 ALTER TABLE `kato_setting` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table kato_tag
# ------------------------------------------------------------

DROP TABLE IF EXISTS `kato_tag`;

CREATE TABLE `kato_tag` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `frequency` int(11) NOT NULL DEFAULT '0',
  `tag_type` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table kato_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `kato_user`;

CREATE TABLE `kato_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(32) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(10) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `login_ip` varchar(20) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `kato_user` WRITE;
/*!40000 ALTER TABLE `kato_user` DISABLE KEYS */;

INSERT INTO `kato_user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `role`, `status`, `create_time`, `update_time`, `login_ip`, `login_time`)
VALUES
	(1,'admin','CCIwu98zZwmGrJRarrUinrdKtfrfO1_E','$2y$13$91cNAK1OdvUPExikkwnplOO1IvjBld.x2UQcIJfuvm2eGuACJrvdS',NULL,'perminder.klair@gmail.com','admin',1,'2014-03-20 19:49:58','2014-03-26 15:24:26','','2014-03-20 09:56:59');

/*!40000 ALTER TABLE `kato_user` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table kato_user_profile
# ------------------------------------------------------------

DROP TABLE IF EXISTS `kato_user_profile`;

CREATE TABLE `kato_user_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  `full_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `kato_user_profile` WRITE;
/*!40000 ALTER TABLE `kato_user_profile` DISABLE KEYS */;

INSERT INTO `kato_user_profile` (`id`, `user_id`, `create_time`, `update_time`, `full_name`)
VALUES
	(1,1,'2014-03-20 19:49:58','2014-03-20 19:49:58','Parminder');

/*!40000 ALTER TABLE `kato_user_profile` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_migration
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_migration`;

CREATE TABLE `tbl_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `tbl_migration` WRITE;
/*!40000 ALTER TABLE `tbl_migration` DISABLE KEYS */;

INSERT INTO `tbl_migration` (`version`, `apply_time`)
VALUES
	('m000000_000000_base',1393605777),
	('m130524_201442_init',1393605789);

/*!40000 ALTER TABLE `tbl_migration` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
