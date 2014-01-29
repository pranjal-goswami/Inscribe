-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 29, 2014 at 03:18 PM
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
  `pwd` varchar(255) DEFAULT NULL COMMENT 'Hash of the owner password',
  `pwd_salt` varchar(255) DEFAULT NULL COMMENT 'Salt for securely hashing the owner password',
  `email` varchar(200) DEFAULT NULL COMMENT 'User email',
  `joined` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Date-time user registered for an account',
  `last_login` datetime DEFAULT NULL COMMENT 'Last time user logged in',
  `pwd_token` varchar(64) DEFAULT NULL COMMENT 'Password reset token',
  `admirers_count` int(20) DEFAULT NULL COMMENT 'Number of unique users who upvoted this user’s work',
  `total_upvotes_count` int(20) DEFAULT NULL COMMENT 'Number of total upvotes from all posts by this user',
  `posts_count` int(20) DEFAULT NULL COMMENT 'Number of total posts made by this user',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `in_users`
--

