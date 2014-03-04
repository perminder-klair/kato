-- phpMyAdmin SQL Dump
-- version 4.1.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 04, 2014 at 04:31 PM
-- Server version: 5.6.16
-- PHP Version: 5.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kato2`
--

-- --------------------------------------------------------

--
-- Table structure for table `kato_block`
--

CREATE TABLE IF NOT EXISTS `kato_block` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `kato_block`
--

INSERT INTO `kato_block` (`id`, `title`, `slug`, `content`, `content_html`, `create_time`, `created_by`, `update_time`, `updated_by`, `parent`, `listing_order`, `status`, `deleted`) VALUES
(1, 'Contact Intro', 'contact-intro', 'Please fill the following:', '<p>test content</p>\n', '2013-10-27 18:14:48', 0, '2013-10-27 18:51:39', 1, 'contact', NULL, 1, 0),
(2, 'test', 'test', 'test test test', '<p>test test test</p>\n', '2013-10-27 18:49:35', 0, '2013-10-27 19:18:35', 1, '', NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `kato_blog`
--

CREATE TABLE IF NOT EXISTS `kato_blog` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `kato_blog`
--

INSERT INTO `kato_blog` (`id`, `title`, `short_desc`, `content`, `content_html`, `slug`, `tags`, `create_time`, `created_by`, `update_time`, `updated_by`, `publish_time`, `published_by`, `is_revision`, `parent_id`, `status`, `deleted`) VALUES
(6, 'test test test 33', '...', '<p>\r\n	   **test**\r\n</p>\r\n<p>\r\n	<span style="background-color: rgb(255, 255, 255);"></span>\r\n</p>\r\n<ul>\r\n	<li>dsf</li>\r\n	<li>asdfs</li>\r\n	<li>asdfsf</li>\r\n</ul>\r\n<p>\r\n	   # hello #\r\n</p>\r\n<p>\r\n	   *test test*\r\n</p>\r\n<h1></h1>', '<p>\n       **test**\n</p>\n\n<p>\n    <span style="background-color: rgb(255, 255, 255);"></span>\n</p>\n\n<ul>\n    <li>dsf</li>\n    <li>asdfs</li>\n    <li>asdfsf</li>\n</ul>\n\n<p>\n       # hello #\n</p>\n\n<p>\n       *test test*\n</p>\n\n<h1></h1>\n', 'test-test-test-33', '', '2013-11-25 20:55:24', 1, '2014-03-04 16:26:06', 1, '2013-11-25 20:55:24', NULL, 0, 0, 0, 0),
(7, 'test', '', '', NULL, '', '', '2013-11-25 21:24:30', 1, '2013-11-25 21:24:30', NULL, '2013-11-25 21:24:30', NULL, 0, 0, 0, 0),
(8, 'test', '', '', NULL, '', '', '2013-11-25 21:28:49', 1, '2013-11-25 21:28:49', NULL, '2013-11-25 21:28:49', NULL, 0, 0, 0, 0),
(9, 'New Post', 'test test test s...', 'test test test s', '<p>test test test s</p>\n', 'new-post', '', '2013-11-25 21:33:47', 1, '2013-11-25 21:51:51', 1, '2013-11-25 21:33:47', NULL, 0, 0, 0, 0),
(10, 'New Post 9', '', '', NULL, '', '', '2013-11-25 21:58:05', 1, '2013-11-25 21:58:05', NULL, '2013-11-25 21:58:05', NULL, 0, 0, 0, 0),
(11, 'My last blog', '...', '', '', 'my-last-blog', '', '2014-03-04 16:29:37', 1, '2014-03-04 16:30:00', 1, '2014-03-04 16:29:37', NULL, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `kato_media`
--

CREATE TABLE IF NOT EXISTS `kato_media` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `kato_media`
--

INSERT INTO `kato_media` (`id`, `filename`, `source`, `create_time`, `extension`, `mimeType`, `byteSize`, `media_type`, `published`) VALUES
(17, 'BHVicYICMAAdHGv.jpg', 'files/2013-10-44/BHVicYICMAAdHGv.jpg', '2013-10-29 23:27:15', 'jpg', 'image/jpeg', 102804, NULL, 1),
(18, 'BHVicYICMAAdHGv.jpg', 'files/2013-10-44/BHVicYICMAAdHGv.jpg', '2013-10-29 23:29:20', 'jpg', 'image/jpeg', 102804, NULL, 1),
(19, 'BHVicYICMAAdHGv.jpg', 'files/2013-10-44/BHVicYICMAAdHGv.jpg', '2013-10-29 23:30:17', 'jpg', 'image/jpeg', 102804, NULL, 1),
(20, 'BHVicYICMAAdHGv.jpg', 'files/2013-10-44/BHVicYICMAAdHGv.jpg', '2013-10-29 23:30:35', 'jpg', 'image/jpeg', 102804, NULL, 1),
(21, 'BHVicYICMAAdHGv.jpg', 'files/2013-10-44/BHVicYICMAAdHGv.jpg', '2013-10-29 23:31:25', 'jpg', 'image/jpeg', 102804, NULL, 1),
(22, 'BHVicYICMAAdHGv.jpg', 'files/2013-10-44/BHVicYICMAAdHGv.jpg', '2013-10-29 23:31:38', 'jpg', 'image/jpeg', 102804, NULL, 1),
(23, 'BHVicYICMAAdHGv.jpg', 'files/2013-11-45/BHVicYICMAAdHGv.jpg', '2013-11-06 18:54:49', 'jpg', 'image/jpeg', 102804, NULL, 1),
(24, 'BHVicYICMAAdHGv.jpg', 'files/2013-11-45/BHVicYICMAAdHGv.jpg', '2013-11-06 18:54:54', 'jpg', 'image/jpeg', 102804, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kato_page`
--

