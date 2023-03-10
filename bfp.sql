-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2023 at 08:43 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bfp`
--

-- --------------------------------------------------------

--
-- Table structure for table `bfp_form1`
--

CREATE TABLE `bfp_form1` (
  `form1_id` int(11) NOT NULL,
  `uid` varchar(255) DEFAULT NULL,
  `fname` text DEFAULT NULL,
  `mname` text DEFAULT NULL,
  `lname` text DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `bday` text DEFAULT NULL,
  `brgy` varchar(255) DEFAULT NULL,
  `type` text DEFAULT NULL,
  `fsec` text NOT NULL,
  `structure` text DEFAULT NULL,
  `nc_or_rn` varchar(255) DEFAULT NULL,
  `inspection` text DEFAULT NULL,
  `issuance` text DEFAULT NULL,
  `form1_status` varchar(255) DEFAULT NULL,
  `form1_date_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bfp_form1`
--

INSERT INTO `bfp_form1` (`form1_id`, `uid`, `fname`, `mname`, `lname`, `gender`, `bday`, `brgy`, `type`, `fsec`, `structure`, `nc_or_rn`, `inspection`, `issuance`, `form1_status`, `form1_date_added`) VALUES
(4, '636d1032005b6', 'Villanueva', 'Jonyl Dave', 'Flores', 'Male', '1999-11-13', 'Bagong Pag-Asa (Pob.)', 'New Establishments Buildings', 'Issued FSEC', '1', 'NC', 'NC', 'Issued FSIC for Occupancy', '1', '2023-01-27 09:46:30'),
(5, '636d1032005b6', 'Villanueva', 'Jeffrey', 'F', 'Male', '2000-09-10', 'Acevida', 'New Government Buildings', 'Issued FSEC', '1', 'NC', 'NC', 'Issued FSIC for Occupancy', '1', '2023-01-23 11:58:44'),
(6, '636d1032005b6', 't', 'asdasdasd', 'gf', 'Male', '2000-02-03', 'Bagumbarangay (Pob.) ', 'New Government Buildings', 'Issued Notice of Disapproval (NOD)', '1', 'NC', 'NC', 'Issued FSIC for Occupancy', '1', '2023-01-27 09:46:30'),
(7, '636d1032005b6', 'h', 'asdasdasdasd', 'Flores', 'Male', '1998-02-02', 'Acevida', 'New Establishments Buildings', 'Issued Notice of Disapproval (NOD)', '1', 'NC', 'NC', 'Issued FSIC for Occupancy', '1', '2023-01-22 06:53:03'),
(8, '636d1032005b6', 'h', 'asdasdasdasd', 'Flores', 'Male', '1998-02-02', 'Acevida', 'New Establishments Buildings', 'Issued Notice of Disapproval (NOD)', '1', 'NC', 'NC', 'Issued FSIC for Occupancy', '1', '2023-01-27 09:46:30'),
(9, '636d1032005b6', 'h', 'asdasdasdasd', 'Flores', 'Male', '1998-02-02', 'Acevida', 'New Establishments Buildings', 'Issued Notice of Disapproval (NOD)', '1', 'NC', 'NC', 'Issued FSIC for Occupancy', '1', '2023-01-27 09:46:30'),
(10, '636d1032005b6', 'h', 'asdasdasdasd', 'Flores', 'Male', '1998-02-02', 'Acevida', 'New Government Buildings', 'Issued FSEC', '1', 'RN', 'NC', 'Issued FSIC for Occupancy', '1', '2023-01-23 11:58:47'),
(11, '636d1032005b6', 'h', 'asdasdasdasd', 'Flores', 'Male', '1998-02-02', 'Acevida', 'New Government Buildings', 'Issued FSEC', '1', 'RN', 'NC', 'Issued FSIC for Occupancy', '0', '2022-12-13 10:51:41'),
(12, '636d1032005b6', 'Dela Cruz', 'Juan', 'F', 'Male', '1997-11-13', 'Bagumbarangay (Pob.) ', 'New Government Buildings', 'Issued FSEC', '2', 'NC', 'NC', 'Issued FSIC for Occupancy', '0', '2022-12-14 16:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `bfp_form2`
--

CREATE TABLE `bfp_form2` (
  `form2_id` int(11) NOT NULL,
  `uid` varchar(255) DEFAULT NULL,
  `fname` text DEFAULT NULL,
  `mname` text DEFAULT NULL,
  `lname` text DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `bday` text DEFAULT NULL,
  `brgy` varchar(255) DEFAULT NULL,
  `type` text DEFAULT NULL,
  `structure` text DEFAULT NULL,
  `fsic` text DEFAULT NULL,
  `with_or_not` text DEFAULT NULL,
  `reinspection_1` text DEFAULT NULL,
  `reinspection_2` text DEFAULT NULL,
  `reinspection_3` text DEFAULT NULL,
  `closure` text DEFAULT NULL,
  `form2_status` varchar(255) DEFAULT NULL,
  `form2_date_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bfp_form2`
--

INSERT INTO `bfp_form2` (`form2_id`, `uid`, `fname`, `mname`, `lname`, `gender`, `bday`, `brgy`, `type`, `structure`, `fsic`, `with_or_not`, `reinspection_1`, `reinspection_2`, `reinspection_3`, `closure`, `form2_status`, `form2_date_added`) VALUES
(2, '636d1032005b6', 'Villanueva', 'Jonyl Dave', 'Flores', 'Male', '1999-11-13', 'Acevida', 'New', '1', 'New', 'FSIC Issued WITHIN Prescribed Period', 'NOTICE TO COMPLY', 'Non-Compliant', 'Issued NTC', 'Closure Order for Failure to Comply the Abatement order', '1', '2023-01-23 11:02:22');

-- --------------------------------------------------------

--
-- Table structure for table `bfp_form3`
--

CREATE TABLE `bfp_form3` (
  `form3_id` int(11) NOT NULL,
  `uid` varchar(255) DEFAULT NULL,
  `fname` text DEFAULT NULL,
  `mname` text DEFAULT NULL,
  `lname` text DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `bday` text DEFAULT NULL,
  `brgy` varchar(255) DEFAULT NULL,
  `type` text DEFAULT NULL,
  `structure` text DEFAULT NULL,
  `new_renew` text DEFAULT NULL,
  `with_or_not` text DEFAULT NULL,
  `reinspection_1` text DEFAULT NULL,
  `reinspection_2` text DEFAULT NULL,
  `reinspection_3` text DEFAULT NULL,
  `closure` text DEFAULT NULL,
  `form3_status` varchar(255) DEFAULT NULL,
  `form3_date_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bfp_form3`
--

INSERT INTO `bfp_form3` (`form3_id`, `uid`, `fname`, `mname`, `lname`, `gender`, `bday`, `brgy`, `type`, `structure`, `new_renew`, `with_or_not`, `reinspection_1`, `reinspection_2`, `reinspection_3`, `closure`, `form3_status`, `form3_date_added`) VALUES
(2, '636d1032005b6', 'Dela Cruz', 'Juan', 'F', 'Male', '1999-11-13', 'Bagong Pag-Asa (Pob.)', 'New', '1', 'New', 'FSIC Issued WITHIN Prescribed Period', 'NOTICE TO COMPLY', 'Compliant', 'Issued NTC', 'Closure Order for Failure to Comply the Abatement order', '1', '2023-01-22 07:21:22');

-- --------------------------------------------------------

--
-- Table structure for table `bfp_form4`
--

CREATE TABLE `bfp_form4` (
  `form4_id` int(11) NOT NULL,
  `uid` varchar(255) DEFAULT NULL,
  `fname` text DEFAULT NULL,
  `mname` text DEFAULT NULL,
  `lname` text DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `bday` text DEFAULT NULL,
  `brgy` varchar(255) DEFAULT NULL,
  `type` text NOT NULL,
  `fire_code_fees` text DEFAULT NULL,
  `fees` double(99,1) NOT NULL,
  `form4_status` varchar(255) DEFAULT NULL,
  `form4_date_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bfp_form4`
--

INSERT INTO `bfp_form4` (`form4_id`, `uid`, `fname`, `mname`, `lname`, `gender`, `bday`, `brgy`, `type`, `fire_code_fees`, `fees`, `form4_status`, `form4_date_added`) VALUES
(6, '636d1032005b6', 'tena', 'jian', 'B', 'Male', '2000-11-11', 'Buhay', 'Government Buildings', 'Fire Code Fees for Occupancy', 111.0, '1', '2023-01-25 18:09:23');

-- --------------------------------------------------------

--
-- Table structure for table `bfp_users`
--

CREATE TABLE `bfp_users` (
  `users_id` int(11) NOT NULL,
  `uid` text DEFAULT NULL,
  `email` text NOT NULL,
  `profile_img` text NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `location` text DEFAULT NULL,
  `municipal` varchar(255) NOT NULL,
  `status` text DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `active` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bfp_users`
