-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2024 at 07:40 PM
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
-- Database: `db_afnaams`
--

-- --------------------------------------------------------

--
-- Table structure for table `non_academic_awards`
--

CREATE TABLE `non_academic_awards` (
  `id` int(11) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `department` varchar(255) NOT NULL,
  `program` varchar(255) NOT NULL,
  `complete_address` varchar(255) DEFAULT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `campus_service_award` enum('1','0') NOT NULL,
  `department_service_award` enum('1','0') NOT NULL,
  `community_service_award` enum('1','0') NOT NULL,
  `accomplishments` text DEFAULT NULL,
  `organized_by` varchar(255) DEFAULT NULL,
  `inclusive_dates` date DEFAULT NULL,
  `venue` varchar(255) DEFAULT NULL,
  `campus_ministry_award` enum('1','0') NOT NULL,
  `what_ministry` varchar(255) DEFAULT NULL,
  `inclusive_years_ministry` varchar(255) DEFAULT NULL,
  `campus_leadership_award` enum('1','0') NOT NULL,
  `department_leadership_award` enum('1','0') NOT NULL,
  `community_leadership_award` enum('1','0') NOT NULL,
  `position` varchar(255) DEFAULT NULL,
  `organization` varchar(255) DEFAULT NULL,
  `inclusive_years_organization` varchar(255) DEFAULT NULL,
  `campus_ministry_leadership_award` enum('1','0') NOT NULL,
  `what_ministry_leadership` varchar(255) DEFAULT NULL,
  `position_ministry_leadership` varchar(255) DEFAULT NULL,
  `inclusive_years_ministry_leadership` varchar(255) DEFAULT NULL,
  `graphic_arts_award` enum('1','0') NOT NULL,
  `performing_arts_award` enum('1','0') NOT NULL,
  `cultural_accomplishments` text DEFAULT NULL,
  `cultural_organized_by` varchar(255) DEFAULT NULL,
  `cultural_inclusive_dates` date DEFAULT NULL,
  `cultural_venue` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0= Unverified, 1= Verified',
  `attachment` varchar(255) DEFAULT NULL,
  `clarify` enum('Agree','Disagree') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `non_academic_awards`
--

INSERT INTO `non_academic_awards` (`id`, `last_name`, `first_name`, `middle_name`, `department`, `program`, `complete_address`, `gender`, `campus_service_award`, `department_service_award`, `community_service_award`, `accomplishments`, `organized_by`, `inclusive_dates`, `venue`, `campus_ministry_award`, `what_ministry`, `inclusive_years_ministry`, `campus_leadership_award`, `department_leadership_award`, `community_leadership_award`, `position`, `organization`, `inclusive_years_organization`, `campus_ministry_leadership_award`, `what_ministry_leadership`, `position_ministry_leadership`, `inclusive_years_ministry_leadership`, `graphic_arts_award`, `performing_arts_award`, `cultural_accomplishments`, `cultural_organized_by`, `cultural_inclusive_dates`, `cultural_venue`, `created_at`, `status`, `attachment`, `clarify`) VALUES
(1, 'Salud', 'Diana', 'NA', 'CICS', 'BSIT', 'SAN ISIDRO', 'Female', '0', '0', '0', 'NA', 'NA', '2024-05-01', 'NA', '0', 'lectors', 'NA', '1', '1', '1', 'NA', 'NA', 'NA', '0', 'music', 'NA', 'NA', '0', '0', 'NA', 'NA', '2024-05-07', 'NA', '2024-05-07 13:33:44', 1, NULL, 'Agree'),
(2, 'Salud', 'Diana', 'sample', 'CASTE', 'a', 'a', 'Female', '1', '0', '1', 'a', 'a', '2024-05-14', 'NA', '0', 'music', 'a', '1', '1', '0', 'a', 'a', 'a', '1', 'music', 'a', 'a', '0', '0', 'a', 'a', '2024-05-14', 'a', '2024-05-14 12:09:25', 0, '1715668695401.jpg', 'Agree');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(30) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `middlename` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(250) NOT NULL,
  `avatar` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `birthday` varchar(100) DEFAULT NULL,
  `age` int(11) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `firstname`, `middlename`, `lastname`, `gender`, `email`, `avatar`, `status`, `birthday`, `age`, `address`) VALUES
(19, 'Diana', '', 'Salud', '', 'diana@sjcbi.edu.ph', '', 1, NULL, 0, ''),
(20, 'Jovelyn', '', 'Bendoy', '', 'jovelyn@sjcbi.edu.ph', '', 1, NULL, 0, ''),
(21, 'Dayvie', '', 'Ramos', '', 'dayvie@sjcbi.edu.ph', '', 1, NULL, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '1=admin, 2=students',
  `students_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `type`, `students_id`) VALUES
(1, 'Admin', 'admin', '0192023a7bbd73250516f069df18b500', 1, 0),
(20, 'Diana Salud', 'diana@sjcbi.edu.ph', 'ca7669cfc26196d72f7d5297cf1bc606', 2, 19),
(21, 'Jovelyn Bendoy', 'jovelyn@sjcbi.edu.ph', 'beb1884e62787fc41d904780c9544fa5', 2, 20),
(22, 'Dayvie Ramos', 'dayvie@sjcbi.edu.ph', '076680c2f3b1f26328df0a1d627a2024', 2, 21);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `non_academic_awards`
--
ALTER TABLE `non_academic_awards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
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
-- AUTO_INCREMENT for table `non_academic_awards`
--
ALTER TABLE `non_academic_awards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
