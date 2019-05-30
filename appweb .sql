-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-05-2019 a las 03:48:22
-- Versión del servidor: 10.1.32-MariaDB
-- Versión de PHP: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `appweb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoriasproductos`
--

CREATE TABLE `categoriasproductos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `fecharegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechamodificacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoriasproductos`
--

INSERT INTO `categoriasproductos` (`id`, `nombre`, `fecharegistro`, `fechamodificacion`) VALUES
(2, 'tofus', '2019-05-23 04:07:35', '2019-05-23 04:07:35'),
(3, 'proteina vegetal', '2019-05-23 04:07:55', '2019-05-23 04:07:55'),
(4, 'Leche vegetal', '2019-05-23 04:09:03', '2019-05-23 04:09:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` bigint(20) NOT NULL,
  `tipocliente` int(11) NOT NULL,
  `nit` varchar(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `rut` varchar(50) NOT NULL,
  `estadosfinancieros` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `fecharegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechamodificacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `direccion` varchar(255) NOT NULL,
  `comercial` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `tipocliente`, `nit`, `nombre`, `telefono`, `rut`, `estadosfinancieros`, `correo`, `fecharegistro`, `fechamodificacion`, `direccion`, `comercial`) VALUES
(3, 2, '181818181', 'Hel Midgard', '433434', '', '', 'hel@gmail.com', '2019-05-23 04:21:10', '2019-05-23 04:21:10', 'calle 45 B 78', ''),
(4, 2, '343434', 'Hades Ortiz', '666666', '', '', 'hades@gmail.com', '2019-05-23 04:22:30', '2019-05-23 04:22:30', 'calle hell', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos_detalle`
--

CREATE TABLE `pedidos_detalle` (
  `pkid` bigint(20) NOT NULL,
  `ref` varchar(20) NOT NULL,
  `token` varchar(100) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `precio` bigint(20) NOT NULL,
  `subtotal` bigint(20) NOT NULL,
  `cantidad` bigint(20) NOT NULL,
  `impuesto` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedidos_detalle`
--

INSERT INTO `pedidos_detalle` (`pkid`, `ref`, `token`, `nombre`, `precio`, `subtotal`, `cantidad`, `impuesto`) VALUES
(27, '111', 'nNQQ2K2L52RfsXJ+a+pnalLy4qV5UylyjP6Sxg8mqutpMGViMnFmbGc3YTV0azd1aTFyZWZqbWV0bnA1YjkzdA==', '', 9000, 20880, 2, 0),
(32, '111', 'IbsdPeRDJcxzSQcTwSw3d5HXs+352tEijlMJJ9hu2190aGRuaWtidmIybGc1NTRlYWhrOWxrY2Z2c25pbG5zYg==', '', 9000, 20880, 2, 0),
(33, '222', 'inTBMln/Yi3icipZvo3pGXZBndRx03R5Io4x+jfq+qh0aGRuaWtidmIybGc1NTRlYWhrOWxrY2Z2c25pbG5zYg==', '', 6600, 39270, 5, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos_encabezado`
--

CREATE TABLE `pedidos_encabezado` (
  `pkid` bigint(20) NOT NULL,
  `token` varchar(100) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `unidades` int(11) NOT NULL,
  `total` bigint(20) NOT NULL,
  `estado` int(1) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `direccion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedidos_encabezado`
--

INSERT INTO `pedidos_encabezado` (`pkid`, `token`, `nombre`, `telefono`, `correo`, `unidades`, `total`, `estado`, `fecha`, `direccion`) VALUES
(3, 'IbsdPeRDJcxzSQcTwSw3d5HXs+352tEijlMJJ9hu2190aGRuaWtidmIybGc1NTRlYWhrOWxrY2Z2c25pbG5zYg==', 'Hel Midgard', '433434', 'hel@gmail.com', 2, 20880, 1, '2019-05-23 05:00:49', 'calle 45 B 78'),
(4, 'inTBMln/Yi3icipZvo3pGXZBndRx03R5Io4x+jfq+qh0aGRuaWtidmIybGc1NTRlYWhrOWxrY2Z2c25pbG5zYg==', 'Hades Ortiz', '666666', 'hades@gmail.com', 5, 39270, 1, '2019-05-23 05:01:13', 'calle hell');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` bigint(20) NOT NULL,
  `categoria` int(11) NOT NULL,
  `ref` varchar(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` mediumtext NOT NULL,
  `precio` bigint(50) NOT NULL,
  `iva` bigint(50) NOT NULL,
  `cant` bigint(100) NOT NULL,
  `foto1` varchar(50) NOT NULL,
  `foto2` varchar(50) NOT NULL,
  `fecharegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechamodificacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `categoria`, `ref`, `nombre`, `descripcion`, `precio`, `iva`, `cant`, `foto1`, `foto2`, `fecharegistro`, `fechamodificacion`) VALUES
(3, 3, '111', 'Maní', '', 9000, 16, 9, '860f5-mani.jpg', '', '2019-05-23 04:11:24', '2019-05-23 04:11:24'),
(4, 2, '222', 'Queso de almendras', '', 6600, 19, 20, '78842-queso-almendras.jpg', '', '2019-05-23 04:13:25', '2019-05-23 04:13:25'),
(5, 4, '333', 'Yogurt de almendras - sabor mora', '', 18000, 19, 6, '7b630-yogurt-almendras-mora.jpg', '', '2019-05-23 04:15:01', '2019-05-23 04:15:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `fecharegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechamodificacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`, `fecharegistro`, `fechamodificacion`) VALUES
(1, 'admin', '2019-03-28 01:29:00', '2019-03-28 01:34:07'),
(3, 'Consultor', '2019-03-28 01:52:58', '2019-03-28 01:53:28'),
(4, 'Estrategico', '2019-04-03 23:23:09', '2019-04-03 23:23:09'),
(5, 'Esencial', '2019-04-03 23:23:16', '2019-04-03 23:23:16'),
(6, 'Historico', '2019-04-03 23:24:14', '2019-04-03 23:24:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposdeclientes`
--

CREATE TABLE `tiposdeclientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `fecharegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechamodificacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tiposdeclientes`
--

INSERT INTO `tiposdeclientes` (`id`, `nombre`, `fecharegistro`, `fechamodificacion`) VALUES
(2, 'Vegano', '2019-05-23 04:15:57', '2019-05-23 04:15:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `perfil` int(11) NOT NULL,
  `fechaingreso` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechamodificacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `foto` varchar(50) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `linkedin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `correo`, `clave`, `nombre`, `telefono`, `perfil`, `fechaingreso`, `fechamodificacion`, `foto`, `facebook`, `twitter`, `linkedin`) VALUES
(2332, 't@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Thyr', '34343', 3, '2019-02-14 01:25:10', '2019-02-21 01:24:19', '', '', '', ''),
(10101, 'c@gmail.co', '827ccb0eea8a706c4c34a16891f84e7b', 'Cristian Ospina', '', 1, '2019-02-14 01:21:35', '2019-03-07 01:15:58', '', '', '', ''),
(1010102, 'qqq@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'qqqq', '', 1, '2019-02-28 01:54:43', '2019-02-28 01:54:43', '', '', '', ''),
(1010103, 'cris@gmail.com', '202cb962ac59075b964b07152d234b70', 'cristian', '445454', 1, '2019-03-20 23:53:04', '2019-03-20 23:53:04', '', '', '', ''),
(1010105, 'c@gmail.com', '202cb962ac59075b964b07152d234b70', 'cristian', '2323', 5, '2019-04-04 01:21:49', '2019-04-11 00:24:58', '7c2ce-1.jpg', 'www.facebook.com', '', ''),
(1010106, 'thor@gmail.com', '202cb962ac59075b964b07152d234b70', 'thor', '2342', 1, '2019-04-04 01:35:03', '2019-04-04 01:35:03', '4d97d-1.jpg', '', '', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoriasproductos`
--
ALTER TABLE `categoriasproductos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nit` (`nit`);

--
-- Indices de la tabla `pedidos_detalle`
--
ALTER TABLE `pedidos_detalle`
  ADD PRIMARY KEY (`pkid`),
  ADD UNIQUE KEY `token` (`token`),
  ADD UNIQUE KEY `token_2` (`token`) USING BTREE,
  ADD UNIQUE KEY `ref_2` (`ref`,`token`),
  ADD KEY `ref` (`ref`) USING BTREE;

--
-- Indices de la tabla `pedidos_encabezado`
--
ALTER TABLE `pedidos_encabezado`
  ADD PRIMARY KEY (`pkid`),
  ADD UNIQUE KEY `token` (`token`) USING BTREE;

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nit` (`ref`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `tiposdeclientes`
--
ALTER TABLE `tiposdeclientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unico` (`correo`),
  ADD KEY `buscarnombre` (`nombre`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoriasproductos`
--
ALTER TABLE `categoriasproductos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `pedidos_detalle`
--
ALTER TABLE `pedidos_detalle`
  MODIFY `pkid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `pedidos_encabezado`
--
ALTER TABLE `pedidos_encabezado`
  MODIFY `pkid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tiposdeclientes`
--
ALTER TABLE `tiposdeclientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1010107;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
