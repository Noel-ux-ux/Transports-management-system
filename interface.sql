-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2026 at 12:08 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `interface`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `Name` varchar(200) NOT NULL DEFAULT '0',
  `phone` varchar(200) NOT NULL DEFAULT '0',
  `email` varchar(200) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `Name`, `phone`, `email`) VALUES
(14, 'john Doe', '65656676', 'jojn@gmail.com'),
(15, 'AGIAMTE NOEL', '651970261', 'agiamtenoelo1@gmail.com'),
(16, 'AGIAMTE NOEL', '651970261', 'agiamtenoelo1@gmail.com'),
(17, 'AGIAMTE NOEL', '651970261', 'agiamtenoelo1@gmail.com'),
(18, 'AGIAMTE NOEL', 'lkkkkkkkkkkk', 'agiamtenoelo1@gmail.com'),
(19, 'AGIAMTE NOEL', '651970261', 'agiamtenoelo1@gmail.com'),
(20, 'AGIAMTE NOEL', '651970261', 'agiamtenoelo1@gmail.com'),
(21, 'AGIAMTE NOEL', 'ppppppppppppp', 'agiamtenoelo1@gmail.com'),
(22, 'AGIAMTE NOEL', 'ppppppppppppp', 'agiamtenoelo1@gmail.com'),
(23, 'AGIAMTE NOEL', 'ppppppppppppp', 'agiamtenoelo1@gmail.com'),
(24, 'mary', '000000000', 'mary@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `phone` varchar(200) NOT NULL DEFAULT '0',
  `email` varchar(200) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `phone`, `email`) VALUES
(7, 'AGIAMTE NOEL', '651970261', 'agiamtenoelo1@gmail.com'),
(8, 'AGIAMTE NOEL', '651970261', 'agiamtenoelo1@gmail.com'),
(9, 'AGIAMTE', '651970261', 'agiamtenoelo1@gmail.com'),
(10, 'AGIAMTE NOEL', '651970261', 'agiamtenoelo1@gmail.com'),
(11, 'AGIAMTE NOEL', '651970261', 'agiamtenoelo1@gmail.com'),
(12, 'AGIAMTE NOEL', '651970261', 'agiamtenoelo1@gmail.com'),
(13, 'AGIAMTE NOEL', '651970261', 'agiamtenoelo1@gmail.com'),
(14, 'mary', '674599833', 'mary@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(50) NOT NULL,
  `message` text DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `admin_note` text DEFAULT NULL,
  `replied_at` datetime DEFAULT NULL,
  `date_submitted` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `phone`, `message`, `status`, `admin_note`, `replied_at`, `date_submitted`) VALUES
(67, 'AGIAMTE NOEL', 'agiamtenoelo1@gmail.com', '651970261', 'no', 'pending', 'ok sir', '2026-07-21 14:17:21', '2026-07-21 14:17:21'),
(76, 'AGIAMTE NOEL', 'agiamtenoel1@gmail.com', '651970261', 'nonnjjj', 'pending', 'ok sir', '2026-07-21 14:17:21', '2026-07-21 14:17:21'),
(77, 'AGIAMTE NOEL', 'agiamtenoel2@gmail.com', '000000000', 'nonnjjj', 'pending', 'ok sir', '2026-07-21 14:17:21', '2026-07-21 14:17:21'),
(78, 'AGIAMTE NOEL', 'agiamtenoelo5@gmail.com', '651970261', 'nonnjjj', 'pending', 'ok sir', '2026-07-21 14:17:21', '2026-07-21 14:17:21'),
(79, 'AGIAMTE NOEL', 'agiamtenoelo9@gmail.com', '651970261', 'nonnjjj', 'pending', 'ok sir', '2026-07-21 14:17:21', '2026-07-21 14:17:21'),
(80, 'AGIAMTE NOEL', 'agiamtenoelo8@gmail.com', '000000000', 'nonnjjj', 'pending', 'ok sir', '2026-07-21 14:17:21', '2026-07-21 14:17:21'),
(81, 'AGIAMT', 'agiamtenoelo0@gmail.com', '000000000', 'nonnjjj', 'pending', 'ok sir', '2026-07-21 14:17:21', '2026-07-21 14:17:21'),
(82, 'AGIAMTE NOEL', 'agiamtenoelo00@gmail.com', '651970261', 'nonnjjj', 'pending', 'ok sir', '2026-07-21 14:17:21', '2026-07-21 14:17:21'),
(83, 'silva', 'silva1@gmail.com', '56565656', 'not yet', 'new', NULL, NULL, '2026-08-02 14:32:59');

