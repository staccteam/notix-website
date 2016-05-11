-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 11, 2016 at 02:14 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hcetnotix`
--

-- --------------------------------------------------------

--
-- Table structure for table `notix_admins`
--

CREATE TABLE `notix_admins` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notix_admins`
--

INSERT INTO `notix_admins` (`username`, `password`, `created_at`, `updated_at`) VALUES
('varun', '$2y$10$WzJUA4dis6zS3xrtekW8.e8GLb3BS2waq/wVNr6oNsePidMwI/ddG', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `notix_attachments`
--

CREATE TABLE `notix_attachments` (
  `id` int(11) NOT NULL,
  `notification_id` int(11) NOT NULL,
  `file_name` varchar(500) NOT NULL,
  `file_url` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notix_branches`
--

CREATE TABLE `notix_branches` (
  `branch` varchar(255) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notix_branches`
--

INSERT INTO `notix_branches` (`branch`, `id`) VALUES
('CS', 1),
('MECH', 2),
('ALL', 3);

-- --------------------------------------------------------

--
-- Table structure for table `notix_faculties`
--

CREATE TABLE `notix_faculties` (
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `branch` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notix_faculties`
--

INSERT INTO `notix_faculties` (`first_name`, `last_name`, `email`, `mobile`, `username`, `password`, `branch`, `status`, `created_at`, `updated_at`, `id`) VALUES
('Pooja', 'Chamar', 'poojachamar@gmail.com', '9876987654', 'pooja', '$2y$10$px5AGjMIE3dfoppW5e7nOuODubbz/FhlMJeqQoVN.4J.FB.5ubZ9O', '1', 1, '0000-00-00 00:00:00', '2016-05-11 13:12:59', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notix_notifications`
--

CREATE TABLE `notix_notifications` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `title` varchar(1000) NOT NULL,
  `message` text NOT NULL,
  `attachment` varchar(500) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notix_notifications`
--

INSERT INTO `notix_notifications` (`id`, `username`, `title`, `message`, `attachment`, `branch_id`, `created_at`, `updated_at`) VALUES
(1, 'pooja', 'First Notification', 'Bas yahi h ab toh', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `notix_students`
--

CREATE TABLE `notix_students` (
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `enrollment` varchar(255) NOT NULL,
  `branch` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `verified` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notix_branches`
--
ALTER TABLE `notix_branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notix_faculties`
--
ALTER TABLE `notix_faculties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notix_notifications`
--
ALTER TABLE `notix_notifications`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notix_branches`
--
ALTER TABLE `notix_branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `notix_faculties`
--
ALTER TABLE `notix_faculties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `notix_notifications`
--
ALTER TABLE `notix_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
