-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2021 at 10:15 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recording_studio`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `user_name` varchar(100) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`user_name`, `password`) VALUES
('admin', 'recordex');

-- --------------------------------------------------------

--
-- Table structure for table `advanced_payment`
--

CREATE TABLE `advanced_payment` (
  `payment_id` int(1) NOT NULL,
  `job_id` int(5) NOT NULL,
  `total` int(10) NOT NULL,
  `advanced_fee` double NOT NULL,
  `ispaid` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `advanced_payment`
--

INSERT INTO `advanced_payment` (`payment_id`, `job_id`, `total`, `advanced_fee`, `ispaid`) VALUES
(1, 49, 4350, 4.35, 1),
(2, 50, 4890, 4.89, 1);

-- --------------------------------------------------------

--
-- Table structure for table `blocked_dates`
--

CREATE TABLE `blocked_dates` (
  `bid` int(5) NOT NULL,
  `sid` int(5) NOT NULL,
  `dates` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blocked_dates`
--

INSERT INTO `blocked_dates` (`bid`, `sid`, `dates`) VALUES
(2, 31, '2021-03-25'),
(7, 31, '2021-07-13'),
(9, 52, '2021-04-13'),
(10, 52, '2021-04-14');

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

CREATE TABLE `complaint` (
  `complaint_id` int(100) NOT NULL,
  `c_id` int(100) NOT NULL,
  `studio_id` int(100) NOT NULL,
  `com_description` varchar(500) NOT NULL,
  `flag` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complaint`
--

INSERT INTO `complaint` (`complaint_id`, `c_id`, `studio_id`, `com_description`, `flag`) VALUES
(31, 48, 31, 'customer complaint', 2),
(32, 48, 0, 'studio complaint', 0),
(33, 23, 0, 'studio complaint', 3),
(34, 23, 0, 'ssfhbdf', 0),
(35, 48, 31, 'this is the complaint', 2),
(36, 48, 31, 'bbdjkhds', 2),
(37, 23, 31, 'this is a complaint\r\n', 0),
(38, 48, 31, 'this is a complaint\r\n', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `c_id` int(6) NOT NULL,
  `first_name` varchar(60) NOT NULL,
  `last_name` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `tele_no` int(10) NOT NULL,
  `password` varchar(60) NOT NULL,
  `email_verified` tinyint(1) NOT NULL DEFAULT 0,
  `blocked` int(1) NOT NULL DEFAULT 0,
  `image` varchar(500) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'Active now'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`c_id`, `first_name`, `last_name`, `email`, `tele_no`, `password`, `email_verified`, `blocked`, `image`, `status`) VALUES
(23, 'Kevin', 'Durant', 'kevin@gmail.com', 722345147, 'a86f69a869ed993e2eb254b9aac2c8f57e2cb740', 1, 0, 'pexels-cottonbro-6892899.jpg', 'Active now'),
(48, 'Naigel ', 'Forrel', 'naigel@gmail.com', 719726091, 'a86f69a869ed993e2eb254b9aac2c8f57e2cb740', 1, 0, 'yeasin-chowdhury-KYbW33ObXh8-unsplash.jpg', 'Active now'),
(49, 'Charlie', 'Jims', 'charlie@gmail.com', 718822545, 'a86f69a869ed993e2eb254b9aac2c8f57e2cb740', 1, 0, 'mariana-vusiatytska-1PlJFiOyacw-unsplash.jpg', 'Active now'),
(51, 'Jogn', 'Paul', 'paula@example.com', 742558744, '7c222fb2927d828af22f592134e8932480637c0d', 1, 1, '', 'Active now'),
(52, 'Oliver', 'Liam', 'oliver@gmail.com', 779726091, 'a86f69a869ed993e2eb254b9aac2c8f57e2cb740', 1, 0, 'images.jpg', 'Active now');

-- --------------------------------------------------------

--
-- Table structure for table `email_verification`
--

CREATE TABLE `email_verification` (
  `id` int(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `token` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `email_verification`
--

INSERT INTO `email_verification` (`id`, `email`, `token`) VALUES
(1, 'sasindusubodhaka@gmail.com', '9573f6b8a54889bdbc493e65e3b8792560628d36b862f');

-- --------------------------------------------------------

--
-- Table structure for table `membership_payment`
--

CREATE TABLE `membership_payment` (
  `mpay_id` int(100) NOT NULL,
  `charge` double NOT NULL,
  `date` date NOT NULL,
  `studio_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(100) NOT NULL,
  `c_id` int(10) NOT NULL,
  `s_id` int(10) NOT NULL,
  `incoming_msg` varchar(255) NOT NULL DEFAULT '0',
  `outgoing_msg` varchar(255) NOT NULL DEFAULT '0',
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `c_id`, `s_id`, `incoming_msg`, `outgoing_msg`, `date`) VALUES
(21, 23, 36, '0', 'hai golrin studios', '2021-03-31'),
(22, 23, 46, '0', 'hai barewell studios', '2021-03-31'),
(23, 23, 54, '0', 'hai stealth records', '2021-03-31'),
(24, 52, 31, '0', 'hello ear candy', '2021-03-31'),
(25, 23, 36, 'hai kevin', '0', '2021-03-31'),
(26, 23, 31, '0', 'hello ear candy', '2021-03-31'),
(27, 23, 31, 'hello kevin', '0', '2021-03-31'),
(28, 48, 31, '0', 'hai there', '2021-03-31'),
(29, 48, 31, 'hai naigel', '0', '2021-03-31'),
(30, 48, 31, '0', 'I want a service from you', '2021-03-31');

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE `owner` (
  `owner_id` int(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `e_mail` varchar(150) NOT NULL,
  `tp_number` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`owner_id`, `first_name`, `last_name`, `e_mail`, `tp_number`) VALUES
(1, 'sasindu', 'sensly', 'sas@gmail.com', 77972091),
(2, 'sasindu', 'sensly', 'vpn@gmail.com', 2345),
(3, 'sasindu', 'sensly', 'sasindu@gmail.com', 2345),
(4, 'nuwan', 'ms', 'sasindusensly@gmail.com', 2345678),
(5, 'nimal', 'fernando', 'nimal@gmail.com', 654),
(6, 'sanath', 'kumara', 'sanath@gmail.com', 779726091),
(7, 'sasindu', 'sensly', 'hjk@gmail.com', 234),
(8, 'nimal', 'sensly', 'nji@gmail.com', 234),
(9, 'sasindu', 'sensly', 'abc@gmail.com', 123456),
(10, 'chandana', 'Gamage', 'chandana@gmail.com', 775610041),
(11, 'addv', 'jjvj', 'jhvjhvjv@jbbh.com', 5445454),
(13, 'jhjvjv', 'hbjjb', 'kkbjb@jhgjvh.com', 2111),
(14, 'igiug', 'uggu', 'oihhoih@yfyfuyf.com', 455454),
(15, 'jgyguyg', 'yguyguyg', 'gugygu@jjhv.com', 4545),
(16, 'Kalana', 'Perera', 'kalana@gmail.com', 77),
(18, 'xfvg', 'Avishka', 'ggu@jjhv.com', 2147483647),
(21, 'Ravindu', 'Bhagya', 'pavinduavishka@gmail.com', 725645879),
(22, 'Pual', 'Stirling', 'pauls@example.com', 725566456);

-- --------------------------------------------------------

--
-- Table structure for table `owner_verification`
--

CREATE TABLE `owner_verification` (
  `id` int(5) NOT NULL,
  `email` varchar(50) NOT NULL,
  `st_email` varchar(50) NOT NULL,
  `token` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rate`
--

CREATE TABLE `rate` (
  `rate_id` int(10) NOT NULL,
  `c_id` int(10) NOT NULL,
  `studio_id` int(10) NOT NULL,
  `rate` float NOT NULL,
  `comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rate`
--

INSERT INTO `rate` (`rate_id`, `c_id`, `studio_id`, `rate`, `comment`) VALUES
(11, 48, 31, 1, ''),
(12, 52, 39, 4, ''),
(13, 48, 39, 5, ''),
(14, 49, 39, 4, ''),
(15, 49, 31, 4, ''),
(16, 52, 31, 4, ''),
(17, 23, 46, 3, ''),
(18, 52, 46, 5, '');

-- --------------------------------------------------------

--
-- Table structure for table `removed_users`
--

CREATE TABLE `removed_users` (
  `id` int(5) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reserved_audio_gear`
--

CREATE TABLE `reserved_audio_gear` (
  `audio_id` int(5) NOT NULL,
  `job_id` int(5) NOT NULL,
  `name` varchar(100) NOT NULL,
  `charge` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reserved_audio_gear`
--

INSERT INTO `reserved_audio_gear` (`audio_id`, `job_id`, `name`, `charge`) VALUES
(11, 49, 'Fender Guitar', 1200),
(12, 49, 'Telecaster Guitar', 1200),
(64, 50, 'Casio Guitar', 600),
(66, 50, 'Piano 25X', 800),
(67, 50, 'Piano 25X', 800);

-- --------------------------------------------------------

--
-- Table structure for table `reserved_job`
--

CREATE TABLE `reserved_job` (
  `job_id` int(5) NOT NULL,
  `c_id` int(5) NOT NULL,
  `studio_id` int(5) NOT NULL,
  `date` date NOT NULL,
  `choose_time` timestamp NULL DEFAULT NULL,
  `isplaced` int(1) NOT NULL DEFAULT 0,
  `rated` int(1) NOT NULL DEFAULT 0,
  `temp_blocked` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reserved_job`
--

INSERT INTO `reserved_job` (`job_id`, `c_id`, `studio_id`, `date`, `choose_time`, `isplaced`, `rated`, `temp_blocked`) VALUES
(49, 48, 31, '2021-04-13', '2021-03-31 19:34:44', 1, 0, 0),
(50, 48, 52, '2021-03-31', '2021-03-31 20:01:41', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `reserved_services`
--

CREATE TABLE `reserved_services` (
  `res_id` int(5) NOT NULL,
  `job_id` int(5) NOT NULL,
  `service_name` varchar(100) NOT NULL,
  `charge` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reserved_services`
--

INSERT INTO `reserved_services` (`res_id`, `job_id`, `service_name`, `charge`) VALUES
(101, 49, 'Recording', 750),
(102, 49, 'singing', 1200),
(103, 50, 'Mastering', 1150),
(104, 50, 'Recording', 1540);

-- --------------------------------------------------------

--
-- Table structure for table `sample_service`
--

CREATE TABLE `sample_service` (
  `service_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sample_service`
--

INSERT INTO `sample_service` (`service_id`, `name`) VALUES
(1, 'Recording'),
(2, 'Mastering'),
(3, 'Mixing'),
(4, 'Dubbing');

-- --------------------------------------------------------

--
-- Table structure for table `studio`
--

CREATE TABLE `studio` (
  `studio_id` int(5) NOT NULL,
  `studio_name` varchar(100) NOT NULL,
  `s_address_line1` varchar(100) NOT NULL,
  `s_address_line2` varchar(100) NOT NULL,
  `s_city` varchar(100) NOT NULL,
  `distric` varchar(100) NOT NULL,
  `postalcode` varchar(100) NOT NULL,
  `s_email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `s_tele_no` int(20) NOT NULL,
  `paypal` varchar(100) NOT NULL,
  `owner_id` int(100) NOT NULL,
  `profile` varchar(500) NOT NULL,
  `cover` varchar(500) NOT NULL,
  `description` text NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `verified` tinyint(4) NOT NULL DEFAULT 0,
  `email_verified` tinyint(1) NOT NULL DEFAULT 0,
  `owner_verified` tinyint(1) NOT NULL DEFAULT 0,
  `blocked` int(1) NOT NULL DEFAULT 0,
  `status` varchar(10) NOT NULL DEFAULT 'Active now'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studio`
--

INSERT INTO `studio` (`studio_id`, `studio_name`, `s_address_line1`, `s_address_line2`, `s_city`, `distric`, `postalcode`, `s_email`, `password`, `s_tele_no`, `paypal`, `owner_id`, `profile`, `cover`, `description`, `latitude`, `longitude`, `verified`, `email_verified`, `owner_verified`, `blocked`, `status`) VALUES
(31, 'EAR CANDY MUSIC STUDIO', '396/B', 'Tangalle Rd', 'Weeraketiya', 'Hambantota', '184481', 'earcandystudios@gmail.com', 'a86f69a869ed993e2eb254b9aac2c8f57e2cb740', 770866346, 'earcandystudios@gmail.com', 10, '511120_6415769_1214828_f649af4d_image.png', 'wp2711244-recording-studio-wallpaper-hd.jpg', 'Abbey Road studios are now regarded as the most iconic set of studios going, you can bet almost anyone has heard of them even if theyï¿½re not in the music industry. With their high-end gear and clientele boasting some of the most legendary names in the music business from The Beatles and Aretha Franklin to Kanye West and Lady Gaga, itï¿½s no surprise they take the number one spot on our list.One of my favourite things about their online mastering service is they give you the option to handpick your own mastering engineer from a list of 5 Abbey Road approved mastering specialists included in their online mastering package starting at just ï¿½90.', '6.9022', '79.8612', 1, 1, 0, 0, 'Active now'),
(36, 'GORLIN STUDIOS', '19/2', 'Kottawa Rd', 'Piliyandala', 'Colombo', '45714', 'gorlinstudios@gmail.com', 'a86f69a869ed993e2eb254b9aac2c8f57e2cb740', 714568794, 'gorlinstudios@gmail.com', 21, '5d86fdbc24984_thumb900.jpg', 'wp2711276-recording-studio-wallpaper-hd.jpg', 'Lahiru studios are now regarded as the most iconic set of studios going, you can bet almost anyone has heard of them even if they’re not in the music industry. With their high-end gear and clientele boasting some of the most legendary names in the music business from The Beatles and Aretha Franklin to Kanye West and Lady Gaga, it’s no surprise they take the number one spot on our list. You will be surprised that the price range can be fairly affordable considering what you get for your money and it’s worth noting that what’s charged to major clients is more than independent musicians and unsigned artists, so always ask if there’s wiggle room on their rates. ', '6.214754', '6.214754', 1, 1, 0, 0, 'Active now'),
(38, 'SPARTAN SOUND STUDIOS', '654', 'Kandy Rd', 'Kannathiddy', 'Gampaha', '84721', 'spartanstudios@gmail.com', 'a86f69a869ed993e2eb254b9aac2c8f57e2cb740', 714568977, 'spartanstudios@gmail.com', 21, 'gqmsknfkgny.png', 'wp2711151-recording-studio-wallpaper-hd.jpg', '', '6.9022', '79.8612', 1, 1, 0, 0, 'Active now'),
(39, 'Static Audio Productions', '53', 'Estate Rd', 'Wilgoda', 'Kurunegala', '80400', 'static@example.com', '7c222fb2927d828af22f592134e8932480637c0d', 723778899, '', 16, '', '', '', '', '', 0, 1, 0, 0, 'Active now'),
(46, 'BAREWALL STUDIOS', 'Lesly Ranagala Rd', 'Vanathamulla', 'Borella', 'Colombo', '52478', 'barewallstudios@gmail.com', 'a86f69a869ed993e2eb254b9aac2c8f57e2cb740', 716542147, 'barewallstudios@gmail.com', 22, '59fb6c594f0b1_thumb900.jpg', 'photo-1568185518838-3300c90c9170.jpg', 'we are barewall studios\r\n', '6.9022', '79.8612', 1, 1, 0, 0, 'Active now'),
(52, 'Pavi Production', '396', 'Deniyaya Rd', 'Morawaka', 'Matara', '81470', 'naveenudara356@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', 768404899, 'naveenudara356@gmail.com', 21, '', '', 'Pavi Production is one of the most established audio post-production and music studios in Sri Lanka. With decades of experience in the industry we specialise in sound design, audio editing & mixing, original music production and music arrangement. Our recording studios have created a myriad of soundscapes and mixes for countless projects both locally and internationally. We are dedicated to providing every client with creative solutions and delivering the quality you deserve. OUR FACILITIES Acoustic Recording, Mixing & Mastering Original Music Compositions Jingle Productions Film Dubbing ( ADR) TV/Radio Commercials IVR (Telephone Message On Hold ) 5.1 Surround Mix Voice-Overs Documentaries & Animation Audio Books & E-learning Corporate Videos', '7.0840', '80.0098', 1, 1, 0, 0, 'Active now'),
(53, 'DISCOVERBEATS STUDIOS', '396', 'Deniyaya Rd', 'Morawaka', 'Matara', '81470', 'discoverbeats@gmail.com', 'a86f69a869ed993e2eb254b9aac2c8f57e2cb740', 768404899, 'discoverbeats@gmail.com', 21, 'do-modern-music-studio-dj-tv-radio-and-entertainment-logo.jpg', 'wp2711188-recording-studio-wallpaper-hd.jpg', '', '6.9022', '79.8612', 1, 1, 0, 0, 'Active now'),
(54, 'STEALTH RECORDS', '396', 'Vinora road', 'Balangoda', 'Ratnapura', '81470', 'stealthrecords@gmail.com', 'a86f69a869ed993e2eb254b9aac2c8f57e2cb740', 768404899, 'stealthrecords@gmail.com', 21, 'design-creative-podcast-studio-radio-and-dj-music-logo.jpg', 'wp2673279-music-studio-wallpaper.jpg', '', '6.9022', '79.8612', 1, 1, 0, 0, 'Active now');

-- --------------------------------------------------------

--
-- Table structure for table `studio_audio_gear`
--

CREATE TABLE `studio_audio_gear` (
  `audio_id` int(5) NOT NULL,
  `studio_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `charge` double NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `studio_audio_gear`
--

INSERT INTO `studio_audio_gear` (`audio_id`, `studio_id`, `name`, `charge`, `status`) VALUES
(8, 31, 'Fender Guitar', 1200, 1),
(9, 31, 'Fender Guitar', 1200, 1),
(10, 31, 'Fender Guitar', 1200, 1),
(11, 31, 'Fender Guitar', 1200, 1),
(12, 31, 'Telecaster Guitar', 1200, 1),
(13, 31, 'Telecaster Guitar', 1200, 1),
(14, 31, 'Telecaster Guitar', 1200, 1),
(15, 31, 'Telecaster Guitar', 1200, 1),
(16, 46, 'Fender Guitar', 1200, 1),
(17, 46, 'Fender Guitar', 1200, 1),
(18, 46, 'Fender Guitar', 1200, 1),
(19, 46, 'Fender Guitar', 1200, 1),
(36, 31, 'Mixer', 5000, 1),
(37, 31, 'Mixer', 5000, 1),
(38, 31, 'Mixer', 5000, 1),
(39, 31, 'Mixer', 5000, 1),
(40, 31, 'Mic', 200, 1),
(41, 31, 'Mic', 200, 1),
(42, 31, 'Mic', 200, 1),
(43, 31, 'Mic', 200, 1),
(44, 36, 'Fender Guitar', 1200, 1),
(45, 36, 'Fender Guitar', 1200, 1),
(46, 36, 'Upright Piano', 1200, 1),
(47, 36, 'Rickenbacker Bass Guitar', 1350, 1),
(48, 36, 'Rickenbacker Bass Guitar', 1350, 1),
(49, 46, 'Gibson Guitar', 1000, 1),
(50, 46, 'Gibson Guitar', 1000, 1),
(51, 46, 'Upright Piano', 1300, 1),
(52, 53, 'Ibanez Guitar', 1200, 1),
(53, 53, 'Ibanez Guitar', 1200, 1),
(54, 53, 'Ibanez Guitar', 1200, 1),
(55, 53, 'Telecaster Guitar', 2000, 1),
(56, 53, 'Telecaster Guitar', 2000, 1),
(57, 53, 'Grand Piano', 1350, 1),
(58, 38, 'Gibson guitar', 1450, 1),
(59, 38, 'Gibson guitar', 1450, 1),
(60, 38, 'Console Piano', 1200, 1),
(61, 38, 'Fender Guitar', 1000, 1),
(62, 38, 'Fender Guitar', 1000, 1),
(63, 52, 'Casio Guitar', 600, 1),
(64, 52, 'Casio Guitar', 600, 1),
(65, 52, 'Casio Guitar', 600, 1),
(66, 52, 'Piano 25X', 800, 1),
(67, 52, 'Piano 25X', 800, 1);

-- --------------------------------------------------------

--
-- Table structure for table `studio_complaint`
--

CREATE TABLE `studio_complaint` (
  `complaint_id` int(11) NOT NULL,
  `studio_id` int(100) NOT NULL,
  `c_id` int(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `flag` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `studio_portfolio`
--

CREATE TABLE `studio_portfolio` (
  `id` int(5) NOT NULL,
  `studio_id` int(5) NOT NULL,
  `port1` varchar(15) DEFAULT 'pGCNVz4USLM',
  `port2` varchar(15) NOT NULL DEFAULT '0dUMGM7cu88',
  `port3` varchar(15) NOT NULL DEFAULT 'QzBACI0YP84',
  `port4` varchar(15) NOT NULL DEFAULT 'taOtlyhftU4'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `studio_portfolio`
--

INSERT INTO `studio_portfolio` (`id`, `studio_id`, `port1`, `port2`, `port3`, `port4`) VALUES
(1, 31, 'XWJrPzAUzAs', 'GH_StQ6KdW0', 'bKDdT_nyP54', 'CAHagot7RIQ'),
(2, 36, 'XWJrPzAUzAs', 'GH_StQ6KdW0', 'bKDdT_nyP54', 'CAHagot7RIQ'),
(3, 46, 'XWJrPzAUzAs', 'GH_StQ6KdW0', 'bKDdT_nyP54', 'CAHagot7RIQ'),
(4, 52, 'XWJrPzAUzAs', 'GH_StQ6KdW0', 'bKDdT_nyP54', 'CAHagot7RIQ');

-- --------------------------------------------------------

--
-- Table structure for table `studio_schedule`
--

CREATE TABLE `studio_schedule` (
  `id` int(5) NOT NULL,
  `issatblocked` int(1) NOT NULL DEFAULT 0,
  `issunblocked` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `studio_schedule`
--

INSERT INTO `studio_schedule` (`id`, `issatblocked`, `issunblocked`) VALUES
(31, 0, 0),
(36, 0, 0),
(46, 0, 0),
(52, 0, 1),
(53, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `studio_service`
--

CREATE TABLE `studio_service` (
  `studio_id` int(100) NOT NULL,
  `service_name` varchar(100) NOT NULL,
  `service_charge` double NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `studio_service`
--

INSERT INTO `studio_service` (`studio_id`, `service_name`, `service_charge`, `status`) VALUES
(31, 'Dubbing', 1300, 1),
(31, 'Mastering', 1500, 1),
(31, 'Mixing', 1590, 0),
(31, 'Recording', 750, 1),
(31, 'singing', 1200, 0),
(31, 'Track Editing', 1500, 1),
(36, 'Dubbing', 1300, 1),
(36, 'Mastering', 1500, 1),
(36, 'Mixing', 450, 1),
(36, 'Recording', 1200, 1),
(38, 'Dubbing', 1300, 1),
(38, 'Mastering', 1500, 1),
(38, 'Mixing', 1450, 1),
(38, 'Recording', 1200, 1),
(46, 'Dubbing', 1650, 1),
(46, 'Mastering', 1300, 1),
(46, 'Mixing', 1500, 1),
(46, 'Recording', 1200, 1),
(52, 'Dubbing', 1150, 1),
(52, 'Mastering', 1150, 1),
(52, 'Recording', 1540, 1),
(53, 'Dubbing', 3200, 1),
(53, 'Mastering', 1500, 1),
(53, 'Mixing', 1450, 1),
(53, 'Recording', 1200, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `id` int(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `token` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advanced_payment`
--
ALTER TABLE `advanced_payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `job_id` (`job_id`);

--
-- Indexes for table `blocked_dates`
--
ALTER TABLE `blocked_dates`
  ADD PRIMARY KEY (`bid`),
  ADD KEY `sid` (`sid`);

--
-- Indexes for table `complaint`
--
ALTER TABLE `complaint`
  ADD PRIMARY KEY (`complaint_id`),
  ADD KEY `c_id` (`c_id`,`studio_id`),
  ADD KEY `studio_id` (`studio_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `email_verification`
--
ALTER TABLE `email_verification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `membership_payment`
--
ALTER TABLE `membership_payment`
  ADD PRIMARY KEY (`mpay_id`),
  ADD KEY `studio_id` (`studio_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`),
  ADD KEY `c_id` (`c_id`),
  ADD KEY `s_id` (`s_id`);

--
-- Indexes for table `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`owner_id`);

--
-- Indexes for table `owner_verification`
--
ALTER TABLE `owner_verification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rate`
--
ALTER TABLE `rate`
  ADD PRIMARY KEY (`rate_id`),
  ADD KEY `c_id` (`c_id`),
  ADD KEY `studio_id` (`studio_id`);

--
-- Indexes for table `removed_users`
--
ALTER TABLE `removed_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reserved_audio_gear`
--
ALTER TABLE `reserved_audio_gear`
  ADD PRIMARY KEY (`audio_id`,`job_id`),
  ADD KEY `job_id` (`job_id`);

--
-- Indexes for table `reserved_job`
--
ALTER TABLE `reserved_job`
  ADD PRIMARY KEY (`job_id`),
  ADD KEY `c_id` (`c_id`),
  ADD KEY `studio_id` (`studio_id`);

--
-- Indexes for table `reserved_services`
--
ALTER TABLE `reserved_services`
  ADD PRIMARY KEY (`res_id`),
  ADD KEY `job_id` (`job_id`),
  ADD KEY `service_name` (`service_name`);

--
-- Indexes for table `sample_service`
--
ALTER TABLE `sample_service`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `studio`
--
ALTER TABLE `studio`
  ADD PRIMARY KEY (`studio_id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Indexes for table `studio_audio_gear`
--
ALTER TABLE `studio_audio_gear`
  ADD PRIMARY KEY (`audio_id`),
  ADD KEY `studio_id` (`studio_id`);

--
-- Indexes for table `studio_complaint`
--
ALTER TABLE `studio_complaint`
  ADD PRIMARY KEY (`complaint_id`),
  ADD KEY `studio_id` (`studio_id`,`c_id`),
  ADD KEY `c_id` (`c_id`);

--
-- Indexes for table `studio_portfolio`
--
ALTER TABLE `studio_portfolio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `studio_id` (`studio_id`);

--
-- Indexes for table `studio_schedule`
--
ALTER TABLE `studio_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studio_service`
--
ALTER TABLE `studio_service`
  ADD PRIMARY KEY (`studio_id`,`service_name`),
  ADD KEY `service_name` (`service_name`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advanced_payment`
--
ALTER TABLE `advanced_payment`
  MODIFY `payment_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `blocked_dates`
--
ALTER TABLE `blocked_dates`
  MODIFY `bid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `complaint`
--
ALTER TABLE `complaint`
  MODIFY `complaint_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `c_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `email_verification`
--
ALTER TABLE `email_verification`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `membership_payment`
--
ALTER TABLE `membership_payment`
  MODIFY `mpay_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `owner`
--
ALTER TABLE `owner`
  MODIFY `owner_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `owner_verification`
--
ALTER TABLE `owner_verification`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rate`
--
ALTER TABLE `rate`
  MODIFY `rate_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `removed_users`
--
ALTER TABLE `removed_users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reserved_job`
--
ALTER TABLE `reserved_job`
  MODIFY `job_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `reserved_services`
--
ALTER TABLE `reserved_services`
  MODIFY `res_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `sample_service`
--
ALTER TABLE `sample_service`
  MODIFY `service_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `studio`
--
ALTER TABLE `studio`
  MODIFY `studio_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `studio_audio_gear`
--
ALTER TABLE `studio_audio_gear`
  MODIFY `audio_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `studio_complaint`
--
ALTER TABLE `studio_complaint`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `studio_portfolio`
--
ALTER TABLE `studio_portfolio`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `advanced_payment`
--
ALTER TABLE `advanced_payment`
  ADD CONSTRAINT `advanced_payment_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `reserved_job` (`job_id`) ON DELETE CASCADE;

--
-- Constraints for table `blocked_dates`
--
ALTER TABLE `blocked_dates`
  ADD CONSTRAINT `blocked_dates_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `studio` (`studio_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `membership_payment`
--
ALTER TABLE `membership_payment`
  ADD CONSTRAINT `membership_payment_ibfk_1` FOREIGN KEY (`studio_id`) REFERENCES `studio` (`studio_id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `customer` (`c_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`s_id`) REFERENCES `studio` (`studio_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rate`
--
ALTER TABLE `rate`
  ADD CONSTRAINT `rate_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `customer` (`c_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rate_ibfk_2` FOREIGN KEY (`studio_id`) REFERENCES `studio` (`studio_id`) ON DELETE CASCADE;

--
-- Constraints for table `reserved_audio_gear`
--
ALTER TABLE `reserved_audio_gear`
  ADD CONSTRAINT `reserved_audio_gear_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `reserved_job` (`job_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reserved_audio_gear_ibfk_2` FOREIGN KEY (`audio_id`) REFERENCES `studio_audio_gear` (`audio_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reserved_services`
--
ALTER TABLE `reserved_services`
  ADD CONSTRAINT `reserved_services_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `reserved_job` (`job_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reserved_services_ibfk_2` FOREIGN KEY (`service_name`) REFERENCES `studio_service` (`service_name`);

--
-- Constraints for table `studio`
--
ALTER TABLE `studio`
  ADD CONSTRAINT `studio_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `owner` (`owner_id`);

--
-- Constraints for table `studio_audio_gear`
--
ALTER TABLE `studio_audio_gear`
  ADD CONSTRAINT `studio_audio_gear_ibfk_1` FOREIGN KEY (`studio_id`) REFERENCES `studio` (`studio_id`);

--
-- Constraints for table `studio_complaint`
--
ALTER TABLE `studio_complaint`
  ADD CONSTRAINT `studio_complaint_ibfk_1` FOREIGN KEY (`studio_id`) REFERENCES `studio` (`studio_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `studio_complaint_ibfk_2` FOREIGN KEY (`c_id`) REFERENCES `customer` (`c_id`);

--
-- Constraints for table `studio_portfolio`
--
ALTER TABLE `studio_portfolio`
  ADD CONSTRAINT `studio_portfolio_ibfk_1` FOREIGN KEY (`studio_id`) REFERENCES `studio` (`studio_id`) ON UPDATE NO ACTION;

--
-- Constraints for table `studio_schedule`
--
ALTER TABLE `studio_schedule`
  ADD CONSTRAINT `studio_schedule_ibfk_1` FOREIGN KEY (`id`) REFERENCES `studio` (`studio_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `studio_service`
--
ALTER TABLE `studio_service`
  ADD CONSTRAINT `studio_service_ibfk_2` FOREIGN KEY (`studio_id`) REFERENCES `studio` (`studio_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
