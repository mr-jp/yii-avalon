-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2019 at 04:59 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `avalon`
--

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE `game` (
  `id` int(11) NOT NULL,
  `timestamp` varchar(50) NOT NULL,
  `started` enum('0','1') NOT NULL DEFAULT '0',
  `players` int(11) NOT NULL,
  `percival` enum('0','1') NOT NULL DEFAULT '0',
  `mordred` enum('0','1') NOT NULL DEFAULT '0',
  `morgana` enum('0','1') NOT NULL DEFAULT '0',
  `oberon` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`id`, `timestamp`, `started`, `players`, `percival`, `mordred`, `morgana`, `oberon`) VALUES
(31, '1558807713', '0', 5, '1', '1', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `player`
--

CREATE TABLE `player` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `team` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL,
  `fk_game_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `player`
--

INSERT INTO `player` (`id`, `name`, `team`, `role`, `fk_game_id`) VALUES
(1, 'Jason', '', '', 26),
(2, 'Jason', '', '', 27),
(3, 'Jason', '', '', 28),
(4, 'Bob', '', '', 28),
(5, 'Bob', '', '', 28),
(6, 'Jason', '', '', 29),
(7, 'Bob', '', '', 29),
(8, 'Charlie', '', '', 29),
(9, 'Re', '', '', 29),
(10, 'ASD', '', '', 29),
(11, 'asd', '', '', 29),
(12, 'asd', '', '', 29),
(13, 'Jason', '', '', 30),
(14, 'a', '', '', 30),
(15, 'b', '', '', 30),
(16, 'c', '', '', 30),
(17, 'd', '', '', 30),
(18, 'Jason', '', '', 31);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `player`
--
ALTER TABLE `player`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_game_id` (`fk_game_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `game`
--
ALTER TABLE `game`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `player`
--
ALTER TABLE `player`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
