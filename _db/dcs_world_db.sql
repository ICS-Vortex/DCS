-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 26, 2015 at 02:04 PM
-- Server version: 10.0.20-MariaDB
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `u453521302_stat`
--

-- --------------------------------------------------------

--
-- Table structure for table `dcs_awards`
--

CREATE TABLE IF NOT EXISTS `dcs_awards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(64) NOT NULL,
  `name` varchar(128) NOT NULL,
  `image_url` varchar(256) NOT NULL,
  `points` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `dcs_awards`
--

INSERT INTO `dcs_awards` (`id`, `country`, `name`, `image_url`, `points`) VALUES
(1, 'Russia', 'Courage Order', 'RUS-01-CourageOrder.png', 200),
(2, 'Russia', 'Medal of Courage', 'RUS-02-MeritMedal.png', 600),
(3, 'Russia', 'Nesterov Medal', 'RUS-03-NesterovMedal.png', 1000),
(4, 'Russia', 'Military Serve Order', 'RUS-04-MilitaryServe.png', 1400),
(5, 'Russia', 'Georgy Cross-IV', 'RUS-05-GeorgyCross-4.png', 1800),
(6, 'Russia', 'Medal For Merit To Fatherland-II', 'RUS-06-ForMeritToFatherland-2.png', 2200),
(7, 'Russia', 'Georgy Cross-I', 'RUS-07-GeorgyCross-1.png', 2600),
(8, 'Russia', 'Hero Gold Star', 'RUS-08-HeroStar.png', 3000),
(9, 'UKRAINE', 'Medal "Zakhystnyku Vitchyzny"', 'UKR-01-ForDefenderOfFatherland.png', 200),
(10, 'UKRAINE', 'Orden "Za Zaslugy III"', 'UKR-02-ForMerit-III.png', 600),
(11, 'UKRAINE', 'Orden "Za Zaslugy II"', 'UKR-03-ForMerit-II.png', 1000),
(12, 'UKRAINE', 'Orden "Za Zaslugy I"', 'UKR-04-ForMerit-I.png', 1400),
(13, 'UKRAINE', 'Zirka "Za Zaslugy"', 'UKR-05-ForMerit-Star.png', 1800),
(14, 'UKRAINE', 'Medal "Za Viyskovu Sluzhbu"', 'UKR-06-ForMilitaryService.png', 2200),
(15, 'UKRAINE', 'Orden "Za Muzhnist"', 'UKR-07-OrderForCourage.png', 2600),
(16, 'UKRAINE', 'Zolota Zirka', 'UKR-08-GoldStar.png', 3000),
(17, 'USA', 'Air Medal', 'US-01-AirMedal.png', 200),
(18, 'USA', 'Purple Heart', 'US-02-PurpleHeart.png', 600),
(19, 'USA', 'Bronze Star', 'US-03-BronzeStar.png', 1000),
(20, 'USA', 'Airmans Medal', 'US-04-AirmansMedal.png', 1400),
(21, 'USA', 'Distinguished Flying Cross', 'US-05-DistinguishedFlyingCross.png', 1800),
(22, 'USA', 'Silver Star', 'US-06-SilverStar.png', 2200),
(23, 'USA', 'Air Force Cross', 'US-07-AirForceCross.png', 2600),
(24, 'USA', 'Air Force Medal of Honour', 'US-08-AirForceMedalOfHonour.png', 3000);

-- --------------------------------------------------------

--
-- Table structure for table `dcs_blueteam`
--

CREATE TABLE IF NOT EXISTS `dcs_blueteam` (
  `pilot_id` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `plane` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `pilot_id` (`pilot_id`),
  KEY `pilot_id_2` (`pilot_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dcs_categories`
--

CREATE TABLE IF NOT EXISTS `dcs_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `dcs_categories`
--

INSERT INTO `dcs_categories` (`id`, `title`) VALUES
(1, 'Самолёты'),
(2, 'Вертолёты'),
(3, 'Корабли'),
(4, 'Бронетехника'),
(5, 'Артиллерия'),
(6, 'ПВО'),
(7, 'Невооружённые'),
(8, 'Пехота'),
(9, 'Статические обьекты'),
(10, 'Неопределенно');

-- --------------------------------------------------------

--
-- Table structure for table `dcs_online`
--

