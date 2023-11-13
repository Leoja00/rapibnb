-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-11-2023 a las 22:17:55
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `rapibnb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alquileres`
--

CREATE TABLE `alquileres` (
  `ID` int(11) NOT NULL,
  `Titulo` varchar(255) NOT NULL,
  `Descripcion` text DEFAULT NULL,
  `Ubicacion` text DEFAULT NULL,
  `Etiquetas` text DEFAULT NULL,
  `GaleriaFotos` text DEFAULT NULL,
  `ListadoServicios` text DEFAULT NULL,
  `CostoAlquilerPorDia` decimal(10,2) NOT NULL,
  `TiempoMinimoPermanencia` int(11) DEFAULT NULL,
  `TiempoMaximoPermanencia` int(11) DEFAULT NULL,
  `Cupo` int(11) DEFAULT NULL,
  `FechaInicio` date DEFAULT NULL,
  `FechaFin` date DEFAULT NULL,
  `UsuarioID` int(11) DEFAULT NULL,
  `FechaPublicacion` datetime DEFAULT NULL,
  `FechaVisible` datetime DEFAULT NULL,
  `FechaActualizacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alquileres`
--

INSERT INTO `alquileres` (`ID`, `Titulo`, `Descripcion`, `Ubicacion`, `Etiquetas`, `GaleriaFotos`, `ListadoServicios`, `CostoAlquilerPorDia`, `TiempoMinimoPermanencia`, `TiempoMaximoPermanencia`, `Cupo`, `FechaInicio`, `FechaFin`, `UsuarioID`, `FechaPublicacion`, `FechaVisible`, `FechaActualizacion`) VALUES
(17, 'Pleno centro', 'Hotel 5 estrellas', 'San Luis', '#San #Luis #centro #oferta', 'imgAlquiler/images.jfif', 'wifi,desayuno,merienda,limpieza,cochera', 3.00, 1, 3, 5, '0000-00-00', '0000-00-00', 2, '2023-10-19 20:24:39', '2023-10-24 20:24:39', '2023-10-26 20:01:21'),
(19, 'Hotel Potrero de los Funes', 'Una mierda la página.', 'Tomás Jofre', '#Seba #Caca', 'imgAlquiler/Tigre1.webp,imgAlquiler/Tigre2.webp,imgAlquiler/Tigre3.webp', 'desayuno,merienda,limpieza', 2000.00, 2, 5, 2, '2023-10-13', '2023-11-05', 3, '2023-10-19 23:30:17', NULL, '2023-10-23 19:59:04'),
(22, 'Cabaña a metros del Balneario', 'Cabaña a metros del Balneario Santa Rosa del Conlara, excelente ubicacion para alquiler en la zona', 'Santa Rosa del Conlara - San Luis', '#Balneario2023 #VERANO #VACACIONES #OFERTA2024', 'imgAlquiler/2.jpg,imgAlquiler/3.jpg,imgAlquiler/rio.jpg', 'desayuno,merienda', 12500.00, 1, 10, 2, '2023-10-25', '2023-10-31', 1, '2023-10-15 23:33:19', NULL, '2023-10-29 22:14:06'),
(23, 'Lotes \"El Cabeza\"', 'Los mejores lotes de Rivadavia', 'Rivadavia-Mendoza', '#Vino #tierra #oferta', 'imgAlquiler/TQ2CPXV6HBD5DLJ7F2BIJ47YI4.jpg', 'wifi,desayuno,merienda,limpieza,cochera', 99999.00, 365, 9999, 15, NULL, NULL, 8, '2023-11-06 20:34:09', NULL, NULL),
(24, 'Hotel Ojo del Rio', 'El mejor hotel, con los mejores servicios, cualquier consulta a su disposicion', 'Ojo del Rio', '#HOTEL #4ESTRELAS #APROVECHA #CYBER #MONDAY #2023', 'imgAlquiler/79278320.jpg', 'wifi,desayuno,merienda,limpieza,cochera', 14500.00, 1, 12, 3, '0000-00-00', '0000-00-00', 1, '2023-11-12 20:21:47', NULL, '2023-11-12 16:22:21'),
(25, 'Tailandia Expres', 'Oferta unica a Tailandia, especial para descansar', 'Tailandia', '#TAILANDIA #DESCANDO #EXPRES', 'imgAlquiler/ko-phi-phi-tailandia__1280x720.jpg', 'desayuno,merienda', 120000.00, 3, 30, 4, NULL, NULL, 7, '2023-11-12 21:01:56', NULL, NULL),
(28, 'Tierra del Fuego', 'Excelente para descansar, al frente del Glaciar', 'Tierra del Fuego', '#GLACIAR #HIELO #INVIERNO', 'imgAlquiler/84311_2990.png,imgAlquiler/Amanecer-en-Ushuaia-Turismo-en-Ushuaia.jpg', 'wifi,desayuno,merienda,limpieza,cochera', 32000.00, 2, 7, 3, NULL, NULL, 17, '2023-11-13 01:22:01', '2023-11-18 01:22:01', NULL),
(29, 'Cabañas Centro', 'Cabañas a 2 cuadras de la plaza principal, cuenta con pileta climatizada', 'Villa Carlos Paz', '#PILETA #verano2024 #cordoba #carlosPaz', 'imgAlquiler/623aa658-a4f9-4648-8277-49b2c5ea09a6.webp,imgAlquiler/vista-general-desde-piscina.jpg', 'wifi,cochera', 24250.00, 2, 15, 2, NULL, NULL, 19, '2023-11-07 10:42:28', '2023-11-12 10:42:28', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `ID` int(11) NOT NULL,
  `UsuarioID` int(11) DEFAULT NULL,
  `AlquilerID` int(11) DEFAULT NULL,
  `FechaReservaInicio` date DEFAULT NULL,
  `FechaReservaFin` date DEFAULT NULL,
  `FechaCreacion` datetime DEFAULT NULL,
  `Estado` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`ID`, `UsuarioID`, `AlquilerID`, `FechaReservaInicio`, `FechaReservaFin`, `FechaCreacion`, `Estado`) VALUES
(39, 1, 23, '2021-11-02', '2023-10-20', '2023-11-06 22:04:21', 'Reservado'),
(49, 7, 24, '2023-11-10', '2023-11-11', '2023-11-10 20:51:19', 'Reservado'),
(51, 17, 23, '2023-11-13', '2024-12-14', '2023-11-13 18:57:17', 'Reservado'),
(54, 17, 24, '2023-11-14', '2023-11-15', '2023-11-13 19:04:34', 'En revision'),
(58, 3, 24, '2023-10-13', '2023-10-14', '2023-10-13 19:11:05', 'Reservado'),
(59, 1, 25, '2023-10-13', '2023-10-30', '2023-10-13 19:13:37', 'Reservado'),
(60, 8, 24, '2023-10-16', '2023-10-20', '2023-10-13 19:29:22', 'Reservado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reseñas`
--

CREATE TABLE `reseñas` (
  `ID` int(11) NOT NULL,
  `Comentario` text DEFAULT NULL,
  `Puntaje` int(11) DEFAULT NULL,
  `AlquilerID` int(11) DEFAULT NULL,
  `UsuarioID` int(11) DEFAULT NULL,
  `ReservaID` int(11) DEFAULT NULL,
  `RespuestaDueño` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reseñas`
--

INSERT INTO `reseñas` (`ID`, `Comentario`, `Puntaje`, `AlquilerID`, `UsuarioID`, `ReservaID`, `RespuestaDueño`) VALUES
(19, 'Muy caro para lo que ofrecen', 1, 23, 1, 39, 'Perdon!'),
(21, 'MUY BUEN HOTEL, MUY RECOMENDABLE', 5, 24, 7, 49, 'Muchas gracias, esperamos tu visita nuevamente!'),
(22, 'Excelente vista al mar, lo super recomiendo, cumplieron con todo lo establecido', 4, 25, 1, 59, ''),
(26, 'Beautiful landscape, and place, will visit us soon', 4, 24, 8, 60, 'TENKIU'),
(27, 'No me gusta el servicio', 2, 24, 3, 58, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(255) NOT NULL,
  `Apellido` varchar(255) NOT NULL,
  `DNI` varchar(20) NOT NULL,
  `CorreoElectronico` varchar(255) NOT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `Intereses` text DEFAULT NULL,
  `Avatar` varchar(255) DEFAULT NULL,
  `Verificado` tinyint(1) DEFAULT 0,
  `FechaVerificacion` date DEFAULT NULL,
  `Biografia` text DEFAULT NULL,
  `Rol` tinyint(1) DEFAULT 0,
  `Contraseña` varchar(255) NOT NULL,
  `MensajeVerificacion` text DEFAULT NULL,
  `ArchivoVerificacion` varchar(255) DEFAULT NULL,
  `FechaVencimiento` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID`, `Nombre`, `Apellido`, `DNI`, `CorreoElectronico`, `Telefono`, `Intereses`, `Avatar`, `Verificado`, `FechaVerificacion`, `Biografia`, `Rol`, `Contraseña`, `MensajeVerificacion`, `ArchivoVerificacion`, `FechaVencimiento`) VALUES
(1, 'Leonardo', 'Gallardo', '42278783', 'leoja00@gmail.com', '2664001527', 'Programación III- Ingenieria del Software', 'imgUser/IMG_4992.jpg', 1, '2023-11-13', 'Alumno de la UNSL', 1, '$2y$10$FDV9y3qdmqGgiViAsAhIuu8wTKKpFLe2xFw6NxC5jQPOE3ai2zh5S', 'Soy estudiante de la TUW', 'archivosVerificar/ingenieria.jfif', '2023-11-18'),
(2, 'Valeria', 'Perez', '123456789', 'valeria@gmail.com', '26666', 'Paisaje', 'imgUser/poli.png', 0, NULL, 'Alumno', 0, '$2y$10$0vCboji12i/db8QtK3w8b.bQ849frD9pm1fCvUM5SpNXQ6cWr05du', NULL, NULL, NULL),
(3, 'Sebastian', 'García', '41272435', 'seba.garcia_11@hotmail.com', '2622308886', 'nada', 'imgUser/AzTeRisk.png', 1, '2023-11-13', 'dsadasda', 1, '$2y$10$M6uRoHrxBxtuKhoTEVuwlu8Ul9KukBGorB2.ueI8qvlSXIOouQfb.', 'Soy SSJ10.', 'archivosVerificar/Ciberterrorismo.jpg', '2023-11-18'),
(5, 'mateo', 'avellaneda', '42690959', ' mateoavellaneda.uni@gmail.com', '2665030129', 'BOCA', 'imgUser/Sin título.png', 0, NULL, 'Me llamo Mateo y ¡Aguante BOOOCA!', 0, '$2y$10$kZ3v3VvqpFgF4ifR4/AWQ.i/EQSVpfdH0uvFcRzfqb8.RHooFvJjG', NULL, NULL, NULL),
(7, 'Juan', 'Martinez', '32123454', 'juan@hotmail.com', '2664001122', 'NADA', 'imgUser/GL Concesionaria - Autos nuevos y usados - Google Chrome 10_10_2023 12_43_03.png', 0, NULL, 'QUE TE IMPORTA', 0, '$2y$10$js4YjXGoeOYpR/OuoTDMzuVay4zY1jsQA6pGw.stk0Hr8yOEi7ArS', 'DALE GATO', 'archivosVerificar/3.28.jpg', NULL),
(8, 'Danilo', 'Talquenca', '39741852', 'danilotalquenca26@gmail.com', '2664457816', 'FERNET, CERVEZA Y VINO', 'imgUser/3.1.jpg', 1, '2023-11-13', 'Estudiante del alcohol y joda', 0, '$2y$10$JETNtqnxAhWq8gaXxCnxn.6Ve6jwm7kOnmbueL6WfrLxdxv.I7Hxq', 'VERIFICAME GATO', 'archivosVerificar/79278320.jpg', '2023-11-18'),
(17, 'Mirta', 'Miranda', '3100123456', 'mirta@gmail.com', '2664112255', 'Paisaje', 'imgUser/Sin título-1.jpg', 0, NULL, 'Alumno', 0, '$2y$10$P1NEnsByVvrHpZ0usA94nOHXbr0fQxoF6ZVQzxBSWIiqp6vPuExZe', NULL, NULL, NULL),
(18, 'María ', 'Mamondez', '43216209', 'Mdcmamondez@outlook.com', '2994544158', 'Playa', 'imgUser/20230930_191440_469.jpg', 0, NULL, '.', 0, '$2y$10$xI2mehKO5dHBWntK1I5gXOqMSPSgF2y717Lva2/rvGQVT...URCNm', 'Verificame plis🤙', 'archivosVerificar/FB_IMG_1696695148608.jpg', NULL),
(19, 'Facundo', 'Cabeza', '38456744', 'facundoCab@gmail.com', '2664245487', 'Vino Mendoza', 'imgUser/prueba.png', 0, NULL, 'Estudiante de Geologia', 0, '$2y$10$TPwgTHWOGjyDxo1p27PjXufeomuaHMUjYSur5p0T5VDPzdIpotnua', NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alquileres`
--
ALTER TABLE `alquileres`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `UsuarioID` (`UsuarioID`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `UsuarioID` (`UsuarioID`),
  ADD KEY `AlquilerID` (`AlquilerID`);

--
-- Indices de la tabla `reseñas`
--
ALTER TABLE `reseñas`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `AlquilerID` (`AlquilerID`),
  ADD KEY `UsuarioID` (`UsuarioID`),
  ADD KEY `ReservaID` (`ReservaID`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `DNI` (`DNI`),
  ADD UNIQUE KEY `CorreoElectronico` (`CorreoElectronico`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alquileres`
--
ALTER TABLE `alquileres`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `reseñas`
--
ALTER TABLE `reseñas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alquileres`
--
ALTER TABLE `alquileres`
  ADD CONSTRAINT `alquileres_ibfk_1` FOREIGN KEY (`UsuarioID`) REFERENCES `usuarios` (`ID`);

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`UsuarioID`) REFERENCES `usuarios` (`ID`),
  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`AlquilerID`) REFERENCES `alquileres` (`ID`);

--
-- Filtros para la tabla `reseñas`
--
ALTER TABLE `reseñas`
  ADD CONSTRAINT `reseñas_ibfk_1` FOREIGN KEY (`AlquilerID`) REFERENCES `alquileres` (`ID`),
  ADD CONSTRAINT `reseñas_ibfk_2` FOREIGN KEY (`UsuarioID`) REFERENCES `usuarios` (`ID`),
  ADD CONSTRAINT `reseñas_ibfk_3` FOREIGN KEY (`ReservaID`) REFERENCES `reservas` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