--

INSERT INTO `bfp_users` (`users_id`, `uid`, `email`, `profile_img`, `username`, `password`, `location`, `municipal`, `status`, `position`, `active`, `date_created`) VALUES
(2, '6358a3e30787a', 'regional@bfp.com', '1929691507 bfp-logo.png', 'Regional', '81dc9bdb52d04dc20036dbd8313ed055', '', '', 'true', 'Admin', 'Online', '2023-01-21 16:59:42'),
(16, '636d1032005b6', '', '1929691507 bfp-logo.png', 'BFP FSED:6495', '81dc9bdb52d04dc20036dbd8313ed055', 'Siniloan', 'Laguna', 'true', 'Municipal', 'offline', '2023-01-12 21:10:10'),
(17, '636d10bd467b0', '', '1929691507 bfp-logo.png', 'BFP FSED:7229', '81dc9bdb52d04dc20036dbd8313ed055', 'Victoria', 'Laguna', 'true', 'Municipal', 'Online', '2023-01-21 16:48:27'),
(18, '636d1183a8152', '', '1929691507 bfp-logo.png', 'BFP FSED:8978', '81dc9bdb52d04dc20036dbd8313ed055', 'Batangas', 'Batangas', 'true', 'Provincial', 'Online', '2023-01-21 16:48:31'),
(19, '636d11b06ec03', '', '1929691507 bfp-logo.png', 'BFP FSED:4680', '81dc9bdb52d04dc20036dbd8313ed055', 'Laguna', 'Laguna', 'true', 'Provincial', 'offline', '2023-01-21 16:48:33'),
(20, '636d11cc7782a', '', '1929691507 bfp-logo.png', 'BFP FSED:7635', '81dc9bdb52d04dc20036dbd8313ed055', 'Balete', 'Batangas', 'true', 'Municipal', 'Online', '2023-01-21 16:48:35'),
(21, '636d1288b66c9', '', '1929691507 bfp-logo.png', 'BFP FSED:7667', '81dc9bdb52d04dc20036dbd8313ed055', 'Malvar', 'Batangas', 'true', 'Municipal', 'Online', '2023-01-21 16:48:37'),
(22, '636d3201d13f2', '', '1929691507 bfp-logo.png', 'BFP FSED:8654', '81dc9bdb52d04dc20036dbd8313ed055', 'Famy', 'Laguna', 'true', 'Municipal', 'offline', '2023-01-21 16:48:40'),
(23, '637cd8ab8f382', '', '1929691507 bfp-logo.png', 'BFP FSED:8502', '81dc9bdb52d04dc20036dbd8313ed055', 'Quezon', 'Quezon', 'true', 'Provincial', 'Online', '2023-01-21 16:48:44'),
(24, '63c0766fb9975', 'jonyl@gmail.com', '1929691507 bfp-logo.png', 'BFP FSED:8744', '81dc9bdb52d04dc20036dbd8313ed055', 'Balete', 'Batangas', 'false', 'Municipal', 'Online', '2023-01-21 16:48:46');

