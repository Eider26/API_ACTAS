-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-06-2024 a las 19:45:28
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dw_2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acta`
--

CREATE TABLE `acta` (
  `id_acta` int(11) NOT NULL,
  `tema` varchar(255) NOT NULL,
  `contenido` text NOT NULL,
  `tipo` enum('publica','privada') NOT NULL,
  `id_reunion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acta_usuario`
--

CREATE TABLE `acta_usuario` (
  `id_acta` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compromiso`
--

CREATE TABLE `compromiso` (
  `id_compromiso` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha_limite` date NOT NULL,
  `estado` enum('pendiente','completado') NOT NULL,
  `id_acta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compromiso_usuario`
--

CREATE TABLE `compromiso_usuario` (
  `id_compromiso` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento`
--

CREATE TABLE `documento` (
  `id_documento` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `ruta` varchar(255) NOT NULL,
  `id_acta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reunion`
--

CREATE TABLE `reunion` (
  `id_reunion` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_finalizacion` time NOT NULL,
  `lugar` varchar(255) NOT NULL,
  `estado` enum('programada','reprogramada') NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `rol` enum('admin','invitado') NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contraseña` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `correo`, `rol`, `usuario`, `contraseña`) VALUES
(26, 'eider', 'barriosvviis44@gmail.com', '', 'eider21', '$2y$10$6eYPOs.6egeh9e8Gh5YuneO6TxPZVxjSYSuzcC4.KKMWTDcB19HHC'),
(27, 'luis rambao', 'luisito@gmail.com', 'admin', 'luisi24', '$2y$10$z/8ZnWK0OW1zlnq9s1z7Eu.SevDSGDcq2CjhWzvyAd5rQpIYtkGxK'),
(29, 'MATEO MARTINEZ', 'mateito@gmail.com', 'admin', 'sincelejo', '$2y$10$cdOIBri7OKff3TlwWIQVIesm/Ghnww5j6/ZyO/brpRp2TpD0AZieK'),
(30, 'dana', 'dana@gmail.com', 'invitado', 'dana', '$2y$10$GiIRAuLJ3Gu/Z5/6hhNfK..WvzMVwRWVTuV30fWvN6cGHuzN.ZxIm'),
(40, 'marolyn', 'maro@gmail.com', 'invitado', 'maro12', '$2y$10$HTA969fJ9mKxy18/FmseheSWQk/AujvF9Xc8Ico6Pw.ZHoE8ORfTq'),
(41, 'll', 'll@gmail.com', 'admin', 'llll', '$2y$10$7d7UEGQSo4knGjC1eSfzQe0T9zefpJ9S5/EY1b0lhBhWfn.jQh/O.');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acta`
--
ALTER TABLE `acta`
  ADD PRIMARY KEY (`id_acta`),
  ADD KEY `fk_id_reunion` (`id_reunion`);

--
-- Indices de la tabla `acta_usuario`
--
ALTER TABLE `acta_usuario`
  ADD PRIMARY KEY (`id_acta`,`id_usuario`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `compromiso`
--
ALTER TABLE `compromiso`
  ADD PRIMARY KEY (`id_compromiso`),
  ADD KEY `id_acta` (`id_acta`);

--
-- Indices de la tabla `compromiso_usuario`
--
ALTER TABLE `compromiso_usuario`
  ADD PRIMARY KEY (`id_compromiso`,`id_usuario`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `documento`
--
ALTER TABLE `documento`
  ADD PRIMARY KEY (`id_documento`),
  ADD KEY `id_acta` (`id_acta`);

--
-- Indices de la tabla `reunion`
--
ALTER TABLE `reunion`
  ADD PRIMARY KEY (`id_reunion`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acta`
--
ALTER TABLE `acta`
  MODIFY `id_acta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `compromiso`
--
ALTER TABLE `compromiso`
  MODIFY `id_compromiso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `documento`
--
ALTER TABLE `documento`
  MODIFY `id_documento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reunion`
--
ALTER TABLE `reunion`
  MODIFY `id_reunion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `acta`
--
ALTER TABLE `acta`
  ADD CONSTRAINT `fk_id_reunion` FOREIGN KEY (`id_reunion`) REFERENCES `reunion` (`id_reunion`);

--
-- Filtros para la tabla `acta_usuario`
--
ALTER TABLE `acta_usuario`
  ADD CONSTRAINT `acta_usuario_ibfk_1` FOREIGN KEY (`id_acta`) REFERENCES `acta` (`id_acta`),
  ADD CONSTRAINT `acta_usuario_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `compromiso`
--
ALTER TABLE `compromiso`
  ADD CONSTRAINT `compromiso_ibfk_1` FOREIGN KEY (`id_acta`) REFERENCES `acta` (`id_acta`);

--
-- Filtros para la tabla `compromiso_usuario`
--
ALTER TABLE `compromiso_usuario`
  ADD CONSTRAINT `compromiso_usuario_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `compromiso_usuario_ibfk_3` FOREIGN KEY (`id_compromiso`) REFERENCES `compromiso` (`id_compromiso`);

--
-- Filtros para la tabla `documento`
--
ALTER TABLE `documento`
  ADD CONSTRAINT `documento_ibfk_1` FOREIGN KEY (`id_acta`) REFERENCES `acta` (`id_acta`);

--
-- Filtros para la tabla `reunion`
--
ALTER TABLE `reunion`
  ADD CONSTRAINT `reunion_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
