-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 11, 2014 at 04:03 PM
-- Server version: 5.5.29
-- PHP Version: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `social_app_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'application id',
  `user_id` int(10) NOT NULL COMMENT 'id of owner of application',
  `title` varchar(20) NOT NULL COMMENT 'name of your application',
  `description` text NOT NULL COMMENT 'application description',
  `path` varchar(160) NOT NULL COMMENT 'File path of application download',
  `count_rating` int(10) NOT NULL DEFAULT '0' COMMENT 'no of users rated this application',
  `rating` smallint(1) NOT NULL DEFAULT '0' COMMENT 'application rating',
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='stores information of application uploaded by developers' AUTO_INCREMENT=18 ;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`id`, `user_id`, `title`, `description`, `path`, `count_rating`, `rating`) VALUES
(14, 6, 'Softage', 'Testing softage ap upload', '/Users/avinash_vallab/Desktop/My Programs/eclipse-php/workspace/webapp/app/webroot/uploads/2014-04-07-060848SoftAge_apkfiles.com.apk_1.0', 4, 4),
(15, 15, 'ArcFileManager', 'Sample file manager application which helps in archiving files', '/Users/avinash_vallab/Desktop/My Programs/eclipse-php/workspace/webapp/app/webroot/uploads/2014-04-08-062115Arc_File_Manager.apk_1.0', 2, 5),
(16, 15, 'CricCompanion', 'Get connected with cricket rankings, news and live scores', '/Users/avinash_vallab/Desktop/My Programs/eclipse-php/workspace/webapp/app/webroot/uploads/2014-04-08-062240Cricket_Companion.apk_1.0', 1, 3),
(17, 15, 'LiveScore', 'Helps in keeping you updated with live scores.', '/Users/avinash_vallab/Desktop/My Programs/eclipse-php/workspace/webapp/app/webroot/uploads/2014-04-08-062323LiveScore.apk_1.0', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `application_revision`
--

CREATE TABLE `application_revision` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `app_id` int(10) NOT NULL COMMENT 'Application id related to the revision number',
  `revision_number` varchar(20) NOT NULL COMMENT 'revision number of app., eg: 2.3.0',
  `filename` varchar(160) NOT NULL COMMENT 'Name of the file',
  `path` varchar(128) NOT NULL COMMENT 'full path of application stored in file system',
  `size` int(20) NOT NULL COMMENT 'size of application ',
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `app_id` (`app_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='versioning of application' AUTO_INCREMENT=18 ;

--
-- Dumping data for table `application_revision`
--