-- --------------------------------------------------------

--
-- Table structure for table `brgy`
--

CREATE TABLE `brgy` (
  `id` int(11) NOT NULL,
  `municipal` varchar(255) DEFAULT NULL,
  `barangay` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brgy`
--

INSERT INTO `brgy` (`id`, `municipal`, `barangay`) VALUES
(2, 'Siniloan', 'Acevida'),
(3, 'Siniloan', 'Bagong Pag-Asa (Pob.)'),
(4, 'Siniloan', 'Bagumbarangay (Pob.) '),
(5, 'Siniloan', 'Buhay'),
(6, 'Siniloan', 'Gen. Luna'),
(7, 'Siniloan', 'Halayhayin '),
(8, 'Siniloan', 'Mendiola'),
(9, 'Siniloan', 'Kapatalan'),
(10, 'Siniloan', 'Laguio'),
(11, 'Siniloan', 'Liyang'),
(12, 'Siniloan', 'Llavac'),
(13, 'Siniloan', 'Pandeno'),
(14, 'Siniloan', 'Magsaysay'),
(15, 'Siniloan', 'Macatad'),
(16, 'Siniloan', 'Mayatba'),
(18, 'Victoria', 'Banca-banca'),
(19, 'Victoria', 'Daniw'),
(20, 'Victoria', 'Masapang'),
(21, 'Victoria', 'Nanhaya (Pob.)'),
(22, 'Victoria', 'Pagalangan'),
(23, 'Victoria', 'San Benito'),
(24, 'Victoria', 'San Felix'),
(25, 'Victoria', 'San Francisco'),
(26, 'Victoria', 'San Roque (Pob.)'),
(27, 'Balete', 'Alangilan'),
(28, 'Balete', 'Calawit'),
(29, 'Balete', 'Looc'),
(30, 'Balete', 'Magapi'),
(31, 'Balete', 'Makina'),
(32, 'Balete', 'Malabanan'),
(33, 'Balete', 'Paligawan'),
(34, 'Balete', 'Palsara'),
(35, 'Balete', 'Poblacion'),
(36, 'Balete', 'Sala'),
(37, 'Balete', 'Sampalocan'),
(38, 'Malvar', 'Bagong Pook'),
(39, 'Malvar', 'Bilucao (San Isidro Western)'),
(40, 'Malvar', 'Bulihan'),
(41, 'Malvar', 'San Gregorio'),
(42, 'Malvar', 'Luta Del Norte'),
(43, 'Malvar', 'Luta Del Sur'),
(44, 'Malvar', 'Poblacion'),
(45, 'Malvar', 'San Andres'),
(46, 'Malvar', 'San Fernando'),
(47, 'Malvar', 'San Isidro East'),
(48, 'Malvar', 'San Juan'),
(49, 'Malvar', 'San Pedro II (Western)'),
(50, 'Malvar', 'San Pedro I (Eastern)'),
(51, 'Malvar', 'San Pioquinto'),
(52, 'Malvar', 'Santiago');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `chat_id` int(11) NOT NULL,
  `chat_to` varchar(255) DEFAULT NULL,
  `chat_uid` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `chat_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`chat_id`, `chat_to`, `chat_uid`, `message`, `chat_time`) VALUES
