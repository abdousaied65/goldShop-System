-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2022 at 07:21 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gold`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(11) NOT NULL,
  `branch_name` varchar(255) NOT NULL,
  `branch_phone` varchar(255) DEFAULT NULL,
  `branch_address` varchar(255) DEFAULT NULL,
  `commercial_record` varchar(255) NOT NULL,
  `license_number` varchar(255) NOT NULL,
  `snap` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `branch_name`, `branch_phone`, `branch_address`, `commercial_record`, `license_number`, `snap`, `created_at`, `updated_at`) VALUES
(1, 'مؤسسة نايف محمد العقاب للمعادن الثمينة والاحجار الكريمة', '0163235047', 'القصيم - بريدة - سوق الذهب - قبة رشيد', '1131056240', '11\\11310302', 'ALOQAB1', '2022-11-18 00:51:49', '2022-11-18 00:51:49');

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\Supervisor', 1),
(2, 'App\\Models\\Supervisor', 4);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `key`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'اضافة مستخدم', 'supervisor', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(2, 'عرض مستخدم', 'supervisor', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(3, 'تعديل مستخدم', 'supervisor', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(4, 'حذف مستخدم', 'supervisor', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(5, 'اضافة صلاحية', 'privilege', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(6, 'عرض صلاحية', 'privilege', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(7, 'تعديل صلاحية', 'privilege', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(8, 'حذف صلاحية', 'privilege', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(9, 'اضافة فرع', 'branch', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(10, 'عرض فرع', 'branch', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(11, 'تعديل فرع', 'branch', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(12, 'حذف فرع', 'branch', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(13, 'اضافة صنف', 'product', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(14, 'عرض صنف', 'product', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(15, 'تعديل صنف', 'product', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(16, 'حذف صنف', 'product', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(17, 'اضافة فاتورة مبسطة', 'simplified', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(18, 'عرض فاتورة مبسطة', 'simplified', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(19, 'اضافة فاتورة ضريبية', 'tax', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(20, 'عرض فاتورة ضريبية', 'tax', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(21, 'اضافة فاتورة مشتريات', 'purchase', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(22, 'عرض فاتورة مشتريات', 'purchase', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(23, 'تعديل فاتورة مشتريات', 'purchase', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(24, 'اضافة مرتجع فاتورة مبسطة', 'simplified_return', 'supervisor-web', '2022-11-29 16:42:27', '2022-11-29 16:42:27'),
(25, 'عرض مرتجع فاتورة مبسطة', 'simplified_return', 'supervisor-web', '2022-11-29 16:42:27', '2022-11-29 16:42:27'),
(26, 'اضافة مرتجع فاتورة ضريبية', 'tax_return', 'supervisor-web', '2022-11-29 16:42:27', '2022-11-29 16:42:27'),
(27, 'عرض مرتجع فاتورة ضريبية', 'tax_return', 'supervisor-web', '2022-11-29 16:42:27', '2022-11-29 16:42:27');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `tax` int(2) NOT NULL DEFAULT 15,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `tax`, `created_at`, `updated_at`) VALUES
(1, 'غوايش', 15, '2022-11-18 01:40:44', '2022-11-18 01:40:44'),
(2, 'طقم', 15, '2022-11-20 23:33:51', '2022-11-20 23:33:51'),
(3, 'طقم تفريد', 15, '2022-11-20 23:33:57', '2022-11-20 23:33:57'),
(4, 'نصف طقم', 15, '2022-11-20 23:34:20', '2022-11-20 23:34:20'),
(5, 'أسوارة', 15, '2022-11-20 23:34:29', '2022-11-20 23:34:29'),
(6, 'سبحة', 15, '2022-11-20 22:36:16', '2022-11-20 22:36:16'),
(7, 'دلعة', 15, '2022-11-20 22:36:16', '2022-11-20 22:36:16'),
(8, 'حلق', 15, '2022-11-20 22:36:16', '2022-11-20 22:36:16'),
(9, 'سلسال', 15, '2022-11-20 22:36:16', '2022-11-20 22:36:16'),
(10, 'تعليقة', 15, '2022-11-20 22:36:16', '2022-11-20 22:36:16'),
(11, 'خاتم', 15, '2022-11-20 22:36:16', '2022-11-20 22:36:16'),
(12, 'دبلة', 15, '2022-11-20 22:36:16', '2022-11-20 22:36:16'),
(13, 'تشكيلة ذهب', 15, '2022-11-20 22:36:16', '2022-11-20 22:36:16'),
(14, 'جهاز عروس', 15, '2022-11-20 22:36:16', '2022-11-20 22:36:16'),
(15, 'سبايك', 0, '2022-11-20 22:36:16', '2022-11-20 22:36:16');

-- --------------------------------------------------------

--
-- Table structure for table `purchases_invoices`
--

CREATE TABLE `purchases_invoices` (
  `id` int(11) NOT NULL,
  `invoice_number` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `supervisor_id` bigint(20) UNSIGNED NOT NULL,
  `tax_total` float NOT NULL,
  `final_total` float NOT NULL,
  `attachment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchases_invoices`
--

INSERT INTO `purchases_invoices` (`id`, `invoice_number`, `date`, `branch_id`, `supervisor_id`, `tax_total`, `final_total`, `attachment`, `created_at`, `updated_at`) VALUES
(1, '12345', '2022-11-21', 1, 1, 521.74, 4000, 'uploads/purchases/attachments/1/maxresdefault.jpg', '2022-11-28 04:20:26', '2022-11-28 17:12:39');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'مدير النظام', 'supervisor-web', '2021-08-23 01:40:49', '2021-08-23 01:40:49'),
(2, 'موظف فرع', 'supervisor-web', '2022-11-18 04:02:02', '2022-11-18 04:02:02');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(13, 2),
(14, 1),
(14, 2),
(15, 1),
(15, 2),
(16, 1),
(16, 2),
(17, 1),
(17, 2),
(18, 1),
(18, 2),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1);

-- --------------------------------------------------------

--
-- Table structure for table `simplified_invoices`
--

CREATE TABLE `simplified_invoices` (
  `id` int(11) NOT NULL,
  `unified_serial_number` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `cash_amount` float DEFAULT NULL,
  `visa_amount` float DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `supervisor_id` bigint(20) UNSIGNED NOT NULL,
  `total_count` float DEFAULT NULL,
  `total_weight` float DEFAULT NULL,
  `gram_total_price` float DEFAULT NULL,
  `amount_total` float DEFAULT NULL,
  `tax_total` float DEFAULT NULL,
  `final_total` float DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'open',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `simplified_invoices`
--

INSERT INTO `simplified_invoices` (`id`, `unified_serial_number`, `date`, `time`, `payment_method`, `cash_amount`, `visa_amount`, `branch_id`, `supervisor_id`, `total_count`, `total_weight`, `gram_total_price`, `amount_total`, `tax_total`, `final_total`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-11-21', '17:27:14', 'cash', 3000, NULL, 1, 1, 1, 10, 260.87, 2608.7, 391.31, 3000, 'return', '2022-11-21 05:27:29', '2022-11-29 18:50:02'),
(2, 2, '2022-11-22', '07:27:57', 'visa', NULL, 3000, 1, 1, 1, 10, 260.87, 2608.7, 391.31, 3000, 'done', '2022-11-21 05:28:54', '2022-11-21 05:28:59'),
(3, 3, '2022-11-23', '07:28:59', 'mixed', 1400, 1600, 1, 1, 1, 10, 260.87, 2608.7, 391.31, 3000, 'done', '2022-11-21 05:29:32', '2022-11-21 05:32:14'),
(4, 4, '2022-11-24', '08:46:26', 'cash', 5000, NULL, 1, 1, 2, 18, 241.55, 4347.83, 652.18, 5000, 'done', '2022-11-21 06:47:38', '2022-11-21 06:49:37'),
(5, 5, '2022-11-25', '08:49:38', 'mixed', 2000, 1000, 1, 1, 1, 10, 260.87, 2608.7, 391.31, 3000, 'done', '2022-11-21 06:49:59', '2022-11-21 06:50:40'),
(6, 6, '2022-11-26', '18:50:41', 'visa', NULL, 3000, 1, 1, 1, 10, 260.87, 2608.7, 391.31, 3000, 'done', '2022-11-21 06:50:58', '2022-11-21 06:51:50'),
(7, 7, '2022-11-27', '03:10:29', 'cash', 3000, NULL, 1, 1, 1, 10, 260.87, 2608.7, 391.31, 3000, 'return', '2022-11-27 01:10:51', '2022-11-29 19:00:13');

-- --------------------------------------------------------

--
-- Table structure for table `simplified_invoice_elements`
--

CREATE TABLE `simplified_invoice_elements` (
  `id` int(11) NOT NULL,
  `simplified_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `karat` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `gram_price` float NOT NULL,
  `amount` float DEFAULT NULL,
  `tax` float DEFAULT NULL,
  `total` float DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `simplified_invoice_elements`
