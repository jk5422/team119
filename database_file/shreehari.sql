-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2023 at 01:28 PM
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
-- Database: `shreehari`
--

-- --------------------------------------------------------

--
-- Table structure for table `appoinments`
--

CREATE TABLE `appoinments` (
  `apno` bigint(20) UNSIGNED NOT NULL,
  `apdate` date NOT NULL,
  `aptimeslot` varchar(25) NOT NULL,
  `apstatus` tinyint(1) DEFAULT NULL,
  `doctors_did` bigint(20) UNSIGNED NOT NULL,
  `clinics_cid` bigint(20) UNSIGNED NOT NULL,
  `services_sid` bigint(20) UNSIGNED NOT NULL,
  `patients_pid` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appoinments`
--

INSERT INTO `appoinments` (`apno`, `apdate`, `aptimeslot`, `apstatus`, `doctors_did`, `clinics_cid`, `services_sid`, `patients_pid`, `created_at`, `updated_at`) VALUES
(1, '2023-05-27', '05:00PM - 06:00PM', 1, 1, 1, 1, 1, '2023-05-20 04:27:40', '2023-05-23 23:38:37'),
(2, '2023-05-22', '12:00PM - 01:00PM', 1, 1, 1, 1, 1, '2023-05-20 04:55:12', '2023-05-20 04:55:12'),
(3, '2023-05-25', '12:00PM - 01:00PM', NULL, 2, 2, 2, 1, '2023-05-20 05:07:25', '2023-05-24 01:09:31'),
(4, '2023-05-25', '01:00PM - 02:00PM', NULL, 2, 2, 2, 1, '2023-05-21 00:19:25', '2023-05-24 05:42:24'),
(5, '2023-05-25', '11:00AM - 12:00PM', NULL, 1, 1, 1, 1, '2023-05-21 22:38:07', '2023-05-21 22:38:07'),
(6, '2023-05-28', '12:00PM - 01:00PM', NULL, 2, 2, 2, 2, '2023-05-25 03:28:15', '2023-05-25 03:28:15');

-- --------------------------------------------------------

--
-- Table structure for table `clinics`
--

CREATE TABLE `clinics` (
  `cid` bigint(20) UNSIGNED NOT NULL,
  `cname` varchar(50) NOT NULL,
  `cmobile` varchar(10) NOT NULL,
  `cemail` varchar(40) NOT NULL,
  `caddress` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clinics`
--

INSERT INTO `clinics` (`cid`, `cname`, `cmobile`, `cemail`, `caddress`, `created_at`, `updated_at`) VALUES
(1, 'Shree Hari Skin & Hair Clinic - Katargam', '9664585431', 'shreehari326@gmail.com', 'FF 116, Avalon, Opp. Samast Patidar Samaj Wadi, Nr.Ankur School,Amba Talavadi,Katargam, Surat-395006.', NULL, '2023-05-22 10:00:40'),
(2, 'Shree Hari Clinic - jakatnaka', '7862035674', 'Ghanshylimbasiya@gmail.com', '201-202, Vikas shoppers, Nr.Bhagavannagar chowk,Sarthana Jakatnaka to Vrajchowk Road,Surat-395006.', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE `contactus` (
  `idcontact` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `email` varchar(45) NOT NULL,
  `subject` varchar(45) NOT NULL,
  `message` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contactus`
--

INSERT INTO `contactus` (`idcontact`, `name`, `mobile`, `email`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(4, 'jenish koladiya', '7898784565', 'jenish@gmail.com', 'Related to medicine issue', 'i Dont know Which medicine is on which time i want to take.', '2023-05-24 23:37:09', '2023-05-24 23:37:09');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `did` bigint(20) UNSIGNED NOT NULL,
  `dname` varchar(50) NOT NULL,
  `dgender` enum('M','F') NOT NULL,
  `dmobile` varchar(10) NOT NULL,
  `dpassword` varchar(255) NOT NULL,
  `demail` varchar(40) NOT NULL,
  `dqualification` varchar(20) NOT NULL,
  `daddress` varchar(100) NOT NULL,
  `clinics_cid` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`did`, `dname`, `dgender`, `dmobile`, `dpassword`, `demail`, `dqualification`, `daddress`, `clinics_cid`, `created_at`, `updated_at`) VALUES
(1, 'Dr. Binal Desai', 'F', '9664585431', 'eyJpdiI6IkZ4clBleDhJaW5ISGtvLzFJN1lHdUE9PSIsInZhbHVlIjoiNG5nS09pcG9DaHZmZWs4R3dla2l0dz09IiwibWFjIjoiYzEzMThkYjA1NmI2NjhmYmFmNzBlNzAzYjViOGQwYmM1NDdiNTlhYmQyODM4NDA5ODdjYTc3MjFiOWU1NTk0OCIsInRhZyI6IiJ9', 'binaldesai@gmail.com', 'B.A.M.S.MD(AM)', 'Katargam-Surat.', 1, '2023-05-21 15:21:24', '2023-05-23 00:56:11'),
(2, 'Dr . Ghanshaym Limbasiya', 'M', '7862035674', 'eyJpdiI6IngxeFRPaFliMHJ0eE5KdFpPWCtHbFE9PSIsInZhbHVlIjoiUDVHQ1pXNlpaUEFFTHhoWkpUbkpLdz09IiwibWFjIjoiOWY2MmNmMGJjNmU1Zjg0MjVhNDZiYzk4ZTA4NzljMWJmYWM3N2EwNDI4ZTQwNjlmNWI3ZjgzNDFhMmVjODljOSIsInRhZyI6IiJ9', 'Ghanshylimbasiya@gmail.com', 'B.H.M.S(CVD)', 'Katargam-Surat', 2, '2023-05-21 15:21:24', '2023-05-22 03:51:21'),
(3, 'Dr Yogesh Kachadiya', 'M', '7899899797', 'eyJpdiI6IndpaFlzRTdXbWdBV0dFaTMwd0dieHc9PSIsInZhbHVlIjoiMjNQTmxDc0hsdzcyQnZ6ZVgvQ2pzUT09IiwibWFjIjoiZDEwNzMzZTI5N2RhNTAwNzUyODFlM2NjYTkwMGQ4NmQyMzdmMzkxODJjMTUyMGZjNzdjZGE4MGJjNTE2NmFlOCIsInRhZyI6IiJ9', 'yogesh@gmail.com', 'MD', 'Jasdan,Rajkot.', 2, '2023-05-21 09:56:13', '2023-05-21 09:56:13');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `medicineid` bigint(20) UNSIGNED NOT NULL,
  `medicinename` varchar(50) NOT NULL,
  `doctors_did` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`medicineid`, `medicinename`, `doctors_did`, `created_at`, `updated_at`) VALUES
(1, 'cream', 2, NULL, '2023-05-23 01:01:17'),
(2, 'tablet', 1, NULL, NULL),
(4, 'paracetamall', 2, '2023-05-24 11:12:52', '2023-05-24 11:12:52'),
(5, 'azee-250', 3, '2023-05-24 13:12:10', '2023-05-24 13:12:10'),
(6, 'No Prescreption', 1, '2023-05-24 22:32:44', '2023-05-24 22:32:44');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(37, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(38, '2019_08_19_000000_create_failed_jobs_table', 1),
(39, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(40, '2023_05_14_110735_create_clinics_table', 1),
(41, '2023_05_14_111149_create_patients_table', 1),
(42, '2023_05_14_112445_create_doctors_table', 1),
(43, '2023_05_14_113240_create_services_table', 1),
(44, '2023_05_14_113511_create_appoinments_table', 1),
(45, '2023_05_16_082213_create_medicines_table', 1),
(46, '2023_05_16_084809_create_prescriptions_table', 1),
(47, '2023_05_17_043004_create_contactus_table', 1),
(48, '2023_05_20_091213_create_payments_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `pid` bigint(20) UNSIGNED NOT NULL,
  `pname` varchar(50) NOT NULL,
  `pmobile` varchar(10) NOT NULL,
  `pemail` varchar(40) DEFAULT NULL,
  `page` int(11) NOT NULL,
  `pgender` enum('M','F') NOT NULL,
  `password` varchar(255) NOT NULL,
  `paddress` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`pid`, `pname`, `pmobile`, `pemail`, `page`, `pgender`, `password`, `paddress`, `created_at`, `updated_at`) VALUES
(1, 'Jaimin koladiya', '7624068023', 'koladiyajaimin@gmail.com', 21, 'M', 'eyJpdiI6ImlOUUJuZDJhV0p3emcwSlFkdzR2b0E9PSIsInZhbHVlIjoiR3NIYmY5aTFYaE8yYjlnWVNkSmI5dz09IiwibWFjIjoiZjgzYzk0MWVmZTI0NGNmMDY0ZjI0N2ZkYzhhODZjNjI4MzdiN2UxOTVjOTljMGY1NzMyMWY0OTZlM2NlZTJkNyIsInRhZyI6IiJ9', 'Vavdi,Babra,Amreli,365410', '2023-05-20 04:21:02', '2023-05-21 00:20:20'),
(2, 'Jaykrut Kotadiya', '7698014421', 'jaykrut@gmail.com', 21, 'M', 'eyJpdiI6ImlORFEwc3VIZG5lY1pxWVpkRTdTUHc9PSIsInZhbHVlIjoia3RhRWpNZ045Zm5lTFkzMnRXSzdjQT09IiwibWFjIjoiNDNlMjYzMzQyNDc5N2IzZThmZWVkZWM5ZDY0NzIwNjU2OWJiYTNjODNhNzVhZjBlMWE1NTU4NjJhZjRiN2UzZiIsInRhZyI6IiJ9', 'mota ankadiya', '2023-05-24 23:35:32', '2023-05-24 23:35:32');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payid` bigint(20) UNSIGNED NOT NULL,
  `paymentid` varchar(255) DEFAULT NULL,
  `paymode` varchar(25) NOT NULL,
  `appt_pid` bigint(20) UNSIGNED NOT NULL,
  `app_apno` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payid`, `paymentid`, `paymode`, `appt_pid`, `app_apno`, `created_at`, `updated_at`) VALUES
(1, 'pay_LrsKyVYYxuQmAJ', 'Online', 1, 1, '2023-05-20 04:27:40', '2023-05-20 04:27:40'),
(2, 'pay_Lrsow96LMIzpYw', 'Online', 1, 2, '2023-05-20 04:55:13', '2023-05-20 04:55:13'),
(3, NULL, 'Cash', 1, 3, '2023-05-20 05:07:25', '2023-05-20 05:07:25'),
(4, 'pay_LsCenFrRaeJooz', 'Online', 1, 4, '2023-05-21 00:19:25', '2023-05-21 00:19:25'),
(5, 'pay_LsZStfrimCctZO', 'Online', 1, 5, '2023-05-21 22:38:07', '2023-05-21 22:38:07'),
(6, 'pay_Ltq0mow08ODjuY', 'Online', 2, 6, '2023-05-25 03:28:15', '2023-05-25 03:28:15');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `appoinments_apno` bigint(20) UNSIGNED NOT NULL,
  `medicines_medid` bigint(20) UNSIGNED NOT NULL,
  `morning` varchar(2) DEFAULT NULL,
  `afternoon` varchar(2) DEFAULT NULL,
  `evening` varchar(2) DEFAULT NULL,
  `night` varchar(2) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`appoinments_apno`, `medicines_medid`, `morning`, `afternoon`, `evening`, `night`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 1, 'BB', 'BL', 'BD', 'N', NULL, NULL, NULL),
(2, 2, 'AB', 'AL', 'AD', 'N', NULL, NULL, NULL),
(3, 6, NULL, NULL, NULL, NULL, NULL, '2023-05-24 22:33:06', '2023-05-24 22:33:06');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `sid` bigint(20) UNSIGNED NOT NULL,
  `sname` varchar(50) NOT NULL,
  `doctors_did` bigint(20) UNSIGNED NOT NULL,
  `clinics_cid` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`sid`, `sname`, `doctors_did`, `clinics_cid`, `created_at`, `updated_at`) VALUES
(1, 'Laser Treatment', 1, 1, NULL, NULL),
(2, 'Hair removal treatment', 2, 2, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appoinments`
--
ALTER TABLE `appoinments`
  ADD PRIMARY KEY (`apno`),
  ADD KEY `appoinments_clinics_cid_foreign` (`clinics_cid`),
  ADD KEY `appoinments_patients_pid_foreign` (`patients_pid`),
  ADD KEY `appoinments_doctors_did_foreign` (`doctors_did`),
  ADD KEY `appoinments_services_sid_foreign` (`services_sid`);

--
-- Indexes for table `clinics`
--
ALTER TABLE `clinics`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`idcontact`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`did`),
  ADD KEY `doctors_clinics_cid_foreign` (`clinics_cid`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`medicineid`),
  ADD KEY `medicines_doctors_did_foreign` (`doctors_did`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payid`),
  ADD KEY `payments_appt_pid_foreign` (`appt_pid`),
  ADD KEY `payments_app_apno_foreign` (`app_apno`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`appoinments_apno`,`medicines_medid`),
  ADD KEY `prescriptions_medicines_medid_foreign` (`medicines_medid`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `services_doctors_did_foreign` (`doctors_did`),
  ADD KEY `services_clinics_cid_foreign` (`clinics_cid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appoinments`
--
ALTER TABLE `appoinments`
  MODIFY `apno` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `clinics`
--
ALTER TABLE `clinics`
  MODIFY `cid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contactus`
--
ALTER TABLE `contactus`
  MODIFY `idcontact` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `did` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `medicineid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `pid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `sid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appoinments`
--
ALTER TABLE `appoinments`
  ADD CONSTRAINT `appoinments_clinics_cid_foreign` FOREIGN KEY (`clinics_cid`) REFERENCES `clinics` (`cid`),
  ADD CONSTRAINT `appoinments_doctors_did_foreign` FOREIGN KEY (`doctors_did`) REFERENCES `doctors` (`did`),
  ADD CONSTRAINT `appoinments_patients_pid_foreign` FOREIGN KEY (`patients_pid`) REFERENCES `patients` (`pid`),
  ADD CONSTRAINT `appoinments_services_sid_foreign` FOREIGN KEY (`services_sid`) REFERENCES `services` (`sid`);

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_clinics_cid_foreign` FOREIGN KEY (`clinics_cid`) REFERENCES `clinics` (`cid`);

--
-- Constraints for table `medicines`
--
ALTER TABLE `medicines`
  ADD CONSTRAINT `medicines_doctors_did_foreign` FOREIGN KEY (`doctors_did`) REFERENCES `doctors` (`did`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_app_apno_foreign` FOREIGN KEY (`app_apno`) REFERENCES `appoinments` (`apno`),
  ADD CONSTRAINT `payments_appt_pid_foreign` FOREIGN KEY (`appt_pid`) REFERENCES `appoinments` (`patients_pid`);

--
-- Constraints for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD CONSTRAINT `prescriptions_appoinments_apno_foreign` FOREIGN KEY (`appoinments_apno`) REFERENCES `appoinments` (`apno`),
  ADD CONSTRAINT `prescriptions_medicines_medid_foreign` FOREIGN KEY (`medicines_medid`) REFERENCES `medicines` (`medicineid`);

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_clinics_cid_foreign` FOREIGN KEY (`clinics_cid`) REFERENCES `clinics` (`cid`),
  ADD CONSTRAINT `services_doctors_did_foreign` FOREIGN KEY (`doctors_did`) REFERENCES `doctors` (`did`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
