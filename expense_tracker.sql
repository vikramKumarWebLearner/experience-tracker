-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2022 at 04:31 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `expense_tracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `borrow`
--

CREATE TABLE `borrow` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `borrow`
--

INSERT INTO `borrow` (`id`, `uid`, `name`) VALUES
(1, 1, 'Vikram'),
(2, 1, 'Vivek'),
(3, 2, 'Vikram'),
(4, 2, 'Vivek'),
(6, 3, 'vikram'),
(7, 3, 'vishal'),
(8, 3, 'vivek'),
(9, 3, 'ashok'),
(10, 7, 'ashok');

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`id`, `uid`, `name`) VALUES
(1, 0, 'Food And Dining'),
(2, 0, 'Shopping'),
(3, 0, 'Travelling'),
(4, 0, 'Entertainment'),
(5, 0, 'Medical'),
(6, 0, 'Personal Care'),
(7, 0, 'Education'),
(8, 0, 'Bills and Utilities'),
(9, 0, 'Investment'),
(10, 0, 'Rent'),
(11, 0, 'Taxes'),
(12, 0, 'Insurance'),
(13, 0, 'Gifts and Donation'),
(14, 1, 'ISCON');

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`id`, `uid`, `name`) VALUES
(1, 0, 'Salary'),
(2, 0, 'Sold Items'),
(3, 0, 'Coupons'),
(4, 0, 'Pocket Money');

-- --------------------------------------------------------

--
-- Table structure for table `lend`
--

CREATE TABLE `lend` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lend`
--

INSERT INTO `lend` (`id`, `uid`, `name`) VALUES
(1, 1, 'Pusha Ram bhaiya'),
(2, 1, 'D P'),
(3, 1, 'Vikram'),
(4, 1, 'Vivek'),
(5, 1, 'Vishal '),
(6, 2, 'Vikram'),
(7, 2, 'D P'),
(8, 2, 'Pusha Ram bhaiya'),
(9, 3, 'vikram'),
(10, 3, 'vishal'),
(11, 3, 'vivek'),
(12, 3, 'ashok');

-- --------------------------------------------------------

--
-- Table structure for table `reminders`
--

CREATE TABLE `reminders` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `amount` int(11) NOT NULL,
  `type` varchar(30) NOT NULL,
  `category` varchar(30) NOT NULL,
  `time` time NOT NULL,
  `note` text NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `amount` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `category` varchar(20) NOT NULL,
  `wallet` varchar(10) NOT NULL,
  `note` text NOT NULL,
  `uid` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `date`, `amount`, `type`, `category`, `wallet`, `note`, `uid`) VALUES
