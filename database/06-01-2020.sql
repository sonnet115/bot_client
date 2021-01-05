-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2021 at 09:42 PM
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
-- Database: `bot`
--

-- --------------------------------------------------------

--
-- Table structure for table `auto_replies`
--

CREATE TABLE `auto_replies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_id` smallint(6) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auto_reply_products`
--

CREATE TABLE `auto_reply_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `ar_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `billing_infos`
--

CREATE TABLE `billing_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_id` smallint(6) NOT NULL,
  `prev_billing_date` date DEFAULT NULL,
  `next_billing_date` date DEFAULT NULL,
  `paid_amount` double DEFAULT NULL,
  `payable_amount` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `billing_infos`
--

INSERT INTO `billing_infos` (`id`, `page_id`, `prev_billing_date`, `next_billing_date`, `paid_amount`, `payable_amount`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-12-24', '2020-12-31', 0, 2000, '2020-12-23 19:28:33', '2020-12-23 19:28:33');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(10) UNSIGNED NOT NULL,
  `pid` int(11) NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `customer_fb_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shop_id` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint(20) DEFAULT NULL,
  `shop_id` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`, `shop_id`, `created_at`, `updated_at`) VALUES
(1, 'Category#1', NULL, 2, NULL, NULL),
(2, 'Category#2', NULL, 3, NULL, NULL),
(3, 'SubCategory#1', NULL, 2, NULL, NULL),
(4, 'SubCategory#2', NULL, 3, NULL, NULL),
(5, 'SubSubCat#1', NULL, 3, NULL, NULL),
(6, 'SubSubCat#2', NULL, 3, NULL, NULL),
(7, 'SubSubCat#3', NULL, 2, NULL, NULL),
(8, 'SubSubCat#4', NULL, 2, NULL, '2020-10-20 14:04:42'),
(9, 'SubCat#3', NULL, 2, NULL, '2020-10-20 14:05:20'),
(10, 'Category#3', NULL, 2, NULL, NULL),
(11, 'Men\'s Clothing', NULL, 2, '2020-10-20 13:47:52', '2020-10-20 13:47:52'),
(12, 'Men\'s Clothing', NULL, 1, '2020-12-30 18:57:02', '2020-12-30 18:57:02');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fb_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `app_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_pic` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `fb_id`, `app_id`, `first_name`, `last_name`, `profile_pic`, `contact`, `billing_address`, `shipping_address`, `created_at`, `updated_at`) VALUES
(1, '2723987454293264', '304733696848773', NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-23 20:07:28', '2020-12-23 20:07:28');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_charges`
--

CREATE TABLE `delivery_charges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_charge` double NOT NULL,
  `shop_id` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery_charges`
--

INSERT INTO `delivery_charges` (`id`, `name`, `delivery_charge`, `shop_id`, `created_at`, `updated_at`) VALUES
(1, 'Inside Dhaka', 60, 1, '2020-12-23 19:13:59', '2020-12-23 19:13:59');

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dis_from` date NOT NULL,
  `dis_to` date NOT NULL,
  `pid` int(11) NOT NULL,
  `dis_percentage` double(8,2) NOT NULL DEFAULT 0.00,
  `shop_id` smallint(6) NOT NULL,
  `state` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prefix` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `route_name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` tinyint(4) DEFAULT NULL,
  `shop_id` smallint(6) NOT NULL,
  `state` tinyint(4) NOT NULL DEFAULT 1,
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
(1, '2014_10_12_000000_create_user_role_mappings_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2020_03_02_091514_create_jobs_table', 1),
(6, '2020_03_18_085002_create_customers_table', 1),
(8, '2020_03_23_074602_create_products_table', 1),
(9, '2020_03_23_074623_create_product_images_table', 1),
(10, '2020_03_23_074958_create_cart_table', 1),
(11, '2020_03_23_074958_create_discounts_table', 1),
(12, '2020_03_23_074958_create_pre_orders_table', 1),
(13, '2020_05_24_053816_create_sessions_table', 1),
(14, '2020_06_09_205600_create_roles_table', 1),
(17, '2020_06_12_203036_create_page_tokens_table', 1),
(18, '2020_06_15_124153_create_menus_table', 1),
(19, '2020_06_15_124736_create_role_menu_mappings_table', 1),
(22, '2020_06_12_194245_create_pages_table', 3),
(23, '2020_08_17_233826_create_delivery_charges_table', 4),
(24, '2020_03_19_094454_create_orders_table', 5),
(25, '2020_06_12_194702_create_ordered_products_table', 6),
(26, '2020_06_12_200000_create_billing_info_table', 7),
(27, '2020_06_12_20023_create_payment_info_table', 8),
(29, '2014_10_12_000000_create_users_table', 9),
(30, '2020_03_23_077777_create_requested_pages_table', 10),
(31, '2014_10_12_000000_create_categories_table', 11),
(32, '2014_10_12_000001_create_auto_replies_table', 12),
(33, '2014_10_12_000001_create_auto_reply_products_table', 12),
(34, '2020_08_17_233827_create_variant_table', 13),
(35, '2020_08_17_233829_create_variant_properties_table', 13),
(36, '2020_08_17_2338654_create_product_variant_table', 14);

-- --------------------------------------------------------

--
-- Table structure for table `ordered_products`
--

CREATE TABLE `ordered_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `oid` bigint(20) NOT NULL,
  `pid` int(11) NOT NULL,
  `quantity` smallint(6) NOT NULL,
  `price` int(11) NOT NULL,
  `discount` double NOT NULL DEFAULT 0,
  `additional_product_details` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `customer_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `additional_order_details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_status` tinyint(4) NOT NULL DEFAULT 0,
  `status_updated_by` int(11) DEFAULT NULL,
  `shop_id` smallint(6) NOT NULL,
  `delivery_charge` smallint(6) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Triggers `orders`
--
DELIMITER $$
CREATE TRIGGER `ssss` AFTER INSERT ON `orders` FOR EACH ROW update orders set code='123' where 		      id= NEW.id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `page_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `page_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `page_access_token` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `page_owner_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `page_connected_status` tinyint(1) NOT NULL,
  `page_subscription_status` tinyint(1) NOT NULL DEFAULT 0,
  `page_contact` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page_likes` bigint(20) DEFAULT NULL,
  `is_published` tinyint(1) DEFAULT NULL,
  `is_webhooks_subscribed` tinyint(1) DEFAULT NULL,
  `page_username` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page_address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page_web_link` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `page_name`, `page_id`, `page_access_token`, `page_owner_id`, `page_connected_status`, `page_subscription_status`, `page_contact`, `page_likes`, `is_published`, `is_webhooks_subscribed`, `page_username`, `page_address`, `page_web_link`, `created_at`, `updated_at`) VALUES
