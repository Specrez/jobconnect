-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2025 at 07:39 AM
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
('BrandBoost', '', '', 'East', NULL, NULL, 'BB003', '2025-04-07 11:44:04'),
('BuildTech', '', '', 'North', NULL, NULL, 'BT010', '2025-04-07 11:44:04'),
('City Hospital', '', '', 'West', NULL, NULL, 'CH008', '2025-04-07 11:44:04'),
('deshan', 'oshadha.dw@gmail.com', '$2y$10$9Cx/eVaIetMJWp4LHy.nF.PBlfiQF4UWccYMJTfkKyU.wv79WDw9q', 'kandy', '451/1 Pahala Eriyagama Peradeniya', '0755490025', 'abc@111', '2025-04-07 16:17:28'),
('deshan', 'oshadha@gmail.com', '1234', 'rty', '451/1 Pahala Eriyagama Peradeniya', '123456781', '123', '2025-04-08 10:47:45'),
('DigitalHive', '', '', 'North', NULL, NULL, 'DH004', '2025-04-07 11:44:04'),
('FinancePro', '', '', 'Main', NULL, NULL, 'FP005', '2025-04-07 11:44:04'),
('Innovate Ltd', '', '', 'West', NULL, NULL, 'IL002', '2025-04-07 11:44:04'),
('Innovate Ltd', '', '', 'West', '321 Lane, Town', '4445556666', 'IL456', '2025-04-07 11:44:04'),
('MediCare', '', '', 'Central', NULL, NULL, 'MC007', '2025-04-07 11:44:04'),
('oshadha', 'oshadha.dw@gmail.com', '1234', 'ert', '451/1 Pahala Eriyagama Peradeniya', '0755490025', 'dfg', '2025-04-08 10:42:19'),
('oshadha', 'oshadha.dw@gmail.com', '$2y$10$xfpCY3shdTso8c7pYLmtru7YAAmjsrX1ve8yv4pTrWjFy6jHN.Bbe', 'kandy', '451/1 Pahala Eriyagama Peradeniya', '0755490025', 'abc@111', '2025-04-07 11:44:04'),
('qewgr', 'oshadha.dw@gmail.com', '$2y$10$apO0guKU2WGp7bZ.Bt/ub.v8ajheTK8LPdzf9zhDTjQFUFla5UDLa', 'kandy', '451/1 Pahala Eriyagama Peradeniya', '0755490025', 'abc@111', '2025-04-07 11:44:04'),
('TechCorp', '', '', 'Main', NULL, NULL, 'TC001', '2025-04-07 11:44:04'),
('TechCorp', '', '', 'Main', '789 Road, City', '1112223333', 'TC123', '2025-04-07 11:44:04'),
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
(22, 'Sales & Retail'),
(1, 'Software Development');

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
(215, NULL, 'hi', NULL, NULL, NULL, 'wq', '23435', 13243.00, 'erwfgsd', 'rwesgfd', '2025-04-09 00:00:00', '2025-04-06 16:18:01');

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
(1, 152, 'Oshadha', 'Weerakoon', 'oshadha.dw@gmail.com', '123456789', '451/1 Pahala Eriyagama Peradeniya', '', '', 3, '', 'wqerth', 'qweregrhdgfn', '', 'uploads/1743929814_IS 1111 (1).pdf', 'uploads/1743929814_IS 1109 (2).pdf', '2025-04-06 08:56:54'),
(2, 153, 'Oshadha', 'Weerakoon', 'oshadha.dw@gmail.com', '2345678', '451/1 Pahala Eriyagama Peradeniya', 'dsaf', '', 2, '', 'qdvfb', 'dasfg', '', 'uploads/1743936676_IS 1111 (1).pdf', 'uploads/1743936676_IS 1115.pdf', '2025-04-06 10:51:16');

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
(8, 'Oshadha Weerakoon', 'oshadh@gmail.com', '1234', '451/1 Pahala Eriyagama Peradeniya', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `field_req`
--

CREATE TABLE `field_req` (
  `field_id` int(11) NOT NULL AUTO_INCREMENT,
  `field_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `company` varchar(255) NOT NULL,
  `branch` varchar(255) NOT NULL,
  `reg_no` varchar(50) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`field_id`),
  FOREIGN KEY (`company`, `branch`, `reg_no`) REFERENCES `company` (`name`, `branch`, `reg_no`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `field_req`
ADD COLUMN `status` ENUM('pending', 'approved', 'rejected') NOT NULL DEFAULT 'pending';

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
  ADD CONSTRAINT `job_applications_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `job` (`job_id`) ON DELETE CASCADE;

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
  MODIFY `field_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=216;

--
-- AUTO_INCREMENT for table `job_applications`
--
ALTER TABLE `job_applications`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `job`
--
ALTER TABLE `job`
  ADD CONSTRAINT `job_ibfk_1` FOREIGN KEY (`job_field`) REFERENCES `field` (`field_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `job_ibfk_2` FOREIGN KEY (`company_name`,`branch`,`reg_no`) REFERENCES `company` (`name`, `branch`, `reg_no`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
