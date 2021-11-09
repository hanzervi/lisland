-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2021 at 02:08 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lisland_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `room_id` int(10) UNSIGNED NOT NULL,
  `adults` int(11) NOT NULL,
  `children` int(11) DEFAULT 0,
  `infants` int(11) DEFAULT 0,
  `add_person` int(11) DEFAULT 0,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `priceTotal` double(8,2) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '-1 = delete; 0 = pending; 1 = reserved; 2 = checkout;',
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `type`, `customer_id`, `room_id`, `adults`, `children`, `infants`, `add_person`, `check_in`, `check_out`, `priceTotal`, `status`, `remarks`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'onsite', 1, 1, 2, NULL, NULL, NULL, '2021-10-26', '2021-10-31', 7850.00, 3, 'Paid', 1, '2021-10-26 06:01:55', '2021-11-03 04:27:15'),
(2, 'onsite', 2, 1, 2, 0, 0, 1, '2021-10-27', '2021-10-31', 6550.00, 3, NULL, 1, '2021-10-27 04:32:19', '2021-11-03 04:27:22'),
(6, 'online', 7, 3, 1, 0, 0, 1, '2021-11-02', '2021-11-03', 7050.00, -1, NULL, 1, '2021-11-02 04:15:00', '2021-11-08 17:03:27'),
(7, 'online', 8, 3, 1, 0, 0, 0, '2021-11-02', '2021-11-03', 6300.00, -1, NULL, 1, '2021-11-02 04:44:42', '2021-11-08 17:03:24'),
(8, 'onsite', 9, 3, 3, 1, NULL, NULL, '2021-11-05', '2021-11-06', 6825.00, -1, NULL, 1, '2021-11-03 04:30:20', '2021-11-03 05:06:20'),
(9, 'online', 10, 4, 4, 3, 0, NULL, '2021-11-03', '2021-11-06', 14000.00, -1, NULL, 1, '2021-11-03 04:46:52', '2021-11-08 17:03:20'),
(10, 'online', 11, 5, 2, 0, 0, NULL, '2021-11-04', '2021-11-05', 4090.00, 3, NULL, 1, '2021-11-03 05:04:59', '2021-11-08 17:03:29'),
(11, 'onsite', 12, 3, 2, NULL, NULL, NULL, '2021-11-03', '2021-11-06', 19425.00, -1, NULL, 1, '2021-11-03 05:06:05', '2021-11-03 05:06:16');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sex` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `firstname`, `lastname`, `address`, `sex`, `contact_no`, `email`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Hanz', 'Paeste', 'Laoac', 'Male', '09263697584', NULL, 1, '2021-10-26 06:01:55', '2021-10-26 06:01:55'),
(2, 'Hanz', 'Manaois', 'Binalonan', 'Female', '09263697584', NULL, 1, '2021-10-27 04:32:19', '2021-10-27 04:32:19'),
(6, 'Hanz', 'Paeste', 'Laoac', 'Male', '09263697584', 'hanz@mail.com', 1, '2021-11-02 04:13:52', '2021-11-02 04:13:52'),
(7, 'Hanz', 'Paeste', 'Laoac', 'Male', '09263697584', 'hanz@mail.com', 1, '2021-11-02 04:15:00', '2021-11-02 04:15:00'),
(8, 'John', 'Doe', 'Binalonan', 'Female', '09263697584', NULL, 1, '2021-11-02 04:44:42', '2021-11-02 04:44:42'),
(9, 'John', 'Doe', 'Urdaneta City, Pangasinan', 'Male', '09263697584', NULL, 1, '2021-11-03 04:30:20', '2021-11-03 04:30:20'),
(10, 'John', 'Doe', 'Laoac, Pangasinan', 'Male', '09263697584', NULL, 1, '2021-11-03 04:46:52', '2021-11-03 04:46:52'),
(11, 'Hanz', 'Paeste', 'Laoac, Pangasinan', 'Male', '09263697584', NULL, 1, '2021-11-03 05:04:59', '2021-11-03 05:04:59'),
(12, 'Hanz', 'Paeste', 'Binalonan', 'Male', '09263697584', NULL, 1, '2021-11-03 05:06:05', '2021-11-03 05:06:05');

-- --------------------------------------------------------

--
-- Table structure for table `food_drinks`
--

CREATE TABLE `food_drinks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'noimage.png',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `food_drinks`
--

