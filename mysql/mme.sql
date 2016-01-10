-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 10. Jan 2016 um 17:14
-- Server-Version: 5.6.26
-- PHP-Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `mme`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `img` varchar(255) NOT NULL,
  `shop` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `article`
--

INSERT INTO `article` (`id`, `room_id`, `category_id`, `name`, `title`, `description`, `img`, `shop`, `website`, `updated_on`, `created_on`) VALUES
(2, 59, 7, 'Mustergültig', 'Garantiert nicht ausgemustert: Klassischer Wandteppich', 'Für ein gemütliches und wohnliches Zuhause: Mit diesem Stil können Sie garantiert nichts falsch machen. Sorgen Sie für ein schönes Ambiente in Ihrer Wohnung und lassen Sie Ihr Zuhause in einem neuen Look erstrahlen.', 'room1product1.jpg', 'IKEA', 'http://www.ikea.de', '2016-01-10 12:58:02', '2015-12-25 20:17:00'),
(3, 59, 8, 'Double-Denim', 'Fluffiges Kissen im Jeans Look', 'Für ein gemütliches und wohnliches Zuhause: Mit diesem Stil können Sie garantiert nichts falsch machen. Sorgen Sie für ein schönes Ambiente in Ihrer Wohnung und lassen Sie Ihr Zuhause in einem neuen Look erstrahlen.', 'room1product2.jpg', 'IKEA', 'http://www.ikea.de', '2015-12-25 20:17:30', '2015-12-25 20:17:30'),
(4, 59, 9, 'Wild West', 'Stilechte Deckenlampe mit Fransen', 'Für ein gemütliches und wohnliches Zuhause: Mit diesem Stil können Sie garantiert nichts falsch machen. Sorgen Sie für ein schönes Ambiente in Ihrer Wohnung und lassen Sie Ihr Zuhause in einem neuen Look erstrahlen.', 'room1product3.jpg', 'IKEA', 'http://www.ikea.de', '2015-12-25 20:18:10', '2015-12-25 20:18:10'),
(5, 61, 10, 'Essplatz-Allrounder', ' Quadratisch, praktisch, gut: Schlichter weißer Esstisch', 'Für ein gemütliches und wohnliches Zuhause: Mit diesem Stil können Sie garantiert nichts falsch machen. Sorgen Sie für ein schönes Ambiente in Ihrer Wohnung und lassen Sie Ihr Zuhause in einem neuen Look erstrahlen.', 'room2product1.jpg', 'IKEA', 'http://www.ikea.de', '2015-12-25 20:41:11', '2015-12-25 20:41:11'),
(6, 61, 11, 'Go Green!', ' Der Klassiker unter den Regalen - mit dem gewissen Extra!', 'Für ein gemütliches und wohnliches Zuhause: Mit diesem Stil können Sie garantiert nichts falsch machen. Sorgen Sie für ein schönes Ambiente in Ihrer Wohnung und lassen Sie Ihr Zuhause in einem neuen Look erstrahlen.', 'room2product2.jpg', 'IKEA', 'http://www.ikea.de', '2015-12-25 20:44:05', '2015-12-25 20:44:05'),
(7, 61, 12, 'Kreative Sitzgelegenheit', 'Immer eine Idee weiter: Der Zweisitzer für den Ess- oder Wohnbereich', 'Für ein gemütliches und wohnliches Zuhause: Mit diesem Stil können Sie garantiert nichts falsch machen. Sorgen Sie für ein schönes Ambiente in Ihrer Wohnung und lassen Sie Ihr Zuhause in einem neuen Look erstrahlen.', 'room2product3.jpg', 'IKEA', 'http://www.ikea.de', '2015-12-25 20:44:36', '2015-12-25 20:44:36'),
(8, 62, 13, 'Der Hänger', 'Eine Kleiderstange die hält, was an ihr hängt.', 'Für ein gemütliches und wohnliches Zuhause: Mit diesem Stil können Sie garantiert nichts falsch machen. Sorgen Sie für ein schönes Ambiente in Ihrer Wohnung und lassen Sie Ihr Zuhause in einem neuen Look erstrahlen.', 'room3product1.jpg', 'IKEA', 'http://www.ikea.de', '2015-12-25 20:47:34', '2015-12-25 20:47:34'),
(9, 62, 14, 'Kork dir einen!', 'Vielseitig einsetzbar: Kork-Untersetzer für Ihr Zuhause', 'Für ein gemütliches und wohnliches Zuhause: Mit diesem Stil können Sie garantiert nichts falsch machen. Sorgen Sie für ein schönes Ambiente in Ihrer Wohnung und lassen Sie Ihr Zuhause in einem neuen Look erstrahlen.', 'room3product2.jpg', 'IKEA', 'http://www.ikea.de', '2016-01-08 20:04:20', '2015-12-25 20:48:45'),
(10, 62, 14, 'Platz für Diverses', 'Schubladen-Denken: Darf im Kleiderschrank nicht fehlen!', 'Für ein gemütliches und wohnliches Zuhause: Mit diesem Stil können Sie garantiert nichts falsch machen. Sorgen Sie für ein schönes Ambiente in Ihrer Wohnung und lassen Sie Ihr Zuhause in einem neuen Look erstrahlen.', 'room3product3.jpg', 'IKEA', 'http://www.ikea.de', '2015-12-25 20:49:14', '2015-12-25 20:49:14'),
(11, 63, 12, 'Soft Skills', 'Gut für weiche Gemüter? Rosa farbenes Sofa für unvergessliche Fernsehabende', 'Für ein gemütliches und wohnliches Zuhause: Mit diesem Stil können Sie garantiert nichts falsch machen. Sorgen Sie für ein schönes Ambiente in Ihrer Wohnung und lassen Sie Ihr Zuhause in einem neuen Look erstrahlen.', 'room4product1.jpg', 'IKEA', 'http://www.ikea.de', '2015-12-25 20:55:12', '2015-12-25 20:55:12'),
(12, 63, 10, 'Stabile Lage', 'Ein Couchtisch, der seine Stil-Treue hält', 'Für ein gemütliches und wohnliches Zuhause: Mit diesem Stil können Sie garantiert nichts falsch machen. Sorgen Sie für ein schönes Ambiente in Ihrer Wohnung und lassen Sie Ihr Zuhause in einem neuen Look erstrahlen.', 'room4product2.jpg', 'IKEA', 'http://www.ikea.de', '2015-12-25 20:55:40', '2015-12-25 20:55:40'),
(13, 64, 10, 'Tischlein deck dich!', 'Dekorativ und zweckerfüllend: Wohnzimmertisch in weiß', 'Für ein gemütliches und wohnliches Zuhause: Mit diesem Stil können Sie garantiert nichts falsch machen. Sorgen Sie für ein schönes Ambiente in Ihrer Wohnung und lassen Sie Ihr Zuhause in einem neuen Look erstrahlen.', 'room5product1.jpg', 'IKEA', 'http://www.ikea.de', '2015-12-25 20:57:13', '2015-12-25 20:57:13'),
(14, 64, 7, 'Es ist so flauschig!', 'Ein Fest für die Füße: Kuschlig weicher Teppich in cremeweiß', 'Für ein gemütliches und wohnliches Zuhause: Mit diesem Stil können Sie garantiert nichts falsch machen. Sorgen Sie für ein schönes Ambiente in Ihrer Wohnung und lassen Sie Ihr Zuhause in einem neuen Look erstrahlen.', 'room5product2.jpg', 'IKEA', 'http://www.ikea.de', '2015-12-25 20:58:18', '2015-12-25 20:58:18'),
(15, 65, 14, 'Zarte Farben', 'Bestens geeignet für den ersten Kaffee am Morgen: Stilvolle Porzellan-Tassen', 'Für ein gemütliches und wohnliches Zuhause: Mit diesem Stil können Sie garantiert nichts falsch machen. Sorgen Sie für ein schönes Ambiente in Ihrer Wohnung und lassen Sie Ihr Zuhause in einem neuen Look erstrahlen.', 'room6product1.jpg', 'IKEA', 'http://www.ikea.de', '2015-12-25 20:59:53', '2015-12-25 20:59:53'),
(16, 66, 14, 'Eingetopft', 'Für Drinnen und Draußen: Der klassische Blumentopf aus Ton', 'Für ein gemütliches und wohnliches Zuhause: Mit diesem Stil können Sie garantiert nichts falsch machen. Sorgen Sie für ein schönes Ambiente in Ihrer Wohnung und lassen Sie Ihr Zuhause in einem neuen Look erstrahlen.', 'room7product1.jpg', 'IKEA', 'http://www.ikea.de', '2015-12-25 21:01:47', '2015-12-25 21:01:47'),
(17, 67, 7, 'Kuschel-Teppich', 'Ersatz für das Kuscheltier gesucht? Flauschiger Kuschel-Teppich sucht neuen Besitzer!', 'Für ein gemütliches und wohnliches Zuhause: Mit diesem Stil können Sie garantiert nichts falsch machen. Sorgen Sie für ein schönes Ambiente in Ihrer Wohnung und lassen Sie Ihr Zuhause in einem neuen Look erstrahlen.', 'room8product1.jpg', 'IKEA', 'http://www.ikea.de', '2015-12-25 21:02:57', '2015-12-25 21:02:57'),
(18, 68, 7, 'Keep Rolling!', 'Auf Rollen: Praktischer Couchtisch für Ihr Wohnzimmer', 'Für ein gemütliches und wohnliches Zuhause: Mit diesem Stil können Sie garantiert nichts falsch machen. Sorgen Sie für ein schönes Ambiente in Ihrer Wohnung und lassen Sie Ihr Zuhause in einem neuen Look erstrahlen.', 'room9product1.jpg', 'IKEA', 'http://www.ikea.de', '2015-12-25 21:04:01', '2015-12-25 21:04:01'),
(20, 69, 14, 'Rollmops', 'Schn', 'Für ein gemütliches und wohnliches Zuhause: Mit diesem Stil können Sie garantiert nichts falsch machen. Sorgen Sie für ein schönes Ambiente in Ihrer Wohnung und lassen Sie Ihr Zuhause in einem neuen Look erstrahlen.', 'slider1product1.jpg', 'IKEA', 'http://www.ikea.de', '2016-01-09 14:32:20', '2016-01-09 14:32:20'),
(21, 69, 14, 'Hock dich hin!', 'Für Faulenzer in der Küche - Praktisch zu jedem Anlass', 'Für ein gemütliches und wohnliches Zuhause: Mit diesem Stil können Sie garantiert nichts falsch machen. Sorgen Sie für ein schönes Ambiente in Ihrer Wohnung und lassen Sie Ihr Zuhause in einem neuen Look erstrahlen.', 'slider1product2.jpg', 'IKEA', 'http://www.ikea.de', '2016-01-09 15:38:41', '2016-01-09 15:38:41'),
(22, 69, 14, 'Du Lappen!', 'Falls es in der Küche mal zu heiß wird: Diese Topflappen lassen nichts anbrennen!', 'Für ein gemütliches und wohnliches Zuhause: Mit diesem Stil können Sie garantiert nichts falsch machen. Sorgen Sie für ein schönes Ambiente in Ihrer Wohnung und lassen Sie Ihr Zuhause in einem neuen Look erstrahlen.', 'slider1product3.jpg', 'IKEA', 'http://www.ikea.de', '2016-01-09 15:40:25', '2016-01-09 15:40:25'),
(23, 70, 7, 'Schachmatt!', 'Mit jedem Zug ein Gewinn - Für den echten Küchenstrategen!', 'Für ein gemütliches und wohnliches Zuhause: Mit diesem Stil können Sie garantiert nichts falsch machen. Sorgen Sie für ein schönes Ambiente in Ihrer Wohnung und lassen Sie Ihr Zuhause in einem neuen Look erstrahlen.', 'slider2product1.jpg', 'IKEA', 'http://www.ikea.de', '2016-01-09 15:41:59', '2016-01-09 15:41:59'),
(24, 70, 10, 'Guten Appetit!', 'Für große und kleine Mäuler - Genug Platz für jede Mahlzeit!', 'Für ein gemütliches und wohnliches Zuhause: Mit diesem Stil können Sie garantiert nichts falsch machen. Sorgen Sie für ein schönes Ambiente in Ihrer Wohnung und lassen Sie Ihr Zuhause in einem neuen Look erstrahlen.', 'slider2product2.jpg', 'IKEA', 'http://www.ikea.de', '2016-01-09 15:43:11', '2016-01-09 15:43:11'),
(25, 70, 9, 'Erleuchtung', 'Damit Ihnen Zuhause ein Licht aufgeht!', 'Für ein gemütliches und wohnliches Zuhause: Mit diesem Stil können Sie garantiert nichts falsch machen. Sorgen Sie für ein schönes Ambiente in Ihrer Wohnung und lassen Sie Ihr Zuhause in einem neuen Look erstrahlen.', 'slider2product3.jpg', 'IKEA', 'http://www.ikea.de', '2016-01-09 15:44:34', '2016-01-09 15:44:34'),
(26, 71, 15, 'Richtig Ruhig Relaxen', 'Entspannt den Nachmittag genießen!', 'Für ein gemütliches und wohnliches Zuhause: Mit diesem Stil können Sie garantiert nichts falsch machen. Sorgen Sie für ein schönes Ambiente in Ihrer Wohnung und lassen Sie Ihr Zuhause in einem neuen Look erstrahlen.', 'slider3product1.jpg', 'IKEA', 'http://www.ikea.de', '2016-01-09 15:55:04', '2016-01-09 15:55:04'),
(27, 71, 11, 'Kommoden Kuddelmuddel', 'Für die Schubladendenker! Kein Fach ist zu klein.', 'Für ein gemütliches und wohnliches Zuhause: Mit diesem Stil können Sie garantiert nichts falsch machen. Sorgen Sie für ein schönes Ambiente in Ihrer Wohnung und lassen Sie Ihr Zuhause in einem neuen Look erstrahlen.', 'slider3product2.jpg', 'IKEA', 'http://www.ikea.de', '2016-01-10 13:40:26', '2016-01-09 15:56:10'),
(28, 71, 10, 'Weißer Traum', 'Quadratisch, praktisch, gut: Schlichter weißer Couchtisch', 'Für ein gemütliches und wohnliches Zuhause: Mit diesem Stil können Sie garantiert nichts falsch machen. Sorgen Sie für ein schönes Ambiente in Ihrer Wohnung und lassen Sie Ihr Zuhause in einem neuen Look erstrahlen.', 'slider3product3.jpg', 'IKEA', 'http://www.ikea.de', '2016-01-09 15:57:52', '2016-01-09 15:57:52');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `category`
--

