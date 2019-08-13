-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 13-08-2019 a las 15:50:36
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
-- Base de datos: `cuisinesoft1.0`
--

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `CUOSER`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `CUOSER` (OUT `z` INT, OUT `a` INT)  BEGIN
	SELECT COUNT(*) INTO z FROM usuarios WHERE cargo_idcargo = 3;
    SELECT COUNT(*) INTO a FROM usuarios WHERE cargo_idcargo = 1;
    SELECT z AS UsersZona, a AS UsersAdmin;
END$$

DROP PROCEDURE IF EXISTS `CUSER`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `CUSER` (OUT `c` INT)  BEGIN
	SELECT COUNT(*) INTO c FROM usuarios WHERE cargo_idcargo = 3;
END$$

DROP PROCEDURE IF EXISTS `findUsuarios`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `findUsuarios` ()  BEGIN
SELECT idusuarios, nombre, apellido, contrasena, cargo.nombreCargo, restaurante.nombreRestaurante FROM usuarios INNER JOIN cargo ON usuarios.cargo_idcargo=cargo.idcargo INNER JOIN restaurante ON usuarios.restaurante_idrestaurante=restaurante.idrestaurante ORDER BY idusuarios DESC;
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
(1, 'Admin'),
(2, 'Jefe Cocina'),
(3, 'Jefe Zona');

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
  `fechaMerma` date NOT NULL,
  `motivoMerma` varchar(45) NOT NULL,
  `precioProducto` float NOT NULL,
  `tipoMerma_idtipoMerma` int(11) NOT NULL,
  `restaurante_idrestaurante` int(11) NOT NULL,
  PRIMARY KEY (`idmerma`),
  KEY `fk_merma_tipoMerma1_idx` (`tipoMerma_idtipoMerma`),
  KEY `fk_merma_restaurante1_idx` (`restaurante_idrestaurante`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perdida`
--

DROP TABLE IF EXISTS `perdida`;
CREATE TABLE IF NOT EXISTS `perdida` (
  `idperdida` int(11) NOT NULL AUTO_INCREMENT,
  `pesoTotal` float NOT NULL,
  `costoTotal` float NOT NULL,
  `merma_idmerma` int(11) NOT NULL,
  PRIMARY KEY (`idperdida`),
  KEY `fk_perdida_merma1_idx` (`merma_idmerma`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  PRIMARY KEY (`idproducto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `restaurante`
--

INSERT INTO `restaurante` (`idrestaurante`, `nombreRestaurante`, `direccionRestaurante`) VALUES
(1, 'Chia', 'Cll 1000'),
(2, 'Tunal', 'Cll 50');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  PRIMARY KEY (`idusuarios`),
  KEY `fk_usuarios_cargo_idx` (`cargo_idcargo`),
  KEY `fk_usuarios_restaurante1_idx` (`restaurante_idrestaurante`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuarios`, `nombre`, `apellido`, `contrasena`, `cargo_idcargo`, `restaurante_idrestaurante`) VALUES
(1, 'Elkin', 'Torres', '12345', 1, 1),
(17, 'Rafael Horacio', 'Osorio Alzate', '15963', 3, 2),
(18, 'Andres German', 'Pachón Valbuena', '11111111', 3, 1),
(20, 'Nestor German', 'Torres Antonio', '999', 3, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_has_producto`
--

DROP TABLE IF EXISTS `venta_has_producto`;
CREATE TABLE IF NOT EXISTS `venta_has_producto` (
  `venta_idventa` int(11) NOT NULL,
  `producto_idproducto` int(11) NOT NULL,
  `cantidadVendida` int(11) NOT NULL,
  PRIMARY KEY (`venta_idventa`,`producto_idproducto`),
  KEY `fk_venta_has_producto_producto1_idx` (`producto_idproducto`),
  KEY `fk_venta_has_producto_venta1_idx` (`venta_idventa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Filtros para la tabla `perdida`
--
ALTER TABLE `perdida`
  ADD CONSTRAINT `fk_perdida_merma1` FOREIGN KEY (`merma_idmerma`) REFERENCES `merma` (`idmerma`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
