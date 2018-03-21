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
(9, 9, 'T-65 Ala-X (X-Wing)'),
(10, 10, 'Halcón Milenario');


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
-- AUTO_INCREMENT de la tabla `type`
--
ALTER TABLE `type`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
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
