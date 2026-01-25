-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 25, 2026 lúc 10:34 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `csmvb`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bookings`
--

CREATE TABLE `bookings` (
  `id` int(10) UNSIGNED NOT NULL,
  `service_name` varchar(255) NOT NULL COMMENT 'Tên dịch vụ',
  `service_price` varchar(100) DEFAULT NULL COMMENT 'Giá dịch vụ',
  `customer_name` varchar(255) NOT NULL COMMENT 'Tên khách hàng',
  `phone` varchar(20) NOT NULL COMMENT 'Số điện thoại',
  `email` varchar(255) DEFAULT NULL COMMENT 'Email khách hàng',
  `note` text DEFAULT NULL COMMENT 'Ghi chú của khách',
  `status` enum('pending','contacted','confirmed','completed','cancelled') NOT NULL DEFAULT 'pending',
  `created_at` datetime NOT NULL COMMENT 'Thời gian tạo',
  `updated_at` datetime DEFAULT NULL COMMENT 'Thời gian cập nhật'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `bookings`
--

INSERT INTO `bookings` (`id`, `service_name`, `service_price`, `customer_name`, `phone`, `email`, `note`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Khám Sơ Sinh', 'Liên hệ', 'Huy Lê Quang', '0373532588', 'huyq46532@gmail.com', 'ok ngay', 'pending', '2026-01-25 13:33:11', NULL),
(2, 'Khám Sơ Sinh', 'Liên hệ', 'Huy Lê Quang', '0373532598', 'huyq46532@gmail.com', 'okk', 'completed', '2026-01-25 15:51:12', NULL),
(3, 'Khám Thai Định Kỳ', '300.000 - 500.000 VNĐ', 'Huy Lê Quang', '0373532588', 'huyq46532@gmail.com', 'thu', 'confirmed', '2026-01-25 16:08:55', '2026-01-25 16:29:49');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `role` enum('customer','admin','staff') DEFAULT 'customer',
  `status` enum('active','inactive','banned') DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `full_name`, `phone`, `address`, `role`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$695xaocsDclOi0Nk/3flx.R5Ue2K9kUPICApnHkw/zfteFkNIuLyK', 'admin', NULL, NULL, 'admin', 'active', '2026-01-21 06:49:47', '2026-01-21 07:09:38');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
