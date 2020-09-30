-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2020 at 12:15 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `capstonedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(50) NOT NULL,
  `admin_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `admin_email` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `admin_password` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `admin_image` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_email`, `admin_password`, `admin_image`) VALUES
(17, 'rawan tarabsheh', 'rawantarabsheh@gmail.com', '72ad812d1214d75def09513ce9618701', '17.png'),
(18, 'Rawan Tarabsheh', 'rawantarabsheh88@gmail.com', '72ad812d1214d75def09513ce9618701', '18.png'),
(20, 'Salameh Yaseen', 'salameh@gmail.com', '5d99ada0a07556923f70d5685c201d6d', '20.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id` int(50) NOT NULL,
  `title` varchar(100) COLLATE utf8_bin NOT NULL,
  `body` text COLLATE utf8_bin NOT NULL,
  `product_id` int(50) NOT NULL,
  `state` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `title`, `body`, `product_id`, `state`) VALUES
(1, 'The Chloe Collection', 'The Project Jacket', 22, 1),
(2, 'The Chloe Collection', 'Bow wrap skirt', 17, 1),
(3, 'The Chloe Collection', 'Women\'s Eyewear‎', 31, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(50) NOT NULL,
  `category_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `category_image` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_image`) VALUES
(8, 'Women’s fashion', '8.jpg'),
(9, 'Men’s fashion', '9.jpg'),
(10, 'Kid’s fashion', '10.jpg'),
(11, 'Cosmetic &amp; Skincare', '11.jpg'),
(12, 'Accessories', '12.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `contact_us_id` int(50) NOT NULL,
  `contact_us_name` varchar(100) COLLATE utf8_bin NOT NULL,
  `contact_us_email` varchar(100) COLLATE utf8_bin NOT NULL,
  `contact_us_message` text COLLATE utf8_bin NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`contact_us_id`, `contact_us_name`, `contact_us_email`, `contact_us_message`, `date`) VALUES
(4, 'rawan tarabsheh', 'rawan@gmail.com', 'hello', '2020-09-09'),
(5, 'rawan tarabsheh', 'rawantarabsheh@gmail.com', 'Test test', '2020-09-09'),
(6, 'rawan tarabsheh', 'rawantarabsheh@gmail.com', 'Test test', '2020-09-29'),
(7, 'rawan tarabsheh', 'rawantarabsheh@gmail.com', 'Test test', '2020-09-29');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(50) NOT NULL,
  `customer_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `customer_email` varchar(50) COLLATE utf8_bin NOT NULL,
  `customer_password` varchar(50) COLLATE utf8_bin NOT NULL,
  `customer_phone` int(50) NOT NULL,
  `customer_address` text COLLATE utf8_bin NOT NULL,
  `customer_image` varchar(50) COLLATE utf8_bin NOT NULL,
  `last_login` date NOT NULL,
  `login_attempts` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_name`, `customer_email`, `customer_password`, `customer_phone`, `customer_address`, `customer_image`, `last_login`, `login_attempts`) VALUES
