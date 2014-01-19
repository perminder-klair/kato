# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.6.13)
# Database: kato2
# Generation Time: 2014-01-19 18:44:07 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


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
	(1,'Contact Intro','contact-intro','Please fill the following:','<p>test content</p>\n','2013-10-27 18:14:48',0,'2013-10-27 18:51:39',1,'contact',NULL,1,0),
	(2,'test','test','test test test','<p>test test test</p>\n','2013-10-27 18:49:35',0,'2013-10-27 19:18:35',1,'',NULL,1,0);

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
  `slug` varchar(70) NOT NULL DEFAULT '',
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

LOCK TABLES `kato_blog` WRITE;
/*!40000 ALTER TABLE `kato_blog` DISABLE KEYS */;

INSERT INTO `kato_blog` (`id`, `title`, `short_desc`, `content`, `content_html`, `slug`, `tags`, `create_time`, `created_by`, `update_time`, `updated_by`, `publish_time`, `published_by`, `is_revision`, `parent_id`, `status`, `deleted`)
VALUES
	(6,'test','','test','','','','2013-11-25 20:55:24',1,'2013-11-25 20:55:24',NULL,'2013-11-25 20:55:24',NULL,0,0,0,0),
	(7,'test','','',NULL,'','','2013-11-25 21:24:30',1,'2013-11-25 21:24:30',NULL,'2013-11-25 21:24:30',NULL,0,0,0,0),
	(8,'test','','',NULL,'','','2013-11-25 21:28:49',1,'2013-11-25 21:28:49',NULL,'2013-11-25 21:28:49',NULL,0,0,0,0),
	(9,'New Post','test test test s...','test test test s','<p>test test test s</p>\n','new-post','','2013-11-25 21:33:47',1,'2013-11-25 21:51:51',1,'2013-11-25 21:33:47',NULL,0,0,0,0),
	(10,'New Post 9','','',NULL,'','','2013-11-25 21:58:05',1,'2013-11-25 21:58:05',NULL,'2013-11-25 21:58:05',NULL,0,0,0,0);

/*!40000 ALTER TABLE `kato_blog` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table kato_media
# ------------------------------------------------------------

DROP TABLE IF EXISTS `kato_media`;

CREATE TABLE `kato_media` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL DEFAULT '',
  `source` varchar(255) DEFAULT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `extension` varchar(50) DEFAULT '',
  `mimeType` varchar(50) DEFAULT '',
  `byteSize` int(10) unsigned NOT NULL,
  `media_type` tinyint(4) DEFAULT NULL,
  `published` tinyint(5) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `kato_media` WRITE;
/*!40000 ALTER TABLE `kato_media` DISABLE KEYS */;

INSERT INTO `kato_media` (`id`, `filename`, `source`, `create_time`, `extension`, `mimeType`, `byteSize`, `media_type`, `published`)
VALUES
	(17,'BHVicYICMAAdHGv.jpg','files/2013-10-44/BHVicYICMAAdHGv.jpg','2013-10-29 23:27:15','jpg','image/jpeg',102804,NULL,1),
	(18,'BHVicYICMAAdHGv.jpg','files/2013-10-44/BHVicYICMAAdHGv.jpg','2013-10-29 23:29:20','jpg','image/jpeg',102804,NULL,1),
	(19,'BHVicYICMAAdHGv.jpg','files/2013-10-44/BHVicYICMAAdHGv.jpg','2013-10-29 23:30:17','jpg','image/jpeg',102804,NULL,1),
	(20,'BHVicYICMAAdHGv.jpg','files/2013-10-44/BHVicYICMAAdHGv.jpg','2013-10-29 23:30:35','jpg','image/jpeg',102804,NULL,1),
	(21,'BHVicYICMAAdHGv.jpg','files/2013-10-44/BHVicYICMAAdHGv.jpg','2013-10-29 23:31:25','jpg','image/jpeg',102804,NULL,1),
	(22,'BHVicYICMAAdHGv.jpg','files/2013-10-44/BHVicYICMAAdHGv.jpg','2013-10-29 23:31:38','jpg','image/jpeg',102804,NULL,1),
	(23,'BHVicYICMAAdHGv.jpg','files/2013-11-45/BHVicYICMAAdHGv.jpg','2013-11-06 18:54:49','jpg','image/jpeg',102804,NULL,1),
	(24,'BHVicYICMAAdHGv.jpg','files/2013-11-45/BHVicYICMAAdHGv.jpg','2013-11-06 18:54:54','jpg','image/jpeg',102804,NULL,1);

