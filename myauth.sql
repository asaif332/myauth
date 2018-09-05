-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 05, 2018 at 05:29 PM
-- Server version: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ems`
--

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL,
  `role` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`) VALUES
(1, 'admin'),
(2, 'user'),
(3, 'role3');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(175) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `reset_password_code` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `email_2` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `address`, `department_id`, `role_id`, `reset_password_code`, `created_at`) VALUES
(4, 'test', 'test@gmail.com', '$2y$10$czUy1Gyt/rn7pea6bHu8rOqj5WHJCqxqoMKPzQUecwOaNVv6ASsp6', '', '', NULL, 1, NULL, '2018-07-31 04:06:08'),
(5, 'demo', 'demo@gmail.com', '$2y$10$8e4QOPyDX0X.l4HKaqWGt.qBlI9idnQ3QUarH.yPE.9JuB7uufmFm', '', '', NULL, 1, NULL, '2018-07-31 11:08:32'),
(6, 'user', 'user@gmail.com', '$2y$10$pnh8NkeS2QjhkRJh4F/gZ.VQVaE7uj8wZYEFQCuJ5v4RfnC839ZKq', '', '', 2, 2, NULL, '2018-08-01 06:17:30'),
(7, 'first employee', 'first@gmail.com', '', '4444444444', 'dfslf dslfjd slfjklds fldsk jfdf', 2, 3, NULL, '2018-08-01 08:04:56'),
(8, 'employee 2', 'kdsfjk@gmail.com', '$2y$10$zrSWV.2zoAwcVl1SdZx0fOpSDwDwIRVAIAB/kBJDT0iJDdIFmYdCq', '1111111111', 'dfdf d d d d ds ', 2, 2, NULL, '2018-08-01 08:10:41'),
(9, 'employee 3', 'b@gmail.com', '$2y$10$9Xee6Rv3.syr16WpU8RBAenhlwvCpphtFgHaFkkAM13tbhRwadWwy', '1111111112', 'dfdfd', 1, 3, NULL, '2018-08-01 08:15:11'),
(15, 'new', NULL, '', '4444444455', 'df', 1, 3, NULL, '2018-08-03 18:40:17'),
(16, 'saif', 'asaif332@gmail.com', '$2y$10$8jlqbRAK0zivTlE5g7K1sOgktEHLCpTiqRfXigAv28LoxHFO/sEHW', '', '', NULL, 15, NULL, '2018-09-05 16:52:50'),
(11, 'new employee', NULL, '', '7777778877', 'df', 2, 3, NULL, '2018-08-01 10:36:45'),
(13, 'xyz', 'xyz@gmail.com', '', '5555555555', ' djflkj dlkf dlfjd kfl dl', 2, 3, NULL, '2018-08-02 04:53:40');

-- --------------------------------------------------------

--
-- Table structure for table `user_sessions`
--

DROP TABLE IF EXISTS `user_sessions`;
CREATE TABLE IF NOT EXISTS `user_sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hash` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
