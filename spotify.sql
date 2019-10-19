-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 19, 2019 at 10:07 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spotify`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `artist` int(11) NOT NULL,
  `genre` int(11) NOT NULL,
  `artworkPath` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `title`, `artist`, `genre`, `artworkPath`) VALUES
(1, 'Bacon and Eggs', 2, 4, 'assets/images/artwork/clearday.jpg'),
(2, 'Pizza Head', 5, 9, 'assets/images/artwork/energy.jpg'),
(3, 'Summer Hits', 3, 1, 'assets/images/artwork/goinghigher.jpg'),
(4, 'The Movie Soundtrack', 2, 9, 'assets/images/artwork/funkyelement.jpg'),
(5, 'Best of the Worst', 1, 3, 'assets/images/artwork/popdance.jpg'),
(6, 'Hello World', 3, 6, 'assets/images/artwork/ukulele.jpg'),
(7, 'Best Beats', 4, 7, 'assets/images/artwork/sweet.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

CREATE TABLE `artists` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`id`, `name`) VALUES
(1, 'Mickey Mouse'),
(2, 'Goofy'),
(3, 'Eric Stanley'),
(4, 'Homer'),
(5, 'Bruce Lee');

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `name`) VALUES
(1, 'Rock'),
(2, 'Pop'),
(3, 'Hip Hop'),
(4, 'R & B'),
(5, 'Classical'),
(6, 'Techno'),
(7, 'Jazz'),
(8, 'Folk'),
(9, 'Country'),
(10, 'Rap');

-- --------------------------------------------------------

--
-- Table structure for table `playlists`
--

CREATE TABLE `playlists` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `owner` varchar(50) NOT NULL,
  `dateCreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `playlists`
--

