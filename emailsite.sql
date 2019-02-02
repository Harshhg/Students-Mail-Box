-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2018 at 03:32 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `emailsite`
--

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE `email` (
  `id` int(11) NOT NULL,
  `sender` varchar(50) NOT NULL,
  `receiver` varchar(50) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` varchar(10000) NOT NULL,
  `sendername` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `stream` varchar(10) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `groupmail` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email`
--

INSERT INTO `email` (`id`, `sender`, `receiver`, `subject`, `message`, `sendername`, `department`, `stream`, `semester`, `groupmail`) VALUES
(14, 'vipin@gmail.com', 'myfolder.pc@gmail.com', 'DEAR STUDENTS', 'Hello Students GROUP MAIL', 'Dr. Vipin Jain', 'Faculty CS', 'cs', 'X', 1),
(15, 'vipin@gmail.com', 'ankit@gmail.com', 'DEAR STUDENTS', 'Hello Students GROUP MAIL', 'Dr. Vipin Jain', 'Faculty CS', 'cs', 'X', 1);

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `Name` varchar(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `DOB` varchar(10) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `Stream` varchar(10) NOT NULL,
  `Department` varchar(20) NOT NULL,
  `Semester` varchar(10) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`Name`, `Email`, `Password`, `DOB`, `Gender`, `Stream`, `Department`, `Semester`, `id`) VALUES
('Harsh Gupta', 'myfolder.pc@gmail.com', '12345', '10-11-1998', 'male', 'cs', 'MCA', 'III', 1),
('Dr. Vipin Jain', 'vipin@gmail.com', '12345', '10-11-1962', 'male', 'cs', 'Faculty CS', 'X', 6),
('Kshetrapal Singh', 'kp@gmail.com', '12345', '11-05-1997', 'male', 'cs', 'MCA', 'III', 7),
('Ankit Bansal', 'ankit@gmail.com', '12345', '14-01-1997', 'male', 'cs', 'MCA', 'III', 8),
('Dhruv Saxena', 'dhruv@gmail.com', '12345', '13-04-1997', 'male', 'cs', 'MCA', 'III', 9),
('Akshay Bharti', 'akshay@gmail.com', '12345', '01-07-1996', 'male', 'cs', 'BCA', 'V', 10),
('Harshit Sharma', 'harshit@gmail.com', '12345', '13-02-1996', 'male', 'cs', 'BCA', 'V', 11);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `email`
--
ALTER TABLE `email`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `email`
--
ALTER TABLE `email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
