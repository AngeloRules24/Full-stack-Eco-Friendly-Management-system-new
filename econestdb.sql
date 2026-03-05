-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2025 at 03:13 PM
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
-- Database: `econestdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `exchange_details`
--

CREATE TABLE `exchange_details` (
  `offer_id` int(11) NOT NULL,
  `produce_id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `offer_produce` varchar(255) NOT NULL,
  `offer_producedescription` text NOT NULL,
  `offer_status` enum('pending','accepted','rejected','cancelled') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exchange_details`
--

INSERT INTO `exchange_details` (`offer_id`, `produce_id`, `from_user_id`, `to_user_id`, `offer_produce`, `offer_producedescription`, `offer_status`) VALUES
(1, 1, 2, 1, 'Carrots', '10 carrots for 5 tomatoes?', 'accepted'),
(3, 2, 3, 1, 'Apples', '10 apples', 'accepted'),
(4, 3, 4, 3, 'Onions', 'A sack of onions', 'accepted'),
(5, 3, 5, 3, 'Cabbage', '10 cabbage', 'rejected'),
(6, 4, 4, 5, 'Grapes', 'A bunch of grapes', 'pending'),
(7, 4, 3, 5, 'Lemons', '10 juicy lemons!', 'rejected');

-- --------------------------------------------------------

--
-- Table structure for table `gardeningprojects`
--

CREATE TABLE `gardeningprojects` (
  `garden_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `projectname` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gardeningprojects`
--

INSERT INTO `gardeningprojects` (`garden_id`, `user_id`, `projectname`, `description`, `created_at`) VALUES
(1, 2, 'TTDI Edible Community Garden', 'Location: Lorong Burhanuddin Helmi 11, Taman Tun Dr. Ismail, Kuala Lumpur, Malaysia', '2025-10-29 23:32:34'),
(2, 3, 'Kebun-Kebun Bangsar', 'Location: Lorong Bukit Pantai, Bangsar, Malaysia', '2025-11-02 02:59:25'),
(3, 5, 'Kebun Kita Petaling Jaya ', 'Location: Petaling Jaya, Malaysia', '2025-11-02 03:02:52');

-- --------------------------------------------------------

--
-- Table structure for table `gardeningtips`
--

CREATE TABLE `gardeningtips` (
  `tip_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gardeningtips`
--

INSERT INTO `gardeningtips` (`tip_id`, `user_id`, `title`, `content`, `created_at`) VALUES
(1, 1, 'Flowers dying', 'Please help me my flowers are wilted!', '2025-10-28 21:44:43'),
(2, 1, 'How to plant tomatoes?', 'Here are steps on how to plant tomatoes.\\r\\n1. Dig a hole\\r\\n2. Plant tomato seeds\\r\\n3. Water \\r\\n4. Done!', '2025-10-28 23:17:09'),
(3, 1, 'How is your garden growing?', 'My garden have flowers and cucumbers! How about y\\\'all??', '2025-10-29 06:54:00');

-- --------------------------------------------------------

--
-- Table structure for table `myswap`
--

CREATE TABLE `myswap` (
  `swap_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `from_user_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `traded_product` varchar(255) NOT NULL,
  `received_product` varchar(255) NOT NULL,
  `trade_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `myswap`
--

INSERT INTO `myswap` (`swap_id`, `product_id`, `from_user_id`, `to_user_id`, `traded_product`, `received_product`, `trade_date`) VALUES
(1, 2, 2, 1, 'Chemistry books', 'Books', '2025-11-01 23:51:14'),
(2, 4, 2, 1, 'Spade', 'Shovel', '2025-11-01 23:59:05'),
(3, 3, 3, 1, 'crop tops', 'Hoodies', '2025-11-02 01:29:01'),
(4, 6, 3, 1, 'Chemistry books', 'Basket', '2025-11-02 11:11:12');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `status` enum('unread','read') DEFAULT 'unread',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `user_id`, `message`, `status`, `created_at`) VALUES
(0, 1, 'Welcome to EcoNest! Thanks for joining our sustainable community 🌿', 'unread', '2025-11-02 13:33:45');

-- --------------------------------------------------------

--
-- Table structure for table `post_comments`
--

