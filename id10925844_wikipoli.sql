-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 25, 2019 at 01:48 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id10925844_wikipoli`
--
CREATE DATABASE IF NOT EXISTS `id10925844_wikipoli` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `id10925844_wikipoli`;

-- --------------------------------------------------------

--
-- Table structure for table `blocked_users`
--

CREATE TABLE `blocked_users` (
  `id` int(11) NOT NULL,
  `user_id` int(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blocked_users`
--

INSERT INTO `blocked_users` (`id`, `user_id`) VALUES
(1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(8) NOT NULL,
  `comment` text NOT NULL,
  `post_id` int(8) NOT NULL,
  `user_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment`, `post_id`, `user_id`) VALUES
(1, 'This is really cool. first comment', 169511336, '920757154');

-- --------------------------------------------------------

--
-- Table structure for table `editions`
--

CREATE TABLE `editions` (
  `edition_id` int(8) NOT NULL,
  `edition` text NOT NULL,
  `post_id` int(8) NOT NULL,
  `user_id` int(8) NOT NULL,
  `edition_date` varchar(255) NOT NULL,
  `edition_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `likes_id` int(8) NOT NULL,
  `post_id` int(8) NOT NULL,
  `user_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(8) NOT NULL,
  `post` text NOT NULL,
  `post_author` int(8) NOT NULL,
  `post_date` varchar(255) NOT NULL,
  `post_date_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `post_status` varchar(255) NOT NULL,
  `post_topic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post`, `post_author`, `post_date`, `post_date_time`, `post_status`, `post_topic`) VALUES
(169511336, 'second post', 920757154, '2019', '2019-10-24 19:49:55', '', 'second topic'),
(175896910, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Aliquam ut porttitor leo a diam. Non nisi est sit amet. Turpis in eu mi bibendum neque egestas congue. Et tortor at risus viverra adipiscing at in. Facilisi morbi tempus iaculis urna id volutpat. Sit amet mauris commodo quis. Sit amet porttitor eget dolor morbi non arcu. Amet justo donec enim diam vulputate ut. Nulla facilisi morbi tempus iaculis urna id. Viverra suspendisse potenti nullam ac tortor. Lectus urna duis convallis convallis tellus id interdum velit. Orci dapibus ultrices in iaculis nunc sed augue lacus viverra.', 920757154, '2019', '2019-10-25 00:09:43', '', 'tester'),
(192555961, 'Below is a static modal example (meaning its position and display have been overridden). Included are the modal header, modal body (required for padding), and modal footer (optional). We ask that you include modal headers with dismiss actions whenever possible, or provide another explicit dismiss action.', 920757154, '2019', '2019-10-25 01:11:38', '', 'tester'),
(339692695, 'This is actually what tools like Workbox do when precaching assets—they generate a hash of the contents of each file in your build and they store that mapping in the service worker (think of it like an internal import map). They also cache the resources for you when the service worker first installs, and they automatically add fetch listeners to respond to matching requests with the cached files.\nWhile serving un-revisioned assets from your server may seem scary (and counter to everything you’ve been taught), the request for these assets is only made when your ', 920757154, '2019', '2019-10-25 00:12:52', '', 'tester'),
(628561676, 'In this article on developers.google.com I introduce these new APIs and show you how you can use them in your applications. I’ve also built a demo application that shows how you can actually deploy these features on the web today (via this origin trial) while still providing fallbacks so they work in all browsers.\n\n', 920757154, '2019', '2019-10-25 00:17:30', '', 'tester'),
(642656114, 'post body', 920757154, '2019', '2019-10-24 19:25:39', '', 'post topic'),
(679623921, 'Modals are built with HTML, CSS, and JavaScript. They’re positioned over everything else in the document and remove scroll from the <body> so that modal content scrolls instead.\nClicking on the modal “backdrop” will automatically close the modal.\nBootstrap only supports one modal window at a time. Nested modals aren’t supported as we believe them to be poor user experiences.\nModals use position: fixed, which can sometimes be a bit particular about its rendering. .', 920757154, '2019', '2019-10-25 00:16:54', '', 'tester'),
(690761765, 'The bad news for webpack users is that webpack’s internal mapping is non-standard, so it can’t integrate with any other tools, and you also can’t customize how the mapping is made. For example, you can’t hash webpack’s output files yourself (as described in technique #1 above) and put your own hashes in the mapping. And this is unfortunate because the content hashes webpack uses are not actually based on the contents of the output files, they’re based on the contents of the source files and build configurations, which can lead to subtle and hard to catch bugs (#1315, #1479, #7787).', 920757154, '2019', '2019-10-25 00:15:57', '', 'tester'),
(723372216, 'Tester', 112709227, '2019', '2019-10-25 02:56:35', '', 'tester'),
(731991353, 'The problem with this, of course, is all these tabs consume system resources (memory, battery, and CPU), and if you never end up going back to them again (which, let’s be honest, happens more often than not) those resources were consumed for nothing.', 920757154, '2019', '2019-10-25 00:17:58', '', 'tester'),
(756048911, 'This means the source code of your modules can safely reference the un-revisioned module names and the browser will always load the revisioned files. And since the revision hashes don’t appear in the module’s source code (they only appear in the import map) changes to those hashes won’t ever invalidate any modules other than the one that changed.', 920757154, '2019', '2019-10-25 00:12:12', '', 'tester');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(8) NOT NULL,
  `name` varchar(40) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` int(8) NOT NULL,
  `super_admin` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `admin`, `super_admin`) VALUES
