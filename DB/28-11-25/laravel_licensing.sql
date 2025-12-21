-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2025 at 02:00 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_licensing`
--

-- --------------------------------------------------------

--
-- Table structure for table `activated_sites`
--

CREATE TABLE `activated_sites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `license_id` bigint(20) UNSIGNED NOT NULL,
  `domain` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `licenses`
--

CREATE TABLE `licenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subscription_id` bigint(20) UNSIGNED NOT NULL,
  `license_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `expires_at` timestamp NULL DEFAULT NULL,
  `allowed_domains` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ;

--
-- Dumping data for table `licenses`
--

INSERT INTO `licenses` (`id`, `subscription_id`, `license_key`, `is_active`, `status`, `expires_at`, `allowed_domains`, `notes`, `metadata`, `version`, `document_file`, `certificate_file`, `receipt_file`, `file_metadata`, `activation_limit`, `activations_used`, `created_at`, `updated_at`) VALUES
(2, 2, '573C3885B08C9621-FAA11A4EDE74CB16', 1, 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 0, '2025-11-28 05:38:18', '2025-11-28 05:38:18'),
(3, 3, '744FC5AFBEE4B17F-A515D592387F0A0B', 1, 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, '2025-11-28 05:56:15', '2025-11-28 06:15:16'),
(4, 4, '975FD31C85850291-F54C2E95829F449C', 1, 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 0, '2025-11-28 06:37:08', '2025-11-28 06:37:08');

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
(2, '2014_10_12_100000_create_password_resets_table', 2),
(3, '2019_05_03_000001_create_customer_columns', 3),
(10, '2019_05_03_000002_create_subscriptions_table', 4),
(11, '2019_05_03_000003_create_subscription_items_table', 4),
(12, '2019_08_19_000000_create_failed_jobs_table', 4),
(13, '2019_12_14_000001_create_personal_access_tokens_table', 4),
(14, '2024_11_27_000001_add_profile_fields_to_users_table', 4),
(15, '2024_11_27_000002_add_extended_profile_fields_to_users_table', 4),
(16, '2024_11_28_000001_create_renewal_history_table', 5),
(17, '2024_11_28_000002_create_transactions_table', 6),
(19, '2025_11_25_120052_create_products_table', 7),
(20, '2025_11_26_111306_create_plugin_subscriptions_table', 8),
(21, '2025_11_26_120117_create_licenses_table', 9),
(22, '2025_11_28_000003_add_is_active_to_products_table', 10),
(23, '2025_11_28_000004_add_license_fields_to_licenses_table', 11),
(24, '2025_11_28_000005_add_missing_fields_to_products_table', 12),
(25, '2025_11_28_000007_add_file_fields_to_licenses_table', 13);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plugin_subscriptions`
--

