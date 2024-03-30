-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2024 at 05:21 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projects`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` bigint(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `mobile`, `email`, `password`) VALUES
(1, 'indira', 9807614152, 'admin@123gmail.com', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `product_id`, `user_id`, `qty`) VALUES
(10, 10002, 101, 1),
(49, 10007, 105, 2),
(50, 10011, 107, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(100) NOT NULL,
  `title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Flowering Indoor Plants', 'Plants that produce flowers indoors', '2024-03-28 10:27:27', '2024-03-28 10:27:27'),
(2, 'Colourful Foliage Indoor Plants', 'Plants with colorful leaves for indoor decoration', '2024-03-28 10:27:27', '2024-03-28 10:27:27'),
(3, 'Low-Light Indoor Plants', 'Plants that thrive in low-light conditions indoors', '2024-03-28 10:27:27', '2024-03-28 10:27:27'),
(4, 'Air Purifying Indoor Plants', 'Plants known for their air purifying properties indoors', '2024-03-28 10:27:27', '2024-03-28 10:27:27'),
(5, 'Trailing Indoor Plants', 'Plants that trail or cascade down from containers indoors', '2024-03-28 10:27:27', '2024-03-28 10:27:27'),
(6, 'Small Indoor Plants', 'Compact and small-sized plants suitable for indoor spaces', '2024-03-28 10:27:27', '2024-03-28 10:27:27'),
(7, 'Large Indoor Plants', 'Plants with large foliage or size suitable for spacious indoors', '2024-03-28 10:27:27', '2024-03-28 10:27:27'),
(8, 'Succulents & Cacti', 'Drought-resistant plants like succulents and cacti for indoor display', '2024-03-28 10:27:27', '2024-03-28 10:27:27'),
(9, 'Moisture Loving Indoor Plants', 'Plants that require higher humidity levels indoors', '2024-03-28 10:27:27', '2024-03-28 10:27:27'),
(10, 'Air Plants', 'Epiphytic plants that grow without soil and absorb nutrients from the air', '2024-03-28 10:27:27', '2024-03-28 10:27:27');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `district` varchar(100) DEFAULT NULL,
  `postcode` varchar(20) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `full_name`, `phone_number`, `email`, `address`, `city`, `district`, `postcode`, `country`, `payment_method`) VALUES
(104, 'tinaa', '9812345674', 'tina@gmail.com', 'sankhmul', 'Kathmandu', 'fghj', '3456', 'Nepal', NULL),
(105, 'Rihana', '981234567', 'tina@gmail.com', 'sankhmul', 'Kathmandu', 'lalitpur', '3456', 'Nepal', NULL),
(106, 'rihanan', '981234567', 'tina@gmail.com', 'sankhmul', 'Kathmandu', 'lalitpur', '3456', 'Nepal', NULL),
(107, 'rihanan', '981234567', 'tina@gmail.com', 'sankhmul', 'Kathmandu', 'lalitpur', '3456', 'Nepal', NULL),
(108, 'tinaa', '981234567', 'tina@gmail.com', 'sankhmul', 'Kathmandu', 'sarlahi', '3456', 'Nepal', NULL),
(109, 'Sujan', '981234567', 'tina@gmail.com', 'sankhmul', 'Kathmandu', 'bagmati', '3456', 'Nepal', NULL),
(110, 'Sujan', '981234567', 'tina@gmail.com', 'sankhmul', 'Kathmandu', 'bagmati', '3456', 'Nepal', NULL),
(111, 'Sujan', '981234567', 'sujan@000gmail.com', 'Baneshor', 'Kathmandu', 'bagmati', '3456', 'Nepal', NULL),
(112, 'Sujan', '981234567', 'sujan@000gmail.com', 'Baneshor', 'Kathmandu', 'bagmati', '3456', 'Nepal', NULL),
(113, 'Sujan', '981234567', 'sujan@000gmail.com', 'Baneshor', 'Kathmandu', 'bagmati', '3456', 'Nepal', NULL),
(114, 'Sujan', '981234567', 'sujan@000gmail.com', 'Baneshor', 'Kathmandu', 'bagmati', '3456', 'Nepal', NULL),
(115, 'Sujan', '981234567', 'sujan@000gmail.com', 'Baneshor', 'Kathmandu', 'bagmati', '3456', 'Nepal', NULL),
(116, 'Sujan', '981234567', 'sujan@000gmail.com', 'Baneshor', 'Kathmandu', 'bagmati', '3456', 'Nepal', NULL),
(117, 'Sujan', '981234567', 'sujan@000gmail.com', 'Baneshor', 'Kathmandu', 'bagmati', '3456', 'Nepal', NULL),
(118, 'Sujan', '981234567', 'sujan@000gmail.com', 'Baneshor', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutCashOnDelivery'),
(119, 'Sujan', '981234567', 'sujan@000gmail.com', 'Baneshor', 'Kathmandu', 'bagmati', '3456', 'Nepal', ''),
(120, 'Sujan', '981234567', 'sujan@000gmail.com', 'Baneshor', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutEsewa'),
(121, 'Sujanaaaa', '981234567', 'sujan@000gmail.com', 'Baneshor', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutEsewa'),
(122, 'Sujanaaaai', '981234567', 'sujan@000gmail.com', 'Baneshor', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutEsewa'),
(123, 'S', '981234567', 'sujan@000gmail.com', 'Baneshor', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutCashOnDelivery'),
(124, 'tinaa', '981234567', 'tina@gmail.com', 'sankhmul', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutCashOnDelivery'),
(125, 'tinaa', '981234567', 'tina@gmail.com', 'sankhmul', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutCashOnDelivery'),
(126, 'tinaa', '981234567', 'tina@gmail.com', 'sankhmul', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutCashOnDelivery'),
(127, 'tinaa', '98123456', 'tina@gmail.com', 'sankhmul', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutCashOnDelivery'),
(128, 'tinaa', '981234', 'tina@gmail.com', 'sankhmul', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutCashOnDelivery'),
(129, 'tinaa', '981234567', 'tina@gmail.com', 'sankhmul', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutCashOnDelivery'),
(130, 'tinaa', '981234567', 'tina@gmail.com', 'sankhmul', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutCashOnDelivery'),
(131, 'tinaa', '981234567', 'tina@gmail.com', 'sankhmul', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutEsewa'),
(132, 'tinaa', '981234567', 'tina@gmail.com', 'sankhmul', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutEsewa'),
(133, 'tinaa', '981234567', 'tina@gmail.com', 'sankhmul', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutEsewa'),
(134, 'tinaa', '981234567', 'tina@gmail.com', 'sankhmul', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutEsewa'),
(135, 'tinaa', '981234567', 'tina@gmail.com', 'sankhmul', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutEsewa'),
(136, 'tinaa', '981234567', 'tina@gmail.com', 'sankhmul', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutCashOnDelivery'),
(137, 'tinaa', '981234567', 'tina@gmail.com', 'sankhmul', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutEsewa'),
(138, 'tinaa', '981234567', 'tina@gmail.com', 'sankhmul', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutCashOnDelivery'),
(139, 'tinaa', '981234567', 'tina@gmail.com', 'sankhmul', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutEsewa'),
(140, 'ltinaa', '981234567', 'tina@gmail.com', 'sankhmul', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutCashOnDelivery'),
(141, 'rojina', '981234567', 'tina@gmail.com', 'sankhmul', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutCashOnDelivery'),
(142, 'Aarti Lama', '981234567', 'aarti2@gmail.com', 'Sarlahi', 'lalbandi', 'sarlahi', '3450', 'Nepal', 'checkoutCashOnDelivery'),
(143, 'Aarti Lama', '9814887699', 'aarti2@gmail.com', 'Sarlahi', 'lalbandi', 'sarlahi', '3450', 'Nepal', 'checkoutCashOnDelivery'),
(144, 'tinaa', '9814887699', 'tina@gmail.com', 'sankhmul', 'Kathmandu', 'lalitpur', '3456', 'Nepal', 'checkoutCashOnDelivery'),
(145, 'Indira Khanal', '9812345678', 'indu@123gmail.com', 'buddhanagar', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutCashOnDelivery'),
(146, 'Indira Khanal', '9812345678', 'indu@123gmail.com', 'buddhanagar', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutCashOnDelivery'),
(147, 'tinaa', '9814887699', 'tina@gmail.com', 'sankhmul', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutEsewa'),
(148, 'tinaa', '9814887699', 'tina@gmail.com', 'sankhmul', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutEsewa'),
(149, 'tinaa', '9814887699', 'tina@gmail.com', 'sankhmul', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutEsewa'),
(150, 'tinaa', '9814887699', 'tina@gmail.com', 'sankhmul', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutCashOnDelivery'),
(151, 'tinaa', '9814887699', 'tina@gmail.com', 'sankhmul', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutEsewa'),
(152, 'tinaa', '9814887699', 'tina@gmail.com', 'sankhmul', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutEsewa'),
(153, 'tinaa', '9814887699', 'tina@gmail.com', 'sankhmul', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutEsewa'),
(154, 'tinaa', '9814887699', 'tina@gmail.com', 'sankhmul', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutEsewa'),
(155, 'Indira Khanal', '9812345678', 'indu@123gmail.com', 'buddhanagar', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutEsewa'),
(156, 'Indira Khanal', '9812345678', 'indu@123gmail.com', 'buddhanagar', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutEsewa'),
(157, 'Indira Khanal', '9812345678', 'indu@123gmail.com', 'buddhanagar', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutEsewa'),
(158, 'Indira Khanal', '9812345678', 'indu@123gmail.com', 'buddhanagar', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutEsewa'),
(159, 'Indira Khanal', '9812345678', 'indu@123gmail.com', 'buddhanagar', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutEsewa'),
(160, 'Indira Khanal', '9812345678', 'indu@123gmail.com', 'buddhanagar', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutEsewa'),
(161, 'Indira Khanal', '9812345678', 'indu@123gmail.com', 'buddhanagar', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutCashOnDelivery'),
(162, 'Indira Khanal', '9812345678', 'indu@123gmail.com', 'buddhanagar', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutCashOnDelivery'),
(163, 'Indira Khanal', '9812345678', 'indu@123gmail.com', 'buddhanagar', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutCashOnDelivery'),
(164, 'Indira Khanal', '9812345678', 'indu@123gmail.com', 'buddhanagar', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutCashOnDelivery'),
(165, 'Indira Khanal', '9812345678', 'indu@123gmail.com', 'buddhanagar', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutCashOnDelivery'),
(166, 'Indira Khanal', '9812345678', 'indu@123gmail.com', 'buddhanagar', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutCashOnDelivery'),
(167, 'Indira Khanal', '9812345678', 'indu@123gmail.com', 'buddhanagar', 'Kathmandu', 'sarlahi', '3456', 'Nepal', 'checkoutCashOnDelivery'),
(168, 'Indira Khanal', '9812345678', 'indu@123gmail.com', 'buddhanagar', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutEsewa'),
(169, 'Indira Khanal', '9812345678', 'indu@123gmail.com', 'buddhanagar', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutEsewa'),
(170, 'Indira upadhaye', '9812345678', 'indu@', 'buddhanagar', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutEsewa'),
(171, 'Indira upadhaye', '9812345678', 'indu@', 'buddhanagar', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutEsewa'),
(172, 'rojina', '9814887699', 'rojina@gmail.com', 'sankhmul', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutEsewa'),
(173, 'rojina', '9814887699', 'rojina@gmail.com', 'sankhmul', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutEsewa'),
(174, 'rojina', '9814887699', 'rojina@gmail.com', 'sankhmul', 'Kathmandu', 'sarlahi', '3456', 'Nepal', 'checkoutEsewa'),
(175, 'rojina', '9814887699', 'rojina@gmail.com', 'sankhmul', 'Kathmandu', 'sarlahi', '3456', 'Nepal', 'checkoutEsewa'),
(176, 'rojina', '9812345678', 'tina@gmail.com', 'sankhmul', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutEsewa'),
(177, 'rojina', '9812345678', 'tina@gmail.com', 'sankhmul', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutEsewa'),
(178, 'rojina', '9812345678', 'tina@gmail.com', 'sankhmul', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutEsewa'),
(179, 'rojina', '9812345678', 'tina@gmail.com', 'sankhmul', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutEsewa'),
(180, 'Indira Khanal', '9812345678', 'indu@123gmail.com', 'buddhanagar', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutEsewa'),
(181, 'Indira Khanal', '9812345678', 'indu@123gmail.com', 'buddhanagar', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutEsewa'),
(182, 'sita', '9814887699', 'sita@gmail.com', 'Sarlahi', 'lalbandi', 'bagmati', '3450', 'Nepal', 'checkoutEsewa'),
(183, 'sita', '9814887699', 'sita@gmail.com', 'Sarlahi', 'lalbandi', 'bagmati', '3450', 'Nepal', 'checkoutEsewa'),
(184, 'sita', '9814887699', 'sita@gmail.com', 'Sarlahi', 'lalbandi', 'bagmati', '3450', 'Nepal', 'checkoutEsewa'),
(185, 'sita', '9814887699', 'sita@gmail.com', 'Sarlahi', 'lalbandi', 'bagmati', '3450', 'Nepal', 'checkoutEsewa'),
(186, 'Indira Khanal', '9812345678', 'indu@123gmail.com', 'buddhanagar', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutkhalti'),
(187, 'Indira Khanal', '9812345678', 'indu@123gmail.com', 'buddhanagar', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutkhalti'),
(188, 'Indira Khanal', '9812345678', 'indu@123gmail.com', 'buddhanagar', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutkhalti'),
(189, 'Indira Khanal', '9812345678', 'indu@123gmail.com', 'buddhanagar', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutkhalti'),
(190, 'Indira Khanal', '9812345678', 'indu@123gmail.com', 'buddhanagar', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutkhalti'),
(191, 'Indira Khanal', '9812345678', 'indu@123gmail.com', 'buddhanagar', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutkhalti'),
(192, 'Indira Khanal', '9812345678', 'indu@123gmail.com', 'buddhanagar', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutkhalti'),
(193, 'Indira Khanal', '9812345678', 'indu@123gmail.com', 'buddhanagar', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutkhalti'),
(194, 'Indira Khanal', '9812345678', 'indu@123gmail.com', 'buddhanagar', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutkhalti'),
(195, 'Indira Khanal', '9812345678', 'indu@123gmail.com', 'buddhanagar', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutkhalti'),
(196, 'Indira Khanal', '9812345678', 'indu@123gmail.com', 'buddhanagar', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutCashOnDelivery'),
(197, 'tinaa', '9812345678', 'tinagmail.com', 'sankhmul', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutkhalti'),
(198, 'tinaa', '9812345678', 'tina@gmail.com', 'sankhmul', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutkhalti'),
(199, 'tinaa', '9812345678', 'tina@gmail.com', 'sankhmul', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutCashOnDelivery'),
(200, 'Khem', '9812345678', 'indu@123gmail.com', 'buddhanagar', 'Kathmandu', 'dukhikhel', '3456', 'Nepal', 'checkoutCashOnDelivery'),
(201, 'tinaa', '', 'tina@gmail.com', 'sankhmul', 'Kathmandu', 'bagmati', '3456', 'Nepal', ''),
(202, 'Indira Khanal', '9812345678', 'indu@123gmail.com', 'buddhanagar', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutCashOnDelivery'),
(203, 'tinaa', '9812345678', 'tina@gmail.com', 'sankhmul', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutCashOnDelivery'),
(204, 'tinaa', '9812345678', 'tina@gmail.com', 'sankhmul', 'Kathmandu', 'bagmati', '3456', 'Nepal', 'checkoutkhalti');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_qty` int(11) NOT NULL,
  `order_amount` float NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) NOT NULL,
  `customer_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `product_id`, `user_id`, `product_qty`, `order_amount`, `order_date`, `status`, `customer_id`) VALUES
(201, 10001, 101, 1, 2049, '2024-03-03 19:21:21', 'Shipped', '1'),
(202, 10002, 101, 1, 1849, '2024-03-03 19:43:34', 'Shipped', '1'),
(203, 10006, 101, 1, 2749, '2024-03-03 19:43:34', 'Delivered', '1'),
(204, 10005, 101, 1, 1549, '2024-03-03 19:43:34', 'Confirmed', '1'),
(205, 10002, 101, 1, 1849, '2024-03-03 20:02:40', 'Confirmed', '1'),
(206, 10002, 101, 1, 1849, '2024-03-03 21:56:17', 'Confirmed', '1'),
(207, 10008, 101, 1, 2249, '2024-03-03 22:19:38', 'Confirmed', '1'),
(208, 10001, 101, 1, 2049, '2024-03-03 22:55:25', 'Confirmed', '1'),
(209, 10005, 102, 3, 4549, '2024-03-05 20:18:58', 'Confirmed', '1'),
(210, 10007, 102, 2, 2849, '2024-03-05 20:18:58', 'Confirmed', NULL),
(211, 10018, 102, 1, 1349, '2024-03-05 20:18:58', 'Confirmed', NULL),
(212, 10001, 102, 2, 4049, '2024-03-05 20:59:33', 'Confirmed', NULL),
(213, 10003, 102, 2, 4449, '2024-03-10 12:01:54', 'Confirmed', NULL),
(214, 10001, 102, 1, 2049, '2024-03-13 15:21:59', 'Confirmed', NULL),
(215, 10001, 102, 1, 2049, '2024-03-13 17:23:16', 'Confirmed', NULL),
(216, 10017, 102, 2, 1649, '2024-03-13 18:21:33', 'Confirmed', NULL),
(217, 10011, 102, 1, 1749, '2024-03-13 20:18:49', 'Confirmed', NULL),
(218, 10021, 102, 1, 2649, '2024-03-13 20:18:49', 'Confirmed', NULL),
(219, 10005, 102, 1, 1549, '2024-03-13 21:17:22', 'Confirmed', NULL),
(220, 10001, 102, 1, 2049, '2024-03-13 23:03:50', 'Confirmed', NULL),
(221, 10006, 102, 4, 10849, '2024-03-15 14:43:55', 'Confirmed', NULL),
(222, 10003, 102, 1, 2249, '2024-03-15 14:43:55', 'Confirmed', NULL),
(223, 10017, 102, 1, 849, '2024-03-15 14:45:08', 'Confirmed', NULL),
(224, 10004, 102, 1, 1249, '2024-03-15 14:45:54', 'Confirmed', NULL),
(225, 10027, 102, 2, 2649, '2024-03-15 14:54:33', 'Confirmed', NULL),
(226, 10006, 102, 1, 2749, '2024-03-15 15:44:44', 'Confirmed', NULL),
(227, 10006, 102, 1, 2749, '2024-03-15 16:23:32', 'Confirmed', NULL),
(228, 10023, 103, 1, 949, '2024-03-21 20:14:27', 'Confirmed', '109'),
(229, 10032, 103, 1, 2549, '2024-03-21 21:11:46', 'Confirmed', '106'),
(230, 10030, 104, 1, 2249, '2024-03-27 11:24:45', 'Shipped', '145'),
(231, 10016, 104, 1, 2149, '2024-03-27 11:40:55', 'Confirmed', '146'),
(232, 10021, 104, 1, 2649, '2024-03-27 11:40:55', 'Confirmed', '146'),
(233, 10021, 104, 1, 2649, '2024-03-27 12:20:34', 'Confirmed', '156'),
(234, 10001, 104, 2, 4049, '2024-03-28 16:44:38', 'Confirmed', '160'),
(235, 10034, 104, 2, 2449, '2024-03-28 16:44:38', 'Confirmed', '161'),
(236, 10019, 104, 1, 2149, '2024-03-28 17:21:33', 'Confirmed', '162'),
(237, 10034, 104, 1, 1249, '2024-03-28 17:39:27', 'Confirmed', '163'),
(238, 10024, 104, 1, 1749, '2024-03-28 18:14:17', 'Confirmed', NULL),
(239, 10001, 104, 1, 2049, '2024-03-28 18:15:02', 'Confirmed', NULL),
(240, 10000, 104, 5, 6549, '2024-03-28 18:28:45', 'Confirmed', '166'),
(242, 0, 0, 0, 0, '2024-03-28 18:41:56', '', NULL),
(244, 0, 0, 0, 0, '2024-03-28 18:42:55', '', NULL),
(245, 10016, 104, 1, 2149, '2024-03-28 18:50:10', 'Confirmed', '171'),
(246, 10007, 104, 1, 1449, '2024-03-28 20:06:24', 'Confirmed', '195'),
(247, 10028, 102, 1, 2249, '2024-03-28 22:29:52', 'Confirmed', '196'),
(248, 10004, 102, 1, 1249, '2024-03-28 22:40:54', 'Confirmed', '199'),
(249, 10000, 102, 1, 1349, '2024-03-29 07:46:21', 'Confirmed', ''),
(250, 10008, 102, 1, 2249, '2024-03-29 07:54:15', 'Confirmed', '201'),
(251, 10001, 102, 1, 2049, '2024-03-29 08:07:54', 'Confirmed', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `category` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` int(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `desc` longtext NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category`, `title`, `price`, `qty`, `desc`, `image`) VALUES
(10000, 1, 'Haworthia', 1300, 21, 'A real stand-out succulent plant, the striped appearance of the zebra Haworthia looks amazing. This slow-growing plant grows more than 6-8 inches in height. In addition, Haworthia is an ideal indoor plant to squeeze into tiny nooks.', 'product_27.png'),
(10001, 7, 'Begonia', 2000, 10, 'They have one big advantage over many other indoor plants, the endless variety in shapes and colours. Another big advantage of Begonias, they are pest resistant compared to other plants.', 'product_1.png'),
(10002, 8, 'African Violet', 1800, 22, 'One of the beautiful plants that bloom flowers in a range of colours including purple,pink,and white.', 'product_2.png'),
(10003, 7, 'Jasmine', 2200, 28, 'The sweetly-scented jasmine flower will fill your room with its heady scent. Despite being a vine that is usually grown outdoors, some jasmine varieties can be grown indoors as well.', 'product_3.png'),
(10004, 9, 'Polka Dot Plant', 1200, 13, 'They are also known as Freckle Faceplants. With attractive foliage, they come in a range of colors including green, cream, pink, and red.', 'product_4.png'),
(10005, 7, 'Prayer Plant', 1500, 29, 'The plant\'s holy name is because the leaves tend to fold in at night, resembling praying hands.', 'product_5.png'),
(10006, 5, 'Creeping Fig', 2700, 12, 'The most popular pick out of the entire Ficus genus is Creeping fig. It has thick leafed vines that look great in hanging baskets.', 'product_6.png'),
(10007, 8, 'Peace Lily', 1400, 34, 'This plant blooms in spring with long-lasting flower stalks that dangle gracefully over the foliage when it is used in a mass display.', 'product_7.png'),
(10008, 10, 'Snake Plant', 2200, 16, 'This plant is also known as Sansevieria or mother-in-law\'s tongue. They are adaptive to any place. The snake plant, which purifies the air, is an ideal plant for newbies.', 'product_8.png'),
(10009, 10, 'Spider Plant', 2400, 30, 'The plant has got this creepy-crawly name because of its slender leaves spilling over and creating other little plantlets.', 'product_9.png'),
(10010, 10, 'Aloe vera', 2800, 50, 'This plant is a gift for the skin. This stemless succulent is well known for its healing and air purification properties.', 'product_10.png'),
(10011, 9, 'English Ivy', 1700, 18, 'The English Ivy is a versatile plant that looks great when you grow them in a tiny pot. Their beautiful vines spill out the side, creating a wonderful display.', 'product_11.png'),
(10012, 10, 'String Of Pearls', 2900, 42, 'This pearl-like foliage hangs over its pot and makes an eye-catching piece of decor for all of your guests.', 'product_12.png'),
(10013, 6, 'Calathea Beauty Star', 2800, 15, 'We have lots of Calathea small indoor plants for you to choose from, and most of them have gorgeous foliage that will certainly add beauty to your home.', 'product_13.png'),
(10014, 6, 'Zeni ZZ', 2000, 32, 'This is a dwarf variety of the famous Zamioculcas Zamiifolia plant. Moreover, it only gets about 2 feet tall on maturity.', 'product_14.png'),
(10015, 3, 'Lucky Bamboo', 1200, 40, 'These Lucky bamboo plants, with eye-catching shapes, swirls, or braided stalks, can also be trained to grow straight as an arrow with simple, little floppy green leaves that adorn the stalks.', 'product_15.png'),
(10016, 4, 'African Violet', 2100, 33, 'This plant is famous for its coin-shaped, round green leaves. In Chinese culture, it is given as a gift to people and why shouldn\'t it be, after all, it can transform any space completely! ', 'product_16.png'),
(10017, 2, 'Pothos', 800, 34, 'This small plant has an attractive vine and heart-shaped leaves. You can grow this tiny one in a hanging basket or place it on your shelf or bookcase.', 'product_17.png'),
(10018, 6, 'Asparagus Fern', 1300, 24, 'It looks wonderful when paired with small, light-colored pots which will contrast against the green leaves.', 'product_18.png'),
(10019, 7, 'Rubber Plant', 2100, 25, 'Rubber trees can reach 10 feet in height. However, trimming their branches and leaves regularly will make them smaller.', 'product_19.png'),
(10020, 4, 'Fiddle leaf fig', 2400, 12, 'With its glossy, dark leaves, the fiddle leaf fig acts as an extra statement piece to any room.', 'product_20.png'),
(10021, 4, 'Giant bird of paradise', 2600, 21, 'The giant bird of paradise plant has tall stems with banana-like leaves. Flowers can bloom, but unfortunately, they don\'t appear indoors.', 'product_21.png'),
(10022, 6, 'Bamboo palm', 900, 45, 'The bamboo palm is pet friendly. So, your green friend and a furry friend can stay together.', 'product_22.png'),
(10023, 7, 'Heartleaf philodendron', 900, 44, 'This plant likes to climb and makes a great hanging plant.  It is incredibly hard to kill this plant, isn\'t it a piece of good news for new plant parents ?', 'product_23.png'),
(10024, 5, 'Monstera', 1700, 49, 'This Swiss Cheese plant has two sad news for you, they are poisonous and pricey.', 'product_24.png'),
(10025, 3, 'Echeverias', 1600, 38, 'Echeverias features foliage that forms a rosette shape. Also, you can get many colors in Echeveria including, purple, pink, red, blues, and even teals.', 'product_25.png'),
(10026, 4, 'Lithops', 1800, 32, 'They are also known as “living stones”, as they closely resemble pebbles and small stones.Due to their deceiving appearance, lithops will dazzle your guests!', 'product_26.png'),
(10028, 1, 'Bromeliads', 2200, 29, 'One of the beautiful plants that bloom flowers in a range of colours including purple, pink, and white.', 'product_28.png'),
(10029, 3, 'Baby Tears', 1800, 40, 'Baby Tears tolerate a range of light conditions, so they grow well on a windowsill or in a darker corner. Being a succulent, well-draining potting mix and irregular watering is important to keep this plant in good health.', 'product_29.png'),
(10030, 1, 'Giant Air Plant', 2200, 31, 'The plant\'s main requirement is bright, filtered light, so a spot on the patio or deck where it will receive indirect sunlight would be the best choice.', 'product_30.png'),
(10031, 1, 'Sky Plant', 2000, 45, 'They are always happiest with some fresh airflow and nutrients from the air. While they can survive indoors, they will be happiest in an open window.', 'product_31.png'),
(10032, 2, 'Bulbosa Belize', 2500, 34, 'This air plant has long twisted curly leaves grown from a large bulbous base. Its leaves can turn from green to bright red when the Bulbosa is about to bloom beautiful tubular bright purple flowers.', 'product_32.png'),
(10034, 5, 'APPLE', 1200, 3, 'SDFGHJ', 'product_1.png');

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `shipping_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `shipping_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `shipping_address` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `district` varchar(100) DEFAULT NULL,
  `postcode` varchar(20) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `mobile` bigint(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `mobile`, `email`, `password`) VALUES
(101, 'Rojina', 'Chhetri', 9814887699, 'rojina@123', 'c78f5c0242c96efb66dea507fe12edab'),
(102, 'Tina', 'Adhikari', 9807614152, 'tina@gmail.com', 'ef2afe0ea76c76b6b4b1ee92864c4d5c'),
(103, 'Aarti', 'Lama', 9814887699, 'aarti2@gmail.com', '4542e4c233f26b4faf6b5f3fed24280c'),
(104, 'Indira', 'Khanal', 9812345623, 'indu@123gmail.com', '6359ac636f27670995da8c85d56e1e9b'),
(105, 'Rojina', 'Chhetri', 9814887699, 'rojina@123gmail.com', '3275ff0830e6edbee98ad9a1f7fbf62a'),
(106, 'Indira', 'Khanal', 9812345, 'rojina@gmail.com', '1b15ebdbb483c17fbf73e994a5de8fbe'),
(107, 'sita', 'ram', 9814998766, 'sita@gmail.com', 'fc0df04c462b62930a8ffe49024e5bc6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_customer_id` (`customer_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`shipping_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=252;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10035;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `shipping_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `shipping`
--
ALTER TABLE `shipping`
  ADD CONSTRAINT `shipping_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`),
  ADD CONSTRAINT `shipping_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
