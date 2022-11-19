-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2022 at 03:26 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_staging`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_activation_attempts`
--

CREATE TABLE `auth_activation_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups`
--

CREATE TABLE `auth_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_permissions`
--

CREATE TABLE `auth_groups_permissions` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `email`, `user_id`, `date`, `success`) VALUES
(1, '::1', 'wy.wahyudani@gmail.com', 1, '2022-11-03 05:32:58', 1),
(2, '::1', 'wahyu1243', NULL, '2022-11-03 05:33:24', 0),
(3, '::1', 'wy.wahyudani@gmail.com', 1, '2022-11-04 21:28:49', 1),
(4, '::1', 'wy.wahyudani@gmail.com', 1, '2022-11-04 21:35:13', 1),
(5, '::1', 'wy.wahyudani@gmail.com', 1, '2022-11-05 22:48:13', 1),
(6, '::1', 'wy.wahyudani@gmail.com', 1, '2022-11-05 22:51:16', 1),
(7, '::1', 'wy.wahyudani@gmail.com', 1, '2022-11-06 03:06:12', 1),
(8, '::1', 'wy.wahyudani@gmail.com', 1, '2022-11-06 23:31:38', 1),
(9, '::1', 'wy.wahyudani@gmail.com', 1, '2022-11-10 21:11:08', 1),
(10, '::1', 'wy.wahyudani@gmail.com', 1, '2022-11-11 03:42:24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_reset_attempts`
--

CREATE TABLE `auth_reset_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_users_permissions`
--

CREATE TABLE `auth_users_permissions` (
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `continent`
--

CREATE TABLE `continent` (
  `continent_code` varchar(50) NOT NULL,
  `continent_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `continent`
--

INSERT INTO `continent` (`continent_code`, `continent_name`) VALUES
('CN202201001', 'Local'),
('CN202201002', 'Singapore'),
('CN202201003', 'Malaysia'),
('CN202201004', 'China'),
('CN202201005', 'Japan'),
('CN202201006', 'Thailand');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_code` varchar(50) NOT NULL,
  `customer_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_code`, `customer_name`) VALUES
('CS202201001', 'DMIA'),
('CS202201002', 'DMSG'),
('CS202201003', 'DMMY'),
('CS202201004', 'DMCH'),
('CS202201005', 'DMJP'),
('CS202201006', 'DMTH');

-- --------------------------------------------------------

--
-- Table structure for table `import`
--

CREATE TABLE `import` (
  `casemark` varchar(50) NOT NULL,
  `kanban` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `import`
--

INSERT INTO `import` (`casemark`, `kanban`, `qty`) VALUES
('CSMRK202201001', 'KBN202201001', 10),
('CSMRK202201002', 'KBN202201002', 15),
('CSMRK202201003', 'KBN202201003', 20),
('CSMRK202201004', 'KBN202201004', 25),
('CSMRK202201005', 'KBN202201005', 30),
('CSMRK202201006', 'KBN202201006', 35),
('CSMRK202201007', 'KBN202201007', 40),
('CSMRK202201008', 'KBN202201008', 45),
('CSMRK202201009', 'KBN202201009', 50),
('CSMRK202201010', 'KBN202201010', 55),
('CSMRK202201011', 'KBN202201011', 60),
('CSMRK202201012', 'KBN202201012', 65),
('CSMRK202201013', 'KBN202201013', 70),
('CSMRK202201014', 'KBN202201014', 75),
('CSMRK202201015', 'KBN202201015', 80);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2017-11-20-223112', 'Myth\\Auth\\Database\\Migrations\\CreateAuthTables', 'default', 'Myth\\Auth', 1667470915, 1);

-- --------------------------------------------------------

--
-- Table structure for table `part_number`
--

CREATE TABLE `part_number` (
  `transaction_date` datetime NOT NULL,
  `part_number` varchar(50) NOT NULL,
  `part_name` varchar(50) NOT NULL,
  `product_code` varchar(50) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `customer_code` varchar(50) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `continent_code` varchar(50) NOT NULL,
  `continent_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `part_number`
--

INSERT INTO `part_number` (`transaction_date`, `part_number`, `part_name`, `product_code`, `product_name`, `customer_code`, `customer_name`, `continent_code`, `continent_name`) VALUES
('2022-07-01 04:28:34', 'PN19600-9480', 'Klakson Denso', 'P202201003', 'Hose', 'CS202201003', 'DMMY', 'CN202201003', 'Malaysia'),
('2022-07-01 04:28:02', 'PN19600-9481', 'Air Conditioner', 'P202201002', 'Blower', 'CS202201003', 'DMMY', 'CN202201002', 'Singapore');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_code` varchar(50) NOT NULL,
  `product_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_code`, `product_name`) VALUES
('P202201001', 'Wiperrr'),
('P202201002', 'Blower'),
('P202201003', 'Hose'),
('P202201004', 'DC Power'),
('P202201005', 'AC Power'),
('P202201006', 'SIS ECU');

-- --------------------------------------------------------

--
-- Table structure for table `scan`
--

CREATE TABLE `scan` (
  `hdrid` varchar(50) NOT NULL,
  `transaction_date` datetime NOT NULL,
  `part_number` varchar(50) NOT NULL,
  `part_name` varchar(50) NOT NULL,
  `production_date` datetime NOT NULL,
  `qty` int(11) NOT NULL,
  `date_scan` datetime NOT NULL,
  `product_code` varchar(50) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `customer_code` varchar(50) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `continent_code` varchar(50) NOT NULL,
  `continent_name` varchar(50) NOT NULL,
  `casemark` varchar(50) NOT NULL,
  `kanban` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `scan`
--

INSERT INTO `scan` (`hdrid`, `transaction_date`, `part_number`, `part_name`, `production_date`, `qty`, `date_scan`, `product_code`, `product_name`, `customer_code`, `customer_name`, `continent_code`, `continent_name`, `casemark`, `kanban`) VALUES
('HDRID20220825', '2022-08-30 18:16:38', 'PN19600-9480', 'Klakson Denso', '2022-08-30 18:16:38', 200, '2022-08-30 18:16:38', 'P202201003', 'Hose', 'CS202201003', 'DMMY', 'CN202201003', 'MALAYSIA', 'CSMRK202201001', 'KBN202201001'),
('HDRID20220826', '2022-08-30 18:16:38', 'PN19600-9481', 'Air Conditioner', '2022-08-30 18:16:38', 80, '2022-08-30 18:16:38', 'P202201002', 'Blower', 'CS202201003', 'DMMY', 'CN202201002', 'Singapore', 'CSMRK202201002', 'KBN202201003'),
('HDRID20220827', '2022-08-30 18:23:42', 'PN19600-9480', 'Klakson Denso', '2022-08-30 18:23:42', 230, '2022-08-30 18:23:42', 'P202201003', 'Hose', 'CS202201003', 'DMMY', 'CN202201003', 'MALAYSIA', 'CSMRK202201003', 'KBN202201003'),
('HDRID20220828', '2022-08-30 18:23:42', 'PN19600-9481', 'Air Conditioner', '2022-08-30 18:23:42', 800, '2022-08-30 18:23:42', 'P202201002', 'Blower', 'CS202201003', 'DMMY', 'CN202201002', 'Singapore', 'CSMRK202201004', 'KBN202201004'),
('HDRID20220829', '2022-08-30 18:25:11', 'PN19600-9480', 'Klakson Denso', '2022-08-30 18:25:11', 115, '2022-08-30 18:25:11', 'P202201003', 'Hose', 'CS202201003', 'DMMY', 'CN202201003', 'MALAYSIA', 'CSMRK202201005', 'KBN202201005'),
('HDRID20220830', '2022-08-30 18:25:11', 'PN19600-9481', 'Air Conditioner', '2022-08-30 18:25:11', 85, '2022-08-30 18:25:11', 'P202201002', 'Blower', 'CS202201003', 'DMMY', 'CN202201002', 'Singapore', 'CSMRK202201006', 'KBN202201006'),
('HDRID20220831', '2022-11-11 03:41:31', 'PN19600-9480', 'Klakson Denso', '2022-01-20 00:00:00', 70, '2022-01-20 00:00:00', 'P202201003', 'Hose', 'CS202201003', 'DMMY', 'CN202201004', 'China', 'CSMRK20220909', 'KBN20220909');

-- --------------------------------------------------------

--
-- Table structure for table `staging`
--

CREATE TABLE `staging` (
  `hdrid` varchar(50) NOT NULL,
  `transaction_date` datetime NOT NULL,
  `date_scan` datetime NOT NULL,
  `continent_code` varchar(50) NOT NULL,
  `kanban` varchar(500) NOT NULL,
  `casemark` varchar(500) NOT NULL,
  `staging_1` varchar(50) NOT NULL,
  `staging_2` varchar(50) NOT NULL,
  `staging_3` varchar(50) NOT NULL,
  `staging_4` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staging`
--

INSERT INTO `staging` (`hdrid`, `transaction_date`, `date_scan`, `continent_code`, `kanban`, `casemark`, `staging_1`, `staging_2`, `staging_3`, `staging_4`, `status`) VALUES
('HDRID20220825', '2022-08-30 18:53:41', '2022-08-30 18:53:41', 'CN202201003', 'KBN202201001', 'CSMRK202201001', '', '', '', 'IN', 'IN'),
('HDRID20220826', '2022-08-30 18:53:41', '2022-08-30 18:53:41', 'CN202201002', 'KBN202201002', 'CSMRK202201003', 'IN', '', '', '', 'IN'),
('HDRID20220827', '2022-08-30 18:56:32', '2022-08-30 18:56:32', 'CN202201003', 'KBN202201003', 'CSMRK202201003', 'IN', '', '', '', 'IN'),
('HDRID20220828', '2022-08-30 18:56:32', '2022-08-30 18:56:32', 'CN202201002', 'KBN202201004', 'CSMRK202201004', 'IN', '', '', '', 'IN'),
('HDRID20220829', '2022-08-30 18:58:25', '2022-08-30 18:58:25', 'CN202201003', 'KBN202201005', 'CSMRK202201005', '', 'IN', '', '', 'IN'),
('HDRID20220830', '2022-08-30 18:58:25', '2022-08-30 18:58:25', 'CN202201002', 'KBN202201006', 'CSMRK202201006', '', '', 'IN', '', 'IN'),
('HDRID20220831', '2022-11-11 03:41:31', '2022-01-20 00:00:00', 'CN202201004', 'KBN20220909', 'CSMRK20220909', 'IN', '', '', '', 'IN');

-- --------------------------------------------------------

--
-- Table structure for table `tb_product`
--

CREATE TABLE `tb_product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_price` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_product`
--

INSERT INTO `tb_product` (`product_id`, `product_name`, `product_price`) VALUES
(1, 'HJK', '321'),
(2, 'CDF', '123'),
(3, '3341', '321');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password_hash`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'wy.wahyudani@gmail.com', 'wahyu1243', '$2y$10$zv3pNei9yJPQoTXqhjrt.eChN6tlTntGmrFvQgUqUWQpsVLkof.5G', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2022-11-03 05:32:37', '2022-11-03 05:32:37', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups`
--
ALTER TABLE `auth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `group_id_permission_id` (`group_id`,`permission_id`);

--
-- Indexes for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`),
  ADD KEY `group_id_user_id` (`group_id`,`user_id`);

--
-- Indexes for table `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_tokens_user_id_foreign` (`user_id`),
  ADD KEY `selector` (`selector`);

--
-- Indexes for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `user_id_permission_id` (`user_id`,`permission_id`);

--
-- Indexes for table `continent`
--
ALTER TABLE `continent`
  ADD PRIMARY KEY (`continent_code`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_code`);

--
-- Indexes for table `import`
--
ALTER TABLE `import`
  ADD PRIMARY KEY (`casemark`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `part_number`
--
ALTER TABLE `part_number`
  ADD PRIMARY KEY (`part_number`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_code`);

--
-- Indexes for table `scan`
--
ALTER TABLE `scan`
  ADD PRIMARY KEY (`hdrid`);

--
-- Indexes for table `staging`
--
ALTER TABLE `staging`
  ADD PRIMARY KEY (`hdrid`);

--
-- Indexes for table `tb_product`
--
ALTER TABLE `tb_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_groups`
--
ALTER TABLE `auth_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_product`
--
ALTER TABLE `tb_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
