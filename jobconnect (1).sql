-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2025 at 10:59 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jobconnect`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`email`, `password`) VALUES
('admin@gmail.com', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `branch` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `reg_no` varchar(50) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`name`, `email`, `password`, `branch`, `address`, `phone_number`, `reg_no`, `date`) VALUES
('ABC Constructions', '', '', 'South', NULL, NULL, 'AC009', '2025-04-07 11:44:04'),
('ala company', 'ala@gmail.com', '1234', 'kandy', 'asdcvb', '0755490025', 'qwert', '2025-04-08 23:39:12'),
('BrandBoost', '', '', 'East', NULL, NULL, 'BB003', '2025-04-07 11:44:04'),
('BuildTech', '', '', 'North', NULL, NULL, 'BT010', '2025-04-07 11:44:04'),
('City Hospital', '', '', 'West', NULL, NULL, 'CH008', '2025-04-07 11:44:04'),
('deshan', 'oshadha.dw@gmail.com', '$2y$10$9Cx/eVaIetMJWp4LHy.nF.PBlfiQF4UWccYMJTfkKyU.wv79WDw9q', 'kandy', '451/1 Pahala Eriyagama Peradeniya', '0755490025', 'abc@111', '2025-04-07 16:17:28'),
('deshan', 'oshadha@gmail.com', '1234', 'rty', '451/1 Pahala Eriyagama Peradeniya', '123456781', '123', '2025-04-08 10:47:45'),
('DigitalHive', '', '', 'North', NULL, NULL, 'DH004', '2025-04-07 11:44:04'),
('FinancePro', '', '', 'Main', NULL, NULL, 'FP005', '2025-04-07 11:44:04'),
('Innovate Ltd', '', '', 'West', NULL, NULL, 'IL002', '2025-04-07 11:44:04'),
('Innovate Ltd', '', '', 'West', '321 Lane, Town', '4445556666', 'IL456', '2025-04-07 11:44:04'),
('lakshapana', 'laksha@gmail.com', '1234', 'colombo', 'kandy', '12345', 'aa@11', '2025-04-23 23:21:42'),
('MediCare', '', '', 'Central', NULL, NULL, 'MC007', '2025-04-07 11:44:04'),
('oshadha', 'oshadha.dw@gmail.com', '1234', 'ert', '451/1 Pahala Eriyagama Peradeniya', '0755490025', 'dfg', '2025-04-08 10:42:19'),
('oshadha', 'oshadha.dw@gmail.com', '$2y$10$xfpCY3shdTso8c7pYLmtru7YAAmjsrX1ve8yv4pTrWjFy6jHN.Bbe', 'kandy', '451/1 Pahala Eriyagama Peradeniya', '0755490025', 'abc@111', '2025-04-07 11:44:04'),
('qewgr', 'oshadha.dw@gmail.com', '$2y$10$apO0guKU2WGp7bZ.Bt/ub.v8ajheTK8LPdzf9zhDTjQFUFla5UDLa', 'kandy', '451/1 Pahala Eriyagama Peradeniya', '0755490025', 'abc@111', '2025-04-07 11:44:04'),
('TechCorp', '', '', 'Main', NULL, NULL, 'TC001', '2025-04-07 11:44:04'),
('TechCorp', '', '', 'Main', '789 Road, City', '1112223333', 'TC123', '2025-04-07 11:44:04'),
('technohub', 'technohub@gmail.com', '123456', 'colombo', 'colombo kandy', '0112233445', 'asd@123', '2025-04-08 13:40:32'),
('UCSC', 'UCSC@gmail.com', '1234', 'colombo', 'colombo', '12345678', 'ucsc@123', '2025-04-24 14:14:04'),
('Wealth Advisors', '', '', 'South', NULL, NULL, 'WA006', '2025-04-07 11:44:04');

-- --------------------------------------------------------

--
-- Table structure for table `field`
--

CREATE TABLE `field` (
  `field_id` int(11) NOT NULL,
  `field_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `field`
