-- phpMyAdmin SQL Dump
-- version 4.0.10deb1ubuntu0.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 04-03-2019 a las 11:16:21
-- Versión del servidor: 5.5.62-0ubuntu0.14.04.1
-- Versión de PHP: 5.6.38-3+ubuntu14.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `infocentro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE IF NOT EXISTS `actividades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `fecha` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_salida` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`id`, `nombre`, `descripcion`, `fecha`, `hora_inicio`, `hora_salida`) VALUES
(11, 'sdfs', 'sfsf', '2018-11-21', '12:12:00', '12:13:00'),
(12, 'proyecto sociotecnologico iv', 'defensa de proyecto de estudiantes del IUTLL trayecto iv', '2018-12-11', '03:00:00', '04:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad_persona`
--

CREATE TABLE IF NOT EXISTS `actividad_persona` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cargo_id` int(11) NOT NULL,
  `actividad_id` int(11) NOT NULL,
  `usu_per_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_privote_usuper_idx` (`usu_per_id`),
  KEY `fk_privote_actividades_idx` (`actividad_id`),
  KEY `fk_privote_cargos_idx` (`cargo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Volcado de datos para la tabla `actividad_persona`
--

INSERT INTO `actividad_persona` (`id`, `cargo_id`, `actividad_id`, `usu_per_id`) VALUES
(16, 3, 12, 59),
(17, 4, 12, 58),
(18, 5, 12, 57);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora`
--

CREATE TABLE IF NOT EXISTS `bitacora` (
  `id` int(11) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `accion` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `bitacora`
--

INSERT INTO `bitacora` (`id`, `fecha_hora`, `usuario`, `accion`, `descripcion`) VALUES
(0, '2018-12-09 14:31:53', 'DESCONOCIDO', 'CONTRASEÑA', 'Recuperacion de Contraseña via Pregunta de Seguridad | ID: 17; Usuario: admin'),
(17, '2018-12-09 14:32:02', 'admin', 'LOGIN', 'Inicio de Sesion al Sistema.'),
(17, '2018-12-09 14:38:39', 'admin', 'REGISTRO', 'Registro de Usuario de la Comunidad - ID: 57 - V-25654789 RAFAEL LEDEZMA'),
(17, '2018-12-09 14:39:40', 'admin', 'REGISTRO', 'Registro de Personal - ID: 58 - V-26123789 KARLA CAMPOS'),
(17, '2018-12-09 14:40:08', 'admin', 'REGISTRO', 'Registro de Equipo Computarizado - ID: 9 - Nro.Equipo: 2'),
(17, '2018-12-09 14:48:10', 'admin', 'REGISTRO', 'Componente Registrado | MARCA: INTEL - MODELO: CORE 2 DUO 2.66 GHZ 4MB - SERIAL: 5151592434'),
(17, '2018-12-09 14:50:30', 'admin', 'REGISTRO', 'Componente Registrado | MARCA: DELUX - MODELO: mouse optico usb m138bu - SERIAL: 2515153232457'),
(17, '2018-12-09 14:51:27', 'admin', 'REGISTRO', 'Actividad Registrada | ID: 12 - Nombre: proyecto sociotecnologico iv - Fecha: 2018-12-11'),
(17, '2018-12-09 14:53:08', 'admin', 'REGISTRO', 'Registro de Personal - ID: 59 - V-22032458 ALEXIS PEREIRA'),
(17, '2018-12-09 14:53:22', 'admin', 'ASIGNAR', 'Cantidad de Miembros asignados:  1 | ActividadID: 12 - Nombre: proyecto sociotecnologico iv - Fecha: 2018-12-11'),
(17, '2018-12-09 14:53:25', 'admin', 'ASIGNAR', 'Cantidad de Miembros asignados:  1 | ActividadID: 12 - Nombre: proyecto sociotecnologico iv - Fecha: 2018-12-11'),
(17, '2018-12-09 14:53:28', 'admin', 'ASIGNAR', 'Cantidad de Miembros asignados:  1 | ActividadID: 12 - Nombre: proyecto sociotecnologico iv - Fecha: 2018-12-11'),
(17, '2018-12-09 14:54:09', 'admin', 'ASIGNAR', 'Componente Asignado a Equipo ID:8 Nro.Equipo: 1 | Vinculado a Componente: MARCA: DELUX - MODELO: mouse optico usb m138bu - SERIAL: 2515153232457'),
(17, '2018-12-09 14:54:32', 'admin', 'ASIGNAR', 'Componente Asignado a Equipo ID:8 Nro.Equipo: 1 | Vinculado a Componente: MARCA: INTEL - MODELO: CORE 2 DUO 2.66 GHZ 4MB - SERIAL: 5151592434'),
(17, '2018-12-09 14:56:20', 'admin', 'LOGOUT', 'Sesion Finalizada.'),
(17, '2018-12-10 10:12:20', 'admin', 'LOGIN', 'Inicio de Sesion al Sistema.'),
(17, '2018-12-11 10:00:45', 'admin', 'LOGIN', 'Inicio de Sesion al Sistema.'),
(0, '2018-12-11 10:02:56', 'DESCONOCIDO', 'INSERTAR', 'Registro de un nuevo usuario al Sistema.'),
(18, '2018-12-11 10:02:58', 'afas', 'LOGOUT', 'Sesion Finalizada.'),
(17, '2018-12-11 10:06:13', 'admin', 'LOGIN', 'Inicio de Sesion al Sistema.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE IF NOT EXISTS `cargos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  `condicion` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `cargos`
--

