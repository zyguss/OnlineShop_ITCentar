-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 24, 2014 at 12:01 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `online_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `number_of_items_in_category` int(6) unsigned NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`, `number_of_items_in_category`) VALUES
(1, 'DVD', 4),
(2, 'Knjige', 3),
(3, 'Računari', 2);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `contact_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `text` text NOT NULL,
  `create_date` int(10) unsigned NOT NULL,
  PRIMARY KEY (`contact_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`contact_id`, `name`, `email`, `text`, `create_date`) VALUES
(1, 'Marko Markovic', 'marko@mail.com', 'Odlična ponuda proizvoda', 1404651623);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `group_id` tinyint(1) unsigned NOT NULL AUTO_INCREMENT,
  `group` varchar(20) NOT NULL,
  `number_of_users_in_group` int(10) unsigned NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`group_id`, `group`, `number_of_users_in_group`) VALUES
(1, 'admin', 1),
(2, 'member', 3);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `item_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL,
  `description` mediumtext NOT NULL,
  `price` float(8,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `number_of_items` int(6) NOT NULL DEFAULT '0',
  `fk_category_id` tinyint(3) NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `title`, `description`, `price`, `image`, `active`, `create_date`, `number_of_items`, `fk_category_id`) VALUES
(1, 'Ana Karenjina', 'Pisac: Lav Nikolajevič Tolstoj\r\nŽanrovi: Ljubavni, Klasična književnost', 1296.00, 'ana_karenjina.jpg', 1, '2013-02-09 13:24:21', 10, 2),
(2, 'Gospodar prstenova', 'Original:LORD OF THE RINGS: FELLOWSHIP OF THE RING\r\nŽanr: Fantazija\r\nTrajanje: 208 minuta\r\nRežija: Piter Džekson\r\nScenario: Dž. R. R. Tolkin, Piter Džekson, Fran Volš, Filipa Bojens\r\nUloge: Elajdža Vud, Ijan Makelen, Vigo Mortensen, Šon Astin, Kejt Blašet, Liv Tajler, Džon Ris-Dejvis, Dominik Monahan, Bili Bojd, Orlando Blum, Endi Serkis, Kristofer Li, Hjugo Viving', 1999.00, 'gospodar_prstenova.jpg', 1, '2013-10-24 00:55:32', 0, 1),
(3, 'TAXI 4', 'Žanrovi: Avanturistički, Akcioni\r\nGlumci: Samy Naceri', 300.00, 'taxi4.jpg', 1, '2013-02-09 13:28:40', 2, 1),
(4, 'Laptop DELL Inspiron 3520 red 15.6', 'Dell Inspiron 3520 je namenjen onima, koji od računara zahtevaju mobilnost i pouzdanost. Ovaj laptop poseduje Intel Celeron DualCore B820 procesor, Intel HD 3000 grafiku i 2GB RAM memorije.', 31990.00, 'Laptop DELL Inspiron 3520.jpg', 1, '2013-02-09 13:31:29', 10, 3),
(5, 'Računar Altos SUPRIMO, Z77/i7-3770K/16GB/GTX670/SSD+2TB/DVD', 'Izuzetan i7 procesor u kombinaciji sa perfektnom MSI pločom čine sklad koji do sada nije vidjen kod personalnih računara. Nevorovatnih 16GB radne memorije.', 137999.00, 'Altos-Suprimo-Storia.jpg', 1, '2013-02-09 13:32:51', 5, 3),
(6, 'Svemirski vojnici', 'Svemirski vojnici (engl. Starship Troopers) je američki naučnofantastični film iz 1997. zasnovan na istoimenoj knjizi Roberta A. Hajnlajna (Robert A. Heinlein). Režirao ga je Pol Verhoven (Paul Verhoeven)', 550.00, 'svemirski_vojnici_knjiga.jpg', 1, '2013-02-10 13:36:44', 3, 2),
(22, 'Lara Croft: Tomb Raider', 'Video game adventurer Lara Croft comes to life in a movie where she races against time and villains to recover powerful ancient artifacts.', 750.00, 'Tomb Raider.jpg', 1, '2013-05-26 11:39:41', 0, 1),
(23, 'Bjuik 8', 'Pisac: Stiven King\r\nŽanrovi: naučna fantastika, horor', 850.00, 'bjuik 8.jpg', 1, '2013-10-24 00:52:09', 0, 2),
(24, 'Svemirski Vojnici', 'Žanrovi: Naučna fantastika, Nagrađene knjige\r\nIzdavač: Čarobna knjiga\r\n', 788.40, 'svemirski_vojnici.jpg', 1, '2013-02-09 13:26:33', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `items_to_purchases`
--

DROP TABLE IF EXISTS `items_to_purchases`;
CREATE TABLE IF NOT EXISTS `items_to_purchases` (
  `item_to_purchase_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fk_purchase_id` int(11) unsigned NOT NULL,
  `fk_item_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`item_to_purchase_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `items_to_purchases`
--

INSERT INTO `items_to_purchases` (`item_to_purchase_id`, `fk_purchase_id`, `fk_item_id`) VALUES
(7, 8, 2),
(8, 8, 3),
(9, 9, 1),
(10, 9, 22),
(11, 9, 4),
(12, 10, 4),
(13, 10, 3),
(14, 10, 23);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `page_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `page` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  PRIMARY KEY (`page_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`page_id`, `page`, `title`, `description`) VALUES
(1, 'home_page', 'HOME', 'Najbolji online shop u Srbiji!'),
(2, 'kontakt_page', 'KONTAKT', 'Tel: 018/555-555 <br />\r\nMob: 069/123-4567 <br />\r\nEmail: office@onslineshop.com');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

DROP TABLE IF EXISTS `purchases`;
CREATE TABLE IF NOT EXISTS `purchases` (
  `purchase_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fk_user_id` int(10) unsigned NOT NULL,
  `purchase_date` bigint(10) unsigned NOT NULL,
  `amount` int(6) unsigned NOT NULL,
  `total_price` float(10,2) NOT NULL,
  PRIMARY KEY (`purchase_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`purchase_id`, `fk_user_id`, `purchase_date`, `amount`, `total_price`) VALUES
(8, 2, 1388337946, 2, 2299.00),
(9, 2, 1389540424, 3, 34036.00),
(10, 2, 1416830421, 3, 33140.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(20) NOT NULL,
  `password` char(32) NOT NULL,
  `email` varchar(128) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `address` varchar(64) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `registration_date` bigint(10) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `email_code` char(5) NOT NULL,
  `fk_group_id` tinyint(1) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `login`, `password`, `email`, `first_name`, `last_name`, `address`, `phone`, `registration_date`, `active`, `email_code`, `fk_group_id`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@admin.com', 'Admin', 'Admin', '', '', 1360415797, 1, '', 1),
(2, 'member', 'aa08769cdcb26674c6706093503ff0a3', 'member@member.com', 'Member', 'Member', '', '', 1360415878, 1, '', 2),
(3, 'member2', '88ed421f060aadcacbd63f28d889797f', 'member2@member2.com', 'Member2', 'Member2', '', '', 1360416000, 1, '', 2),
(5, 'milos', 'e10adc3949ba59abbe56e057f20f883e', 'milos.milojevic@itcentar.rs', 'Miloš', 'Milojević', '', '141414', 1387706125, 1, '', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
