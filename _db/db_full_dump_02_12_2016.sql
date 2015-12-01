-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 01, 2015 at 10:23 PM
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
-- Table structure for table `dcs_best_streaks`
--

CREATE TABLE IF NOT EXISTS `dcs_best_streaks` (
  `pilot_id` int(11) unsigned NOT NULL,
  `streak` int(11) unsigned NOT NULL,
  UNIQUE KEY `ix_dcs_best_streaks` (`pilot_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dcs_blueteam`
--

CREATE TABLE IF NOT EXISTS `dcs_blueteam` (
  `pilot_id` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `plane` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `pilot_id` (`pilot_id`),
  UNIQUE KEY `pilot_id_3` (`pilot_id`),
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
  UNIQUE KEY `pilot_id_3` (`pilot_id`),
  KEY `pilot_id_2` (`pilot_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dcs_spectators`
--

CREATE TABLE IF NOT EXISTS `dcs_spectators` (
  `pilot_id` int(11) NOT NULL,
  `data` datetime NOT NULL,
  UNIQUE KEY `pilot_id` (`pilot_id`),
  UNIQUE KEY `pilot_id_2` (`pilot_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dcs_temporary_streaks`
--

CREATE TABLE IF NOT EXISTS `dcs_temporary_streaks` (
  `pilot_id` int(11) unsigned NOT NULL,
  `streak` int(11) NOT NULL DEFAULT '1',
  KEY `ix_dcs_temporary_streaks` (`pilot_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dcs_temporary_streaks`
--

INSERT INTO `dcs_temporary_streaks` (`pilot_id`, `streak`) VALUES
(8, 1),
(8, 1),
(8, 1);

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
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `category` (`category`),
  KEY `ix_name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=744 ;

--
-- Dumping data for table `dcs_units`
--

INSERT INTO `dcs_units` (`id`, `country`, `type_unit`, `category`, `name`) VALUES
(1, 'RUSSIA', 'Plane', 1, 'Su-33'),
(2, 'RUSSIA', 'Plane', 1, 'Su-25'),
(3, 'RUSSIA', 'Plane', 1, 'MiG-29S'),
(4, 'RUSSIA', 'Plane', 1, 'MiG-29A'),
(5, 'RUSSIA', 'Plane', 1, 'Su-27'),
(6, 'RUSSIA', 'Plane', 1, 'Su-25TM'),
(7, 'RUSSIA', 'Plane', 1, 'Su-25T'),
(8, 'RUSSIA', 'Plane', 1, 'MiG-31'),
(9, 'RUSSIA', 'Plane', 1, 'MiG-27K'),
(10, 'RUSSIA', 'Plane', 1, 'Su-30'),
(11, 'RUSSIA', 'Plane', 1, 'Tu-160'),
(12, 'RUSSIA', 'Plane', 1, 'Su-34'),
(13, 'RUSSIA', 'Plane', 1, 'Tu-95MS'),
(14, 'RUSSIA', 'Plane', 1, 'Tu-142'),
(15, 'RUSSIA', 'Plane', 1, 'MiG-25PD'),
(16, 'RUSSIA', 'Plane', 1, 'Tu-22M3'),
(17, 'RUSSIA', 'Plane', 1, 'A-50'),
(18, 'RUSSIA', 'Plane', 1, 'Yak-40'),
(19, 'RUSSIA', 'Plane', 1, 'An-26B'),
(20, 'RUSSIA', 'Plane', 1, 'An-30M'),
(21, 'RUSSIA', 'Plane', 1, 'Su-17M4'),
(22, 'RUSSIA', 'Plane', 1, 'MiG-23MLD'),
(23, 'RUSSIA', 'Plane', 1, 'MiG-25RBT'),
(24, 'RUSSIA', 'Plane', 1, 'Su-24M'),
(25, 'RUSSIA', 'Plane', 1, 'Su-24MR'),
(26, 'RUSSIA', 'Plane', 1, 'IL-78M'),
(27, 'RUSSIA', 'Plane', 1, 'IL-76MD'),
(28, 'RUSSIA', 'Plane', 1, 'L-39ZA'),
(29, 'RUSSIA', 'Plane', 1, 'P-51D'),
(30, 'RUSSIA', 'Ship', 3, 'KUZNECOW'),
(31, 'RUSSIA', 'Ship', 3, 'MOSCOW'),
(32, 'RUSSIA', 'Ship', 3, 'PIOTR'),
(33, 'RUSSIA', 'Ship', 3, 'ELNYA'),
(34, 'RUSSIA', 'Ship', 3, 'ALBATROS'),
(35, 'RUSSIA', 'Ship', 3, 'REZKY'),
(36, 'RUSSIA', 'Ship', 3, 'MOLNIYA'),
(37, 'RUSSIA', 'Ship', 3, 'KILO'),
(38, 'RUSSIA', 'Ship', 3, 'SOM'),
(39, 'RUSSIA', 'Ship', 3, 'ZWEZDNY'),
(40, 'RUSSIA', 'Ship', 3, 'NEUSTRASH'),
(41, 'RUSSIA', 'Ship', 3, 'Dry-Cargo Ship-1'),
(42, 'RUSSIA', 'Ship', 3, 'Dry-Cargo Ship-2'),
(43, 'RUSSIA', 'Car', 4, 'BTR-80'),
(44, 'RUSSIA', 'Car', 6, '1L13 EWR'),
(45, 'RUSSIA', 'Car', 6, '55G6 EWR'),
(46, 'RUSSIA', 'Car', 6, 'S-300PS 40B6M tr'),
(47, 'RUSSIA', 'Car', 6, 'S-300PS 40B6MD sr'),
(48, 'RUSSIA', 'Car', 6, 'S-300PS 64H6E sr'),
(49, 'RUSSIA', 'Car', 6, 'S-300PS 5P85C ln'),
(50, 'RUSSIA', 'Car', 6, 'S-300PS 5P85D ln'),
(51, 'RUSSIA', 'Car', 6, 'SA-11 Buk SR 9S18M1'),
(52, 'RUSSIA', 'Car', 6, 'SA-11 Buk CC 9S470M1'),
(53, 'RUSSIA', 'Car', 6, 'SA-11 Buk LN 9A310M1'),
(54, 'RUSSIA', 'Car', 6, 'Kub 1S91 str'),
(55, 'RUSSIA', 'Car', 6, 'Kub 2P25 ln'),
(56, 'RUSSIA', 'Car', 6, 'Osa 9A33 ln'),
(57, 'RUSSIA', 'Car', 6, 'Strela-1 9P31'),
(58, 'RUSSIA', 'Car', 6, 'Strela-10M3'),
(59, 'RUSSIA', 'Car', 6, 'Dog Ear radar'),
(60, 'RUSSIA', 'Car', 6, 'Tor 9A331'),
(61, 'RUSSIA', 'Car', 6, '2S6 Tunguska'),
(62, 'RUSSIA', 'Car', 6, 'ZSU-23-4 Shilka'),
(63, 'RUSSIA', 'Car', 5, 'SAU Msta'),
(64, 'RUSSIA', 'Car', 5, 'SAU Akatsia'),
(65, 'RUSSIA', 'Car', 5, 'SAU 2-C9'),
(66, 'RUSSIA', 'Car', 7, 'ATMZ-5'),
(67, 'RUSSIA', 'Car', 7, 'ATZ-10'),
(68, 'RUSSIA', 'Car', 4, 'BMD-1'),
(69, 'RUSSIA', 'Car', 4, 'BMP-1'),
(70, 'RUSSIA', 'Car', 4, 'BMP-2'),
(71, 'RUSSIA', 'Car', 4, 'BRDM-2'),
(72, 'RUSSIA', 'Car', 5, 'Grad-URAL'),
(73, 'RUSSIA', 'Car', 5, 'Smerch'),
(74, 'RUSSIA', 'Car', 4, 'T-80UD'),
(75, 'RUSSIA', 'Car', 7, 'UAZ-469'),
(76, 'RUSSIA', 'Car', 7, 'Ural-375'),
(77, 'RUSSIA', 'Car', 7, 'Ural-375 PBU'),
(78, 'RUSSIA', 'Car', 7, 'IKARUS Bus'),
(79, 'RUSSIA', 'Car', 7, 'VAZ Car'),
(80, 'RUSSIA', 'Car', 7, 'Trolley bus'),
(81, 'RUSSIA', 'Car', 7, 'KAMAZ Truck'),
(82, 'RUSSIA', 'Car', 7, 'LAZ Bus'),
(83, 'RUSSIA', 'Car', 5, 'SAU Gvozdika'),
(84, 'RUSSIA', 'Car', 4, 'BMP-3'),
(85, 'RUSSIA', 'Car', 4, 'BTR_D'),
(86, 'RUSSIA', 'Car', 6, 'S-300PS 54K6 cp'),
(87, 'RUSSIA', 'Car', 7, 'GAZ-3307'),
(88, 'RUSSIA', 'Car', 7, 'GAZ-66'),
(89, 'RUSSIA', 'Car', 7, 'GAZ-3308'),
(90, 'RUSSIA', 'Car', 7, 'MAZ-6303'),
(91, 'RUSSIA', 'Car', 7, 'ZIL-4331'),
(92, 'RUSSIA', 'Car', 7, 'SKP-11'),
(93, 'RUSSIA', 'Car', 7, 'Ural-4320T'),
(94, 'RUSSIA', 'Car', 7, 'Ural-4320-31'),
(95, 'RUSSIA', 'Car', 7, 'Ural ATsP-6'),
(96, 'RUSSIA', 'Car', 7, 'ZiL-131 APA-80'),
(97, 'RUSSIA', 'Car', 7, 'ZIL-131 KUNG'),
(98, 'RUSSIA', 'Car', 7, 'Ural-375 APA-50'),
(99, 'RUSSIA', 'Car', 6, 'ZU-23 Emplacement'),
(100, 'RUSSIA', 'Car', 6, 'ZU-23 Emplacement Closed'),
(101, 'RUSSIA', 'Car', 6, 'Ural-375 ZU-23'),
(102, 'RUSSIA', 'Car', 4, 'MTLB'),
(103, 'RUSSIA', 'Car', 4, 'T-72B'),
(104, 'RUSSIA', 'Car', 6, 'SA-18 Igla-S manpad'),
(105, 'RUSSIA', 'Car', 6, 'SA-18 Igla-S comm'),
(106, 'RUSSIA', 'Car', 4, 'T-55'),
(107, 'RUSSIA', 'Car', 8, 'Paratrooper RPG-16'),
(108, 'RUSSIA', 'Car', 8, 'Paratrooper AKS-74'),
(109, 'RUSSIA', 'Car', 4, 'Boman'),
(110, 'RUSSIA', 'Car', 5, '2B11 mortar'),
(111, 'RUSSIA', 'Car', 6, '5p73 s-125 ln'),
(112, 'RUSSIA', 'Car', 6, 'snr s-125 tr'),
(113, 'RUSSIA', 'Car', 6, 'p-19 s-125 sr'),
(114, 'RUSSIA', 'Car', 8, 'Infantry AK'),
(115, 'RUSSIA', 'Car', 4, 'T-90'),
(116, 'RUSSIA', 'Helicopter', 2, 'Mi-24V'),
(117, 'RUSSIA', 'Helicopter', 2, 'Mi-8MT'),
(118, 'RUSSIA', 'Helicopter', 2, 'Mi-26'),
(119, 'RUSSIA', 'Helicopter', 2, 'Ka-27'),
(120, 'RUSSIA', 'Helicopter', 2, 'Mi-28N'),
(121, 'RUSSIA', 'Helicopter', 2, 'UH-1H'),
(122, 'RUSSIA', 'Plane', 1, 'Su-27'),
(123, 'RUSSIA', 'Plane', 1, 'MiG-29A'),
(124, 'RUSSIA', 'Plane', 1, 'MiG-29S'),
(125, 'RUSSIA', 'Plane', 1, 'Su-17M4'),
(126, 'RUSSIA', 'Plane', 1, 'Tu-95MS'),
(127, 'RUSSIA', 'Plane', 1, 'Su-24M'),
(128, 'RUSSIA', 'Plane', 1, 'Su-24MR'),
(129, 'RUSSIA', 'Plane', 1, 'Su-25'),
(130, 'RUSSIA', 'Plane', 1, 'MiG-25PD'),
(131, 'RUSSIA', 'Plane', 1, 'An-26B'),
(132, 'RUSSIA', 'Plane', 1, 'An-30M'),
(133, 'RUSSIA', 'Plane', 1, 'MiG-23MLD'),
(134, 'RUSSIA', 'Plane', 1, 'IL-78M'),
(135, 'RUSSIA', 'Plane', 1, 'IL-76MD'),
(136, 'RUSSIA', 'Plane', 1, 'MiG-27K'),
(137, 'RUSSIA', 'Plane', 1, 'Tu-22M3'),
(138, 'RUSSIA', 'Plane', 1, 'MiG-25RBT'),
(139, 'RUSSIA', 'Plane', 1, 'Yak-40'),
(140, 'RUSSIA', 'Plane', 1, 'L-39ZA'),
(141, 'RUSSIA', 'Plane', 1, 'P-51D'),
(142, 'RUSSIA', 'Ship', 3, 'ELNYA'),
(143, 'RUSSIA', 'Ship', 3, 'ALBATROS'),
(144, 'RUSSIA', 'Ship', 3, 'MOLNIYA'),
(145, 'RUSSIA', 'Ship', 3, 'KILO'),
(146, 'RUSSIA', 'Ship', 3, 'ZWEZDNY'),
(147, 'RUSSIA', 'Ship', 3, 'Dry-Cargo Ship-1'),
(148, 'RUSSIA', 'Ship', 3, 'Dry-Cargo Ship-2'),
(149, 'RUSSIA', 'Ship', 3, 'REZKY'),
(150, 'RUSSIA', 'Car', 4, 'BTR-80'),
(151, 'RUSSIA', 'Car', 6, '1L13 EWR'),
(152, 'RUSSIA', 'Car', 6, '55G6 EWR'),
(153, 'RUSSIA', 'Car', 6, 'S-300PS 40B6M tr'),
(154, 'RUSSIA', 'Car', 6, 'S-300PS 40B6MD sr'),
(155, 'RUSSIA', 'Car', 6, 'S-300PS 64H6E sr'),
(156, 'RUSSIA', 'Car', 6, 'S-300PS 5P85C ln'),
(157, 'RUSSIA', 'Car', 6, 'S-300PS 5P85D ln'),
(158, 'RUSSIA', 'Car', 6, 'SA-11 Buk SR 9S18M1'),
(159, 'RUSSIA', 'Car', 6, 'SA-11 Buk CC 9S470M1'),
(160, 'RUSSIA', 'Car', 6, 'SA-11 Buk LN 9A310M1'),
(161, 'RUSSIA', 'Car', 6, 'Kub 1S91 str'),
(162, 'RUSSIA', 'Car', 6, 'Kub 2P25 ln'),
(163, 'RUSSIA', 'Car', 6, 'Osa 9A33 ln'),
(164, 'RUSSIA', 'Car', 6, 'Strela-10M3'),
(165, 'RUSSIA', 'Car', 6, 'Dog Ear radar'),
(166, 'RUSSIA', 'Car', 6, 'Tor 9A331'),
(167, 'RUSSIA', 'Car', 6, 'ZSU-23-4 Shilka'),
(168, 'RUSSIA', 'Car', 5, 'SAU Msta'),
(169, 'RUSSIA', 'Car', 5, 'SAU Akatsia'),
(170, 'RUSSIA', 'Car', 5, 'SAU 2-C9'),
(171, 'RUSSIA', 'Car', 7, 'ATMZ-5'),
(172, 'RUSSIA', 'Car', 7, 'ATZ-10'),
(173, 'RUSSIA', 'Car', 4, 'BMD-1'),
(174, 'RUSSIA', 'Car', 4, 'BMP-1'),
(175, 'RUSSIA', 'Car', 4, 'BMP-2'),
(176, 'RUSSIA', 'Car', 4, 'BRDM-2'),
(177, 'RUSSIA', 'Car', 5, 'Grad-URAL'),
(178, 'RUSSIA', 'Car', 4, 'T-80UD'),
(179, 'RUSSIA', 'Car', 7, 'UAZ-469'),
(180, 'RUSSIA', 'Car', 7, 'Ural-375'),
(181, 'RUSSIA', 'Car', 7, 'Ural-375 PBU'),
(182, 'RUSSIA', 'Car', 7, 'IKARUS Bus'),
(183, 'RUSSIA', 'Car', 7, 'VAZ Car'),
(184, 'RUSSIA', 'Car', 7, 'Trolley bus'),
(185, 'RUSSIA', 'Car', 7, 'KAMAZ Truck'),
(186, 'RUSSIA', 'Car', 7, 'LAZ Bus'),
(187, 'RUSSIA', 'Car', 5, 'SAU Gvozdika'),
(188, 'RUSSIA', 'Car', 4, 'BTR_D'),
(189, 'RUSSIA', 'Car', 6, 'S-300PS 54K6 cp'),
(190, 'RUSSIA', 'Car', 7, 'GAZ-3307'),
(191, 'RUSSIA', 'Car', 7, 'GAZ-3308'),
(192, 'RUSSIA', 'Car', 7, 'GAZ-66'),
(193, 'RUSSIA', 'Car', 7, 'ZIL-4331'),
(194, 'RUSSIA', 'Car', 7, 'MAZ-6303'),
(195, 'RUSSIA', 'Car', 7, 'SKP-11'),
(196, 'RUSSIA', 'Car', 7, 'Ural-4320T'),
(197, 'RUSSIA', 'Car', 7, 'Ural ATsP-6'),
(198, 'RUSSIA', 'Car', 7, 'ZiL-131 APA-80'),
(199, 'RUSSIA', 'Car', 7, 'ZIL-131 KUNG'),
(200, 'RUSSIA', 'Car', 7, 'Ural-375 APA-50'),
(201, 'RUSSIA', 'Car', 6, 'ZU-23 Emplacement'),
(202, 'RUSSIA', 'Car', 6, 'ZU-23 Emplacement Closed'),
(203, 'RUSSIA', 'Car', 6, 'Ural-375 ZU-23'),
(204, 'RUSSIA', 'Car', 6, '2S6 Tunguska'),
(205, 'RUSSIA', 'Car', 5, 'Smerch'),
(206, 'RUSSIA', 'Car', 6, 'Strela-1 9P31'),
(207, 'RUSSIA', 'Car', 4, 'MTLB'),
(208, 'RUSSIA', 'Car', 4, 'T-72B'),
(209, 'RUSSIA', 'Car', 6, 'SA-18 Igla-S manpad'),
(210, 'RUSSIA', 'Car', 6, 'SA-18 Igla-S comm'),
(211, 'RUSSIA', 'Car', 4, 'T-55'),
(212, 'RUSSIA', 'Car', 5, '2B11 mortar'),
(213, 'RUSSIA', 'Helicopter', 2, 'Mi-24V'),
(214, 'RUSSIA', 'Helicopter', 2, 'Mi-8MT'),
(215, 'RUSSIA', 'Helicopter', 2, 'Mi-26'),
(216, 'RUSSIA', 'Helicopter', 2, 'Ka-27'),
(217, 'RUSSIA', 'Helicopter', 2, 'UH-1H'),
(218, 'USA', 'Plane', 1, 'A-10A'),
(219, 'USA', 'Plane', 1, 'F-117A'),
(220, 'USA', 'Plane', 1, 'C-17A'),
(221, 'USA', 'Plane', 1, 'F-15C'),
(222, 'USA', 'Plane', 1, 'F-15E'),
(223, 'USA', 'Plane', 1, 'F-16C bl.52d'),
(224, 'USA', 'Plane', 1, 'B-1B'),
(225, 'USA', 'Plane', 1, 'B-52H'),
(226, 'USA', 'Plane', 1, 'E-3A'),
(227, 'USA', 'Plane', 1, 'KC-135'),
(228, 'USA', 'Plane', 1, 'C-130'),
(229, 'USA', 'Plane', 1, 'F-14A'),
(230, 'USA', 'Plane', 1, 'S-3B'),
(231, 'USA', 'Plane', 1, 'S-3B Tanker'),
(232, 'USA', 'Plane', 1, 'F/A-18C'),
(233, 'USA', 'Plane', 1, 'E-2C'),
(234, 'USA', 'Plane', 1, 'F-16A'),
(235, 'USA', 'Plane', 1, 'F-5E'),
(236, 'USA', 'Plane', 1, 'RQ-1A Predator'),
(237, 'USA', 'Plane', 1, 'P-51D'),
(238, 'USA', 'Ship', 3, 'VINSON'),
(239, 'USA', 'Ship', 3, 'PERRY'),
(240, 'USA', 'Ship', 3, 'TICONDEROG'),
(241, 'USA', 'Car', 4, 'M-2 Bradley'),
(242, 'USA', 'Car', 6, 'M1097 Avenger'),
(243, 'USA', 'Car', 6, 'Patriot str'),
(244, 'USA', 'Car', 6, 'Patriot ln'),
(245, 'USA', 'Car', 6, 'Patriot AMG'),
(246, 'USA', 'Car', 6, 'Patriot EPP'),
(247, 'USA', 'Car', 6, 'Patriot ECS'),
(248, 'USA', 'Car', 6, 'Patriot cp'),
(249, 'USA', 'Car', 6, 'Hawk sr'),
(250, 'USA', 'Car', 6, 'Hawk tr'),
(251, 'USA', 'Car', 6, 'Hawk ln'),
(252, 'USA', 'Car', 6, 'Vulcan'),
(253, 'USA', 'Car', 4, 'Hummer'),
(254, 'USA', 'Car', 4, 'LAV-25'),
(255, 'USA', 'Car', 4, 'AAV7'),
(256, 'USA', 'Car', 4, 'M-113'),
(257, 'USA', 'Car', 5, 'M-109'),
(258, 'USA', 'Car', 4, 'M-1 Abrams'),
(259, 'USA', 'Car', 5, 'MLRS'),
(260, 'USA', 'Car', 7, 'M 818'),
(261, 'USA', 'Car', 6, 'M48 Chaparral'),
(262, 'USA', 'Car', 4, 'M1126 Stryker ICV'),
(263, 'USA', 'Car', 4, 'M1128 Stryker MGS'),
(264, 'USA', 'Car', 4, 'M1134 Stryker ATGM'),
(265, 'USA', 'Car', 6, 'M6 Linebacker'),
(266, 'USA', 'Car', 6, 'Stinger manpad'),
(267, 'USA', 'Car', 6, 'Stinger comm'),
(268, 'USA', 'Car', 1, 'Predator GCS'),
(269, 'USA', 'Car', 1, 'Predator TrojanSpirit'),
(270, 'USA', 'Car', 4, 'M1043 HMMWV Armament'),
(271, 'USA', 'Car', 4, 'M1045 HMMWV TOW'),
(272, 'USA', 'Car', 7, 'M978 HEMTT Tanker'),
(273, 'USA', 'Car', 7, 'HEMTT TFFT'),
(274, 'USA', 'Car', 8, 'Soldier M4'),
(275, 'USA', 'Car', 8, 'Soldier M249'),
(276, 'USA', 'Car', 5, '2B11 mortar'),
(277, 'USA', 'Helicopter', 2, 'AH-64A'),
(278, 'USA', 'Helicopter', 2, 'AH-64D'),
(279, 'USA', 'Helicopter', 2, 'AH-1W'),
(280, 'USA', 'Helicopter', 2, 'UH-60A'),
(281, 'USA', 'Helicopter', 2, 'CH-47D'),
(282, 'USA', 'Helicopter', 2, 'SH-60B'),
(283, 'USA', 'Helicopter', 2, 'CH-53E'),
(284, 'USA', 'Helicopter', 2, 'OH-58D'),
(285, 'USA', 'Helicopter', 2, 'UH-1H'),
(286, 'TURKEY', 'Plane', 1, 'F-16C bl.50'),
(287, 'TURKEY', 'Plane', 1, 'F-4E'),
(288, 'TURKEY', 'Plane', 1, 'F-5E'),
(289, 'TURKEY', 'Plane', 1, 'C-130'),
(290, 'TURKEY', 'Plane', 1, 'P-51D'),
(291, 'TURKEY', 'Ship', 3, 'PERRY'),
(292, 'TURKEY', 'Car', 4, 'M-113'),
(293, 'TURKEY', 'Car', 6, 'Hawk sr'),
(294, 'TURKEY', 'Car', 6, 'Hawk tr'),
(295, 'TURKEY', 'Car', 6, 'Hawk ln'),
(296, 'TURKEY', 'Car', 4, 'Hummer'),
(297, 'TURKEY', 'Car', 7, 'M 818'),
(298, 'TURKEY', 'Car', 4, 'M-60'),
(299, 'TURKEY', 'Car', 5, 'MLRS'),
(300, 'TURKEY', 'Car', 6, 'M1097 Avenger'),
(301, 'TURKEY', 'Car', 6, 'Vulcan'),
(302, 'TURKEY', 'Car', 5, 'M-109'),
(303, 'TURKEY', 'Car', 4, 'AAV7'),
(304, 'TURKEY', 'Car', 6, 'M48 Chaparral'),
(305, 'TURKEY', 'Car', 4, 'BTR-80'),
(306, 'TURKEY', 'Car', 6, 'Stinger manpad'),
(307, 'TURKEY', 'Car', 6, 'Stinger comm'),
(308, 'TURKEY', 'Car', 7, 'M978 HEMTT Tanker'),
(309, 'TURKEY', 'Car', 7, 'HEMTT TFFT'),
(310, 'TURKEY', 'Car', 4, 'Leopard1A3'),
(311, 'TURKEY', 'Helicopter', 2, 'UH-60A'),
(312, 'TURKEY', 'Helicopter', 2, 'Mi-8MT'),
(313, 'TURKEY', 'Helicopter', 2, 'AH-1W'),
(314, 'TURKEY', 'Helicopter', 2, 'UH-1H'),
(315, 'GERMANY', 'Plane', 1, 'MiG-29G'),
(316, 'GERMANY', 'Plane', 1, 'F-4E'),
(317, 'GERMANY', 'Plane', 1, 'Tornado IDS'),
(318, 'GERMANY', 'Plane', 1, 'P-51D'),
(319, 'GERMANY', 'Car', 4, 'M-113'),
(320, 'GERMANY', 'Car', 6, 'Patriot str'),
(321, 'GERMANY', 'Car', 6, 'Patriot ln'),
(322, 'GERMANY', 'Car', 6, 'Patriot AMG'),
(323, 'GERMANY', 'Car', 6, 'Patriot EPP'),
(324, 'GERMANY', 'Car', 6, 'Patriot ECS'),
(325, 'GERMANY', 'Car', 6, 'Patriot cp'),
(326, 'GERMANY', 'Car', 6, 'Hawk sr'),
(327, 'GERMANY', 'Car', 6, 'Hawk tr'),
(328, 'GERMANY', 'Car', 6, 'Hawk ln'),
(329, 'GERMANY', 'Car', 6, 'Roland ADS'),
(330, 'GERMANY', 'Car', 6, 'Roland Radar'),
(331, 'GERMANY', 'Car', 6, 'Gepard'),
(332, 'GERMANY', 'Car', 4, 'Hummer'),
(333, 'GERMANY', 'Car', 4, 'Leopard-2'),
(334, 'GERMANY', 'Car', 5, 'M-109'),
(335, 'GERMANY', 'Car', 4, 'Marder'),
(336, 'GERMANY', 'Car', 4, 'TPZ'),
(337, 'GERMANY', 'Car', 5, 'MLRS'),
(338, 'GERMANY', 'Car', 6, 'Stinger manpad'),
(339, 'GERMANY', 'Car', 6, 'Stinger comm'),
(340, 'GERMANY', 'Car', 7, 'M 818'),
(341, 'GERMANY', 'Car', 7, 'M978 HEMTT Tanker'),
(342, 'GERMANY', 'Car', 7, 'HEMTT TFFT'),
(343, 'GERMANY', 'Helicopter', 2, 'UH-1H'),
(344, 'GERMANY', 'Plane', 1, 'C-130'),
(345, 'GERMANY', 'Plane', 1, 'P-51D'),
(346, 'GERMANY', 'Plane', 1, 'F/A-18C'),
(347, 'GERMANY', 'Car', 4, 'M-113'),
(348, 'GERMANY', 'Car', 4, 'Hummer'),
(349, 'GERMANY', 'Car', 4, 'LAV-25'),
(350, 'GERMANY', 'Car', 5, 'M-109'),
(351, 'GERMANY', 'Car', 6, 'Stinger manpad'),
(352, 'GERMANY', 'Car', 6, 'Stinger comm'),
(353, 'GERMANY', 'Car', 7, 'M 818'),
(354, 'GERMANY', 'Car', 7, 'M978 HEMTT Tanker'),
(355, 'GERMANY', 'Car', 7, 'HEMTT TFFT'),
(356, 'GERMANY', 'Car', 4, 'Leopard1A3'),
(357, 'GERMANY', 'Helicopter', 2, 'UH-1H'),
(358, 'GERMANY', 'Plane', 1, 'Tornado GR4'),
(359, 'GERMANY', 'Plane', 1, 'C-130'),
(360, 'GERMANY', 'Plane', 1, 'P-51D'),
(361, 'GERMANY', 'Car', 4, 'MCV-80'),
(362, 'GERMANY', 'Car', 4, 'Challenger2'),
(363, 'GERMANY', 'Car', 4, 'Hummer'),
(364, 'GERMANY', 'Car', 5, 'MLRS'),
(365, 'GERMANY', 'Car', 7, 'M 818'),
(366, 'GERMANY', 'Helicopter', 2, 'AH-64A'),
(367, 'GERMANY', 'Helicopter', 2, 'AH-64D'),
(368, 'GERMANY', 'Helicopter', 2, 'CH-47D'),
(369, 'GERMANY', 'Helicopter', 2, 'UH-1H'),
(370, 'GERMANY', 'Plane', 1, 'Mirage 2000-5'),
(371, 'GERMANY', 'Plane', 1, 'C-130'),
(372, 'GERMANY', 'Plane', 1, 'P-51D'),
(373, 'GERMANY', 'Car', 4, 'Leclerc'),
(374, 'GERMANY', 'Car', 5, 'MLRS'),
(375, 'GERMANY', 'Car', 6, 'Hawk sr'),
(376, 'GERMANY', 'Car', 6, 'Hawk tr'),
(377, 'GERMANY', 'Car', 6, 'Hawk ln'),
(378, 'GERMANY', 'Car', 7, 'M 818'),
(379, 'GERMANY', 'Helicopter', 2, 'UH-1H'),
(380, 'GERMANY', 'Plane', 1, 'C-130'),
(381, 'GERMANY', 'Plane', 1, 'P-51D'),
(382, 'GERMANY', 'Plane', 1, 'F/A-18C'),
(383, 'GERMANY', 'Car', 4, 'M-113'),
(384, 'GERMANY', 'Car', 6, 'Hawk sr'),
(385, 'GERMANY', 'Car', 6, 'Hawk tr'),
(386, 'GERMANY', 'Car', 6, 'Hawk ln'),
(387, 'GERMANY', 'Car', 4, 'Hummer'),
(388, 'GERMANY', 'Car', 4, 'Leopard-2'),
(389, 'GERMANY', 'Car', 5, 'M-109'),
(390, 'GERMANY', 'Car', 6, 'Stinger manpad'),
(391, 'GERMANY', 'Car', 6, 'Stinger comm'),
(392, 'GERMANY', 'Car', 7, 'M 818'),
(393, 'GERMANY', 'Helicopter', 2, 'CH-47D'),
(394, 'GERMANY', 'Helicopter', 2, 'UH-1H'),
(395, 'THE NETHERLANDS', 'Plane', 1, 'C-130'),
(396, 'THE NETHERLANDS', 'Plane', 1, 'F-16A MLU'),
(397, 'THE NETHERLANDS', 'Plane', 1, 'P-51D'),
(398, 'THE NETHERLANDS', 'Car', 4, 'Hummer'),
(399, 'THE NETHERLANDS', 'Car', 6, 'Patriot str'),
(400, 'THE NETHERLANDS', 'Car', 6, 'Patriot ln'),
(401, 'THE NETHERLANDS', 'Car', 6, 'Patriot AMG'),
(402, 'THE NETHERLANDS', 'Car', 6, 'Patriot EPP'),
(403, 'THE NETHERLANDS', 'Car', 6, 'Patriot ECS'),
(404, 'THE NETHERLANDS', 'Car', 6, 'Patriot cp'),
(405, 'THE NETHERLANDS', 'Car', 6, 'Hawk sr'),
(406, 'THE NETHERLANDS', 'Car', 6, 'Hawk tr'),
(407, 'THE NETHERLANDS', 'Car', 6, 'Hawk ln'),
(408, 'THE NETHERLANDS', 'Car', 4, 'Leopard-2'),
(409, 'THE NETHERLANDS', 'Car', 5, 'M-109'),
(410, 'THE NETHERLANDS', 'Car', 5, 'MLRS'),
(411, 'THE NETHERLANDS', 'Car', 6, 'Stinger manpad'),
(412, 'THE NETHERLANDS', 'Car', 6, 'Stinger comm'),
(413, 'THE NETHERLANDS', 'Car', 7, 'M 818'),
(414, 'THE NETHERLANDS', 'Car', 4, 'Leopard1A3'),
(415, 'THE NETHERLANDS', 'Helicopter', 2, 'AH-64A'),
(416, 'THE NETHERLANDS', 'Helicopter', 2, 'AH-64D'),
(417, 'THE NETHERLANDS', 'Helicopter', 2, 'CH-47D'),
(418, 'THE NETHERLANDS', 'Helicopter', 2, 'UH-1H'),
(419, 'BELGIUM', 'Plane', 1, 'C-130'),
(420, 'BELGIUM', 'Plane', 1, 'F-16A MLU'),
(421, 'BELGIUM', 'Plane', 1, 'P-51D'),
(422, 'BELGIUM', 'Car', 4, 'M-113'),
(423, 'BELGIUM', 'Car', 6, 'Hawk sr'),
(424, 'BELGIUM', 'Car', 6, 'Hawk tr'),
(425, 'BELGIUM', 'Car', 6, 'Hawk ln'),
(426, 'BELGIUM', 'Car', 4, 'Hummer'),
(427, 'BELGIUM', 'Car', 5, 'M-109'),
(428, 'BELGIUM', 'Car', 6, 'Stinger manpad'),
(429, 'BELGIUM', 'Car', 6, 'Stinger comm'),
(430, 'BELGIUM', 'Car', 7, 'M 818'),
(431, 'BELGIUM', 'Helicopter', 2, 'UH-1H'),
(432, 'NORWAY', 'Plane', 1, 'C-130'),
(433, 'NORWAY', 'Plane', 1, 'F-16A MLU'),
(434, 'NORWAY', 'Plane', 1, 'P-51D'),
(435, 'NORWAY', 'Car', 4, 'M-113'),
(436, 'NORWAY', 'Car', 6, 'Hawk sr'),
(437, 'NORWAY', 'Car', 6, 'Hawk tr'),
(438, 'NORWAY', 'Car', 6, 'Hawk ln'),
(439, 'NORWAY', 'Car', 4, 'Hummer'),
(440, 'NORWAY', 'Car', 5, 'M-109'),
(441, 'NORWAY', 'Car', 5, 'MLRS'),
(442, 'NORWAY', 'Car', 6, 'Stinger manpad'),
(443, 'NORWAY', 'Car', 6, 'Stinger comm'),
(444, 'NORWAY', 'Car', 7, 'M 818'),
(445, 'NORWAY', 'Car', 4, 'Leopard1A3'),
(446, 'NORWAY', 'Helicopter', 2, 'UH-1H'),
(447, 'DENMARK', 'Plane', 1, 'C-130'),
(448, 'DENMARK', 'Plane', 1, 'F-16A MLU'),
(449, 'DENMARK', 'Plane', 1, 'P-51D'),
(450, 'DENMARK', 'Car', 4, 'M-113'),
(451, 'DENMARK', 'Car', 6, 'Hawk sr'),
(452, 'DENMARK', 'Car', 6, 'Hawk tr'),
(453, 'DENMARK', 'Car', 6, 'Hawk ln'),
(454, 'DENMARK', 'Car', 4, 'Hummer'),
(455, 'DENMARK', 'Car', 5, 'M-109'),
(456, 'DENMARK', 'Car', 5, 'MLRS'),
(457, 'DENMARK', 'Car', 6, 'Stinger manpad'),
(458, 'DENMARK', 'Car', 6, 'Stinger comm'),
(459, 'DENMARK', 'Car', 7, 'M 818'),
(460, 'DENMARK', 'Car', 4, 'Leopard1A3'),
(461, 'DENMARK', 'Helicopter', 2, 'UH-1H'),
(462, 'GEORGIA', 'Plane', 1, 'Su-25'),
(463, 'GEORGIA', 'Plane', 1, 'An-26B'),
(464, 'GEORGIA', 'Plane', 1, 'Su-25T'),
(465, 'GEORGIA', 'Plane', 1, 'L-39ZA'),
(466, 'GEORGIA', 'Plane', 1, 'Yak-40'),
(467, 'GEORGIA', 'Plane', 1, 'P-51D'),
(468, 'GEORGIA', 'Ship', 3, 'ELNYA'),
(469, 'GEORGIA', 'Ship', 3, 'ALBATROS'),
(470, 'GEORGIA', 'Ship', 3, 'MOLNIYA'),
(471, 'GEORGIA', 'Ship', 3, 'Dry-Cargo Ship-1'),
(472, 'GEORGIA', 'Ship', 3, 'Dry-Cargo Ship-2'),
(473, 'GEORGIA', 'Ship', 3, 'ZWEZDNY'),
(474, 'GEORGIA', 'Car', 4, 'BTR-80'),
(475, 'GEORGIA', 'Car', 6, 'Strela-1 9P31'),
(476, 'GEORGIA', 'Car', 6, 'Strela-10M3'),
(477, 'GEORGIA', 'Car', 6, 'ZSU-23-4 Shilka'),
(478, 'GEORGIA', 'Car', 6, 'SA-11 Buk SR 9S18M1'),
(479, 'GEORGIA', 'Car', 6, 'SA-11 Buk CC 9S470M1'),
(480, 'GEORGIA', 'Car', 6, 'SA-11 Buk LN 9A310M1'),
(481, 'GEORGIA', 'Car', 5, 'SAU Akatsia'),
(482, 'GEORGIA', 'Car', 5, 'SAU 2-C9'),
(483, 'GEORGIA', 'Car', 7, 'ATMZ-5'),
(484, 'GEORGIA', 'Car', 7, 'ATZ-10'),
(485, 'GEORGIA', 'Car', 7, 'Ural-375 APA-50'),
(486, 'GEORGIA', 'Car', 4, 'BMD-1'),
(487, 'GEORGIA', 'Car', 4, 'BMP-1'),
(488, 'GEORGIA', 'Car', 4, 'BMP-2'),
(489, 'GEORGIA', 'Car', 4, 'BRDM-2'),
(490, 'GEORGIA', 'Car', 5, 'Grad-URAL'),
(491, 'GEORGIA', 'Car', 7, 'UAZ-469'),
(492, 'GEORGIA', 'Car', 7, 'Ural-375'),
(493, 'GEORGIA', 'Car', 7, 'Ural-375 PBU'),
(494, 'GEORGIA', 'Car', 7, 'IKARUS Bus'),
(495, 'GEORGIA', 'Car', 7, 'VAZ Car'),
(496, 'GEORGIA', 'Car', 7, 'Trolley bus'),
(497, 'GEORGIA', 'Car', 7, 'KAMAZ Truck'),
(498, 'GEORGIA', 'Car', 7, 'LAZ Bus'),
(499, 'GEORGIA', 'Car', 7, 'GAZ-3307'),
(500, 'GEORGIA', 'Car', 7, 'GAZ-3308'),
(501, 'GEORGIA', 'Car', 7, 'GAZ-66'),
(502, 'GEORGIA', 'Car', 7, 'MAZ-6303'),
(503, 'GEORGIA', 'Car', 7, 'ZIL-4331'),
(504, 'GEORGIA', 'Car', 6, 'Osa 9A33 ln'),
(505, 'GEORGIA', 'Car', 7, 'SKP-11'),
(506, 'GEORGIA', 'Car', 7, 'Ural ATsP-6'),
(507, 'GEORGIA', 'Car', 7, 'ZiL-131 APA-80'),
(508, 'GEORGIA', 'Car', 7, 'ZIL-131 KUNG'),
(509, 'GEORGIA', 'Car', 6, 'ZU-23 Emplacement'),
(510, 'GEORGIA', 'Car', 6, 'ZU-23 Emplacement Closed'),
(511, 'GEORGIA', 'Car', 6, 'Ural-375 ZU-23'),
(512, 'GEORGIA', 'Car', 6, 'Dog Ear radar'),
(513, 'GEORGIA', 'Car', 6, '1L13 EWR'),
(514, 'GEORGIA', 'Car', 4, 'MTLB'),
(515, 'GEORGIA', 'Car', 4, 'T-72B'),
(516, 'GEORGIA', 'Car', 6, 'SA-18 Igla manpad'),
(517, 'GEORGIA', 'Car', 6, 'SA-18 Igla comm'),
(518, 'GEORGIA', 'Car', 4, 'T-55'),
(519, 'GEORGIA', 'Car', 6, 'Stinger manpad'),
(520, 'GEORGIA', 'Car', 6, 'Stinger comm'),
(521, 'GEORGIA', 'Car', 8, 'Soldier AK'),
(522, 'GEORGIA', 'Car', 8, 'Soldier RPG'),
(523, 'GEORGIA', 'Car', 6, '5p73 s-125 ln'),
(524, 'GEORGIA', 'Car', 6, 'snr s-125 tr'),
(525, 'GEORGIA', 'Car', 6, 'p-19 s-125 sr'),
(526, 'GEORGIA', 'Car', 7, 'M 818'),
(527, 'GEORGIA', 'Car', 5, '2B11 mortar'),
(528, 'GEORGIA', 'Helicopter', 2, 'UH-1H'),
(529, 'GEORGIA', 'Helicopter', 2, 'Mi-8MT'),
(530, 'GEORGIA', 'Helicopter', 2, 'Mi-24V'),
(531, 'ISRAEL', 'Plane', 1, 'F-15C'),
(532, 'ISRAEL', 'Plane', 1, 'F-15E'),
(533, 'ISRAEL', 'Plane', 1, 'F-16C bl.52d'),
(534, 'ISRAEL', 'Plane', 1, 'C-130'),
(535, 'ISRAEL', 'Plane', 1, 'F-4E'),
(536, 'ISRAEL', 'Plane', 1, 'P-51D'),
(537, 'ISRAEL', 'Car', 4, 'M-113'),
(538, 'ISRAEL', 'Car', 6, 'M1097 Avenger'),
(539, 'ISRAEL', 'Car', 6, 'Patriot str'),
(540, 'ISRAEL', 'Car', 6, 'Patriot ln'),
(541, 'ISRAEL', 'Car', 6, 'Patriot AMG'),
(542, 'ISRAEL', 'Car', 6, 'Patriot EPP'),
(543, 'ISRAEL', 'Car', 6, 'Patriot ECS'),
(544, 'ISRAEL', 'Car', 6, 'Patriot cp'),
(545, 'ISRAEL', 'Car', 6, 'Hawk sr'),
(546, 'ISRAEL', 'Car', 6, 'Hawk tr'),
(547, 'ISRAEL', 'Car', 6, 'Hawk ln'),
(548, 'ISRAEL', 'Car', 6, 'Vulcan'),
(549, 'ISRAEL', 'Car', 4, 'Hummer'),
(550, 'ISRAEL', 'Car', 4, 'LAV-25'),
(551, 'ISRAEL', 'Car', 4, 'AAV7'),
(552, 'ISRAEL', 'Car', 5, 'M-109'),
(553, 'ISRAEL', 'Car', 4, 'M-60'),
(554, 'ISRAEL', 'Car', 7, 'M 818'),
(555, 'ISRAEL', 'Car', 6, 'M48 Chaparral'),
(556, 'ISRAEL', 'Car', 5, 'MLRS'),
(557, 'ISRAEL', 'Car', 6, 'Stinger manpad dsr'),
(558, 'ISRAEL', 'Car', 6, 'Stinger comm dsr'),
(559, 'ISRAEL', 'Helicopter', 2, 'AH-64A'),
(560, 'ISRAEL', 'Helicopter', 2, 'AH-1W'),
(561, 'ISRAEL', 'Helicopter', 2, 'UH-60A'),
(562, 'ISRAEL', 'Helicopter', 2, 'AH-64D'),
(563, 'ISRAEL', 'Helicopter', 2, 'UH-1H'),
(564, 'INSURGENTS', 'Ship', 3, 'ELNYA'),
(565, 'INSURGENTS', 'Ship', 3, 'MOLNIYA'),
(566, 'INSURGENTS', 'Ship', 3, 'Dry-Cargo Ship-1'),
(567, 'INSURGENTS', 'Ship', 3, 'Dry-Cargo Ship-2'),
(568, 'INSURGENTS', 'Ship', 3, 'ZWEZDNY'),
(569, 'INSURGENTS', 'Car', 4, 'BTR-80'),
(570, 'INSURGENTS', 'Car', 6, 'Strela-1 9P31'),
(571, 'INSURGENTS', 'Car', 6, 'Strela-10M3'),
(572, 'INSURGENTS', 'Car', 6, 'ZSU-23-4 Shilka'),
(573, 'INSURGENTS', 'Car', 5, 'SAU Akatsia'),
(574, 'INSURGENTS', 'Car', 5, 'SAU 2-C9'),
(575, 'INSURGENTS', 'Car', 7, 'ATMZ-5'),
(576, 'INSURGENTS', 'Car', 7, 'ATZ-10'),
(577, 'INSURGENTS', 'Car', 4, 'BMD-1'),
(578, 'INSURGENTS', 'Car', 4, 'BMP-1'),
(579, 'INSURGENTS', 'Car', 4, 'BMP-2'),
(580, 'INSURGENTS', 'Car', 4, 'BRDM-2'),
(581, 'INSURGENTS', 'Car', 5, 'Grad-URAL'),
(582, 'INSURGENTS', 'Car', 7, 'UAZ-469'),
(583, 'INSURGENTS', 'Car', 7, 'Ural-375'),
(584, 'INSURGENTS', 'Car', 7, 'Ural-375 PBU'),
(585, 'INSURGENTS', 'Car', 7, 'IKARUS Bus'),
(586, 'INSURGENTS', 'Car', 7, 'VAZ Car'),
(587, 'INSURGENTS', 'Car', 7, 'Trolley bus'),
(588, 'INSURGENTS', 'Car', 7, 'KAMAZ Truck'),
(589, 'INSURGENTS', 'Car', 7, 'LAZ Bus'),
(590, 'INSURGENTS', 'Car', 7, 'GAZ-3307'),
(591, 'INSURGENTS', 'Car', 7, 'GAZ-3308'),
(592, 'INSURGENTS', 'Car', 7, 'GAZ-66'),
(593, 'INSURGENTS', 'Car', 7, 'MAZ-6303'),
(594, 'INSURGENTS', 'Car', 7, 'ZIL-4331'),
(595, 'INSURGENTS', 'Car', 6, 'ZU-23 Insurgent'),
(596, 'INSURGENTS', 'Car', 6, 'ZU-23 Closed Insurgent'),
(597, 'INSURGENTS', 'Car', 6, 'Ural-375 ZU-23 Insurgent'),
(598, 'INSURGENTS', 'Car', 7, 'ZiL-131 APA-80'),
(599, 'INSURGENTS', 'Car', 7, 'ZIL-131 KUNG'),
(600, 'INSURGENTS', 'Car', 4, 'MTLB'),
(601, 'INSURGENTS', 'Car', 6, 'SA-18 Igla manpad'),
(602, 'INSURGENTS', 'Car', 6, 'SA-18 Igla comm'),
(603, 'INSURGENTS', 'Car', 4, 'T-55'),
(604, 'INSURGENTS', 'Car', 6, 'Stinger manpad'),
(605, 'INSURGENTS', 'Car', 6, 'Stinger comm'),
(606, 'INSURGENTS', 'Car', 8, 'Soldier AK'),
(607, 'INSURGENTS', 'Car', 8, 'Soldier RPG'),
(608, 'INSURGENTS', 'Car', 5, '2B11 mortar'),
(609, 'INSURGENTS', 'Helicopter', 2, 'Mi-8MT'),
(610, 'INSURGENTS', 'Helicopter', 2, 'UH-1H'),
(611, 'ABKHAZIA', 'Plane', 1, 'Su-25'),
(612, 'ABKHAZIA', 'Plane', 1, 'An-26B'),
(613, 'ABKHAZIA', 'Plane', 1, 'L-39ZA'),
(614, 'ABKHAZIA', 'Plane', 1, 'P-51D'),
(615, 'ABKHAZIA', 'Ship', 3, 'ELNYA'),
(616, 'ABKHAZIA', 'Ship', 3, 'MOLNIYA'),
(617, 'ABKHAZIA', 'Ship', 3, 'ZWEZDNY'),
(618, 'ABKHAZIA', 'Ship', 3, 'Dry-Cargo Ship-1'),
(619, 'ABKHAZIA', 'Ship', 3, 'Dry-Cargo Ship-2'),
(620, 'ABKHAZIA', 'Car', 4, 'BTR-80'),
(621, 'ABKHAZIA', 'Car', 6, 'SA-11 Buk SR 9S18M1'),
(622, 'ABKHAZIA', 'Car', 6, 'SA-11 Buk CC 9S470M1'),
(623, 'ABKHAZIA', 'Car', 6, 'SA-11 Buk LN 9A310M1'),
(624, 'ABKHAZIA', 'Car', 6, 'Kub 1S91 str'),
(625, 'ABKHAZIA', 'Car', 6, 'Kub 2P25 ln'),
(626, 'ABKHAZIA', 'Car', 6, 'Osa 9A33 ln'),
(627, 'ABKHAZIA', 'Car', 6, 'Strela-10M3'),
(628, 'ABKHAZIA', 'Car', 6, 'Dog Ear radar'),
(629, 'ABKHAZIA', 'Car', 6, 'ZSU-23-4 Shilka'),
(630, 'ABKHAZIA', 'Car', 5, 'SAU Akatsia'),
(631, 'ABKHAZIA', 'Car', 5, 'SAU 2-C9'),
(632, 'ABKHAZIA', 'Car', 7, 'ATMZ-5'),
(633, 'ABKHAZIA', 'Car', 7, 'ATZ-10'),
(634, 'ABKHAZIA', 'Car', 4, 'BMD-1'),
(635, 'ABKHAZIA', 'Car', 4, 'BMP-1'),
(636, 'ABKHAZIA', 'Car', 4, 'BMP-2'),
(637, 'ABKHAZIA', 'Car', 4, 'BRDM-2'),
(638, 'ABKHAZIA', 'Car', 5, 'Grad-URAL'),
(639, 'ABKHAZIA', 'Car', 7, 'UAZ-469'),
(640, 'ABKHAZIA', 'Car', 7, 'Ural-375'),
(641, 'ABKHAZIA', 'Car', 7, 'Ural-375 PBU'),
(642, 'ABKHAZIA', 'Car', 7, 'IKARUS Bus'),
(643, 'ABKHAZIA', 'Car', 7, 'VAZ Car'),
(644, 'ABKHAZIA', 'Car', 7, 'Trolley bus'),
(645, 'ABKHAZIA', 'Car', 7, 'KAMAZ Truck'),
(646, 'ABKHAZIA', 'Car', 7, 'LAZ Bus'),
(647, 'ABKHAZIA', 'Car', 5, 'SAU Gvozdika'),
(648, 'ABKHAZIA', 'Car', 4, 'BTR_D'),
(649, 'ABKHAZIA', 'Car', 7, 'GAZ-3307'),
(650, 'ABKHAZIA', 'Car', 7, 'GAZ-3308'),
(651, 'ABKHAZIA', 'Car', 7, 'GAZ-66'),
(652, 'ABKHAZIA', 'Car', 7, 'ZIL-4331'),
(653, 'ABKHAZIA', 'Car', 7, 'MAZ-6303'),
(654, 'ABKHAZIA', 'Car', 7, 'SKP-11'),
(655, 'ABKHAZIA', 'Car', 7, 'Ural-4320T'),
(656, 'ABKHAZIA', 'Car', 7, 'Ural ATsP-6'),
(657, 'ABKHAZIA', 'Car', 7, 'ZiL-131 APA-80'),
(658, 'ABKHAZIA', 'Car', 7, 'ZIL-131 KUNG'),
(659, 'ABKHAZIA', 'Car', 7, 'Ural-375 APA-50'),
(660, 'ABKHAZIA', 'Car', 6, 'ZU-23 Emplacement'),
(661, 'ABKHAZIA', 'Car', 6, 'ZU-23 Emplacement Closed'),
(662, 'ABKHAZIA', 'Car', 6, 'Ural-375 ZU-23'),
(663, 'ABKHAZIA', 'Car', 6, '2S6 Tunguska'),
(664, 'ABKHAZIA', 'Car', 6, 'Strela-1 9P31'),
(665, 'ABKHAZIA', 'Car', 4, 'MTLB'),
(666, 'ABKHAZIA', 'Car', 4, 'T-72B'),
(667, 'ABKHAZIA', 'Car', 6, 'SA-18 Igla manpad'),
(668, 'ABKHAZIA', 'Car', 6, 'SA-18 Igla comm'),
(669, 'ABKHAZIA', 'Car', 4, 'T-55'),
(670, 'ABKHAZIA', 'Car', 5, '2B11 mortar'),
(671, 'ABKHAZIA', 'Helicopter', 2, 'Mi-24V'),
(672, 'ABKHAZIA', 'Helicopter', 2, 'Mi-8MT'),
(673, 'ABKHAZIA', 'Helicopter', 2, 'Ka-50'),
(674, 'ABKHAZIA', 'Helicopter', 2, 'UH-1H'),
(675, 'SOUTH OSSETIA', 'Car', 4, 'BTR-80'),
(676, 'SOUTH OSSETIA', 'Car', 6, 'Osa 9A33 ln'),
(677, 'SOUTH OSSETIA', 'Car', 6, 'Strela-10M3'),
(678, 'SOUTH OSSETIA', 'Car', 6, 'ZSU-23-4 Shilka'),
(679, 'SOUTH OSSETIA', 'Car', 5, 'SAU Akatsia'),
(680, 'SOUTH OSSETIA', 'Car', 5, 'SAU 2-C9'),
(681, 'SOUTH OSSETIA', 'Car', 7, 'ATMZ-5'),
(682, 'SOUTH OSSETIA', 'Car', 7, 'ATZ-10'),
(683, 'SOUTH OSSETIA', 'Car', 4, 'BMD-1'),
(684, 'SOUTH OSSETIA', 'Car', 4, 'BMP-1'),
(685, 'SOUTH OSSETIA', 'Car', 4, 'BMP-2'),
(686, 'SOUTH OSSETIA', 'Car', 4, 'BRDM-2'),
(687, 'SOUTH OSSETIA', 'Car', 5, 'Grad-URAL'),
(688, 'SOUTH OSSETIA', 'Car', 7, 'UAZ-469'),
(689, 'SOUTH OSSETIA', 'Car', 7, 'Ural-375'),
(690, 'SOUTH OSSETIA', 'Car', 7, 'Ural-375 PBU'),
(691, 'SOUTH OSSETIA', 'Car', 7, 'IKARUS Bus'),
(692, 'SOUTH OSSETIA', 'Car', 7, 'VAZ Car'),
(693, 'SOUTH OSSETIA', 'Car', 7, 'KAMAZ Truck'),
(694, 'SOUTH OSSETIA', 'Car', 7, 'LAZ Bus'),
(695, 'SOUTH OSSETIA', 'Car', 5, 'SAU Gvozdika'),
(696, 'SOUTH OSSETIA', 'Car', 4, 'BTR_D'),
(697, 'SOUTH OSSETIA', 'Car', 7, 'GAZ-3307'),
(698, 'SOUTH OSSETIA', 'Car', 7, 'GAZ-3308'),
(699, 'SOUTH OSSETIA', 'Car', 7, 'GAZ-66'),
(700, 'SOUTH OSSETIA', 'Car', 7, 'ZIL-4331'),
(701, 'SOUTH OSSETIA', 'Car', 7, 'MAZ-6303'),
(702, 'SOUTH OSSETIA', 'Car', 7, 'SKP-11'),
(703, 'SOUTH OSSETIA', 'Car', 7, 'Ural-4320T'),
(704, 'SOUTH OSSETIA', 'Car', 7, 'Ural ATsP-6'),
(705, 'SOUTH OSSETIA', 'Car', 7, 'ZiL-131 APA-80'),
(706, 'SOUTH OSSETIA', 'Car', 7, 'ZIL-131 KUNG'),
(707, 'SOUTH OSSETIA', 'Car', 7, 'Ural-375 APA-50'),
(708, 'SOUTH OSSETIA', 'Car', 6, 'ZU-23 Emplacement'),
(709, 'SOUTH OSSETIA', 'Car', 6, 'ZU-23 Emplacement Closed'),
(710, 'SOUTH OSSETIA', 'Car', 6, 'Ural-375 ZU-23'),
(711, 'SOUTH OSSETIA', 'Car', 6, '2S6 Tunguska'),
(712, 'SOUTH OSSETIA', 'Car', 6, 'Strela-1 9P31'),
(713, 'SOUTH OSSETIA', 'Car', 4, 'MTLB'),
(714, 'SOUTH OSSETIA', 'Car', 4, 'T-72B'),
(715, 'SOUTH OSSETIA', 'Car', 6, 'SA-18 Igla manpad'),
(716, 'SOUTH OSSETIA', 'Car', 6, 'SA-18 Igla comm'),
(717, 'SOUTH OSSETIA', 'Car', 4, 'T-55'),
(718, 'SOUTH OSSETIA', 'Car', 5, '2B11 mortar'),
(719, 'SOUTH OSSETIA', 'Helicopter', 2, 'Mi-24V'),
(720, 'SOUTH OSSETIA', 'Helicopter', 2, 'Mi-8MT'),
(721, 'SOUTH OSSETIA', 'Helicopter', 2, 'Ka-50'),
(722, 'SOUTH OSSETIA', 'Helicopter', 2, 'UH-1H'),
(723, 'ITALY', 'Plane', 1, 'C-130'),
(724, 'ITALY', 'Plane', 1, 'F-16A MLU'),
(725, 'ITALY', 'Plane', 1, 'P-51D'),
(726, 'ITALY', 'Plane', 1, 'Tornado IDS'),
(727, 'ITALY', 'Car', 4, 'M-113'),
(728, 'ITALY', 'Car', 6, 'Hawk sr'),
(729, 'ITALY', 'Car', 6, 'Hawk tr'),
(730, 'ITALY', 'Car', 6, 'Hawk ln'),
(731, 'ITALY', 'Car', 4, 'Hummer'),
(732, 'ITALY', 'Car', 5, 'M-109'),
(733, 'ITALY', 'Car', 5, 'MLRS'),
(734, 'ITALY', 'Car', 6, 'Stinger manpad'),
(735, 'ITALY', 'Car', 6, 'Stinger comm'),
(736, 'ITALY', 'Car', 7, 'M 818'),
(737, 'ITALY', 'Car', 4, 'Leopard1A3'),
(738, 'ITALY', 'Car', 7, 'M978 HEMTT Tanker'),
(739, 'ITALY', 'Car', 7, 'HEMTT TFFT'),
(740, 'ITALY', 'Car', 4, 'M1043 HMMWV Armament'),
(741, 'ITALY', 'Car', 4, 'M1045 HMMWV TOW'),
(742, 'ITALY', 'Car', 5, '2B11 mortar'),
(743, 'ITALY', 'Helicopter', 2, 'UH-1H');

-- --------------------------------------------------------

--
-- Table structure for table `dcs_units_types`
--

CREATE TABLE IF NOT EXISTS `dcs_units_types` (
  `type_unit` varchar(256) CHARACTER SET utf8 NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `dcs_units_types`
--

INSERT INTO `dcs_units_types` (`type_unit`, `id`) VALUES
('Plane', 1),
('Ship', 2),
('Car', 3),
('Helicopter', 4);

-- --------------------------------------------------------

--
-- Table structure for table `fail_flights`
--

CREATE TABLE IF NOT EXISTS `fail_flights` (
  `pilot_id` int(11) NOT NULL,
  `data` datetime NOT NULL,
  KEY `pilot_id` (`pilot_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fail_flights`
--

INSERT INTO `fail_flights` (`pilot_id`, `data`) VALUES
(1, '2015-11-30 16:02:08'),
(2, '2015-11-30 17:04:08'),
(4, '2015-11-30 17:47:23'),
(7, '2015-11-30 20:42:14'),
(10, '2015-11-30 21:10:05'),
(7, '2015-11-30 21:16:37'),
(10, '2015-11-30 21:17:40'),
(11, '2015-11-30 21:41:21'),
(7, '2015-11-30 21:42:05'),
(18, '2015-12-01 04:55:41'),
(24, '2015-12-01 19:20:49'),
(27, '2015-12-01 19:50:08'),
(27, '2015-12-01 20:04:26'),
(27, '2015-12-01 20:19:05');

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

--
-- Dumping data for table `flight_hours`
--

INSERT INTO `flight_hours` (`pilot_id`, `start_flight`, `end_flight`, `total`) VALUES
(1, '2015-11-30 15:52:22', '2015-11-30 15:54:23', 121),
(1, '2015-11-30 16:00:25', '2015-11-30 16:02:08', 103),
(2, '2015-11-30 16:45:56', '2015-11-30 16:46:04', 8),
(2, '2015-11-30 16:51:30', '2015-11-30 17:04:08', 758),
(2, '2015-11-30 17:26:11', '2015-11-30 17:26:13', 2),
(3, '2015-11-30 17:16:14', '2015-11-30 17:40:08', 1434),
(4, '2015-11-30 17:36:32', '2015-11-30 17:47:23', 651),
(6, '2015-11-30 19:42:36', '2015-11-30 19:47:38', 302),
(6, '2015-11-30 19:55:00', '2015-11-30 20:00:24', 324),
(7, '2015-11-30 20:26:06', '2015-11-30 20:42:14', 968),
(8, '2015-11-30 20:29:34', '2015-11-30 20:46:55', 1041),
(10, '2015-11-30 21:03:31', '2015-11-30 21:10:05', 394),
(7, '2015-11-30 20:48:36', '2015-11-30 21:16:37', 1681),
(10, '2015-11-30 21:12:37', '2015-11-30 21:17:40', 303),
(9, '2015-11-30 20:50:40', '2015-11-30 21:23:39', 1979),
(8, '2015-11-30 20:50:42', '2015-11-30 21:24:01', 1999),
(11, '2015-11-30 21:20:04', '2015-11-30 21:41:21', 1277),
(7, '2015-11-30 21:22:09', '2015-11-30 21:42:05', 1196),
(12, '2015-11-30 21:20:19', '2015-11-30 21:53:49', 2010),
(9, '2015-11-30 21:35:11', '2015-11-30 21:57:02', 1311),
(8, '2015-11-30 21:33:20', '2015-11-30 21:57:31', 1451),
(18, '2015-12-01 04:42:27', '2015-12-01 04:55:41', 794),
(21, '2015-12-01 11:13:31', '2015-12-01 11:18:29', 298),
(21, '2015-12-01 11:27:04', '2015-12-01 11:49:47', 1363),
(3, '2015-12-01 15:23:59', '2015-12-01 15:48:53', 1494),
(25, '2015-12-01 19:12:28', '2015-12-01 19:15:54', 206),
(24, '2015-12-01 19:01:16', '2015-12-01 19:20:49', 1173),
(24, '2015-12-01 19:31:17', '2015-12-01 19:46:41', 924),
(27, '2015-12-01 19:45:00', '2015-12-01 19:50:08', 308),
(9, '2015-12-01 19:37:21', '2015-12-01 20:01:32', 1451),
(27, '2015-12-01 19:53:10', '2015-12-01 20:04:26', 676),
(27, '2015-12-01 20:08:43', '2015-12-01 20:19:05', 622),
(9, '2015-12-01 20:03:26', '2015-12-01 20:25:01', 1295),
(27, '2015-12-01 20:23:31', '2015-12-01 20:55:51', 1940),
(8, '2015-12-01 20:38:58', '2015-12-01 21:02:21', 1403),
(8, '2015-12-01 21:02:27', '2015-12-01 21:02:29', 2),
(9, '2015-12-01 20:58:12', '2015-12-01 21:15:32', 1040),
(8, '2015-12-01 21:57:10', '2015-12-01 22:09:15', 725),
(8, '2015-12-01 22:21:34', '2015-12-01 22:31:51', 617);

-- --------------------------------------------------------

--
-- Table structure for table `pilots`
--

CREATE TABLE IF NOT EXISTS `pilots` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(128) NOT NULL,
  `hash` varchar(128) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `ix_pilots_nickname` (`nickname`),
  KEY `ix_hash_index` (`hash`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `pilots`
--

INSERT INTO `pilots` (`id`, `nickname`, `hash`) VALUES
(1, 'timur21099', 'c362750f758a489d59c388cab98dcef3'),
(2, '=BASIS= panzer_18', '365d749b2e85b50af2a8e1500eec06c0'),
(3, '-=Крылатый=-', '40a7729cc232f2181039167567580279'),
(4, 'FishOnTheRun', 'fc5c554fb098470093a2788035f22fde'),
(5, 'Glunz', '01a393f80dd3e7fa58195414e1b6279c'),
(6, 'Adolf Galland', 'a2de625bb7b70f555a9e0b57c6d46dd1'),
(7, '159BAG_Mamba', '5bec0f17c286b2870fbf62a21579517a'),
(8, '=BS=eekz', '9057a2af64d0ea1f73f29634e0f21fb5'),
(9, 'FF*CMF*04', '574378d7f238893b5298cb7de954bcaa'),
(10, 'SpeeZ', '9a0314db9cd7bec0e806d21d98e53c93'),
(11, 'Helljumper', '65d2630cb29584d77cb0f49d583a3cfa'),
(12, 'VEAF_Shughart', '80eeb471ff417e5f4c50e7926230bfe7'),
(13, 'Kapott', 'cefe8459dc94655fa31b16df6cd5d210'),
(14, 'Adriano 4620', '611dd915f1cac9d80f633055eb9d33d1'),
(15, 'JacktheSchlüpper', '3ec360073a451795d898d384d8e048a1'),
(16, 'GermanWolF', 'd457637f5d7b9e5af244269ed9c85725'),
(17, 'Bacon', 'f3025189501863321d336d3320911c4d'),
(18, 'quarant', 'f6e8973fd95ef2aad7fb7f8e51a9c169'),
(19, 'CncKiwi', '7ca34a48dfcf99eb4c853d205d8807fe'),
(20, 'eeq', 'cccf7f2fb7778d505e595128e0723ec5'),
(21, 'Were_M_Eye', '71ba494889bf1ebddd6ca059ef354844'),
(22, 'Cherepaha', '37e510f0d7910ab7a586d27963fab2f7'),
(23, 'galema', 'bc3007e02d71ba3090166fecc20b9001'),
(24, 'dresam', '6b2b9bd00c622891e04dafd5be9e4ed9'),
(25, 'Nick', '22cada88234c10a5d3d150ca816d1106'),
(26, 'Mustang', '19ef6e2c11f0ec5853c4d0db3f38a197'),
(27, '[DoW] SnowTiger', '159f41a38361766cc8a7d0e3d16dc74a'),
(28, 'BOPOH', 'bee701ae20e8b3ea1191241ca4ea02d0'),
(29, 'Adik', 'f47025ef24a4965467d6a02f33ca2bcb'),
(30, 'FreedomFries', 'cf9c7da6cccd0d0a053dc8858412e8dd'),
(31, 'CA09_Sun', '47c26366922130bdfc3364802bcbb625'),
(32, 'joker', 'b7eb5fbf4e2af3bc1944e8740db3c504'),
(33, 'loubard', 'f47c953396c42aee3353bf32beff2c26'),
(34, 'gin', '1f6b233c2a4c3c44c5acef09f9311e70'),
(35, 'Crumpp', 'bbf4a19c12018b6c63af3f72c012d6b8');

-- --------------------------------------------------------

--
-- Table structure for table `pilots_death`
--

CREATE TABLE IF NOT EXISTS `pilots_death` (
  `pilot_id` int(11) NOT NULL,
  `death` datetime NOT NULL,
  KEY `pilot_id` (`pilot_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pilots_death`
--

INSERT INTO `pilots_death` (`pilot_id`, `death`) VALUES
(2, '2015-11-30 16:46:06'),
(2, '2015-11-30 17:22:16'),
(4, '2015-11-30 17:47:23'),
(5, '2015-11-30 19:52:06'),
(11, '2015-11-30 21:15:41'),
(18, '2015-12-01 04:55:41'),
(24, '2015-12-01 19:20:49'),
(27, '2015-12-01 20:04:26'),
(34, '2015-12-02 00:59:44');

-- --------------------------------------------------------

--
-- Table structure for table `pilots_dogfights`
--

CREATE TABLE IF NOT EXISTS `pilots_dogfights` (
  `pilot_id` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `friendly` int(11) NOT NULL,
  `victim_id` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  KEY `ix_victim_id` (`victim_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pilots_dogfights`
--

INSERT INTO `pilots_dogfights` (`pilot_id`, `data`, `friendly`, `victim_id`, `points`) VALUES
(8, '2015-11-30 20:42:14', 0, 7, 50),
(9, '2015-11-30 21:10:06', 0, 10, 50),
(8, '2015-11-30 21:16:37', 0, 7, 50),
(8, '2015-11-30 21:41:21', 0, 11, 50),
(27, '2015-12-01 19:50:07', 0, 27, 50),
(27, '2015-12-01 20:19:05', 0, 27, 50);

-- --------------------------------------------------------

--
-- Table structure for table `pilots_ejects`
--

CREATE TABLE IF NOT EXISTS `pilots_ejects` (
  `pilot_id` int(11) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pilots_ejects`
--

INSERT INTO `pilots_ejects` (`pilot_id`, `data`) VALUES
(2, '2015-11-30 17:19:05'),
(7, '2015-11-30 20:42:14'),
(10, '2015-11-30 21:10:05'),
(34, '2015-12-02 00:59:44');

-- --------------------------------------------------------

--
-- Table structure for table `pilots_kills`
--

CREATE TABLE IF NOT EXISTS `pilots_kills` (
  `pilot_id` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `unit_id` int(11) NOT NULL,
  `unit_type_id` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  KEY `pilot_id` (`pilot_id`),
  KEY `ix_unit_id` (`unit_id`),
  KEY `ix_unit_type_id` (`unit_type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pilots_kills`
--

INSERT INTO `pilots_kills` (`pilot_id`, `data`, `unit_id`, `unit_type_id`, `points`) VALUES
(3, '2015-11-30 17:21:41', 336, 4, 5),
(3, '2015-11-30 17:22:23', 336, 4, 5),
(3, '2015-11-30 17:29:18', 253, 4, 5),
(3, '2015-11-30 17:30:10', 88, 7, 5),
(3, '2015-11-30 17:30:59', 253, 4, 5),
(8, '2015-11-30 20:34:44', 336, 4, 5),
(8, '2015-11-30 20:34:54', 336, 4, 5),
(8, '2015-11-30 20:34:55', 273, 7, 5),
(12, '2015-11-30 21:30:21', 76, 7, 5),
(12, '2015-11-30 21:30:32', 76, 7, 5),
(11, '2015-11-30 21:31:11', 81, 7, 5),
(11, '2015-11-30 21:31:23', 76, 7, 5),
(12, '2015-11-30 21:32:37', 81, 7, 5),
(21, '2015-12-01 11:39:52', 336, 4, 5),
(21, '2015-12-01 11:42:45', 88, 7, 5),
(3, '2015-12-01 15:31:52', 257, 5, 5),
(3, '2015-12-01 15:32:03', 336, 4, 5),
(3, '2015-12-01 15:32:52', 253, 4, 5),
(3, '2015-12-01 15:42:15', 253, 4, 5),
(27, '2015-12-01 19:50:06', 336, 4, 5),
(9, '2015-12-01 19:53:32', 88, 7, 5),
(9, '2015-12-01 19:54:54', 253, 4, 5),
(9, '2015-12-01 19:55:46', 273, 7, 5),
(27, '2015-12-01 19:59:10', 336, 4, 5),
(27, '2015-12-01 20:00:01', 336, 4, 5),
(9, '2015-12-01 20:11:31', 336, 4, 5),
(9, '2015-12-01 20:12:34', 257, 5, 5),
(8, '2015-12-01 22:26:06', 336, 4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `pilots_lands`
--

CREATE TABLE IF NOT EXISTS `pilots_lands` (
  `pilot_id` int(11) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pilots_lands`
--

INSERT INTO `pilots_lands` (`pilot_id`, `data`) VALUES
(1, '2015-11-30 15:54:23'),
(2, '2015-11-30 16:46:04'),
(2, '2015-11-30 17:26:13'),
(3, '2015-11-30 17:40:08'),
(6, '2015-11-30 19:47:38'),
(6, '2015-11-30 20:00:24'),
(8, '2015-11-30 20:46:55'),
(9, '2015-11-30 21:23:39'),
(8, '2015-11-30 21:24:01'),
(12, '2015-11-30 21:53:49'),
(9, '2015-11-30 21:57:02'),
(8, '2015-11-30 21:57:31'),
(21, '2015-12-01 11:18:29'),
(21, '2015-12-01 11:49:47'),
(3, '2015-12-01 15:48:53'),
(25, '2015-12-01 19:15:54'),
(24, '2015-12-01 19:46:41'),
(9, '2015-12-01 20:01:32'),
(9, '2015-12-01 20:25:01'),
(27, '2015-12-01 20:55:51'),
(8, '2015-12-01 21:02:21'),
(8, '2015-12-01 21:02:29'),
(9, '2015-12-01 21:15:32'),
(8, '2015-12-01 22:09:15'),
(8, '2015-12-01 22:31:51');

-- --------------------------------------------------------

--
-- Table structure for table `pilots_takeoffs`
--

CREATE TABLE IF NOT EXISTS `pilots_takeoffs` (
  `pilot_id` int(11) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pilots_takeoffs`
--

INSERT INTO `pilots_takeoffs` (`pilot_id`, `data`) VALUES
(1, '2015-11-30 15:52:22'),
(1, '2015-11-30 16:00:25'),
(2, '2015-11-30 16:45:56'),
(2, '2015-11-30 16:51:30'),
(3, '2015-11-30 17:16:14'),
(2, '2015-11-30 17:26:11'),
(4, '2015-11-30 17:36:32'),
(6, '2015-11-30 19:42:36'),
(6, '2015-11-30 19:55:00'),
(7, '2015-11-30 20:26:06'),
(8, '2015-11-30 20:29:34'),
(7, '2015-11-30 20:48:36'),
(9, '2015-11-30 20:50:40'),
(8, '2015-11-30 20:50:42'),
(10, '2015-11-30 21:03:31'),
(10, '2015-11-30 21:12:37'),
(11, '2015-11-30 21:20:04'),
(12, '2015-11-30 21:20:19'),
(7, '2015-11-30 21:22:09'),
(8, '2015-11-30 21:33:20'),
(9, '2015-11-30 21:35:11'),
(18, '2015-12-01 04:42:27'),
(21, '2015-12-01 11:13:31'),
(21, '2015-12-01 11:27:04'),
(3, '2015-12-01 15:23:59'),
(24, '2015-12-01 19:01:16'),
(25, '2015-12-01 19:12:28'),
(24, '2015-12-01 19:31:17'),
(9, '2015-12-01 19:37:21'),
(27, '2015-12-01 19:45:00'),
(27, '2015-12-01 19:53:10'),
(9, '2015-12-01 20:03:26'),
(27, '2015-12-01 20:08:43'),
(27, '2015-12-01 20:23:31'),
(8, '2015-12-01 20:38:58'),
(9, '2015-12-01 20:58:12'),
(8, '2015-12-01 21:02:27'),
(8, '2015-12-01 21:57:10'),
(8, '2015-12-01 22:21:34');

-- --------------------------------------------------------

--
-- Table structure for table `server`
--

CREATE TABLE IF NOT EXISTS `server` (
  `status` int(1) NOT NULL,
  `server_dcs` varchar(25) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `server`
--

INSERT INTO `server` (`status`, `server_dcs`) VALUES
(1, 'Server');

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