CREATE TABLE `post_comments` (
  `comment_id` int(11) NOT NULL,
  `tip_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_comments`
--

INSERT INTO `post_comments` (`comment_id`, `tip_id`, `user_id`, `comment_text`, `created_at`) VALUES
(1, 3, 1, 'My garden has 100 tulips!', '2025-10-29 17:03:09'),
(2, 3, 2, 'Oh wow that sounds fantastic!', '2025-10-29 17:05:41');

-- --------------------------------------------------------

--
-- Table structure for table `post_likes`
--

CREATE TABLE `post_likes` (
  `like_id` int(11) NOT NULL,
  `tip_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_likes`
--

INSERT INTO `post_likes` (`like_id`, `tip_id`, `user_id`, `created_at`) VALUES
(1, 3, 2, '2025-10-29 21:19:20'),
(2, 3, 3, '2025-10-29 21:22:05');

-- --------------------------------------------------------

--
-- Table structure for table `produceexchange`
--

CREATE TABLE `produceexchange` (
  `produce_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `produce_name` varchar(255) NOT NULL,
  `produce_description` text DEFAULT NULL,
  `status` enum('available','pending','traded') DEFAULT 'available',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produceexchange`
--

INSERT INTO `produceexchange` (`produce_id`, `user_id`, `produce_name`, `produce_description`, `status`, `created_at`) VALUES
(1, 1, 'Tomatoes', 'Fresh tomatoes harvested today!', 'traded', '2025-10-30 17:26:47'),
(2, 1, 'Watermelon', 'Juicy watermelons for trade!', 'traded', '2025-10-30 17:39:47'),
(3, 3, 'Lettuce', '10 lettuce', 'traded', '2025-10-30 19:19:37'),
(4, 5, 'Peas', 'A bunch of peas', 'available', '2025-10-30 19:39:10');

-- --------------------------------------------------------

--
-- Table structure for table `productswap`
--

CREATE TABLE `productswap` (
  `product_ID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_category` varchar(255) NOT NULL,
  `product1_name` varchar(255) NOT NULL,
  `product_description` text NOT NULL,
  `product2_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('available','pending','completed') DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productswap`
--

INSERT INTO `productswap` (`product_ID`, `user_id`, `product_category`, `product1_name`, `product_description`, `product2_name`, `created_at`, `status`) VALUES
(2, 1, 'books', 'Books', 'Old english books', '', '2025-11-01 21:46:52', ''),
(3, 1, 'clothing', 'Hoodies', 'Old hoodies with broken zip', '', '2025-11-01 23:15:51', 'completed'),
(4, 1, 'gardening', 'Shovel', 'Used shovel', '', '2025-11-01 23:53:14', ''),
(5, 1, 'books', 'Pens', 'A pack of pens', '', '2025-11-02 06:19:55', 'available'),
(6, 1, 'crafts', 'Basket', 'baket', '', '2025-11-02 11:09:18', 'completed'),
(7, 1, 'gardening', 'pitchfork', 'used', '', '2025-11-02 12:58:24', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `project_participants`
--

CREATE TABLE `project_participants` (
  `participant_id` int(11) NOT NULL,
  `garden_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_participants`
--

INSERT INTO `project_participants` (`participant_id`, `garden_id`, `user_id`) VALUES
(10, 1, 1),
(12, 1, 3),
(11, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `swap_offers`
--

CREATE TABLE `swap_offers` (
  `offer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `offered_product` varchar(255) NOT NULL,
  `offer_description` text NOT NULL,
  `offer_status` enum('pending','accepted','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `swap_offers`
--

INSERT INTO `swap_offers` (`offer_id`, `product_id`, `from_user_id`, `to_user_id`, `offered_product`, `offer_description`, `offer_status`, `created_at`) VALUES
(1, 2, 2, 1, 'Chemistry books', 'Pre-owned chemistry books for form 4 and form 5 students', 'accepted', '2025-11-01 22:39:37'),
(2, 4, 2, 1, 'Spade', '2 small spades', 'accepted', '2025-11-01 23:54:28'),
(3, 3, 3, 1, 'pants', 'long pants, jeans', 'rejected', '2025-11-02 00:18:15'),
(4, 3, 3, 1, 'crop tops', 'new crop tops', 'accepted', '2025-11-02 01:27:34'),
(5, 6, 2, 1, 'Spade', 'shovel', 'rejected', '2025-11-02 11:10:01'),
(6, 6, 3, 1, 'Chemistry books', 'books', 'accepted', '2025-11-02 11:10:40');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(100) NOT NULL,
  `user_lastname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_email`, `user_phone`, `user_password`, `user_firstname`, `user_lastname`) VALUES
(1, 'test1', 'test1@gmail.com', '0123456789', '$2y$10$4BrGOdz2jPhJN.3lAbrVcOl2PNuggiYLpM8YYZWMTp5z7CMpme7Qy', '', ''),
(2, 'test2', 'test2@gmail.com', '01987654321', '$2y$10$Y0M7zKhY2MItne7ew2Az8e38YS4tNQ2mn4MIk7oTcCoLdxkaKFbb6', '', ''),
(3, 'test3', 'test3@gmail.com', '0122334455', '$2y$10$63WjtasM7fTtdDm/ClWBu.2xTdhDFtFQwZBfZM1Fn1aep6RjTPF8K', '', ''),
(4, 'test4', 'test4@gmail.com', '0199887766', '$2y$10$MTaEFDHXIRQnnLg0Jn4Fhed/6XTiicoJ3dYX4ZEdUjkIBlNqbBFne', 'John', 'Doe'),
(5, 'test5', 'test5@yahoo.com', '0192837465', '$2y$10$8Bs9scBLXhc6V3sJrXQ8b.qIUFqwsn93agMRyjrl.TFdR2rJLnQZi', '', ''),
(6, 'Mahalia', 'mahaliajaya07@gmail.com', '0122093858', '$2y$10$cGE3nf9wPbGrEeRyf8P0HeDESuJgq4GkSCkgxcaVFZHcesCj6.LUy', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `exchange_details`
--
ALTER TABLE `exchange_details`
  ADD PRIMARY KEY (`offer_id`),
  ADD KEY `produce_id` (`produce_id`),
  ADD KEY `from_user_id` (`from_user_id`),
  ADD KEY `to_user_id` (`to_user_id`);

--
-- Indexes for table `gardeningprojects`
--
ALTER TABLE `gardeningprojects`
  ADD PRIMARY KEY (`garden_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `gardeningtips`
--
ALTER TABLE `gardeningtips`
  ADD PRIMARY KEY (`tip_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `myswap`
--
ALTER TABLE `myswap`
  ADD PRIMARY KEY (`swap_id`),
  ADD KEY `from_user_id` (`from_user_id`),
  ADD KEY `to_user_id` (`to_user_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `post_comments`
--
ALTER TABLE `post_comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `tip_id` (`tip_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `post_likes`
--
ALTER TABLE `post_likes`
  ADD PRIMARY KEY (`like_id`),
  ADD UNIQUE KEY `unique_like` (`tip_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `produceexchange`
--
ALTER TABLE `produceexchange`
  ADD PRIMARY KEY (`produce_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `productswap`
--
ALTER TABLE `productswap`
  ADD PRIMARY KEY (`product_ID`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `project_participants`
--
ALTER TABLE `project_participants`
  ADD PRIMARY KEY (`participant_id`),
  ADD UNIQUE KEY `unique_participation` (`garden_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `swap_offers`
--
ALTER TABLE `swap_offers`
  ADD PRIMARY KEY (`offer_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `from_user_id` (`from_user_id`),
  ADD KEY `to_user_id` (`to_user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exchange_details`
--
ALTER TABLE `exchange_details`
  MODIFY `offer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `gardeningprojects`
--
ALTER TABLE `gardeningprojects`
  MODIFY `garden_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gardeningtips`
--
ALTER TABLE `gardeningtips`
  MODIFY `tip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `myswap`
--
ALTER TABLE `myswap`
  MODIFY `swap_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `post_comments`
--
ALTER TABLE `post_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `post_likes`
--
ALTER TABLE `post_likes`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `produceexchange`
--
ALTER TABLE `produceexchange`
  MODIFY `produce_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `productswap`
--
ALTER TABLE `productswap`
  MODIFY `product_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `project_participants`
--
ALTER TABLE `project_participants`
  MODIFY `participant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `swap_offers`
--
ALTER TABLE `swap_offers`
  MODIFY `offer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `exchange_details`
--
ALTER TABLE `exchange_details`
  ADD CONSTRAINT `exchange_details_ibfk_1` FOREIGN KEY (`produce_id`) REFERENCES `produceexchange` (`produce_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exchange_details_ibfk_2` FOREIGN KEY (`from_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exchange_details_ibfk_3` FOREIGN KEY (`to_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `gardeningprojects`
--
ALTER TABLE `gardeningprojects`
  ADD CONSTRAINT `gardeningprojects_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `gardeningtips`
--
ALTER TABLE `gardeningtips`
  ADD CONSTRAINT `gardeningtips_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `myswap`
--
ALTER TABLE `myswap`
  ADD CONSTRAINT `myswap_ibfk_1` FOREIGN KEY (`from_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `myswap_ibfk_2` FOREIGN KEY (`to_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post_comments`
--
ALTER TABLE `post_comments`
  ADD CONSTRAINT `post_comments_ibfk_1` FOREIGN KEY (`tip_id`) REFERENCES `gardeningtips` (`tip_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `post_likes`
--
ALTER TABLE `post_likes`
  ADD CONSTRAINT `post_likes_ibfk_1` FOREIGN KEY (`tip_id`) REFERENCES `gardeningtips` (`tip_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_likes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `produceexchange`
--
ALTER TABLE `produceexchange`
  ADD CONSTRAINT `produceexchange_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `productswap`
--
ALTER TABLE `productswap`
  ADD CONSTRAINT `productswap_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `project_participants`
--
ALTER TABLE `project_participants`
  ADD CONSTRAINT `project_participants_ibfk_1` FOREIGN KEY (`garden_id`) REFERENCES `gardeningprojects` (`garden_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_participants_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `swap_offers`
--
ALTER TABLE `swap_offers`
  ADD CONSTRAINT `swap_offers_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `productswap` (`product_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `swap_offers_ibfk_2` FOREIGN KEY (`from_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `swap_offers_ibfk_3` FOREIGN KEY (`to_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
