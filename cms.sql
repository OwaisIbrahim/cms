-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2019 at 02:23 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(3) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(29, 'PHP'),
(30, 'Javascript'),
(31, 'Sports'),
(32, 'Procedural PHP');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(7, 14, 'Edwin Riaz', 'edwinriaz@gmail.com', 'Hey! its copyright', 'unapproved', '2019-07-05'),
(13, 27, 'James Bond', 'jamesbond@gmail.com', 'Comment 1', 'approved', '2019-07-08'),
(14, 27, 'Usman Riaz', 'usmanriaz@gmail.com', 'Comment 2', 'unapproved', '2019-07-08'),
(15, 27, 'JamesBond', 'bilaljaffery@gmail.com', 'Comment 3', 'approved', '2019-07-08'),
(16, 27, 'Bilal Jaffery', 'bilaljaffery@gmail.com', 'Comment 4', 'unapproved', '2019-07-08'),
(17, 27, 'Gala', 'gala@gmail.com', 'Comment 5', 'unapproved', '2019-07-08'),
(19, 31, 'bilal', 'bilaljamal@gmail.com', 'THis is good', 'unapproved', '2019-07-09');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_cat_id` int(3) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_user` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comment_count` int(5) NOT NULL,
  `post_status` varchar(255) NOT NULL DEFAULT 'draft',
  `post_views_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_cat_id`, `post_title`, `post_author`, `post_user`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_views_count`) VALUES
(14, 32, 'POST 1000', 'James Bonf', 'James Bonf', '2019-07-04', 'image_2.jpg', 'PHP         ', 'php, advance php', 5, 'draft', 24),
(23, 30, 'JS DEMO', 'Riaz jaffery', 'Riaz jaffery', '2019-07-08', 'image_5.jpg', '<p>I love javascript</p>', 'js, angular, javascript', 0, 'draft', 1),
(25, 29, 'PHP', 'Riaz jaffery', 'Riaz jaffery', '2019-07-08', 'image_1.jpg', 'Magento Course was good                                 ', 'php, magento, magento', 0, 'draft', 0),
(26, 29, 'PHP', 'Riaz jaffery', 'Riaz jaffery', '2019-07-08', 'image_1.jpg', 'Magento Course was good                                 ', 'php, magento, magento', 0, 'draft', 0),
(27, 29, 'Javascript', 'Bilal Usman', 'Bilal Usman', '2019-07-09', 'image_2.jpg', '<p>Better than php</p>', 'javascript, js, typescript', 0, 'draft', 11),
(30, 30, 'Test User 2', '', 'abc1', '2019-07-08', 'image_5.jpg', '<p>This is test user 2</p>', 'js, js10, angular', 0, 'draft', 0),
(31, 30, 'Test User 55', '', 'ricky', '2019-07-10', 'image_5.jpg', '<p>This is test 55</p>', 'js, js7', 0, 'draft', 3),
(32, 29, 'Test post 1', '', 'bilal', '2019-07-09', 'image_1.jpg', '<p>This is test post 1</p>', 'php, php7', 0, 'draft', 8),
(34, 29, 'Test post 1', '', 'newuser', '2019-07-11', 'image_1.jpg', '<p>This is test post 1</p>', 'php, php7', 0, 'published', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` text NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `user_randSalt` varchar(255) NOT NULL DEFAULT '$2y$10$usesomecrazystring22',
  `user_token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `user_randSalt`, `user_token`) VALUES
