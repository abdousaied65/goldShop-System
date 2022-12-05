-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2022 at 03:28 AM
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
(1, 'فرع العقاب 1', '0163235047', 'القصيم - بريدة - سوق الذهب - قبة رشيد', '1131056240', '11\\11310302', 'ALOQAB1', '2022-11-18 00:51:49', '2022-12-01 04:07:37'),
(2, 'فرع العقاب 2', '763456278876', 'جدة', '64352678234765', '11/34536787654', 'AlOQAB2', '2022-12-01 23:54:48', '2022-12-01 23:54:48');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `branch_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'ابرهيم', '2022-12-02 03:16:27', '2022-12-02 03:16:27'),
(2, 1, 'صالح', '2022-12-02 03:17:08', '2022-12-02 03:17:08'),
(3, 2, 'على', '2022-12-02 03:17:20', '2022-12-02 03:17:20'),
(4, 2, 'فهد', '2022-12-02 03:17:41', '2022-12-02 03:33:33');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `supervisor_id` bigint(20) UNSIGNED NOT NULL,
  `fixed_id` int(11) NOT NULL,
  `unified_serial_number` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `expense_details` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `expense_pic` text NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `branch_id`, `supervisor_id`, `fixed_id`, `unified_serial_number`, `date`, `expense_details`, `amount`, `expense_pic`, `notes`, `created_at`, `updated_at`) VALUES
(2, 1, 1, 2, '1', '2022-11-30', 'راتب ابراهيم شهر نوفمبر 2022', '2500', 'uploads/expenses/2/maxresdefault.jpg', 'راتب كامل', '2022-12-03 04:13:09', '2022-12-03 04:13:09');

-- --------------------------------------------------------

--
-- Table structure for table `fixed_expenses`
--

CREATE TABLE `fixed_expenses` (
  `id` int(11) NOT NULL,
  `supervisor_id` bigint(20) UNSIGNED NOT NULL,
  `fixed_expense` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fixed_expenses`
--

