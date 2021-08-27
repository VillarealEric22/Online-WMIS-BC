-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2021 at 05:20 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `transaction_no` int(11) NOT NULL,
  `product_code` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price_ea` double NOT NULL,
  `price_tot` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`transaction_no`, `product_code`, `quantity`, `price_ea`, `price_tot`) VALUES
(9, 'p2', 10, 150, 0),
(9, 'product 1', 2, 250, 0),
(10, 'PO3', 2, 2500, 0),
(11, 'PO3', 3, 2500, 0),
(11, 'PM2', 5, 1500, 0),
(12, 'PO3', 2, 2500, 0),
(12, 'p2', 15, 150, 0),
(14, 'PO3', 15, 2500, 1),
(14, 'PM2', 10, 1500, 1),
(15, 'PO3', 12, 2500, 1),
(15, 'p2', 5, 100, 1),
(16, 'PO3', 15, 2500, 1),
(16, 'product 1', 1, 50000, 1),
(17, 'p2', 1, 150, 1),
(17, 'PO3', 5, 2500, 1),
(18, 'product 1', 1, 50000, 1),
(19, 'PO3', 5, 2500, 12500),
(19, 'product 1', 1, 50000, 50000),
(20, 'PO3', 5, 2500, 12500),
(21, 'PO3', 5, 2500, 12500),
(22, 'PO3', 5, 2500, 12500),
(23, 'PO3', 5, 2500, 12500),
(24, 'PO3', 5, 2500, 12500),
(25, 'PO3', 5, 2500, 12500),
(26, 'PO3', 1, 2500, 2500),
(27, 'PO3', 5, 2500, 12500),
(28, 'PO3', 5, 2500, 12500);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `c_address` varchar(250) NOT NULL,
  `contact_number` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `firstname`, `lastname`, `c_address`, `contact_number`) VALUES
(2, 'cj', 'alarcon', '123123', '12321312'),
(5, 'fhi', 'grafil', 'imus', '123'),
(6, 'Toffy', 'grafil', 'imus', '123');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employee_id` int(11) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `email_address` varchar(250) NOT NULL,
  `emp_address` varchar(50) NOT NULL,
  `contact_number` varchar(50) NOT NULL,
  `sex` varchar(50) NOT NULL,
  `birthday` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `lastname`, `firstname`, `middlename`, `email_address`, `emp_address`, `contact_number`, `sex`, `birthday`) VALUES
(1, 'Villareal', 'ej', 'John', '', 'Cadiz Street', '9295471787', 'Male', '2021-07-06'),
(2, 'Alarcon', 'Celwyn John', 'V', '', 'imus', '0909', 'Male', '2021-07-06'),
(3, 'Grafil', 'Sofhia', 'B', '', 'qweqw', '123123', 'Female', '2021-07-06'),
(4, 'Sambalilo', 'Aira', 'O', '', 'paliparan', '80974', 'Female', '2021-07-07'),
(10, 'Toffy', 'Toffy', 'F', '', 'CAVITE', '123', 'Female', '2019-03-03'),
(19, 'grafil', 'sofhia', 'b', '', 'imus', '123', 'Female', '2021-07-07'),
(20, 'GRAFIL', 'TOFFY', 'B', '', 'IMUS', '231', 'Female', '2021-07-20'),
(38, 'Villareal', 'Eric', 'John', '', 'Cadiz Street', '9295471787', 'Male', '2021-07-08');

-- --------------------------------------------------------

--
-- Table structure for table `item_inventory`
--

