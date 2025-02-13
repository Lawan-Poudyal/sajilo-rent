-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2025 at 01:30 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `sender` varchar(255) DEFAULT NULL,
  `reciever` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `seenornot` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`sender`, `reciever`, `message`, `seenornot`) VALUES
('example2@gmail.com', 'loopfelloff@gmail.com', 'room is very untidy right now please clean it', 'seen'),
('loopfelloff@gmail.com', 'example2@gmail.com', 'yeah i know clean it yourselves', 'seen'),
('loopfelloff@gmail.com', 'example2@gmail.com', 'room is very untidy right now please clean it', 'seen'),
('loopfelloff@gmail.com', 'example2@gmail.com', 'yeah i know clean it yourselves', 'seen'),
('loopfelloff@gmail.com', 'example2@gmail.com', 'yeah i know clean it yourselves', 'seen'),
('loopfelloff@gmail.com', 'example2@gmail.com', 'room is very untidy right now please clean it', 'seen'),
('loopfelloff@gmail.com', 'example2@gmail.com', 'room is very untidy right now please clean it', 'seen'),
('loopfelloff@gmail.com', 'example2@gmail.com', 'yeah i know clean it yourselves', 'seen'),
('loopfelloff@gmail.com', 'example2@gmail.com', 'i hate eating food btw', 'seen'),
('loopfelloff@gmail.com', 'example2@gmail.com', 'testing', 'seen'),
('loopfelloff@gmail.com', 'example2@gmail.com', '', 'seen'),
('loopfelloff@gmail.com', 'example2@gmail.com', 'fuck', 'seen'),
('loopfelloff@gmail.com', 'example2@gmail.com', 'fuck', 'seen'),
('loopfelloff@gmail.com', 'example2@gmail.com', 'fuck', 'seen'),
('loopfelloff@gmail.com', 'example2@gmail.com', 'hi', 'seen'),
('loopfelloff@gmail.com', 'example2@gmail.com', '', 'seen'),
('loopfelloff@gmail.com', 'example2@gmail.com', 'hi', 'seen'),
('loopfelloff@gmail.com', 'example2@gmail.com', 'monkeytyping', 'seen'),
('example2@gmail.com', 'loopfelloff@gmail.com', 'yes heck you', 'seen'),
('loopfelloff@gmail.com', 'example2@gmail.com', 'why not brother', 'seen'),
('example2@gmail.com', 'loopfelloff@gmail.com', 'fuck you ass hole', 'seen'),
('loopfelloff@gmail.com', 'example2@gmail.com', 'yeah right as if you can', 'seen'),
('loopfelloff@gmail.com', 'example2@gmail.com', '', 'seen'),
('loopfelloff@gmail.com', 'example2@gmail.com', 'fgsdfgsd', 'seen'),
('loopfelloff@gmail.com', 'example2@gmail.com', '', 'seen'),
('loopfelloff@gmail.com', 'example2@gmail.com', '', 'seen'),
('loopfelloff@gmail.com', 'example2@gmail.com', 'hi wassup', 'seen'),
('loopfelloff@gmail.com', 'example2@gmail.com', 'hi how are you i hope you are doing good', 'seen'),
('example2@gmail.com', 'loopfelloff@gmail.com', 'yeah sure i am doing good', 'seen'),
('loopfelloff@gmail.com', 'example2@gmail.com', 'hey buddy i am sure you are doing good', 'seen'),
('example2@gmail.com', 'loopfelloff@gmail.com', 'yeah why  i am awesome', 'seen'),
('example2@gmail.com', 'loopfelloff@gmail.com', 'hi handsome', 'seen'),
('example2@gmail.com', 'loopfelloff@gmail.com', 'yeah right mate isn\'t it', 'seen'),
('loopfelloff@gmail.com', 'example2@gmail.com', 'true that', 'seen'),
('example2@gmail.com', 'loopfelloff@gmail.com', 'hey how are you', 'seen'),
('loopfelloff@gmail.com', 'example2@gmail.com', 'hey good to mmet you brother', 'seen'),
('example2@gmail.com', 'loopfelloff@gmail.com', 'nice it\'s so awesome to mmett you too', 'seen'),
('example2@gmail.com', 'loopfelloff@gmail.com', 'why you are soo cool', 'seen'),
('example2@gmail.com', 'loopfelloff@gmail.com', 'you aregood as hell', 'seen'),
('example2@gmail.com', 'loopfelloff@gmail.com', '', 'seen'),
('loopfelloff@gmail.com', 'example2@gmail.com', 'so any plans today', 'seen'),
('example2@gmail.com', 'loopfelloff@gmail.com', 'not muc wby', 'seen'),
('loopfelloff@gmail.com', 'example2@gmail.com', 'yeah sure why', 'seen'),
('example2@gmail.com', 'loopfelloff@gmail.com', 'yeah ti\'s awesome', 'seen'),
('example2@gmail.com', 'loopfelloff@gmail.com', 'yo how are you', 'seen'),
('loopfelloff@gmail.com', 'testboy@gmail.com', 'fg', 'ownerseen'),
('example2@gmail.com', 'loopfelloff@gmail.com', 'yooo', 'seen'),
('loopfelloff@gmail.com', 'example2@gmail.com', 'good i am fine', 'seen'),
('example2@gmail.com', 'loopfelloff@gmail.com', 'chutiya', 'seen'),
('example2@gmail.com', 'loopfelloff@gmail.com', 'how are you how do you do', 'seen'),
('example2@gmail.com', 'loopfelloff@gmail.com', 'new messsgae', 'seen'),
('example2@gmail.com', 'loopfelloff@gmail.com', '', 'seen'),
('loopfelloff@gmail.com', 'testboy@gmail.com', 'fasdfadf', 'ownerseen'),
('loopfelloff@gmail.com', 'testboy@gmail.com', 'asdfasdf', 'ownerseen'),
('loopfelloff@gmail.com', 'testboy@gmail.com', 'asdfasdf', 'ownerseen'),
('example2@gmail.com', 'loopfelloff@gmail.com', 'd', 'seen'),
('loopfelloff@gmail.com', 'example2@gmail.com', 'k cha vai', 'seen'),
('example2@gmail.com', 'loopfelloff@gmail.com', 'theek xa yr', 'seen'),
('loopfelloff@gmail.com', 'example2@gmail.com', 'hey how do you do buddy', 'seen'),
('example2@gmail.com', 'loopfelloff@gmail.com', 'i am good how are you mate', 'seen');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