INSERT INTO `category` (`id`, `name`, `updated_at`, `created_at`) VALUES
(7, 'Teppiche', '2016-01-08 21:54:45', '2016-01-08 21:54:45'),
(8, 'Kissen', '2015-12-25 20:09:29', '2015-12-25 20:09:29'),
(9, 'Lampen', '2015-12-25 20:09:38', '2015-12-25 20:09:38'),
(10, 'Tische', '2015-12-25 20:09:49', '2015-12-25 20:09:49'),
(11, 'Regale', '2015-12-25 20:10:04', '2015-12-25 20:10:04'),
(12, 'Sofas', '2015-12-25 20:10:21', '2015-12-25 20:10:21'),
(13, 'Kleiderständer', '2015-12-25 20:10:44', '2015-12-25 20:10:44'),
(14, 'Sonstiges', '2015-12-25 20:10:53', '2015-12-25 20:10:53'),
(15, 'Stühle', '2016-01-09 15:53:51', '2016-01-09 15:53:51');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `client`
--

INSERT INTO `client` (`id`, `name`, `lastname`, `email`, `password`, `updated_at`, `created_at`) VALUES
(1, 'Robert', 'Dziuba', 'robert@robert.de', 'e10adc3949ba59abbe56e057f20f883e', '2015-12-14 20:49:41', '0000-00-00 00:00:00'),
(6, 'Inga', 'Schwarze', 'inga@schwarze.de', 'e10adc3949ba59abbe56e057f20f883e', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `department`
--

INSERT INTO `department` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Wohnzimmer', '2016-01-08 21:44:43', '2016-01-08 21:44:43'),
(2, 'Küche', '2015-12-17 21:20:53', '2015-12-17 21:20:53'),
(15, 'Bad', '2015-12-17 21:20:47', '2015-12-17 21:20:47'),
(16, 'Schlafzimmer', '2015-12-17 21:20:42', '2015-12-17 21:20:42'),
(19, 'Flur', '2015-12-17 21:20:36', '2015-12-17 21:20:36'),
(23, 'Keller', '2015-12-17 21:20:31', '2015-12-17 21:20:31'),
(24, 'Garten', '2015-12-17 21:20:18', '2015-12-17 21:20:18'),
(25, 'Esszimmer', '2015-12-22 21:55:30', '2015-12-22 21:55:30');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `room`
--

CREATE TABLE IF NOT EXISTS `room` (
  `id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `img` varchar(255) NOT NULL,
  `slider` blob NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `room`
--

INSERT INTO `room` (`id`, `department_id`, `client_id`, `name`, `title`, `description`, `img`, `slider`, `updated_at`, `created_at`) VALUES
(59, 25, 6, 'Robust & Gemütlich', 'Rustikales Wohnen im traditionellen Design', 'Für ein gemütliches und wohnliches Zuhause: Mit diesem Stil können Sie garantiert nichts falsch machen. Sorgen Sie für ein schönes Ambiente in Ihrer Wohnung und lassen Sie Ihr Zuhause in einem neuen Look erstrahlen.', 'room1.jpg', 0x30, '2016-01-09 14:56:33', '2016-01-09 14:56:33'),
(61, 25, 6, 'Für Lebenskünstler', 'Bringen Sie mehr Farbe in Ihr Esszimmer!', 'Für ein gemütliches und wohnliches Zuhause: Mit diesem Stil können Sie garantiert nichts falsch machen. Sorgen Sie für ein schönes Ambiente in Ihrer Wohnung und lassen Sie Ihr Zuhause in einem neuen Look erstrahlen.', 'room2.jpg', 0x30, '2015-12-25 20:20:33', '2015-12-25 20:20:33'),
(62, 16, 1, 'Für Detailverliebte', 'Gut verstaut: Hier ist Platz für all Ihre Lieblingsstücke', 'Für ein gemütliches und wohnliches Zuhause: Mit diesem Stil können Sie garantiert nichts falsch machen. Sorgen Sie für ein schönes Ambiente in Ihrer Wohnung und lassen Sie Ihr Zuhause in einem neuen Look erstrahlen.', 'room3.jpg', 0x30, '2015-12-25 20:46:52', '2015-12-25 20:46:52'),
(63, 1, 1, 'Zarte Töne', 'Softe Farben für Ihr Zuhause', 'Für ein gemütliches und wohnliches Zuhause: Mit diesem Stil können Sie garantiert nichts falsch machen. Sorgen Sie für ein schönes Ambiente in Ihrer Wohnung und lassen Sie Ihr Zuhause in einem neuen Look erstrahlen.', 'room4.jpg', 0x30, '2015-12-25 20:50:39', '2015-12-25 20:50:39'),
(64, 1, 6, 'All White', 'Wohnliche Leichtigkeit: Weiß bringt Ihnen den Frische-Kick ins Wohnzimmer!', 'Für ein gemütliches und wohnliches Zuhause: Mit diesem Stil können Sie garantiert nichts falsch machen. Sorgen Sie für ein schönes Ambiente in Ihrer Wohnung und lassen Sie Ihr Zuhause in einem neuen Look erstrahlen.', 'room5.jpg', 0x30, '2015-12-25 20:56:32', '2015-12-25 20:56:32'),
(65, 2, 1, 'Pretty in Pastel', 'Fröhlichkeit kommt jetzt in Porzellan daher!', 'Für ein gemütliches und wohnliches Zuhause: Mit diesem Stil können Sie garantiert nichts falsch machen. Sorgen Sie für ein schönes Ambiente in Ihrer Wohnung und lassen Sie Ihr Zuhause in einem neuen Look erstrahlen.', 'room6.jpg', 0x30, '2015-12-25 20:59:20', '2015-12-25 20:59:20'),
(66, 2, 1, 'Allerlei für die Küche', 'Holen Sie sich den Garten in die Küche!', 'Für ein gemütliches und wohnliches Zuhause: Mit diesem Stil können Sie garantiert nichts falsch machen. Sorgen Sie für ein schönes Ambiente in Ihrer Wohnung und lassen Sie Ihr Zuhause in einem neuen Look erstrahlen.', 'room7.jpg', 0x30, '2015-12-25 21:00:58', '2015-12-25 21:00:58'),
(67, 16, 6, 'Schöne Träume', 'Zum Einschlafen schön: Schlaf-Gelegenheiten in ihrer gemütlichsten Form', 'Für ein gemütliches und wohnliches Zuhause: Mit diesem Stil können Sie garantiert nichts falsch machen. Sorgen Sie für ein schönes Ambiente in Ihrer Wohnung und lassen Sie Ihr Zuhause in einem neuen Look erstrahlen.', 'room8.jpg', 0x30, '2016-01-10 13:31:41', '2016-01-10 13:31:41'),
(68, 1, 1, 'Akzente setzen', 'Gegensätze ziehen sich an: Sezten Sie Akzente in Ihrem Wohnzimmer!', 'Für ein gemütliches und wohnliches Zuhause: Mit diesem Stil können Sie garantiert nichts falsch machen. Sorgen Sie für ein schönes Ambiente in Ihrer Wohnung und lassen Sie Ihr Zuhause in einem neuen Look erstrahlen.', 'room9.jpg', 0x30, '2015-12-25 21:03:30', '2015-12-25 21:03:30'),
(69, 2, 1, 'Kühl & Elegant ', 'Zeitloser Klassiker: Die moderne Küche aus Edelstahl', 'Für ein gemütliches und wohnliches Zuhause: Mit diesem Stil können Sie garantiert nichts falsch machen. Sorgen Sie für ein schönes Ambiente in Ihrer Wohnung und lassen Sie Ihr Zuhause in einem neuen Look erstrahlen.', 'slider1.jpg', 0x31, '2016-01-10 13:34:59', '2016-01-10 13:34:59'),
(70, 2, 6, 'Auf die Details kommt es an', 'Ob modern, schlicht oder elegant. Hier isst das Auge mit!', 'Für ein gemütliches und wohnliches Zuhause: Mit diesem Stil können Sie garantiert nichts falsch machen. Sorgen Sie für ein schönes Ambiente in Ihrer Wohnung und lassen Sie Ihr Zuhause in einem neuen Look erstrahlen.', 'slider2.jpg', 0x31, '2016-01-10 13:29:17', '2016-01-10 13:29:17'),
(71, 1, 6, 'Natürlich chillen', 'Für Genießer: Weiß bringt Ihnen den Frische-Kick ins Wohnzimmer!', 'Für ein gemütliches und wohnliches Zuhause: Mit diesem Stil können Sie garantiert nichts falsch machen. Sorgen Sie für ein schönes Ambiente in Ihrer Wohnung und lassen Sie Ihr Zuhause in einem neuen Look erstrahlen.', 'slider3.jpg', 0x31, '2016-01-10 13:29:46', '2016-01-10 13:29:46');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indizes für die Tabelle `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indizes für die Tabelle `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indizes für die Tabelle `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indizes für die Tabelle `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `client_id` (`client_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT für Tabelle `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT für Tabelle `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT für Tabelle `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT für Tabelle `room`
--
ALTER TABLE `room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=72;
--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`),
  ADD CONSTRAINT `article_ibfk_4` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Constraints der Tabelle `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`),
  ADD CONSTRAINT `room_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