CREATE TABLE IF NOT EXISTS `dcs_online` (
  `pilot_id` int(11) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `dcs_ranks`
--

CREATE TABLE IF NOT EXISTS `dcs_ranks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(64) NOT NULL,
  `name` varchar(128) NOT NULL,
  `points` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `dcs_ranks`
--

INSERT INTO `dcs_ranks` (`id`, `country`, `name`, `points`) VALUES
(1, 'Russia', 'Second lieutenant', 0),
(2, 'Russia', 'First lieutenant', 15),
(3, 'Russia', 'Captain', 30),
(4, 'Russia', 'Major', 60),
(5, 'Russia', 'Lieutenant colonel', 120),
(6, 'Russia', 'Colonel', 240),
(7, 'UKRAINE', 'Second lieutenant', 0),
(8, 'UKRAINE', 'First lieutenant', 15),
(9, 'UKRAINE', 'Captain', 30),
(10, 'UKRAINE', 'Major', 60),
(11, 'UKRAINE', 'Lieutenant colonel', 120),
(12, 'UKRAINE', 'Colonel', 240),
(13, 'USA', 'Second lieutenant', 0),
(14, 'USA', 'First lieutenant', 15),
(15, 'USA', 'Captain', 30),
(16, 'USA', 'Major', 60),
(17, 'USA', 'Lieutenant colonel', 120),
(18, 'USA', 'Colonel', 240);

-- --------------------------------------------------------

--
-- Table structure for table `dcs_redteam`
--

CREATE TABLE IF NOT EXISTS `dcs_redteam` (
  `pilot_id` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `plane` varchar(32) CHARACTER SET utf8 NOT NULL,
  UNIQUE KEY `pilot_id` (`pilot_id`),
  KEY `pilot_id_2` (`pilot_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dcs_spectators`
--

CREATE TABLE IF NOT EXISTS `dcs_spectators` (
  `pilot_id` int(11) NOT NULL,
  `data` datetime NOT NULL,
  UNIQUE KEY `pilot_id` (`pilot_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dcs_units`
--

CREATE TABLE IF NOT EXISTS `dcs_units` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(64) NOT NULL,
  `type_unit` varchar(256) NOT NULL,
  `category` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `point` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `category` (`category`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=744 ;

--
-- Dumping data for table `dcs_units`
--

INSERT INTO `dcs_units` (`id`, `country`, `type_unit`, `category`, `name`, `point`) VALUES
(1, 'RUSSIA', 'Plane', 1, 'Su-33', 0),
(2, 'RUSSIA', 'Plane', 1, 'Su-25', 0),
(3, 'RUSSIA', 'Plane', 1, 'MiG-29S', 0),
(4, 'RUSSIA', 'Plane', 1, 'MiG-29A', 0),
(5, 'RUSSIA', 'Plane', 1, 'Su-27', 0),
(6, 'RUSSIA', 'Plane', 1, 'Su-25TM', 0),
(7, 'RUSSIA', 'Plane', 1, 'Su-25T', 0),
(8, 'RUSSIA', 'Plane', 1, 'MiG-31', 0),
(9, 'RUSSIA', 'Plane', 1, 'MiG-27K', 0),
(10, 'RUSSIA', 'Plane', 1, 'Su-30', 0),
(11, 'RUSSIA', 'Plane', 1, 'Tu-160', 0),
(12, 'RUSSIA', 'Plane', 1, 'Su-34', 0),
(13, 'RUSSIA', 'Plane', 1, 'Tu-95MS', 0),
(14, 'RUSSIA', 'Plane', 1, 'Tu-142', 0),
(15, 'RUSSIA', 'Plane', 1, 'MiG-25PD', 0),
(16, 'RUSSIA', 'Plane', 1, 'Tu-22M3', 0),
(17, 'RUSSIA', 'Plane', 1, 'A-50', 0),
(18, 'RUSSIA', 'Plane', 1, 'Yak-40', 0),
(19, 'RUSSIA', 'Plane', 1, 'An-26B', 0),
(20, 'RUSSIA', 'Plane', 1, 'An-30M', 0),
(21, 'RUSSIA', 'Plane', 1, 'Su-17M4', 0),
(22, 'RUSSIA', 'Plane', 1, 'MiG-23MLD', 0),
(23, 'RUSSIA', 'Plane', 1, 'MiG-25RBT', 0),
(24, 'RUSSIA', 'Plane', 1, 'Su-24M', 0),
(25, 'RUSSIA', 'Plane', 1, 'Su-24MR', 0),
(26, 'RUSSIA', 'Plane', 1, 'IL-78M', 0),
(27, 'RUSSIA', 'Plane', 1, 'IL-76MD', 0),
(28, 'RUSSIA', 'Plane', 1, 'L-39ZA', 0),
(29, 'RUSSIA', 'Plane', 1, 'P-51D', 0),
(30, 'RUSSIA', 'Ship', 3, 'KUZNECOW', 0),
(31, 'RUSSIA', 'Ship', 3, 'MOSCOW', 0),
(32, 'RUSSIA', 'Ship', 3, 'PIOTR', 0),
(33, 'RUSSIA', 'Ship', 3, 'ELNYA', 0),
(34, 'RUSSIA', 'Ship', 3, 'ALBATROS', 0),
(35, 'RUSSIA', 'Ship', 3, 'REZKY', 0),
(36, 'RUSSIA', 'Ship', 3, 'MOLNIYA', 0),
(37, 'RUSSIA', 'Ship', 3, 'KILO', 0),
(38, 'RUSSIA', 'Ship', 3, 'SOM', 0),
(39, 'RUSSIA', 'Ship', 3, 'ZWEZDNY', 0),
(40, 'RUSSIA', 'Ship', 3, 'NEUSTRASH', 0),
(41, 'RUSSIA', 'Ship', 3, 'Dry-Cargo Ship-1', 0),
(42, 'RUSSIA', 'Ship', 3, 'Dry-Cargo Ship-2', 0),
(43, 'RUSSIA', 'Car', 4, 'BTR-80', 0),
(44, 'RUSSIA', 'Car', 6, '1L13 EWR', 0),
(45, 'RUSSIA', 'Car', 6, '55G6 EWR', 0),
(46, 'RUSSIA', 'Car', 6, 'S-300PS 40B6M tr', 0),
(47, 'RUSSIA', 'Car', 6, 'S-300PS 40B6MD sr', 0),
(48, 'RUSSIA', 'Car', 6, 'S-300PS 64H6E sr', 0),
(49, 'RUSSIA', 'Car', 6, 'S-300PS 5P85C ln', 0),
(50, 'RUSSIA', 'Car', 6, 'S-300PS 5P85D ln', 0),
(51, 'RUSSIA', 'Car', 6, 'SA-11 Buk SR 9S18M1', 0),
(52, 'RUSSIA', 'Car', 6, 'SA-11 Buk CC 9S470M1', 0),
(53, 'RUSSIA', 'Car', 6, 'SA-11 Buk LN 9A310M1', 0),
(54, 'RUSSIA', 'Car', 6, 'Kub 1S91 str', 0),
(55, 'RUSSIA', 'Car', 6, 'Kub 2P25 ln', 0),
(56, 'RUSSIA', 'Car', 6, 'Osa 9A33 ln', 0),
(57, 'RUSSIA', 'Car', 6, 'Strela-1 9P31', 0),
(58, 'RUSSIA', 'Car', 6, 'Strela-10M3', 0),
(59, 'RUSSIA', 'Car', 6, 'Dog Ear radar', 0),
(60, 'RUSSIA', 'Car', 6, 'Tor 9A331', 0),
(61, 'RUSSIA', 'Car', 6, '2S6 Tunguska', 0),
(62, 'RUSSIA', 'Car', 6, 'ZSU-23-4 Shilka', 0),
(63, 'RUSSIA', 'Car', 5, 'SAU Msta', 0),
(64, 'RUSSIA', 'Car', 5, 'SAU Akatsia', 0),
(65, 'RUSSIA', 'Car', 5, 'SAU 2-C9', 0),
(66, 'RUSSIA', 'Car', 7, 'ATMZ-5', 0),
(67, 'RUSSIA', 'Car', 7, 'ATZ-10', 0),
(68, 'RUSSIA', 'Car', 4, 'BMD-1', 0),
(69, 'RUSSIA', 'Car', 4, 'BMP-1', 0),
(70, 'RUSSIA', 'Car', 4, 'BMP-2', 0),
(71, 'RUSSIA', 'Car', 4, 'BRDM-2', 0),
(72, 'RUSSIA', 'Car', 5, 'Grad-URAL', 0),
(73, 'RUSSIA', 'Car', 5, 'Smerch', 0),
(74, 'RUSSIA', 'Car', 4, 'T-80UD', 0),
(75, 'RUSSIA', 'Car', 7, 'UAZ-469', 0),
(76, 'RUSSIA', 'Car', 7, 'Ural-375', 0),
(77, 'RUSSIA', 'Car', 7, 'Ural-375 PBU', 0),
(78, 'RUSSIA', 'Car', 7, 'IKARUS Bus', 0),
(79, 'RUSSIA', 'Car', 7, 'VAZ Car', 0),
(80, 'RUSSIA', 'Car', 7, 'Trolley bus', 0),
(81, 'RUSSIA', 'Car', 7, 'KAMAZ Truck', 0),
(82, 'RUSSIA', 'Car', 7, 'LAZ Bus', 0),
(83, 'RUSSIA', 'Car', 5, 'SAU Gvozdika', 0),
(84, 'RUSSIA', 'Car', 4, 'BMP-3', 0),
(85, 'RUSSIA', 'Car', 4, 'BTR_D', 0),
(86, 'RUSSIA', 'Car', 6, 'S-300PS 54K6 cp', 0),
(87, 'RUSSIA', 'Car', 7, 'GAZ-3307', 0),
(88, 'RUSSIA', 'Car', 7, 'GAZ-66', 0),
(89, 'RUSSIA', 'Car', 7, 'GAZ-3308', 0),
(90, 'RUSSIA', 'Car', 7, 'MAZ-6303', 0),
(91, 'RUSSIA', 'Car', 7, 'ZIL-4331', 0),
(92, 'RUSSIA', 'Car', 7, 'SKP-11', 0),
(93, 'RUSSIA', 'Car', 7, 'Ural-4320T', 0),
(94, 'RUSSIA', 'Car', 7, 'Ural-4320-31', 0),
(95, 'RUSSIA', 'Car', 7, 'Ural ATsP-6', 0),
(96, 'RUSSIA', 'Car', 7, 'ZiL-131 APA-80', 0),
(97, 'RUSSIA', 'Car', 7, 'ZIL-131 KUNG', 0),
(98, 'RUSSIA', 'Car', 7, 'Ural-375 APA-50', 0),
(99, 'RUSSIA', 'Car', 6, 'ZU-23 Emplacement', 0),
(100, 'RUSSIA', 'Car', 6, 'ZU-23 Emplacement Closed', 0),
(101, 'RUSSIA', 'Car', 6, 'Ural-375 ZU-23', 0),
(102, 'RUSSIA', 'Car', 4, 'MTLB', 0),
(103, 'RUSSIA', 'Car', 4, 'T-72B', 0),
(104, 'RUSSIA', 'Car', 6, 'SA-18 Igla-S manpad', 0),
(105, 'RUSSIA', 'Car', 6, 'SA-18 Igla-S comm', 0),
(106, 'RUSSIA', 'Car', 4, 'T-55', 0),
(107, 'RUSSIA', 'Car', 8, 'Paratrooper RPG-16', 0),
(108, 'RUSSIA', 'Car', 8, 'Paratrooper AKS-74', 0),
(109, 'RUSSIA', 'Car', 4, 'Boman', 0),
(110, 'RUSSIA', 'Car', 5, '2B11 mortar', 0),
(111, 'RUSSIA', 'Car', 6, '5p73 s-125 ln', 0),
(112, 'RUSSIA', 'Car', 6, 'snr s-125 tr', 0),
(113, 'RUSSIA', 'Car', 6, 'p-19 s-125 sr', 0),
(114, 'RUSSIA', 'Car', 8, 'Infantry AK', 0),
(115, 'RUSSIA', 'Car', 4, 'T-90', 0),
(116, 'RUSSIA', 'Helicopter', 2, 'Mi-24V', 0),
(117, 'RUSSIA', 'Helicopter', 2, 'Mi-8MT', 0),
(118, 'RUSSIA', 'Helicopter', 2, 'Mi-26', 0),
(119, 'RUSSIA', 'Helicopter', 2, 'Ka-27', 0),
(120, 'RUSSIA', 'Helicopter', 2, 'Mi-28N', 0),
(121, 'RUSSIA', 'Helicopter', 2, 'UH-1H', 0),
(122, 'RUSSIA', 'Plane', 1, 'Su-27', 0),
(123, 'RUSSIA', 'Plane', 1, 'MiG-29A', 0),
(124, 'RUSSIA', 'Plane', 1, 'MiG-29S', 0),
(125, 'RUSSIA', 'Plane', 1, 'Su-17M4', 0),
(126, 'RUSSIA', 'Plane', 1, 'Tu-95MS', 0),
(127, 'RUSSIA', 'Plane', 1, 'Su-24M', 0),
(128, 'RUSSIA', 'Plane', 1, 'Su-24MR', 0),
(129, 'RUSSIA', 'Plane', 1, 'Su-25', 0),
(130, 'RUSSIA', 'Plane', 1, 'MiG-25PD', 0),
(131, 'RUSSIA', 'Plane', 1, 'An-26B', 0),
(132, 'RUSSIA', 'Plane', 1, 'An-30M', 0),
(133, 'RUSSIA', 'Plane', 1, 'MiG-23MLD', 0),
(134, 'RUSSIA', 'Plane', 1, 'IL-78M', 0),
(135, 'RUSSIA', 'Plane', 1, 'IL-76MD', 0),
(136, 'RUSSIA', 'Plane', 1, 'MiG-27K', 0),
(137, 'RUSSIA', 'Plane', 1, 'Tu-22M3', 0),
(138, 'RUSSIA', 'Plane', 1, 'MiG-25RBT', 0),
(139, 'RUSSIA', 'Plane', 1, 'Yak-40', 0),
(140, 'RUSSIA', 'Plane', 1, 'L-39ZA', 0),
(141, 'RUSSIA', 'Plane', 1, 'P-51D', 0),
(142, 'RUSSIA', 'Ship', 3, 'ELNYA', 0),
(143, 'RUSSIA', 'Ship', 3, 'ALBATROS', 0),
(144, 'RUSSIA', 'Ship', 3, 'MOLNIYA', 0),
(145, 'RUSSIA', 'Ship', 3, 'KILO', 0),
(146, 'RUSSIA', 'Ship', 3, 'ZWEZDNY', 0),
(147, 'RUSSIA', 'Ship', 3, 'Dry-Cargo Ship-1', 0),
(148, 'RUSSIA', 'Ship', 3, 'Dry-Cargo Ship-2', 0),
(149, 'RUSSIA', 'Ship', 3, 'REZKY', 0),
(150, 'RUSSIA', 'Car', 4, 'BTR-80', 0),
(151, 'RUSSIA', 'Car', 6, '1L13 EWR', 0),
(152, 'RUSSIA', 'Car', 6, '55G6 EWR', 0),
(153, 'RUSSIA', 'Car', 6, 'S-300PS 40B6M tr', 0),
(154, 'RUSSIA', 'Car', 6, 'S-300PS 40B6MD sr', 0),
(155, 'RUSSIA', 'Car', 6, 'S-300PS 64H6E sr', 0),
(156, 'RUSSIA', 'Car', 6, 'S-300PS 5P85C ln', 0),
(157, 'RUSSIA', 'Car', 6, 'S-300PS 5P85D ln', 0),
(158, 'RUSSIA', 'Car', 6, 'SA-11 Buk SR 9S18M1', 0),
(159, 'RUSSIA', 'Car', 6, 'SA-11 Buk CC 9S470M1', 0),
(160, 'RUSSIA', 'Car', 6, 'SA-11 Buk LN 9A310M1', 0),
(161, 'RUSSIA', 'Car', 6, 'Kub 1S91 str', 0),
(162, 'RUSSIA', 'Car', 6, 'Kub 2P25 ln', 0),
(163, 'RUSSIA', 'Car', 6, 'Osa 9A33 ln', 0),
(164, 'RUSSIA', 'Car', 6, 'Strela-10M3', 0),
(165, 'RUSSIA', 'Car', 6, 'Dog Ear radar', 0),
(166, 'RUSSIA', 'Car', 6, 'Tor 9A331', 0),
(167, 'RUSSIA', 'Car', 6, 'ZSU-23-4 Shilka', 0),
(168, 'RUSSIA', 'Car', 5, 'SAU Msta', 0),
(169, 'RUSSIA', 'Car', 5, 'SAU Akatsia', 0),
(170, 'RUSSIA', 'Car', 5, 'SAU 2-C9', 0),
(171, 'RUSSIA', 'Car', 7, 'ATMZ-5', 0),
(172, 'RUSSIA', 'Car', 7, 'ATZ-10', 0),
(173, 'RUSSIA', 'Car', 4, 'BMD-1', 0),
(174, 'RUSSIA', 'Car', 4, 'BMP-1', 0),
(175, 'RUSSIA', 'Car', 4, 'BMP-2', 0),
(176, 'RUSSIA', 'Car', 4, 'BRDM-2', 0),
(177, 'RUSSIA', 'Car', 5, 'Grad-URAL', 0),
(178, 'RUSSIA', 'Car', 4, 'T-80UD', 0),
(179, 'RUSSIA', 'Car', 7, 'UAZ-469', 0),
(180, 'RUSSIA', 'Car', 7, 'Ural-375', 0),
(181, 'RUSSIA', 'Car', 7, 'Ural-375 PBU', 0),
(182, 'RUSSIA', 'Car', 7, 'IKARUS Bus', 0),
(183, 'RUSSIA', 'Car', 7, 'VAZ Car', 0),
(184, 'RUSSIA', 'Car', 7, 'Trolley bus', 0),
(185, 'RUSSIA', 'Car', 7, 'KAMAZ Truck', 0),
(186, 'RUSSIA', 'Car', 7, 'LAZ Bus', 0),
(187, 'RUSSIA', 'Car', 5, 'SAU Gvozdika', 0),
(188, 'RUSSIA', 'Car', 4, 'BTR_D', 0),
(189, 'RUSSIA', 'Car', 6, 'S-300PS 54K6 cp', 0),
(190, 'RUSSIA', 'Car', 7, 'GAZ-3307', 0),
(191, 'RUSSIA', 'Car', 7, 'GAZ-3308', 0),
(192, 'RUSSIA', 'Car', 7, 'GAZ-66', 0),
(193, 'RUSSIA', 'Car', 7, 'ZIL-4331', 0),
(194, 'RUSSIA', 'Car', 7, 'MAZ-6303', 0),
(195, 'RUSSIA', 'Car', 7, 'SKP-11', 0),
(196, 'RUSSIA', 'Car', 7, 'Ural-4320T', 0),
(197, 'RUSSIA', 'Car', 7, 'Ural ATsP-6', 0),
(198, 'RUSSIA', 'Car', 7, 'ZiL-131 APA-80', 0),
(199, 'RUSSIA', 'Car', 7, 'ZIL-131 KUNG', 0),
(200, 'RUSSIA', 'Car', 7, 'Ural-375 APA-50', 0),
(201, 'RUSSIA', 'Car', 6, 'ZU-23 Emplacement', 0),
(202, 'RUSSIA', 'Car', 6, 'ZU-23 Emplacement Closed', 0),
(203, 'RUSSIA', 'Car', 6, 'Ural-375 ZU-23', 0),
(204, 'RUSSIA', 'Car', 6, '2S6 Tunguska', 0),
(205, 'RUSSIA', 'Car', 5, 'Smerch', 0),
(206, 'RUSSIA', 'Car', 6, 'Strela-1 9P31', 0),
(207, 'RUSSIA', 'Car', 4, 'MTLB', 0),
(208, 'RUSSIA', 'Car', 4, 'T-72B', 0),
(209, 'RUSSIA', 'Car', 6, 'SA-18 Igla-S manpad', 0),
(210, 'RUSSIA', 'Car', 6, 'SA-18 Igla-S comm', 0),
(211, 'RUSSIA', 'Car', 4, 'T-55', 0),
(212, 'RUSSIA', 'Car', 5, '2B11 mortar', 0),
(213, 'RUSSIA', 'Helicopter', 2, 'Mi-24V', 0),
(214, 'RUSSIA', 'Helicopter', 2, 'Mi-8MT', 0),
(215, 'RUSSIA', 'Helicopter', 2, 'Mi-26', 0),
(216, 'RUSSIA', 'Helicopter', 2, 'Ka-27', 0),
(217, 'RUSSIA', 'Helicopter', 2, 'UH-1H', 0),
(218, 'USA', 'Plane', 1, 'A-10A', 0),
(219, 'USA', 'Plane', 1, 'F-117A', 0),
(220, 'USA', 'Plane', 1, 'C-17A', 0),
(221, 'USA', 'Plane', 1, 'F-15C', 0),
(222, 'USA', 'Plane', 1, 'F-15E', 0),
(223, 'USA', 'Plane', 1, 'F-16C bl.52d', 0),
(224, 'USA', 'Plane', 1, 'B-1B', 0),
(225, 'USA', 'Plane', 1, 'B-52H', 0),
(226, 'USA', 'Plane', 1, 'E-3A', 0),
(227, 'USA', 'Plane', 1, 'KC-135', 0),
(228, 'USA', 'Plane', 1, 'C-130', 0),
(229, 'USA', 'Plane', 1, 'F-14A', 0),
(230, 'USA', 'Plane', 1, 'S-3B', 0),
(231, 'USA', 'Plane', 1, 'S-3B Tanker', 0),
(232, 'USA', 'Plane', 1, 'F/A-18C', 0),
(233, 'USA', 'Plane', 1, 'E-2C', 0),
(234, 'USA', 'Plane', 1, 'F-16A', 0),
(235, 'USA', 'Plane', 1, 'F-5E', 0),
(236, 'USA', 'Plane', 1, 'RQ-1A Predator', 0),
(237, 'USA', 'Plane', 1, 'P-51D', 0),
(238, 'USA', 'Ship', 3, 'VINSON', 0),
(239, 'USA', 'Ship', 3, 'PERRY', 0),
(240, 'USA', 'Ship', 3, 'TICONDEROG', 0),
(241, 'USA', 'Car', 4, 'M-2 Bradley', 0),
(242, 'USA', 'Car', 6, 'M1097 Avenger', 0),
(243, 'USA', 'Car', 6, 'Patriot str', 0),
(244, 'USA', 'Car', 6, 'Patriot ln', 0),
(245, 'USA', 'Car', 6, 'Patriot AMG', 0),
(246, 'USA', 'Car', 6, 'Patriot EPP', 0),
(247, 'USA', 'Car', 6, 'Patriot ECS', 0),
(248, 'USA', 'Car', 6, 'Patriot cp', 0),
(249, 'USA', 'Car', 6, 'Hawk sr', 0),
(250, 'USA', 'Car', 6, 'Hawk tr', 0),
(251, 'USA', 'Car', 6, 'Hawk ln', 0),
(252, 'USA', 'Car', 6, 'Vulcan', 0),
(253, 'USA', 'Car', 4, 'Hummer', 0),
(254, 'USA', 'Car', 4, 'LAV-25', 0),
(255, 'USA', 'Car', 4, 'AAV7', 0),
(256, 'USA', 'Car', 4, 'M-113', 0),
(257, 'USA', 'Car', 5, 'M-109', 0),
(258, 'USA', 'Car', 4, 'M-1 Abrams', 0),
(259, 'USA', 'Car', 5, 'MLRS', 0),
(260, 'USA', 'Car', 7, 'M 818', 0),
(261, 'USA', 'Car', 6, 'M48 Chaparral', 0),
(262, 'USA', 'Car', 4, 'M1126 Stryker ICV', 0),
(263, 'USA', 'Car', 4, 'M1128 Stryker MGS', 0),
(264, 'USA', 'Car', 4, 'M1134 Stryker ATGM', 0),
(265, 'USA', 'Car', 6, 'M6 Linebacker', 0),
(266, 'USA', 'Car', 6, 'Stinger manpad', 0),
(267, 'USA', 'Car', 6, 'Stinger comm', 0),
(268, 'USA', 'Car', 1, 'Predator GCS', 0),
(269, 'USA', 'Car', 1, 'Predator TrojanSpirit', 0),
(270, 'USA', 'Car', 4, 'M1043 HMMWV Armament', 0),
(271, 'USA', 'Car', 4, 'M1045 HMMWV TOW', 0),
(272, 'USA', 'Car', 7, 'M978 HEMTT Tanker', 0),
(273, 'USA', 'Car', 7, 'HEMTT TFFT', 0),
(274, 'USA', 'Car', 8, 'Soldier M4', 0),
(275, 'USA', 'Car', 8, 'Soldier M249', 0),
(276, 'USA', 'Car', 5, '2B11 mortar', 0),
(277, 'USA', 'Helicopter', 2, 'AH-64A', 0),
(278, 'USA', 'Helicopter', 2, 'AH-64D', 0),
(279, 'USA', 'Helicopter', 2, 'AH-1W', 0),
(280, 'USA', 'Helicopter', 2, 'UH-60A', 0),
(281, 'USA', 'Helicopter', 2, 'CH-47D', 0),
(282, 'USA', 'Helicopter', 2, 'SH-60B', 0),
(283, 'USA', 'Helicopter', 2, 'CH-53E', 0),
(284, 'USA', 'Helicopter', 2, 'OH-58D', 0),
(285, 'USA', 'Helicopter', 2, 'UH-1H', 0),
(286, 'TURKEY', 'Plane', 1, 'F-16C bl.50', 0),
(287, 'TURKEY', 'Plane', 1, 'F-4E', 0),
(288, 'TURKEY', 'Plane', 1, 'F-5E', 0),
(289, 'TURKEY', 'Plane', 1, 'C-130', 0),
(290, 'TURKEY', 'Plane', 1, 'P-51D', 0),
(291, 'TURKEY', 'Ship', 3, 'PERRY', 0),
(292, 'TURKEY', 'Car', 4, 'M-113', 0),
(293, 'TURKEY', 'Car', 6, 'Hawk sr', 0),
(294, 'TURKEY', 'Car', 6, 'Hawk tr', 0),
(295, 'TURKEY', 'Car', 6, 'Hawk ln', 0),
(296, 'TURKEY', 'Car', 4, 'Hummer', 0),
(297, 'TURKEY', 'Car', 7, 'M 818', 0),
(298, 'TURKEY', 'Car', 4, 'M-60', 0),
(299, 'TURKEY', 'Car', 5, 'MLRS', 0),
(300, 'TURKEY', 'Car', 6, 'M1097 Avenger', 0),
(301, 'TURKEY', 'Car', 6, 'Vulcan', 0),
(302, 'TURKEY', 'Car', 5, 'M-109', 0),
(303, 'TURKEY', 'Car', 4, 'AAV7', 0),
(304, 'TURKEY', 'Car', 6, 'M48 Chaparral', 0),
(305, 'TURKEY', 'Car', 4, 'BTR-80', 0),
(306, 'TURKEY', 'Car', 6, 'Stinger manpad', 0),
(307, 'TURKEY', 'Car', 6, 'Stinger comm', 0),
(308, 'TURKEY', 'Car', 7, 'M978 HEMTT Tanker', 0),
(309, 'TURKEY', 'Car', 7, 'HEMTT TFFT', 0),
(310, 'TURKEY', 'Car', 4, 'Leopard1A3', 0),
(311, 'TURKEY', 'Helicopter', 2, 'UH-60A', 0),
(312, 'TURKEY', 'Helicopter', 2, 'Mi-8MT', 0),
(313, 'TURKEY', 'Helicopter', 2, 'AH-1W', 0),
(314, 'TURKEY', 'Helicopter', 2, 'UH-1H', 0),
(315, 'GERMANY', 'Plane', 1, 'MiG-29G', 0),
(316, 'GERMANY', 'Plane', 1, 'F-4E', 0),
(317, 'GERMANY', 'Plane', 1, 'Tornado IDS', 0),
(318, 'GERMANY', 'Plane', 1, 'P-51D', 0),
(319, 'GERMANY', 'Car', 4, 'M-113', 0),
(320, 'GERMANY', 'Car', 6, 'Patriot str', 0),
(321, 'GERMANY', 'Car', 6, 'Patriot ln', 0),
(322, 'GERMANY', 'Car', 6, 'Patriot AMG', 0),
(323, 'GERMANY', 'Car', 6, 'Patriot EPP', 0),
(324, 'GERMANY', 'Car', 6, 'Patriot ECS', 0),
(325, 'GERMANY', 'Car', 6, 'Patriot cp', 0),
(326, 'GERMANY', 'Car', 6, 'Hawk sr', 0),
(327, 'GERMANY', 'Car', 6, 'Hawk tr', 0),
(328, 'GERMANY', 'Car', 6, 'Hawk ln', 0),
(329, 'GERMANY', 'Car', 6, 'Roland ADS', 0),
(330, 'GERMANY', 'Car', 6, 'Roland Radar', 0),
(331, 'GERMANY', 'Car', 6, 'Gepard', 0),
(332, 'GERMANY', 'Car', 4, 'Hummer', 0),
(333, 'GERMANY', 'Car', 4, 'Leopard-2', 0),
(334, 'GERMANY', 'Car', 5, 'M-109', 0),
(335, 'GERMANY', 'Car', 4, 'Marder', 0),
(336, 'GERMANY', 'Car', 4, 'TPZ', 0),
(337, 'GERMANY', 'Car', 5, 'MLRS', 0),
(338, 'GERMANY', 'Car', 6, 'Stinger manpad', 0),
(339, 'GERMANY', 'Car', 6, 'Stinger comm', 0),
(340, 'GERMANY', 'Car', 7, 'M 818', 0),
(341, 'GERMANY', 'Car', 7, 'M978 HEMTT Tanker', 0),
(342, 'GERMANY', 'Car', 7, 'HEMTT TFFT', 0),
(343, 'GERMANY', 'Helicopter', 2, 'UH-1H', 0),
(344, 'GERMANY', 'Plane', 1, 'C-130', 0),
(345, 'GERMANY', 'Plane', 1, 'P-51D', 0),
(346, 'GERMANY', 'Plane', 1, 'F/A-18C', 0),
(347, 'GERMANY', 'Car', 4, 'M-113', 0),
(348, 'GERMANY', 'Car', 4, 'Hummer', 0),
(349, 'GERMANY', 'Car', 4, 'LAV-25', 0),
(350, 'GERMANY', 'Car', 5, 'M-109', 0),
(351, 'GERMANY', 'Car', 6, 'Stinger manpad', 0),
(352, 'GERMANY', 'Car', 6, 'Stinger comm', 0),
(353, 'GERMANY', 'Car', 7, 'M 818', 0),
(354, 'GERMANY', 'Car', 7, 'M978 HEMTT Tanker', 0),
(355, 'GERMANY', 'Car', 7, 'HEMTT TFFT', 0),
(356, 'GERMANY', 'Car', 4, 'Leopard1A3', 0),
(357, 'GERMANY', 'Helicopter', 2, 'UH-1H', 0),
(358, 'GERMANY', 'Plane', 1, 'Tornado GR4', 0),
(359, 'GERMANY', 'Plane', 1, 'C-130', 0),
(360, 'GERMANY', 'Plane', 1, 'P-51D', 0),
(361, 'GERMANY', 'Car', 4, 'MCV-80', 0),
(362, 'GERMANY', 'Car', 4, 'Challenger2', 0),
(363, 'GERMANY', 'Car', 4, 'Hummer', 0),
(364, 'GERMANY', 'Car', 5, 'MLRS', 0),
(365, 'GERMANY', 'Car', 7, 'M 818', 0),
(366, 'GERMANY', 'Helicopter', 2, 'AH-64A', 0),
(367, 'GERMANY', 'Helicopter', 2, 'AH-64D', 0),
(368, 'GERMANY', 'Helicopter', 2, 'CH-47D', 0),
(369, 'GERMANY', 'Helicopter', 2, 'UH-1H', 0),
(370, 'GERMANY', 'Plane', 1, 'Mirage 2000-5', 0),
(371, 'GERMANY', 'Plane', 1, 'C-130', 0),
(372, 'GERMANY', 'Plane', 1, 'P-51D', 0),
(373, 'GERMANY', 'Car', 4, 'Leclerc', 0),
(374, 'GERMANY', 'Car', 5, 'MLRS', 0),
(375, 'GERMANY', 'Car', 6, 'Hawk sr', 0),
(376, 'GERMANY', 'Car', 6, 'Hawk tr', 0),
(377, 'GERMANY', 'Car', 6, 'Hawk ln', 0),
(378, 'GERMANY', 'Car', 7, 'M 818', 0),
(379, 'GERMANY', 'Helicopter', 2, 'UH-1H', 0),
(380, 'GERMANY', 'Plane', 1, 'C-130', 0),
(381, 'GERMANY', 'Plane', 1, 'P-51D', 0),
(382, 'GERMANY', 'Plane', 1, 'F/A-18C', 0),
(383, 'GERMANY', 'Car', 4, 'M-113', 0),
(384, 'GERMANY', 'Car', 6, 'Hawk sr', 0),
(385, 'GERMANY', 'Car', 6, 'Hawk tr', 0),
(386, 'GERMANY', 'Car', 6, 'Hawk ln', 0),
(387, 'GERMANY', 'Car', 4, 'Hummer', 0),
(388, 'GERMANY', 'Car', 4, 'Leopard-2', 0),
(389, 'GERMANY', 'Car', 5, 'M-109', 0),
(390, 'GERMANY', 'Car', 6, 'Stinger manpad', 0),
(391, 'GERMANY', 'Car', 6, 'Stinger comm', 0),
(392, 'GERMANY', 'Car', 7, 'M 818', 0),
(393, 'GERMANY', 'Helicopter', 2, 'CH-47D', 0),
(394, 'GERMANY', 'Helicopter', 2, 'UH-1H', 0),
(395, 'THE NETHERLANDS', 'Plane', 1, 'C-130', 0),
(396, 'THE NETHERLANDS', 'Plane', 1, 'F-16A MLU', 0),
(397, 'THE NETHERLANDS', 'Plane', 1, 'P-51D', 0),
(398, 'THE NETHERLANDS', 'Car', 4, 'Hummer', 0),
(399, 'THE NETHERLANDS', 'Car', 6, 'Patriot str', 0),
(400, 'THE NETHERLANDS', 'Car', 6, 'Patriot ln', 0),
(401, 'THE NETHERLANDS', 'Car', 6, 'Patriot AMG', 0),
(402, 'THE NETHERLANDS', 'Car', 6, 'Patriot EPP', 0),
(403, 'THE NETHERLANDS', 'Car', 6, 'Patriot ECS', 0),
(404, 'THE NETHERLANDS', 'Car', 6, 'Patriot cp', 0),
(405, 'THE NETHERLANDS', 'Car', 6, 'Hawk sr', 0),
(406, 'THE NETHERLANDS', 'Car', 6, 'Hawk tr', 0),
(407, 'THE NETHERLANDS', 'Car', 6, 'Hawk ln', 0),
(408, 'THE NETHERLANDS', 'Car', 4, 'Leopard-2', 0),
(409, 'THE NETHERLANDS', 'Car', 5, 'M-109', 0),
(410, 'THE NETHERLANDS', 'Car', 5, 'MLRS', 0),
(411, 'THE NETHERLANDS', 'Car', 6, 'Stinger manpad', 0),
(412, 'THE NETHERLANDS', 'Car', 6, 'Stinger comm', 0),
(413, 'THE NETHERLANDS', 'Car', 7, 'M 818', 0),
(414, 'THE NETHERLANDS', 'Car', 4, 'Leopard1A3', 0),
(415, 'THE NETHERLANDS', 'Helicopter', 2, 'AH-64A', 0),
(416, 'THE NETHERLANDS', 'Helicopter', 2, 'AH-64D', 0),
(417, 'THE NETHERLANDS', 'Helicopter', 2, 'CH-47D', 0),
(418, 'THE NETHERLANDS', 'Helicopter', 2, 'UH-1H', 0),
(419, 'BELGIUM', 'Plane', 1, 'C-130', 0),
(420, 'BELGIUM', 'Plane', 1, 'F-16A MLU', 0),
(421, 'BELGIUM', 'Plane', 1, 'P-51D', 0),
(422, 'BELGIUM', 'Car', 4, 'M-113', 0),
(423, 'BELGIUM', 'Car', 6, 'Hawk sr', 0),
(424, 'BELGIUM', 'Car', 6, 'Hawk tr', 0),
(425, 'BELGIUM', 'Car', 6, 'Hawk ln', 0),
(426, 'BELGIUM', 'Car', 4, 'Hummer', 0),
(427, 'BELGIUM', 'Car', 5, 'M-109', 0),
(428, 'BELGIUM', 'Car', 6, 'Stinger manpad', 0),
(429, 'BELGIUM', 'Car', 6, 'Stinger comm', 0),
(430, 'BELGIUM', 'Car', 7, 'M 818', 0),
(431, 'BELGIUM', 'Helicopter', 2, 'UH-1H', 0),
(432, 'NORWAY', 'Plane', 1, 'C-130', 0),
(433, 'NORWAY', 'Plane', 1, 'F-16A MLU', 0),
(434, 'NORWAY', 'Plane', 1, 'P-51D', 0),
(435, 'NORWAY', 'Car', 4, 'M-113', 0),
(436, 'NORWAY', 'Car', 6, 'Hawk sr', 0),
(437, 'NORWAY', 'Car', 6, 'Hawk tr', 0),
(438, 'NORWAY', 'Car', 6, 'Hawk ln', 0),
(439, 'NORWAY', 'Car', 4, 'Hummer', 0),
(440, 'NORWAY', 'Car', 5, 'M-109', 0),
(441, 'NORWAY', 'Car', 5, 'MLRS', 0),
(442, 'NORWAY', 'Car', 6, 'Stinger manpad', 0),
(443, 'NORWAY', 'Car', 6, 'Stinger comm', 0),
(444, 'NORWAY', 'Car', 7, 'M 818', 0),
(445, 'NORWAY', 'Car', 4, 'Leopard1A3', 0),
(446, 'NORWAY', 'Helicopter', 2, 'UH-1H', 0),
(447, 'DENMARK', 'Plane', 1, 'C-130', 0),
(448, 'DENMARK', 'Plane', 1, 'F-16A MLU', 0),
(449, 'DENMARK', 'Plane', 1, 'P-51D', 0),
(450, 'DENMARK', 'Car', 4, 'M-113', 0),
(451, 'DENMARK', 'Car', 6, 'Hawk sr', 0),
(452, 'DENMARK', 'Car', 6, 'Hawk tr', 0),
(453, 'DENMARK', 'Car', 6, 'Hawk ln', 0),
(454, 'DENMARK', 'Car', 4, 'Hummer', 0),
(455, 'DENMARK', 'Car', 5, 'M-109', 0),
(456, 'DENMARK', 'Car', 5, 'MLRS', 0),
(457, 'DENMARK', 'Car', 6, 'Stinger manpad', 0),
(458, 'DENMARK', 'Car', 6, 'Stinger comm', 0),
(459, 'DENMARK', 'Car', 7, 'M 818', 0),
(460, 'DENMARK', 'Car', 4, 'Leopard1A3', 0),
(461, 'DENMARK', 'Helicopter', 2, 'UH-1H', 0),
(462, 'GEORGIA', 'Plane', 1, 'Su-25', 0),
(463, 'GEORGIA', 'Plane', 1, 'An-26B', 0),
(464, 'GEORGIA', 'Plane', 1, 'Su-25T', 0),
(465, 'GEORGIA', 'Plane', 1, 'L-39ZA', 0),
(466, 'GEORGIA', 'Plane', 1, 'Yak-40', 0),
(467, 'GEORGIA', 'Plane', 1, 'P-51D', 0),
(468, 'GEORGIA', 'Ship', 3, 'ELNYA', 0),
(469, 'GEORGIA', 'Ship', 3, 'ALBATROS', 0),
(470, 'GEORGIA', 'Ship', 3, 'MOLNIYA', 0),
(471, 'GEORGIA', 'Ship', 3, 'Dry-Cargo Ship-1', 0),
(472, 'GEORGIA', 'Ship', 3, 'Dry-Cargo Ship-2', 0),
(473, 'GEORGIA', 'Ship', 3, 'ZWEZDNY', 0),
(474, 'GEORGIA', 'Car', 4, 'BTR-80', 0),
(475, 'GEORGIA', 'Car', 6, 'Strela-1 9P31', 0),
(476, 'GEORGIA', 'Car', 6, 'Strela-10M3', 0),
(477, 'GEORGIA', 'Car', 6, 'ZSU-23-4 Shilka', 0),
(478, 'GEORGIA', 'Car', 6, 'SA-11 Buk SR 9S18M1', 0),
(479, 'GEORGIA', 'Car', 6, 'SA-11 Buk CC 9S470M1', 0),
(480, 'GEORGIA', 'Car', 6, 'SA-11 Buk LN 9A310M1', 0),
(481, 'GEORGIA', 'Car', 5, 'SAU Akatsia', 0),
(482, 'GEORGIA', 'Car', 5, 'SAU 2-C9', 0),
(483, 'GEORGIA', 'Car', 7, 'ATMZ-5', 0),
(484, 'GEORGIA', 'Car', 7, 'ATZ-10', 0),
(485, 'GEORGIA', 'Car', 7, 'Ural-375 APA-50', 0),
(486, 'GEORGIA', 'Car', 4, 'BMD-1', 0),
(487, 'GEORGIA', 'Car', 4, 'BMP-1', 0),
(488, 'GEORGIA', 'Car', 4, 'BMP-2', 0),
(489, 'GEORGIA', 'Car', 4, 'BRDM-2', 0),
(490, 'GEORGIA', 'Car', 5, 'Grad-URAL', 0),
(491, 'GEORGIA', 'Car', 7, 'UAZ-469', 0),
(492, 'GEORGIA', 'Car', 7, 'Ural-375', 0),
(493, 'GEORGIA', 'Car', 7, 'Ural-375 PBU', 0),
(494, 'GEORGIA', 'Car', 7, 'IKARUS Bus', 0),
(495, 'GEORGIA', 'Car', 7, 'VAZ Car', 0),
(496, 'GEORGIA', 'Car', 7, 'Trolley bus', 0),
(497, 'GEORGIA', 'Car', 7, 'KAMAZ Truck', 0),
(498, 'GEORGIA', 'Car', 7, 'LAZ Bus', 0),
(499, 'GEORGIA', 'Car', 7, 'GAZ-3307', 0),
(500, 'GEORGIA', 'Car', 7, 'GAZ-3308', 0),
(501, 'GEORGIA', 'Car', 7, 'GAZ-66', 0),
(502, 'GEORGIA', 'Car', 7, 'MAZ-6303', 0),
(503, 'GEORGIA', 'Car', 7, 'ZIL-4331', 0),
(504, 'GEORGIA', 'Car', 6, 'Osa 9A33 ln', 0),
(505, 'GEORGIA', 'Car', 7, 'SKP-11', 0),
(506, 'GEORGIA', 'Car', 7, 'Ural ATsP-6', 0),
(507, 'GEORGIA', 'Car', 7, 'ZiL-131 APA-80', 0),
(508, 'GEORGIA', 'Car', 7, 'ZIL-131 KUNG', 0),
(509, 'GEORGIA', 'Car', 6, 'ZU-23 Emplacement', 0),
(510, 'GEORGIA', 'Car', 6, 'ZU-23 Emplacement Closed', 0),
(511, 'GEORGIA', 'Car', 6, 'Ural-375 ZU-23', 0),
(512, 'GEORGIA', 'Car', 6, 'Dog Ear radar', 0),
(513, 'GEORGIA', 'Car', 6, '1L13 EWR', 0),
(514, 'GEORGIA', 'Car', 4, 'MTLB', 0),
(515, 'GEORGIA', 'Car', 4, 'T-72B', 0),
(516, 'GEORGIA', 'Car', 6, 'SA-18 Igla manpad', 0),
(517, 'GEORGIA', 'Car', 6, 'SA-18 Igla comm', 0),
(518, 'GEORGIA', 'Car', 4, 'T-55', 0),
(519, 'GEORGIA', 'Car', 6, 'Stinger manpad', 0),
(520, 'GEORGIA', 'Car', 6, 'Stinger comm', 0),
(521, 'GEORGIA', 'Car', 8, 'Soldier AK', 0),
(522, 'GEORGIA', 'Car', 8, 'Soldier RPG', 0),
(523, 'GEORGIA', 'Car', 6, '5p73 s-125 ln', 0),
(524, 'GEORGIA', 'Car', 6, 'snr s-125 tr', 0),
(525, 'GEORGIA', 'Car', 6, 'p-19 s-125 sr', 0),
(526, 'GEORGIA', 'Car', 7, 'M 818', 0),
(527, 'GEORGIA', 'Car', 5, '2B11 mortar', 0),
(528, 'GEORGIA', 'Helicopter', 2, 'UH-1H', 0),
(529, 'GEORGIA', 'Helicopter', 2, 'Mi-8MT', 0),
(530, 'GEORGIA', 'Helicopter', 2, 'Mi-24V', 0),
(531, 'ISRAEL', 'Plane', 1, 'F-15C', 0),
(532, 'ISRAEL', 'Plane', 1, 'F-15E', 0),
(533, 'ISRAEL', 'Plane', 1, 'F-16C bl.52d', 0),
(534, 'ISRAEL', 'Plane', 1, 'C-130', 0),
(535, 'ISRAEL', 'Plane', 1, 'F-4E', 0),
(536, 'ISRAEL', 'Plane', 1, 'P-51D', 0),
(537, 'ISRAEL', 'Car', 4, 'M-113', 0),
(538, 'ISRAEL', 'Car', 6, 'M1097 Avenger', 0),
(539, 'ISRAEL', 'Car', 6, 'Patriot str', 0),
(540, 'ISRAEL', 'Car', 6, 'Patriot ln', 0),
(541, 'ISRAEL', 'Car', 6, 'Patriot AMG', 0),
(542, 'ISRAEL', 'Car', 6, 'Patriot EPP', 0),
(543, 'ISRAEL', 'Car', 6, 'Patriot ECS', 0),
(544, 'ISRAEL', 'Car', 6, 'Patriot cp', 0),
(545, 'ISRAEL', 'Car', 6, 'Hawk sr', 0),
(546, 'ISRAEL', 'Car', 6, 'Hawk tr', 0),
(547, 'ISRAEL', 'Car', 6, 'Hawk ln', 0),
(548, 'ISRAEL', 'Car', 6, 'Vulcan', 0),
(549, 'ISRAEL', 'Car', 4, 'Hummer', 0),
(550, 'ISRAEL', 'Car', 4, 'LAV-25', 0),
(551, 'ISRAEL', 'Car', 4, 'AAV7', 0),
(552, 'ISRAEL', 'Car', 5, 'M-109', 0),
(553, 'ISRAEL', 'Car', 4, 'M-60', 0),
(554, 'ISRAEL', 'Car', 7, 'M 818', 0),
(555, 'ISRAEL', 'Car', 6, 'M48 Chaparral', 0),
(556, 'ISRAEL', 'Car', 5, 'MLRS', 0),
(557, 'ISRAEL', 'Car', 6, 'Stinger manpad dsr', 0),
(558, 'ISRAEL', 'Car', 6, 'Stinger comm dsr', 0),
(559, 'ISRAEL', 'Helicopter', 2, 'AH-64A', 0),
(560, 'ISRAEL', 'Helicopter', 2, 'AH-1W', 0),
(561, 'ISRAEL', 'Helicopter', 2, 'UH-60A', 0),
(562, 'ISRAEL', 'Helicopter', 2, 'AH-64D', 0),
(563, 'ISRAEL', 'Helicopter', 2, 'UH-1H', 0),
(564, 'INSURGENTS', 'Ship', 3, 'ELNYA', 0),
(565, 'INSURGENTS', 'Ship', 3, 'MOLNIYA', 0),
(566, 'INSURGENTS', 'Ship', 3, 'Dry-Cargo Ship-1', 0),
(567, 'INSURGENTS', 'Ship', 3, 'Dry-Cargo Ship-2', 0),
(568, 'INSURGENTS', 'Ship', 3, 'ZWEZDNY', 0),
(569, 'INSURGENTS', 'Car', 4, 'BTR-80', 0),
(570, 'INSURGENTS', 'Car', 6, 'Strela-1 9P31', 0),
(571, 'INSURGENTS', 'Car', 6, 'Strela-10M3', 0),
(572, 'INSURGENTS', 'Car', 6, 'ZSU-23-4 Shilka', 0),
(573, 'INSURGENTS', 'Car', 5, 'SAU Akatsia', 0),
(574, 'INSURGENTS', 'Car', 5, 'SAU 2-C9', 0),
(575, 'INSURGENTS', 'Car', 7, 'ATMZ-5', 0),
(576, 'INSURGENTS', 'Car', 7, 'ATZ-10', 0),
(577, 'INSURGENTS', 'Car', 4, 'BMD-1', 0),
(578, 'INSURGENTS', 'Car', 4, 'BMP-1', 0),
(579, 'INSURGENTS', 'Car', 4, 'BMP-2', 0),
(580, 'INSURGENTS', 'Car', 4, 'BRDM-2', 0),
(581, 'INSURGENTS', 'Car', 5, 'Grad-URAL', 0),
(582, 'INSURGENTS', 'Car', 7, 'UAZ-469', 0),
(583, 'INSURGENTS', 'Car', 7, 'Ural-375', 0),
(584, 'INSURGENTS', 'Car', 7, 'Ural-375 PBU', 0),
(585, 'INSURGENTS', 'Car', 7, 'IKARUS Bus', 0),
(586, 'INSURGENTS', 'Car', 7, 'VAZ Car', 0),
(587, 'INSURGENTS', 'Car', 7, 'Trolley bus', 0),
(588, 'INSURGENTS', 'Car', 7, 'KAMAZ Truck', 0),
(589, 'INSURGENTS', 'Car', 7, 'LAZ Bus', 0),
(590, 'INSURGENTS', 'Car', 7, 'GAZ-3307', 0),
(591, 'INSURGENTS', 'Car', 7, 'GAZ-3308', 0),
(592, 'INSURGENTS', 'Car', 7, 'GAZ-66', 0),
(593, 'INSURGENTS', 'Car', 7, 'MAZ-6303', 0),
(594, 'INSURGENTS', 'Car', 7, 'ZIL-4331', 0),
(595, 'INSURGENTS', 'Car', 6, 'ZU-23 Insurgent', 0),
(596, 'INSURGENTS', 'Car', 6, 'ZU-23 Closed Insurgent', 0),
(597, 'INSURGENTS', 'Car', 6, 'Ural-375 ZU-23 Insurgent', 0),
(598, 'INSURGENTS', 'Car', 7, 'ZiL-131 APA-80', 0),
(599, 'INSURGENTS', 'Car', 7, 'ZIL-131 KUNG', 0),
(600, 'INSURGENTS', 'Car', 4, 'MTLB', 0),
(601, 'INSURGENTS', 'Car', 6, 'SA-18 Igla manpad', 0),
(602, 'INSURGENTS', 'Car', 6, 'SA-18 Igla comm', 0),
(603, 'INSURGENTS', 'Car', 4, 'T-55', 0),
(604, 'INSURGENTS', 'Car', 6, 'Stinger manpad', 0),
(605, 'INSURGENTS', 'Car', 6, 'Stinger comm', 0),
(606, 'INSURGENTS', 'Car', 8, 'Soldier AK', 0),
(607, 'INSURGENTS', 'Car', 8, 'Soldier RPG', 0),
(608, 'INSURGENTS', 'Car', 5, '2B11 mortar', 0),
(609, 'INSURGENTS', 'Helicopter', 2, 'Mi-8MT', 0),
(610, 'INSURGENTS', 'Helicopter', 2, 'UH-1H', 0),
(611, 'ABKHAZIA', 'Plane', 1, 'Su-25', 0),
(612, 'ABKHAZIA', 'Plane', 1, 'An-26B', 0),
(613, 'ABKHAZIA', 'Plane', 1, 'L-39ZA', 0),
(614, 'ABKHAZIA', 'Plane', 1, 'P-51D', 0),
(615, 'ABKHAZIA', 'Ship', 3, 'ELNYA', 0),
(616, 'ABKHAZIA', 'Ship', 3, 'MOLNIYA', 0),
(617, 'ABKHAZIA', 'Ship', 3, 'ZWEZDNY', 0),
(618, 'ABKHAZIA', 'Ship', 3, 'Dry-Cargo Ship-1', 0),
(619, 'ABKHAZIA', 'Ship', 3, 'Dry-Cargo Ship-2', 0),
(620, 'ABKHAZIA', 'Car', 4, 'BTR-80', 0),
(621, 'ABKHAZIA', 'Car', 6, 'SA-11 Buk SR 9S18M1', 0),
(622, 'ABKHAZIA', 'Car', 6, 'SA-11 Buk CC 9S470M1', 0),
(623, 'ABKHAZIA', 'Car', 6, 'SA-11 Buk LN 9A310M1', 0),
(624, 'ABKHAZIA', 'Car', 6, 'Kub 1S91 str', 0),
(625, 'ABKHAZIA', 'Car', 6, 'Kub 2P25 ln', 0),
(626, 'ABKHAZIA', 'Car', 6, 'Osa 9A33 ln', 0),
(627, 'ABKHAZIA', 'Car', 6, 'Strela-10M3', 0),
(628, 'ABKHAZIA', 'Car', 6, 'Dog Ear radar', 0),
(629, 'ABKHAZIA', 'Car', 6, 'ZSU-23-4 Shilka', 0),
(630, 'ABKHAZIA', 'Car', 5, 'SAU Akatsia', 0),
(631, 'ABKHAZIA', 'Car', 5, 'SAU 2-C9', 0),
(632, 'ABKHAZIA', 'Car', 7, 'ATMZ-5', 0),
(633, 'ABKHAZIA', 'Car', 7, 'ATZ-10', 0),
(634, 'ABKHAZIA', 'Car', 4, 'BMD-1', 0),
(635, 'ABKHAZIA', 'Car', 4, 'BMP-1', 0),
(636, 'ABKHAZIA', 'Car', 4, 'BMP-2', 0),
(637, 'ABKHAZIA', 'Car', 4, 'BRDM-2', 0),
(638, 'ABKHAZIA', 'Car', 5, 'Grad-URAL', 0),
(639, 'ABKHAZIA', 'Car', 7, 'UAZ-469', 0),
(640, 'ABKHAZIA', 'Car', 7, 'Ural-375', 0),
(641, 'ABKHAZIA', 'Car', 7, 'Ural-375 PBU', 0),
(642, 'ABKHAZIA', 'Car', 7, 'IKARUS Bus', 0),
(643, 'ABKHAZIA', 'Car', 7, 'VAZ Car', 0),
(644, 'ABKHAZIA', 'Car', 7, 'Trolley bus', 0),
(645, 'ABKHAZIA', 'Car', 7, 'KAMAZ Truck', 0),
(646, 'ABKHAZIA', 'Car', 7, 'LAZ Bus', 0),
(647, 'ABKHAZIA', 'Car', 5, 'SAU Gvozdika', 0),
(648, 'ABKHAZIA', 'Car', 4, 'BTR_D', 0),
(649, 'ABKHAZIA', 'Car', 7, 'GAZ-3307', 0),
(650, 'ABKHAZIA', 'Car', 7, 'GAZ-3308', 0),
(651, 'ABKHAZIA', 'Car', 7, 'GAZ-66', 0),
(652, 'ABKHAZIA', 'Car', 7, 'ZIL-4331', 0),
(653, 'ABKHAZIA', 'Car', 7, 'MAZ-6303', 0),
(654, 'ABKHAZIA', 'Car', 7, 'SKP-11', 0),
(655, 'ABKHAZIA', 'Car', 7, 'Ural-4320T', 0),
(656, 'ABKHAZIA', 'Car', 7, 'Ural ATsP-6', 0),
(657, 'ABKHAZIA', 'Car', 7, 'ZiL-131 APA-80', 0),
(658, 'ABKHAZIA', 'Car', 7, 'ZIL-131 KUNG', 0),
(659, 'ABKHAZIA', 'Car', 7, 'Ural-375 APA-50', 0),
(660, 'ABKHAZIA', 'Car', 6, 'ZU-23 Emplacement', 0),
(661, 'ABKHAZIA', 'Car', 6, 'ZU-23 Emplacement Closed', 0),
(662, 'ABKHAZIA', 'Car', 6, 'Ural-375 ZU-23', 0),
(663, 'ABKHAZIA', 'Car', 6, '2S6 Tunguska', 0),
(664, 'ABKHAZIA', 'Car', 6, 'Strela-1 9P31', 0),
(665, 'ABKHAZIA', 'Car', 4, 'MTLB', 0),
(666, 'ABKHAZIA', 'Car', 4, 'T-72B', 0),
(667, 'ABKHAZIA', 'Car', 6, 'SA-18 Igla manpad', 0),
(668, 'ABKHAZIA', 'Car', 6, 'SA-18 Igla comm', 0),
(669, 'ABKHAZIA', 'Car', 4, 'T-55', 0),
(670, 'ABKHAZIA', 'Car', 5, '2B11 mortar', 0),
(671, 'ABKHAZIA', 'Helicopter', 2, 'Mi-24V', 0),
(672, 'ABKHAZIA', 'Helicopter', 2, 'Mi-8MT', 0),
(673, 'ABKHAZIA', 'Helicopter', 2, 'Ka-50', 0),
(674, 'ABKHAZIA', 'Helicopter', 2, 'UH-1H', 0),
(675, 'SOUTH OSSETIA', 'Car', 4, 'BTR-80', 0),
(676, 'SOUTH OSSETIA', 'Car', 6, 'Osa 9A33 ln', 0),
(677, 'SOUTH OSSETIA', 'Car', 6, 'Strela-10M3', 0),
(678, 'SOUTH OSSETIA', 'Car', 6, 'ZSU-23-4 Shilka', 0),
(679, 'SOUTH OSSETIA', 'Car', 5, 'SAU Akatsia', 0),
(680, 'SOUTH OSSETIA', 'Car', 5, 'SAU 2-C9', 0),
(681, 'SOUTH OSSETIA', 'Car', 7, 'ATMZ-5', 0),
(682, 'SOUTH OSSETIA', 'Car', 7, 'ATZ-10', 0),
(683, 'SOUTH OSSETIA', 'Car', 4, 'BMD-1', 0),
(684, 'SOUTH OSSETIA', 'Car', 4, 'BMP-1', 0),
(685, 'SOUTH OSSETIA', 'Car', 4, 'BMP-2', 0),
(686, 'SOUTH OSSETIA', 'Car', 4, 'BRDM-2', 0),
(687, 'SOUTH OSSETIA', 'Car', 5, 'Grad-URAL', 0),
(688, 'SOUTH OSSETIA', 'Car', 7, 'UAZ-469', 0),
(689, 'SOUTH OSSETIA', 'Car', 7, 'Ural-375', 0),
(690, 'SOUTH OSSETIA', 'Car', 7, 'Ural-375 PBU', 0),
(691, 'SOUTH OSSETIA', 'Car', 7, 'IKARUS Bus', 0),
(692, 'SOUTH OSSETIA', 'Car', 7, 'VAZ Car', 0),
(693, 'SOUTH OSSETIA', 'Car', 7, 'KAMAZ Truck', 0),
(694, 'SOUTH OSSETIA', 'Car', 7, 'LAZ Bus', 0),
(695, 'SOUTH OSSETIA', 'Car', 5, 'SAU Gvozdika', 0),
(696, 'SOUTH OSSETIA', 'Car', 4, 'BTR_D', 0),
(697, 'SOUTH OSSETIA', 'Car', 7, 'GAZ-3307', 0),
(698, 'SOUTH OSSETIA', 'Car', 7, 'GAZ-3308', 0),
(699, 'SOUTH OSSETIA', 'Car', 7, 'GAZ-66', 0),
(700, 'SOUTH OSSETIA', 'Car', 7, 'ZIL-4331', 0),
(701, 'SOUTH OSSETIA', 'Car', 7, 'MAZ-6303', 0),
(702, 'SOUTH OSSETIA', 'Car', 7, 'SKP-11', 0),
(703, 'SOUTH OSSETIA', 'Car', 7, 'Ural-4320T', 0),
(704, 'SOUTH OSSETIA', 'Car', 7, 'Ural ATsP-6', 0),
(705, 'SOUTH OSSETIA', 'Car', 7, 'ZiL-131 APA-80', 0),
(706, 'SOUTH OSSETIA', 'Car', 7, 'ZIL-131 KUNG', 0),
(707, 'SOUTH OSSETIA', 'Car', 7, 'Ural-375 APA-50', 0),
(708, 'SOUTH OSSETIA', 'Car', 6, 'ZU-23 Emplacement', 0),
(709, 'SOUTH OSSETIA', 'Car', 6, 'ZU-23 Emplacement Closed', 0),
(710, 'SOUTH OSSETIA', 'Car', 6, 'Ural-375 ZU-23', 0),
(711, 'SOUTH OSSETIA', 'Car', 6, '2S6 Tunguska', 0),
(712, 'SOUTH OSSETIA', 'Car', 6, 'Strela-1 9P31', 0),
(713, 'SOUTH OSSETIA', 'Car', 4, 'MTLB', 0),
(714, 'SOUTH OSSETIA', 'Car', 4, 'T-72B', 0),
(715, 'SOUTH OSSETIA', 'Car', 6, 'SA-18 Igla manpad', 0),
(716, 'SOUTH OSSETIA', 'Car', 6, 'SA-18 Igla comm', 0),
(717, 'SOUTH OSSETIA', 'Car', 4, 'T-55', 0),
(718, 'SOUTH OSSETIA', 'Car', 5, '2B11 mortar', 0),
(719, 'SOUTH OSSETIA', 'Helicopter', 2, 'Mi-24V', 0),
(720, 'SOUTH OSSETIA', 'Helicopter', 2, 'Mi-8MT', 0),
(721, 'SOUTH OSSETIA', 'Helicopter', 2, 'Ka-50', 0),
(722, 'SOUTH OSSETIA', 'Helicopter', 2, 'UH-1H', 0),
(723, 'ITALY', 'Plane', 1, 'C-130', 0),
(724, 'ITALY', 'Plane', 1, 'F-16A MLU', 0),
(725, 'ITALY', 'Plane', 1, 'P-51D', 0),
(726, 'ITALY', 'Plane', 1, 'Tornado IDS', 0),
(727, 'ITALY', 'Car', 4, 'M-113', 0),
(728, 'ITALY', 'Car', 6, 'Hawk sr', 0),
(729, 'ITALY', 'Car', 6, 'Hawk tr', 0),
(730, 'ITALY', 'Car', 6, 'Hawk ln', 0),
(731, 'ITALY', 'Car', 4, 'Hummer', 0),
(732, 'ITALY', 'Car', 5, 'M-109', 0),
(733, 'ITALY', 'Car', 5, 'MLRS', 0),
(734, 'ITALY', 'Car', 6, 'Stinger manpad', 0),
(735, 'ITALY', 'Car', 6, 'Stinger comm', 0),
(736, 'ITALY', 'Car', 7, 'M 818', 0),
(737, 'ITALY', 'Car', 4, 'Leopard1A3', 0),
(738, 'ITALY', 'Car', 7, 'M978 HEMTT Tanker', 0),
(739, 'ITALY', 'Car', 7, 'HEMTT TFFT', 0),
(740, 'ITALY', 'Car', 4, 'M1043 HMMWV Armament', 0),
(741, 'ITALY', 'Car', 4, 'M1045 HMMWV TOW', 0),
(742, 'ITALY', 'Car', 5, '2B11 mortar', 0),
(743, 'ITALY', 'Helicopter', 2, 'UH-1H', 0);

-- --------------------------------------------------------

--
-- Table structure for table `fail_flights`
--

CREATE TABLE IF NOT EXISTS `fail_flights` (
  `pilot_id` int(11) NOT NULL,
  `data` datetime NOT NULL,
  KEY `pilot_id` (`pilot_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `fail_logins`
--

CREATE TABLE IF NOT EXISTS `fail_logins` (
  `email` varchar(128) NOT NULL,
  `ip_adress` varchar(128) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `flights`
--

CREATE TABLE IF NOT EXISTS `flights` (
  `pilot_id` int(11) NOT NULL,
  `flight` datetime NOT NULL,
  `coalition` varchar(10) NOT NULL,
  UNIQUE KEY `pilot_id_3` (`pilot_id`),
  KEY `pilot_id` (`pilot_id`),
  KEY `pilot_id_2` (`pilot_id`,`flight`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `flight_hours`
--

CREATE TABLE IF NOT EXISTS `flight_hours` (
  `pilot_id` int(11) NOT NULL,
  `start_flight` datetime NOT NULL,
  `end_flight` datetime NOT NULL,
  `total` bigint(20) NOT NULL,
  KEY `pilot_id` (`pilot_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pilots`
--

CREATE TABLE IF NOT EXISTS `pilots` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(128) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `pilots`
--

INSERT INTO `pilots` (`id`, `nickname`) VALUES
(1, '=BS=eekz'),
(2, 'Chief pilot'),
(3, 'FishOnTheRun');

-- --------------------------------------------------------

--
-- Table structure for table `pilots_death`
--

CREATE TABLE IF NOT EXISTS `pilots_death` (
  `pilot_id` int(11) NOT NULL,
  `death` datetime NOT NULL,
  KEY `pilot_id` (`pilot_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pilots_dogfights`
--

CREATE TABLE IF NOT EXISTS `pilots_dogfights` (
  `pilot_id` int(11) NOT NULL,
  `victim` varchar(64) NOT NULL,
  `data` datetime NOT NULL,
  `friendly` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pilots_ejects`
--

CREATE TABLE IF NOT EXISTS `pilots_ejects` (
  `pilot_id` int(11) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pilots_kills`
--

CREATE TABLE IF NOT EXISTS `pilots_kills` (
  `pilot_id` int(11) NOT NULL,
  `object` varchar(64) NOT NULL,
  `ammunition` varchar(64) NOT NULL,
  `data` datetime NOT NULL,
  KEY `pilot_id` (`pilot_id`),
  KEY `object` (`object`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pilots_lands`
--

CREATE TABLE IF NOT EXISTS `pilots_lands` (
  `pilot_id` int(11) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pilots_takeoffs`
--

CREATE TABLE IF NOT EXISTS `pilots_takeoffs` (
  `pilot_id` int(11) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `server`
--

CREATE TABLE IF NOT EXISTS `server` (
  `status` int(1) NOT NULL,
  `ip_adress` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `server`
--

INSERT INTO `server` (`status`, `ip_adress`) VALUES
(1, '95.215.156.205');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE IF NOT EXISTS `units` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(64) NOT NULL,
  `type_unit` varchar(256) NOT NULL,
  `category` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `point` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `id` (`id`),
  KEY `category` (`category`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=744 ;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `country`, `type_unit`, `category`, `name`, `point`) VALUES
(1, 'RUSSIA', 'Plane', 1, 'Su-33', 0),
(2, 'RUSSIA', 'Plane', 1, 'Su-25', 0),
(3, 'RUSSIA', 'Plane', 1, 'MiG-29S', 0),
(4, 'RUSSIA', 'Plane', 1, 'MiG-29A', 0),
(5, 'RUSSIA', 'Plane', 1, 'Su-27', 0),
(6, 'RUSSIA', 'Plane', 1, 'Su-25TM', 0),
(7, 'RUSSIA', 'Plane', 1, 'Su-25T', 0),
(8, 'RUSSIA', 'Plane', 1, 'MiG-31', 0),
(9, 'RUSSIA', 'Plane', 1, 'MiG-27K', 0),
(10, 'RUSSIA', 'Plane', 1, 'Su-30', 0),
(11, 'RUSSIA', 'Plane', 1, 'Tu-160', 0),
(12, 'RUSSIA', 'Plane', 1, 'Su-34', 0),
(13, 'RUSSIA', 'Plane', 1, 'Tu-95MS', 0),
(14, 'RUSSIA', 'Plane', 1, 'Tu-142', 0),
(15, 'RUSSIA', 'Plane', 1, 'MiG-25PD', 0),
(16, 'RUSSIA', 'Plane', 1, 'Tu-22M3', 0),
(17, 'RUSSIA', 'Plane', 1, 'A-50', 0),
(18, 'RUSSIA', 'Plane', 1, 'Yak-40', 0),
(19, 'RUSSIA', 'Plane', 1, 'An-26B', 0),
(20, 'RUSSIA', 'Plane', 1, 'An-30M', 0),
(21, 'RUSSIA', 'Plane', 1, 'Su-17M4', 0),
(22, 'RUSSIA', 'Plane', 1, 'MiG-23MLD', 0),
(23, 'RUSSIA', 'Plane', 1, 'MiG-25RBT', 0),
(24, 'RUSSIA', 'Plane', 1, 'Su-24M', 0),
(25, 'RUSSIA', 'Plane', 1, 'Su-24MR', 0),
(26, 'RUSSIA', 'Plane', 1, 'IL-78M', 0),
(27, 'RUSSIA', 'Plane', 1, 'IL-76MD', 0),
(28, 'RUSSIA', 'Plane', 1, 'L-39ZA', 0),
(29, 'RUSSIA', 'Plane', 1, 'P-51D', 0),
(30, 'RUSSIA', 'Ship', 3, 'KUZNECOW', 0),
(31, 'RUSSIA', 'Ship', 3, 'MOSCOW', 0),
(32, 'RUSSIA', 'Ship', 3, 'PIOTR', 0),
(33, 'RUSSIA', 'Ship', 3, 'ELNYA', 0),
(34, 'RUSSIA', 'Ship', 3, 'ALBATROS', 0),
(35, 'RUSSIA', 'Ship', 3, 'REZKY', 0),
(36, 'RUSSIA', 'Ship', 3, 'MOLNIYA', 0),
(37, 'RUSSIA', 'Ship', 3, 'KILO', 0),
(38, 'RUSSIA', 'Ship', 3, 'SOM', 0),
(39, 'RUSSIA', 'Ship', 3, 'ZWEZDNY', 0),
(40, 'RUSSIA', 'Ship', 3, 'NEUSTRASH', 0),
(41, 'RUSSIA', 'Ship', 3, 'Dry-Cargo Ship-1', 0),
(42, 'RUSSIA', 'Ship', 3, 'Dry-Cargo Ship-2', 0),
(43, 'RUSSIA', 'Car', 4, 'BTR-80', 0),
(44, 'RUSSIA', 'Car', 6, '1L13 EWR', 0),
(45, 'RUSSIA', 'Car', 6, '55G6 EWR', 0),
(46, 'RUSSIA', 'Car', 6, 'S-300PS 40B6M tr', 0),
(47, 'RUSSIA', 'Car', 6, 'S-300PS 40B6MD sr', 0),
(48, 'RUSSIA', 'Car', 6, 'S-300PS 64H6E sr', 0),
(49, 'RUSSIA', 'Car', 6, 'S-300PS 5P85C ln', 0),
(50, 'RUSSIA', 'Car', 6, 'S-300PS 5P85D ln', 0),
(51, 'RUSSIA', 'Car', 6, 'SA-11 Buk SR 9S18M1', 0),
(52, 'RUSSIA', 'Car', 6, 'SA-11 Buk CC 9S470M1', 0),
(53, 'RUSSIA', 'Car', 6, 'SA-11 Buk LN 9A310M1', 0),
(54, 'RUSSIA', 'Car', 6, 'Kub 1S91 str', 0),
(55, 'RUSSIA', 'Car', 6, 'Kub 2P25 ln', 0),
(56, 'RUSSIA', 'Car', 6, 'Osa 9A33 ln', 0),
(57, 'RUSSIA', 'Car', 6, 'Strela-1 9P31', 0),
(58, 'RUSSIA', 'Car', 6, 'Strela-10M3', 0),
(59, 'RUSSIA', 'Car', 6, 'Dog Ear radar', 0),
(60, 'RUSSIA', 'Car', 6, 'Tor 9A331', 0),
(61, 'RUSSIA', 'Car', 6, '2S6 Tunguska', 0),
(62, 'RUSSIA', 'Car', 6, 'ZSU-23-4 Shilka', 0),
(63, 'RUSSIA', 'Car', 5, 'SAU Msta', 0),
(64, 'RUSSIA', 'Car', 5, 'SAU Akatsia', 0),
(65, 'RUSSIA', 'Car', 5, 'SAU 2-C9', 0),
(66, 'RUSSIA', 'Car', 7, 'ATMZ-5', 0),
(67, 'RUSSIA', 'Car', 7, 'ATZ-10', 0),
(68, 'RUSSIA', 'Car', 4, 'BMD-1', 0),
(69, 'RUSSIA', 'Car', 4, 'BMP-1', 0),
(70, 'RUSSIA', 'Car', 4, 'BMP-2', 0),
(71, 'RUSSIA', 'Car', 4, 'BRDM-2', 0),
(72, 'RUSSIA', 'Car', 5, 'Grad-URAL', 0),
(73, 'RUSSIA', 'Car', 5, 'Smerch', 0),
(74, 'RUSSIA', 'Car', 4, 'T-80UD', 0),
(75, 'RUSSIA', 'Car', 7, 'UAZ-469', 0),
(76, 'RUSSIA', 'Car', 7, 'Ural-375', 0),
(77, 'RUSSIA', 'Car', 7, 'Ural-375 PBU', 0),
(78, 'RUSSIA', 'Car', 7, 'IKARUS Bus', 0),
(79, 'RUSSIA', 'Car', 7, 'VAZ Car', 0),
(80, 'RUSSIA', 'Car', 7, 'Trolley bus', 0),
(81, 'RUSSIA', 'Car', 7, 'KAMAZ Truck', 0),
(82, 'RUSSIA', 'Car', 7, 'LAZ Bus', 0),
(83, 'RUSSIA', 'Car', 5, 'SAU Gvozdika', 0),
(84, 'RUSSIA', 'Car', 4, 'BMP-3', 0),
(85, 'RUSSIA', 'Car', 4, 'BTR_D', 0),
(86, 'RUSSIA', 'Car', 6, 'S-300PS 54K6 cp', 0),
(87, 'RUSSIA', 'Car', 7, 'GAZ-3307', 0),
(88, 'RUSSIA', 'Car', 7, 'GAZ-66', 0),
(89, 'RUSSIA', 'Car', 7, 'GAZ-3308', 0),
(90, 'RUSSIA', 'Car', 7, 'MAZ-6303', 0),
(91, 'RUSSIA', 'Car', 7, 'ZIL-4331', 0),
(92, 'RUSSIA', 'Car', 7, 'SKP-11', 0),
(93, 'RUSSIA', 'Car', 7, 'Ural-4320T', 0),
(94, 'RUSSIA', 'Car', 7, 'Ural-4320-31', 0),
(95, 'RUSSIA', 'Car', 7, 'Ural ATsP-6', 0),
(96, 'RUSSIA', 'Car', 7, 'ZiL-131 APA-80', 0),
(97, 'RUSSIA', 'Car', 7, 'ZIL-131 KUNG', 0),
(98, 'RUSSIA', 'Car', 7, 'Ural-375 APA-50', 0),
(99, 'RUSSIA', 'Car', 6, 'ZU-23 Emplacement', 0),
(100, 'RUSSIA', 'Car', 6, 'ZU-23 Emplacement Closed', 0),
(101, 'RUSSIA', 'Car', 6, 'Ural-375 ZU-23', 0),
(102, 'RUSSIA', 'Car', 4, 'MTLB', 0),
(103, 'RUSSIA', 'Car', 4, 'T-72B', 0),
(104, 'RUSSIA', 'Car', 6, 'SA-18 Igla-S manpad', 0),
(105, 'RUSSIA', 'Car', 6, 'SA-18 Igla-S comm', 0),
(106, 'RUSSIA', 'Car', 4, 'T-55', 0),
(107, 'RUSSIA', 'Car', 8, 'Paratrooper RPG-16', 0),
(108, 'RUSSIA', 'Car', 8, 'Paratrooper AKS-74', 0),
(109, 'RUSSIA', 'Car', 4, 'Boman', 0),
(110, 'RUSSIA', 'Car', 5, '2B11 mortar', 0),
(111, 'RUSSIA', 'Car', 6, '5p73 s-125 ln', 0),
(112, 'RUSSIA', 'Car', 6, 'snr s-125 tr', 0),
(113, 'RUSSIA', 'Car', 6, 'p-19 s-125 sr', 0),
(114, 'RUSSIA', 'Car', 8, 'Infantry AK', 0),
(115, 'RUSSIA', 'Car', 4, 'T-90', 0),
(116, 'RUSSIA', 'Helicopter', 2, 'Mi-24V', 0),
(117, 'RUSSIA', 'Helicopter', 2, 'Mi-8MT', 0),
(118, 'RUSSIA', 'Helicopter', 2, 'Mi-26', 0),
(119, 'RUSSIA', 'Helicopter', 2, 'Ka-27', 0),
(120, 'RUSSIA', 'Helicopter', 2, 'Mi-28N', 0),
(121, 'RUSSIA', 'Helicopter', 2, 'UH-1H', 0),
(218, 'USA', 'Plane', 1, 'A-10A', 0),
(219, 'USA', 'Plane', 1, 'F-117A', 0),
(220, 'USA', 'Plane', 1, 'C-17A', 0),
(221, 'USA', 'Plane', 1, 'F-15C', 0),
(222, 'USA', 'Plane', 1, 'F-15E', 0),
(223, 'USA', 'Plane', 1, 'F-16C bl.52d', 0),
(224, 'USA', 'Plane', 1, 'B-1B', 0),
(225, 'USA', 'Plane', 1, 'B-52H', 0),
(226, 'USA', 'Plane', 1, 'E-3A', 0),
(227, 'USA', 'Plane', 1, 'KC-135', 0),
(228, 'USA', 'Plane', 1, 'C-130', 0),
(229, 'USA', 'Plane', 1, 'F-14A', 0),
(230, 'USA', 'Plane', 1, 'S-3B', 0),
(231, 'USA', 'Plane', 1, 'S-3B Tanker', 0),
(232, 'USA', 'Plane', 1, 'F/A-18C', 0),
(233, 'USA', 'Plane', 1, 'E-2C', 0),
(234, 'USA', 'Plane', 1, 'F-16A', 0),
(235, 'USA', 'Plane', 1, 'F-5E', 0),
(236, 'USA', 'Plane', 1, 'RQ-1A Predator', 0),
(238, 'USA', 'Ship', 3, 'VINSON', 0),
(239, 'USA', 'Ship', 3, 'PERRY', 0),
(240, 'USA', 'Ship', 3, 'TICONDEROG', 0),
(241, 'USA', 'Car', 4, 'M-2 Bradley', 0),
(242, 'USA', 'Car', 6, 'M1097 Avenger', 0),
(243, 'USA', 'Car', 6, 'Patriot str', 0),
(244, 'USA', 'Car', 6, 'Patriot ln', 0),
(245, 'USA', 'Car', 6, 'Patriot AMG', 0),
(246, 'USA', 'Car', 6, 'Patriot EPP', 0),
(247, 'USA', 'Car', 6, 'Patriot ECS', 0),
(248, 'USA', 'Car', 6, 'Patriot cp', 0),
(249, 'USA', 'Car', 6, 'Hawk sr', 0),
(250, 'USA', 'Car', 6, 'Hawk tr', 0),
(251, 'USA', 'Car', 6, 'Hawk ln', 0),
(252, 'USA', 'Car', 6, 'Vulcan', 0),
(253, 'USA', 'Car', 4, 'Hummer', 0),
(254, 'USA', 'Car', 4, 'LAV-25', 0),
(255, 'USA', 'Car', 4, 'AAV7', 0),
(256, 'USA', 'Car', 4, 'M-113', 0),
(257, 'USA', 'Car', 5, 'M-109', 0),
(258, 'USA', 'Car', 4, 'M-1 Abrams', 0),
(259, 'USA', 'Car', 5, 'MLRS', 0),
(260, 'USA', 'Car', 7, 'M 818', 0),
(261, 'USA', 'Car', 6, 'M48 Chaparral', 0),
(262, 'USA', 'Car', 4, 'M1126 Stryker ICV', 0),
(263, 'USA', 'Car', 4, 'M1128 Stryker MGS', 0),
(264, 'USA', 'Car', 4, 'M1134 Stryker ATGM', 0),
(265, 'USA', 'Car', 6, 'M6 Linebacker', 0),
(266, 'USA', 'Car', 6, 'Stinger manpad', 0),
(267, 'USA', 'Car', 6, 'Stinger comm', 0),
(268, 'USA', 'Car', 1, 'Predator GCS', 0),
(269, 'USA', 'Car', 1, 'Predator TrojanSpirit', 0),
(270, 'USA', 'Car', 4, 'M1043 HMMWV Armament', 0),
(271, 'USA', 'Car', 4, 'M1045 HMMWV TOW', 0),
(272, 'USA', 'Car', 7, 'M978 HEMTT Tanker', 0),
(273, 'USA', 'Car', 7, 'HEMTT TFFT', 0),
(274, 'USA', 'Car', 8, 'Soldier M4', 0),
(275, 'USA', 'Car', 8, 'Soldier M249', 0),
(277, 'USA', 'Helicopter', 2, 'AH-64A', 0),
(278, 'USA', 'Helicopter', 2, 'AH-64D', 0),
(279, 'USA', 'Helicopter', 2, 'AH-1W', 0),
(280, 'USA', 'Helicopter', 2, 'UH-60A', 0),
(281, 'USA', 'Helicopter', 2, 'CH-47D', 0),
(282, 'USA', 'Helicopter', 2, 'SH-60B', 0),
(283, 'USA', 'Helicopter', 2, 'CH-53E', 0),
(284, 'USA', 'Helicopter', 2, 'OH-58D', 0),
(286, 'TURKEY', 'Plane', 1, 'F-16C bl.50', 0),
(287, 'TURKEY', 'Plane', 1, 'F-4E', 0),
(298, 'TURKEY', 'Car', 4, 'M-60', 0),
(310, 'TURKEY', 'Car', 4, 'Leopard1A3', 0),
(315, 'GERMANY', 'Plane', 1, 'MiG-29G', 0),
(317, 'GERMANY', 'Plane', 1, 'Tornado IDS', 0),
(329, 'GERMANY', 'Car', 6, 'Roland ADS', 0),
(330, 'GERMANY', 'Car', 6, 'Roland Radar', 0),
(331, 'GERMANY', 'Car', 6, 'Gepard', 0),
(333, 'GERMANY', 'Car', 4, 'Leopard-2', 0),
(335, 'GERMANY', 'Car', 4, 'Marder', 0),
(336, 'GERMANY', 'Car', 4, 'TPZ', 0),
(358, 'GERMANY', 'Plane', 1, 'Tornado GR4', 0),
(361, 'GERMANY', 'Car', 4, 'MCV-80', 0),
(362, 'GERMANY', 'Car', 4, 'Challenger2', 0),
(370, 'GERMANY', 'Plane', 1, 'Mirage 2000-5', 0),
(373, 'GERMANY', 'Car', 4, 'Leclerc', 0),
(396, 'THE NETHERLANDS', 'Plane', 1, 'F-16A MLU', 0),
(516, 'GEORGIA', 'Car', 6, 'SA-18 Igla manpad', 0),
(517, 'GEORGIA', 'Car', 6, 'SA-18 Igla comm', 0),
(521, 'GEORGIA', 'Car', 8, 'Soldier AK', 0),
(522, 'GEORGIA', 'Car', 8, 'Soldier RPG', 0),
(557, 'ISRAEL', 'Car', 6, 'Stinger manpad dsr', 0),
(558, 'ISRAEL', 'Car', 6, 'Stinger comm dsr', 0),
(595, 'INSURGENTS', 'Car', 6, 'ZU-23 Insurgent', 0),
(596, 'INSURGENTS', 'Car', 6, 'ZU-23 Closed Insurgent', 0),
(597, 'INSURGENTS', 'Car', 6, 'Ural-375 ZU-23 Insurgent', 0),
(673, 'ABKHAZIA', 'Helicopter', 2, 'Ka-50', 0);
