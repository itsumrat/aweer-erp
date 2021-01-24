-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 09, 2021 at 04:40 PM
-- Server version: 5.7.32-0ubuntu0.16.04.1
-- PHP Version: 7.2.34-8+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aweer-erp`
--

-- --------------------------------------------------------

--
-- Table structure for table `adjustments`
--

CREATE TABLE `adjustments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` int(11) NOT NULL,
  `doc_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_id` int(11) NOT NULL,
  `unit_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` int(11) NOT NULL DEFAULT '0',
  `parent_category` int(11) NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `code`, `name`, `department_id`, `parent_category`, `description`, `created_at`, `updated_at`) VALUES
(1, '021', 'Dairy Foods', 1, 0, 'Dairy Foods', '2020-09-05 23:10:03', '2020-09-05 23:10:03');

-- --------------------------------------------------------

--
-- Table structure for table `combos`
--

CREATE TABLE `combos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barcode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_id` int(11) NOT NULL,
  `combo_price` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `user_id` int(11) NOT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `combos`
--

INSERT INTO `combos` (`id`, `product_id`, `barcode`, `unit_id`, `combo_price`, `note`, `user_id`, `vendor_id`, `location_id`, `created_at`, `updated_at`) VALUES
(1, '1', '629102387090', 1, '', NULL, 1, 2, NULL, '2021-01-02 11:36:00', '2021-01-02 11:36:00'),
(2, '1', '629102387765', 3, '', NULL, 1, 2, NULL, '2021-01-02 11:36:27', '2021-01-02 11:36:27'),
(3, '2', '12545644456465', 1, '', NULL, 1, 2, NULL, '2021-01-04 07:23:21', '2021-01-04 07:23:21'),
(4, '3', '454545', 2, '', NULL, 1, 3, NULL, '2021-01-05 10:54:01', '2021-01-05 10:54:01'),
(5, '3', '545454', 1, '', NULL, 1, 3, NULL, '2021-01-05 10:55:43', '2021-01-05 10:55:43'),
(6, '3', '676767', 3, '', NULL, 1, 3, NULL, '2021-01-05 10:56:05', '2021-01-05 10:56:05');

-- --------------------------------------------------------

--
-- Table structure for table `combo_items`
--

CREATE TABLE `combo_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `combo_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `daily_closings`
--

CREATE TABLE `daily_closings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `loc_code` int(11) DEFAULT NULL,
  `cashier_id` int(11) DEFAULT NULL,
  `f1000` int(11) DEFAULT NULL,
  `f500` int(11) DEFAULT NULL,
  `f200` int(11) DEFAULT NULL,
  `f100` int(11) DEFAULT NULL,
  `f50` int(11) DEFAULT NULL,
  `f20` int(11) DEFAULT NULL,
  `f10` int(11) DEFAULT NULL,
  `f5` int(11) DEFAULT NULL,
  `f1` int(11) DEFAULT NULL,
  `f_50` double(8,2) DEFAULT NULL,
  `f_25` double(8,2) DEFAULT NULL,
  `s1000` int(11) DEFAULT NULL,
  `s500` int(11) DEFAULT NULL,
  `s200` int(11) DEFAULT NULL,
  `s100` int(11) DEFAULT NULL,
  `s50` int(11) DEFAULT NULL,
  `s20` int(11) DEFAULT NULL,
  `s10` int(11) DEFAULT NULL,
  `s5` int(11) DEFAULT NULL,
  `s1` int(11) DEFAULT NULL,
  `s_50` double(8,2) DEFAULT NULL,
  `s_25` double(8,2) DEFAULT NULL,
  `credit_sale` int(11) DEFAULT NULL,
  `cash_to_credit` int(11) DEFAULT NULL,
  `total_punched` int(11) DEFAULT NULL,
  `credit_to_cash` int(11) DEFAULT NULL,
  `refund` int(11) DEFAULT NULL,
  `credit_settlement` int(11) DEFAULT NULL,
  `short_over` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `damages`
--

