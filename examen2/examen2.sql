-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-04-2019 a las 01:05:13
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `examen2`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_edita_entrada` (IN `v_evento` INT(10), IN `v_ubicacion` VARCHAR(25), IN `v_costo_unitario` DECIMAL(10,2), IN `v_espacios` INT(10), IN `v_ID` INT)  BEGIN

UPDATE entrada SET UBICACION=v_ubicacion, COSTO_UNITARIO=v_costo_unitario, ESPACIOS=v_espacios where ID=v_ID;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_inserta_entrada` (IN `v_evento` INT(10), IN `v_ubicacion` VARCHAR(50), IN `v_costo_unitario` DECIMAL(10,2), IN `v_espacios` INT(10))  BEGIN

SET @servicio := v_costo_unitario * 0.13 ;

select ESCENARIO into @escenario from evento where ID=  v_evento;


INSERT INTO entrada(EVENTO, ESCENARIO, UBICACION, COSTO_UNITARIO, COSTO_SERVICIO, ESPACIOS)
VALUES (v_evento, @escenario, v_ubicacion, v_costo_unitario, @servicio, v_espacios  );

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrada`
--

CREATE TABLE `entrada` (
  `ID` int(11) NOT NULL,
  `EVENTO` int(11) NOT NULL,
  `ESCENARIO` int(11) NOT NULL,
  `UBICACION` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `COSTO_UNITARIO` decimal(8,2) NOT NULL,
  `COSTO_SERVICIO` decimal(8,2) NOT NULL,
  `ESPACIOS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `entrada`
--

