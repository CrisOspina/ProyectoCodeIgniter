-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-05-2019 a las 21:42:16
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
(1, 'aaa', '2019-05-08 19:22:36', '2019-05-08 19:22:36');

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
(1, 1, '111', 'aa', '23232', '', '', 'aaaa@gmail.com', '2019-05-08 19:38:13', '2019-05-08 19:38:13', 'cdcd', 'a');

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
(1, 0, '111', 'Producto 1', '<p>\n	Lorem ipsum</p>\n', 2000, 16, 3, '9874a-mani.jpg', '', '2019-05-08 17:54:41', '2019-05-08 17:54:41');

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
(1, 'aaa', '2019-05-08 19:36:53', '2019-05-08 19:36:53');

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
  ADD UNIQUE KEY `ref` (`ref`),
  ADD UNIQUE KEY `token` (`token`);

--
-- Indices de la tabla `pedidos_encabezado`
--
ALTER TABLE `pedidos_encabezado`
  ADD PRIMARY KEY (`pkid`),
  ADD UNIQUE KEY `token` (`token`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tiposdeclientes`
--
ALTER TABLE `tiposdeclientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1010107;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