CREATE TABLE `item_inventory` (
  `inventory_id` int(11) NOT NULL,
  `product_code` varchar(50) NOT NULL,
  `curr_quantity` int(11) NOT NULL,
  `bQty` int(11) NOT NULL,
  `pQty` int(11) NOT NULL,
  `warehouse_code` varchar(50) NOT NULL,
  `date_created` date NOT NULL,
  `critical_amt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_inventory`
--

INSERT INTO `item_inventory` (`inventory_id`, `product_code`, `curr_quantity`, `bQty`, `pQty`, `warehouse_code`, `date_created`, `critical_amt`) VALUES
(2, 'PO3', 43, 50, 25, 'New', '2021-07-20', 1),
(5, 'PM2', 21, 11, 10, 'W3', '2021-08-16', 1),
(6, 'product 1', 11, 11, 0, '001', '2021-06-16', 1);

-- --------------------------------------------------------

--
-- Table structure for table `item_orders`
--

CREATE TABLE `item_orders` (
  `product_code` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price_ea` double NOT NULL,
  `price_tot` decimal(10,0) NOT NULL,
  `purchase_order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_orders`
--

INSERT INTO `item_orders` (`product_code`, `quantity`, `price_ea`, `price_tot`, `purchase_order_id`) VALUES
('p2', 11, 555, '0', 1),
('PO3', 5, 2500, '0', 3),
('product 1', 5, 50000, '0', 4),
('PM2', 5, 1500, '0', 5);

-- --------------------------------------------------------

--
-- Table structure for table `item_returns`
--

CREATE TABLE `item_returns` (
  `return_id` int(11) NOT NULL,
  `transaction_no` int(11) NOT NULL,
  `product_code` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `item_price` double NOT NULL,
  `total_price` double NOT NULL,
  `return_type` varchar(50) NOT NULL,
  `return_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_returns`
--

INSERT INTO `item_returns` (`return_id`, `transaction_no`, `product_code`, `quantity`, `item_price`, `total_price`, `return_type`, `return_date`) VALUES
(1, 1, 'PO3', 1, 1, 1, 'a', '2021-07-21'),
(2, 2, 'PM2', 0, 0, 0, 'b', '2021-07-16'),
(3, 2, 'product 1', 1, 50000, 50000, 'Replacement', '2021-07-25'),
(4, 17, 'PO3', 1, 2500, 2500, 'Replacement', '2021-08-16');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `package_code` varchar(50) NOT NULL,
  `total_price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`package_code`, `total_price`) VALUES
('package a', 555),
('package b', 500),
('package c', 100);

-- --------------------------------------------------------

--
-- Table structure for table `package_items`
--

CREATE TABLE `package_items` (
  `product_code` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `package_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `package_items`
--

INSERT INTO `package_items` (`product_code`, `quantity`, `package_code`) VALUES
('p2', 2, 'package c'),
('PO3', 22, 'package a'),
('PO3', 11, 'package b'),
('product 1', 5, 'package a'),
('product 1', 2, 'package b');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_code` varchar(50) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `manufacturer` varchar(250) NOT NULL,
  `capacity` varchar(50) NOT NULL,
  `measurement` varchar(50) NOT NULL,
  `product_type` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `lenght` int(11) NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `item_price` double NOT NULL,
  `supplier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_code`, `product_name`, `manufacturer`, `capacity`, `measurement`, `product_type`, `color`, `lenght`, `width`, `height`, `unit`, `item_price`, `supplier_id`) VALUES
('', '', '', '', '', 'test', '', 0, 0, 0, '', 0, 1),
('p2', 'produktow', 'samp', '200', '', 'test', 'blue', 0, 0, 0, '', 0, 5),
('PM2', 'Mixer', 'abc', '100', '', 'test', 'white', 1, 1, 1, '', 1500, 12),
('PO3', 'oven', 'abc', '1', '', 'test', 'Gray', 10, 10, 10, '', 2500, 12),
('product 1', 'ovenee', 'test', '4 Trays', '', 'testing2', 'red', 22, 22, 12, '', 50000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `product_type` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`product_type`, `description`) VALUES
('test', 'test'),
('testing2', 'testtest');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE `purchase_order` (
  `purchase_order_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `itemsTotal` int(11) NOT NULL,
  `total_price` double NOT NULL,
  `order_date` date NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase_order`
--

INSERT INTO `purchase_order` (`purchase_order_id`, `supplier_id`, `itemsTotal`, `total_price`, `order_date`, `status`) VALUES
(1, 1, 0, 555, '2021-07-21', 'pending'),
(2, 1, 0, 37500, '2021-08-16', 'pending'),
(3, 2, 0, 12500, '2021-07-19', 'received'),
(4, 2, 0, 250000, '2021-08-19', 'pending'),
(5, 2, 0, 7500, '2021-08-19', 'received');

-- --------------------------------------------------------

--
-- Table structure for table `sales_transaction`
--

CREATE TABLE `sales_transaction` (
  `transaction_no` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `itemsTotal` int(11) NOT NULL,
  `total_price` double NOT NULL,
  `transaction_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_transaction`
--

INSERT INTO `sales_transaction` (`transaction_no`, `customer_id`, `itemsTotal`, `total_price`, `transaction_date`) VALUES
(1, 2, 0, 400, '2021-07-16'),
(2, 2, 0, 400, '2021-07-16'),
(3, 2, 0, 400, '2021-07-16'),
(4, 2, 0, 400, '2021-07-16'),
(5, 2, 0, 185, '2021-07-16'),
(6, 2, 0, 400, '2021-07-16'),
(7, 2, 0, 400, '2021-07-17'),
(8, 2, 0, 300, '2021-07-17'),
(9, 2, 0, 400, '2021-07-17'),
(10, 2, 0, 5000, '2021-08-14'),
(11, 5, 0, 15000, '2021-08-11'),
(12, 5, 0, 7250, '2021-08-14'),
(13, 5, 0, 52500, '2021-08-14'),
(14, 5, 0, 52500, '2021-08-14'),
(15, 5, 0, 30500, '2021-08-14'),
(16, 5, 0, 87500, '2021-08-14'),
(17, 5, 0, 12650, '2021-08-14'),
(18, 2, 0, 50000, '2021-08-14'),
(19, 5, 0, 62500, '2021-08-14'),
(20, 5, 0, 12500, '2021-08-21'),
(21, 5, 0, 12500, '2021-08-21'),
(22, 5, 0, 12500, '2021-08-21'),
(23, 5, 0, 12500, '2021-08-21'),
(24, 2, 0, 12500, '2021-08-21'),
(25, 5, 0, 12500, '2021-08-21'),
(26, 2, 0, 2500, '2021-08-21'),
(27, 5, 0, 12500, '2021-08-21'),
(28, 2, 0, 12500, '2021-08-21');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(50) NOT NULL,
  `s_address` varchar(250) NOT NULL,
  `contact_number` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_name`, `s_address`, `contact_number`) VALUES
(1, 'try', 'test', '123'),
(2, 'fhia', 'imus', '123'),
(3, 'sofhia', 'cavite', '0999'),
(4, 'cel', 'cavite', '09222'),
(5, 'AIRA', 'PALIAPARAN', '111'),
(6, 'pia', 'cavite', '777'),
(8, 'fhia', 'imus', '8030952'),
(9, 'fhia', 'adress', '123'),
(10, 'SOFHIA', 'IMUS', '1234'),
(11, 'toffy', 'imus', '123'),
(12, 'fhia', '123', '0000');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_role` varchar(50) NOT NULL,
  `employee_id` int(50) NOT NULL,
  `user_img` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `user_role`, `employee_id`, `user_img`) VALUES
('BCAdmin', '$2y$10$nBnhBWVboXYo2o38xPVsTOzw8Y7xh8a.F1nJLrh.VY/BIaH.E/Ak2', 'Admin', 1, ''),
('DW', '$2y$10$0/f4rot2se3Ax/ve1YFDvuakYf0zalKyEU4P70e3dy554tJPz6Cl2', 'Admin', 20, ''),
('TestUser', '$2y$10$qmv2yZwctwhQAXCxVp2eTOlKZ/9lFjJBmuOC.98LdRlTpG06wWpYO', 'Admin', 2, ''),
('TestUser2', '$2y$10$NknTPJWM7wpdyIDhIcPDZux0wkf9TRtbeXynbCtA63xgFMglpkr6W', 'Admin', 1, ''),
('TF', '$2y$10$fw0TTT0cIoUbgidydC.9I.UaojCRTqJ7VodBXdQjfeKdAHfrX8Hsu', 'Admin', 10, '');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `user_role` varchar(50) NOT NULL,
  `r_products` varchar(50) NOT NULL,
  `r_inventory` varchar(50) NOT NULL,
  `r_sales` varchar(50) NOT NULL,
  `r_orders` varchar(50) NOT NULL,
  `r_customers` varchar(50) NOT NULL,
  `r_suppliers` varchar(50) NOT NULL,
  `r_warehouse` varchar(50) NOT NULL,
  `r_reports` varchar(50) NOT NULL,
  `r_returns` varchar(50) NOT NULL,
  `r_users` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`user_role`, `r_products`, `r_inventory`, `r_sales`, `r_orders`, `r_customers`, `r_suppliers`, `r_warehouse`, `r_reports`, `r_returns`, `r_users`) VALUES
('Admin', 'Read-Only', 'Read-Only', 'Create-and-Edit', 'No-Restrictions', 'No-Restrictions', 'No-Restrictions', 'No-Authorization', 'No-Restrictions', 'No-Restrictions', 'No-Restrictions');

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `warehouse_code` varchar(50) NOT NULL,
  `warehouse_name` varchar(250) NOT NULL,
  `warehouse_address` varchar(250) NOT NULL,
  `warehouse_area` double NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`warehouse_code`, `warehouse_name`, `warehouse_address`, `warehouse_area`, `username`) VALUES
