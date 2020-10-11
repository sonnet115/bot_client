-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2020 at 02:19 PM
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
-- Database: `bot`
--

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
  `trial_status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `billing_infos`
--

INSERT INTO `billing_infos` (`id`, `page_id`, `prev_billing_date`, `next_billing_date`, `paid_amount`, `payable_amount`, `trial_status`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-10-10', '2020-11-10', 2000, 1000, 1, '2020-10-03 19:06:19', '2020-10-03 19:06:19'),
(2, 2, '2020-10-04', '2020-10-14', 0, 2000, 0, '2020-10-03 20:19:14', '2020-10-03 20:19:14'),
(3, 3, '2020-10-04', '2020-10-14', 0, 2000, 0, '2020-10-03 20:19:17', '2020-10-03 20:19:17'),
(9, 1, '2020-10-10', '2020-10-20', 0, 2000, NULL, '2020-10-10 15:41:00', '2020-10-10 15:41:00'),
(10, 2, '2020-10-10', '2020-10-20', 0, 2000, NULL, '2020-10-10 15:41:00', '2020-10-10 15:41:00'),
(11, 3, '2020-10-10', '2020-10-20', 0, 2000, NULL, '2020-10-10 15:41:01', '2020-10-10 15:41:01'),
(12, 1, '2020-10-10', '2020-10-20', 0, 2000, NULL, '2020-10-10 16:04:16', '2020-10-10 16:04:16'),
(13, 2, '2020-10-10', '2020-10-20', 0, 2000, NULL, '2020-10-10 16:04:17', '2020-10-10 16:04:17'),
(14, 3, '2020-10-10', '2020-10-20', 0, 2000, NULL, '2020-10-10 16:04:17', '2020-10-10 16:04:17'),
(15, 4, '2020-10-11', '2020-10-21', 0, 2000, NULL, '2020-10-11 09:31:26', '2020-10-11 09:31:26');

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

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `pid`, `customer_id`, `customer_fb_id`, `shop_id`, `created_at`, `updated_at`) VALUES
(17, 1, 1, '2723987454293264', 1, '2020-09-17 09:23:43', '2020-09-17 09:23:43');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fb_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `app_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(1, '2723987454293264', '304733696848773', 'Mehedi', 'Sonet', 'https://platform-lookaside.fbsbx.com/platform/profilepic/?psid=2723987454293264&width=1024&ext=1600365026&hash=AeSAU7NpkIuzcfec', '+8801707725787', 'Mollapara, Taltola, West Agargaon, Dhaka', 'Mollapara, Taltola, West Agargaon, Dhaka', '2020-08-18 17:50:26', '2020-09-17 07:48:01'),
(2, '2624477377673422', '113382016754105', 'Mehedi Hasan', 'Sonnet', 'https://platform-lookaside.fbsbx.com/platform/profilepic/?psid=2624477377673422&width=1024&ext=1600366969&hash=AeT_BNeKXG2m86jl', NULL, NULL, NULL, '2020-08-18 18:22:49', '2020-08-18 18:22:49'),
(3, '3413721062007626', '102396781628833', 'Mehedi Hasan', 'Sonnet', 'https://platform-lookaside.fbsbx.com/platform/profilepic/?psid=3413721062007626&width=1024&ext=1604732879&hash=AeTCL_4hxhZKVT3XOIM', NULL, NULL, NULL, '2020-10-08 07:07:57', '2020-10-08 07:07:57');

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
(1, 'Inside Dhaka', 60, 1, '2020-08-17 18:20:13', '2020-08-17 18:43:43'),
(2, 'Outside Dhaka', 100, 1, '2020-08-17 18:20:48', '2020-08-17 18:20:48'),
(3, 'Inside Dhaka', 70, 2, '2020-10-01 18:04:39', '2020-10-01 18:04:59');

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

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id`, `name`, `dis_from`, `dis_to`, `pid`, `dis_percentage`, `shop_id`, `state`, `created_at`, `updated_at`) VALUES
(1, 'Danielle Wilson', '2020-08-14', '2020-08-20', 1, 15.00, 1, 1, '2020-08-13 19:34:01', '2020-08-13 20:34:10'),
(2, 'October Sales', '2020-10-01', '2020-10-10', 1, 7.00, 1, 1, '2020-10-01 17:26:54', '2020-10-01 17:26:54'),
(3, 'November Sales', '2020-11-01', '2020-11-10', 4, 15.00, 2, 1, '2020-10-01 17:27:46', '2020-10-01 17:27:46');

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

--
-- Dumping data for table `failed_jobs`
--

INSERT INTO `failed_jobs` (`id`, `connection`, `queue`, `payload`, `exception`, `failed_at`) VALUES
(1, 'database', 'default', '{\"displayName\":\"App\\\\Jobs\\\\Bot\\\\BotHandler\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\Bot\\\\BotHandler\",\"command\":\"O:23:\\\"App\\\\Jobs\\\\Bot\\\\BotHandler\\\":10:{s:34:\\\"\\u0000App\\\\Jobs\\\\Bot\\\\BotHandler\\u0000messaging\\\";O:25:\\\"App\\\\Bot\\\\Webhook\\\\Messaging\\\":6:{s:35:\\\"\\u0000App\\\\Bot\\\\Webhook\\\\Messaging\\u0000senderId\\\";s:16:\\\"3413721062007626\\\";s:38:\\\"\\u0000App\\\\Bot\\\\Webhook\\\\Messaging\\u0000recipientId\\\";s:15:\\\"102396781628833\\\";s:36:\\\"\\u0000App\\\\Bot\\\\Webhook\\\\Messaging\\u0000timestamp\\\";i:1602268730474;s:34:\\\"\\u0000App\\\\Bot\\\\Webhook\\\\Messaging\\u0000message\\\";N;s:31:\\\"\\u0000App\\\\Bot\\\\Webhook\\\\Messaging\\u0000type\\\";s:8:\\\"postback\\\";s:35:\\\"\\u0000App\\\\Bot\\\\Webhook\\\\Messaging\\u0000postback\\\";O:24:\\\"App\\\\Bot\\\\Webhook\\\\Postback\\\":2:{s:31:\\\"\\u0000App\\\\Bot\\\\Webhook\\\\Postback\\u0000title\\\";s:9:\\\"View Cart\\\";s:33:\\\"\\u0000App\\\\Bot\\\\Webhook\\\\Postback\\u0000payload\\\";s:9:\\\"VIEW_CART\\\";}}s:35:\\\"\\u0000App\\\\Jobs\\\\Bot\\\\BotHandler\\u0000page_token\\\";s:200:\\\"EAANvprl4bdEBAJZBNwrFtyKDwp2fDTZCLxvdFUG5mkW7PZC91tGLk2nxwXEqHJeDid0UiNQvon3eYeEqL5ZBwFZB1qnjazlTavnmkyq0fRGhxrQZCpYb4ItDa8p2gqb5FoNEIuKT55doZBzccdSNteXKEQPZAWxNFjwQzKuiuXLs8siXZC6lKNdI2EkNkZCVJytPMZD\\\";s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Illuminate\\Queue\\MaxAttemptsExceededException: App\\Jobs\\Bot\\BotHandler has been attempted too many times or run too long. The job may have previously timed out. in F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php:632\nStack trace:\n#0 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(446): Illuminate\\Queue\\Worker->maxAttemptsExceededException(Object(Illuminate\\Queue\\Jobs\\DatabaseJob))\n#1 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(358): Illuminate\\Queue\\Worker->markJobAsFailedIfAlreadyExceedsMaxAttempts(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), 1)\n#2 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(314): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#3 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(267): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#4 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(112): Illuminate\\Queue\\Worker->runNextJob(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#5 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(96): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#6 [internal function]: Illuminate\\Queue\\Console\\WorkCommand->handle()\n#7 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(32): call_user_func_array(Array, Array)\n#8 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#9 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(90): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#10 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(34): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#11 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(590): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#12 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(134): Illuminate\\Container\\Container->call(Array)\n#13 F:\\xampp\\htdocs\\Bot\\vendor\\symfony\\console\\Command\\Command.php(255): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#14 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(121): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#15 F:\\xampp\\htdocs\\Bot\\vendor\\symfony\\console\\Application.php(1009): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#16 F:\\xampp\\htdocs\\Bot\\vendor\\symfony\\console\\Application.php(273): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#17 F:\\xampp\\htdocs\\Bot\\vendor\\symfony\\console\\Application.php(149): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#18 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Application.php(93): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#19 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(131): Illuminate\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#20 F:\\xampp\\htdocs\\Bot\\artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#21 {main}', '2020-10-09 18:41:28'),
(2, 'database', 'default', '{\"displayName\":\"App\\\\Jobs\\\\Bot\\\\BotHandler\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\Bot\\\\BotHandler\",\"command\":\"O:23:\\\"App\\\\Jobs\\\\Bot\\\\BotHandler\\\":10:{s:34:\\\"\\u0000App\\\\Jobs\\\\Bot\\\\BotHandler\\u0000messaging\\\";O:25:\\\"App\\\\Bot\\\\Webhook\\\\Messaging\\\":6:{s:35:\\\"\\u0000App\\\\Bot\\\\Webhook\\\\Messaging\\u0000senderId\\\";s:16:\\\"3413721062007626\\\";s:38:\\\"\\u0000App\\\\Bot\\\\Webhook\\\\Messaging\\u0000recipientId\\\";s:15:\\\"102396781628833\\\";s:36:\\\"\\u0000App\\\\Bot\\\\Webhook\\\\Messaging\\u0000timestamp\\\";i:1602268759840;s:34:\\\"\\u0000App\\\\Bot\\\\Webhook\\\\Messaging\\u0000message\\\";N;s:31:\\\"\\u0000App\\\\Bot\\\\Webhook\\\\Messaging\\u0000type\\\";s:8:\\\"postback\\\";s:35:\\\"\\u0000App\\\\Bot\\\\Webhook\\\\Messaging\\u0000postback\\\";O:24:\\\"App\\\\Bot\\\\Webhook\\\\Postback\\\":2:{s:31:\\\"\\u0000App\\\\Bot\\\\Webhook\\\\Postback\\u0000title\\\";s:14:\\\"Search Product\\\";s:33:\\\"\\u0000App\\\\Bot\\\\Webhook\\\\Postback\\u0000payload\\\";s:14:\\\"PRODUCT_SEARCH\\\";}}s:35:\\\"\\u0000App\\\\Jobs\\\\Bot\\\\BotHandler\\u0000page_token\\\";s:200:\\\"EAANvprl4bdEBAJZBNwrFtyKDwp2fDTZCLxvdFUG5mkW7PZC91tGLk2nxwXEqHJeDid0UiNQvon3eYeEqL5ZBwFZB1qnjazlTavnmkyq0fRGhxrQZCpYb4ItDa8p2gqb5FoNEIuKT55doZBzccdSNteXKEQPZAWxNFjwQzKuiuXLs8siXZC6lKNdI2EkNkZCVJytPMZD\\\";s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Illuminate\\Queue\\MaxAttemptsExceededException: App\\Jobs\\Bot\\BotHandler has been attempted too many times or run too long. The job may have previously timed out. in F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php:632\nStack trace:\n#0 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(446): Illuminate\\Queue\\Worker->maxAttemptsExceededException(Object(Illuminate\\Queue\\Jobs\\DatabaseJob))\n#1 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(358): Illuminate\\Queue\\Worker->markJobAsFailedIfAlreadyExceedsMaxAttempts(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), 1)\n#2 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(314): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#3 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(267): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#4 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(112): Illuminate\\Queue\\Worker->runNextJob(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#5 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(96): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#6 [internal function]: Illuminate\\Queue\\Console\\WorkCommand->handle()\n#7 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(32): call_user_func_array(Array, Array)\n#8 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#9 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(90): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#10 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(34): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#11 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(590): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#12 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(134): Illuminate\\Container\\Container->call(Array)\n#13 F:\\xampp\\htdocs\\Bot\\vendor\\symfony\\console\\Command\\Command.php(255): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#14 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(121): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#15 F:\\xampp\\htdocs\\Bot\\vendor\\symfony\\console\\Application.php(1009): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#16 F:\\xampp\\htdocs\\Bot\\vendor\\symfony\\console\\Application.php(273): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#17 F:\\xampp\\htdocs\\Bot\\vendor\\symfony\\console\\Application.php(149): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#18 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Application.php(93): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#19 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(131): Illuminate\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#20 F:\\xampp\\htdocs\\Bot\\artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#21 {main}', '2020-10-09 18:41:29'),
(3, 'database', 'default', '{\"displayName\":\"App\\\\Jobs\\\\Bot\\\\BotHandler\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\Bot\\\\BotHandler\",\"command\":\"O:23:\\\"App\\\\Jobs\\\\Bot\\\\BotHandler\\\":10:{s:34:\\\"\\u0000App\\\\Jobs\\\\Bot\\\\BotHandler\\u0000messaging\\\";O:25:\\\"App\\\\Bot\\\\Webhook\\\\Messaging\\\":6:{s:35:\\\"\\u0000App\\\\Bot\\\\Webhook\\\\Messaging\\u0000senderId\\\";s:16:\\\"3413721062007626\\\";s:38:\\\"\\u0000App\\\\Bot\\\\Webhook\\\\Messaging\\u0000recipientId\\\";s:15:\\\"102396781628833\\\";s:36:\\\"\\u0000App\\\\Bot\\\\Webhook\\\\Messaging\\u0000timestamp\\\";i:1602268927293;s:34:\\\"\\u0000App\\\\Bot\\\\Webhook\\\\Messaging\\u0000message\\\";N;s:31:\\\"\\u0000App\\\\Bot\\\\Webhook\\\\Messaging\\u0000type\\\";s:8:\\\"postback\\\";s:35:\\\"\\u0000App\\\\Bot\\\\Webhook\\\\Messaging\\u0000postback\\\";O:24:\\\"App\\\\Bot\\\\Webhook\\\\Postback\\\":2:{s:31:\\\"\\u0000App\\\\Bot\\\\Webhook\\\\Postback\\u0000title\\\";s:14:\\\"Search Product\\\";s:33:\\\"\\u0000App\\\\Bot\\\\Webhook\\\\Postback\\u0000payload\\\";s:14:\\\"PRODUCT_SEARCH\\\";}}s:35:\\\"\\u0000App\\\\Jobs\\\\Bot\\\\BotHandler\\u0000page_token\\\";s:200:\\\"EAANvprl4bdEBAJZBNwrFtyKDwp2fDTZCLxvdFUG5mkW7PZC91tGLk2nxwXEqHJeDid0UiNQvon3eYeEqL5ZBwFZB1qnjazlTavnmkyq0fRGhxrQZCpYb4ItDa8p2gqb5FoNEIuKT55doZBzccdSNteXKEQPZAWxNFjwQzKuiuXLs8siXZC6lKNdI2EkNkZCVJytPMZD\\\";s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Illuminate\\Queue\\MaxAttemptsExceededException: App\\Jobs\\Bot\\BotHandler has been attempted too many times or run too long. The job may have previously timed out. in F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php:632\nStack trace:\n#0 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(446): Illuminate\\Queue\\Worker->maxAttemptsExceededException(Object(Illuminate\\Queue\\Jobs\\DatabaseJob))\n#1 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(358): Illuminate\\Queue\\Worker->markJobAsFailedIfAlreadyExceedsMaxAttempts(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), 1)\n#2 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(314): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#3 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(267): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#4 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(112): Illuminate\\Queue\\Worker->runNextJob(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#5 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(96): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#6 [internal function]: Illuminate\\Queue\\Console\\WorkCommand->handle()\n#7 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(32): call_user_func_array(Array, Array)\n#8 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#9 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(90): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#10 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(34): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#11 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(590): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#12 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(134): Illuminate\\Container\\Container->call(Array)\n#13 F:\\xampp\\htdocs\\Bot\\vendor\\symfony\\console\\Command\\Command.php(255): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#14 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(121): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#15 F:\\xampp\\htdocs\\Bot\\vendor\\symfony\\console\\Application.php(1009): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#16 F:\\xampp\\htdocs\\Bot\\vendor\\symfony\\console\\Application.php(273): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#17 F:\\xampp\\htdocs\\Bot\\vendor\\symfony\\console\\Application.php(149): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#18 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Application.php(93): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#19 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(131): Illuminate\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#20 F:\\xampp\\htdocs\\Bot\\artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#21 {main}', '2020-10-09 18:43:37');

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
(29, '2014_10_12_000000_create_users_table', 9);

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
  `product_status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ordered_products`
--

INSERT INTO `ordered_products` (`id`, `oid`, `pid`, `quantity`, `price`, `discount`, `additional_product_details`, `product_status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 30000, 1000, NULL, 2, '2020-09-17 08:41:37', '2020-09-29 11:19:07'),
(2, 1, 3, 1, 2000, 0, NULL, 2, '2020-09-17 08:41:37', '2020-10-01 17:36:54'),
(3, 2, 1, 1, 30000, 0, NULL, 3, '2020-09-17 09:13:53', '2020-10-01 17:48:30'),
(4, 2, 3, 2, 2000, 0, NULL, 1, '2020-09-17 09:13:53', '2020-09-29 11:06:59'),
(5, 3, 1, 1, 30000, 0, NULL, 1, '2020-09-17 09:17:51', '2020-09-17 09:17:51'),
(6, 3, 3, 1, 2000, 0, NULL, 1, '2020-09-17 09:17:51', '2020-09-17 09:17:51'),
(7, 4, 1, 1, 30000, 0, NULL, 0, '2020-09-17 09:20:40', '2020-09-29 10:21:27'),
(8, 4, 3, 1, 2000, 0, NULL, 0, '2020-09-17 09:20:40', '2020-09-29 10:21:34'),
(9, 5, 1, 1, 30000, 0, NULL, 0, '2020-09-17 09:27:01', '2020-09-29 10:20:57'),
(10, 5, 3, 1, 2000, 0, NULL, 0, '2020-09-17 09:27:01', '2020-09-29 10:20:59'),
(11, 6, 1, 1, 30000, 0, NULL, 1, '2020-09-17 10:07:36', '2020-09-17 10:07:36'),
(12, 6, 3, 1, 2000, 0, NULL, 1, '2020-09-17 10:07:36', '2020-09-17 10:07:36'),
(13, 7, 1, 1, 30000, 0, NULL, 1, '2020-09-17 10:09:34', '2020-09-17 10:09:34'),
(14, 7, 3, 1, 2000, 0, NULL, 1, '2020-09-17 10:09:34', '2020-09-17 10:09:34'),
(15, 8, 1, 1, 30000, 0, NULL, 1, '2020-09-17 10:11:59', '2020-09-17 10:11:59'),
(16, 8, 3, 1, 2000, 0, NULL, 1, '2020-09-17 10:11:59', '2020-09-17 10:11:59'),
(17, 9, 1, 1, 30000, 0, NULL, 1, '2020-09-17 10:17:40', '2020-09-17 10:17:40'),
(18, 9, 3, 1, 2000, 0, NULL, 1, '2020-09-17 10:17:40', '2020-09-17 10:17:40'),
(19, 10, 1, 5, 30000, 0, NULL, 1, '2020-09-17 10:25:04', '2020-09-17 10:25:04'),
(20, 10, 3, 3, 2000, 0, NULL, 1, '2020-09-17 10:25:04', '2020-09-17 10:25:04'),
(21, 11, 1, 1, 30000, 2100, NULL, 0, '2020-10-08 07:09:59', '2020-10-08 07:09:59');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `customer_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `code`, `customer_id`, `customer_name`, `billing_address`, `shipping_address`, `contact`, `additional_order_details`, `order_status`, `status_updated_by`, `shop_id`, `delivery_charge`, `created_at`, `updated_at`) VALUES
(1, '1600332097_13712', 1, 'Mehedi Sonet', 'Mollapara, Taltola, West Agargaon, Dhaka', 'Mollapara, Taltola, West Agargaon, Dhaka', '+8801707725787', NULL, 1, 1, 1, 60, '2020-09-01 08:41:37', '2020-10-07 04:37:34'),
(2, '1600334033_41454', 1, 'Mehedi Sonet', 'Mollapara, Taltola, West Agargaon, Dhaka', 'Mollapara, Taltola, West Agargaon, Dhaka', '+8801707725787', NULL, 0, 1, 1, 100, '2020-09-05 09:13:53', '2020-09-28 12:28:17'),
(3, '1600334271_83317', 1, 'Mehedi Sonet', 'Mollapara, Taltola, West Agargaon, Dhaka', 'Mollapara, Taltola, West Agargaon, Dhaka', '+8801707725787', NULL, 1, 1, 2, 60, '2020-09-03 09:17:51', '2020-10-01 17:48:15'),
(4, '1600334440_71678', 1, 'Mehedi Sonet', 'Mollapara, Taltola, West Agargaon, Dhaka', 'Mollapara, Taltola, West Agargaon, Dhaka', '+8801707725787', NULL, 2, 1, 2, 60, '2020-09-07 09:20:40', '2020-10-01 17:48:06'),
(5, '1600334820_62393', 1, 'Mehedi Sonet', 'Mollapara, Taltola, West Agargaon, Dhaka', 'Mollapara, Taltola, West Agargaon, Dhaka', '+8801707725787', NULL, 2, 1, 1, 60, '2020-09-10 09:27:00', '2020-09-28 12:28:29'),
(6, '1600337256_34966', 1, 'Mehedi Sonet', 'Mollapara, Taltola, West Agargaon, Dhaka', 'Mollapara, Taltola, West Agargaon, Dhaka', '+8801707725787', NULL, 4, 1, 3, 60, '2020-10-01 10:07:36', '2020-10-07 04:56:00'),
(7, '1600337374_63325', 1, 'Mehedi Sonet', 'Mollapara, Taltola, West Agargaon, Dhaka', 'Mollapara, Taltola, West Agargaon, Dhaka', '+8801707725787', NULL, 3, 1, 1, 60, '2020-10-05 10:09:34', '2020-10-07 04:55:57'),
(8, '1600337519_42036', 1, 'Mehedi Sonet', 'Mollapara, Taltola, West Agargaon, Dhaka', 'Mollapara, Taltola, West Agargaon, Dhaka', '+8801707725787', NULL, 4, 1, 3, 60, '2020-10-06 10:11:59', '2020-10-07 04:55:56'),
(9, '1600337860_50691', 1, 'Mehedi Sonet', 'Mollapara, Taltola, West Agargaon, Dhaka', 'Mollapara, Taltola, West Agargaon, Dhaka', '+8801707725787', NULL, 3, 1, 2, 60, '2020-09-30 10:17:40', '2020-10-07 04:56:01'),
(10, '1600338304_57214', 1, 'Mehedi Sonet', 'Mollapara, Taltola, West Agargaon, Dhaka', 'Mollapara, Taltola, West Agargaon, Dhaka', '+8801707725787', NULL, 1, 1, 1, 100, '2020-09-07 10:25:04', '2020-10-01 17:38:44'),
(11, '1602140999_88785', 1, 'Mehedi Sonet', 'Mollapara, Taltola, West Agargaon, Dhaka', 'Mollapara, Taltola, West Agargaon, Dhaka', '+8801707725787', NULL, 0, NULL, 2, 70, '2020-10-08 07:09:59', '2020-10-08 07:09:59');

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
(1, 'হকার টেকনোলজিস', '102396781628833', 'EAANvprl4bdEBAHT5jv7Li1Eivfg8fboq24Wjw51cpPBAEeFZCCI5ZCNZCYcZC1n2XVH0vXhH8ImyLpnrn1ZCd1ZBLGrIUYJGfNYTLnnZAYEqghOaf2hKtw2viIXrHORtAmQ8aNeflTIeAfm7VfvcZCSVGZCLrPgFIejZCN7DN9Kce1xKMEpdIlJTvkuZBHO97GZB5yAZD', '1433986483479006', 1, 1, '+8801608435599', 0, 1, 1, 'howkar.bd', '107/1, West Kafrul, Sher-e-Bangla Nagar, Dhaka, 1206', 'https://howkar.com/', '2020-10-10 16:04:16', '2020-10-11 11:58:36'),
(2, 'Chat Bot BD', '113382016754105', 'EAANvprl4bdEBALldBkyZC4ZCUxpcYchZAzdZCzqvOnUx63u179ZCHKnlBCkXuiCjZBZC6GHRzkfGFYvocaZCtZABJdo1D6Ve0ZAR7UBX2CZAwir1ueNHOAj6FtW5rTZC0pV5RdZC1ZAMmhkExClawIe5RoaZBIPxSjE5MCrIyOl7NW6bOpr4YoLeOcI9ZCstKrlKl2xI8ZBoZD', '1433986483479006', 1, 1, '+8801686244926', 73, 0, 1, 'CBotBD', 'Taltola, West Agargaon, Dhaka, 1207 Dhaka, Dhaka Division, Bangladesh', NULL, '2020-10-10 16:04:16', '2020-10-11 11:58:40'),
(3, 'Test bot', '304733696848773', 'EAANvprl4bdEBABeed5zmZAzHvAZC6GBZADugi4COEEfHOq2m8wJR83S9VC0Fzzh4FHhZChDnuoZAVIJzFGEjqbXrZBgccCLkwgURBGzZBZCu3KjlWZCCwaBuhJOA0hCT9xVZCeQIElKTJoUTmelixdvT3lUNPNsW8AZBWbb6duVoA2y9X4mtbomgLUIpt3s8reKqcwZD', '1433986483479006', 1, 1, '+8801686244925', 2, 1, 1, 'demosgbot', 'taltoal, Dhaka, Dhaka Division, Bangladesh', NULL, '2020-10-10 16:04:17', '2020-10-11 11:58:44'),
(4, 'Fusion Closet BD', '1769989713323411', 'EAANvprl4bdEBAJfXF9Q01JM0Yk8Eo5oMR1eZBM2rjuyNWCsnsZAj5ikIqjsVzUka4diguwYxtGb7Fu1O3GC0KHGOlviyJEHRwYDuW7WxNcBkMVkGlt6HZC5fyxt1dXQUl6kvxvv8O7iMWpIhjF7XcreakiVE1zoP0jr0FnSmqBo3H2T8u4qPOuvDj2JCRIZD', '1433986483479006', 0, 1, NULL, 0, 0, 1, NULL, NULL, 'www.fusioncloset.com', '2020-10-11 09:31:26', '2020-10-11 11:58:35');

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
  `month` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trx_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_infos`