CREATE TABLE `plugin_subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `plan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `currency` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'USD',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `starts_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `expires_at` timestamp NULL DEFAULT NULL,
  `stripe_subscription_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_payment_intent_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plugin_subscriptions`
--

INSERT INTO `plugin_subscriptions` (`id`, `user_id`, `product_id`, `plan`, `amount`, `currency`, `status`, `starts_at`, `expires_at`, `stripe_subscription_id`, `stripe_payment_intent_id`, `created_at`, `updated_at`) VALUES
(2, 2, 4, 'monthly', '19.99', 'USD', 'active', '2025-11-28 05:38:18', '2025-12-28 05:38:18', 'pi_3SYPX9FJjDqSry300obWLyZA', 'pi_3SYPX9FJjDqSry300obWLyZA', '2025-11-28 05:38:18', '2025-11-28 05:38:18'),
(3, 2, 7, 'monthly', '12.99', 'USD', 'active', '2026-11-27 18:30:00', '2026-12-27 18:30:00', 'pi_3SYPoWFJjDqSry300hncKIfv', 'pi_3SYPwbFJjDqSry301m5mqwCB', '2025-11-28 05:56:15', '2025-11-28 06:04:36'),
(4, 3, 6, 'yearly', '149.99', 'USD', 'active', '2026-11-27 18:30:00', '2027-11-27 18:30:00', 'pi_3SYQS4FJjDqSry3003l21rjN', 'pi_3SYQm3FJjDqSry301qaSly07', '2025-11-28 06:37:07', '2025-11-28 06:57:46');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `version` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1.0.0',
  `tested_up_to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `requires_php` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '7.4',
  `requires_wordpress` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '5.0',
  `price_monthly` decimal(8,2) NOT NULL,
  `price_yearly` decimal(8,2) NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `banner_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `changelog` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `documentation_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `github_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `support_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default_activation_limit` int(11) NOT NULL DEFAULT 1,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `description`, `short_description`, `version`, `tested_up_to`, `requires_php`, `requires_wordpress`, `price_monthly`, `price_yearly`, `file_path`, `banner_image`, `icon_image`, `changelog`, `documentation_url`, `github_url`, `support_url`, `default_activation_limit`, `is_active`, `created_at`, `updated_at`) VALUES
(4, 'Moon Security Pro', 'moon-security-pro', 'Moon Security Pro is a comprehensive WordPress security solution that provides real-time protection against threats, malware scanning, firewall protection, and security hardening features.', 'Advanced WordPress security plugin with firewall and malware protection', '2.1.0', '6.4', '7.4', '5.0', '19.99', '199.99', 'plugins/moon-security-pro.zip', NULL, NULL, NULL, 'https://docs.moonplugins.com/security', 'https://github.com/moonplugins/security-pro', 'https://support.moonplugins.com', 3, 1, '2025-11-28 05:27:00', '2025-11-28 05:28:06'),
(5, 'Moon SEO Pro', 'moon-seo-pro', 'Moon SEO Pro provides comprehensive SEO optimization including XML sitemaps, meta tags, schema markup, page analysis, and Google Analytics integration to improve your search rankings.', 'Complete SEO optimization plugin for WordPress with analytics and ranking tools', '1.8.5', '6.4', '7.4', '5.0', '24.99', '249.99', 'plugins/moon-seo-pro.zip', NULL, NULL, NULL, 'https://docs.moonplugins.com/seo', 'https://github.com/moonplugins/seo-pro', 'https://support.moonplugins.com', 5, 1, '2025-11-28 05:27:09', '2025-11-28 05:28:06'),
(6, 'Moon Central Pro', 'moon-central-pro', 'Moon Central Pro transforms your WordPress dashboard with custom themes, white-label options, and enhanced admin features for better user experience.', 'WordPress dashboard theme and admin customization plugin', '3.2.1', '6.4', '7.4', '5.0', '14.99', '149.99', 'plugins/moon-central-pro-1764327461.zip', NULL, NULL, NULL, 'https://docs.moonplugins.com/central', 'https://github.com/moonplugins/central-pro', 'https://support.moonplugins.com', 10, 1, '2025-11-28 05:27:18', '2025-11-28 05:28:06'),
(7, 'Moon Backup Pro', 'moon-backup-pro', 'Moon Backup Pro provides reliable automated backups with cloud storage support to Google Drive, Dropbox, and Amazon S3. Schedule backups, restore with one click, and never lose your data.', 'Automated WordPress backup plugin with cloud storage integration', '1.5.3', '6.4', '7.4', '5.0', '12.99', '129.99', 'plugins/moon-backup-pro.zip', NULL, NULL, NULL, 'https://docs.moonplugins.com/backup', 'https://github.com/moonplugins/backup-pro', 'https://support.moonplugins.com', 3, 1, '2025-11-28 05:27:35', '2025-11-28 05:28:06'),
(9, 'Moon Analytics Pro', 'moon-analytics-pro', 'Moon Analytics Pro provides comprehensive website analytics with real-time visitor tracking, conversion monitoring, heatmaps, and detailed reporting without relying on external services.', 'Advanced WordPress analytics and visitor tracking plugin', '1.9.2', '6.4', '7.4', '5.0', '22.99', '229.99', 'plugins/moon-analytics-pro-1764327744.zip', NULL, NULL, NULL, 'https://docs.moonplugins.com/analytics', 'https://github.com/moonplugins/analytics-pro', 'https://support.moonplugins.com', 3, 1, '2025-11-28 05:27:49', '2025-11-28 05:32:24');

-- --------------------------------------------------------

--
-- Table structure for table `renewal_history`
--

CREATE TABLE `renewal_history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `license_id` bigint(20) UNSIGNED NOT NULL,
  `subscription_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `plan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `currency` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'USD',
  `renewal_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'extension',
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_intent_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `renewal_start_date` timestamp NULL DEFAULT NULL,
  `renewal_end_date` timestamp NULL DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ;

--
-- Dumping data for table `renewal_history`
--

INSERT INTO `renewal_history` (`id`, `user_id`, `license_id`, `subscription_id`, `product_id`, `plan`, `amount`, `currency`, `renewal_type`, `transaction_id`, `payment_method`, `payment_intent_id`, `customer_id`, `renewal_start_date`, `renewal_end_date`, `notes`, `metadata`, `created_at`, `updated_at`) VALUES
(1, 2, 3, 3, 7, 'monthly', '12.99', 'USD', 'extension', 'pi_3SYPwbFJjDqSry301m5mqwCB', 'stripe', 'pi_3SYPwbFJjDqSry301m5mqwCB', 'cus_TVQoFEtbEH592t', '2026-11-27 18:30:00', '2026-12-27 18:30:00', NULL, '{\"payment_intent_status\":\"succeeded\",\"renewal_initiated_at\":\"2025-11-28T11:34:36.304777Z\"}', '2025-11-28 06:04:36', '2025-11-28 06:04:36'),
(2, 3, 4, 4, 6, 'yearly', '149.99', 'USD', 'extension', 'pi_3SYQm3FJjDqSry301qaSly07', 'stripe', 'pi_3SYQm3FJjDqSry301qaSly07', 'cus_TVRfogiE2IGn4g', '2026-11-27 18:30:00', '2027-11-27 18:30:00', NULL, '{\"payment_intent_status\":\"succeeded\",\"renewal_initiated_at\":\"2025-11-28T12:27:46.654803Z\"}', '2025-11-28 06:57:46', '2025-11-28 06:57:46');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscription_items`
--