-- --------------------------------------------------------

--
-- Table structure for table `super_admin`
--

CREATE TABLE `super_admin` (
  `id` int(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `super_admin`
--

INSERT INTO `super_admin` (`id`, `username`, `password`, `name`, `email`) VALUES
(1, 'superadmin', 'admin123', 'super Admin', 'superadmin@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `tracking_number` varchar(50) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `transporter_id` int(11) DEFAULT NULL,
  `clients` varchar(200) NOT NULL,
  `Transporter` varchar(200) NOT NULL,
  `goods` varchar(200) NOT NULL,
  `service_type` varchar(100) DEFAULT 'Logistics',
  `origin` varchar(100) DEFAULT '',
  `destination` varchar(100) DEFAULT '',
  `weight_kg` decimal(10,2) DEFAULT 0.00,
  `amount` decimal(12,2) DEFAULT 0.00,
  `status` enum('pending','in_transit','delivered','cancelled') DEFAULT 'pending',
  `date_created` datetime DEFAULT current_timestamp(),
  `date_delivered` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `tracking_number`, `client_id`, `transporter_id`, `clients`, `Transporter`, `goods`, `service_type`, `origin`, `destination`, `weight_kg`, `amount`, `status`, `date_created`, `date_delivered`) VALUES
(25, '39', 14, 7, 'AGIAMTE NOEL', 'wilfrid', 'Banana', 'Export', 'Kribi port', 'Cana-toronto', '0.00', '2000000.00', 'pending', '2026-08-02 15:28:26', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `transporters`
--

CREATE TABLE `transporters` (
  `id` int(11) NOT NULL,
  `Name` varchar(200) NOT NULL DEFAULT '0',
  `phone` varchar(200) NOT NULL DEFAULT '0',
  `email` varchar(200) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transporters`
--

INSERT INTO `transporters` (`id`, `Name`, `phone`, `email`) VALUES
(5, 'john Doe', '65656676', 'jojn@gmail.com'),
(6, 'AGIAMTE NOEL', '651970261', 'agiamtenoelo1@gmail.com'),
(7, 'AGIAMTE NOEL', '651970261', 'agiamtenoelo1@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `yearly_summarry`
--

CREATE TABLE `yearly_summarry` (
  `id` int(11) NOT NULL,
  `Number_of_Imported_Transaction` varchar(200) NOT NULL,
  `Number_of_Exported_Transaction` varchar(200) NOT NULL,
  `Number_of_Successful_Imported_Transaction` varchar(200) NOT NULL,
  `Number_of_Unsuccessful_Imported_Transaction` varchar(200) NOT NULL,
  `Number_of_Countries_Reached` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `yearly_summarry`
--

INSERT INTO `yearly_summarry` (`id`, `Number_of_Imported_Transaction`, `Number_of_Exported_Transaction`, `Number_of_Successful_Imported_Transaction`, `Number_of_Unsuccessful_Imported_Transaction`, `Number_of_Countries_Reached`) VALUES
(2, '2', '3', '5', '6', '9'),
(3, '14', '48', '4', '11', '29'),
(4, '14', '48', '4', '11', '29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `super_admin`
--
ALTER TABLE `super_admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tracking_number` (`tracking_number`),
  ADD KEY `fk_trans_client` (`client_id`),
  ADD KEY `fk_trans_transporter` (`transporter_id`);

--
-- Indexes for table `transporters`
--
ALTER TABLE `transporters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `yearly_summarry`
--
ALTER TABLE `yearly_summarry`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `super_admin`
--
ALTER TABLE `super_admin`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `transporters`
--
ALTER TABLE `transporters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `yearly_summarry`
--
ALTER TABLE `yearly_summarry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `fk_trans_client` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_trans_transporter` FOREIGN KEY (`transporter_id`) REFERENCES `transporters` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
