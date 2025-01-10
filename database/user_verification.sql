-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2025 at 04:42 AM
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
-- Indexes for table `user_verification`
--
ALTER TABLE `user_verification`
  ADD PRIMARY KEY (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
