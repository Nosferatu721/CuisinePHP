-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 28-10-2019 a las 14:33:26
-- Versión del servidor: 5.7.26
-- Versión de PHP: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `nueva`
--

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `activos`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `activos` (OUT `a` INT, OUT `b` INT)  BEGIN
	SELECT COUNT(*) INTO a FROM usuarios WHERE estado = 'Activo';
    SELECT COUNT(*) INTO b FROM usuarios WHERE estado = 'Inactivo';
    SELECT a AS Activos, b AS Inactivos;
END$$

DROP PROCEDURE IF EXISTS `CUOSER`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `CUOSER` (OUT `a` INT, OUT `b` INT, OUT `c` INT)  BEGIN
	SELECT COUNT(*) INTO a FROM usuarios WHERE cargo_idcargo = 1;
    SELECT COUNT(*) INTO b FROM usuarios WHERE cargo_idcargo = 2;
    SELECT COUNT(*) INTO c FROM usuarios WHERE cargo_idcargo = 3;
    SELECT a AS UsersAdmin, b AS UsersCocina, c AS UsersZona;
END$$

DROP PROCEDURE IF EXISTS `findMerma`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `findMerma` (IN `idRest` INT)  BEGIN
	SELECT idmerma, idproducto, nombreProducto, idtipoMerma, tipoMerma, perdida, cantidadMerma, motivoMerma, fechaMerma FROM merma INNER JOIN producto ON merma.producto_idproducto = producto.idproducto INNER JOIN tipomerma ON merma.tipoMerma_idtipoMerma = tipomerma.idtipoMerma WHERE restaurante_idrestaurante = idRest ORDER BY nombreProducto ASC;
END$$

DROP PROCEDURE IF EXISTS `findMermaDate`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `findMermaDate` (IN `idRest` INT, IN `fechaIni` DATE, IN `fechaFin` DATE)  BEGIN

SELECT idmerma, idproducto, nombreProducto, idtipoMerma, tipoMerma, perdida, cantidadMerma, motivoMerma, fechaMerma FROM merma INNER JOIN producto ON merma.producto_idproducto = producto.idproducto INNER JOIN tipomerma ON merma.tipoMerma_idtipoMerma = tipomerma.idtipoMerma WHERE restaurante_idrestaurante = idRest AND fechaMerma BETWEEN fechaIni AND fechaFin ORDER BY nombreProducto ASC;

END$$

DROP PROCEDURE IF EXISTS `findMermaID`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `findMermaID` (IN `idRest` INT, IN `id` INT)  BEGIN

SELECT idmerma, nombreProducto, cantidadMerma,perdida, motivoMerma, tipoMerma_idtipoMerma, producto_idproducto FROM merma INNER JOIN producto ON merma.producto_idproducto = producto.idproducto WHERE restaurante_idrestaurante = idRest AND idmerma = id;

END$$

DROP PROCEDURE IF EXISTS `findProFec`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `findProFec` (IN `fechaI` DATE, IN `fechaF` DATE, IN `idres` INT)  NO SQL
SELECT p.nombreProducto,SUM(vhp.cantidadVendida)Total, SUM(vhp.cantProyectada)Totalproy FROM venta INNER JOIN venta_has_producto as vhp ON idventa = venta_idventa AND restaurante_idrestaurante=idres INNER JOIN producto as p ON idproducto=producto_idproducto WHERE fechaVenta BETWEEN fechaI AND fechaF AND proyectadoA BETWEEN (DATE_ADD(fechaI,INTERVAL 7 DAY)) AND (DATE_ADD(fechaF, INTERVAL 7 DAY)) GROUP BY idproducto$$

DROP PROCEDURE IF EXISTS `findStock`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `findStock` (IN `idRest` INT)  BEGIN
	SELECT idproducto, nombreProducto, cantidadProducto, fechaVencimiento, lote FROM restaurante_has_producto 		INNER JOIN producto ON restaurante_has_producto.producto_idproducto = producto.idproducto
    WHERE restaurante_idrestaurante = idRest ORDER BY nombreProducto ASC;
END$$

