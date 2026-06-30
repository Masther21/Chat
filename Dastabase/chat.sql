-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-06-2026 a las 18:04:15
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `test-chat`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id_m` int(11) NOT NULL,
  `id_entrante_m` int(100) NOT NULL,
  `id_saliente_m` int(100) NOT NULL,
  `msj_m` text NOT NULL,
  `leido_m` tinyint(1) NOT NULL DEFAULT 0,
  `archivo_m` varchar(255) NOT NULL,
  `fecha_m` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id_m`, `id_entrante_m`, `id_saliente_m`, `msj_m`, `leido_m`, `archivo_m`, `fecha_m`) VALUES
(1, 166392764, 123, 'Hola, cómo está?', 1, '', '2026-06-25 18:08:12'),
(2, 123, 166392764, 'Hola, estas ahí?', 1, '', '2026-06-25 17:23:24'),
(3, 166392764, 123, 'Si, estoy aquí', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(4, 166392764, 123, 'Y tu como haz estado?', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(5, 166392764, 123, 'Qué tal todo?', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(6, 166392764, 123, 'Qué tal todo?', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(7, 166392764, 123, 'HOla', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(8, 166392764, 123, 'Hi', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(9, 166392764, 123, 'Hello', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(10, 166392764, 123, 'HOLA NUEVAMENTE', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(11, 166392764, 123, 'Qué tal todo!?', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(12, 166392764, 123, 'Hola Qué tal?', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(13, 166392764, 123, 'Hola Qué tal?', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(14, 166392764, 123, 'Que me cuentas?', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(15, 166392764, 123, 'Queé Honda civic bro?', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(16, 166392764, 123, 'Queé Honda civic bro?', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(17, 166392764, 123, 'Que hay de nuevo?', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(18, 166392764, 123, 'Hola, pendejo!', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(19, 166392764, 123, 'Hola, calipso', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(20, 166392764, 123, 'Hola, calipso', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(21, 166392764, 123, 'Honduras', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(22, 166392764, 123, 'Klk loco', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(23, 166392764, 123, 'Locon, pero habla me?', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(24, 166392764, 123, 'H', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(25, 166392764, 123, 'Juio', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(26, 166392764, 123, 'Haku', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(27, 166392764, 123, 'Haku', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(28, 166392764, 123, 'honter', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(29, 166392764, 123, 'Halo', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(30, 166392764, 123, 'Klk', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(31, 166392764, 123, 'jjjjj', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(32, 166392764, 123, 'ssssss', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(33, 166392764, 123, 'qqqq', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(34, 166392764, 123, 'qqqq', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(35, 166392764, 123, 'Hola, monigote', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(36, 166392764, 123, 'aaaaaaaaaaa', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(37, 166392764, 123, 'xxxxx', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(38, 166392764, 123, 'xxxxx', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(39, 166392764, 123, 'rrrrrrrrr', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(40, 166392764, 123, 'sdlfknsdlfk', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(41, 166392764, 123, 'sdlfknsdlfk', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(42, 166392764, 123, 'HolaMan', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(43, 166392764, 123, 'dddd', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(44, 166392764, 123, 'aaaa', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(45, 166392764, 123, 'wwwww', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(46, 166392764, 123, 'aaaaaaaaaaaa', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(47, 166392764, 123, 'qqqqqqqqqqqqqqqqq', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(48, 166392764, 123, 'eeeeeeeeeeeeee', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(49, 166392764, 123, 'eeeeeeeeeeeeeeq', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(50, 166392764, 123, 'eeeeeeeeeeeeeeq', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(51, 166392764, 123, 'qqqqqwqwqddd', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(52, 166392764, 123, 'asasfff', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(53, 166392764, 123, 'wqqwqwqwqwqw', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(54, 166392764, 123, 'dstststts', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(55, 166392764, 123, 'qqqwmmmmm', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(56, 166392764, 123, 'fdfdfdfdf', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(57, 166392764, 123, 'trtrtrt', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(58, 166392764, 123, 'ererer', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(59, 166392764, 123, 'oiioioioiolkkhjk', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(60, 166392764, 123, 'rmrmrmmrmrmr', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(61, 166392764, 123, 'wmwmwmmw', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(62, 123, 166392764, 'Dime lo!', 1, 'NO IMAGE', '2026-06-25 17:23:24'),
(63, 166392764, 123, 'Klk', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(64, 166392764, 123, 'Hola', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(65, 123, 166392764, 'Aquí estoy man', 1, 'NO IMAGE', '2026-06-25 17:23:24'),
(66, 123, 166392764, 'dddd', 1, 'NO IMAGE', '2026-06-25 17:23:24'),
(67, 123, 166392764, 'xxxxxx', 1, 'NO IMAGE', '2026-06-25 17:23:24'),
(68, 123, 166392764, 'sdsdsd', 1, 'NO IMAGE', '2026-06-25 17:23:24'),
(69, 123, 166392764, 'sdfsdfsd', 1, 'NO IMAGE', '2026-06-25 17:23:24'),
(70, 166392764, 123, 'Qué haces, man?', 1, 'NO IMAGE', '2026-06-25 18:08:12'),
(71, 166392764, 123, '123', 1, 'NO IMAGE', '2026-06-25 18:08:26'),
(72, 166392764, 123, '456', 1, 'NO IMAGE', '2026-06-25 18:26:40'),
(73, 166392764, 123, '45613', 1, 'NO IMAGE', '2026-06-25 18:26:40'),
(74, 166392764, 123, 'sasa2323', 1, 'NO IMAGE', '2026-06-25 18:26:40'),
(75, 123, 166392764, 'Qué son esas convinaciones?', 1, 'NO IMAGE', '2026-06-25 18:54:03'),
(76, 166392764, 123, 'K hay de nuevo?', 1, 'NO IMAGE', '2026-06-26 16:23:18'),
(77, 123, 166392764, 'Nada nuevo y tu?', 1, 'NO IMAGE', '2026-06-26 16:23:59'),
(78, 166392764, 123, 'Pos, igual!', 1, 'NO IMAGE', '2026-06-26 16:24:29'),
(79, 123, 166392764, 'Hola, otra vez?', 1, 'NO IMAGE', '2026-06-26 17:30:16'),
(80, 123, 166392764, 'Qué haces?', 1, 'NO IMAGE', '2026-06-26 17:30:16'),
(81, 123, 166392764, 'Ya no puedes responder me, tan mal estamos?', 1, 'NO IMAGE', '2026-06-26 17:30:16'),
(82, 166392764, 123, 'Ahora, qué quieres?', 1, 'NO IMAGE', '2026-06-26 17:32:01'),
(83, 166392764, 123, 'Nada solo quería hablar contigo de lo que paso!', 1, 'NO IMAGE', '2026-06-27 02:09:39'),
(84, 123, 166392764, 'A si!?', 1, 'NO IMAGE', '2026-06-27 02:10:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_u` int(11) NOT NULL,
  `id_unico_u` int(100) DEFAULT NULL,
  `name_u` varchar(100) NOT NULL,
  `apellido_u` varchar(100) NOT NULL,
  `correo_u` varchar(100) NOT NULL,
  `pass_u` varchar(150) NOT NULL,
  `conf_pass_u` varchar(150) NOT NULL,
  `img_u` varchar(255) NOT NULL,
  `estado_u` tinyint(4) NOT NULL DEFAULT 1,
  `fecha_u` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_u`, `id_unico_u`, `name_u`, `apellido_u`, `correo_u`, `pass_u`, `conf_pass_u`, `img_u`, `estado_u`, `fecha_u`) VALUES
(1, 123, 'Luis', 'Polo', 'pololuis@master.com', '123456', '', '/crital/Public/Assets/IMG/June/Perfil.png', 1, '2026-06-29 16:08:25'),
(2, 0, 'pablo', '', 'p123456@gmail.com', 'P123456', 'P123456', '', 1, '2026-06-15 16:27:10'),
(7, NULL, 'Maria', '', 'm159789@gmail.com', 'K456', 'K456', '', 1, '2026-06-15 16:39:17'),
(8, NULL, 'Maria', '', 'm159789@gmail.com', 'K456', 'K456', '', 1, '2026-06-15 16:39:17'),
(9, NULL, 'Emanuel', '', 'em789@gmail.com', 'E123', 'E123', '', 1, '2026-06-15 16:50:32'),
(10, 166392764, 'Miguel', '', 'miguel014@master.com', 'M456456', 'M456456', '', 1, '2026-06-15 17:56:07'),
(11, 6, 'Alexis', '', 'alex590@master.com', '590AM', '590Am', '', 1, '2026-06-15 17:58:10'),
(12, 78880119, 'Celeste', '', 'cr1212@master.com', 'Cr1212', 'Cr1212', '/crital/Public/Assets/IMG/June/6a30978f155eb_logoCEMADOJA.png', 1, '2026-06-16 00:23:43'),
(13, 47248536, 'maru', '', 'bargas41@masterh.com', 'MB123', 'MB123', 'D:\\LServer\\htdocs\\crital\\App\\Controllers/../../Public/Assets/IMG/June/6a315fd4af1f9_Agradesido!.PNG', 1, '2026-06-16 14:38:12'),
(14, 23163407, 'Karioque', '', 'K123@c.com', 'K123', 'K123', 'D:\\LServer\\htdocs\\crital\\App\\Controllers/../../Public/Assets/IMG/June/6a3161b55c66f_ErrorAlmacen.PNG', 1, '2026-06-16 14:46:13'),
(15, 87357227, 'Report', '', 'Rls@masther.com', 'C22', 'C22', 'D:\\LServer\\htdocs\\crital\\App\\Controllers/../../Public/Assets/IMG/June/6a3161eea931c_reporte_sistema_turno.jpeg', 1, '2026-06-16 14:47:10'),
(16, 30446043, 'Luis', '', 'L789@master.com', 'L789', 'L789', '../Public/Assets/IMG/June/6a31687e3f276_FT2X2.png', 1, '2026-06-16 15:15:10'),
(17, 73354726, 'Luis', '', 'L789@master.com', 'L789', 'L789', '../Public/Assets/IMG/June/6a3168857328f_FT2X2.png', 1, '2026-06-16 15:15:17'),
(18, 22331749, 'Wasinton', '', 'W234@m.com', 'W2345', 'W2345', '../Public/Assets/IMG/June/6a318afe0388d_e4e90e11-9730-4572-b044-4fcc751419cf.jfif', 1, '2026-06-16 17:42:22'),
(19, 45717172, 'Yaide', '', 'y6@yahoo.com', 'Y345', 'Y455', 'NO IMAGES', 1, '2026-06-16 17:53:17'),
(20, 71378458, 'Wandel', '', 'rw456@v.com', 'sdfsdf', 'sdfsdf', 'NO IMAGE', 1, '2026-06-16 18:07:57'),
(21, 15288796, 'test', '', 't567@v.com', 'tv1212', 'vt1212', '../Public/Assets/IMG/June/6a31914af0b0c_adminAlexandraGEMEDI.PNG', 1, '2026-06-16 18:09:15'),
(22, 56158534, 'TestChoose', '', 'tc@master.com', 'Tc123456', 'Tc123456', '../Public/Assets/IMG/June/6a428ae56b3a5_imagenesUser.PNG', 1, '2026-06-29 15:10:29'),
(23, 14096334, 'Error', '', 'ec78@gmail.com', 'Ec789456', 'Ec879456', '/Public/Assets/IMG/June/6a428be25c6a5_ErrorAlmacen.PNG', 1, '2026-06-29 15:14:42'),
(24, 95543728, 'Error', '', 'ec78@gmail.com', 'Ec789456', 'Ec879456', '/Public/Assets/IMG/June/6a428be2918e2_ErrorAlmacen.PNG', 1, '2026-06-29 15:14:42'),
(25, 84159558, 'TestChoose1', '', 'tc1@a.com', 'ctcasa', 'Tccasa', '/crital/Public/Assets/IMG/June/6a428c9c39f8f_MariaZalzuela.PNG', 1, '2026-06-29 15:17:48'),
(26, 76054340, 'Prueba2', '', 'P@masther.com', 'P/*-789', 'P/*-789', '/crital/Public/Assets/IMG/June/6a4291850a2bc_9935313.png', 1, '2026-06-29 15:38:45'),
(27, 63824218, 'prueba3Imagen', '', 'pi@c.com', 'PI123456', 'PI123456', '../Public/Assets/IMG/June/6a42960c7d7d7_9935313.png', 1, '2026-06-29 15:58:04'),
(28, 50787907, 'prueba4Imagen', '', 'p4i@cemaodja.com', 'p4i123', 'p4i123', '/crital/Public/Assets/IMG/June/6a42992c02dbc_4140052.png', 1, '2026-06-29 16:11:24'),
(29, 24945572, 'prueba5Imagen', '', 'p5i@p.com', 'p5i123', 'p5i123', '../Assets/IMG/June/6a4299e8f3cac_4140052.png', 1, '2026-06-29 16:14:32'),
(30, 85745952, 'prueba6Imagen', '', 'p6i@c.com', 'p6i123', 'p6i123', '/crital/Public/Assets/IMG/June/6a429ab131a69_4140052.png', 1, '2026-06-29 16:17:53'),
(31, 12361286, 'prueba7Imagen', '', 'p7i@a.com', 'pi7123', 'PI7123', '../Public/Assets/IMG/June/6a429b60c0bfe_4140052.png', 1, '2026-06-29 16:20:48'),
(32, 25032659, 'prueba8Imagen', '', 'p8i@b.com', 'p8i123', 'p8i123', 'D:\\LServer\\htdocs\\crital\\App\\Controllers/../Public/Assets/IMG/June/6a42ae2b9ee31_perfil.png', 1, '2026-06-29 17:40:59'),
(33, 39828177, 'prueba8Imagen', '', 'p8i@b.com', 'p8i123', 'p8i123', 'D:\\LServer\\htdocs\\crital\\App\\Controllers/../Public/Assets/IMG/June/6a42ae2c68a51_perfil.png', 1, '2026-06-29 17:41:00'),
(34, 45740013, 'prueba9Imagen', '', 'p9i@s.com', 'p9i123', 'p9i123', 'D:\\LServer\\htdocs\\crital\\App\\Controllers/../../Public/Assets/IMG/June/6a42af8f51da4_perfil.png', 1, '2026-06-29 17:46:55'),
(35, 53969783, 'prueba10Imagen', '', 'p10i@gmil.com', 'p10i123', 'p10i123', 'D:\\LServer\\htdocs\\crital\\App\\Controllers/../../Public/Assets/IMG/June/6a42b0cece9dd_perfil.png', 1, '2026-06-29 17:52:14'),
(36, 74606404, 'prueba11Imagen', '', 'p@cemaodja.com', 'pc123123', 'pc123123', '/crital/Public/Assets/IMG/June/6a42b43472b4b_perfil.png', 1, '2026-06-29 18:06:44'),
(37, 49013714, 'prueba12Imagen', '', 'p12img@s.com', 'P951', 'P951', 'D:\\LServer\\htdocs\\crital\\App\\Controllers/../../Public/Assets/IMG/June/6a42b6c9df155_perfil.png', 1, '2026-06-29 18:17:46'),
(38, 48708224, 'prueba13Imagen', '', 'p13@13.com', 'P1313', 'P1313', '/crital/Public/Assets/IMG/June/6a42ba3b07b09_perfil.png', 1, '2026-06-29 18:32:27');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id_m`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_u`),
  ADD UNIQUE KEY `id_unico_u` (`id_unico_u`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id_m` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_u` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
