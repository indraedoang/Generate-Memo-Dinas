-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2020 at 10:39 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `memodinas`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department` varchar(150) DEFAULT NULL,
  `singkatan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `department`, `singkatan`) VALUES
(2, 'wholesales', 'WBUD'),
(3, 'Information Technology ', 'ITED'),
(4, 'JOINT FINANCING', 'WBUD-JF'),
(5, 'Human Capital Management Div. Head', 'HCMD'),
(6, 'Retail Financing Business Div. Head', 'RFBD'),
(7, 'Hajj & Umrah Business Div. Head', 'HUBD');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(150) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`, `user_id`, `role_id`) VALUES
(1, 'indra', '5f4dcc3b5aa765d61d8327deb882cf99', 1, 2),
(2, 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', 2, 1),
(3, 'arum', '5f4dcc3b5aa765d61d8327deb882cf99', 3, 2),
(4, 'faisal', '5f4dcc3b5aa765d61d8327deb882cf99', 4, 2),
(5, 'fajar', '24bc50d85ad8fa9cda686145cf1f8aca', 5, 2),
(6, 'slestari', '5f4dcc3b5aa765d61d8327deb882cf99', 6, 2),
(7, 'slestari', '5f4dcc3b5aa765d61d8327deb882cf99', 7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `memodinas`
--

CREATE TABLE IF NOT EXISTS `memodinas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_md` varchar(150) DEFAULT NULL,
  `dept_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `perihal` varchar(255) DEFAULT NULL,
  `tujuan` text,
  `keterangan` text,
  `dokument` varchar(255) DEFAULT NULL,
  `tgl_request` date DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `modul` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `memodinas`
--

INSERT INTO `memodinas` (`id`, `no_md`, `dept_id`, `user_id`, `perihal`, `tujuan`, `keterangan`, `dokument`, `tgl_request`, `status`, `modul`) VALUES
(1, '0001 / BMS / IT / II / 20', 3, 1, 'HGH', 'HTRE', 'REYTRYERTY', '', '2020-02-12', 1, '2'),
(2, '0002 / BMS / IT / II / 20', 3, 1, 'dasa', 'safd', 'sfdafsfds', '', '2020-02-12', 1, '2'),
(3, 'MD. / 0001 / IT / 20', 3, 1, 'sad', 'FDWQFD', 'WQFDWA', '', '2020-02-12', 1, '1'),
(4, 'MD. / 0002 / IT / 20', 3, 1, 'dsfsfgfgdg', 'dgdsg', 'dgfdgdf', '', '2020-02-12', 1, '1'),
(5, 'MD. / 0002 /      /ITED/20 / 20', 3, 1, 'test aja', 'GA', 'nulis', '', '2020-02-12', 1, '1'),
(6, 'MD. / 0001 / RFBD / 20', 6, 6, 'Program Tabungan Rencana Umrah', 'RFBD ', 'jadwal keberangkatan umrah untuk periode tahun 2021 ', 'Keberangkatan_Umrah_Periode_Tahun_2021.docx', '2020-02-13', 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `modul`
--

CREATE TABLE IF NOT EXISTS `modul` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `modul`
--

INSERT INTO `modul` (`id`, `nama`) VALUES
(1, 'Memo Dinas'),
(2, 'Surat Keluar');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'Administrator'),
(2, 'User');

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

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(150) DEFAULT NULL,
  `full_name` varchar(250) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `extension` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nik`, `full_name`, `department_id`, `extension`, `status`) VALUES
(1, '18.8567.1.90', 'INDRA SETIAWAN', 3, '0945', 1),
(2, '18.8567.1.90', 'Administartor', NULL, '', 1),
(3, '18.8567.1.89', 'Arum', 2, '0803', 1),
(4, '18.8567.1.88', 'FAISAL', 4, '0294', 1),
(5, '14.0673.1.90', 'Fajar S', 4, '0820', 1),
(6, '14.0336.2.91', 'Sri Lestari', 6, '0934', 1),
(7, '14.0336.2.91', 'Sri Lestari', 7, '0934', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
