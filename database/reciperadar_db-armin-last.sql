-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 30. Jun 2024 um 18:53
-- Server-Version: 10.4.32-MariaDB
-- PHP-Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `reciperadar_db`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `comments`
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
-- Tabellenstruktur für Tabelle `likes`
--

CREATE TABLE `likes` (
  `likeID` int(20) NOT NULL,
  `postID` int(20) NOT NULL,
  `userID` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `messages`
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
-- Tabellenstruktur für Tabelle `posts`
--

CREATE TABLE `posts` (
  `postID` int(20) NOT NULL,
  `authorID` int(20) NOT NULL,
  `category` varchar(60) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `instructions` text DEFAULT NULL,
  `season` varchar(50) NOT NULL DEFAULT 'All Seasons',
  `ingredients` text DEFAULT NULL,
  `picPath` varchar(50) DEFAULT NULL,
  `postDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `posts`
--

INSERT INTO `posts` (`postID`, `authorID`, `category`, `title`, `content`, `instructions`, `season`, `ingredients`, `picPath`, `postDate`) VALUES
(21, 81, '', 'test', 'test1', NULL, 'All Seasons', NULL, '../uploads/BMW E30 M3.jpg', '2024-05-28 03:00:12'),
(28, 82, '', 'ddd', 'ddd', NULL, 'All Seasons', NULL, '../uploads/salad.png', '2024-06-30 14:15:12'),
(29, 82, '', 'Best Homemade Alfredo Sauce ', 'Best Homemade Alfredo Sauce is rich, creamy, and packed with garlic parmesan flavor!  This Alfredo Sauce is easy to make and perfect with your favorite pasta!', NULL, 'All Seasons', NULL, '../uploads/pasta-alfredo.png', '2024-06-30 14:29:57'),
(30, 82, '', 'new', 'new', NULL, 'All Seasons', '1\r\n2\r\n3', '../uploads/salad.png', '2024-06-30 15:04:00'),
(31, 82, '', 'New pasta alfredo', 'Best Homemade Alfredo Sauce is rich, creamy, and packed with garlic parmesan flavor! This Alfredo Sauce is easy to make and perfect with your favorite pasta!', '', 'All Seasons', '1/2 Cup Butter\r\n1 1/2 Cups Heavy Whipping Cream\r\n2 Teaspoons Garlic Minced\r\n1/2 Teaspoon Italian Seasoning\r\n1/2 Teaspoon Salt\r\n1/4 Teaspoon Pepper\r\n2 Cups Freshly Grated Parmesan Cheese', '../uploads/pasta-alfredo.png', '2024-06-30 15:21:24'),
(34, 82, '', 'Epic summer salad', 'Perfect for BBQs and buffets, our epic salad is an assembly job of gorgeous ingredients – no cooking required. Serve it with lamb kebabs for an impressive summer feast', 'STEP 1\r\nMake the dressing by blending all of the ingredients in a food processor (or very finely chop them), saving a few herb leaves for the salad. You can make the dressing up to 24 hrs before serving.\r\n\r\nSTEP 2\r\nScatter the beans and spinach over a large platter. Arrange the tomatoes, cucumber, mango, onion and radishes on top and gently toss together with your hands. Top the salad with the avocados, feta and herbs, and serve the dressing on the side.', 'Summer', '400g black beans, drained\r\n2 large handfuls baby spinach leaves, roughly chopped\r\n500g heritage tomatoes, chopped into large chunks\r\n½ cucumber, halved lengthways, seeds scooped out and sliced on an angle\r\n1 mango, peeled and chopped into chunks\r\n1 large red onion, halved and finely sliced\r\n6-8 radishes, sliced\r\n2 avocados, peeled and sliced\r\n100g feta, crumbled\r\nhandful of herbs (reserved from the dressing)', '../uploads/Epic-summer-salad.jpg', '2024-06-30 16:42:56');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `relations`
--

CREATE TABLE `relations` (
  `relationID` int(20) NOT NULL,
  `relationFrom` int(20) NOT NULL,
  `relationTo` int(20) NOT NULL,
  `type` varchar(50) CHARACTER SET utf16 COLLATE utf16_general_ci NOT NULL,
  `start` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `relations`
--

INSERT INTO `relations` (`relationID`, `relationFrom`, `relationTo`, `type`, `start`) VALUES
(1, 73, 74, 'friend', '0000-00-00 00:00:00'),
(2, 73, 79, 'friend', '0000-00-00 00:00:00'),
(3, 73, 81, 'friend', '0000-00-00 00:00:00'),
(4, 75, 73, 'friend', '0000-00-00 00:00:00'),
(5, 80, 73, 'friend', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
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
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`userID`, `type`, `salutation`, `firstName`, `middleName`, `lastName`, `userName`, `email`, `password`, `birthDate`, `profilePicture`) VALUES
(73, '', 'Herr', 'Ben', 'Nick', 'Fero', 'benfero', 'ben@fero.com', '$2y$10$3SFC3S1VKyI3ZOqwTxQ7/OAD9rgVCcX4/QT6w0p4WAxaFgOk.qt22', '1993-09-01', NULL),
(74, '', 'Keine Angabe', 'fovea', NULL, 'love', 'fovea', 'fovea@fovea.com', '$2y$10$nOc2kbuwqxd0jjDZKjZQ1On1B12jXsXnH7AI2svIpfnxdH8pQBZP2', '2024-05-01', NULL),
(75, '', 'Herr', 'Nick', NULL, 'chopper', 'nickchopper', 'nick@chopper.com', '$2y$10$ZBEIrtdbLVgwDH3FWnVimeIaesVK9Zce7RpvIezvdcJXOZAXj2d.a', '2024-05-15', NULL),
(79, '', 'Herr', 'Tin', 'Mid', 'Woodman', 'tintin', 'tin@tin.com', '$2y$10$4AEOeFBvG3lbq/UO9VKZJeb2YzdgWHI7YMa..5oK0CtcjSq4/QlBu', '2020-01-01', NULL),
(80, '', 'Herr', 'Ahmet', '', 'Cicek', 'ahmo', 'ahmo@ahmo.com', '$2y$10$qlDytecwL2FzhvGuCfBjfuzIPoh0sJS.YDnrAJ5mb60JuUxQ8TjHm', '2020-01-01', NULL),
(81, 'normal', 'Herr', 'ahmo', 'mesa', 'ahmo', 'ahmoahmo', 'ahmo@mo.com', '$2y$10$6oHkmkrcB1qkHH1tFUFn8eFJNwbJDnJR3oTDq/E2sYd0sAmoDglgy', '2000-01-01', NULL),
(82, 'normal', 'Herr', 'Armin', '', 'Dervisefendic', 'armin', 'armin.amino99@gmail.com', '$2y$10$YbctY/hS.dvmXhRWtKPiJugg1sZuLNJnGWLs0XissaOYFGW4C1vPq', '1999-04-20', NULL);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentID`),
  ADD KEY `postID` (`postID`),
  ADD KEY `userID` (`userID`);

--
-- Indizes für die Tabelle `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`likeID`);

--
-- Indizes für die Tabelle `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`messageID`);

--
-- Indizes für die Tabelle `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`postID`),
  ADD KEY `postUserID` (`authorID`);

--
-- Indizes für die Tabelle `relations`
--
ALTER TABLE `relations`
  ADD PRIMARY KEY (`relationID`),
  ADD KEY `relationFrom` (`relationFrom`,`relationTo`),
  ADD KEY `type` (`type`,`start`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `userName` (`userName`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `type` (`type`(1024)),
  ADD KEY `firstName` (`firstName`,`lastName`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `comments`
--
ALTER TABLE `comments`
  MODIFY `commentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `likes`
--
ALTER TABLE `likes`
  MODIFY `likeID` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `messages`
--
ALTER TABLE `messages`
  MODIFY `messageID` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `posts`
--
ALTER TABLE `posts`
  MODIFY `postID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT für Tabelle `relations`
--
ALTER TABLE `relations`
  MODIFY `relationID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`postID`) REFERENCES `posts` (`postID`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
