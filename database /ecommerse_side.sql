-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 06, 2026 at 11:01 AM
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
-- Database: `ecommerse_side`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_name` varchar(200) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `items_count` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT NULL,
  `status` enum('PENDING','PROCESSING','SHIPPED','DELIVERED','CANCELLED') DEFAULT 'PENDING',
  `order_date` date DEFAULT curdate(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_name`, `email`, `items_count`, `amount`, `status`, `order_date`, `created_at`, `first_name`, `last_name`) VALUES
(2, 'rolex ×1', 'sdfs@gmail.com', 0, NULL, 'PENDING', '2026-04-04', '2026-04-04 12:46:34', 'djfdksjf', 'dfsdf'),
(4, 'rolex ×1', 'djfkdjf@gmail.com', 0, 50000.00, 'PENDING', '2026-04-04', '2026-04-04 13:01:13', 'krijan', 'sdjfhjs'),
(5, 'rgb mouse ×1', 'mountain@gmail.com', 0, 1233.00, 'PENDING', '2026-04-05', '2026-04-05 03:23:15', 'mountain', ''),
(6, 'laptop ×1', 'biraj@gmail.com', 0, 10000.00, 'PENDING', '2026-04-06', '2026-04-06 02:36:46', 'biraj', 'bhatta');

-- --------------------------------------------------------

--
-- Table structure for table `product_detail`
--

CREATE TABLE `product_detail` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `old_price` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_detail`
--

INSERT INTO `product_detail` (`id`, `product_name`, `price`, `category`, `description`, `created_at`, `old_price`, `image`) VALUES
(14, 'normal moouse', 120.00, 'Electronics', 'dfsdhkdjhfkj', '2026-03-18 16:46:25', 120, 'uploads/prod_69d36b60cb4dd6.81059492.png'),
(17, 'mac', 150000.00, 'Electronics', '', '2026-03-20 16:26:26', 150000, 'uploads/macbook-laptop-screen-mockup-above-pedestal-photo.jpg'),
(19, 'laptop', 10000.00, 'Electronics', 'premium', '2026-04-06 02:33:20', 1000, 'uploads/premium_photo-1681566925246-cc584a44d7fe.webp');

-- --------------------------------------------------------

--
-- Table structure for table `user_authentication`
--

CREATE TABLE `user_authentication` (
  `id` int(11) NOT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_authentication`
--

INSERT INTO `user_authentication` (`id`, `fullname`, `email`, `password`) VALUES
(11, 'akriti', 'akriti@gmail.com', '12346789'),
(12, 'suman', 'suman@gmail.com', '123456'),
(18, 'krijan', 'krijanmaharjan@gmail.com', '123456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_detail`
--
ALTER TABLE `product_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_authentication`
--
ALTER TABLE `user_authentication`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_detail`
--
ALTER TABLE `product_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_authentication`
--
ALTER TABLE `user_authentication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
