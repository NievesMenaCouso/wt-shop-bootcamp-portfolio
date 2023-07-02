-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 02, 2023 at 01:17 PM
-- Server version: 8.0.33
-- PHP Version: 8.0.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wt`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int UNSIGNED NOT NULL,
  `total` decimal(8,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `user_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `order_content`
--

CREATE TABLE `order_content` (
  `content_id` int UNSIGNED NOT NULL,
  `quantity` int UNSIGNED NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `order_id` int UNSIGNED NOT NULL,
  `item_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `item_id` int UNSIGNED NOT NULL,
  `item_name` varchar(20) NOT NULL,
  `item_desc` varchar(2000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `item_img` varchar(20) NOT NULL,
  `item_price` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`item_id`, `item_name`, `item_desc`, `item_img`, `item_price`) VALUES
(1, 'White T-Shirt', 'The white T-shirt is a\r\nwardrobe\r\nstaple,\r\nwhatever\r\nthe season.', 'img/wh-t.jpg', '7.99'),
(2, 'Black T-Shirt', 'Effortless,\r\nthe black T-shirt is the\r\nfoundation\r\nof\r\neverything.', 'img/bl-t.jpg', '7.99'),
(3, 'Purple T-Shirt', 'Purple T-shirts add\r\nrich colour\r\nto your\r\nbasics.', 'img/purple-t.jpg', '5.99'),
(4, 'Green T-Shirt', 'Add a pop of\r\ncolour to\r\nyour\r\ncollection\r\nwith this\r\ngreen t-shirt.', 'img/green-t.jpg', '4.99'),
(5, 'Red T-Shirt', 'Our\r\nbestselling\r\nred t-shirt,\r\nmade from\r\nlightweight\r\ncotton.', 'img/red-t.jpg', '9.99'),
(6, 'Blue T-Shirt', 'Opt for easy,\r\nversatile\r\nstyle with\r\nour\r\ncollection of\r\nblue T-shirts.', 'img/blue-t.jpg', '6.99');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int UNSIGNED NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `email` varchar(60) NOT NULL,
  `pass` varchar(40) NOT NULL,
  `reg_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `email`, `pass`, `reg_date`) VALUES
(1, 'Pedro', 'Picapiedra', 'pp@gmail.com', 'pass', '2023-05-28 19:29:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`,`user_id`),
  ADD KEY `fk_orders_user1_idx` (`user_id`);

--
-- Indexes for table `order_content`
--
ALTER TABLE `order_content`
  ADD PRIMARY KEY (`content_id`,`order_id`,`item_id`),
  ADD KEY `fk_order_content_orders1_idx` (`order_id`),
  ADD KEY `fk_order_content_products1_idx` (`item_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_content`
--
ALTER TABLE `order_content`
  MODIFY `content_id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `item_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `order_content`
--
ALTER TABLE `order_content`
  ADD CONSTRAINT `fk_order_content_orders1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `fk_order_content_products1` FOREIGN KEY (`item_id`) REFERENCES `products` (`item_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