CREATE TABLE `damages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` int(11) NOT NULL,
  `doc_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_id` int(11) NOT NULL,
  `unit_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `code`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Grocery Food', '01', 'Grocery Items', '2020-09-05 23:01:29', '2020-09-05 23:01:29'),
(2, 'Dairy', '02', 'Dairy Items', '2020-09-05 23:01:48', '2020-09-05 23:01:48'),
(3, 'Frozen', '03', 'Frozen Items', '2020-09-05 23:01:57', '2020-09-05 23:01:57');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `f_o_c_items`
--

CREATE TABLE `f_o_c_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hand_overs`
--

CREATE TABLE `hand_overs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `loc_code` int(11) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `audit_by` int(11) DEFAULT NULL,
  `audit_date` date DEFAULT NULL,
  `pcash_fund` int(11) DEFAULT NULL,
  `no_of_pos` int(11) DEFAULT NULL,
  `float_amount` int(11) DEFAULT NULL,
  `total_expense` int(11) DEFAULT NULL,
  `f1000` int(11) DEFAULT NULL,
  `f500` int(11) DEFAULT NULL,
  `f200` int(11) DEFAULT NULL,
  `f100` int(11) DEFAULT NULL,
  `f50` int(11) DEFAULT NULL,
  `f20` int(11) DEFAULT NULL,
  `f10` int(11) DEFAULT NULL,
  `f5` int(11) DEFAULT NULL,
  `f1` int(11) DEFAULT NULL,
  `f_50` int(11) DEFAULT NULL,
  `f_25` int(11) DEFAULT NULL,
  `short_over` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ledgers`
--

CREATE TABLE `ledgers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `main_ac` int(11) DEFAULT NULL,
  `ac_category` int(11) DEFAULT NULL,
  `report_type` int(11) DEFAULT NULL,
  `ledger_code` int(11) DEFAULT NULL,
  `ledger_head` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ledger_entries`
--

CREATE TABLE `ledger_entries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date DEFAULT NULL,
  `subledger_id` int(11) DEFAULT NULL,
  `balance` int(11) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `particulars` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lpo_receives`
--

CREATE TABLE `lpo_receives` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `shelf_life` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exipre_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_invoice_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_paid` tinyint(1) DEFAULT NULL COMMENT 'false for unpaid, true for paid',
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lpo_receive_items`
--

CREATE TABLE `lpo_receive_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lpo_receive_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `cost` double(8,2) NOT NULL,
  `discount` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_04_21_160445_create_departments_table', 1),