--

INSERT INTO `simplified_invoice_elements` (`id`, `simplified_id`, `product_id`, `weight`, `karat`, `count`, `gram_price`, `amount`, `tax`, `total`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 10, 21, 1, 260.87, 2608.7, 391.31, 3000, '2022-11-21 05:27:29', '2022-11-21 05:27:29'),
(2, 2, 1, 10, 21, 1, 260.87, 2608.7, 391.31, 3000, '2022-11-21 05:28:54', '2022-11-21 05:28:54'),
(3, 3, 1, 10, 21, 1, 260.87, 2608.7, 391.31, 3000, '2022-11-21 05:29:32', '2022-11-21 05:29:32'),
(4, 4, 1, 10, 21, 1, 260.87, 2608.7, 391.31, 3000, '2022-11-21 06:47:38', '2022-11-21 06:47:38'),
(5, 4, 2, 8, 21, 1, 217.39, 1739.13, 260.87, 2000, '2022-11-21 06:48:58', '2022-11-21 06:48:58'),
(6, 5, 1, 10, 21, 1, 260.87, 2608.7, 391.31, 3000, '2022-11-21 06:49:59', '2022-11-21 06:49:59'),
(7, 6, 1, 10, 21, 1, 260.87, 2608.7, 391.31, 3000, '2022-11-21 06:50:58', '2022-11-21 06:50:58'),
(9, 7, 1, 10, 21, 1, 260.87, 2608.7, 391.31, 3000, '2022-11-27 01:10:51', '2022-11-27 01:10:51');

