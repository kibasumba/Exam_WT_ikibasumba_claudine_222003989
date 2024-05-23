-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2024 at 10:29 AM
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
-- Database: `bike_shop_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `bikes`
--

CREATE TABLE `bikes` (
  `BikeID` int(11) NOT NULL,
  `Brand` varchar(50) DEFAULT NULL,
  `Model` varchar(50) DEFAULT NULL,
  `Type` varchar(50) DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bikes`
--

INSERT INTO `bikes` (`BikeID`, `Brand`, `Model`, `Type`, `Price`) VALUES
(1, 'Road bike brands', 'Electric', 'HybridBike', 200000.00),
(2, 'fat', 'Hero', 'mountain', 600000.00),
(3, 'hybrid bike', 'electric', 'moto', 1000.00);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `CustomerID` int(11) NOT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`CustomerID`, `FirstName`, `LastName`, `Email`, `Phone`) VALUES
(1, 'Danny', 'Mugisha', 'mugishaD@gmail.com', '07810838234'),
(5, 'diane', 'mutoni', 'mutoni@gmail.com', '0788857026'),
(12, 'gad', 'Ruremesha', 'ruremesha@gmail.com', '0780553232');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `EmployeeID` int(11) NOT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `Position` varchar(50) DEFAULT NULL,
  `Salary` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`EmployeeID`, `FirstName`, `LastName`, `Position`, `Salary`) VALUES
(1, 'kaluzi', 'alex', 'CEO', 10000000.00),
(2, 'Kibasumba', 'nicky', 'MD', 800000.00),
(3, 'NG', 'KC', 'HR', 500000.00),
(12, 'aline', 'mwiza', 'RH', 123.00);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(11) NOT NULL,
  `CustomerID` int(11) DEFAULT NULL,
  `BikeID` int(11) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `TotalPrice` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `CustomerID`, `BikeID`, `Quantity`, `TotalPrice`) VALUES
(2, 3, 2, 10, 30000.00),
(3, 1, 3, 15, 50000.00),
(6, 1, 1, 987, 876.00);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `StockID` int(11) NOT NULL,
  `BikeID` int(11) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Supplier` varchar(100) DEFAULT NULL,
  `PurchaseDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`StockID`, `BikeID`, `Quantity`, `Supplier`, `PurchaseDate`) VALUES
(1, 2, 2, '43', '0000-00-00'),
(2, 3, 3, '10', '2020-05-12'),
(3, 4, 4, '10', '2024-05-23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Phone` varchar(20) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `MembershipType` varchar(50) NOT NULL,
  `PasswordHash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `FirstName`, `LastName`, `Email`, `Phone`, `Address`, `MembershipType`, `PasswordHash`) VALUES
(1, 'uwase', 'ange', 'angel@gmail.com', '0789999879', 'kgl', 'Premium', '$2y$10$jbCgp6AM8g8yzimjGq7kWOZJBulP9SwnG4HL16B3vXJX5/wSiPyd6'),
(4, 'kibasumba', 'ange', 'kibasumba@gmail.com', '0720000000', 'kgl', 'Basic', '$2y$10$7ACkEP265TF1bNlWiKTPeu4iZnYhFZ/.AZ9FtgW2ruTmFgRjRe9gO'),
(5, 'braver', 'king', 'braver@gmail.com', '0789976532', 'muhanga', 'Basic', '$2y$10$s4XaIOZQMcSZerhWCCPXIupWvS6K5JXk8/2yLOxMXiyxjuxuOfAI.'),
(6, 'alice', 'dudu', 'dudu@gmail.com', '0788000000', 'kgl', 'Basic', '$2y$10$ygAKvsf7zv2dlw79VZn3geZBv1hivAG5UjxboqgI8dQq5/qhNrlbe'),
(7, 'kazungu', 'esther', 'kazungu@gmail.com', '0778989890', 'muhanga', 'Basic', '$2y$10$wIXXLqeTB7znXotns2aE4ORs13svpxqCvIf6sawC4tKcOsMtbvbn.'),
(12, 'shema', 'Claudine ', 'claudine@gmail.com', '0778989891', 'muhanga', 'Premium', '$2y$10$PHCZ6VwM9q.ZR.25MdUX5O4ELxeHFOS3AvpZi9dHfu..xEbn/3xHa'),
(14, 'ishimwe', 'braver', 'braver1@gmail.com', '0780000007', 'huye', 'Premium', '$2y$10$p/lKx6Rhx1xrPlsfiW6oPecTbzSRWF78D5YwwVZ/en6IFSPJbLn4y');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bikes`
--
ALTER TABLE `bikes`
  ADD PRIMARY KEY (`BikeID`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`EmployeeID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`StockID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `Phone` (`Phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
