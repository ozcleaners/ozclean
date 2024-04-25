-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 23, 2022 at 07:34 PM
-- Server version: 8.0.13
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ozcleaners`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_menus`
--

CREATE TABLE `admin_menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin_menus`
--

INSERT INTO `admin_menus` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Primary Menu', '2021-09-03 23:46:45', '2021-09-03 23:46:45'),
(3, 'Important Links', '2022-01-10 08:47:32', '2022-01-10 08:47:32'),
(4, 'Area we Serve', '2022-01-10 08:51:42', '2022-01-10 08:51:42');

-- --------------------------------------------------------

--
-- Table structure for table `admin_menu_items`
--

CREATE TABLE `admin_menu_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `label` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `parent` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0',
  `class` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_clickable` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `additional_file` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `menu` bigint(20) UNSIGNED NOT NULL,
  `depth` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin_menu_items`
--

INSERT INTO `admin_menu_items` (`id`, `label`, `link`, `parent`, `sort`, `class`, `parent_clickable`, `additional_file`, `menu`, `depth`, `created_at`, `updated_at`) VALUES
(1, 'About Us', '/about-us', 0, 0, NULL, 'Yes', NULL, 1, 0, '2021-09-03 23:48:43', '2021-09-06 06:16:59'),
(2, 'Our Services', '#', 0, 1, 'clsDrp', 'No', 'service', 1, 0, '2021-09-04 04:20:34', '2022-02-01 06:08:00'),
(5, 'Pro Tips', '/pro-tips', 0, 4, NULL, 'Yes', NULL, 1, 0, '2021-09-04 20:13:47', '2021-10-26 05:09:54'),
(6, 'Gallery', '/photo-gallery', 0, 5, NULL, 'Yes', NULL, 1, 0, '2021-09-04 20:13:54', '2022-01-29 00:16:59'),
(7, 'Contact Us', '/contact-us', 0, 6, NULL, 'Yes', NULL, 1, 0, '2021-09-04 20:14:03', '2021-10-26 07:48:20'),
(11, 'Legal Docs', '#', 0, 1, NULL, 'Yes', NULL, 3, 0, '2022-01-10 08:47:42', '2022-01-10 08:47:50'),
(12, 'Terms & Conditions', '#', 0, 2, NULL, 'Yes', NULL, 3, 0, '2022-01-10 08:47:50', '2022-01-10 08:47:57'),
(13, 'Client Reviews', '#', 0, 3, NULL, 'Yes', NULL, 3, 0, '2022-01-10 08:47:57', '2022-01-10 08:48:03'),
(14, 'How to Book a service', '#', 0, 4, NULL, 'Yes', NULL, 3, 0, '2022-01-10 08:48:03', '2022-01-10 08:48:09'),
(15, 'Team Members', '#', 0, 5, NULL, 'Yes', NULL, 3, 0, '2022-01-10 08:48:09', '2022-01-10 08:48:16'),
(16, 'Join Our Team', '#', 0, 6, NULL, 'Yes', NULL, 3, 0, '2022-01-10 08:48:16', '2022-01-10 08:48:19'),
(17, 'Sydney', '#', 0, 1, NULL, 'Yes', NULL, 4, 0, '2022-01-10 08:51:49', '2022-01-10 08:51:56'),
(18, 'Canberra', '#', 0, 2, NULL, 'Yes', NULL, 4, 0, '2022-01-10 08:51:56', '2022-01-10 08:52:01'),
(19, 'Melbourne', '#', 0, 3, NULL, 'Yes', NULL, 4, 0, '2022-01-10 08:52:01', '2022-01-10 08:52:06'),
(20, 'Adelaide', '#', 0, 4, NULL, 'Yes', NULL, 4, 0, '2022-01-10 08:52:06', '2022-01-10 08:52:11'),
(21, 'Darwin', '#', 0, 5, NULL, 'Yes', NULL, 4, 0, '2022-01-10 08:52:11', '2022-01-10 08:52:16'),
(22, 'Perth', '#', 0, 6, NULL, NULL, NULL, 4, 0, '2022-01-10 08:52:16', '2022-01-10 08:52:16');

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  `cssid` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cssclass` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `albums_pcat_id` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `special` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `name`, `position`, `cssid`, `cssclass`, `description`, `albums_pcat_id`, `special`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Demod', 1, '#', '#', 'sdsd', '1', NULL, 1, '2021-09-29 10:59:34', '2021-09-29 21:57:01'),
(2, 'Album', 2, 'd', 'd', 'ss', '1', NULL, 1, '2021-10-26 07:15:28', '2021-10-26 07:15:28'),
(3, 'Residential Property Cleaning', 3, '#', '#', 'Residential Property Cleaning', '2', NULL, 1, '2021-10-26 23:40:13', '2021-10-26 23:40:13'),
(4, 'Commercial Property Cleaning', 4, '#', '#', 'Commercial Property Cleaning', '2', NULL, 1, '2021-10-26 23:40:33', '2021-10-26 23:40:33'),
(5, 'Post Construction Cleaning', 5, '#', '#', 'Post Construction Cleaning', '2', NULL, 1, '2021-10-26 23:40:59', '2021-10-26 23:40:59'),
(6, 'Strata Cleaning', 6, '#', '#', 'Strata Cleaning', '2', NULL, 1, '2021-10-26 23:41:14', '2021-10-26 23:41:14');

-- --------------------------------------------------------

--
-- Table structure for table `albums_pcat`
--

CREATE TABLE `albums_pcat` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cover_photo` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `albums_pcat`
--

INSERT INTO `albums_pcat` (`id`, `name`, `cover_photo`, `is_active`) VALUES
(1, 'Gallery', '15', 1),
(2, 'Portfolio', '8', 1);

-- --------------------------------------------------------

--
-- Table structure for table `attribute_values`
--

CREATE TABLE `attribute_values` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unique_name` enum('Zone','Gender','Calculator Setting','Equation Type','Service Type','Counter Type','Calculation Type','Input Type','Radio Type') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Active','Inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attribute_values`
--

INSERT INTO `attribute_values` (`id`, `unique_name`, `value`, `slug`, `status`) VALUES
(2, 'Zone', 'Melbourne', 'melbourne', 'Inactive'),
(4, 'Gender', 'Male', 'male', 'Active'),
(5, 'Gender', 'Female', 'female', 'Active'),
(6, 'Zone', 'Sydney', 'sydney', 'Inactive'),
(8, 'Zone', 'Adelaide', 'adelaide', 'Active'),
(9, 'Zone', 'Brisbane', 'brisbane', 'Inactive'),
(10, 'Zone', 'Canberra', 'canberra', 'Inactive'),
(11, 'Zone', 'Perth', 'perth', 'Inactive'),
(20, 'Equation Type', 'Fixed', 'fixed', 'Active'),
(22, 'Equation Type', 'Percentage', 'percentage', 'Active'),
(23, 'Calculator Setting', 'Type of property', 'type_of_property', 'Active'),
(24, 'Calculator Setting', 'Day wise Rate', 'day_wise_rate', 'Active'),
(25, 'Calculator Setting', 'Default Price', 'default_price', 'Active'),
(26, 'Calculator Setting', 'Minimum Price', 'minimum_price', 'Active'),
(27, 'Calculator Setting', 'Social share discount', 'social_share_discount', 'Active'),
(28, 'Calculator Setting', 'Type of machine', 'type_of_machine', 'Active'),
(29, 'Calculator Setting', 'Furnish Type', 'furnish_type', 'Active'),
(30, 'Calculator Setting', 'Frequency Type', 'frequency_type', 'Active'),
(31, 'Calculator Setting', 'No of storey', 'no_of_storey', 'Active'),
(33, 'Calculator Setting', 'GST', 'gst', 'Active'),
(34, 'Service Type', 'Main', 'main', 'Active'),
(35, 'Service Type', 'Extra', 'extra', 'Active'),
(36, 'Calculation Type', 'Quantity', 'quantity', 'Active'),
(37, 'Calculation Type', 'Square Meter', 'square_meter', 'Active'),
(38, 'Counter Type', 'Regular', 'regular', 'Active'),
(40, 'Counter Type', 'Popup', 'popup', 'Active'),
(41, 'Counter Type', 'None', 'none', 'Active'),
(42, 'Input Type', 'Select', 'select', 'Active'),
(43, 'Input Type', 'Number', 'number', 'Active'),
(44, 'Input Type', 'Plus Minus', 'plus_minus', 'Active'),
(45, 'Input Type', 'Text', 'text', 'Active'),
(46, 'Input Type', 'Checkbox', 'checkbox', 'Active'),
(47, 'Input Type', 'Radio', 'radio', 'Active'),
(48, 'Radio Type', 'Regular', 'regular', 'Active'),
(49, 'Radio Type', 'Image', 'image', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `booking_general_information`
--

CREATE TABLE `booking_general_information` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `sub_service_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `booking_general_information`
--

INSERT INTO `booking_general_information` (`id`, `full_name`, `contact_no`, `email_address`, `post_code`, `service_id`, `sub_service_id`, `created_at`, `updated_at`) VALUES
(1, 'Nipun', '01680139540', 'info@tritiyo.com', '5084', 7, 34, '2022-04-12 13:27:47', '2022-04-12 13:27:47'),
(2, 'Samrat Khan', '01680139540', 'info@tritiyo.com', '5084', 7, 34, '2022-04-14 18:47:19', '2022-04-14 18:47:19'),
(3, 'Nipun', '0123814347120', 'nipun@mathmozo.com', '5084', 7, 57, '2022-05-09 14:27:58', '2022-05-09 14:27:58'),
(4, 'john hunk', '01677618199', 'hjh@nm.com', '5000', 7, 34, '2022-05-09 15:11:28', '2022-05-09 15:11:28'),
(5, 'john hunk', '01677618199', 'hjh@nm.com', '5000', 7, 34, '2022-05-10 08:26:33', '2022-05-10 08:26:33'),
(6, 'john hunk', '01677618199', 'hjh@nm.com', '5000', 7, 34, '2022-05-10 08:37:41', '2022-05-10 08:37:41'),
(7, 'john hunk', '01677618199', 'hjh@nm.com', '5000', 7, 34, '2022-05-11 11:57:25', '2022-05-11 11:57:25'),
(8, 'john hunk', '01677618199', 'hjh@nm.com', '5000', 7, 34, '2022-05-12 08:40:01', '2022-05-12 08:40:01'),
(9, 'john hunk', '01677618199', 'hjh@nm.com', '5000', 7, 34, '2022-05-13 05:10:23', '2022-05-13 05:10:23'),
(10, 'john hunk', '01677618199', 'hjh@nm.com', '5000', 7, 34, '2022-05-18 01:52:14', '2022-05-18 01:52:14'),
(11, 'Nipun', '01680139540', 'nipun@mathmozo.com', '5084', 7, 57, '2022-05-18 13:43:14', '2022-05-18 13:43:14');

-- --------------------------------------------------------

--
-- Table structure for table `calc_basic_settings`
--

CREATE TABLE `calc_basic_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `service_slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `setting_type` bigint(20) UNSIGNED NOT NULL,
  `setting_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `setting_sub_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `equation_type` bigint(20) UNSIGNED NOT NULL,
  `rate` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `show_on_calculator` enum('Yes','No') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `computable` enum('Yes','No') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sorting_order` int(11) NOT NULL,
  `which_module` enum('Basic','Other') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `section_id` bigint(20) UNSIGNED DEFAULT NULL,
  `intial_selected` enum('Yes') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `calculate_with` enum('After Total','Before Total') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `calc_basic_settings`
--

INSERT INTO `calc_basic_settings` (`id`, `service_id`, `service_slug`, `service_icon`, `setting_type`, `setting_title`, `setting_sub_title`, `equation_type`, `rate`, `show_on_calculator`, `computable`, `sorting_order`, `which_module`, `section_id`, `intial_selected`, `calculate_with`) VALUES
(1, 57, 'high-pressure-cleaning', NULL, 23, 'Unit', NULL, 22, '10', 'Yes', 'Yes', 0, 'Basic', NULL, NULL, NULL),
(2, 57, 'high-pressure-cleaning', NULL, 23, 'Townhouse', NULL, 22, '10', 'Yes', 'Yes', 1, 'Basic', NULL, NULL, NULL),
(3, 57, 'high-pressure-cleaning', NULL, 23, 'House', NULL, 22, '15', 'Yes', 'Yes', 2, 'Basic', NULL, NULL, NULL),
(5, 57, 'high-pressure-cleaning', NULL, 23, 'Commercial', NULL, 22, '15', 'No', 'No', 3, 'Basic', NULL, NULL, NULL),
(6, 34, 'end-of-lease-cleaning-residential', NULL, 24, 'Saturday', NULL, 22, '10', 'No', 'Yes', 5, NULL, NULL, NULL, NULL),
(7, 34, 'end-of-lease-cleaning-residential', NULL, 24, 'Sunday', NULL, 22, '25', 'No', 'Yes', 6, NULL, NULL, NULL, NULL),
(8, 34, 'end-of-lease-cleaning-residential', NULL, 25, 'Default Price', 'Default Price', 20, '100', 'No', 'Yes', 7, 'Basic', NULL, NULL, 'Before Total'),
(9, 34, 'end-of-lease-cleaning-residential', NULL, 26, 'Minimum Price', NULL, 20, '220', 'No', 'Yes', 8, NULL, NULL, NULL, NULL),
(10, 34, 'end-of-lease-cleaning-residential', NULL, 27, 'Facebook', 'Facebook', 22, '5', 'No', 'Yes', 9, 'Basic', NULL, NULL, 'After Total'),
(11, 57, 'high-pressure-cleaning', NULL, 28, 'Steam Cleaner', NULL, 22, '10', 'Yes', 'Yes', 10, 'Basic', NULL, NULL, NULL),
(12, 57, 'high-pressure-cleaning', NULL, 28, 'Carpet Shapooer', NULL, 22, '5', 'Yes', 'Yes', 11, 'Basic', NULL, NULL, NULL),
(13, 57, 'high-pressure-cleaning', NULL, 28, 'Dry Cleaner', NULL, 22, '-5', 'Yes', 'Yes', 12, 'Basic', NULL, NULL, NULL),
(14, 57, 'high-pressure-cleaning', NULL, 29, 'Furnished', NULL, 22, '5', 'Yes', 'Yes', 13, 'Basic', NULL, NULL, NULL),
(15, 57, 'high-pressure-cleaning', NULL, 29, 'Unfurnished', NULL, 22, '-5', 'Yes', 'Yes', 14, 'Basic', NULL, NULL, NULL),
(16, 34, 'end-of-lease-cleaning-residential', NULL, 31, 'Single', 'Single', 22, '10', 'Yes', 'Yes', 15, 'Basic', NULL, NULL, 'After Total'),
(17, 34, 'end-of-lease-cleaning-residential', NULL, 31, 'Double', 'Double', 22, '15', 'Yes', 'Yes', 16, 'Basic', NULL, NULL, 'After Total'),
(18, 34, 'end-of-lease-cleaning-residential', NULL, 31, 'Triple', NULL, 22, '20', 'Yes', 'Yes', 17, 'Basic', NULL, NULL, 'After Total'),
(20, 34, 'end-of-lease-cleaning-residential', NULL, 33, 'GST', 'GST', 22, '10', 'No', 'Yes', 4, 'Basic', NULL, NULL, 'After Total'),
(22, 34, 'end-of-lease-cleaning-residential', NULL, 31, 'Single', NULL, 22, '0', 'Yes', 'Yes', 0, 'Other', 5, NULL, NULL),
(23, 34, 'end-of-lease-cleaning-residential', NULL, 31, 'Double', NULL, 22, '10', 'Yes', 'Yes', 0, 'Other', 5, NULL, NULL),
(24, 34, 'end-of-lease-cleaning-residential', NULL, 29, 'Furnished', 'Furnished', 22, '5', 'Yes', 'Yes', 0, 'Basic', NULL, 'Yes', 'After Total'),
(25, 34, 'end-of-lease-cleaning-residential', NULL, 29, 'Unfurnished', 'Unfurnished', 22, '0', 'Yes', 'Yes', 0, 'Basic', NULL, NULL, 'After Total'),
(26, 57, 'high-pressure-cleaning_297991953', NULL, 25, 'Default Price', NULL, 20, '100', 'No', 'Yes', 0, 'Basic', NULL, 'Yes', 'Before Total'),
(27, 57, 'high-pressure-cleaning_297991953', NULL, 26, 'Minimum Price', NULL, 20, '200', 'No', 'Yes', 0, 'Basic', NULL, 'Yes', 'Before Total');

-- --------------------------------------------------------

--
-- Table structure for table `calc_input_types`
--

CREATE TABLE `calc_input_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `setting_type` enum('calcbasic','calcservice') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `attr_id` bigint(20) UNSIGNED NOT NULL,
  `input_type` bigint(20) UNSIGNED NOT NULL,
  `radio_design` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `calc_input_types`
--

INSERT INTO `calc_input_types` (`id`, `setting_type`, `service_id`, `attr_id`, `input_type`, `radio_design`, `created_at`, `updated_at`) VALUES
(1, 'calcbasic', 34, 23, 47, 48, '2022-04-12 14:25:44', '2022-04-14 18:43:00'),
(2, 'calcbasic', 34, 29, 47, 48, '2022-04-12 14:26:59', '2022-05-06 22:50:47'),
(3, 'calcbasic', 34, 31, 47, 48, '2022-04-12 14:27:09', '2022-05-09 11:09:41'),
(4, 'calcbasic', 34, 28, 47, 48, '2022-04-12 14:27:25', '2022-04-18 13:19:04');

-- --------------------------------------------------------

--
-- Table structure for table `calc_materials_settings`
--

CREATE TABLE `calc_materials_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL,
  `material_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `equation_type` bigint(20) UNSIGNED DEFAULT NULL,
  `rate` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extras_connection` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `calc_materials_settings`
--

INSERT INTO `calc_materials_settings` (`id`, `service_id`, `section_id`, `material_title`, `equation_type`, `rate`, `extras_connection`, `created_at`, `updated_at`) VALUES
(1, 57, 1, 'Tiles', 22, '10', '7,9', '2022-05-09 14:29:41', '2022-05-09 14:29:41'),
(2, 57, 1, 'Pavers', 22, '15', '7,9', '2022-05-09 14:30:01', '2022-05-09 14:30:01'),
(3, 57, 1, 'Concrete', 22, '0', '6,7', '2022-05-09 14:30:14', '2022-05-18 15:26:36');

-- --------------------------------------------------------

--
-- Table structure for table `calc_service_settings`
--

CREATE TABLE `calc_service_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `service_slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `base_price` int(11) NOT NULL,
  `extra_default` int(11) NOT NULL,
  `minimum_qty` int(11) NOT NULL,
  `maximum_qty` int(11) NOT NULL,
  `service_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_sub_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_title_slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `setting_option_type` bigint(20) UNSIGNED DEFAULT NULL,
  `calculation_type` bigint(20) UNSIGNED DEFAULT NULL,
  `counter_type` bigint(20) UNSIGNED DEFAULT NULL,
  `computable` enum('Yes','No') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tooltips_content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `notes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `material_available` enum('Yes','No') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `storey_available` enum('Yes','No') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `input_type` bigint(20) UNSIGNED DEFAULT NULL,
  `radio_design` bigint(20) UNSIGNED DEFAULT NULL,
  `sorting_order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `calc_service_settings`
--

