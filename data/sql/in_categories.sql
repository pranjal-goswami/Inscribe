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
-- Table structure for table `in_categories`
--

CREATE TABLE IF NOT EXISTS `in_categories` (
  `id` int(20) NOT NULL AUTO_INCREMENT COMMENT 'Unique ID of the category',
  `category_name` varchar(200) NOT NULL COMMENT 'Name of the category',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `in_categories`
--

INSERT INTO `in_categories` (`id`, `category_name`) VALUES
(1, 'Satire'),
(2, 'Politics');
