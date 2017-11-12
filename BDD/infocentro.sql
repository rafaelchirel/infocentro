-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-11-2017 a las 10:53:44
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `infocentro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE `actividades` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `fecha` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_salida` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad_persona`
--

CREATE TABLE `actividad_persona` (
  `id` int(11) NOT NULL,
  `cargo_id` int(11) NOT NULL,
  `actividad_id` int(11) NOT NULL,
  `usu_per_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `condicion` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `componentes` (
  `id` int(11) NOT NULL,
  `marca` varchar(100) NOT NULL,
  `modelo` varchar(100) NOT NULL,
  `serial` varchar(100) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `estatus_id` int(11) NOT NULL,
  `periferico_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `control_maquinas`
--

CREATE TABLE `control_maquinas` (
  `id` int(11) NOT NULL,
  `fecha_hora_entrada` timestamp NULL DEFAULT NULL,
  `fecha_hora_salida` timestamp NULL DEFAULT NULL,
  `condicion` tinyint(1) NOT NULL,
  `usu_per_id` int(11) NOT NULL,
  `equipo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `id` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  `condicion` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equ_comp`
--

CREATE TABLE `equ_comp` (
  `id` int(11) NOT NULL,
  `equipo_id` int(11) NOT NULL,
  `componente_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estatus`
--

CREATE TABLE `estatus` (
  `id` int(11) NOT NULL,
  `condicion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `historial` (
  `id` int(11) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `observacion` varchar(255) NOT NULL,
  `estatus_id` int(11) NOT NULL,
  `componente_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen_usu_per`
--

CREATE TABLE `imagen_usu_per` (
  `url` varchar(255) DEFAULT NULL,
  `usu_per_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `institucion`
--

CREATE TABLE `institucion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `direccion` varchar(46) NOT NULL,
  `banner_1` varchar(255) NOT NULL,
  `banner_2` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
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

CREATE TABLE `perifericos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `condicion` tinyint(1) NOT NULL,
  `eliminar` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `redes_sociales`
--

CREATE TABLE `redes_sociales` (
  `id` int(11) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `icono` varchar(255) NOT NULL,
  `tipo` enum('url','text_num','num') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `redsocial_usu_per`
--

CREATE TABLE `redsocial_usu_per` (
  `id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `persona_id` int(11) NOT NULL,
  `red_social_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rol` tinyint(1) NOT NULL DEFAULT '0',
  `habilitado` tinyint(1) NOT NULL DEFAULT '1',
  `pregunta` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `respuesta` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `rol`, `habilitado`, `pregunta`, `respuesta`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
(17, 'admin', 'admin@hotmail.com', '$2y$10$s.bp93shJ5mJQPBQv32MmubyAgtfHf1NCk2W8upVfv9ua5EieB.Vu', 1, 1, 'estado donde nacio', 'guarico', 'avatar_1510498327.png', 'BmNvXMTwNAk73bDQS6u3DkcyGl0DxKNA9MxDOS1rNhZt1CwonQJq1AvgasOp', '2017-10-08 16:37:15', '2017-11-12 14:22:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usu_per`
--

CREATE TABLE `usu_per` (
  `id` int(11) NOT NULL,
  `cedula` varchar(12) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `genero` enum('M','F') NOT NULL,
  `fecha_nac` date NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telefono` varchar(12) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `eliminar` tinyint(1) NOT NULL DEFAULT '1',
  `cargo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `actividad_persona`
--
ALTER TABLE `actividad_persona`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_privote_usuper_idx` (`usu_per_id`),
  ADD KEY `fk_privote_actividades_idx` (`actividad_id`),
  ADD KEY `fk_privote_cargos_idx` (`cargo_id`);

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `componentes`
--
ALTER TABLE `componentes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pivote_componentes_idx` (`periferico_id`),
  ADD KEY `fk_estatus_componente_idx` (`estatus_id`);

--
-- Indices de la tabla `control_maquinas`
--
ALTER TABLE `control_maquinas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_privote_usuper_idx` (`usu_per_id`),
  ADD KEY `fk_privote_equipos_idx` (`equipo_id`);

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `equ_comp`
--
ALTER TABLE `equ_comp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_equipo_equ_comp_idx` (`equipo_id`),
  ADD KEY `fk_det_comp_equipo_idx` (`componente_id`);

--
-- Indices de la tabla `estatus`
--
ALTER TABLE `estatus`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_det_comp_historial_idx` (`componente_id`),
  ADD KEY `fk_estatus_historial_idx` (`estatus_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `imagen_usu_per`
--
ALTER TABLE `imagen_usu_per`
  ADD KEY `fk_imagen_per_usu_per1_idx` (`usu_per_id`);

--
-- Indices de la tabla `institucion`
--
ALTER TABLE `institucion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indices de la tabla `perifericos`
--
ALTER TABLE `perifericos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `redes_sociales`
--
ALTER TABLE `redes_sociales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `redsocial_usu_per`
--
ALTER TABLE `redsocial_usu_per`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pivote_redes_sociales_idx` (`red_social_id`),
  ADD KEY `fk_pivote_usu_per_idx` (`persona_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `usu_per`
--
ALTER TABLE `usu_per`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usu_per_cargos_idx` (`cargo_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividades`
--
ALTER TABLE `actividades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `actividad_persona`
--
ALTER TABLE `actividad_persona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `componentes`
--
ALTER TABLE `componentes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `control_maquinas`
--
ALTER TABLE `control_maquinas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `equ_comp`
--
ALTER TABLE `equ_comp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `estatus`
--
ALTER TABLE `estatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `historial`
--
ALTER TABLE `historial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT de la tabla `institucion`
--
ALTER TABLE `institucion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `perifericos`
--
ALTER TABLE `perifericos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `redes_sociales`
--
ALTER TABLE `redes_sociales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `redsocial_usu_per`
--
ALTER TABLE `redsocial_usu_per`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=465;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `usu_per`
--
ALTER TABLE `usu_per`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
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
