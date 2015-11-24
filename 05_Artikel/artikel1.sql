-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 01. Mrz 2014 um 11:49
-- Server Version: 5.5.27
-- PHP-Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `test`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `artikel1`
--

CREATE TABLE IF NOT EXISTS `artikel1` (
  `nr` int(11) NOT NULL AUTO_INCREMENT,
  `titel` varchar(255) DEFAULT NULL,
  `artnr` int(11) DEFAULT NULL,
  `preis` decimal(10,2) DEFAULT NULL,
  `inhalt` text,
  PRIMARY KEY (`nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Daten für Tabelle `artikel1`
--

INSERT INTO `artikel1` (`nr`, `titel`, `artnr`, `preis`, `inhalt`) VALUES
(1, 'swa', 123, 120.00, 'Abc1234'),
(3, 'Telefon', 1234, 240.00, 'Abc123'),
(7, 'Titel_dwa', 0, 100.00, 'das ist ein Text 1'),
(5, 'tttt', 666666, 78.00, 'das'),
(10, '111', 111, 456.00, '676776'),
(22, 'Titel', 123456, 456.00, 'das ist ein Text'),
(20, 'Titel', 12345, 45.00, 'das'),
(15, 'eeee', 9696, 678.00, 'fas'),
(16, '233§32', 12321, 34.00, 'fda'),
(18, 'tttt', 2344, 45.00, 'das'),
(19, 'titel', 1234, 45.00, 'heute'),
(21, 'Titel', 12345, 45.00, 'das');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