(112709227, 'Johnson', 'jaycodist@gmail.com', 'c203adb47bff611ab271a9bc342ec55b', 0, 0),
(119991569, 'hackLaplace', 'abdullahakinwumi@gmail.com', 'fd58662fc958e2b8368fd2d6387e1572', 0, 0),
(156720375, 'usdufhsh', 'jkjsdjs@kjdsahf.com', '5f454547868caa7ed877cdb0134d86c6', 0, 0),
(268194566, 'hack', 'abdullah@gmail.com', 'fd58662fc958e2b8368fd2d6387e1572', 0, 0),
(270494590, '2345', '452662@526672.com', 'cbd4a7178621579b432eb2a66d7532c3', 0, 0),
(275969179, '[object HTMLInputElement]', '[object HTMLInputElement]', 'e0b73a1699aeee785d156388f584cf74', 0, 0),
(276162690, 'Admin Admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 1, 0),
(376534387, 'hackLaplaceee', 'abdullahakinwumiiii@gmail.com', '925cc8d2953eba624b2bfedf91a91613', 0, 0),
(410061142, 'Bringforthjoy', 'adelugba.emma@gmail.com', '670b14728ad9902aecba32e22fa4f6bd', 0, 0),
(467215117, 'Sam Smith', 'samsmith@gmail.com', 'eadd934e2cc978fc622fc1324878d8af', 0, 0),
(471578929, 'Josef Mark', 'jaetechit@gmail.com', 'e226b62e010f81dead1e6bfa3887d9c6', 0, 0),
(546790595, 'lancer lancer', 'lancer@gmail.com', 'b81a9dfa2a3ea350de88cac98594e40d', 0, 0),
(571558861, 'Oladipo Umar', 'oladipoumar1@gmail.com', '66695bc78d8e49a1a16688391bc4c6ab', 0, 0),
(576104914, 'Oladipo Umar', 'oladipoumar@gmail.com', '66695bc78d8e49a1a16688391bc4c6ab', 0, 0),
(611832525, 'Mary Jane', 'mary@jane.com', '7b81a7a76693d0321b9498e12e4f4759', 0, 0),
(628899341, 'ce', 'example@email.com', '25f9e794323b453885f5181f1b624d0b', 0, 0),
(655390511, 'Super Admin', 'super@gmail.com', '1b3231655cebb7a1f783eddf27d254ca', 1, 1),
(762261705, 'Gradia', 'gradia@gmail.com', 'ceceb1e4804f87e11343fa08e295ccc5', 0, 0),
(815137558, 'ehis', 'ehis@gmail.com', '4ffbc6845635ff8e867fd61759e3284e', 0, 0),
(833290853, 'Chiagoziem Anyanwu', 'gozzypat@gmail.com', '813f0e8b43a84aaeade2c8a60477a941', 0, 0),
(920125799, 'sholzy', 'sholzt@gmail.com', 'c31f0edd2f399a887b436dd45247ac22', 0, 0),
(920757154, 'erons', 'eronmmer@gmail.com', '312ab168561f98c39ea434d41cc4d5cb', 0, 0),
(953551671, 'hackLaplacee', 'abdullahakinwumii@gmail.com', 'fd58662fc958e2b8368fd2d6387e1572', 0, 0),
(995917966, 'hack', 'laplace@ggg.bom', '9aa51b39287467d5dfb17077dfed945e', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `editions`
--
ALTER TABLE `editions`
  ADD PRIMARY KEY (`edition_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`likes_id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `editions`
--
ALTER TABLE `editions`
  MODIFY `edition_id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `likes_id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=756048912;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=995917967;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