(1, '2022-05-01', 5000, 'income', 'Salary', 'PAYTM', 'From Home', 1),
(2, '2022-05-07', 2700, 'expense', 'Rent', 'PAYTM', 'Room Rent', 1),
(3, '2022-05-01', 423, 'lend', 'Pusha Ram bhaiya', 'Amazon Pay', 'Send to Pusha Ram bhaiya', 1),
(4, '2022-05-11', 299, 'lend', 'D P', 'Amazon Pay', '8386834575 Airtel Recharge ', 1),
(5, '2022-05-14', 149, 'lend', 'D P', 'Amazon Pay', '8386824274 VI Recharge ', 1),
(6, '2022-05-15', 130, 'expense', 'Personal Care', 'Amazon Pay', 'Hair cutting ', 1),
(7, '2022-05-15', 18, 'expense', 'Food And Dining', 'Amazon Pay', 'A one Sabji Bhandar', 1),
(8, '2022-05-15', 26, 'expense', 'Food And Dining', 'Amazon Pay', 'Dahi and Chhach', 1),
(9, '2022-05-16', 70, 'expense', 'Education', 'Cash', 'For udhgosh pass', 1),
(10, '2022-05-16', 150, 'expense', 'Food And Dining', 'Amazon Pay', 'Aata', 1),
(11, '2022-05-16', 10, 'expense', 'Food And Dining', 'Amazon Pay', 'Chhach', 1),
(12, '2022-05-17', 32, 'expense', 'Food And Dining', 'Cash', 'A one Sabji Bhandar', 1),
(13, '2022-05-17', 26, 'expense', 'Food And Dining', 'Cash', 'Dahi and Chhach', 1),
(14, '2022-05-18', 20, 'expense', 'Food And Dining', 'Cash', 'Dahi and chocolate 🍫 ', 1),
(15, '2022-05-19', 20, 'expense', 'Food And Dining', 'Cash', 'Dahi and chocolate 🍫 ', 1),
(16, '2022-05-21', 12, 'expense', 'Food And Dining', 'Cash', 'A one Sabji Bhandar', 1),
(17, '2022-05-21', 26, 'expense', 'Food And Dining', 'Cash', 'Dahi and Chhach', 1),
(18, '2022-05-22', 33, 'expense', 'Food And Dining', 'Cash', 'A one Sabji Bhandar', 1),
(19, '2022-05-22', 20, 'expense', 'Food And Dining', 'Cash', 'Dahi and chocolate 🍫 ', 1),
(20, '2022-05-23', 10, 'expense', 'Food And Dining', 'Cash', 'Chhach', 1),
(21, '2022-05-24', 40, 'expense', 'Food And Dining', 'Cash', 'Dahi', 1),
(22, '2022-05-25', 21, 'expense', 'Food And Dining', 'Cash', 'A one Sabji Bhandar', 1),
(23, '2022-05-25', 31, 'expense', 'Food And Dining', 'Cash', 'Dahi and Chhach', 1),
(24, '2022-05-26', 20, 'expense', 'Food And Dining', 'Cash', 'Dahi', 1),
(25, '2022-05-27', 23, 'expense', 'Food And Dining', 'Cash', 'A one Sabji Bhandar', 1),
(26, '2022-05-27', 16, 'expense', 'Food And Dining', 'Cash', 'Dahi', 1),
(27, '2022-05-27', 6600, 'income', 'Salary', 'Cash', 'INDIAN BANK ACCOUNT ', 1),
(28, '2022-05-28', 10, 'expense', 'Food And Dining', 'Cash', 'Dahi', 1),
(29, '2022-05-29', 20, 'expense', 'Food And Dining', 'Cash', 'Dahi and chocolate 🍫 ', 1),
(30, '2022-05-29', 25, 'expense', 'Food And Dining', 'Cash', 'A one Sabji Bhandar', 1),
(31, '2022-05-29', 31, 'expense', 'Food And Dining', 'Cash', 'Dahi and Chhach', 1),
(32, '2022-05-31', 40, 'expense', 'Food And Dining', 'Cash', 'A one Sabji Bhandar', 1),
(33, '2022-05-31', 90, 'expense', 'Food And Dining', 'Cash', 'A one juice 🥤 ', 1),
(34, '2022-05-31', 50, 'expense', 'Food And Dining', 'Cash', 'Dahi and chocolate 🍫 ', 1),
(35, '2022-05-31', 150, 'expense', 'Food And Dining', 'Cash', 'Aata', 1),
(36, '2022-06-01', 10, 'expense', 'Food And Dining', 'Cash', 'Chhach', 1),
(37, '2022-06-02', 20, 'expense', 'Food And Dining', 'Cash', 'Dahi', 1),
(38, '2022-06-03', 53, 'expense', 'Food And Dining', 'Cash', 'A one Sabji Bhandar', 1),
(39, '2022-06-03', 10, 'expense', 'Food And Dining', 'Cash', 'Chhach', 1),
(40, '2022-06-04', 40, 'expense', 'Food And Dining', 'Cash', 'Dahi and chocolate 🍫 ', 1),
(41, '2022-06-04', 20, 'borrow', 'Vikram', 'Cash', 'previous months ', 1),
(42, '2022-06-04', 650, 'borrow', 'Vikram', 'Cash', 'Ghee from Vikram ', 1),
(43, '2022-06-04', 2700, 'expense', 'Rent', 'Cash', 'Room Rent', 1),
(44, '2022-06-05', 34, 'expense', 'Food And Dining', 'Cash', 'Dahi and chocolate 🍫 ', 1),
(45, '2022-06-06', 9, 'lend', 'Vikram', 'Cash', 'Pen for Vikram ', 1),
(46, '2022-06-07', 27, 'lend', 'Vikram', 'Cash', 'A one Sabji for Vikram ', 1),
(47, '2022-06-07', 5, 'lend', 'Vikram', 'Cash', 'Ratlami for Vikram ', 1),
(48, '2022-06-07', 25, 'expense', 'Food And Dining', 'Cash', 'A one Sabji Bhandar', 1),
(49, '2022-06-07', 22, 'expense', 'Food And Dining', 'Cash', 'Dahi and chocolate 🍫 ', 1),
(50, '2022-06-07', 215, 'expense', 'Food And Dining', 'Cash', 'Ground nut oil 1 litre ', 1),
(51, '2022-06-08', 32, 'expense', 'Food And Dining', 'Cash', 'Dahi', 1),
(52, '2022-06-08', 2999, 'lend', 'D P', 'Cash', '8386834575 Airtel Recharge ', 1),
(53, '2022-06-08', 4000, 'income', 'Salary', 'Cash', 'From Home', 1),
(54, '2022-06-10', 32, 'expense', 'Food And Dining', 'Cash', 'A one Sabji Bhandar', 1),
(55, '2022-06-10', 18, 'lend', 'Vikram', 'Cash', 'A one Sabji for Vikram ', 1),
(56, '2022-06-10', 18, 'expense', 'Food And Dining', 'Cash', 'Dahi', 1),
(57, '2022-06-12', 10, 'expense', 'Food And Dining', 'Cash', 'Chhach', 1),
(58, '2022-06-13', 10, 'expense', 'Food And Dining', 'Cash', 'Chhach', 1),
(59, '2022-06-13', 45, 'expense', 'Food And Dining', 'Cash', 'A one Sabji Bhandar', 1),
(60, '2022-07-09', 24, 'lend', 'Vikram', 'Cash', 'A one Sabji for Vikram ', 1),
(61, '2022-06-14', 16, 'expense', 'Food And Dining', 'Cash', 'Dahi', 1),
(62, '2022-06-15', 10, 'expense', 'Food And Dining', 'Cash', 'Dahi', 1),
(63, '2022-06-16', 19, 'expense', 'Food And Dining', 'Cash', 'A one Sabji Bhandar', 1),
(64, '2022-06-16', 20, 'lend', 'Vikram', 'Cash', 'A one Sabji for Vikram ', 1),
(65, '2022-06-16', 16, 'expense', 'Food And Dining', 'Cash', 'Dahi', 1),
(66, '2022-06-16', 150, 'expense', 'Food And Dining', 'Cash', 'Aata', 1),
(67, '2022-06-17', 350, 'expense', 'Travelling', 'Cash', 'JODHPUR to AJMER ', 1),
(68, '2022-06-17', 10, 'expense', 'Food And Dining', 'Cash', 'Admit card download from Bajrang computers ', 1),
(69, '2022-06-17', 100, 'expense', 'Food And Dining', 'Cash', 'slipper', 1),
(70, '2022-06-17', 40, 'expense', 'Food And Dining', 'Cash', 'ice cream ', 1),
(71, '2022-06-18', 30, 'expense', 'Travelling', 'Cash', 'By-pass to railway station in ajmer ', 1),
(72, '2022-06-18', 60, 'expense', 'Rent', 'Cash', 'Room Rent in ajmer ', 1),
(73, '2022-06-18', 30, 'expense', 'Travelling', 'Cash', 'bus station to bright india public school in ajmer ', 1),
(74, '2022-06-18', 40, 'expense', 'Food And Dining', 'Cash', 'chocolate ice-cream in ajmer ', 1),
(75, '2022-06-18', 40, 'expense', 'Food And Dining', 'Cash', 'pineapple juice in ajmer ', 1),
(76, '2022-06-18', 20, 'expense', 'Food And Dining', 'Cash', 'water bottle at bus stand in ajmer ', 1),
(77, '2022-06-18', 10, 'expense', 'Food And Dining', 'Cash', 'bright india public schoo to railway station in ajmer ', 1),
(78, '2022-06-21', 130, 'expense', 'Travelling', 'Cash', 'Mokalpur to jodhpur ', 1),
(79, '2022-06-21', 58, 'expense', 'Travelling', 'Cash', 'pavota bus stand to room', 1),
(80, '2022-06-21', 30, 'expense', 'Food And Dining', 'Cash', 'A one Sabji Bhandar', 1),
(81, '2022-06-21', 19, 'lend', 'Vikram', 'Cash', 'A one Sabji for Vikram ', 1),
(82, '2022-06-21', 35, 'expense', 'Food And Dining', 'Cash', 'Dahi and chocolate 🍫 ', 1),
(83, '2022-06-21', 1000, 'income', 'Salary', 'Cash', 'From Home', 1),
(84, '2022-06-23', 10, 'lend', 'Vikram', 'Cash', 'A one Sabji for Vikram ', 1),
(85, '2022-06-23', 20, 'expense', 'Food And Dining', 'Cash', 'A one ice-cream ', 1),
(86, '2022-06-23', 30, 'expense', 'Food And Dining', 'Cash', 'Dahi and Chhach and chocolate 🍫 ', 1),
(87, '2022-06-24', 80, 'expense', 'Food And Dining', 'Cash', 'juice 🥤 ', 1),
(88, '2022-06-24', 80, 'borrow', 'Vikram', 'Cash', 'juice 🥤 from Vikram ', 1),
(89, '2022-06-25', 41, 'expense', 'Food And Dining', 'Cash', 'A one Sabji Bhandar', 1),
(90, '2022-06-25', 30, 'expense', 'Food And Dining', 'Cash', 'Dahi and Chhach and chocolate 🍫 ', 1),
(91, '2022-06-28', 19, 'borrow', 'Vikram', 'Cash', 'A one Sabji from Vikram ', 1),
(92, '2022-06-30', 35, 'expense', 'Food And Dining', 'Cash', 'A one Sabji Bhandar', 1),
(93, '2022-06-30', 10, 'expense', 'Food And Dining', 'Cash', 'Chhach', 1),
(94, '2022-07-02', 30, 'lend', 'Vikram', 'Cash', 'cash ', 1),
(95, '2022-07-02', 20, 'lend', 'D P', 'Cash', 'cash ', 1),
(96, '2022-07-03', 16, 'expense', 'Food And Dining', 'Cash', 'Dahi', 1),
(97, '2022-07-03', 40, 'expense', 'Food And Dining', 'Cash', 'lassi at restaurant ', 1),
(98, '2022-07-03', 105, 'lend', 'Vikram', 'Cash', 'dal bati at restaurant', 1),
(99, '2022-07-03', 5000, 'borrow', 'Vikram', 'PAYTM', 'cash ', 1),
(100, '2022-06-04', 50, 'expense', 'Food And Dining', 'Cash', 'Sandwich 🥪 let night ', 1),
(101, '2022-07-04', 50, 'lend', 'Vikram', 'Cash', 'Sandwich 🥪 let night ', 1),
(102, '2022-07-04', 50, 'lend', 'Vishal ', 'Cash', 'Sandwich 🥪 let night ', 1),
(103, '2022-07-05', 37, 'borrow', 'Vikram', 'Cash', 'A one Sabji from Vikram ', 1),
(104, '2022-07-05', 16, 'expense', 'Food And Dining', 'Cash', 'Dahi', 1),
(105, '2022-07-05', 50, 'expense', 'Education', 'Cash', 'Riport photo copy at Bajrang computers ', 1),
(106, '2022-07-05', 500, 'borrow', 'Vikram', 'Cash', 'cash ', 1),
(107, '2022-07-06', 142, 'expense', 'Food And Dining', 'Cash', 'fast food at navin restaurant ', 1),
(108, '2022-07-06', 142, 'lend', 'Vivek', 'Cash', 'fast food at navin restaurant ', 1),
(109, '2022-07-06', 142, 'lend', 'Vikram', 'Cash', 'fast food at navin restaurant ', 1),
(110, '2022-07-06', 100, 'borrow', 'Vivek', 'Cash', 'for fast food at navin restaurant ', 1),
(111, '2022-07-06', 60, 'expense', 'Food And Dining', 'Cash', 'chocolate shake ', 1),
(112, '2022-07-06', 60, 'lend', 'Vikram', 'Cash', 'chocolate shake ', 1),
(113, '2022-07-06', 60, 'lend', 'Vivek', 'Cash', 'chocolate shake ', 1),
(114, '2022-07-06', 4734, 'lend', 'Vikram', 'Cash', 'Lenovo laptop service ', 1),
(115, '2022-07-09', 10, 'lend', 'D P', 'Cash', 'cash ', 1),
(116, '2022-07-06', 50, 'expense', 'Food And Dining', 'Cash', 'chocolates for children 🧒 ', 1),
(117, '2022-07-07', 16, 'expense', 'Food And Dining', 'Cash', 'Dahi', 1),
(118, '2022-07-07', 16, 'borrow', 'Vikram', 'Cash', 'Dahi ', 1),
(119, '2022-07-08', 10, 'expense', 'Food And Dining', 'Cash', 'Chhach', 1),
(120, '2022-07-08', 16, 'lend', 'Vikram', 'Cash', 'Dahi for Vikram', 1),
(121, '2022-07-08', 27, 'lend', 'Vikram', 'Cash', 'medicine ', 1),
(122, '2022-07-09', 30, 'expense', 'Food And Dining', 'Cash', 'A one Sabji Bhandar', 1),
(123, '2022-07-09', 16, 'expense', 'Food And Dining', 'Cash', 'Dahi', 1),
(124, '2022-07-09', 30, 'borrow', 'Vikram', 'Cash', 'A one Sabji from Vikram ', 1),
(125, '2022-07-09', 14, 'borrow', 'Vikram', 'Cash', 'Dahi', 1),
(144, '2022-07-10', 10, 'expense', 'Food And Dining', 'Cash', '', 2),
(145, '2022-07-10', 10, 'expense', 'Shopping', 'Cash', '', 2),
(146, '2022-07-10', 10, 'expense', 'Travelling', 'Cash', '', 2),
(147, '2022-07-10', 10, 'expense', 'Entertainment', 'Cash', '', 2),
(148, '2022-07-10', 10, 'expense', 'Medical', 'Cash', '', 2),
(149, '2022-07-10', 10, 'expense', 'Personal Care', 'Cash', '', 2),
(150, '2022-07-10', 10, 'expense', 'Education', 'Cash', '', 2),
(151, '2022-07-10', 10, 'expense', 'Bills and Utilities', 'Cash', '', 2),
(152, '2022-07-10', 10, 'expense', 'Investment', 'Cash', '', 2),
(153, '2022-07-10', 10, 'expense', 'Rent', 'Cash', '', 2),
(154, '2022-07-10', 10, 'expense', 'Taxes', 'Cash', '', 2),
(155, '2022-07-10', 10, 'expense', 'Insurance', 'Cash', '', 2),
(156, '2022-07-10', 10, 'expense', 'Gifts and Donation', 'Cash', '', 2),
(157, '2022-07-10', 10, 'income', 'Salary', 'Cash', '', 2),
(158, '2022-07-10', 10, 'income', 'Sold Items', 'Cash', '', 2),
(159, '2022-07-10', 10, 'income', 'Coupons', 'Cash', '', 2),
(160, '2022-07-10', 10, 'income', 'Pocket Money', 'Cash', '', 2),
(161, '2022-07-10', 20, 'borrow', 'Vikram', 'Cash', '', 2),
(163, '2022-07-10', 10, 'lend', 'D P', 'Cash', '', 2),
(176, '2022-07-10', 1000, 'income', 'Salary', 'Cash', '', 3),
(177, '2022-07-10', 100, 'expense', 'Personal Care', 'Cash', '', 3),
(179, '2022-07-04', 12, 'expense', 'Education', 'Cash', '', 3),
(180, '2022-07-01', 24, 'expense', 'Investment', 'Cash', '', 3),
(181, '2022-07-06', 29, 'expense', 'Rent', 'Cash', '', 3),
(182, '2022-07-07', 42, 'expense', 'Gifts and Donation', 'Cash', '', 3),
(184, '2022-07-10', 500, 'income', 'Salary', 'Cash', '', 3),
(185, '2022-07-10', 100, 'expense', 'Food And Dining', 'Cash', '', 3),
(186, '2022-07-10', 100, 'expense', 'Food And Dining', 'Cash', '', 3),
(187, '2022-07-10', 12, 'expense', 'Medical', 'Cash', '', 3),
(188, '2022-07-10', 100, 'expense', 'Rent', 'Cash', '', 3),
(189, '2022-07-10', 24, 'expense', 'Insurance', 'Cash', '', 3),
(190, '2022-07-10', 100, 'expense', 'Food And Dining', 'Cash', '', 3),
(200, '2022-07-10', 16, 'expense', 'Food And Dining', 'Cash', 'Dhahi', 1),
(201, '2022-07-10', 16, 'lend', 'Vikram', 'Cash', 'Dhahi for Vikram', 1),
(203, '2022-07-11', 500, 'borrow', 'vivek', 'Cash', '', 3),
(204, '2022-07-11', 1, 'expense', 'Food And Dining', 'Cash', '', 3),
(205, '2022-07-11', 1, 'lend', 'vishal', 'Cash', '', 3),
(206, '2022-07-11', 423, 'expense', 'Entertainment', 'Cash', 'movie', 1),
(207, '2022-07-10', 120, 'expense', 'Gifts and Donation', 'Cash', 'bday gift for ganesh', 1),
(208, '2022-07-18', 15, 'income', 'Salary', 'Cash', '', 5),
(209, '2022-07-18', 15, 'expense', 'Shopping', 'Amazon Pay', '', 5),
(210, '2022-07-24', 100, 'borrow', 'ashok', 'PAYTM', '', 7),
(230, '2022-08-29', 100, 'income', 'Salary', 'Cash', '', 5),
(231, '2022-08-29', 99, 'expense', 'Food And Dining', 'Cash', '', 5),
(237, '2022-08-29', 21, 'expense', 'Food And Dining', 'Cash', '', 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(200) NOT NULL,
  `mobileNumber` bigint(11) NOT NULL,
  `password` varchar(200) NOT NULL,
  `regDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `monthlyBudget` int(11) DEFAULT NULL,
  `budget` int(11) DEFAULT NULL,
  `debt` int(11) DEFAULT NULL,
  `credit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `mobileNumber`, `password`, `regDate`, `monthlyBudget`, `budget`, `debt`, `credit`) VALUES