--

INSERT INTO `field` (`field_id`, `field_name`) VALUES
(28, 'Construction'),
(27, 'Creative & Design'),
(23, 'Customer Support'),
(20, 'Engineering'),
(3, 'Finance'),
(4, 'health'),
(26, 'Hospitality & Tourism'),
(21, 'Legal & Government'),
(25, 'Logistics & Supply Chain'),
(29, 'Manufacturing'),
(2, 'Marketing'),
(38, 'math'),
(22, 'Sales & Retail'),
(36, 'sci'),
(1, 'Software Development'),
(30, 'tech');

-- --------------------------------------------------------

--
-- Table structure for table `field_req`
--

CREATE TABLE `field_req` (
  `field_id` int(11) NOT NULL,
  `field_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `company` varchar(255) NOT NULL,
  `branch` varchar(255) NOT NULL,
  `reg_no` varchar(50) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `field_req`
--

INSERT INTO `field_req` (`field_id`, `field_name`, `description`, `company`, `branch`, `reg_no`, `date`, `status`) VALUES
(1, 'sci', 'scicicicicic', 'ala company', 'kandy', 'qwert', '2025-04-09 09:33:23', 'approved'),
(2, 'sci', 'scicicicicic', 'ala company', 'kandy', 'qwert', '2025-04-09 12:13:06', 'rejected'),
(3, 'math', 'dsf', 'lakshapana', 'colombo', 'aa@11', '2025-04-23 23:46:23', 'approved'),
(4, 'math', 'dsf', 'lakshapana', 'colombo', 'aa@11', '2025-04-23 23:47:08', 'rejected'),
(5, 'computer', 'computing', 'UCSC', 'colombo', 'ucsc@123', '2025-04-24 14:18:47', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `job_id` int(11) NOT NULL,
  `job_field` int(11) DEFAULT NULL,
  `job_role` varchar(255) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `branch` varchar(255) DEFAULT NULL,
  `reg_no` varchar(50) DEFAULT NULL,
  `location` text DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  `requirements` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `deadline` datetime DEFAULT NULL,
  `post` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`job_id`, `job_field`, `job_role`, `company_name`, `branch`, `reg_no`, `location`, `phone`, `salary`, `requirements`, `description`, `deadline`, `post`) VALUES
(152, 1, 'Software Engineer', 'TechCorp', 'Main', 'TC001', 'Colombo', '0112345678', 90000.00, 'BSc in Computer Science', 'Develop and maintain software', '2025-05-01 00:00:00', '2025-04-03 11:12:27'),
(153, 1, 'Web Developer', 'Innovate Ltd', 'West', 'IL002', 'Kandy', '0771234567', 85000.00, 'BSc in IT', 'Create and maintain websites', '2025-05-05 00:00:00', '2025-04-03 11:12:27'),
(154, 2, 'Marketing Manager', 'BrandBoost', 'East', 'BB003', 'Galle', '0715678901', 70000.00, 'Experience in marketing', 'Lead marketing campaigns', '2025-05-10 00:00:00', '2025-04-03 11:13:21'),
(155, 2, 'SEO Specialist', 'DigitalHive', 'North', 'DH004', 'Jaffna', '0778765432', 65000.00, 'Knowledge in SEO', 'Optimize websites for search engines', '2025-05-15 00:00:00', '2025-04-03 11:13:21'),
(156, 1, 'Software Engineer', 'TechCorp', 'Main', 'TC001', 'Colombo', '0112345678', 90000.00, 'BSc in Computer Science', 'Develop and maintain software', '2025-05-01 00:00:00', '2025-04-03 11:17:10'),
(157, 1, 'Web Developer', 'Innovate Ltd', 'West', 'IL002', 'Kandy', '0771234567', 85000.00, 'BSc in IT', 'Create and maintain websites', '2025-05-05 00:00:00', '2025-04-03 11:17:10'),
(158, 1, 'Software Engineer', 'TechCorp', 'Main', 'TC001', 'Colombo', '0112345678', 90000.00, 'BSc in Computer Science', 'Develop and maintain software', '2025-05-01 00:00:00', '2025-04-03 11:21:32'),
(159, 1, 'Web Developer', 'Innovate Ltd', 'West', 'IL002', 'Kandy', '0771234567', 85000.00, 'BSc in IT', 'Create and maintain websites', '2025-05-05 00:00:00', '2025-04-03 11:21:32'),
(160, 2, 'Marketing Manager', 'BrandBoost', 'East', 'BB003', 'Galle', '0715678901', 70000.00, 'Experience in marketing', 'Lead marketing campaigns', '2025-05-10 00:00:00', '2025-04-03 11:21:32'),
(161, 2, 'SEO Specialist', 'DigitalHive', 'North', 'DH004', 'Jaffna', '0778765432', 65000.00, 'Knowledge in SEO', 'Optimize websites for search engines', '2025-05-15 00:00:00', '2025-04-03 11:21:32'),
(162, 3, 'Accountant', 'FinancePro', 'Main', 'FP005', 'Colombo', '0115671234', 95000.00, 'Degree in Accounting', 'Manage company finances', '2025-05-20 00:00:00', '2025-04-03 11:21:32'),
(163, 3, 'Financial Analyst', 'Wealth Advisors', 'South', 'WA006', 'Negombo', '0765437890', 98000.00, 'Experience in financial analysis', 'Analyze market trends', '2025-05-25 00:00:00', '2025-04-03 11:21:32'),
(164, 4, 'Doctor', 'MediCare', 'Central', 'MC007', 'Kurunegala', '0756784321', 150000.00, 'MBBS degree', 'Provide medical consultations', '2025-06-01 00:00:00', '2025-04-03 11:21:32'),
(165, 4, 'Nurse', 'City Hospital', 'West', 'CH008', 'Galle', '0712348765', 75000.00, 'Nursing certification', 'Assist doctors and patients', '2025-06-05 00:00:00', '2025-04-03 11:21:32'),
(168, 1, 'Software Engineer', 'TechCorp', 'Main', 'TC001', 'Colombo', '0112345678', 90000.00, 'BSc in Computer Science', 'Develop and maintain software', '2025-05-01 00:00:00', '2025-04-03 11:22:49'),
(169, 1, 'Web Developer', 'Innovate Ltd', 'West', 'IL002', 'Kandy', '0771234567', 85000.00, 'BSc in IT', 'Create and maintain websites', '2025-05-05 00:00:00', '2025-04-03 11:22:49'),
(170, 2, 'Marketing Manager', 'BrandBoost', 'East', 'BB003', 'Galle', '0715678901', 70000.00, 'Experience in marketing', 'Lead marketing campaigns', '2025-05-10 00:00:00', '2025-04-03 11:22:49'),
(171, 2, 'SEO Specialist', 'DigitalHive', 'North', 'DH004', 'Jaffna', '0778765432', 65000.00, 'Knowledge in SEO', 'Optimize websites for search engines', '2025-05-15 00:00:00', '2025-04-03 11:22:49'),
(172, 3, 'Accountant', 'FinancePro', 'Main', 'FP005', 'Colombo', '0115671234', 95000.00, 'Degree in Accounting', 'Manage company finances', '2025-05-20 00:00:00', '2025-04-03 11:22:49'),
(173, 3, 'Financial Analyst', 'Wealth Advisors', 'South', 'WA006', 'Negombo', '0765437890', 98000.00, 'Experience in financial analysis', 'Analyze market trends', '2025-05-25 00:00:00', '2025-04-03 11:22:49'),
(174, 4, 'Doctor', 'MediCare', 'Central', 'MC007', 'Kurunegala', '0756784321', 150000.00, 'MBBS degree', 'Provide medical consultations', '2025-06-01 00:00:00', '2025-04-03 11:22:49'),
(175, 4, 'Nurse', 'City Hospital', 'West', 'CH008', 'Galle', '0712348765', 75000.00, 'Nursing certification', 'Assist doctors and patients', '2025-06-05 00:00:00', '2025-04-03 11:22:49'),
(176, 1, 'Software Engineer', 'TechCorp', 'Main', 'TC001', 'Colombo', '0112345678', 90000.00, 'BSc in Computer Science', 'Develop and maintain software', '2025-05-01 00:00:00', '2025-04-03 11:23:04'),
(177, 1, 'Web Developer', 'Innovate Ltd', 'West', 'IL002', 'Kandy', '0771234567', 85000.00, 'BSc in IT', 'Create and maintain websites', '2025-05-05 00:00:00', '2025-04-03 11:23:04'),
(178, 2, 'Marketing Manager', 'BrandBoost', 'East', 'BB003', 'Galle', '0715678901', 70000.00, 'Experience in marketing', 'Lead marketing campaigns', '2025-05-10 00:00:00', '2025-04-03 11:23:04'),
(179, 2, 'SEO Specialist', 'DigitalHive', 'North', 'DH004', 'Jaffna', '0778765432', 65000.00, 'Knowledge in SEO', 'Optimize websites for search engines', '2025-05-15 00:00:00', '2025-04-03 11:23:04'),
(180, 3, 'Accountant', 'FinancePro', 'Main', 'FP005', 'Colombo', '0115671234', 95000.00, 'Degree in Accounting', 'Manage company finances', '2025-05-20 00:00:00', '2025-04-03 11:23:04'),
(181, 3, 'Financial Analyst', 'Wealth Advisors', 'South', 'WA006', 'Negombo', '0765437890', 98000.00, 'Experience in financial analysis', 'Analyze market trends', '2025-05-25 00:00:00', '2025-04-03 11:23:04'),
(182, 4, 'Doctor', 'MediCare', 'Central', 'MC007', 'Kurunegala', '0756784321', 150000.00, 'MBBS degree', 'Provide medical consultations', '2025-06-01 00:00:00', '2025-04-03 11:23:04'),
(183, 4, 'Nurse', 'City Hospital', 'West', 'CH008', 'Galle', '0712348765', 75000.00, 'Nursing certification', 'Assist doctors and patients', '2025-06-05 00:00:00', '2025-04-03 11:23:04'),
(184, 20, 'Mechanical Engineer', NULL, NULL, NULL, 'Colombo', '0763214567', 110000.00, 'BSc in Mechanical Engineering', 'Design and test machinery', '2025-06-10 00:00:00', '2025-04-03 11:23:04'),
(185, 20, 'Electrical Engineer', NULL, NULL, NULL, 'Kandy', '0776543210', 105000.00, 'BSc in Electrical Engineering', 'Maintain power systems', '2025-06-15 00:00:00', '2025-04-03 11:23:04'),
(188, 1, 'Software Engineer', 'TechCorp', 'Main', 'TC001', 'Colombo', '0112345678', 90000.00, 'BSc in Computer Science', 'Develop and maintain software', '2025-05-01 00:00:00', '2025-04-03 11:25:52'),
(189, 1, 'Web Developer', 'Innovate Ltd', 'West', 'IL002', 'Kandy', '0771234567', 85000.00, 'BSc in IT', 'Create and maintain websites', '2025-05-05 00:00:00', '2025-04-03 11:25:52'),
(190, 2, 'Marketing Manager', 'BrandBoost', 'East', 'BB003', 'Galle', '0715678901', 70000.00, 'Experience in marketing', 'Lead marketing campaigns', '2025-05-10 00:00:00', '2025-04-03 11:25:52'),
(191, 2, 'SEO Specialist', 'DigitalHive', 'North', 'DH004', 'Jaffna', '0778765432', 65000.00, 'Knowledge in SEO', 'Optimize websites for search engines', '2025-05-15 00:00:00', '2025-04-03 11:25:52'),
(192, 3, 'Accountant', 'FinancePro', 'Main', 'FP005', 'Colombo', '0115671234', 95000.00, 'Degree in Accounting', 'Manage company finances', '2025-05-20 00:00:00', '2025-04-03 11:25:52'),
(193, 3, 'Financial Analyst', 'Wealth Advisors', 'South', 'WA006', 'Negombo', '0765437890', 98000.00, 'Experience in financial analysis', 'Analyze market trends', '2025-05-25 00:00:00', '2025-04-03 11:25:52'),
(194, 4, 'Doctor', 'MediCare', 'Central', 'MC007', 'Kurunegala', '0756784321', 150000.00, 'MBBS degree', 'Provide medical consultations', '2025-06-01 00:00:00', '2025-04-03 11:25:53'),
(195, 4, 'Nurse', 'City Hospital', 'West', 'CH008', 'Galle', '0712348765', 75000.00, 'Nursing certification', 'Assist doctors and patients', '2025-06-05 00:00:00', '2025-04-03 11:25:53'),
(196, 20, 'Mechanical Engineer', NULL, NULL, NULL, 'Colombo', '0763214567', 110000.00, 'BSc in Mechanical Engineering', 'Design and test machinery', '2025-06-10 00:00:00', '2025-04-03 11:25:53'),
(197, 20, 'Electrical Engineer', NULL, NULL, NULL, 'Kandy', '0776543210', 105000.00, 'BSc in Electrical Engineering', 'Maintain power systems', '2025-06-15 00:00:00', '2025-04-03 11:25:53'),
(198, 21, 'Legal Advisor', NULL, NULL, NULL, 'Colombo', '0114567890', 130000.00, 'LLB Degree', 'Provide legal guidance', '2025-06-20 00:00:00', '2025-04-03 11:25:53'),
(199, 21, 'Policy Analyst', NULL, NULL, NULL, 'Jaffna', '0778529631', 98000.00, 'Masters in Public Policy', 'Analyze government policies', '2025-06-25 00:00:00', '2025-04-03 11:25:53'),
(200, 22, 'Store Manager', NULL, NULL, NULL, 'Kurunegala', '0753698521', 95000.00, 'Retail experience', 'Manage store operations', '2025-07-10 00:00:00', '2025-04-03 11:25:53'),
(201, 22, 'Cashier', NULL, NULL, NULL, 'Jaffna', '0774561239', 60000.00, 'Basic accounting skills', 'Handle customer payments', '2025-07-15 00:00:00', '2025-04-03 11:25:53'),
(202, 23, 'Customer Service Representative', NULL, NULL, NULL, 'Colombo', '0117456123', 55000.00, 'Good communication skills', 'Assist customers with inquiries', '2025-07-20 00:00:00', '2025-04-03 11:25:53'),
(203, 23, 'Technical Support Specialist', NULL, NULL, NULL, 'Kandy', '0769521478', 72000.00, 'IT knowledge', 'Provide technical support', '2025-07-25 00:00:00', '2025-04-03 11:25:53'),
(206, 25, 'Logistics Coordinator', NULL, NULL, NULL, 'Kandy', '0762581479', 90000.00, 'Experience in logistics', 'Manage transportation and supply chains', '2025-08-10 00:00:00', '2025-04-03 11:25:53'),
(207, 25, 'Warehouse Manager', NULL, NULL, NULL, 'Colombo', '0774568923', 98000.00, 'Experience in warehouse management', 'Oversee storage operations', '2025-08-15 00:00:00', '2025-04-03 11:25:53'),
(208, 26, 'Hotel Manager', NULL, NULL, NULL, 'Galle', '0719638527', 130000.00, 'Experience in hotel management', 'Oversee hotel operations', '2025-08-20 00:00:00', '2025-04-03 11:25:53'),
(209, 26, 'Chef', NULL, NULL, NULL, 'Colombo', '0768527413', 85000.00, 'Culinary certification', 'Prepare high-quality meals', '2025-08-25 00:00:00', '2025-04-03 11:25:53'),
(210, 27, 'Graphic Designer', NULL, NULL, NULL, 'Colombo', '0117532148', 85000.00, 'Degree in Graphic Design', 'Create visual content', '2025-09-01 00:00:00', '2025-04-03 11:25:53'),
(211, 27, 'Video Editor', NULL, NULL, NULL, 'Kandy', '0773654129', 75000.00, 'Experience in video editing', 'Edit and produce video content', '2025-09-05 00:00:00', '2025-04-03 11:25:53'),
(212, 28, 'Civil Engineer', NULL, NULL, NULL, 'Colombo', '0778765432', 120000.00, 'BSc in Civil Engineering', 'Supervise construction projects', '2025-09-10 00:00:00', '2025-04-03 11:25:53'),
(213, 28, 'Site Supervisor', NULL, NULL, NULL, 'Kandy', '0761239876', 80000.00, 'Experience in site management', 'Oversee site operations', '2025-09-15 00:00:00', '2025-04-03 11:25:53'),
(214, NULL, '213', NULL, NULL, NULL, 'eqrw', '1`23456', 0.00, '3ref', 'wrefd', '2025-04-30 00:00:00', '2025-04-06 15:17:55'),
(215, NULL, 'hi', NULL, NULL, NULL, 'wq', '23435', 13243.00, 'erwfgsd', 'rwesgfd', '2025-04-09 00:00:00', '2025-04-06 16:18:01'),
(216, NULL, 'hi', NULL, NULL, NULL, 'eqrw', '123', 13243.00, 'qwer', 'qwer', '2025-04-16 00:00:00', '2025-04-08 11:16:35'),
(217, 27, 'hi', NULL, NULL, NULL, 's', '134234', 213456.00, '213ew', 'sADFSGDHFGJHKLOI', '2025-05-02 00:00:00', '2025-04-08 11:40:14'),
(223, 28, 'hi', 'deshan', 'rty', '123', 'eqwf', '081-2389194', 13243.00, 'q', 'dwsa', '2025-05-07 00:00:00', '2025-04-08 13:33:49'),
(224, 4, 'doctor', 'technohub', 'colombo', 'asd@123', 'colombo', '081-2389194', 1230000.00, 'qwerty', 'asdfgh', '2025-05-10 00:00:00', '2025-04-08 13:41:49'),
(225, 4, 'doctor', 'technohub', 'colombo', 'asd@123', 'colombo', '081-2389194', 1230000.00, 'qwerty', 'asdfgh', '2025-05-10 00:00:00', '2025-04-08 13:46:11'),
(226, 4, 'doctor', 'technohub', 'colombo', 'asd@123', 'colombo', '081-2389194', 1230000.00, 'qwerty', 'asdfgh', '2025-05-10 00:00:00', '2025-04-08 13:48:52'),
(227, 4, 'doctor', 'technohub', 'colombo', 'asd@123', 'colombo', '081-2389194', 1230000.00, 'qwerty', 'asdfgh', '2025-05-10 00:00:00', '2025-04-08 13:49:07'),
(228, 2, 'marketer', 'deshan', 'rty', '123', 'gampaha', '12345678', 45678.00, 'kanna puluwan', 'bonna puluwan', '2025-05-08 00:00:00', '2025-04-08 17:57:14'),
(229, 3, 'finance', 'ala company', 'kandy', 'qwert', 'kandy', '081-2389194', 100000.00, 'qwertt', 'ertyuu', '2025-05-02 00:00:00', '2025-04-08 23:43:11'),
(230, 21, 'lawyer', 'lakshapana', 'colombo', 'aa@11', 'colombo', '1234456', 121433.00, 'ewfdsg', 'Dxzvcbfdgte', '2025-05-09 00:00:00', '2025-04-23 23:22:47'),
(232, 30, 'software engineer', 'UCSC', 'colombo', 'ucsc@123', 'colombo', '123456678', 34567.00, 'computer science', 'helooo', '2025-05-09 00:00:00', '2025-04-24 14:15:28');

-- --------------------------------------------------------

--
-- Table structure for table `job_applications`
--

CREATE TABLE `job_applications` (
  `application_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text DEFAULT NULL,
  `current_company` varchar(150) DEFAULT NULL,
  `current_position` varchar(150) DEFAULT NULL,
  `experience` int(11) NOT NULL,
  `expected_salary` varchar(50) DEFAULT NULL,
  `skills` text NOT NULL,
  `why_applying` text NOT NULL,
  `additional_info` text DEFAULT NULL,
  `resume_path` varchar(255) NOT NULL,
  `cover_letter_path` varchar(255) DEFAULT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_applications`
--

INSERT INTO `job_applications` (`application_id`, `job_id`, `first_name`, `last_name`, `email`, `phone`, `address`, `current_company`, `current_position`, `experience`, `expected_salary`, `skills`, `why_applying`, `additional_info`, `resume_path`, `cover_letter_path`, `submitted_at`) VALUES
(6, 227, 'jhone', 'deshan', 'oshadha.dw@gmail.com', '1234567', '451/1 Pahala Eriyagama Peradeniya', '132r', 'efgh', 3, '45678', 'dsfsghjmhngbv', 'dfghrtjmhbdvsfdq', 'sfdgfetwrfas', 'uploads/1744114317_IS 1111 (1).pdf', 'uploads/1744114317_IS 1115.pdf', '2025-04-08 12:11:57'),
(7, 227, 'Oshadha', 'Weerakoon', 'oshadha.dw@gmail.com', '12345678', '451/1 Pahala Eriyagama Peradeniya', 'ewrt', 'efgh', 4, '1234567', 'dasfdghjhythrgfdsa', 'fghfdgjkyftjhdgsfd', 'fghfbdfsd', 'uploads/1744114360_IS 1111 (1).pdf', 'uploads/1744114360_IS 1115.pdf', '2025-04-08 12:12:40'),
(8, 228, 'alaya', 'bathalaya', 'bathala@gmail.com', '12345678', 'wergthyjuik', 'sdfg', 'sdfg', 4, '567890', 'dsfgsfhjkjydthrsgef', 'dfhetragdshfgref', 'fhgdfsdafd', 'uploads/1744115361_IS 1108.pdf', 'uploads/1744115361_IS 2110.pdf', '2025-04-08 12:29:21'),
(9, 228, 'Oshadha', 'Weerakoon', 'oshadha.dw@gmail.com', '567876543', '451/1 Pahala Eriyagama Peradeniya', 'ewddf', 'dfsvf', 4, 'dsfg', 'ryhtgfdsc', 'vfsfdvf', 'ervfdsc', 'uploads/1744115590_IS 1111 (1).pdf', 'uploads/1744115590_IS 1115.pdf', '2025-04-08 12:33:10'),
(10, 229, 'kavishka', 'nalan', 'kana@gmail.com', '12345678', '451/1 Pahala Eriyagama Peradeniya', 'ala', 'ala', 4, '450000', 'ety', 'dfgh', 'dfg', 'uploads/1744136089_IS 1115.pdf', 'uploads/1744136089_IS 1113 (2).pdf', '2025-04-08 18:14:49'),
(11, 163, 'dasun', 'madushan', 'da@gmail.com', '12345678', 'qwertyuio', 'asdfghjk', 'xcvb', 3, '56785', 'sdfsghjfbvdcs', 'ccvbnfgerfs', 'dfsghgfnbdvsc', 'uploads/1744182157_IS 1115.pdf', 'uploads/1744182157_IS 1111 (1).pdf', '2025-04-09 07:02:37'),
(12, 230, 'Oshadha', 'Weerakoon', 'oshadha.dw@gmail.com', '12345678', '451/1 Pahala Eriyagama Peradeniya', 'kandy', '', 3, '', 'ewrfg', 'weqrfdb', 'eqwgfdb', 'uploads/1745431333_IS 1115.pdf', 'uploads/1745431333_IS 1113 (1).pdf', '2025-04-23 18:02:13'),
(13, 230, 'Oshadha', 'Weerakoon', 'oshadha.dw@gmail.com', '12345', '451/1 Pahala Eriyagama Peradeniya', 'dsaf', 'efgh', 4, '12345678', 'sdf', 'sdac', 'wdsacz', 'uploads/1745463846_IS 1112.pdf', 'uploads/1745463846_IS 1112.pdf', '2025-04-24 03:04:06'),
(14, 232, 'oshadha', 'weerakoon', 'Osha@gmail.com', '1234', '1345', 'ucsc', '13', 3, '1234', 'dwf', 'ew', 'we', 'uploads/1745484462_IS 1108 (2).pdf', 'uploads/1745484462_IS 2110 (2).pdf', '2025-04-24 08:47:42');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `full_name`, `email`, `password`, `address`, `phone_number`) VALUES
(1, 'John Doe', 'john@example.com', 'password123', '123 Street, City', '1234567890'),
(2, 'Jane Smith', 'jane@example.com', 'securepass', '456 Avenue, Town', '0987654321'),
(3, 'Oshadha Weerakoon', 'oshadha.dw@gmail.com', '$2y$10$ZbRAVVBGeJnbDsTmgf90duerSVqNFi4ningi3MvcYf7RoNPH66L.G', '451/1 Pahala Eriyagama Peradeniya', NULL),
(5, 'Oshadha Weerakoon', 'oshadha@gmail.com', '$2y$10$fr/6TKwQakGa5IlEfeicoexOLsxWdkhG91DySP02PWTh1GajFa/km', '451/1 Pahala Eriyagama Peradeniya', NULL),
(8, 'Oshadha Weerakoon', 'oshadh@gmail.com', '1234', '451/1 Pahala Eriyagama Peradeniya', NULL),
(9, 'oshadhanee', 'oshadhanee@gmail.com', '1234', 'asdfghjk', NULL),
(10, 'tharusha', 'tharu@gmail.com', '12345', 'tharu', NULL),
(12, 'Oshadha', 'Osha@gmail.com', '1234', '451/1 Pahala Eriyagama Peradeniya', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`name`,`branch`,`reg_no`);

--
-- Indexes for table `field`
--
ALTER TABLE `field`
  ADD PRIMARY KEY (`field_id`),
  ADD UNIQUE KEY `field_name` (`field_name`);

--
-- Indexes for table `field_req`
--
ALTER TABLE `field_req`
  ADD PRIMARY KEY (`field_id`),
  ADD KEY `company` (`company`,`branch`,`reg_no`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`job_id`),
  ADD KEY `job_field` (`job_field`),
  ADD KEY `company_name` (`company_name`,`branch`,`reg_no`);

--
-- Indexes for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD PRIMARY KEY (`application_id`),
  ADD KEY `fk_job_id` (`job_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone_number` (`phone_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `field`
--
ALTER TABLE `field`
  MODIFY `field_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `field_req`
--
ALTER TABLE `field_req`
  MODIFY `field_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=233;

--
-- AUTO_INCREMENT for table `job_applications`
--
ALTER TABLE `job_applications`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `field_req`
--
ALTER TABLE `field_req`
  ADD CONSTRAINT `field_req_ibfk_1` FOREIGN KEY (`company`,`branch`,`reg_no`) REFERENCES `company` (`name`, `branch`, `reg_no`) ON DELETE CASCADE;

--
-- Constraints for table `job`
--
ALTER TABLE `job`
  ADD CONSTRAINT `job_ibfk_1` FOREIGN KEY (`job_field`) REFERENCES `field` (`field_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `job_ibfk_2` FOREIGN KEY (`company_name`,`branch`,`reg_no`) REFERENCES `company` (`name`, `branch`, `reg_no`) ON DELETE CASCADE;

--
-- Constraints for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD CONSTRAINT `fk_job_id` FOREIGN KEY (`job_id`) REFERENCES `job` (`job_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