-- --------------------------------------------------------

--
-- Table structure for table `simplified_payments`
--

CREATE TABLE `simplified_payments` (
  `id` int(11) NOT NULL,
  `simplified_id` int(11) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `amount` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `simplified_payments`
--

INSERT INTO `simplified_payments` (`id`, `simplified_id`, `payment_method`, `amount`, `created_at`, `updated_at`) VALUES
(1, 1, 'cash', 3000, '2022-11-21 05:27:56', '2022-11-21 05:27:56'),
(2, 2, 'visa', 3000, '2022-11-21 05:28:59', '2022-11-21 05:28:59'),
(3, 3, 'cash', 1400, '2022-11-21 05:32:14', '2022-11-21 05:32:14'),
(4, 3, 'visa', 1600, '2022-11-21 05:32:14', '2022-11-21 05:32:14'),
(5, 4, 'cash', 5000, '2022-11-21 06:49:37', '2022-11-21 06:49:37'),
(6, 5, 'cash', 2000, '2022-11-21 06:50:40', '2022-11-21 06:50:40'),
(7, 5, 'visa', 1000, '2022-11-21 06:50:40', '2022-11-21 06:50:40'),
(8, 6, 'visa', 3000, '2022-11-21 06:51:50', '2022-11-21 06:51:50'),
(9, 7, 'cash', 3000, '2022-11-27 01:11:37', '2022-11-27 01:11:37');

-- --------------------------------------------------------

--
-- Table structure for table `simplified_returns`
--

CREATE TABLE `simplified_returns` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `supervisor_id` bigint(20) UNSIGNED NOT NULL,
  `simplified_id` int(11) NOT NULL,
  `unified_serial_number` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `simplified_returns`
--

INSERT INTO `simplified_returns` (`id`, `branch_id`, `supervisor_id`, `simplified_id`, `unified_serial_number`, `date`, `time`, `notes`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '1', '2022-11-29', '20:48:41', 'العميل عايز يبدل ويرجع', '2022-11-29 18:50:02', '2022-11-29 18:50:02'),
(2, 1, 1, 7, '2', '2022-11-29', '21:00:02', 'لا يوجد', '2022-11-29 19:00:13', '2022-11-29 19:00:13');

-- --------------------------------------------------------

--
-- Table structure for table `supervisors`
--

CREATE TABLE `supervisors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `phone_number` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_pic` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `api_token` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supervisors`
--

INSERT INTO `supervisors` (`id`, `name`, `email`, `branch_id`, `phone_number`, `profile_pic`, `email_verified_at`, `password`, `role_name`, `Status`, `api_token`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Abdou Shawer', 'abdoushawer93@gmail.com', 1, '01092716796', 'uploads/profiles/supervisors/1/logo.png', '2021-08-23 01:40:49', '$2y$10$kZ/pvEMG.UWZLVzlAVP0geuiOpRiUztGgynkfSaF38Y5l4T13NFIS', 'مدير النظام', 'active', NULL, 'gUf6cvexaGOE7daXshKTOUSfQvarF9SYj92cZ8xKSJYtEhwv39GkiqeuoBlh', '2021-08-23 01:40:49', '2022-11-18 04:13:54'),
(4, 'محمد', 'mo@gmail.com', 1, NULL, NULL, NULL, '$2y$10$0Qs9cPpVHnn7D1p7If2JzuEc1AqTsw.Wbwr/kLbF.dPWfVzEMVRlG', 'موظف فرع', 'active', NULL, 'c1iDiFp0k1MZkf7bxi1Ch7F0U5LzYmuBn10ftW9Fzl8P8uknDkiKKdRPceQE', '2022-11-20 23:07:39', '2022-11-20 23:07:39');

-- --------------------------------------------------------

--
-- Table structure for table `supervisor_password_resets`
--

CREATE TABLE `supervisor_password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supervisor_password_resets`
--

INSERT INTO `supervisor_password_resets` (`email`, `token`, `created_at`) VALUES
('abdousaied65@gmail.com', '$2y$10$w9r2ojlfMQZR30gYetKu5eZHvfQLy4i3JHMxmPmiC1oZZieAtydbm', '2022-11-27 00:58:21'),
('abdoushawer93@gmail.com', '$2y$10$DyNxeJhMrNCS6MMRw/P/FuJABD6AioLUWU9IunuvhmpOifOe4xMhy', '2022-11-27 01:05:03');

-- --------------------------------------------------------

--
-- Table structure for table `tax_invoices`
--

CREATE TABLE `tax_invoices` (
  `id` int(11) NOT NULL,
  `unified_serial_number` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_tax_number` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `cash_amount` float DEFAULT NULL,
  `visa_amount` float DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `supervisor_id` bigint(20) UNSIGNED NOT NULL,
  `total_count` float DEFAULT NULL,
  `total_weight` float DEFAULT NULL,
  `gram_total_price` float DEFAULT NULL,
  `amount_total` float DEFAULT NULL,
  `tax_total` float DEFAULT NULL,
  `final_total` float DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'open',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tax_invoices`
--

INSERT INTO `tax_invoices` (`id`, `unified_serial_number`, `company_name`, `company_tax_number`, `date`, `time`, `payment_method`, `cash_amount`, `visa_amount`, `branch_id`, `supervisor_id`, `total_count`, `total_weight`, `gram_total_price`, `amount_total`, `tax_total`, `final_total`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 'شركة شاور', '123456789123456', '2022-11-27', '05:54:42', 'cash', 3000, NULL, 1, 1, 1, 10, 260.87, 2608.7, 391.31, 3000, 'return', '2022-11-27 03:55:08', '2022-11-29 19:17:54'),
(3, 2, 'شركة شاور', '123456789123456', '2022-11-27', '05:55:17', 'visa', NULL, 3000, 1, 1, 1, 10, 260.87, 2608.7, 391.31, 3000, 'done', '2022-11-27 03:56:17', '2022-11-27 03:56:21'),
(4, 3, 'شركة شاور', '123456789123456', '2022-11-27', '05:56:22', 'mixed', 1500, 1500, 1, 1, 1, 10, 260.87, 2608.7, 391.31, 3000, 'done', '2022-11-27 03:57:01', '2022-11-27 04:08:44');

-- --------------------------------------------------------

--
-- Table structure for table `tax_invoice_elements`
--

CREATE TABLE `tax_invoice_elements` (
  `id` int(11) NOT NULL,
  `tax_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `karat` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `gram_price` float NOT NULL,
  `amount` float DEFAULT NULL,
  `tax` float DEFAULT NULL,
  `total` float DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tax_invoice_elements`
--

INSERT INTO `tax_invoice_elements` (`id`, `tax_id`, `product_id`, `weight`, `karat`, `count`, `gram_price`, `amount`, `tax`, `total`, `created_at`, `updated_at`) VALUES
(2, 2, 1, 10, 21, 1, 260.87, 2608.7, 391.31, 3000, '2022-11-27 03:55:08', '2022-11-27 03:55:08'),
(3, 3, 1, 10, 21, 1, 260.87, 2608.7, 391.31, 3000, '2022-11-27 03:56:17', '2022-11-27 03:56:17'),
(4, 4, 1, 10, 21, 1, 260.87, 2608.7, 391.31, 3000, '2022-11-27 03:57:01', '2022-11-27 03:57:01');

-- --------------------------------------------------------

--
-- Table structure for table `tax_payments`
--

CREATE TABLE `tax_payments` (
  `id` int(11) NOT NULL,
  `tax_id` int(11) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `amount` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tax_payments`
--

INSERT INTO `tax_payments` (`id`, `tax_id`, `payment_method`, `amount`, `created_at`, `updated_at`) VALUES
(1, 2, 'cash', 3000, '2022-11-27 03:55:16', '2022-11-27 03:55:16'),
(2, 3, 'visa', 3000, '2022-11-27 03:56:21', '2022-11-27 03:56:21'),
(3, 4, 'cash', 1500, '2022-11-27 04:08:44', '2022-11-27 04:08:44'),
(4, 4, 'visa', 1500, '2022-11-27 04:08:44', '2022-11-27 04:08:44');

-- --------------------------------------------------------

--
-- Table structure for table `tax_returns`
--

CREATE TABLE `tax_returns` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `supervisor_id` bigint(20) UNSIGNED NOT NULL,
  `tax_id` int(11) NOT NULL,
  `unified_serial_number` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tax_returns`
--

INSERT INTO `tax_returns` (`id`, `branch_id`, `supervisor_id`, `tax_id`, `unified_serial_number`, `date`, `time`, `notes`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, '1', '2022-11-29', '21:17:15', 'غير صحيحة', '2022-11-29 19:17:54', '2022-11-29 19:17:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases_invoices`
--
ALTER TABLE `purchases_invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `branch_id_2` (`branch_id`),
  ADD KEY `supervisor_id` (`supervisor_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `simplified_invoices`
--
ALTER TABLE `simplified_invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `branch_id_2` (`branch_id`),
  ADD KEY `supervisor_id` (`supervisor_id`);

--
-- Indexes for table `simplified_invoice_elements`
--
ALTER TABLE `simplified_invoice_elements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id_2` (`product_id`),
  ADD KEY `simplified_id` (`simplified_id`);

--
-- Indexes for table `simplified_payments`
--
ALTER TABLE `simplified_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `simplified_id_2` (`simplified_id`);

--
-- Indexes for table `simplified_returns`
--
ALTER TABLE `simplified_returns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `branch_id_9` (`branch_id`),
  ADD KEY `supervisor_id_9` (`supervisor_id`),
  ADD KEY `simplified_id_9` (`simplified_id`);

--
-- Indexes for table `supervisors`
--
ALTER TABLE `supervisors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD UNIQUE KEY `admins_api_token_unique` (`api_token`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `supervisor_password_resets`
--
ALTER TABLE `supervisor_password_resets`
  ADD KEY `admin_password_resets_email_index` (`email`);

--
-- Indexes for table `tax_invoices`
--
ALTER TABLE `tax_invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `branch_id_22` (`branch_id`),
  ADD KEY `supervisor_id_22` (`supervisor_id`);

--
-- Indexes for table `tax_invoice_elements`
--
ALTER TABLE `tax_invoice_elements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id_22` (`product_id`),
  ADD KEY `tax_id_22` (`tax_id`);

--
-- Indexes for table `tax_payments`
--
ALTER TABLE `tax_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tax_id_23` (`tax_id`);

--
-- Indexes for table `tax_returns`
--
ALTER TABLE `tax_returns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `branch_id_10` (`branch_id`),
  ADD KEY `supervisor_id_10` (`supervisor_id`),
  ADD KEY `tax_id_10` (`tax_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `purchases_invoices`
--
ALTER TABLE `purchases_invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `simplified_invoices`
--
ALTER TABLE `simplified_invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `simplified_invoice_elements`
--
ALTER TABLE `simplified_invoice_elements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `simplified_payments`
--
ALTER TABLE `simplified_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `simplified_returns`
--
ALTER TABLE `simplified_returns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `supervisors`
--
ALTER TABLE `supervisors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tax_invoices`
--
ALTER TABLE `tax_invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tax_invoice_elements`
--
ALTER TABLE `tax_invoice_elements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tax_payments`
--
ALTER TABLE `tax_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tax_returns`
--
ALTER TABLE `tax_returns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `simplified_invoices`
--
ALTER TABLE `simplified_invoices`
  ADD CONSTRAINT `branch_id_2` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `supervisor_id` FOREIGN KEY (`supervisor_id`) REFERENCES `supervisors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `simplified_invoice_elements`
--
ALTER TABLE `simplified_invoice_elements`
  ADD CONSTRAINT `product_id_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `simplified_id` FOREIGN KEY (`simplified_id`) REFERENCES `simplified_invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `simplified_payments`
--
ALTER TABLE `simplified_payments`
  ADD CONSTRAINT `simplified_id_2` FOREIGN KEY (`simplified_id`) REFERENCES `simplified_invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `simplified_returns`
--
ALTER TABLE `simplified_returns`
  ADD CONSTRAINT `branch_id_9` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `simplified_id_9` FOREIGN KEY (`simplified_id`) REFERENCES `simplified_invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `supervisor_id_9` FOREIGN KEY (`supervisor_id`) REFERENCES `supervisors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `supervisors`
--
ALTER TABLE `supervisors`
  ADD CONSTRAINT `branch_id` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tax_invoices`
--
ALTER TABLE `tax_invoices`
  ADD CONSTRAINT `branch_id_22` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `supervisor_id_22` FOREIGN KEY (`supervisor_id`) REFERENCES `supervisors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tax_invoice_elements`
--
ALTER TABLE `tax_invoice_elements`
  ADD CONSTRAINT `product_id_22` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tax_id_22` FOREIGN KEY (`tax_id`) REFERENCES `tax_invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tax_payments`
--
ALTER TABLE `tax_payments`
  ADD CONSTRAINT `tax_id_23` FOREIGN KEY (`tax_id`) REFERENCES `tax_invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tax_returns`
--
ALTER TABLE `tax_returns`
  ADD CONSTRAINT `branch_id_10` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `supervisor_id_10` FOREIGN KEY (`supervisor_id`) REFERENCES `supervisors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tax_id_10` FOREIGN KEY (`tax_id`) REFERENCES `tax_invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