/*!40000 ALTER TABLE `kato_media` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table kato_page
# ------------------------------------------------------------

DROP TABLE IF EXISTS `kato_page`;

CREATE TABLE `kato_page` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(70) NOT NULL DEFAULT '',
  `short_desc` varchar(160) DEFAULT NULL,
  `content` text,
  `content_html` text,
  `slug` varchar(70) NOT NULL DEFAULT '',
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
	(1,'About Us','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sodales imperdiet leo, a suscipit est lacinia vitae. Aliquam blandit, massa...','## Information About Us\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sodales imperdiet leo, a suscipit est lacinia vitae. Aliquam blandit, massa eget vulputate luctus, nulla tellus ultrices tellus, ac elementum nibh lorem non nulla. Nulla ut sagittis erat. Curabitur posuere eleifend porta. Duis dignissim eleifend lobortis. Mauris vulputate gravida elementum. Vestibulum non sagittis elit. Nulla eu adipiscing sem. Phasellus in volutpat sapien. Donec ut pretium ligula. Phasellus non accumsan ligula.','<h2>Information About Us</h2>\n\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sodales imperdiet leo, a suscipit est lacinia vitae. Aliquam blandit, massa eget vulputate luctus, nulla tellus ultrices tellus, ac elementum nibh lorem non nulla. Nulla ut sagittis erat. Curabitur posuere eleifend porta. Duis dignissim eleifend lobortis. Mauris vulputate gravida elementum. Vestibulum non sagittis elit. Nulla eu adipiscing sem. Phasellus in volutpat sapien. Donec ut pretium ligula. Phasellus non accumsan ligula.</p>\n','about-us','2013-10-27 09:48:13',0,'2013-10-27 16:10:24',1,1,'default',0,NULL,1,0),
	(2,'New Page 1','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sodales imperdiet leo, a suscipit est lacinia vitae. Aliquam blandit, massa...','## Information About Us\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sodales imperdiet leo, a suscipit est lacinia vitae. Aliquam blandit, massa eget vulputate luctus, nulla tellus ultrices tellus, ac elementum nibh lorem non nulla. Nulla ut sagittis erat. Curabitur posuere eleifend porta. Duis dignissim eleifend lobortis. Mauris vulputate gravida elementum. Vestibulum non sagittis elit. Nulla eu adipiscing sem. Phasellus in volutpat sapien. Donec ut pretium ligula. Phasellus non accumsan ligula.','<h2>Information About Us</h2>\n\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sodales imperdiet leo, a suscipit est lacinia vitae. Aliquam blandit, massa eget vulputate luctus, nulla tellus ultrices tellus, ac elementum nibh lorem non nulla. Nulla ut sagittis erat. Curabitur posuere eleifend porta. Duis dignissim eleifend lobortis. Mauris vulputate gravida elementum. Vestibulum non sagittis elit. Nulla eu adipiscing sem. Phasellus in volutpat sapien. Donec ut pretium ligula. Phasellus non accumsan ligula.</p>\n','new-page-1','2013-10-27 15:17:31',1,'2013-10-27 16:10:25',1,1,'default',0,NULL,1,0);

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

LOCK TABLES `kato_tag` WRITE;
/*!40000 ALTER TABLE `kato_tag` DISABLE KEYS */;

INSERT INTO `kato_tag` (`id`, `name`, `frequency`, `tag_type`)
VALUES
	(36,'tag2',6,'blog2'),
	(37,'tag',2,'blog2'),
	(38,'tag2',3,'blog'),
	(40,'test',1,NULL),
	(41,'blog',1,'blog');

/*!40000 ALTER TABLE `kato_tag` ENABLE KEYS */;
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
	('m000000_000000_base',1385410023),
	('m130524_201442_init',1385410051);

/*!40000 ALTER TABLE `tbl_migration` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_user`;

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(32) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT '10',
  `status` tinyint(4) NOT NULL DEFAULT '10',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tbl_user` WRITE;
/*!40000 ALTER TABLE `tbl_user` DISABLE KEYS */;

INSERT INTO `tbl_user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `role`, `status`, `create_time`, `update_time`)
VALUES
	(1,'admin','YMw5yC_XxI4paVY0qbAw8e4-KQlFQsw8','$2y$13$31AhCCkvObHnhTD8xIbtsuG/GCBeZUXD/u3NDo5t6OeR0MzQAXCG.',NULL,'perminder.klair@gmail.com',10,10,1385410334,1385410334);

/*!40000 ALTER TABLE `tbl_user` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
