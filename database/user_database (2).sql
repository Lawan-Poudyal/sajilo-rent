-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
<<<<<<< HEAD:database/user_database (2).sql
-- Generation Time: Jan 10, 2025 at 01:16 PM
=======
-- Generation Time: Dec 20, 2024 at 02:24 PM
>>>>>>> 78620a49f9f4b7be1dfc5e751a0aa3c14545eb74:database/user_database.sql
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
<<<<<<< HEAD:database/user_database (2).sql
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
('minecrafter boy', 1, 1, '12:59:00', '13:59:00', 500, 'images/cheap-room-decor-ideas.jpg', 'images/beautiful-living-room-ideas.jpg', 'images/bedroom-decor-ideas.jpg', 27.620648775625185, 85.53756058216095, 500, 'unavailable', 'required', '2', 'west');

-- --------------------------------------------------------

--
=======
>>>>>>> 78620a49f9f4b7be1dfc5e751a0aa3c14545eb74:database/user_database.sql
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
<<<<<<< HEAD:database/user_database (2).sql
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
=======
('', '', '', '$2y$10$Xs3b7md4/iPPX2LR1XL73eXp4E4tqsU2afz6EkJZhspbNfPZPseIO'),
('abhiyanthapa@gmail.com', 'abhiyan ', 'thapa', '$2y$10$L9WjpF6ildsVby2IKfEkMu1e7dAka3bXXDawsiyq2NfqmedKm/gTu'),
('lawan@gmail.com', 'lawan', 'paudel', '$2y$10$X6Jlc8B4r85a/Cx1ZgAZi.s.BSGEqiMxP7HkaWe1Tj3rKkU/IcqdC'),
('seasonrana@gmail.com', 'season', 'rana', '$2y$10$j8Js2SsFOzxfCK.3XqOyk.9tyb9f7efjsoyID6Bhxren.LgTrFJg.'),
('swastikbhandari2006@gmail.com', 'swastik ', 'bhandari', '$2y$10$zEUbk9kpMcUPswB4PUkLeuwdnnMreLam8Yo.TRp5Rf4D9U/Ky1POu');
>>>>>>> 78620a49f9f4b7be1dfc5e751a0aa3c14545eb74:database/user_database.sql

--
-- Indexes for dumped tables
--

--
<<<<<<< HEAD:database/user_database (2).sql
-- Indexes for table `housedetails`
--
ALTER TABLE `housedetails`
  ADD PRIMARY KEY (`username`,`latitude`,`longitude`),
  ADD UNIQUE KEY `username` (`username`,`latitude`,`longitude`);

--
=======
>>>>>>> 78620a49f9f4b7be1dfc5e751a0aa3c14545eb74:database/user_database.sql
-- Indexes for table `signin`
--
ALTER TABLE `signin`
  ADD PRIMARY KEY (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
