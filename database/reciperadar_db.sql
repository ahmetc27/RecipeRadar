-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2024 at 12:46 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

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

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`commentID`, `postID`, `userID`, `content`, `commentDate`, `updateDate`) VALUES
(5, 34, 83, 'very cool', '2024-07-01 01:02:38', '2024-07-01 01:02:38'),
(11, 34, 82, 'nice', '2024-07-02 00:30:31', '2024-07-02 00:30:31'),
(12, 40, 85, 'This looks absolutely delicious! Can\'t wait to try it out. 😋', '2024-07-02 11:21:53', '2024-07-02 11:21:53'),
(13, 40, 86, 'Wow, the presentation is stunning! Do you have any tips for a beginner?', '2024-07-02 11:23:59', '2024-07-02 11:23:59'),
(14, 34, 86, 'Just made this for dinner and it was amazing. Thanks for sharing!', '2024-07-02 11:24:20', '2024-07-02 11:24:20'),
(15, 39, 86, 'Your step-by-step instructions made it so easy to follow. Turned out great!', '2024-07-02 11:24:45', '2024-07-02 11:24:45'),
(16, 39, 87, 'This is my kind of meal – simple, delicious, and full of flavor.', '2024-07-02 11:29:15', '2024-07-02 11:29:15'),
(17, 40, 87, 'The combination of spices in this recipe is fantastic. Well done!', '2024-07-02 11:29:29', '2024-07-02 11:29:29'),
(18, 31, 87, 'I\'m always looking for new recipes to try, and this one looks like a winner!', '2024-07-02 11:29:56', '2024-07-02 11:29:56'),
(19, 39, 88, 'Tried this recipe last night and it was a hit with the whole family!', '2024-07-02 11:37:04', '2024-07-02 11:37:04'),
(20, 39, 89, 'This looks like comfort food at its finest. Yum!', '2024-07-02 11:38:50', '2024-07-02 11:38:50'),
(21, 40, 90, 'The ingredients list is so fresh and vibrant. Perfect for summer!', '2024-07-02 11:39:58', '2024-07-02 11:39:58'),
(22, 40, 92, 'Made this for my partner and they couldn\'t stop raving about it. Thank you!', '2024-07-02 11:42:23', '2024-07-02 11:42:23'),
(23, 40, 93, 'Very Cool!!!', '2024-07-02 11:44:34', '2024-07-02 11:44:34'),
(24, 39, 93, 'So refreshing !!', '2024-07-02 11:44:51', '2024-07-02 11:44:51'),
(25, 31, 93, 'Delicious !!', '2024-07-02 11:45:11', '2024-07-02 11:45:11'),
(26, 39, 94, 'Thank you for this great recipe. Delicious!', '2024-07-02 11:46:31', '2024-07-02 11:46:31'),
(27, 39, 98, 'Amazing and refreshing', '2024-07-02 11:50:40', '2024-07-02 11:50:40');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `likeID` int(20) NOT NULL,
  `postID` int(20) NOT NULL,
  `userID` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`likeID`, `postID`, `userID`) VALUES
