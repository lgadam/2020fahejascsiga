-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1:3306
-- Létrehozás ideje: 2020. Ápr 15. 10:36
-- Kiszolgáló verziója: 5.7.26
-- PHP verzió: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `hasznaltautok`
--
--
-- Tábla szerkezet ehhez a táblához `hasznaltautok`-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1:3306
-- Létrehozás ideje: 2020. Ápr 06. 19:36
-- Kiszolgáló verziója: 5.7.26
-- PHP verzió: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `hasznaltautok`
--

DELIMITER $$

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `hasznaltautok`
--

DROP TABLE IF EXISTS `hasznaltautok`;
CREATE TABLE IF NOT EXISTS `hasznaltautok` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Cim` varchar(250) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `Marka` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `Tipus` varchar(50) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `Evjarat` varchar(15) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `Uzemanyag` varchar(15) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `Kilometer_Allas` varchar(250) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `Ar` int(250) DEFAULT NULL,
  `madeby` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `madeby` (`madeby`),
  KEY `madeby_2` (`madeby`)
) ENGINE=InnoDB AUTO_INCREMENT=324 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `hasznaltautok`
--

INSERT INTO `hasznaltautok` (`id`, `Cim`, `Marka`, `Tipus`, `Evjarat`, `Uzemanyag`, `Kilometer_Allas`, `Ar`, `madeby`) VALUES
(318, '3200 Gyöngyös', 'Honda', 'Civic', '2002', 'Benzin', '203123', 1230900, 1),
(319, '3200 Gyöngyös', 'Fiat', 'Stilo', '2008', 'Hibrid', '128000', 22323232, 2),
(320, '3300 Eger', 'Suzuki', 'Swift', '2004', 'Dízel', '321000', 2800000, 1),
(321, '3200 Gyöngyös', 'Ford', 'Focus', '1999', 'Benzin', '168091', 560000, 1),
(322, '1014', 'BMW', '320d', '2001', 'Dízel', '461082', 1290000, 1),
(323, '1012', 'Audi', 'A6', '2009', 'Dízel', '210921', 3190000, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `pwdreset`
--

DROP TABLE IF EXISTS `pwdreset`;
CREATE TABLE IF NOT EXISTS `pwdreset` (
  `pwdResetId` int(11) NOT NULL AUTO_INCREMENT,
  `pwdResetEmail` text COLLATE utf8_hungarian_ci NOT NULL,
  `pwdResetToken` longtext COLLATE utf8_hungarian_ci NOT NULL,
  `pwdResetExpires` text COLLATE utf8_hungarian_ci NOT NULL,
  PRIMARY KEY (`pwdResetId`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `pwdreset`
--

INSERT INTO `pwdreset` (`pwdResetId`, `pwdResetEmail`, `pwdResetToken`, `pwdResetExpires`) VALUES
(11, 'admin@admin.com', '3033710dffffa493c5ea1abe193b9eb5', '1563539341');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `userregistration`
--

DROP TABLE IF EXISTS `userregistration`;
CREATE TABLE IF NOT EXISTS `userregistration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `tel` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `activationcode` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `userregistration`
--

INSERT INTO `userregistration` (`id`, `name`, `email`, `tel`, `password`, `activationcode`, `status`, `admin`) VALUES
(1, 'admin', 'admin@admin.com', '06304093283', '$2y$15$N7qq/3tersYxsXDlu07sDO4djIqIJZAKfxSFQk6tBZ2pWeE2YMgti', '', 1, 1),
(2, 'Igen', 'igen@nem.com', '06123123123', '$2y$15$fwGPhUSHTghSB1JNiJDePeH4hRTkmiCn8W2/gH5HTqKW8WQxWNrYO', '10ece685a8380b17ebe7831d6ad3619c', 1, 0);

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `hasznaltautok`
--
ALTER TABLE `hasznaltautok`
  ADD CONSTRAINT `FG_hasznaltautok_userregistration` FOREIGN KEY (`madeby`) REFERENCES `userregistration` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

--

DROP TABLE IF EXISTS `hasznaltautok`;
CREATE TABLE IF NOT EXISTS `hasznaltautok` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Cim` varchar(250) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `Marka` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `Tipus` varchar(50) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `Evjarat` varchar(15) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `Uzemanyag` varchar(15) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `Kilometer_Allas` varchar(250) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `Ar` int(250) DEFAULT NULL,
  `madeby` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `madeby` (`madeby`),
  KEY `madeby_2` (`madeby`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `hasznaltautok`
--

INSERT INTO `hasznaltautok` (`id`, `Cim`, `Marka`, `Tipus`, `Evjarat`, `Uzemanyag`, `Kilometer_Allas`, `Ar`, `madeby`) VALUES
(1, '3200 Gyöngyös', 'Honda', 'Civic', '2002', 'Benzin', '203123', 1230900, 1),
(2, '3200 Gyöngyös', 'Fiat', 'Stilo', '2008', 'Hibrid', '128000', 22323232, 2),
(3, '3300 Eger', 'Suzuki', 'Swift', '2004', 'Dízel', '321000', 2800000, 1),
(4, '3200 Gyöngyös', 'Ford', 'Focus', '1999', 'Benzin', '168091', 560000, 1),
(5, '1014', 'BMW', '320d', '2001', 'Dízel', '461082', 1290000, 1),
(6, '1012', 'Audi', 'A6', '2009', 'Dízel', '210921', 3190000, 1);

-- --------------------------------------------------------
--
-- Tábla szerkezet ehhez a táblához `userregistration`
--

DROP TABLE IF EXISTS `userregistration`;
CREATE TABLE IF NOT EXISTS `userregistration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `tel` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `activationcode` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;
