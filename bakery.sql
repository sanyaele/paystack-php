-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 27, 2019 at 02:10 PM
-- Server version: 5.7.25-0ubuntu0.18.04.2
-- PHP Version: 7.2.15-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bakery`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `global` set('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `global`) VALUES
(1, 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', '1');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `item_name`, `date_added`) VALUES
(1, 'Yeast', '2019-02-22 11:19:12'),
(2, 'Flour', '2019-02-22 11:19:12'),
(3, 'Sugar', '2019-02-22 11:19:24'),
(4, 'Salt', '2019-02-22 11:19:24'),
(5, 'Eggs', '2019-02-22 11:19:51'),
(6, 'Fat', '2019-02-22 11:19:51'),
(7, 'Milk', '2019-02-22 11:20:37'),
(8, 'Butter', '2019-02-22 11:20:37');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `confirmation` enum('True','False') NOT NULL DEFAULT 'False',
  `date_paid` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `paystack_recepient_code` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telephone` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `items` varchar(50) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `paystack_recepient_code`, `name`, `email`, `telephone`, `address`, `items`, `date_added`) VALUES
(1, '', 'Opeyemi Bakers Shop', 'opeyemi@mymail.com', '08063467345', 'Ikotun, Alimosho, Lagos', 'Yeast', '2019-02-22 11:28:42'),
(2, '', 'G Waltob Venture', 'waltob@gmail.com', '07086753792', 'oko oba, ifako ijaiye, lagos', 'Yeast', '2019-02-22 11:28:42'),
(3, '', 'Flour Mills of Nigeria PLC', 'info@flourmills.com', '08012542314', '2 Old Dockyard Road, Wharf Road, Apapa, Lagos', 'Flour', '2019-02-22 11:30:54'),
(4, '', 'Honeywell Flour Mills Plc', 'info@honeywell.com.ng', '09065526725', 'Oregun, Ikeja', 'Flour', '2019-02-22 11:30:54'),
(5, '', 'Dogan\'s Sugar Limited', 'dogan@yahoo.com', '08015656287', 'Oba Kayode Akinyemi Way, Amuwo Odofin Estate, Lagos', 'Sugar', '2019-02-22 11:32:51'),
(6, '', 'Dangote Sugar Refinery PLC', 'info@dangotesugar.com.ng', '08165267879', 'GDNL, 3rd Floor,Terminal E Shed 20 NPA Wharf Port Complex, Apapa, Lagos', 'Sugar', '2019-02-22 11:32:51'),
(7, '', 'Covenant Salt Company Limited', 'info@covenantsalt.com.ng', '08007854458', 'Plot C10 Afam Close, Industrial Estate, Agbara, Ogun State Nigeria', 'Salt', '2019-02-22 11:36:17'),
(8, '', 'Columbia International Limited', 'contact@columbiasalt.ng', '07012572098', 'Shed E/G And Shed 4 ,Apapa Port Complex, Apapa, Lagos', 'Salt', '2019-02-22 11:36:17'),
(9, '', 'Chellarams Plc', 'info@chellaramsplc.com', '08052676287', 'Agidingbi, Alausa, ikeja', 'Milk', '2019-02-22 11:38:48'),
(10, '', 'Presco Plc', 'admin@presco.ng', '09065235872', 'Ikeja, lagos', 'Fat', '2019-02-22 11:38:48'),
(11, '', 'Mama Risi Farms', 'risi@yahoo.com', '08056462782', 'Agbalata market, Ketu', 'Eggs', '2019-02-22 12:33:30'),
(12, '', 'Bolawole Enterprises Nigeria Ltd', 'info@bolawole.com', '09067352780', '14 Fatai Atere Way, Matori Oshodi Mushin, Lagos Nigeria', 'Butter', '2019-02-22 12:33:30');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers_banks`
--

CREATE TABLE `suppliers_banks` (
  `id` int(11) NOT NULL,
  `supplier_email` varchar(50) NOT NULL,
  `bank` varchar(50) NOT NULL,
  `bankCode` varchar(10) NOT NULL,
  `accountName` varchar(100) NOT NULL,
  `recipient_code` varchar(25) NOT NULL,
  `accountNumber` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `supplies`
--

CREATE TABLE `supplies` (
  `id` int(11) NOT NULL,
  `payment_reference_id` varchar(50) NOT NULL,
  `item_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `status` enum('initiated','supplied','paid','cancelled','returned') NOT NULL DEFAULT 'initiated',
  `quantity_desc` varchar(50) NOT NULL,
  `amount` int(11) NOT NULL,
  `supply_type` enum('prepaid','postpaid') NOT NULL DEFAULT 'postpaid',
  `paid` enum('yes','no') NOT NULL DEFAULT 'no',
  `supply_order_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `supply_date` timestamp NULL DEFAULT NULL,
  `payment_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplies`
--

INSERT INTO `supplies` (`id`, `payment_reference_id`, `item_id`, `supplier_id`, `status`, `quantity_desc`, `amount`, `supply_type`, `paid`, `supply_order_date`, `supply_date`, `payment_date`) VALUES
(1, '', 1, 1, 'supplied', '50kg', 30000, 'postpaid', 'no', '2019-02-23 08:34:48', '2019-02-23 08:34:48', '2019-02-23 08:34:48'),
(2, '', 1, 2, 'initiated', '125kg', 70000, 'prepaid', 'no', '2019-02-23 08:59:45', NULL, NULL),
(3, '', 2, 3, 'initiated', '100kg', 100000, 'postpaid', 'no', '2019-02-23 09:01:26', NULL, NULL),
(4, '', 2, 4, 'initiated', '100', 90000, 'prepaid', 'no', '2019-02-23 09:01:26', NULL, NULL),
(5, '', 3, 5, 'initiated', '10', 7000, 'prepaid', 'no', '2019-02-23 09:03:30', NULL, NULL),
(6, '', 3, 6, 'initiated', '18kg', 20000, 'prepaid', 'no', '2019-02-23 09:03:30', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`email`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `suppliers_banks`
--
ALTER TABLE `suppliers_banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplies`
--
ALTER TABLE `supplies`
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
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `suppliers_banks`
--
ALTER TABLE `suppliers_banks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `supplies`
--
ALTER TABLE `supplies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