--

INSERT INTO `payment_infos` (`id`, `page_id`, `page_name`, `month`, `trx_id`, `created_at`, `updated_at`) VALUES
(1, NULL, 'হকার টেকনোলজিস', 'October', 'Rtsgsfshbajksbjkab2123123234', '2020-10-08 04:58:52', '2020-10-08 04:58:52'),
(2, NULL, 'হকার টেকনোলজিস', 'Month', 'sdbahbdjkasbd', '2020-10-08 05:02:07', '2020-10-08 05:02:07'),
(3, NULL, 'Chat Bot BD', 'dfsdfsdf', 'sdfsdf', '2020-10-08 05:02:22', '2020-10-08 05:02:22'),
(4, NULL, 'Chat Bot BD', 'dfsdfsdf', 'sdfsdf', '2020-10-08 05:03:29', '2020-10-08 05:03:29'),
(5, NULL, 'Chat Bot BD', 'Month', 'sdbahbdjkasbd', '2020-10-08 05:03:44', '2020-10-08 05:03:44'),
(6, NULL, 'Chat Bot BD', 'Month', 'asdfsdf', '2020-10-08 05:06:25', '2020-10-08 05:06:25');

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
  `state` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `code`, `stock`, `uom`, `price`, `shop_id`, `state`, `created_at`, `updated_at`) VALUES
