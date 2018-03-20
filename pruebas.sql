-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-03-2018 a las 15:16:53
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
(1, 'Nave 1', 2, 123, 234, 456),
(2, 'Caza de Darth Vader', 4, 123, 123, 123),
(3, 'efasfeaef', 4, 123, 213432, 234),
(4, 'Halcón Milenario', 10, 555, 666, 777);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `token`
--

CREATE TABLE `token` (
  `id` int(10) NOT NULL,
  `user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `token`
--

INSERT INTO `token` (`id`, `user`) VALUES
(1, 'pepe'),
(2, 'pepe'),
(3, 'prueba'),
(4, 'prueba'),
(5, 'pepon'),
(6, 'probando'),
(7, 'pepis'),
(8, 'pepe'),
(9, 'pepo'),
(10, 'pepo'),
(11, 'pepe'),
(12, 'prueba'),
(13, 'pepo'),
(14, 'pepe'),
(15, 'prueba'),
(16, 'pedro'),
(17, 'pep'),
(18, 'pepe');

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
-- AUTO_INCREMENT de la tabla `spaceship`
--
ALTER TABLE `spaceship`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `token`
--
ALTER TABLE `token`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `type`
--
ALTER TABLE `type`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
