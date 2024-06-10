-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2024 at 08:10 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reciperadar_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `commentID` int(11) NOT NULL,
  `postID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `content` text NOT NULL,
  `commentDate` datetime NOT NULL DEFAULT current_timestamp(),
  `updateDate` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `likeID` int(20) NOT NULL,
  `postID` int(20) NOT NULL,
  `userID` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `messageID` int(20) NOT NULL,
  `messageFrom` int(20) NOT NULL,
  `MessageTo` int(20) NOT NULL,
  `message` text NOT NULL,
  `viewed` varchar(1) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `postID` int(20) NOT NULL,
  `authorID` int(20) NOT NULL,
  `category` varchar(60) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `picPath` varchar(50) DEFAULT NULL,
  `postDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`postID`, `authorID`, `category`, `title`, `content`, `picPath`, `postDate`) VALUES
(17, 0, '', 'Test', 'Testing', 'uploads/salad.png', '2024-04-18 11:29:43'),
(18, 0, '', '123', '123', 'uploads/salad.png', '2024-04-22 14:11:14'),
(19, 0, '', '123', '123', 'uploads/salad.png', '2024-04-22 14:11:25'),
(20, 81, '', 'test', 'test1', '../uploads/BMW E30 M3.jpg', '2024-05-28 02:58:58'),
(21, 81, '', 'test', 'test1', '../uploads/BMW E30 M3.jpg', '2024-05-28 03:00:12'),
(22, 81, '', 'test', 'test1', '../uploads/BMW E30 M3.jpg', '2024-05-28 03:00:39'),
(23, 81, '', 'test10', 'test20', '../uploads/BMW E30 M3.jpg', '2024-05-28 03:02:49'),
(24, 81, '', 'test10', 'test20', '../uploads/BMW E30 M3.jpg', '2024-05-28 03:05:52'),
(25, 81, '', 'test10', 'test20', '../uploads/BMW E30 M3.jpg', '2024-05-28 03:07:11'),
(26, 81, '', 'test11', 'test22', '../uploads/BMW E30 M3.jpg', '2024-05-28 03:09:17');

-- --------------------------------------------------------

--
-- Table structure for table `relations`
--

CREATE TABLE `relations` (
  `relationID` int(20) NOT NULL,
  `relationFrom` int(20) NOT NULL,
  `relationTo` int(20) NOT NULL,
  `type` varchar(50) CHARACTER SET utf16 COLLATE utf16_general_ci NOT NULL,
  `start` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `relations`
--

INSERT INTO `relations` (`relationID`, `relationFrom`, `relationTo`, `type`, `start`) VALUES
(1, 73, 74, 'friend', '0000-00-00 00:00:00'),
(2, 73, 79, 'friend', '0000-00-00 00:00:00'),
(3, 73, 81, 'friend', '0000-00-00 00:00:00'),
(4, 75, 73, 'friend', '0000-00-00 00:00:00'),
(5, 80, 73, 'friend', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(20) NOT NULL,
  `type` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'normal',
  `salutation` varchar(50) DEFAULT NULL,
  `firstName` varchar(50) NOT NULL,
  `middleName` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) NOT NULL,
  `userName` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `birthDate` date NOT NULL,
  `profilePicture` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `type`, `salutation`, `firstName`, `middleName`, `lastName`, `userName`, `email`, `password`, `birthDate`, `profilePicture`) VALUES
(73, '', 'Herr', 'Ben', 'Nick', 'Fero', 'benfero', 'ben@fero.com', '$2y$10$3SFC3S1VKyI3ZOqwTxQ7/OAD9rgVCcX4/QT6w0p4WAxaFgOk.qt22', '1993-09-01', NULL),
(74, '', 'Keine Angabe', 'fovea', NULL, 'love', 'fovea', 'fovea@fovea.com', '$2y$10$nOc2kbuwqxd0jjDZKjZQ1On1B12jXsXnH7AI2svIpfnxdH8pQBZP2', '2024-05-01', NULL),
(75, '', 'Herr', 'Nick', NULL, 'chopper', 'nickchopper', 'nick@chopper.com', '$2y$10$ZBEIrtdbLVgwDH3FWnVimeIaesVK9Zce7RpvIezvdcJXOZAXj2d.a', '2024-05-15', NULL),
(79, '', 'Herr', 'Tin', 'Mid', 'Woodman', 'tintin', 'tin@tin.com', '$2y$10$4AEOeFBvG3lbq/UO9VKZJeb2YzdgWHI7YMa..5oK0CtcjSq4/QlBu', '2020-01-01', NULL),
(80, '', 'Herr', 'Ahmet', '', 'Cicek', 'ahmo', 'ahmo@ahmo.com', '$2y$10$qlDytecwL2FzhvGuCfBjfuzIPoh0sJS.YDnrAJ5mb60JuUxQ8TjHm', '2020-01-01', NULL),
(81, 'normal', 'Herr', 'ahmo', 'mesa', 'ahmo', 'ahmoahmo', 'ahmo@mo.com', '$2y$10$6oHkmkrcB1qkHH1tFUFn8eFJNwbJDnJR3oTDq/E2sYd0sAmoDglgy', '2000-01-01', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentID`),
  ADD KEY `postID` (`postID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`likeID`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`messageID`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`postID`),
  ADD KEY `postUserID` (`authorID`);

--
-- Indexes for table `relations`
--
ALTER TABLE `relations`
  ADD PRIMARY KEY (`relationID`),
  ADD KEY `relationFrom` (`relationFrom`,`relationTo`),
  ADD KEY `type` (`type`,`start`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `userName` (`userName`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `type` (`type`(1024)),
  ADD KEY `firstName` (`firstName`,`lastName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `likeID` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `messageID` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `postID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `relations`
--
ALTER TABLE `relations`
  MODIFY `relationID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`postID`) REFERENCES `posts` (`postID`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
