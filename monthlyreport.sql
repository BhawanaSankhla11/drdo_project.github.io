-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2023 at 12:49 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `monthlyreport`
--

-- --------------------------------------------------------

--
-- Table structure for table `control10`
--

CREATE TABLE `control10` (
  `userid` varchar(255) NOT NULL,
  `count` int(100) NOT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `filled_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `control10`
--

INSERT INTO `control10` (`userid`, `count`, `remarks`, `filled_at`) VALUES
('abc@example.com', 1, 'remark', '2023-07-11 15:17:12');

-- --------------------------------------------------------

--
-- Table structure for table `securitycontrol`
--

CREATE TABLE `securitycontrol` (
  `userid` varchar(255) NOT NULL,
  `control` int(25) NOT NULL,
  `compliance` varchar(255) NOT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `filled_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `securitycontrol`
--

INSERT INTO `securitycontrol` (`userid`, `control`, `compliance`, `remark`, `filled_at`) VALUES
('abc@example.com', 1, 'yes', '', '2023-07-11 11:27:30'),
('abc@example.com', 2, 'yes', '', '2023-07-11 11:27:30'),
('abc@example.com', 3, 'no', '', '2023-07-11 11:27:30'),
('abc@example.com', 4, 'no', '', '2023-07-11 11:27:30'),
('abc@example.com', 5, 'no', '', '2023-07-11 11:27:30'),
('abc@example.com', 6, 'no', 'Applicable', '2023-07-11 11:27:30'),
('abc@example.com', 7, 'no', '', '2023-07-11 11:27:30'),
('abc@example.com', 8, 'no', '', '2023-07-11 11:27:30'),
('abc@example.com', 9, 'no', '', '2023-07-11 11:27:30'),
('abc@example.com', 10, 'yes', '', '2023-07-11 11:27:30'),
('bhawanasankhla02@gmail.com', 1, 'no', '', '2023-07-10 18:56:12'),
('bhawanasankhla02@gmail.com', 2, 'no', '', '2023-07-10 18:56:12'),
('bhawanasankhla02@gmail.com', 3, 'no', '', '2023-07-10 18:56:12'),
('bhawanasankhla02@gmail.com', 4, 'no', '', '2023-07-10 18:56:12'),
('bhawanasankhla02@gmail.com', 5, 'no', '', '2023-07-10 18:56:12'),
('bhawanasankhla02@gmail.com', 6, 'no', 'Applicable', '2023-07-10 18:56:12'),
('bhawanasankhla02@gmail.com', 7, 'no', '', '2023-07-10 18:56:12'),
('bhawanasankhla02@gmail.com', 8, 'no', '', '2023-07-10 18:56:12'),
('bhawanasankhla02@gmail.com', 9, 'no', '', '2023-07-10 18:56:12'),
('bhawanasankhla02@gmail.com', 10, 'yes', '', '2023-07-10 18:56:12');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(30) NOT NULL,
  `rank` varchar(30) NOT NULL,
  `groupname` varchar(30) NOT NULL,
  `oicname` varchar(30) NOT NULL,
  `oicdesign` varchar(30) NOT NULL,
  `admin` varchar(25) NOT NULL,
  `filled_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `password`, `name`, `rank`, `groupname`, `oicname`, `oicdesign`, `admin`, `filled_at`) VALUES
('abc@example.com', '$2y$10$qZU13/V4adPj2mGdf0gL5OrL8pZTFWDqdV4WVVP18igCCfMGDez/i', 'a', 'a', 'a', 'a', 'a', 'no', '2023-07-11 11:26:41'),
('bhawanasankhla02@gmail.com', '$2y$10$FQtsySyfa1dblPVUCJMjmeL3fIHV5SEWmv/P6lu7naRdqqL3Bi1RW', 'Bhawana Sankhla', 'rank', 'group', 'oic', 'oic', 'no', '2023-07-10 18:54:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `control10`
--
ALTER TABLE `control10`
  ADD PRIMARY KEY (`filled_at`,`count`);

--
-- Indexes for table `securitycontrol`
--
ALTER TABLE `securitycontrol`
  ADD PRIMARY KEY (`userid`,`control`,`filled_at`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
