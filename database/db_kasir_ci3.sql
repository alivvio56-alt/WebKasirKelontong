-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 08, 2026 at 05:52 AM
-- Server version: 8.0.45-0ubuntu0.24.04.1
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kasir_ci3`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id` int NOT NULL,
  `id_transaksi` int NOT NULL,
  `id_produk` int DEFAULT NULL,
  `nama_produk` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga_satuan` decimal(15,2) NOT NULL,
  `qty` int NOT NULL DEFAULT '1',
  `subtotal` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id`, `id_transaksi`, `id_produk`, `nama_produk`, `harga_satuan`, `qty`, `subtotal`) VALUES
(7, 7, 3, 'Aqua 600ml', 3000.00, 1, 3000.00),
(8, 7, 5, 'Chitato 68gr', 10000.00, 1, 10000.00),
(9, 8, 3, 'Aqua 600ml', 3000.00, 1, 3000.00),
(10, 8, 5, 'Chitato 68gr', 10000.00, 1, 10000.00),
(11, 8, 7, 'Gudang Garam 12', 25000.00, 1, 25000.00),
(12, 9, 3, 'Aqua 600ml', 3000.00, 1, 3000.00),
(13, 10, 3, 'Aqua 600ml', 3000.00, 1, 3000.00),
(14, 10, 2, 'Indomie Kuah', 3500.00, 1, 3500.00),
(15, 10, 9, 'Shampo Pantene', 12000.00, 1, 12000.00);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int NOT NULL,
  `nama_kategori` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama_kategori`, `created_at`) VALUES
(1, 'Makanan', '2026-05-16 03:14:41'),
(2, 'Minuman', '2026-05-16 03:14:41'),
(3, 'Snack', '2026-05-16 03:14:41'),
(4, 'Rokok', '2026-05-16 03:14:41'),
(5, 'Kebutuhan Rumah', '2026-05-16 03:14:41');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int NOT NULL,
  `kode_produk` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_produk` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_beli` decimal(15,2) DEFAULT '0.00',
  `harga_jual` decimal(15,2) NOT NULL,
  `stok` int DEFAULT '0',
  `id_kategori` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `kode_produk`, `nama_produk`, `harga_beli`, `harga_jual`, `stok`, `id_kategori`, `created_at`) VALUES
(1, 'PRD001', 'Indomie Goreng', 2500.00, 3500.00, 100, 1, '2026-05-16 03:14:41'),
(2, 'PRD002', 'Indomie Kuah', 2500.00, 3500.00, 99, 1, '2026-05-16 03:14:41'),
(3, 'PRD003', 'Aqua 600ml', 2000.00, 3000.00, 196, 2, '2026-05-16 03:14:41'),
(4, 'PRD004', 'Teh Botol 350ml', 2500.00, 4000.00, 150, 2, '2026-05-16 03:14:41'),
(5, 'PRD005', 'Chitato 68gr', 7000.00, 10000.00, 48, 3, '2026-05-16 03:14:41'),
(6, 'PRD006', 'Taro 65gr', 6000.00, 9000.00, 50, 3, '2026-05-16 03:14:41'),
(7, 'PRD007', 'Gudang Garam 12', 20000.00, 25000.00, 29, 4, '2026-05-16 03:14:41'),
(8, 'PRD008', 'Sabun Lifebuoy', 4000.00, 6000.00, 40, 5, '2026-05-16 03:14:41'),
(9, 'PRD009', 'Shampo Pantene', 8000.00, 12000.00, 29, 5, '2026-05-16 03:14:41'),
(10, 'PRD010', 'Beras 1kg', 12000.00, 15000.00, 80, 1, '2026-05-16 03:14:41');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int NOT NULL,
  `no_transaksi` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` datetime DEFAULT CURRENT_TIMESTAMP,
  `total` decimal(15,2) NOT NULL DEFAULT '0.00',
  `bayar` decimal(15,2) NOT NULL DEFAULT '0.00',
  `kembalian` decimal(15,2) NOT NULL DEFAULT '0.00',
  `id_user` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `no_transaksi`, `tanggal`, `total`, `bayar`, `kembalian`, `id_user`) VALUES
(7, 'TRX-20260516-0001', '2026-05-16 11:10:56', 13000.00, 30000.00, 17000.00, 1),
(8, 'TRX-20260516-0002', '2026-05-16 11:12:42', 38000.00, 40000.00, 2000.00, 1),
(9, 'TRX-20260518-0001', '2026-05-18 10:37:26', 3000.00, 5000.00, 2000.00, 1),
(10, 'TRX-20260605-0001', '2026-06-05 14:05:29', 18500.00, 20000.00, 1500.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','kasir') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'kasir',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'Administrator', 'admin', '$2y$10$tVDZZuxC8QgLI0Zk7UB6yOSQ4PUtmOKsJ.2/wGnZzYe3JYoAAX8HO', 'admin', '2026-05-16 03:14:41'),
(2, 'Kasir 1', 'kasir1', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'kasir', '2026-05-16 03:14:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_produk` (`kode_produk`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_transaksi` (`no_transaksi`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_transaksi_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