CREATE TABLE `subscription_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subscription_id` bigint(20) UNSIGNED NOT NULL,
  `stripe_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_product` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `license_id` bigint(20) UNSIGNED DEFAULT NULL,
  `subscription_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `currency` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'USD',
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_gateway_transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_gateway_customer_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `license_id`, `subscription_id`, `product_id`, `transaction_id`, `type`, `status`, `amount`, `currency`, `payment_method`, `payment_gateway_transaction_id`, `payment_gateway_customer_id`, `payment_metadata`, `product_name`, `plan`, `original_amount`, `discount_amount`, `discount_code`, `license_key`, `period_start`, `period_end`, `auto_renewal`, `billing_name`, `billing_email`, `billing_address`, `billing_city`, `billing_state`, `billing_country`, `billing_postal_code`, `billing_phone`, `description`, `metadata`, `notes`, `processed_at`, `refunded_at`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 2, 4, 'TXN-2025-692982A258136', 'purchase', 'completed', '19.99', 'USD', 'stripe', 'pi_3SYPX9FJjDqSry300obWLyZA', 'cus_TVQN1VctmUyTLO', '{\"payment_intent_status\":\"succeeded\",\"payment_method_id\":\"pm_1SYPX7FJjDqSry30rTeTDjb7\"}', 'Moon Security Pro', 'monthly', '19.99', '0.00', NULL, '573C3885B08C9621-FAA11A4EDE74CB16', '2025-11-28 05:38:18', '2025-12-28 05:38:18', 0, 'Moon Test', 'test@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'Purchase of Moon Security Pro - monthly plan', NULL, NULL, '2025-11-28 05:38:18', NULL, '2025-11-28 05:38:18', '2025-11-28 05:38:18'),
(2, 2, 3, 3, 7, 'TXN-2025-692986D7F3D47', 'purchase', 'completed', '129.99', 'USD', 'stripe', 'pi_3SYPoWFJjDqSry300hncKIfv', 'cus_TVQfY0bolVgnf2', '{\"payment_intent_status\":\"succeeded\",\"payment_method_id\":\"pm_1SYPoUFJjDqSry30YuqAJhA6\"}', 'Moon Backup Pro', 'yearly', '129.99', '0.00', NULL, '744FC5AFBEE4B17F-A515D592387F0A0B', '2025-11-28 05:56:15', '2026-11-28 05:56:15', 0, 'Moon Test', 'test@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'Purchase of Moon Backup Pro - yearly plan', NULL, NULL, '2025-11-28 05:56:15', NULL, '2025-11-28 05:56:16', '2025-11-28 05:56:16'),
(3, 2, 3, 3, 7, 'TXN-2025-692988CC4C681', 'renewal', 'completed', '12.99', 'USD', 'stripe', 'pi_3SYPwbFJjDqSry301m5mqwCB', 'cus_TVQoFEtbEH592t', '{\"payment_intent_status\":\"succeeded\",\"payment_method_id\":\"pm_1SYPwZFJjDqSry30s1ah2aCy\"}', 'Moon Backup Pro', 'monthly', '12.99', '0.00', NULL, '744FC5AFBEE4B17F-A515D592387F0A0B', '2026-11-27 18:30:00', '2026-12-27 18:30:00', 0, 'asdasd', 'test@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'Renewal of Moon Backup Pro - monthly plan', '{\"payment_intent_status\":\"succeeded\",\"renewal_initiated_at\":\"2025-11-28T11:34:36.312826Z\",\"renewal_type\":\"extension\"}', NULL, '2025-11-28 06:04:36', NULL, '2025-11-28 06:04:36', '2025-11-28 06:04:36'),
(4, 3, 4, 4, 6, 'TXN-2025-6929906C041F4', 'purchase', 'completed', '149.99', 'USD', 'stripe', 'pi_3SYQS4FJjDqSry3003l21rjN', 'cus_TVRKuJkPDjLT8s', '{\"payment_intent_status\":\"succeeded\",\"payment_method_id\":\"pm_1SYQS2FJjDqSry30GO3mBtYO\"}', 'Moon Central Pro', 'yearly', '149.99', '0.00', NULL, '975FD31C85850291-F54C2E95829F449C', '2025-11-28 06:37:07', '2026-11-28 06:37:07', 0, 'NDP', 'ndp@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'Purchase of Moon Central Pro - yearly plan', NULL, NULL, '2025-11-28 06:37:08', NULL, '2025-11-28 06:37:08', '2025-11-28 06:37:08'),
(5, 3, 4, 4, 6, 'TXN-2025-69299542A167F', 'renewal', 'completed', '149.99', 'USD', 'stripe', 'pi_3SYQm3FJjDqSry301qaSly07', 'cus_TVRfogiE2IGn4g', '{\"payment_intent_status\":\"succeeded\",\"payment_method_id\":\"pm_1SYQm1FJjDqSry30jgJABxMQ\"}', 'Moon Central Pro', 'yearly', '149.99', '0.00', NULL, '975FD31C85850291-F54C2E95829F449C', '2026-11-27 18:30:00', '2027-11-27 18:30:00', 0, 'NDP', 'ndp@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'Renewal of Moon Central Pro - yearly plan', '{\"payment_intent_status\":\"succeeded\",\"renewal_initiated_at\":\"2025-11-28T12:27:46.661018Z\",\"renewal_type\":\"extension\"}', NULL, '2025-11-28 06:57:46', NULL, '2025-11-28 06:57:46', '2025-11-28 06:57:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `timezone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'UTC',
  `bio` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_notifications` tinyint(1) NOT NULL DEFAULT 1,
  `security_alerts` tinyint(1) NOT NULL DEFAULT 1,
  `marketing_emails` tinyint(1) NOT NULL DEFAULT 0,
  `product_updates` tinyint(1) NOT NULL DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `stripe_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pm_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pm_last_four` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `is_admin`, `email`, `company`, `phone`, `timezone`, `bio`, `website`, `address`, `city`, `state`, `country`, `postal_code`, `linkedin`, `twitter`, `facebook`, `instagram`, `email_notifications`, `security_alerts`, `marketing_emails`, `product_updates`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `stripe_id`, `pm_type`, `pm_last_four`, `trial_ends_at`) VALUES
(1, 'Moon Dev', 1, 'dev@moontechnolabs.com', NULL, NULL, 'UTC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 1, NULL, '$2y$10$jW3NP0M8sAHOzM97b.9z3uPH6iiFmob8kh8JWayiXHvffSm8nfnYC', NULL, '2025-11-28 05:03:09', '2025-11-28 05:22:51', NULL, NULL, NULL, NULL),
(2, 'Moon Test', NULL, 'test@gmail.com', NULL, NULL, 'UTC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 1, NULL, '$2y$10$UUyWnhRX2MwpcfEXs4o2mOuAIfHRLBX2d7pq3.8SZsihreIaFt8jW', NULL, '2025-11-28 05:03:38', '2025-11-28 05:03:38', NULL, NULL, NULL, NULL),
(3, 'NDP', NULL, 'ndp@gmail.com', NULL, NULL, 'UTC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 1, NULL, '$2y$10$cn4RkKjsMEEFva9uouHdoOm5/ImPGwmmRtyv4JiVFdlbhAzcD58iq', NULL, '2025-11-28 06:27:00', '2025-11-28 06:27:00', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activated_sites`
--
ALTER TABLE `activated_sites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `plugin_subscriptions`
--
ALTER TABLE `plugin_subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscriptions_stripe_id_unique` (`stripe_id`),
  ADD KEY `subscriptions_user_id_stripe_status_index` (`user_id`,`stripe_status`);

--
-- Indexes for table `subscription_items`
--
ALTER TABLE `subscription_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscription_items_subscription_id_stripe_price_unique` (`subscription_id`,`stripe_price`),
  ADD UNIQUE KEY `subscription_items_stripe_id_unique` (`stripe_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_stripe_id_index` (`stripe_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activated_sites`
--
ALTER TABLE `activated_sites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `licenses`
--
ALTER TABLE `licenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plugin_subscriptions`
--
ALTER TABLE `plugin_subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `renewal_history`
--
ALTER TABLE `renewal_history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscription_items`
--
ALTER TABLE `subscription_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
