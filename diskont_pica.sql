-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 23, 2019 at 11:14 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `diskont_pica`
--

-- --------------------------------------------------------

--
-- Table structure for table `klijent`
--

DROP TABLE IF EXISTS `klijent`;
CREATE TABLE IF NOT EXISTS `klijent` (
  `korisnicko_ime` varchar(50) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `sifra` varchar(100) NOT NULL,
  `je_admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `klijent`
--

INSERT INTO `klijent` (`korisnicko_ime`, `id`, `email`, `sifra`, `je_admin`) VALUES
('Strahinja', 3, 'strahinja@gmail.com', '11111111', 1),
('Marko', 4, 'marko@gmail.com', '22222222', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pice`
--

DROP TABLE IF EXISTS `pice`;
CREATE TABLE IF NOT EXISTS `pice` (
  `naziv` varchar(100) NOT NULL,
  `cena` double NOT NULL,
  `id_vrste` int(11) NOT NULL,
  `id_zapremine` int(11) NOT NULL,
  `slika` varchar(200) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pice`
--

INSERT INTO `pice` (`naziv`, `cena`, `id_vrste`, `id_zapremine`, `slika`, `id`) VALUES
('Pivo Budweiser u limenci. Pakovanje od 24 komada.', 2016, 1, 2, '5d5d657e7c1cb0.12431632.jpg', 5),
('Rubin Stono Polusuvo Vino Car Lazar', 1.085, 8, 3, '5d5d61b250a282.14138805.jpg', 12),
('Belo vino Terasa Chardonnay Matalj', 965, 8, 3, '5d5d6127831704.14343418.jpg', 11),
('Fanta Malina u Pvc ambalaÅ¾i', 95, 2, 4, '5d5d64a6eee1c5.59605649.jpg', 13),
('Erdinger Pivo u paketu od 12 komada', 1740, 1, 1, '5d5d66efd93226.93057789.jpg', 14);

-- --------------------------------------------------------

--
-- Table structure for table `porudzbina`
--

DROP TABLE IF EXISTS `porudzbina`;
CREATE TABLE IF NOT EXISTS `porudzbina` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_klijenta` int(11) NOT NULL,
  `id_pica` int(11) NOT NULL,
  `kolicina` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vrsta`
--

DROP TABLE IF EXISTS `vrsta`;
CREATE TABLE IF NOT EXISTS `vrsta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vrsta`
--

INSERT INTO `vrsta` (`id`, `naziv`) VALUES
(1, 'Piva'),
(2, 'Sokovi'),
(3, 'Vode'),
(7, 'Zestoka pica'),
(8, 'Vina');

-- --------------------------------------------------------

--
-- Table structure for table `zapremina`
--

DROP TABLE IF EXISTS `zapremina`;
CREATE TABLE IF NOT EXISTS `zapremina` (
  `kolicina` double NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zapremina`
--

INSERT INTO `zapremina` (`kolicina`, `id`) VALUES
(0.33, 1),
(0.5, 2),
(0.7, 3),
(1, 4),
(20, 5),
(30, 6);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
