 
 
 
--
-- Estructura de tabla para la tabla `communes`
--

CREATE TABLE IF NOT EXISTS `communes` (
  `id_com` int NOT NULL AUTO_INCREMENT,
  `id_reg` int NOT NULL,
  `description` varchar(90) NOT NULL,
  `status` enum('A','I','trash') NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id_com`,`id_reg`),
  KEY `fk_communes_region_idx` (`id_reg`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `communes`
--

INSERT INTO `communes` (`id_com`, `id_reg`, `description`, `status`) VALUES
(1, 1, 'Tamaulipas', 'A'),
(2, 1, 'Durango', 'A'),
(3, 2, 'Texas', 'A'),
(4, 2, 'Colorado', 'A'),
(7, 3, 'Toronto', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `credentials`
--
 
CREATE TABLE IF NOT EXISTS `credentials` (
  `id_cred` int NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `user` varchar(255) NOT NULL COMMENT 'Usuario de la credencial',
  `password` varchar(255) NOT NULL COMMENT 'Contraseña de la credencial',
  PRIMARY KEY (`id_cred`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `credentials`
--

INSERT INTO `credentials` (`id_cred`, `user`, `password`) VALUES
(1, 'netomix', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customers`
--

 
CREATE TABLE IF NOT EXISTS `customers` (
  `dni` varchar(45) NOT NULL COMMENT 'Documento de Identidad',
  `id_reg` int NOT NULL,
  `id_com` int NOT NULL,
  `email` varchar(120) NOT NULL COMMENT 'Correo Electrónico',
  `name` varchar(45) NOT NULL COMMENT 'Nombre',
  `last_name` varchar(45) NOT NULL COMMENT 'Apellido',
  `address` varchar(255) DEFAULT NULL COMMENT 'Dirección',
  `date_reg` datetime NOT NULL COMMENT 'Fecha y hora del registro',
  `status` enum('A','I','trash') NOT NULL DEFAULT 'A' COMMENT 'estado del registro:\nA \r\n: Activo\nI : Desactivo\ntrash : Registro eliminado',
  PRIMARY KEY (`dni`,`id_reg`,`id_com`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_customers_communes1_idx` (`id_com`,`id_reg`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `customers`
--

INSERT INTO `customers` (`dni`, `id_reg`, `id_com`, `email`, `name`, `last_name`, `address`, `date_reg`, `status`) VALUES
('asdasd', 1, 2, 'netomix@gamil', 'Jose', 'Hernández ', 'Quintero 404', '2024-06-08 02:48:11', 'A'),
('asdasda', 1, 2, 'netomix@gamil2', 'Jose', 'Hernández ', 'Quintero 404', '2024-06-08 03:15:28', 'trash'),
('asdasdaa', 1, 2, 'netomix@gamil23', 'Jose', 'Hernández ', '', '2024-06-08 04:30:00', 'trash'),
('asdasdaa1', 1, 2, 'netomix@gamil231', 'Jose', 'Hernández ', '', '2024-06-08 14:01:53', 'A'),
('asdasdaa11', 1, 2, 'netomix@gamil2311', 'Jose', 'Hernández ', 'asdasdads', '2024-06-08 14:02:43', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `regions`
--

 
CREATE TABLE IF NOT EXISTS `regions` (
  `id_reg` int NOT NULL AUTO_INCREMENT,
  `description` varchar(90) NOT NULL,
  `status` enum('A','I','trash') NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id_reg`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `regions`
--

INSERT INTO `regions` (`id_reg`, `description`, `status`) VALUES
(1, 'Mexico', 'A'),
(2, 'EU', 'A'),
(3, 'Canada', 'I');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tokens`
--
 
CREATE TABLE IF NOT EXISTS `tokens` (
  `id_toks` int NOT NULL AUTO_INCREMENT COMMENT 'Id del token',
  `token` char(40) NOT NULL COMMENT 'Token ',
  `id_creds` int NOT NULL COMMENT 'Credencial del login',
  `created` datetime NOT NULL,
  `expired` datetime NOT NULL,
  PRIMARY KEY (`id_toks`),
  UNIQUE KEY `token` (`token`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tokens`
--

INSERT INTO `tokens` (`id_toks`, `token`, `id_creds`, `created`, `expired`) VALUES
(3, '9c0767be3ec2698367ffc799bd8afd2ac97299fa', 1, '2024-06-07 17:59:00', '2024-06-07 18:59:00'),
(2, '929c6e51a2c0608a49ae1f3b6df262c766bb0038', 1, '2024-06-07 17:34:51', '2024-06-07 18:34:51'),
(4, '7fc24a3fc044aedb474fbdbe248eb00c0d646107', 1, '2024-06-07 19:03:24', '2024-06-07 19:03:24'),
(5, 'a3ba70f4365accf3821e865f9a57cf144bb2828e', 1, '2024-06-08 01:04:57', '2024-06-08 02:04:57'),
(6, '91b5caa196080537d36772860733b51c2a4a1427', 1, '2024-06-08 01:05:19', '2024-06-08 02:05:19'),
(7, 'ae4823fadfa5f164018c8a7ccadac8d5bdffe8f5', 1, '2024-06-08 02:45:59', '2024-06-08 03:45:59'),
(8, '9655df95fc4fbeadc209326024b6c50e0af554a9', 1, '2024-06-08 03:44:19', '2024-06-08 04:44:19'),
(9, 'a235522022edd749276b49875151f762b9cb2c60', 1, '2024-06-08 04:27:57', '2024-06-08 05:27:57'),
(10, 'd3a8477d5fe490654d04cd981153aeed0e31f0f7', 1, '2024-06-08 13:51:30', '2024-06-08 14:51:30'),
(11, '91c37a74b824324885368da713ba99ca5ab24608', 1, '2024-06-08 15:45:03', '2024-06-08 16:45:03'),
(12, 'd7750fe169e6fd2b5e3d107bb4f471b9430d75eb', 1, '2024-06-08 15:45:36', '2024-06-08 16:45:36'),
(13, '41f278291f5bda5ce88042aab9056fcce1a4932e', 1, '2024-06-08 15:59:33', '2024-06-08 16:59:33'),
(14, 'b75c6a0d40d378201ed66396f23931aaec74be2d', 1, '2024-06-08 16:39:56', '2024-06-08 17:39:56');
COMMIT;
 