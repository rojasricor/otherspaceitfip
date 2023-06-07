-- phpMyAdmin SQL Dump
-- version 5.0.4deb2+deb11u1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 20-01-2023 a las 11:14:54
-- Versión del servidor: 10.5.18-MariaDB-0+deb11u1
-- Versión de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de datos: `spaceitfip_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores_spaceitfip`
--

CREATE TABLE `administradores_spaceitfip` (
  `id_administrador` int(11) NOT NULL COMMENT 'Guarda el id de los administradores de los espacios del itfip',
  `nombres_administrador` text NOT NULL COMMENT 'Se guarda los nombres de los administradores del itfip.',
  `apellidos_administrador` text NOT NULL COMMENT 'Guardará los apellidos de cada administrador de los espacios del itfip.',
  `correo_institucional_administrador` text NOT NULL COMMENT 'Guardará el correo institucional del administrador del espacio del itfip.',
  `contraseña_administrador` text NOT NULL COMMENT 'Aquí se guarda la contraseña del correo del administrador de los espacios del itfip.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci COMMENT='Tabla que guarda los administradores con acceso a la aplicación';

--
-- Volcado de datos para la tabla `administradores_spaceitfip`
--

INSERT INTO `administradores_spaceitfip` (`id_administrador`, `nombres_administrador`, `apellidos_administrador`, `correo_institucional_administrador`, `contraseña_administrador`) VALUES
(1, 'administrador', 'uno', 'administrador1@itfip.edu.co', '$2y$10$V2Y3dSnBFj1mIXBAr.NAM.hGrQdG3ivkKyZv0UaZgQjDYlTapCjLi'),
(2, 'administrador', 'dos', 'administrador2@itfip.edu.co', '$2y$10$uAAH.wD4irTbHWPrRA4S/uoVdlFXmJglTIIw1MQd5LnISZj9le8oS'),
(3, 'administrador', 'tres', 'administrador3@itfip.edu.co', '$2y$10$EfUJ9xWVW3f8UGQcxdCzKOTMP0fr8xzG7MS0NVVgoDGHsoryUDsjW');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aprobacion_prestamos_bienes_itfip`
--

CREATE TABLE `aprobacion_prestamos_bienes_itfip` (
  `id_aprobacion` bigint(11) NOT NULL COMMENT 'El id de de los espacios que aun faltan por aprobar o no.',
  `fecha_aprobacion_bien` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'Fecha de la aprobacion del espacio físico. ',
  `id_prestamo` bigint(20) NOT NULL COMMENT 'Id del préstamo del espacio registrado como llave foránea.',
  `aprobacion_prestamo` enum('no','si') NOT NULL DEFAULT 'no' COMMENT 'Aquí se guarda si se aprobará o no el espacio físico solicitado.',
  `observacion_prestamo` varchar(255) NOT NULL COMMENT 'Aquí se guardará el por que no fue aprobado el préstamo.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci COMMENT='Tabla que guarda las aprobaciones de los prestamos';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bienes_itfip`
--

CREATE TABLE `bienes_itfip` (
  `id_bien` int(11) NOT NULL COMMENT 'Es el id del espacio, con el cual se identfica cada espacio registrado en la base de datos.',
  `nombre_bien` text NOT NULL COMMENT 'Se guarda el nombre del espacio a solicitar.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci COMMENT='Tabla que guarda los nombres y descripción bienes ITFIP';

--
-- Volcado de datos para la tabla `bienes_itfip`
--

INSERT INTO `bienes_itfip` (`id_bien`, `nombre_bien`) VALUES
(1, 'Auditorio ITFIP'),
(2, 'Estadio Deportivo Fútbol'),
(3, 'Canchas Baloncesto'),
(4, 'Piscina Semiolímpica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_prestamos_bienes_itfip`
--

CREATE TABLE `registro_prestamos_bienes_itfip` (
  `id_prestamo` bigint(20) NOT NULL COMMENT 'El id el cual se identifica el préstamo de dicho espacio',
  `fecha_solicitud_bien` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'Donde se guarda la fecha en la que fue solicitado el espacio.',
  `id_bien` int(11) NOT NULL COMMENT 'El id de identficacion del espacio prestado.',
  `fecha_entrega_bien` date NOT NULL COMMENT 'Aqui se guarda en la cual se entrega el espacio para el uso que haya dicho el usuario.',
  `fecha_fin_bien` date NOT NULL COMMENT 'Se guardará la fecha en la cual el usuario entrega el espacio.',
  `Hora_entrega_bien` time NOT NULL COMMENT 'Hora en la que se necesita el espacio a solicitar.',
  `Hora_fin_bien` time NOT NULL COMMENT 'Hora en la que el usuario entregaria el espacio.',
  `nombre_del_solicitante` text NOT NULL COMMENT 'Nombre del usuario que va a utilizar el espacio fisico.',
  `numero_documento_del_solicitante` bigint(11) NOT NULL COMMENT 'Documento del usuario que ha solicitado el préstamo del espacio.',
  `direccion_del_solicitante` text NOT NULL COMMENT 'Donde vive el usuario que necesita el espacio físico del itfip.',
  `telefono_del_solicitante` bigint(11) NOT NULL COMMENT 'Numero de teléfono del usuario el cual requiere el espacio físico.',
  `descripcion_prestamo` text NOT NULL COMMENT 'Se guardará el por que requiere el espacio.',
  `finalidad_prestamo` text NOT NULL COMMENT 'Se guardará para que será utilizado.',
  `id_administrador` int(11) NOT NULL COMMENT 'id de los administradores de los espacios del itfip.',
  `aprobacion_pendiente` enum('si','no') NOT NULL DEFAULT 'si' COMMENT 'Se guardara el dato si fue o no prestado el espacio solicitado.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci COMMENT='Tabla que guarda el registro de prestamos de bienes del ITFIP';

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores_spaceitfip`
--
ALTER TABLE `administradores_spaceitfip`
  ADD PRIMARY KEY (`id_administrador`);

--
-- Indices de la tabla `aprobacion_prestamos_bienes_itfip`
--
ALTER TABLE `aprobacion_prestamos_bienes_itfip`
  ADD PRIMARY KEY (`id_aprobacion`),
  ADD KEY `id_prestamo` (`id_prestamo`);

--
-- Indices de la tabla `bienes_itfip`
--
ALTER TABLE `bienes_itfip`
  ADD PRIMARY KEY (`id_bien`);

--
-- Indices de la tabla `registro_prestamos_bienes_itfip`
--
ALTER TABLE `registro_prestamos_bienes_itfip`
  ADD PRIMARY KEY (`id_prestamo`),
  ADD KEY `id_bien` (`id_bien`),
  ADD KEY `id_bien_2` (`id_bien`),
  ADD KEY `id_administrador` (`id_administrador`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administradores_spaceitfip`
--
ALTER TABLE `administradores_spaceitfip`
  MODIFY `id_administrador` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Guarda el id de los administradores de los espacios del itfip', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `aprobacion_prestamos_bienes_itfip`
--
ALTER TABLE `aprobacion_prestamos_bienes_itfip`
  MODIFY `id_aprobacion` bigint(11) NOT NULL AUTO_INCREMENT COMMENT 'El id de de los espacios que aun faltan por aprobar o no.';

--
-- AUTO_INCREMENT de la tabla `bienes_itfip`
--
ALTER TABLE `bienes_itfip`
  MODIFY `id_bien` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Es el id del espacio, con el cual se identfica cada espacio registrado en la base de datos.', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `registro_prestamos_bienes_itfip`
--
ALTER TABLE `registro_prestamos_bienes_itfip`
  MODIFY `id_prestamo` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'El id el cual se identifica el préstamo de dicho espacio';

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `aprobacion_prestamos_bienes_itfip`
--
ALTER TABLE `aprobacion_prestamos_bienes_itfip`
  ADD CONSTRAINT `aprobacion_prestamos_bienes_itfip_ibfk_1` FOREIGN KEY (`id_prestamo`) REFERENCES `registro_prestamos_bienes_itfip` (`id_prestamo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `registro_prestamos_bienes_itfip`
--
ALTER TABLE `registro_prestamos_bienes_itfip`
  ADD CONSTRAINT `registro_prestamos_bienes_itfip_ibfk_1` FOREIGN KEY (`id_bien`) REFERENCES `bienes_itfip` (`id_bien`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `registro_prestamos_bienes_itfip_ibfk_2` FOREIGN KEY (`id_administrador`) REFERENCES `administradores_spaceitfip` (`id_administrador`);
COMMIT;
