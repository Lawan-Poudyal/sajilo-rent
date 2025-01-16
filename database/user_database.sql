-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2025 at 11:34 AM
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
('Abhiyan MulaSag', 1, 1, '20:42:00', '20:43:00', 1500, 'images/aesthetic-room-ideas-5195645-hero-7d51313f2c8f4ed6b338513ae284b113.jpg', 'images/beautiful-living-room-ideas.jpg', 'images/aesthetic-room-ideas-5195645-hero-7d51313f2c8f4ed6b338513ae284b113.jpg', 27.61970291051658, 85.53646624088287, 500, 'unavailable', 'notrequired', '2', 'west'),
('minecrafter boy', 1, 1, '22:33:00', '22:32:00', 500, 'images/beautiful-living-room-ideas.jpg', 'images/aesthetic-room-ideas-5195645-hero-7d51313f2c8f4ed6b338513ae284b113.jpg', 'images/bedroom-decor-ideas.jpg', 27.620539454949803, 85.53878903388977, 500, 'unavailable', 'required', '2', 'east'),
('minecrafter boy', 1, 1, '12:59:00', '13:59:00', 500, 'images/cheap-room-decor-ideas.jpg', 'images/beautiful-living-room-ideas.jpg', 'images/bedroom-decor-ideas.jpg', 27.620648775625185, 85.53756058216095, 500, 'unavailable', 'required', '2', 'west');

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
('example2@gmail.com', 'images/WIN_20250115_16_45_05_Pro.jpg');

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

-- --------------------------------------------------------

--
-- Table structure for table `signin`
--

CREATE TABLE `signin` (
  `email` varchar(50) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signin`
--

INSERT INTO `signin` (`email`, `firstName`, `lastName`, `password`) VALUES
('a@gmail.com', 'Abhiyan', 'MulaSag', '$2y$10$RLNdxV9.X4GG98KZe9y9S.GCno7ABIoWI4YEA69G/EPE2vqaHbK1G'),
('abhiyandondai@gmail.com', 'Abhiyan ', 'Dondai', '$2y$10$.afvIVtfrWndIOIgO5wVke4fFIWmQ2j40BaKzFmuhe4m56uIt8pXu'),
('abhiyanregmi12@gmail.com', 'Abhiyandon', 'Regmi', '$2y$10$rv3iKh13ZDabghMrEHLxh.Vn7km/Q4wCL4fR2D0L6VwCCswcmoQSu'),
('abhiyanthapa@gmail.com', 'abhiyan ', 'thapa', '$2y$10$L9WjpF6ildsVby2IKfEkMu1e7dAka3bXXDawsiyq2NfqmedKm/gTu'),
('computerengineering@gmail.com', 'Abhiyan123', 'Regmi', '$2y$10$Thua0c7hLkD88glGjzvqLugXszEAX.XLwRruUN20AjX6f2uJ/J89K'),
('example2@gmail.com', 'minecrafter', 'boy', '$2y$10$Uznr0inq1y9gsq4iggWnlOAtD8HYamzuxaWHAZFdECeYA6HzDId9G'),
('exampleemail@gmail.com', 'Abhiyan12', 'Regmi', '$2y$10$sr0ksBE3DkJFHQq7Z1geROrhwZwGAIlgcGPWZuJ99Uh7GKIf94o2W'),
('ku@gmail.com', 'helloworld', 'minecraft', '$2y$10$s9b8Hj8AJMb1kDBoVifiQ.LugJjlbSkVbKYm2OO1D8cSjTqrS8UYS'),
('qwertyuiop@gmail.com', 'yesboi', 'hello', '$2y$10$3T1jU4zmWzlmWvGifqFWiONJyxA/GmgHhN47hoq7v2Ei473U.JA0.'),
('swastikbhandari2006@gmail.com', 'swastik ', 'bhandari', '$2y$10$zEUbk9kpMcUPswB4PUkLeuwdnnMreLam8Yo.TRp5Rf4D9U/Ky1POu'),
('test@gmail.com', 'sijan', 'bhan', '$2y$10$4CVu7s7P8vG5e2FbaqCgBuF0Nn09kCRbzqFsVvg8RDtKfpJakuBJu'),
('testuser@gmail.com', 'Test', 'User', '$2y$10$Lnblp5Sl6pfc8CimhJp4zeXOSe9iz7JMZjEVqRcGpqn.zoAlb1qmq'),
('university@gmail.com', 'yeah boi', 'regmi', '$2y$10$aU7OpjrQ4cWRJaX1WFle0eSSw1SWq3bj0eqA1TPDmNNSNz67sH5ZG');

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
('234567@gmail.com', 3456, 'student'),
('3456765432ertytrew@gmail.com', 6543, 'owner'),
('a@gmail.com', 12345, 'student'),
('abhiaynregmi12@gmail.com', 23456, 'owner'),
('abhiyandondai@gmail.com', 123456788, 'student'),
('abhiyanregmi12@gmail.com', 2147483647, 'student'),
('abhiyanregmi@gmail.com', 23456, 'student'),
('abhiyanthapa@gmail.com', 2345678, 'student'),
('example2@gmail.com', 12, 'student'),
('exampleemail@gmail.com', 123456, 'student'),
('fjfsdfalsdjfals@gmail.com', 2147483647, 'student'),
('ku@gmail.com', 2147483647, 'student'),
('swastikbhandari2006@gmail.com', 2006, 'student'),
('university@gmail.com', 123456, 'student');

--
-- Indexes for dumped tables
--

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
  ADD PRIMARY KEY (`sender`,`receiver`);

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
