-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2025 at 12:12 PM
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
('example2@gmail.com', 'a@gmail.com', 27.62042538108522000, 85.53692758083345000);

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
('loopfelloff@gmail.com', 'example2@gmail.com', 'asdfasdfa', 'unseen', 9),
('loopfelloff@gmail.com', 'undefined', 'fasdfasdf', 'unseen', 11),
('loopfelloff@gmail.com', 'undefined', 'ddddd', 'unseen', 12),
('loopfelloff@gmail.com', 'sarthakregmi@gmail.com', 'fasdfasdfasdf', 'unseen', 16),
('loopfelloff@gmail.com', 'example2@gmail.com', 'hey how are you long time no see!', 'unseen', 17),
('example2@gmail.com', 'loopfelloff@gmail.com', 'I am good wby?', 'unseen', 18),
('loopfelloff@gmail.com', 'example2@gmail.com', 'hello how are yoiu', 'unseen', 19),
('example2@gmail.com', 'loopfelloff@gmail.com', 'hello how are you friend', 'unseen', 20),
('loopfelloff@gmail.com', 'example2@gmail.com', 'i am fine thank you sir', 'unseen', 21),
('loopfelloff@gmail.com', 'example2@gmail.com', 'hello how are you', 'unseen', 22),
('loopfelloff@gmail.com', 'example2@gmail.com', 'fajksldfjalsdjflajdlfajsdflkadjfasldf', 'unseen', 24);

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
('a@gmail.com', 1, 1, '18:50:00', '16:54:00', 1000, 'images/aesthetic-room-ideas-5195645-hero-7d51313f2c8f4ed6b338513ae284b113.jpg', 'images/bedroom-decor-ideas.jpg', 'images/beautiful-living-room-ideas.jpg', 27.62042538108522, 85.53692758083345, 500, 'unavailable', 'required', '4', 'west'),
('aarti.adhikari@example.com', 2, 1, '17:00:00', '22:00:00', 600, 'images/2a.jpg', 'images/2b.jpg', 'images/2c.jpg', 27.672, 85.325, 2000, 'unavailable', 'required', '1', 'west'),
('anish@gmail.com', 2, 2, '06:00:00', '22:00:00', 500, 'images/room1.jpg', 'images/room1.jpg', 'images/room3.jpg', 27.624012356845405, 85.53862690624237, 3800, 'available', 'included', '2', 'south'),
('anita.kc@example.com', 3, 2, '17:00:00', '22:00:00', 850, 'images/10a.jpg', 'images/10b.jpg', 'images/10c.jpg', 27.68, 85.333, 1900, 'unavailable', 'required', '1', 'west'),
('ashok.poudel@example.com', 3, 2, '17:00:00', '22:00:00', 850, 'images/19a.jpg', 'images/19b.jpg', 'images/19c.jpg', 27.689, 85.342, 1900, 'available', 'required', '1', 'south'),
('bibek123@yahoo.com', 3, 1, '06:00:00', '22:30:00', 0, 'images/room3.jpg', 'images/room3.jpg', 'images/room1.jpg', 27.624147356845405, 85.53843690624237, 5500, 'available', 'required', '1', 'north'),
('deepak.bhatta@example.com', 2, 1, '17:00:00', '22:00:00', 700, 'images/5a.jpg', 'images/5b.jpg', 'images/5c.jpg', 27.675, 85.328, 1300, 'available', 'required', '2', 'east'),
('dinesh.khadka@example.com', 2, 1, '17:00:00', '22:00:00', 600, 'images/20a.jpg', 'images/20b.jpg', 'images/20c.jpg', 27.69, 85.343, 1500, 'unavailable', 'required', '2', 'north'),
('gopal.rajbhandari@example.com', 2, 1, '17:00:00', '22:00:00', 600, 'images/14a.jpg', 'images/14b.jpg', 'images/14c.jpg', 27.684, 85.337, 1500, 'unavailable', 'required', '2', 'west'),
('isha.mishra@example.com', 3, 2, '17:00:00', '22:00:00', 900, 'images/13a.jpg', 'images/13b.jpg', 'images/13c.jpg', 27.683, 85.336, 1800, 'available', 'required', '1', 'east'),
('kamal@outlook.com', 3, 2, '05:30:00', '23:00:00', 350, 'images/room1.jpg', 'images/room1.jpg', 'images/room1.jpg', 27.623897356845404, 85.53883690624237, 5900, 'available', 'required', '3', 'west'),
('kiran.ghimire@example.com', 4, 3, '17:00:00', '22:00:00', 1300, 'images/9a.jpg', 'images/9b.jpg', 'images/9c.jpg', 27.679, 85.332, 4000, 'available', 'required', '3', 'east'),
('manoj.chaudhary@example.com', 3, 2, '17:00:00', '22:00:00', 950, 'images/7a.jpg', 'images/7b.jpg', 'images/7c.jpg', 27.677, 85.33, 2200, 'available', 'required', '1', 'south'),
('nabin@gmail.com', 1, 0, '05:45:00', '23:15:00', 0, 'images/room1.jpg', 'images/room3.jpg', 'images/room1.jpg', 27.623697356845405, 85.53903690624237, 3950, 'available', 'required', '2', 'north-west'),
('neeta.bhatt@example.com', 4, 3, '17:00:00', '22:00:00', 1200, 'images/15a.jpg', 'images/15b.jpg', 'images/15c.jpg', 27.685, 85.338, 3000, 'available', 'required', '3', 'south'),
('nisha.pandey@example.com', 3, 2, '17:00:00', '22:00:00', 900, 'images/4a.jpg', 'images/4b.jpg', 'images/4c.jpg', 27.674, 85.327, 1800, 'unavailable', 'required', '1', 'north'),
('pratiksha.bhattarai@example.com', 4, 3, '17:00:00', '22:00:00', 1200, 'images/21a.jpg', 'images/21b.jpg', 'images/21c.jpg', 27.691, 85.344, 3500, 'available', 'required', '3', 'east'),
('priya.thapa@example.com', 4, 3, '17:00:00', '22:00:00', 1100, 'images/6a.jpg', 'images/6b.jpg', 'images/6c.jpg', 27.676, 85.329, 3000, 'unavailable', 'required', '3', 'west'),
('priya@outlook.com', 1, 2, '05:30:00', '23:00:00', 300, 'images/room3.jpg', 'images/room1.jpg', 'images/room3.jpg', 27.623847356845406, 85.53873690624236, 4200, 'not available', 'included', '3', 'west'),
('purnima.acharya@example.com', 2, 1, '17:00:00', '22:00:00', 700, 'images/17a.jpg', 'images/17b.jpg', 'images/17c.jpg', 27.687, 85.34, 1700, 'available', 'required', '2', 'east'),
('rajesh.kumar@example.com', 4, 3, '17:00:00', '22:00:00', 1200, 'images/3a.jpg', 'images/3b.jpg', 'images/3c.jpg', 27.673, 85.326, 2500, 'available', 'required', '3', 'south'),
('rajeshwori.pokharel@example.com', 2, 1, '17:00:00', '22:00:00', 700, 'images/11a.jpg', 'images/11b.jpg', 'images/11c.jpg', 27.681, 85.334, 1600, 'available', 'required', '2', 'south'),
('ramesh@hotmail.com', 2, 0, '05:00:00', '23:30:00', 250, 'images/room1.jpg', 'images/room3.jpg', 'images/room1.jpg', 27.623747356845406, 85.53893690624237, 3500, 'available', 'included', '4', 'south-east'),
('ravi.adhikari@example.com', 3, 2, '17:00:00', '22:00:00', 950, 'images/16a.jpg', 'images/16b.jpg', 'images/16c.jpg', 27.686, 85.339, 2200, 'unavailable', 'required', '1', 'north'),
('rita@yahoo.com', 2, 3, '06:00:00', '22:30:00', 200, 'images/room3.jpg', 'images/room3.jpg', 'images/room3.jpg', 27.624147356845405, 85.53813690624237, 4500, 'not available', 'included', '1', 'south-west'),
('sachin@gmail.com', 1, 1, '22:36:00', '22:36:00', 0, 'images/room1.jpg', 'images/room3.jpg', 'images/room3.jpg', 27.623947356845406, 85.53853690624237, 500, 'available', 'required', '1', 'east'),
('sanjana.khadka@example.com', 4, 3, '17:00:00', '22:00:00', 1300, 'images/18a.jpg', 'images/18b.jpg', 'images/18c.jpg', 27.688, 85.341, 4000, 'unavailable', 'required', '3', 'west'),
('sanjay.shrestha@example.com', 3, 2, '17:00:00', '22:00:00', 800, 'images/1a.jpg', 'images/1b.jpg', 'images/1c.jpg', 27.6712, 85.324, 1500, 'available', 'required', '2', 'east'),
('sita.bhandari@example.com', 2, 1, '17:00:00', '22:00:00', 650, 'images/8a.jpg', 'images/8b.jpg', 'images/8c.jpg', 27.678, 85.331, 1700, 'unavailable', 'required', '2', 'north'),
('suman.bhattarai@example.com', 4, 3, '17:00:00', '22:00:00', 1200, 'images/12a.jpg', 'images/12b.jpg', 'images/12c.jpg', 27.682, 85.335, 3500, 'unavailable', 'required', '3', 'north'),
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
('a@gmail.com', 'images/WIN_20241130_19_28_36_Pro.jpg'),
('aarti.adhikari@example.com', 'images/p2.jpg'),
('abhim@123', 'images/room1.jpg'),
('anita.kc@example.com', 'images/p10.jpg'),
('ashok.poudel@example.com', 'images/p19.jpg'),
('deepak.bhatta@example.com', 'images/p5.jpg'),
('dinesh.khadka@example.com', 'images/p20.jpg'),
('example2@gmail.com', 'images/WIN_20241202_17_21_45_Pro.jpg'),
('gopal.rajbhandari@example.com', 'images/p14.jpg'),
('isha.mishra@example.com', 'images/p13.jpg'),
('kiran.ghimire@example.com', 'images/p9.jpg'),
('manoj.chaudhary@example.com', 'images/p7.jpg'),
('neeta.bhatt@example.com', 'images/p15.jpg'),
('nisha.pandey@example.com', 'images/p4.jpg'),
('p@gmail.com', 'images/Screenshot 2024-01-10 174546.png'),
('pratiksha.bhattarai@example.com', 'images/p21.jpg'),
('priya.thapa@example.com', 'images/p6.jpg'),
('purnima.acharya@example.com', 'images/p17.jpg'),
('rajesh.kumar@example.com', 'images/p3.jpg'),
('rajeshwori.pokharel@example.com', 'images/p11.jpg'),
('ravi.adhikari@example.com', 'images/p16.jpg'),
('sachin@gmail.com', 'images/room2.jpg'),
('sanjana.khadka@example.com', 'images/p18.jpg'),
('sanjay.shrestha@example.com', 'images/p1.jpg'),
('sita.bhandari@example.com', 'images/p8.jpg'),
('suman.bhattarai@example.com', 'images/p12.jpg'),
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
('example2@gmail.com', 'rajesh.kumar@example.com', 27.673, 85.326, 'no'),
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
('reviewer10@example.com', 'anita.kc@example.com', 5, 'Highly recommend!', '2023-10-10'),
('reviewer11@example.com', 'rajeshwori.pokharel@example.com', 2, 'Not worth it.', '2023-10-11'),
('reviewer12@example.com', 'suman.bhattarai@example.com', 3, 'Decent place.', '2023-10-12'),
('reviewer13@example.com', 'isha.mishra@example.com', 4, 'Good experience.', '2023-10-13'),
('reviewer14@example.com', 'gopal.rajbhandari@example.com', 5, 'Fantastic!', '2023-10-14'),
('reviewer15@example.com', 'neeta.bhatt@example.com', 1, 'Terrible.', '2023-10-15'),
('reviewer16@example.com', 'ravi.adhikari@example.com', 4, 'Very nice house.', '2023-10-16'),
('reviewer17@example.com', 'purnima.acharya@example.com', 3, 'It was okay.', '2023-10-17'),
('reviewer18@example.com', 'sanjana.khadka@example.com', 5, 'Loved the place!', '2023-10-18'),
('reviewer19@example.com', 'ashok.poudel@example.com', 2, 'Not great.', '2023-10-19'),
('reviewer1@example.com', 'sanjay.shrestha@example.com', 5, 'Nice house!', '2023-10-01'),
('reviewer20@example.com', 'dinesh.khadka@example.com', 4, 'Good overall.', '2023-10-20'),
('reviewer21@example.com', 'pratiksha.bhattarai@example.com', 3, 'Average stay.', '2023-10-21'),
('reviewer2@example.com', 'aarti.adhikari@example.com', 4, 'Good place to stay.', '2023-10-02'),
('reviewer3@example.com', 'rajesh.kumar@example.com', 3, 'Average experience.', '2023-10-03'),
('reviewer4@example.com', 'nisha.pandey@example.com', 2, 'Not as expected.', '2023-10-04'),
('reviewer5@example.com', 'deepak.bhatta@example.com', 1, 'Bad house.', '2023-10-05'),
('reviewer6@example.com', 'priya.thapa@example.com', 5, 'Loved it!', '2023-10-06'),
('reviewer7@example.com', 'manoj.chaudhary@example.com', 4, 'Very nice!', '2023-10-07'),
('reviewer8@example.com', 'sita.bhandari@example.com', 3, 'It was okay.', '2023-10-08'),
('reviewer9@example.com', 'kiran.ghimire@example.com', 4, 'Good value for money.', '2023-10-09'),
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
('a@gmail.com', 'a', 'a', '2326323523', '$2y$10$MDpQYV8/Q69uFuaAzWRDEO43geu4OLjKu0HheKr7xPZCMTDJ1jvJa'),
('aarti.adhikari@example.com', 'Aarti', 'Adhikari', '2345678901', ''),
('abhim@123', 'abhim', 'bhusal', '0', '$2y$10$hoQ.1bjIMh6EpvsvBPgiiOBeNJc5RVZB88PQRSXQg1KpJvAxEUpLO'),
('abhiyanregmi@gmail.com', 'asdasdf', 'sdfas', '2536456345', '$2y$10$7EsiMC6vyGKHKxfR2Phus.fYYheLhkco2l6fjO3DWr2LmGz4gXWhi'),
('anita.kc@example.com', 'Anita', 'KC', '1234567890', ''),
('ashok.poudel@example.com', 'Ashok', 'Poudel', '1234567890', ''),
('deepak.bhatta@example.com', 'Deepak', 'Bhatta', '5678901234', ''),
('dinesh.khadka@example.com', 'Dinesh', 'Khadka', '2345678901', ''),
('example2@gmail.com', 'student', 'yes', '9999999999', '$2y$10$y.yreO2GWjeTToQc8yUM3uhJkOWkqQedb/kYFnGKjbf669qNxKqR6'),
('gopal.rajbhandari@example.com', 'Gopal', 'Rajbhandari', '5678901234', ''),
('isha.mishra@example.com', 'Isha', 'Mishra', '4567890123', ''),
('kiran.ghimire@example.com', 'Kiran', 'Ghimire', '9012345678', ''),
('manoj.chaudhary@example.com', 'Manoj', 'Chaudhary', '7890123456', ''),
('neeta.bhatt@example.com', 'Neeta', 'Bhatt', '6789012345', ''),
('nisha.pandey@example.com', 'Nisha', 'Pandey', '4567890123', ''),
('pratiksha.bhattarai@example.com', 'Pratiksha', 'Bhattarai', '3456789012', ''),
('priya.thapa@example.com', 'Priya', 'Thapa', '6789012345', ''),
('purnima.acharya@example.com', 'Purnima', 'Acharya', '8901234567', ''),
('rajesh.kumar@example.com', 'Rajesh', 'Kumar', '3456789012', ''),
('rajeshwori.pokharel@example.com', 'Rajeshwori', 'Pokharel', '2345678901', ''),
('ravi.adhikari@example.com', 'Ravi', 'Adhikari', '7890123456', ''),
('sachin@gmail.com', 'Sachin', 'name', '0', '$2y$10$rowJ8imB.okiwy0aSIqaXebNgpSVl.IqFEf9EyItU4m72cqOGKic2'),
('sanjana.khadka@example.com', 'Sanjana', 'Khadka', '9012345678', ''),
('sanjay.shrestha@example.com', 'Sanjay', 'Shrestha', '1234567890', ''),
('shishir@gmail.com', 'Sijan', 'hfasufhf', '9765415893', '$2y$10$9Wxwk5d1L.JuY7hpgfwpaeYMTaPGp60DaT2gk3pVYvvvTjkn7/ZlG'),
('SijanBhandari17', 'kane', 'Williamson', '0', '841bf1f4d35fd3dcd6132d0ebcc6639e1743ab7e866d1d420775229f5ba18431'),
('sita.bhandari@example.com', 'Sita', 'Bhandari', '8901234567', ''),
('suman.bhattarai@example.com', 'Suman', 'Bhattarai', '3456789012', ''),
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
('a@gmail.com', 12, 'owner'),
('abhim@123', 12, 'owner'),
('abhiyanregmi@gmail.com', 23, 'owner'),
('example2@gmail.com', 12, 'student'),
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
('a@gmail.com', 12, 'owner'),
('aarti.adhikari@example.com', 2345678, 'owner'),
('abhim@123', 12, 'owner'),
('abhiyanregmi@gmail.com', 23, 'owner'),
('anita.kc@example.com', 123456, 'owner'),
('ashok.poudel@example.com', 9012345, 'owner'),
('deepak.bhatta@example.com', 5678901, 'owner'),
('dinesh.khadka@example.com', 123456, 'owner'),
('example2@gmail.com', 12, 'student'),
('gopal.rajbhandari@example.com', 4567890, 'owner'),
('isha.mishra@example.com', 3456789, 'owner'),
('kiran.ghimire@example.com', 9012345, 'owner'),
('manoj.chaudhary@example.com', 7890123, 'owner'),
('neeta.bhatt@example.com', 5678901, 'owner'),
('nisha.pandey@example.com', 4567890, 'owner'),
('pratiksha.bhattarai@example.com', 1234567, 'owner'),
('priya.thapa@example.com', 6789012, 'owner'),
('purnima.acharya@example.com', 7890123, 'owner'),
('rajesh.kumar@example.com', 3456789, 'owner'),
('rajeshwori.pokharel@example.com', 1234567, 'owner'),
('ravi.adhikari@example.com', 6789012, 'owner'),
('sachin@gmail.com', 1234, 'owner'),
('sanjana.khadka@example.com', 8901234, 'owner'),
('sanjay.shrestha@example.com', 1234567, 'owner'),
('shishir@gmail.com', 123, 'student'),
('sita.bhandari@example.com', 8901234, 'owner'),
('suman.bhattarai@example.com', 2345678, 'owner'),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