INSERT INTO `entrada` (`ID`, `EVENTO`, `ESCENARIO`, `UBICACION`, `COSTO_UNITARIO`, `COSTO_SERVICIO`, `ESPACIOS`) VALUES
(1, 1, 1, 'A2', '500.00', '65.00', 100),
(2, 1, 1, 'A3', '600.00', '78.00', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escenario`
--

CREATE TABLE `escenario` (
  `ID` int(11) NOT NULL,
  `CODIGO` char(5) COLLATE latin1_spanish_ci NOT NULL,
  `NOMBRE` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
  `TIPO` tinyint(10) NOT NULL,
  `PROVINCIA` char(1) COLLATE latin1_spanish_ci NOT NULL,
  `CANTON` char(3) COLLATE latin1_spanish_ci NOT NULL,
  `DISTRITO` char(5) COLLATE latin1_spanish_ci NOT NULL,
  `DIRECCION` varchar(300) COLLATE latin1_spanish_ci NOT NULL,
  `NOMBRE_CONTACTO` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `TELEFONO_CONTACTO` int(8) NOT NULL,
  `EMAIL_CONTACTO` varchar(100) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `escenario`
--

INSERT INTO `escenario` (`ID`, `CODIGO`, `NOMBRE`, `TIPO`, `PROVINCIA`, `CANTON`, `DISTRITO`, `DIRECCION`, `NOMBRE_CONTACTO`, `TELEFONO_CONTACTO`, `EMAIL_CONTACTO`) VALUES
(1, 'ENAC', 'ESTADIO NACIONAL', 2, '1', '2', '1', 'LA SABANA', 'JUAN PEREZ', 88888888, 'JPEREZ@CORREO.COM');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE `evento` (
  `ID` int(11) NOT NULL,
  `CODIGO` char(5) COLLATE latin1_spanish_ci NOT NULL,
  `NOMBRE` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
  `DESCRIPCION` varchar(3000) COLLATE latin1_spanish_ci NOT NULL,
  `ESCENARIO` int(11) NOT NULL,
  `FECHA` date NOT NULL,
  `HORA` time NOT NULL,
  `TIPO` tinyint(4) NOT NULL,
  `CONDICIONES` text COLLATE latin1_spanish_ci NOT NULL,
  `EDAD` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `evento`
--

INSERT INTO `evento` (`ID`, `CODIGO`, `NOMBRE`, `DESCRIPCION`, `ESCENARIO`, `FECHA`, `HORA`, `TIPO`, `CONDICIONES`, `EDAD`) VALUES
(1, 'CO1', 'CONCIERTO #1', 'CONCIERTO DE PRUEBA<br>', 1, '2019-04-17', '08:50:00', 1, 'NINGUNA', 18),
(3, 'CO2', 'CONCIERTO #2', 'PRUEBA #2<br>', 1, '2019-04-12', '10:30:00', 1, 'NINGUNA', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento_vendedor`
--

CREATE TABLE `evento_vendedor` (
  `EVENTO` int(11) NOT NULL,
  `VENDEDOR` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `evento_vendedor`
--

INSERT INTO `evento_vendedor` (`EVENTO`, `VENDEDOR`) VALUES
(1, 1),
(2, 1),
(2, 2),
(3, 1),
(3, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `ID` int(11) NOT NULL,
  `NOMBRE` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `EMAIL` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `TELEFONO` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
  `NICK` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
  `PASSWORD` varchar(255) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`ID`, `NOMBRE`, `EMAIL`, `TELEFONO`, `NICK`, `PASSWORD`) VALUES
(1, 'Administrador', 'admin@admin.cr', '88888888', 'admin', '7fcf4ba391c48784edde599889d6e3f1e47a27db36ecc050cc92f259bfac38afad2c68a1ae804d77075e8fb722503f3eca2b2c1006ee6f6c7b7628cb45fffd1d'),
(2, 'usuario1', 'usuario@admin.cr', '88888888', 'usuario1', '06844fe66b5fd3753dee2ee7c15f79f1e29956a0a2e724bfeb8e7cfb428a1082cb0eb9026948810c406321a4fb732ad68105eb2dc119d5f2c64f414d339f1294');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendedor`
--

CREATE TABLE `vendedor` (
  `ID` int(11) NOT NULL,
  `CEDULA` int(11) NOT NULL,
  `NOMBRE` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `DIRECCION` varchar(300) COLLATE latin1_spanish_ci NOT NULL,
  `EMAIL` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `TELEFONO` char(8) COLLATE latin1_spanish_ci NOT NULL,
  `HORARIO` varchar(1) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `vendedor`
--

INSERT INTO `vendedor` (`ID`, `CEDULA`, `NOMBRE`, `DIRECCION`, `EMAIL`, `TELEFONO`, `HORARIO`) VALUES
(1, 113700455, 'Andres Camacho', 'Cartago', 'admin@admin.cr', '2222222', '3'),
(2, 113700458, 'Juan Perez', 'Cartago', 'l@correo.com', '888888', '1'),
(3, 8888895, 'Luis Perez', 'San Jose', 'lperez@correo.com', '8888888', '3');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `entrada`
--
ALTER TABLE `entrada`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ESCENARIO` (`ESCENARIO`),
  ADD KEY `EVENTO` (`EVENTO`);

--
-- Indices de la tabla `escenario`
--
ALTER TABLE `escenario`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ESCENARIO` (`ESCENARIO`);

--
-- Indices de la tabla `evento_vendedor`
--
ALTER TABLE `evento_vendedor`
  ADD PRIMARY KEY (`EVENTO`,`VENDEDOR`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `I_NICK` (`NICK`);

--
-- Indices de la tabla `vendedor`
--
ALTER TABLE `vendedor`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `entrada`
--
ALTER TABLE `entrada`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `escenario`
--
ALTER TABLE `escenario`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `evento`
--
ALTER TABLE `evento`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `vendedor`
--
ALTER TABLE `vendedor`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `entrada`
--
ALTER TABLE `entrada`
  ADD CONSTRAINT `entrada_ibfk_1` FOREIGN KEY (`ESCENARIO`) REFERENCES `escenario` (`ID`),
  ADD CONSTRAINT `entrada_ibfk_2` FOREIGN KEY (`EVENTO`) REFERENCES `evento` (`ID`);

--
-- Filtros para la tabla `evento`
--
ALTER TABLE `evento`
  ADD CONSTRAINT `evento_ibfk_1` FOREIGN KEY (`ESCENARIO`) REFERENCES `escenario` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
