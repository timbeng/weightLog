-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Värd: 127.0.0.1:3306
-- Tid vid skapande: 17 jun 2021 kl 14:47
-- Serverversion: 5.7.31
-- PHP-version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `weightlog`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `measurements`
--

DROP TABLE IF EXISTS `measurements`;
CREATE TABLE IF NOT EXISTS `measurements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `added_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumpning av Data i tabell `measurements`
--

INSERT INTO `measurements` (`id`, `user_id`, `name`, `value`, `added_at`) VALUES
(1, 1, 'weight', '90', '2020-12-20 20:20:18'),
(2, 1, 'neck', '36,5', '2021-01-08 15:25:20'),
(3, 1, 'neck', '37', '2021-01-09 15:25:20');

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `birth_date` date DEFAULT NULL,
  `gender` varchar(10) COLLATE utf8_swedish_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_swedish_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `notes` text COLLATE utf8_swedish_ci,
  `weight` decimal(10,0) NOT NULL DEFAULT '0',
  `height` decimal(10,0) NOT NULL DEFAULT '0',
  `neck` varchar(5) COLLATE utf8_swedish_ci NOT NULL DEFAULT '0',
  `waist` varchar(5) COLLATE utf8_swedish_ci NOT NULL DEFAULT '0',
  `hips` varchar(5) COLLATE utf8_swedish_ci NOT NULL DEFAULT '0',
  `fat_percentage` varchar(3) COLLATE utf8_swedish_ci DEFAULT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`id`, `birth_date`, `gender`, `username`, `firstname`, `lastname`, `email`, `phone`, `password`, `notes`, `weight`, `height`, `neck`, `waist`, `hips`, `fat_percentage`, `deleted`) VALUES
(1, '1983-05-30', 'male', 'timbeng', 'Tim', 'Bengtsson', 'timbeng@gmail.com', '0706011129', '$2y$10$oUwLcqyzaR.JMpmz.bkas.dysU96f/mxP6xlMWOxdA9irOvAngTwC', '', '90', '194', '39', '93', '0', NULL, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