(5, '2020_04_21_160505_create_units_table', 1),
(6, '2020_04_21_160617_create_stores_table', 1),
(7, '2020_04_21_160656_create_categories_table', 1),
(8, '2020_04_21_160713_create_vendors_table', 1),
(9, '2020_04_26_184059_create_products_table', 1),
(10, '2020_04_26_185320_create_product_pricings_table', 1),
(11, '2020_04_28_182339_create_combos_table', 1),
(12, '2020_04_28_183237_create_repackings_table', 1),
(13, '2020_05_04_114931_create_price_update_histories_table', 1),
(14, '2020_05_04_174307_create_promotional_products_table', 1),
(15, '2020_05_05_170843_create_offers_table', 1),
(16, '2020_05_05_213843_create_product_wise_vendors_table', 1),
(17, '2020_05_07_200732_create_adjustments_table', 1),
(18, '2020_05_07_201010_create_damages_table', 1),
(19, '2020_05_10_185018_create_stock_calculations_table', 1),
(20, '2020_05_19_180932_create_taxes_table', 1),
(21, '2020_06_08_185955_create_permission_tables', 1),
(22, '2020_06_14_144257_create_requisitions_table', 1),
(23, '2020_06_15_201040_create_purchases_table', 1),
(24, '2020_06_15_202603_create_transfers_table', 1),
(25, '2020_06_16_210446_create_purchase_returns_table', 1),
(26, '2020_06_16_211352_create_transfer_returns_table', 1),
(27, '2020_06_16_211718_create_trn_receives_table', 1),
(28, '2020_06_16_212342_create_lpo_receives_table', 1),
(29, '2020_06_18_171505_create_requisition_wise_items_table', 1),
(30, '2020_06_20_185212_create_purchase_order_wise_items_table', 1),
(31, '2020_06_24_070530_create_f_o_c_items_table', 1),
(32, '2020_06_24_180306_create_transfer_items_table', 1),
(33, '2020_06_26_210102_create_transfer_return_items_table', 1),
(34, '2020_06_26_210346_create_purchase_return_items_table', 1),
(35, '2020_09_10_214738_create_combo_items_table', 2),
(36, '2020_12_06_044338_create_payment_vouchers_table', 3),
(37, '2020_12_10_053333_create_vendor_transactions_table', 4),
(38, '2020_12_12_074142_create_un_paid_grns_table', 5),
(39, '2020_12_12_102659_create_paid_grns_table', 6),
(40, '2020_12_19_111922_create_payment_advanceds_table', 7),
(41, '2020_12_24_183015_create_daily_closings_table', 8),
(42, '2020_12_24_183115_create_ledgers_table', 8),
(43, '2020_12_25_101944_create_ledger_entries_table', 9),
(44, '2020_12_25_102629_create_pcash_balances_table', 9),
(45, '2020_12_25_102843_create_pcash_transactions_table', 9),
(46, '2020_12_25_102916_create_product_costings_table', 9),
(47, '2020_12_25_102942_create_subledgers_table', 9),
(48, '2020_12_25_103022_create_tele_card_sales_table', 9),
(49, '2020_12_25_103146_create_hand_overs_table', 9),
(50, '2021_01_08_093721_create_requisition_stores_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barcode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_ids` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `buy_product_id` int(11) NOT NULL,
  `buy_quantity` int(11) NOT NULL,
  `get_product_id` int(11) NOT NULL,
  `get_quantity` int(11) NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paid_grns`
--

CREATE TABLE `paid_grns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date DEFAULT NULL,
  `purchase_id` int(11) DEFAULT NULL,
  `un_paid_grn_id` int(11) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `vendor_invoice` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_due` int(11) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `is_paid` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_advanceds`
--

CREATE TABLE `payment_advanceds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double(10,2) DEFAULT NULL,
  `paid_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_vouchers`
--

CREATE TABLE `payment_vouchers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pvch_date` date DEFAULT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_invoice` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_debit` float DEFAULT NULL,
  `other_debit` float DEFAULT NULL,
  `total_credit` float DEFAULT NULL,
  `other_credit` float DEFAULT NULL,
  `net_amount` int(11) DEFAULT NULL,
  `payment_amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adj_advance` int(11) NOT NULL DEFAULT '0',
  `account_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pcash_balances`
--

CREATE TABLE `pcash_balances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `loc_code` int(11) DEFAULT NULL,
  `balance` int(11) DEFAULT NULL,
  `float_money` int(11) DEFAULT NULL,
  `special_fund` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pcash_transactions`
--

CREATE TABLE `pcash_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pcash_curr_balance` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `loc_code` int(11) DEFAULT NULL,
  `exp_amount` int(11) DEFAULT NULL,
  `particulars` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exp_by` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `price_update_histories`
--

CREATE TABLE `price_update_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `prev_cost` double(8,2) NOT NULL,
  `prev_price` double(8,2) NOT NULL,
  `prev_markup` double(8,2) NOT NULL,
  `updated_price` double(8,2) NOT NULL,
  `updated_markup` double(8,2) NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barcode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `evaluation` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dept_wise_category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `generic_description` text COLLATE utf8mb4_unicode_ci,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `long_description` text COLLATE utf8mb4_unicode_ci,
  `delivery_mode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `tax_amount` int(11) NOT NULL DEFAULT '0',
  `alert_quantity` int(11) DEFAULT '0',
  `quantity` int(11) DEFAULT '1',
  `note` text COLLATE utf8mb4_unicode_ci,
  `user_id` int(11) NOT NULL,
  `location_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `code`, `barcode`, `evaluation`, `dept_wise_category`, `generic_description`, `short_description`, `long_description`, `delivery_mode`, `department_id`, `category_id`, `unit_id`, `tax_amount`, `alert_quantity`, `quantity`, `note`, `user_id`, `location_id`, `created_at`, `updated_at`) VALUES
(1, 'MAI DUBAI DRINKING WATER', '101920', '', 'Fast Moving', '1', 'LPDS__3210', 'MAI DUBAI DRINKING WATER', NULL, 'DC', 1, 1, 1, 5, 20, 1, NULL, 1, NULL, '2021-01-02 11:35:12', '2021-01-02 11:35:12'),
(2, 'Test', '101010', '', 'Fast Moving', '1', 'LPDS__3210', 'test', NULL, 'DC', 1, 1, 1, 5, 20, 1, NULL, 1, NULL, '2021-01-04 07:22:14', '2021-01-04 07:22:14'),
(3, 'Basmoti Chal', '22222', '', 'Fast Moving', '1', 'HFd', 'erewrwerw', NULL, 'DC', 1, 1, 2, 5, 50, 1, NULL, 1, NULL, '2021-01-05 10:49:28', '2021-01-05 10:49:28');

-- --------------------------------------------------------

--
-- Table structure for table `product_costings`
--

CREATE TABLE `product_costings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `purchase_cost` int(11) DEFAULT NULL,
  `cost_with_tax` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_costings`
--

INSERT INTO `product_costings` (`id`, `product_id`, `unit_id`, `purchase_cost`, `cost_with_tax`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 20, 21, '2021-01-02 11:35:12', '2021-01-02 11:35:12'),
(2, 2, 1, 30, 32, '2021-01-04 07:22:14', '2021-01-04 07:22:14'),
(3, 3, 2, 3, 3, '2021-01-05 10:49:28', '2021-01-05 10:49:28');

-- --------------------------------------------------------

--
-- Table structure for table `product_pricings`
--

CREATE TABLE `product_pricings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `barcode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `final_cost` double(8,2) DEFAULT '0.00',
  `avg_cost` double(8,2) DEFAULT '0.00',
  `last_grn_cost` double(8,2) DEFAULT '0.00',
  `markup` double(8,2) DEFAULT '0.00',
  `unit_id` int(11) DEFAULT NULL,
  `final_price` double(8,2) DEFAULT '0.00',
  `price_without_tax` double(8,2) DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_pricings`
--

INSERT INTO `product_pricings` (`id`, `product_id`, `barcode`, `final_cost`, `avg_cost`, `last_grn_cost`, `markup`, `unit_id`, `final_price`, `price_without_tax`, `created_at`, `updated_at`) VALUES
(1, 1, '629102387090', 0.00, 0.00, 0.00, 0.00, 1, 0.00, 0.00, '2021-01-02 11:36:00', '2021-01-02 11:36:00'),
(2, 1, '629102387765', 0.00, 0.00, 0.00, 0.00, 3, 0.00, 0.00, '2021-01-02 11:36:27', '2021-01-02 11:36:27'),
(3, 2, '12545644456465', 32.00, 0.00, 0.00, 20.00, 1, 38.40, 0.00, '2021-01-04 07:23:21', '2021-01-04 07:24:21'),
(4, 3, '454545', 0.00, 0.00, 0.00, 0.00, 2, 0.00, 0.00, '2021-01-05 10:54:01', '2021-01-05 10:54:01'),
(5, 3, '545454', 3.00, 0.00, 0.00, 5.00, 1, 3.15, 0.00, '2021-01-05 10:55:43', '2021-01-08 05:50:15'),
(6, 3, '676767', 18.00, 0.00, 0.00, 4.00, 3, 18.72, 0.00, '2021-01-05 10:56:05', '2021-01-08 05:49:50');

-- --------------------------------------------------------

--
-- Table structure for table `product_wise_vendors`
--

CREATE TABLE `product_wise_vendors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `vendor_price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `promotional_products`
--

CREATE TABLE `promotional_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_ids` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_id` int(11) NOT NULL,
  `promotion_start` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `promotion_end` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `promotion_price` double(8,2) NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requisition_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_confirm_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0 = draft, 1= final',
  `document_file` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_foc` tinyint(1) NOT NULL DEFAULT '0',
  `vendor_id` int(11) NOT NULL,
  `discount` double(8,2) DEFAULT '0.00',
  `tax` double(8,2) DEFAULT '0.00',
  `note` text COLLATE utf8mb4_unicode_ci,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_wise_items`
--

CREATE TABLE `purchase_order_wise_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` int(11) NOT NULL,
  `location_id` int(11) DEFAULT NULL,
  `purchase_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `cost` float NOT NULL,
  `discount` double(8,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_returns`
--

CREATE TABLE `purchase_returns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '1 = draft, 2= sent',
  `document_file` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `grand_total` float DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_return_items`
--

CREATE TABLE `purchase_return_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` int(11) NOT NULL,
  `location_id` int(11) DEFAULT NULL,
  `purchase_return_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `repackings`
--

CREATE TABLE `repackings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barcode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `evalucation` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `generic_description` text COLLATE utf8mb4_unicode_ci,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `long_description` text COLLATE utf8mb4_unicode_ci,
  `delivery_mode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `alert_quantity` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `additional_cost` double(8,2) DEFAULT NULL,
  `price` double(8,2) NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `user_id` int(11) NOT NULL,
  `location_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `requisitions`
--

CREATE TABLE `requisitions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0 = pending, 1= sent',
  `requisition_from` int(11) NOT NULL,
  `requisition_to` int(11) NOT NULL,
  `type` int(11) NOT NULL COMMENT '1 = vegetable, 2= DC, 3 = DSD',
  `note` text COLLATE utf8mb4_unicode_ci,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `requisitions`
--

INSERT INTO `requisitions` (`id`, `date`, `reference`, `status`, `requisition_from`, `requisition_to`, `type`, `note`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '2021/01/08 10:01:48', 'RQSN0010001', 0, 1, 3, 1, NULL, 1, '2021-01-08 04:23:17', '2021-01-08 04:23:17'),
(2, '2021/01/08 10:01:41', 'RQSN0010002', 0, 1, 3, 1, NULL, 1, '2021-01-08 04:27:49', '2021-01-08 04:27:49'),
(3, '2021/01/08 10:01:38', 'RQSN0010003', 0, 1, 3, 1, NULL, 1, '2021-01-08 04:43:12', '2021-01-08 04:43:12'),
(4, '2021/01/08 10:01:38', 'RQSN0010003', 0, 1, 3, 1, NULL, 1, '2021-01-08 04:53:02', '2021-01-08 04:53:02'),
(5, '2021/01/08 11:01:39', 'RQSN0010004', 0, 1, 3, 1, NULL, 1, '2021-01-08 05:54:49', '2021-01-08 05:54:49'),
(6, '2021/01/09 04:01:05', 'RQSN0010005', 0, 1, 3, 1, NULL, 1, '2021-01-09 10:28:57', '2021-01-09 10:28:57');

-- --------------------------------------------------------

--
-- Table structure for table `requisition_stores`
--

CREATE TABLE `requisition_stores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `req_store` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `requisition_stores`
--

INSERT INTO `requisition_stores` (`id`, `req_store`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Aweer', 0, '2021-01-07 18:00:00', '2021-01-07 18:00:00'),
(2, 'Central Warehouse', 0, '2021-01-07 18:00:00', '2021-01-07 18:00:00'),
(3, 'Supplier', 0, '2021-01-07 18:00:00', '2021-01-07 18:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `requisition_wise_items`
--

CREATE TABLE `requisition_wise_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `requisition_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `requisition_wise_items`
--

INSERT INTO `requisition_wise_items` (`id`, `requisition_id`, `item_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 5, 6, 3, '2021-01-08 05:54:49', '2021-01-08 05:54:49'),
(2, 6, 676767, 23, '2021-01-09 10:28:57', '2021-01-09 10:28:57'),
(3, 6, 545454, 12, '2021-01-09 10:28:57', '2021-01-09 10:28:57');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) NOT NULL,
  `location_id` bigint(20) DEFAULT NULL,
  `op_type` tinyint(1) DEFAULT NULL COMMENT '1=in, 2=out',
  `quantity` bigint(20) NOT NULL DEFAULT '0',
  `user_id` bigint(20) DEFAULT NULL,
  `e_p` int(11) DEFAULT NULL COMMENT 'end_point',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_balances`
--

CREATE TABLE `stock_balances` (
  `item_id` bigint(20) NOT NULL,
  `location_id` bigint(20) NOT NULL,
  `op_type` tinyint(1) DEFAULT NULL COMMENT '1=in, 2=out',
  `balance_quantity` bigint(20) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_calculations`
