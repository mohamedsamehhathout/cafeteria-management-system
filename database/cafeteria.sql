-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 04, 2026 at 11:38 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cafeteria`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`) VALUES
(1, 'Hot Drinks', '2026-06-03 15:22:10'),
(2, 'Cold Drinks', '2026-06-03 15:22:10'),
(3, 'Desserts', '2026-06-03 15:22:10'),
(9, 'Sandwiches', '2026-06-04 10:54:56');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `room_id` int DEFAULT NULL,
  `notes` text,
  `total_amount` decimal(10,2) DEFAULT '0.00',
  `status` enum('processing','out_for_delivery','done','cancelled') DEFAULT 'processing',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `room_id`, `notes`, `total_amount`, `status`, `created_at`, `updated_at`) VALUES
(5, 6, 2, 'Less sugar', 95.00, 'done', '2026-06-04 10:57:47', '2026-06-04 10:57:47'),
(6, 3, 3, 'No ice please', 70.00, 'processing', '2026-06-04 10:57:47', '2026-06-04 10:57:47'),
(7, 4, 4, 'Urgent order', 120.00, 'out_for_delivery', '2026-06-04 10:57:47', '2026-06-04 10:57:47'),
(8, 5, 5, '', 60.00, 'done', '2026-06-04 10:57:47', '2026-06-04 10:57:47');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `unit_price` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `unit_price`, `subtotal`) VALUES
(15, 5, 11, 1, 25.00, 25.00),
(16, 5, 17, 1, 50.00, 50.00),
(17, 5, 14, 1, 20.00, 20.00),
(18, 6, 13, 1, 40.00, 40.00),
(19, 6, 16, 1, 30.00, 30.00),
(20, 7, 19, 2, 60.00, 120.00),
(21, 8, 18, 3, 20.00, 60.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category_id` int NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_available` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `category_id`, `image`, `is_available`, `created_at`) VALUES
(11, 'Espresso', 25.00, 1, 'espresso.jpg', 1, '2026-06-04 10:56:30'),
(12, 'Cappuccino', 35.00, 1, 'cappuccino.jpg', 1, '2026-06-04 10:56:30'),
(13, 'Latte', 40.00, 1, 'latte.jpg', 1, '2026-06-04 10:56:30'),
(14, 'Tea', 20.00, 1, 'tea.jpg', 1, '2026-06-04 10:56:30'),
(15, 'Iced Coffee', 45.00, 2, 'iced-coffee.jpg', 1, '2026-06-04 10:56:30'),
(16, 'Orange Juice', 30.00, 2, 'orange-juice.jpg', 1, '2026-06-04 10:56:30'),
(17, 'Chocolate Cake', 50.00, 3, 'cake.jpg', 1, '2026-06-04 10:56:30'),
(18, 'Donut', 20.00, 3, 'donut.jpg', 1, '2026-06-04 10:56:30'),
(19, 'Chicken Sandwich', 60.00, 9, 'chicken-sandwich.jpg', 1, '2026-06-04 10:56:30'),
(20, 'Turkey Sandwich', 65.00, 9, 'turkey-sandwich.jpg', 1, '2026-06-04 10:56:30');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int NOT NULL,
  `room_number` varchar(20) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_number`, `description`) VALUES
(1, '2010', 'First Floor'),
(2, '2011', 'First Floor'),
(3, '2012', 'Second Floor'),
(4, '2013', 'Second Floor'),
(5, '101', 'First Floor'),
(6, '102', 'First Floor'),
(7, '201', 'Second Floor'),
(8, '202', 'Second Floor'),
(9, '301', 'Meeting Room');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `room_id` int DEFAULT NULL,
  `extension` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `room_id`, `extension`, `created_at`) VALUES
(1, 'Admin User', 'admin@cafeteria.com', '$2y$12$j0E8WXQE4JW6slHrUELRA.RXdCIiZS0vcXNLr.BmBJMIZsJS/o.72', 'admin', 6, '100', '2026-06-03 15:22:10'),
(3, 'Mohamed Sameh', 'user@cafeteria.com', '$2y$12$YvTOMJpb8ZUtA/J3ioRjH.4PrHJROIIbc3o1wgFRD9BTHWQYxSPvu', 'user', 9, NULL, '2026-06-03 16:38:52'),
(4, 'Hathout', 'admin1@cafeteria.com', '$2y$12$EOrOMkJoUHVJfGNyhTOnKOVf5nZgvENGHjZu41yg8KebH8ORRCcf2', 'admin', 1, '100', '2026-06-04 10:53:44'),
(5, 'Mohamed Hathout', 'user1@cafeteria.com', '$2y$12$EOrOMkJoUHVJfGNyhTOnKOVf5nZgvENGHjZu41yg8KebH8ORRCcf2', 'user', 2, '101', '2026-06-04 10:53:44'),
(6, 'Sara Ahmed', 'user2@cafeteria.com', '$2y$12$EOrOMkJoUHVJfGNyhTOnKOVf5nZgvENGHjZu41yg8KebH8ORRCcf2', 'user', 3, '102', '2026-06-04 10:53:44'),
(7, 'Omar Khaled', 'user3@cafeteria.com', '$2y$12$EOrOMkJoUHVJfGNyhTOnKOVf5nZgvENGHjZu41yg8KebH8ORRCcf2', 'user', 4, '103', '2026-06-04 10:53:44'),
(8, 'Mona Ali', 'user4@cafeteria.com', '$2y$12$EOrOMkJoUHVJfGNyhTOnKOVf5nZgvENGHjZu41yg8KebH8ORRCcf2', 'user', 5, '104', '2026-06-04 10:53:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order_user` (`user_id`),
  ADD KEY `fk_order_room` (`room_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orderitem_order` (`order_id`),
  ADD KEY `fk_orderitem_product` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product_category` (`category_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `room_number` (`room_number`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_user_room` (`room_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_order_room` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_order_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `fk_orderitem_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_orderitem_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_product_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_user_room` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