(26, '6358a3e30787a', '636d11b06ec03', 'asdasd', '2023-01-22 07:42:53'),
(29, '6358a3e30787a', '636d11b06ec03', 'hekki', '2023-02-02 08:00:23'),
(33, '636d1032005b6', '6358a3e30787a', 'Hi There', '2023-02-02 17:08:41'),
(34, '6358a3e30787a', '636d1032005b6', 'Hello', '2023-02-02 17:08:47');

-- --------------------------------------------------------

--
-- Table structure for table `google_oauth`
--

CREATE TABLE `google_oauth` (
  `id` int(11) NOT NULL,
  `provider` varchar(255) NOT NULL,
  `provider_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m_report`
--

CREATE TABLE `m_report` (
  `M_report_id` int(11) NOT NULL,
  `M_uid` varchar(255) NOT NULL,
  `M_report_name` text NOT NULL,
  `M_details` text DEFAULT NULL,
  `reason` text NOT NULL,
  `M_report_comment` text NOT NULL,
  `M_start_report` datetime DEFAULT NULL,
  `M_end_report` datetime DEFAULT NULL,
  `M_report_status` varchar(255) DEFAULT NULL,
  `M_report_submit` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_report`
--

INSERT INTO `m_report` (`M_report_id`, `M_uid`, `M_report_name`, `M_details`, `reason`, `M_report_comment`, `M_start_report`, `M_end_report`, `M_report_status`, `M_report_submit`) VALUES
(1, '636d11b06ec03', 'Laguna Report-373761429', '<p>asdasdasdaasdasd</p>', 'Wrong Entry of Data, Missing Record, Formula Miscalculation', '<p>daasdadad</p>', '2023-01-01 00:00:00', '2023-01-31 00:00:00', 'Need Edit', '2023-02-02 16:17:37');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `uid` varchar(255) DEFAULT NULL,
  `title` text DEFAULT NULL,
  `content` text DEFAULT NULL,
  `click` varchar(255) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `uid`, `title`, `content`, `click`, `date_created`) VALUES
(74, '6358a3e30787a', 'New registration', 'There is a new registration', '1', '2022-11-10 14:52:34'),
(75, '636d1032005b6', 'Approve registration', 'Your registration is approved', '1', '2023-01-21 18:22:03'),
(76, '6358a3e30787a', 'New registration', 'There is a new registration', '1', '2022-11-10 14:54:53'),
(77, '636d10bd467b0', 'Approve registration', 'Your registration is approved', '0', '2022-11-10 14:55:29'),
(78, '6358a3e30787a', 'New registration', 'There is a new registration', '1', '2022-11-10 14:58:11'),
(79, '636d1183a8152', 'Approve registration', 'Your registration is approved', '0', '2022-11-10 14:58:30'),
(80, '6358a3e30787a', 'New registration', 'There is a new registration', '1', '2022-11-10 14:58:56'),
(81, '636d11b06ec03', 'Approve registration', 'Your registration is approved', '1', '2023-01-22 06:28:21'),
(82, '6358a3e30787a', 'New registration', 'There is a new registration', '1', '2022-11-10 14:59:24'),
(83, '636d11cc7782a', 'Approve registration', 'Your registration is approved', '0', '2022-11-10 14:59:39'),
(84, '6358a3e30787a', 'New registration', 'There is a new registration', '1', '2023-01-23 18:24:07'),
(85, '636d1288b66c9', 'Approve registration', 'Your registration is approved', '0', '2022-11-10 15:03:06'),
(86, '6358a3e30787a', 'New registration', 'There is a new registration', '1', '2023-01-23 18:24:07'),
(87, '6358a3e30787a', 'New registration', 'There is a new registration', '1', '2023-01-23 18:24:07'),
(88, '637cd8ab8f382', 'Approve registration', 'Your registration is approved', '0', '2022-11-22 14:12:40'),
(89, '6358a3e30787a', 'New registration', 'There is a new registration', '1', '2023-01-23 18:24:07'),
(90, '636d11b06ec03', 'Send Report', 'Siniloan Send Report for 2023-01-01', '1', '2023-01-28 06:55:22'),
(91, '636d3201d13f2', 'Approve registration', 'Your registration is approved', '1', '2023-01-28 07:32:21'),
(92, '636d11b06ec03', 'Send Report', 'Siniloan Send Report for 2023-01-01', '1', '2023-01-30 07:48:29'),
(93, '636d11b06ec03', 'Send Report', 'Siniloan Send Report for 2023-01-01', '1', '2023-01-30 07:48:29'),
(94, '636d11b06ec03', 'Edit Report', 'Siniloan OFfice Edit their Report', '1', '2023-02-02 12:38:35');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `report_id` int(11) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `report_name` text NOT NULL,
  `details` text DEFAULT NULL,
  `start_report` datetime DEFAULT NULL,
  `end_report` datetime DEFAULT NULL,
  `reason` text NOT NULL,
  `report_comment` text NOT NULL,
  `report_reply` text NOT NULL,
  `report_status` varchar(255) DEFAULT NULL,
  `report_submit` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`report_id`, `uid`, `report_name`, `details`, `start_report`, `end_report`, `reason`, `report_comment`, `report_reply`, `report_status`, `report_submit`) VALUES
(7, '636d1032005b6', 'Report-2023-01', '<p>asdadasdasdasd</p>', '2023-01-01 00:00:00', '2023-01-31 00:00:00', '', '', '<p>none</p>', 'Approved', '2023-01-27 09:46:30'),
(8, '636d1032005b6', 'Report-2023-01', '', '2023-01-01 00:00:00', '2023-01-31 00:00:00', '', '', '', 'Approved', '2023-01-28 07:36:22'),
(9, '636d1032005b6', 'Report-2023-01', '<p>qeweqweqewqeqwe</p>', '2023-01-01 00:00:00', '2023-01-31 00:00:00', 'Wrong Entry of Data, Missing Record, Incorrect List', '', '<p>This is the latest Report</p>', 'Need Edit', '2023-02-02 12:38:46'),
(10, '636d1032005b6', 'Report-2023-01', '<p>qeweqweqewqeqwe</p>', '2023-01-01 00:00:00', '2023-01-31 00:00:00', '', '<p>qqqqqqqqqs</p>', '', 'Need Edit', '2023-02-02 07:50:06');

-- --------------------------------------------------------

--
-- Table structure for table `structure`
--

CREATE TABLE `structure` (
  `structure_id` int(11) NOT NULL,
  `lbl` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `structure`
--

INSERT INTO `structure` (`structure_id`, `lbl`) VALUES
(1, 'Assembly'),
(2, 'Educational'),
(3, 'Day Care'),
(4, 'Health Care'),
(5, 'Residential Board & Care'),
(6, 'Detention & Correctional'),
(7, 'Hotel'),
(8, 'Dormitories'),
(9, 'Apartment Building'),
(10, 'Lodging and Rooming house'),
(11, 'Single and Two Family Dwelling Unit'),
(12, 'Mercantile'),
(13, 'Business'),
(14, 'Industrial'),
(15, 'Storage'),
(16, 'Special Structures');

-- --------------------------------------------------------

--
-- Table structure for table `structure_data`
--

CREATE TABLE `structure_data` (
  `data_id` int(11) NOT NULL,
  `uid` varchar(255) DEFAULT NULL,
  `report_id` int(11) DEFAULT NULL,
  `structure_type` varchar(255) DEFAULT NULL,
  `type` text NOT NULL,
  `Assembly` int(11) DEFAULT NULL,
  `Educational` int(11) DEFAULT NULL,
  `DayCare` int(11) DEFAULT NULL,
  `HealthCare` int(11) DEFAULT NULL,
  `ResidentialBoardandCare` int(11) DEFAULT NULL,
  `DetentionandCorrectional` int(11) DEFAULT NULL,
  `Hotel` int(11) DEFAULT NULL,
  `Dormitories` int(11) DEFAULT NULL,
  `ApartmentBuilding` int(11) DEFAULT NULL,
  `LodgingandRooming_house` int(11) DEFAULT NULL,
  `SingleandTwoFamilyDwellingUnit` int(11) DEFAULT NULL,
  `Mercantile` int(11) DEFAULT NULL,
  `Business` int(11) DEFAULT NULL,
  `Industrial` int(11) DEFAULT NULL,
  `Storage` int(11) DEFAULT NULL,
  `SpecialStructures` int(11) DEFAULT NULL,
  `structotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `structure_data`
--

INSERT INTO `structure_data` (`data_id`, `uid`, `report_id`, `structure_type`, `type`, `Assembly`, `Educational`, `DayCare`, `HealthCare`, `ResidentialBoardandCare`, `DetentionandCorrectional`, `Hotel`, `Dormitories`, `ApartmentBuilding`, `LodgingandRooming_house`, `SingleandTwoFamilyDwellingUnit`, `Mercantile`, `Business`, `Industrial`, `Storage`, `SpecialStructures`, `structotal`) VALUES
(47, '636d1032005b6', 31, 'NC', 'New Establishments Buildings', 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 128),
(48, '636d1032005b6', 31, 'RN', 'New Establishments Buildings', 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 128);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bfp_form1`
--
ALTER TABLE `bfp_form1`
  ADD PRIMARY KEY (`form1_id`);

--
-- Indexes for table `bfp_form2`
--
ALTER TABLE `bfp_form2`
  ADD PRIMARY KEY (`form2_id`);

--
-- Indexes for table `bfp_form3`
--
ALTER TABLE `bfp_form3`
  ADD PRIMARY KEY (`form3_id`);

--
-- Indexes for table `bfp_form4`
--
ALTER TABLE `bfp_form4`
  ADD PRIMARY KEY (`form4_id`);

--
-- Indexes for table `bfp_users`
--
ALTER TABLE `bfp_users`
  ADD PRIMARY KEY (`users_id`);

--
-- Indexes for table `brgy`
--
ALTER TABLE `brgy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `google_oauth`
--
ALTER TABLE `google_oauth`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_report`
--
ALTER TABLE `m_report`
  ADD PRIMARY KEY (`M_report_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `structure`
--
ALTER TABLE `structure`
  ADD PRIMARY KEY (`structure_id`);

--
-- Indexes for table `structure_data`
--
ALTER TABLE `structure_data`
  ADD PRIMARY KEY (`data_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bfp_form1`
--
ALTER TABLE `bfp_form1`
  MODIFY `form1_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `bfp_form2`
--
ALTER TABLE `bfp_form2`
  MODIFY `form2_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bfp_form3`
--
ALTER TABLE `bfp_form3`
  MODIFY `form3_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bfp_form4`
--
ALTER TABLE `bfp_form4`
  MODIFY `form4_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bfp_users`
--
ALTER TABLE `bfp_users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `brgy`
--
ALTER TABLE `brgy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `google_oauth`
--
ALTER TABLE `google_oauth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_report`
--
ALTER TABLE `m_report`
  MODIFY `M_report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `structure`
--
ALTER TABLE `structure`
  MODIFY `structure_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `structure_data`
--
ALTER TABLE `structure_data`
  MODIFY `data_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
