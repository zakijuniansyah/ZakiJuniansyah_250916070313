-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 21, 2025 at 10:42 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ujikom`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telpon` varchar(30) DEFAULT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `nama`, `alamat`, `telpon`, `email`) VALUES
(2, 'ZAKI JUNIANSYAH', 'Babakan, Kec. Setu, Kota Tangerang Selatan, Banten', '083174105801', 'zakyjuniansyah@gmail.com'),
(3, 'Jaki', 'Pamulang', '083174105801', 'jaki@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id_item` int NOT NULL,
  `nama_item` varchar(150) NOT NULL,
  `harga_beli` decimal(12,2) NOT NULL,
  `harga_jual` decimal(12,2) NOT NULL,
  `stok` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id_item`, `nama_item`, `harga_beli`, `harga_jual`, `stok`) VALUES
(2, 'Kursi', '100000.00', '85000.00', -1),
(3, 'Meja', '150000.00', '200000.00', 0),
(4, 'Laptop', '12000000.00', '12500000.00', 11),
(5, 'Colokan', '5000.00', '7000.00', 8);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--
-- Error reading structure for table ujikom.login: #1812 - Tablespace is missing for table `ujikom`.`login`.
-- Error reading data for table ujikom.login: #1812 - Tablespace is missing for table `ujikom`.`login`.

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_user` int NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_user`, `nama_user`, `username`, `password`) VALUES
(2, 'ZAKI JUNIANSYAH', 'zakijuniansyah', '$2y$10$2R/M4vX9ptWkEcoPP3NHluS7QfOX3g2LNXVUcV2UVe9blXhKEoaeC');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id_sales` int NOT NULL,
  `id_customer` int NOT NULL,
  `do_number` varchar(50) DEFAULT NULL,
  `status` enum('Pending','Proses','Selesai') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id_sales`, `id_customer`, `do_number`, `status`) VALUES
(3, 2, '0101', 'Proses'),
(4, 3, '1111', 'Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id_transaction` int NOT NULL,
  `id_sales` int NOT NULL,
  `id_item` int NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id_transaction`, `id_sales`, `id_item`, `quantity`, `price`, `amount`, `created_at`) VALUES
(1, 3, 2, 9, '85000.00', '765000.00', '2025-09-21 05:44:03'),
(2, 3, 2, 1, '85000.00', '85000.00', '2025-09-21 05:45:57'),
(3, 3, 3, 12, '200000.00', '2400000.00', '2025-09-21 05:50:39'),
(4, 3, 5, 2, '7000.00', '14000.00', '2025-09-21 08:18:08'),
(5, 3, 4, 2, '12500000.00', '25000000.00', '2025-09-21 08:26:05'),
(6, 3, 2, 1, '85000.00', '85000.00', '2025-09-21 08:30:02');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_temp`
--

CREATE TABLE `transaction_temp` (
  `id_temp` int NOT NULL,
  `id_sales` int NOT NULL,
  `id_item` int NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `amount` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$iQSFgqGJz9g52c/uqYzU8.6lIO4yqNU2zz8oarAN.OSnxsqpH0HM.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id_item`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id_sales`),
  ADD KEY `id_customer` (`id_customer`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id_transaction`),
  ADD KEY `id_sales` (`id_sales`),
  ADD KEY `id_item` (`id_item`);

--
-- Indexes for table `transaction_temp`
--
ALTER TABLE `transaction_temp`
  ADD PRIMARY KEY (`id_temp`),
  ADD KEY `id_sales` (`id_sales`),
  ADD KEY `id_item` (`id_item`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id_item` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id_sales` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id_transaction` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transaction_temp`
--
ALTER TABLE `transaction_temp`
  MODIFY `id_temp` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`id_sales`) REFERENCES `sales` (`id_sales`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`id_item`) REFERENCES `item` (`id_item`) ON DELETE CASCADE;

--
-- Constraints for table `transaction_temp`
--
ALTER TABLE `transaction_temp`
  ADD CONSTRAINT `transaction_temp_ibfk_1` FOREIGN KEY (`id_sales`) REFERENCES `sales` (`id_sales`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaction_temp_ibfk_2` FOREIGN KEY (`id_item`) REFERENCES `item` (`id_item`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
