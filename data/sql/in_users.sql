-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 04, 2014 at 05:40 PM
-- Server version: 5.1.44
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `inscribe`
--

-- --------------------------------------------------------

--
-- Table structure for table `in_users`
--

CREATE TABLE IF NOT EXISTS `in_users` (
  `id` int(20) NOT NULL AUTO_INCREMENT COMMENT 'Unique ID of the user',
  `full_name` varchar(200) DEFAULT NULL COMMENT 'User full name',
  `profile_pic_id` varchar(100) DEFAULT NULL COMMENT 'Unique ID of user profile picture',
  `pwd` varchar(255) DEFAULT NULL COMMENT 'Hash of the owner password',
  `pwd_salt` varchar(255) DEFAULT NULL COMMENT 'Salt for securely hashing the owner password',
  `email` varchar(200) DEFAULT NULL COMMENT 'User email',
  `joined` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Date-time user registered for an account',
  `last_login` datetime DEFAULT NULL COMMENT 'Last time user logged in',
  `pwd_token` varchar(64) DEFAULT NULL COMMENT 'Password reset token',
  `admirers_count` int(20) DEFAULT '0' COMMENT 'Number of unique users who upvoted this user’s work',
  `total_upvotes_count` int(20) DEFAULT '0' COMMENT 'Number of total upvotes from all posts by this user',
  `posts_count` int(20) DEFAULT '0' COMMENT 'Number of total posts made by this user',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `in_users`
--

INSERT INTO `in_users` (`id`, `full_name`, `profile_pic_id`, `pwd`, `pwd_salt`, `email`, `joined`, `last_login`, `pwd_token`, `admirers_count`, `total_upvotes_count`, `posts_count`) VALUES
(5, 'Naman Agrawal', NULL, '8aa1ef9afbb2e0799af4c96103a078e1', '477f123b5d169db091f19609cf36d282', 'naman.iitkgp@gmail.com', '2014-02-04 21:29:38', NULL, NULL, 0, 0, 0);