CREATE TABLE IF NOT EXISTS `kato_page` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `kato_page`
--

INSERT INTO `kato_page` (`id`, `title`, `short_desc`, `content`, `content_html`, `slug`, `create_time`, `created_by`, `update_time`, `updated_by`, `level`, `layout`, `parent_id`, `type`, `status`, `deleted`) VALUES
(1, 'About Us', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sodales imperdiet leo, a suscipit est lacinia vitae. Aliquam blandit, massa...', '## Information About Us\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sodales imperdiet leo, a suscipit est lacinia vitae. Aliquam blandit, massa eget vulputate luctus, nulla tellus ultrices tellus, ac elementum nibh lorem non nulla. Nulla ut sagittis erat. Curabitur posuere eleifend porta. Duis dignissim eleifend lobortis. Mauris vulputate gravida elementum. Vestibulum non sagittis elit. Nulla eu adipiscing sem. Phasellus in volutpat sapien. Donec ut pretium ligula. Phasellus non accumsan ligula.', '<h2>Information About Us</h2>\n\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sodales imperdiet leo, a suscipit est lacinia vitae. Aliquam blandit, massa eget vulputate luctus, nulla tellus ultrices tellus, ac elementum nibh lorem non nulla. Nulla ut sagittis erat. Curabitur posuere eleifend porta. Duis dignissim eleifend lobortis. Mauris vulputate gravida elementum. Vestibulum non sagittis elit. Nulla eu adipiscing sem. Phasellus in volutpat sapien. Donec ut pretium ligula. Phasellus non accumsan ligula.</p>\n', 'about-us', '2013-10-27 09:48:13', 0, '2013-10-27 16:10:24', 1, 1, 'default', 0, NULL, 1, 0),
(2, 'New Page 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sodales imperdiet leo, a suscipit est lacinia vitae. Aliquam blandit, massa...', '## Information About Us\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sodales imperdiet leo, a suscipit est lacinia vitae. Aliquam blandit, massa eget vulputate luctus, nulla tellus ultrices tellus, ac elementum nibh lorem non nulla. Nulla ut sagittis erat. Curabitur posuere eleifend porta. Duis dignissim eleifend lobortis. Mauris vulputate gravida elementum. Vestibulum non sagittis elit. Nulla eu adipiscing sem. Phasellus in volutpat sapien. Donec ut pretium ligula. Phasellus non accumsan ligula.', '<h2>Information About Us</h2>\n\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sodales imperdiet leo, a suscipit est lacinia vitae. Aliquam blandit, massa eget vulputate luctus, nulla tellus ultrices tellus, ac elementum nibh lorem non nulla. Nulla ut sagittis erat. Curabitur posuere eleifend porta. Duis dignissim eleifend lobortis. Mauris vulputate gravida elementum. Vestibulum non sagittis elit. Nulla eu adipiscing sem. Phasellus in volutpat sapien. Donec ut pretium ligula. Phasellus non accumsan ligula.</p>\n', 'new-page-1', '2013-10-27 15:17:31', 1, '2013-10-27 16:10:25', 1, 1, 'default', 0, NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `kato_setting`
--

CREATE TABLE IF NOT EXISTS `kato_setting` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `define` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `value` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `kato_setting`
--

INSERT INTO `kato_setting` (`id`, `define`, `value`) VALUES
(1, 'site_name', 'Kato'),
(2, 'home_meta_description', NULL),
(3, 'home_meta_keywords', NULL),
(4, 'admin_email', NULL),
(5, 'twitter', NULL),
(6, 'facebook', NULL),
(7, 'telephone', NULL),
(8, 'mobile', NULL),
(9, 'address', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kato_tag`
--

CREATE TABLE IF NOT EXISTS `kato_tag` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `frequency` int(11) NOT NULL DEFAULT '0',
  `tag_type` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `kato_tag`
--

INSERT INTO `kato_tag` (`id`, `name`, `frequency`, `tag_type`) VALUES
(36, 'tag2', 6, 'blog2'),
(37, 'tag', 2, 'blog2'),
(38, 'tag2', 3, 'blog'),
(40, 'test', 1, NULL),
(41, 'blog', 1, 'blog');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_auth_assignment`
--

CREATE TABLE IF NOT EXISTS `tbl_auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `biz_rule` text,
  `data` text,
  PRIMARY KEY (`item_name`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_auth_assignment`
--

INSERT INTO `tbl_auth_assignment` (`item_name`, `user_id`, `biz_rule`, `data`) VALUES
('admin', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_auth_item`
--

CREATE TABLE IF NOT EXISTS `tbl_auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `biz_rule` text,
  `data` text,
  PRIMARY KEY (`name`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_auth_item`
--

INSERT INTO `tbl_auth_item` (`name`, `type`, `description`, `biz_rule`, `data`) VALUES
('admin', 2, 'Administrator', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_auth_item_child`
--

CREATE TABLE IF NOT EXISTS `tbl_auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_migration`
--

CREATE TABLE IF NOT EXISTS `tbl_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_migration`
--

INSERT INTO `tbl_migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1393605777),
('m130524_201442_init', 1393605789);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(32) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `role` smallint(6) NOT NULL DEFAULT '10',
  `status` smallint(6) NOT NULL DEFAULT '10',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `role`, `status`, `create_time`, `update_time`) VALUES
(1, 'admin', 'CCIwu98zZwmGrJRarrUinrdKtfrfO1_E', '$2y$13$91cNAK1OdvUPExikkwnplOO1IvjBld.x2UQcIJfuvm2eGuACJrvdS', NULL, 'perminder.klair@gmail.com', 10, 10, 1393605836, 1393605836);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_auth_assignment`
--
ALTER TABLE `tbl_auth_assignment`
  ADD CONSTRAINT `tbl_auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `tbl_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_auth_item_child`
--
ALTER TABLE `tbl_auth_item_child`
  ADD CONSTRAINT `tbl_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `tbl_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `tbl_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
