-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-05-2024 a las 00:31:40
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
-- Base de datos: `realstate`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favoritos`
--

CREATE TABLE `favoritos` (
  `id` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idInmueble` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `favoritos`
--

INSERT INTO `favoritos` (`id`, `idUsuario`, `idInmueble`) VALUES
(26, 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenesinmuebles`
--

CREATE TABLE `imagenesinmuebles` (
  `IdImagen` int(11) NOT NULL,
  `RutaImagen` varchar(255) NOT NULL,
  `IdInmueble` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `imagenesinmuebles`
--

INSERT INTO `imagenesinmuebles` (`IdImagen`, `RutaImagen`, `IdInmueble`) VALUES
(127, 'imagenes/img_66567c1bd1187_1716943899.jpg', 1),
(128, 'imagenes/img_66567c1bd17b9_1716943899.jpg', 1),
(129, 'imagenes/img_66567c1bd1e19_1716943899.jpg', 1),
(130, 'imagenes/img_66567c9e8dff3_1716944030.jpg', 2),
(131, 'imagenes/img_66567c9e8e61b_1716944030.jpg', 2),
(132, 'imagenes/img_66567c9e8ec76_1716944030.jpg', 2),
(133, 'imagenes/img_66567cc8c3eca_1716944072.jpg', 3),
(134, 'imagenes/img_66567cc8c4852_1716944072.jpg', 3),
(135, 'imagenes/img_66567cc8c52cf_1716944072.jpg', 3),
(136, 'imagenes/img_66567cfad6f35_1716944122.jpg', 4),
(137, 'imagenes/img_66567cfad76d8_1716944122.jpg', 4),
(138, 'imagenes/img_66567cfad80dc_1716944122.jpg', 4),
(139, 'imagenes/img_66567cfad9209_1716944122.jpg', 4),
(140, 'imagenes/img_66567fb623628_1716944822.jpg', 5),
(141, 'imagenes/img_66567fb623e26_1716944822.jpg', 5),
(142, 'imagenes/img_66567fb624500_1716944822.jpg', 5),
(143, 'imagenes/img_66567fb624c85_1716944822.jpg', 5),
(144, 'imagenes/img_66567ff38a4ab_1716944883.jpg', 6),
(145, 'imagenes/img_66567ff38ac0e_1716944883.jpg', 6),
(146, 'imagenes/img_665680212717b_1716944929.jpg', 7),
(147, 'imagenes/img_66568021277be_1716944929.jpg', 7),
(148, 'imagenes/img_6656802128168_1716944929.jpg', 7),
(149, 'imagenes/img_6656802128ae5_1716944929.jpg', 7),
(150, 'imagenes/img_66568049f1392_1716944969.jpg', 8),
(151, 'imagenes/img_6656804a01777_1716944970.jpg', 8),
(152, 'imagenes/img_665680cb9d559_1716945099.jpg', 9),
(153, 'imagenes/img_665680cb9dbe2_1716945099.jpg', 9),
(154, 'imagenes/img_665680cb9eac1_1716945099.jpg', 9),
(155, 'imagenes/img_665680efc1865_1716945135.jpg', 10),
(156, 'imagenes/img_665680efc2227_1716945135.jpg', 10),
(157, 'imagenes/img_66568c017bc36_1716947969.jpg', 11),
(158, 'imagenes/img_66568c017c14f_1716947969.jpg', 11),
(159, 'imagenes/img_66569a37f07b6_1716951607.jpg', 12),
(160, 'imagenes/img_66569a37f1334_1716951607.jpg', 12),
(162, 'imagenes/img_66569a6d6be80_1716951661.jpg', 13),
(163, 'imagenes/img_66569a6d6c8fa_1716951661.jpg', 13),
(164, 'imagenes/img_66569c993db02_1716952217.jpg', 14),
(165, 'imagenes/img_66569c993e63c_1716952217.jpg', 14),
(166, 'imagenes/img_66569c993f2cc_1716952217.jpg', 14),
(167, 'imagenes/img_66569cc2a3e27_1716952258.jpg', 15),
(168, 'imagenes/img_66569cc2a4765_1716952258.jpg', 15),
(169, 'imagenes/img_66569d161b78d_1716952342.jpg', 16),
(170, 'imagenes/img_66569d161bdfd_1716952342.jpg', 16),
(171, 'imagenes/img_66569d98905d6_1716952472.jpg', 17),
(172, 'imagenes/img_66569d9890c7f_1716952472.jpg', 17),
(173, 'imagenes/img_66569dd21e51a_1716952530.jpg', 18),
(174, 'imagenes/img_66569dd21eacb_1716952530.jpg', 18),
(175, 'imagenes/img_66569ea815888_1716952744.jpg', 19),
(176, 'imagenes/img_66569ea81600b_1716952744.jpg', 19),
(177, 'imagenes/img_66569ea816545_1716952744.jpg', 19),
(178, 'imagenes/img_6656a1164de3c_1716953366.jpg', 20),
(179, 'imagenes/img_6656a1164e3dc_1716953366.jpg', 20),
(180, 'imagenes/img_6656a1164ea0a_1716953366.jpg', 20),
(181, 'imagenes/img_6656a15d1bfd2_1716953437.jpg', 21),
(182, 'imagenes/img_6656a15d1cb4e_1716953437.jpg', 21),
(183, 'imagenes/img_6656a15d1dedf_1716953437.jpg', 21),
(184, 'imagenes/img_6656a18f2395b_1716953487.jpg', 22),
(185, 'imagenes/img_6656a18f2467e_1716953487.jpg', 22),
(186, 'imagenes/img_6656a18f25045_1716953487.jpg', 22),
(187, 'imagenes/img_6656a394651c1_1716954004.jpg', 23),
(188, 'imagenes/img_6656a39466064_1716954004.jpg', 23),
(189, 'imagenes/img_6656a39466733_1716954004.jpg', 23),
(190, 'imagenes/img_6656a3dacc548_1716954074.jpg', 24),
(191, 'imagenes/img_6656a3daccb2d_1716954074.jpg', 24),
(192, 'imagenes/img_6656a3dacd0b8_1716954074.jpg', 24),
(193, 'imagenes/img_6656a4053b482_1716954117.jpg', 25),
(194, 'imagenes/img_6656a4053c183_1716954117.jpg', 25),
(195, 'imagenes/img_6656a4053cf80_1716954117.jpg', 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE `solicitudes` (
  `idSolicitud` int(11) NOT NULL,
  `Nombre` varchar(40) NOT NULL,
  `Telefono` varchar(12) NOT NULL,
  `Correo` varchar(40) NOT NULL,
  `idInmuebleInteres` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitudes`
--

INSERT INTO `solicitudes` (`idSolicitud`, `Nombre`, `Telefono`, `Correo`, `idInmuebleInteres`) VALUES
(6, 'juandi ', '3225554856', 'cloychillonaconsentida@gmail.com', 0),
(10, 'juandi kun', '3225554856', 'cloy14q@gmail.com', 0),
(11, 'kacho', '3225554856', 'juancho14@gmail.com', 0),
(13, 'karol', '3225554845', 'juancho14@gmail.com', 0),
(15, 'juandi', '3225554856', 'juancho@gmail.com', 0),
(16, 'kacho kiun', '32165161', 'cloy14q@gmail.com', 0),
(24, 'juandi su amdre', '3225554856', 'juancho14@gmail.com', 0),
(26, 'juandi', '3225554856', 'juancho14@gmail.com', 5),
(27, 'juandi su amdre', '3225554856', 'juancho14@gmail.com', 3),
(28, 'kacho kiun kiun', '3225456', 'cloy14q@gmail.com', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblcategoria`
--

CREATE TABLE `tblcategoria` (
  `IdCategoria` int(11) NOT NULL,
  `Nombres` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tblcategoria`
--

INSERT INTO `tblcategoria` (`IdCategoria`, `Nombres`) VALUES
(1, 'Casa'),
(2, 'Apartamento'),
(3, 'Lote'),
(4, 'Finca'),
(5, 'Bodega');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblcita`
--

CREATE TABLE `tblcita` (
  `IdCita` int(11) NOT NULL,
  `IdUsuario` int(11) NOT NULL,
  `Nombre_usuario` varchar(30) NOT NULL,
  `Nombre_asesor` varchar(30) NOT NULL,
  `Dirección` varchar(20) NOT NULL,
  `Fecha` date NOT NULL,
  `Hora` time NOT NULL,
  `Telefono` varchar(10) NOT NULL,
  `codigoc` int(11) NOT NULL,
  `infoinmueble` varchar(50) NOT NULL,
  `Precio_final` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tblcita`
--

INSERT INTO `tblcita` (`IdCita`, `IdUsuario`, `Nombre_usuario`, `Nombre_asesor`, `Dirección`, `Fecha`, `Hora`, `Telefono`, `codigoc`, `infoinmueble`, `Precio_final`) VALUES
(1, 42, 'Andres Steven Alzate Castañeda', 'Juan Perez', 'Cra 88f n 56 26', '2024-05-22', '10:30:00', '3209586712', 1, '5', '1000000'),
(2, 6, 'tamarindo', 'Laura Gomez', 'cra 54 n 88 h 24', '2024-04-30', '14:00:00', '2324324524', 2, '3', '1500000'),
(5, 42, 'thdhdthdfh', 'Ana Rodriguez', 'dsfgdfshsfghbsf', '2024-04-17', '11:45:00', '456464564', 2, '3', '1800000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblinmueble`
--

CREATE TABLE `tblinmueble` (
  `IdInmueble` int(11) NOT NULL,
  `Titulo` varchar(100) NOT NULL,
  `Estado` enum('Disponible','En proceso de adquisición','No disponible') NOT NULL,
  `Ubicacion` varchar(255) NOT NULL,
  `Precio` varchar(200) NOT NULL,
  `Localidad` varchar(15) NOT NULL,
  `Dirección` varchar(50) NOT NULL,
  `Estrato` int(11) NOT NULL,
  `Area_construida` varchar(20) NOT NULL,
  `NumeroPisos` int(11) DEFAULT NULL,
  `Habitaciones` int(11) DEFAULT NULL,
  `Baños` int(11) DEFAULT NULL,
  `Cocina` int(11) DEFAULT NULL,
  `Garaje` varchar(10) DEFAULT NULL,
  `Patio` varchar(10) DEFAULT NULL,
  `Estudio` varchar(10) DEFAULT NULL,
  `Contacto` varchar(50) NOT NULL,
  `codigoc` int(11) NOT NULL,
  `descripcion` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tblinmueble`
--

INSERT INTO `tblinmueble` (`IdInmueble`, `Titulo`, `Estado`, `Ubicacion`, `Precio`, `Localidad`, `Dirección`, `Estrato`, `Area_construida`, `NumeroPisos`, `Habitaciones`, `Baños`, `Cocina`, `Garaje`, `Patio`, `Estudio`, `Contacto`, `codigoc`, `descripcion`) VALUES
(1, 'Casa en venta', 'Disponible', 'ubicacion/ubicacion_66567c1bd2be6_1716943899.png', '160000000', 'bosa', 'cra18num13', 4, '120', 2, 4, 4, 1, '5', '1', '5', '32245575671', 1, 'cam,vinga vkjmxc hn nikvcnmvjndsioncfisdiucbu9fdnou cbicxnvji sanm  zmvkondmivn smcdsnmodm9udsjfipjf psh´gñn mhgkphjmkomvjodsmcfkp ijbnm pam xvihjnldk g8uyhj iokdvnguomdkjlbnerkpnd puv otm gimlñb ojrtgnbmkh ghirfmbopgmpfñdtjgn0p{,mxcvkogmklñjmdpsg jodx ni km bkjozdmfgbko jkgfoigmhwtghjp kdopftmgoimgf0ihmvi´d'),
(2, 'Casa en Venta', 'Disponible', 'ubicacion/ubicacion_66567c9e8f4aa_1716944030.png', '150000000', 'soacha', 'cra18num', 4, '1000', 5, 4, 1, 2, '1', '1', '1', '32228978', 1, 'ronal wrvha8 h4yuerhfa4iuw gweuar bfuobwuyw4ef8yierh  gbfjkfklszxniuwenduiovnosgnirons r jnbsdfkb 9uaeisrbn ewg eduhbf uoernf ond oewdjnvjols nsdf 9uew hehuvl y8ld hnrdhfjsd hfudahns o fmocxpmodi  ihjnoxljdsxzncd '),
(3, 'Casa en Venta', 'En proceso de adquisición', 'ubicacion/ubicacion_66567cc8c5ddf_1716944072.png', '350000000', 'novena', 'recreo', 5, '120', 2, 2, 5, 2, '1', '1', '1', '3053483532', 1, 'vinicius vkjmxc hn nikvcnmvjndsioncfisdiucbu9fdnou cbicxnvji sanm zmvkondmivn smcdsnmodm9udsjfipjf psh´gñn mhgkphjmkomvjodsmcfkp ijbnm pam xvihjnldk g8uyhj iokdvnguomdkjlbnerkpnd puv otm gimlñb ojrtgnbmkh ghirfmbopgmpfñdtjgn0p{,mxcvkogmklñjmdpsg jodx ni km bkjozdmfgbko jkgfoigmhwtghjp kdopftmgoimgf0ihmvi´d'),
(4, 'Casa en venta', 'Disponible', 'ubicacion/ubicacion_66567cfad9eae_1716944122.png', '150000000', 'usaquen', 'cra18num13', 5, '70', 3, 3, 3, 3, '1', '1', '1', '3053483532', 1, 'La casa en cuestión destaca por su perfecta combinación de elegancia clásica y comodidades contemporáneas. Estratégicamente ubicada, esta residencia ofrece cercanía a centros comerciales, restaurantes de renombre, parques y lugares de interés cultural, brindando así un estilo de vida urbano sin sacrificar la tranquilidad y seguridad.'),
(5, 'Casa en venta', 'Disponible', 'ubicacion/ubicacion_66567fb6257b8_1716944822.png', '200000000', 'Bosa', 'vdrgdfgdgerdgd', 3, '90', 2, 2, 2, 2, '2', '2', '2', '4323412313', 1, 'hdfghdfgncfyhdh'),
(6, 'Apartamento en Venta', 'Disponible', 'ubicacion/ubicacion_66567ff38c2ae_1716944883.png', '200000000', 'bosa', 'Cra 80 #60-15', 3, '85', 1, 3, 2, 0, '1', '1', '1', '3224242', 2, 'Apartamento en excelente estado, bien ubicado.'),
(7, 'Apartamento en Venta', 'Disponible', 'ubicacion/ubicacion_66568021293cb_1716944929.png', '210000000', 'bosa', 'Calle 70 #78-22', 3, '90', 1, 2, 2, 0, '0', '1', '1', '23422535', 2, 'Apartamento cómodo y luminoso, cerca a transporte público.'),
(8, 'Apartamento en Venta', 'Disponible', 'ubicacion/ubicacion_6656804a06044_1716944970.png', '220000000', 'novena', 'Transv 79 #65-30', 6, '95', 16, 0, 7, 0, '3', '0', '5', '568696858', 2, 'Apartamento amplio con excelentes acabados y parqueadero.'),
(9, 'Apartamento en Venta', 'Disponible', 'ubicacion/ubicacion_665680cb9f3ad_1716945099.png', '230000000', 'bosa', 'Av. Cali #70-50', 4, '100', 2, 3, 3, 0, '2', '2', '2', '235345353254', 2, 'Apartamento moderno con balcón y patio.'),
(10, 'Apartamento en Venta', 'Disponible', 'ubicacion/ubicacion_665680efc29b3_1716945135.png', '240000000', 'bosa', 'Cra 82 #68-12', 4, '110', 3, 3, 2, 0, '1', '2', '3', '3453234224', 2, 'Hermoso apartamento en zona tranquila y segura.'),
(11, 'Lote en Venta', 'Disponible', 'ubicacion/ubicacion_66568c017d1db_1716947969.png', '250000000', 'soacha', 'Calle 13 #8-45', 3, '120', 2, 3, 2, 0, '4', '0', '5', '3453525353', 3, 'Casa de dos pisos en buen estado, lista para habitar.'),
(12, 'Lote en Venta', 'Disponible', 'ubicacion/ubicacion_66569a37f1cc9_1716951607.png', '260000000', 'soacha', 'Carrera 10 #15-33', 4, '130', 2, 4, 3, 0, '4', '0', '6', '45563453674', 3, 'Amplia casa con patio y parqueadero, cerca a colegios.'),
(13, 'Lote en Venta', 'Disponible', 'ubicacion/ubicacion_66569a6d6d8f3_1716951661.png', '270000000', 'soacha', 'Av. Las Americas #20-10', 4, '140', 3, 5, 3, 0, '3', '2', '7', '346445646', 3, 'Casa en conjunto cerrado con seguridad 24 horas.'),
(14, 'Lote en Venta', 'Disponible', 'ubicacion/ubicacion_66569c99405c9_1716952217.png', '280000000', 'soacha', 'Calle 20 #12-15', 4, '150', 3, 3, 2, 0, '4', '4', '4', '646454645646', 3, 'Casa remodelada, lista para mudarse.'),
(15, 'Lote en Venta', 'Disponible', 'ubicacion/ubicacion_66569cc2a4fab_1716952258.png', '290000000', 'soacha', 'Cra 5 #18-9', 5, '160', 3, 4, 3, 0, '5', '4', '8', '564563363', 3, 'Casa con excelentes acabados y amplio jardín.'),
(16, 'Finca en Venta', 'Disponible', 'ubicacion/ubicacion_66569d161c5a4_1716952342.png', '300000000', 'novena', 'Calle 45 #30-20', 3, '80', 1, 2, 1, 0, '3', '4', '3', '5465163645', 4, 'Apartamento acogedor en excelente ubicación.'),
(17, 'Finca en Venta', 'Disponible', 'ubicacion/ubicacion_66569d98914a5_1716952472.png', '310000000', 'novena', 'Carrera 40 #50-11', 3, '85', 1, 3, 2, 0, '5', '5', '5', '645465754', 4, 'Luminoso apartamento con vista a la ciudad.'),
(18, 'Finca en Venta', 'Disponible', 'ubicacion/ubicacion_66569dd21f439_1716952530.png', '320000000', 'novena', 'Transv 41 #51-15', 4, '90', 2, 4, 2, 0, '0', '4', '4', '4576434634636', 4, 'Apartamento espacioso y bien distribuido.'),
(19, 'Finca en Venta', 'Disponible', 'ubicacion/ubicacion_66569ea816d23_1716952744.png', '330000000', 'novena', 'Av. Caracas #43-20', 4, '95', 2, 3, 3, 0, '5', '5', '5', '67545454747', 4, 'Apartamento moderno con acabados de lujo.'),
(20, 'Finca en Venta', 'Disponible', 'ubicacion/ubicacion_6656a1164f360_1716953366.png', '340000000', 'novena', 'Cra 44 #54-30', 4, '100', 3, 3, 2, 0, '6', '6', '6', '45674545678', 4, 'Hermoso apartamento con excelente iluminación.'),
(21, 'Bodega en Venta', 'Disponible', 'ubicacion/ubicacion_6656a15d1e766_1716953437.png', '350000000', 'usaquen', 'Calle 123 #20-30', 4, '110', 2, 4, 3, 0, '0', '0', '0', '57453464436', 5, 'Casa amplia y moderna en excelente ubicación.'),
(22, 'Casa en Venta', 'Disponible', 'ubicacion/ubicacion_6656a18f269d2_1716953487.png', '360000000', 'usaquen', 'Carrera 15 #127-45', 4, '120', 2, 5, 3, 0, '0', '0', '0', '5675744747', 5, 'Hermosa casa con jardín y garaje doble.'),
(23, 'Bodega en Venta', 'Disponible', 'ubicacion/ubicacion_6656a39466f26_1716954004.png', '370000000', 'usaquen', 'Transv 21 #129-60', 5, '130', 3, 3, 2, 0, '0', '0', '0', '644636347436', 5, 'Casa en conjunto cerrado con vigilancia.'),
(24, 'Bodega en Venta', 'Disponible', 'ubicacion/ubicacion_6656a3dacd8a5_1716954074.png', '380000000', 'usaquen', 'Av. 19 #130-25', 5, '140', 3, 4, 3, 0, '0', '0', '0', '495864984968395388349378563', 5, 'Casa remodelada con amplios espacios.'),
(25, 'Casa en Venta', 'Disponible', 'ubicacion/ubicacion_6656a4053d7a2_1716954117.png', '390000000', 'usaquen', 'Cra 18 #132-10', 5, '150', 3, 5, 3, 0, '0', '0', '0', '765465464645', 5, 'Casa de lujo en zona exclusiva.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblusuarios`
--

CREATE TABLE `tblusuarios` (
  `id` int(11) NOT NULL,
  `Nombres` varchar(40) NOT NULL,
  `Correo` varchar(40) NOT NULL,
  `Contraseña` varchar(32) NOT NULL,
  `rol` enum('usuario','administrador') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tblusuarios`
--

INSERT INTO `tblusuarios` (`id`, `Nombres`, `Correo`, `Contraseña`, `rol`) VALUES
(4, 'yiyi kun', 'yiyiconsentida@gmail.com', '9d02702ad9978bdd3d5d6cf32771a58c', 'usuario'),
(85, 'isagi', 'solobluelock@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'administrador');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idInmueble` (`idInmueble`);

--
-- Indices de la tabla `imagenesinmuebles`
--
ALTER TABLE `imagenesinmuebles`
  ADD PRIMARY KEY (`IdImagen`),
  ADD KEY `IdInmueble` (`IdInmueble`);

--
-- Indices de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD PRIMARY KEY (`idSolicitud`);

--
-- Indices de la tabla `tblcategoria`
--
ALTER TABLE `tblcategoria`
  ADD PRIMARY KEY (`IdCategoria`);

--
-- Indices de la tabla `tblcita`
--
ALTER TABLE `tblcita`
  ADD PRIMARY KEY (`IdCita`);

--
-- Indices de la tabla `tblinmueble`
--
ALTER TABLE `tblinmueble`
  ADD PRIMARY KEY (`IdInmueble`);

--
-- Indices de la tabla `tblusuarios`
--
ALTER TABLE `tblusuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `imagenesinmuebles`
--
ALTER TABLE `imagenesinmuebles`
  MODIFY `IdImagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;

--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `idSolicitud` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `tblcategoria`
--
ALTER TABLE `tblcategoria`
  MODIFY `IdCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tblcita`
--
ALTER TABLE `tblcita`
  MODIFY `IdCita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tblinmueble`
--
ALTER TABLE `tblinmueble`
  MODIFY `IdInmueble` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `tblusuarios`
--
ALTER TABLE `tblusuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `imagenesinmuebles`
--
ALTER TABLE `imagenesinmuebles`
  ADD CONSTRAINT `imagenesinmuebles_ibfk_1` FOREIGN KEY (`IdInmueble`) REFERENCES `tblinmueble` (`IdInmueble`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;







