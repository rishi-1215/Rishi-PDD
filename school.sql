-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2025 at 07:58 AM
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
-- Database: `school`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `id` int(11) NOT NULL,
  `candidate_name` varchar(255) NOT NULL,
  `candidate_symbol` varchar(255) NOT NULL,
  `position` enum('headboy','headgirl','sportshead','culturalshead') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `votes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`id`, `candidate_name`, `candidate_symbol`, `position`, `created_at`, `votes`) VALUES
(33, 'Ritu', './uploads/bus.png', 'headgirl', '2024-11-26 15:35:31', 10),
(34, 'sonu', './uploads/car.jpg', 'headgirl', '2024-11-26 15:36:00', 8),
(35, 'pooja', './uploads/fan.jpg', 'headgirl', '2024-11-26 15:36:52', 2),
(38, 'Joseph', './uploads/horse.jpg', 'culturalshead', '2024-11-26 15:38:56', 6),
(39, 'Rakesh', './uploads/deer.jpg', 'culturalshead', '2024-11-26 15:39:22', 6),
(40, 'Roshik', './uploads/spectacles.jpg', 'headboy', '2024-11-26 15:48:11', 7),
(43, 'Ishaan', './uploads/football.jpg', 'sportshead', '2024-11-26 15:55:55', 2),
(44, 'Vijay', './uploads/sports.jpg', 'sportshead', '2024-11-26 15:59:37', 9),
(45, 'Vamsi', './uploads/Screenshot 2024-11-13 105532.png', 'headboy', '2024-11-27 04:23:51', 11),
(46, 'Keerthi', './uploads/Screenshot 2024-11-13 105523.png', 'sportshead', '2024-11-27 04:25:13', 8),
(47, 'Rithika', './uploads/Screenshot 2024-11-14 094139.png', 'culturalshead', '2024-11-27 04:28:06', 5),
(49, 'ben', './uploads/football.jpg', 'headboy', '2024-12-24 05:47:56', 3);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `message`, `submitted_at`) VALUES
(2, 'sandy', 'sdwndn@gmail.com', 'good', '2024-12-16 10:29:35'),
(8, 'sai', 'sai12@gmail.com', 'good !', '2024-12-24 04:04:17'),
(9, 'kiran', 'kiran@gmail.com', 'excellent ', '2024-12-29 07:22:01'),
(12, 'nick', 'nick@gmail.com', 'good', '2024-12-29 08:02:56'),
(13, 'jordan', 'jordan@gmail.com', 'good', '2024-12-29 08:03:32');

-- --------------------------------------------------------

--
-- Table structure for table `culturalshead`
--

CREATE TABLE `culturalshead` (
  `id` int(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `symbol_path` varchar(255) NOT NULL,
  `votes` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `headboy`
--

CREATE TABLE `headboy` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `symbol_path` varchar(255) NOT NULL,
  `votes` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `headboy`
--

INSERT INTO `headboy` (`id`, `name`, `symbol_path`, `votes`) VALUES
(1, 'Hari', 'images/symbol_flag.png', 0),
(2, 'Roshik', 'images/symbol_torch.png', 0),
(3, 'Hemu', 'images/symbol_bow_arrow.png', 0),
(4, 'Raj', 'images/symbol_bicycle.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `headgirl`
--

CREATE TABLE `headgirl` (
  `id` int(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `symbol_path` varchar(50) NOT NULL,
  `votes` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `id` int(11) NOT NULL,
  `position_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sportshead`
--

CREATE TABLE `sportshead` (
  `id` int(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `symbol_path` varchar(255) NOT NULL,
  `votes` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `register_number` int(255) NOT NULL,
  `createdon` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usertype` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `mobile`, `register_number`, `createdon`, `usertype`) VALUES
(3, 'rishikumar', '123', '1234567890', 0, '2024-11-13 04:21:35', '2'),
(9, 'admin', 'admin', '9949447358', 0, '2024-11-13 04:33:21', '1'),
(10, 'rishikumar', '123', '', 0, '2024-11-13 04:41:38', '2'),
(12, 'roshi', '123', '1234567890', 0, '2024-11-13 05:09:47', '2'),
(15, 'roshi', '123', '', 0, '2024-11-28 03:11:07', '2'),
(17, 'rishi', '123', '9326874899', 0, '2024-12-28 09:26:09', '2'),
(18, 'kiran', '123', '9454554552', 0, '2024-12-29 06:59:38', '2'),
(19, 'sam', '123', '9874561230', 0, '2025-01-03 05:25:27', '2');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `candidate_name` varchar(255) DEFAULT NULL,
  `candidate_position` varchar(255) DEFAULT NULL,
  `votes` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `culturalshead`
--
ALTER TABLE `culturalshead`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `headboy`
--
ALTER TABLE `headboy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `headgirl`
--
ALTER TABLE `headgirl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sportshead`
--
ALTER TABLE `sportshead`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `culturalshead`
--
ALTER TABLE `culturalshead`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `headboy`
--
ALTER TABLE `headboy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `headgirl`
--
ALTER TABLE `headgirl`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sportshead`
--
ALTER TABLE `sportshead`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
