-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 09, 2010 at 01:52 PM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `productsdemo`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `ID` int(11) NOT NULL,
  `Category` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Image` varchar(255) NOT NULL,
  `Price` double NOT NULL,
  `Option1Desc` varchar(255) NOT NULL,
  `Option1a` varchar(255) NOT NULL,
  `Option1b` varchar(255) NOT NULL,
  `Option1c` varchar(255) NOT NULL,
  `Option1d` varchar(255) NOT NULL,
  `Option2Desc` varchar(255) NOT NULL,
  `Option2a` varchar(255) NOT NULL,
  `Option2b` varchar(255) NOT NULL,
  `Option2c` varchar(255) NOT NULL,
  `Option2d` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ID`, `Category`, `Description`, `Image`, `Price`, `Option1Desc`, `Option1a`, `Option1b`, `Option1c`, `Option1d`, `Option2Desc`, `Option2a`, `Option2b`, `Option2c`, `Option2d`) VALUES
(1, 'Houseware', 'Kettle', '1', 23, 'Color', 'Red', 'White', 'Black', '', '', '', '', '', ''),
(2, 'Tools', 'Wrench Set', '2', 59, '', '', '', '', '', '', '', '', '', ''),
(3, 'Sportswear', 'Hiking Boots', '3', 98, 'Color', 'Green', 'Black', 'Tan', 'Pink', 'Size', '8', '9', '10', '11'),
(4, 'Houseware', 'Iron', '4', 17, 'Color', 'Red', 'White', 'Silver', '', '', '', '', '', ''),
(5, 'Tools', 'Socket Set', '5', 90, 'Type', 'Metric', 'English', '', '', 'Color', 'Silver', 'Gold', '', ''),
(6, 'Sportswear', 'Cargo Pants', '6', 54, 'Color', 'Tan', 'Black', '', '', 'Size', 'S', 'M', 'L', 'XL'),
(7, 'Houseware', 'Ironing Board', '7', 32, 'Size', '36Inch', '48Inch', '', '', '', '', '', '', ''),
(8, 'Tools', 'Screwdriver Set', '8', 13, 'Color', 'Black', 'Yellow', '', '', 'Type', 'Philips', 'Robertson', 'Standard', ''),
(9, 'Sportswear', 'Cargo Shirt', '9', 30, 'Color', 'Tan', 'Black', '', '', 'Size', 'M', 'L', '', '');
