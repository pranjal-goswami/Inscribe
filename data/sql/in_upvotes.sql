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
-- Table structure for table `in_upvotes`
--

CREATE TABLE IF NOT EXISTS `in_upvotes` (
  `id` int(20) NOT NULL AUTO_INCREMENT COMMENT 'Internal Unique ID of upvote',
  `user_id` int(20) DEFAULT NULL COMMENT 'ID of user who upvoted',
  `post_id` int(20) DEFAULT NULL COMMENT 'ID of the post upvoted',
  `vote` int(2) DEFAULT '1' COMMENT 'Vote type (upvoted=1)',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Time of the upvote',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `in_upvotes`
--