INSERT INTO `calc_service_settings` (`id`, `service_id`, `service_slug`, `service_icon`, `base_price`, `extra_default`, `minimum_qty`, `maximum_qty`, `service_title`, `service_sub_title`, `service_title_slug`, `setting_option_type`, `calculation_type`, `counter_type`, `computable`, `tooltips_content`, `notes`, `material_available`, `storey_available`, `input_type`, `radio_design`, `sorting_order`, `created_at`, `updated_at`) VALUES
(1, 57, 'high-pressure-cleaning_297991953', NULL, 3, 20, 0, 200, 'Driveway', 'Driveway', 'driveway', 34, 37, 38, 'Yes', NULL, NULL, 'Yes', 'Yes', 44, 48, 0, '2022-04-08 12:46:27', '2022-05-18 14:53:35'),
(2, 57, 'high-pressure-cleaning_297991953', NULL, 10, 40, 0, 5, 'Carport', 'Carport', 'carport', 34, 37, 38, 'Yes', NULL, NULL, 'No', 'No', 44, 48, 2, '2022-04-08 12:46:59', '2022-05-18 14:06:49'),
(3, 57, 'high-pressure-cleaning', NULL, 6, 50, 0, 0, 'Pathway', NULL, 'pathway', 34, 37, 38, 'Yes', NULL, NULL, 'Yes', 'No', 44, 48, 3, '2022-04-08 12:47:22', '2022-04-16 12:21:02'),
(4, 57, 'high-pressure-cleaning', NULL, 5, 20, 0, 0, 'Backyard', NULL, 'backyard', 34, 37, 38, 'Yes', NULL, NULL, 'Yes', 'No', 44, 48, 4, '2022-04-08 12:47:45', '2022-04-16 12:21:21'),
(5, 57, 'high-pressure-cleaning', NULL, 5, 30, 20, 20, 'Roof Cleaning', NULL, 'roof_cleaning', 34, 37, 38, 'Yes', NULL, NULL, 'Yes', 'Yes', 44, 48, 1, '2022-04-08 12:49:16', '2022-04-16 12:21:02'),
(6, 57, 'high-pressure-cleaning', NULL, 5, 20, 20, 20, 'Clean underside of pergola', NULL, 'clean_underside_of_pergola', 35, 37, 40, 'Yes', NULL, NULL, NULL, NULL, 44, 48, 7, '2022-04-08 12:59:56', '2022-04-16 12:21:02'),
(7, 57, 'high-pressure-cleaning', NULL, 4, 20, 10, 300, 'Re sand paver joints', NULL, 're_sand_paver_joints', 35, 37, 40, 'Yes', NULL, NULL, NULL, NULL, 44, 48, 6, '2022-04-08 13:00:37', '2022-04-16 12:21:02'),
(8, 57, 'high-pressure-cleaning', NULL, 3, 10, 10, 100, 'Gutter Cleaning', NULL, 'gutter_cleaning', 35, 37, 40, 'Yes', NULL, NULL, NULL, NULL, 44, 48, 5, '2022-04-08 13:12:07', '2022-04-16 12:21:02'),
(9, 34, 'end-of-lease-cleaning-residential', NULL, 15, 30, 0, 10, 'Window outside', 'Window outside', 'window_outside', 35, 36, 38, 'Yes', '<p><strong>Additional Balcony Clean</strong></p><p>Railings dusted &amp; wiped down<br></p><p>All debris removed</p><p>Cobwebs removed from brickwork</p><p>Sliding door glass/frame / tracks cleaned</p><p>Floors swept and mopped</p>', NULL, 'No', 'No', 44, 48, 0, '2022-04-21 15:01:50', '2022-05-23 13:19:08'),
(10, 34, 'end-of-lease-cleaning-residential', '116', 10, 50, 0, 20, 'Carpet cleaning', 'Carpet cleaning', 'carpet_cleaning', 35, 36, 40, 'Yes', NULL, 'Please confirm how many rooms you would steam cleaned:', 'No', 'No', 44, 48, 0, '2022-04-21 15:03:15', '2022-05-23 12:06:49'),
(11, 34, 'end-of-lease-cleaning-residential', NULL, 25, 0, 1, 10, 'Bedroom', 'How many bedrooms?', 'bedroom', 34, 36, 38, 'Yes', NULL, NULL, 'No', 'No', 44, 48, 0, '2022-04-21 15:10:01', '2022-05-09 11:39:57'),
(12, 34, 'end-of-lease-cleaning-residential', NULL, 20, 0, 0, 5, 'Bathroom', 'How many bathrooms?', 'bathroom', 34, 36, 38, 'Yes', NULL, NULL, 'No', 'No', 44, 48, 0, '2022-04-21 15:15:50', '2022-05-09 11:47:51'),
(13, 34, 'end-of-lease-cleaning-residential', NULL, 10, 40, 0, 20, 'Spot Cleaning', NULL, 'spot_cleaning', 35, 36, 40, 'Yes', NULL, NULL, 'No', 'No', 44, 48, 0, '2022-05-06 22:44:31', '2022-05-07 11:27:47'),
(14, 34, 'end-of-lease-cleaning-residential', NULL, 10, 30, 0, 10, 'Dusting Blinds', NULL, 'dusting_blinds', 35, 36, 41, 'Yes', NULL, NULL, 'No', 'No', 44, 48, 0, '2022-05-06 22:45:31', '2022-05-06 22:45:31'),
(15, 34, 'end-of-lease-cleaning-residential', NULL, 5, 30, 0, 10, 'Fridge Cleaning', NULL, '_fridge_cleaning', 35, 36, 38, 'Yes', NULL, NULL, 'No', 'No', 44, 48, 0, '2022-05-06 22:46:09', '2022-05-06 22:46:09'),
(16, 34, 'end-of-lease-cleaning-residential', NULL, 5, 20, 0, 10, 'Balcony Cleaning', NULL, 'balcony_cleaning', 35, 36, 38, 'Yes', NULL, NULL, 'No', 'No', 44, 48, 0, '2022-05-06 22:46:35', '2022-05-06 22:46:35'),
(17, 34, 'end-of-lease-cleaning-residential', NULL, 5, 20, 0, 10, 'Garage Cleaning', NULL, 'garage_cleaning', 35, 36, 38, 'Yes', NULL, NULL, 'No', 'No', 44, 48, 0, '2022-05-06 22:47:03', '2022-05-09 01:55:14'),
(18, 34, 'end-of-lease-cleaning-residential', NULL, 3, 0, 0, 10, 'Microwave Oven', NULL, 'microwave_oven', 35, 36, 38, 'Yes', NULL, NULL, 'No', 'No', 44, 48, 0, '2022-05-06 22:47:42', '2022-05-06 22:47:42'),
(19, 34, 'end-of-lease-cleaning-residential', NULL, 4, 10, 0, 10, 'AC Vent Cleaning', NULL, '_ac_vent_cleaning', 35, 36, 38, 'Yes', NULL, NULL, 'No', 'No', 44, 48, 0, '2022-05-06 22:48:23', '2022-05-06 22:48:23'),
(20, 34, 'end-of-lease-cleaning-residential', NULL, 5, 10, 0, 10, 'Property Exterior', NULL, 'property_exterior', 35, 36, 38, 'Yes', NULL, NULL, 'No', 'No', 44, 48, 0, '2022-05-06 22:48:48', '2022-05-06 22:48:48'),
(21, 34, 'end-of-lease-cleaning-residential', NULL, 50, 0, 0, 30, 'Extra Toilet', 'How many extra toilets?', 'extra_toilet', 34, 36, 38, 'Yes', NULL, NULL, 'No', 'No', 44, 48, 0, '2022-05-07 11:25:08', '2022-05-09 11:44:57');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `coupon_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_amount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `coupon_type` enum('Percentage','Fixed') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'percentage/fixed',
  `allow_type` enum('All','Custom') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'all/custom',
  `limit_type` enum('Unlimited','Custom') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'unlimited/custom',
  `coupon_service` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `how_many_uses` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `person_limit_user` int(11) DEFAULT NULL,
  `coupon_min` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `coupon_groups` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `up_to` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `frontend_settings`
--

CREATE TABLE `frontend_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `meta_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `meta_value` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `meta_type` enum('Text','Textarea','Select','Richeditor','Number') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_group` enum('General','Homepage','Contact Us Page') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_order` int(11) DEFAULT NULL,
  `meta_placeholder` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `frontend_settings`
--

INSERT INTO `frontend_settings` (`id`, `meta_title`, `meta_name`, `meta_value`, `meta_type`, `meta_group`, `meta_order`, `meta_placeholder`, `created_at`, `updated_at`) VALUES
(3, 'Faq Left Side Image', 'home_faq_left_img', '14', 'Text', 'Homepage', 4, NULL, '2021-03-11 05:33:46', '2022-02-01 01:39:22'),
(4, 'Faq Category', 'home_faq_cat_id', '62', 'Text', 'Homepage', 5, NULL, '2021-03-11 05:33:46', '2022-02-01 01:39:22'),
(7, 'Facebook', 'facebook_url', 'https://facebook.com/nobodoltravellers', 'Text', 'General', NULL, NULL, '2021-03-11 05:33:46', '2022-02-01 01:41:14'),
(8, 'Twitter URL', 'twitter_url', 'https://twitter.com/saamraatkhaan', 'Text', 'General', NULL, NULL, '2021-03-11 05:33:46', '2022-02-01 01:41:42'),
(9, 'Instagram', 'instagram_url', 'https://www.instagram.com/mkk.samrat/', 'Text', 'General', NULL, NULL, '2021-03-11 05:33:46', '2022-02-01 01:41:14'),
(10, 'Youtube', 'youtube_url', 'https://www.youtube.com/channel/UCLRqwj0DmB0HfkGYyk-E_Nw', 'Text', 'General', NULL, NULL, NULL, '2022-02-01 01:41:14'),
(23, 'Simple Step of Booking', 'home_simple_step_of_booking', '64', 'Text', 'Homepage', 3, NULL, NULL, '2022-02-01 01:39:22'),
(24, 'Testimonial', 'home_testimonial', '65', 'Text', 'Homepage', 4, NULL, NULL, '2022-02-01 01:39:22'),
(25, 'Blogs', 'home_blogs', '66', 'Text', 'Homepage', 4, NULL, NULL, '2022-02-01 01:39:22'),
(26, 'Location of service', 'location_of_service', 'All Adelaide Regions', 'Text', 'General', 4, NULL, NULL, '2022-02-01 01:39:22'),
(27, 'Location of service 2nd', 'location_of_service_2nd', 'Monday - Saturday (8:00 AM - 10:00 PM)', 'Text', 'General', 4, NULL, NULL, '2022-02-01 01:39:22'),
(28, 'Home Portfolio ID', 'home_portfolio_cat_id', '2', 'Text', 'Homepage', 1, NULL, NULL, '2022-02-01 01:39:22'),
(29, 'Team Members', 'team_members', 'Team Members|70|fa fa-users', 'Text', 'Homepage', NULL, NULL, NULL, '2022-02-01 01:39:22'),
(30, 'Ratings as', 'ratings_as', 'Ratings as|100|fa fa-user', 'Text', 'Homepage', NULL, NULL, NULL, '2022-02-01 01:39:22'),
(31, 'Happy Clients', 'happy_clients', 'Happy Clients|1800|fa fa-trophy', 'Text', 'Homepage', NULL, NULL, NULL, '2022-02-01 01:39:22'),
(32, 'Jobs Done', 'jobs_done', 'Jobs Done|3000|fa fa-list', 'Text', 'Homepage', NULL, NULL, NULL, '2022-02-01 01:39:22'),
(33, 'Partners', 'partners', '80|Partners in world wide|29-slack|29-slack|29-slack|29-slack|29-slack|29-slack', 'Textarea', 'Homepage', 6, NULL, NULL, '2022-02-01 01:39:22'),
(37, 'Page Title', 'page_title', 'Contact Us', 'Text', 'General', 1, NULL, NULL, '2022-02-01 01:39:22'),
(38, 'Sub Title', 'page_subtitle', 'Feel free to contact with us for any kind of query.', 'Text', 'General', 2, NULL, NULL, '2022-02-01 01:39:22'),
(39, 'Short Details', 'short_details', 'Thank you for your interest in hiring Denver Cleaning Service Company. We consider communication with the customer.', 'Text', 'General', 3, NULL, NULL, '2022-02-01 01:39:22'),
(41, 'Contact Us CTA', 'contact_us_cta', 'Want to work with our team member?', 'Text', 'General', 4, NULL, NULL, '2022-02-01 01:39:22'),
(42, 'Contact Us CTA Details', 'contact_us_cta_details', 'We love what we do and we do it with passion. We value the experimentation of the message and smart incentives.', 'Text', 'General', 5, NULL, NULL, '2022-02-01 01:39:22'),
(43, 'Contact Us CTA URL', 'contact_us_cta_url', 'https://www.google.com', 'Text', 'General', 6, NULL, NULL, '2022-02-01 01:39:22'),
(44, 'Contact Us CTA Button Text', 'contact_us_cta_button_text', 'Get an estimate', 'Text', 'General', 7, NULL, NULL, '2022-02-01 01:39:22'),
(45, 'Linked In', 'linkedin_url', 'none', 'Text', 'General', NULL, NULL, NULL, '2022-02-01 01:39:22'),
(47, 'We are cleaners!!!', 'we_are_cleaners', 'Best cleaning service provider in your area! Cleanliness is next to godliness! When we clean something, we bring out its inner beauty, this is a good deed, and it benefits everything.', 'Textarea', 'Homepage', 7, NULL, NULL, '2022-02-01 01:39:22'),
(48, 'Home Why Choose Us', 'home_why_choose_us', '63', 'Text', 'Homepage', 4, NULL, NULL, '2021-10-26 03:42:13');

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` int(10) UNSIGNED NOT NULL,
  `serial` int(11) NOT NULL,
  `media_id` int(11) NOT NULL,
  `gallery_for` enum('General','Service') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_category_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `caption` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `active` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `serial`, `media_id`, `gallery_for`, `parent_category_id`, `category_id`, `caption`, `active`, `created_at`, `updated_at`) VALUES
(1, 1, 8, 'General', NULL, 2, NULL, '1', '2021-09-29 11:17:41', '2021-10-26 07:32:17'),
(2, 2, 6, 'General', NULL, 2, 'df', '1', '2021-09-29 14:17:07', '2021-10-26 07:15:41'),
(3, 3, 17, 'General', NULL, 3, 'none', '1', '2021-10-26 23:42:11', '2021-10-27 12:09:35'),
(4, 4, 18, 'General', NULL, 4, 'Caption None', '1', '2021-10-27 12:08:18', '2021-10-27 12:09:30'),
(5, 5, 19, 'General', NULL, 5, 'none', '1', '2021-10-27 12:09:56', '2021-10-27 12:09:56'),
(6, 6, 20, 'General', NULL, 6, 'none', '1', '2021-10-27 12:10:06', '2021-10-27 12:10:06'),
(7, 7, 21, 'General', NULL, 3, 'none', '1', '2021-10-27 12:10:15', '2021-10-27 12:10:15'),
(10, 7, 0, NULL, 10, 24, 'To provide the following service we charge extra in our end of lease cleaning services. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s.', '1', '2021-10-27 12:10:15', '2022-02-02 05:12:06'),
(11, 8, 43, 'Service', 7, 39, 'None', '1', '2022-01-11 04:35:57', '2022-01-29 00:04:03'),
(12, 9, 48, 'Service', 10, 24, 'sadfjksad', '1', '2022-01-19 22:31:48', '2022-01-29 00:04:15'),
(13, 10, 61, 'Service', 10, 20, 'Caption', '1', '2022-01-28 23:34:11', '2022-01-29 00:04:26'),
(14, 11, 62, 'Service', 8, 29, 'Caption 1', '1', '2022-01-28 23:34:35', '2022-01-28 23:34:35'),
(15, 12, 73, 'Service', 8, 31, '74665', '1', '2022-01-28 23:57:27', '2022-01-29 00:04:40'),
(16, 13, 72, 'Service', 9, 16, 'hjfghjfg', '1', '2022-01-28 23:58:30', '2022-01-29 00:04:48'),
(17, 14, 73, 'Service', 9, 13, 'gfhdfghdf', '1', '2022-01-29 00:02:20', '2022-01-29 00:02:20');

-- --------------------------------------------------------

--
-- Table structure for table `global_settings`
--

CREATE TABLE `global_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `slogan` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `eshtablished` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `license_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `logo` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `header_photo` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `google_map` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `website` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `analytics` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `chat_box` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `meta_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_keywords` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `working_hours` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin_phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin_email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin_photo` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_page_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `favicon` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `timezone` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `global_settings`
--

INSERT INTO `global_settings` (`id`, `name`, `slogan`, `eshtablished`, `license_code`, `logo`, `header_photo`, `phone`, `order_phone`, `email`, `address`, `google_map`, `website`, `analytics`, `chat_box`, `meta_title`, `meta_description`, `meta_keywords`, `working_hours`, `admin_name`, `admin_phone`, `admin_email`, `admin_photo`, `facebook_page_id`, `favicon`, `timezone`, `created_at`, `updated_at`) VALUES
(1, 'adfasd', 'adfasd', 'adfasd', 'adfasd', '76', '34', '01821660066', '01680139540', 'info@tritiyo.com', 'dhaka', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1668590.4767430644!2d149.343618!3d-35.232222!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xd0a1db3155c933f6!2sUltimate%20Cleaners!5e0!3m2!1sen!2sin!4v1635256727145!5m2!1sen!2sin\" width=\"1920\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>', 'http://localhost/ubuntu/ozcleaners', 'sdfasd', 'sdfasd', 'OZ Cleaners | One Stop Cleaning Service in Australia', 'sdfasd', 'sdfasd', '9:00 AM', 'adfasd', '01721767693', 'anowar@mtsbd.net', '32', '0948321', '49', NULL, '2021-09-05 09:06:10', '2022-02-09 14:03:23');

-- --------------------------------------------------------

--
-- Table structure for table `medias`
--

CREATE TABLE `medias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `original_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `filename` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `file_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `file_size` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `file_extension` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `full_size_directory` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `icon_size_directory` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `medias`
--

INSERT INTO `medias` (`id`, `original_name`, `filename`, `file_type`, `file_size`, `file_extension`, `full_size_directory`, `icon_size_directory`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(7, 'logo.png', 'logo_1630915149.png', 'image/png', '5160', 'png', 'storage/uploads/fullsize/2021-09/logo_1630915149.png', 'storage/uploads/iconsize/2021-09/logo_1630915149.png', 1, 1, '2021-09-06 01:59:09', '2021-09-06 01:59:09'),
(8, '1.jpg', '1_1630951547.jpg', 'image/jpeg', '49861', 'jpg', 'storage/uploads/fullsize/2021-09/1_1630951547.jpg', 'storage/uploads/iconsize/2021-09/1_1630951547.jpg', 1, 1, '2021-09-06 12:05:48', '2021-09-06 12:05:48'),
(9, 'cover.png', 'cover_1632979339.png', 'image/png', '1262810', 'png', 'storage/uploads/fullsize/2021-09/cover_1632979339.png', 'storage/uploads/iconsize/2021-09/cover_1632979339.png', 1, 1, '2021-09-29 23:22:20', '2021-09-29 23:22:20'),
(10, 'cover.png', 'cover_1632981835.png', 'image/png', '1378861', 'png', 'storage/uploads/fullsize/2021-09/cover_1632981835.png', 'storage/uploads/iconsize/2021-09/cover_1632981835.png', 1, 1, '2021-09-30 00:03:55', '2021-09-30 00:03:55'),
(11, 'cover_1632979339.png', 'cover1632979339_1634800793.png', 'image/png', '1555199', 'png', 'storage/uploads/fullsize/2021-10/cover1632979339_1634800793.png', 'storage/uploads/iconsize/2021-10/cover1632979339_1634800793.png', 1, 1, '2021-10-21 01:19:54', '2021-10-21 01:19:54'),
(12, 'banner-01.jpg', 'banner-01_1635232867.jpg', 'image/jpeg', '52887', 'jpg', 'storage/uploads/fullsize/2021-10/banner-01_1635232867.jpg', 'storage/uploads/iconsize/2021-10/banner-01_1635232867.jpg', 1, 1, '2021-10-26 01:21:08', '2021-10-26 01:21:08'),
(13, 'testimonial-1.jpg', 'testimonial-1_1635241597.jpg', 'image/jpeg', '2739', 'jpg', 'storage/uploads/fullsize/2021-10/testimonial-1_1635241597.jpg', 'storage/uploads/iconsize/2021-10/testimonial-1_1635241597.jpg', 1, 1, '2021-10-26 03:46:37', '2021-10-26 03:46:37'),
(14, 'faqbg.jpg', 'faqbg_1635243054.jpg', 'image/jpeg', '137544', 'jpg', 'storage/uploads/fullsize/2021-10/faqbg_1635243054.jpg', 'storage/uploads/iconsize/2021-10/faqbg_1635243054.jpg', 1, 1, '2021-10-26 04:10:54', '2021-10-26 04:10:54'),
(15, 'c2.jpg', 'c2_1635244413.jpg', 'image/jpeg', '19823', 'jpg', 'storage/uploads/fullsize/2021-10/c2_1635244413.jpg', 'storage/uploads/iconsize/2021-10/c2_1635244413.jpg', 1, 1, '2021-10-26 04:33:33', '2021-10-26 04:33:33'),
(16, 'window_cleaning.jpg', 'windowcleaning_1635258252.jpg', 'image/jpeg', '379206', 'jpg', 'storage/uploads/fullsize/2021-10/windowcleaning_1635258252.jpg', 'storage/uploads/iconsize/2021-10/windowcleaning_1635258252.jpg', 1, 1, '2021-10-26 08:24:12', '2021-10-26 08:24:12'),
(17, 'p1.jpg', 'p1_1635358148.jpg', 'image/jpeg', '55013', 'jpg', 'storage/uploads/fullsize/2021-10/p1_1635358148.jpg', 'storage/uploads/iconsize/2021-10/p1_1635358148.jpg', 1, 1, '2021-10-27 12:09:08', '2021-10-27 12:09:08'),
(18, 'p2.jpg', 'p2_1635358148.jpg', 'image/jpeg', '22316', 'jpg', 'storage/uploads/fullsize/2021-10/p2_1635358148.jpg', 'storage/uploads/iconsize/2021-10/p2_1635358148.jpg', 1, 1, '2021-10-27 12:09:08', '2021-10-27 12:09:08'),
(19, 'p3.jpg', 'p3_1635358148.jpg', 'image/jpeg', '21816', 'jpg', 'storage/uploads/fullsize/2021-10/p3_1635358148.jpg', 'storage/uploads/iconsize/2021-10/p3_1635358148.jpg', 1, 1, '2021-10-27 12:09:08', '2021-10-27 12:09:08'),
(20, 'p4.jpg', 'p4_1635358148.jpg', 'image/jpeg', '20416', 'jpg', 'storage/uploads/fullsize/2021-10/p4_1635358148.jpg', 'storage/uploads/iconsize/2021-10/p4_1635358148.jpg', 1, 1, '2021-10-27 12:09:08', '2021-10-27 12:09:08'),
(21, 'p5.jpg', 'p5_1635358148.jpg', 'image/jpeg', '26086', 'jpg', 'storage/uploads/fullsize/2021-10/p5_1635358148.jpg', 'storage/uploads/iconsize/2021-10/p5_1635358148.jpg', 1, 1, '2021-10-27 12:09:08', '2021-10-27 12:09:08'),
(22, 'end_of_lease_cleaning.png', 'endofleasecleaning_1635628428.png', 'image/png', '1553090', 'png', 'storage/uploads/fullsize/2021-10/endofleasecleaning_1635628428.png', 'storage/uploads/iconsize/2021-10/endofleasecleaning_1635628428.png', 1, 1, '2021-10-30 15:13:48', '2021-10-30 15:13:48'),
(23, 'end_of_lease_cleaning.png', 'endofleasecleaning_1635628493.png', 'image/png', '1410894', 'png', 'storage/uploads/fullsize/2021-10/endofleasecleaning_1635628493.png', 'storage/uploads/iconsize/2021-10/endofleasecleaning_1635628493.png', 1, 1, '2021-10-30 15:14:53', '2021-10-30 15:14:53'),
(26, 'before_img.png', 'beforeimg_1635859854.png', 'image/png', '1002338', 'png', 'storage/uploads/fullsize/2021-11/beforeimg_1635859854.png', 'storage/uploads/iconsize/2021-11/beforeimg_1635859854.png', 1, 1, '2021-11-02 07:30:55', '2021-11-02 07:30:55'),
(37, 'c2.jpg', 'c2_1641730445.jpg', 'image/jpeg', '19823', 'jpg', 'storage/uploads/fullsize/2022-01/c2_1641730445.jpg', 'storage/uploads/iconsize/2022-01/c2_1641730445.jpg', 1, 1, '2022-01-09 06:14:05', '2022-01-09 06:14:05'),
(47, 'CircleLogo.png', 'circlelogo_1641824993.png', 'image/png', '13262', 'png', 'storage/uploads/fullsize/2022-01/circlelogo_1641824993.png', 'storage/uploads/iconsize/2022-01/circlelogo_1641824993.png', 1, 1, '2022-01-10 08:29:54', '2022-01-10 08:29:54'),
(49, 'ozlogo200x50.png', 'ozlogo200x50_1642718367.png', 'image/png', '5460', 'png', 'storage/uploads/fullsize/2022-01/ozlogo200x50_1642718367.png', 'storage/uploads/iconsize/2022-01/ozlogo200x50_1642718367.png', 1, 1, '2022-01-20 16:39:28', '2022-01-20 16:39:28'),
(50, 'banner-01_1635232867.jpg', 'banner-011635232867_1642933435.jpg', 'image/jpeg', '52887', 'jpg', 'storage/uploads/fullsize/2022-01/banner-011635232867_1642933435.jpg', 'storage/uploads/iconsize/2022-01/banner-011635232867_1642933435.jpg', 1, 1, '2022-01-23 04:23:55', '2022-01-23 04:23:55'),
(51, 'service_detal-3.png', 'servicedetal-3_1642970611.png', 'image/png', '85915', 'png', 'storage/uploads/fullsize/2022-01/servicedetal-3_1642970611.png', 'storage/uploads/iconsize/2022-01/servicedetal-3_1642970611.png', 1, 1, '2022-01-23 14:43:32', '2022-01-23 14:43:32'),
(52, 'c-service-brisbbban-4-5.png', 'c-service-brisbbban-4-5_1642970611.png', 'image/png', '80302', 'png', 'storage/uploads/fullsize/2022-01/c-service-brisbbban-4-5_1642970611.png', 'storage/uploads/iconsize/2022-01/c-service-brisbbban-4-5_1642970611.png', 1, 1, '2022-01-23 14:43:32', '2022-01-23 14:43:32'),
(53, 'c-service-brisbbban-5-3.png', 'c-service-brisbbban-5-3_1642970611.png', 'image/png', '91556', 'png', 'storage/uploads/fullsize/2022-01/c-service-brisbbban-5-3_1642970611.png', 'storage/uploads/iconsize/2022-01/c-service-brisbbban-5-3_1642970611.png', 1, 1, '2022-01-23 14:43:32', '2022-01-23 14:43:32'),
(54, 'service_detal-1-2.png', 'servicedetal-1-2_1642970611.png', 'image/png', '89366', 'png', 'storage/uploads/fullsize/2022-01/servicedetal-1-2_1642970611.png', 'storage/uploads/iconsize/2022-01/servicedetal-1-2_1642970611.png', 1, 1, '2022-01-23 14:43:32', '2022-01-23 14:43:32'),
(61, 'banner-01_1635232867.jpg', 'banner-011635232867_1642997862.jpg', 'image/jpeg', '52887', 'jpg', 'storage/uploads/fullsize/2022-01/banner-011635232867_1642997862.jpg', 'storage/uploads/iconsize/2022-01/banner-011635232867_1642997862.jpg', 1, 1, '2022-01-23 22:17:42', '2022-01-23 22:17:42'),
(62, 'service_detal-1-2.png', 'servicedetal-1-2_1642997923.png', 'image/png', '89366', 'png', 'storage/uploads/fullsize/2022-01/servicedetal-1-2_1642997923.png', 'storage/uploads/iconsize/2022-01/servicedetal-1-2_1642997923.png', 1, 1, '2022-01-23 22:18:43', '2022-01-23 22:18:43'),
(64, 'kitchen.png', 'kitchen_1643004406.png', 'image/png', '12515', 'png', 'storage/uploads/fullsize/2022-01/kitchen_1643004406.png', 'storage/uploads/iconsize/2022-01/kitchen_1643004406.png', 1, 1, '2022-01-24 00:06:47', '2022-01-24 00:06:47'),
(65, 'bathroom.png', 'bathroom_1643004406.png', 'image/png', '13831', 'png', 'storage/uploads/fullsize/2022-01/bathroom_1643004406.png', 'storage/uploads/iconsize/2022-01/bathroom_1643004406.png', 1, 1, '2022-01-24 00:06:47', '2022-01-24 00:06:47'),
(66, 'all-rooms.png', 'all-rooms_1643004406.png', 'image/png', '12441', 'png', 'storage/uploads/fullsize/2022-01/all-rooms_1643004406.png', 'storage/uploads/iconsize/2022-01/all-rooms_1643004406.png', 1, 1, '2022-01-24 00:06:47', '2022-01-24 00:06:47'),
(67, 'livingroom.png', 'livingroom_1643004406.png', 'image/png', '8030', 'png', 'storage/uploads/fullsize/2022-01/livingroom_1643004406.png', 'storage/uploads/iconsize/2022-01/livingroom_1643004406.png', 1, 1, '2022-01-24 00:06:47', '2022-01-24 00:06:47'),
(69, 'service_detal-1-2.png', 'servicedetal-1-2_1643025108.png', 'image/png', '89366', 'png', 'storage/uploads/fullsize/2022-01/servicedetal-1-2_1643025108.png', 'storage/uploads/iconsize/2022-01/servicedetal-1-2_1643025108.png', 1, 1, '2022-01-24 05:51:48', '2022-01-24 05:51:48'),
(71, 'Screenshot_2.png', 'screenshot2_1643035126.png', 'image/png', '131172', 'png', 'storage/uploads/fullsize/2022-01/screenshot2_1643035126.png', 'storage/uploads/iconsize/2022-01/screenshot2_1643035126.png', 1, 1, '2022-01-24 08:38:46', '2022-01-24 08:38:46'),
(72, 'image-5.jpg', 'image-5_1643035270.jpg', 'image/jpeg', '222296', 'jpg', 'storage/uploads/fullsize/2022-01/image-5_1643035270.jpg', 'storage/uploads/iconsize/2022-01/image-5_1643035270.jpg', 1, 1, '2022-01-24 08:41:10', '2022-01-24 08:41:10'),
(73, '1.jpg', '1_1643413778.jpg', 'image/jpeg', '21857', 'jpg', 'storage/uploads/fullsize/2022-01/1_1643413778.jpg', 'storage/uploads/iconsize/2022-01/1_1643413778.jpg', 1, 1, '2022-01-28 17:49:39', '2022-01-28 17:49:39'),
(74, '2.jpg', '2_1643413778.jpg', 'image/jpeg', '31968', 'jpg', 'storage/uploads/fullsize/2022-01/2_1643413778.jpg', 'storage/uploads/iconsize/2022-01/2_1643413778.jpg', 1, 1, '2022-01-28 17:49:39', '2022-01-28 17:49:39'),
(75, '3.jpg', '3_1643413778.jpg', 'image/jpeg', '40379', 'jpg', 'storage/uploads/fullsize/2022-01/3_1643413778.jpg', 'storage/uploads/iconsize/2022-01/3_1643413778.jpg', 1, 1, '2022-01-28 17:49:39', '2022-01-28 17:49:39'),
(113, 'img-20210309-wa0113_1641744527.jpg', 'img-20210309-wa01131641744527_1650217827.jpg', 'image/jpeg', '241049', 'jpg', 'storage/uploads/fullsize/2022-04/img-20210309-wa01131641744527_1650217827.jpg', 'storage/uploads/iconsize/2022-04/img-20210309-wa01131641744527_1650217827.jpg', 1, 1, '2022-04-17 11:50:27', '2022-04-17 11:50:27'),
(114, 'IMG_0826.JPG', 'img0826_1650219404.JPG', 'image/jpeg', '3707021', 'JPG', 'storage/uploads/fullsize/2022-04/img0826_1650219404.JPG', 'storage/uploads/iconsize/2022-04/img0826_1650219404.JPG', 1, 1, '2022-04-17 12:16:46', '2022-04-17 12:16:46'),
(115, 'IMG_0927.JPG', 'img0927_1650219424.JPG', 'image/jpeg', '5524516', 'JPG', 'storage/uploads/fullsize/2022-04/img0927_1650219424.JPG', 'storage/uploads/iconsize/2022-04/img0927_1650219424.JPG', 1, 1, '2022-04-17 12:17:06', '2022-04-17 12:17:06'),
(116, 'carpet-steam-clean.png', 'carpet-steam-clean_1653329189.png', 'image/png', '10738', 'png', 'storage/uploads/fullsize/2022-05/carpet-steam-clean_1653329189.png', 'storage/uploads/iconsize/2022-05/carpet-steam-clean_1653329189.png', 1, 1, '2022-05-23 12:06:29', '2022-05-23 12:06:29');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2021_07_14_054017_create_roles_table', 1),
(4, '2021_07_14_054543_create_warehouses_table', 1),
(5, '2021_07_14_054544_create_role_users_table', 1),
(11, '2021_07_14_061139_create_route_groups_table', 2),
(12, '2021_07_14_061140_create_route_lists_table', 2),
(13, '2021_07_14_061655_create_route_list_roles_table', 2),
(14, '2021_08_03_055209_create_products_table', 3),
(17, '2021_08_15_210833_create_terms_table', 4),
(20, '2021_08_19_120537_create_medias_table', 6),
(21, '2021_08_21_065343_create_posts_table', 7),
(22, '2021_08_22_235852_create_pages_table', 7),
(23, '2017_08_11_073824_create_menus_wp_table', 8),
(24, '2017_08_11_074006_create_menu_items_wp_table', 8),
(25, '2021_09_05_024010_create_global_settings_table', 9),
(26, '2022_01_12_063743_create_attribute_values_table', 10),
(30, '2022_01_17_042359_create_term_custom_fields', 11),
(31, '2022_01_17_042657_create_term_custom_fields_breakdown', 11),
(32, '2022_01_17_042907_create_seo_informations', 11),
(38, '2022_02_09_204133_create_booking_general_information_table', 12),
(39, '2022_04_03_201028_create_calc_basic_settings_table', 12),
(48, '2022_04_05_192543_create_calc_service_settings', 13),
(49, '2022_04_11_182957_create_calc_materials_settings', 14),
(50, '2022_04_12_195305_create_calc_input_types_table', 15),
(51, '2022_04_08_213305_create_postcodes_table', 16),
(52, '2022_04_08_213414_create_postcode_rates_table', 16),
(53, '2022_04_18_132127_create_coupons_table', 17);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `which_editor` enum('normal','grapes') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sub_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `seo_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `author` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `grapes_description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `grapes_css` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `images` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `short_description` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `youtube` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `h1tag` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `h2tag` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_keywords` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_sticky` tinyint(1) DEFAULT NULL,
  `lang` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'English, Bengali or any other language',
  `template` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `which_editor`, `user_id`, `title`, `sub_title`, `seo_url`, `author`, `description`, `grapes_description`, `grapes_css`, `images`, `short_description`, `youtube`, `h1tag`, `h2tag`, `seo_title`, `seo_description`, `seo_keywords`, `is_sticky`, `lang`, `template`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'normal', 1, 'About Us', 'about us', 'about-us', NULL, '<p>Samrat Khan</p>', NULL, NULL, '1', 'About Us', 'About Us', 'About Us', 'About Us', 'About Us', 'About Us', 'About Us', 1, 'en', NULL, 1, '2021-08-23 05:12:48', '2021-10-26 12:57:51'),