(1, 'Testing Pal', '304733696848773', 'EAAPh7vTsNHcBAMgOOqBZCDIaqZCt0XY2ayjJctVRlngbh83QpmfLQDF0YRuaUk5zg8bIZBAOkDAWrzh4csKhuRmFIZBndiQ7b1aaFllxpphXPoJBj050PKWI3IYyZCbiaHZBA4BGAMedM3Eygy6B3f4K6l2dk6HYagKZCGL2tEnf7fKGVk0kHVTAZBTT9kanYjcZD', '1301689713375351', 1, 1, NULL, 4, 1, 1, 'demosgbot', 'taltoal, Dhaka, Dhaka Division, Bangladesh', NULL, '2020-12-23 19:13:59', '2020-12-23 19:28:33');

-- --------------------------------------------------------

--
-- Table structure for table `page_tokens`
--

CREATE TABLE `page_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_token` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `app_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `payment_infos`
--

CREATE TABLE `payment_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_id` smallint(6) DEFAULT NULL,
  `page_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trx_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `served` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pre_orders`
--

CREATE TABLE `pre_orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `pid` int(11) NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `customer_fb_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `additional_product_details` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_id` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` mediumint(9) NOT NULL DEFAULT 0,
  `uom` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double(8,2) NOT NULL,
  `shop_id` smallint(6) NOT NULL,
  `show_in_bot` tinyint(1) NOT NULL DEFAULT 1,
  `state` tinyint(4) NOT NULL DEFAULT 1,
  `category_id` int(11) DEFAULT NULL,
  `variant_combination_ids` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_product_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `code`, `stock`, `uom`, `price`, `shop_id`, `show_in_bot`, `state`, `category_id`, `variant_combination_ids`, `parent_product_id`, `created_at`, `updated_at`) VALUES
(1, 'Tag Heuer', 'TH-2003', -1, 'Pcs', 30000.00, 2, 1, 1, 1, '3_23', NULL, '2020-08-12 19:53:50', '2020-12-23 18:43:20'),
(2, 'Rolex', 'RL-2001', 99, 'Set', 50000.00, 2, 1, 1, 1, NULL, NULL, '2020-08-12 19:54:31', '2020-12-23 18:43:20'),
(3, 'Pakistani Lawn', 'PL-3094', 554, 'Pcs', 2000.00, 2, 0, 1, 1, NULL, NULL, '2020-08-12 19:55:24', '2020-12-23 18:43:20'),
(4, 'Jamdani Saree Red', 'JSR-100', 100, 'Pcs', 3000.00, 2, 1, 1, 9, NULL, NULL, '2020-08-12 19:56:46', '2020-12-23 18:43:20'),
(5, 'T-Shirt', 'TS-677', 598, 'Pcs', 300.00, 2, 0, 1, 2, NULL, NULL, '2020-10-01 17:03:29', '2020-12-23 18:43:20'),
(6, 'Sade Blair', 'Qui', 45, 'Pcs', 911.00, 1, 1, 1, 1, NULL, NULL, '2020-11-23 17:42:33', '2020-12-23 19:52:35'),
(8, 'Sade Blair', 'Optio', 100, 'ss', 1990.00, 1, 1, 1, 12, '23_5', NULL, '2021-01-05 19:19:36', '2021-01-05 19:19:36'),
(9, 'sss', 'Opti', 23, 'Pcs', 30000.00, 1, 1, 1, 12, '23_4_29', NULL, '2021-01-05 19:20:14', '2021-01-05 19:20:14');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pid` int(11) NOT NULL,
  `image_url` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `pid`, `image_url`, `created_at`, `updated_at`) VALUES
