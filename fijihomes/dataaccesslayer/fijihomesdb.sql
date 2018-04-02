-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2018 at 04:32 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fijihomesdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `access`
--

CREATE TABLE `access` (
  `Email` varchar(50) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Status` varchar(10) NOT NULL,
  `Type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `allocation`
--

CREATE TABLE `allocation` (
  `A_ID` int(11) NOT NULL,
  `Employee_ID` int(11) NOT NULL,
  `Owner_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `apartments`
--

CREATE TABLE `apartments` (
  `Plot` int(11) NOT NULL,
  `P_Address` varchar(50) NOT NULL,
  `Rooms` int(2) NOT NULL,
  `Max_People` int(2) NOT NULL,
  `Amenities` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `Employee_ID` int(11) NOT NULL,
  `E_Name` varchar(50) NOT NULL,
  `E_Position` varchar(50) NOT NULL,
  `E_Contact` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `genuine`
--

CREATE TABLE `genuine` (
  `G_ID` varchar(10) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Acc_Type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE `owner` (
  `Owner_ID` int(11) NOT NULL,
  `G_ID` varchar(10) NOT NULL,
  `Plot` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tenant`
--

CREATE TABLE `tenant` (
  `Tenant_ID` int(11) NOT NULL,
  `G_ID` varchar(10) NOT NULL,
  `T_Password` varchar(50) NOT NULL,
  `T_Contact` int(11) NOT NULL,
  `Plot` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access`
--
ALTER TABLE `access`
  ADD PRIMARY KEY (`Email`),
  ADD UNIQUE KEY `User_Email` (`Email`);

--
-- Indexes for table `allocation`
--
ALTER TABLE `allocation`
  ADD PRIMARY KEY (`A_ID`),
  ADD KEY `Owner_ID` (`Owner_ID`),
  ADD KEY `Employee_ID` (`Employee_ID`);

--
-- Indexes for table `apartments`
--
ALTER TABLE `apartments`
  ADD PRIMARY KEY (`Plot`),
  ADD KEY `Plot` (`Plot`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`Employee_ID`);

--
-- Indexes for table `genuine`
--
ALTER TABLE `genuine`
  ADD PRIMARY KEY (`G_ID`),
  ADD KEY `Email` (`Email`);

--
-- Indexes for table `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`Owner_ID`),
  ADD KEY `Email` (`G_ID`),
  ADD KEY `Plot` (`Plot`),
  ADD KEY `G_ID` (`G_ID`);

--
-- Indexes for table `tenant`
--
ALTER TABLE `tenant`
  ADD PRIMARY KEY (`Tenant_ID`),
  ADD KEY `Plot` (`Plot`),
  ADD KEY `T_Email` (`G_ID`),
  ADD KEY `G_ID` (`G_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apartments`
--
ALTER TABLE `apartments`
  MODIFY `Plot` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `owner`
--
ALTER TABLE `owner`
  MODIFY `Owner_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `allocation`
--
ALTER TABLE `allocation`
  ADD CONSTRAINT `allocation_ibfk_1` FOREIGN KEY (`Owner_ID`) REFERENCES `owner` (`Owner_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `allocation_ibfk_2` FOREIGN KEY (`Owner_ID`) REFERENCES `owner` (`Owner_ID`),
  ADD CONSTRAINT `allocation_ibfk_3` FOREIGN KEY (`Employee_ID`) REFERENCES `employee` (`Employee_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `genuine`
--
ALTER TABLE `genuine`
  ADD CONSTRAINT `genuine_ibfk_1` FOREIGN KEY (`Email`) REFERENCES `access` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `owner`
--
ALTER TABLE `owner`
  ADD CONSTRAINT `owner_ibfk_2` FOREIGN KEY (`Plot`) REFERENCES `apartments` (`Plot`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `owner_ibfk_3` FOREIGN KEY (`G_ID`) REFERENCES `genuine` (`G_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tenant`
--
ALTER TABLE `tenant`
  ADD CONSTRAINT `tenant_ibfk_2` FOREIGN KEY (`Plot`) REFERENCES `apartments` (`Plot`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tenant_ibfk_3` FOREIGN KEY (`G_ID`) REFERENCES `genuine` (`G_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