INSERT INTO `application_revision` (`id`, `app_id`, `revision_number`, `filename`, `path`, `size`) VALUES
(14, 14, '1.0.0', 'SoftAge_apkfiles.com.apk', '2014-04-07-060848SoftAge_apkfiles.com.apk_1.0', 837603),
(15, 15, '1.0.0', 'Arc File Manager.apk', '2014-04-08-062115Arc_File_Manager.apk_1.0', 2409156),
(16, 16, '1.0.0', 'Cricket Companion.apk', '2014-04-08-062240Cricket_Companion.apk_1.0', 1899260),
(17, 17, '1.0.0', 'LiveScore.apk', '2014-04-08-062323LiveScore.apk_1.0', 5748970);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `app_id` int(10) NOT NULL COMMENT 'application on which comment is made',
  `user_id` int(10) NOT NULL COMMENT 'user who made the comment',
  `description` varchar(140) NOT NULL COMMENT 'comment content',
  `posted_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'record date time',
  PRIMARY KEY (`id`),
  KEY `app_id` (`app_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='holds all the comments made on applications' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL COMMENT 'name of the group',
  `user_id` int(10) NOT NULL COMMENT 'id of user who created the group ',
  `description` text COMMENT 'Description of groups',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `admin_user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='contains metadata of groups' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `user_id`, `description`, `created_on`) VALUES
(1, 'TestGroup', 6, NULL, '2014-04-06 23:51:59'),
(2, 'Test2', 8, NULL, '2014-04-07 00:01:21');

-- --------------------------------------------------------

--
-- Table structure for table `groups_user`
--

CREATE TABLE `groups_user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `group_id` int(10) NOT NULL COMMENT 'to which group a user belongs to',
  `user_id` int(10) NOT NULL COMMENT 'user id of member of group',
  `role` varchar(20) NOT NULL DEFAULT 'user' COMMENT 'role of user in group',
  `status` varchar(20) NOT NULL COMMENT 'current status of user in group',
  `added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='table holding relations to groups and its users' AUTO_INCREMENT=7 ;

--
-- Dumping data for table `groups_user`
--

INSERT INTO `groups_user` (`id`, `group_id`, `user_id`, `role`, `status`, `added_on`) VALUES
(1, 1, 6, 'admin', '', '2014-04-06 23:52:38'),
(2, 1, 7, 'user', '', '2014-04-06 23:52:49'),
(3, 1, 9, 'user', '', '2014-04-06 23:52:55'),
(4, 2, 6, 'user', '', '2014-04-07 00:01:34'),
(5, 1, 5, 'user', '', '2014-04-08 00:20:47'),
(6, 2, 5, 'admin', '', '2014-04-08 00:21:21');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL COMMENT 'user to which notification belongs to',
  `description` varchar(128) NOT NULL COMMENT 'notification content',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 - haven''t read, 1 - read : status of application',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='holds the notification to be shown to users' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'incremented for no of users',
  `first_name` varchar(30) NOT NULL COMMENT 'first name of user',
  `last_name` varchar(30) NOT NULL COMMENT 'last name of user',
  `email` varchar(255) NOT NULL COMMENT 'email id of user',
  `password` varchar(255) NOT NULL COMMENT 'hashed password of user',
  `phone` varchar(12) DEFAULT NULL COMMENT 'phone no of the user',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` datetime NOT NULL,
  `role` enum('developer','mobile','admin') NOT NULL DEFAULT 'developer' COMMENT 'role of the user',
  `token` varchar(128) DEFAULT NULL COMMENT 'Unique identification token for mobile users',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_id` (`email`),
  UNIQUE KEY `token` (`token`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Table containing all the users for application' AUTO_INCREMENT=16 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `password`, `phone`, `date_created`, `last_login`, `role`, `token`) VALUES
(5, 'Avinash', 'Vallabhaneni', 'avinash.vllbh@gmail.com', '9c93b342c13b08f43e957702aa330aa28f536b44', '3043767486', '0000-00-00 00:00:00', '2014-03-10 03:30:40', 'developer', NULL),
(6, 'test', 'test', 'test@test.com', '233ef64c6f6502bba4a9c794cd13d2f9f7db226c', '', '0000-00-00 00:00:00', '2014-04-07 05:49:13', 'developer', '533e4d3d-1d6c-4192-b606-0311ced748bd'),
(7, 'testing', 'testing', 'testing@testing.com', '8178e2b59fa03f35d354a10bd2918d82d06a9dd9', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'developer', NULL),
(8, 'avi', 'nash', 'avi@avi.com', 'a9701d86f4375a5b0e4dbf1a751bf483ed0884ef', '3043767486', '0000-00-00 00:00:00', '2014-03-10 03:39:24', 'developer', NULL),
(9, 'Avinash', 'Test', 'avinash.vallab@gmail.com', '1a27dd71a0e548a032d1f5dddbef1d6b056a6ba0', '3043767486', '0000-00-00 00:00:00', '2014-04-04 05:30:47', 'developer', NULL),
(10, 'jsontest', '', 'json@json.com', 'cd7911c255c5318e8998094d44fdba7832558647', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'mobile', '533e4729-8de8-4194-adcc-6a8bced748bd'),
(15, 'Avinash', 'Vallabhaneni', 'avallab1@asu.edu', '1a27dd71a0e548a032d1f5dddbef1d6b056a6ba0', '3043767486', '0000-00-00 00:00:00', '2014-04-08 18:56:35', 'admin', '53438106-4df4-49cb-94cc-be3cced748bd');

-- --------------------------------------------------------

--
-- Table structure for table `user_follower`
--

CREATE TABLE `user_follower` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL COMMENT 'Should be only developers id',
  `follower_user_id` int(10) NOT NULL COMMENT 'id of user who requested to follow the developer',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `follower_user_id` (`follower_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='holds the relationship between developers and users' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_friend`
--

CREATE TABLE `user_friend` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL COMMENT 'user id',
  `friend_user_id` int(10) NOT NULL COMMENT 'friend of user_id',
  `status` smallint(1) NOT NULL DEFAULT '0' COMMENT '0-requested,1-accepted,2-rejected',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `friend_user_id` (`friend_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='holds the friend requests between users' AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `application`
--
ALTER TABLE `application`
  ADD CONSTRAINT `application_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `application_revision`
--
ALTER TABLE `application_revision`
  ADD CONSTRAINT `application_revision_ibfk_1` FOREIGN KEY (`app_id`) REFERENCES `application` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`app_id`) REFERENCES `application` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `groups_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `groups_user`
--
ALTER TABLE `groups_user`
  ADD CONSTRAINT `groups_user_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `groups_user_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_follower`
--
ALTER TABLE `user_follower`
  ADD CONSTRAINT `user_follower_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_follower_ibfk_2` FOREIGN KEY (`follower_user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_friend`
--
ALTER TABLE `user_friend`
  ADD CONSTRAINT `user_friend_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_friend_ibfk_2` FOREIGN KEY (`friend_user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
