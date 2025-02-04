-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3307
-- Tiempo de generación: 04-02-2025 a las 17:56:04
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
-- Base de datos: `api_v2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `imagen`, `usuario_id`) VALUES
(4, 'Silla Gamer Ergonómica', 'Silla Gaemer Ergonómica de color negro', 900.00, 'https://www.e-bestprice.com/cdn/shop/files/silla-gamer-ergonomica-dreizt-shine-series-negro-con-posapies-reclinable-copy-1183974-1183_dae4ebce-6531-4004-98aa-2e214b894e9120230801T163833132.jpg?v=1691674132', 1),
(6, 'Teclado', 'teclado de color negro', 150.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ_QMpgNT_rTxob9OWQRKC_cVsRbZFC1j9JJA&s', 2),
(7, 'Mesa', 'mesa de color negro', 200.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ_QMpgNT_rTxob9OWQRKC_cVsRbZFC1j9JJA&s', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `clave` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `email`, `clave`) VALUES
(1, 'Juan Pérez', 'juanperez', 'juan@example.com', '$2y$10$JT1.0b9jNJ6Ing6xELNtweA47oITXWTcQUPi1kOLKR4xHX3Y7CIoC'),
(2, 'Jherson Villa', 'jherson', 'jherson@example.com', '$2y$10$iuOgu7KnAhCa08uqMtfri.GZoO7Vl.lw01DqwuFjEvyog5KFwr3De'),
(3, 'La rana', 'rana', 'rana', '$2y$10$nSlhupPUfWistru/C.bCXui62ogSJqRqMBATMp/l12xAplaMEb8bi'),
(4, 'Pepe', '', 'pepe@gmail.com', '$2y$10$6vbtJQmmMyuUvGxNo4yi7eGhdJe.RyDnkMBZ22RDfR0h4dfbuxzPa'),
(5, 'Cesar P', 'cesar', 'cesar@gmail.com', '$2y$10$a1kj3txoogbwTiEA5CuptudcaS/D0bak.TZXvpSNAE6M6DWwohCzi'),
(6, ' ', 'jose', 'jose@gmail.com', '$2y$10$bhJDWfFShOcBEfjdpgMwXudsbO7OoqFpwU.FjPDa/c4WgbcD6m.se'),
(7, 'Manuel', 'manuel', 'manuel@gmail.com', '$2y$10$InBJSc2FpmIPr0Y.qyoVS.cGH8QHJtrGmTZ/CTczF2pz4LS7bVdvS');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
