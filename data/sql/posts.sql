-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 29, 2014 at 03:07 PM
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
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(20) NOT NULL AUTO_INCREMENT COMMENT 'Unique ID of the post ',
  `title` varchar(100) DEFAULT NULL COMMENT 'Title of the post',
  `author_id` int(20) DEFAULT NULL COMMENT 'Unique ID of the author (user)',
  `category` varchar(500) DEFAULT NULL COMMENT 'Category(s) of the post (Array)',
  `content_id` int(20) DEFAULT NULL COMMENT 'ID of the content txt file',
  `read_length` int(10) DEFAULT NULL COMMENT 'Length of the read (in minutes)',
  `publish_time` datetime DEFAULT NULL COMMENT 'Time of publish',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Time of this row entry',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `posts`
--