('001', 'SAMPLE', 'Cavite', 200, 'TestUser'),
('New', 'warehouse', 'iomis', 100, 'DW'),
('SAMPLE1', 'SAMPLE', 'SAMPLE1', 100, 'DW'),
('TF', 'Toffy', 'Imus', 150, 'DW'),
('w1', 'try', 'imus', 100, 'BCAdmin'),
('W3', 'SAMPLE', 'Cavite', 100, 'BCAdmin'),
('www', 'qweqw', 'www', 12, 'BCAdmin');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_storage`
--

CREATE TABLE `warehouse_storage` (
  `storage_no` int(11) NOT NULL,
  `storage_type` varchar(50) NOT NULL,
  `length` int(11) NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `stack` int(11) DEFAULT NULL,
  `warehouse_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD KEY `product_code` (`product_code`),
  ADD KEY `transaction_no` (`transaction_no`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `customer_id` (`customer_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`),
  ADD UNIQUE KEY `employee_id` (`employee_id`);

--
-- Indexes for table `item_inventory`
--
ALTER TABLE `item_inventory`
  ADD PRIMARY KEY (`inventory_id`),
  ADD UNIQUE KEY `inventory_id` (`inventory_id`,`product_code`),
  ADD UNIQUE KEY `product_code` (`product_code`) USING BTREE,
  ADD KEY `warehouse_code` (`warehouse_code`) USING BTREE;

--
-- Indexes for table `item_orders`
--
ALTER TABLE `item_orders`
  ADD KEY `product_code` (`product_code`),
  ADD KEY `purchase_order_id` (`purchase_order_id`);

--
-- Indexes for table `item_returns`
--
ALTER TABLE `item_returns`
  ADD PRIMARY KEY (`return_id`),
  ADD KEY `transaction_id` (`transaction_no`,`product_code`),
  ADD KEY `product_code` (`product_code`) USING BTREE;

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`package_code`);

