-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2025 at 04:36 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saharighar`
--

-- --------------------------------------------------------

--
-- Table structure for table `added_by`
--

CREATE TABLE `added_by` (
  `prod_id` int(10) NOT NULL,
  `owner_id` int(10) NOT NULL,
  `owner_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `added_by`
--

INSERT INTO `added_by` (`prod_id`, `owner_id`, `owner_type`) VALUES
(81, 1, 'admin'),
(82, 1, 'admin'),
(84, 1, 'admin'),
(85, 18, 'landlord'),
(86, 18, 'landlord'),
(89, 1, 'admin'),
(91, 18, 'landlord'),
(92, 1, 'admin'),
(93, 18, 'landlord');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `u_name` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `u_name`, `password`, `phone`, `email`) VALUES
(1, 'admin', 'admin', '9811340312', 'admin@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `interaction_log`
--

CREATE TABLE `interaction_log` (
  `id` int(11) NOT NULL,
  `prop_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `weight` decimal(3,2) NOT NULL CHECK (`weight` >= 0 and `weight` <= 1),
  `idate` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `interaction_log`
--

INSERT INTO `interaction_log` (`id`, `prop_id`, `uid`, `weight`, `idate`) VALUES
(1, 84, 18, 0.50, '2025-08-25 07:58:39'),
(2, 82, 24, 0.50, '2025-08-31 07:39:30'),
(3, 85, 24, 0.50, '2025-08-31 07:51:50'),
(4, 89, 23, 0.50, '2025-09-04 06:49:46'),
(5, 82, 23, 0.50, '2025-09-04 06:50:06'),
(6, 81, 23, 0.50, '2025-09-04 06:54:57'),
(7, 84, 23, 0.50, '2025-09-04 09:07:19'),
(8, 92, 23, 0.50, '2025-09-04 14:34:38'),
(9, 86, 23, 0.50, '2025-09-04 14:36:28'),
(10, 91, 23, 0.90, '2025-09-04 14:36:52'),
(11, 85, 23, 0.50, '2025-09-04 14:46:31'),
(12, 82, 18, 0.50, '2025-09-04 16:26:43'),
(13, 93, 18, 0.50, '2025-09-04 16:33:53'),
(14, 93, 23, 0.90, '2025-09-04 18:51:50'),
(15, 92, 18, 0.50, '2025-09-06 11:25:12');

-- --------------------------------------------------------

--
-- Table structure for table `prop_detail`
--

CREATE TABLE `prop_detail` (
  `prod_id` int(10) NOT NULL,
  `title` varchar(30) NOT NULL,
  `type` varchar(20) NOT NULL,
  `price` varchar(20) NOT NULL,
  `location` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `area` int(20) NOT NULL,
  `bedroom` int(20) NOT NULL,
  `bathroom` int(20) NOT NULL,
  `latitude` double(10,6) NOT NULL DEFAULT 0.000000,
  `longitude` double(10,6) NOT NULL DEFAULT 0.000000
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prop_detail`
--

INSERT INTO `prop_detail` (`prod_id`, `title`, `type`, `price`, `location`, `image`, `area`, `bedroom`, `bathroom`, `latitude`, `longitude`) VALUES
(81, 'hostel room', 'hostel room', '12000', 'baneswor', 'room 1.jpg', 250, 2, 1, 0.000000, 0.000000),
(82, 'hostel room best', 'hostel room', '11000', 'new_road', 'room 5.jpg', 200, 2, 1, 0.000000, 0.000000),
(84, 'house available', 'house', '8000', 'balkot', 'nepalese-dream-home-budhanilkantha-1066.webp', 300, 3, 1, 0.000000, 0.000000),
(85, 'single room', 'room', '5000', 'lalitput', 'room 3.jpg', 200, 1, 1, 0.000000, 0.000000),
(86, 'flat in rent', 'flats & apartment', '15000', 'buspark_area', 'apartment.jpeg', 300, 3, 1, 0.000000, 0.000000),
(89, 'room in ktm', 'room', '10000', 'ktm', 'images.jpeg', 120, 3, 1, 0.000000, 0.000000),
(91, 'single room', 'room', '7000', 'koteshwor, ktm', 'room 5.jpg', 200, 1, 1, 0.000000, 0.000000),
(92, 'house available', 'house', '100000', 'chysal, lalitpur', 'images.jpeg', 300, 5, 2, 0.000000, 0.000000),
(93, 'hostel available', 'hostel room', '4000', 'baneshwor, ktm', 'room 7.jpg', 150, 2, 1, 27.698880, 85.336475);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `full_name` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `phone_number` varchar(10) NOT NULL,
  `password` varchar(20) NOT NULL,
  `repeat_password` varchar(20) NOT NULL,
  `role` varchar(10) NOT NULL,
  `landlord_address` varchar(50) NOT NULL,
  `landlordid_image` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `full_name`, `email`, `phone_number`, `password`, `repeat_password`, `role`, `landlord_address`, `landlordid_image`) VALUES
(13, 'kiran diyali', 'kiran@gmail.com', '9898542345', 'kiran', 'kiran', 'tenant', '', 'image'),
(18, 'kishor diyali', 'kishor@gmail.com', '9811340312', 'kishor', 'kishor', 'landlord', 'Barachettra 3', 'CamScanner 11-08-2021 17.16.jpg'),
(20, 'Dipa ', 'dipa@gmail.com', '9816543762', 'dipa', 'dipa', 'tenant', '', ''),
(22, 'kushal diyali', 'kushal@gmail.com', '9812345678', 'Kushal@123', 'Kushal@123', 'landlord', 'Balkot Nepal', 'CamScanner 11-08-2021 17.16.jpg'),
(23, 'aakash', 'aakash@gmail.com', '9812345678', 'Aakash@0312', 'Aakash@0312', 'tenant', '', ''),
(24, 'sunil bk', 'sunil@gmail.com', '9815119168', 'Sunil@123', 'Sunil@123', 'tenant', '', ''),
(25, '-20', 'xyz@xyz.com', '9856767676', 'Kishor@123', 'Kishor@123', 'tenant', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `added_by`
--
ALTER TABLE `added_by`
  ADD PRIMARY KEY (`prod_id`,`owner_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interaction_log`
--
ALTER TABLE `interaction_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_prop` (`prop_id`),
  ADD KEY `fk_user` (`uid`);

--
-- Indexes for table `prop_detail`
--
ALTER TABLE `prop_detail`
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`,`phone_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `interaction_log`
--
ALTER TABLE `interaction_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `prop_detail`
--
ALTER TABLE `prop_detail`
  MODIFY `prod_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `added_by`
--
ALTER TABLE `added_by`
  ADD CONSTRAINT `added_by_fk` FOREIGN KEY (`prod_id`) REFERENCES `prop_detail` (`prod_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `interaction_log`
--
ALTER TABLE `interaction_log`
  ADD CONSTRAINT `fk_prop` FOREIGN KEY (`prop_id`) REFERENCES `prop_detail` (`prod_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`uid`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
