-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2025 at 04:33 PM
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
('abhiaynregmi12@gmail.com', 23456, 'owner'),
('abhiyandondai@gmail.com', 123456788, 'student'),
('abhiyanregmi12@gmail.com', 2147483647, 'student'),
('abhiyanregmi@gmail.com', 23456, 'student'),
('ashok@gmail.com', 33436, '0'),
('dhaba@gmail.com', 52352, '0'),
('happu@gmail.com', 252353, '0'),
('jina@gmail.com', 46346, '0'),
('jiwan@gmail.com', 346346, '0'),
('jiwana@gmail.com', 235235, 'owner'),
('julia@gmail.com', 522334, 'student'),
('maaaya@gmail.com', 5433634, '0'),
('maha@gmail.com', 364624, 'student'),
('maman@gmail.com', 3466346, '0'),
('mamta@gmail.com', 465653, 'student'),
('pankaj@gmail.com', 363446, 'owner'),
('papadon@gmail.com', 0, 'student'),
('puja@gmail.com', 25235, 'student'),
('puskar@gmail.com', 634646, 'student'),
('ramlal@gmail.com', 36346, 'student'),
('seasonparirar@gmail.com', 536446, 'owner'),
('simran@gmail.com', 25325, '0'),
('swastikbhandari2006@gmail.com', 2006, 'student'),
('vhawana@gmail.com', 5225278, 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `verified_users`
--
ALTER TABLE `verified_users`
  ADD PRIMARY KEY (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
