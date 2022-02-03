-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2022 at 10:23 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `heychat`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `groupid` varchar(60) DEFAULT NULL,
  `groupname` varchar(20) DEFAULT NULL,
  `member` text DEFAULT NULL,
  `admin` varchar(60) NOT NULL,
  `groupProfile` text DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `messageid` varchar(60) DEFAULT NULL,
  `reciever` varchar(60) DEFAULT NULL,
  `sender` varchar(60) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `recieved` tinyint(1) NOT NULL DEFAULT 0,
  `seen` tinyint(1) NOT NULL DEFAULT 0,
  `deletedsender` tinyint(1) NOT NULL DEFAULT 0,
  `deletedreciever` tinyint(1) NOT NULL DEFAULT 0,
  `files` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `messageid`, `reciever`, `sender`, `message`, `date`, `recieved`, `seen`, `deletedsender`, `deletedreciever`, `files`) VALUES
(1, 'yhO3ndXZKf0BzGdztcLEGYFNU6RYSStm5oZbpY', '22439935325005301616575319663002835129952851588', '145890242250830986781361785424768728253850', 'hello there', '2022-01-26 19:37:24', 1, 1, 0, 0, NULL),
(2, 'yhO3ndXZKf0BzGdztcLEGYFNU6RYSStm5oZbpY', '22439935325005301616575319663002835129952851588', '145890242250830986781361785424768728253850', 'hello there', '2022-01-26 19:38:51', 1, 1, 0, 0, NULL),
(3, 'yhO3ndXZKf0BzGdztcLEGYFNU6RYSStm5oZbpY', '22439935325005301616575319663002835129952851588', '145890242250830986781361785424768728253850', NULL, '2022-01-26 19:52:39', 1, 1, 0, 0, './uploads/2015.01.08.16.38.23.16_waiters.jpg'),
(4, 'yhO3ndXZKf0BzGdztcLEGYFNU6RYSStm5oZbpY', '22439935325005301616575319663002835129952851588', '145890242250830986781361785424768728253850', 'miko', '2022-01-26 19:55:03', 1, 1, 0, 0, NULL),
(5, 'yhO3ndXZKf0BzGdztcLEGYFNU6RYSStm5oZbpY', '145890242250830986781361785424768728253850', '22439935325005301616575319663002835129952851588', 'juki', '2022-01-26 19:55:32', 1, 1, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `userid` varchar(60) DEFAULT NULL,
  `firstname` varchar(10) DEFAULT NULL,
  `lastname` varchar(10) DEFAULT NULL,
  `username` varchar(10) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'null',
  `gender` varchar(8) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `userid`, `firstname`, `lastname`, `username`, `email`, `status`, `gender`, `password`, `date`, `image`) VALUES
(1, '145890242250830986781361785424768728253850', 'hezron', 'ndirangu', 'web', 'ndiranguhezron97@gmail.com', 'null', 'male', '$2y$10$hwAO6lHHGPe6kMM2oPv/kOLIcpFJnirDSewsfedHR3.Vsl4o.WDfa', '2022-01-26 19:22:59', './ui/images/user_male.jpg'),
(2, '22439935325005301616575319663002835129952851588', 'hezron', 'ndirangu', 'milo', 'ndiranguhezron98@gmail.com', 'null', 'male', '$2y$10$S7HvT60KiQmuUtWaSux2y.pscf3kvXmFyoQgcZE9/dWb5Eh17IP4q', '2022-01-26 19:27:07', './ui/images/user_male.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
