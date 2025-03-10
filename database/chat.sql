-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2025 at 09:29 AM
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
  `seenornot` varchar(50) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`sender`, `reciever`, `message`, `seenornot`, `id`) VALUES
('loopfelloff@gmail.com', 'sarthakregmi@gmail.com', 'what\'s up dumbo sarthak', 'unseen', 1),
('loopfelloff@gmail.com', 'example2@gmail.com', 'asdfasdfa', 'ownerseen', 9),
('loopfelloff@gmail.com', 'undefined', 'fasdfasdf', 'ownerseen', 11),
('loopfelloff@gmail.com', 'undefined', 'ddddd', 'ownerseen', 12),
('loopfelloff@gmail.com', 'sarthakregmi@gmail.com', 'fasdfasdfasdf', 'unseen', 16),
('loopfelloff@gmail.com', 'example2@gmail.com', 'hey how are you long time no see!', 'ownerseen', 17),
('example2@gmail.com', 'loopfelloff@gmail.com', 'I am good wby?', 'ownerseen', 18),
('loopfelloff@gmail.com', 'example2@gmail.com', 'hello how are yoiu', 'ownerseen', 19),
('example2@gmail.com', 'loopfelloff@gmail.com', 'hello how are you friend', 'ownerseen', 20),
('loopfelloff@gmail.com', 'example2@gmail.com', 'i am fine thank you sir', 'ownerseen', 21),
('loopfelloff@gmail.com', 'example2@gmail.com', 'hello how are you', 'ownerseen', 22),
('loopfelloff@gmail.com', 'example2@gmail.com', 'fajksldfjalsdjflajdlfajsdflkadjfasldf', 'ownerseen', 24);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