INSERT INTO `cargos` (`id`, `nombre`, `condicion`) VALUES
(1, 'Personal', 1),
(2, 'Usuario', 1),
(3, 'Facilitador', 0),
(4, 'Brigadista', 0),
(5, 'Comunidad', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `componentes`
--

CREATE TABLE IF NOT EXISTS `componentes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `marca` varchar(100) NOT NULL,
  `modelo` varchar(100) NOT NULL,
  `serial` varchar(100) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `estatus_id` int(11) NOT NULL,
  `periferico_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pivote_componentes_idx` (`periferico_id`),
  KEY `fk_estatus_componente_idx` (`estatus_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `componentes`
--

INSERT INTO `componentes` (`id`, `marca`, `modelo`, `serial`, `descripcion`, `imagen`, `estatus_id`, `periferico_id`) VALUES
(11, 'INTEL', 'CORE 2 DUO 2.66 GHZ 4MB', '5151592434', 'SOCKET 775', 'componente_1544381290.jpg', 3, 10),
(12, 'DELUX', 'mouse optico usb m138bu', '2515153232457', 'COLOR NEGRO', 'componente_1544381430.jpg', 3, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `control_maquinas`
--

CREATE TABLE IF NOT EXISTS `control_maquinas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_hora_entrada` timestamp NULL DEFAULT NULL,
  `fecha_hora_salida` timestamp NULL DEFAULT NULL,
  `condicion` tinyint(1) NOT NULL,
  `usu_per_id` int(11) NOT NULL,
  `equipo_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_privote_usuper_idx` (`usu_per_id`),
  KEY `fk_privote_equipos_idx` (`equipo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE IF NOT EXISTS `equipos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` int(11) NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  `condicion` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`id`, `numero`, `estatus`, `condicion`) VALUES
(8, 1, 1, 1),
(9, 2, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equ_comp`
--

CREATE TABLE IF NOT EXISTS `equ_comp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `equipo_id` int(11) NOT NULL,
  `componente_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_equipo_equ_comp_idx` (`equipo_id`),
  KEY `fk_det_comp_equipo_idx` (`componente_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Volcado de datos para la tabla `equ_comp`
--

INSERT INTO `equ_comp` (`id`, `equipo_id`, `componente_id`) VALUES
(16, 8, 12),
(17, 8, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estatus`
--

CREATE TABLE IF NOT EXISTS `estatus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `condicion` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `estatus`
--

INSERT INTO `estatus` (`id`, `condicion`) VALUES
(1, 'Registrado'),
(2, 'Disponible | Almacen'),
(3, 'Asignado a Equipo'),
(4, 'Bueno | Retirado por ServTec'),
(5, 'Dañado | Retirado por ServTec'),
(6, 'Dañado | Almacen'),
(7, 'Dañado | Equipo'),
(8, 'Robado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE IF NOT EXISTS `historial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_hora` datetime NOT NULL,
  `observacion` varchar(255) NOT NULL,
  `estatus_id` int(11) NOT NULL,
  `componente_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_det_comp_historial_idx` (`componente_id`),
  KEY `fk_estatus_historial_idx` (`estatus_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=62 ;

--
-- Volcado de datos para la tabla `historial`
--

INSERT INTO `historial` (`id`, `fecha_hora`, `observacion`, `estatus_id`, `componente_id`, `user_id`) VALUES
(58, '2018-12-09 14:48:10', '', 1, 11, 17),
(59, '2018-12-09 14:50:30', '', 1, 12, 17),
(60, '2018-12-09 14:54:09', '<b>Equipo vinculado: 1 </b><br> COMPONENTE ASIGNADO  A EQUIPO NUMERO 1', 3, 12, 17),
(61, '2018-12-09 14:54:32', '<b>Equipo vinculado: 1 </b><br> COMPONENTE ASIGNADO A EQUIPO.', 3, 11, 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen_usu_per`
--

CREATE TABLE IF NOT EXISTS `imagen_usu_per` (
  `url` varchar(255) DEFAULT NULL,
  `usu_per_id` int(11) NOT NULL,
  KEY `fk_imagen_per_usu_per1_idx` (`usu_per_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `imagen_usu_per`
--

INSERT INTO `imagen_usu_per` (`url`, `usu_per_id`) VALUES
('usuario_1551711497.png', 57),
('personal_1551711552.png', 58),
('M.jpg', 59);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `institucion`
--

CREATE TABLE IF NOT EXISTS `institucion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `direccion` varchar(46) NOT NULL,
  `banner_1` varchar(255) NOT NULL,
  `banner_2` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `institucion`
--

INSERT INTO `institucion` (`id`, `nombre`, `codigo`, `direccion`, `banner_1`, `banner_2`) VALUES
(2, 'PADRE CHACIN', 'gua14', 'SECTOR PADRE CHACIN', 'banner_11551711920.png', 'banner_21551711873.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('admin@hotmail.com', '423ad29dbcfa7255771c5c7928bdfc12a23cb0294d94e47de261bf19403bc66c', '2017-09-27 13:35:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perifericos`
--

CREATE TABLE IF NOT EXISTS `perifericos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `condicion` tinyint(1) NOT NULL,
  `eliminar` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `perifericos`
--

INSERT INTO `perifericos` (`id`, `nombre`, `condicion`, `eliminar`) VALUES
(10, 'PROCESADOR', 0, 1),
(11, 'MOUSE', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `redes_sociales`
--

CREATE TABLE IF NOT EXISTS `redes_sociales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) NOT NULL,
  `icono` varchar(255) NOT NULL,
  `tipo` enum('url','text_num','num') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `redes_sociales`
--

INSERT INTO `redes_sociales` (`id`, `nombre`, `icono`, `tipo`) VALUES
(7, 'FACEBOOK', 'red_social_1551710890.png', 'url'),
(8, 'INSTAGRAM', 'red_social_1551711097.png', 'text_num');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `redsocial_usu_per`
--

CREATE TABLE IF NOT EXISTS `redsocial_usu_per` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `persona_id` int(11) NOT NULL,
  `red_social_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pivote_redes_sociales_idx` (`red_social_id`),
  KEY `fk_pivote_usu_per_idx` (`persona_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `redsocial_usu_per`
--

INSERT INTO `redsocial_usu_per` (`id`, `url`, `persona_id`, `red_social_id`) VALUES
(9, 'HTTPS://WWW.FACEBOOK.COM/DFFSFSFSF', 57, 7),
(10, 'RAFAELLEDEZMA', 57, 8),
(12, 'HTTPS://WWW.FACEBOOK.COM/KARLA', 58, 7),
(13, 'ALEXIS_PEREIRA', 59, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rol` tinyint(1) NOT NULL DEFAULT '0',
  `habilitado` tinyint(1) NOT NULL DEFAULT '0',
  `pregunta` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `respuesta` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `rol`, `habilitado`, `pregunta`, `respuesta`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
(17, 'admin', 'admin@hotmail.com', '$2y$10$FVjTk1ucmFAZkGiT4h2SEumMTm4Peu.N2Ahh1hFAvkk9ryA7FXwhm', 1, 1, 'estado donde nacio', 'guarico', 'avatar_1510498327.png', 'rm8ipEgWmgx8GfNuBnW11IiA0dWuFtBBeaNF4BpFLfrOB2Peoq707yDly97O', '2017-10-08 16:37:15', '2018-12-09 18:56:20'),
(18, 'afas', 'asas@gmail.com', '$2y$10$f.uJZ9cr3UCzZmQP4JXuoO6hCmBQ1qIr221Srxlgtlhakx6.o8nza', 0, 0, '3434', '3434', 'avatar_default.png', 'ni4qttUzjrBJc1WWeFARGOJJyPcbfjvWpVFGG5N3Wgr6uoTzsAp6vki07opr', '2018-12-11 14:02:56', '2018-12-11 14:02:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usu_per`
--

CREATE TABLE IF NOT EXISTS `usu_per` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` varchar(12) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `genero` enum('M','F') NOT NULL,
  `fecha_nac` date NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telefono` varchar(12) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `eliminar` tinyint(1) NOT NULL DEFAULT '1',
  `cargo_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usu_per_cargos_idx` (`cargo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=60 ;

--
-- Volcado de datos para la tabla `usu_per`
--

INSERT INTO `usu_per` (`id`, `cedula`, `nombre`, `apellido`, `genero`, `fecha_nac`, `email`, `telefono`, `direccion`, `eliminar`, `cargo_id`) VALUES
(57, 'V-25654789', 'RAFAEL', 'LEDEZMA', 'M', '1997-12-01', 'RAFAELLEDEZMA@GMAIL.COM', '04261515158', 'SECTOR LOS CERRITOS', 1, 2),
(58, 'V-26123789', 'KARLA', 'CAMPOS', 'F', '1996-12-01', 'KARLA@GMAIL.COM', '04265151611', 'SECTOR GUAMACHAL', 1, 1),
(59, 'V-22032458', 'ALEXIS', 'PEREIRA', 'M', '1994-12-01', 'ALEXISPEREURA@GMAIL.COM', '04141851561', 'URBANIZACION CARLOS PEREZ', 1, 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividad_persona`
--
ALTER TABLE `actividad_persona`
  ADD CONSTRAINT `fk_privote_actividades` FOREIGN KEY (`actividad_id`) REFERENCES `actividades` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_privote_cargos` FOREIGN KEY (`cargo_id`) REFERENCES `cargos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_privote_usuper` FOREIGN KEY (`usu_per_id`) REFERENCES `usu_per` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `componentes`
--
ALTER TABLE `componentes`
  ADD CONSTRAINT `fk_estatus_componente` FOREIGN KEY (`estatus_id`) REFERENCES `estatus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pivote_componentes` FOREIGN KEY (`periferico_id`) REFERENCES `perifericos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `control_maquinas`
--
ALTER TABLE `control_maquinas`
  ADD CONSTRAINT `fk_privote_equipos` FOREIGN KEY (`equipo_id`) REFERENCES `equipos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_privote_usuperr` FOREIGN KEY (`usu_per_id`) REFERENCES `usu_per` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `equ_comp`
--
ALTER TABLE `equ_comp`
  ADD CONSTRAINT `fk_det_comp_equipo` FOREIGN KEY (`componente_id`) REFERENCES `componentes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_equipo_equ_comp` FOREIGN KEY (`equipo_id`) REFERENCES `equipos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `historial`
--
ALTER TABLE `historial`
  ADD CONSTRAINT `fk_det_comp_historial` FOREIGN KEY (`componente_id`) REFERENCES `componentes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_estatus_historial` FOREIGN KEY (`estatus_id`) REFERENCES `estatus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `imagen_usu_per`
--
ALTER TABLE `imagen_usu_per`
  ADD CONSTRAINT `fk_imagen_per_usu_per1` FOREIGN KEY (`usu_per_id`) REFERENCES `usu_per` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `redsocial_usu_per`
--
ALTER TABLE `redsocial_usu_per`
  ADD CONSTRAINT `fk_pivote_redes_sociales` FOREIGN KEY (`red_social_id`) REFERENCES `redes_sociales` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pivote_usu_per` FOREIGN KEY (`persona_id`) REFERENCES `usu_per` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usu_per`
--
ALTER TABLE `usu_per`
  ADD CONSTRAINT `fk_usu_per_cargos` FOREIGN KEY (`cargo_id`) REFERENCES `cargos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
