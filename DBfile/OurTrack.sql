-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Dec 02, 2014 at 05:03 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `collaborators`
--

INSERT INTO `collaborators` (`id`, `user1_id`, `user2_id`, `created_at`) VALUES
(2, 4, 3, '2014-12-02 16:02:37'),
(8, 2, 3, '2014-12-02 16:02:37');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`id`, `user_id`, `follower_id`, `created_at`) VALUES
(6, 2, 3, '2014-12-02 16:02:09'),
(7, 4, 3, '2014-12-02 16:02:09'),
(8, 3, 4, '2014-12-02 16:02:09'),
(9, 4, 2, '2014-12-02 16:02:09');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `track_id`, `user_id`, `created_at`) VALUES
(27, 1, 4, '2014-12-02 16:00:42'),
(28, 2, 4, '2014-12-02 16:00:42'),
(29, 3, 3, '2014-12-02 16:00:42'),
(30, 2, 2, '2014-12-02 16:00:42'),
(31, 3, 2, '2014-12-02 16:00:42');

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
  `likes` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`id`, `track_id`, `owner_id`, `picture`, `source`, `title`, `description`, `likes`, `created_at`) VALUES
(1, 1, 4, 'ajeif45s843l.jpg', 'whoosh.wav', 'Reply Track', 'This a reply to another track', 2, '2014-12-02 16:01:24'),
(2, 2, 2, 'kentsquare.jpg', 'whoosh.wav', 'reply to Second Track', 'This is the reply I made for the second track.', 1, '2014-12-02 16:01:24'),
(3, 2, 3, 'square.jpg', '', 'Reply track ', 'this is the description for this reply track', 1, '2014-12-02 15:57:02'),
(4, 3, 3, 'tonsoflikes.jpg', 'whoosh.wav', 'this is a reply', 'This is a description', 0, '2014-12-02 16:01:24');

-- --------------------------------------------------------

--
-- Table structure for table `rlikes`
--

CREATE TABLE `rlikes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reply_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `rlikes`
--

INSERT INTO `rlikes` (`id`, `reply_id`, `user_id`, `created_at`) VALUES
(11, 1, 3, '2014-12-02 16:01:02'),
(12, 1, 2, '2014-12-02 16:01:02'),
(13, 2, 4, '2014-12-02 16:01:02'),
(14, 3, 3, '2014-12-02 16:01:02');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tagmaps`
--

INSERT INTO `tagmaps` (`id`, `track_id`, `tag_id`, `type`) VALUES
(4, 1, 1, 'track'),
(5, 1, 2, 'track'),
(6, 2, 1, 'track'),
(7, 2, 4, 'track'),
(8, 3, 5, 'track'),
(9, 4, 2, 'track'),
(10, 4, 3, 'track');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`) VALUES
(2, 'blues'),
(5, 'fresh'),
(3, 'new'),
(4, 'other'),
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
  `withcollaborators` tinyint(1) NOT NULL,
  `likes` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tracks`
--

INSERT INTO `tracks` (`id`, `owner_id`, `picture`, `source`, `title`, `description`, `genre`, `withcollaborators`, `likes`, `created_at`) VALUES
(1, 3, 'ajeif45s843l.jpg', 'whoosh.wav', 'Track Title', 'Track Description', 'Alternative', 0, 1, '2014-12-02 15:59:59'),
(2, 3, 'tonsoflikes.jpg', 'whoosh.wav', 'Second Track', 'this is the description of my second track', 'Electronic', 1, 2, '2014-12-02 15:59:59'),
(3, 4, 'square.jpg', 'whoosh.wav', 'Whoooooooosh', 'This is the description for the whoosh track.', 'Alternative', 0, 2, '2014-12-02 15:59:59'),
(4, 2, 'kentsquare.jpg', 'whoosh.wav', 'My First Track', 'the description from my first track is right here.', 'Jazz', 0, 0, '2014-12-02 15:59:59');

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
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `salt`, `bio`, `picture`) VALUES
(2, 'email@domain.com', 'Jack Black', 'e3d21997fd10a4b19180583ea70640ecd2d4a1f9fc747346835ec11f85328100', 'GóŸZ á7¹ñ‰·I$kë¶‰v­z¼Õ ß‡', 'This is the bio of Jack Black. He has not uploaded a new profile image yet.', 'default.png'),
(3, 'new@email.com', 'John Doe', '2b03509986609e6c4571397da9f585bbcbfbf6318cbfb0bed2fabeb2c68f9277', 'Eø¸i™.—É×nõMmr;EŸ¦CV.U‚ìCà ', 'this is the bio informatio of John Doe.', '54799bae972c4.png'),
(4, 'joeblow@gmail.com', 'Joe Blow', '38eb0d32b073d9d0784aedc72868d4995ecc3d67c4318a2015f20a557f47fe61', '…q{\ZF?ìYB`Ul¨IYåµç¡Â×ºÈR˜½Y|û®', 'This is joe blow''s bio. He has changed his default profile picture\n', '547dd9d751be7.jpg');