--

CREATE TABLE `stock_calculations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `zone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `stock` int(11) DEFAULT NULL,
  `counted_stock` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `name`, `code`, `phone`, `email`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Electra', '2101', '9999999999999', 'electra@gmail.com', 'Electra', '2020-09-05 23:02:57', '2020-09-05 23:02:57'),
(2, 'Muroor', '2102', '88888888888', 'muroor@gmail.com', 'Muroor', '2020-09-05 23:03:17', '2020-09-05 23:03:17'),
(3, 'Airport Road', '2104', '77777777777777', 'airport@gmail.com', 'Airport Road', '2020-09-05 23:03:39', '2020-09-05 23:03:39'),
(4, 'ASM M-09', '2105', '3356477568', 'asmm09@gmail.com', 'Musaafah-09, Abu Dhabi, UAE', '2020-10-02 03:14:20', '2020-10-02 03:14:20');

-- --------------------------------------------------------

--
-- Table structure for table `subledgers`
--

CREATE TABLE `subledgers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ledger_id` int(11) DEFAULT NULL,
  `main_ac_id` int(11) DEFAULT NULL,
  `ac_category_id` int(11) DEFAULT NULL,
  `report_type_id` int(11) DEFAULT NULL,
  `posting_type` int(11) DEFAULT NULL,
  `subledger_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subledger_head` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `op_balance` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE `taxes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amount` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taxes`
--

INSERT INTO `taxes` (`id`, `amount`, `created_at`, `updated_at`) VALUES
(1, 5.00, '2020-09-05 23:10:15', '2020-09-05 23:10:15');

-- --------------------------------------------------------

--
-- Table structure for table `tele_card_sales`
--

CREATE TABLE `tele_card_sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dc_id` int(11) DEFAULT NULL,
  `e15` int(11) DEFAULT NULL,
  `e30` int(11) DEFAULT NULL,
  `e55` int(11) DEFAULT NULL,
  `e110` int(11) DEFAULT NULL,
  `f15` int(11) DEFAULT NULL,
  `f20` int(11) DEFAULT NULL,
  `f30` int(11) DEFAULT NULL,
  `f50` int(11) DEFAULT NULL,
  `du25` int(11) DEFAULT NULL,
  `du55` int(11) DEFAULT NULL,
  `du110` int(11) DEFAULT NULL,
  `h15` int(11) DEFAULT NULL,
  `h30` int(11) DEFAULT NULL,
  `h50` int(11) DEFAULT NULL,
  `emb50` int(11) DEFAULT NULL,
  `dmb50` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transfers`