(2, 'rawan tarabsheh', 'rawantarabsheh@yahoo.com', 'bd1f633a773150b905640631e1cfe050', 798441545, 'Al salt', '2.jpg', '2020-09-26', 0),
(3, 'sajedah tarabsheh', 'sajedahtarabsheh@gmail.com', '0120a59b22758f0937fa65e21d19390a', 798441545, 'Al salt', '3.jpg', '2020-09-26', 0),
(38, 'Test Custmer', 'rawantarabsheh@gmail.com', '72ad812d1214d75def09513ce9618701', 798441545, 'Al salt', '38.jpg', '2020-09-30', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(50) NOT NULL,
  `order_date` date NOT NULL,
  `customer_id` int(50) NOT NULL,
  `product_id` varchar(100) COLLATE utf8_bin NOT NULL,
  `qty` varchar(100) COLLATE utf8_bin NOT NULL,
  `payment_method` varchar(50) COLLATE utf8_bin NOT NULL,
  `total` int(11) NOT NULL,
  `notes` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_date`, `customer_id`, `product_id`, `qty`, `payment_method`, `total`, `notes`) VALUES
(10, '2020-09-18', 3, '28,29', '2,2', 'cash', 0, 'jjjkkjhkhlkhlk'),
(11, '2020-09-18', 3, '28', '3', 'cash', 36, 'cscscs'),
(12, '2020-09-18', 3, '28', '3', 'cash', 36, 'nfghm'),
(13, '2020-09-18', 33, '23', '1', 'cash', 20, 'wdwd'),
(14, '2020-09-18', 37, '17,16', '1,1', 'cash', 25, 'fergfrdf'),
(15, '2020-09-19', 3, '30', '1', 'cash', 20, 'dgsf'),
(16, '2020-09-19', 3, '29', '1', 'cash', 20, 'hkk'),
(17, '2020-09-19', 3, '29,28', '3,1', 'cash', 72, 'wdwdw'),
(18, '2020-09-19', 3, '29', '1', 'cash', 20, 'dwsd'),
(20, '2020-09-19', 3, '29', '1', 'cash', 20, 'dwad'),
(21, '2020-09-19', 3, '29', '1', 'cash', 20, 'n'),
(22, '2020-09-21', 3, '29', '2', 'cash', 40, 'test'),
(23, '2020-09-22', 3, '60,18', '1,1', 'cash', 20, 'jugigiuhij'),
(24, '2020-09-29', 3, '88', '1', 'cash', 20, 'test'),
(25, '2020-09-29', 3, '88,103', '1,1', 'cash', 40, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(50) NOT NULL,
  `product_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `product_desc` text COLLATE utf8_bin NOT NULL,
  `product_price` int(50) NOT NULL,
  `product_color` char(50) COLLATE utf8_bin NOT NULL,
  `product_size` varchar(50) COLLATE utf8_bin NOT NULL,
  `product_image` varchar(50) COLLATE utf8_bin NOT NULL,
  `other_images` varchar(100) COLLATE utf8_bin NOT NULL,
  `product_offer` int(50) NOT NULL,
  `sub_cat_id` int(50) NOT NULL,
  `state` int(50) NOT NULL,
  `date` date NOT NULL,
  `vendor_id` int(50) NOT NULL,
  `features` int(50) NOT NULL,
  `num_of_products` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_desc`, `product_price`, `product_color`, `product_size`, `product_image`, `other_images`, `product_offer`, `sub_cat_id`, `state`, `date`, `vendor_id`, `features`, `num_of_products`) VALUES
(17, 'MANGO Black Solid Handheld Bag', 'PRODUCT DETAILS \r\nBlack solid handheld bag has a zip closure\r\n1 main compartment, 1 inner pocket\r\nWith a non-detachable sling strap\r\n\r\nSize &amp;amp; Fit\r\nHeight: 22 cm\r\nWidth: 37 cm\r\nDepth: 10 cm\r\n\r\nMaterial &amp;amp; Care\r\nPU\r\nWipe with a clean, dry cloth to remove dust', 20, '#030303', 'Free Size', '17.jpg', '1.jpg,2.jpg,3.jpg', 15, 57, 1, '2020-09-16', 14, 2, 0),
(18, 'Beige - Denim  - Pants', 'Product Details: \r\n\r\nReturn within 14 days.\r\n\r\nFabric Info: 100% Cotton\r\n\r\nSize of the item on the image: Size: 38, Waist: 74 cm, Hips: 98 cm\r\n\r\nThere is an approximately a 4 cm difference between sizes.\r\n\r\nDelivery: This item will be dispatched in 24 hours', 100, '#000000', 'Free Size', '18.jpg', '1.jpg,2.jpg,3.jpg', 5, 5, 1, '2020-09-16', 14, 2, 19),
(22, 'Multi - Boys` Sweatshirt', 'Product Details: \r\n\r\nReturn within 14 days.\r\nFabric Info: 50% Polyester, 50% Cotton\r\n\r\nThere is approximately a 4 cm difference between sizes.', 20, '#000000', 'Free Size', '22.jpg', '1.jpg,2.jpg,3.jpg', 0, 35, 1, '2020-09-09', 13, 1, 20),
(23, 'Multi - Boys` Boots', 'Product Details: Multi - Boys` Boots\r\n\r\nReturn within 14 days.\r\n\r\nFabric Info: Made by natural fibers, gives a soft, easy, comfortable feel and use. Plus a higher capacity of holding moisture.\r\n\r\n100% Viscose\r\n\r\nThere is an approximately 4 cm difference between sizes', 20, '#000000', 'XS', '23.jpg', '1.jpg,2.jpg,3.jpg', 0, 37, 1, '2020-09-11', 13, 3, 20),
(29, 'Blue - Denim - Cotton -  Pants', 'Product Details: \r\n\r\nReturn within 14 days.\r\n\r\nFabric Info: 100% Cotton\r\n\r\nSize of the item on the image: Size: 38, Height: 97 cm, Waist: 74 cm, Hips: 98 cm\r\n\r\nThere is an approximately a 4 cm difference between sizes.\r\n\r\nDelivery: This item will be dispatched in 24 hours', 20, '#000000', 'XS,S,L,XL', '29.jpg', '1.jpg,2.jpg,3.jpg', 12, 5, 1, '2020-09-16', 14, 2, 3),
(31, 'Women\'s Eyewear‎', 'Eyewear‎', 10, '#000000', 'Free Size', '31.jpg', '1.jpg,2.jpg,3.jpg', 0, 53, 1, '2020-09-16', 13, 3, 20),
(48, 'Navy Blue - Crew neck', 'Return within 14 days\r\nFabric Info: The elasticity of the material enables strength and durability. The lightweight of the fabric keeps the condition better for longer use.\r\nPolyester, Unlined\r\n\r\nSize of the item on the image: Size: 38, Height: 150 cm, Bust: 94 cm, Waist: 98 cm, Hips: 124 cm\r\nThere is an approximately a 4 cm difference between sizes.\r\n\r\nDelivery: This item will be dispatched in 24 hours', 30, '#161fa7', 'Free Size', '48.jpg', '1.jpg,2.jpg,3.jpg', 20, 3, 1, '2020-09-21', 13, 2, 20),
(49, 'Blue - Stripe - Crew neck ', 'Product Details:\r\n\r\nReturn within 14 days\r\n\r\nFabric Info: 100% Cotton, Fully Lined\r\n\r\nLined\r\n\r\nItems included in the price: Belt\r\n\r\nSize of the model: Size: 36, Height: 176 cm, Bust: 89 cm, Waist: 66 cm, Hips: 96 cm\r\n\r\nSize of the item on the image: Size: 38, Bust: 100 cm, Waist: 40 cm, Hips: 140 cm, Front Size: 140 cm\r\n\r\nThere is an approximately 4 cm difference between sizes.\r\n\r\nDelivery: This item will be dispatched in 24 hours', 30, '#b5e0f2', 'XS,S,L,XL', '49.jpg', '1.jpg,2.jpg,3.jpg', 0, 3, 1, '2020-09-21', 13, 1, 20),
(50, 'Khaki - Point Collar - ', 'Product Details: \r\n\r\nReturn within 14 days.\r\n\r\nFabric Info: 35% Polyester, 65% Cotton, Unlined\r\n\r\nItems included in the price: Belt\r\n\r\nSize of the item on the image: Size: 38, Bust: 96 cm, Waist: 86 cm, Hips: 128 cm\r\n\r\nThere is an approximately 4 cm difference between sizes.Size Chart\r\n\r\nDelivery: This item will be dispatched in 24 hours', 35, '#7f9f8f', 'Free Size', '50.jpg', '1.jpg,2.jpg,3.jpg', 0, 3, 1, '2020-09-21', 14, 3, 20),
(51, 'Dusty Rose - Dusty Rose - Crew neck ', 'Product Details:\r\n\r\nReturn within 14 days.\r\n\r\nFabric Info: The elasticity of the material enables strength and durability. Lightweight of the fabric keeps the condition better for longer use.\r\n\r\nPolyester, Unlined\r\n\r\nSize of the item on the image: Size: 38, Height: 144 cm, Bust: 100 cm, Waist: 116 cm, Hips: 120 cm\r\n\r\nThere is an approximately 4 cm difference between sizes.\r\n\r\nDelivery: This item will be dispatched in 24 hours', 55, '#b18686', 'Free Size', '51.jpg', '1.jpg,2.jpg,3.jpg', 35, 3, 1, '2020-09-21', 14, 2, 10),
(52, 'Powder - Floral - Crew neck ', 'Product Details: \r\n\r\nReturn within 14 days.\r\n\r\nFabric Info: Made by natural fibers, gives a soft, easy, comfortable feel and use. Plus a higher capacity of holding moisture.\r\n\r\n100% Viscose, Unlined\r\n\r\nSize of the model: Size: 36, Height: 178 cm, Bust: 88 cm, Waist: 60 cm, Hips: 91 cm\r\n\r\nSize of the item on the image: Size: 38, Bust: 100 cm, Waist: 100 cm, Hips: 130 cm\r\n\r\nThere is an approximately 4 cm difference between sizes.\r\n\r\nDelivery: This item will be dispatched in 24 hours', 42, '#ad7f7f', 'Free Size', '52.jpg', '1.jpg,2.jpg,3.jpg', 0, 3, 1, '2020-09-21', 14, 1, 20),
(53, 'Plum - Crew neck ', 'Product Details: \r\n\r\nReturn within 14 days.\r\n\r\nFabric Info: The elasticity of the material enables strength and durability. The lightweight of the fabric keeps the condition better for longer use.\r\n\r\nPolyester, Unlined\r\n\r\nSize of the item on the image: Size: 38, Height: 150 cm, Bust: 94 cm, Waist: 98 cm, Hips: 124 cm\r\n\r\nThere is an approximately 4 cm difference between sizes.\r\n\r\nDelivery: This item will be dispatched in 24 hours', 20, '#834949', 'XL', '53.jpg', '1.jpg,2.jpg,3.jpg', 0, 3, 1, '2020-09-21', 14, 1, 20),
(54, 'Minc - Plain - Pashmina', 'Product Details: \r\n\r\nReturn within 14 days. \r\n\r\nFabric Info: Made by natural fibers, gives a soft, easy, comfortable feel and use. Plus a higher capacity of holding moisture.\r\n\r\n100% Viscose\r\n\r\nSize of the item on the image: Size: Standart, Width: 65 cm, Height: 170 cm\r\n\r\nDelivery: This item will be dispatched in 24 hours', 12, '#c08c8c', 'Free Size', '54.jpg', '1.jpg,2.jpg,3.jpg', 0, 12, 1, '2020-09-21', 14, 1, 20),
(55, 'Blue - Plain - Shawl', 'Product Details: \r\n\r\nReturn within 14 days.\r\n\r\nFabric Info: Made by natural fibers, gives a soft, easy, comfortable feel and use. Plus a higher capacity of holding moisture.\r\n\r\n100% Viscose\r\n\r\nSize of the item on the image: Size: Standart, Width: 65 cm, Height: 172 cm\r\n\r\nDelivery: This item will be dispatched in 24 hours', 17, '#5fb3b9', 'Free Size', '55.jpg', '1.jpg,2.jpg,3.jpg', 15, 12, 1, '2020-09-21', 14, 2, 15),
(56, 'Multi - Printed - Pashmina', 'Product Details:\r\n\r\nReturn within 14 days.\r\n\r\nFabric Info: The elasticity of the material enables strength and durability. The lightweight of the fabric keeps the condition better for longer use.\r\n\r\nPolyester\r\n\r\nSize of the item on the image: Size: Standart, Width: 66 cm, Height: 170 cm\r\n\r\nDelivery: This item will be dispatched in 24 hours', 10, '#8e6767', '', '56.jpg', '1.jpg,2.jpg,3.jpg', 7, 12, 1, '2020-09-21', 13, 2, 15),
(57, 'Black - Skirt', 'Product Details: \r\n\r\nReturn within 14 days.\r\n\r\nFabric Info: The elasticity of the material enables strength and durability. The lightweight of the fabric keeps the condition better for longer use.\r\n\r\nPolyester\r\n\r\nThere is an approximately 4 cm difference between sizes', 12, '#000000', 'Free Size', '57.png', '1.jpg,2.jpg,3.jpg', 0, 4, 1, '2020-09-22', 14, 3, 20),
(58, 'Gray - Skirt', 'Product Details: \r\n\r\nReturn within 14 days.\r\n\r\nFabric Info: 30% Polyester, 65% Cotton, 5% Elastane\r\n\r\nSize of the item on the image: Size: S\r\n\r\nThere is an approximately 4 cm difference between sizes', 20, '#aba0a0', 'Free Size', '58.jpg', '1.jpg,2.jpg,3.jpg', 0, 4, 1, '2020-09-22', 14, 0, 20),
(59, 'White - Skirt', 'Product Details: \r\n\r\nReturn within 14 days.\r\n\r\nFabric Info: The elasticity of the material enables strength and durability. The lightweight of the fabric keeps the condition better for longer use.\r\n\r\nPolyester\r\n\r\nSize of the item on the image: Size: S-M, Height: 95 cm, Bust: 68 cm, Waist: 106 cm\r\n\r\nThere is an approximately 4 cm difference between sizes.\r\n\r\nDelivery: This item will be dispatched in 24 hours', 20, '#f3f1f1', 'Free Size', '59.jpg', '1.jpg,2.jpg,3.jpg', 0, 4, 1, '2020-09-15', 13, 3, 20),
(60, 'Saxe - Unlined - Skirt', 'Product Details: \r\n\r\nReturn within 14 days.\r\n\r\nFabric Info: The elasticity of the material enables strength and durability. Lightweight of the fabric keeps the condition better for longer use. The blend of Lycra enables free movement and easy adaptation of the body.\r\n\r\n95% Polyester, 5% Lycra, Unlined\r\n\r\nItems excluded: Bag, Belt\r\n\r\nSize of the item on the image: Size: 38, Waist: 72 cm, Hips: 82 cm, Front Size: 89 cm\r\n\r\nThere is an approximately 4 cm difference between sizes.\r\n\r\nDelivery: This item will be dispatched in 24 hours', 10, '#6685f4', 'Free Size', '60.jpg', '1.jpg,2.jpg,3.jpg', 0, 4, 1, '2020-09-15', 13, 3, 19),
(61, 'Black -  Pants', 'Product Details: \r\n\r\nReturn within &quot;14 days.\r\n\r\nFabric Info: 40% Polyester, 60% Cotton\r\n\r\nSize of the item on the image: Size: 38, Hips: 104 cm, Front Size: 97 cm\r\n\r\nThere is an approximately 4 cm difference between sizes.Size Chart\r\n\r\nDelivery: This item will be dispatched in 24 hours', 20, '#000000', 'Free Size', '61.jpg', '1.jpg,2.jpg,3.jpg', 0, 5, 1, '2020-09-22', 13, 1, 20),
(62, 'Beige - Pants', 'Product Details: \r\n\r\nReturn within 14 days.\r\n\r\nFabric Info: 86% Polyester, 14% Elastane\r\n\r\nSize of the model: Size: 39, Height: 176 cm, Bust: 88 cm, Waist: 60 cm, Hips: 99 cm\r\n\r\nSize of the item on the image: Size: 38, Waist: 76 cm, Hips: 90 cm, Front Size: 108 cm\r\n\r\nThere is an approximately 4 cm difference between sizes\r\n\r\nDelivery: This item will be dispatched in 24 hours', 20, '#d09a9a', 'Free Size', '62.jpg', '1.jpg,2.jpg,3.jpg', 0, 5, 1, '2020-09-22', 13, 3, 20),
(63, 'Maroon - Boy Sweatshirts', 'Product Details: \r\n\r\nReturn within 14 days.\r\n\r\nFabric Info: 97% Cotton, 3% Elastane\r\n\r\nThere is an approximately a 4 cm difference between sizes.', 20, '#740101', 'Free Size', '63.jpg', '1.jpg,2.jpg,3.jpg', 0, 35, 1, '2020-09-23', 13, 1, 20),
(64, 'Navy Blue - Boys` Sweatshirt', 'Product Details: \r\n\r\nReturn within 14 days.\r\n\r\n\r\nFabric Info: 40% Polyester, 60% Cotton\r\n\r\nThere is approximately 4 cm difference between sizes.', 20, '#a29a9a', 'Free Size', '64.jpg', '1.jpg,2.jpg,3.jpg', 0, 36, 1, '2020-09-22', 13, 1, 20),
(65, 'Gray - Boys` Sweatshirt', 'Product Details: \r\n\r\nReturn within 14 days.\r\nFabric Info: 50% Polyester, 50% Cotton\r\n\r\nThere is an approximately 4 cm difference between sizes', 20, '#a9a2a2', 'Free Size', '65.jpg', '1.jpg,2.jpg,3.jpg', 0, 36, 1, '2020-09-22', 13, 1, 20),
(66, 'Black - Boots', 'Product Details: Black - Boots\r\n\r\nReturn within 14 days.\r\n\r\nFabric Info: 100% Artificial Leather', 15, '#000000', 'XS,S,L,XL', '66.jpeg', '1.jpeg,2.jpeg,3.jpeg', 0, 51, 1, '2020-09-15', 13, 3, 20),
(67, 'Tan - Boot - Boots', 'Product Details: Tan - Boot - Boots\r\n\r\nReturn within 14 days.\r\n\r\nFabric Info: 100% Artificial Leather\r\n\r\nSize of the item on the image: Size: 36, Heels: 3 cm\r\n\r\nDelivery: This item will be dispatched in 24 hours', 20, '#5e4308', 'XS,S,L,XL', '67.jpg', '1.jpg,2.jpg,3.jpg', 0, 51, 1, '2020-09-21', 13, 1, 20),
(68, 'Beige - Boot - Boots', 'Product Details: Beige - Boot - Boots\r\n\r\nReturn within 14 days.\r\n\r\nFabric Info: 100% Artificial Leather\r\n\r\nSize of the item on the image: Size: 36, Heels: 5 cm\r\n\r\nDelivery: This item will be dispatched in 24 hours', 25, '#e8c0c0', 'XS,S,L,XL', '68.jpg', '1.jpg,2.jpg,3.jpg', 0, 51, 1, '2020-09-22', 13, 1, 10),
(69, 'Tan - Boot - Boots', 'Product Details: Tan - Boot - Boots\r\n\r\nReturn within 14 days.\r\n\r\nFabric Info: 100% Artificial Leather\r\n\r\nSize of the item on the image: Size: 36\r\n\r\nDelivery: This item will be dispatched in 24 hours', 20, '#000000', 'XS,S,L,XL', '69.jpg', '1.jpg,2.jpg,3.jpg', 10, 51, 1, '2020-09-22', 13, 2, 20),
(70, 'Ecru - Boys` Sweatshirt', 'Product Details: Ecru - Boys` Sweatshirt\r\n\r\nReturn within 14 days.\r\n\r\nFabric Info: 97% Cotton, 3% Elastane\r\n\r\nThere is an approximately  4 cm difference between sizes.', 20, '#645959', 'Free Size', '70.jpg', '1.jpg,2.jpg,3.jpg', 0, 47, 1, '2020-09-22', 13, 1, 20),
(71, 'Navy Blue - Girls` Skirt', 'Product Details: Navy Blue - Girls` Skirt\r\n\r\nReturn within 14 days\r\nFabric Info: 95% Cotton, 5% Elastane\r\n\r\nThere is an approximately 4 cm difference between sizes', 20, '#0b0a1e', 'Free Size', '71.jpg', '1.jpg,2.jpg,3.jpg', 0, 46, 1, '2020-09-22', 13, 1, 20),
(72, 'Pink - Girls` Skirt', 'Product Details: Pink - Girls` Skirt\r\n\r\nReturn within 14 days.\r\n\r\nFabric Info: The elasticity of the material enables strength and durability. The lightweight of the fabric keeps the condition better for longer use.\r\n\r\nPolyester\r\n\r\nThere is an approximately 4 cm difference between sizes.', 10, '#b69090', 'Free Size', '72.jpg', '1.jpg,2.jpg,3.jpg', 0, 46, 1, '2020-09-21', 13, 1, 20),
(73, 'Pink - Baby Jacket', 'Product Details: Pink - Baby Jacket\r\n\r\nReturn within 14 days.\r\n\r\nFabric Info: The elasticity of the material enables strength and durability. The lightweight of the fabric keeps the condition better for longer use.\r\n\r\nPolyester\r\n\r\nThere is an approximately 4 cm difference between sizes.', 20, '#f6c1c1', 'Free Size', '73.jpg', '1.jpg,2.jpg,3.jpg', 0, 45, 1, '2020-09-21', 14, 1, 20),
(74, 'Tan - Satchel - Shoulder Bags', 'Product Details: Tan - Satchel - Shoulder Bags\r\n\r\nReturn within 14 days.\r\n\r\nFabric Info: 100% Artificial Leather\r\n\r\nSize of the item on the image: Size: Standart\r\n\r\nThere is an approximately a 4 cm difference between sizes.\r\n\r\nDelivery: This item will be dispatched in 24 hours', 10, '#a56c09', 'Free Size', '74.jpg', '1.jpg,2.jpg,3.jpg', 0, 57, 1, '2020-09-24', 13, 1, 20),
(75, 'Powder - Shoulder Bags', 'Product Details: Powder - Shoulder Bags\r\n\r\nReturn within 14 days.\r\n\r\nFabric Info: 100% Artificial Leather\r\n\r\nSize of the item on the image: Size: Standart, Width: 25 cm, Height: 33 cm\r\n\r\nThere is an approximately a 4 cm difference between sizes.', 20, '#000000', 'Free Size', '75.jpg', '1.jpg,2.jpg,3.jpg', 10, 57, 1, '2020-09-16', 14, 2, 20),
(76, 'Black - Casual - Shoes', 'Product Details: Black - Casual - Shoes\r\n\r\nReturn within 14 days.\r\n\r\nFabric Info: 100% Artificial Leather\r\n\r\nSize of the item on the image: Size: 36, Heels: 2 cm\r\n\r\nThere is an approximately 4 cm difference between sizes.\r\n\r\nDelivery: This item will be dispatched in 24 hours', 20, '#000000', 'XS,S,L,XL', '76.jpg', '1.jpg,2.jpg,3.jpg', 0, 54, 1, '2020-09-23', 13, 3, 10),
(77, 'Body care', 'Product Details: Bodycare\r\n\r\nReturn within 14 days.\r\n\r\nEditor’s Note:\r\n\r\nThanks to the panthenol it contains, it moisturizes the skin, strengthens the skin barrier, and helps the skin to protect against external factors, keeping it soft, supple, smooth, and moist\r\n\r\nSize of the item on the image: Size: Standart\r\n\r\nThere is an approximately 4 cm difference between sizes.', 10, '#b99e18', 'L', '77.jpg', '1.jpg,2.jpg,3.jpg', 0, 22, 1, '2020-09-22', 14, 3, 20),
(78, '100ml - Bodycare', 'Product Details: Bodycare\r\n\r\nReturn within  14 days.\r\n\r\nEditor’s Note:\r\n\r\nEnriched with vitamin E and chamomile extract, Soft hand care creams are easily absorbed and leave a pleasant chamomile scent on the skin. It helps to nourish and moisturize the skin which is worn out by external factors.\r\n\r\nSize of the item on the image: Size: Standart\r\n\r\nThere is an approximately 4 cm difference between sizes.', 10, '#f0e6e6', 'S', '78.jpg', '1.jpg,2.jpg,3.jpg', 0, 22, 1, '2020-09-22', 13, 1, 20),
(79, 'Compression Set', 'Men Gym Clothes Man Compression Set 3-pieces\r\nMen Brand Tracksuit Rashguard Kit Quick-drying Men Gym Clothes Man Compression Underwear 3-piece Set Long Johns Collar: O-NeckPant Closure Type: Zipper FlyStyle: CasualMaterial Composition: Cotton, PolyesterPattern Type: PatchworkOut Side Length: HoodieSleeve Length(cm): FullDecoration: PocketsClosure Type: ZipperMaterial: PolyesterAttribute: summer shirt, sport suit men, men\'s sports attribute 1: sportswear for men, men sweatshirt pants style: Hoodie pants 3 set occasion: Fast drying Breathablestyle2: Long sleeve and pants and shorts', 35, '#000000', 'XS,S,L,XL', '79.jpg', '1.jpg,2.jpg,3.jpg', 0, 15, 1, '2020-09-22', 14, 1, 20),
(80, 'SPORT SUIT MEN ', 'Sport Suit Men Bodybuilding Jacket Pants Sports Suits Basketball Tights Clothes Gym Fitness Running Set Men Tracksuits 3XL\r\n\r\nGender: Men Material Composition: Cotton and polyester Collar: O-Neck Pattern Type: Solid Style: Casual Out Side Length: 106cm Pant Closure Type: Drawstring Material: COTTON Closure Type: None Brand Name: BAODINONG Sleeve Length(cm): Full Decoration: Pockets', 55, '#a8a3a3', 'XS,S,L,XL', '80.jpg', '1.jpg,2.jpg,3.jpg', 0, 15, 1, '2020-09-22', 14, 1, 20),
(81, 'Gym Sportkleding', 'Gym Sportswear Suit Men Running Sports Tracksuits Fitness Sweatshirt Sweatpants Male Cotton Hoodie Pants Sets Jogging Tops Jacket | Running Sets | - AliExpress', 50, '#212a45', 'Free Size', '81.jpg', '1.jpg,2.jpg,3.jpg', 0, 15, 1, '2020-09-22', 14, 0, 20),
(82, 'Men’s Fashion Tracksuit ', 'Men’s Fashion Tracksuit 2019 New Brand Two Piece Set Sleeveless Hooded Sweatshirt And Pants Set\r\nGender: Men\r\nCollar: O-Neck\r\nPant Closure Type: Zipper Fly\r\nBrand Name: BRZK\r\nMaterial Composition: Polyester\r\nSleeve Length(cm): Sleeveless\r\nMaterial: COTTON\r\nPattern Type: Patchwork\r\nOut Side Length: Hoodie\r\nStyle: Preppy Style\r\nDecoration: Appliques\r\nClosure Type: zipper\r\n', 55, '#000000', 'XS,S,L,XL', '82.jpg', '1.jpg,2.jpg,3.jpg', 35, 15, 1, '2020-09-22', 14, 2, 20),
(83, 'Casual shirt ', 'Casual shirt for men\'s slim fit\r\nCasual slim long sleeve shirt for men. High-quality special army green color. Buy in our catalog online store The-Casual. Free delivery.', 20, '#193e22', 'XS,S,L,XL', '83.jpg', '1.jpg,2.jpg,3.jpg', 0, 14, 1, '2020-09-22', 13, 1, 20),
(84, 'men shirts', 'Men\'s Long Sleeve Printed Dress Shirts Casual Button-Down Regular Fit Men Shir.\r\nButton closure\r\nTumble dry\r\nSOFT AND COMFORTABLE TO WEAR: the men’s dress shirts are comfy when wearing. Thoughtful design with soft cotton contrast on collar and cuffs gives you a casual feeling.\r\nFASHIONABLE AND STYLISH: long sleeve and short sleeve shirts. Red, blue, gray, white, black dress shirt with various prints match your different dressing styles.', 20, '#000000', 'Free Size', '84.jpg', '1.jpg,2.jpg,3.jpg', 10, 14, 1, '2020-09-22', 14, 2, 20),
(85, 'Essential dress pants ', 'Essential dress pants crafted in Italian wool with a touch of stretch for techno-wool performance.\r\nBelt loops\r\nZip fly with tab-button closure\r\nSide slash pockets\r\nBack buttoned welt pockets\r\nFront and back pleats\r\nWool/elastane\r\nDry clean\r\nImported of Italian fabric\r\n\r\nSIZE &amp; FIT\r\nRegular-fit, Straight leg\r\nRise, about 10&quot;\r\nInseam, about 38&quot;\r\nLeg opening, about 15&quot;', 15, '#000000', 'Free Size', '85.png', '1.png,2.png,3.png', 0, 17, 1, '2020-09-22', 13, 1, 20),
(86, 'Handsome trousers', 'Details:\r\nHandsome trousers constructed from a soft stretch-cotton fabric and cut in a slim-fit.\r\nBelt loops\r\nZip fly with button closure\r\nSide seam pockets\r\nBack welt pockets\r\nCotton/spandex\r\nDry clean\r\nImported\r\n\r\nSIZE &amp; FIT\r\nRise, about 10&quot;\r\nInseam, about 34&quot;\r\nLeg opening, about 14&quot;\r\n', 20, '#000000', 'XS,S,L,XL', '86.png', '1.png,2.png,3.png', 0, 17, 1, '2020-09-16', 13, 1, 20),
(87, 'Lightweight pants', 'Details:\r\nLightweight fabrication highlights these tapered pants to dapper effects.\r\nBelt loops\r\nZip fly with button closure\r\nSide slash pockets\r\nBack welt pockets\r\nCotton/elastane/spandex\r\nMachine wash\r\nMade in Italy\r\n\r\nSIZE &amp;amp; FIT\r\nRise, about 10.5&amp;quot;\r\nInseam, about 32&amp;quot;', 20, '#000000', 'XS', '87.png', '1.png,2.png,3.png', 0, 17, 1, '2020-09-23', 14, 3, 20),
(88, 'Straight leg pants', ']Details:\r\nStraight leg pants crafted from a stretch blend of cotton and silk\r\nBelt loops\r\nZip fly with button closure\r\nSide slash pockets\r\nBack buttoned welt pockets\r\nRise, about 10&quot;\r\nInseam, about 34&quot;\r\nLeg opening, about 14&quot;\r\nCotton/silk/spandex\r\nDry clean\r\nMade in Italy', 20, '#372306', 'Free Size', '88.png', '1.png,2.png,3.png', 0, 17, 1, '2020-09-16', 14, 1, 18),
(89, 'sleep pants', 'Details:\r\nGraffiti logos adorn these joggers in an allover manner.\r\nElasticized drawstring waist\r\nPull-on style\r\nSide seam welt pockets\r\nBack zip welt pocket\r\nRib-knit cuffs\r\nCotton\r\nMachine wash\r\nMade in Italy\r\n\r\nSIZE &amp; FIT\r\nInseam, about 32&quot;', 10, '#000000', 'Free Size', '89.png', '1.png,2.png,3.png', 0, 16, 1, '2020-09-23', 13, 3, 30),
(90, 'Puma x KidSuper Logo Tape Track Pants', 'Details:\r\nFrom the Puma x KidSuper Collaboration. Athleisure track pants topped with a logo graphic print, patch detail, and side stripe taping design.\r\nElasticized drawstring waist\r\nPull-on style\r\nSide welt pockets\r\nBack welt pocket\r\nElasticized cuffs\r\nNylon\r\nMachine wash\r\nImported\r\n\r\nSIZE &amp; FIT\r\nInseam, about 32&quot;\r\n', 20, '#000000', 'XL', '90.png', '1.png,2.png,3.png', 0, 16, 1, '2020-09-22', 14, 1, 20),
(91, 'Fleece Slim-Fit Sweatpants', '\r\nDetails\r\nAthleisure sweatpants flaunt soft fleece fabrication, side logo detailing, and a stylish slim-fit cut.\r\nDrawstring waist\r\nPull-on styling\r\nSide seam pockets\r\nZip hem\r\nBack welt pocket\r\nOrganic cotton/polyester\r\nMachine wash\r\nImported', 10, '#000000', 'XS', '91.png', '1.png,2.png,3.png', 0, 16, 1, '2020-09-22', 14, 3, 20),
(92, 'Logo Sport Jogging Pants', 'deatials:\r\nAthleisure, in essence, these joggers with color block styling showcase side stripes and signature logo.\r\nElasticized waist\r\nPull-on style\r\nSide pockets\r\nElasticized zip cuffs\r\nPolyamide\r\nMachine wash\r\nImported\r\n\r\nSIZE &amp;amp; FIT\r\nInseam, about 28&amp;quot;', 35, '#000000', 'S', '92.png', '1.png,2.png,3.png', 10, 16, 1, '2020-09-22', 14, 2, 10),
(93, 'Classic Fit Tonal Wool Tuxedo', 'Details:\r\nTonal wool with textured trim adds subtle luxury to a classic tuxedo. Wool. Dry clean. Made in Italy.\r\n\r\nJACKET\r\nNotch lapels\r\nLong sleeves\r\nButton cuffs\r\nButton front\r\nChest and waist welt pockets\r\nDual back vents\r\nTextured trim\r\nAbout 29&quot; from shoulder to hem\r\n\r\nPANTS\r\nRise, about 11&quot;\r\nInseam, about 36&quot;', 100, '#3b435e', 'XS,S,L,XL', '93.png', '1.png,2.png,3.png', 0, 13, 1, '2020-09-22', 13, 1, 20),
(94, 'Twill Wool Suit', 'Details:\r\nCanali\r\nTwill Wool Suit\r\nColor -Navy\r\nSize -\r\nSize Guide\r\n48 (38) R50 (40) R50 (40) S52 (42) L52 (42) R52 (42) S54 (44) L54 (44) R56 (46) L56 (46) R58 (48) R60 (50) R\r\nPlease note\r\nThis item cannot be shipped to Jordan\r\n\r\nJOD 1,756.18\r\n$35-$700 GIFT CARD WITH CODE SEPGCSF\r\n\r\nSHIP ITPICK UP IN STORE\r\nColor/size unavailable? Add to Wait List\r\nWoven into a twill finish, this suit is a minimalist basic. Wool. Dry clean. Made in Italy.\r\n\r\nJACKET\r\nNotch lapels\r\nLong sleeves\r\nButton front\r\nChest welt pocket\r\nWaist flap pockets\r\nDual back vents\r\nLined\r\n\r\nPANTS\r\nZip fly with button closure\r\nSide and back pockets\r\nFront and back pleats\r\n\r\nSIZE &amp; FIT\r\nJacket, about 30&quot; from shoulder to hem\r\nRise, about 10&quot;\r\nInseam, about 32&quot;\r\nLeg opening, about 14&quot;', 75, '#1e24cc', 'Free Size', '94.png', '1.png,2.png,3.png', 0, 13, 1, '2020-09-22', 14, 2, 10),
(95, 'Alinzs Tuxedo Jacket', '\r\nDetails:\r\nWoven into a twill finish, this suit is a minimalist basic. Wool. Dry clean. Made in Italy.\r\n\r\nJACKET\r\nNotch lapels\r\nLong sleeves\r\nButton front\r\nChest welt pocket\r\nWaist flap pockets\r\nDual back vents\r\nLined\r\n\r\nPANTS\r\nZip fly with button closure\r\nSide and back pockets\r\nFront and back pleats\r\n\r\nSIZE &amp;amp;amp;amp;amp; FIT\r\nJacket, about 30&amp;amp;amp;amp;quot; from shoulder to hem\r\nRise, about 10&amp;amp;amp;amp;quot;\r\nInseam, about 32&amp;amp;amp;amp;quot;\r\nLeg opening, about 14&amp;amp;amp;amp;quot;', 80, '#000000', 'Free Size', '95.png', '1.png,2.png,3.png', 0, 13, 1, '2020-09-22', 14, 3, 20),
(96, 'M Line Stretch Wool Tuxedo', 'Details:\r\nElegant tuxedo in a timeless silhouette. Wool/elastane. Dry clean. Made in Italy.\r\n\r\nJACKET\r\nNotch lapels\r\nLong sleeves\r\nButton cuffs\r\nButton front\r\nChest welt pocket\r\nWaist welt pockets\r\nDual back vents\r\nAbout 27” from shoulder to hem\r\n\r\nPANTS\r\nBelt loops\r\nZip fly with concealed hook-and-bar closure\r\nOn-seam pockets\r\nBack buttoned welt pockets\r\nRise, about 14”\r\nInseam, about 34”\r\n\r\nPlease note: The garment tag indicates Italian sizing. Sizes above are listed with the Italian size followed by the US size in brackets.', 100, '#000000', 'XS,S,L,XL', '96.png', '1.png,2.png,3.png', 0, 13, 1, '2020-09-22', 13, 1, 10),
(97, 'Heure H 21MM Goldplated &amp; Leather Strap Watch', 'Details:\r\nFrom the Heure H Collection. Sleek signature H-shaped case set on a leather strap.\r\nSwiss quartz movement\r\nWhite dial\r\nArabic numerals\r\nPin buckle with gold plating\r\nHermès 2 years International warranty\r\nMade in Switzerland\r\n\r\nFEATURES\r\nWater-resistant to 3 ATM\r\n\r\nSIZES\r\nSquare yellow goldplated stainless steel case, 21mm (0.82&quot;)\r\nInterchangeable gold grained calf strap, 16mm x 14mm (0.62&quot; x 0.55&quot;)', 50, '#000000', 'Free Size', '97.png', '1.png,2.png,3.png', 0, 52, 1, '2020-09-22', 13, 1, 10),
(98, 'Heure H 21MM Goldplated &amp; Leather Strap Watch', 'Details:\r\nFrom the Heure H Collection. Signature H-shaped case set on a grained leather strap.\r\nQuartz movement\r\nArabic numeral hour markers\r\nSapphire crystal\r\nWhite dial\r\nPin buckle with gold plating\r\nHermès 2 years International warranty\r\nMade in Switzerland\r\n\r\nFEATURES\r\nWater-resistant to 3 ATM\r\n\r\nSIZES\r\nH-shaped goldplated stainless steel case, 21mm x 21mm (0.8&quot;)\r\nInterchangeable black grained calf strap, 16mm x 14mm (0.62&quot; x 0.55&quot;)', 15, '#000000', 'Free Size', '98.png', '1.png,2.png,3.png', 0, 52, 1, '2020-09-22', 13, 1, 20),
(99, 'Alpine Eagle Stainless Steel &amp; Grey-Dial Brace', 'From the Alpine Eagle Collection. Contemporary, refined and assertive, this sport-chic timepiece is inspired by the design of the St. Moritz, powered by a Chronometer-certified movement within the sleek brushed stainless steel casing. The sunburst motif dial evokes the iris of the eagle — with rhodium-plated Roman numerals and hour markers.\r\nChronometer-certified automatic movement\r\nGlare-proof scratch-resistant sapphire crystal\r\nScrew-down crown\r\nGrey sunburst dial\r\nRoman numeral hour markers\r\nSecond hand\r\nSee-through sapphire crystal case back\r\nStainless steel case and bracelet strap\r\nDeployant clasp\r\nMade in Switzerland\r\n\r\nFEATURES\r\nWater-resistant to 10 ATM\r\n\r\nSIZE\r\nRound case, 41mm (1.61&quot;)\r\nBracelet strap, 23.4mm (0.92&quot;)', 11, '#ecee81', 'Free Size', '99.png', '1.png,2.png,3.png', 0, 52, 1, '2020-09-22', 13, 1, 20),
(100, 'Baume &amp; Mercier', '\r\nDetails:\r\nWoven into a twill finish, this suit is a minimalist basic. Wool. Dry clean. Made in Italy.\r\n\r\nJACKET\r\nNotch lapels\r\nLong sleeves\r\nButton front\r\nChest welt pocket\r\nWaist flap pockets\r\nDual back vents\r\nLined\r\n\r\nPANTS\r\nZip fly with button closure\r\nSide and back pockets\r\nFront and back pleats\r\n\r\nSIZE &amp;amp; FIT\r\nJacket, about 30&amp;quot; from shoulder to hem\r\nRise, about 10&amp;quot;\r\nInseam, about 32&amp;quot;\r\nLeg opening, about 14&amp;quot;', 50, '#000000', 'Free Size', '100.png', '1.png,2.png,3.png', 35, 52, 1, '2020-09-22', 13, 2, 12),
(101, 'Isabel Marant', 'Details:\r\nThis studded leather belt is crafted to fall just-so, lending it cool-girl nonchalance.\r\nLeather\r\nMade in Italy\r\n\r\nSIZE\r\nWidth, about 1.25&quot;', 20, '#000000', 'Free Size', '101.png', '1.png,2.png,3.png', 0, 55, 1, '2020-09-22', 13, 1, 10),
(102, 'Brown - Sunglasses', 'Product Details: Brown - Sunglasses\r\n\r\nReturn within 14 days.\r\n\r\nSize of the item on the image: Size: Standart', 20, '#643b0c', 'Free Size', '102.jpg', '1.jpg,2.jpg,3.jpg', 0, 53, 1, '2020-09-22', 14, 1, 20),
(103, 'Brown - Sunglasses', 'Product Details: Brown - Sunglasses\r\n\r\nReturn within 14 days.\r\n\r\nSize of the item on the image: Size: Standart', 20, '#67540e', 'Free Size', '103.jpg', '1.jpg,2.jpg,3.jpg', 15, 53, 1, '2020-09-22', 13, 2, 9),
(104, 'Purple - Sunglasses', 'Product Details: Purple - Sunglasses\r\n\r\nReturn within 14 days.\r\n\r\nSize of the item on the image: Size: Standart', 25, '#461547', 'Free Size', '104.jpg', '1.jpg,2.jpg,3.jpg', 0, 53, 1, '2020-09-23', 13, 3, 10),
(105, 'Smoke - Sunglasses', 'Product Details: Smoke - Sunglasses\r\n\r\nReturn within 14 days.\r\n\r\nSize of the item on the image: Size: Standart', 10, '#4b4949', 'Free Size', '105.jpg', '1.jpg,2.jpg,3.jpg', 0, 53, 1, '2020-09-23', 13, 3, 12),
(108, 'Glashütte Original Watches', 'The Seventies collection of Glashütte Original is expanding with two new variations of the Chronograph Panorama Date model. The tones of their dials are inspired by the colors of the manufactory\'s surroundings.\r\nThe German watchmaker is located in the center of Glashütte, a small town set in a valley in Saxony’s Ore Mountains surrounded by thick forests and green meadows with two dominant colors: green and grey.', 65, '#0d0c0c', 'Free Size', '108.jpg', '1.jpg,2.jpg,3.jpg', 0, 52, 1, '2020-09-16', 14, 1, 20),
(109, 'Pink - Blush', 'Product Details: Pink Blush\r\n\r\nReturn within 14 days.\r\n\r\nSize of the item on the image: Size: Standart\r\n\r\nThere is an approximately 4 cm difference between sizes.', 12, '#000000', '', '109.jpg', '1.jpg,2.jpg,3.jpg', 0, 21, 1, '2020-09-23', 13, 1, 20),
(110, ' Natural Blush-On Blusher', 'Product Details: Natural Blush-On Blusher\r\n\r\nReturn within 14 days.\r\n\r\nSize of the item on the image: Size: Standart\r\n\r\nThere is an approximately 4 cm difference between sizes.', 10, '#c58c8c', 'XS,S,L,XL', '110.jpg', '1.jpg,2.jpg,3.jpg', 8, 21, 1, '2020-09-23', 14, 2, 20),
(111, 'Instant Glow Mineral Blush', 'Product Details: Instant Glow Mineral Blush\r\n\r\nReturn within 14 days.\r\n\r\nEditor’s Note:\r\n\r\nThis innovative mineral blush, available in five gorgeous shades, provides a healthy glow that flatters any skin tone. The loose powder blush is made of 100% natural ingredients, free of chemicals or fillers, gives a fresh and radiant lift to your face. Only a tiny amount is needed to last all day. Halal, Vegan &amp; Vegetarian, Cruelty-Free Certified.\r\n\r\n \r\n\r\nCosmetics and personal care products can only be returnable if the packaging and product protection tape is unsealed and the product is unused.\r\n\r\nSize of the item on the image: Size: Standart\r\n\r\nThere is an approximately 4 cm difference between sizes.', 20, '#000000', 'XS,S,L,XL', '111.jpg', '1.jpg,2.jpg,3.jpg', 0, 21, 1, '2020-09-22', 13, 3, 10),
(112, 'Multi - Blush', 'Product Details: Multi - Blush\r\n\r\nReturn within 14 days.\r\n\r\nSize of the item on the image: Size: Standart\r\n\r\nThere is an approximately 4 cm difference between sizes.', 20, '#000000', 'XS,S,L,XL', '112.jpg', '1.jpg,2.jpg,3.jpg', 0, 21, 1, '2020-09-22', 13, 3, 10),
(113, 'Harry’s “Stone” body wash', 'Harry’s sulfate-free body wash comes in a jumbo size and at an affordable price—but that high-quality value is nothing new from the brand that innovated the men’s grooming industry. We’re big into all three scents, but it’s “Stone” that wins top prize, for its citrus and mineral finish. Or, stock up on all three; they’ll probably last you a whole year.\r\n\r\n\r\n', 15, '#000000', 'XL', '113.jpg', '1.jpg,2.jpg,3.jpg', 10, 22, 1, '2020-09-23', 13, 2, 20),
(114, 'Jack Black “Black Reserve” body wash', 'If what you fancy is a fancy wash, then add Jack Black to cart. In particular, add its newest release, a limited edition “reserve” with a layered aroma: It’s got notes of lavender, bergamot, coriander, patchouli, cedarwood, and cardamom. Better yet, it soothes and fortifies skin with aloe vera, Vitamin B5, coconut surfactant, shea butter, and jojoba. Technically, this one is a 2-in-1 body wash and shampoo, which is nice, but we can\'t bring ourselves to fully endorse the duality of such products. Instead, use this one as a body wash, which will only prolong its shelf life. (And at 33 fl. oz, that’s already a long shelf life.)', 15, '#000000', 'XL', '114.jpg', '1.jpg,2.jpg,3.jpg', 0, 22, 1, '2020-09-23', 14, 3, 20),
(115, 'The Best Small Batch Body Wash', 'PLANT Apothecary “Calm Down” body wash\r\n\r\n\r\n\r\nIf you don’t have time for a head-clearing, skin-soothing soak, then stock up on PLANT’s aromatic, aptly named body wash. “Calm Down” uses ginger and lavender to permeate the senses and scrub away stresses, while a blend of coconut, olive, and jojoba oil soaps cleanse and nourish the skin.', 20, '#000000', 'XS,S,L,XL', '115.jpg', '1.jpg,2.jpg,3.jpg', 0, 22, 1, '2020-09-23', 13, 1, 20),
(116, 'Dove Men+Care ', 'Dove Men+Care Sports care Active+Fresh\r\n\r\nThis post-workout body wash smells like you did CrossFit in a pristine meadow.\r\n\r\n', 15, '#000000', 'XS,S,L,XL', '116.jpg', '1.jpg,2.jpg,3.jpg', 0, 22, 1, '2020-09-23', 14, 3, 10),
(117, 'Body Care for women', 'Long-lasting, moisturizing body lotion invigorates while leaving skin feeling smooth, soft, and refreshed\r\nDermatologist tested shea butter Lotion made with sweet almond oil &amp; other thoughtfully chosen ingredients\r\nThe paraben-Free lotion also made without phthalates, animal-derived ingredients, and artificial colors\r\nRainwater scented body lotion has a fragrance so clean. Drops of rainwater fall on leaves and noses and ﬁll the air.\r\nMrs. Meyer\'s produces Cruelty-free body lotion. None of our products are tested on animals.', 20, '#dc9898', 'XS,S,L,XL', '117.jpg', '1.jpg,2.jpg,3.jpg', 15, 22, 1, '2020-09-22', 14, 2, 20),
(118, 'Dermablend  Concealer', 'Dermablend Cover Care Concealer, Full Coverage Concealer Makeup and Corrector for Under Eye Dark Circles, Acne &amp; Blemishes, 24-Hr Hydration, Matte Finish, XL Applicator\r\n', 20, '#000000', 'XS,S,L,XL', '118.jpg', '1.jpg,2.jpg,3.jpg', 0, 23, 1, '2020-09-23', 14, 1, 13),
(119, 'NYX PROFESSIONAL  Concealer', 'NYX PROFESSIONAL MAKEUP Can\'t Stop Won\'t Stop Contour Concealer - Vanilla, With Neutral Undertone\r\n', 28, '#f0e3b2', 'XS,S,L,XL', '119.jpg', '1.jpg,2.jpg,3.jpg', 25, 23, 1, '2020-09-22', 14, 2, 12),
(120, 'elf. Hydrating Camo Concealer', 'e.l.f., Hydrating Camo Concealer, Lightweight, Full Coverage, Long Lasting, Conceals, Corrects, Covers, Hydrates, Highlights, Light Sand, Satin Finish, 25 Shades, All-Day Wear, 0.20 Fl Oz\r\nlasting coverage: This lightweight, the full-coverage formula doesn\'t flake and leaves a satin finish. Camouflage blemishes, dark under-eye circles, redness, and more with this hydrating and long-wearing concealer.\r\nHow to wear: Prep under eye area with moisturizer and primer, and use the doe-foot applicator to apply to the desired area. Blend using brush, fingers, or blender sponge for desired coverage.\r\n100% cruelty-free &amp; Vegan: proud to be 100% vegan and cruelty-free, worldwide. Because kindness is chic.\r\nFree from: all E.L.F. Products are 100% free from phthalates, parabens, nonylphenol, Ethoxylates, triclosan, triclocarban, and hydroquinone.\r\nBeauty for all: e.l.f. Cosmetics provides professional-quality products at get-real prices because we believe beauty should be accessible to every eye, lip, and face.', 28, '#f0dfa3', 'XS,S,L,XL', '120.jpg', '1.jpg,2.jpg,3.jpg', 0, 23, 1, '2020-09-23', 14, 3, 20),
(121, 'Neutrogena Healthy  Concealer ', 'Neutrogena Healthy Skin Radiant Brightening Cream Concealer with Peptides &amp; Vitamin E Antioxidant, Lightweight Perfecting Concealer, Non-Comedogenic, Ivory Light 01 with neutral undertones, 0.24 oz', 20, '#d2c889', 'XS,S,L,XL', '121.jpg', '1.jpg,2.jpg,3.jpg', 0, 23, 1, '2020-09-23', 14, 3, 20),
(122, 'SHANY Ultimate Fusion - 120 Color Eye shadow ', 'SHANY Ultimate Fusion - 120 Color Eye shadow Palette Natural Nude and Neon Combination\r\n\r\nAbout this item\r\nMakeup palette with 120 natural and nude eyeshadow colors.\r\nIncludes 60 neon eyeshadow colors and 60 natural eyeshadow colors.\r\nLong lasting, highly pigmented colors allow for a smudge-free look.\r\nSlender display makes it portable and easy for on-the-go application\r\nPerfect gift for a makeup professional or a beauty beginner.', 50, '#000000', 'XL', '122.jpg', '1.jpg,2.jpg,3.jpg', 40, 24, 1, '2020-09-23', 14, 2, 20),
(123, 'Beauty Glazed High Pigmented Makeup Palette ', 'Beauty Glazed High Pigmented Makeup Palette Easy to Blend Color Fusion 39 Shades Metallic and Shimmers Eyeshadow Sweatproof and Waterproof Eye Shadows\r\n\r\nAbout this item\r\n【HIGH PIGMENTED CRUELTY FREE】 Supper pigmented and soft creamy powder, match most skin tone to make the makeup look brighter. Cruelty-free not test on the animal!\r\n【WATER and SWEAT RESISTANT】 Smooth powder and long-lasting colors, keep your perfect eye shadow makeup for a long time. Can last all day long. Kindly note applying primer before eyeshadow will display the feature of waterproof and sweatproof!\r\n【32 METALLIC+7 SHIMMERS FOR MAKEUP TUTORIAL AND PROFESSIONAL】 Suitable for professional use or domestic use, as well as makeup tutorials and beginners. Pigmented shades from ultra matte to shimmery metallic shades and has everything you have to transfer to the eyelids.', 50, '#000000', 'XL', '123.jpg', '1.jpg,2.jpg,3.jpg', 0, 24, 1, '2020-09-23', 14, 1, 20),
(124, 'High Pigmented Eyeshadow Palette Matte + Shimmer 3', 'High Pigmented Eyeshadow Palette Matte + Shimmer 35 Fall Colors Makeup Natural Bronze Warm Neutral Smokey Blendable Waterproof Creamy Eye Shadows Cosmetic Kit\r\nProfessional eyeshadow palette: 23 colors creamy shimmer shades and 10 matte powder and 2 pressed glitter eye shadow in one makeup eye shadow palette（Size:9.5 x 7x 0.5 inches).The warm colors eyeshadow pallet perfect for autumn and winter makeup.\r\nRich Colors: Exquisite beauty makeup palette with 35 pigment-rich colors range with outstanding matte, metallic, satin, glitter, and shimmering earth tones. The richer color combination is suitable for naturally beautiful to wild dramatic gray black smoky eye makeup looks.\r\nRich Colors: Exquisite beauty makeup palette with 35 pigment-rich colors range with outstanding matte, metallic, satin, glitter, and shimmering earth tones. The richer color combination is suitable for naturally beautiful to wild dramatic gray black smoky eye makeup looks.', 25, '#000000', 'L', '124.jpg', '1.jpg,2.jpg,3.jpg', 0, 24, 1, '2020-09-23', 14, 1, 20),
(125, '30 Colors Eyeshadow Makeup Palette', '\r\nClick image to open expanded view\r\nHigh Pigmented Eyeshadow Palette Matte + Shimmer 35 Fall Colors Makeup Natural Bronze Warm Neutral Smokey Blendable Waterproof Creamy Eye Shadows Cosmetic Kit\r\nProfessional eyeshadow palette: 23 colors creamy shimmer shades and 10 matte powder and 2 pressed glitter eye shadow in one makeup eye shadow palette（Size:9.5 x 7x 0.5 inches).The warm colors eyeshadow pallet perfect for autumn and winter makeup.\r\nRich Colors: Exquisite beauty makeup palette with 35 pigment-rich colors range with outstanding matte, metallic, satin, glitter, and shimmering earth tones. The richer color combination is suitable for naturally beautiful to wild dramatic gray black smoky eye makeup looks.\r\nRich Colors: Exquisite beauty makeup palette with 35 pigment-rich colors range with outstanding matte, metallic, satin, glitter, and shimmering earth tones. The richer color combination is suitable for naturally beautiful to wild dramatic gray black smoky eye makeup looks.', 20, '#000000', 'XL', '125.jpg', '1.jpg,2.jpg,3.jpg', 0, 24, 1, '2020-09-23', 14, 3, 20),
(126, ' All Day Eyeliner, Deep Blue,', '\r\nRoll over image to zoom in\r\nCovergirl Defining Moment, All Day Eyeliner, Deep Blue, 0.012 Ounce\r\nAbout this item\r\nGet vibrant color designed to pop with this all-day eyeliner\r\nSmooth-glide all-day eyeliner for easy application\r\nSuitable for sensitive eyes\r\n', 12, '#000000', 'L', '126.jpg', '1.jpg,2.jpg,3.jpg', 0, 25, 1, '2020-09-23', 14, 1, 10),
(127, 'Sterling Silver Pressed Flower Teardrop Earrings', 'Unique translucent teardrop-shape earrings featuring real dried flowers preserved in resin and surrounded by sterling silver settings\r\nThe natural properties of real flowers provides a one-of-a-kind look to each piece. The image may show a slight difference to the actual flowers in color and composition\r\nGrown in the fields of Taxco, Mexico, these miniature flowers are gathered by hand and preserved permanently in resin\r\nFishhook backings\r\nMade in Mexico', 30, '#429a58', 'Free Size', '127.jpg', '1.jpg,2.jpg,3.jpg', 0, 58, 1, '2020-09-29', 14, 1, 10),
(128, 'Silver-Plated &amp; Pink Oxidised Jhumkas', 'Silver-toned dome-shaped human, silver-plated, has pearls\r\nSecured with a post and back\r\n\r\nSize &amp; Fit\r\nLength:4.5cm\r\n\r\nMaterial &amp; Care\r\nMaterial: Brass\r\nStone Type: Pearls\r\nCare Instructions:\r\nWipe your jewelry with a soft cloth after every use\r\nAlways store your jewelry in a flat box to avoid accidental scratches\r\nKeep sprays and perfumes away from your jewelry\r\nDo not soak your jewelry in water\r\nClean your jewelry using a soft brush, dipped in jewelry cleaning solution only', 30, '#3f2727', 'Free Size', '128.jpg', '1.jpg,2.jpg,3.jpg', 25, 58, 1, '2020-09-29', 14, 2, 20),
(129, 'Carlton London', 'PRODUCT DETAILS \r\nSilver-toned contemporary studs, rhodium-plated, has cubic zirconia\r\nSecured with a post and back\r\n\r\nSize &amp; Fit\r\nLength: 2 cm\r\n\r\nMaterial &amp; Care\r\nMaterial: Brass\r\nStone Type: Cubic Zirconia\r\nWipe with a clean cotton swab when needed', 60, '#000000', 'Free Size', '129.jpg', '1.jpg,2.jpg,3.jpg', 0, 58, 1, '2020-09-29', 14, 3, 20),
(130, 'Maybelline eyeliner', 'PRODUCT DETAILS \r\nColossal Bold Liner \r\nShade Name - Black\r\n\r\n\r\nSpecifications\r\nColour Shade Name\r\nBlack\r\nFeatures\r\nSmudge-Proof\r\nFinish\r\nMatte\r\nIngredients Preference\r\nOphthalmologically Tested\r\nType\r\nLiquid', 15, '#000000', 'XL', '130.jpg', '1.jpg,2.jpg,3.jpg', 0, 25, 1, '2020-09-29', 14, 3, 20),
(131, 'Roadster jacket', 'PRODUCT DETAILS \r\nOlive green solid bomber jacket, has a mock collar, three pockets, zip closure, long sleeves, straight hem, polyester lining\r\n\r\nSize &amp; Fit\r\nThe model (height 6\') is wearing a size M\r\n\r\nMaterial &amp; Care\r\n100% cotton\r\nMachine-wash', 50, '#000000', 'XS,S,L,XL', '131.jpg', '1.jpg,2.jpg,3.jpg', 45, 18, 1, '2020-09-23', 14, 2, 20),
(132, 'Puma Shose', 'PRODUCT DETAILS \r\nA pair of round-toe black sneakers, has regular styling, lace-up detail\r\nTextile upper\r\nCushioned footbed\r\nTextured and patterned outsole\r\nWarranty: 3 months\r\nWarranty provided by brand/manufacturer\r\n\r\nSize &amp; Fit\r\nNarrow\r\n\r\nMaterial &amp; Care\r\nTextile\r\nWipe with a clean, dry cloth to remove dust', 30, '#000000', 'XS,S,L,XL', '132.jpg', '1.jpg,2.jpg,3.jpg', 0, 54, 1, '2020-09-30', 14, 3, 20),
(133, 'Puma Unisex Black BMW', 'PRODUCT DETAILS \r\nProduct design details\r\nA pair of black &amp; grey running sports shoes, has regular styling, lace-up detail\r\nSynthetic leather upper with laser cutouts\r\nRubber outsole\r\nDebossed lines and colour blocking\r\nTraditional BMW M Motorsport colourways\r\nBMW badge on heel\r\nPerforated PUMA Formstrip and toe\r\nWarranty: 3 months\r\nWarranty provided by brand/manufacturer\r\n\r\nProduct Story\r\nSupreme performance reaches the peak of fan style in our BMW M Motorsports Drift Cat 8, a return to the classic excellence of our Drift Cat. This streamlined silhouette features a low profile luxe look with a synthetic leather upper featuring a laser perforated PUMA Formstrip for an edgy touch that will turn heads.', 50, '#000000', 'XS,S,L,XL', '133.jpg', '1.jpg,2.jpg,3.jpg', 35, 54, 1, '2020-09-29', 14, 2, 10),
(134, 'Crew STREET Women Teal Blue ', 'PRODUCT DETAILS \r\nThese sports shoes bringfull-court style and premium comfort to an iconic look with its lower collar height.\r\n\r\nFeatures\r\nEngineered knit-mesh fabric upper features cool air mesh panels and side seam accents.\r\nSlip-on design with dual elastic insets.\r\nEVA sole cushions your feet and gives the shoe a longer life.\r\nRounded toe with TPU lamination.\r\nA padded collar provides ankle support.\r\nWeight: lightweight\r\nFastening: Slip-on\r\nFit: Comfort\r\nWarranty: 3 months\r\nWarranty provided by brand/manufacturer\r\n\r\nMaterial &amp; Care\r\nMesh\r\nWipe with a clean, dry cloth to remove dust', 35, '#5f86ce', 'XS,S,L,XL', '134.jpg', '1.jpg,2.jpg,3.jpg', 0, 54, 1, '2020-09-30', 14, 1, 20),
(135, 'CRUSSET Women Black', 'PRODUCT DETAILS \r\nBlack solid belt\r\nReversible: No\r\nStretchable: Yes\r\nSecured with a push pin\r\n\r\nSize &amp; Fit\r\nWidth:5 cm\r\nSuitable for 26 to 34 waist size\r\n\r\nMaterial &amp; Care\r\nSynthetic\r\nWipe with a clean, dry cloth to remove dust', 20, '#000000', 'Free Size', '135.jpg', '1.jpg,2.jpg,3.jpg', 15, 55, 1, '2020-09-30', 14, 2, 20),
(136, 'Calvadoss Women Tan Brown', 'PRODUCT DETAILS \r\nTan Brown solid belt\r\nReversible: No\r\nStretchable: No\r\nSecured with a tang\r\nWarranty: 1 month\r\nWarranty provided by brand/manufacturer\r\n\r\nSize &amp; Fit\r\nWidth: 3.4 cm\r\n\r\nMaterial &amp; Care\r\nPU\r\nWipe with a clean, dry cloth to remove dust', 15, '#ad951a', 'Free Size', '136.jpg', '1.jpg,2.jpg,3.jpg', 0, 55, 1, '2020-09-29', 14, 1, 20),
(137, 'Ayesha Women Gold-Toned Solid Belt', 'PRODUCT DETAILS \r\nGold-Toned solid belt\r\nReversible: No\r\nStretchable: Yes\r\nSecured with an interlock\r\n\r\nSize &amp; Fit\r\nWidth: 1.5 cm\r\n\r\nMaterial &amp; Care\r\nSynthetic\r\nWipe with a clean, dry cloth to remove dust', 20, '#e7ea1f', 'Free Size', '137.jpg', '1.jpg,2.jpg,3.jpg', 0, 55, 1, '2020-09-30', 14, 1, 10),
(138, 'DressBerry Pink Satchel', 'PRODUCT DETAILS \r\nPink satchel with buckle detail\r\nOne short handle has one long, adjustable, and detachable sling strap\r\nTwo main zip compartments has flaps across the mouths secured with magnetic button closure, one with two slip pockets and one with a zip pocket\r\n\r\nSize &amp; Fit\r\nHeight: 25 cm\r\nWidth: 28 cm\r\nDepth: 9 cm\r\n\r\nMaterial &amp; Care\r\nPU\r\nWipe with a clean, dry cloth when needed', 25, '#e6c1c1', 'Free Size', '138.jpg', '1.jpg,2.jpg,3.jpg', 0, 57, 1, '2020-09-30', 14, 1, 10),
(139, 'ANIKAS CREATION', 'PRODUCT DETAILS \r\nBlack and Gold-plated enameled dome-shaped jhumkas and has artificial beads\r\nSecured with a post and back\r\n\r\nSize &amp; Fit\r\nEarring Length: 10 cms\r\n\r\n\r\nMaterial &amp; Care\r\nMaterial: Copper\r\nStone Type: Artificial Beads\r\n\r\nCare Instruction for Fine Jewellery:\r\nWipe with a soft, lint-free clean cloth\r\nAvoid contact with perfume, soap, hairspray, and cosmetics\r\nAvoid using gold in swimming pools\r\nStore your jewelry in a fabric-lined box to prevent loosening of stone setting', 25, '#e3f11e', 'Free Size', '139.jpg', '1.jpg,2.jpg,3.jpg', 0, 58, 1, '2020-09-30', 14, 1, 10),
(140, ' Tistabene Gold-Plated Wedding Ring', 'PRODUCT DETAILS \r\nGold-plated white AD-studded handcrafted adjustable finger ring\r\n\r\n\r\nSize &amp; Fit\r\nRing length: 2.616 cm\r\nRing width: 3.175 cm\r\nCircumference of the ring: 7.62 cm\r\n\r\n\r\nMaterial &amp; Care\r\nMaterial: Alloy\r\nPlating: Gold-Plated\r\nStone type: American Diamond\r\nCare Instruction\r\nWipe your jewelry with a soft cloth after every use\r\nAlways store your jewelry in a flat box to avoid accidental scratches\r\nKeep sprays and perfumes away from your jewelry\r\nDo not soak your jewelry in water\r\nClean your jewelry using a soft brush, dipped in jewelry cleaning solution only', 100, '#e3f033', 'XS,S,L,XL', '140.jpg', '1.jpg,2.jpg,3.jpg', 0, 56, 1, '2020-09-30', 14, 1, 20),
(141, 'Voylla Gold-Plated Ring', 'Voylla\r\nGold-Plated &amp; White Zircon Adorned Cutwork Design Layered Finger Ring\r\nPRODUCT DETAILS \r\nGold-plated &amp; white statement finger ring, has multiple layers design with CZ gemstone-studded detail\r\n\r\n\r\nSize &amp; Fit\r\nDesign length: 1.27 cm\r\nDesign width: 1.88 cm\r\nCircumference of ring: 5.2 cm\r\nDiameter of ring: 1.6 cm\r\nWeight: 3.65 gm\r\n\r\n\r\nMaterial &amp; Care\r\nMaterial: Brass\r\nPlating: Gold-plated\r\nStone Type: Cubic zirconia\r\nCare Instruction\r\nWipe your jewelry with a soft cloth after every use\r\nAlways store your jewelry in a flat box to avoid accidental scratches\r\nKeep sprays and perfumes away from your jewelry\r\nDo not soak your jewelry in water\r\nClean your jewelry using a soft brush, dipped in jewelry cleaning solution only', 75, '#95830e', 'XS,S,L,XL', '141.jpg', '1.jpg,2.jpg,3.jpg', 65, 56, 1, '2020-09-30', 14, 2, 10);
INSERT INTO `products` (`product_id`, `product_name`, `product_desc`, `product_price`, `product_color`, `product_size`, `product_image`, `other_images`, `product_offer`, `sub_cat_id`, `state`, `date`, `vendor_id`, `features`, `num_of_products`) VALUES
(142, 'Tistabene Gold-Plated Pink Ring', 'Tistabene\r\nGold-Plated Pink Drusy-Studded Handcrafted Cocktail Finger Ring\r\nPRODUCT DETAILS \r\nGold-plated pink drusy-studded finger ring with a square-shaped design and cut-out detail\r\n\r\n\r\nSize &amp; Fit\r\nRing Length: 2.667 cm\r\nRing Width: 2.54 cm\r\nCircumference: 5.08\r\nDiameter: 1.70 cm\r\n\r\n\r\nMaterial &amp; Care\r\nMaterial: Alloy\r\nPlating: Gold-plated\r\nStone type: Drusy\r\n\r\nCare Instructions\r\nWipe your jewelry with a soft cloth after every use\r\nAlways store your jewelry in a flat box to avoid accidental scratches\r\nKeep sprays and perfumes away from your jewelry\r\nDo not soak your jewelry in water\r\nClean your jewelry using a soft brush, dipped in jewelry cleaning solution only', 80, '#000000', 'XS,S,L,XL', '142.jpg', '1.jpg,2.jpg,3.jpg', 0, 56, 1, '2020-09-30', 14, 3, 10),
(143, 'Tistabene Silver-Plated Black &amp; Beige Ring', 'Tistabene\r\nSilver-Plated Black &amp; Beige Floral-Shaped Adjustable Finger Ring\r\nPRODUCT DETAILS \r\nSilver-plated black and beige floral shaped adjustable finger-ring\r\n\r\n\r\nSize &amp; Fit\r\nRing length: 1.905 cm\r\nRing width: 3.683 cm\r\nCircumference of the ring: 7.62 cm\r\n\r\n\r\nMaterial &amp; Care\r\nMaterial: Alloy\r\nPlating: Silver-Plated\r\n\r\nCare Instruction\r\nWipe your jewelry with a soft cloth after every use\r\nAlways store your jewelry in a flat box to avoid accidental scratches\r\nKeep sprays and perfumes away from your jewelry\r\nDo not soak your jewelry in water\r\nClean your jewelry using a soft brush, dipped in jewelry cleaning solution only', 50, '#000000', 'XS,S,L,XL', '143.jpg', '1.jpg,2.jpg,3.jpg', 0, 56, 1, '2020-09-30', 14, 1, 5),
(144, 'M.A.C Fling Eye Brows', 'M.A.C\r\nFling Eye Brows Big Boost Fibre Gel 4.1 g\r\nPRODUCT DETAILS \r\nShade Name:\r\nFling \r\n\r\nWhat it is:\r\nA gel formula with microfibers that gives the eyebrows a big boost that lasts 24 hours.\r\n\r\nWhat it does:\r\nGive your eyebrows a big boost with this 24-hour Fiber Gel for a perfectly polished to perfectly rough look.\r\n This tinted formula effortlessly creates fuller, thicker, bushy eyebrows with small synthetic microfibres that build, define, and shape eyebrow hairs. \r\nThe watertight, sweatproof formula ensures that the color and volume are right all day and all night\r\nFeatures:\r\nLong-term, 24 hours\r\nVolume-giving and buildable\r\nThree-fiber technology\r\nSweat and water-resistant\r\nResistant to folds and fades\r\nDoes not flake', 10, '#3a2003', 'XL', '144.jpg', '1.jpg,2.jpg,3.jpg', 0, 26, 1, '2020-09-30', 14, 3, 20),
(145, 'Bobbi Brown Natural Brow', 'Bobbi Brown\r\nNatural Brow Shaper &amp; Hair Touch Up - 1 Blond Natural\r\n\r\nPRODUCT DETAILS \r\nBobbi BrownWaterproof Brow Shaper cum Hair Touch-up\r\nShade Name: 1 Blonde Natural\r\n\r\nSpecifications\r\nColour Shade Name\r\nBlonde\r\nFeatures\r\nSmudge-Proof\r\nType\r\nBrow Gel Mascara', 15, '#644b07', 'XS,S,L,XL', '145.jpg', '1.jpg,2.jpg,3.jpg', 12, 26, 1, '2020-09-30', 14, 2, 20),
(146, 'Physicians Formula', 'Physicians Formula\r\nBrunette Eye ---ooster Lash Feather Brow Fiber &amp; Highlighter Duo\r\n\r\nShade name\r\nBrunette \r\n\r\nWhat it is\r\nFeather brow fiber and highlighter duo\r\n\r\nWhat it does\r\nInstant, fuller, thicker brows\r\nAchieve a natural fuller-brow look and lift with Feather Brow 2-in-1 brow tool\r\nHypoallergenic\r\nFragrance-free \r\nParaben-free\r\nCruelty-free\r\nDermatologist tested\r\n\r\nSize &amp; Fit\r\nHighlighter: 0.6 g\r\nFiber: 0.6 g', 15, '#ac7c39', 'XS,S,L,XL', '146.jpg', '1.jpg,2.jpg,3.jpg', 0, 26, 1, '2020-09-30', 14, 1, 20),
(148, ' Hair Fall Control Hair Oil ', '\r\nMamaearth\r\nUnisex Onion &amp; Coconut Hair Regrowth &amp; Hair Fall Control Hair Oil 150 ml\r\nPRODUCT DETAILS \r\nMamaearth Unisex Onion &amp; Coconut Hair Regrowth &amp; Hair Fall Control Hair Oil\r\n\r\nSpecifications\r\nConcern\r\nHair Fall\r\nHair Type\r\nRegular\r\nType\r\nRegular', 30, '#000000', 'XS,S,L,XL', '148.jpg', '1.jpg,2.jpg,3.jpg', 20, 27, 1, '2020-09-30', 14, 2, 20),
(149, 'Mamaearth Hair Onion Oil, Shampoo Conditioner Hair', 'Mamaearth\r\nSustainable Unisex Set of Hair Onion Oil, Shampoo Conditioner Hair Regrowth Kit\r\n\r\nPRODUCT DETAILS \r\nHair Regrowth Kit\r\n\r\nMamaearth Onion Hair Fall Control Conditioner\r\n\r\nWhat it is\r\nOnion Hair Fall Control Conditioner \r\n\r\nFeatures\r\nReduces hair fall and accelerates hair growth\r\nIt penetrates deep into the follicles and promotes hair growth and scalp health\r\nSafe for colored and chemically treated hair\r\nFree of harmful chemicals and toxins such as Sulfates, Silicones, Parabens, Mineral Oil, and Dyes\r\n\r\nMamaearth Onion Hair Fall Control Shampoo', 55, '#000000', 'XS,S,L,XL', '149.jpg', '1.jpg,2.jpg,3.jpg', 0, 27, 1, '2020-09-30', 14, 3, 20),
(150, 'WELLA PROFESSIONALS', 'WELLA PROFESSIONALS\r\nWella Professionals Invigo Nutri-enrich Shampoo 250 ml\r\n100% Original Products\r\nFree Delivery on orders above Rs. 799\r\nThis item is not returnable. Items like inner-wear, personal care, make-up, socks, and certain accessories do not come under our return policy', 20, '#000000', 'XS,S,L,XL', '150.jpg', '1.jpg,2.jpg,3.jpg', 0, 27, 1, '2020-09-30', 14, 1, 20),
(151, ' LOreal Paris Extraordinary Oil ', '\r\nLOreal\r\nParis Extraordinary Oil Serum 100 ml\r\n100% Original Products\r\nFree Delivery on orders above Rs. 799\r\nThis item is not returnable. Items like inner-wear, personal care, make-up, socks, and certain accessories do not come under our return policy.', 20, '#000000', 'XS,S,L,XL', '151.jpg', '1.jpg,2.jpg,3.jpg', 0, 27, 1, '2020-09-30', 14, 1, 20),
(152, 'Maybelline  Lipsticks ', 'Maybelline\r\nNew York Set of 2 Creamy Matte Lipsticks - Nude Nuance &amp; Touch of Spice\r\n100% Original Products\r\nFree Delivery on orders above Rs. 799\r\nThis item is not returnable. Items like inner-wear, personal care, make-up, socks, and certain accessories do not come under our return policy\r\n\r\nPRODUCT DETAILS \r\nSet of 2 Color Sensational Creamy Matte Lipsticks\r\nShade Name 1: Touch of Spice\r\nShade Name 2: Nude Nuance', 20, '#000000', 'Free Size', '152.jpg', '1.jpg,2.jpg,3.jpg', 0, 29, 1, '2020-09-30', 14, 1, 20),
(153, 'Liquid Catsuit Matte Lipstick ', 'Wet n Wild\r\nSustainable MegaLast Liquid Catsuit Matte Lipstick - Give Me Mocha E925B 6 g\r\n100% Original Products\r\nFree Delivery on orders above Rs. 799\r\nThis item is not returnable. Items like inner-wear, personal care, make-up, socks, and certain accessories do not come under our return policy.\r\n\r\n', 15, '#df7777', 'XS,S,L,XL', '153.jpg', '1.jpg,2.jpg,3.jpg', 0, 29, 1, '2020-09-30', 14, 1, 20),
(154, 'M.A.C Lip Cushion Mousse ', '\r\nWhat is\r\nGet ultra-comfortable with celestial lip color. The long-wearing formula provides sheer-to-medium buildable coverage with a soft-matte finish. Specially designed in metallic rose gold and matte dark grey packaging inspired by star tarot cards.\r\n\r\nWhat it does\r\nLong-wearing, 8 hours\r\nStays colour-true\r\nDisclaimer: Please note that you can purchase a maximum of 6 units from a particular range per transaction. Please be aware ingredient listing may change and vary from time to time. Please refer to the ingredient list on the product package you receive for the most up-to-date list of ingredients.\r\n\r\nSize &amp; Fit\r\n7ML/.24FLOZ\r\n\r\n\r\nMaterial &amp; Care\r\nLIP CUSHION MOUSSE-PRIVA 7ML/.24FLOZ', 20, '#ef4ee1', 'XS,S,L,XL', '154.jpg', '1.jpg,2.jpg,3.jpg', 0, 29, 1, '2020-09-30', 14, 3, 10),
(155, ' M.A.C Retro Matte Lipstick ', '\r\nM.A.C\r\nRetro Matte Lipstick - Flat Out Fabulous 3 gm\r\nPRODUCT DETAILS \r\nM.A.C Retro Matte Flat Out Fabulous Lipstick 3 gm\r\n\r\nDisclaimer: Please be aware ingredient listing may change and vary from time to time. Please refer to the ingredient list on the product package you receive for the most up-to-date list of ingredients.', 15, '#d463d0', 'XS,S,L,XL', '155.jpg', '1.jpg,2.jpg,3.jpg', 0, 29, 1, '2020-09-30', 14, 1, 20),
(156, 'INCOLOR Incolor   Blusher ', 'INCOLOR\r\nIncolor Exposed Highlighter Blusher tomato 22 - 9 g\r\n100% Original Products\r\nFree Delivery on orders above Rs. 799\r\nThis item is not returnable. Items like inner-wear, personal care, make-up, socks, and certain accessories do not come under our return policy', 20, '#fb8e8e', 'Free Size', '156.jpg', '1.jpg,2.jpg,3.jpg', 0, 21, 1, '2020-09-30', 14, 1, 10),
(157, 'Bobbi Brown Mini Vitamin ', 'Bobbi Brown\r\nMini Vitamin Enriched Face Base 7 ml\r\n100% Original Products\r\nFree Delivery on orders above Rs. 799\r\nThis item is not returnable. Items like inner-wear, personal care, make-up, socks, and certain accessories do not come under our return policy', 25, '#f2f5c6', 'XS,S,L,XL', '157.jpg', '1.jpg,2.jpg,3.jpg', 0, 30, 1, '2020-09-30', 14, 1, 10),
(158, ' LOreal Paris True Match Lumi Powder ', '\r\nLOreal\r\nParis True Match Lumi Powder Illuminator - Warm 9 g\r\n\r\n100% Original Products\r\nFree Delivery on orders above Rs. 799\r\nThis item is not returnable. Items like inner-wear, personal care, make-up, socks, and certain accessories do not come under our return policy.', 20, '#000000', 'XS,S,L,XL', '158.jpg', '1.jpg,2.jpg,3.jpg', 0, 30, 1, '2020-09-30', 14, 1, 10),
(159, 'SASSAFRAS Women Jacket', 'SASSAFRAS\r\nWomen Blue Solid Denim Jacket\r\n\r\nPRODUCT DETAILS \r\nBlue solid denim jacket with washed effect, has a spread collar, 2 pockets, button closures, long sleeves, straight hem\r\n\r\nSize &amp; Fit\r\nThe model (height 5\'8&quot;) is wearing a size S\r\n\r\nMaterial &amp; Care\r\nCotton\r\nMachine-wash', 20, '#000000', 'XS,S,L,XL', '159.jpg', '1.jpg,2.jpg,3.jpg', 0, 10, 1, '2020-09-30', 14, 1, 10),
(160, 'STREET 9 Women  Jacket', 'STREET 9\r\nWomen Mustard Brown Solid Crop Jacket\r\n\r\nPRODUCT DETAILS \r\nMustard brown solid crop jacket, has a spread collar, button closure, long sleeves, straight hem, 2 mock pockets\r\n\r\nSize &amp; Fit\r\nThe model (height 5\'8&quot;) is wearing a size S\r\n\r\nMaterial &amp; Care\r\nCotton\r\nMachine-wash', 20, '#000000', 'XS,S,L,XL', '160.jpg', '1.jpg,2.jpg,3.jpg', 10, 10, 1, '2020-09-30', 14, 2, 20),
(161, 'STREET 9 Women Black  Jacket', 'STREET 9\r\nWomen Black Solid CroppePRODUCT DETAILS \r\nThe black solid cropped tailored jacket has a spread collar, snap button closure, long sleeves, straight hem, mock pocket detail\r\n\r\nSize &amp; Fit\r\nThe model (height 5\'8&quot;) is wearing a size S\r\n\r\nMaterial &amp; Care\r\n100% cotton\r\nMachine-washed Tailored Jacket\r\n', 20, '#000000', '', '161.jpg', '1.jpg,2.jpg,3.jpg', 0, 10, 1, '2020-09-30', 14, 3, 10),
(162, ' Bhama Couture Women Jacket', '\r\nBhama Couture\r\nWomen Navy Blue Washed Denim Jacket\r\n\r\nPRODUCT DETAILS \r\nNavy blue washed denim jacket with embroidered detail, has a spread collar, two flap pockets, button closure, long sleeves, straight hem\r\n\r\nSize &amp; Fit\r\nThe model (height 5\'8&quot;) is wearing a size S\r\n\r\nMaterial &amp; Care\r\nCotton\r\nMachine-wash', 20, '#0c0a24', 'XS,S,L,XL', '162.jpg', '1.jpg,2.jpg,3.jpg', 10, 10, 1, '2020-09-30', 14, 2, 20),
(163, ' all about you Women  Suit', '\r\nall about you\r\nWomen Burgundy Self Design Suit\r\n\r\nPRODUCT DETAILS \r\nBurgundy self-design coat, single-breasted with double button closures, notched lapel, long sleeves, two flap pockets\r\nBurgundy self-design trousers, has button closure, zip fly, two pockets\r\n\r\nSize &amp; Fit\r\nThe model (height 5\'8&quot;) is wearing a size M\r\n\r\nMaterial &amp; Care\r\nTop fabric: 62% polyester, 18% acrylic, 12% viscose, 8% polyamide\r\nBottom fabric: 62% polyester, 18% acrylic, 12% viscose, 8% polyamide\r\nMachine-wash', 75, '#836363', 'XS,S,L,XL', '163.jpg', '1.jpg,2.jpg,3.jpg', 0, 8, 1, '2020-09-30', 14, 1, 10),
(164, ' MANGO Women Black suits', '\r\nMANGO\r\nWomen Black &amp; White Stripped Single-Breasted Blazer\r\nPRODUCT DETAILS \r\nBlack and White stripped single-breasted blazer, has a notched lapel collar, long sleeves, button closure, two pockets, single vented back hem, and an attached lining\r\n\r\nSize &amp; Fit\r\nThe model (height 5\'8\'\') is wearing a size S\r\n\r\nMaterial &amp; Care\r\nShell: 70% polyester, 28% viscose, and 2% elastane\r\nLining: Polyester', 80, '#000000', 'XS,S,L,XL', '164.jpg', '1.jpg,2.jpg,3.jpg', 0, 8, 1, '2020-09-30', 14, 3, 10),
(165, 'Prakrti Women  Night suit', 'Prakrti\r\nWomen Navy Blue &amp;amp; Off-White Floral Printed Night suit\r\n\r\nPRODUCT DETAILS \r\nNavy Blue and off-white night suit consists of top and pyjamas\r\nNavy Blue and off-white floral printed top, has a round neck, three-quarter sleeves, high-low hem\r\nA pair of off-white and navy blue printed pyjamas, has drawstring closure, one pocket\r\n\r\nSize &amp;amp; Fit\r\nThe model (height 5\'8\') is wearing a size S\r\n\r\nMaterial &amp;amp; Care\r\nTop fabric: Pure Cotton\r\nBottom fabric: Pure Cotton\r\nHand-wash', 30, '#4c749e', 'XS,S,L,XL', '165.jpg', '1.jpg,2.jpg,3.jpg', 0, 6, 1, '2020-09-30', 27, 1, 20),
(166, ' Prakrti Women   Night suit', '\r\nPrakrti\r\nWomen White &amp;amp; Coral Pink Floral Printed Night suit\r\nPRODUCT DETAILS \r\nWhite and coral pink night suit consists of top and pyjamas\r\nWhite and coral pink floral printed top, has a round neck, three-quarter sleeves\r\nA pair of coral pink and white chevron printed pyjamas, has a drawstring closure, one pocket\r\n\r\nSize &amp;amp; Fit\r\nThe model (height 5\'8\') is wearing a size S\r\n\r\nMaterial &amp;amp; Care\r\nTop fabric: Pure Cotton\r\nBottom fabric: Pure Cotton\r\nHand-wash', 30, '#ee9696', 'XS,S,L,XL', '166.jpg', '1.jpg,2.jpg,3.jpg', 0, 6, 1, '2020-09-23', 27, 3, 20),
(167, 'Masha Women Yellow Night suit', 'Masha\r\nWomen Yellow Printed Night suit\r\nPRODUCT DETAILS \r\nYellow night suit consists of shirt and pyjamas\r\nYellow printed shirt, has a shirt collar, short sleeves\r\nA pair of yellow printed pyjamas, has drawstring closure\r\n\r\nSize &amp;amp; Fit\r\nThe model (height 5\'8\') is wearing a size S\r\n\r\nMaterial &amp;amp; Care\r\nTop fabric: 100%Cotton\r\nBottom fabric: 100%Cotton\r\nHand-wash', 20, '#edde07', 'XS,S,L,XL', '167.jpg', '1.jpg,2.jpg,3.jpg', 0, 6, 1, '2020-09-30', 27, 1, 20),
(168, 'DRAPE IN VOGUE Women Grey Solid Night Suit', 'DRAPE IN VOGUE\r\nWomen Grey Solid Night Suit\r\nPRODUCT DETAILS \r\nGrey night suit consists of shirt and pyjamas\r\nGrey solid shirt, has a lapel collar, long sleeves, button closure and one patch pocket\r\nA pair of grey solid pyjamas, has an elasticated waistband with slip-on closure\r\nComes with an eye mask\r\n\r\nSize &amp;amp; Fit\r\nThe model (height 5\'8\') is wearing a size S\r\n\r\nMaterial &amp;amp; Care\r\nTop fabric: Modal\r\nBottom fabric: Modal\r\nMachine-wash', 20, '#000000', 'XS,S,L,XL', '168.jpg', '1.jpg,2.jpg,3.jpg', 0, 6, 1, '2020-09-30', 27, 1, 10),
(169, ' Sleeve Wrap Dress in Plum', 'Athena\r\nDramatic Entrance Lantern Sleeve Wrap Dress in Plum\r\nPRODUCT DETAILS \r\nEditor\'s Notes\r\nAthena presents this charming plum dress which would be an elegant choice to wear with a headpiece and gold accessories. Dramatic entrance, sorted!\r\n\r\nDetails\r\nDesigned with chic off shoulder surplice neck, self-tie bowknot at waist and statement lantern sleeves. Styled with a pencil shape that sits on the knee. \r\n\r\nKey Highlights\r\nCross-over silhouette\r\nPleated front\r\nPerfect trans-seasonal wear', 50, '#3b1212', 'XS,S,L,XL', '169.jpg', '1.jpg,2.jpg,3.jpg', 0, 3, 1, '2020-09-30', 27, 1, 20),
(170, 'H&amp;M  Socks', 'H&amp;M\r\nInfants Pack of 5 Solid Ankle Length Socks\r\n\r\nPRODUCT DETAILS \r\nSocks in a soft, fine-knit cotton blend with a fold-down shaft. Sizes 3-9 with anti-slip protectors.\r\n\r\n\r\nMaterial &amp; Care\r\n78% Cotton, 20% Polyamide, 2% Elastane\r\nHand Wash', 5, '#000000', 'Free Size', '170.jpg', '1.jpg,2.jpg,3.jpg', 0, 40, 1, '2020-09-30', 27, 1, 20);

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `sub_cat_id` int(50) NOT NULL,
  `sub_cat_name` varchar(100) COLLATE utf8_bin NOT NULL,
  `category_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`sub_cat_id`, `sub_cat_name`, `category_id`) VALUES
(3, 'Dresses', 8),
(4, 'Skirt\'s', 8),
(5, 'Pant\'s', 8),
(6, 'Sleep Wear', 8),
(8, 'All Suit\'s', 8),
(9, 'Abaya', 8),
(10, 'Jacket\'s', 8),
(11, 'Swim Wear', 8),
(12, 'Hijab', 8),
(13, 'Suit\'s', 9),
(14, 'Shirt\'s', 9),
(15, 'sports wear', 9),
(16, 'Sleep Wear', 9),
(17, 'Pants', 9),
(18, 'Jacket\'s', 9),
(19, 'Swim Wear', 9),
(21, 'Blush', 11),
(22, 'Body Care', 11),
(23, 'concealer', 11),
(24, 'Eye Shadow', 11),
(25, 'Eye Liner', 11),
(26, 'Eye brow', 11),
(27, 'Hair', 11),
(29, 'Lipstick', 11),
(30, 'Powder', 11),
(31, 'Foundation', 11),
(32, 'Skin Care', 11),
(33, 'Boy\'s Jacket', 10),
(34, 'Boy\'s Pants', 10),
(35, 'Boy\'s Shirts', 10),
(36, 'Boy\'s Suits', 10),
(37, 'Boy\'s Boots', 10),
(38, 'Boy\'s Hat', 10),
(39, 'Boy\'s Coat', 10),
(40, 'Boy\'s Socks', 10),
(41, 'Girl\'s Boots', 10),
(42, 'Girl\'s Dress', 10),
(43, 'Girl\'s Coat', 10),
(44, 'Girl\'s Hat', 10),
(45, 'Girl\'s Jacket', 10),
(46, 'Girl\'s Skirt', 10),
(47, 'Girl\'s T-shirt', 10),
(48, 'Girl\'s Suit', 10),
(49, 'Girl\'s Socks', 10),
(50, 'Boy\'s T-shirt', 10),
(51, 'Boots', 12),
(52, 'Watches', 12),
(53, 'Sunglasses', 12),
(54, 'Women\'s Shoes', 12),
(55, 'Women\'s Belts', 12),
(56, 'Women\'s Rings', 12),
(57, 'women bag', 12),
(58, ' earrings', 12);

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `vendor_id` int(50) NOT NULL,
  `vendor_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `vendor_email` varchar(50) COLLATE utf8_bin NOT NULL,
  `vendor_password` varchar(50) COLLATE utf8_bin NOT NULL,
  `vendor_image` varchar(50) COLLATE utf8_bin NOT NULL,
  `vendor_address` text COLLATE utf8_bin NOT NULL,
  `vendor_phone` int(50) NOT NULL,
  `active` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`vendor_id`, `vendor_name`, `vendor_email`, `vendor_password`, `vendor_image`, `vendor_address`, `vendor_phone`, `active`) VALUES
