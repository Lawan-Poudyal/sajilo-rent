-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 06, 2025 at 03:18 PM
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
-- Database: `latlng`
--

-- --------------------------------------------------------

--
-- Table structure for table `LatLng`
--

CREATE TABLE `LatLng` (
  `LAT` decimal(10,8) NOT NULL,
  `LNG` decimal(11,8) NOT NULL,
  `PRICE` int(11) NOT NULL,
  `CONTACT` varchar(255) NOT NULL,
  `ROOMSAVAILABLE` int(11) NOT NULL,
  `BOOKED` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `LatLng`
--

INSERT INTO `LatLng` (`LAT`, `LNG`, `PRICE`, `CONTACT`, `ROOMSAVAILABLE`, `BOOKED`) VALUES
(27.61549310, 85.53810207, 3900, 'contact9@example.com', 2, 1),
(27.61604536, 85.53902724, 3950, 'contact10@example.com', 3, 0),
(27.62073785, 85.53761673, 3550, 'contact2@example.com', 3, 0),
(27.62091434, 85.54116091, 3800, 'contact7@example.com', 2, 0),
(27.62122757, 85.53922422, 3600, 'contact3@example.com', 1, 1),
(27.62184812, 85.53750703, 3500, 'contact1@example.com', 2, 0),
(27.62203878, 85.53905967, 3650, 'contact4@example.com', 2, 0),
(27.62262568, 85.53814412, 3700, 'contact5@example.com', 4, 1),
(27.62317712, 85.53982978, 3750, 'contact6@example.com', 3, 0),
(27.62388027, 85.54122813, 3850, 'contact8@example.com', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `LatLng`
--
ALTER TABLE `LatLng`
  ADD PRIMARY KEY (`LAT`,`LNG`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
