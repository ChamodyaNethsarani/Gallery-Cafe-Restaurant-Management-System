-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 16, 2024 at 06:10 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `galerycafe`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `booking_date` date NOT NULL,
  `number_of_guests` int NOT NULL,
  `special_requests` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `table_id` int NOT NULL,
  `parking_slot_count` int DEFAULT '0',
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_table_id` (`table_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `name`, `email`, `phone`, `booking_date`, `number_of_guests`, `special_requests`, `table_id`, `parking_slot_count`, `start_time`, `end_time`) VALUES
(2, 'mithila', 'sandinkodagoda@gmail.com', '0711093799', '2024-07-17', 8, 'saedrgtfyhujgcfxzdd', 6, 1, '01:30:00', '02:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `commission`
--

DROP TABLE IF EXISTS `commission`;
CREATE TABLE IF NOT EXISTS `commission` (
  `commission_id` int NOT NULL AUTO_INCREMENT,
  `category` varchar(100) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `number_of_sales` int NOT NULL,
  `commission_rate` int NOT NULL,
  PRIMARY KEY (`commission_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coworkers`
--

DROP TABLE IF EXISTS `coworkers`;
CREATE TABLE IF NOT EXISTS `coworkers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `birthday` date NOT NULL,
  `contact_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coworkers`
--

INSERT INTO `coworkers` (`id`, `name`, `email`, `password`, `birthday`, `contact_number`) VALUES
(2, 'laki', 'laki@gmail.com', '$2y$10$jws4WC3aM4DAOLlEJhj58eCk/YD0Spv8iWQe1sKwRcgBEHjWSCQEe', '2024-07-27', '0711093799'),
(9, 'cha', 'cha@gmail.com', '$2y$10$GNUcuYqDkJIiIInNXwLzGerA1wTFyzTgld9Y3vOth9b15VaDjeCei', '2024-08-08', '0711151700'),
(7, 'Nethsarani', 'chamodyan@gmail.com', '$2y$10$izehQl21LHkLXTIUPvXQAOgrF/Imc.MPJ9kVywJ1KFS5SOlfMrceS', '2024-07-06', '0711151700'),
(8, 'x', 'x@gmail.com', '$2y$10$EPpsAw.92ZBP287Qc0qe6uf122j/CyjgocleYiz2MNXLGzQYJuM1m', '2006-02-18', '0711151700');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `contact` int NOT NULL,
  `birthday` date NOT NULL,
  `password` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `email`, `contact`, `birthday`, `password`) VALUES
(1, 'Chamoya', '123@gmail.com', 711093799, '2024-07-05', '$2y$10$Fm/xsggmMeE.b'),
(2, 'Sandin', 'sandin@gmail.com', 711093799, '2002-01-17', '$2y$10$v9l5qIRl25fGO'),
(3, 'chamo', 'sandind@gmail.com', 711093799, '2024-07-12', '$2y$10$cQPUQurEDp4M8'),
(4, 'ch', 's@gmail.com', 711093799, '2024-07-01', '$2y$10$Pnzv5aZbMH2.G'),
(5, 'gagani', 'gagi@gmail.com', 714398651, '2024-07-01', '123456789'),
(6, 'mihin', 'mihin@gmail.com', 711093799, '2024-07-05', '$2y$10$54LKBDaiDg33a'),
(7, 'laki', 'laki@gmail.com', 711093799, '2024-07-14', '123456789'),
(8, 'miki', 'miki@gmail.com', 711093799, '2023-12-22', '$2y$10$MYs4BgXks7p.5'),
(9, 'nethsarani', 'nethsarani@gmail.com', 711093799, '2024-07-06', 'neth123'),
(10, 'jagath', 'jagath@gmail.com', 711093799, '2024-07-12', '123456789'),
(11, 'chamodya', 'chamodya@gmail.com', 711093799, '2024-07-05', '12345d'),
(12, 'cha', 'cha@gmail.com', 711151700, '2024-08-22', '123456f');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telephone_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `order_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `order_status` enum('pending','confirmed','canceled') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'pending',
  `additional_info` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_name`, `address`, `telephone_number`, `email`, `total_price`, `order_date`, `order_status`, `additional_info`) VALUES
(1, 'John Doe', '123 Elm Street', '555-1234', 'john.doe@example.com', 29.99, '2024-07-31 15:00:17', 'confirmed', NULL),
(2, 'Jane Smith', '456 Oak Avenue', '555-5678', 'jane.smith@example.com', 49.99, '2024-07-31 15:00:17', 'confirmed', NULL),
(3, 'chamodya', 'mawathgama,horana', '0342252489', 'chamodya@gmail.com', 1150.00, '2024-07-31 15:11:04', 'pending', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `parking_slots`
--

DROP TABLE IF EXISTS `parking_slots`;
CREATE TABLE IF NOT EXISTS `parking_slots` (
  `id` int NOT NULL AUTO_INCREMENT,
  `slot_number` int NOT NULL,
  `is_reserved` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `slot_number` (`slot_number`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pre_orders`
--

DROP TABLE IF EXISTS `pre_orders`;
CREATE TABLE IF NOT EXISTS `pre_orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `item_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `item_price` decimal(10,2) NOT NULL,
  `preorder_date` date DEFAULT NULL,
  `preorder_time` time DEFAULT NULL,
  `customer_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `customer_phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` enum('pending','confirmed','canceled') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'pending',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pre_orders`
--

INSERT INTO `pre_orders` (`id`, `item_name`, `item_price`, `preorder_date`, `preorder_time`, `customer_name`, `customer_phone`, `created_at`, `status`) VALUES
(1, 'Pizza', 12.99, '2024-07-31', '18:00:00', 'Alice Johnson', '555-9876', '2024-07-31 15:03:03', 'confirmed'),
(2, 'Tasty Cakes', 2100.00, '2024-07-16', '17:12:00', NULL, NULL, '2024-07-31 15:12:13', 'confirmed');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `booking_date` date NOT NULL,
  `number_of_guests` int NOT NULL,
  `special_requests` text,
  `table_id` int NOT NULL,
  `parking_slot_count` int DEFAULT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `name`, `email`, `phone`, `booking_date`, `number_of_guests`, `special_requests`, `table_id`, `parking_slot_count`, `start_time`, `end_time`) VALUES
(37, 'chamodya', 'nethsarani@gmail.com', '0711151800', '2024-08-11', 7, '0', 2, 3, '15:17:00', '17:17:00'),
(33, 'mithila', 'mithila@gmail.com', '0774398651', '0000-00-00', 9, '', 4, 2, '21:58:00', '23:58:00'),
(32, 'mithila', 'mithila@gmail.com', '0774398651', '0000-00-00', 12, 'I want fresh foods', 3, 2, '21:57:00', '23:57:00'),
(31, 'jayathilaka', 'jayathilaka@gmail.com', '0774398651', '0000-00-00', 4, '', 7, 3, '15:43:00', '17:50:00'),
(35, 'Nethsarani', '123@gmail.com', '0711151700', '0000-00-00', 3, 'd5ydhb ty5b dy6hgd vbgyxtb', 1, 2, '05:09:00', '06:09:00'),
(34, 'Nethsarani', '123@gmail.com', '0711151700', '0000-00-00', 3, 'd5ydhb ty5b dy6hgd vbgyxtb', 1, 2, '05:09:00', '06:09:00'),
(30, 'sandin', 'indurangakawishwara2003@gmail.com', '0711093799', '0000-00-00', 7, 'frgthyjuyi', 3, 1, '14:30:00', '15:30:00'),
(39, 'chamodya', 'cha@gmail.com', '0711151700', '0000-00-00', 8, 'meeting', 8, 10, '13:09:00', '14:09:00');

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

DROP TABLE IF EXISTS `tables`;
CREATE TABLE IF NOT EXISTS `tables` (
  `id` int NOT NULL AUTO_INCREMENT,
  `table_number` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`id`, `table_number`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