(2, 'normal', 1, 'Legal Docs', 'Legal Docs', 'legal-docs', NULL, NULL, NULL, NULL, '1', 'Legal Docs', 'Legal Docs', 'Legal Docs', 'Legal Docs', 'Legal Docs', 'Legal Docs', 'Legal Docs', 1, 'en', NULL, 1, '2021-09-02 20:44:05', '2021-09-04 20:16:24'),
(3, 'normal', 1, 'Terms & Conditions', 'Terms & Conditions', 'terms-and-conditions', NULL, 'Terms & Conditions', NULL, NULL, NULL, 'Terms & Conditions', NULL, 'Terms & Conditions', 'Terms & Conditions', 'Terms & Conditions', 'Terms & Conditions', 'Terms & Conditions', 1, 'en', NULL, 1, '2021-09-04 20:16:59', '2021-09-04 20:16:59'),
(4, 'normal', 1, 'Gallery', 'Gallery', 'gallery', NULL, '<p>Gallery<br></p>', NULL, NULL, NULL, 'Gallery', NULL, 'Gallery', 'Gallery', 'Gallery', 'Gallery', 'Gallery', 1, 'en', 'gallery', 1, '2021-09-06 04:32:46', '2021-09-06 04:32:46'),
(5, 'normal', 1, 'Pro Tips', 'Pro Tips', 'pro-tips', NULL, '<p>Pro Tips</p>', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 1, 'en', 'blogs', 1, '2021-10-26 05:05:44', '2021-10-26 05:06:33'),
(6, 'normal', 1, 'Contact Us', 'contact us sub title', 'contact-us', NULL, '<p>contact us sub title<br></p>', NULL, NULL, NULL, 'contact us sub title', NULL, 'contact us sub title', 'contact us sub title', 'contact us sub title', 'contact us sub title', '', 1, 'en', 'contact', 1, '2021-10-26 07:47:57', '2021-10-26 07:47:57');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `postcodes`
--

CREATE TABLE `postcodes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `zone_id` bigint(20) UNSIGNED NOT NULL,
  `postcode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `postcodes`
--

INSERT INTO `postcodes` (`id`, `zone_id`, `postcode`, `created_at`, `updated_at`) VALUES
(1, 8, '5000', '2022-04-13 11:35:08', '2022-04-13 11:35:08'),
(2, 8, '5001', '2022-04-13 11:35:15', '2022-04-13 11:35:15'),
(3, 8, '5002', '2022-04-13 11:35:19', '2022-04-13 11:35:19'),
(4, 8, '5003', '2022-04-13 11:35:23', '2022-04-13 11:35:23'),
(5, 8, '5004', '2022-04-13 11:35:29', '2022-04-13 11:35:29'),
(6, 8, '5084', '2022-04-13 11:35:34', '2022-04-13 11:35:34'),
(7, 8, '5085', '2022-04-14 18:20:42', '2022-04-14 18:20:42'),
(8, 9, '5025', '2022-04-14 18:29:06', '2022-04-14 18:29:06');

-- --------------------------------------------------------

--
-- Table structure for table `postcode_rates`
--

CREATE TABLE `postcode_rates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `zone_id` bigint(20) UNSIGNED NOT NULL,
  `postcode_id` bigint(20) UNSIGNED NOT NULL,
  `postcode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `rate` int(11) NOT NULL,
  `equation_type` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `postcode_rates`
--

INSERT INTO `postcode_rates` (`id`, `zone_id`, `postcode_id`, `postcode`, `service_id`, `rate`, `equation_type`, `created_at`, `updated_at`) VALUES
(1, 8, 1, '5000', 34, 10, 22, '2022-04-13 11:38:37', '2022-04-14 18:23:45'),
(2, 8, 2, '5001', 34, 10, 22, '2022-04-13 11:38:37', '2022-04-14 18:23:45'),
(3, 8, 3, '5002', 34, 10, 22, '2022-04-13 11:38:37', '2022-04-14 18:23:45'),
(4, 8, 7, '5085', 34, 10, 22, '2022-04-14 18:21:01', '2022-04-14 18:23:45'),
(5, 8, 4, '5003', 34, 15, 22, '2022-04-21 13:21:49', '2022-04-21 13:21:49'),
(6, 8, 5, '5004', 34, 15, 22, '2022-04-21 13:21:49', '2022-04-21 13:21:49'),
(7, 8, 6, '5084', 34, 20, 22, '2022-04-21 13:22:26', '2022-04-21 13:22:26');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `which_editor` enum('normal','grapes') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sub_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `author` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `categories` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `images` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `grapes_description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `grapes_css` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `short_description` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `youtube` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `brand` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `opening_hours` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitude` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_numbers` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `tags` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `division` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `district` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `thana` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `shop_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `lang` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'English, Bengali or any other language',
  `is_auto_post` tinyint(1) DEFAULT NULL,
  `is_upcoming` tinyint(1) DEFAULT NULL,
  `is_sticky` tinyint(1) DEFAULT NULL,
  `position` enum('Left Top','Left','Left Bottom','Middle Top','Middle','Middle Bottom','Right Top','Right','Right Bottom') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `font_awesome_icon` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `which_editor`, `user_id`, `title`, `sub_title`, `seo_url`, `author`, `categories`, `images`, `description`, `grapes_description`, `grapes_css`, `short_description`, `youtube`, `brand`, `phone`, `opening_hours`, `latitude`, `longitude`, `phone_numbers`, `address`, `tags`, `division`, `district`, `thana`, `shop_type`, `lang`, `is_auto_post`, `is_upcoming`, `is_sticky`, `position`, `font_awesome_icon`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'grapes', 1, 'Samrat Test', 'Samrat Test', 'samrat-test', 'Samrat Test', '4', '1', NULL, NULL, NULL, 'Samrat Test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 1, 1, 1, 'Right', NULL, 1, '2021-08-23 21:29:53', '2021-10-26 00:51:55'),