--

CREATE TABLE `transfers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transfer_from` int(11) NOT NULL,
  `transfer_to` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '1 = sent, 2= received',
  `document_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transfer_items`
--

CREATE TABLE `transfer_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transfer_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transfer_items`
--

INSERT INTO `transfer_items` (`id`, `transfer_id`, `item_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 17, 3, '2020-11-17 04:40:09', '2020-11-17 04:40:09'),
(2, 2, 3, 25, '2020-11-17 07:51:45', '2020-11-17 07:51:45'),
(3, 3, 3, 5, '2020-11-20 23:23:37', '2020-11-20 23:23:37');

-- --------------------------------------------------------

--
-- Table structure for table `transfer_returns`
--

CREATE TABLE `transfer_returns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transfer_from` int(11) NOT NULL,
  `transfer_to` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '1 = Draft, 2= Sent',
  `document_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transfer_return_items`
--

CREATE TABLE `transfer_return_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transfer_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trn_receives`
--

CREATE TABLE `trn_receives` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reference_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transfer_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shop_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_cost` double(8,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trn_receive_items`
--

CREATE TABLE `trn_receive_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `trn_receive_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `cost` double(8,2) NOT NULL,
  `discount` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `note`, `created_at`, `updated_at`) VALUES
(1, 'PCS', '1', '2020-09-05 23:02:18', '2020-09-05 23:02:18'),
(2, 'KG', '1', '2020-09-05 23:02:25', '2020-09-05 23:02:25'),
(3, 'CTN/6', '6', '2020-09-06 02:26:14', '2020-09-06 02:26:14');

-- --------------------------------------------------------

--
-- Table structure for table `un_paid_grns`
--

CREATE TABLE `un_paid_grns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date DEFAULT NULL,
  `purchase_id` int(11) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `vendor_invoice` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_due` int(11) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `is_paid` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', NULL, '$2y$10$ZtDkvhHdzt8lNDr5MQRQ/OOGLKcHsKwldtlBkaSnBpuQOBMXAuxWK', 'd3K8KFxpDZshwJXWMIzWUxIjmgRxmVSiuipjvZaNSUcYq7mrnd7k3Iptmx1l', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vat_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_term` int(11) NOT NULL,
  `discount` double(8,2) DEFAULT '0.00',
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `code`, `company`, `vat_no`, `email`, `name`, `city`, `phone`, `country`, `payment_term`, `discount`, `address`, `type`, `created_at`, `updated_at`) VALUES
(1, 'F001001', 'Fresh Food Company', '12456789', 'ffc@gmail.com', 'Fresh Food Company', 'Abu Dhabi', '987654321', 'UAE', 30, 5.00, 'Abu Dhabi', 'Principle vendor', '2020-09-05 23:11:56', '2020-09-05 23:11:56'),
(2, 'U001001', 'IFCO', '456123789', 'ifco@gmail.com', 'IFCO', 'Abu Dhabi', '123789456', 'UAE', 15, 3.00, 'Musaffah', 'Principle vendor', '2020-09-05 23:18:06', '2020-09-05 23:18:06'),
(3, 'M002002', 'SSL', '5', 'test1@gmail.com', 'Test 1', 'Dhaka', '0183232832', 'Bangladesh', 15, 3.00, 'Dhaka', 'Principle vendor', '2020-12-26 00:24:42', '2020-12-26 00:24:42');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_stocks`
--

CREATE TABLE `vendor_stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) NOT NULL,
  `vendor_id` bigint(20) DEFAULT NULL,
  `op_type` tinyint(1) DEFAULT NULL COMMENT '1=in, 2=out',
  `quantity` bigint(20) NOT NULL DEFAULT '0',
  `user_id` bigint(20) DEFAULT NULL,
  `e_p` int(11) DEFAULT NULL COMMENT 'end_point',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_stock_balances`
--

CREATE TABLE `vendor_stock_balances` (
  `item_id` bigint(20) NOT NULL,
  `vendor_id` bigint(20) NOT NULL,
  `op_type` tinyint(1) DEFAULT NULL COMMENT '1=in, 2=out',
  `balance_quantity` bigint(20) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_transactions`
