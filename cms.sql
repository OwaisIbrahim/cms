-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2019 at 09:54 AM
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
(10, 29, 'JS Feedback', 'Adnan Rafiq', 'Adnan Rafiq', '2019-07-04', 'image_5.jpg', '        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry', 'js, php, magenti', 4, 'published', 1),
(14, 32, 'POST 1000', 'James Bonf', 'James Bonf', '2019-07-04', 'image_2.jpg', 'PHP         ', 'php, advance php', 5, 'published', 1),
(23, 30, 'JS DEMO', 'Riaz jaffery', 'Riaz jaffery', '2019-07-08', 'image_5.jpg', '<p>I love javascript</p>', 'js, angular, javascript', 0, 'published', 0),
(25, 29, 'PHP', 'Riaz jaffery', 'Riaz jaffery', '2019-07-08', 'image_1.jpg', 'Magento Course was good                                 ', 'php, magento, magento', 0, 'published', 0),
(26, 29, 'PHP', 'Riaz jaffery', 'Riaz jaffery', '2019-07-08', 'image_1.jpg', 'Magento Course was good                                 ', 'php, magento, magento', 0, 'published', 0),
(27, 29, 'Javascript', 'Bilal Usman', 'Bilal Usman', '2019-07-09', 'image_2.jpg', '<p>Better than php</p>', 'javascript, js, typescript', 0, 'published', 11),
(30, 30, 'Test User 2', '', 'abc1', '2019-07-08', 'image_5.jpg', '<p>This is test user 2</p>', 'js, js10, angular', 0, 'published', 0),
(31, 30, 'Test User 55', '', 'ricky', '2019-07-09', 'image_5.jpg', '<p>This is test 55</p>', 'js, js7', 0, 'draft', 3);

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
  `user_randSalt` varchar(255) NOT NULL DEFAULT '$2y$10$usesomecrazystring22'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `user_randSalt`) VALUES
(1, 'bilal', '123', 'bilal', 'gaffar', 'bilalgaffar@gmail.com', '', 'admin', ''),
(3, 'ricky', 'ricky123', 'Ricky', 'Sons', 'ricky@gmail.com', '', 'admin', ''),
(4, 'gala', 'gala', 'Gala', 'gala', 'gala@gmail.com', '', 'admin', '$2y$10$usesomecrazystring22'),
(9, 'abc123', 'abc123', 'Robin', 'Host', 'abc123@gmail.com', '', 'subscriber', '$2y$10$usesomecrazystring22'),
(12, 'demo123', '$1$pwBilkNg$nBwjWy1x..YCuGoEcnmzE/', 'Riaz', 'Jaffery', 'demo@gmail.com', '', 'admin', '$2y$10$usesomecrazystring22'),
(13, 'demo1000', '$1$wmEub61d$mvYYzNUBakPQ3SuY417m1/', '', '', 'demo@gmail.com', '', 'admin', '$2y$10$usesomecrazystring22'),
(17, 'newuser', '$2y$12$yZNml4Rg2B1d.TDRLiQzJeg8qlwHuY9rO95KzrsTcwaWwUVG0haDG', '', '', 'newuser@gmail.com', '', 'subscriber', '$2y$10$usesomecrazystring22'),
(21, 'william', '$2y$10$84tv0zv7x0s1LHU5/mUBVuHoyYJ5WVcP.eDM4B4j0N8WI1D/M4zmS', 'WIlliam', 'Johns', 'william@gmail.com', '', 'admin', '$2y$10$usesomecrazystring22'),
(22, 'newuser', '$2y$12$3qVCHSmwzLshfW56U5LNGe2Adizqd0uJPtto0aUVIe2VqkPDZUg1O', 'William', 'Shakes', 'newuser@gmail.com', '', 'admin', '$2y$10$usesomecrazystring22');

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
(7, 'kcstktubblarfpcq294gd706js', 1562658827);

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
  ADD PRIMARY KEY (`user_id`);

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
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
