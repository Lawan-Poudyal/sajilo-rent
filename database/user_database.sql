-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2024 at 01:27 AM
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
-- Table structure for table `rent_house_location`
--

CREATE TABLE `rent_house_location` (
  `email` varchar(250) NOT NULL,
  `lat1` float NOT NULL,
  `lng1` float NOT NULL,
  `lat2` float NOT NULL,
  `lng2` float NOT NULL,
  `lat3` float NOT NULL,
  `lng3` float NOT NULL,
  `lat4` float NOT NULL,
  `lng4` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rent_house_location`
--

INSERT INTO `rent_house_location` (`email`, `lat1`, `lng1`, `lat2`, `lng2`, `lat3`, `lng3`, `lat4`, `lng4`) VALUES
('example2@gmail.com', 27.619, 85.5383, 27.6198, 85.5383, 27.6202, 85.5391, 27.6199, 85.5395);

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
('abhiyanregmi12@gmail.com', 'Abhiyandon', 'Regmi', '$2y$10$rv3iKh13ZDabghMrEHLxh.Vn7km/Q4wCL4fR2D0L6VwCCswcmoQSu'),
('abhiyanthapa@gmail.com', 'abhiyan ', 'thapa', '$2y$10$L9WjpF6ildsVby2IKfEkMu1e7dAka3bXXDawsiyq2NfqmedKm/gTu'),
('example2@gmail.com', 'minecrafter', 'boy', '$2y$10$Uznr0inq1y9gsq4iggWnlOAtD8HYamzuxaWHAZFdECeYA6HzDId9G'),
('exampleemail@gmail.com', 'Abhiyan12', 'Regmi', '$2y$10$sr0ksBE3DkJFHQq7Z1geROrhwZwGAIlgcGPWZuJ99Uh7GKIf94o2W'),
('ku@gmail.com', 'helloworld', 'minecraft', '$2y$10$s9b8Hj8AJMb1kDBoVifiQ.LugJjlbSkVbKYm2OO1D8cSjTqrS8UYS'),
('qwertyuiop@gmail.com', 'yesboi', 'hello', '$2y$10$3T1jU4zmWzlmWvGifqFWiONJyxA/GmgHhN47hoq7v2Ei473U.JA0.'),
('swastikbhandari2006@gmail.com', 'swastik ', 'bhandari', '$2y$10$zEUbk9kpMcUPswB4PUkLeuwdnnMreLam8Yo.TRp5Rf4D9U/Ky1POu'),
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
('abhiaynregmi12@gmail.com', 23456, 'owner'),
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
-- Indexes for table `rent_house_location`
--
ALTER TABLE `rent_house_location`
  ADD PRIMARY KEY (`email`);

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