DROP PROCEDURE IF EXISTS `findStockID`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `findStockID` (IN `id` INT, IN `rest` INT)  BEGIN
	SELECT cantidadProducto, fechaVencimiento, lote, idproducto, nombreProducto FROM restaurante_has_producto INNER JOIN producto ON 					
    restaurante_has_producto.producto_idproducto = producto.idproducto WHERE restaurante_idrestaurante = rest AND producto_idproducto = id;
END$$

DROP PROCEDURE IF EXISTS `findUserID`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `findUserID` (IN `id` INT)  BEGIN
	SELECT idusuarios, nombre ,apellido, email, contrasena, estado, idrestaurante, nombreRestaurante, direccionRestaurante, idcargo, nombreCargo from usuarios INNER JOIN restaurante ON usuarios.restaurante_idrestaurante = restaurante.idrestaurante INNER JOIN cargo ON usuarios.cargo_idcargo = cargo.idcargo WHERE idusuarios = id;
END$$

DROP PROCEDURE IF EXISTS `findUsuarios`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `findUsuarios` ()  BEGIN
SELECT idusuarios, nombre, apellido, email, contrasena, estado, cargo.nombreCargo, restaurante.nombreRestaurante FROM usuarios INNER JOIN cargo ON usuarios.cargo_idcargo=cargo.idcargo INNER JOIN restaurante ON usuarios.restaurante_idrestaurante=restaurante.idrestaurante;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almuerzopersonal`
--

DROP TABLE IF EXISTS `almuerzopersonal`;
CREATE TABLE IF NOT EXISTS `almuerzopersonal` (
  `idalmuerzoPersonal` int(11) NOT NULL AUTO_INCREMENT,
  `fechaAlmuerzo` date NOT NULL,
  `cantidadPersonas` int(11) NOT NULL,
  `restaurante_idrestaurante` int(11) NOT NULL,
  PRIMARY KEY (`idalmuerzoPersonal`),
  KEY `fk_almuerzoPersonal_restaurante1_idx` (`restaurante_idrestaurante`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almuerzopersonal_has_producto`
--