(1, 'ASHOK KUMAR', 'ashokkhichi010@gmail.com', 9785304381, 'e10adc3949ba59abbe56e057f20f883e', '2022-07-09 21:12:36', 5000, 3880, 6466, 9464),
(2, 'vikram', 'vikram@gmail.com', 9784923848, '202cb962ac59075b964b07152d234b70', '2022-07-10 02:20:08', 500, 9840, 20, 10),
(3, 'Vivek Bishnoi', 'vivkbishno', 1234, '81dc9bdb52d04dc20036dbd8313ed055', '2022-07-10 06:14:41', 0, 94, 500, 1),
(4, 'Vishal', 'vishal@gmail.com', 93021393, '202cb962ac59075b964b07152d234b70', '2022-07-10 23:17:37', 500, NULL, NULL, NULL),
(5, 'A G', 'ag.com', 123, '202cb962ac59075b964b07152d234b70', '2022-07-11 03:33:02', 100, 1, 0, 0),
(6, 'A G2', 'ag2.com', 123, '202cb962ac59075b964b07152d234b70', '2022-07-11 03:49:06', 1000, 14, 0, 0),
(7, 'surendra kataria', 'zindagibhar.com', 8258424619, '6d53d0f233e0f74f92ae557dc0d8b955', '2022-07-24 17:27:41', 200, 27, 100, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `borrow`
--
ALTER TABLE `borrow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lend`
--
ALTER TABLE `lend`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reminders`
--
ALTER TABLE `reminders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `borrow`
--
ALTER TABLE `borrow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `lend`
--
ALTER TABLE `lend`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `reminders`
--
ALTER TABLE `reminders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=239;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
