-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2025 at 01:51 PM
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
-- Database: `dbschool`
--

-- --------------------------------------------------------

--
-- Table structure for table `dbschool`
--

CREATE TABLE `dbschool` (
  `id` int(11) NOT NULL,
  `names` varchar(191) NOT NULL,
  `lastname` varchar(191) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `confirmpass` varchar(255) NOT NULL,
  `usertype` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dbschool`
--

INSERT INTO `dbschool` (`id`, `names`, `lastname`, `email`, `pass`, `confirmpass`, `usertype`, `created_at`) VALUES
(1, 'daniela', 'dela cruz', 'anthonydelac1602@gmail.com', '12345678', '12345678', 0, '2025-11-30 08:56:29'),
(2, 'dan', 'dela cruz', 'dan@gmail.com', '123456789', '123456789', 1, '2025-11-30 08:57:35'),
(3, 'mark boss', 'mark@gmail.com', 'mark@gmail.com', '12345678', '12345678', 1, '2025-11-30 09:08:06'),
(4, 'gusion', 'dela cruz', 'gus@gmail.com', '1234567', '1234567', 1, '2025-11-30 09:15:33'),
(5, 'daniela', 'dela cruz', 'dann@gmail.com', '123456', '123456', 1, '2025-12-02 10:28:50'),
(6, 'danjiii', 'dela cruz', 'danji@gmail.com', '123456', '123456', 0, '2025-12-02 10:29:55'),
(7, 'jade ahahhahah', 'dela cruz', 'jade@gmail.com', '123456', '123456', 1, '2025-12-04 10:18:41'),
(9, 'danielanthony', 'dela cruz', 'danski@gmail.com', '123456', '123456', 1, '2025-12-04 11:28:31'),
(10, 'markmendoza', 'kupals', 'markz@gmail.com', '123456', '123456', 1, '2025-12-04 11:39:54'),
(11, 'nana', 'haha', 'nana@gmail.com', '123456', '123456', 1, '2025-12-04 12:18:39'),
(12, 'danjix', 'dela cruz', 'danjix@gmail.com', '123456', '123456', 1, '2025-12-04 12:37:05'),
(13, 'danielaaa', 'delacruzzz', 'anthonydelac@gmail.com', '123456', '123456', 1, '2025-12-08 06:45:39'),
(14, 'mark boss22', 'sssss', 'mark2@gmail.com', '123456', '123456', 0, '2025-12-08 06:48:36'),
(15, 'dan11', 'dela cruz', 'gus11@gmail.s', '$2y$10$rPhv9zorOEh3tSOj8.tNsuSjnmrAfZGu1XhjbCp/vxlWuRZasgHX2', '', 0, '2025-12-08 07:20:19'),
(17, 'Daniel Anthony', 'Dela Cruz', 'danjix1@gmail.com', '123456', '123456', 1, '2025-12-08 07:25:51'),
(18, 'sam', 'jandel', 'sam@gmail.com', '123456', '123456', 0, '2025-12-08 07:27:50'),
(19, 'daniela', 'dadadad', 'anthonydelac02@gmail.com', '123456', '123456', 1, '2025-12-10 07:40:53'),
(20, 'admistrator', 'admin', 'admin@gmail.com', '123456', '123456', 1, '2025-12-10 21:26:23');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `password` int(255) NOT NULL,
  `confirmpassword` int(255) NOT NULL,
  `role` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dbschool`
--
ALTER TABLE `dbschool`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dbschool`
--
ALTER TABLE `dbschool`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
