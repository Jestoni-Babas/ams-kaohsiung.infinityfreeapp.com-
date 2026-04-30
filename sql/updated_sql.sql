-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2026 at 06:08 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ams`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance_logs`
--

CREATE TABLE `attendance_logs` (
  `id` int(11) NOT NULL,
  `church_id` varchar(40) NOT NULL,
  `gathering_type` varchar(50) NOT NULL,
  `time_in` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance_logs`
--

INSERT INTO `attendance_logs` (`id`, `church_id`, `gathering_type`, `time_in`) VALUES
(1, '11217691', 'Thanksgiving (Regular)', '2026-04-28 03:57:25'),
(2, '11217692', 'Thanksgiving (Regular)', '2026-04-28 03:57:39'),
(3, '11217692', 'Thanksgiving (Regular)', '2026-04-28 03:58:22'),
(4, '11217691', 'Thanksgiving (Regular)', '2026-04-28 03:58:31'),
(5, '11217691', 'Thanksgiving (Regular)', '2026-04-28 04:00:33'),
(6, '11217692', 'Thanksgiving (Regular)', '2026-04-28 04:00:39');

-- --------------------------------------------------------

--
-- Table structure for table `gatherings`
--

CREATE TABLE `gatherings` (
  `id` int(11) NOT NULL,
  `gathering_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gatherings`
--

INSERT INTO `gatherings` (`id`, `gathering_name`) VALUES
(1, 'Thanksgiving (Regular)'),
(2, 'SPBB DAY 1'),
(3, 'SPBB DAY 2'),
(4, 'SPBB DAY 3'),
(5, 'The Lord Supper'),
(6, 'Christian New Year'),
(7, 'Worship Service'),
(8, 'Combined PM & WS'),
(9, 'Prayer Meeting');

-- --------------------------------------------------------

--
-- Table structure for table `locale`
--

CREATE TABLE `locale` (
  `id` int(11) NOT NULL,
  `locale_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `locale`
--

INSERT INTO `locale` (`id`, `locale_name`) VALUES
(1, 'TAICHUNG'),
(2, 'TAINAN'),
(3, 'KAOHSIUNG'),
(4, 'ZHUBEI'),
(5, 'ZHONGLI'),
(6, 'TAIPEI');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(11) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `church_id` varchar(50) NOT NULL,
  `locale` varchar(50) NOT NULL,
  `picture` varchar(60) NOT NULL,
  `dob` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `lname`, `fname`, `mname`, `church_id`, `locale`, `picture`, `dob`) VALUES
(1, 'Babas', 'Jestoni', 'De ocampo', '11217692', 'KAOHSIUNG', '69f02f83f3e45.png', '2012-11-16'),
(2, 'Peralta', 'Jhone Paul', 'Cabanglan', '11217691', 'TAICHUNG', '69f02fa679766.jpg', '2026-04-02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `email` varchar(70) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'Jestoni De ocampo Babas', 'admin@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$VzBwcDBhT2w0dk8wMmpmSw$fhrWTSEnb5KImrgFXoH3FllsTDEvOKvgag9Wvl9GBm0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance_logs`
--
ALTER TABLE `attendance_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gatherings`
--
ALTER TABLE `gatherings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locale`
--
ALTER TABLE `locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance_logs`
--
ALTER TABLE `attendance_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `gatherings`
--
ALTER TABLE `gatherings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `locale`
--
ALTER TABLE `locale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
