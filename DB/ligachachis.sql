-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 10-12-2023 a las 03:04:06
-- Versión del servidor: 8.0.30
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ligachachis`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alineaciones`
--

CREATE TABLE `alineaciones` (
  `idJugador` varchar(60) NOT NULL,
  `idEquipo` varchar(60) NOT NULL,
  `camiseta` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `idEquipo` varchar(60) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `afavor` int NOT NULL,
  `contra` int NOT NULL,
  `empatados` int NOT NULL,
  `ganados` int NOT NULL,
  `puntos` int NOT NULL,
  `perdidos` int NOT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `idEntrenador` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`idEquipo`, `nombre`, `afavor`, `contra`, `empatados`, `ganados`, `puntos`, `perdidos`, `foto`, `idEntrenador`) VALUES
('equipo657264785ac3a', 'UNAM', 0, 0, 0, 0, 0, 0, NULL, 'user6574892d44768'),
('equipo657289a858f3f', 'Atlético San Pancho', 0, 0, 0, 0, 0, 0, NULL, NULL),
('equipo6572a9548f867', 'America', 0, 0, 0, 0, 0, 0, '', NULL),
('equipo6572bb25d4d1c', 'Barca', 0, 0, 0, 0, 0, 0, 'Barca_63.png', NULL),
('equipo6572bdba5a87d', 'Real Madrid', 0, 0, 0, 0, 0, 0, 'Real_Madrid_36.png', NULL),
('equipo657354629c373', 'Atlas', 0, 0, 0, 0, 0, 0, '', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugadores`
--

CREATE TABLE `jugadores` (
  `nombre` varchar(60) NOT NULL,
  `apellido` varchar(60) NOT NULL,
  `edad` int NOT NULL,
  `equipo` varchar(100) NOT NULL,
  `camiseta` int NOT NULL,
  `posicion` varchar(60) NOT NULL,
  `idJugador` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `jugadores`
--

INSERT INTO `jugadores` (`nombre`, `apellido`, `edad`, `equipo`, `camiseta`, `posicion`, `idJugador`) VALUES
('Leonel', 'Messi', 37, 'equipo657264785ac3a', 0, 'DC', 'qwertasdfq');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partidos`
--

CREATE TABLE `partidos` (
  `idPartido` varchar(60) NOT NULL,
  `jornada` int NOT NULL,
  `equipolocal` varchar(60) NOT NULL,
  `equipoVisitante` varchar(60) NOT NULL,
  `jugado` tinyint(1) NOT NULL,
  `marcadorLocal` int NOT NULL,
  `marcadorVisitante` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `partidos`
--

INSERT INTO `partidos` (`idPartido`, `jornada`, `equipolocal`, `equipoVisitante`, `jugado`, `marcadorLocal`, `marcadorVisitante`) VALUES
('partido6575260aa52f6', 1, 'equipo657264785ac3a', 'equipo657354629c373', 1, 0, 0),
('partido6575260b2f21a', 1, 'equipo657289a858f3f', 'equipo6572bdba5a87d', 1, 0, 0),
('partido6575260b3aa96', 1, 'equipo6572a9548f867', 'equipo6572bb25d4d1c', 1, 0, 0),
('partido6575260b3feb8', 2, 'equipo657264785ac3a', 'equipo6572bdba5a87d', 1, 0, 0),
('partido6575260b457aa', 2, 'equipo657354629c373', 'equipo6572bb25d4d1c', 1, 0, 0),
('partido6575260b4ac28', 2, 'equipo657289a858f3f', 'equipo6572a9548f867', 1, 0, 0),
('partido6575260b5064d', 3, 'equipo657264785ac3a', 'equipo6572bb25d4d1c', 1, 0, 0),
('partido6575260b559c0', 3, 'equipo6572bdba5a87d', 'equipo6572a9548f867', 1, 0, 0),
('partido6575260b71be6', 3, 'equipo657354629c373', 'equipo657289a858f3f', 1, 0, 0),
('partido6575260b762b5', 4, 'equipo657264785ac3a', 'equipo6572a9548f867', 1, 0, 0),
('partido6575260b7bbe9', 4, 'equipo6572bb25d4d1c', 'equipo657289a858f3f', 1, 0, 0),
('partido6575260b81089', 4, 'equipo6572bdba5a87d', 'equipo657354629c373', 1, 0, 0),
('partido6575260b869a6', 5, 'equipo657264785ac3a', 'equipo657289a858f3f', 1, 0, 0),
('partido6575260bc251c', 5, 'equipo6572a9548f867', 'equipo657354629c373', 1, 0, 0),
('partido6575260be5671', 5, 'equipo6572bb25d4d1c', 'equipo6572bdba5a87d', 1, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `torneos`
--

CREATE TABLE `torneos` (
  `idTorneo` varchar(60) NOT NULL,
  `enjuego` tinyint(1) NOT NULL DEFAULT '0',
  `campeon` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `torneos`
--

INSERT INTO `torneos` (`idTorneo`, `enjuego`, `campeon`) VALUES
('torneo6575260bf33c0', 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` varchar(60) NOT NULL,
  `rol` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `contraseña` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `username` varchar(60) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `apellido` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `rol`, `contraseña`, `username`, `nombre`, `apellido`) VALUES
('user6574892d44768', 'entrenador', '$2y$10$0wGcEiXIk5grrx3FtUyZn.kbST6qN5f2d9hxrRCoImYVr1r8.Lj0K', 'jorge15', 'Jorge', 'Ruano'),
('user65748dbf0335a', 'administrador', '$2y$10$MEwDFTSOIaz56.nnvxXEqe9vNbkpv3TEbKXSbNeQr5iqshoBLifYy', 'alexis15', 'Alexis', 'Millan'),
('user657496ad04fb1', 'entrenador', '$2y$10$qsqwB.kywcKQ6e73nPyEgeJZ79v0vxmEQvNyVNCnsrFESjnuW4zTC', 'vane15', 'Vane', 'Rivera');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alineaciones`
--
ALTER TABLE `alineaciones`
  ADD PRIMARY KEY (`idEquipo`),
  ADD KEY `idJugador` (`idJugador`),
  ADD KEY `idEquipo` (`idEquipo`);

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`idEquipo`);

--
-- Indices de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  ADD PRIMARY KEY (`idJugador`);

--
-- Indices de la tabla `partidos`
--
ALTER TABLE `partidos`
  ADD PRIMARY KEY (`idPartido`),
  ADD KEY `equipolocal` (`equipolocal`),
  ADD KEY `equipoVisitante` (`equipoVisitante`),
  ADD KEY `equipolocal_2` (`equipolocal`);

--
-- Indices de la tabla `torneos`
--
ALTER TABLE `torneos`
  ADD PRIMARY KEY (`idTorneo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alineaciones`
--
ALTER TABLE `alineaciones`
  ADD CONSTRAINT `alineaciones_ibfk_1` FOREIGN KEY (`idEquipo`) REFERENCES `equipos` (`idEquipo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `alineaciones_ibfk_2` FOREIGN KEY (`idJugador`) REFERENCES `jugadores` (`idJugador`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
