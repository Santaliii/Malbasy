-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2022 at 03:32 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `malbasy`
--

-- --------------------------------------------------------

--
-- Table structure for table `accessories`
--

CREATE TABLE `accessories` (
  `id` int(11) NOT NULL,
  `type` varchar(45) NOT NULL,
  `description` varchar(45) NOT NULL,
  `price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `image_src` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accessories`
--

INSERT INTO `accessories` (`id`, `type`, `description`, `price`, `quantity`, `image_src`) VALUES
(2, 'Accessories', 'Watch', 200.99, 5, 'Accessories/Watch.jpg'),
(3, 'Accessories', 'Hat', 20.99, 4, 'Accessories/Hat.jpg'),
(4, 'Accessories', 'Sunglasses', 139.99, 5, 'Accessories/Sunglasses.jpg'),
(5, 'Accessories', 'Wallet', 30.99, 5, 'Accessories/Wallet.jpg'),
(6, 'Accessories', 'Belt', 10.99, 5, 'Accessories/Belt.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(2, 'khalid', '5f14e72d515e753ca29c94e56cf339a8358067cbbb425dfe8cb2974bdbd1fc45'),
(3, 'omar', '21297e6e966afbd06e8f08c4525ae2edcbd3696cc6bc436037e278d4b1e67b4d'),
(4, 'bandar', '2853bf819ad7796cc048e782ed3c2ada2587f86574f7193b7f3d5c5f2f640ba2'),
(5, 'badr', '36e5236fcd4c61044949678014f0d0b337384d2c0ee41dda458bda5c57f2fc68'),
(6, 'sakher', 'dcf41dd781d0075b8504fa4a66e5dcf7dbcfd0d620311d187657f7d8e9262782'),
(7, 'ali', '94419b99b12c11133a4dfeccc3e17885974beb48f7827c48239aabfbcad238d8');

-- --------------------------------------------------------

--
-- Table structure for table `bottoms`
--

CREATE TABLE `bottoms` (
  `id` int(11) NOT NULL,
  `type` varchar(45) NOT NULL,
  `description` varchar(45) NOT NULL,
  `price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `image_src` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bottoms`
--

INSERT INTO `bottoms` (`id`, `type`, `description`, `price`, `quantity`, `image_src`) VALUES
(1, 'Bottoms', 'Jeans', 140.99, 5, 'Bottoms/Jeans.jpg'),
(3, 'Bottoms', 'Shorts', 60.99, 4, 'Bottoms/Shorts.jpg'),
(4, 'Bottoms', 'Sweatpants', 71.99, 6, 'Bottoms/Sweatpants.jpg'),
(5, 'Bottoms', 'Swimming Shorts', 76.99, 11, 'Bottoms/Swimming Shorts.jpg'),
(6, 'Bottoms', 'Chinos', 43.99, 6, 'Bottoms/Chinos.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `order_total` double NOT NULL,
  `date_ordered` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `type` varchar(45) NOT NULL,
  `description` varchar(45) NOT NULL,
  `price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `image_src` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `shoes`
--

CREATE TABLE `shoes` (
  `id` int(11) NOT NULL,
  `type` varchar(45) NOT NULL,
  `description` varchar(45) NOT NULL,
  `price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `image_src` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shoes`
--

INSERT INTO `shoes` (`id`, `type`, `description`, `price`, `quantity`, `image_src`) VALUES
(2, 'Shoes', 'Sneakers', 140.99, 5, 'Shoes/Sneakers.jpg'),
(3, 'Shoes', 'Football Boots', 180.99, 1, 'Shoes/Football Boots.jpg'),
(4, 'Shoes', 'Boots', 80.99, 3, 'Shoes/Boots.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `upperwear`
--

CREATE TABLE `upperwear` (
  `id` int(11) NOT NULL,
  `type` varchar(45) NOT NULL,
  `description` varchar(45) NOT NULL,
  `price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `image_src` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `upperwear`
--

INSERT INTO `upperwear` (`id`, `type`, `description`, `price`, `quantity`, `image_src`) VALUES
(2, 'Upperwear', 'Space Hoodie', 20.99, 3, 'Upperwear/Space Print Hoodie.jpg'),
(3, 'Upperwear', 'Striped T-Shirt', 30.99, 6, 'Upperwear/Striped T-Shirt.jpg'),
(4, 'Upperwear', 'Plain T-Shirt', 20.99, 3, 'Upperwear/T-Shirt.jpg'),
(5, 'Upperwear', 'Plain Tank-Top', 35.99, 9, 'Upperwear/Tank Top.jpg'),
(6, 'Upperwear', 'V-Neck T-Shirt', 15.99, 4, 'Upperwear/V-Neck T-Shirt.jpg'),
(8, 'Upperwear', 'Plain Hoodie', 81.99, 11, 'Upperwear/Hoodie.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accessories`
--
ALTER TABLE `accessories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bottoms`
--
ALTER TABLE `bottoms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order` (`order_id`);

--
-- Indexes for table `shoes`
--
ALTER TABLE `shoes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upperwear`
--
ALTER TABLE `upperwear`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accessories`
--
ALTER TABLE `accessories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `bottoms`
--
ALTER TABLE `bottoms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `shoes`
--
ALTER TABLE `shoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `upperwear`
--
ALTER TABLE `upperwear`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_products`
--
ALTER TABLE `order_products`
  ADD CONSTRAINT `order` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