(13, 'Rawan Tarabsheh', 'rawantarabsheh@gmail.com', '72ad812d1214d75def09513ce9618701', '13.png', 'Al salt', 798441545, 1),
(14, 'heba tarabsheh', 'hebatarabsheh@gmail.com', 'ef48cefb5e42829e852a25dd79cb5da5', '14.jpg', 'Al salt', 798441545, 1),
(15, 'ahmad tarabsheh', 'ahmad@yagoo.com', '67779632c9147bdc3074d5811d07348c', '15.jpg', 'Al salt', 798441545, 1),
(16, 'rawan tarabsheh', 'rawantarabsheh@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '16.jpg', 'Al salt', 798441545, 0),
(17, 'rawan tarabsheh', 'hebatarabsheh@gmail.com', '72ad812d1214d75def09513ce9618701', '17.jpg', 'Al salt', 798441545, 0),
(18, 'Amer manaseer', 'amer@gmail.com', '58444d972f4d338905e4de65e40f6d13', '18.jpg', 'Al salt', 798441545, 1),
(19, 'Amer Manseer', 'amermanaseer@gmail.com', 'ea06b2ba42a696d49e4cb669f9089348', '19.jpg', 'Al salt', 798441545, 0),
(22, 'rawan tarabsheh', 'rawantarabsheh@gmail.com', '72ad812d1214d75def09513ce9618701', '22.jpg', 'Al salt', 798441545, 0),
(23, 'rawan', 'rawantarabsheh@yahoo.com', '72ad812d1214d75def09513ce9618701', '23.jpg', 'Al salt', 798441545, 0),
(24, 'Rawan Hamdi', 'rawantarabsheh@gmail.com', 'bd1f633a773150b905640631e1cfe050', '24.jpg', 'Al salt', 798441545, 1),
(25, 'teae', 'rawantarabsheh@gmail.com', '72ad812d1214d75def09513ce9618701', '25.jpg', 'Al salt', 798441545, 0),
(27, 'Salameh Yaseen', 'salameh@gmail.com', '5d99ada0a07556923f70d5685c201d6d', '27.jpg', 'amman', 798441545, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vendor_message`
--

CREATE TABLE `vendor_message` (
  `id` int(50) NOT NULL,
  `vendor_id` int(50) NOT NULL,
  `message` text COLLATE utf8_bin NOT NULL,
  `date` date NOT NULL,
  `title` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `vendor_message`
--

INSERT INTO `vendor_message` (`id`, `vendor_id`, `message`, `date`, `title`) VALUES
(1, 13, 'scwcwwwdqdqdqd', '2020-09-11', 'test test test'),
(3, 14, 'hikska\r\njcnwjkcbwjk\r\nwjcbw', '2020-09-23', 'change state'),
(4, 14, 'kfksnfsanfj', '2020-09-15', 'Technical support '),
(13, 14, 'dnwjwjkdw', '2020-09-29', 'test');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`contact_us_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`sub_cat_id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`vendor_id`);

--
-- Indexes for table `vendor_message`
--
ALTER TABLE `vendor_message`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `contact_us_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `sub_cat_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `vendor_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `vendor_message`
--
ALTER TABLE `vendor_message`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