INSERT INTO `fixed_expenses` (`id`, `supervisor_id`, `fixed_expense`, `created_at`, `updated_at`) VALUES
(1, 1, 'ايجارات 2', '2022-12-03 03:38:50', '2022-12-03 03:40:45'),
(2, 1, 'رواتب', '2022-12-03 03:39:22', '2022-12-03 03:39:22');

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
(1, 'App\\Models\\Supervisor', 5),
(2, 'App\\Models\\Supervisor', 4),
(2, 'App\\Models\\Supervisor', 6);

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
(27, 'عرض مرتجع فاتورة ضريبية', 'tax_return', 'supervisor-web', '2022-11-29 16:42:27', '2022-11-29 16:42:27'),
(28, 'اضافة موظف', 'employee', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(29, 'عرض موظف', 'employee', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(30, 'تعديل موظف', 'employee', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(31, 'حذف موظف', 'employee', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(32, 'تعديل فاتورة مبسطة', 'simplified', 'supervisor-web', '2022-12-02 14:27:54', '2022-12-02 14:27:54'),
(33, 'تعديل فاتورة ضريبية', 'tax', 'supervisor-web', '2022-12-02 14:27:54', '2022-12-02 14:27:54'),
(34, 'اضافة مصروف ثابت', 'fixed', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(35, 'عرض مصروف ثابت', 'fixed', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(36, 'تعديل مصروف ثابت', 'fixed', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(37, 'حذف مصروف ثابت', 'fixed', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(38, 'اضافة مصروف', 'expense', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(39, 'عرض مصروف', 'expense', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(40, 'تعديل مصروف', 'expense', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(41, 'حذف مصروف', 'expense', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(42, 'التقارير', 'reports', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42');

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
  `employee_id` int(11) NOT NULL,
  `tax_total` float NOT NULL,
  `final_total` float NOT NULL,
  `attachment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchases_invoices`
--

INSERT INTO `purchases_invoices` (`id`, `invoice_number`, `date`, `branch_id`, `supervisor_id`, `employee_id`, `tax_total`, `final_total`, `attachment`, `created_at`, `updated_at`) VALUES
(1, '453678', '2022-12-02', 2, 1, 4, 391.3, 3000, 'uploads/purchases/attachments/1/maxresdefault.jpg', '2022-12-02 14:29:47', '2022-12-02 14:29:47'),
(2, '86543', '2022-12-05', 1, 1, 1, 391, 3000, 'uploads/purchases/attachments/2/maxresdefault.jpg', '2022-12-05 03:06:53', '2022-12-05 03:06:53');

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
(2, 'مدير فرع', 'supervisor-web', '2022-11-18 04:02:02', '2022-11-18 04:02:02');

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
(19, 2),
(20, 1),
(20, 2),
(21, 1),
(21, 2),
(22, 1),
(22, 2),
(23, 1),
(23, 2),
(24, 1),
(24, 2),
(25, 1),
(25, 2),
(26, 1),
(26, 2),
(27, 1),
(27, 2),
(28, 1),
(28, 2),
(29, 1),
(29, 2),
(30, 1),
(30, 2),
(31, 1),
(31, 2),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1);

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
  `employee_id` int(11) NOT NULL,
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

INSERT INTO `simplified_invoices` (`id`, `unified_serial_number`, `date`, `time`, `payment_method`, `cash_amount`, `visa_amount`, `branch_id`, `supervisor_id`, `employee_id`, `total_count`, `total_weight`, `gram_total_price`, `amount_total`, `tax_total`, `final_total`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, '2022-12-02', '06:11:50', 'cash', 5000, NULL, 1, 1, 1, 2, 18, 241.55, 4347.83, 652.18, 5000, 'return', '2022-12-02 04:12:11', '2022-12-02 05:59:59'),
(4, 2, '2022-12-02', '06:18:07', 'cash', 1, NULL, 1, 1, 2, 1, 1, 0.87, 0.87, 0.13, 1, 'done', '2022-12-02 04:18:18', '2022-12-02 04:18:59'),
(5, 3, '2022-12-03', '22:18:59', 'cash', 1, NULL, 1, 1, 1, 1, 1, 0.87, 0.87, 0.13, 1, 'done', '2022-12-02 04:19:12', '2022-12-02 17:55:58'),
(6, 4, '2022-12-03', '03:18:02', 'cash', 3000, NULL, 1, 1, 1, 1, 10, 260.87, 2608.7, 391.31, 3000, 'done', '2022-12-03 01:18:21', '2022-12-03 01:18:25'),
(7, 5, '2022-12-05', '01:10:49', 'cash', 3000, NULL, 1, 1, 1, 1, 10, 300, 3000, 0, 3000, 'done', '2022-12-04 23:11:13', '2022-12-04 23:12:15'),
(8, 6, '2022-12-05', '04:17:00', 'cash', 4000, NULL, 2, 1, 4, 1, 10, 347.83, 3478.26, 521.74, 4000, 'done', '2022-12-05 02:17:13', '2022-12-05 02:17:21'),
(9, 7, '2022-12-05', '04:59:31', 'cash', 5000, NULL, 1, 1, 1, 1, 10, 434.78, 4347.83, 652.17, 5000, 'return', '2022-12-05 02:59:57', '2022-12-05 03:00:40');

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
(2, 2, 1, 10, 21, 1, 260.87, 2608.7, 391.31, 3000, '2022-12-02 04:12:11', '2022-12-02 04:12:11'),
(3, 2, 2, 8, 21, 1, 217.39, 1739.13, 260.87, 2000, '2022-12-02 04:16:41', '2022-12-02 04:16:41'),
(8, 4, 2, 1, 21, 1, 0.87, 0.87, 0.13, 1, '2022-12-02 04:18:53', '2022-12-02 04:18:53'),
(9, 5, 3, 1, 21, 1, 0.87, 0.87, 0.13, 1, '2022-12-02 04:19:12', '2022-12-02 04:19:12'),
(11, 6, 1, 10, 21, 1, 260.87, 2608.7, 391.31, 3000, '2022-12-03 01:18:21', '2022-12-03 01:18:21'),
(12, 7, 15, 10, 21, 1, 300, 3000, 0, 3000, '2022-12-04 23:11:13', '2022-12-04 23:11:13'),
(13, 8, 1, 10, 21, 1, 347.83, 3478.26, 521.74, 4000, '2022-12-05 02:17:13', '2022-12-05 02:17:13'),
(14, 9, 1, 10, 21, 1, 434.78, 4347.83, 652.17, 5000, '2022-12-05 02:59:57', '2022-12-05 02:59:57');

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
(1, 2, 'cash', 5000, '2022-12-02 04:17:27', '2022-12-02 04:17:27'),
(2, 4, 'cash', 1, '2022-12-02 04:18:59', '2022-12-02 04:18:59'),
(23, 5, 'cash', 1, '2022-12-02 17:55:58', '2022-12-02 17:55:58'),
(24, 6, 'cash', 3000, '2022-12-03 01:18:25', '2022-12-03 01:18:25'),
(25, 7, 'cash', 3000, '2022-12-04 23:12:15', '2022-12-04 23:12:15'),
(26, 8, 'cash', 4000, '2022-12-05 02:17:21', '2022-12-05 02:17:21'),
(27, 9, 'cash', 5000, '2022-12-05 03:00:01', '2022-12-05 03:00:01');

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
  `employee_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `simplified_returns`
--

INSERT INTO `simplified_returns` (`id`, `branch_id`, `supervisor_id`, `simplified_id`, `unified_serial_number`, `employee_id`, `date`, `time`, `notes`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, '1', 1, '2022-12-02', '07:59:38', NULL, '2022-12-02 05:59:59', '2022-12-02 05:59:59'),
(2, 1, 1, 9, '2', 1, '2022-12-05', '05:00:24', 'مرتجع', '2022-12-05 03:00:40', '2022-12-05 03:00:40');

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
(1, 'Admin', 'admin@admin.com', NULL, '01092716796', 'uploads/profiles/supervisors/1/logo.png', '2021-08-23 01:40:49', '$2y$10$t4SrdNYc5gUcTeBUyZtu5e1bKWFkrcILcaTLglc816zddXkjoir3G', 'مدير النظام', 'active', NULL, 'GYSoI8ArPurNFTR7xOhlzRAbqUbA5XE3qC0F5jWueiPV849LeFdcdio5NHiy', '2021-08-23 01:40:49', '2022-12-01 02:43:40'),
(4, 'فرع العقاب 1 الرياض', 'mo@gmail.com', 1, NULL, NULL, NULL, '$2y$10$HgTgrWaXc/Mm.Sb/LJucJ.ReDnapVmv56Z6WGSnhxKnIbfoYbBbSu', 'مديرفرع', 'active', NULL, 'c1iDiFp0k1MZkf7bxi1Ch7F0U5LzYmuBn10ftW9Fzl8P8uknDkiKKdRPceQE', '2022-11-20 23:07:39', '2022-12-01 23:56:16'),
(5, 'مدير 2', 'admin2@admin.com', NULL, NULL, NULL, NULL, '$2y$10$9GH67S7Ahn4Y3AEI8pgR0OIgjWHwr43ZI4seMVkauE7XoByd79cqO', 'مدير النظام', 'active', NULL, NULL, '2022-11-30 22:27:37', '2022-11-30 22:27:37'),
(6, 'فرع العقاب 2 جدة', 'oqab2@gmail.com', 2, NULL, NULL, NULL, '$2y$10$kx0TmPb5nzac7Pc5GXF.WOlBz63hbl67UQmJ6qsPyQ7yPOy30Z5/2', 'مديرفرع', 'active', NULL, NULL, '2022-12-01 23:55:55', '2022-12-01 23:55:55');

-- --------------------------------------------------------

--
-- Table structure for table `supervisor_password_resets`
--

CREATE TABLE `supervisor_password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `employee_id` int(11) NOT NULL,
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

INSERT INTO `tax_invoices` (`id`, `unified_serial_number`, `company_name`, `company_tax_number`, `date`, `time`, `payment_method`, `cash_amount`, `visa_amount`, `branch_id`, `supervisor_id`, `employee_id`, `total_count`, `total_weight`, `gram_total_price`, `amount_total`, `tax_total`, `final_total`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'شركة موارد الخليج', '123456789102030', '2022-12-02', '15:57:31', 'cash', 3000, NULL, 1, 1, 2, 1, 10, 260.87, 2608.7, 391.31, 3000, 'done', '2022-12-02 14:12:03', '2022-12-03 01:25:06'),
(2, 2, 'شركة موارد', '536776545676543', '2022-12-04', '21:51:58', 'cash', 3000, NULL, 1, 1, 1, 1, 10, 260.87, 2608.7, 391.31, 3000, 'done', '2022-12-04 19:52:25', '2022-12-04 19:52:31'),
(3, 3, 'شركة موارد', '536776545676543', '2022-12-04', '21:52:36', 'cash', 3000, NULL, 1, 1, 1, 1, 10, 260.87, 2608.7, 391.31, 3000, 'return', '2022-12-04 19:53:06', '2022-12-04 19:55:23'),
(4, 4, 'شركة موارد', '536776545676543', '2022-12-04', '21:53:15', 'cash', 3000, NULL, 1, 1, 1, 1, 10, 260.87, 2608.7, 391.31, 3000, 'return', '2022-12-04 19:54:45', '2022-12-04 19:55:36');

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
(1, 1, 3, 10, 21, 1, 260.87, 2608.7, 391.31, 3000, '2022-12-02 14:12:03', '2022-12-02 14:12:03'),
(2, 2, 1, 10, 21, 1, 260.87, 2608.7, 391.31, 3000, '2022-12-04 19:52:25', '2022-12-04 19:52:25'),
(3, 3, 1, 10, 21, 1, 260.87, 2608.7, 391.31, 3000, '2022-12-04 19:53:06', '2022-12-04 19:53:06'),
(4, 4, 1, 10, 21, 1, 260.87, 2608.7, 391.31, 3000, '2022-12-04 19:54:45', '2022-12-04 19:54:45');

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
(5, 1, 'cash', 3000, '2022-12-03 01:25:06', '2022-12-03 01:25:06'),
(6, 2, 'cash', 3000, '2022-12-04 19:52:31', '2022-12-04 19:52:31'),
(7, 3, 'cash', 3000, '2022-12-04 19:53:11', '2022-12-04 19:53:11'),
(8, 4, 'cash', 3000, '2022-12-04 19:54:49', '2022-12-04 19:54:49');

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
  `employee_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tax_returns`
--

INSERT INTO `tax_returns` (`id`, `branch_id`, `supervisor_id`, `tax_id`, `unified_serial_number`, `employee_id`, `date`, `time`, `notes`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 3, '1', 1, '2022-12-04', '21:54:57', NULL, '2022-12-04 19:55:23', '2022-12-04 19:55:23'),
(2, 1, 1, 4, '2', 1, '2022-12-04', '21:55:24', NULL, '2022-12-04 19:55:36', '2022-12-04 19:55:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `branch_id_54` (`branch_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `branch_id_56` (`branch_id`),
  ADD KEY `supervisor_id_56` (`supervisor_id`),
  ADD KEY `fixed_id_56` (`fixed_id`);

--
-- Indexes for table `fixed_expenses`
--
ALTER TABLE `fixed_expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supervisor_id_55` (`supervisor_id`);

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
  ADD KEY `branch_id_90` (`branch_id`),
  ADD KEY `supervisor_id_90` (`supervisor_id`),
  ADD KEY `employee_id_90` (`employee_id`);

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
  ADD KEY `supervisor_id` (`supervisor_id`),
  ADD KEY `employee_id` (`employee_id`);

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
  ADD KEY `simplified_id_9` (`simplified_id`),
  ADD KEY `employee_id_2` (`employee_id`);

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
  ADD KEY `supervisor_id_22` (`supervisor_id`),
  ADD KEY `employee_id_3` (`employee_id`);

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
  ADD KEY `tax_id_10` (`tax_id`),
  ADD KEY `employee_id_4` (`employee_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `fixed_expenses`
--
ALTER TABLE `fixed_expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `purchases_invoices`
--
ALTER TABLE `purchases_invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `simplified_invoices`
--
ALTER TABLE `simplified_invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `simplified_invoice_elements`
--
ALTER TABLE `simplified_invoice_elements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `simplified_payments`
--
ALTER TABLE `simplified_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `simplified_returns`
--
ALTER TABLE `simplified_returns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `supervisors`
--
ALTER TABLE `supervisors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tax_invoices`
--
ALTER TABLE `tax_invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tax_invoice_elements`
--
ALTER TABLE `tax_invoice_elements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tax_payments`
--
ALTER TABLE `tax_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tax_returns`
--
ALTER TABLE `tax_returns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `branch_id_54` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `branch_id_56` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fixed_id_56` FOREIGN KEY (`fixed_id`) REFERENCES `fixed_expenses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `supervisor_id_56` FOREIGN KEY (`supervisor_id`) REFERENCES `supervisors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fixed_expenses`
--
ALTER TABLE `fixed_expenses`
  ADD CONSTRAINT `supervisor_id_55` FOREIGN KEY (`supervisor_id`) REFERENCES `supervisors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `purchases_invoices`
--
ALTER TABLE `purchases_invoices`
  ADD CONSTRAINT `branch_id_90` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `employee_id_90` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `supervisor_id_90` FOREIGN KEY (`supervisor_id`) REFERENCES `supervisors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `employee_id` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
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
  ADD CONSTRAINT `employee_id_2` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
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
  ADD CONSTRAINT `employee_id_3` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
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
  ADD CONSTRAINT `employee_id_4` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `supervisor_id_10` FOREIGN KEY (`supervisor_id`) REFERENCES `supervisors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tax_id_10` FOREIGN KEY (`tax_id`) REFERENCES `tax_invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
