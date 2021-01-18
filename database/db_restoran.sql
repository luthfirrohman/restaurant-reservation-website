-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2021 at 03:36 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_restoran`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_resto`
--

CREATE TABLE `admin_resto` (
  `employee_id` int(11) NOT NULL,
  `employee_username` varchar(50) NOT NULL,
  `employee_password` varchar(50) NOT NULL,
  `employee_access` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_resto`
--

INSERT INTO `admin_resto` (`employee_id`, `employee_username`, `employee_password`, `employee_access`) VALUES
(1001, 'admin', '123', 'denied'),
(1002, 'luthfi', 'luthfi123', 'denied'),
(1003, 'naufal', 'naufal123', 'denied'),
(1004, 'adam', 'adam123', 'denied');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `book_id` int(11) NOT NULL,
  `book_nama` varchar(50) NOT NULL,
  `book_alamat` varchar(100) NOT NULL,
  `book_phone` varchar(15) NOT NULL,
  `book_tanggal` varchar(20) NOT NULL,
  `book_jam` varchar(20) NOT NULL,
  `book_kursi` varchar(100) NOT NULL,
  `book_timestamp` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`book_id`, `book_nama`, `book_alamat`, `book_phone`, `book_tanggal`, `book_jam`, `book_kursi`, `book_timestamp`) VALUES
(1003, 'Naufal', 'Medokan Asri 3', '081764852896', '2021-01-13', '20:00', '2', '10-01-2021 16:17:46'),
(1004, 'Mas Adam KH', 'Rungkut Asri', '081732467543271', '2021-01-22', '20:00', '4', '14-01-2021 03:07:36');

-- --------------------------------------------------------

--
-- Table structure for table `datamail`
--

CREATE TABLE `datamail` (
  `mail_id` int(11) NOT NULL,
  `mail_name` varchar(50) NOT NULL,
  `mail_email` varchar(50) NOT NULL,
  `mail_phone` varchar(20) NOT NULL,
  `mail_category` varchar(20) NOT NULL,
  `mail_message` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `datamail`
--

INSERT INTO `datamail` (`mail_id`, `mail_name`, `mail_email`, `mail_phone`, `mail_category`, `mail_message`) VALUES
(4, 'Muhammad Luthfirrohman', 'luthfiroh200@gmail.com', '081703182874', 'question', 'Halo'),
(5, 'Mas Adam', 'masadam@gmail.com', '082139784521', 'complaint', 'Overcook'),
(6, 'Muhammad Luthfirrohman', 'luthfiroh200@gmail.com', '081703182874', 'question', 'Bagaimana cara reservasi 1 restoran ???');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_resto`
--
ALTER TABLE `admin_resto`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `datamail`
--
ALTER TABLE `datamail`
  ADD PRIMARY KEY (`mail_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_resto`
--
ALTER TABLE `admin_resto`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1005;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1005;

--
-- AUTO_INCREMENT for table `datamail`
--
ALTER TABLE `datamail`
  MODIFY `mail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