(1, 'Tag Heuer', 'TH-2003', 84, 'Pcs', 30000.00, 2, 1, '2020-08-12 19:53:50', '2020-10-08 07:09:59'),
(2, 'Rolex', 'RL-2001', 100, 'Set', 50000.00, 1, 0, '2020-08-12 19:54:31', '2020-10-01 17:11:10'),
(3, 'Pakistani Lawn', 'PL-3094', 555, 'Pcs', 2000.00, 2, 1, '2020-08-12 19:55:24', '2020-09-17 10:25:04'),
(4, 'Jamdani Saree Red', 'JSR-100', 100, 'Pcs', 3000.00, 2, 1, '2020-08-12 19:56:46', '2020-08-18 18:22:25'),
(5, 'T-Shirt', 'TS-677', 600, 'Pcs', 300.00, 1, 1, '2020-10-01 17:03:29', '2020-10-01 17:03:29');

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
(7, 5, 'Test_bot/TS-677_1.jpeg', '2020-10-01 17:03:29', '2020-10-01 17:03:29');

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
  `remember_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `provider`, `user_id`, `profile_picture`, `contact`, `page_added`, `profile_completed`, `long_lived_user_token`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Mehedi Hasan Sonnet', 'sonnetfacebook@gmail.com', 'facebook', '1433986483479006', 'https://graph.facebook.com/v8.0/1433986483479006/picture?type=normal', NULL, 1, 0, 'EAANvprl4bdEBALqTYs6fGkZA2cx2pe3c5h1sLfs7pxEQmeHQrhipihA8e7BoehZCJJQHEVUQoUE6P6zgg9ZCPlxNa4VSJgl15F8i6S9sPUEk0G0o33lxzIpB8k5iMukT57ZBZCIHEZBQJOVD3tmm13fPROT1tabsdITeGqL2DvEWyDhnM9JI5r', NULL, '2020-10-10 15:57:17', '2020-10-11 11:58:49');

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

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `billing_infos`
--
ALTER TABLE `billing_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `delivery_charges`
--
ALTER TABLE `delivery_charges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=214;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `ordered_products`
--
ALTER TABLE `ordered_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `page_tokens`
--
ALTER TABLE `page_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_infos`
--
ALTER TABLE `payment_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pre_orders`
--
ALTER TABLE `pre_orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