--

CREATE TABLE `vendor_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date DEFAULT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '1 = draft, 2= sent	',
  `document_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `user_id` int(11) DEFAULT NULL,
  `debit` float DEFAULT NULL,
  `credit` float NOT NULL,
  `un_paid_grn_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adjustments`
--
ALTER TABLE `adjustments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `combos`
--
ALTER TABLE `combos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `combo_items`
--
ALTER TABLE `combo_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daily_closings`
--
ALTER TABLE `daily_closings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `damages`
--
ALTER TABLE `damages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `f_o_c_items`
--
ALTER TABLE `f_o_c_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hand_overs`
--
ALTER TABLE `hand_overs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ledgers`
--
ALTER TABLE `ledgers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ledger_entries`
--
ALTER TABLE `ledger_entries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lpo_receives`
--
ALTER TABLE `lpo_receives`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lpo_receive_items`
--
ALTER TABLE `lpo_receive_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
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
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `offers_code_unique` (`code`),
  ADD UNIQUE KEY `offers_barcode_unique` (`barcode`);

--
-- Indexes for table `paid_grns`
--
ALTER TABLE `paid_grns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_advanceds`
--
ALTER TABLE `payment_advanceds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_vouchers`
--
ALTER TABLE `payment_vouchers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pcash_balances`
--
ALTER TABLE `pcash_balances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pcash_transactions`
--
ALTER TABLE `pcash_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `price_update_histories`
--
ALTER TABLE `price_update_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_costings`
--
ALTER TABLE `product_costings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_pricings`
--
ALTER TABLE `product_pricings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_wise_vendors`
--
ALTER TABLE `product_wise_vendors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promotional_products`
--
ALTER TABLE `promotional_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_order_wise_items`
--
ALTER TABLE `purchase_order_wise_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_returns`
--
ALTER TABLE `purchase_returns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_return_items`
--
ALTER TABLE `purchase_return_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `repackings`
--
ALTER TABLE `repackings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requisitions`
--
ALTER TABLE `requisitions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requisition_stores`
--
ALTER TABLE `requisition_stores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requisition_wise_items`
--
ALTER TABLE `requisition_wise_items`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_balances`
--
ALTER TABLE `stock_balances`
  ADD PRIMARY KEY (`item_id`,`location_id`);

--
-- Indexes for table `stock_calculations`
--
ALTER TABLE `stock_calculations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `stores_code_unique` (`code`),
  ADD UNIQUE KEY `stores_phone_unique` (`phone`),
  ADD UNIQUE KEY `stores_email_unique` (`email`);

