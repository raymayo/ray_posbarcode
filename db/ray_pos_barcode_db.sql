-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2023 at 07:59 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ray_pos_barcode_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `catid` int(255) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`catid`, `category`) VALUES
(1, 'Computer'),
(2, 'Mouse'),
(4, 'Keyboard'),
(5, 'Monitor'),
(6, 'Speaker'),
(7, 'Headphones'),
(8, 'Mousepad'),
(9, 'Motherboard'),
(10, 'CPU'),
(11, 'Graphics Card'),
(12, 'Fans');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_form`
--

CREATE TABLE `tbl_form` (
  `userid` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `useremail` varchar(255) NOT NULL,
  `userpassword` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_form`
--

INSERT INTO `tbl_form` (`userid`, `username`, `useremail`, `userpassword`, `role`) VALUES
(1, 'Luffy', 'luffy@gmail.com', '12345', 'Admin'),
(2, 'Chopper', 'chopper@gmail.com', 'chopper123', 'User'),
(3, 'Zoro', 'zoro@gmail.com', 'zoro123', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `pid` int(255) NOT NULL,
  `barcode` varchar(1000) NOT NULL,
  `product` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `stock` int(255) NOT NULL,
  `purchaseprice` float NOT NULL,
  `saleprice` float NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`pid`, `barcode`, `product`, `category`, `description`, `stock`, `purchaseprice`, `saleprice`, `image`) VALUES
(1, '65465445646546654', 'Logitech PRO X SUPERLIGHT 2', 'Mouse', 'The next evolution of our championship-winning mouse. Meet the new weapon of choice for the world’s top esports athletes.', 154, 7999, 8999, '652f723b714f9_logitech_pro_x_superlight_2_mouse_white_910-006640.jpg'),
(2, '5121151132165', 'Test Product', 'Graphics Card', 'qweqeqeqweqw', 232, 2233, 3233, '652f73b2b2ce5_logitech_pro_x_superlight_2_mouse_white_910-006640.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`catid`);

--
-- Indexes for table `tbl_form`
--
ALTER TABLE `tbl_form`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`pid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `catid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_form`
--
ALTER TABLE `tbl_form`
  MODIFY `userid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `pid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
