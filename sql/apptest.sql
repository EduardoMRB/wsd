-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 06, 2014 at 11:06 PM
-- Server version: 5.5.35-1ubuntu1
-- PHP Version: 5.5.9-1ubuntu4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `apptest`
--

-- --------------------------------------------------------

--
-- Table structure for table `apartamento`
--

CREATE TABLE IF NOT EXISTS `apartamento` (
  `id_apartamento` int(11) NOT NULL AUTO_INCREMENT,
  `morador` varchar(45) NOT NULL,
  `numero` int(11) NOT NULL,
  `saldo` float NOT NULL,
  `meses_devedores` varchar(45) NOT NULL,
  PRIMARY KEY (`id_apartamento`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `apartamento`
--

INSERT INTO `apartamento` (`id_apartamento`, `morador`, `numero`, `saldo`, `meses_devedores`) VALUES
(4, 'Bruna marquezine', 102, 500, 'Janeiro, Fevereiro'),
(5, 'Bruna marquezine', 102, 500, 'Janeiro, Fevereiro'),
(6, 'Bruna marquezine', 102, 500, 'Janeiro, Fevereiro'),
(7, 'Bruna marquezine', 102, 500, 'Janeiro, Fevereiro'),
(8, 'Bruna marquezine', 102, 500, 'Janeiro, Fevereiro'),
(9, 'Bruna marquezine', 102, 500, 'Janeiro, Fevereiro'),
(10, 'Bruna marquezine', 102, 500, 'Janeiro, Fevereiro');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