--
-- Indexes for table `package_items`
--
ALTER TABLE `package_items`
  ADD UNIQUE KEY `product_code` (`product_code`,`package_code`),
  ADD KEY `package_code` (`package_code`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_code`),
  ADD UNIQUE KEY `product_code` (`product_code`,`product_name`,`supplier_id`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `product_type` (`product_type`),
  ADD KEY `product_name` (`product_name`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`product_type`);

--
-- Indexes for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD PRIMARY KEY (`purchase_order_id`),
  ADD UNIQUE KEY `purchase_order_id` (`purchase_order_id`,`supplier_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `sales_transaction`
--
ALTER TABLE `sales_transaction`
  ADD PRIMARY KEY (`transaction_no`),
  ADD KEY `transaction_no` (`transaction_no`),
  ADD KEY `sales_transaction_ibfk_1` (`customer_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`),
  ADD UNIQUE KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`),
  ADD KEY `user_role` (`user_role`),
  ADD KEY `user_ibfk_1` (`employee_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`user_role`);

--
-- Indexes for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`warehouse_code`),
  ADD UNIQUE KEY `warehouse_code` (`warehouse_code`),
  ADD KEY `username` (`username`) USING BTREE;

--
-- Indexes for table `warehouse_storage`
--
ALTER TABLE `warehouse_storage`
  ADD KEY `warehouse_code` (`warehouse_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `item_inventory`
--
ALTER TABLE `item_inventory`
  MODIFY `inventory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=382;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`product_code`) REFERENCES `products` (`product_code`),
  ADD CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`transaction_no`) REFERENCES `sales_transaction` (`transaction_no`);

