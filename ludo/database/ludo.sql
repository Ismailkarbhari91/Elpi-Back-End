-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 30, 2023 at 08:28 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ludo`
--

-- --------------------------------------------------------

--
-- Table structure for table `game_meta`
--

CREATE TABLE `game_meta` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `game_status` varchar(255) NOT NULL,
  `playercolor` varchar(255) NOT NULL,
  `sharecode` varchar(255) NOT NULL,
  `player1` varchar(655) NOT NULL,
  `player2` varchar(655) NOT NULL,
  `player3` varchar(655) NOT NULL,
  `player4` varchar(655) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `game_meta`
--

INSERT INTO `game_meta` (`id`, `username`, `game_status`, `playercolor`, `sharecode`, `player1`, `player2`, `player3`, `player4`) VALUES
(39, 'player2', 'cancelled', 'green', 'hnFDU9J0ay', '', '', '', ''),
(40, 'player1', 'cancelled', 'blue', 'hnFDU9J0ay', '', '', '', ''),
(41, 'player2', 'cancelled', 'blue', 'OIkWnlVP0X', '', '', '', ''),
(42, 'player1', 'cancelled', 'green', 'OIkWnlVP0X', '', '', '', ''),
(43, 'player2', 'cancelled', 'red', 'J7DM0HNqEc', '', '', '', ''),
(44, 'player1', 'cancelled', 'yellow', 'J7DM0HNqEc', '', '', '', ''),
(45, 'player2', 'cancelled', 'green', '8S4zRtQLke', '', '', '', ''),
(46, 'player2', 'cancelled', 'green', 'cuix3AyKw0', '', '', '', ''),
(47, 'player2', 'inlobby', 'green', 'AyEuwfOHkj', '', '', '', ''),
(48, 'player1', 'cancelled', 'blue', 'cuix3AyKw0', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `metadata`
--

CREATE TABLE `metadata` (
  `id` int(11) NOT NULL,
  `meta_key` varchar(255) NOT NULL,
  `meta_value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token_amount` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `token_amount`, `created_at`) VALUES
(1, 'Player 1', 'player1', 'player1', 7500, '2023-03-24 06:47:27'),
(2, 'Player 2', 'player2', 'player2', 7100, '2023-03-24 07:52:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `game_meta`
--
ALTER TABLE `game_meta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `metadata`
--
ALTER TABLE `metadata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `game_meta`
--
ALTER TABLE `game_meta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `metadata`
--
ALTER TABLE `metadata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
