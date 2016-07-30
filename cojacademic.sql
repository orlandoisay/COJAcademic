-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 30, 2016 at 10:38 AM
-- Server version: 5.5.49-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cojacademic`
--

-- --------------------------------------------------------

--
-- Table structure for table `contest`
--

CREATE TABLE IF NOT EXISTS `contest` (
  `id` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `data` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `contest`
--

INSERT INTO `contest` (`id`, `data`) VALUES
('ATSA', 'CODCUP'),
('CODCUP', '{"name":"ITSUR CODING CUP 2016","start":"2016-06-02 12:00:00.0","end":"2016-06-02 18:00:00","lastUpdate":"2016-07-27 11:24:35","penaltyPerMin":1,"penaltyPerWA":20,"problems":[1001,1661],"contestants":[{"user":"OrlandoIsay97","submissions":[[-1,0],[14,1]],"score":{"pts":1,"penalty":14}},{"user":"Licgerman","submissions":[[-1,0],[-1,0]],"score":{"pts":0,"penalty":0}},{"user":"Ozwaldo10","submissions":[[-1,0],[-1,0]],"score":{"pts":0,"penalty":0}},{"user":"qaxnouxeb","submissions":[[-1,0],[-1,0]],"score":{"pts":0,"penalty":0}},{"user":"sazukerick","submissions":[[-1,0],[-1,0]],"score":{"pts":0,"penalty":0}},{"user":"Thanya1996","submissions":[[-1,0],[-1,0]],"score":{"pts":0,"penalty":0}},{"user":"XeraXemag","submissions":[[-1,0],[-1,0]],"score":{"pts":0,"penalty":0}}]}'),
('CODING', '{"name":"CODIGNITION","start":"2016-07-29 12:00:00","end":"2016-07-29 15:00:00","lastUpdate":"2016-07-29 13:42:15","penaltyPerMin":1,"penaltyPerWA":20,"problems":[1012,2343,3243,2556,1000,2937],"contestants":[{"user":"Andrei","submissions":[[-1,0],[-1,0],[-1,0],[-1,0],[-1,0],[-1,0]],"score":{"pts":0,"penalty":0}},{"user":"AngelLB","submissions":[[-1,0],[-1,0],[-1,0],[-1,0],[-1,0],[-1,0]],"score":{"pts":0,"penalty":0}},{"user":"gazperek","submissions":[[-1,0],[-1,0],[-1,0],[-1,0],[-1,0],[-1,0]],"score":{"pts":0,"penalty":0}},{"user":"licgerman","submissions":[[-1,0],[-1,0],[-1,0],[-1,0],[-1,0],[-1,0]],"score":{"pts":0,"penalty":0}},{"user":"OrlandoIsay97","submissions":[[-1,0],[-1,0],[-1,0],[-1,0],[-1,0],[-1,0]],"score":{"pts":0,"penalty":0}},{"user":"Ozwaldo10","submissions":[[-1,0],[-1,0],[-1,0],[-1,0],[-1,0],[-1,0]],"score":{"pts":0,"penalty":0}},{"user":"qaxnouxeb","submissions":[[-1,0],[-1,0],[-1,0],[-1,0],[-1,0],[-1,0]],"score":{"pts":0,"penalty":0}}]}');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `handle` varchar(32) COLLATE utf8mb4_spanish_ci NOT NULL,
  `pass` varchar(256) COLLATE utf8mb4_spanish_ci NOT NULL,
  `coj_account` varchar(32) COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`handle`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`handle`, `pass`, `coj_account`) VALUES
('admin', '$2y$10$0T8TVipef/BeKcLQ7yH9ceK/7RYTcjf9bJA0h7BplQVkt7lVPrzce', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