--
-- Constraints for table `item_inventory`
--
ALTER TABLE `item_inventory`
  ADD CONSTRAINT `item_inventory_ibfk_1` FOREIGN KEY (`product_code`) REFERENCES `products` (`product_code`),
  ADD CONSTRAINT `item_inventory_ibfk_2` FOREIGN KEY (`warehouse_code`) REFERENCES `warehouses` (`warehouse_code`);

--
-- Constraints for table `item_orders`
--
ALTER TABLE `item_orders`
  ADD CONSTRAINT `item_orders_ibfk_1` FOREIGN KEY (`product_code`) REFERENCES `products` (`product_code`),
  ADD CONSTRAINT `item_orders_ibfk_2` FOREIGN KEY (`purchase_order_id`) REFERENCES `purchase_order` (`purchase_order_id`);

--
-- Constraints for table `item_returns`
--
ALTER TABLE `item_returns`
  ADD CONSTRAINT `item_returns_ibfk_1` FOREIGN KEY (`transaction_no`) REFERENCES `sales_transaction` (`transaction_no`),
  ADD CONSTRAINT `item_returns_ibfk_2` FOREIGN KEY (`product_code`) REFERENCES `products` (`product_code`);

--
-- Constraints for table `package_items`
--
ALTER TABLE `package_items`
  ADD CONSTRAINT `package_items_ibfk_2` FOREIGN KEY (`product_code`) REFERENCES `products` (`product_code`),
  ADD CONSTRAINT `package_items_ibfk_3` FOREIGN KEY (`package_code`) REFERENCES `packages` (`package_code`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_5` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`),
  ADD CONSTRAINT `products_ibfk_7` FOREIGN KEY (`product_type`) REFERENCES `product_category` (`product_type`);

--
-- Constraints for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD CONSTRAINT `purchase_order_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`);

--
-- Constraints for table `sales_transaction`
--
ALTER TABLE `sales_transaction`
  ADD CONSTRAINT `sales_transaction_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`user_role`) REFERENCES `user_roles` (`user_role`);

--
-- Constraints for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD CONSTRAINT `warehouses_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`);

--
-- Constraints for table `warehouse_storage`
--
ALTER TABLE `warehouse_storage`
  ADD CONSTRAINT `warehouse_storage_ibfk_1` FOREIGN KEY (`warehouse_code`) REFERENCES `warehouses` (`warehouse_code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