(1, 1, 'Chat_Bot_BD/TH-2003_1.jpeg', '2020-08-12 19:53:50', '2020-08-12 19:53:50'),
(2, 1, 'Chat_Bot_BD/TH-2003_2.jpeg', '2020-08-12 19:53:50', '2020-08-12 19:53:50'),
(3, 2, 'Chat_Bot_BD/RL-2001_1.jpeg', '2020-08-12 19:54:31', '2020-08-12 19:54:31'),
(4, 3, 'Chat_Bot_BD/PL-3094_1.png', '2020-08-12 19:55:24', '2020-08-12 19:55:24'),
(5, 4, 'Test_bot/JSR-100_1.jpeg', '2020-08-12 19:56:46', '2020-08-12 19:56:46'),
(6, 3, 'Test_bot/PL-3094_2.jpeg', '2020-08-12 20:21:28', '2020-08-12 20:21:28'),
(7, 5, 'Test_bot/TS-677_1.jpeg', '2020-10-01 17:03:29', '2020-10-01 17:03:29'),
(8, 6, 'Chat_Bot_BD/Qui_1.png', '2020-11-23 17:42:33', '2020-11-23 17:42:33'),
(9, 6, 'Chat_Bot_BD/Qui_2.jpeg', '2020-11-23 17:42:33', '2020-11-23 17:42:33');

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
--

CREATE TABLE `product_variants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `variant_id` bigint(20) NOT NULL,
  `variant_property_ids` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_variants`
--

INSERT INTO `product_variants` (`id`, `variant_id`, `variant_property_ids`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 1, '23', 8, '2021-01-05 19:19:36', '2021-01-05 19:19:36'),
(2, 3, '5', 8, '2021-01-05 19:19:36', '2021-01-05 19:19:36'),
(3, 1, '24', 9, '2021-01-05 19:20:14', '2021-01-05 19:20:14'),
(4, 3, '4', 9, '2021-01-05 19:20:14', '2021-01-05 19:20:14'),
(5, 5, '29', 9, '2021-01-05 19:20:14', '2021-01-05 19:20:14');

-- --------------------------------------------------------

--
-- Table structure for table `requested_pages`
--

CREATE TABLE `requested_pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `page_id` smallint(6) NOT NULL,
  `user_id` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `requested_pages`
--

INSERT INTO `requested_pages` (`id`, `page_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2020-12-23 19:22:40', '2020-12-23 19:22:40');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shop_id` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_menu_mappings`
--

CREATE TABLE `role_menu_mappings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) NOT NULL,
  `role_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_picture` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page_added` tinyint(1) NOT NULL DEFAULT 0,
  `profile_completed` tinyint(1) NOT NULL DEFAULT 0,
  `long_lived_user_token` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trial_status` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `provider`, `user_id`, `profile_picture`, `contact`, `page_added`, `profile_completed`, `long_lived_user_token`, `trial_status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Mehedi Hasan Sonnet', 'sonnet36biz@gmail.com', 'facebook', '1301689713375351', 'https://graph.facebook.com/v8.0/1301689713375351/picture?type=normal', '+8801707725787', 1, 2, 'EAAPh7vTsNHcBAAWLmD8MNR5UcN6fVGUnU84cWZAw0oowvUTn5YEIkABZB53a86IIpOv4TFPvWfEiLrfQFD3lEoNy9lRMq8eax9iGGbw66YBm8DlaR5AXZB4hfjmpZBcoZBJkQa9XlQPRsKectsq2Gxh8mKTRE8QbjkXzNZC9niNdPDGjtp4GXS', 0, 'Q1wKtQvHiAvCUHti7yFFL5uAgfhDvpoOaDcFpjO1oDNuwhXmZOHwefeYN4Rm', '2020-12-23 19:07:58', '2020-12-23 19:28:33');

