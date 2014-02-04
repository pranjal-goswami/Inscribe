-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 04, 2014 at 05:39 PM
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
-- Table structure for table `in_posts`
--

CREATE TABLE IF NOT EXISTS `in_posts` (
  `id` int(20) NOT NULL AUTO_INCREMENT COMMENT 'Unique ID of the post ',
  `title` varchar(100) DEFAULT NULL COMMENT 'Title of the post',
  `author_id` int(20) DEFAULT NULL COMMENT 'Unique ID of the author (user)',
  `content_id` varchar(255) DEFAULT NULL COMMENT 'ID of the content txt file',
  `excerpt` longtext COMMENT 'Short description of the post',
  `read_length` int(10) DEFAULT NULL COMMENT 'Length of the read (in minutes)',
  `publish_flag` int(2) DEFAULT '0' COMMENT 'Publish status of the post (1=published, 0=not)',
  `publish_time` datetime DEFAULT NULL COMMENT 'Time of publish',
  `upvote_count` int(20) DEFAULT '0' COMMENT 'Number of upvotes on the post',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Time of this row entry',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `in_posts`
--

