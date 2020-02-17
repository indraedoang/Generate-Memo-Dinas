-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2020 at 02:37 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fix_asset`
--

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE IF NOT EXISTS `setting` (
  `id` int(3) NOT NULL,
  `id_site` int(3) NOT NULL,
  `employee_id` int(20) NOT NULL,
  `container` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` varchar(256) NOT NULL,
  `date` date NOT NULL,
  `religion` varchar(100) NOT NULL,
  `keys` int(20) NOT NULL,
  `restore` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `id_site`, `employee_id`, `container`, `title`, `content`, `date`, `religion`, `keys`, `restore`) VALUES
(1, 0, 0, 'sites', 'themes', 'Mega', '0000-00-00', '', 0, 'N'),
(2, 0, 0, 'sites', 'name', '', '0000-00-00', '', 0, 'N'),
(3, 0, 0, 'sites', 'title', '', '0000-00-00', '', 0, 'N'),
(4, 0, 0, 'sites', 'meta', '', '0000-00-00', '', 0, 'N'),
(5, 1, 0, 'email', 'protocol', '', '0000-00-00', '', 0, 'N'),
(6, 0, 0, 'email', 'host', '', '0000-00-00', '', 0, 'N'),
(7, 0, 0, 'email', 'port', '', '0000-00-00', '', 0, 'N'),
(8, 0, 0, 'email', 'username', '', '0000-00-00', '', 0, 'N'),
(9, 0, 0, 'email', 'password', '', '0000-00-00', '', 0, 'N'),
(10, 0, 0, 'email', 'from', '', '0000-00-00', '', 0, 'N'),
(11, 0, 0, 'email', 'name', '', '0000-00-00', '', 0, 'N'),
(12, 1, 0, 'email', 'auth', 'Yes', '0000-00-00', '', 0, 'N');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