-- --------------------------------------------------------

--
-- Table structure for table `user_role_mappings`
--

CREATE TABLE `user_role_mappings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `role_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `variants`
--

CREATE TABLE `variants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `variants`
--

INSERT INTO `variants` (`id`, `name`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Size', 1, '2020-12-27 18:59:26', '2020-12-27 18:59:26'),
(3, 'Color', 1, '2020-12-27 19:07:47', '2020-12-27 19:07:47'),
(5, 'Other', 1, '2021-01-05 18:43:55', '2021-01-05 18:43:55');

-- --------------------------------------------------------

--
-- Table structure for table `variant_properties`
--

CREATE TABLE `variant_properties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vid` bigint(20) NOT NULL,
  `property_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `variant_properties`
--

INSERT INTO `variant_properties` (`id`, `vid`, `property_name`, `description`, `created_at`, `updated_at`) VALUES
(3, 3, 'Red', NULL, '2020-12-27 19:07:47', '2020-12-27 19:07:47'),
(4, 3, 'Black', NULL, '2020-12-27 19:07:47', '2020-12-27 19:07:47'),
(5, 3, 'Blue', NULL, '2020-12-27 19:07:47', '2020-12-27 19:07:47'),
(6, 3, 'Navy Blue', NULL, '2020-12-27 19:07:47', '2020-12-27 19:07:47'),
(18, 4, 'Robin Goff', NULL, '2020-12-29 16:44:26', '2020-12-29 16:44:26'),
(23, 1, 'L', '15cm', '2020-12-29 17:38:15', '2020-12-29 17:38:15'),
(24, 1, 'M', '10cm', '2020-12-29 17:38:15', '2020-12-29 17:38:15'),
(25, 1, 'S', '7cm', '2020-12-29 17:38:15', '2020-12-30 17:43:25'),
(26, 1, 'XL', '20cm', '2020-12-30 17:43:25', '2020-12-30 17:43:25'),
(27, 3, 'Pink', NULL, '2020-12-30 18:58:18', '2020-12-30 18:58:18'),
(28, 5, 'O-1', '10', '2021-01-05 18:43:55', '2021-01-05 18:43:55'),
(29, 5, 'O-2', '20', '2021-01-05 18:43:55', '2021-01-05 18:43:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auto_replies`
--
ALTER TABLE `auto_replies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auto_reply_products`
--
ALTER TABLE `auto_reply_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billing_infos`
--
ALTER TABLE `billing_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_charges`
--
ALTER TABLE `delivery_charges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordered_products`
--
ALTER TABLE `ordered_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_tokens`
--
ALTER TABLE `page_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_infos`
--
ALTER TABLE `payment_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pre_orders`
--
ALTER TABLE `pre_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requested_pages`
--
ALTER TABLE `requested_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_menu_mappings`
--
ALTER TABLE `role_menu_mappings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD UNIQUE KEY `sessions_id_unique` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_user_id_unique` (`user_id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_role_mappings`
--
ALTER TABLE `user_role_mappings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `variants`
--
ALTER TABLE `variants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `variant_properties`
--
ALTER TABLE `variant_properties`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auto_replies`
--
ALTER TABLE `auto_replies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auto_reply_products`
--
ALTER TABLE `auto_reply_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `billing_infos`
--
ALTER TABLE `billing_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `delivery_charges`
--
ALTER TABLE `delivery_charges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=285;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `ordered_products`
--
ALTER TABLE `ordered_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `page_tokens`
--
ALTER TABLE `page_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_infos`
--
ALTER TABLE `payment_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pre_orders`
--
ALTER TABLE `pre_orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `requested_pages`
--
ALTER TABLE `requested_pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role_menu_mappings`
--
ALTER TABLE `role_menu_mappings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_role_mappings`
--
ALTER TABLE `user_role_mappings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `variants`
--
ALTER TABLE `variants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `variant_properties`
--
ALTER TABLE `variant_properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
