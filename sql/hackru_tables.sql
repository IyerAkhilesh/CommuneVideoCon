-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2020 at 12:57 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hackru`
--

-- --------------------------------------------------------

--
-- Table structure for table `common_data`
--

CREATE TABLE `common_data` (
  `lecture_id` int(11) NOT NULL,
  `lecture_name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `presentation` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discussion` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `videos` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group_assignment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_list`
--

CREATE TABLE `course_list` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `professor` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_data_lecture`
--

CREATE TABLE `personal_data_lecture` (
  `pdata_id` int(11) NOT NULL,
  `lecture_name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_id` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `screens` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_trails` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `student_assignment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students_courses`
--

CREATE TABLE `students_courses` (
  `id` int(11) NOT NULL,
  `student_id` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grade` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_list`
--

CREATE TABLE `student_list` (
  `student_number` int(11) NOT NULL,
  `student_id` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `common_data`
--
ALTER TABLE `common_data`
  ADD PRIMARY KEY (`lecture_id`);

--
-- Indexes for table `course_list`
--
ALTER TABLE `course_list`
  ADD PRIMARY KEY (`course_id`),
  ADD UNIQUE KEY `course_id` (`course_id`,`professor`),
  ADD UNIQUE KEY `course_name` (`course_name`);

--
-- Indexes for table `personal_data_lecture`
--
ALTER TABLE `personal_data_lecture`
  ADD PRIMARY KEY (`pdata_id`);

--
-- Indexes for table `students_courses`
--
ALTER TABLE `students_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_list`
--
ALTER TABLE `student_list`
  ADD PRIMARY KEY (`student_number`),
  ADD UNIQUE KEY `student_number` (`student_number`,`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `common_data`
--
ALTER TABLE `common_data`
  MODIFY `lecture_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_list`
--
ALTER TABLE `course_list`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_data_lecture`
--
ALTER TABLE `personal_data_lecture`
  MODIFY `pdata_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students_courses`
--
ALTER TABLE `students_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_list`
--
ALTER TABLE `student_list`
  MODIFY `student_number` int(11) NOT NULL AUTO_INCREMENT;

--
-- Adding the 'code' field to table `personal_data_structure`
--

ALTER TABLE `commune.personal_data_lecture`
  ADD `code` text NOT NULL;


--
-- Changing the primary key of table `student_list` from `student_number` to `student_id`
--

ALTER TABLE `commune.student_list` 
  DROP PRIMARY KEY, ADD PRIMARY KEY(`student_id`);
  
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;