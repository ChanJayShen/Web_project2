-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2026 at 12:27 PM
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
-- Database: `web_assgn2`
--

-- --------------------------------------------------------

--
-- Table structure for table `eoi`
--

CREATE TABLE `eoi` (
  `eoinumber` int(11) NOT NULL,
  `job_ref_num` char(5) NOT NULL,
  `f_name` varchar(20) NOT NULL,
  `l_name` varchar(20) NOT NULL,
  `date_birth` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `street_add` varchar(40) NOT NULL,
  `suburb_town` varchar(40) NOT NULL,
  `state` char(3) NOT NULL,
  `postcode` char(4) NOT NULL,
  `email` varchar(50) NOT NULL,
  `p_num` varchar(12) NOT NULL,
  `skills` varchar(200) DEFAULT NULL,
  `other_skills` text DEFAULT NULL,
  `status` enum('New','Current','Final') NOT NULL DEFAULT 'New'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eoi`
--

INSERT INTO `eoi` (`eoinumber`, `job_ref_num`, `f_name`, `l_name`, `date_birth`, `gender`, `street_add`, `suburb_town`, `state`, `postcode`, `email`, `p_num`, `skills`, `other_skills`, `status`) VALUES
(5, 'UI011', 'Dan', 'Lin', '2026-06-04', 'Male', '20/41 Jalan Wawasan 3', 'Puchong', 'SA', '2342', 'lindan@gmail.com', '989765543', 'Math foundation', '', 'Current'),
(6, 'JP020', 'ChongWei', 'Lee', '2026-06-02', 'Male', '29 Jalan Pondok 29/31', 'Petaling Jaya', 'NSW', '4444', 'chongwei@gmail.com', '098765432', 'Math foundation, Rapid Prototyping', '', 'New'),
(7, 'DO130', 'ZiiJia', 'Lee', '2026-06-17', 'Female', '22 Jalan Yayasan 2/10', 'Klang', 'TAS', '7660', 'ziijia@gmail.com', '98909877', 'Math foundation', '', 'New'),
(8, 'DO130', 'ZiiJia', 'Lee', '2026-06-17', 'Female', '22 Jalan Yayasan 2/10', 'Klang', 'TAS', '7660', 'ziijia@gmail.com', '98909877', 'Math foundation', '', 'New'),
(9, 'DO130', 'josep', 'hal', '2026-06-01', '-', '32 jalan titiasan 2/10', 'kuching', 'NT', '2232', 'josep@gmail.com', '0198829282', 'Math foundation, Game engine proficiency', '', 'New');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `jobs_id` int(11) NOT NULL,
  `jobs_ref_num` char(5) NOT NULL,
  `jobs_position` varchar(40) NOT NULL,
  `jobs_salary` varchar(40) NOT NULL,
  `jobs_reporting_line` varchar(40) NOT NULL,
  `jobs_requirements` varchar(200) DEFAULT NULL,
  `other_requirements` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`jobs_id`, `jobs_ref_num`, `jobs_position`, `jobs_salary`, `jobs_reporting_line`, `jobs_requirements`, `other_requirements`) VALUES
(1, 'UI011', 'Junior UI/UX Designer', '$50,000 - $70,000 per year', 'Lead UI/UX Director', 'Proven experience as a UI/UX Designer or similar role\r\nPortfolio demonstrating design skills and experience\r\nExperience with Figma, Sketch, or Adobe Creative Suite', 'User-centered design principles knowledge'),
(2, 'JP020', 'Junior Engine Programmer', '$60,000 - $80,000 per year', 'Lead Engine Programmer', 'Bachelor\'s degree in Computer Science or related field\r\nProficiency in C++ and C#\r\nExperience with Unity or Unreal Engine', 'Experience with modern graphics APIs (Vulkan, D3D12)'),
(3, 'DO130', 'DevOps Engineer', '$85,000 - $110,000 per year', 'Product Manager', 'Bachelor\'s degree in Computer Science or related field\r\nExperience with AWS, Azure, or GCP\r\nProficiency in automation tools and scripting', 'Understanding of Docker and Kubernetes');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'Admin', '$2y$10$PMWfczHnz6MtVU.QPXAXleZCFxnaRkWVUzbyXLN6Bo5EWgcZ00Lv.'),
(2, 'student', '$2y$10$7Y3Eaf3CZVIj2hNZc6.HIeKJIy8miF/lA7oSdKMshS6BYGx6XwK.K');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eoi`
--
ALTER TABLE `eoi`
  ADD PRIMARY KEY (`eoinumber`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`jobs_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eoi`
--
ALTER TABLE `eoi`
  MODIFY `eoinumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `jobs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
