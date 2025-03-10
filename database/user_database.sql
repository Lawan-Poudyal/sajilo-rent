-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 10, 2025 at 07:23 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
-- Table structure for table `booked`
--

CREATE TABLE `booked` (
  `email` varchar(255) NOT NULL,
  `owner` varchar(255) DEFAULT NULL,
  `lat` decimal(20,17) DEFAULT NULL,
  `lng` decimal(20,17) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booked`
--

INSERT INTO `booked` (`email`, `owner`, `lat`, `lng`) VALUES
('uhisijan@gmail.com', 'sachin@gmail.com', 27.62394735684500000, 85.53853690624200000);

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

-- --------------------------------------------------------

--
-- Table structure for table `housedetails`
--

CREATE TABLE `housedetails` (
  `username` varchar(255) NOT NULL,
  `no_of_rooms` int(11) NOT NULL,
  `no_of_roommates` int(11) NOT NULL,
  `gates_open` time NOT NULL,
  `gates_close` time NOT NULL,
  `wifi_price` int(11) NOT NULL,
  `image1` varchar(255) DEFAULT NULL,
  `image2` varchar(255) DEFAULT NULL,
  `image3` varchar(255) DEFAULT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `price` int(11) DEFAULT NULL,
  `parking` varchar(255) DEFAULT NULL,
  `electricity` varchar(255) DEFAULT NULL,
  `floor_level` varchar(255) DEFAULT NULL,
  `house_facing_direction` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `housedetails`
--

INSERT INTO `housedetails` (`username`, `no_of_rooms`, `no_of_roommates`, `gates_open`, `gates_close`, `wifi_price`, `image1`, `image2`, `image3`, `latitude`, `longitude`, `price`, `parking`, `electricity`, `floor_level`, `house_facing_direction`) VALUES
('anish@gmail.com', 2, 2, '06:00:00', '22:00:00', 500, 'images/room1.jpg', 'images/room1.jpg', 'images/room3.jpg', 27.624012356845405, 85.53862690624237, 3800, 'available', 'included', '2', 'south'),
('bibek123@yahoo.com', 3, 1, '06:00:00', '22:30:00', 0, 'images/room3.jpg', 'images/room3.jpg', 'images/room1.jpg', 27.624147356845405, 85.53843690624237, 5500, 'available', 'required', '1', 'north'),
('kamal@outlook.com', 3, 2, '05:30:00', '23:00:00', 350, 'images/room1.jpg', 'images/room1.jpg', 'images/room1.jpg', 27.623897356845404, 85.53883690624237, 5900, 'available', 'required', '3', 'west'),
('nabin@gmail.com', 1, 0, '05:45:00', '23:15:00', 0, 'images/room1.jpg', 'images/room3.jpg', 'images/room1.jpg', 27.623697356845405, 85.53903690624237, 3950, 'available', 'required', '2', 'north-west'),
('priya@outlook.com', 1, 2, '05:30:00', '23:00:00', 300, 'images/room3.jpg', 'images/room1.jpg', 'images/room3.jpg', 27.623847356845406, 85.53873690624236, 4200, 'not available', 'included', '3', 'west'),
('ramesh@hotmail.com', 2, 0, '05:00:00', '23:30:00', 250, 'images/room1.jpg', 'images/room3.jpg', 'images/room1.jpg', 27.623747356845406, 85.53893690624237, 3500, 'available', 'included', '4', 'south-east'),
('rita@yahoo.com', 2, 3, '06:00:00', '22:30:00', 200, 'images/room3.jpg', 'images/room3.jpg', 'images/room3.jpg', 27.624147356845405, 85.53813690624237, 4500, 'not available', 'included', '1', 'south-west'),
('sachin@gmail.com', 1, 1, '22:36:00', '22:36:00', 0, 'images/room1.jpg', 'images/room3.jpg', 'images/room3.jpg', 27.623947356845406, 85.53853690624237, 500, 'available', 'required', '1', 'east'),
('sunita@gmail.com', 1, 3, '06:30:00', '22:00:00', 400, 'images/room3.jpg', 'images/room1.jpg', 'images/room1.jpg', 27.624047356845406, 85.53833690624236, 4800, 'not available', 'included', '2', 'north-east');

-- --------------------------------------------------------

--
-- Table structure for table `profilepicture`
--

CREATE TABLE `profilepicture` (
  `email` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profilepicture`
--

INSERT INTO `profilepicture` (`email`, `image`) VALUES
('abhim@123', 'images/room1.jpg'),
('example2@gmail.com', 'images/WIN_20250115_16_45_05_Pro.jpg'),
('p@gmail.com', 'images/Screenshot 2024-01-10 174546.png'),
('sachin@gmail.com', 'images/room2.jpg'),
('test@gmail.com', 'images/room3.jpg'),
('uhisijan@gmail.com', 'images/randphoto.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `rentrequest`
--

CREATE TABLE `rentrequest` (
  `sender` varchar(255) NOT NULL,
  `receiver` varchar(255) NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `seen` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rentrequest`
--

INSERT INTO `rentrequest` (`sender`, `receiver`, `lat`, `lng`, `seen`) VALUES
('uhisijan@gmail.com', 'SijanBhandari17', 27.62188935678423, 85.53754452104563, 'no'),
('uhisijan@gmail.com', 'SijanBhandari17', 27.62394739871245, 85.5385369421569, 'no');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `reviewer` varchar(255) NOT NULL,
  `receiver` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`reviewer`, `receiver`, `rating`, `comment`, `date`) VALUES
('abhim@123', 'test@gmail.com', 3, 'gay', '2025-02-06'),
('abhim@123', 'uhisijan@gmail.com', 3, 'safsaf', '2025-02-13'),
('adsf', 'test@gmail.com', 3, 'fa]', '2025-02-06'),
('alice.jones@example.com', 'abhim@123', 3, 'Decent place, but had some issues with parking.', '2025-03-02'),
('daf', 'test@gmail.com', 1, 'fa]', '2025-02-06'),
('hello', 'test@gmail.com', 3, 'fa]', '2025-02-06'),
('jane.smith@example.com', 'abhim@123', 4, 'Very nice house, but the wifi could be better.', '2025-03-02'),
('john.doe@example.com', 'abhim@123', 5, 'Excellent place, highly recommended!', '2025-03-02'),
('john.doe@example.com', 'uhisijan@gmail.com', 5, 'Great experience! Highly recommended.', '2025-02-13'),
('sdaf', 'test@gmail.com', 4, 'fa]', '2025-02-06'),
('sdasdff', 'test@gmail.com', 5, 'fa]', '2025-02-06'),
('sdf', 'test@gmail.com', 2, 'fa]', '2025-02-06'),
('uhisijan@gmail.com', 'abhim@123', 3, 'saf', '2025-03-06');

-- --------------------------------------------------------

--
-- Table structure for table `review_house`
--

CREATE TABLE `review_house` (
  `reviewer` varchar(255) NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` varchar(256) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review_house`
--

INSERT INTO `review_house` (`reviewer`, `lat`, `lng`, `rating`, `comment`, `date`) VALUES
('uhisijan@gmail.com', 27.6240091448826, 85.53816676139833, 1, 'asf', '2025-03-06');

-- --------------------------------------------------------

--
-- Table structure for table `signin`
--

CREATE TABLE `signin` (
  `email` varchar(50) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signin`
--

INSERT INTO `signin` (`email`, `firstName`, `lastName`, `number`, `password`) VALUES
('abhim@123', 'abhim', 'bhusal', '0', '$2y$10$hoQ.1bjIMh6EpvsvBPgiiOBeNJc5RVZB88PQRSXQg1KpJvAxEUpLO'),
('sachin@gmail.com', 'Sachin', 'name', '0', '$2y$10$rowJ8imB.okiwy0aSIqaXebNgpSVl.IqFEf9EyItU4m72cqOGKic2'),
('shishir@gmail.com', 'Sijan', 'hfasufhf', '9765415893', '$2y$10$9Wxwk5d1L.JuY7hpgfwpaeYMTaPGp60DaT2gk3pVYvvvTjkn7/ZlG'),
('SijanBhandari17', 'kane', 'Williamson', '0', '841bf1f4d35fd3dcd6132d0ebcc6639e1743ab7e866d1d420775229f5ba18431'),
('test@gmail.com', 'test', 'se', '0', '$2y$10$IOfUCY4ry0YBxrsFZTxXuepTsbScIBX/hqBuanQGC1dwqQ7INtWPm'),
('uhisijan@gmail.com', 'Sijan', 'Bhandari', '0', '$2y$10$uCZ60kitAAyCXER8XptWReUlWAMTPmhqS9yOvr/FUCBdZJygQF2lO');

-- --------------------------------------------------------

--
-- Table structure for table `user_verification`
--

CREATE TABLE `user_verification` (
  `email` varchar(255) NOT NULL,
  `verification_number` int(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_verification`
--

INSERT INTO `user_verification` (`email`, `verification_number`, `status`) VALUES
('abhim@123', 12, 'owner'),
('sachin@gmail.com', 1234, 'owner'),
('shishir@gmail.com', 123, 'student'),
('test@gmail.com', 1, 'student');

-- --------------------------------------------------------

--
-- Table structure for table `verified_users`
--

CREATE TABLE `verified_users` (
  `email` varchar(50) NOT NULL,
  `verification_number` int(20) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `verified_users`
--

INSERT INTO `verified_users` (`email`, `verification_number`, `status`) VALUES
('abhim@123', 12, 'owner'),
('sachin@gmail.com', 1234, 'owner'),
('shishir@gmail.com', 123, 'student'),
('test@gmail.com', 1, 'student'),
('uhisijan@gmail.com', 1, 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booked`
--
ALTER TABLE `booked`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `housedetails`
--
ALTER TABLE `housedetails`
  ADD PRIMARY KEY (`username`,`latitude`,`longitude`),
  ADD UNIQUE KEY `username` (`username`,`latitude`,`longitude`);

--
-- Indexes for table `profilepicture`
--
ALTER TABLE `profilepicture`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `rentrequest`
--
ALTER TABLE `rentrequest`
  ADD PRIMARY KEY (`sender`,`receiver`,`lat`,`lng`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`reviewer`,`receiver`);

--
-- Indexes for table `review_house`
--
ALTER TABLE `review_house`
  ADD PRIMARY KEY (`lat`,`lng`,`reviewer`);

--
-- Indexes for table `signin`
--
ALTER TABLE `signin`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `user_verification`
--
ALTER TABLE `user_verification`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `verified_users`
--
ALTER TABLE `verified_users`
  ADD PRIMARY KEY (`email`);

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