--
-- Indexes for table `subledgers`
--
ALTER TABLE `subledgers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tele_card_sales`
--
ALTER TABLE `tele_card_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfer_items`
--
ALTER TABLE `transfer_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfer_returns`
--
ALTER TABLE `transfer_returns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfer_return_items`
--
ALTER TABLE `transfer_return_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trn_receives`
--
ALTER TABLE `trn_receives`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trn_receive_items`
--
ALTER TABLE `trn_receive_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `un_paid_grns`
--
ALTER TABLE `un_paid_grns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor_stocks`
--
ALTER TABLE `vendor_stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor_stock_balances`
--
ALTER TABLE `vendor_stock_balances`
  ADD PRIMARY KEY (`item_id`,`vendor_id`);

--
-- Indexes for table `vendor_transactions`
--
ALTER TABLE `vendor_transactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adjustments`
--
ALTER TABLE `adjustments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `combos`
--
ALTER TABLE `combos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `combo_items`
--
ALTER TABLE `combo_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `daily_closings`
--
ALTER TABLE `daily_closings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `damages`
--
ALTER TABLE `damages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `f_o_c_items`
--
ALTER TABLE `f_o_c_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hand_overs`
--
ALTER TABLE `hand_overs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ledgers`
--
ALTER TABLE `ledgers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ledger_entries`
--
ALTER TABLE `ledger_entries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lpo_receives`
--
ALTER TABLE `lpo_receives`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lpo_receive_items`
--
ALTER TABLE `lpo_receive_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `paid_grns`
--
ALTER TABLE `paid_grns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payment_advanceds`
--
ALTER TABLE `payment_advanceds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payment_vouchers`
--
ALTER TABLE `payment_vouchers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pcash_balances`
--
ALTER TABLE `pcash_balances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pcash_transactions`
--
ALTER TABLE `pcash_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `price_update_histories`
--
ALTER TABLE `price_update_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `product_costings`
--
ALTER TABLE `product_costings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `product_pricings`
--
ALTER TABLE `product_pricings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `product_wise_vendors`
--
ALTER TABLE `product_wise_vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `promotional_products`
--
ALTER TABLE `promotional_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `purchase_order_wise_items`
--
ALTER TABLE `purchase_order_wise_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `purchase_returns`
--
ALTER TABLE `purchase_returns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `purchase_return_items`
--
ALTER TABLE `purchase_return_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `repackings`
--
ALTER TABLE `repackings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `requisitions`
--
ALTER TABLE `requisitions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `requisition_stores`
--
ALTER TABLE `requisition_stores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `requisition_wise_items`
--
ALTER TABLE `requisition_wise_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stock_calculations`
--
ALTER TABLE `stock_calculations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `subledgers`
--
ALTER TABLE `subledgers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tele_card_sales`
--
ALTER TABLE `tele_card_sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transfers`
--
ALTER TABLE `transfers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transfer_items`
--
ALTER TABLE `transfer_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `transfer_returns`
--
ALTER TABLE `transfer_returns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transfer_return_items`
--
ALTER TABLE `transfer_return_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `trn_receives`
--
ALTER TABLE `trn_receives`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `trn_receive_items`
--
ALTER TABLE `trn_receive_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `un_paid_grns`
--
ALTER TABLE `un_paid_grns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `vendor_stocks`
--
ALTER TABLE `vendor_stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vendor_transactions`
--
ALTER TABLE `vendor_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