(4, 'gala', 'gala', 'Gala', 'gala', 'gala@gmail.com', '', 'admin', '$2y$10$usesomecrazystring22', ''),
(9, 'abc123', 'abc123', 'Robin', 'Host', 'abc123@gmail.com', '', 'admin', '$2y$10$usesomecrazystring22', ''),
(12, 'demo123', '$1$pwBilkNg$nBwjWy1x..YCuGoEcnmzE/', 'Riaz', 'Jaffery', 'demo@gmail.com', '', 'subscriber', '$2y$10$usesomecrazystring22', ''),
(13, 'demo1000', '$1$wmEub61d$mvYYzNUBakPQ3SuY417m1/', '', '', 'demo@gmail.com', '', 'admin', '$2y$10$usesomecrazystring22', ''),
(17, 'newuser', '$2y$12$j.J22.UusPdvUOTKX2q4pe6iU8V23/R0FfEUnbfzYj9ERY4dH2GxC', '', '', 'newuser@gmail.com', '', 'admin', '$2y$10$usesomecrazystring22', ''),
(21, 'william', '$2y$10$84tv0zv7x0s1LHU5/mUBVuHoyYJ5WVcP.eDM4B4j0N8WI1D/M4zmS', 'WIlliam', 'Johns', 'william@gmail.com', '', 'admin', '$2y$10$usesomecrazystring22', ''),
(23, 'newuser1', '$2y$10$/mK6r6vCxJq0PfBst8O12uK7ZV4nJli4agwvvGTYMuk3pl7X0cz9K', '', '', 'newuser1@gmail.com', '', 'subscriber', '$2y$10$usesomecrazystring22', ''),
(24, 'newuser2', '$2y$10$f7OFZgdx2SlK8UFgnbml0.ggzmYe/cXQJXf8M2JRMOXGt5mjenXOe', '', '', 'newuser2@gmail.com', '', 'subscriber', '$2y$10$usesomecrazystring22', ''),
(25, 'bilal', '$2y$10$zq4AaTXcSGlSTvcpyhPugOzAJcfG5TNz7qU4.pcls7pbtWBpTI0Lq', '', '', 'bilal@gmail.com', '', 'subscriber', '$2y$10$usesomecrazystring22', ''),
(40, 'edwin', '$2y$10$wok3NGA3whLs26IF68dKAON8Pb/ZejRGtvMlikWi5XqR/vpCVf6T2', '', '', 'edwin@gmail.com', '', 'admin', '$2y$10$usesomecrazystring22', ''),
(45, 'edwin3', '$2y$10$xCk4l6iQM5ebGlEJbfFhiOorQKELuFJL4N.m9hk1VjT1qFrzLxbwO', '', '', 'edwin3@gmail.com', '', 'subscriber', '$2y$10$usesomecrazystring22', ''),
(46, 'edwin123', '$2y$10$BkhSfwjelOmNipviEEzB1.QisgA/e.CwEq98sy8qgeHp42eKTG67.', '', '', 'edwin123@gmail.com', '', 'subscriber', '$2y$10$usesomecrazystring22', ''),
(47, 'edwin12', '$2y$10$mmVwmuO/HWhaxFaV290cNOeJSlIAH5L.8yXN4DOwpSD0m.tDOllh6', '', '', 'edwin12@gmail.com', '', 'subscriber', '$2y$10$usesomecrazystring22', ''),
(48, 'edwin124', '$2y$10$q/4s.ePUFI7qwXOgfanU8OzfFx.TEmAzc5eqp1ZaK3TWA4PP/9CCy', '', '', 'edwin124@gmail.com', '', 'subscriber', '$2y$10$usesomecrazystring22', ''),
(49, 'edwin125', '$2y$10$v42IMhf/BRAFLng6UWwnpO0hKB6RnqkjhkSUqLryVV6131OPBzRYm', '', '', 'edwin125@gmail.com', '', 'subscriber', '$2y$10$usesomecrazystring22', ''),
(50, 'edwin126', '$2y$10$631.PV6NRzpc3OaEARqSsurXNCasDJ1mFMrKCVkJJzdQqqKchntmS', '', '', 'edwin126@gmail.com', '', 'subscriber', '$2y$10$usesomecrazystring22', ''),
(51, 'edwin128', '$2y$10$OCjAGM31ztialZnQw2/d5uEudtA5YStX26639pxnfGVduIPu.Ht7G', '', '', 'edwin128@gmail.com', '', 'subscriber', '$2y$10$usesomecrazystring22', ''),
(52, 'edwin129', '$2y$10$EE1.59c2G7rO42nZz0.dwOeJ5XiLu.9YWEXrmqANhk/LiyGJGtAF2', '', '', 'edwin129@gmail.com', '', 'subscriber', '$2y$10$usesomecrazystring22', ''),
(53, 'edwin120', '$2y$10$5tPvbbq3nGuansK5rRIou.XsLeDAc4.uzIxVbSbW2ZfTD2jGHesEe', '', '', 'edwin120@gmail.com', '', 'subscriber', '$2y$10$usesomecrazystring22', ''),
(54, 'edwin130', '$2y$10$SqniYtF6em2Q83/q62wKherOakmgG.8zzuKCXfbJpgdUBaG0DvPLO', '', '', 'edwin130@gmail.com', '', 'subscriber', '$2y$10$usesomecrazystring22', ''),
(55, 'susan', '$2y$10$xgCa5hyzfTnzqYRurDiSsuQS2tvP3eFB4CtcyYiFjIR2r.3pFTWgC', '', '', 'susan@gmail.com', '', 'subscriber', '$2y$10$usesomecrazystring22', ''),
(56, 'Owais', '$2y$10$XzJQ6SVaspT.j20UImMdvuLHpKsX72ZhIol10zJ5tL12bP2KK5UNK', '', '', 'owaisibrahim099@gmail.com', '', 'admin', '$2y$10$usesomecrazystring22', '7c6af461e301ae2ca08d21390a66be981c2f5887873c5d0bacb22a98e7113ae7fd52e0f6a6c7b83ae6eeefb2c6e822547ebc'),
(57, 'bilalusman', '$2y$10$Icl/b5ITwREG5h2Nnal88uBJ8.rvUyzoXJaRpNPFUBcw7tesAAX/e', '', '', 'bilalusman@gmail.com', '', 'subscriber', '$2y$10$usesomecrazystring22', ''),
(58, 'jameelusman', '$2y$10$y32WMAzuozcqVwCZ65J2dOg0OutyPRo85ZMg2GsRuemc2fVkova8O', '', '', 'jameelusmani@gmail.com', '', 'subscriber', '$2y$10$usesomecrazystring22', ''),
(59, 'jameelu', '$2y$10$VTxmtjzmTVCrZPi8HUHL3OI/IVyATzugsTU.nky98VLqBmqHkON9O', '', '', 'jameelu@gmail.com', '', 'subscriber', '$2y$10$usesomecrazystring22', ''),
(60, 'lius', '$2y$10$8Ku9YP3sBztAmqvog/TdY.qwgdFj0Bn9IwdsYG5TlBrok2OHYieqG', '', '', 'lius@gmail.com', '', 'subscriber', '$2y$10$usesomecrazystring22', ''),
(61, 'shakeel', '$2y$10$NcM1RUlYegFqSC01iSsI3OWd8GzMOULuBP8Zrfx4uRIOaptZMS0ve', '', '', 'shakeel@gmail.com', '', 'subscriber', '$2y$10$usesomecrazystring22', ''),
(62, 'yousuf', '$2y$10$gtBevu/EsepL7KFn./wc5eAqYo/.SeWDUiedXNyCnJNfE7iqxWeby', '', '', 'yousuf@gmail.com', '', 'subscriber', '$2y$10$usesomecrazystring22', '');

