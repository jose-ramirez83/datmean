-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-03-2018 a las 19:01:57
-- Versión del servidor: 10.1.16-MariaDB
-- Versión de PHP: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pruebas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `spaceship`
--

CREATE TABLE `spaceship` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `id_type` int(2) NOT NULL,
  `x` int(10) NOT NULL,
  `y` int(10) NOT NULL,
  `z` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `spaceship`
--

INSERT INTO `spaceship` (`id`, `name`, `id_type`, `x`, `y`, `z`) VALUES
(10, 'Halcón milenario', 10, -532, 234, 432),
(12, 'X-Wing Luke', 11, 32, 43, 12),
(13, 'Darth Vader Ship 1', 1, 66, 55, 33),
(14, 'Darth Vader chip 2', 1, 21, 13, 23),
(15, 'Prueba halcón 2', 10, 3423, 234, 123);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `token`
--

CREATE TABLE `token` (
  `id` int(10) NOT NULL,
  `user` varchar(255) NOT NULL,
  `token` text NOT NULL,
  `fc_acceso` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `token`
--

INSERT INTO `token` (`id`, `user`, `token`, `fc_acceso`) VALUES
(1, 'pepe', '', '0000-00-00 00:00:00'),
(2, 'pepe', '', '0000-00-00 00:00:00'),
(3, 'prueba', '', '0000-00-00 00:00:00'),
(4, 'prueba', '', '0000-00-00 00:00:00'),
(5, 'pepon', '', '0000-00-00 00:00:00'),
(6, 'probando', '', '0000-00-00 00:00:00'),
(7, 'pepis', '', '0000-00-00 00:00:00'),
(8, 'pepe', '', '0000-00-00 00:00:00'),
(9, 'pepo', '', '0000-00-00 00:00:00'),
(10, 'pepo', '', '0000-00-00 00:00:00'),
(11, 'pepe', '', '0000-00-00 00:00:00'),
(12, 'prueba', '', '0000-00-00 00:00:00'),
(13, 'pepo', '', '0000-00-00 00:00:00'),
(14, 'pepe', '', '0000-00-00 00:00:00'),
(15, 'prueba', '', '0000-00-00 00:00:00'),
(16, 'pedro', '', '0000-00-00 00:00:00'),
(17, 'pep', '', '0000-00-00 00:00:00'),
(18, 'pepe', '', '0000-00-00 00:00:00'),
(19, 'soldado', '', '0000-00-00 00:00:00'),
(20, 'prueba', '', '0000-00-00 00:00:00'),
(21, 'pedro', '', '0000-00-00 00:00:00'),
(22, 'pepe', '', '0000-00-00 00:00:00'),
(23, 'pepito', '', '0000-00-00 00:00:00'),
(24, 'pepe', '', '2018-03-20 16:44:36'),
(25, 'pepo', '', '2018-03-20 17:33:14'),
(26, 'spaceship', '', '2018-03-20 17:39:32'),
(27, 'prueba', '', '2018-03-20 17:45:04'),
(28, 'soldado', '', '2018-03-20 17:59:12'),
(29, 'peter', '', '2018-03-20 18:15:38'),
(30, 'pepo', '', '2018-03-20 18:16:01'),
(31, 'padre', '', '2018-03-20 18:16:24'),
(32, 'pruebas', '', '2018-03-20 18:43:02'),
(33, 'pepe', '', '2018-03-20 18:44:49'),
(34, 'pepe', 'ZDQxZDhjZDk4ZjAwYjIwNGU5ODAwOTk4ZWNmODQyN2U=', '2018-03-20 18:51:16'),
(35, 'pepon', 'NGM1ODVmMmYyYzQ5MzIxNTExOTI2ODk1YzhmZjMxYmE=', '2018-03-20 18:54:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `type`
--

CREATE TABLE `type` (
  `id` int(10) NOT NULL,
  `type` int(2) NOT NULL,
  `ds_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tipo de la spacecraft.';

--
-- Volcado de datos para la tabla `type`
--

INSERT INTO `type` (`id`, `type`, `ds_type`) VALUES
(1, 1, 'Destructor Estelar'),
(2, 2, 'BTL Ala-Y'),
(3, 3, 'Firespray-31'),
(4, 4, 'Caza estelar N-1'),
(5, 5, 'TIE Avanzado X1'),
(6, 6, 'Lanzadera T-4a Lambda'),
(7, 7, 'Aerodeslizador T-47'),
(8, 8, 'TIE/LN'),
(10, 10, 'Halcón Milenario'),
(11, 9, 'T-65 Ala-X (X-Wing)');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `spaceship`
--
ALTER TABLE `spaceship`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_type` (`id_type`);

--
-- Indices de la tabla `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `spaceship`
--
ALTER TABLE `spaceship`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `token`
--
ALTER TABLE `token`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT de la tabla `type`
--
ALTER TABLE `type`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `spaceship`
--
ALTER TABLE `spaceship`
  ADD CONSTRAINT `id_type` FOREIGN KEY (`id_type`) REFERENCES `type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