INSERT INTO `food_drinks` (`id`, `image`, `name`, `description`, `category`, `price`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'x_1635941223_.jpg', 'Longsilog', 'Filipino sausage w/ garlic rice and egg', 'Power Breakfast', '129', 1, 1, '2021-11-01 17:01:12', '2021-11-03 04:07:03'),
(2, 'x_1635941228_.jpg', 'Smoke Golden Tinapa', 'Smoked milkfish w/ garlic rice, tomato and salted egg', 'International Specialties', '119', 1, 1, '2021-11-01 17:01:27', '2021-11-03 04:07:08'),
(3, 'x_1635941234_.jpg', 'Tapsilog', 'Beef tapa with garlic rice and egg', 'Lislands\' Special', '119', 1, 1, '2021-11-01 17:02:05', '2021-11-03 04:07:14'),
(4, 'x_1635941218_.jpg', 'Hotsilog', 'Juicy hotdog with garlic rice and egg', 'Filipino Breakfast', '129', 1, 1, '2021-11-01 17:02:18', '2021-11-03 04:06:58'),
(5, 'x_1635941213_.jpg', 'Dasilog', 'Marinated milkfish with garlic rice and egg', 'Filipino Breakfast', '119', 1, 1, '2021-11-01 17:02:33', '2021-11-03 04:06:53'),
(6, 'x_1635941238_.jpg', 'Tocsilog', 'Semi-sweet prok belly strips w/ garlic and rice', 'Lislands\' Special', '109', 1, 1, '2021-11-01 17:02:47', '2021-11-03 04:07:18');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2021_10_05_131501_create_food_drinks_table', 1),
(3, '2021_10_06_171130_create_customers_table', 1),
(4, '2021_10_10_130800_create_rooms_table', 1),
(5, '2021_10_10_180220_create_pools_table', 1),
(6, '2021_10_18_183605_create_books_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pools`
--

CREATE TABLE `pools` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image360` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `images` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pools`
--

INSERT INTO `pools` (`id`, `name`, `description`, `image360`, `images`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Lisland\'s Pool', 'Kiddie and adult pool with slide', '360-thomas-galler-8UDJ4sflous-unsplash_1635817924_.jpg', '[\"pool_1635941659_.jpg\",\"pool1_1635941659_.jpg\",\"pool3_1635941659_.jpg\",\"pool4_1635941659_.jpg\"]', 1, 1, '2021-11-01 17:52:04', '2021-11-03 04:14:19');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `images` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image360` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_rooms` int(11) NOT NULL,
  `price_wd` double(8,2) NOT NULL,
  `price_we` double(8,2) NOT NULL,
  `adults` tinyint(4) DEFAULT 0,
  `children` tinyint(4) DEFAULT 0,
  `infants` tinyint(4) DEFAULT 0,
  `includes` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `description`, `images`, `image360`, `no_rooms`, `price_wd`, `price_we`, `adults`, `children`, `infants`, `includes`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Standard Room', '4ft pool', '[\"128665624_1849819085171886_489850524945339983_n_1635256860_.jpg\",\"244627585_3976970099071451_2063055193080069205_n_1635256860_.jpg\",\"244177698_971166326773569_3890045396865650009_n_1635256860_.jpg\"]', '360-thomas-galler-8UDJ4sflous-unsplash_1635256860_.jpg', 5, 1300.00, 1600.00, 2, NULL, NULL, 'TV, Wifi', -1, 1, '2021-10-26 06:01:00', '2021-10-27 09:43:46'),
(2, 'Suite Room', 'sds', '[\"128665624_1849819085171886_489850524945339983_n_1635258933_.jpg\"]', '360-thomas-galler-8UDJ4sflous-unsplash_1635258933_.jpg', 5, 2300.00, 2500.00, 3, 2, NULL, 'TV', -1, 1, '2021-10-26 06:35:33', '2021-10-27 09:43:48'),
(3, 'The Lodge', 'Biggest', '[\"lodge_1635942950_.jpg\",\"lodge2_1635942950_.jpg\",\"lodge3_1635942950_.jpg\",\"lodge4_1635942950_.jpg\",\"lodge5_1635942950_.jpg\",\"lodge6_1635942950_.jpg\",\"lodge7_1635942950_.jpg\",\"lodge8_1635942950_.jpg\",\"lodge9_1635942950_.jpg\"]', '360-thomas-galler-8UDJ4sflous-unsplash_1635356683_.jpg', 5, 6300.00, 6825.00, 5, 5, 0, 'Wifi, Tv, Kitchen, CR', 1, 1, '2021-10-27 09:44:43', '2021-11-03 04:35:50'),
(4, 'Family Room', '2nd Biggest', '[\"fam_1635943375_.jpg\",\"fam2_1635943375_.jpg\"]', '360-thomas-galler-8UDJ4sflous-unsplash_1635356730_.jpg', 3, 4525.00, 4950.00, 5, 3, 2, 'Wifi, TV, Radio', 1, 1, '2021-10-27 09:45:30', '2021-11-03 04:42:55'),
(5, 'Deluxe Room', 'Deluxe', '[\"de_1635943564_.png\",\"de2_1635943564_.png\"]', '360-thomas-galler-8UDJ4sflous-unsplash_1635356781_.jpg', 2, 4090.00, 4515.00, 3, 0, 0, 'WIFI, Aircon', 1, 1, '2021-10-27 09:46:21', '2021-11-03 05:07:03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `status`, `remember_token`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', '$2a$12$4uzL/iqcn9D3r.U1PIlIge5pUtJfyZJYjen7/hBLzsK.Gof0Xfzge', 1, NULL, 1, '2021-10-26 05:59:29', '2021-11-03 05:01:17'),
(2, 'Hanz', 'hanzpaeste', '$2y$10$z6z5dUJD589NrFzXVU9o9OO1VEcSOwtP/lMOTVYMAPH0xmvLEqDn6', -1, NULL, 1, '2021-11-02 07:04:20', '2021-11-02 07:04:23'),
(3, 'User One', 'userone', '$2y$10$pt.awiarAQ.S5flSPfh4fONEbWd1i.sYQHkDNKapYNrzyf4q1EZl2', -1, NULL, 1, '2021-11-03 04:03:15', '2021-11-08 17:04:01'),
(4, 'User Two', 'usertwo', '$2y$10$xs6u.ut7Cl1xx7LnF5WaneNwxznCb8iNT2mrKSWTL0ctmtJoVvBoC', -1, NULL, 1, '2021-11-03 04:03:35', '2021-11-03 05:07:29'),
(5, 'User Three', 'userthree', '$2y$10$MuX99KZzJ4MYgYB880N7KOcw3x/CJZOfkzBwlv4Eq4g3WrbRlFjbi', -1, NULL, 1, '2021-11-03 04:03:47', '2021-11-08 17:04:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_drinks`
--
ALTER TABLE `food_drinks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pools`
--
ALTER TABLE `pools`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `food_drinks`
--
ALTER TABLE `food_drinks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pools`
--
ALTER TABLE `pools`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