-- --------------------------------------------------------

--
-- Table structure for table `users_online`
--

CREATE TABLE `users_online` (
  `id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_online`
--

INSERT INTO `users_online` (`id`, `session`, `time`) VALUES
(2, 'p8njvn36qvhnntgppphcfoji7j', 1562599005),
(3, 'i82ut6jfcukln2pmv8q54e65i4', 1562586740),
(4, 'o8i62bmus77k58sg9ihfbvere8', 1562597420),
(5, 'i4jich7g99qds47312hfhl631d', 1562590517),
(6, '23itema69gsftfb0krjo2hnefs', 1562654338),
(7, 'kcstktubblarfpcq294gd706js', 1562684864),
(8, 'ra9gipc4k3u7u1kangveg5do6i', 1562774329),
(9, '0rajk4qhbcrkdfciqnsps18mpf', 1562760162),
(10, 'tbcagh08967em0159an9ocf741', 1562860636),
(11, 'o5nam6a7dadf83m3aa1i1m68qb', 1562914187),
(12, 'gnb831eirisllpoev0us4j7k8t', 1562918796),
(13, 'g7b4169rconc4s9qeo44cdglo5', 1562917964),
(14, 'h8gh81pbdu79ts260dkg89ckml', 1562934189);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_username` (`user_username`);

--
-- Indexes for table `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