(2, 'normal', 1, 'How much is the cost for my cleaning?', NULL, 'how-much-is-the-cost-for-my-cleaning', NULL, '62,63', NULL, '<p>Every property is different, so, can\'t say the price exactly without looking at it. However, in 90% case, the price given by our calculator is accurate and developing it every day to get 99% result. If any price correction is needed then our team will advise you on site before starting the job.</p>', NULL, NULL, 'How much is the cost for my cleaning?', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 1, 1, 1, NULL, NULL, 1, '2021-10-22 12:47:45', '2021-10-22 12:47:45'),
(3, 'normal', 1, 'How your payment terms work?', NULL, 'how-your-payment-terms-work', NULL, '62', NULL, 'At the time of confirming a booking for you, our system will charge you 20% of your total cost. Rest of the 80% will be charged from your account one day before the scheduled the date. If this payment is not successful then the system will cancel your booking automatically and you will not get any refund from us For more details, please read our terms and condition while booking a job in our system.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 1, 1, 1, NULL, NULL, 1, '2021-10-22 12:51:28', '2021-10-22 12:51:28'),
(4, 'normal', 1, 'Do I need to be at the property while cleaning?', NULL, 'do-i-need-to-be-at-the-property-while-cleaning', NULL, '62', NULL, 'NO, not at all. You are free to go anywhere, stress is on us. Even to let us in, you don\'t need to be there. Just keep the door open or leave the keys somewhere like, in the letterbox or under the door mate. Our team will finish the job and leave the keys at the same place they got it.', NULL, NULL, 'Do I need to be at the property while cleaning?', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 1, 1, 1, NULL, NULL, 1, '2021-10-22 12:52:15', '2021-10-22 12:52:15'),
(5, 'normal', 1, 'What if I get any issues after you cleaned?', NULL, 'what-if-i-get-any-issues-after-you-cleaned', NULL, '62', NULL, 'There is one famous saying in cleaning industry, \"There is always something to clean\". We cannot make something like new again but do our best to make it sparkling. Still, if you are not happy then we will send our team again for free to rectify any issues you got.', NULL, NULL, 'What if I get any issues after you cleaned?', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 1, 1, 1, NULL, NULL, 1, '2021-10-22 12:53:00', '2021-10-22 12:53:00'),
(6, 'normal', 1, 'Do you contact my property manager or landlord?', 'Do you contact my property manager or landlord?', 'do-you-contact-my-property-manager-or-landlord', NULL, '62', NULL, 'Usually we don\'t contact your property manager or landlord, but if you require then just advise us at time of booking. However, for any re-clean issue, after you returned the keys, we are happy to contact them to fix any issue they got without prior notice.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 1, 1, 1, NULL, NULL, 1, '2021-10-22 12:53:40', '2021-10-22 12:53:40'),
(7, 'normal', 1, 'Do you guarantee my bond back?', 'Do you guarantee my bond back?', 'do-you-guarantee-my-bond-back', NULL, '62', NULL, 'YES, happily we do. After we finished the job, you will have 7 calendar days to contact with us with any issues to get a free revisit by our team. If it is more than 7 days then we will charge extra to retouch anything for you.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 1, 1, 1, NULL, NULL, 1, '2021-10-22 12:55:06', '2021-10-22 12:55:06'),
(8, 'normal', 1, 'What if your cleaners didn\'t show up?', 'What if your cleaners didn\'t show up?', 'what-if-your-cleaners-didnt-show-up', NULL, '62', NULL, 'This is very unlikely to happen, however, still there is a chance right! No worries, you are in good hand. If a scheduled team didn\'t show up even after 2 hours of scheduled time then we will send another team straight away for your job if it was the last day of your lease. In other cases, we will reschedule the job for any other day.', NULL, NULL, 'What if your cleaners didn\'t show up?', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 1, 1, 1, NULL, NULL, 1, '2021-10-22 12:55:50', '2021-10-22 12:55:50'),
(9, 'normal', 1, 'Can I reschedule my booking?', 'Can I reschedule my booking?', 'can-i-reschedule-my-booking', NULL, '62', NULL, 'YES, of course you can reschedule a job anytime you want. However, there may be a rescheduling fee if you want to do it by less than 24 hours prior notice. Please read our terms & conditions properly while booking the job.', NULL, NULL, 'Can I reschedule my booking?', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 1, 1, 1, NULL, NULL, 1, '2021-10-22 12:57:08', '2021-10-22 12:57:08'),
(10, 'normal', 1, 'If needed, can I cancel my booking?', 'If needed, can I cancel my booking?', 'if-needed-can-i-cancel-my-booking', NULL, '62', NULL, 'YES, of course you can cancel anytime you want. However, there will be a cancellation charge if you want to cancel a scheduled job by less than 72 hours prior notice. Please read our terms &amp; conditions properly while booking the job.', NULL, NULL, 'If needed, can I cancel my booking?', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 1, 1, 1, NULL, NULL, 1, '2021-10-22 12:58:59', '2021-10-22 12:58:59'),
(11, 'normal', 1, 'Reasonable Price', NULL, 'reasonable-price', NULL, '63', NULL, NULL, NULL, NULL, 'Unlike others, along with our quality, we are very reasonable & affordable.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 1, 1, 1, 'Left', 'fas fa-thumbs-up', 1, '2021-10-26 00:54:48', '2022-01-30 14:36:46'),
(12, 'normal', 1, 'Satisfaction Guaranteed', NULL, 'satisfaction-guaranteed', NULL, '63', NULL, NULL, NULL, NULL, 'Bad thing happens on the job; we always admit it and stay on your side.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 1, 1, 1, 'Left', 'fab fa-superpowers', 1, '2021-10-26 01:18:02', '2022-01-30 14:38:11'),
(13, 'normal', 1, 'Quality Staffs', NULL, 'quality-staffs', NULL, '63', NULL, NULL, NULL, NULL, 'We never let anyone inexperienced work for our clients & that\'s a promise.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 1, 1, 1, 'Left', 'fa fa-thermometer-full', 1, '2021-10-26 01:19:55', '2021-10-26 01:19:55'),
(14, 'normal', 1, '25+', NULL, '25-service-provide', NULL, '63', '12', NULL, NULL, NULL, 'Services we provide', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 1, 1, 1, 'Middle Top', NULL, 1, '2021-10-26 01:24:08', '2021-10-26 01:25:32'),
(16, 'normal', 1, '1542\r\n\r\n', NULL, '1542-satisfied-clients', NULL, '63', '', NULL, NULL, NULL, 'Satisfied Clients', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 1, 1, 1, 'Middle Bottom', 'fa fa-male', 1, '2021-10-26 01:24:08', '2021-10-26 01:25:32'),
(17, 'normal', 1, '1542\r\n\r\n', NULL, '1542-expert-team', NULL, '63', '', NULL, NULL, NULL, 'Satisfied Clients', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 1, 1, 1, 'Middle Bottom', 'fa fa-male', 1, '2021-10-26 01:24:08', '2021-10-26 01:25:32'),
(18, 'normal', 1, 'Fast Services', NULL, ' fast-services', NULL, '63', NULL, NULL, NULL, NULL, 'We have enough team to serve even by the same-day notice in any city we serve.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 1, 1, 1, 'Right', 'fa fa-long-arrow-right', 1, '2021-10-26 01:19:55', '2021-10-26 01:19:55'),
(19, 'normal', 1, 'Best Equipment', NULL, 'best-equipment', NULL, '63', NULL, NULL, NULL, NULL, 'We never give a second thought to buy the best equipment in the market.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 1, 1, 1, 'Right', 'fas fa-user', 1, '2021-10-26 01:19:55', '2022-01-30 14:38:54'),
(20, 'normal', 1, 'We Are Insured ', NULL, ' we-are-Insured', NULL, '63', NULL, NULL, NULL, NULL, 'You have coverage with 5 million dollars insurance from us, be chilled!', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 1, 1, 1, 'Right', 'fa fa-long-arrow-right', 1, '2021-10-26 01:19:55', '2021-10-26 01:19:55'),
(21, 'normal', 1, 'Find Us Fast Now', NULL, 'find-us-fast-now', NULL, '64', NULL, NULL, NULL, NULL, 'Sed ut perspiciatis unde omnis iste natus error voluptatem.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 1, 1, 1, NULL, 'fa fa-search', 1, '2021-10-26 03:27:28', '2021-10-26 03:27:28'),
(22, 'normal', 1, 'Choose Services', NULL, 'choose-services', NULL, '64', NULL, NULL, NULL, NULL, 'Sed ut perspiciatis unde omnis iste natus error voluptatem.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 1, 1, 1, NULL, 'fa fa-cog', 1, '2021-10-26 03:36:32', '2021-10-26 03:36:32'),
(23, 'normal', 1, 'Book Appointment', NULL, 'book-appointment', NULL, '64', NULL, NULL, NULL, NULL, 'Sed ut perspiciatis unde omnis iste natus error voluptatem.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 1, 1, 1, NULL, 'fa fa-calendar', 1, '2021-10-26 03:37:33', '2021-10-26 03:37:33'),
(24, 'normal', 1, 'Haidar', NULL, 'testomonial-haidar', NULL, '65', '13', NULL, NULL, NULL, 'They use to provide a lot of cleaning services and property maintenances, but I received only a window cleaning service from them. And I am so impressed with their services that I don\'t think I need to go anywhere else for any cleaning or property maintenances services ever as long as the current management is there. They are highly recommended for everyone; though not cheap but affordable.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 1, 1, 1, NULL, NULL, 1, '2021-10-26 03:49:14', '2021-10-26 03:54:30'),
(25, 'normal', 1, 'How much is the cost for my cleaning?', NULL, 'how-much-is-the-cost-for-my-cleaning', NULL, '62', NULL, NULL, NULL, NULL, 'Every property is different, so, can\'t say the price exactly without looking at it. However, in 90% case, the price given by our calculator is accurate and developing it every day to get 99% result. If any price correction is needed then our team will advise you on site before starting the job.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 1, 1, 1, NULL, NULL, 1, '2021-10-26 04:06:20', '2021-10-26 04:06:20'),
(26, 'grapes', 1, 'How stay calm from the first time', NULL, 'how-stay-calm-from-the-first-time', NULL, '66', '15', '<h2 style=\"margin-bottom: 10px; font-family: DauphinPlain; font-size: 24px; line-height: 24px; color: rgb(0, 0, 0);\">What is Lorem Ipsum?</h2><p style=\"margin-bottom: 15px; text-align: justify; color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\"><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '<div id=\"iicl\" class=\"row\"><div id=\"iw9z\" class=\"cell\"><img id=\"i6tz\" src=\"http://localhost/ubuntu/ozcleaners/storage/uploads/fullsize/2022-01/servicedetal-1-2_1642997923.png\"/></div><div id=\"im38\" class=\"cell\"><div id=\"i554\">Best cleaning service provider in your area! Cleanliness is next to godliness! When we clean something, we bring out its inner beauty, this is a good deed, and it benefits everything. Best cleaning service provider in your area! Cleanliness is next to godliness! When we clean something, we bring out its inner beauty, this is a good deed, and it benefits everything. Best cleaning service provider in your area! Cleanliness is next to godliness! When we clean something, we bring out its inner beauty, this is a good deed, and it benefits everything. Best cleaning service provider in your area! Cleanliness is next to godliness! When we clean something, we bring out its inner beauty, this is a good deed, and it benefits everything. <div><br/></div><div>Best cleaning service provider in your area! Cleanliness is next to godliness! When we clean something, we bring out its inner beauty, this is a good deed, and it benefits everything. Best cleaning service provider in your area! Cleanliness is next to godliness! When we clean something, we bring out its inner beauty, this is a good deed, and it benefits everything. Best cleaning service provider in your area! Cleanliness is next to godliness! When we clean something, we bring out its inner beauty, this is a good deed, and it benefits everything. Best cleaning service provider in your area! Cleanliness is next to godliness! When we clean something, we bring out its inner beauty, this is a good deed, and it benefits everything. </div><div><br/></div></div></div></div><div class=\"row\" id=\"inbe2\"><div class=\"cell\" id=\"ika6r\"><div id=\"i2i4k\">Best cleaning service provider in your area! Cleanliness is next to godliness! When we clean something, we bring out its inner beauty, this is a good deed, and it benefits everything. Best cleaning service provider in your area! Cleanliness is next to godliness! When we clean something, we bring out its inner beauty, this is a good deed, and it benefits everything. Best cleaning service provider in your area! Cleanliness is next to godliness! When we clean something, we bring out its inner beauty, this is a good deed, and it benefits everything. Best cleaning service provider in your area! Cleanliness is next to godliness! When we clean something, we bring out its inner beauty, this is a good deed, and it benefits everything. <div><br/></div><div>Best cleaning service provider in your area! Cleanliness is next to godliness! When we clean something, we bring out its inner beauty, this is a good deed, and it benefits everything. Best cleaning service provider in your area! Cleanliness is next to godliness! When we clean something, we bring out its inner beauty, this is a good deed, and it benefits everything. Best cleaning service provider in your area! Cleanliness is next to godliness! When we clean something, we bring out its inner beauty, this is a good deed, and it benefits everything. Best cleaning service provider in your area! Cleanliness is next to godliness! When we clean something, we bring out its inner beauty, this is a good deed, and it benefits everything. </div><div id=\"ik9ha\"><br/></div></div></div><div class=\"cell\" id=\"i1aca\"><img src=\"http://localhost/ubuntu/ozcleaners/storage/uploads/fullsize/2022-01/servicedetal-1-2_1642997923.png\" id=\"iyc7q\"/></div></div>', '* { box-sizing: border-box; } body {margin: 0;}*{box-sizing:border-box;}body{margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;}*{box-sizing:border-box;}body{margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;}*{box-sizing:border-box;}body{margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;}*{box-sizing:border-box;}body{margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;}.row{display:flex;justify-content:flex-start;align-items:stretch;flex-wrap:nowrap;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;}.cell{min-height:75px;flex-grow:1;flex-basis:100%;}#i6tz{color:black;}#i554{padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;}#iyc7q{color:black;}#i2i4k{padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;}@media (max-width: 768px){.row{flex-wrap:wrap;}}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 1, 1, 1, 'Left', NULL, 1, '2021-10-26 04:17:12', '2022-02-02 01:39:11'),
(27, 'normal', 1, 'The Best Way to Clean Your Instant Pot (And Keep It Clean!)', NULL, 'the-best-way-to-clean-your-instant-pot-and-keep-it-clean', NULL, '66', '15', '<p><strong>Are Instant Pots Easy to Clean?</strong></p><p>The more you use your instant pot, the more often you’ll want to clean it. Giving it a light scrub after every use is a good start, but the intense pressure and heat associated with this style of cooking means you’ll want to go a bit deeper to ensure your food doesn’t pick up old flavors. Luckily, those quick cleans are easy, and even a deep clean doesn’t take too long, either.</p><p><strong>Here’s How Often to Clean an Instant Pot</strong><br></p><p>There are a few parts to the instant pot you’ll clean every time you use them.</p><p>› <strong>Inner Pot</strong>. This large, stainless-steel pot is where the magic happens! It comes in direct contact with foods like rice, curries, and soups, so you’ll want to wash the pot with warm, soapy water every time you use it.</p><p>› <strong>Steam Rack</strong>. For steamed vegetables especially, this steel component touches the food directly. You can put the rack in the dishwasher, but it can be easier washing by hand, just as you would the inner pot, to get small bits of food that might be stuck in the grate.</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 1, 1, 0, 'Left', NULL, 1, '2021-10-26 04:53:53', '2022-01-29 08:47:33'),
(28, 'normal', 1, 'Germs, Dirt, Damage: Say No to Wearing Shoes in the House', NULL, 'germs-dirt-damage-say-no-to-wearing-shoes-in-the-house', NULL, '66', '15', '<p>We all have that one neighbor or friend, the moment you enter their home you hear -“Take Off Your Shoes. Please”!. And like the gracious guest you are, you may oblige. But you have to wonder...is it all really necessary? After all, they’re just shoes! Well, as it turns out, not only does wearing shoes inside your home bring in those pesky, outdoor germs, but it also tracks in unwanted dirt and can cause damage to your flooring. In this article, we’ll review the reasons why you shouldn\'t wear shoes past your front door.</p><p><strong>Reduce Germs</strong></p><p>Did you know there are possibly over 420,000 bacteria living on the outside of your shoes? And as much as we try, we can’t avoid them completely. But you can help reduce the spread of germs in your home by taking off your shoes when you walk inside. Research has shown that the outside of your shoes can be a carrier for a variety of microbes like viruses and bacteria. Many people are unaware that when wearing shoes for more than a month, there is a better than 93% chance those shoes will have some form of fecal bacteria on the bottom of them. And if you aren’t checking your shoes at the front door, those microbes can rub off on any surface they come in contact with throughout your home. If you have small children crawling around the house, that makes this fact even more concerning.&nbsp;&nbsp;</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 1, 1, 1, 'Right', NULL, 1, '2021-10-26 04:54:49', '2022-01-29 08:48:51'),
(29, 'normal', 1, 'Do Natural Cleaning Products Kill Bacteria?', NULL, 'do-natural-cleaning-products-kill-bacteria', NULL, '66', '15', '<p style=\"color: rgb(120, 120, 120); font-family: Montserrat, Verdana, sans-serif; font-size: 18px;\">If you are looking for a way to clean your home without the use of harsh chemicals, there are countless natural products out there that market themselves as ideal, eco-friendly solutions. The problem is many of the natural cleaners you see advertised do not disinfect the surfaces you use them on, failing to provide the deep clean you need and expect. With so many to choose from, let’s take a closer look at the options and how you can even make your own!</p><h2 style=\"margin-top: 0.5rem; margin-bottom: 1.2rem; font-family: Montserrat, Verdana, sans-serif; font-size: 1.33rem; letter-spacing: 0.12em; color: rgb(7, 29, 73);\">“Natural” Cleaners in Recycled Bottles</h2><p style=\"color: rgb(120, 120, 120); font-family: Montserrat, Verdana, sans-serif; font-size: 18px;\"><br>Many cleaning products advertise themselves as being “natural” when they are anything but. They use the same harsh chemicals as any other mainstream, standard cleaning solutions, including ammonia and petroleum. The product is then placed within a recycled bottle, thus making it “green.” While there are numerous environmental benefits to reducing plastic, if you are searching for a proper natural cleaner (one that both disinfects and is environmentally friendly), these products simply don’t fit the bill.</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 1, 1, 1, 'Right', NULL, 1, '2021-10-26 04:56:15', '2021-10-26 04:56:15'),
(30, 'normal', 1, '5 Fancy Napkin Folding Techniques to Try', NULL, '5-fancy-napkin-folding-techniques-to-try', NULL, '66', '15', '<p style=\"color: rgb(120, 120, 120); font-family: Montserrat, Verdana, sans-serif; font-size: 18px;\">When hosting a dinner party or even a causal taco Tuesday at home, adding a folded napkin to each place setting lends a touch of elegance and fun to any meal. Some of these napkin folding ideas can also be used to hold the silverware, adding a functional touch to each place setting.</p><h3 style=\"margin-top: 0.5rem; margin-bottom: 1.2rem; font-family: Montserrat, Verdana, sans-serif; font-size: 1.33rem; line-height: 1.4; color: rgb(7, 29, 73);\"><a style=\"transition: color 0.5s ease 0s; color: rgb(224, 70, 124);\">Napkin with a Pocket</a></h3><p style=\"color: rgb(120, 120, 120); font-family: Montserrat, Verdana, sans-serif; font-size: 18px;\">While it is a somewhat simple design, folding a napkin into a pocket to hold the silverware is a great introduction to the art of napkin folding. It’s also a fun way to get the kids involved in getting ready for a special meal.</p><ol style=\"list-style-type: decimal; padding-left: 2em; margin-top: 1em; margin-bottom: 1em; color: rgb(120, 120, 120); font-family: Montserrat, Verdana, sans-serif; font-size: 18px;\"><li>Place the napkin in front of you, face down on the table. Fold the bottom edge up about 3 inches to make a band at the bottom of the napkin. Do the same with the top edge, folding the top down about 3 inches to meet the other fold in the middle of the napkin.</li><li>Flip the napkin over, folding in both sides to meet in the middle of the napkin.</li><li>Fold the left side of the napkin over to meet the right edge of the napkin, creating a small rectangular pocket at the bottom of the napkin. Insert the silverware into the pocket.</li></ol>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 1, 1, 1, 'Right', NULL, 1, '2021-10-26 04:57:40', '2021-10-26 04:58:34'),
(31, 'normal', 1, 'Noushad Nipun', NULL, 'noushad-nipun', NULL, '65', '43', '<p>They use to provide a lot of cleaning services and property maintenances, but I received only a window cleaning service from them. And I am so impressed with their services that I don\'t think I need to go anywhere else for any cleaning or property maintenances services ever as long as the current management is there. They are highly recommended for everyone; though not cheap but affordable.</p>', NULL, NULL, 'They use to provide a lot of cleaning services and property maintenances, but I received only a window cleaning service from them. And I am so impressed with their services that I don\'t think I need to go anywhere else for any cleaning or property maintenances services ever as long as the current management is there. They are highly recommended for everyone; though not cheap but affordable.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 1, 1, 1, NULL, NULL, 1, '2022-01-09 03:38:47', '2022-01-09 23:12:25'),
(32, 'normal', 1, 'fsdasdf', 'asdf', 'fsdasdf', 'Harunur Rashid', '65', '48', '<p>adfas</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 1, 1, 1, NULL, NULL, 1, '2022-01-20 09:28:25', '2022-01-20 09:28:25'),
(33, 'normal', 1, 'fsdasdf', 'asdf', 'fsdasdf', 'Harunur Rashid', '65', '48', '<p>adfas</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 1, 1, 1, NULL, NULL, 1, '2022-01-20 09:29:17', '2022-01-20 09:29:17'),
(34, 'normal', 1, 'asdfasdf', 'asdfa', 'asdfasdf', NULL, '65', '46', '<p>adfas</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 1, 1, 1, NULL, NULL, 1, '2022-01-20 09:29:56', '2022-01-20 09:29:56'),
(35, 'normal', 1, 'asdfasdf', 'asdfa', 'asdfasdf', NULL, '65', '46', '<p>adfas</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 1, 1, 1, NULL, NULL, 1, '2022-01-20 09:30:53', '2022-01-20 09:30:53'),
(36, 'normal', 1, 'asdfasdf', 'asdfa', 'asdfasdf', NULL, '65', '46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 1, 1, 1, NULL, NULL, 1, '2022-01-20 09:31:44', '2022-02-02 01:19:14');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sku` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `specification` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `unit_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('Global','General','Custom') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `code`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'super_admin', 'Global', NULL, '2021-07-31 08:59:44'),
(3, 'User', 'user', 'General', NULL, '2021-08-04 21:22:49'),
(4, 'Subordinate Manager', 'subordinate_manager', 'Custom', NULL, '2021-08-01 10:14:46'),
(6, 'Warehouse Manager', 'warehouse_manager', 'Custom', '2021-07-27 22:06:30', '2021-08-01 10:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `role_users`
--

CREATE TABLE `role_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `warehouse_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_users`
--

INSERT INTO `role_users` (`id`, `role_id`, `user_id`, `warehouse_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL, '2022-02-10 12:49:59'),
(54, 3, 17, NULL, '2021-07-30 01:00:08', '2021-07-30 01:00:08'),
(81, 3, 18, NULL, '2021-07-31 11:04:26', '2021-08-01 10:16:25'),
(116, 4, 18, 20, NULL, NULL),
(117, 6, 18, 21, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `route_groups`
--

CREATE TABLE `route_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `route_order` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `route_groups`
--

INSERT INTO `route_groups` (`id`, `name`, `code`, `route_order`, `created_at`, `updated_at`) VALUES
(46, 'Routelist', 'routelist', NULL, '2021-07-31 09:16:21', '2021-07-31 09:16:21'),
(47, 'User', 'user', NULL, '2021-07-31 09:16:22', '2021-07-31 09:16:22'),
(48, 'Role', 'role', NULL, '2021-07-31 09:16:22', '2021-07-31 09:16:22'),
(49, 'Warehouse', 'warehouse', NULL, '2021-07-31 09:16:22', '2021-07-31 09:16:22'),
(50, 'Product', 'product', NULL, '2021-07-31 09:16:22', '2021-07-31 09:16:22'),
(51, 'Dashboard', 'dashboard', 1, '2021-08-15 14:34:55', '2021-08-15 14:34:55'),
(52, 'Term', 'term', NULL, '2021-08-15 16:49:13', '2021-08-15 16:49:13'),
(53, 'Post', 'post', 3, '2021-08-16 15:45:03', '2021-08-16 15:45:03'),
(54, 'Media', 'media', NULL, '2021-08-19 06:30:09', '2021-08-19 06:30:09'),
(55, 'Common', 'common', NULL, NULL, NULL),
(56, 'Page', 'page', 2, '2021-08-22 23:05:35', '2021-08-22 23:05:35'),
(58, 'Settings', 'settings', NULL, '2021-09-04 20:56:34', '2021-09-04 20:56:34'),
(59, 'Gallery', 'gallery', NULL, '2021-09-29 10:36:43', '2021-09-29 10:36:43'),
(60, 'General Gallery', 'generalgallery', 4, '2022-01-09 03:57:49', '2022-01-09 03:57:49'),
(61, 'Service Gallery', 'servicegallery', 5, '2022-01-09 04:05:13', '2022-01-09 04:05:13'),
(62, 'Attribute', 'attribute', NULL, '2022-01-12 09:25:25', '2022-01-12 09:25:25'),
(63, 'Setting', 'setting', NULL, '2022-04-02 17:19:09', '2022-04-02 17:19:09'),
(64, 'Service Setting', 'servicesetting', NULL, '2022-04-05 13:31:32', '2022-04-05 13:31:32'),
(65, 'material Setting', 'materialsetting', NULL, '2022-04-12 13:56:12', '2022-04-12 13:56:12'),
(66, 'Input Type Setting', 'inputtypesetting', NULL, '2022-04-13 09:43:47', '2022-04-13 09:43:47');

-- --------------------------------------------------------

--
-- Table structure for table `route_lists`
--

CREATE TABLE `route_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `route_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `route_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `route_parameter` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `route_description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `route_group` bigint(20) UNSIGNED DEFAULT NULL,
  `route_icon` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `route_order` int(11) DEFAULT NULL,
  `route_hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `show_menu` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_menu_id` int(11) DEFAULT NULL,
  `dashboard_position` set('Left','Right','Top','Bottom') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `show_for` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `route_lists`
--

INSERT INTO `route_lists` (`id`, `route_title`, `route_name`, `route_parameter`, `route_description`, `route_group`, `route_icon`, `route_order`, `route_hash`, `show_menu`, `parent_menu_id`, `dashboard_position`, `show_for`, `created_at`, `updated_at`) VALUES
(163, 'Manage Route', 'routelist_index', NULL, 'Manage Route', 46, 'far fa-folder', NULL, '$2y$10$fpjEuRrQa9aOVmd3D47D3..FiYC8VuPI8haNXAo4I5C3PmvL0BarO', 'Yes', NULL, 'Top', NULL, NULL, '2021-12-21 05:00:49'),
(164, 'Add', 'routelist_create', NULL, 'Add', 46, 'far fa-folder', NULL, '$2y$10$5bWtz9ps8/XU6lVoD6EPWuVLNuVVbUvspR6VQ62SLakvp/k6ef.jS', 'Yes', NULL, 'Top', NULL, NULL, '2021-12-21 05:00:39'),
(165, 'Edit', 'routelist_edit', NULL, 'Edit', 46, 'far fa-folder', NULL, '$2y$10$fTuDtobgKcpBLHQCig2fYOVnEeNTCVz2f5nXEVGjQb31d0r3O8.xu', NULL, NULL, NULL, NULL, NULL, NULL),
(166, 'Delete', 'routelist_destroy', NULL, 'Delete', 46, 'far fa-folder', NULL, '$2y$10$P5eVGOl/RPKE7.EMplyzkegDs0ulv6VrPWp063NfVhJirJ1QmP1jS', NULL, NULL, NULL, NULL, NULL, NULL),
(167, 'Manage Users', 'user_index', NULL, 'Manage Users', 47, 'far fa-user', NULL, '$2y$10$nWxyvUghT/qVyP6lgZKvb.809Zi.dY08k7x3Po5zoU81mowZse08y', 'Yes', NULL, 'Top', NULL, NULL, '2021-12-21 05:01:19'),
(168, 'Add', 'user_create', NULL, 'Add', 47, 'far fa-user', NULL, '$2y$10$GAQ7Fj0U7uGfIe1aaLdc1eyz.eYKbIy7.dH71XDWdNG3S7myxei2u', 'Yes', NULL, 'Top', NULL, NULL, '2021-12-21 05:01:22'),
(169, 'Edit', 'user_edit', NULL, 'Edit', 47, 'far fa-folder', NULL, '$2y$10$OlJQybxRrm.eFIQGgJHjhOVs/oul.MjBZX2x8arDoc5AgcNAVbztG', NULL, NULL, NULL, NULL, NULL, NULL),
(170, 'Delete', 'user_destroy', NULL, 'Delete', 47, 'far fa-folder', NULL, '$2y$10$XEc00vnjFwr9SWmq1OmTqOw4kWEqkw.Lcl8z8P0NcQORN0hP5jMh2', NULL, NULL, NULL, NULL, NULL, NULL),
(172, 'Add', 'role_create', NULL, 'Add', 48, 'far fa-folder', 2, '$2y$10$VoLnQtJwtEbz4A4G8xZcvOFcCwD/yGFlkv2h4jP2d5NMCf0lrIvom', 'Yes', NULL, 'Top', NULL, NULL, '2021-12-21 06:05:06'),
(173, 'Edit', 'role_edit', NULL, 'Edit', 48, 'far fa-folder', NULL, '$2y$10$E..AhTdVphkEg8QcC0uKTOE7FTUTOu7.X3AalYdZ1NFDQUcNygJ46', NULL, NULL, NULL, NULL, NULL, NULL),
(174, 'Delete', 'role_destroy', NULL, 'Delete', 48, 'far fa-folder', NULL, '$2y$10$qHW6nGmKW.Y3L40RAHSEoeFafHrd2De8F2h1jI8L1kx6OHAdeRkum', NULL, NULL, NULL, NULL, NULL, NULL),
(175, 'Manage Zone', 'warehouse_index', NULL, 'Manage Warehouse', 49, 'far fa-folder', NULL, '$2y$10$TZfbAMSrrrDsD.lBAgI6Z.NCwRnbrYvWc0l1EUrtSLzYSFOGEQwJq', 'No', NULL, 'Left,Top', NULL, NULL, '2021-08-22 14:48:50'),
(176, 'Add', 'warehouse_create', NULL, 'Add', 49, 'far fa-folder', NULL, '$2y$10$PuIGLZ1yBoJS6nmw.DJnP.//5w0hovBJDOS.9XRueoKxRla6YPQBu', NULL, NULL, NULL, NULL, NULL, NULL),
(177, 'Edit', 'warehouse_edit', NULL, 'Edit', 49, 'far fa-folder', NULL, '$2y$10$1na.5XkzQUlzTQeIw1yozO8xI8sRAiPZd5nkqNPjXt2Dxmam4giRC', NULL, NULL, NULL, NULL, NULL, NULL),
(178, 'Delete', 'warehouse_destroy', NULL, 'Delete', 49, 'far fa-folder', NULL, '$2y$10$HAc.HuzUVCbo7honmmwawuMTMEXeECmIqP5FJT6J/2UP.L8PrE60W', NULL, NULL, NULL, NULL, NULL, NULL),
(179, 'View Warehouse', 'warehouse_single_index', NULL, 'View Warehouse', 49, 'far fa-folder', NULL, '$2y$10$gYsQbv7JMqJqm/bOaVxZ8.OX3QiO7sFw8n8vyDAUTV4Sx3n1lqSKO', NULL, NULL, NULL, NULL, NULL, NULL),
(183, 'Manage Products', 'product_index', NULL, 'Manage Products', 50, 'far fa-folder', NULL, '$2y$10$dna2K5v7xp9AnkoPrL2hZuKZnfQvtCedlgW68nvcvelugtNWK37zm', 'Yes', NULL, 'Left', 'Warehouse', NULL, '2021-08-04 21:16:32'),
(184, 'Manage Roles', 'role_index', NULL, 'Manage Roles', 48, 'far fa-folder', 1, '$2y$10$agxTJUZJWI1NcZTw9JvlxurywdpsbpZTeevCr1DnrNULGKZEwVQY2', 'Yes', NULL, 'Top', NULL, NULL, '2021-12-21 06:05:02'),
(186, 'Dashboard', 'admin_dashboard', NULL, 'User Dashboard', NULL, 'fas fa-th', 1, '$2y$10$d/UcNDlqPZ5KYxMy7lnx6.edsfu7kf2OCErvD8NEwuoPZE07UABKu', 'Yes', NULL, 'Left', NULL, NULL, '2021-08-22 16:19:53'),
(187, 'Categories', 'common_term_index', NULL, 'Manage Categories', NULL, 'far fa-folder', NULL, '$2y$10$ISVvq1rdT8Zdwwj4py/ZSe4PZuht5G1EUXTkVXacR4INf7RzZ2tWO', 'Yes', NULL, 'Top', NULL, NULL, '2022-01-13 06:48:07'),
(192, 'Edit', 'common_term_edit', NULL, 'Edit', 52, 'far fa-folder', NULL, '$2y$10$Cmg7Ibq/J4HGkyOha4hsbO7Ke453ZveVq1U6fyNOSqP1c9p6Hp7Dm', NULL, NULL, NULL, NULL, NULL, NULL),
(193, 'Delete', 'common_term_destroy', NULL, 'Delete', 52, 'far fa-folder', NULL, '$2y$10$fs66uIVGykkC5.TZpGtDLe94gDG8cU5kqmiDP03WEhr1x150y86si', NULL, NULL, NULL, NULL, NULL, NULL),
(194, 'Posts', 'common_post_index', NULL, 'Manage Posts', 53, 'far fa-folder', NULL, '$2y$10$3IvYcTI3xfcEEMquuHBd4.Nv35GH6ODbRvoy5R6j5nQytbhF8DPv.', 'Yes', NULL, 'Left', NULL, NULL, '2021-09-06 13:40:58'),
(195, 'Add Post', 'common_post_create', NULL, 'Add Post', 53, 'far fa-folder', NULL, '$2y$10$WqD5plYuMPvHbYHk9bF/rOLnKm3njmXc2f9H6AuGZC8oTliiQy2mi', 'Yes', NULL, 'Left', NULL, NULL, '2021-09-06 13:37:46'),
(196, 'Edit', 'common_post_edit', NULL, 'Edit', 53, 'far fa-folder', NULL, '$2y$10$3MAH3AgTDtVSOwDs8F9WruiKs5VAS4Gk6aGBVQDqxbw9RZgM/vemq', NULL, NULL, NULL, NULL, NULL, NULL),
(197, 'Delete', 'common_post_destroy', NULL, 'Delete', 53, 'far fa-folder', NULL, '$2y$10$8RWo45aeInSQV816vKEXhOn1LEHGxg/GMnJtuEJ5ZyE3Qc1/QAO/C', NULL, NULL, NULL, NULL, NULL, NULL),
(198, 'Medias', 'common_media_index', NULL, 'Manage Medias', NULL, 'fas fa-image', NULL, '$2y$10$IA4dCFa7cKAAvUD/sXJmw.yx979VV7wUB.uoC81t1qvCEM7tK9a6K', 'Yes', NULL, 'Top', NULL, NULL, '2022-01-10 08:12:26'),
(200, 'Edit', 'common_media_edit', NULL, 'Edit', 54, 'far fa-folder', NULL, '$2y$10$ywprhZ63CHoZglOwvQTlW.P/B5zioXTKk09boi3Nxp4NIMLU4ubgq', NULL, NULL, NULL, NULL, NULL, NULL),
(201, 'Delete', 'common_media_destroy', NULL, 'Delete', 54, 'far fa-folder', NULL, '$2y$10$JDdI1daUTjRrfgGdYpwHv.7kT1c2XCaKk5lN0YXyz3LXordnBNIk2', NULL, NULL, NULL, NULL, NULL, NULL),
(202, 'Pages', 'common_page_index', NULL, 'Manage Pages', 56, 'far fa-folder', NULL, '$2y$10$TTYgrapEVpKZa81XLVLuFO4vX2qDeoRqJZRBo.dOk7N3R/ISwmRf6', 'Yes', NULL, 'Left', NULL, NULL, '2021-09-06 13:40:43'),
(203, 'Add Page', 'common_page_create', NULL, 'Add', 56, 'far fa-folder', NULL, '$2y$10$Qo6wKa1wN6wza5GhlJeh3ezjJgdFuiWPXLNe5zKMk.oEgIzVqcsTG', 'Yes', NULL, 'Left', NULL, NULL, '2021-09-06 13:40:51'),
(204, 'Edit', 'common_page_edit', NULL, 'Edit', 56, 'far fa-folder', NULL, '$2y$10$Y2kA18HRGsq1zmSe5ItTsevcOBxYg12v1LAcdNoIH9mZkfF7ABxfG', NULL, NULL, NULL, NULL, NULL, NULL),
(205, 'Delete', 'common_page_destroy', NULL, 'Delete', 56, 'far fa-folder', NULL, '$2y$10$.CBbTOs4J.wjz4l7qzj1/u6QSrufj32u1svX9UOABk3osZiawZhUm', NULL, NULL, NULL, NULL, NULL, NULL),
(208, 'Menus', 'common_menus', NULL, 'Menus', 58, 'far fa-folder', 2, '$2y$10$n2fR01YOwsVSSdfTDPzLPebmzbFMfcoNdKrA6IOIrUT3tfDAREgPS', 'Yes', NULL, 'Top', NULL, NULL, '2021-12-21 05:01:49'),
(212, 'Global Settings', 'common_setting_index', NULL, 'Global Settings', 58, 'far fa-folder', NULL, '$2y$10$TxTu5XcISxDxKESqzeyiyu480uderbOOwneXgI.cek4LCXPUYDnO6', 'Yes', NULL, 'Top', NULL, NULL, '2021-12-21 03:14:54'),
(213, 'Edit', 'common_setting_edit', NULL, 'Edit', 58, 'far fa-folder', NULL, '$2y$10$Y.EPPqGOOkdv5/dWG6KOneVvuwT3DraT.JKiwl96nA52uXlUDsqz6', NULL, NULL, NULL, NULL, NULL, NULL),
(214, 'Delete', 'common_setting_destroy', NULL, 'Delete', 58, 'far fa-folder', NULL, '$2y$10$27G7NLlwj3Tq5IY0ubCfJu1VjNM3SxKx0gi.X6sDAdsMNbSpapVCS', NULL, NULL, NULL, NULL, NULL, NULL),
(222, 'Frontend Settings', 'common_setting_frontend_settings_index', NULL, 'Frontend Settings', 58, 'far fa-folder', NULL, '$2y$10$mk6NpL7m0MMNoOcsbdmsA.iNJ1LmgGouNLRZNuw1eYKkBbhzkHt.C', 'Yes', NULL, 'Top', NULL, NULL, '2021-12-21 03:15:20'),
(223, 'Manage Album', 'common_album_index', NULL, 'Manage Album', 60, 'far fa-folder', 2, '$2y$10$q5SPK0qExFeZG5lU6m5SQeqc4tVe83V5Qk7VtrtyCdwNnFwNjw/0y', 'Yes', NULL, 'Left', NULL, NULL, '2022-01-09 03:58:46'),
(224, 'Manage Parent Album', 'common_album_pcat_index', NULL, 'Manage Parent Album', 60, 'far fa-folder', 1, '$2y$10$rUSCYQ7gghYCCZN7eubIkOwlb1NIqxfMIQNkHI9tjkfaHcF93fexu', 'Yes', NULL, 'Left', NULL, NULL, '2022-01-09 03:58:41'),
(225, 'Manage Gallery', 'common_gallery_index', NULL, 'Manage Gallery', 60, 'far fa-folder', 3, '$2y$10$PNGUDV3WEjCnm4VHlX1c/.60ynet6jqOP2K5CCwj4AsdIzoethDxC', 'Yes', NULL, 'Left', NULL, NULL, '2022-01-09 03:58:49'),
(226, 'Manage Gallery', 'common_service_gallery_index', '', 'Manage Gallery', 61, 'far fa-folder', NULL, '$2y$10$VGDqsvK/BBkBdhRwLwjXzusDM/JT0rtJD81fkXIAwmsoztG6wzoiu', 'Yes', NULL, 'Left', NULL, NULL, '2022-01-09 04:05:49'),
(232, 'Manage Zone', 'attribute_zone_index', 'Zone', 'Manage Zone', 62, 'far fa-folder', NULL, '$2y$10$AII9Pc7zHCbD4CaWsL6SruhOnFpKIEXn20yfW5e2GAVKn9ZTGL7P.', 'Yes', NULL, 'Top', NULL, NULL, NULL),
(233, 'Manage Gender', 'attribute_gender_index', 'Gender', 'Manage Gender', 62, 'far fa-folder', NULL, '$2y$10$vWRE0tJLV5RJJ5skbKCHvOElJD6AMk9aVyfDIYI/h0DvhoDfxG7ou', 'Yes', NULL, 'Top', NULL, NULL, NULL),
(235, 'Delete', 'common_term_custom_field_destroy', '', 'Delete', 52, 'far fa-folder', NULL, '$2y$10$sBPjytOUEOCQ/JDOTn3zhu9mvQYIPUGG6YNtcxMW3jgrNc5LavB0S', NULL, NULL, NULL, NULL, NULL, NULL),
(236, 'Delete', 'common_term_breakdown_destroy', '', 'Delete', 52, 'far fa-folder', NULL, '$2y$10$DMMwz2Q2OUc5HhfAoQx79.3FbXI5Aed75IJyNPc8eit5.Z4CRG71m', NULL, NULL, NULL, NULL, NULL, NULL),
(237, 'Manage Calculator Setting', 'attribute_calculator setting_index', 'Calculator Setting', 'Manage Calculator Setting', 62, 'far fa-folder', NULL, '$2y$10$phVLX6rITApvV345PUdcGORLnk.Eln2UF0JNRFQ9JERHqUXIUnBZW', 'Yes', NULL, 'Top', NULL, NULL, NULL),
(238, 'Manage Calculator Setting', 'calculator_setting_index', '', 'Manage Calculator Setting', NULL, 'far fa-folder', NULL, '$2y$10$vbgJOuq8gl3wkWZMSdVgV.glYyksETC6n6ovfDDDJpb4Xva3c5VXW', NULL, NULL, NULL, NULL, NULL, NULL),
(239, 'Add', 'calculator_setting_create', '', 'Add', 63, 'far fa-folder', NULL, '$2y$10$ikZssEy654jKphl7tol0h.CvT3.XjcVedYgtA8UdZC8lR4JTPwvEa', NULL, NULL, NULL, NULL, NULL, NULL),
(240, 'Edit', 'calculator_setting_edit', '', 'Edit', 63, 'far fa-folder', NULL, '$2y$10$ZtSRleIqTQCMis6cj1HFvucOydTNv9q2mEHuwxfcKESqJ4kZEpozu', NULL, NULL, NULL, NULL, NULL, NULL),
(241, 'Delete', 'calculator_setting_destroy', '', 'Delete', 63, 'far fa-folder', NULL, '$2y$10$VmIOu2kKARD7cQibgybZBOamoCZVkBTQKsdzBkdR1MwHZzy3L5Vri', NULL, NULL, NULL, NULL, NULL, NULL),
(242, 'Manage Equation Type', 'attribute_equation type_index', 'Equation Type', 'Manage Equation Type', 62, 'far fa-folder', NULL, '$2y$10$MsGJCMtYaJ4SpuOCAxm1HOalXK5rMqtc5cnSreJzxnyGPAVcDOP72', 'Yes', NULL, 'Top', NULL, NULL, NULL),
(243, 'Manage Service Type', 'attribute_service type_index', 'Service Type', 'Manage Service Type', 62, 'far fa-folder', NULL, '$2y$10$4nKbVfTDGAfWX74PSPEhuOWAudYYVoUckd9dCdDXzKtSpdHiZ3U7a', 'Yes', NULL, 'Top', NULL, NULL, NULL),
(244, 'Manage Calculator Service Setting', 'calculator_service_setting_index', '', 'Manage Calculator Service Setting', NULL, 'far fa-folder', NULL, '$2y$10$aAmdPMwWG5WSIDqRxiDb5e9LhFHB64ue50rMGLqZ60yu65gBWMpf6', NULL, NULL, NULL, NULL, NULL, NULL),
(245, 'Add', 'calculator_service_setting_create', '', 'Add', 64, 'far fa-folder', NULL, '$2y$10$O2kXnWiMsvIG/5XaYQdakOUcluIdW3qopvw5E75qs/qedIqHVMA8.', NULL, NULL, NULL, NULL, NULL, NULL),
(246, 'Edit', 'calculator_service_setting_edit', '', 'Edit', 64, 'far fa-folder', NULL, '$2y$10$T.IkR0DgGKzG1MCAC8kciuaBbZu2tnupzeMGnwkEsJEJn6RViRcD6', NULL, NULL, NULL, NULL, NULL, NULL),
(247, 'Delete', 'calculator_service_setting_destroy', '', 'Delete', 64, 'far fa-folder', NULL, '$2y$10$UGa1ZZFdQa06OlVDtdBtm.RWH3p1Bkvox.5gAVT/hcvGPeq8MvCwC', NULL, NULL, NULL, NULL, NULL, NULL),
(249, 'Manage Counter Type', 'attribute_counter type_index', 'Counter Type', 'Manage Counter Type', 62, 'far fa-folder', NULL, '$2y$10$v1L5qkvU2Iafnjt7Xp1RcutqsAPLHcKuUwlFHkNPJXWafobUNbZnm', 'Yes', NULL, 'Top', NULL, NULL, NULL),
(250, 'Manage Calculation Type', 'attribute_calculation type_index', 'Calculation Type', 'Manage Calculation Type', 62, 'far fa-folder', NULL, '$2y$10$mzxODe.gHwnCF1aMdDqJRO7um7RRH5N4FnNEWj6hJrcpuR.Gp06/6', 'Yes', NULL, 'Top', NULL, NULL, NULL),
(252, 'Manage Calculator Material Setting', 'calculator_material_setting_index', '', 'Manage Calculator Material Setting', 65, 'far fa-folder', NULL, '$2y$10$Afw7t2z/ISFwaBIQAhBmdecz7lkQfX9m.KBzye.85tZ5O5IAZ0yzO', NULL, NULL, NULL, NULL, '2022-04-12 13:56:50', '2022-04-12 13:56:50'),
(253, 'Add', 'calculator_material_setting_create', '', 'Add', 65, 'far fa-folder', NULL, '$2y$10$Mt1OLgC4KuX6nIJcI/H3bu5DvgzgQhxjy9gyRMeAaOAnIEBnBq3.2', NULL, NULL, NULL, NULL, '2022-04-12 13:56:50', '2022-04-12 13:56:50'),
(254, 'Edit', 'calculator_material_setting_edit', '', 'Edit', 65, 'far fa-folder', NULL, '$2y$10$XwltZiaL/65YA/TPWdAvZun7ICRNpvnOmeswjNnYmeaQtcruWaZcG', NULL, NULL, NULL, NULL, '2022-04-12 13:56:50', '2022-04-12 13:56:50'),
(255, 'Delete', 'calculator_material_setting_destroy', '', 'Delete', 65, 'far fa-folder', NULL, '$2y$10$zGNTfv5MVeLSD4FHKBRjZuqG1dCXa4kZQs7qsmSiaNs1Hh8dgur2W', NULL, NULL, NULL, NULL, '2022-04-12 13:56:50', '2022-04-12 13:56:50'),
(256, 'Manage Input Type', 'attribute_input type_index', 'Input Type', 'Manage Input Type', 62, 'far fa-folder', NULL, '$2y$10$DMimiDAijkNU.AY4flZUWOnb6hX4JQYXlM0hqxJ1jtg.sL9MnRRzO', 'Yes', NULL, 'Top', NULL, '2022-04-12 13:57:13', '2022-04-12 13:57:13'),
(257, 'Delete', 'calculator_input_setting_destroy', '', 'Delete', 66, 'far fa-folder', NULL, '$2y$10$BEEzg1N2g2cdAFjSHuu6Q.hTVWOl4CnK1BfEE4xKE43UruLissfm.', NULL, NULL, NULL, NULL, '2022-04-13 09:43:48', '2022-04-13 09:43:48'),
(258, 'Manage Radio Type', 'attribute_radio type_index', 'Radio Type', 'Manage Radio Type', 62, 'far fa-folder', NULL, '$2y$10$.ZZD1ti4HEc32DK8e9TTceJSMkSodnEUPpH0ElGSO5ajSTIei6gUG', 'Yes', NULL, 'Top', NULL, '2022-04-13 09:44:25', '2022-04-13 09:44:25'),
(259, 'Manage Postcode', 'oz_postcode_index', '', 'Manage Postcode', 58, 'far fa-folder', NULL, '$2y$10$oJmfubvMtgwY/q.8rr4eR.QTGshLefFYAr4xtVOm5bV905BxQX2UG', 'Yes', NULL, 'Top', NULL, '2022-04-13 11:34:41', '2022-04-13 11:34:41'),
(260, 'Manage Coupon', 'oz_coupon_index', '', 'Manage Coupon', 58, 'far fa-folder', NULL, '$2y$10$m81LDZ0uCUkJc2GHRSAj5OXki.pD3srpyxNoe6PuiTVQtAvjMcarq', 'Yes', NULL, 'Top', NULL, '2022-04-21 13:20:13', '2022-04-21 13:20:13'),
(261, 'Manage Schedule', 'oz_schedule_index', '', 'Manage Schedule', 58, 'far fa-folder', NULL, '$2y$10$CQ0tYKv30G6/Xnz0FzlZme.UnyFx2MErecmVA.UFWZGMNzMKeNc8K', 'Yes', NULL, 'Top', NULL, '2022-05-06 13:04:06', '2022-05-06 13:04:06');

-- --------------------------------------------------------

--
-- Table structure for table `route_list_roles`
--

CREATE TABLE `route_list_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `route_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `route_list_roles`
--

INSERT INTO `route_list_roles` (`id`, `role_id`, `route_id`, `created_at`, `updated_at`) VALUES
(4, 3, 163, '2021-08-04 21:22:49', '2021-08-04 21:22:49'),
(5, 3, 165, '2021-08-04 21:22:49', '2021-08-04 21:22:49'),
(6, 3, 166, '2021-08-04 21:22:49', '2021-08-04 21:22:49');

-- --------------------------------------------------------

--
-- Table structure for table `seo_informations`
--

CREATE TABLE `seo_informations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `content_type` enum('Post','Page','Term') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_id` int(11) NOT NULL COMMENT 'It could be post id or page id or term id or any other content id',
  `meta_zone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `canonical_tags` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_author` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seo_informations`
--

INSERT INTO `seo_informations` (`id`, `content_type`, `content_id`, `meta_zone`, `meta_title`, `meta_description`, `meta_keywords`, `canonical_tags`, `meta_author`, `created_at`, `updated_at`) VALUES
(2, 'Term', 34, 'Sydney', 'End of lease cleaning in Sydney', 'sdds', 'fdfg,fhdfhdf', 'http://localhost/ubuntu/ozcleaners/admin/common/term/custom_field_seo/34?zone=Sydney', 'Samrat', '2022-01-18 11:58:36', '2022-05-18 14:39:46'),
(3, 'Term', 34, 'Melbourne', 'End of lease cleaning in Melbourne', 'End of lease cleaning in Melbourne', 'End of lease cleaning in Melbourne, melbourne lease cleaning', 'http://localhost/ubuntu/ozcleaners/admin/common/term/custom_field_seo/34?zone=Melbourne', 'Samrat', '2022-01-18 12:08:51', '2022-01-18 12:08:51'),
(4, 'Term', 34, 'Adelaide', 'End of lease cleaning in Adelaide', 'End of lease cleaning in Adelaide', 'End of lease cleaning in Adelaide', NULL, NULL, '2022-01-19 12:53:36', '2022-01-19 12:53:36'),
(5, 'Term', 2, NULL, 'fdfd', 'fd', 'fdf', NULL, NULL, '2022-01-20 09:04:18', '2022-01-20 09:13:25'),
(6, 'Term', 8, NULL, 'ay aijka', 'ay aijka', 'ay aijka', 'ay aijka', 'ay aijka', '2022-01-20 09:15:30', '2022-01-29 01:02:19'),
(7, 'Post', 36, NULL, 'Nipun Test', 'Nipun Test', 'Nipun Test', 'Nipun Test', 'Nipun Test', '2022-01-20 09:31:44', '2022-02-02 01:19:14'),
(8, 'Term', 7, NULL, 'Residential Property for australia', 'Residential Property for australia', 'Residential Property for australia', NULL, NULL, '2022-01-20 10:33:06', '2022-01-29 01:01:26'),
(9, 'Term', 9, NULL, NULL, NULL, NULL, NULL, NULL, '2022-01-22 23:48:21', '2022-01-29 01:02:06'),
(10, 'Term', 10, NULL, NULL, NULL, NULL, NULL, NULL, '2022-01-22 23:48:32', '2022-01-29 01:01:52'),
(11, 'Post', 27, NULL, NULL, NULL, NULL, NULL, NULL, '2022-01-29 08:47:14', '2022-01-29 08:47:33'),
(12, 'Post', 28, NULL, NULL, NULL, NULL, NULL, NULL, '2022-01-29 08:48:51', '2022-01-29 08:48:51'),
(13, 'Post', 11, NULL, NULL, NULL, NULL, NULL, NULL, '2022-01-30 14:35:38', '2022-01-30 14:36:46'),
(14, 'Post', 12, NULL, NULL, NULL, NULL, NULL, NULL, '2022-01-30 14:37:08', '2022-01-30 14:38:11'),
(15, 'Post', 19, NULL, NULL, NULL, NULL, NULL, NULL, '2022-01-30 14:38:53', '2022-01-30 14:38:53'),
(16, 'Term', 66, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-01 04:26:06', '2022-02-01 04:26:06'),
(17, 'Post', 26, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-02 01:19:30', '2022-02-02 01:19:30'),
(18, 'Term', 74, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-08 21:12:49', '2022-02-08 21:12:49'),
(19, 'Term', 57, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-18 14:39:55', '2022-05-18 14:39:55');

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE `terms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `which_editor` enum('normal','grapes','section') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `calculator_template` enum('regular','breakdown') COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `term_subtitle` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cat_theme` int(11) NOT NULL DEFAULT '1',
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  `cssid` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `cssclass` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `grapes_description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `grapes_css` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `term_short_description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `parent` int(11) DEFAULT NULL,
  `connected_with` int(11) DEFAULT NULL,
  `page_image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `thumb_image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `home_image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `term_menu_icon` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `term_menu_arrow` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `with_sub_menu` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `sub_menu_width` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `column_count` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `banner1` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `banner2` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `level_no` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `onpage_banner` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`id`, `which_editor`, `calculator_template`, `name`, `term_subtitle`, `seo_url`, `cat_theme`, `type`, `position`, `cssid`, `cssclass`, `description`, `grapes_description`, `grapes_css`, `term_short_description`, `parent`, `connected_with`, `page_image`, `thumb_image`, `home_image`, `term_menu_icon`, `term_menu_arrow`, `with_sub_menu`, `sub_menu_width`, `column_count`, `is_active`, `banner1`, `banner2`, `level_no`, `onpage_banner`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 'Posts', NULL, 'posts', 1, 'category', 1, 'category-1', 'category-1', 'Category 1', NULL, NULL, NULL, NULL, NULL, NULL, '8', NULL, NULL, NULL, '0', 'Category 1', 4, NULL, '26', '27', NULL, 'Category 1', '2021-08-15 16:26:29', '2021-08-15 16:26:29'),
(2, NULL, NULL, 'Products', NULL, 'products', 1, 'category', 2, 'sub-of-category-1', 'sub-of-category-1', 'Sub of Category 1', NULL, NULL, 'Sub of Category 1', NULL, NULL, NULL, '8', NULL, NULL, NULL, '0', '980', NULL, 1, '26', '27', NULL, NULL, '2021-08-15 21:09:42', '2022-01-20 09:13:25'),
(3, NULL, NULL, 'Services', NULL, 'services', 1, 'category', 3, 'services', 'services', '<p>services</p>', NULL, NULL, 'services', NULL, NULL, NULL, '8', NULL, NULL, NULL, '0', NULL, NULL, 1, '26', '27', NULL, NULL, '2021-08-15 21:10:24', '2021-08-24 05:54:54'),
(7, 'normal', NULL, 'Residential Property', 'Residential Property Cleaning Sub Title', 'residential-property', 1, 'category', 7, 'end-of-lease-cleaning', 'end-of-lease-cleaning', '<p>Residential Property Cleaning<br></p>', NULL, NULL, 'Residential Property Cleaning', 3, NULL, 'http://localhost/ubuntu/warehouse/storage/uploads/fullsize/2021-09/1_1630951547.jpg', '45', NULL, NULL, NULL, '0', NULL, NULL, 1, '26', '27', NULL, '69', '2021-09-06 06:36:20', '2022-01-29 01:01:26'),
(8, NULL, NULL, 'Commercial Property', NULL, 'commercial-property', 1, 'category', 8, 'commercial-property-cleaning', 'commercial-property-cleaning', NULL, NULL, NULL, NULL, 3, NULL, NULL, '8', NULL, NULL, NULL, '0', NULL, NULL, 1, '26', '27', NULL, '51', '2021-09-06 07:20:08', '2022-01-29 01:02:19'),
(9, NULL, NULL, 'Post Construction', NULL, 'post-construction', 1, 'category', 9, 'post-construction-cleaning', 'post-construction-cleaning', '<p>Post Construction Cleaning<br></p>', NULL, NULL, NULL, 3, NULL, NULL, '8', NULL, NULL, NULL, '0', NULL, NULL, 1, '26', '27', NULL, '53', '2021-09-06 07:20:22', '2022-01-29 01:02:06'),
(10, NULL, NULL, 'Strata', NULL, 'strata', 1, 'category', 10, 'strata-cleaning', 'strata-cleaning', '<p>Strata Cleaning<br></p>', NULL, NULL, NULL, 3, NULL, NULL, '8', NULL, NULL, NULL, '0', NULL, NULL, 1, '26', '27', NULL, '54', '2021-09-06 07:25:19', '2022-01-29 01:01:52'),
(11, NULL, NULL, 'Initial Cleaning', NULL, 'initial-cleaning', 1, 'category', 11, 'initial-cleaning', 'initial-cleaning', '<p>Initial Cleaning<br></p>', NULL, NULL, NULL, 9, NULL, NULL, '8', NULL, NULL, NULL, '0', NULL, NULL, NULL, '26', '27', NULL, NULL, '2021-09-06 07:25:38', '2021-09-06 07:25:38'),
(12, NULL, NULL, 'Final cleaning', NULL, 'final-cleaning', 1, 'category', 12, 'final-cleaning', 'final-cleaning', '<p>Final cleaning<br></p>', NULL, NULL, NULL, 9, NULL, NULL, '8', NULL, NULL, NULL, '0', NULL, NULL, NULL, '26', '27', NULL, NULL, '2021-09-06 07:25:51', '2021-09-06 07:25:51'),
(13, NULL, NULL, 'Window Cleaning', NULL, 'window-cleaning', 1, 'category', 13, 'window-cleaning', 'window-cleaning', '<p>Window Cleaning<br></p>', NULL, NULL, NULL, 9, NULL, NULL, '16', NULL, NULL, NULL, '0', NULL, NULL, 1, '26', '27', NULL, NULL, '2021-09-06 07:26:03', '2021-10-26 08:24:35'),
(14, NULL, NULL, 'High Pressure Cleaning', NULL, 'high-pressure-cleaning', 1, 'category', 14, 'high-pressure-cleaning', 'high-pressure-cleaning', '<p>High Pressure Cleaning<br></p>', NULL, NULL, NULL, 9, NULL, NULL, '8', NULL, NULL, NULL, '0', NULL, NULL, NULL, '26', '27', NULL, NULL, '2021-09-06 07:27:42', '2021-09-06 07:27:42'),
(15, NULL, NULL, 'Building Soft Washing', NULL, 'building-soft-washing', 1, 'category', 15, 'building-soft-washing', 'building-soft-washing', '<p>Building Soft Washing<br></p>', NULL, NULL, NULL, 9, NULL, NULL, '8', NULL, NULL, NULL, '0', NULL, NULL, NULL, '26', '27', NULL, NULL, '2021-09-06 07:27:53', '2021-09-06 07:27:53'),
(16, NULL, NULL, 'Grassing & Landscaping', NULL, 'grassing-and-landscaping', 1, 'category', 16, 'grassing-and-landscaping', 'grassing-and-landscaping', '<p>Grassing &amp; Landscaping<br></p>', NULL, NULL, NULL, 9, NULL, NULL, '8', NULL, NULL, NULL, '0', NULL, NULL, NULL, '26', '27', NULL, NULL, '2021-09-06 07:28:05', '2021-09-06 07:28:05'),
(18, NULL, NULL, 'Window Cleaning', NULL, 'window-cleaning-strata', 1, 'category', 17, 'window-cleaning', 'window-cleaning', NULL, NULL, NULL, NULL, 10, NULL, NULL, '8', NULL, NULL, NULL, '0', NULL, NULL, NULL, '26', '27', NULL, NULL, '2021-09-06 07:28:39', '2021-09-06 07:28:39'),
(19, NULL, NULL, 'Solar Panel Cleaning', NULL, 'solar-panel-cleaning', 1, 'category', 19, 'solar-panel-cleaning', 'solar-panel-cleaning', '<p>Solar Panel Cleaning<br></p>', NULL, NULL, NULL, 10, NULL, NULL, '8', NULL, NULL, NULL, '0', NULL, NULL, NULL, '26', '27', NULL, NULL, '2021-09-06 07:28:50', '2021-09-06 07:28:50'),
(20, NULL, NULL, 'Skylight Cleaning', NULL, 'skylight-cleaning', 1, 'category', 20, 'skylight-cleaning', 'skylight-cleaning', NULL, NULL, NULL, NULL, 10, NULL, NULL, '8', NULL, NULL, NULL, '0', NULL, NULL, NULL, '26', '27', NULL, NULL, '2021-09-06 09:58:08', '2021-09-06 09:58:08'),
(23, NULL, NULL, 'High Pressure Cleaning', NULL, 'high-pressure-cleaning-strata', 1, 'category', 21, 'high-pressure-cleaning', 'high-pressure-cleaning', '<p>High Pressure Cleaning<br></p>', NULL, NULL, NULL, 10, NULL, NULL, '8', NULL, NULL, NULL, '0', NULL, NULL, NULL, '26', '27', NULL, NULL, '2021-09-06 09:59:14', '2021-09-06 09:59:14'),
(24, NULL, NULL, 'Property Washing', NULL, 'property-washing', 1, 'category', 24, 'property-washing', 'property-washing', '<p>Property Washing<br></p>', NULL, NULL, NULL, 10, NULL, NULL, '8', NULL, NULL, NULL, '0', NULL, NULL, NULL, '26', '27', NULL, NULL, '2021-09-06 10:00:23', '2021-09-06 10:00:23'),
(25, NULL, NULL, 'Gutter Cleaning', NULL, 'gutter-cleaning', 1, 'category', 25, 'gutter-cleaning', 'gutter-cleaning', '<p>Gutter Cleaning<br></p>', NULL, NULL, NULL, 10, NULL, NULL, '8', NULL, NULL, NULL, '0', NULL, NULL, NULL, '26', '27', NULL, NULL, '2021-09-06 10:00:35', '2021-09-06 10:00:35'),
(26, NULL, NULL, 'End of Lease Cleaning', NULL, 'end-of-lease-cleaning', 1, 'category', 26, 'end-of-lease-cleaning', 'end-of-lease-cleaning', '<p>End of Lease Cleaning<br></p>', NULL, NULL, NULL, 8, NULL, NULL, '8', NULL, NULL, NULL, '0', NULL, NULL, NULL, '26', '27', NULL, NULL, '2021-09-06 10:00:54', '2021-09-06 10:00:54'),
(27, NULL, NULL, 'Carpet Steam Cleaning', NULL, 'carpet-steam-cleaning', 1, 'category', 27, 'carpet-steam-cleaning', 'carpet-steam-cleaning', '<p>Carpet Steam Cleaning<br></p>', NULL, NULL, NULL, 8, NULL, NULL, '8', NULL, NULL, NULL, '0', NULL, NULL, NULL, '26', '27', NULL, NULL, '2021-09-06 10:01:07', '2021-09-06 10:01:07'),
(28, NULL, NULL, 'Regular Office Cleaning', NULL, 'regular-office-cleaning', 1, 'category', 28, 'regular-office-cleaning', 'regular-office-cleaning', '<p>Regular Office Cleaning<br></p>', NULL, NULL, NULL, 8, NULL, NULL, '8', NULL, NULL, NULL, '0', NULL, NULL, NULL, '26', '27', NULL, NULL, '2021-09-06 10:03:08', '2021-09-06 10:03:08'),
(29, NULL, NULL, 'Window Cleaning', NULL, 'window-cleaning-commercial', 1, 'category', 29, 'window-cleaning', 'window-cleaning', '<p>Window Cleaning<br></p>', NULL, NULL, NULL, 8, NULL, NULL, '8', NULL, NULL, NULL, '0', NULL, NULL, NULL, '26', '27', NULL, NULL, '2021-09-06 10:03:28', '2021-09-06 10:03:28'),
(30, NULL, NULL, 'Tile & Grout Cleaning', 'Need help cleaning grout', 'tile-and-grout-cleaning', 1, 'category', 30, 'tile-and-grout-cleaning', 'tile-and-grout-cleaning', '<p>Tile &amp; Grout Cleaning<br></p>', NULL, NULL, 'Need help cleaning grout? I tested 10 popular homemade grout cleaners to figure out which DIY tile and grout cleaner works best.   The winning solution is an all-natural cleaner that brightens and whitens grout with only 2 simple ingredients. Learn the easy, healthy way to clean grout and tile today!', 8, NULL, 'http://localhost/ubuntu/ozcleaners/storage/uploads/fullsize/2021-10/cover1632979339_1634800793.png', '8', NULL, NULL, NULL, '0', NULL, NULL, 1, '26', '27', NULL, 'http://localhost/ubuntu/ozcleaners/storage/uploads/fullsize/2021-10/cover1632979339_1634800793.png', '2021-09-06 10:04:58', '2021-10-21 01:28:55'),
(31, NULL, NULL, 'High Pressure Cleaning', NULL, 'high-pressure-cleaning-commercial', 1, 'category', 31, 'high-pressure-cleaning', 'high-pressure-cleaning', '<p>High Pressure Cleaning<br></p>', NULL, NULL, NULL, 8, NULL, NULL, '8', NULL, NULL, NULL, '0', NULL, NULL, NULL, '26', '27', NULL, NULL, '2021-09-06 10:05:16', '2021-09-06 10:05:16'),
(32, NULL, NULL, 'Commercial Property Washing', NULL, 'commercial-property-washing', 1, 'category', 32, 'commercial-property-washing', 'commercial-property-washing', '<p>Commercial Property Washing<br></p>', NULL, NULL, NULL, 8, NULL, NULL, '8', NULL, NULL, NULL, '0', NULL, NULL, NULL, '26', '27', NULL, NULL, '2021-09-06 10:05:28', '2021-09-06 10:05:28'),
(33, NULL, NULL, 'Roof Cleaning & Painting', NULL, 'roof-cleaning-and-painting', 1, 'category', 33, 'roof-cleaning-and-painting', 'roof-cleaning-and-painting', '<p>Roof Cleaning &amp; Painting<br></p>', NULL, NULL, NULL, 8, NULL, NULL, '8', NULL, NULL, NULL, '0', NULL, NULL, NULL, '26', '27', NULL, NULL, '2021-09-06 10:05:44', '2021-09-06 10:05:44'),
(34, 'normal', 'regular', 'End of Lease Cleaning', 'End of Lease Cleaning Sub Title', 'end-of-lease-cleaning-residential', 1, 'category', 34, 'end-of-lease-cleaning', 'end-of-lease-cleaning', '<p>End of Lease Cleaning In Melbourne. Your Tenancy Cleaners\r\nif you’re looking for professional end of lease cleaners in Melbourne, then you have come to the right place. Singhz End of Lease Cleaning is a reliable end of tenancy cleaning company in Melbourne, VIC with over 10 years of experience. At our company, cleaning quality is our top priority. No matter how big or small the job is, we can do it for you.\r\n\r\nWe have a dedicated Melbourne end of lease cleaning team who are always ready at your disposal and our cleaning company is of real estate standards. Normally, an end of tenancy cleaning takes between 3 to 5 hours and 2-3 cleaners for a standard home of 2 bedrooms. But, it all depends on the size of property and condition. We recommend you contact us for more information</p>', NULL, NULL, 'Stop looking for an affordable end of lease cleaning service now; we are here to help. Just book our cleaning services online with 100% money back guarantee. For the end of lease cleaning Adelaide, we are the right choice because we never quit, doesn\'t mater how picky a real estate agent you got.', 7, NULL, NULL, '8', NULL, NULL, NULL, '0', NULL, NULL, 1, '26', '27', NULL, '23', '2021-09-06 10:06:03', '2022-05-18 14:39:46'),
(36, NULL, NULL, 'Carpet Steam Cleaning', 'Carpet Steam Cleaning sub title', 'carpet-steam-cleaning-residential', 1, 'category', 35, 'carpet-steam-cleaning', 'carpet-steam-cleaning', '<p>End of lease cleaning – do it yourself or give it to us Our Trusted Bond Cleaning Service</p><h2>EXPERIENCE A STRESS FREE BOND CLEANING WITH US</h2><p>When it comes to hiring professional end of lease cleaning services, then look no further than Bond Cleaning in Adelaide. With complete dedication and affordability, we have been delivering top notch cleaning services for both residential and commercial properties across Adelaide and its local suburbs. When it comes to hiring professional end of lease cleaning services, then look no further than Bond Cleaning in Adelaide. With complete dedication and affordability, we have been delivering top notch cleaning services for both residential and commercial properties across Adelaide and its local suburbs. When it comes to hiring professional end of lease cleaning services, then look no further than Bond Cleaning in Adelaide.</p><p><img src=\"https://www.bondcleaninginadelaide.com.au/wp-content/uploads/2018/09/service_detal-3.png\" alt=\"my_class_left\" style=\"font-size: 1rem;\"></p><p>With complete dedication and affordability, we have been delivering top notch cleaning services for both residential and commercial properties across Adelaide and its local suburbs. Our efficient and fully trained team of cleaners makes sure that your inspection goes smoothly and your property manager is a happy man at the end of the process. So, what are you waiting for? Let us clean your leased property to perfection! When it comes to hiring professional end of lease cleaning services, then look no further than Bond Cleaning in Adelaide. With complete dedication and affordability, we have been delivering top notch cleaning services for both residential and commercial properties across Adelaide and its local suburbs. When it comes to hiring professional end of lease cleaning services, then look no further than Bond Cleaning in Adelaide.&nbsp;</p><p><br></p><p>With complete dedication and affordability, we have been delivering top notch cleaning services for both residential and commercial properties across Adelaide and its local suburbs. When it comes to hiring professional end of lease cleaning services, then look no further than Bond Cleaning in Adelaide. With complete dedication and affordability, we have been delivering top notch cleaning services for both residential and commercial properties across Adelaide and its local suburbs. Our efficient and fully trained team of cleaners makes sure that your inspection goes smoothly and your property manager is a happy man at the end of the process. So, what are you waiting for? Let us clean your leased property to perfection! When it comes to hiring professional end of lease cleaning services, then look no further than Bond Cleaning in Adelaide. With complete dedication and affordability, we have been delivering top notch cleaning services for both residential and commercial properties across Adelaide and its local suburbs. When it comes to hiring professional end of lease cleaning services, then look no further than Bond Cleaning in Adelaide. With complete dedication and affordability, we have been delivering top notch cleaning services for both residential and commercial properties across Adelaide and its local suburbs. When it comes to hiring professional end of lease cleaning services, then look no further than Bond Cleaning in Adelaide. With complete dedication and affordability, we have been delivering top notch cleaning services for both residential and commercial properties across Adelaide and its local suburbs. Our efficient and fully trained team of cleaners makes sure that your inspection goes smoothly and your property manager is a happy man at the end of the process.&nbsp;</p><p><br></p><p>So, what are you waiting for? Let us clean your leased property to perfection! When it comes to hiring professional end of lease cleaning services, then look no further than Bond Cleaning in Adelaide. With complete dedication and affordability, we have been delivering top notch cleaning services for both residential and commercial properties across Adelaide and its local suburbs. When it comes to hiring professional end of lease cleaning services, then look no further than Bond Cleaning in Adelaide. With complete dedication and affordability, we have been delivering top notch cleaning services for both residential and commercial properties across Adelaide and its local suburbs. When it comes to hiring professional end of lease cleaning services, then look no further than Bond Cleaning in Adelaide. With complete dedication and affordability, we have been delivering top notch cleaning services for both residential and commercial properties across Adelaide and its local suburbs. Our efficient and fully trained team of cleaners makes sure that your inspection goes smoothly and your property manager is a happy man at the end of the process. So, what are you waiting for? Let us clean your leased property to perfection!<br></p>', NULL, NULL, 'Stop looking for an affordable end of lease cleaning service now; we are here to help. Just book our cleaning services online with 100% money back guarantee. For the end of lease cleaning Adelaide, we are the right choice because we never quit, doesn\'t mater how picky a real estate agent you got.', 7, NULL, NULL, '8', NULL, NULL, NULL, '0', NULL, NULL, 1, '26', '27', NULL, 'http://localhost/ubuntu/ozcleaners/storage/uploads/fullsize/2021-09/cover_1632981835.png', '2021-09-06 10:06:32', '2021-10-26 00:15:51'),
(37, NULL, NULL, 'Pre Inspection Cleaning', NULL, 'pre-inspection-cleaning', 1, 'category', 37, 'pre-inspection-cleaning', 'pre-inspection-cleaning', '<p>Pre Inspection Cleaning<br></p>', NULL, NULL, NULL, 7, NULL, NULL, '8', NULL, NULL, NULL, '0', NULL, NULL, 1, '26', '27', NULL, NULL, '2021-09-06 10:06:42', '2021-10-26 00:16:06'),
(38, NULL, NULL, 'Spring Cleaning', NULL, 'spring-cleaning', 1, 'category', 38, 'spring-cleaning', 'spring-cleaning', '<p>Spring Cleaning<br></p>', NULL, NULL, NULL, 7, NULL, NULL, '8', NULL, NULL, NULL, '0', NULL, NULL, 1, '26', '27', NULL, NULL, '2021-09-06 10:06:55', '2021-10-26 00:15:34'),
(39, NULL, NULL, 'Regular House Cleaning', NULL, 'regular-house-cleaning', 1, 'category', 39, 'regular-house-cleaning', 'regular-house-cleaning', '<p>Regular House Cleaning<br></p>', NULL, NULL, NULL, 7, NULL, NULL, '8', NULL, NULL, NULL, '0', NULL, NULL, 1, '26', '27', NULL, NULL, '2021-09-06 10:07:11', '2021-10-26 08:18:42'),
(51, NULL, NULL, 'Window Cleaning', NULL, 'window-cleaning_2121185947', 1, 'category', 40, 'window-cleaning', 'window-cleaning', '<p>Window Cleaning<br></p>', NULL, NULL, NULL, 7, NULL, NULL, '8', NULL, NULL, NULL, '0', NULL, NULL, NULL, '26', '27', NULL, NULL, '2021-09-06 11:31:00', '2021-09-06 11:31:00'),
(53, NULL, NULL, 'Solar Panel Cleaning', NULL, 'solar-panel-cleaning_1255027143', 1, 'category', 52, 'solar-panel-cleaning', 'solar-panel-cleaning', '<p>Solar Panel Cleaning<br></p>', NULL, NULL, NULL, 7, NULL, NULL, '8', NULL, NULL, NULL, '0', NULL, NULL, NULL, '26', '27', NULL, NULL, '2021-09-06 11:32:13', '2021-09-06 11:32:13'),
(55, NULL, NULL, 'Tile & Grout Cleaning', NULL, 'tile-and-grout-cleaning_382901595', 1, 'category', 54, 'tile-and-grout-cleaning', 'tile-and-grout-cleaning', '<p>Tile &amp; Grout Cleaning<br></p>', NULL, NULL, NULL, 7, NULL, NULL, '8', NULL, NULL, NULL, '0', NULL, NULL, NULL, '26', '27', NULL, NULL, '2021-09-06 11:32:24', '2021-09-06 11:32:24'),
(57, NULL, 'breakdown', 'High Pressure Cleaning', NULL, 'high-pressure-cleaning_297991953', 1, 'category', 56, 'high-pressure-cleaning', 'high-pressure-cleaning', '<p>High Pressure Cleaning<br></p>', NULL, NULL, NULL, 7, NULL, NULL, '8', NULL, NULL, NULL, '0', NULL, NULL, 1, '26', '27', NULL, NULL, '2021-09-06 11:32:36', '2022-05-18 14:39:55'),
(58, NULL, NULL, 'House Washing', NULL, 'house-washing', 1, 'category', 58, 'house-washing', 'house-washing', '<p>House Washing<br></p>', NULL, NULL, NULL, 7, NULL, NULL, '8', NULL, NULL, NULL, '0', NULL, NULL, NULL, '26', '27', NULL, NULL, '2021-09-06 11:32:49', '2021-09-06 11:32:49'),
(59, NULL, NULL, 'Gutter Cleaning & Repairing', NULL, 'gutter-cleaning-and-repairing', 1, 'category', 59, 'gutter-cleaning-and-repairing', 'gutter-cleaning-and-repairing', '<p>Gutter Cleaning &amp; Repairing<br></p>', NULL, NULL, NULL, 7, NULL, NULL, '8', NULL, NULL, NULL, '0', NULL, NULL, NULL, '26', '27', NULL, NULL, '2021-09-06 11:33:00', '2021-09-06 11:33:00'),
(61, NULL, NULL, 'Roof Cleaning & Painting', NULL, 'roof-cleaning-and-painting_33739761', 1, 'category', 60, 'roof-cleaning-and-painting', 'roof-cleaning-and-painting', '<p>Roof Cleaning &amp; Painting<br></p>', NULL, NULL, NULL, 7, NULL, NULL, '8', NULL, NULL, NULL, '0', NULL, NULL, NULL, '26', '27', NULL, NULL, '2021-09-06 11:33:11', '2021-09-06 11:33:11'),
(62, 'normal', NULL, 'FAQ', 'Questions in your mind are answered', 'faq', 1, 'category', 62, 'faq', 'faq', '<p>faq<br></p>', NULL, NULL, 'faq', 1, NULL, NULL, '8', NULL, NULL, NULL, '0', NULL, NULL, 1, '26', '27', NULL, NULL, '2021-10-22 12:45:25', '2021-10-22 13:02:54'),
(63, 'normal', NULL, 'Why Choose Us', NULL, 'why-choose-us', 1, 'category', 63, 'why-choose-us', 'why-choose-us', '<p>Why Choose Us<br></p>', NULL, NULL, NULL, 1, NULL, NULL, '8', NULL, NULL, NULL, '0', NULL, NULL, NULL, '26', '27', NULL, NULL, '2021-10-26 00:26:51', '2021-10-26 00:26:51'),
(64, 'normal', NULL, 'Simple step of booking', NULL, 'simple-step-of-booking', 1, 'category', 64, 'simple-step-of-booking', 'simple-step-of-booking', NULL, NULL, NULL, NULL, 1, NULL, NULL, '8', NULL, NULL, NULL, '0', NULL, NULL, NULL, '26', '27', NULL, NULL, '2021-10-26 03:25:55', '2021-10-26 03:25:55'),
(65, 'normal', NULL, 'Testimonial', 'What They Are Talking', 'testimonial', 1, 'category', 65, 'testimonial', 'testimonial', NULL, NULL, NULL, 'We value the experimentation, the reformation of the message, and the smart incentives. <br>We offer a variety of services and solutions Worldwide.', 1, NULL, NULL, '8', NULL, NULL, NULL, '0', NULL, NULL, 1, '26', '27', NULL, NULL, '2021-10-26 03:39:36', '2022-01-09 03:35:55'),
(66, 'normal', NULL, 'Pro Tips', 'We provide professional service', 'pro-tips', 1, 'category', 66, 'pro-tips', 'pro-tips', NULL, NULL, NULL, NULL, 1, NULL, NULL, '8', NULL, NULL, NULL, '0', NULL, NULL, 1, '26', '27', NULL, NULL, '2021-10-26 04:14:46', '2022-02-01 04:26:06'),
(67, 'normal', NULL, 'Our Portfolio', NULL, 'our-portfolio', 1, 'category', 67, 'our-portfolio', 'our-portfolio', NULL, NULL, NULL, NULL, 1, NULL, NULL, '8', NULL, NULL, NULL, '0', NULL, NULL, NULL, '26', '27', NULL, NULL, '2021-10-26 05:11:52', '2021-10-26 05:11:52'),
(68, 'normal', NULL, 'Portfolio', 'portfolio', 'portfolio', 1, 'category', 68, 'portfolio', 'portfolio', '<p>portfolio<br></p>', NULL, NULL, 'portfolio', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, '26', '27', NULL, NULL, '2021-10-26 14:59:13', '2021-10-26 14:59:13');

-- --------------------------------------------------------

--
-- Table structure for table `term_custom_fields`
--

CREATE TABLE `term_custom_fields` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `content_term_id` int(11) NOT NULL,
  `content_term_parent_id` int(11) DEFAULT NULL,
  `content_type` enum('Tabs','Text','Multiple Image','Bullets Vertical','Bullets Horizontal','Special Text','Vertical Tabs','Term Title','Why Choose Us','Left Image Content','Right Image Content','Side by Side Bullets','Before After','Extras','Left Image Content Without Title','Right Image Content Without Title') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_seo_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_sub_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_page_banner` int(11) DEFAULT NULL,
  `content_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `content_short_details` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_zone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sorting_order` int(11) DEFAULT NULL,
  `bg_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` enum('Yes','No') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `term_custom_fields`
--

INSERT INTO `term_custom_fields` (`id`, `content_term_id`, `content_term_parent_id`, `content_type`, `content_title`, `content_seo_url`, `content_sub_title`, `content_image`, `content_page_banner`, `content_details`, `content_short_details`, `content_zone`, `sorting_order`, `bg_color`, `is_active`, `created_at`, `updated_at`) VALUES
(2, 34, NULL, 'Before After', 'Gallery At a glance', NULL, NULL, '8', NULL, '<p>End of lease cleaning service inclusion</p>', NULL, 'Adelaide', 1, NULL, NULL, '2021-10-20 06:26:03', '2022-04-04 15:18:10'),
(3, 34, NULL, 'Tabs', 'End of Lease Cleaning In Melbourne', 'end-of-lease-cleaning-in-melbourne', 'End of lease cleaning is important because when the rental property is thoroughly cleaned', '8', NULL, 'End of lease cleaning is important because when the rental property is thoroughly cleaned', 'End of lease cleaning is important because when the rental property is thoroughly cleaned', 'Adelaide', 2, NULL, NULL, '2021-10-20 17:10:34', '2022-04-04 15:18:10'),
(5, 34, NULL, 'Bullets Vertical', 'Some important things you should know before booking our end of lease cleaning service', NULL, NULL, '72', NULL, 'For the following service we charge extra in our end of lease cleaning services', 'Please note, we will take before and after photos of the above items for comparison and quality control purposes', 'Adelaide', 3, NULL, NULL, '2021-10-20 21:09:49', '2022-04-04 15:18:10'),
(7, 34, NULL, 'Special Text', 'To provide the following service we charge extra in our end of lease cleaning services', NULL, NULL, '8', NULL, '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s</p>', NULL, 'Adelaide', 5, NULL, NULL, '2021-10-22 06:06:58', '2022-04-04 15:18:10'),
(8, 34, NULL, 'Side by Side Bullets', 'What\'s included in your end of lease clean service', 'whats-included-in-your-end-of-lease-clean-service', NULL, '8', NULL, '<p>When you book an End of Lease clean you’ll benefit from top-rated professional cleaners with a 100% happiness guarantee. Our cleaners bring all required cleaning products and equipment and work hard to get your job done on time.</p>', 'For following service we charge extra in our end of lease cleaning services', 'Adelaide', 6, NULL, NULL, '2021-10-22 06:08:23', '2022-04-04 15:18:10'),
(9, 34, NULL, 'Vertical Tabs', 'Inclusion', NULL, NULL, '8', NULL, '<p>General<br></p>', NULL, 'Adelaide', 7, NULL, NULL, '2021-10-30 08:11:34', '2022-04-04 15:18:10'),
(24, 34, 7, 'Term Title', 'End of Lease <span>Cleaning</span>', 'end-of-lease-cleaning', NULL, '77', 77, '<p>End of Lease <strong>Cleaning In Sydney</strong><br></p><p>\r\n\r\nEnd of Lease Cleaning In Melbourne. Your Tenancy Cleaners if you’re looking for professional end of lease cleaners in Melbourne, then you have come to the right place</p>', 'End of Lease Cleaning In Melbourne. Your Tenancy Cleaners if you’re looking for professional end of lease cleaners in Melbourne, then you have come to the right place.', 'Adelaide', 0, '#ffffff', 'Yes', '2022-01-19 12:19:32', '2022-02-10 10:53:07'),
(26, 34, 7, 'Why Choose Us', 'Why choose us', 'why-choose-us', NULL, '50', NULL, '<p>Services we provide</p>', NULL, 'Adelaide', 4, '#f5f5f5', 'Yes', '2022-01-23 04:25:14', '2022-01-29 08:06:00'),
(27, 34, 7, 'Left Image Content', 'Bond Cleaning <span>In Adelaide</span>', 'bond-cleaning-spanin-adelaide', 'We work relentlessly to get your bond back and provide ultimate cleaning.', '54', NULL, '<p>We as a professional bond cleaning company knows the hassles involved in getting the bond amount back from property managers. Meeting the strict cleaning standards of real estate agents and property owners can be difficult for a tenant. They need professional assistance from a reliable cleaning company like us. Our Our end of lease cleaners in Adelaide use the REISA approved cleaning checklist to provide you with thorough and safe end of lease cleaning. We go the extra mile to get your bond back.</p>\r\n<p>&nbsp;</p>\r\n<p>Our team is fully equipped with high end equipment and cleaning products that leave all the dirtiest areas spotless and clean. You can focus on your move and let us clean your leased property thoroughly using safe and environmentally friendly cleaning products. Hire our bond cleaning service for an affordable and effortless clean-up of your property.</p>', NULL, 'Adelaide', 2, NULL, NULL, '2022-01-23 14:44:47', '2022-01-29 08:06:00'),
(28, 34, 7, 'Right Image Content', 'EXPERIENCE A STRESS FREE BOND CLEANING WITH US', 'experience-a-stress-free-bond-cleaning-with-us', 'Our Trusted Bond Cleaning Service', '51', NULL, '<p>When it comes to hiring professional end of lease cleaning services, then look no further than Bond Cleaning in Adelaide. With complete dedication and affordability, we have been delivering top notch cleaning services for both residential and commercial properties across Adelaide and its local suburbs.</p><p>Our efficient and fully trained team of cleaners makes sure that your inspection goes smoothly and your property manager is a happy man at the end of the process. So, what are you waiting for? Let us clean your leased property to perfection!<br></p>', NULL, 'Adelaide', 6, '#000000', NULL, '2022-01-23 15:01:21', '2022-01-29 08:06:00'),
(29, 34, 7, 'Right Image Content', 'New Content <span>By Emran</span>', 'new-content-spanby-emranspan', NULL, '53', NULL, '<p>As an end of lease cleaning service provider in Adelaide, we are not the best, but still, our competitors hate us.</p><p>No, wrong if you think because we charge the least money to provide any end of lease cleaning service. We must say we are not the cheapest but affordable than many other competitors in the market.</p><p>Other bond cleanings or exit cleaning service providers hate us because our clients love us. They do marketing for us to their friends and families. They advise us about how to make our service better and so on.</p><p>To beat the competition, now most cleaning companies provide a 100% bond back guarantee with their bond cleaning services. No doubt everyone\'s finger crosses for no issues after leaving the property.</p>', NULL, 'Adelaide', 3, '#e8e8e8', NULL, '2022-01-24 08:05:45', '2022-01-29 08:06:00'),
(30, 34, 7, 'Extras', 'Extra Services', 'extra-services', 'Extra Services', NULL, NULL, '<p>Extra Services<br></p>', NULL, 'Adelaide', 10, '#f2f2f2', 'Yes', '2022-01-28 17:41:59', '2022-01-29 08:06:00'),
(31, 26, 8, 'Term Title', 'try', 'try', 'try', NULL, NULL, '<p>try<br></p>', 'try', 'Adelaide', 1, '#ffffff', 'Yes', '2022-01-31 05:38:27', '2022-01-31 05:38:27'),
(49, 37, NULL, 'Before After', 'Gallery At a glance', 'copy-4e3d27da', NULL, '8', NULL, '<p>End of lease cleaning service inclusion</p>', NULL, 'Adelaide', 8, NULL, NULL, '2021-10-20 06:26:03', '2022-01-29 08:06:00'),
(50, 37, NULL, 'Tabs', 'End of Lease Cleaning In Melbourne', 'end-of-lease-cleaning-in-melbournecopy-10bf514a', 'End of lease cleaning is important because when the rental property is thoroughly cleaned', '8', NULL, 'End of lease cleaning is important because when the rental property is thoroughly cleaned', 'End of lease cleaning is important because when the rental property is thoroughly cleaned', 'Adelaide', 1, NULL, NULL, '2021-10-20 17:10:34', '2022-01-29 08:06:00'),
(51, 37, NULL, 'Bullets Vertical', 'Some important things you should know before booking our end of lease cleaning service', 'copy-ca75dcbe', NULL, '72', NULL, 'For the following service we charge extra in our end of lease cleaning services', 'Please note, we will take before and after photos of the above items for comparison and quality control purposes', 'Adelaide', 11, NULL, NULL, '2021-10-20 21:09:49', '2022-01-29 08:06:00'),
(52, 37, NULL, 'Special Text', 'To provide the following service we charge extra in our end of lease cleaning services', 'copy-b324ec29', NULL, '8', NULL, '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s</p>', NULL, 'Adelaide', 5, NULL, NULL, '2021-10-22 06:06:58', '2022-01-29 08:06:00'),
(53, 37, NULL, 'Side by Side Bullets', 'What\'s included in your end of lease clean service', 'whats-included-in-your-end-of-lease-clean-servicecopy-70b17806', NULL, '8', NULL, '<p>When you book an End of Lease clean you’ll benefit from top-rated professional cleaners with a 100% happiness guarantee. Our cleaners bring all required cleaning products and equipment and work hard to get your job done on time.</p>', 'For following service we charge extra in our end of lease cleaning services', 'Adelaide', 9, NULL, NULL, '2021-10-22 06:08:23', '2022-01-29 08:06:00'),
(54, 37, NULL, 'Vertical Tabs', 'Inclusion', 'copy-7482af0e', NULL, '8', NULL, '<p>General<br></p>', NULL, 'Adelaide', 7, NULL, NULL, '2021-10-30 08:11:34', '2022-01-29 08:06:00'),
(55, 37, 7, 'Term Title', 'End of Lease <span>Cleaning</span>', 'end-of-lease-cleaningcopy-b9a40f50', NULL, '9', 9, '<p>End of Lease <strong>Cleaning In Sydney</strong><br></p><p>\r\n\r\nEnd of Lease Cleaning In Melbourne. Your Tenancy Cleaners if you’re looking for professional end of lease cleaners in Melbourne, then you have come to the right place</p>', 'End of Lease Cleaning In Melbourne. Your Tenancy Cleaners if you’re looking for professional end of lease cleaners in Melbourne, then you have come to the right place.', 'Adelaide', 0, '#ffffff', 'Yes', '2022-01-19 12:19:32', '2022-02-01 04:35:21'),
(56, 37, 7, 'Why Choose Us', 'Why choose us', 'why-choose-uscopy-b49a5eb3', NULL, '50', NULL, '<p>Services we provide</p>', NULL, 'Adelaide', 4, '#f5f5f5', 'Yes', '2022-01-23 04:25:14', '2022-01-29 08:06:00'),
(57, 37, 7, 'Left Image Content', 'Bond Cleaning <span>In Adelaide</span>', 'bond-cleaning-spanin-adelaidecopy-d1f70f1e', 'We work relentlessly to get your bond back and provide ultimate cleaning.', '54', NULL, '<p>We as a professional bond cleaning company knows the hassles involved in getting the bond amount back from property managers. Meeting the strict cleaning standards of real estate agents and property owners can be difficult for a tenant. They need professional assistance from a reliable cleaning company like us. Our Our end of lease cleaners in Adelaide use the REISA approved cleaning checklist to provide you with thorough and safe end of lease cleaning. We go the extra mile to get your bond back.</p>\r\n<p>&nbsp;</p>\r\n<p>Our team is fully equipped with high end equipment and cleaning products that leave all the dirtiest areas spotless and clean. You can focus on your move and let us clean your leased property thoroughly using safe and environmentally friendly cleaning products. Hire our bond cleaning service for an affordable and effortless clean-up of your property.</p>', NULL, 'Adelaide', 2, NULL, NULL, '2022-01-23 14:44:47', '2022-01-29 08:06:00'),
(58, 37, 7, 'Right Image Content', 'EXPERIENCE A STRESS FREE BOND CLEANING WITH US', 'experience-a-stress-free-bond-cleaning-with-uscopy-33ee05fa', 'Our Trusted Bond Cleaning Service', '51', NULL, '<p>When it comes to hiring professional end of lease cleaning services, then look no further than Bond Cleaning in Adelaide. With complete dedication and affordability, we have been delivering top notch cleaning services for both residential and commercial properties across Adelaide and its local suburbs.</p><p>Our efficient and fully trained team of cleaners makes sure that your inspection goes smoothly and your property manager is a happy man at the end of the process. So, what are you waiting for? Let us clean your leased property to perfection!<br></p>', NULL, 'Adelaide', 6, '#000000', NULL, '2022-01-23 15:01:21', '2022-01-29 08:06:00'),
(59, 37, 7, 'Right Image Content', 'New Content <span>By Emran</span>', 'new-content-spanby-emranspancopy-43cc86c4', NULL, '53', NULL, '<p>As an end of lease cleaning service provider in Adelaide, we are not the best, but still, our competitors hate us.</p><p>No, wrong if you think because we charge the least money to provide any end of lease cleaning service. We must say we are not the cheapest but affordable than many other competitors in the market.</p><p>Other bond cleanings or exit cleaning service providers hate us because our clients love us. They do marketing for us to their friends and families. They advise us about how to make our service better and so on.</p><p>To beat the competition, now most cleaning companies provide a 100% bond back guarantee with their bond cleaning services. No doubt everyone\'s finger crosses for no issues after leaving the property.</p>', NULL, 'Adelaide', 3, '#e8e8e8', NULL, '2022-01-24 08:05:45', '2022-01-29 08:06:00'),
(60, 37, 7, 'Extras', 'Extra Services', 'extra-servicescopy-202c45a5', 'Extra Services', NULL, NULL, '<p>Extra Services<br></p>', NULL, 'Adelaide', 10, '#f2f2f2', 'Yes', '2022-01-28 17:41:59', '2022-01-29 08:06:00'),
(73, 28, 8, 'Before After', 'Gallery At a glance', NULL, NULL, '8', NULL, '<p>End of lease cleaning service inclusion</p>', NULL, 'Adelaide', 8, NULL, NULL, '2021-10-20 06:26:03', '2022-01-29 08:06:00'),
(75, 28, 8, 'Before After', 'Gallery At a glance', NULL, NULL, '8', NULL, '<p>End of lease cleaning service inclusion</p>', NULL, 'Adelaide', 8, NULL, NULL, '2021-10-20 06:26:03', '2022-01-29 08:06:00'),
(76, 28, 8, 'Tabs', 'End of Lease Cleaning In Melbourne', 'end-of-lease-cleaning-in-melbourne', 'End of lease cleaning is important because when the rental property is thoroughly cleaned', '8', NULL, 'End of lease cleaning is important because when the rental property is thoroughly cleaned', 'End of lease cleaning is important because when the rental property is thoroughly cleaned', 'Adelaide', 1, NULL, NULL, '2021-10-20 17:10:34', '2022-01-29 08:06:00'),
(77, 28, 8, 'Bullets Vertical', 'Some important things you should know before booking our end of lease cleaning service', NULL, NULL, '72', NULL, 'For the following service we charge extra in our end of lease cleaning services', 'Please note, we will take before and after photos of the above items for comparison and quality control purposes', 'Adelaide', 11, NULL, NULL, '2021-10-20 21:09:49', '2022-01-29 08:06:00'),
(78, 28, 8, 'Special Text', 'To provide the following service we charge extra in our end of lease cleaning services', NULL, NULL, '8', NULL, '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s</p>', NULL, 'Adelaide', 5, NULL, NULL, '2021-10-22 06:06:58', '2022-01-29 08:06:00'),
(79, 28, 8, 'Side by Side Bullets', 'What\'s included in your end of lease clean service', 'whats-included-in-your-end-of-lease-clean-service', NULL, '8', NULL, '<p>When you book an End of Lease clean you’ll benefit from top-rated professional cleaners with a 100% happiness guarantee. Our cleaners bring all required cleaning products and equipment and work hard to get your job done on time.</p>', 'For following service we charge extra in our end of lease cleaning services', 'Adelaide', 9, NULL, NULL, '2021-10-22 06:08:23', '2022-01-29 08:06:00'),
(80, 28, 8, 'Vertical Tabs', 'Inclusion', NULL, NULL, '8', NULL, '<p>General<br></p>', NULL, 'Adelaide', 7, NULL, NULL, '2021-10-30 08:11:34', '2022-01-29 08:06:00'),
(81, 28, 8, 'Term Title', 'End of Lease <span>Cleaning</span>', 'end-of-lease-cleaning', NULL, '9', 9, '<p>End of Lease <strong>Cleaning In Sydney</strong><br></p><p>\r\n\r\nEnd of Lease Cleaning In Melbourne. Your Tenancy Cleaners if you’re looking for professional end of lease cleaners in Melbourne, then you have come to the right place</p>', 'End of Lease Cleaning In Melbourne. Your Tenancy Cleaners if you’re looking for professional end of lease cleaners in Melbourne, then you have come to the right place.', 'Adelaide', 0, '#ffffff', 'Yes', '2022-01-19 12:19:32', '2022-02-01 04:35:21'),
(82, 28, 8, 'Why Choose Us', 'Why choose us', 'why-choose-us', NULL, '50', NULL, '<p>Services we provide</p>', NULL, 'Adelaide', 4, '#f5f5f5', 'Yes', '2022-01-23 04:25:14', '2022-01-29 08:06:00'),
(83, 28, 8, 'Left Image Content', 'Bond Cleaning <span>In Adelaide</span>', 'bond-cleaning-spanin-adelaide', 'We work relentlessly to get your bond back and provide ultimate cleaning.', '54', NULL, '<p>We as a professional bond cleaning company knows the hassles involved in getting the bond amount back from property managers. Meeting the strict cleaning standards of real estate agents and property owners can be difficult for a tenant. They need professional assistance from a reliable cleaning company like us. Our Our end of lease cleaners in Adelaide use the REISA approved cleaning checklist to provide you with thorough and safe end of lease cleaning. We go the extra mile to get your bond back.</p>\r\n<p>&nbsp;</p>\r\n<p>Our team is fully equipped with high end equipment and cleaning products that leave all the dirtiest areas spotless and clean. You can focus on your move and let us clean your leased property thoroughly using safe and environmentally friendly cleaning products. Hire our bond cleaning service for an affordable and effortless clean-up of your property.</p>', NULL, 'Adelaide', 2, NULL, NULL, '2022-01-23 14:44:47', '2022-01-29 08:06:00'),
(84, 28, 8, 'Right Image Content', 'EXPERIENCE A STRESS FREE BOND CLEANING WITH US', 'experience-a-stress-free-bond-cleaning-with-us', 'Our Trusted Bond Cleaning Service', '51', NULL, '<p>When it comes to hiring professional end of lease cleaning services, then look no further than Bond Cleaning in Adelaide. With complete dedication and affordability, we have been delivering top notch cleaning services for both residential and commercial properties across Adelaide and its local suburbs.</p><p>Our efficient and fully trained team of cleaners makes sure that your inspection goes smoothly and your property manager is a happy man at the end of the process. So, what are you waiting for? Let us clean your leased property to perfection!<br></p>', NULL, 'Adelaide', 6, '#000000', NULL, '2022-01-23 15:01:21', '2022-01-29 08:06:00'),
(85, 28, 8, 'Right Image Content', 'New Content <span>By Emran</span>', 'new-content-spanby-emranspan', NULL, '53', NULL, '<p>As an end of lease cleaning service provider in Adelaide, we are not the best, but still, our competitors hate us.</p><p>No, wrong if you think because we charge the least money to provide any end of lease cleaning service. We must say we are not the cheapest but affordable than many other competitors in the market.</p><p>Other bond cleanings or exit cleaning service providers hate us because our clients love us. They do marketing for us to their friends and families. They advise us about how to make our service better and so on.</p><p>To beat the competition, now most cleaning companies provide a 100% bond back guarantee with their bond cleaning services. No doubt everyone\'s finger crosses for no issues after leaving the property.</p>', NULL, 'Adelaide', 3, '#e8e8e8', NULL, '2022-01-24 08:05:45', '2022-01-29 08:06:00'),
(86, 28, 8, 'Extras', 'Extra Services', 'extra-services', 'Extra Services', NULL, NULL, '<p>Extra Services<br></p>', NULL, 'Adelaide', 10, '#f2f2f2', 'Yes', '2022-01-28 17:41:59', '2022-01-29 08:06:00'),
(100, 61, 7, 'Before After', 'Gallery At a glance', NULL, NULL, '8', NULL, '<p>End of lease cleaning service inclusion</p>', NULL, 'Adelaide', 8, NULL, NULL, '2021-10-20 06:26:03', '2022-01-29 08:06:00'),
(101, 61, 7, 'Tabs', 'End of Lease Cleaning In Melbourne', 'end-of-lease-cleaning-in-melbourne', 'End of lease cleaning is important because when the rental property is thoroughly cleaned', '8', NULL, 'End of lease cleaning is important because when the rental property is thoroughly cleaned', 'End of lease cleaning is important because when the rental property is thoroughly cleaned', 'Adelaide', 1, NULL, NULL, '2021-10-20 17:10:34', '2022-01-29 08:06:00'),
(102, 61, 7, 'Bullets Vertical', 'Some important things you should know before booking our end of lease cleaning service', NULL, NULL, '72', NULL, 'For the following service we charge extra in our end of lease cleaning services', 'Please note, we will take before and after photos of the above items for comparison and quality control purposes', 'Adelaide', 11, NULL, NULL, '2021-10-20 21:09:49', '2022-01-29 08:06:00'),
(103, 61, 7, 'Special Text', 'To provide the following service we charge extra in our end of lease cleaning services', NULL, NULL, '8', NULL, '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s</p>', NULL, 'Adelaide', 5, NULL, NULL, '2021-10-22 06:06:58', '2022-01-29 08:06:00'),
(104, 61, 7, 'Side by Side Bullets', 'What\'s included in your end of lease clean service', 'whats-included-in-your-end-of-lease-clean-service', NULL, '8', NULL, '<p>When you book an End of Lease clean you’ll benefit from top-rated professional cleaners with a 100% happiness guarantee. Our cleaners bring all required cleaning products and equipment and work hard to get your job done on time.</p>', 'For following service we charge extra in our end of lease cleaning services', 'Adelaide', 9, NULL, NULL, '2021-10-22 06:08:23', '2022-01-29 08:06:00'),
(105, 61, 7, 'Vertical Tabs', 'Inclusion', NULL, NULL, '8', NULL, '<p>General<br></p>', NULL, 'Adelaide', 7, NULL, NULL, '2021-10-30 08:11:34', '2022-01-29 08:06:00'),
(106, 61, 7, 'Term Title', 'End of Lease <span>Cleaning</span>', 'end-of-lease-cleaning', NULL, '9', 9, '<p>End of Lease <strong>Cleaning In Sydney</strong><br></p><p>\r\n\r\nEnd of Lease Cleaning In Melbourne. Your Tenancy Cleaners if you’re looking for professional end of lease cleaners in Melbourne, then you have come to the right place</p>', 'End of Lease Cleaning In Melbourne. Your Tenancy Cleaners if you’re looking for professional end of lease cleaners in Melbourne, then you have come to the right place.', 'Adelaide', 0, '#ffffff', 'Yes', '2022-01-19 12:19:32', '2022-02-01 04:35:21'),
(107, 61, 7, 'Why Choose Us', 'Why choose us', 'why-choose-us', NULL, '50', NULL, '<p>Services we provide</p>', NULL, 'Adelaide', 4, '#f5f5f5', 'Yes', '2022-01-23 04:25:14', '2022-01-29 08:06:00'),
(108, 61, 7, 'Left Image Content', 'Bond Cleaning <span>In Adelaide</span>', 'bond-cleaning-spanin-adelaide', 'We work relentlessly to get your bond back and provide ultimate cleaning.', '54', NULL, '<p>We as a professional bond cleaning company knows the hassles involved in getting the bond amount back from property managers. Meeting the strict cleaning standards of real estate agents and property owners can be difficult for a tenant. They need professional assistance from a reliable cleaning company like us. Our Our end of lease cleaners in Adelaide use the REISA approved cleaning checklist to provide you with thorough and safe end of lease cleaning. We go the extra mile to get your bond back.</p>\r\n<p>&nbsp;</p>\r\n<p>Our team is fully equipped with high end equipment and cleaning products that leave all the dirtiest areas spotless and clean. You can focus on your move and let us clean your leased property thoroughly using safe and environmentally friendly cleaning products. Hire our bond cleaning service for an affordable and effortless clean-up of your property.</p>', NULL, 'Adelaide', 2, NULL, NULL, '2022-01-23 14:44:47', '2022-01-29 08:06:00'),
(109, 61, 7, 'Right Image Content', 'EXPERIENCE A STRESS FREE BOND CLEANING WITH US', 'experience-a-stress-free-bond-cleaning-with-us', 'Our Trusted Bond Cleaning Service', '51', NULL, '<p>When it comes to hiring professional end of lease cleaning services, then look no further than Bond Cleaning in Adelaide. With complete dedication and affordability, we have been delivering top notch cleaning services for both residential and commercial properties across Adelaide and its local suburbs.</p><p>Our efficient and fully trained team of cleaners makes sure that your inspection goes smoothly and your property manager is a happy man at the end of the process. So, what are you waiting for? Let us clean your leased property to perfection!<br></p>', NULL, 'Adelaide', 6, '#000000', NULL, '2022-01-23 15:01:21', '2022-01-29 08:06:00'),
(110, 61, 7, 'Right Image Content', 'New Content <span>By Emran</span>', 'new-content-spanby-emranspan', NULL, '53', NULL, '<p>As an end of lease cleaning service provider in Adelaide, we are not the best, but still, our competitors hate us.</p><p>No, wrong if you think because we charge the least money to provide any end of lease cleaning service. We must say we are not the cheapest but affordable than many other competitors in the market.</p><p>Other bond cleanings or exit cleaning service providers hate us because our clients love us. They do marketing for us to their friends and families. They advise us about how to make our service better and so on.</p><p>To beat the competition, now most cleaning companies provide a 100% bond back guarantee with their bond cleaning services. No doubt everyone\'s finger crosses for no issues after leaving the property.</p>', NULL, 'Adelaide', 3, '#e8e8e8', NULL, '2022-01-24 08:05:45', '2022-01-29 08:06:00'),
(111, 61, 7, 'Extras', 'Extra Services', 'extra-services', 'Extra Services', NULL, NULL, '<p>Extra Services<br></p>', NULL, 'Adelaide', 10, '#f2f2f2', 'Yes', '2022-01-28 17:41:59', '2022-01-29 08:06:00');

-- --------------------------------------------------------

--
-- Table structure for table `term_custom_fields_breakdown`
--

CREATE TABLE `term_custom_fields_breakdown` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `content_type` enum('Left Image List Type','Right Image List Type','Counter','Normal List') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_term_id` int(11) NOT NULL,
  `term_custom_field_id` bigint(20) UNSIGNED NOT NULL,
  `content_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_sub_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `font_awesome` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `content_short_details` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_zone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sorting_order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `term_custom_fields_breakdown`
--

INSERT INTO `term_custom_fields_breakdown` (`id`, `content_type`, `content_term_id`, `term_custom_field_id`, `content_title`, `content_sub_title`, `content_image`, `font_awesome`, `content_details`, `content_short_details`, `content_zone`, `sorting_order`, `created_at`, `updated_at`) VALUES
(2, 'Normal List', 7, 2, '2nd image', '2nd image sub title', '70', NULL, '<p>2nd image sub title<br></p>', NULL, 'Adelaide', 0, '2021-10-20 16:47:20', '2022-01-24 08:29:14'),
(4, 'Left Image List Type', 7, 3, '1st Tab Samrat', '1st tab sub title', '16', NULL, 'End of lease cleaning is important because when the rental property is thoroughly cleaned, the landlord will be pleased with the condition and you will get your full deposit back.\r\n\r\nPerforming end of lease cleaning by yourself is not easy as it requires the right cleaning tools to perform the cleaning. So in order to make sure that the cleaning process is hassle-free and cheap, we recommend you hire an end of cleaning company like us to get the cleaning job done for you.', NULL, NULL, NULL, '2021-10-20 17:11:18', '2021-10-20 21:17:09'),
(5, 'Left Image List Type', 7, 3, '2nd Tab', '2nd Tab Sub Title', '8', NULL, 'By taking our end of lease cleaning services, we make sure that each and every corner of your property is thoroughly cleaned. We always use eco-friendly cleaning products and sophisticated equipment to clean your place professionally. Our end of lease cleaning services come with a 100% bond-back guarantee. We also include carpet cleaning.', NULL, NULL, NULL, '2021-10-20 17:11:40', '2021-10-20 21:17:19'),
(7, 'Normal List', 34, 5, 'None', 'None', '8', NULL, 'Our team does their best to make the cleaning spotless but not guaranteed since some marks are permanent or very hard to remove, and trying too hard may cause damages, so we leave those', NULL, 'Adelaide', NULL, '2021-10-20 21:10:12', '2022-01-24 08:39:07'),
(8, 'Normal List', 34, 5, 'none', 'none', '8', NULL, 'Our team will use floor cleaning chemicals thoroughly to clean the bathroom and kitchen floor. But we do not clean tile and grout in our end of lease cleaning services. If you still need this service, please book it separately or discuss it with our friendly team', NULL, 'Adelaide', NULL, '2021-10-20 21:10:27', '2022-01-24 08:39:13'),
(9, 'Normal List', 34, 5, 'none', 'none', '16', NULL, 'Sometimes there are hard water stains on the shower screens or glasses. This thing is hard to remove and risks damaging the glass. So it is not included in our regular end of lease cleaning service', NULL, 'Adelaide', NULL, '2021-10-20 21:10:40', '2022-01-24 08:39:22'),
(10, 'Normal List', 34, 8, '1st bullet', '1st bullet sub', '64', NULL, '<p><ul><li>Dust and clean all accessible surfaces</li><li>Vacuum and mop all accessible floors</li><li>Empty visible garbage bins</li><li>Mirrors cleaned and polished</li><li>Clean door handles, light switches and power points</li><li>Clean and polish all glass-top surfaces</li><li>Cobwebs removed</li><li>Dust and wipe skirting boards</li><li>Dust accessible air vents</li></ul></p>', NULL, 'Adelaide', 0, '2021-10-22 06:08:48', '2022-01-24 08:04:00'),
(11, 'Normal List', 34, 8, '2nd bullet', '2nd bullet sub', '65', NULL, '<p><ul><li>Clean all benches and splashbacks</li><li>Clean stove, hotplates, rangehood and chute</li><li>Clean oven exterior</li><li>Clean oven interior</li><li>Clean and polish sink and taps</li><li>Clean exterior fridge, dishwasher/appliances</li><li>Clean exterior of all cupboards, pantry and drawers</li><li>Clean interior of all cupboards, pantry and drawers</li></ul></p>', NULL, 'Adelaide', 2, '2021-10-22 06:09:58', '2022-01-24 08:02:53'),
(13, 'Normal List', 34, 8, '4th bullet', '4th bullet sub', '67', NULL, '<p><ul><li>Clean and sanitise shower screens and tiles</li><li>Clean and sanitise toilet</li><li>Clean and sanitise bath and sink</li><li>Clean and polish sink and taps</li><li>Plugholes clean and free of debris</li><li>Clean exterior of all cupboards and drawers</li><li>Clean interior of all cupboards and drawers</li><li>Clean clothes dryer filter</li></ul></p>', NULL, 'Adelaide', 3, '2021-10-22 06:10:35', '2022-01-24 08:02:53'),
(16, 'Left Image List Type', 34, 9, 'General', 'General', '8', NULL, '<p>Remove cobwebs, insect marks and small nests where Pest control is not warranted\r\nClean fans, Air Conditioners and filters\r\nClean light fittings (where they can be safely removed and accessible)\r\nSpot clean walls, light switches and power points\r\nClean skirting, architraves and doors\r\nClean drawers and cupboards including inside, doors and cupboard tops and shelving\r\nWindows clean both sides (exclusions apply at heights and accessibility)\r\nVacuum sliding door tracks and clean tracks\r\nClean standard blinds, cords and rails (spot clean and dust).\r\nVacuum all the floors and carpets.\r\nMop hard floors.</p>', NULL, NULL, NULL, '2021-10-30 08:12:14', '2021-10-30 08:39:05'),
(17, 'Left Image List Type', 34, 9, 'Kitchen', 'Kitchen', '16', NULL, '<p>* Clean inside and outside and on top of all cupboards, doors and drawers.</p><p>* Clean inside, outside and around stove top, elements, rings and knobs.</p><p>* Clean inside and outside of oven, griller, doors, trays, racks, glass and knobs.</p><p>* Clean inside, outside &amp; behind refrigerator* and dishwasher* &amp; microwave* space. (if applicable)</p><p>* Clean and dry sink, drain holes, drainers and polish tap ware.</p><p>* Range hood exhaust and filter -filter can be removed and cleaned.</p><p>* Clean and polish splash back area.</p>', NULL, 'Adelaide', NULL, '2021-10-30 08:30:00', '2022-01-20 15:42:49'),
(24, 'Normal List', 34, 26, 'Reasonable Price', 'Reasonable Price', NULL, 'fa fa-thumbs-o-up', '<p>Unlike others, along with our quality, we are very reasonable &amp; affordable.</p>', NULL, 'Adelaide', 0, '2022-01-23 04:45:02', '2022-01-24 08:01:15'),
(25, 'Normal List', 34, 26, 'Satisfaction Guarenteed', 'Satisfaction Guarenteed', NULL, 'fa fa-superpowers', '<p>Bad thing happens on the job; we always admit it and stay on your side.</p>', NULL, 'Adelaide', 1, '2022-01-23 04:47:49', '2022-01-24 07:58:47'),
(26, 'Normal List', 34, 26, 'Quality Staffs', 'Quality Staffs', NULL, 'fa fa-thermometer-full', '<p>We never let anyone inexperienced work for our clients &amp; that\'s a promise.</p>', NULL, 'Adelaide', 2, '2022-01-23 04:48:43', '2022-01-24 07:58:47'),
(27, 'Normal List', 34, 26, 'Fast Services', 'Fast Services', NULL, 'fa fa-long-arrow-right', '<p>We have enough team to serve even by the same-day notice in any city we serve.</p>', NULL, 'Adelaide', 3, '2022-01-23 04:49:20', '2022-01-24 07:58:47'),
(28, 'Normal List', 34, 26, 'Best Equipment', 'Best Equipment', NULL, 'fa fa-user-o', 'We never give a second thought to buy the best equipment in the market.', NULL, 'Adelaide', 4, '2022-01-23 04:49:55', '2022-01-24 07:58:47'),
(29, 'Normal List', 34, 26, 'We Are Insured', 'We Are Insured', NULL, 'fa fa-long-arrow-right', 'You have coverage with 5 million dollars insurance from us, be chilled!', NULL, 'Adelaide', 5, '2022-01-23 04:50:32', '2022-01-24 07:58:47'),
(30, 'Counter', 34, 26, '25', 'Services we provide', NULL, NULL, NULL, NULL, NULL, 6, '2022-01-23 14:27:08', '2022-01-24 07:58:47'),
(31, 'Counter', 34, 26, '800', 'Satisfied Clients', NULL, 'fa fa-male', NULL, NULL, 'Adelaide', 7, '2022-01-23 14:30:42', '2022-01-24 07:58:47'),
(32, 'Counter', 34, 26, '1542', 'Project Done', NULL, 'fa fa-male', NULL, NULL, 'Adelaide', 8, '2022-01-23 14:32:46', '2022-01-24 07:58:48'),
(33, 'Normal List', 34, 2, '1st Image', NULL, '70', NULL, '<p>asdfasd</p>', NULL, 'Adelaide', 1, '2022-01-24 08:16:48', '2022-01-24 08:29:53'),
(34, 'Normal List', 34, 5, 'None', 'None', '8', NULL, 'In carpet cleaning, sometimes we find very old or hard stains. We do our best but cannot guarantee any stain removals, and our price is for general carpet cleaning only. If any stain needs extra attention, we may charge extra for that', NULL, 'Adelaide', NULL, '2021-10-20 21:10:12', '2022-01-24 08:39:07'),
(35, 'Normal List', 34, 5, 'none', 'none', '8', NULL, 'For inside window cleaning, all windows should be accessible by hand. If not, then we may charge extra based on the height', NULL, 'Adelaide', NULL, '2021-10-20 21:10:27', '2022-01-24 08:39:13'),
(36, 'Normal List', 34, 5, 'none', 'none', '16', NULL, 'Outside windows should be accessible by three steps ladder, and the fly-screen should be removed. If you want us to remove the fly-screen then we will charge extra. Our cleaners can deny cleaning any windows if they find it’s risky to put the steps ladder.', NULL, 'Adelaide', NULL, '2021-10-20 21:10:40', '2022-01-24 08:39:22'),
(37, 'Normal List', 34, 5, 'none', 'none', '16', NULL, 'The customer is to provide access to the property when the service is due to be performed. If not available at the appointed time, then responsible for providing us access to the keys. Failure to do so is subject to a cancellation/postponement/late fee as per our terms and conditions', NULL, 'Adelaide', NULL, '2021-10-20 21:10:40', '2022-01-24 08:39:22'),
(38, 'Normal List', 34, 5, 'none', 'none', '16', NULL, 'Running hot water and electricity must be available within the property. Failure to provide these is subject to a cancellation/postponement fee or extra charge to use the generator', NULL, 'Adelaide', NULL, '2021-10-20 21:10:40', '2022-01-24 08:39:22'),
(39, 'Normal List', 34, 5, 'none', 'none', '16', NULL, 'It is the client’s responsibility to provide parking access to the cleaners. If there is any cost for car parking during the job, the client is responsible to pay for that.', NULL, 'Adelaide', NULL, '2021-10-20 21:10:40', '2022-01-24 08:39:22'),
(40, 'Normal List', 34, 5, 'none', 'none', '16', NULL, 'Our team can deny cleaning anything inside the property that is more than 3 meters in height.', NULL, 'Adelaide', NULL, '2021-10-20 21:10:40', '2022-01-24 08:39:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `employee_no` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `marital_status` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `father` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `mother` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `emergency_phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `company` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `department` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `postcode` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `district` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `join_date` date DEFAULT NULL,
  `employee_status` enum('Enroll','Terminated','Long Leave','Left Job','On Hold') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `employee_no`, `username`, `phone`, `gender`, `marital_status`, `father`, `mother`, `emergency_phone`, `company`, `department`, `address`, `postcode`, `district`, `email_verified_at`, `birthday`, `join_date`, `employee_status`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Samrat', 'info@tritiyo.com', NULL, NULL, '01680139540', 'Male', NULL, NULL, NULL, NULL, NULL, NULL, 'Block L, Road No. 8, South Banasree', '1703', 'Dhaka', NULL, NULL, NULL, 'Enroll', '$2y$10$DWwxudpDc5FnfQMq/bNXA.W3POF5OAN78tybjGt7pz.Sgi8.TxL1a', 'lPUfmHY0To3ZQbDfErsp8wwWH6EtEWU2j5TyyH8R5WHLLq3E74RMMBACmz8B', '2021-07-13 22:54:50', '2022-02-10 12:49:59'),
(17, 'Noushad Nipun', 'nipun@tritiyo.com', NULL, NULL, '01677618199', 'Male', NULL, NULL, NULL, NULL, NULL, NULL, 'Ghatail', '1980', 'Tangail', NULL, NULL, NULL, NULL, '$2y$10$6wisrDzoaM3GU6ceZUXmlu/yjk6ianySYJWrh16MA7fFqCPumJZnu', NULL, '2021-07-30 01:00:08', '2021-07-30 01:00:08'),
(18, 'Anowarul Haque', 'anowar@mtsbd.net', NULL, NULL, '0', 'Select gender', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$E8wPRvVv6XtCjUw/sRSsZuK9DckaU5ZajK709NSGhRhdFTjorUYQK', NULL, '2021-07-30 02:03:53', '2021-08-01 10:16:25');

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`id`, `name`, `location`, `code`, `phone`, `email`, `created_at`, `updated_at`) VALUES
(20, 'Warehouse 2', 'CTG', 'warehouse_2_89b1', NULL, NULL, '2021-07-30 01:07:43', '2021-07-31 20:51:31'),
(21, 'Warehouse 1', 'DHK', 'warehouse_1_af9b', NULL, NULL, '2021-07-30 02:04:50', '2021-07-31 21:28:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_menus`
--
ALTER TABLE `admin_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_menu_items`
--
ALTER TABLE `admin_menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_menu_items_menu_foreign` (`menu`);

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `albums_position_unique` (`position`);

--
-- Indexes for table `albums_pcat`
--
ALTER TABLE `albums_pcat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attribute_values`
--
ALTER TABLE `attribute_values`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_general_information`
--
ALTER TABLE `booking_general_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `calc_basic_settings`
--
ALTER TABLE `calc_basic_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `calc_basic_settings_setting_type_foreign` (`setting_type`),
  ADD KEY `calc_basic_settings_equation_type_foreign` (`equation_type`),
  ADD KEY `calc_basic_settings_service_id_foreign` (`service_id`),
  ADD KEY `calc_service_settings_section_id_foreign` (`section_id`);

--
-- Indexes for table `calc_input_types`
--
ALTER TABLE `calc_input_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `calc_input_types_service_id_foreign` (`service_id`),
  ADD KEY `calc_input_types_attr_id_foreign` (`attr_id`),
  ADD KEY `radio_design` (`radio_design`),
  ADD KEY `input_type` (`input_type`);

--
-- Indexes for table `calc_materials_settings`
--
ALTER TABLE `calc_materials_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `calc_materials_settings_service_id_foreign` (`service_id`),
  ADD KEY `calc_materials_settings_section_id_foreign` (`section_id`),
  ADD KEY `calc_materials_settings_equation_type_foreign` (`equation_type`);

--
-- Indexes for table `calc_service_settings`
--
ALTER TABLE `calc_service_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `calc_service_settings_service_id_foreign` (`service_id`),
  ADD KEY `calc_service_settings_setting_option_type_foreign` (`setting_option_type`),
  ADD KEY `calc_service_settings_calculation_type_foreign` (`calculation_type`),
  ADD KEY `calc_service_settings_counter_type_foreign` (`counter_type`),
  ADD KEY `calc_service_settings_input_type_foreign` (`input_type`),
  ADD KEY `calc_service_settings_radio_design_foreign` (`radio_design`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_coupon_code_unique` (`coupon_code`);

--
-- Indexes for table `frontend_settings`
--
ALTER TABLE `frontend_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `meta_name` (`meta_name`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `global_settings`
--
ALTER TABLE `global_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medias`
--
ALTER TABLE `medias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medias_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pages_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `postcodes`
--
ALTER TABLE `postcodes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `postcodes_zone_id_foreign` (`zone_id`);

--
-- Indexes for table `postcode_rates`
--
ALTER TABLE `postcode_rates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `postcode_rates_service_id_foreign` (`service_id`),
  ADD KEY `postcode_rates_zone_id_foreign` (`zone_id`),
  ADD KEY `postcode_rates_equation_type_foreign` (`equation_type`),
  ADD KEY `postcode_rates_postcode_id_foreign` (`postcode_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_users`
--
ALTER TABLE `role_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_users_role_id_foreign` (`role_id`),
  ADD KEY `role_users_user_id_foreign` (`user_id`),
  ADD KEY `role_users_warehouse_id_foreign` (`warehouse_id`);

--
-- Indexes for table `route_groups`
--
ALTER TABLE `route_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `route_lists`
--
ALTER TABLE `route_lists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `route_lists_route_name_unique` (`route_name`),
  ADD KEY `route_lists_route_group_foreign` (`route_group`);

--
-- Indexes for table `route_list_roles`
--
ALTER TABLE `route_list_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `route_list_roles_role_id_foreign` (`role_id`),
  ADD KEY `route_list_roles_route_id_foreign` (`route_id`);

--
-- Indexes for table `seo_informations`
--
ALTER TABLE `seo_informations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terms`
--
ALTER TABLE `terms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `terms_seo_url_unique` (`seo_url`),
  ADD UNIQUE KEY `terms_position_unique` (`position`);

--
-- Indexes for table `term_custom_fields`
--
ALTER TABLE `term_custom_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `term_custom_fields_breakdown`
--
ALTER TABLE `term_custom_fields_breakdown`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `employee_no` (`employee_no`);

--
-- Indexes for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_menus`
--
ALTER TABLE `admin_menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `admin_menu_items`
--
ALTER TABLE `admin_menu_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `albums_pcat`
--
ALTER TABLE `albums_pcat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `attribute_values`
--
ALTER TABLE `attribute_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `booking_general_information`
--
ALTER TABLE `booking_general_information`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `calc_basic_settings`
--
ALTER TABLE `calc_basic_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `calc_input_types`
--
ALTER TABLE `calc_input_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `calc_materials_settings`
--
ALTER TABLE `calc_materials_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `calc_service_settings`
--
ALTER TABLE `calc_service_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `frontend_settings`
--
ALTER TABLE `frontend_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `global_settings`
--
ALTER TABLE `global_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `medias`
--
ALTER TABLE `medias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `postcodes`
--
ALTER TABLE `postcodes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `postcode_rates`
--
ALTER TABLE `postcode_rates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `role_users`
--
ALTER TABLE `role_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `route_groups`
--
ALTER TABLE `route_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `route_lists`
--
ALTER TABLE `route_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=262;

--
-- AUTO_INCREMENT for table `route_list_roles`
--
ALTER TABLE `route_list_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `seo_informations`
--
ALTER TABLE `seo_informations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `terms`
--
ALTER TABLE `terms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `term_custom_fields`
--
ALTER TABLE `term_custom_fields`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `term_custom_fields_breakdown`
--
ALTER TABLE `term_custom_fields_breakdown`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_menu_items`
--
ALTER TABLE `admin_menu_items`
  ADD CONSTRAINT `admin_menu_items_menu_foreign` FOREIGN KEY (`menu`) REFERENCES `admin_menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `calc_basic_settings`
--
ALTER TABLE `calc_basic_settings`
  ADD CONSTRAINT `calc_basic_settings_equation_type_foreign` FOREIGN KEY (`equation_type`) REFERENCES `attribute_values` (`id`),
  ADD CONSTRAINT `calc_basic_settings_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `terms` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `calc_basic_settings_setting_type_foreign` FOREIGN KEY (`setting_type`) REFERENCES `attribute_values` (`id`),
  ADD CONSTRAINT `calc_service_settings_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `calc_service_settings` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `calc_input_types`
--
ALTER TABLE `calc_input_types`
  ADD CONSTRAINT `calc_input_types_attr_id_foreign` FOREIGN KEY (`attr_id`) REFERENCES `attribute_values` (`id`),
  ADD CONSTRAINT `calc_input_types_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `terms` (`id`),
  ADD CONSTRAINT `input_type` FOREIGN KEY (`input_type`) REFERENCES `attribute_values` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `radio_design` FOREIGN KEY (`radio_design`) REFERENCES `attribute_values` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `calc_materials_settings`
--
ALTER TABLE `calc_materials_settings`
  ADD CONSTRAINT `calc_materials_settings_equation_type_foreign` FOREIGN KEY (`equation_type`) REFERENCES `attribute_values` (`id`),
  ADD CONSTRAINT `calc_materials_settings_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `calc_service_settings` (`id`),
  ADD CONSTRAINT `calc_materials_settings_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `terms` (`id`);

--
-- Constraints for table `calc_service_settings`
--
ALTER TABLE `calc_service_settings`
  ADD CONSTRAINT `calc_service_settings_calculation_type_foreign` FOREIGN KEY (`calculation_type`) REFERENCES `attribute_values` (`id`),
  ADD CONSTRAINT `calc_service_settings_counter_type_foreign` FOREIGN KEY (`counter_type`) REFERENCES `attribute_values` (`id`),
  ADD CONSTRAINT `calc_service_settings_input_type_foreign` FOREIGN KEY (`input_type`) REFERENCES `attribute_values` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `calc_service_settings_radio_design_foreign` FOREIGN KEY (`radio_design`) REFERENCES `attribute_values` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `calc_service_settings_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `terms` (`id`),
  ADD CONSTRAINT `calc_service_settings_setting_option_type_foreign` FOREIGN KEY (`setting_option_type`) REFERENCES `attribute_values` (`id`);

--
-- Constraints for table `medias`
--
ALTER TABLE `medias`
  ADD CONSTRAINT `medias_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `pages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `postcodes`
--
ALTER TABLE `postcodes`
  ADD CONSTRAINT `postcodes_zone_id_foreign` FOREIGN KEY (`zone_id`) REFERENCES `attribute_values` (`id`);

--
-- Constraints for table `postcode_rates`
--
ALTER TABLE `postcode_rates`
  ADD CONSTRAINT `postcode_rates_equation_type_foreign` FOREIGN KEY (`equation_type`) REFERENCES `attribute_values` (`id`),
  ADD CONSTRAINT `postcode_rates_postcode_id_foreign` FOREIGN KEY (`postcode_id`) REFERENCES `postcodes` (`id`),
  ADD CONSTRAINT `postcode_rates_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `terms` (`id`),
  ADD CONSTRAINT `postcode_rates_zone_id_foreign` FOREIGN KEY (`zone_id`) REFERENCES `attribute_values` (`id`);

--
-- Constraints for table `role_users`
--
ALTER TABLE `role_users`
  ADD CONSTRAINT `role_users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_users_warehouse_id_foreign` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `route_lists`
--
ALTER TABLE `route_lists`
  ADD CONSTRAINT `route_lists_route_group_foreign` FOREIGN KEY (`route_group`) REFERENCES `route_groups` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `route_list_roles`
--
ALTER TABLE `route_list_roles`
  ADD CONSTRAINT `route_list_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `route_list_roles_route_id_foreign` FOREIGN KEY (`route_id`) REFERENCES `route_lists` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
