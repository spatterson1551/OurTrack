-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Nov 30, 2014 at 03:52 AM
-- Server version: 5.5.34
-- PHP Version: 5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `OurTrack`
--

-- --------------------------------------------------------

--
-- Table structure for table `collaborators`
--

CREATE TABLE `collaborators` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user1_id` int(11) NOT NULL,
  `user2_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `collaborators`
--

INSERT INTO `collaborators` (`id`, `user1_id`, `user2_id`, `created_at`) VALUES
(1, 1, 3, '2014-11-29 07:30:56'),
(2, 3, 2, '2014-11-29 07:58:05');

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `follower_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`id`, `user_id`, `follower_id`, `created_at`) VALUES
(1, 3, 2, '2014-11-29 07:31:19'),
(2, 1, 3, '2014-11-29 07:31:42');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `track_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `track_id`, `user_id`, `created_at`) VALUES
(2, 1, 3, '2014-11-30 01:58:32');

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `track_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `picture` varchar(30) NOT NULL,
  `source` varchar(30) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `genre` varchar(30) NOT NULL,
  `likes` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`id`, `track_id`, `owner_id`, `picture`, `source`, `title`, `description`, `genre`, `likes`, `created_at`) VALUES
(1, 1, 3, 'ajeif45s843l.jpg', 'track.mp3', 'Reply Track', 'This a reply to another track', 'Alternative', 0, '2014-11-30 02:00:36');

-- --------------------------------------------------------

--
-- Table structure for table `tagmaps`
--

CREATE TABLE `tagmaps` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `track_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `type` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tagmaps`
--

INSERT INTO `tagmaps` (`id`, `track_id`, `tag_id`, `type`) VALUES
(1, 1, 1, 'track'),
(2, 1, 2, 'track'),
(3, 1, 2, 'reply');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`) VALUES
(2, 'blues'),
(1, 'rock');

-- --------------------------------------------------------

--
-- Table structure for table `tracks`
--

CREATE TABLE `tracks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) NOT NULL,
  `picture` varchar(30) NOT NULL,
  `source` varchar(30) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `genre` varchar(30) NOT NULL,
  `likes` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tracks`
--

INSERT INTO `tracks` (`id`, `owner_id`, `picture`, `source`, `title`, `description`, `genre`, `likes`, `created_at`) VALUES
(1, 3, 'ajeif45s843l.jpg', 'track.mp3', 'Track Title', 'Track Description', 'Alternative', 11, '2014-11-26 07:31:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(60) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(65) NOT NULL,
  `salt` varchar(32) NOT NULL,
  `bio` text NOT NULL,
  `picture` varchar(25) NOT NULL,
  `url` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `salt`, `bio`, `picture`, `url`) VALUES
(1, 'test@ourtrack.com', 'steve', 'password', 'salt', 'bio', 'smile.jpg', '1'),
(2, 'email@domain.com', 'okay', 'e3d21997fd10a4b19180583ea70640ecd2d4a1f9fc747346835ec11f85328100', 'GóŸZ á7¹ñ‰·I$kë¶‰v­z¼Õ ß‡', '', 'default.png', ''),
(3, 'new@email.com', 'okayyy', '2b03509986609e6c4571397da9f585bbcbfbf6318cbfb0bed2fabeb2c68f9277', 'Eø¸i™.—É×nõMmr;EŸ¦CV.U‚ìCà ', 'this is the new bio.', '54799bae972c4.png', '');
