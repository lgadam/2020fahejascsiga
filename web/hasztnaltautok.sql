-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1:3306
-- Létrehozás ideje: 2020. Ápr 13. 17:36
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