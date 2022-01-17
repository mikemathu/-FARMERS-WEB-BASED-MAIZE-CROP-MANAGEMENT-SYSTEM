-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2021 at 03:11 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fmarket`
--

-- --------------------------------------------------------

--
-- Table structure for table `accepted`
--

CREATE TABLE `accepted` (
  `f_username` varchar(200) NOT NULL,
  `offer_id` int(11) NOT NULL,
  `e_username` varchar(200) NOT NULL,
  `price` int(11) NOT NULL,
  `valid` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`, `contact`) VALUES
('admin', '123', 787716340);

-- --------------------------------------------------------

--
-- Table structure for table `apply`
--

CREATE TABLE `apply` (
  `offer_id` int(11) NOT NULL,
  `f_username` varchar(200) NOT NULL,
  `bid` int(11) NOT NULL,
  `cover_letter` varchar(1000) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apply`
--

INSERT INTO `apply` (`offer_id`, `f_username`, `bid`, `cover_letter`, `quantity`) VALUES
(11, 'client1', 0, '', 16);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `contact_no` varchar(200) NOT NULL,
  `id_card_no` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `gender` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`username`, `password`, `contact_no`, `id_card_no`, `location`, `gender`) VALUES
('client1', '123', '01001001001', '30303030', 'Kilifi', 'female'),
('client10', '123', '0798827450', '35703436', 'Kenya', 'female'),
('joyce', '123', '0798827444', '35703436', '1234', 'female'),
('JohnDoe', '123', '0798827450', '35703436', 'kilifi', 'male');

-- --------------------------------------------------------

--
-- Table structure for table `employer`
--

CREATE TABLE `employer` (
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `contact_no` varchar(200) NOT NULL,
  `gender` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `farmer`
--

CREATE TABLE `farmer` (
  `id` int(255) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `contact_no` varchar(200) NOT NULL,
  `id_card_no` varchar(255) NOT NULL,
  `farm_location` varchar(255) NOT NULL,
  `farm_size` varchar(255) NOT NULL,
  `soil_type` varchar(255) NOT NULL,
  `gender` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `farmer`
--

INSERT INTO `farmer` (`id`, `username`, `password`, `contact_no`, `id_card_no`, `farm_location`, `farm_size`, `soil_type`, `gender`) VALUES
(1, 'farmer1', '123', '0808008008', '30303030', 'Kiambu', '1', 'Sand', 'male'),
(2, 'farmer2', '123', '0500050505', '390993909', 'Kwale', '1', 'clay', 'female'),
(3, 'farmer10', '123', '0798827450', '35703436', 'kericho', '0.5', 'sandy-loam', 'male'),
(4, 'farmer12', '123', '0798827450', '2222222', 'Kangae', '4', '', 'male'),
(5, 'felix', '123', '0987', '35703436', '77777', '3', 'silty-clay', 'male'),
(6, 'janedoe', '123', '0798827450', '35703436', 'Kangae', '2', 'sandy-loam', 'female');

-- --------------------------------------------------------

--
-- Table structure for table `farm_input`
--

CREATE TABLE `farm_input` (
  `item_id` int(11) NOT NULL,
  `item_type` varchar(255) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `quantity` int(255) NOT NULL,
  `selling_price` int(255) NOT NULL,
  `e_username` varchar(200) NOT NULL,
  `valid` tinyint(1) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `farm_input`
--

INSERT INTO `farm_input` (`item_id`, `item_type`, `title`, `description`, `quantity`, `selling_price`, `e_username`, `valid`, `timestamp`) VALUES
(1, 'White', 'admin 1', '123', 123, 123, 'admin', 0, '2021-11-21 14:24:03'),
(2, 'White', 'fresh maize', 'dfgh', 222, 55555, 'admin', 0, '2021-12-16 08:06:49'),
(3, 'Yellow', 'dab', 'dfgh', 80, 200, 'admin', 0, '2021-12-16 09:48:10'),
(4, 'White', 'mbegu', 'dfgh', 100, 100, 'admin', 0, '2021-12-16 09:48:59'),
(5, 'White', 'Input1', 'maize', 11, 100, 'admin', 0, '2021-12-19 08:31:22'),
(6, 'Yellow', 'input2', 'description', 40, 300, 'admin', 0, '2021-12-19 10:56:03'),
(7, 'Red', 'input4', 'description', 29, 200, 'admin', 0, '2021-12-19 10:57:27'),
(8, 'White', 'jn', 'description', 0, 100, 'admin', 0, '2021-12-19 11:05:42'),
(9, 'White', 'huhijkn', 'description', 30, 200, 'admin', 1, '2021-12-19 14:51:05'),
(10, 'Yellow', 'hjb', 'description', 8, 100, 'admin', 1, '2021-12-19 15:05:55');

-- --------------------------------------------------------

--
-- Table structure for table `farm_output`
--

CREATE TABLE `farm_output` (
  `offer_id` int(255) NOT NULL,
  `maize_type` varchar(255) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `number_of_bags` int(255) NOT NULL,
  `selling_price` int(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `e_username` varchar(200) NOT NULL,
  `valid` tinyint(1) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `farm_output`
--

INSERT INTO `farm_output` (`offer_id`, `maize_type`, `title`, `description`, `number_of_bags`, `selling_price`, `location`, `e_username`, `valid`, `timestamp`) VALUES
(1, 'Yellow', '1', '1111', 111, 1111, '11111111', 'farmer1', 0, '2021-11-21 14:13:38'),
(2, 'Yellow', '234567', 'fresh', 6, 55555, 'Mitamisyi', 'farmer10', 0, '2021-12-16 08:04:21'),
(3, 'Yellow', 'test', 'description', 23, 115, 'Msambweni', 'farmer2', 0, '2021-12-19 12:32:51'),
(4, 'White', 'rrr', 'description', 0, 500, 'Msambweni', 'farmer2', 1, '2021-12-19 12:53:22'),
(5, 'White', 'ff', 'description', 47, 300, 'Mpwapa', 'farmer2', 0, '2021-12-19 12:55:30'),
(6, 'White', 'gtgtg', 'description', 33, 500, 'Mitamisyi', 'farmer2', 0, '2021-12-19 13:00:50'),
(7, 'Yellow', 'nnhb b', 'I need someone to help me with laudering', 40, 200, 'kilifi', 'farmer2', 0, '2021-12-19 14:18:04'),
(8, 'White', 'rrgv', 'descr', 56, 400, 'Mpwapa', 'farmer2', 1, '2021-12-19 14:20:26'),
(9, 'Yellow', 'yugyuhj', 'description', 0, 300, 'Mitamisyi', 'farmer2', 0, '2021-12-19 14:40:36'),
(10, 'White', 'xxxxxx', 'description', 0, 300, 'Mpwapa', 'farmer1', 0, '2021-12-19 15:23:44'),
(11, 'Yellow', 'ubnhubhj', 'bjn', 52, 200, 'kilifi', 'farmer1', 1, '2021-12-19 17:25:21');

-- --------------------------------------------------------

--
-- Table structure for table `market_request`
--

CREATE TABLE `market_request` (
  `id` int(11) NOT NULL,
  `maize_type` varchar(255) NOT NULL,
  `title` varchar(200) NOT NULL,
  `type` varchar(200) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `number_of_bags` int(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `budget` int(11) NOT NULL,
  `e_username` varchar(200) NOT NULL,
  `valid` tinyint(1) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `market_request`
--

INSERT INTO `market_request` (`id`, `maize_type`, `title`, `type`, `description`, `number_of_bags`, `location`, `budget`, `e_username`, `valid`, `timestamp`) VALUES
(1, '', 'request 11', '', 'request 11', 11, '11111111', 111, 'client1', 0, '2021-11-21 14:20:48'),
(2, 'White', 'urgent', '', 'description', 1, 'Kenya', 1000, 'client10', 1, '2021-12-16 08:02:34'),
(3, 'Yellow', 'www', '', 'fresg', 5, 'Msambweni', 1000, 'joyce', 1, '2021-12-16 09:11:00'),
(4, 'Yellow', 'Maize', '', 'description', 20, 'Kilifi', 400, 'client1', 1, '2021-12-19 15:30:02');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `sender` varchar(200) NOT NULL,
  `receiver` varchar(200) NOT NULL,
  `msg` varchar(1000) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`sender`, `receiver`, `msg`, `timestamp`) VALUES
('joyce', 'client1', 'hello', '2021-12-16 09:16:36');

-- --------------------------------------------------------

--
-- Table structure for table `msgs`
--

CREATE TABLE `msgs` (
  `id` int(11) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `msg_text` varchar(255) NOT NULL,
  `timestamp` varchar(255) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `msgs`
--

INSERT INTO `msgs` (`id`, `sender`, `msg_text`, `timestamp`) VALUES
(1, 'farmer1', 'hello', '2021-12-16 11:28:34'),
(2, 'farmer10', 'hey are you there', '2021-12-16 11:29:51');

-- --------------------------------------------------------

--
-- Table structure for table `postcontent`
--

CREATE TABLE `postcontent` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `posted_by` varchar(255) NOT NULL,
  `timestamp` time NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `postcontent`
--

INSERT INTO `postcontent` (`id`, `title`, `body`, `category`, `posted_by`, `timestamp`) VALUES
(1, 'weeding season', 'should begin from 15th to 16th', 'White', 'admin', '11:05:57');

-- --------------------------------------------------------

--
-- Table structure for table `selected`
--

CREATE TABLE `selected` (
  `f_username` varchar(200) NOT NULL,
  `offer_id` int(11) NOT NULL,
  `e_username` varchar(200) NOT NULL,
  `price` int(11) NOT NULL,
  `valid` tinyint(1) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `selected`
--

INSERT INTO `selected` (`f_username`, `offer_id`, `e_username`, `price`, `valid`, `quantity`) VALUES
('farmer1', 1, 'client1', 0, 1, 1),
('client1', 1, 'farmer1', 0, 1, 1),
('farmer10', 2, 'farmer10', 0, 0, 1),
('farmer2', 3, 'client1', 0, 1, 11),
('farmer2', 4, 'client1', 0, 1, 29),
('farmer2', 5, 'client1', 0, 0, 1),
('farmer2', 6, 'client1', 0, 0, 1),
('farmer2', 4, 'client1', 0, 1, 13),
('farmer2', 4, 'client1', 0, 1, 54),
('farmer2', 4, 'client1', 0, 1, 11),
('farmer2', 4, 'client1', 0, 1, 2),
('farmer2', 4, 'client1', 0, 1, 5),
('farmer2', 4, 'client1', 0, 1, 2),
('farmer2', 4, 'client1', 0, 1, 10),
('farmer2', 4, 'client1', 0, 1, 8),
('farmer2', 7, 'client1', 0, 0, 1),
('farmer2', 8, 'client1', 0, 0, 1),
('farmer2', 8, 'client1', 0, 0, 1),
('farmer2', 8, 'client1', 0, 0, 1),
('farmer2', 8, 'client1', 0, 0, 1),
('farmer2', 8, 'client1', 0, 0, 1),
('farmer2', 8, 'client1', 0, 0, 1),
('farmer2', 8, 'client1', 0, 0, 1),
('farmer2', 9, 'client1', 0, 0, 1),
('farmer2', 9, 'client1', 0, 0, 1),
('farmer2', 9, 'client1', 0, 0, 30),
('farmer2', 9, 'client1', 0, 0, 7),
('farmer1', 10, 'client1', 0, 0, 30),
('farmer1', 10, 'client1', 0, 0, 9);

-- --------------------------------------------------------

--
-- Table structure for table `selected_farminput`
--

CREATE TABLE `selected_farminput` (
  `f_username` varchar(200) NOT NULL,
  `offer_id` int(11) NOT NULL,
  `e_username` varchar(200) NOT NULL,
  `price` int(11) NOT NULL,
  `valid` tinyint(1) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `selected_farminput`
--

INSERT INTO `selected_farminput` (`f_username`, `offer_id`, `e_username`, `price`, `valid`, `quantity`) VALUES
('farmer1', 1, 'admin', 0, 0, 1),
('farmer10', 3, 'admin', 0, 0, 1),
('farmer2', 4, 'admin', 0, 0, 1),
('farmer1', 5, 'admin', 0, 0, 1),
('farmer1', 2, 'admin', 0, 0, 0),
('farmer2', 6, 'admin', 0, 0, 0),
('farmer2', 7, 'admin', 0, 0, 12),
('farmer2', 8, 'admin', 0, 0, 19),
('farmer2', 8, 'admin', 0, 0, 19),
('farmer2', 8, 'admin', 0, 0, 19),
('farmer2', 8, 'admin', 0, 0, 19),
('farmer2', 8, 'admin', 0, 0, 6),
('farmer2', 8, 'admin', 0, 0, 6),
('farmer2', 8, 'admin', 0, 0, 1),
('farmer1', 9, 'admin', 0, 0, 99),
('farmer1', 10, 'admin', 0, 0, 30),
('farmer1', 10, 'admin', 0, 0, 9),
('farmer1', 10, 'admin', 0, 0, 9),
('farmer1', 9, 'admin', 0, 0, 60),
('farmer1', 9, 'admin', 0, 0, 8),
('farmer10', 10, 'admin', 0, 0, 12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employer`
--
ALTER TABLE `employer`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `farmer`
--
ALTER TABLE `farmer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `farm_input`
--
ALTER TABLE `farm_input`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `farm_output`
--
ALTER TABLE `farm_output`
  ADD PRIMARY KEY (`offer_id`);

--
-- Indexes for table `market_request`
--
ALTER TABLE `market_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `msgs`
--
ALTER TABLE `msgs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `postcontent`
--
ALTER TABLE `postcontent`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `farmer`
--
ALTER TABLE `farmer`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `farm_input`
--
ALTER TABLE `farm_input`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `farm_output`
--
ALTER TABLE `farm_output`
  MODIFY `offer_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `market_request`
--
ALTER TABLE `market_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `msgs`
--
ALTER TABLE `msgs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `postcontent`
--
ALTER TABLE `postcontent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
