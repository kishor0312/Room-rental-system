-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2024 at 03:00 AM
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `u_name` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `u_name`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `landlord_record`
--

CREATE TABLE `landlord_record` (
  `ID` int(10) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `image` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `landlord_record`
--

INSERT INTO `landlord_record` (`ID`, `fname`, `lname`, `email`, `phone`, `image`) VALUES
(2, 'kushal', 'diyali', 'kushaldiyali@gmail.c', '9814311191', 'WIN_20220324_16_21_23_Pro.jpg'),
(3, 'prem', 'kathyat', 'prem@gmail.com', '9811111111', 'WIN_20240327_13_20_39_Pro.jpg'),
(4, 'kishor', 'diyali', 'kishordiyali3@gmail.', '9811340312', 'room 1.jpg');

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
  `bathroom` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prop_detail`
--

INSERT INTO `prop_detail` (`prod_id`, `title`, `type`, `price`, `location`, `image`, `area`, `bedroom`, `bathroom`) VALUES
(37, 'house available', 'house', '1000000', 'balkot', 'room 2.jpg', 500, 5, 2),
(38, 'single room new peoosicola', 'room', '8000', 'pessicola', 'room 4.jpg', 250, 1, 1),
(39, 'hostel rooms', 'hostel room', '100000', 'naneswor', 'room 5.jpg', 3, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `full_name` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `phone_number` int(10) NOT NULL,
  `password` varchar(20) NOT NULL,
  `repeat_password` varchar(20) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `full_name`, `email`, `phone_number`, `password`, `repeat_password`, `role`) VALUES
(1, 'prem', 'prem@gmail.com', 981431119, 'prem@123', 'prem@123', ''),
(2, '', 'kishor@gmail.com', 0, 'kishor@123', '', ''),
(4, 'manish diyali', 'manish@gmail.com', 2147483647, 'manish', 'manish', 'landlord'),
(5, 'jivan', 'jivan@gmail.com', 2147483647, 'jivan', 'jivan', 'tenant'),
(6, 'kishor bk', 'kishordiyali3@gmail.', 2147483647, 'jjk', 'kjkk', 'landlord');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `landlord_record`
--
ALTER TABLE `landlord_record`
  ADD PRIMARY KEY (`ID`,`email`);

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
-- AUTO_INCREMENT for table `landlord_record`
--
ALTER TABLE `landlord_record`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `prop_detail`
--
ALTER TABLE `prop_detail`
  MODIFY `prod_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