(133, 34, 83),
(135, 34, 82),
(136, 40, 84),
(137, 39, 82),
(138, 40, 85),
(139, 39, 85),
(140, 30, 85),
(141, 40, 86),
(142, 34, 86),
(143, 39, 86),
(144, 39, 87),
(145, 40, 87),
(146, 31, 87),
(147, 39, 88),
(148, 34, 88),
(149, 40, 88),
(150, 39, 89),
(151, 40, 89),
(152, 40, 90),
(153, 39, 90),
(154, 40, 91),
(155, 39, 91),
(156, 34, 91),
(157, 31, 91),
(158, 30, 91),
(159, 40, 92),
(160, 39, 92),
(161, 40, 93),
(162, 39, 93),
(163, 31, 93),
(164, 40, 94),
(165, 34, 94),
(166, 39, 94),
(167, 40, 95),
(168, 39, 95),
(169, 39, 96),
(170, 40, 96),
(171, 39, 97),
(172, 39, 98);

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
  `instructions` text DEFAULT NULL,
  `season` varchar(50) NOT NULL DEFAULT 'All Seasons',
  `ingredients` text DEFAULT NULL,
  `picPath` varchar(50) DEFAULT NULL,
  `postDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`postID`, `authorID`, `category`, `title`, `content`, `instructions`, `season`, `ingredients`, `picPath`, `postDate`) VALUES
(30, 82, '', 'Fresh Salad', 'new', NULL, 'All Seasons', '1\r\n2\r\n3', '../uploads/salad.png', '2024-06-30 15:04:00'),
(31, 82, '', 'Best Homemade Alfredo Sauce ', 'Best Homemade Alfredo Sauce is rich, creamy, and packed with garlic parmesan flavor! This Alfredo Sauce is easy to make and perfect with your favorite pasta!', '', 'All Seasons', '1/2 Cup Butter\r\n1 1/2 Cups Heavy Whipping Cream\r\n2 Teaspoons Garlic Minced\r\n1/2 Teaspoon Italian Seasoning\r\n1/2 Teaspoon Salt\r\n1/4 Teaspoon Pepper\r\n2 Cups Freshly Grated Parmesan Cheese', '../uploads/pasta-alfredo.png', '2024-06-30 15:21:24'),
(34, 82, '', 'Epic summer salad', 'Perfect for BBQs and buffets, our epic salad is an assembly job of gorgeous ingredients – no cooking required. Serve it with lamb kebabs for an impressive summer feast', 'STEP 1\r\nMake the dressing by blending all of the ingredients in a food processor (or very finely chop them), saving a few herb leaves for the salad. You can make the dressing up to 24 hrs before serving.\r\n\r\nSTEP 2\r\nScatter the beans and spinach over a large platter. Arrange the tomatoes, cucumber, mango, onion and radishes on top and gently toss together with your hands. Top the salad with the avocados, feta and herbs, and serve the dressing on the side.', 'Summer', '400g black beans, drained\r\n2 large handfuls baby spinach leaves, roughly chopped\r\n500g heritage tomatoes, chopped into large chunks\r\n½ cucumber, halved lengthways, seeds scooped out and sliced on an angle\r\n1 mango, peeled and chopped into chunks\r\n1 large red onion, halved and finely sliced\r\n6-8 radishes, sliced\r\n2 avocados, peeled and sliced\r\n100g feta, crumbled\r\nhandful of herbs (reserved from the dressing)', '../uploads/Epic-summer-salad.jpg', '2024-06-30 16:42:56'),
(39, 84, '', 'Peach & raspberry fruit salad with mascarpone', 'Get the best out of fresh produce with this lovely peach and raspberry fruit salad. Serve with a scattering of pistachios, mascarpone and maple syrup', 'STEP 1\r\nStone and finely slice the peaches or nectarines and arrange the slices over four plates. Sprinkle over a little of the sugar and scatter over most of the thyme leaves.\r\n\r\nSTEP 2\r\nWhisk together the mascarpone, cream, vanilla extract and the remaining sugar in a bowl until light and fluffy. Spoon or pipe blobs of the mixture over the peaches or nectarines and arrange the raspberries over the plates. Finish with a scattering of pistachios, the remaining thyme leaves and a drizzle of maple syrup to serve.', 'Summer', '2 ripe peaches or nectarines\r\n50g caster sugar\r\n1 tsp lemon thyme leaves\r\n100g mascarpone\r\n100ml double cream\r\ndrop vanilla extract\r\n16 raspberries, halved\r\nsmall handful pistachios, roughly chopped\r\n1 tbsp maple syrup', '../uploads/peach-raspberry-fruit-salad.jpg', '2024-07-02 00:51:17'),
(40, 84, '', 'Panzanella 🍳👨‍🍳', 'Prepare your own version of one of Tuscany’s most famous dishes, panzanella. It\'s a good way to use up leftovers, as it\'s made with stale bread – simply toss with ripe tomatoes and an olive oil dressing', 'STEP 1\r\nHeat the oven to 180C/160C fan/gas 4. Put the tomatoes in a colander and sprinkle over 1 tsp sea salt, then leave to sit for 15 mins.\r\n\r\nSTEP 2\r\nSpread the chunks of bread out on a baking tray and toss with 1 tbsp of the oil. Bake for 10-15 mins, or until lightly toasted.\r\n\r\nSTEP 3\r\nIn a bowl, whisk together the remaining oil, the vinegar and shallot. Season to taste. Toss the anchovies with the tomatoes, croutons, olive oil dressing, the olives and half the basil in a large bowl. Spoon the panzanella onto a serving plate and top with the remaining basil.', 'All', '1kg ripe mixed tomatoes, halved if small, quartered if large\r\n300g day-old sourdough or ciabatta, torn into large chunks\r\n100ml extra virgin olive oil\r\n50ml red wine vinegar\r\n1 small shallot, finely chopped\r\n50g tin anchovies, drained and roughly chopped\r\n100g black olives, pitted\r\nlarge handful of basil leaves, torn', '../uploads/Panzanella.jpg', '2024-07-02 00:57:21');

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
(5, 80, 73, 'friend', '0000-00-00 00:00:00'),
(9, 82, 84, 'friend', '2024-07-01 15:32:21'),
(10, 84, 83, 'friend', '2024-07-01 15:34:35'),
(23, 82, 83, 'friend', '2024-07-02 09:11:41');

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
(81, 'normal', 'Herr', 'ahmo', 'mesa', 'ahmo', 'ahmoahmo', 'ahmo@mo.com', '$2y$10$6oHkmkrcB1qkHH1tFUFn8eFJNwbJDnJR3oTDq/E2sYd0sAmoDglgy', '2000-01-01', NULL),
(82, 'normal', 'Herr', 'Armin', 'test', 'Dervisefendic', 'armin', 'armin.amino99@gmail.com', '$2y$10$YbctY/hS.dvmXhRWtKPiJugg1sZuLNJnGWLs0XissaOYFGW4C1vPq', '1999-04-20', NULL),
(83, 'admin', '', 'admin', 'admin', 'admin', 'admin', 'admin@admin.at', '$2y$10$s1DTYDnXQkptb9hUbEu1l.M1MsHdZc.bzsUpQsShza5Dr2dqa0TcW', '2024-01-01', NULL),
(84, 'normal', 'Herr', 'Chef', '', 'Ramsey', 'chef', 'chef@ramsey.at', '$2y$10$aVL6CPbhRuZ4baPqq3dN1elloj4Kyl4rujrWInmbaxwNsCYGcRAhe', '2024-07-01', NULL),
(85, 'normal', 'Herr', 'John', 'Michael', 'Doe', 'johndoe90', 'john.doe@example.com', '$2y$10$zD9BP2EwMThpjRlqK1/mpO.HXVGqGiEE84uOtWRRoe1ZvQsptKhue', '1990-01-01', NULL),
(86, 'normal', 'Frau', 'Jane', 'Elizabeth', 'Smith', 'janesmith65', 'jane.smith@example.com', '$2y$10$7oo4AvOrGJJ8ZWR3ICdCRenN.bq5MKm0B84dxP4E03AoKahE.B2SG', '1965-05-05', NULL),
(87, 'normal', 'Herr', 'William', 'Robert', 'Johnson', 'williamjohnson78', 'william.johnson@example.com', '$2y$10$8ClWYiURugWZ6EavQ1Q1EOodKIDt6cMjQXkdczwf4nprO0EqSUgm.', '1978-11-11', NULL),
(88, 'normal', 'Frau', 'Emily', 'Grace', 'Brown', 'emilybrown92', 'emily.brown@example.com', '$2y$10$JQ0UwC5ChBDjD41mrbcIL.qVaoP2NNBl0DsVa6YzIWHIiHvziNs0W', '1992-03-07', NULL),
(89, 'normal', 'Herr', 'James', 'Anthony', 'Davis', 'jamesdavis88', 'james.davis@example.com', '$2y$10$H1h0l4LyoowU/rJQtzoHTOfnCPvwAmYFXG8lqhxILNIIPEJgTZywm', '1988-03-03', NULL),
(90, 'normal', 'Frau', 'Sarah', 'Louise', 'Miller', 'sarahmiller95', 'sarah.miller@example.com', '$2y$10$RmlMHyt4Hmi6ROQb0tLSpOQXxJd3jSZeEFTTWjcyUJseUscvzCIzC', '1995-05-05', NULL),
(91, 'normal', 'Herr', 'Daniel', 'Thomas', 'Wilson', 'danielwilson83', 'daniel.wilson@example.com', '$2y$10$doYRNtgeIr2qQwwM9iwyAOkDp3qMveOmFgHnS9LEuLpLERAjgqXpa', '1983-07-07', NULL),
(92, 'normal', 'Frau', 'Laura', 'Ann', 'Moore', 'lauramoore91', 'laura.moore@example.com', '$2y$10$WmaaBYYS5ZZlECc5SUgUwOJMd1Aw7/ZLa4/XknwQX/8J1/IOiT4se', '1991-12-12', NULL),
(93, 'normal', 'Herr', 'Christopher', 'David', 'Taylor', 'christophertaylor87', 'christopher.taylor@example.com', '$2y$10$lhw/.x9.nwSzQEM.RfkrC.ioqc1PwmkzQrIWem/hiXRld7aIkoh7C', '1987-04-04', NULL),
(94, 'normal', 'Frau', 'Amanda', 'Nicole', 'Anderson', 'amandaanderson93', 'amanda.anderson@example.com', '$2y$10$7Ok/Kx1snP9DwBw51dV/L.c6MPiPzssnpCS/JjnMGGenS5QlQH.p2', '1993-10-10', NULL),
(95, 'normal', 'Herr', 'Michael', 'Joseph', 'Thomas', 'michaelthomas80', 'michael.thomas@example.com', '$2y$10$vRsn3mLHTfYtUQNkNoYrlesek08POhnWq54.A8hyBJrc9fxe8VFBy', '1980-04-02', NULL),
(96, 'normal', 'Frau', 'Jennifer', 'Marie', 'Jackson', 'jenniferjackson86', 'jennifer.jackson@example.com', '$2y$10$ITJB.zNt3w05o0R50PepeuhWYh7Y/Qd/a5xKQx3f.ZOWO1jSTMWm.', '1986-07-07', NULL),
(97, 'normal', 'Herr', 'Matthew', 'Alexander', 'White', 'matthewwhite94', 'matthew.white@example.com', '$2y$10$LqDHY/Zp711kQ9/dVIDKye0OoWbEsdWib0ZSD9mlyqt4whtSMJbl6', '1994-01-01', NULL),
(98, 'normal', 'Frau', 'Jessica', 'Lynn', 'Harris', 'jessicaharris89', 'jessica.harris@example.com', '$2y$10$DbEGq9GzkGzO0rk/MJdR4eLKpq0keYAoY2aIX.xDDK6jtvVfyOpb.', '1989-04-05', NULL),
(99, 'normal', 'Herr', 'testtt', 'testt', 'testt', 'testt', 'testt@test.at', '$2y$10$SmpY5q7O.kAjbi7P7fiRpeImgt/GB1Hvc3hhfI8af.IAzRuMtgDAu', '2024-07-02', NULL),
(100, 'normal', 'Herr', 'Ahmet', 'Ahmo', 'Cicek', 'ahmetc27', 'ahmetcicek@gmail.at', '$2y$10$BMcT.TmQpSw/762iy3/QVeel894kmEqsmywYSnU4FuaU.FHz0XlOS', '2024-07-02', NULL);

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
  MODIFY `commentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `likeID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `messageID` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `postID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `relations`
--
ALTER TABLE `relations`
  MODIFY `relationID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

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
