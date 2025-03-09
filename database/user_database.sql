-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 09, 2025 at 08:05 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!40101 SET NAMES utf8mb4 */
;
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
  `lat` decimal(20, 17) DEFAULT NULL,
  `lng` decimal(20, 17) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
-- --------------------------------------------------------
--
-- Table structure for table `chat`
--
CREATE TABLE `chat` (
  `sender` varchar(255) DEFAULT NULL,
  `reciever` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `seenornot` varchar(50) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
--
-- Dumping data for table `chat`
--
INSERT INTO `chat` (`sender`, `reciever`, `message`, `seenornot`)
VALUES (
    'example2@gmail.com',
    'loopfelloff@gmail.com',
    'room is very untidy right now please clean it',
    'seen'
  ),
  (
    'loopfelloff@gmail.com',
    'example2@gmail.com',
    'yeah i know clean it yourselves',
    'seen'
  ),
  (
    'loopfelloff@gmail.com',
    'example2@gmail.com',
    'room is very untidy right now please clean it',
    'seen'
  ),
  (
    'loopfelloff@gmail.com',
    'example2@gmail.com',
    'yeah i know clean it yourselves',
    'seen'
  ),
  (
    'loopfelloff@gmail.com',
    'example2@gmail.com',
    'yeah i know clean it yourselves',
    'seen'
  ),
  (
    'loopfelloff@gmail.com',
    'example2@gmail.com',
    'room is very untidy right now please clean it',
    'seen'
  ),
  (
    'loopfelloff@gmail.com',
    'example2@gmail.com',
    'room is very untidy right now please clean it',
    'seen'
  ),
  (
    'loopfelloff@gmail.com',
    'example2@gmail.com',
    'yeah i know clean it yourselves',
    'seen'
  ),
  (
    'loopfelloff@gmail.com',
    'example2@gmail.com',
    'i hate eating food btw',
    'seen'
  ),
  (
    'loopfelloff@gmail.com',
    'example2@gmail.com',
    'testing',
    'seen'
  ),
  (
    'loopfelloff@gmail.com',
    'example2@gmail.com',
    '',
    'seen'
  ),
  (
    'loopfelloff@gmail.com',
    'example2@gmail.com',
    'fuck',
    'seen'
  ),
  (
    'loopfelloff@gmail.com',
    'example2@gmail.com',
    'fuck',
    'seen'
  ),
  (
    'loopfelloff@gmail.com',
    'example2@gmail.com',
    'fuck',
    'seen'
  ),
  (
    'loopfelloff@gmail.com',
    'example2@gmail.com',
    'hi',
    'seen'
  ),
  (
    'loopfelloff@gmail.com',
    'example2@gmail.com',
    '',
    'seen'
  ),
  (
    'loopfelloff@gmail.com',
    'example2@gmail.com',
    'hi',
    'seen'
  ),
  (
    'loopfelloff@gmail.com',
    'example2@gmail.com',
    'monkeytyping',
    'seen'
  ),
  (
    'example2@gmail.com',
    'loopfelloff@gmail.com',
    'yes heck you',
    'seen'
  ),
  (
    'loopfelloff@gmail.com',
    'example2@gmail.com',
    'why not brother',
    'seen'
  ),
  (
    'example2@gmail.com',
    'loopfelloff@gmail.com',
    'fuck you ass hole',
    'seen'
  ),
  (
    'loopfelloff@gmail.com',
    'example2@gmail.com',
    'yeah right as if you can',
    'seen'
  ),
  (
    'loopfelloff@gmail.com',
    'example2@gmail.com',
    '',
    'seen'
  ),
  (
    'loopfelloff@gmail.com',
    'example2@gmail.com',
    'fgsdfgsd',
    'seen'
  ),
  (
    'loopfelloff@gmail.com',
    'example2@gmail.com',
    '',
    'seen'
  ),
  (
    'loopfelloff@gmail.com',
    'example2@gmail.com',
    '',
    'seen'
  ),
  (
    'loopfelloff@gmail.com',
    'example2@gmail.com',
    'hi wassup',
    'seen'
  ),
  (
    'loopfelloff@gmail.com',
    'example2@gmail.com',
    'hi how are you i hope you are doing good',
    'seen'
  ),
  (
    'example2@gmail.com',
    'loopfelloff@gmail.com',
    'yeah sure i am doing good',
    'seen'
  ),
  (
    'loopfelloff@gmail.com',
    'example2@gmail.com',
    'hey buddy i am sure you are doing good',
    'seen'
  ),
  (
    'example2@gmail.com',
    'loopfelloff@gmail.com',
    'yeah why  i am awesome',
    'seen'
  ),
  (
    'example2@gmail.com',
    'loopfelloff@gmail.com',
    'hi handsome',
    'seen'
  ),
  (
    'example2@gmail.com',
    'loopfelloff@gmail.com',
    'yeah right mate isn\'t it',
    'seen'
  ),
  (
    'loopfelloff@gmail.com',
    'example2@gmail.com',
    'true that',
    'seen'
  ),
  (
    'example2@gmail.com',
    'loopfelloff@gmail.com',
    'hey how are you',
    'seen'
  ),
  (
    'loopfelloff@gmail.com',
    'example2@gmail.com',
    'hey good to mmet you brother',
    'seen'
  ),
  (
    'example2@gmail.com',
    'loopfelloff@gmail.com',
    'nice it\'s so awesome to mmett you too',
    'seen'
  ),
  (
    'example2@gmail.com',
    'loopfelloff@gmail.com',
    'why you are soo cool',
    'seen'
  ),
  (
    'example2@gmail.com',
    'loopfelloff@gmail.com',
    'you aregood as hell',
    'seen'
  ),
  (
    'example2@gmail.com',
    'loopfelloff@gmail.com',
    '',
    'seen'
  ),
  (
    'loopfelloff@gmail.com',
    'example2@gmail.com',
    'so any plans today',
    'seen'
  ),
  (
    'example2@gmail.com',
    'loopfelloff@gmail.com',
    'not muc wby',
    'seen'
  ),
  (
    'loopfelloff@gmail.com',
    'example2@gmail.com',
    'yeah sure why',
    'seen'
  ),
  (
    'example2@gmail.com',
    'loopfelloff@gmail.com',
    'yeah ti\'s awesome',
    'seen'
  ),
  (
    'example2@gmail.com',
    'loopfelloff@gmail.com',
    'yo how are you',
    'seen'
  ),
  (
    'loopfelloff@gmail.com',
    'testboy@gmail.com',
    'fg',
    'ownerseen'
  ),
  (
    'example2@gmail.com',
    'loopfelloff@gmail.com',
    'yooo',
    'seen'
  ),
  (
    'loopfelloff@gmail.com',
    'example2@gmail.com',
    'good i am fine',
    'seen'
  ),
  (
    'example2@gmail.com',
    'loopfelloff@gmail.com',
    'chutiya',
    'seen'
  ),
  (
    'example2@gmail.com',
    'loopfelloff@gmail.com',
    'how are you how do you do',
    'seen'
  ),
  (
    'example2@gmail.com',
    'loopfelloff@gmail.com',
    'new messsgae',
    'seen'
  ),
  (
    'example2@gmail.com',
    'loopfelloff@gmail.com',
    '',
    'seen'
  ),
  (
    'loopfelloff@gmail.com',
    'testboy@gmail.com',
    'fasdfadf',
    'ownerseen'
  ),
  (
    'loopfelloff@gmail.com',
    'testboy@gmail.com',
    'asdfasdf',
    'ownerseen'
  ),
  (
    'loopfelloff@gmail.com',
    'testboy@gmail.com',
    'asdfasdf',
    'ownerseen'
  ),
  (
    'example2@gmail.com',
    'loopfelloff@gmail.com',
    'd',
    'seen'
  ),
  (
    'loopfelloff@gmail.com',
    'example2@gmail.com',
    'k cha vai',
    'seen'
  ),
  (
    'example2@gmail.com',
    'loopfelloff@gmail.com',
    'theek xa yr',
    'seen'
  ),
  (
    'loopfelloff@gmail.com',
    'example2@gmail.com',
    'hey how do you do buddy',
    'seen'
  ),
  (
    'example2@gmail.com',
    'loopfelloff@gmail.com',
    'i am good how are you mate',
    'seen'
  );
-- --------------------------------------------------------
--
-- Table structure for table `booked`
--
CREATE TABLE `booked` (
  `email` varchar(255) NOT NULL,
  `owner` varchar(255) DEFAULT NULL,
  `lat` decimal(20, 17) DEFAULT NULL,
  `lng` decimal(20, 17) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
--
-- Dumping data for table `booked`
--
INSERT INTO `booked` (`email`, `owner`, `lat`, `lng`)
VALUES (
    'uhisijan@gmail.com',
    'sachin@gmail.com',
    27.62394735684540600,
    85.53853690624237000
  );
-- --------------------------------------------------------
--
-- Table structure for table `chat`
--
CREATE TABLE `chat` (
  `sender` varchar(255) DEFAULT NULL,
  `reciever` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `seenornot` varchar(50) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
--
-- Dumping data for table `chat`
--
INSERT INTO `chat` (`sender`, `reciever`, `message`, `seenornot`)
VALUES ('null', 'undefined', 'sadfksjdafl', 'unseen');
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
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
--
-- Dumping data for table `housedetails`
--
INSERT INTO `housedetails` (
    `username`,
    `no_of_rooms`,
    `no_of_roommates`,
    `gates_open`,
    `gates_close`,
    `wifi_price`,
    `image1`,
    `image2`,
    `image3`,
    `latitude`,
    `longitude`,
    `price`,
    `parking`,
    `electricity`,
    `floor_level`,
    `house_facing_direction`
  )
VALUES (
    'Abhiyan MulaSag',
    1,
    1,
    '20:42:00',
    '20:43:00',
    1500,
    'images/aesthetic-room-ideas-5195645-hero-7d51313f2c8f4ed6b338513ae284b113.jpg',
    'images/beautiful-living-room-ideas.jpg',
    'images/aesthetic-room-ideas-5195645-hero-7d51313f2c8f4ed6b338513ae284b113.jpg',
    27.61970291051658,
    85.53646624088287,
    500,
    'unavailable',
    'notrequired',
    '2',
    'west'
  ),
  (
    'minecrafter boy',
    1,
    1,
    '22:33:00',
    '22:32:00',
    500,
    'images/beautiful-living-room-ideas.jpg',
    'images/aesthetic-room-ideas-5195645-hero-7d51313f2c8f4ed6b338513ae284b113.jpg',
    'images/bedroom-decor-ideas.jpg',
    27.620539454949803,
    85.53878903388977,
    500,
    'unavailable',
    'required',
    '2',
    'east'
  ),
  (
    'minecrafter boy',
    1,
    1,
    '12:59:00',
    '13:59:00',
    500,
    'images/cheap-room-decor-ideas.jpg',
    'images/beautiful-living-room-ideas.jpg',
    'images/bedroom-decor-ideas.jpg',
    27.620648775625185,
    85.53756058216095,
    500,
    'unavailable',
    'required',
    '2',
    'west'
  ),
  (
    'pawan a',
    1,
    1,
    '20:47:00',
    '23:48:00',
    500,
    'images/Screenshot 2024-01-02 181900.png',
    'images/Screenshot 2024-01-10 174546.png',
    'images/Screenshot 2024-01-31 210847.png',
    27.620490022985425,
    85.53829765319811,
    500,
    'unavailable',
    'required',
    '2',
    'east'
  );
-- --------------------------------------------------------
-- --------------------------------------------------------
--
-- Table structure for table `profilepicture`
--
CREATE TABLE `profilepicture` (
  `email` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
--
-- Dumping data for table `profilepicture`
--
INSERT INTO `profilepicture` (`email`, `image`)
VALUES (
    'example2@gmail.com',
    'images/WIN_20250115_16_45_05_Pro.jpg'
  ),
  (
    'p@gmail.com',
    'images/Screenshot 2024-01-10 174546.png'
  ),
  ('abhim@123', 'images/room1.jpg'),
  (
    'example2@gmail.com',
    'images/WIN_20250115_16_45_05_Pro.jpg'
  ),
  (
    'p@gmail.com',
    'images/Screenshot 2024-01-10 174546.png'
  ),
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
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
--
-- Dumping data for table `rentrequest`
--
INSERT INTO `rentrequest` (`sender`, `receiver`, `lat`, `lng`, `seen`)
VALUES (
    'uhisijan@gmail.com',
    'SijanBhandari17',
    27.62188935678423,
    85.53754452104563,
    'no'
  ),
  (
    'uhisijan@gmail.com',
    'SijanBhandari17',
    27.62394739871245,
    85.5385369421569,
    'no'
  );
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
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
--
-- Dumping data for table `review`
--
INSERT INTO `review` (
    `reviewer`,
    `receiver`,
    `rating`,
    `comment`,
    `date`
  )
VALUES (
    'abhim@123',
    'test@gmail.com',
    3,
    'gay',
    '2025-02-06'
  ),
  (
    'abhim@123',
    'uhisijan@gmail.com',
    3,
    'safsaf',
    '2025-02-13'
  ),
  ('adsf', 'test@gmail.com', 3, 'fa]', '2025-02-06'),
  (
    'alice.jones@example.com',
    'abhim@123',
    3,
    'Decent place, but had some issues with parking.',
    '2025-03-02'
  ),
  ('daf', 'test@gmail.com', 1, 'fa]', '2025-02-06'),
  (
    'hello',
    'test@gmail.com',
    3,
    'fa]',
    '2025-02-06'
  ),
  (
    'jane.smith@example.com',
    'abhim@123',
    4,
    'Very nice house, but the wifi could be better.',
    '2025-03-02'
  ),
  (
    'john.doe@example.com',
    'abhim@123',
    5,
    'Excellent place, highly recommended!',
    '2025-03-02'
  ),
  (
    'john.doe@example.com',
    'uhisijan@gmail.com',
    5,
    'Great experience! Highly recommended.',
    '2025-02-13'
  ),
  ('sdaf', 'test@gmail.com', 4, 'fa]', '2025-02-06'),
  (
    'sdasdff',
    'test@gmail.com',
    5,
    'fa]',
    '2025-02-06'
  ),
  ('sdf', 'test@gmail.com', 2, 'fa]', '2025-02-06'),
  (
    'uhisijan@gmail.com',
    'abhim@123',
    3,
    'saf',
    '2025-03-06'
  );
-- --------------------------------------------------------
--
-- Table structure for table `review_house`
--
CREATE TABLE `review_house` (
  `reviewer` varchar(255) NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` varchar(256) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
--
-- Dumping data for table `review_house`
--
INSERT INTO `review_house` (`reviewer`, `lat`, `lng`, `rating`, `comment`)
VALUES (
    'uhisijan@gmail.com',
    27.623947356845406,
    85.53853690624237,
    5,
    'fas'
  );
-- --------------------------------------------------------
--
-- Table structure for table `signin`
--
CREATE TABLE `signin` (
  `email` varchar(50) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `number` int(10) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
--
-- Dumping data for table `signin`
--
INSERT INTO `signin` (`email`, `firstName`, `lastName`, `password`)
VALUES (
    '',
    'ashok',
    'sin',
    '$2y$10$pTrzxsxYIaO8UYibvYCGYeZaitw3XRsMLvvAgoztzA3cM3RdJFk62'
  ),
  (
    'a@gmail.com',
    'Abhiyan',
    'MulaSag',
    '$2y$10$RLNdxV9.X4GG98KZe9y9S.GCno7ABIoWI4YEA69G/EPE2vqaHbK1G'
  ),
  (
    'abhiyandondai@gmail.com',
    'Abhiyan ',
    'Dondai',
    '$2y$10$.afvIVtfrWndIOIgO5wVke4fFIWmQ2j40BaKzFmuhe4m56uIt8pXu'
  ),
  (
    'abhiyanregmi12@gmail.com',
    'Abhiyandon',
    'Regmi',
    '$2y$10$rv3iKh13ZDabghMrEHLxh.Vn7km/Q4wCL4fR2D0L6VwCCswcmoQSu'
  ),
  (
    'abhiyanthapa@gmail.com',
    'abhiyan ',
    'thapa',
    '$2y$10$L9WjpF6ildsVby2IKfEkMu1e7dAka3bXXDawsiyq2NfqmedKm/gTu'
  ),
  (
    'AckermanSwastik@gmail.com',
    'Swastik',
    'Ackerman',
    '$2y$10$5JIx.PRN324rcC8nS3Nq/.AWh5iddei0D46iD2BPq2SGvJbpA2K1C'
  ),
  (
    'ashok@gmail.com',
    'ashok',
    'singh',
    '$2y$10$yeepAFYPoeXHiKiZQVN6c.NLWtq7MUplmLuRGPLz1WJxjR6SHh5OC'
  ),
  (
    'computerengineering@gmail.com',
    'Abhiyan123',
    'Regmi',
    '$2y$10$Thua0c7hLkD88glGjzvqLugXszEAX.XLwRruUN20AjX6f2uJ/J89K'
  ),
  (
    'dhaba@gmail.com',
    'dhaba',
    'chand',
    '$2y$10$eF2i/90PI3spYMA/RAcEoeLWmi3aEmgm/3dy6SxD.JJSBeAg/Ciey'
  ),
  (
    'example2@gmail.com',
    'minecrafter',
    'boy',
    '$2y$10$Uznr0inq1y9gsq4iggWnlOAtD8HYamzuxaWHAZFdECeYA6HzDId9G'
  ),
  (
    'exampleemail@gmail.com',
    'Abhiyan12',
    'Regmi',
    '$2y$10$sr0ksBE3DkJFHQq7Z1geROrhwZwGAIlgcGPWZuJ99Uh7GKIf94o2W'
  ),
  (
    'happu@gmail.com',
    'happu',
    'singh',
    '$2y$10$O/cOjqvLDMOL0A.k2vFgmuQ1NSV8GPkcw08OOc/2NCXHNZXk6JX3u'
  ),
  (
    'jimu@gmail.com',
    'jimu',
    'lal',
    '$2y$10$z4eNabHg/Rjg9nOeIljIzOwqVeIAf9fTh4dXd3VNlTYgQFEdkPx/6'
  ),
  (
    'jina@gmail.com',
    'jina',
    'singh',
    '$2y$10$xGVjylSIq4/koiQZDxE2dOznuHE53mH.EHvJsKQUg12zZMiTAenSO'
  ),
  (
    'jiwan@gmail.com',
    'jiwan',
    'rana',
    '$2y$10$2010ZXeMogdwn1nutzP6o.hznmzJO.7SfJcmK5oMAnKYng8gU9tBG'
  ),
  (
    'jiwana@gmail.com',
    'jiwana',
    'regmi',
    '$2y$10$/snEgYjCiYCivPveXMqqye5GTBRsJlzwyq7n6kcQ1yvPGKwIq3HJG'
  ),
  (
    'john@gmail.com',
    'john',
    'voe',
    '$2y$10$RWJzpH1FU7ZlEW.IO9T8iOtsFzVr8od2zqwgvrDGWGl.QPth7BN4S'
  ),
  (
    'ku@gmail.com',
    'helloworld',
    'minecraft',
    '$2y$10$s9b8Hj8AJMb1kDBoVifiQ.LugJjlbSkVbKYm2OO1D8cSjTqrS8UYS'
  ),
  (
    'maaaya@gmail.com',
    'maaaya',
    'thapa',
    '$2y$10$GFOr7n6zm8Q0e3DX/l71O.G7ojkRDC0zu4nH0y8qwRfQH6BBcdkH.'
  ),
  (
    'maha@gmail.com',
    'maha',
    'thapa',
    '$2y$10$qX4KDsl5qlLsfkWBQMOcGeV19a.VSQlUfLi/cqqzcEvWt/1KmNQ8S'
  ),
  (
    'maman@gmail.com',
    'maman',
    'pandey',
    '$2y$10$E/qF5G/dFXH.71I4wzLc4OV8eTI3eVygXoxPVl2IJQZriaMoJdgeS'
  ),
  (
    'mamta@gmail.com',
    'mamta',
    'pandy',
    '$2y$10$pvb0BpO5Sc/3qGLRDUtwwuhufN0zWNYnmPZXqWjF.3SrirLUzJ2S2'
  ),
  (
    'mohan@gmail.com',
    'mohan',
    'dahal',
    '$2y$10$LG58YhRUIcuz2MlPxmOZMe3oySh25hTaauiYNScPa0c11JnqDjR9.'
  ),
  (
    'paja@gmail.com',
    'puja',
    'rana',
    '$2y$10$kRuz6XnBpg4on3eFH7c1/.5FMu.5DVVMR1qeiLHNQlSnKlvwwKN4e'
  ),
  (
    'pankaj@gmail.com',
    'pankaj',
    'dawadi',
    '$2y$10$UggK46FrIcvOR6Z4JnNhcOmazEYT9U8YONcUCFdULxjhLtNl/Rafi'
  ),
  (
    'papadon@gmail.com',
    'papadon',
    'papadon',
    '$2y$10$zrJQqomsN2O2kvIRPa/X3eI1EBZVyNLMRAvE/HHnumVVAXEWmGmCK'
  ),
  (
    'papan@gmail.com',
    'papan',
    'lama',
    '$2y$10$B08m2J05z4tCTUNuB7xz2eSGwx1bLtJGbZKeNzmGQv.IKer.VITpO'
  ),
  (
    'puja@gmail.com',
    'puja',
    'rana',
    '$2y$10$Zh0V3w2Itnhf1xkzAbO6L.JGsibffb6/ZEp0beRVyYzOqSQz7tIQa'
  ),
  (
    'qwertyuiop@gmail.com',
    'yesboi',
    'hello',
    '$2y$10$3T1jU4zmWzlmWvGifqFWiONJyxA/GmgHhN47hoq7v2Ei473U.JA0.'
  ),
  (
    'rajan@gmail.com',
    'rajan',
    'bista',
    '$2y$10$BjETNUnB49biJbWvAAHLOeTl3breyhL3M/f/hBAZ1gEJPb7hZvDou'
  ),
  (
    'raju@gmail.com',
    'raju',
    'bhandari',
    '$2y$10$VkEuodIF4FMYGYodtkMnOOLoW45e3gmShcfeJIfnSAcY58lNkSrS.'
  ),
  (
    'ramlal@gmail.com',
    'ramlal',
    'thapa',
    '$2y$10$FTPAt7kFIe8fdbRjU52.4urbEIlqD5OcYmn2BgWEhwIcbD2c5KERa'
  ),
  (
    'samikshya@gmail.com',
    'samikshya',
    'bohara',
    '$2y$10$Bm70z8Wzy0HD4u3WwwQR6OjzWZqdK2psQ9SziYrDDTkSRf4/3LQ0W'
  ),
  (
    'sanu@gmail.com',
    'sanu',
    'bhandari',
    '$2y$10$FPwFloYM/lqN0klqMhhSwuTABiiBjbZiovDyY8IccBd2hX/ylEDam'
  ),
  (
    'season@gmail.com',
    'season',
    'thapa',
    '$2y$10$dHbyVhiFa.FRmJcQVeHmXuWvDiwnOPyv5d4boq0biNM2YvWjPXvX6'
  ),
  (
    'seasonparirar@gmail.com',
    'season',
    'parirar',
    '$2y$10$bDp2GxkeEIffwer.tlgBfeZNF32pTyRMow1ZLN9UK7c9hpRTj3MJm'
  ),
  (
    'simran@gmail.com',
    'simran',
    'pandey',
    '$2y$10$pBrCzJVdI4XgCUB9s81fhuKgeO/azJuY59wZpt7YCb/rtaqeandKq'
  ),
  (
    'swastikbhandari2006@gmail.com',
    'swastik ',
    'bhandari',
    '$2y$10$zEUbk9kpMcUPswB4PUkLeuwdnnMreLam8Yo.TRp5Rf4D9U/Ky1POu'
  ),
  (
    'test@gmail.com',
    'sijan',
    'bhan',
    '$2y$10$4CVu7s7P8vG5e2FbaqCgBuF0Nn09kCRbzqFsVvg8RDtKfpJakuBJu'
  ),
  (
    'testuser@gmail.com',
    'Test',
    'User',
    '$2y$10$Lnblp5Sl6pfc8CimhJp4zeXOSe9iz7JMZjEVqRcGpqn.zoAlb1qmq'
  ),
  (
    'university@gmail.com',
    'yeah boi',
    'regmi',
    '$2y$10$aU7OpjrQ4cWRJaX1WFle0eSSw1SWq3bj0eqA1TPDmNNSNz67sH5ZG'
  ),
  (
    'usha@gmail.com',
    'usha',
    'bista',
    '$2y$10$RNINyMBropQyAGfnd89iEuQAJhqyjeuWJyJO1g0B6ljel0LIfajku'
  ),
  (
    'vanja@gmail.com',
    'vanja',
    'babu',
    '$2y$10$MwbsAjxFplFJ2fhFFsy1X.q.3tQy5JGnYgJDObnfHfnVmjMldGLL6'
  ),
  (
    'yeagersandy@gmail.com',
    'Sandesh',
    'Yeager',
    '$2y$10$.uOb71ZzoCZEZluUNphuRe9U5pnRgV0B2Q3yN2WBAmYaZfAWLvdGy'
  ),
  (
    'abhim@123',
    'abhim',
    'bhusal',
    0,
    '$2y$10$hoQ.1bjIMh6EpvsvBPgiiOBeNJc5RVZB88PQRSXQg1KpJvAxEUpLO'
  ),
  (
    'sachin@gmail.com',
    'Sachin',
    'name',
    0,
    '$2y$10$rowJ8imB.okiwy0aSIqaXebNgpSVl.IqFEf9EyItU4m72cqOGKic2'
  ),
  (
    'SijanBhandari17',
    'kane',
    'Williamson',
    0,
    '841bf1f4d35fd3dcd6132d0ebcc6639e1743ab7e866d1d420775229f5ba18431'
  ),
  (
    'test@gmail.com',
    'test',
    'se',
    0,
    '$2y$10$IOfUCY4ry0YBxrsFZTxXuepTsbScIBX/hqBuanQGC1dwqQ7INtWPm'
  ),
  (
    'uhisijan@gmail.com',
    'Sijan',
    'Bhandari',
    0,
    '$2y$10$uCZ60kitAAyCXER8XptWReUlWAMTPmhqS9yOvr/FUCBdZJygQF2lO'
  );
-- --------------------------------------------------------
--
-- Table structure for table `user_verification`
--
CREATE TABLE `user_verification` (
  `email` varchar(255) NOT NULL,
  `verification_number` int(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
--
-- Dumping data for table `user_verification`
--
<< << << < HEAD
INSERT INTO `user_verification` (`email`, `verification_number`, `status`)
VALUES ('abhiyanthapa@gmail.com', 2345678, 'student'),
  ('ashok@gmail.com', 33436, 'owner'),
  ('example2@gmail.com', 12, 'student'),
  ('exampleemail@gmail.com', 123456, 'student'),
  (
    'fjfsdfalsdjfals@gmail.com',
    2147483647,
    'student'
  ),
  ('jimu@gmail.com', 36436, 'student'),
  ('jina@gmail.com', 46346, 'student'),
  ('jiwana@gmail.com', 235235, 'owner'),
  ('ku@gmail.com', 2147483647, 'student'),
  ('maha@gmail.com', 364624, 'student'),
  ('maman@gmail.com', 3466346, 'student'),
  ('mohan@gmail.com', 34634634, 'owner'),
  ('pankaj@gmail.co', 363446, 'owner'),
  ('papan@gmail.com', 36346, 'student'),
  ('puja@gmail.com', 25235, 'student'),
  ('rajan@gmail.com', 243523, 'student'),
  ('ramlal@gmail.com', 36346, 'student'),
  ('university@gmail.com', 123456, 'student'),
  ('vanja@gmail.com', 46346, 'student');
== == == =
INSERT INTO `user_verification` (`email`, `verification_number`, `status`)
VALUES ('abhim@123', 12, 'owner'),
  ('sachin@gmail.com', 1234, 'owner'),
  ('test@gmail.com', 1, 'student');
>> >> >> > 68317de684eb8e1a84c6cf8850fdd5ba3ca80181 -- --------------------------------------------------------
--
-- Table structure for table `verified_users`
--
CREATE TABLE `verified_users` (
  `email` varchar(50) NOT NULL,
  `verification_number` int(20) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
--
-- Dumping data for table `verified_users`
--
<< << << < HEAD
INSERT INTO `verified_users` (`email`, `verification_number`, `status`)
VALUES ('abhiaynregmi12@gmail.com', 23456, 'owner'),
  ('abhiyandondai@gmail.com', 123456788, 'student'),
  (
    'abhiyanregmi12@gmail.com',
    2147483647,
    'student'
  ),
  ('abhiyanregmi@gmail.com', 23456, 'student'),
  ('ashok@gmail.com', 33436, '0'),
  ('dhaba@gmail.com', 52352, '0'),
  ('happu@gmail.com', 252353, '0'),
  ('jina@gmail.com', 46346, '0'),
  ('jiwan@gmail.com', 346346, '0'),
  ('jiwana@gmail.com', 235235, 'owner'),
  ('maaaya@gmail.com', 5433634, '0'),
  ('maha@gmail.com', 364624, 'student'),
  ('maman@gmail.com', 3466346, '0'),
  ('mamta@gmail.com', 465653, 'student'),
  ('pankaj@gmail.com', 363446, 'owner'),
  ('papadon@gmail.com', 0, 'student'),
  ('puja@gmail.com', 25235, 'student'),
  ('ramlal@gmail.com', 36346, 'student'),
  ('seasonparirar@gmail.com', 536446, 'owner'),
  ('simran@gmail.com', 25325, '0'),
  ('swastikbhandari2006@gmail.com', 2006, 'student');
== == == =
INSERT INTO `verified_users` (`email`, `verification_number`, `status`)
VALUES ('abhim@123', 12, 'owner'),
  ('sachin@gmail.com', 1234, 'owner'),
  ('test@gmail.com', 1, 'student'),
  ('uhisijan@gmail.com', 1, 'student');
>> >> >> > 68317de684eb8e1a84c6cf8850fdd5ba3ca80181 --
-- Indexes for dumped tables
--
--
-- Indexes for table `booked`
--
ALTER TABLE `booked`
ADD PRIMARY KEY (`email`);
--
-- Indexes for table `booked`
--
ALTER TABLE `booked`
ADD PRIMARY KEY (`email`);
--
-- Indexes for table `housedetails`
--
ALTER TABLE `housedetails`
ADD PRIMARY KEY (`username`, `latitude`, `longitude`),
  ADD UNIQUE KEY `username` (`username`, `latitude`, `longitude`);
--
<< << << < HEAD -- Indexes for table `owner_number`
--
ALTER TABLE `owner_number`
ADD PRIMARY KEY (`email`);
--
== == == = >> >> >> > 68317de684eb8e1a84c6cf8850fdd5ba3ca80181 -- Indexes for table `profilepicture`
--
ALTER TABLE `profilepicture`
ADD PRIMARY KEY (`email`);
--
-- Indexes for table `rentrequest`
--
ALTER TABLE `rentrequest` << << << < HEAD
ADD PRIMARY KEY (`sender`, `receiver`);
== == == =
ADD PRIMARY KEY (`sender`, `receiver`, `lat`, `lng`);
>> >> >> > 68317de684eb8e1a84c6cf8850fdd5ba3ca80181 --
-- Indexes for table `review`
--
ALTER TABLE `review` << << << < HEAD
ADD PRIMARY KEY (`reviewer`, `reciever`);
== == == =
ADD PRIMARY KEY (`reviewer`, `receiver`);
>> >> >> > 68317de684eb8e1a84c6cf8850fdd5ba3ca80181 --
-- Indexes for table `review_house`
--
ALTER TABLE `review_house` << << << < HEAD
ADD PRIMARY KEY (`lat`, `lng`, `reviewer`);
== == == =
ADD PRIMARY KEY (`lat`, `lng`, `reviewer`);
>> >> >> > 68317de684eb8e1a84c6cf8850fdd5ba3ca80181 --
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
COMMIT;
<< << << < HEAD
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;
== == == =
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;
>> >> >> > 68317de684eb8e1a84c6cf8850fdd5ba3ca80181