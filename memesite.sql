-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 21, 2022 at 03:04 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `memesite`
--

-- --------------------------------------------------------

--
-- Table structure for table `Registered_Users`
--

CREATE TABLE `Registered_Users` (
  `USER_ID` int(11) NOT NULL,
  `FIRST_NAME` varchar(50) NOT NULL,
  `LAST_NAME` varchar(50) NOT NULL,
  `USER_NAME` varchar(50) NOT NULL,
  `EMAIL` text NOT NULL,
  `PASSWORD` text NOT NULL,
  `GENDER` varchar(20) NOT NULL,
  `BIRTHDAY` date NOT NULL,
  `PROFILE_PIC` text NOT NULL,
  `BIO` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Registered_Users`
--

INSERT INTO `Registered_Users` (`USER_ID`, `FIRST_NAME`, `LAST_NAME`, `USER_NAME`, `EMAIL`, `PASSWORD`, `GENDER`, `BIRTHDAY`, `PROFILE_PIC`, `BIO`) VALUES
(1, 'Algilbert', 'Gomez', 'AlgilbertGomez123', 'emailniAlgilbert@email.com', 'password', 'Male', '2002-08-20', 'user_1669038901.jpg', ''),
(2, 'Juan', 'Dela Cruz', 'JuanDC', 'emailniJuan@email.com', 'juan', 'Male', '2006-08-09', 'user_1669039421.jpg', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Registered_Users`
--
ALTER TABLE `Registered_Users`
  ADD PRIMARY KEY (`USER_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Registered_Users`
--
ALTER TABLE `Registered_Users`
  MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
