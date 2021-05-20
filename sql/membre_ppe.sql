-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jun 16, 2020 at 08:01 AM
-- Server version: 5.5.49-log
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `membre_ppe`
--

-- --------------------------------------------------------

--
-- Table structure for table `membres`
--

CREATE TABLE IF NOT EXISTS `membres` (
  `id` int(50) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `nomdesociete` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `numero1` int(12) NOT NULL,
  `numero2` int(12) NOT NULL,
  `motdepasse` text NOT NULL,
  `avatar` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `membres`
--

INSERT INTO `membres` (`id`, `prenom`, `nom`, `nomdesociete`, `email`, `numero1`, `numero2`, `motdepasse`, `avatar`) VALUES
(1, 'Admin', 'Admin', 'Admin', 'supp.ppe2.sio@gmail.com', 1223455678, 0, '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', ''),

--
-- Indexes for dumped tables
--

--
-- Indexes for table `membres`
--
ALTER TABLE `membres`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `membres`
--
ALTER TABLE `membres`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
