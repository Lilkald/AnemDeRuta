-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 27-05-2023 a las 17:37:20
-- Versión del servidor: 5.7.31
-- Versión de PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `anemderuta`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `missatge`
--

DROP TABLE IF EXISTS `missatge`;
CREATE TABLE IF NOT EXISTS `missatge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `gmail` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `numTelef` int(11) NOT NULL,
  `missatge` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `missatge`
--

INSERT INTO `missatge` (`id`, `nom`, `gmail`, `numTelef`, `missatge`) VALUES
(1, 'wdasd', 'ricardesra@gmail.com', 1235436, 'awdasdw'),
(2, 'wdasd', 'ricardesra@gmail.com', 1235436, 'awdasdw');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutas`
--

DROP TABLE IF EXISTS `rutas`;
CREATE TABLE IF NOT EXISTS `rutas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `dificultad` int(11) NOT NULL,
  `descripcio` text COLLATE utf8_spanish_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `latitud_inicial` decimal(50,10) NOT NULL,
  `latitud_final` decimal(50,10) NOT NULL,
  `longitud_inicial` decimal(50,10) NOT NULL,
  `longitud_final` decimal(50,10) NOT NULL,
  `tipus` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=108 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `rutas`
--

INSERT INTO `rutas` (`id`, `nombre`, `dificultad`, `descripcio`, `user_id`, `created_date`, `latitud_inicial`, `latitud_final`, `longitud_inicial`, `longitud_final`, `tipus`) VALUES
(103, 'motorismo eagle vs tigers', 3, 'asdada', NULL, '2023-05-23 12:08:06', '41.5515865686', '41.5200744014', '2.0735588563', '2.1252447136', 'moto'),
(102, 'sabadell-polinya', 5, 'lkmlkm', NULL, '2023-05-22 11:37:36', '41.5449250603', '41.5207478051', '2.1000878985', '2.1242889311', 'coche'),
(100, 'sabadell-polinya', 3, 'ruta molt agradable, molta naturalesa', NULL, '2023-05-20 16:00:39', '41.5408941841', '41.5574797026', '2.1161488614', '2.1580286625', 'coche'),
(104, 'asdsada', 3, 'dasdsad', NULL, '2023-05-23 12:55:40', '41.5554112799', '41.5528395858', '2.0123964420', '2.0934453612', 'caminar'),
(106, 'Julianno Mileto', 2, 'juliano MIleto', NULL, '2023-05-23 13:11:19', '41.5429376081', '41.5629971815', '2.0225275569', '2.0960210683', 'caminar'),
(107, 'RUTA de las putas', 5, 'eres una putilla bien golda', NULL, '2023-05-27 18:58:59', '41.6138207658', '41.6343654544', '2.0834133430', '2.1692702489', 'coche');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguidors`
--

DROP TABLE IF EXISTS `seguidors`;
CREATE TABLE IF NOT EXISTS `seguidors` (
  `id_seguidor` int(11) NOT NULL,
  `id_seguit` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuaris`
--

DROP TABLE IF EXISTS `usuaris`;
CREATE TABLE IF NOT EXISTS `usuaris` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `usuari` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `nom` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `cognom` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `descripcio` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `tipus` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `gmail` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `contrassenya` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `numRutes` int(11) NOT NULL,
  `seguidors` int(11) NOT NULL,
  `seguits` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuaris`
--

INSERT INTO `usuaris` (`ID`, `usuari`, `nom`, `cognom`, `descripcio`, `tipus`, `gmail`, `contrassenya`, `numRutes`, `seguidors`, `seguits`) VALUES
(1, 'Ricardet', 'Ricard ', 'Esteban Rambla', 'Hola molt bona tarda', 'admin', 'ricardesra@gmail.com', '123', 0, 0, 0),
(2, 'asd', 'asd', 'asd', '', 'admin', 'ricardesra@gmail.com', 'asd', 0, 0, 0),
(3, 'Estevet', 'Esteve', 'Riba', '', 'admin', 'estevet@gmail.com', '123', 0, 0, 0),
(17, 'Ricard', 'Ricard', 'Esteban', 'Hola molt bona tarda', 'usuari', 'ricardesra@gmail.com', '123', 0, 0, 0),
(15, 'Juanma', 'Juanma', 'asdas', '', 'usuari', 'ricardesra@gmail.com', 'asd', 0, 0, 0),
(13, 'asdwfesadf', 'sdfaf', 'AWEFAWEF', '', 'usuari', 'ricardesra@gmail.com', 'asd', 0, 0, 0),
(18, 'Ricard', 'Ricard', 'Esteban', '', 'usuari', 'ricardesra@gmail.com', '123', 0, 0, 0),
(29, 'Prova', 'Proveta', 'Provota', '', 'usuari', 'prova@gmail.com', '123', 0, 0, 0),
(31, 'wdasda', 'wdasdawda', 'sdawdasdawd', '', 'usuari', 'ricardesra@gmail.com', 'wdasd', 0, 0, 0),
(32, 'wdasda', 'wdasdawda', 'sdawdasdawd', '', 'usuari', 'ricardesra@gmail.com', 'wdasd', 0, 0, 0),
(33, 'Estevet del cul estret', 'Estevet', 'Ribanet', '', 'usuari', 'estevet@gmail.com', '123', 0, 0, 0),
(35, 'paco', 'paco', 'pintamonas', 'Soc en paco encatat o encantada ;)', 'usuari', 'pintamonas@gmail.com', '123', 4, 0, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