INSERT INTO `playlists` (`id`, `name`, `owner`, `dateCreated`) VALUES
(2, 'Melodies', 'ericstanley', '2019-10-14 00:00:00'),
(3, 'Rock', 'ericstanley', '2019-10-14 00:00:00'),
(4, 'Beats', 'ericstanley', '2019-10-18 00:00:00'),
(5, 'Jazz', 'ericstanley', '2019-10-18 00:00:00'),
(6, 'Pop', 'ericstanley', '2019-10-18 00:00:00'),
(7, 'Hits', 'ericstanley', '2019-10-18 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `playlistSongs`
--

CREATE TABLE `playlistSongs` (
  `id` int(11) NOT NULL,
  `songId` int(11) NOT NULL,
  `playlistId` int(11) NOT NULL,
  `playlistOrder` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `playlistSongs`
--

INSERT INTO `playlistSongs` (`id`, `songId`, `playlistId`, `playlistOrder`) VALUES
(5, 9, 3, 3),
(7, 2, 2, 5),
(8, 2, 2, 6),
(9, 2, 3, 4),
(10, 1, 2, 7),
(11, 6, 3, 5),
(12, 9, 2, 8),
(13, 6, 4, 1),
(14, 5, 5, 1),
(15, 17, 6, 1),
(17, 21, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

CREATE TABLE `songs` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `artist` int(11) NOT NULL,
  `album` int(11) NOT NULL,
  `genre` int(11) NOT NULL,
  `duration` varchar(8) NOT NULL,
  `path` varchar(500) NOT NULL,
  `albumOrder` int(11) NOT NULL,
  `plays` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`id`, `title`, `artist`, `album`, `genre`, `duration`, `path`, `albumOrder`, `plays`) VALUES
(1, 'Acoustic Breeze', 1, 1, 8, '2:37', 'assets/music/bensound-acousticbreeze.mp3', 1, 31),
(2, 'A new beginning', 1, 5, 1, '2:35', 'assets/music/bensound-anewbeginning.mp3', 2, 16),
(3, 'Better Days', 1, 5, 2, '2:33', 'assets/music/bensound-betterdays.mp3', 3, 25),
(4, 'Buddy', 1, 5, 3, '2:02', 'assets/music/bensound-buddy.mp3', 4, 49),
(5, 'Clear Day', 1, 5, 4, '1:29', 'assets/music/bensound-clearday.mp3', 5, 14),
(6, 'Going Higher', 2, 1, 1, '4:04', 'assets/music/bensound-goinghigher.mp3', 1, 22),
(7, 'Funny Song', 2, 4, 2, '3:07', 'assets/music/bensound-funnysong.mp3', 2, 30),
(8, 'Funky Element', 2, 1, 3, '3:08', 'assets/music/bensound-funkyelement.mp3', 2, 56),
(9, 'Extreme Action', 2, 1, 4, '8:03', 'assets/music/bensound-extremeaction.mp3', 3, 1134),
(10, 'Epic', 2, 4, 5, '2:58', 'assets/music/bensound-epic.mp3', 3, 22),
(11, 'Energy', 2, 1, 6, '2:59', 'assets/music/bensound-energy.mp3', 4, 18),
(12, 'Dubstep', 2, 1, 7, '2:03', 'assets/music/bensound-dubstep.mp3', 5, 26),
(13, 'Happiness', 3, 6, 8, '4:21', 'assets/music/bensound-happiness.mp3', 5, 19),
(14, 'Happy Rock', 3, 6, 9, '1:45', 'assets/music/bensound-happyrock.mp3', 4, 22),
(15, 'Jazzy Frenchy', 3, 6, 10, '1:44', 'assets/music/bensound-jazzyfrenchy.mp3', 3, 37),
(16, 'Little Idea', 3, 6, 1, '2:49', 'assets/music/bensound-littleidea.mp3', 2, 41),
(17, 'Memories', 3, 6, 2, '3:50', 'assets/music/bensound-memories.mp3', 1, 39),
(18, 'Moose', 4, 7, 1, '2:43', 'assets/music/bensound-moose.mp3', 5, 50),
(19, 'November', 4, 7, 2, '3:32', 'assets/music/bensound-november.mp3', 4, 17),
(20, 'Of Elias Dream', 4, 7, 3, '4:58', 'assets/music/bensound-ofeliasdream.mp3', 3, 19),
(21, 'Pop Dance', 4, 7, 2, '2:42', 'assets/music/bensound-popdance.mp3', 2, 20),
(22, 'Retro Soul', 4, 7, 5, '3:36', 'assets/music/bensound-retrosoul.mp3', 1, 22),
(23, 'Sad Day', 5, 2, 1, '2:28', 'assets/music/bensound-sadday.mp3', 1, 56),
(24, 'Sci-fi', 5, 2, 2, '4:44', 'assets/music/bensound-scifi.mp3', 2, 24),
(25, 'Slow Motion', 5, 2, 3, '3:26', 'assets/music/bensound-slowmotion.mp3', 3, 22);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(32) NOT NULL,
  `signup_date` datetime NOT NULL,
  `profile_pic` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `firstname`, `lastname`, `email`, `password`, `signup_date`, `profile_pic`) VALUES
(6, 'EricStanley', 'Eric', 'Stanley', 'Eric@gmail.com', '72a3dcef165d9122a45decf13ae20631', '2019-08-31 00:00:00', 'assets/images/profile-pics/user.png'),
(7, 'KennedyJoseph', 'Kennedy', 'Joseph', 'Kennedy@gmail.com', 'f5d1278e8109edd94e1e4197e04873b9', '2019-08-31 00:00:00', 'assets/images/profile-pics/user.png'),
(8, 'ArunRaja', 'Arun', 'Raja', 'Arun@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '2019-08-31 00:00:00', 'assets/images/profile-pics/user.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `playlists`
--
ALTER TABLE `playlists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `playlistSongs`
--
ALTER TABLE `playlistSongs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `songs`
--
ALTER TABLE `songs`
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
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `artists`
--
ALTER TABLE `artists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `playlists`
--
ALTER TABLE `playlists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `playlistSongs`
--
ALTER TABLE `playlistSongs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `songs`
--
ALTER TABLE `songs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