DROP TABLE IF EXISTS `almuerzopersonal_has_producto`;
CREATE TABLE IF NOT EXISTS `almuerzopersonal_has_producto` (
  `almuerzoPersonal_idalmuerzoPersonal` int(11) NOT NULL,
  `producto_idproducto` int(11) NOT NULL,
  `cantidadProducto` int(11) NOT NULL,
  `cantidadIndividual` float NOT NULL,
  `precioProducto` float NOT NULL,
  PRIMARY KEY (`almuerzoPersonal_idalmuerzoPersonal`,`producto_idproducto`),
  KEY `fk_almuerzoPersonal_has_producto_producto1_idx` (`producto_idproducto`),
  KEY `fk_almuerzoPersonal_has_producto_almuerzoPersonal1_idx` (`almuerzoPersonal_idalmuerzoPersonal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos`
--

DROP TABLE IF EXISTS `archivos`;
CREATE TABLE IF NOT EXISTS `archivos` (
  `idArchivo` int(255) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) NOT NULL,
  `document` varchar(100) NOT NULL,
  `idUser` int(11) NOT NULL,
  PRIMARY KEY (`idArchivo`),
  KEY `fk_usuarios` (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `archivos`
--

INSERT INTO `archivos` (`idArchivo`, `descripcion`, `document`, `idUser`) VALUES
(4, 'Chequeo', 'Lista de Chequeo evaluación proyectos FaseIVB.docx', 1),
(8, 'GG', 'CLUB-DEPORTIVO-LA-EQUIDAD.docx', 4),
(9, 'Eso', 'Entrevista-licenciatura-en-ingles.docx', 1),
(10, 'hghghghghgg', 'Formato consentimiento informado  cultura fisica (1) (1).pdf', 1),
(11, 'WorkShop 3', 'WORKSHOP 3.docx', 2),
(12, 'Ensayo Humanística', 'ENSAYO.docx', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

DROP TABLE IF EXISTS `cargo`;
CREATE TABLE IF NOT EXISTS `cargo` (
  `idcargo` int(11) NOT NULL AUTO_INCREMENT,
  `nombreCargo` varchar(45) NOT NULL,
  PRIMARY KEY (`idcargo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`idcargo`, `nombreCargo`) VALUES
(1, 'Administrador'),
(2, 'Jefe de Cocina'),
(3, 'Jefe de Zona');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrega`
--

DROP TABLE IF EXISTS `entrega`;
CREATE TABLE IF NOT EXISTS `entrega` (
  `identrega` int(11) NOT NULL AUTO_INCREMENT,
  `entregaProgramada` tinyint(4) DEFAULT NULL,
  `fechaEntrega` date DEFAULT NULL,
  `pedido_idpedido` int(11) NOT NULL,
  PRIMARY KEY (`identrega`),
  KEY `fk_entrega_pedido1_idx` (`pedido_idpedido`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventualidad`
--

DROP TABLE IF EXISTS `eventualidad`;
CREATE TABLE IF NOT EXISTS `eventualidad` (
  `ideventualidad` int(11) NOT NULL AUTO_INCREMENT,
  `fechaEventualidad` date NOT NULL,
  `descripcionEventualidad` varchar(45) NOT NULL,
  `tipoEvento_idtipoEvento` int(11) NOT NULL,
  `restaurante_idrestaurante` int(11) NOT NULL,
  `menaje_idmenaje` int(11) NOT NULL,
  PRIMARY KEY (`ideventualidad`),
  KEY `fk_eventualidad_tipoEvento1_idx` (`tipoEvento_idtipoEvento`),
  KEY `fk_eventualidad_restaurante1_idx` (`restaurante_idrestaurante`),
  KEY `fk_eventualidad_menaje1_idx` (`menaje_idmenaje`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menaje`
--

DROP TABLE IF EXISTS `menaje`;
CREATE TABLE IF NOT EXISTS `menaje` (
  `idmenaje` int(11) NOT NULL AUTO_INCREMENT,
  `nombreMenaje` varchar(45) NOT NULL,
  PRIMARY KEY (`idmenaje`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `merma`
--

DROP TABLE IF EXISTS `merma`;
CREATE TABLE IF NOT EXISTS `merma` (
  `idmerma` int(11) NOT NULL AUTO_INCREMENT,
  `cantidadMerma` int(11) NOT NULL,
  `perdida` float DEFAULT NULL,
  `fechaMerma` date NOT NULL,
  `motivoMerma` varchar(45) NOT NULL,
  `tipoMerma_idtipoMerma` int(11) NOT NULL,
  `restaurante_idrestaurante` int(11) NOT NULL,
  `producto_idproducto` int(11) NOT NULL,
  PRIMARY KEY (`idmerma`),
  KEY `fk_merma_tipoMerma1_idx` (`tipoMerma_idtipoMerma`),
  KEY `fk_merma_restaurante1_idx` (`restaurante_idrestaurante`),
  KEY `fk_merma_producto1_idx` (`producto_idproducto`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `merma`
--

INSERT INTO `merma` (`idmerma`, `cantidadMerma`, `perdida`, `fechaMerma`, `motivoMerma`, `tipoMerma_idtipoMerma`, `restaurante_idrestaurante`, `producto_idproducto`) VALUES
(1, 6, 5700, '2019-09-15', 'Motivo 1', 1, 2, 1),
(2, 4, 4800, '2019-09-16', 'Motivo 2', 1, 2, 2),
(3, 1, 900, '2019-09-15', 'Motivo 3', 1, 2, 4),
(4, 5, 0, '2019-09-18', 'Reutilizado como salsa', 2, 2, 5),
(5, 5, 3500, '2019-09-15', 'Motivo 3', 1, 2, 8),
(10, 2, 0, '2019-09-15', 'fff', 2, 2, 6),
(13, 4, 3000, '2019-09-20', 'vencimiento', 1, 2, 5),
(14, 3, 3600, '2019-09-23', 'ss', 1, 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

DROP TABLE IF EXISTS `pedido`;
CREATE TABLE IF NOT EXISTS `pedido` (
  `idpedido` int(11) NOT NULL AUTO_INCREMENT,
  `fechaPedido` date NOT NULL,
  `restaurante_idrestaurante` int(11) NOT NULL,
  PRIMARY KEY (`idpedido`),
  KEY `fk_pedido_restaurante1_idx` (`restaurante_idrestaurante`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`idpedido`, `fechaPedido`, `restaurante_idrestaurante`) VALUES
(1, '2019-09-01', 2),
(2, '2019-09-26', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_has_producto`
--

DROP TABLE IF EXISTS `pedido_has_producto`;
CREATE TABLE IF NOT EXISTS `pedido_has_producto` (
  `pedido_idpedido` int(11) NOT NULL,
  `producto_idproducto` int(11) NOT NULL,
  `cantidadProdPed` int(11) NOT NULL,
  PRIMARY KEY (`pedido_idpedido`,`producto_idproducto`),
  KEY `fk_pedido_has_producto_producto1_idx` (`producto_idproducto`),
  KEY `fk_pedido_has_producto_pedido1_idx` (`pedido_idpedido`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pedido_has_producto`
--

INSERT INTO `pedido_has_producto` (`pedido_idpedido`, `producto_idproducto`, `cantidadProdPed`) VALUES
(1, 2, 35),
(1, 5, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamo`
--

DROP TABLE IF EXISTS `prestamo`;
CREATE TABLE IF NOT EXISTS `prestamo` (
  `idprestamo` int(11) NOT NULL AUTO_INCREMENT,
  `fechaPrestamo` date NOT NULL,
  `fechaDevolucion` date DEFAULT NULL,
  `descripcionPrestamo` varchar(100) NOT NULL,
  `menaje_idmenaje` int(11) NOT NULL,
  `restaurante_idrestaurante` int(11) NOT NULL,
  PRIMARY KEY (`idprestamo`),
  KEY `fk_prestamo_menaje1_idx` (`menaje_idmenaje`),
  KEY `fk_prestamo_restaurante1_idx` (`restaurante_idrestaurante`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `idproducto` int(11) NOT NULL AUTO_INCREMENT,
  `nombreProducto` varchar(45) NOT NULL,
  `precioProducto` float NOT NULL,
  PRIMARY KEY (`idproducto`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idproducto`, `nombreProducto`, `precioProducto`) VALUES
(1, 'Papa', 950),
(2, 'Yuca', 1200),
(3, 'Arroz', 1800),
(4, 'Cebolla', 900),
(5, 'Tomate', 750),
(6, 'Frijol', 1300),
(7, 'Carne', 2500),
(8, 'Platano', 700),
(9, 'Acelga', 1000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyeccionventa`
--

DROP TABLE IF EXISTS `proyeccionventa`;
CREATE TABLE IF NOT EXISTS `proyeccionventa` (
  `idproyeccionVenta` int(11) NOT NULL AUTO_INCREMENT,
  `fechaProyeccion` date NOT NULL,
  `venta_idventa` int(11) NOT NULL,
  PRIMARY KEY (`idproyeccionVenta`),
  KEY `fk_proyeccionVenta_venta1_idx` (`venta_idventa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyeccionventa_has_producto`
--

DROP TABLE IF EXISTS `proyeccionventa_has_producto`;
CREATE TABLE IF NOT EXISTS `proyeccionventa_has_producto` (
  `proyeccionVenta_idproyeccionVenta` int(11) NOT NULL,
  `producto_idproducto` int(11) NOT NULL,
  `cantidadProyectada` int(11) DEFAULT NULL,
  PRIMARY KEY (`proyeccionVenta_idproyeccionVenta`,`producto_idproducto`),
  KEY `fk_proyeccionVenta_has_producto_producto1_idx` (`producto_idproducto`),
  KEY `fk_proyeccionVenta_has_producto_proyeccionVenta1_idx` (`proyeccionVenta_idproyeccionVenta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restaurante`
--

DROP TABLE IF EXISTS `restaurante`;
CREATE TABLE IF NOT EXISTS `restaurante` (
  `idrestaurante` int(11) NOT NULL AUTO_INCREMENT,
  `nombreRestaurante` varchar(45) NOT NULL,
  `direccionRestaurante` varchar(45) NOT NULL,
  PRIMARY KEY (`idrestaurante`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `restaurante`
--

INSERT INTO `restaurante` (`idrestaurante`, `nombreRestaurante`, `direccionRestaurante`) VALUES
(1, 'Chia', 'Cll 100'),
(2, 'Tunal', 'Cll 55'),
(3, 'Chapinero', 'Cll 200'),
(4, 'Escocia', 'Cll 75'),
(6, 'Sena', 'Calle 63');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restaurante_has_menaje`
--

DROP TABLE IF EXISTS `restaurante_has_menaje`;
CREATE TABLE IF NOT EXISTS `restaurante_has_menaje` (
  `restaurante_idrestaurante` int(11) NOT NULL,
  `menaje_idmenaje` int(11) NOT NULL,
  `cantidadMenaje` int(11) NOT NULL,
  `vidaUtil` date DEFAULT NULL,
  PRIMARY KEY (`restaurante_idrestaurante`,`menaje_idmenaje`),
  KEY `fk_restaurante_has_menaje_menaje1_idx` (`menaje_idmenaje`),
  KEY `fk_restaurante_has_menaje_restaurante1_idx` (`restaurante_idrestaurante`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restaurante_has_producto`
--

DROP TABLE IF EXISTS `restaurante_has_producto`;
CREATE TABLE IF NOT EXISTS `restaurante_has_producto` (
  `restaurante_idrestaurante` int(11) NOT NULL,
  `producto_idproducto` int(11) NOT NULL,
  `cantidadProducto` int(11) NOT NULL,
  `fechaVencimiento` date NOT NULL,
  `lote` int(11) NOT NULL,
  PRIMARY KEY (`restaurante_idrestaurante`,`producto_idproducto`),
  KEY `fk_restaurante_has_producto_producto1_idx` (`producto_idproducto`),
  KEY `fk_restaurante_has_producto_restaurante1_idx` (`restaurante_idrestaurante`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `restaurante_has_producto`
--

INSERT INTO `restaurante_has_producto` (`restaurante_idrestaurante`, `producto_idproducto`, `cantidadProducto`, `fechaVencimiento`, `lote`) VALUES
(1, 2, 88, '2019-09-30', 748596),
(1, 3, 66, '2019-09-22', 52524),
(1, 4, 33, '2019-09-25', 85962),
(2, 1, 25, '2020-08-21', 251414),
(2, 2, 25, '2019-09-28', 69596),
(2, 3, 85, '2019-10-05', 95623),
(2, 4, 84, '2019-09-27', 475847),
(2, 6, 33, '2019-09-27', 452365),
(2, 7, 50, '2019-09-27', 625362);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoevento`
--

DROP TABLE IF EXISTS `tipoevento`;
CREATE TABLE IF NOT EXISTS `tipoevento` (
  `idtipoEvento` int(11) NOT NULL AUTO_INCREMENT,
  `tipoEvento` varchar(45) NOT NULL,
  PRIMARY KEY (`idtipoEvento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipomerma`
--

DROP TABLE IF EXISTS `tipomerma`;
CREATE TABLE IF NOT EXISTS `tipomerma` (
  `idtipoMerma` int(11) NOT NULL AUTO_INCREMENT,
  `tipoMerma` varchar(45) NOT NULL,
  PRIMARY KEY (`idtipoMerma`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipomerma`
--

INSERT INTO `tipomerma` (`idtipoMerma`, `tipoMerma`) VALUES
(1, 'Baja'),
(2, 'Reproceso');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `idusuarios` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `contrasena` varchar(45) NOT NULL,
  `cargo_idcargo` int(11) NOT NULL,
  `restaurante_idrestaurante` int(11) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  PRIMARY KEY (`idusuarios`),
  KEY `fk_usuarios_cargo_idx` (`cargo_idcargo`),
  KEY `fk_usuarios_restaurante1_idx` (`restaurante_idrestaurante`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuarios`, `nombre`, `apellido`, `contrasena`, `cargo_idcargo`, `restaurante_idrestaurante`, `estado`, `email`) VALUES
(1, 'Elkin', 'Torres', '666', 1, 2, 'Activo', 'elkintorres721@gmail.com'),
(2, 'Rafael', 'Alzate', '12345', 2, 2, 'Activo', 'rhosorio1@misena.edu.co'),
(3, 'Andres', 'Pachon', '48625', 3, 2, 'Activo', 'gpachon01@misena.edu.co'),
(4, 'Camilo', 'Suarez', '15324', 3, 2, 'Inactivo', 'casuarez484@misena.edu.co'),
(5, 'Angelica', 'Neiza', '6asd85as', 2, 1, 'Activo', 'angelica@gmail.com'),
(6, 'Juan', 'Rendon', '9865847ff', 3, 1, 'Activo', 'juanrendon@gmail.com'),
(7, 'Nicolas', 'Moreno', '584ff854', 2, 1, 'Activo', 'nicolasMoreno@gmail.com'),
(8, 'Andrea', 'Moreno', '584hh854', 3, 1, 'Activo', 'andreaMoreno@gmail.com'),
(9, 'Pepito', 'Perez', '12345', 2, 3, 'Inactivo', 'pepito@gmail.com'),
(10, 'Brayan', 'Sepulveda', '695847', 3, 6, 'Activo', 'brayanSepulveda@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

DROP TABLE IF EXISTS `venta`;
CREATE TABLE IF NOT EXISTS `venta` (
  `idventa` int(11) NOT NULL AUTO_INCREMENT,
  `fechaVenta` date NOT NULL,
  `restaurante_idrestaurante` int(11) NOT NULL,
  PRIMARY KEY (`idventa`),
  KEY `fk_venta_restaurante1_idx` (`restaurante_idrestaurante`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`idventa`, `fechaVenta`, `restaurante_idrestaurante`) VALUES
(1, '2019-09-27', 2),
(2, '2019-10-14', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_has_producto`
--

DROP TABLE IF EXISTS `venta_has_producto`;
CREATE TABLE IF NOT EXISTS `venta_has_producto` (
  `venta_idventa` int(11) NOT NULL,
  `producto_idproducto` int(11) NOT NULL,
  `cantidadVendida` int(11) NOT NULL,
  `proyectadoA` date DEFAULT NULL,
  `cantProyectada` int(11) NOT NULL,
  PRIMARY KEY (`venta_idventa`,`producto_idproducto`),
  KEY `fk_venta_has_producto_producto1_idx` (`producto_idproducto`),
  KEY `fk_venta_has_producto_venta1_idx` (`venta_idventa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `venta_has_producto`
--

INSERT INTO `venta_has_producto` (`venta_idventa`, `producto_idproducto`, `cantidadVendida`, `proyectadoA`, `cantProyectada`) VALUES
(1, 1, 12, '2019-10-04', 15),
(1, 4, 15, '2019-10-04', 18),
(1, 5, 8, '2019-10-04', 10),
(1, 6, 10, '2019-10-04', 12),
(2, 3, 8, '2019-10-21', 10),
(2, 6, 5, '2019-10-21', 6);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `almuerzopersonal`
--
ALTER TABLE `almuerzopersonal`
  ADD CONSTRAINT `fk_almuerzoPersonal_restaurante1` FOREIGN KEY (`restaurante_idrestaurante`) REFERENCES `restaurante` (`idrestaurante`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `almuerzopersonal_has_producto`
--
ALTER TABLE `almuerzopersonal_has_producto`
  ADD CONSTRAINT `fk_almuerzoPersonal_has_producto_almuerzoPersonal1` FOREIGN KEY (`almuerzoPersonal_idalmuerzoPersonal`) REFERENCES `almuerzopersonal` (`idalmuerzoPersonal`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_almuerzoPersonal_has_producto_producto1` FOREIGN KEY (`producto_idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `archivos`
--
ALTER TABLE `archivos`
  ADD CONSTRAINT `fk_usuarios` FOREIGN KEY (`idUser`) REFERENCES `usuarios` (`idusuarios`);

--
-- Filtros para la tabla `entrega`
--
ALTER TABLE `entrega`
  ADD CONSTRAINT `fk_entrega_pedido1` FOREIGN KEY (`pedido_idpedido`) REFERENCES `pedido` (`idpedido`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `eventualidad`
--
ALTER TABLE `eventualidad`
  ADD CONSTRAINT `fk_eventualidad_menaje1` FOREIGN KEY (`menaje_idmenaje`) REFERENCES `menaje` (`idmenaje`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_eventualidad_restaurante1` FOREIGN KEY (`restaurante_idrestaurante`) REFERENCES `restaurante` (`idrestaurante`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_eventualidad_tipoEvento1` FOREIGN KEY (`tipoEvento_idtipoEvento`) REFERENCES `tipoevento` (`idtipoEvento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `merma`
--
ALTER TABLE `merma`
  ADD CONSTRAINT `fk_merma_producto1` FOREIGN KEY (`producto_idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_merma_restaurante1` FOREIGN KEY (`restaurante_idrestaurante`) REFERENCES `restaurante` (`idrestaurante`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_merma_tipoMerma1` FOREIGN KEY (`tipoMerma_idtipoMerma`) REFERENCES `tipomerma` (`idtipoMerma`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `fk_pedido_restaurante1` FOREIGN KEY (`restaurante_idrestaurante`) REFERENCES `restaurante` (`idrestaurante`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pedido_has_producto`
--
ALTER TABLE `pedido_has_producto`
  ADD CONSTRAINT `fk_pedido_has_producto_pedido1` FOREIGN KEY (`pedido_idpedido`) REFERENCES `pedido` (`idpedido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pedido_has_producto_producto1` FOREIGN KEY (`producto_idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD CONSTRAINT `fk_prestamo_menaje1` FOREIGN KEY (`menaje_idmenaje`) REFERENCES `menaje` (`idmenaje`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_prestamo_restaurante1` FOREIGN KEY (`restaurante_idrestaurante`) REFERENCES `restaurante` (`idrestaurante`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `proyeccionventa`
--
ALTER TABLE `proyeccionventa`
  ADD CONSTRAINT `fk_proyeccionVenta_venta1` FOREIGN KEY (`venta_idventa`) REFERENCES `venta` (`idventa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `proyeccionventa_has_producto`
--
ALTER TABLE `proyeccionventa_has_producto`
  ADD CONSTRAINT `fk_proyeccionVenta_has_producto_producto1` FOREIGN KEY (`producto_idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_proyeccionVenta_has_producto_proyeccionVenta1` FOREIGN KEY (`proyeccionVenta_idproyeccionVenta`) REFERENCES `proyeccionventa` (`idproyeccionVenta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `restaurante_has_menaje`
--
ALTER TABLE `restaurante_has_menaje`
  ADD CONSTRAINT `fk_restaurante_has_menaje_menaje1` FOREIGN KEY (`menaje_idmenaje`) REFERENCES `menaje` (`idmenaje`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_restaurante_has_menaje_restaurante1` FOREIGN KEY (`restaurante_idrestaurante`) REFERENCES `restaurante` (`idrestaurante`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `restaurante_has_producto`
--
ALTER TABLE `restaurante_has_producto`
  ADD CONSTRAINT `fk_restaurante_has_producto_producto1` FOREIGN KEY (`producto_idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_restaurante_has_producto_restaurante1` FOREIGN KEY (`restaurante_idrestaurante`) REFERENCES `restaurante` (`idrestaurante`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_cargo` FOREIGN KEY (`cargo_idcargo`) REFERENCES `cargo` (`idcargo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuarios_restaurante1` FOREIGN KEY (`restaurante_idrestaurante`) REFERENCES `restaurante` (`idrestaurante`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `fk_venta_restaurante1` FOREIGN KEY (`restaurante_idrestaurante`) REFERENCES `restaurante` (`idrestaurante`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `venta_has_producto`
--
ALTER TABLE `venta_has_producto`
  ADD CONSTRAINT `fk_venta_has_producto_producto1` FOREIGN KEY (`producto_idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_venta_has_producto_venta1` FOREIGN KEY (`venta_idventa`) REFERENCES `venta` (`idventa`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
