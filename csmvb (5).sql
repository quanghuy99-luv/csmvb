-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 31, 2026 lúc 04:29 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.1.25

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
  `dichvu_id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED DEFAULT NULL,
  `customer_name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `booking_date` datetime DEFAULT NULL,
  `status` enum('pending','contacted','confirmed','completed','cancelled') DEFAULT 'pending',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `bookings`
--

INSERT INTO `bookings` (`id`, `dichvu_id`, `customer_id`, `customer_name`, `phone`, `email`, `note`, `booking_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'Huy Lê Quang', '0973523258', 'customer@gmail.com', 'Khám cho bé sơ sinh', '2026-02-05 10:00:00', 'confirmed', '2026-01-31 11:53:00', '2026-01-31 11:53:00'),
(2, 2, NULL, 'Mẹ Nguyễn', '0968123456', 'me@gmail.com', 'Tiêm theo lịch', '2026-02-10 14:00:00', 'pending', '2026-01-31 11:53:00', '2026-01-31 11:53:00'),
(4, 1, NULL, 'Huy Lê Quang', '0373532588', 'huyq46532@gmail.com', 'ok', '2026-01-31 19:13:09', 'pending', '2026-01-31 19:13:09', '2026-01-31 19:13:09'),
(5, 1, NULL, 'Huy Lê Quang', '0373532588', 'huyq46532@gmail.com', 'oki', '2026-01-31 19:16:58', 'pending', '2026-01-31 19:16:58', '2026-01-31 19:16:58'),
(6, 2, NULL, 'Huy Lê Quang', '0373532588', 'huyq46532@gmail.com', 'okhu', '2026-01-31 19:27:15', 'pending', '2026-01-31 19:27:15', '2026-01-31 19:27:15');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dichvu`
--

CREATE TABLE `dichvu` (
  `id` int(10) UNSIGNED NOT NULL,
  `tendichvu` varchar(255) NOT NULL,
  `mo_ta_ngan` text DEFAULT NULL,
  `noi_dung_chi_tiet` text DEFAULT NULL,
  `hinh_anh` varchar(500) DEFAULT NULL,
  `gia` decimal(12,2) NOT NULL,
  `gia_cu` decimal(12,2) DEFAULT NULL,
  `thoi_gian_du_kien` varchar(50) DEFAULT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `dichvu`
--

INSERT INTO `dichvu` (`id`, `tendichvu`, `mo_ta_ngan`, `noi_dung_chi_tiet`, `hinh_anh`, `gia`, `gia_cu`, `thoi_gian_du_kien`, `category_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Khám Sơ Sinh & Tiêm Chủng', 'Kiểm tra sức khỏe chi tiết cho bé sơ sinh', 'Khám tổng quát\nSàng lọc sơ sinh\nTiêm chủng đầy đủ', 'https://www.matsaigon.com/wp-content/uploads/2018/03/kham-mat-cho-tre-3-e1524565768759.jpg', 200000.00, NULL, NULL, 1, 1, '2026-01-31 11:53:00', '2026-01-31 19:22:46'),
(2, 'Tiêm Vắc-xin Hexaxim', 'Vắc-xin ngừa 6 bệnh', 'Tiêm an toàn\nTheo dõi sau tiêm', NULL, 350000.00, NULL, NULL, 2, 1, '2026-01-31 11:53:00', '2026-01-31 11:53:00'),
(3, 'Chăm Sóc Mẹ Sau Sinh Tại Nhà', 'Hỗ trợ hồi phục sau sinh', 'Theo dõi sức khỏe mẹ\nChăm sóc vết mổ/vết khâu\nMassage thư giãn\nHướng dẫn cho bé bú đúng cách', 'https://images.unsplash.com/photo-1600880292203-757bb62b4baf', 500000.00, 650000.00, '3 - 4 giờ', 1, 1, '2026-01-31 21:40:44', '2026-01-31 21:40:44'),
(4, 'Tắm Bé & Chăm Sóc Rốn', 'Chăm sóc bé sơ sinh an toàn', 'Tắm bé đúng chuẩn y khoa\nVệ sinh rốn\nTheo dõi thân nhiệt\nHướng dẫn cha mẹ chăm sóc tại nhà', 'https://images.unsplash.com/photo-1601582589907-f92af5ed9db8', 250000.00, NULL, '60 phút', 1, 1, '2026-01-31 21:40:44', '2026-01-31 21:40:44'),
(5, 'Massage & Kích Thích Phát Triển Cho Bé', 'Hỗ trợ bé ăn ngon, ngủ sâu', 'Massage toàn thân\nKích thích giác quan\nHướng dẫn cha mẹ thực hiện tại nhà', 'https://images.unsplash.com/photo-1600209141720-d2f4a1a7d99f', 300000.00, NULL, '45 phút', 1, 1, '2026-01-31 21:40:44', '2026-01-31 21:40:44'),
(6, 'Theo Dõi Sức Khỏe Mẹ & Bé 7 Ngày', 'Gói chăm sóc sau sinh trọn gói', 'Theo dõi sức khỏe mẹ\nTheo dõi bé sơ sinh\nTư vấn dinh dưỡng & chăm sóc', 'https://images.unsplash.com/photo-1584515933487-779824d29309', 3000000.00, 3500000.00, '7 ngày', 1, 1, '2026-01-31 21:40:44', '2026-01-31 21:40:44'),
(7, 'Chăm Sóc Người Cao Tuổi Tại Nhà', 'Hỗ trợ sinh hoạt hằng ngày', 'Hỗ trợ ăn uống\nVệ sinh cá nhân\nTheo dõi huyết áp\nTrò chuyện tinh thần', 'https://images.unsplash.com/photo-1581579185169-1cbf07c1b4d4', 400000.00, NULL, '4 giờ', 2, 1, '2026-01-31 21:40:44', '2026-01-31 21:40:44'),
(8, 'Theo Dõi Sức Khỏe Người Già', 'Theo dõi các chỉ số sức khỏe', 'Đo huyết áp\nTheo dõi đường huyết\nNhắc uống thuốc đúng giờ', 'https://images.unsplash.com/photo-1580281657527-47c042c06a1c', 350000.00, NULL, '2 giờ', 2, 1, '2026-01-31 21:40:44', '2026-01-31 21:40:44'),
(9, 'Chăm Sóc Người Già Dài Hạn', 'Chăm sóc toàn diện theo ngày', 'Chăm sóc sinh hoạt\nTheo dõi sức khỏe\nHỗ trợ vận động nhẹ', 'https://images.unsplash.com/photo-1604881991720-f91add269bed', 1200000.00, 1500000.00, '1 ngày', 2, 1, '2026-01-31 21:40:44', '2026-01-31 21:40:44'),
(10, 'Chăm Sóc Người Bệnh Sau Phẫu Thuật', 'Hỗ trợ hồi phục tại nhà', 'Theo dõi tình trạng vết mổ\nHỗ trợ đi lại\nNhắc uống thuốc', 'https://images.unsplash.com/photo-1582719478185-2193f56f4d9d', 600000.00, NULL, '4 giờ', 3, 1, '2026-01-31 21:40:44', '2026-01-31 21:40:44'),
(11, 'Điều Dưỡng Chăm Sóc Người Bệnh', 'Điều dưỡng theo chỉ định bác sĩ', 'Theo dõi sinh hiệu\nHỗ trợ vệ sinh\nBáo cáo tình trạng sức khỏe', 'https://images.unsplash.com/photo-1584516150909-c43483ee7932', 800000.00, NULL, '1 ngày', 3, 1, '2026-01-31 21:40:44', '2026-01-31 21:40:44');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `service_category`
--

CREATE TABLE `service_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `service_category`
--

INSERT INTO `service_category` (`id`, `name`, `description`, `icon`, `status`, `created_at`) VALUES
(1, 'Dịch Vụ Chăm Sóc Mẹ và Bé', 'Các dịch vụ khám sức khỏe', 'heart', 1, '2026-01-31 11:53:00'),
(2, 'Dịch Vụ Chăm Sóc Người Cao Tuổi', 'Dịch Vụ Chăm Sóc Người Già', 'syringe', 1, '2026-01-31 11:53:00'),
(3, 'Dịch Vụ Chăm Sóc Người Bệnh', 'Các dịch vụ chăm sóc người bệnh tại nhà', 'user-nurse', 1, '2026-01-31 21:40:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `avatar` varchar(500) DEFAULT NULL,
  `role` enum('customer','admin','staff','doctor') DEFAULT 'customer',
  `status` enum('active','inactive','banned') DEFAULT 'active',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `full_name`, `phone`, `address`, `avatar`, `role`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@mamacore.com', 'hashed', 'Admin MamaCore', NULL, NULL, NULL, 'admin', 'active', '2026-01-31 11:53:00', '2026-01-31 11:53:00'),
(2, 'staff1', 'staff@mamacore.com', 'hashed', 'Nhân viên lễ tân', NULL, NULL, NULL, 'staff', 'active', '2026-01-31 11:53:00', '2026-01-31 11:53:00'),
(3, 'customer1', 'customer@gmail.com', 'hashed', 'Huy Lê Quang', NULL, NULL, NULL, 'customer', 'active', '2026-01-31 11:53:00', '2026-01-31 11:53:00');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_dichvu` (`dichvu_id`),
  ADD KEY `idx_customer` (`customer_id`);

--
-- Chỉ mục cho bảng `dichvu`
--
ALTER TABLE `dichvu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_category` (`category_id`);

--
-- Chỉ mục cho bảng `service_category`
--
ALTER TABLE `service_category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `dichvu`
--
ALTER TABLE `dichvu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `service_category`
--
ALTER TABLE `service_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `fk_bookings_customer` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_bookings_dichvu` FOREIGN KEY (`dichvu_id`) REFERENCES `dichvu` (`id`) ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `dichvu`
--
ALTER TABLE `dichvu`
  ADD CONSTRAINT `fk_dichvu_category` FOREIGN KEY (`category_id`) REFERENCES `service_category` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
