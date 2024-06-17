-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-06-2024 a las 04:06:05
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

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `ActualizarInmueble` (IN `p_IdInmueble` INT, IN `p_Titulo` VARCHAR(100), IN `p_Estado` ENUM('Disponible','En proceso de adquisición','No disponible'), IN `p_Ubicacion` VARCHAR(255), IN `p_Precio` VARCHAR(200), IN `p_Localidad` VARCHAR(15), IN `p_Direccion` VARCHAR(50), IN `p_Estrato` INT, IN `p_AreaConstruida` VARCHAR(20), IN `p_NumeroPisos` INT, IN `p_Habitaciones` INT, IN `p_Baños` INT, IN `p_Cocina` INT, IN `p_Garaje` VARCHAR(10), IN `p_Patio` VARCHAR(10), IN `p_Estudio` VARCHAR(10), IN `p_Contacto` VARCHAR(50), IN `p_CodigoC` INT, IN `p_Descripcion` VARCHAR(500))   BEGIN
    UPDATE tblinmueble
    SET 
        Titulo = p_Titulo,
        Estado = p_Estado,
        Ubicacion = p_Ubicacion,
        Precio = p_Precio,
        Localidad = p_Localidad,
        Dirección = p_Direccion,
        Estrato = p_Estrato,
        Area_construida = p_AreaConstruida,
        NumeroPisos = p_NumeroPisos,
        Habitaciones = p_Habitaciones,
        Baños = p_Baños,
        Cocina = p_Cocina,
        Garaje = p_Garaje,
        Patio = p_Patio,
        Estudio = p_Estudio,
        Contacto = p_Contacto,
        codigoc = p_CodigoC,
        descripcion = p_Descripcion
    WHERE IdInmueble = p_IdInmueble;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `EliminarInmueble` (IN `p_IdInmueble` INT)   BEGIN
    DELETE FROM tblinmueble WHERE IdInmueble = p_IdInmueble;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertarInmueble` (IN `p_Titulo` VARCHAR(100), IN `p_Estado` ENUM('Disponible','En proceso de adquisición','No disponible'), IN `p_Ubicacion` VARCHAR(255), IN `p_Precio` VARCHAR(200), IN `p_Localidad` VARCHAR(15), IN `p_Direccion` VARCHAR(50), IN `p_Estrato` INT, IN `p_AreaConstruida` VARCHAR(20), IN `p_NumeroPisos` INT, IN `p_Habitaciones` INT, IN `p_Baños` INT, IN `p_Cocina` INT, IN `p_Garaje` VARCHAR(10), IN `p_Patio` VARCHAR(10), IN `p_Estudio` VARCHAR(10), IN `p_Contacto` VARCHAR(50), IN `p_CodigoC` INT, IN `p_Descripcion` VARCHAR(500))   BEGIN
    INSERT INTO tblinmueble (
        Titulo, Estado, Ubicacion, Precio, Localidad, Dirección, Estrato, Area_construida, 
        NumeroPisos, Habitaciones, Baños, Cocina, Garaje, Patio, Estudio, Contacto, codigoc, descripcion
    ) VALUES (
        p_Titulo, p_Estado, p_Ubicacion, p_Precio, p_Localidad, p_Direccion, p_Estrato, p_AreaConstruida,
        p_NumeroPisos, p_Habitaciones, p_Baños, p_Cocina, p_Garaje, p_Patio, p_Estudio, p_Contacto, p_CodigoC, p_Descripcion
    );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ObtenerInmueblePorID` (IN `p_IdInmueble` INT)   BEGIN
    SELECT * FROM tblinmueble WHERE IdInmueble = p_IdInmueble;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ObtenerInmuebles` ()   BEGIN
    SELECT * FROM tblinmueble;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditoria`
--

CREATE TABLE `auditoria` (
  `id` int(11) NOT NULL,
  `accion` varchar(20) NOT NULL,
  `tabla_afectada` varchar(50) NOT NULL,
  `id_registro_afectado` int(11) DEFAULT NULL,
  `usuario` varchar(40) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `datos_antiguos` varchar(500) DEFAULT NULL,
  `datos_nuevos` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `auditoria`
--

INSERT INTO `auditoria` (`id`, `accion`, `tabla_afectada`, `id_registro_afectado`, `usuario`, `fecha_hora`, `datos_antiguos`, `datos_nuevos`) VALUES
(3, 'ACTUALIZACION', 'tblinmueble', 41, '85', '2024-06-07 01:40:19', 'Titulo: Finca En Venta, Estado: En proceso de adquisición, Ubicacion: ubicacion/ubicacion_6662a26eb87c1_1717740142.jpg, Precio: 300000000, Localidad: soacha, Dirección: cradhgdfhdf, Estrato: 4, Area_construida: 4, NumeroPisos: 4, Habitaciones: 4, Baños: 4, Cocina: 4, Garaje: 4, Patio: 4, Estudio: 4, Contacto: 765765, codigoc: 4, Descripcion: gjdfjydghjfghjdghj', 'Titulo: casa, Estado: En proceso de adquisición, Ubicacion: ubicacion/ubicacion_6662a26eb87c1_1717740142.jpg, Precio: 300000000, Localidad: soacha, Dirección: cradhgdfhdf, Estrato: 4, Area_construida: 4, NumeroPisos: 4, Habitaciones: 4, Baños: 4, Cocina: 4, Garaje: 4, Patio: 4, Estudio: 4, Contacto: 765765, codigoc: 4, Descripcion: gjdfjydghjfghjdghj'),
(4, 'ELIMINACION', 'tblinmueble', 41, '85', '2024-06-07 01:41:47', 'Titulo: casa, Estado: En proceso de adquisición, Ubicacion: ubicacion/ubicacion_6662a26eb87c1_1717740142.jpg, Precio: 300000000, Localidad: soacha, Dirección: cradhgdfhdf, Estrato: 4, Area_construida: 4, NumeroPisos: 4, Habitaciones: 4, Baños: 4, Cocina: 4, Garaje: 4, Patio: 4, Estudio: 4, Contacto: 765765, codigoc: 4, Descripcion: gjdfjydghjfghjdghj', NULL),
(5, 'INSERCION', 'tblinmueble', 43, '85', '2024-06-07 01:43:31', NULL, 'Titulo: Finca En Venta, Estado: Disponible, Ubicacion: , Precio: 300000000, Localidad: soacha, Dirección: cradhgdfhdf, Estrato: 4, Area_construida: 4, NumeroPisos: 4, Habitaciones: 4, Baños: 4, Cocina: 4, Garaje: 4, Patio: 4, Estudio: 4, Contacto: 375465, codigoc: 4, Descripcion: dfgjjjjjjjdddfgfgdggggggggggggggggggggggggggggdfgh'),
(6, 'ACTUALIZACION', 'tblinmueble', 43, '85', '2024-06-07 01:43:31', 'Titulo: Finca En Venta, Estado: Disponible, Ubicacion: , Precio: 300000000, Localidad: soacha, Dirección: cradhgdfhdf, Estrato: 4, Area_construida: 4, NumeroPisos: 4, Habitaciones: 4, Baños: 4, Cocina: 4, Garaje: 4, Patio: 4, Estudio: 4, Contacto: 375465, codigoc: 4, Descripcion: dfgjjjjjjjdddfgfgdggggggggggggggggggggggggggggdfgh', 'Titulo: Finca En Venta, Estado: Disponible, Ubicacion: ubicacion/ubicacion_6662ac13f01b7_1717742611.png, Precio: 300000000, Localidad: soacha, Dirección: cradhgdfhdf, Estrato: 4, Area_construida: 4, NumeroPisos: 4, Habitaciones: 4, Baños: 4, Cocina: 4, Garaje: 4, Patio: 4, Estudio: 4, Contacto: 375465, codigoc: 4, Descripcion: dfgjjjjjjjdddfgfgdggggggggggggggggggggggggggggdfgh'),
(7, 'ACTUALIZACION', 'tblinmueble', 5, '85', '2024-06-07 01:45:24', 'Titulo: Casa en venta, Estado: Disponible, Ubicacion: ubicacion/ubicacion_66567fb6257b8_1716944822.png, Precio: 200000000, Localidad: Bosa, Dirección: vdrgdfgdgerdgd, Estrato: 3, Area_construida: 90, NumeroPisos: 2, Habitaciones: 2, Baños: 2, Cocina: 2, Garaje: 2, Patio: 2, Estudio: 2, Contacto: 4323412313, codigoc: 1, Descripcion: hdfghdfgncfyhdh', 'Titulo: Casa en venta, Estado: Disponible, Ubicacion: ubicacion/ubicacion_66567fb6257b8_1716944822.png, Precio: 200000000, Localidad: Bosa, Dirección: vdrgdfgdgerdgd, Estrato: 3, Area_construida: 90, NumeroPisos: 2, Habitaciones: 2, Baños: 2, Cocina: 2, Garaje: 2, Patio: 2, Estudio: 2, Contacto: 4323412313, codigoc: 1, Descripcion: hdfghdfgncfyhdh'),
(8, 'ACTUALIZACION', 'tblinmueble', 36, '85', '2024-06-07 01:46:02', 'Titulo: Finca En Venta, Estado: Disponible, Ubicacion: , Precio: 300000000, Localidad: soacha, Dirección: cradhgdfhdf, Estrato: 4, Area_construida: 4, NumeroPisos: 3, Habitaciones: 3, Baños: 3, Cocina: 3, Garaje: 3, Patio: 3, Estudio: 3, Contacto: 3, codigoc: 4, Descripcion: fghdghdghdgh', 'Titulo: Finca En Venta, Estado: Disponible, Ubicacion: , Precio: 300000000, Localidad: soacha, Dirección: cradhgdfhdf, Estrato: 4, Area_construida: 4, NumeroPisos: 3, Habitaciones: 3, Baños: 3, Cocina: 3, Garaje: 3, Patio: 3, Estudio: 3, Contacto: 3, codigoc: 4, Descripcion: fghdghdghdgh'),
(9, 'ACTUALIZACION', 'tblinmueble', 36, '85', '2024-06-07 01:46:02', 'Titulo: Finca En Venta, Estado: Disponible, Ubicacion: , Precio: 300000000, Localidad: soacha, Dirección: cradhgdfhdf, Estrato: 4, Area_construida: 4, NumeroPisos: 3, Habitaciones: 3, Baños: 3, Cocina: 3, Garaje: 3, Patio: 3, Estudio: 3, Contacto: 3, codigoc: 4, Descripcion: fghdghdghdgh', 'Titulo: Finca En Venta, Estado: Disponible, Ubicacion: ubicacion/ubicacion_6662acaa51afc_1717742762.png, Precio: 300000000, Localidad: soacha, Dirección: cradhgdfhdf, Estrato: 4, Area_construida: 4, NumeroPisos: 3, Habitaciones: 3, Baños: 3, Cocina: 3, Garaje: 3, Patio: 3, Estudio: 3, Contacto: 3, codigoc: 4, Descripcion: fghdghdghdgh'),
(10, 'Insercion', 'tblusuarios', 79, '85', '2024-06-07 12:13:32', NULL, 'Nombres: dark; Correo: alzateandres799@gmail.com; Contraseña: andres2004; Rol: usuario'),
(11, 'Actualizacion', 'tblusuarios', 79, '85', '2024-06-07 12:15:11', 'Nombres: dark; Correo: alzateandres799@gmail.com; Contraseña: andres2004; Rol: usuario', 'Nombres: Andres Alzate; Correo: alzateandres799@gmail.com; Contraseña: andres2004; Rol: usuario'),
(12, 'Eliminacion', 'tblusuarios', 79, '85', '2024-06-07 12:15:26', 'Nombres: Andres Alzate; Correo: alzateandres799@gmail.com; Contraseña: andres2004; Rol: usuario', NULL),
(13, 'Insercion', 'tblcita', 6, '85', '2024-06-07 12:20:04', NULL, 'IdUsuario: 85; Nombre_usuario: Juan Diego; Nombre_asesor: Jesus Fierro; Dirección: cra 88 f n 88 h 24; Fecha: 2024-06-26; Hora: 16:19:00; Telefono: 3209586712; codigoc: 2; infoinmueble: 10; Precio_final: 200000000'),
(14, 'Actualizacion', 'tblcita', 6, '85', '2024-06-07 12:20:41', 'IdUsuario: 85; Nombre_usuario: Juan Diego; Nombre_asesor: Jesus Fierro; Dirección: cra 88 f n 88 h 24; Fecha: 2024-06-26; Hora: 16:19:00; Telefono: 3209586712; codigoc: 2; infoinmueble: 10; Precio_final: 200000000', 'IdUsuario: 85; Nombre_usuario: Andres Alzate; Nombre_asesor: Jesus Fierro; Dirección: cra 88 f n 88 h 24; Fecha: 2024-06-26; Hora: 16:19:00; Telefono: 3209586712; codigoc: 2; infoinmueble: 10; Precio_final: 200000000'),
(15, 'Eliminacion', 'tblcita', 6, '85', '2024-06-07 12:20:59', 'IdUsuario: 85; Nombre_usuario: Andres Alzate; Nombre_asesor: Jesus Fierro; Dirección: cra 88 f n 88 h 24; Fecha: 2024-06-26; Hora: 16:19:00; Telefono: 3209586712; codigoc: 2; infoinmueble: 10; Precio_final: 200000000', NULL),
(16, 'Insercion', 'solicitudes', 29, '85', '2024-06-07 12:23:52', NULL, 'Nombre: ; Telefono: 3209586712; Correo: ; idInmuebleInteres: 0'),
(17, 'Eliminacion', 'solicitudes', 29, '85', '2024-06-07 12:24:15', 'Nombre: ; Telefono: 3209586712; Correo: ; idInmuebleInteres: 0', NULL),
(18, 'Actualizacion', 'solicitudes', 28, '85', '2024-06-07 12:24:38', 'Nombre: kacho kiun kiun; Telefono: 3225456; Correo: cloy14q@gmail.com; idInmuebleInteres: 15', 'Nombre: kacho kiun kiun ; Telefono: 645645453; Correo: cloy14q@gmail.com; idInmuebleInteres: 15'),
(19, 'ELIMINACION', 'tblinmueble', 5, '85', '2024-06-15 09:47:09', 'Titulo: Casa en venta, Estado: Disponible, Ubicacion: ubicacion/ubicacion_66567fb6257b8_1716944822.png, Precio: 200000000, Localidad: Bosa, Dirección: vdrgdfgdgerdgd, Estrato: 3, Area_construida: 90, NumeroPisos: 2, Habitaciones: 2, Baños: 2, Cocina: 2, Garaje: 2, Patio: 2, Estudio: 2, Contacto: 4323412313, codigoc: 1, Descripcion: hdfghdfgncfyhdh', NULL),
(20, 'ELIMINACION', 'tblinmueble', 28, '85', '2024-06-15 09:47:26', 'Titulo: Finca En Venta, Estado: Disponible, Ubicacion: ubicacion/ubicacion_6662911c1d8c5_1717735708.jpg, Precio: 300000000, Localidad: soacha, Dirección: cradhgdfhdf, Estrato: 3, Area_construida: 3, NumeroPisos: 3, Habitaciones: 3, Baños: 3, Cocina: 3, Garaje: 3, Patio: 3, Estudio: 3, Contacto: 57657, codigoc: 4, Descripcion: dyjstyhdtryhdthy', NULL),
(21, 'ELIMINACION', 'tblinmueble', 36, '85', '2024-06-15 09:47:46', 'Titulo: Finca En Venta, Estado: Disponible, Ubicacion: ubicacion/ubicacion_6662acaa51afc_1717742762.png, Precio: 300000000, Localidad: soacha, Dirección: cradhgdfhdf, Estrato: 4, Area_construida: 4, NumeroPisos: 3, Habitaciones: 3, Baños: 3, Cocina: 3, Garaje: 3, Patio: 3, Estudio: 3, Contacto: 3, codigoc: 4, Descripcion: fghdghdghdgh', NULL),
(22, 'ELIMINACION', 'tblinmueble', 37, '85', '2024-06-15 09:47:57', 'Titulo: Finca En Venta, Estado: Disponible, Ubicacion: ubicacion/ubicacion_66629aab7990e_1717738155.jpg, Precio: 300000000, Localidad: soacha, Dirección: cradhgdfhdf, Estrato: 5, Area_construida: 5, NumeroPisos: 45, Habitaciones: 4, Baños: 5, Cocina: 5, Garaje: 5, Patio: 5, Estudio: 5, Contacto: 5, codigoc: 4, Descripcion: fgdfghdh', NULL),
(23, 'ELIMINACION', 'tblinmueble', 38, '85', '2024-06-15 09:48:05', 'Titulo: Finca En Arriendo, Estado: Disponible, Ubicacion: ubicacion/ubicacion_66629e0e512bd_1717739022.jpg, Precio: 300000000, Localidad: soacha, Dirección: cradhgdfhdf, Estrato: 4, Area_construida: 4, NumeroPisos: 4, Habitaciones: 4, Baños: 4, Cocina: 4, Garaje: 4, Patio: 4, Estudio: 4, Contacto: 4444, codigoc: 4, Descripcion: dfghdfghdfgh', NULL),
(24, 'ELIMINACION', 'tblinmueble', 39, '85', '2024-06-15 09:48:14', 'Titulo: Finca En Arriendo, Estado: Disponible, Ubicacion: ubicacion/ubicacion_66629f4789178_1717739335.jpg, Precio: 300000000, Localidad: soacha, Dirección: cradhgdfhdf, Estrato: 4, Area_construida: 4, NumeroPisos: 4, Habitaciones: 4, Baños: 4, Cocina: 4, Garaje: 4, Patio: 4, Estudio: 4, Contacto: 4444, codigoc: 4, Descripcion: dfghdfghdfgh', NULL),
(25, 'ELIMINACION', 'tblinmueble', 43, '85', '2024-06-15 09:48:22', 'Titulo: Finca En Venta, Estado: Disponible, Ubicacion: ubicacion/ubicacion_6662ac13f01b7_1717742611.png, Precio: 300000000, Localidad: soacha, Dirección: cradhgdfhdf, Estrato: 4, Area_construida: 4, NumeroPisos: 4, Habitaciones: 4, Baños: 4, Cocina: 4, Garaje: 4, Patio: 4, Estudio: 4, Contacto: 375465, codigoc: 4, Descripcion: dfgjjjjjjjdddfgfgdggggggggggggggggggggggggggggdfgh', NULL),
(26, 'Insercion', 'tblusuarios', 58, '85', '2024-06-15 10:00:18', NULL, 'Nombres: UserEjemplo; Correo: alzateandres799@gmail.com; Contraseña: a5263aa568bdf6bcaeb38be13d9fcd3b; Rol: usuario'),
(27, 'Actualizacion', 'tblusuarios', 58, '85', '2024-06-15 10:02:52', 'Nombres: UserEjemplo; Correo: alzateandres799@gmail.com; Contraseña: a5263aa568bdf6bcaeb38be13d9fcd3b; Rol: usuario', 'Nombres: UserEjemplo; Correo: alzateandres799@gmail.com; Contraseña: a5263aa568bdf6bcaeb38be13d9fcd3b; Rol: administrador'),
(28, 'Eliminacion', 'tblusuarios', 58, '85', '2024-06-15 10:18:27', 'Nombres: UserEjemplo; Correo: alzateandres799@gmail.com; Contraseña: a5263aa568bdf6bcaeb38be13d9fcd3b; Rol: administrador', NULL),
(29, 'INSERCION', 'tblinmueble', 44, '85', '2024-06-15 10:32:03', NULL, 'Titulo: apartamento, Estado: Disponible, Ubicacion: , Precio: 12000000000, Localidad: bosa, Dirección: cra 56 i n 88 h 24, Estrato: 3, Area_construida: 120, NumeroPisos: 5, Habitaciones: 4, Baños: 3, Cocina: 3, Garaje: 2, Patio: 1, Estudio: 2, Contacto: 4322334433, codigoc: 2, Descripcion: asdfigjuahfgirhudfgihujdgipvahs'),
(30, 'ACTUALIZACION', 'tblinmueble', 44, '85', '2024-06-15 10:32:03', 'Titulo: apartamento, Estado: Disponible, Ubicacion: , Precio: 12000000000, Localidad: bosa, Dirección: cra 56 i n 88 h 24, Estrato: 3, Area_construida: 120, NumeroPisos: 5, Habitaciones: 4, Baños: 3, Cocina: 3, Garaje: 2, Patio: 1, Estudio: 2, Contacto: 4322334433, codigoc: 2, Descripcion: asdfigjuahfgirhudfgihujdgipvahs', 'Titulo: apartamento, Estado: Disponible, Ubicacion: ubicacion/ubicacion_666db3f330266_1718465523.png, Precio: 12000000000, Localidad: bosa, Dirección: cra 56 i n 88 h 24, Estrato: 3, Area_construida: 120, NumeroPisos: 5, Habitaciones: 4, Baños: 3, Cocina: 3, Garaje: 2, Patio: 1, Estudio: 2, Contacto: 4322334433, codigoc: 2, Descripcion: asdfigjuahfgirhudfgihujdgipvahs'),
(31, 'ELIMINACION', 'tblinmueble', 44, '85', '2024-06-15 10:45:03', 'Titulo: apartamento, Estado: Disponible, Ubicacion: ubicacion/ubicacion_666db3f330266_1718465523.png, Precio: 12000000000, Localidad: bosa, Dirección: cra 56 i n 88 h 24, Estrato: 3, Area_construida: 120, NumeroPisos: 5, Habitaciones: 4, Baños: 3, Cocina: 3, Garaje: 2, Patio: 1, Estudio: 2, Contacto: 4322334433, codigoc: 2, Descripcion: asdfigjuahfgirhudfgihujdgipvahs', NULL),
(32, 'ACTUALIZACION', 'tblinmueble', 1, '85', '2024-06-15 10:53:32', 'Titulo: Casa en venta, Estado: Disponible, Ubicacion: ubicacion/ubicacion_66567c1bd2be6_1716943899.png, Precio: 160000000, Localidad: bosa, Dirección: cra18num13, Estrato: 4, Area_construida: 120, NumeroPisos: 2, Habitaciones: 4, Baños: 4, Cocina: 1, Garaje: 5, Patio: 1, Estudio: 5, Contacto: 32245575671, codigoc: 1, Descripcion: cam,vinga vkjmxc hn nikvcnmvjndsioncfisdiucbu9fdnou cbicxnvji sanm  zmvkondmivn smcdsnmodm9udsjfipjf psh´gñn mhgkphjmkomvjodsmcfkp ijbnm pam xvihjnldk g8uyhj iokdvnguom', 'Titulo: Casa en venta, Estado: En proceso de adquisición, Ubicacion: ubicacion/ubicacion_66567c1bd2be6_1716943899.png, Precio: 160000000, Localidad: bosa, Dirección: cra18num13, Estrato: 4, Area_construida: 120, NumeroPisos: 2, Habitaciones: 4, Baños: 4, Cocina: 1, Garaje: 5, Patio: 1, Estudio: 5, Contacto: 32245575671, codigoc: 1, Descripcion: cam,vinga vkjmxc hn nikvcnmvjndsioncfisdiucbu9fdnou cbicxnvji sanm  zmvkondmivn smcdsnmodm9udsjfipjf psh´gñn mhgkphjmkomvjodsmcfkp ijbnm pam xvihjnldk g8'),
(33, 'Actualizacion', 'tblcita', 5, '85', '2024-06-15 12:43:59', 'IdUsuario: 42; Nombre_usuario: thdhdthdfh; Nombre_asesor: Ana Rodriguez; Dirección: dsfgdfshsfghbsf; Fecha: 2024-04-17; Hora: 11:45:00; Telefono: 456464564; codigoc: 2; infoinmueble: 3; Precio_final: 1800000', 'IdUsuario: 42; Nombre_usuario: Karol Nathalia; Nombre_asesor: Ana Rodriguez; Dirección: dsfgdfshsfghbsf; Fecha: 2024-04-17; Hora: 11:45:00; Telefono: 456464564; codigoc: 2; infoinmueble: 3; Precio_final: 1800000'),
(34, 'Eliminacion', 'tblcita', 5, '85', '2024-06-15 12:45:42', 'IdUsuario: 42; Nombre_usuario: Karol Nathalia; Nombre_asesor: Ana Rodriguez; Dirección: dsfgdfshsfghbsf; Fecha: 2024-04-17; Hora: 11:45:00; Telefono: 456464564; codigoc: 2; infoinmueble: 3; Precio_final: 1800000', NULL),
(35, 'Insercion', 'tblusuarios', 90, '85', '2024-06-15 12:49:23', NULL, 'Nombres: UserEjemplo; Correo: alzateandres799@gmail.com; Contraseña: a5263aa568bdf6bcaeb38be13d9fcd3b; Rol: usuario'),
(36, 'Insercion', 'tblcita', 7, '85', '2024-06-15 12:52:39', NULL, 'IdUsuario: 90; Nombre_usuario: Karol Nathalia; Nombre_asesor: luiz lopez; Dirección: cra 67 u 78 67; Fecha: 2024-06-25; Hora: 17:52:00; Telefono: 4563234567; codigoc: 1; infoinmueble: 21; Precio_final: 180000000'),
(37, 'Actualizacion', 'tblcita', 7, '85', '2024-06-15 12:53:09', 'IdUsuario: 90; Nombre_usuario: Karol Nathalia; Nombre_asesor: luiz lopez; Dirección: cra 67 u 78 67; Fecha: 2024-06-25; Hora: 17:52:00; Telefono: 4563234567; codigoc: 1; infoinmueble: 21; Precio_final: 180000000', 'IdUsuario: 90; Nombre_usuario: UserEjemplo; Nombre_asesor: luiz lopez; Dirección: cra 67 u 78 67; Fecha: 2024-06-25; Hora: 17:52:00; Telefono: 4563234567; codigoc: 1; infoinmueble: 21; Precio_final: 180000000'),
(38, 'ELIMINACION', 'tblinmueble', 1, '85', '2024-06-16 10:52:14', 'Titulo: Casa en venta, Estado: En proceso de adquisición, Ubicacion: ubicacion/ubicacion_66567c1bd2be6_1716943899.png, Precio: 160000000, Localidad: bosa, Dirección: cra18num13, Estrato: 4, Area_construida: 120, NumeroPisos: 2, Habitaciones: 4, Baños: 4, Cocina: 1, Garaje: 5, Patio: 1, Estudio: 5, Contacto: 32245575671, codigoc: 1, Descripcion: cam,vinga vkjmxc hn nikvcnmvjndsioncfisdiucbu9fdnou cbicxnvji sanm  zmvkondmivn smcdsnmodm9udsjfipjf psh´gñn mhgkphjmkomvjodsmcfkp ijbnm pam xvihjnldk g8', NULL),
(39, 'ELIMINACION', 'tblinmueble', 2, '85', '2024-06-16 10:52:14', 'Titulo: Casa en Venta, Estado: Disponible, Ubicacion: ubicacion/ubicacion_66567c9e8f4aa_1716944030.png, Precio: 150000000, Localidad: soacha, Dirección: cra18num, Estrato: 4, Area_construida: 1000, NumeroPisos: 5, Habitaciones: 4, Baños: 1, Cocina: 2, Garaje: 1, Patio: 1, Estudio: 1, Contacto: 32228978, codigoc: 1, Descripcion: ronal wrvha8 h4yuerhfa4iuw gweuar bfuobwuyw4ef8yierh  gbfjkfklszxniuwenduiovnosgnirons r jnbsdfkb 9uaeisrbn ewg eduhbf uoernf ond oewdjnvjols nsdf 9uew hehuvl y8ld hnrdhf', NULL),
(40, 'ELIMINACION', 'tblinmueble', 3, '85', '2024-06-16 10:52:14', 'Titulo: Casa en Venta, Estado: En proceso de adquisición, Ubicacion: ubicacion/ubicacion_66567cc8c5ddf_1716944072.png, Precio: 350000000, Localidad: novena, Dirección: recreo, Estrato: 5, Area_construida: 120, NumeroPisos: 2, Habitaciones: 2, Baños: 5, Cocina: 2, Garaje: 1, Patio: 1, Estudio: 1, Contacto: 3053483532, codigoc: 1, Descripcion: vinicius vkjmxc hn nikvcnmvjndsioncfisdiucbu9fdnou cbicxnvji sanm zmvkondmivn smcdsnmodm9udsjfipjf psh´gñn mhgkphjmkomvjodsmcfkp ijbnm pam xvihjnldk g8uyhj ', NULL),
(41, 'ELIMINACION', 'tblinmueble', 4, '85', '2024-06-16 10:52:14', 'Titulo: Casa en venta, Estado: Disponible, Ubicacion: ubicacion/ubicacion_66567cfad9eae_1716944122.png, Precio: 150000000, Localidad: usaquen, Dirección: cra18num13, Estrato: 5, Area_construida: 70, NumeroPisos: 3, Habitaciones: 3, Baños: 3, Cocina: 3, Garaje: 1, Patio: 1, Estudio: 1, Contacto: 3053483532, codigoc: 1, Descripcion: La casa en cuestión destaca por su perfecta combinación de elegancia clásica y comodidades contemporáneas. Estratégicamente ubicada, esta residencia ofrece cercanía a ', NULL),
(42, 'ELIMINACION', 'tblinmueble', 6, '85', '2024-06-16 10:52:15', 'Titulo: Apartamento en Venta, Estado: Disponible, Ubicacion: ubicacion/ubicacion_66567ff38c2ae_1716944883.png, Precio: 200000000, Localidad: bosa, Dirección: Cra 80 #60-15, Estrato: 3, Area_construida: 85, NumeroPisos: 1, Habitaciones: 3, Baños: 2, Cocina: 0, Garaje: 1, Patio: 1, Estudio: 1, Contacto: 3224242, codigoc: 2, Descripcion: Apartamento en excelente estado, bien ubicado.', NULL),
(43, 'ELIMINACION', 'tblinmueble', 7, '85', '2024-06-16 10:52:15', 'Titulo: Apartamento en Venta, Estado: Disponible, Ubicacion: ubicacion/ubicacion_66568021293cb_1716944929.png, Precio: 210000000, Localidad: bosa, Dirección: Calle 70 #78-22, Estrato: 3, Area_construida: 90, NumeroPisos: 1, Habitaciones: 2, Baños: 2, Cocina: 0, Garaje: 0, Patio: 1, Estudio: 1, Contacto: 23422535, codigoc: 2, Descripcion: Apartamento cómodo y luminoso, cerca a transporte público.', NULL),
(44, 'ELIMINACION', 'tblinmueble', 8, '85', '2024-06-16 10:52:15', 'Titulo: Apartamento en Venta, Estado: Disponible, Ubicacion: ubicacion/ubicacion_6656804a06044_1716944970.png, Precio: 220000000, Localidad: novena, Dirección: Transv 79 #65-30, Estrato: 6, Area_construida: 95, NumeroPisos: 16, Habitaciones: 0, Baños: 7, Cocina: 0, Garaje: 3, Patio: 0, Estudio: 5, Contacto: 568696858, codigoc: 2, Descripcion: Apartamento amplio con excelentes acabados y parqueadero.', NULL),
(45, 'ELIMINACION', 'tblinmueble', 9, '85', '2024-06-16 10:52:31', 'Titulo: Apartamento en Venta, Estado: Disponible, Ubicacion: ubicacion/ubicacion_665680cb9f3ad_1716945099.png, Precio: 230000000, Localidad: bosa, Dirección: Av. Cali #70-50, Estrato: 4, Area_construida: 100, NumeroPisos: 2, Habitaciones: 3, Baños: 3, Cocina: 0, Garaje: 2, Patio: 2, Estudio: 2, Contacto: 235345353254, codigoc: 2, Descripcion: Apartamento moderno con balcón y patio.', NULL),
(46, 'ELIMINACION', 'tblinmueble', 10, '85', '2024-06-16 10:52:31', 'Titulo: Apartamento en Venta, Estado: Disponible, Ubicacion: ubicacion/ubicacion_665680efc29b3_1716945135.png, Precio: 240000000, Localidad: bosa, Dirección: Cra 82 #68-12, Estrato: 4, Area_construida: 110, NumeroPisos: 3, Habitaciones: 3, Baños: 2, Cocina: 0, Garaje: 1, Patio: 2, Estudio: 3, Contacto: 3453234224, codigoc: 2, Descripcion: Hermoso apartamento en zona tranquila y segura.', NULL),
(47, 'ELIMINACION', 'tblinmueble', 11, '85', '2024-06-16 10:52:31', 'Titulo: Lote en Venta, Estado: Disponible, Ubicacion: ubicacion/ubicacion_66568c017d1db_1716947969.png, Precio: 250000000, Localidad: soacha, Dirección: Calle 13 #8-45, Estrato: 3, Area_construida: 120, NumeroPisos: 2, Habitaciones: 3, Baños: 2, Cocina: 0, Garaje: 4, Patio: 0, Estudio: 5, Contacto: 3453525353, codigoc: 3, Descripcion: Casa de dos pisos en buen estado, lista para habitar.', NULL),
(48, 'ELIMINACION', 'tblinmueble', 12, '85', '2024-06-16 10:52:31', 'Titulo: Lote en Venta, Estado: Disponible, Ubicacion: ubicacion/ubicacion_66569a37f1cc9_1716951607.png, Precio: 260000000, Localidad: soacha, Dirección: Carrera 10 #15-33, Estrato: 4, Area_construida: 130, NumeroPisos: 2, Habitaciones: 4, Baños: 3, Cocina: 0, Garaje: 4, Patio: 0, Estudio: 6, Contacto: 45563453674, codigoc: 3, Descripcion: Amplia casa con patio y parqueadero, cerca a colegios.', NULL),
(49, 'ELIMINACION', 'tblinmueble', 13, '85', '2024-06-16 10:52:31', 'Titulo: Lote en Venta, Estado: Disponible, Ubicacion: ubicacion/ubicacion_66569a6d6d8f3_1716951661.png, Precio: 270000000, Localidad: soacha, Dirección: Av. Las Americas #20-10, Estrato: 4, Area_construida: 140, NumeroPisos: 3, Habitaciones: 5, Baños: 3, Cocina: 0, Garaje: 3, Patio: 2, Estudio: 7, Contacto: 346445646, codigoc: 3, Descripcion: Casa en conjunto cerrado con seguridad 24 horas.', NULL),
(50, 'ELIMINACION', 'tblinmueble', 14, '85', '2024-06-16 10:52:31', 'Titulo: Lote en Venta, Estado: Disponible, Ubicacion: ubicacion/ubicacion_66569c99405c9_1716952217.png, Precio: 280000000, Localidad: soacha, Dirección: Calle 20 #12-15, Estrato: 4, Area_construida: 150, NumeroPisos: 3, Habitaciones: 3, Baños: 2, Cocina: 0, Garaje: 4, Patio: 4, Estudio: 4, Contacto: 646454645646, codigoc: 3, Descripcion: Casa remodelada, lista para mudarse.', NULL),
(51, 'ELIMINACION', 'tblinmueble', 15, '85', '2024-06-16 10:52:31', 'Titulo: Lote en Venta, Estado: Disponible, Ubicacion: ubicacion/ubicacion_66569cc2a4fab_1716952258.png, Precio: 290000000, Localidad: soacha, Dirección: Cra 5 #18-9, Estrato: 5, Area_construida: 160, NumeroPisos: 3, Habitaciones: 4, Baños: 3, Cocina: 0, Garaje: 5, Patio: 4, Estudio: 8, Contacto: 564563363, codigoc: 3, Descripcion: Casa con excelentes acabados y amplio jardín.', NULL),
(52, 'ELIMINACION', 'tblinmueble', 16, '85', '2024-06-16 10:52:31', 'Titulo: Finca en Venta, Estado: Disponible, Ubicacion: ubicacion/ubicacion_66569d161c5a4_1716952342.png, Precio: 300000000, Localidad: novena, Dirección: Calle 45 #30-20, Estrato: 3, Area_construida: 80, NumeroPisos: 1, Habitaciones: 2, Baños: 1, Cocina: 0, Garaje: 3, Patio: 4, Estudio: 3, Contacto: 5465163645, codigoc: 4, Descripcion: Apartamento acogedor en excelente ubicación.', NULL),
(53, 'ELIMINACION', 'tblinmueble', 20, '85', '2024-06-16 10:52:45', 'Titulo: Finca en Venta, Estado: Disponible, Ubicacion: ubicacion/ubicacion_6656a1164f360_1716953366.png, Precio: 340000000, Localidad: novena, Dirección: Cra 44 #54-30, Estrato: 4, Area_construida: 100, NumeroPisos: 3, Habitaciones: 3, Baños: 2, Cocina: 0, Garaje: 6, Patio: 6, Estudio: 6, Contacto: 45674545678, codigoc: 4, Descripcion: Hermoso apartamento con excelente iluminación.', NULL),
(54, 'ELIMINACION', 'tblinmueble', 21, '85', '2024-06-16 10:52:45', 'Titulo: Bodega en Venta, Estado: Disponible, Ubicacion: ubicacion/ubicacion_6656a15d1e766_1716953437.png, Precio: 350000000, Localidad: usaquen, Dirección: Calle 123 #20-30, Estrato: 4, Area_construida: 110, NumeroPisos: 2, Habitaciones: 4, Baños: 3, Cocina: 0, Garaje: 0, Patio: 0, Estudio: 0, Contacto: 57453464436, codigoc: 5, Descripcion: Casa amplia y moderna en excelente ubicación.', NULL),
(55, 'ELIMINACION', 'tblinmueble', 22, '85', '2024-06-16 10:52:45', 'Titulo: Casa en Venta, Estado: Disponible, Ubicacion: ubicacion/ubicacion_6656a18f269d2_1716953487.png, Precio: 360000000, Localidad: usaquen, Dirección: Carrera 15 #127-45, Estrato: 4, Area_construida: 120, NumeroPisos: 2, Habitaciones: 5, Baños: 3, Cocina: 0, Garaje: 0, Patio: 0, Estudio: 0, Contacto: 5675744747, codigoc: 5, Descripcion: Hermosa casa con jardín y garaje doble.', NULL),
(56, 'ELIMINACION', 'tblinmueble', 23, '85', '2024-06-16 10:52:45', 'Titulo: Bodega en Venta, Estado: Disponible, Ubicacion: ubicacion/ubicacion_6656a39466f26_1716954004.png, Precio: 370000000, Localidad: usaquen, Dirección: Transv 21 #129-60, Estrato: 5, Area_construida: 130, NumeroPisos: 3, Habitaciones: 3, Baños: 2, Cocina: 0, Garaje: 0, Patio: 0, Estudio: 0, Contacto: 644636347436, codigoc: 5, Descripcion: Casa en conjunto cerrado con vigilancia.', NULL),
(57, 'ELIMINACION', 'tblinmueble', 24, '85', '2024-06-16 10:52:45', 'Titulo: Bodega en Venta, Estado: Disponible, Ubicacion: ubicacion/ubicacion_6656a3dacd8a5_1716954074.png, Precio: 380000000, Localidad: usaquen, Dirección: Av. 19 #130-25, Estrato: 5, Area_construida: 140, NumeroPisos: 3, Habitaciones: 4, Baños: 3, Cocina: 0, Garaje: 0, Patio: 0, Estudio: 0, Contacto: 495864984968395388349378563, codigoc: 5, Descripcion: Casa remodelada con amplios espacios.', NULL),
(58, 'ELIMINACION', 'tblinmueble', 25, '85', '2024-06-16 10:52:45', 'Titulo: Casa en Venta, Estado: Disponible, Ubicacion: ubicacion/ubicacion_6656a4053d7a2_1716954117.png, Precio: 390000000, Localidad: usaquen, Dirección: Cra 18 #132-10, Estrato: 5, Area_construida: 150, NumeroPisos: 3, Habitaciones: 5, Baños: 3, Cocina: 0, Garaje: 0, Patio: 0, Estudio: 0, Contacto: 765465464645, codigoc: 5, Descripcion: Casa de lujo en zona exclusiva.', NULL),
(59, 'ELIMINACION', 'tblinmueble', 17, '85', '2024-06-16 10:52:53', 'Titulo: Finca en Venta, Estado: Disponible, Ubicacion: ubicacion/ubicacion_66569d98914a5_1716952472.png, Precio: 310000000, Localidad: novena, Dirección: Carrera 40 #50-11, Estrato: 3, Area_construida: 85, NumeroPisos: 1, Habitaciones: 3, Baños: 2, Cocina: 0, Garaje: 5, Patio: 5, Estudio: 5, Contacto: 645465754, codigoc: 4, Descripcion: Luminoso apartamento con vista a la ciudad.', NULL),
(60, 'ELIMINACION', 'tblinmueble', 18, '85', '2024-06-16 10:52:53', 'Titulo: Finca en Venta, Estado: Disponible, Ubicacion: ubicacion/ubicacion_66569dd21f439_1716952530.png, Precio: 320000000, Localidad: novena, Dirección: Transv 41 #51-15, Estrato: 4, Area_construida: 90, NumeroPisos: 2, Habitaciones: 4, Baños: 2, Cocina: 0, Garaje: 0, Patio: 4, Estudio: 4, Contacto: 4576434634636, codigoc: 4, Descripcion: Apartamento espacioso y bien distribuido.', NULL),
(61, 'ELIMINACION', 'tblinmueble', 19, '85', '2024-06-16 10:52:53', 'Titulo: Finca en Venta, Estado: Disponible, Ubicacion: ubicacion/ubicacion_66569ea816d23_1716952744.png, Precio: 330000000, Localidad: novena, Dirección: Av. Caracas #43-20, Estrato: 4, Area_construida: 95, NumeroPisos: 2, Habitaciones: 3, Baños: 3, Cocina: 0, Garaje: 5, Patio: 5, Estudio: 5, Contacto: 67545454747, codigoc: 4, Descripcion: Apartamento moderno con acabados de lujo.', NULL),
(62, 'Insercion', 'tblusuarios', 91, '85', '2024-06-16 11:43:10', NULL, 'Nombres: server2; Correo: isagistriker69@gmail.com; Contraseña: 2586debc9d03ed65a24810a4b64e6feb; Rol: usuario'),
(63, 'Actualizacion', 'tblcita', 1, '85', '2024-06-16 12:51:18', 'IdUsuario: 42; Nombre_usuario: Andres Steven Alzate Castañeda; Nombre_asesor: Juan Perez; Dirección: Cra 88f n 56 26; Fecha: 2024-05-22; Hora: 10:30:00; Telefono: 3209586712; codigoc: 1; infoinmueble: 5; Precio_final: 1000000', 'IdUsuario: 42; Nombre_usuario: Andres Steven ; Nombre_asesor: Juan Perez; Dirección: Cra 88f n 56 26; Fecha: 2024-05-22; Hora: 10:30:00; Telefono: 3209586712; codigoc: 1; infoinmueble: 5; Precio_final: 1000000'),
(64, 'INSERCION', 'tblinmueble', 45, '85', '2024-06-16 12:59:16', NULL, 'Titulo: Cómodo Apartamento , Estado: Disponible, Ubicacion: , Precio: 280000000, Localidad: Engativá, Dirección: Carrera 70 #80-15, Estrato: 3, Area_construida: 85, NumeroPisos: 1, Habitaciones: 3, Baños: 2, Cocina: 1, Garaje: 1, Patio: 1, Estudio: 1, Contacto: 3222545454, codigoc: 2, Descripcion: Este apartamento en Engativá ofrece un ambiente cómodo y funcional. Con espacios bien distribuidos y acabados modernos, es ideal para parejas o familias pequeñas que buscan un lugar acogedor cerca de c'),
(65, 'ACTUALIZACION', 'tblinmueble', 45, '85', '2024-06-16 12:59:18', 'Titulo: Cómodo Apartamento , Estado: Disponible, Ubicacion: , Precio: 280000000, Localidad: Engativá, Dirección: Carrera 70 #80-15, Estrato: 3, Area_construida: 85, NumeroPisos: 1, Habitaciones: 3, Baños: 2, Cocina: 1, Garaje: 1, Patio: 1, Estudio: 1, Contacto: 3222545454, codigoc: 2, Descripcion: Este apartamento en Engativá ofrece un ambiente cómodo y funcional. Con espacios bien distribuidos y acabados modernos, es ideal para parejas o familias pequeñas que buscan un lugar acogedor cerca de c', 'Titulo: Cómodo Apartamento , Estado: Disponible, Ubicacion: ubicacion/ubicacion_666f27f638b9a_1718560758.png, Precio: 280000000, Localidad: Engativá, Dirección: Carrera 70 #80-15, Estrato: 3, Area_construida: 85, NumeroPisos: 1, Habitaciones: 3, Baños: 2, Cocina: 1, Garaje: 1, Patio: 1, Estudio: 1, Contacto: 3222545454, codigoc: 2, Descripcion: Este apartamento en Engativá ofrece un ambiente cómodo y funcional. Con espacios bien distribuidos y acabados modernos, es ideal para parejas o familias '),
(66, 'Eliminacion', 'tblusuarios', 4, '85', '2024-06-16 19:10:47', 'Nombres: yiyi kun; Correo: yiyiconsentida@gmail.com; Contraseña: 9d02702ad9978bdd3d5d6cf32771a58c; Rol: usuario', NULL),
(67, 'Eliminacion', 'tblusuarios', 91, '85', '2024-06-16 19:10:58', 'Nombres: server2; Correo: isagistriker69@gmail.com; Contraseña: 2586debc9d03ed65a24810a4b64e6feb; Rol: usuario', NULL),
(68, 'INSERCION', 'tblinmueble', 46, '85', '2024-06-16 19:19:28', NULL, 'Titulo: Espaciosa Casa , Estado: Disponible, Ubicacion: , Precio: 320000000, Localidad: Bosa, Dirección: Carrera 80 #25-45, Estrato: 4, Area_construida: 180 , NumeroPisos: 2, Habitaciones: 4, Baños: 3, Cocina: 1, Garaje: 1, Patio: 1, Estudio: 1, Contacto: 3259415259, codigoc: 1, Descripcion: Esta amplia casa en Bosa Occidental ofrece un diseño cómodo y funcional. Con espacios bien distribuidos y acabados de calidad, es ideal para familias que buscan confort y tranquilidad. La ubicación cercana a'),
(69, 'ACTUALIZACION', 'tblinmueble', 46, '85', '2024-06-16 19:19:28', 'Titulo: Espaciosa Casa , Estado: Disponible, Ubicacion: , Precio: 320000000, Localidad: Bosa, Dirección: Carrera 80 #25-45, Estrato: 4, Area_construida: 180 , NumeroPisos: 2, Habitaciones: 4, Baños: 3, Cocina: 1, Garaje: 1, Patio: 1, Estudio: 1, Contacto: 3259415259, codigoc: 1, Descripcion: Esta amplia casa en Bosa Occidental ofrece un diseño cómodo y funcional. Con espacios bien distribuidos y acabados de calidad, es ideal para familias que buscan confort y tranquilidad. La ubicación cercana a', 'Titulo: Espaciosa Casa , Estado: Disponible, Ubicacion: ubicacion/ubicacion_666f8110c94af_1718583568.png, Precio: 320000000, Localidad: Bosa, Dirección: Carrera 80 #25-45, Estrato: 4, Area_construida: 180 , NumeroPisos: 2, Habitaciones: 4, Baños: 3, Cocina: 1, Garaje: 1, Patio: 1, Estudio: 1, Contacto: 3259415259, codigoc: 1, Descripcion: Esta amplia casa en Bosa Occidental ofrece un diseño cómodo y funcional. Con espacios bien distribuidos y acabados de calidad, es ideal para familias que busca'),
(70, 'ACTUALIZACION', 'tblinmueble', 46, '85', '2024-06-16 19:20:02', 'Titulo: Espaciosa Casa , Estado: Disponible, Ubicacion: ubicacion/ubicacion_666f8110c94af_1718583568.png, Precio: 320000000, Localidad: Bosa, Dirección: Carrera 80 #25-45, Estrato: 4, Area_construida: 180 , NumeroPisos: 2, Habitaciones: 4, Baños: 3, Cocina: 1, Garaje: 1, Patio: 1, Estudio: 1, Contacto: 3259415259, codigoc: 1, Descripcion: Esta amplia casa en Bosa Occidental ofrece un diseño cómodo y funcional. Con espacios bien distribuidos y acabados de calidad, es ideal para familias que busca', 'Titulo: Espaciosa Casa , Estado: Disponible, Ubicacion: ubicacion/ubicacion_666f8110c94af_1718583568.png, Precio: 320000000, Localidad: Bosa, Dirección: Carrera 80 #25-45, Estrato: 4, Area_construida: 180 , NumeroPisos: 2, Habitaciones: 4, Baños: 3, Cocina: 1, Garaje: 1, Patio: 1, Estudio: 1, Contacto: 3259415259, codigoc: 1, Descripcion: Esta amplia casa en Bosa Occidental ofrece un diseño cómodo y funcional. Con espacios bien distribuidos y acabados de calidad, es ideal para familias que busca'),
(71, 'INSERCION', 'tblinmueble', 47, '85', '2024-06-16 19:24:46', NULL, 'Titulo: Amplia Casa , Estado: Disponible, Ubicacion: , Precio: 450000000, Localidad: Los Mártires, Dirección: Carrera 13 #24-36, Estrato: 4, Area_construida: 180, NumeroPisos: 2, Habitaciones: 5, Baños: 4, Cocina: 1, Garaje: 1, Patio: 1, Estudio: 0, Contacto: 3262929626, codigoc: 1, Descripcion: Esta espaciosa casa ubicada en el barrio Los Mártires ofrece confort y elegancia. Con una distribución perfecta para familias grandes, cuenta con amplias habitaciones y áreas sociales ideales para compar'),
(72, 'ACTUALIZACION', 'tblinmueble', 47, '85', '2024-06-16 19:24:47', 'Titulo: Amplia Casa , Estado: Disponible, Ubicacion: , Precio: 450000000, Localidad: Los Mártires, Dirección: Carrera 13 #24-36, Estrato: 4, Area_construida: 180, NumeroPisos: 2, Habitaciones: 5, Baños: 4, Cocina: 1, Garaje: 1, Patio: 1, Estudio: 0, Contacto: 3262929626, codigoc: 1, Descripcion: Esta espaciosa casa ubicada en el barrio Los Mártires ofrece confort y elegancia. Con una distribución perfecta para familias grandes, cuenta con amplias habitaciones y áreas sociales ideales para compar', 'Titulo: Amplia Casa , Estado: Disponible, Ubicacion: ubicacion/ubicacion_666f824f80039_1718583887.png, Precio: 450000000, Localidad: Los Mártires, Dirección: Carrera 13 #24-36, Estrato: 4, Area_construida: 180, NumeroPisos: 2, Habitaciones: 5, Baños: 4, Cocina: 1, Garaje: 1, Patio: 1, Estudio: 0, Contacto: 3262929626, codigoc: 1, Descripcion: Esta espaciosa casa ubicada en el barrio Los Mártires ofrece confort y elegancia. Con una distribución perfecta para familias grandes, cuenta con amplias h'),
(73, 'Insercion', 'solicitudes', 30, '85', '2024-06-16 19:25:22', NULL, 'Nombre: kacho kiun kiun; Telefono: 3225554856; Correo: juancho14@gmail.com; idInmuebleInteres: 47'),
(74, 'INSERCION', 'tblinmueble', 48, '85', '2024-06-16 19:29:28', NULL, 'Titulo: Hermosa Casa , Estado: En proceso de adquisición, Ubicacion: , Precio: 300000000, Localidad: San Cristóbal, Dirección: Calle 123 #456, Estrato: 4, Area_construida: 150, NumeroPisos: 2, Habitaciones: 4, Baños: 3, Cocina: 1, Garaje: 1, Patio: 1, Estudio: 1, Contacto: 3545252525, codigoc: 1, Descripcion: Esta encantadora casa en San Cristóbal cuenta con espacios amplios y luminosos, perfectos para disfrutar en familia. Con acabados modernos y una ubicación privilegiada, ofrece tranquilidad '),
(75, 'ACTUALIZACION', 'tblinmueble', 48, '85', '2024-06-16 19:29:29', 'Titulo: Hermosa Casa , Estado: En proceso de adquisición, Ubicacion: , Precio: 300000000, Localidad: San Cristóbal, Dirección: Calle 123 #456, Estrato: 4, Area_construida: 150, NumeroPisos: 2, Habitaciones: 4, Baños: 3, Cocina: 1, Garaje: 1, Patio: 1, Estudio: 1, Contacto: 3545252525, codigoc: 1, Descripcion: Esta encantadora casa en San Cristóbal cuenta con espacios amplios y luminosos, perfectos para disfrutar en familia. Con acabados modernos y una ubicación privilegiada, ofrece tranquilidad ', 'Titulo: Hermosa Casa , Estado: En proceso de adquisición, Ubicacion: ubicacion/ubicacion_666f836932306_1718584169.png, Precio: 300000000, Localidad: San Cristóbal, Dirección: Calle 123 #456, Estrato: 4, Area_construida: 150, NumeroPisos: 2, Habitaciones: 4, Baños: 3, Cocina: 1, Garaje: 1, Patio: 1, Estudio: 1, Contacto: 3545252525, codigoc: 1, Descripcion: Esta encantadora casa en San Cristóbal cuenta con espacios amplios y luminosos, perfectos para disfrutar en familia. Con acabados modernos y '),
(76, 'INSERCION', 'tblinmueble', 49, '85', '2024-06-16 19:33:28', NULL, 'Titulo: Apartamento Moderno , Estado: No disponible, Ubicacion: , Precio: 250000000, Localidad: Modelia, Dirección: Carrera 50 #80-30, Estrato: 3, Area_construida: 100, NumeroPisos: 1, Habitaciones: 3, Baños: 2, Cocina: 1, Garaje: 0, Patio: 0, Estudio: 1, Contacto: 3565959595, codigoc: 2, Descripcion: Este encantador apartamento en Modelia ofrece un diseño moderno y funcional, ideal para personas que buscan comodidad y accesibilidad. Con espacios bien distribuidos y acabados de calidad, este inm'),
(77, 'ACTUALIZACION', 'tblinmueble', 49, '85', '2024-06-16 19:33:29', 'Titulo: Apartamento Moderno , Estado: No disponible, Ubicacion: , Precio: 250000000, Localidad: Modelia, Dirección: Carrera 50 #80-30, Estrato: 3, Area_construida: 100, NumeroPisos: 1, Habitaciones: 3, Baños: 2, Cocina: 1, Garaje: 0, Patio: 0, Estudio: 1, Contacto: 3565959595, codigoc: 2, Descripcion: Este encantador apartamento en Modelia ofrece un diseño moderno y funcional, ideal para personas que buscan comodidad y accesibilidad. Con espacios bien distribuidos y acabados de calidad, este inm', 'Titulo: Apartamento Moderno , Estado: No disponible, Ubicacion: ubicacion/ubicacion_666f845942cf8_1718584409.png, Precio: 250000000, Localidad: Modelia, Dirección: Carrera 50 #80-30, Estrato: 3, Area_construida: 100, NumeroPisos: 1, Habitaciones: 3, Baños: 2, Cocina: 1, Garaje: 0, Patio: 0, Estudio: 1, Contacto: 3565959595, codigoc: 2, Descripcion: Este encantador apartamento en Modelia ofrece un diseño moderno y funcional, ideal para personas que buscan comodidad y accesibilidad. Con espacios b'),
(78, 'INSERCION', 'tblinmueble', 50, '85', '2024-06-16 19:41:16', NULL, 'Titulo: Ciudad Bolívar, Estado: Disponible, Ubicacion: , Precio: 150000000, Localidad: Ciudad Bolívar, Dirección: Calle 90 Sur #22-10, Estrato: 2, Area_construida: 75, NumeroPisos: 1, Habitaciones: 3, Baños: 2, Cocina: 1, Garaje: 0, Patio: 0, Estudio: 1, Contacto: 3056592652, codigoc: 2, Descripcion: Este apartamento en Ciudad Bolívar combina modernidad y funcionalidad. Con una distribución eficiente y acabados contemporáneos, es ideal para parejas o personas solteras que buscan comodidad y acce'),
(79, 'ACTUALIZACION', 'tblinmueble', 50, '85', '2024-06-16 19:41:16', 'Titulo: Ciudad Bolívar, Estado: Disponible, Ubicacion: , Precio: 150000000, Localidad: Ciudad Bolívar, Dirección: Calle 90 Sur #22-10, Estrato: 2, Area_construida: 75, NumeroPisos: 1, Habitaciones: 3, Baños: 2, Cocina: 1, Garaje: 0, Patio: 0, Estudio: 1, Contacto: 3056592652, codigoc: 2, Descripcion: Este apartamento en Ciudad Bolívar combina modernidad y funcionalidad. Con una distribución eficiente y acabados contemporáneos, es ideal para parejas o personas solteras que buscan comodidad y acce', 'Titulo: Ciudad Bolívar, Estado: Disponible, Ubicacion: ubicacion/ubicacion_666f862cdc03f_1718584876.png, Precio: 150000000, Localidad: Ciudad Bolívar, Dirección: Calle 90 Sur #22-10, Estrato: 2, Area_construida: 75, NumeroPisos: 1, Habitaciones: 3, Baños: 2, Cocina: 1, Garaje: 0, Patio: 0, Estudio: 1, Contacto: 3056592652, codigoc: 2, Descripcion: Este apartamento en Ciudad Bolívar combina modernidad y funcionalidad. Con una distribución eficiente y acabados contemporáneos, es ideal para parejas'),
(80, 'INSERCION', 'tblinmueble', 51, '85', '2024-06-16 20:04:09', NULL, 'Titulo: Amplia Casa , Estado: Disponible, Ubicacion: , Precio: 550000000, Localidad: Suba, Dirección: Calle 139 #120-45, Estrato: 4, Area_construida: 250, NumeroPisos: 2, Habitaciones: 5, Baños: 4, Cocina: 1, Garaje: 1, Patio: 1, Estudio: 1, Contacto: 3225465656, codigoc: 1, Descripcion: Esta espaciosa casa en Suba es ideal para familias que buscan un lugar amplio y cómodo. Con cinco habitaciones y cuatro baños, ofrece suficiente espacio para todos los miembros de la familia. La casa cuenta con '),
(81, 'ACTUALIZACION', 'tblinmueble', 51, '85', '2024-06-16 20:04:44', 'Titulo: Amplia Casa , Estado: Disponible, Ubicacion: , Precio: 550000000, Localidad: Suba, Dirección: Calle 139 #120-45, Estrato: 4, Area_construida: 250, NumeroPisos: 2, Habitaciones: 5, Baños: 4, Cocina: 1, Garaje: 1, Patio: 1, Estudio: 1, Contacto: 3225465656, codigoc: 1, Descripcion: Esta espaciosa casa en Suba es ideal para familias que buscan un lugar amplio y cómodo. Con cinco habitaciones y cuatro baños, ofrece suficiente espacio para todos los miembros de la familia. La casa cuenta con ', 'Titulo: Amplia Casa , Estado: Disponible, Ubicacion: , Precio: 550000000, Localidad: Suba, Dirección: Calle 139 #120-45, Estrato: 4, Area_construida: 250, NumeroPisos: 2, Habitaciones: 5, Baños: 4, Cocina: 1, Garaje: 1, Patio: 1, Estudio: 1, Contacto: 3225465656, codigoc: 1, Descripcion: Esta espaciosa casa en Suba es ideal para familias que buscan un lugar amplio y cómodo. Con cinco habitaciones y cuatro baños, ofrece suficiente espacio para todos los miembros de la familia. La casa cuenta con '),
(82, 'ACTUALIZACION', 'tblinmueble', 51, '85', '2024-06-16 20:04:44', 'Titulo: Amplia Casa , Estado: Disponible, Ubicacion: , Precio: 550000000, Localidad: Suba, Dirección: Calle 139 #120-45, Estrato: 4, Area_construida: 250, NumeroPisos: 2, Habitaciones: 5, Baños: 4, Cocina: 1, Garaje: 1, Patio: 1, Estudio: 1, Contacto: 3225465656, codigoc: 1, Descripcion: Esta espaciosa casa en Suba es ideal para familias que buscan un lugar amplio y cómodo. Con cinco habitaciones y cuatro baños, ofrece suficiente espacio para todos los miembros de la familia. La casa cuenta con ', 'Titulo: Amplia Casa , Estado: Disponible, Ubicacion: ubicacion/ubicacion_666f8baca49cc_1718586284.png, Precio: 550000000, Localidad: Suba, Dirección: Calle 139 #120-45, Estrato: 4, Area_construida: 250, NumeroPisos: 2, Habitaciones: 5, Baños: 4, Cocina: 1, Garaje: 1, Patio: 1, Estudio: 1, Contacto: 3225465656, codigoc: 1, Descripcion: Esta espaciosa casa en Suba es ideal para familias que buscan un lugar amplio y cómodo. Con cinco habitaciones y cuatro baños, ofrece suficiente espacio para todos'),
(83, 'INSERCION', 'tblinmueble', 52, '85', '2024-06-16 20:08:39', NULL, 'Titulo: Casa Moderna, Estado: Disponible, Ubicacion: , Precio: 320000000, Localidad: Rafael Uribe Ur, Dirección: Carrera 13A #45-30, Estrato: 3, Area_construida: 120, NumeroPisos: 2, Habitaciones: 4, Baños: 3, Cocina: 1, Garaje: 1, Patio: 1, Estudio: 1, Contacto: 3056486565, codigoc: 1, Descripcion: Esta casa moderna en Rafael Uribe Uribe ofrece un ambiente cómodo y funcional, ideal para familias que buscan un espacio acogedor. Con cuatro habitaciones y tres baños, esta propiedad brinda la comod'),
(84, 'ACTUALIZACION', 'tblinmueble', 52, '85', '2024-06-16 20:08:42', 'Titulo: Casa Moderna, Estado: Disponible, Ubicacion: , Precio: 320000000, Localidad: Rafael Uribe Ur, Dirección: Carrera 13A #45-30, Estrato: 3, Area_construida: 120, NumeroPisos: 2, Habitaciones: 4, Baños: 3, Cocina: 1, Garaje: 1, Patio: 1, Estudio: 1, Contacto: 3056486565, codigoc: 1, Descripcion: Esta casa moderna en Rafael Uribe Uribe ofrece un ambiente cómodo y funcional, ideal para familias que buscan un espacio acogedor. Con cuatro habitaciones y tres baños, esta propiedad brinda la comod', 'Titulo: Casa Moderna, Estado: Disponible, Ubicacion: ubicacion/ubicacion_666f8c9a11b00_1718586522.png, Precio: 320000000, Localidad: Rafael Uribe Ur, Dirección: Carrera 13A #45-30, Estrato: 3, Area_construida: 120, NumeroPisos: 2, Habitaciones: 4, Baños: 3, Cocina: 1, Garaje: 1, Patio: 1, Estudio: 1, Contacto: 3056486565, codigoc: 1, Descripcion: Esta casa moderna en Rafael Uribe Uribe ofrece un ambiente cómodo y funcional, ideal para familias que buscan un espacio acogedor. Con cuatro habitacio'),
(85, 'ACTUALIZACION', 'tblinmueble', 52, '85', '2024-06-16 20:09:22', 'Titulo: Casa Moderna, Estado: Disponible, Ubicacion: ubicacion/ubicacion_666f8c9a11b00_1718586522.png, Precio: 320000000, Localidad: Rafael Uribe Ur, Dirección: Carrera 13A #45-30, Estrato: 3, Area_construida: 120, NumeroPisos: 2, Habitaciones: 4, Baños: 3, Cocina: 1, Garaje: 1, Patio: 1, Estudio: 1, Contacto: 3056486565, codigoc: 1, Descripcion: Esta casa moderna en Rafael Uribe Uribe ofrece un ambiente cómodo y funcional, ideal para familias que buscan un espacio acogedor. Con cuatro habitacio', 'Titulo: Casa Moderna, Estado: Disponible, Ubicacion: ubicacion/ubicacion_666f8c9a11b00_1718586522.png, Precio: 320000000, Localidad: Rafael Uribe , Dirección: Carrera 13A #45-30, Estrato: 3, Area_construida: 120, NumeroPisos: 2, Habitaciones: 4, Baños: 3, Cocina: 1, Garaje: 1, Patio: 1, Estudio: 1, Contacto: 3056486565, codigoc: 1, Descripcion: Esta casa moderna en Rafael Uribe Uribe ofrece un ambiente cómodo y funcional, ideal para familias que buscan un espacio acogedor. Con cuatro habitacione'),
(86, 'INSERCION', 'tblinmueble', 53, '85', '2024-06-16 20:13:27', NULL, 'Titulo: Confortable Apartaestudio, Estado: Disponible, Ubicacion: , Precio: 135000000, Localidad: Kennedy, Dirección: Avenida Primero de Mayo #34-56, Estrato: 3, Area_construida: 45, NumeroPisos: 1, Habitaciones: 1, Baños: 1, Cocina: 1, Garaje: 0, Patio: 0, Estudio: 1, Contacto: 3056465565, codigoc: 2, Descripcion: Este apartaestudio en Kennedy combina comodidad y funcionalidad en un espacio compacto. Con un diseño moderno y eficiente, es perfecto para solteros o parejas que buscan una vivienda '),
(87, 'ACTUALIZACION', 'tblinmueble', 53, '85', '2024-06-16 20:13:27', 'Titulo: Confortable Apartaestudio, Estado: Disponible, Ubicacion: , Precio: 135000000, Localidad: Kennedy, Dirección: Avenida Primero de Mayo #34-56, Estrato: 3, Area_construida: 45, NumeroPisos: 1, Habitaciones: 1, Baños: 1, Cocina: 1, Garaje: 0, Patio: 0, Estudio: 1, Contacto: 3056465565, codigoc: 2, Descripcion: Este apartaestudio en Kennedy combina comodidad y funcionalidad en un espacio compacto. Con un diseño moderno y eficiente, es perfecto para solteros o parejas que buscan una vivienda ', 'Titulo: Confortable Apartaestudio, Estado: Disponible, Ubicacion: ubicacion/ubicacion_666f8db7e8919_1718586807.png, Precio: 135000000, Localidad: Kennedy, Dirección: Avenida Primero de Mayo #34-56, Estrato: 3, Area_construida: 45, NumeroPisos: 1, Habitaciones: 1, Baños: 1, Cocina: 1, Garaje: 0, Patio: 0, Estudio: 1, Contacto: 3056465565, codigoc: 2, Descripcion: Este apartaestudio en Kennedy combina comodidad y funcionalidad en un espacio compacto. Con un diseño moderno y eficiente, es perfecto '),
(88, 'ACTUALIZACION', 'tblinmueble', 53, '85', '2024-06-16 20:18:42', 'Titulo: Confortable Apartaestudio, Estado: Disponible, Ubicacion: ubicacion/ubicacion_666f8db7e8919_1718586807.png, Precio: 135000000, Localidad: Kennedy, Dirección: Avenida Primero de Mayo #34-56, Estrato: 3, Area_construida: 45, NumeroPisos: 1, Habitaciones: 1, Baños: 1, Cocina: 1, Garaje: 0, Patio: 0, Estudio: 1, Contacto: 3056465565, codigoc: 2, Descripcion: Este apartaestudio en Kennedy combina comodidad y funcionalidad en un espacio compacto. Con un diseño moderno y eficiente, es perfecto ', 'Titulo: Confortable Apartaestudio, Estado: Disponible, Ubicacion: ubicacion/ubicacion_666f8db7e8919_1718586807.png, Precio: 135000000, Localidad: Kennedy, Dirección: Avenida Primero de Mayo #34-56, Estrato: 3, Area_construida: 45, NumeroPisos: 1, Habitaciones: 1, Baños: 1, Cocina: 1, Garaje: 0, Patio: 0, Estudio: 1, Contacto: 3056465565, codigoc: 6, Descripcion: Este apartaestudio en Kennedy combina comodidad y funcionalidad en un espacio compacto. Con un diseño moderno y eficiente, es perfecto '),
(89, 'INSERCION', 'tblinmueble', 54, '85', '2024-06-16 20:26:49', NULL, 'Titulo: Elegante Apartaestudio , Estado: Disponible, Ubicacion: , Precio: 270000000, Localidad: Teusaquillo, Dirección: Carrera 24 #45-70, Estrato: 4, Area_construida: 60, NumeroPisos: 1, Habitaciones: 1, Baños: 1, Cocina: 1, Garaje: 0, Patio: 0, Estudio: 1, Contacto: 3225465659, codigoc: 6, Descripcion: Este elegante apartaestudio en Teusaquillo es ideal para quienes buscan un espacio moderno y bien ubicado. Con un diseño eficiente, cuenta con una habitación cómoda, un baño, y una cocina equipa'),
(90, 'ACTUALIZACION', 'tblinmueble', 54, '85', '2024-06-16 20:26:50', 'Titulo: Elegante Apartaestudio , Estado: Disponible, Ubicacion: , Precio: 270000000, Localidad: Teusaquillo, Dirección: Carrera 24 #45-70, Estrato: 4, Area_construida: 60, NumeroPisos: 1, Habitaciones: 1, Baños: 1, Cocina: 1, Garaje: 0, Patio: 0, Estudio: 1, Contacto: 3225465659, codigoc: 6, Descripcion: Este elegante apartaestudio en Teusaquillo es ideal para quienes buscan un espacio moderno y bien ubicado. Con un diseño eficiente, cuenta con una habitación cómoda, un baño, y una cocina equipa', 'Titulo: Elegante Apartaestudio , Estado: Disponible, Ubicacion: ubicacion/ubicacion_666f90da4b3ae_1718587610.png, Precio: 270000000, Localidad: Teusaquillo, Dirección: Carrera 24 #45-70, Estrato: 4, Area_construida: 60, NumeroPisos: 1, Habitaciones: 1, Baños: 1, Cocina: 1, Garaje: 0, Patio: 0, Estudio: 1, Contacto: 3225465659, codigoc: 6, Descripcion: Este elegante apartaestudio en Teusaquillo es ideal para quienes buscan un espacio moderno y bien ubicado. Con un diseño eficiente, cuenta con una'),
(91, 'INSERCION', 'tblinmueble', 55, '85', '2024-06-16 20:31:27', NULL, 'Titulo: Encantador Apartaestudio, Estado: Disponible, Ubicacion: , Precio: 320000000, Localidad: La Candelaria, Dirección: Calle 10 #3-15, Estrato: 3, Area_construida: 55, NumeroPisos: 1, Habitaciones: 1, Baños: 1, Cocina: 1, Garaje: 0, Patio: 1, Estudio: 1, Contacto: 3162549656, codigoc: 6, Descripcion: Ubicado en el corazón histórico de Bogotá, este apartaestudio en La Candelaria combina encanto y funcionalidad. Su diseño acogedor y moderno, junto con un patio interno y acabados de calidad, lo');
INSERT INTO `auditoria` (`id`, `accion`, `tabla_afectada`, `id_registro_afectado`, `usuario`, `fecha_hora`, `datos_antiguos`, `datos_nuevos`) VALUES
(92, 'ACTUALIZACION', 'tblinmueble', 55, '85', '2024-06-16 20:31:28', 'Titulo: Encantador Apartaestudio, Estado: Disponible, Ubicacion: , Precio: 320000000, Localidad: La Candelaria, Dirección: Calle 10 #3-15, Estrato: 3, Area_construida: 55, NumeroPisos: 1, Habitaciones: 1, Baños: 1, Cocina: 1, Garaje: 0, Patio: 1, Estudio: 1, Contacto: 3162549656, codigoc: 6, Descripcion: Ubicado en el corazón histórico de Bogotá, este apartaestudio en La Candelaria combina encanto y funcionalidad. Su diseño acogedor y moderno, junto con un patio interno y acabados de calidad, lo', 'Titulo: Encantador Apartaestudio, Estado: Disponible, Ubicacion: ubicacion/ubicacion_666f91f0741c2_1718587888.png, Precio: 320000000, Localidad: La Candelaria, Dirección: Calle 10 #3-15, Estrato: 3, Area_construida: 55, NumeroPisos: 1, Habitaciones: 1, Baños: 1, Cocina: 1, Garaje: 0, Patio: 1, Estudio: 1, Contacto: 3162549656, codigoc: 6, Descripcion: Ubicado en el corazón histórico de Bogotá, este apartaestudio en La Candelaria combina encanto y funcionalidad. Su diseño acogedor y moderno, junt'),
(93, 'ACTUALIZACION', 'tblinmueble', 49, '85', '2024-06-16 20:32:30', 'Titulo: Apartamento Moderno , Estado: No disponible, Ubicacion: ubicacion/ubicacion_666f845942cf8_1718584409.png, Precio: 250000000, Localidad: Modelia, Dirección: Carrera 50 #80-30, Estrato: 3, Area_construida: 100, NumeroPisos: 1, Habitaciones: 3, Baños: 2, Cocina: 1, Garaje: 0, Patio: 0, Estudio: 1, Contacto: 3565959595, codigoc: 2, Descripcion: Este encantador apartamento en Modelia ofrece un diseño moderno y funcional, ideal para personas que buscan comodidad y accesibilidad. Con espacios b', 'Titulo: Apartamento Moderno , Estado: No disponible, Ubicacion: ubicacion/ubicacion_666f845942cf8_1718584409.png, Precio: 250000000, Localidad: Modelia, Dirección: Carrera 50 #80-30, Estrato: 3, Area_construida: 100, NumeroPisos: 1, Habitaciones: 3, Baños: 2, Cocina: 1, Garaje: 0, Patio: 0, Estudio: 1, Contacto: 3565959595, codigoc: 2, Descripcion: Este encantador apartamento en Modelia ofrece un diseño moderno y funcional, ideal para personas que buscan comodidad y accesibilidad. Con espacios b'),
(94, 'Eliminacion', 'tblusuarios', 90, '85', '2024-06-16 20:35:14', 'Nombres: UserEjemplo; Correo: alzateandres799@gmail.com; Contraseña: a5263aa568bdf6bcaeb38be13d9fcd3b; Rol: usuario', NULL),
(95, 'Insercion', 'tblusuarios', 40, '85', '2024-06-16 20:36:11', NULL, 'Nombres: juan diego; Correo: juandiegorubiorodriguez14@gmail.com; Contraseña: 71cb80b7afea4fac72e89b782a4450d0; Rol: usuario');

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
(218, 'imagenes/img_666f27f4b2587_1718560756.jpg', 45),
(219, 'imagenes/img_666f27f517b27_1718560757.jpg', 45),
(220, 'imagenes/img_666f27f56f9b2_1718560757.jpg', 45),
(221, 'imagenes/img_666f27f5e04f3_1718560757.jpg', 45),
(222, 'imagenes/img_666f27f620aca_1718560758.jpg', 45),
(224, 'imagenes/img_666f8110936f4_1718583568.jpg', 46),
(225, 'imagenes/img_666f8110a6f93_1718583568.jpg', 46),
(226, 'imagenes/img_666f824f1e7cc_1718583887.jpg', 47),
(227, 'imagenes/img_666f824f437b5_1718583887.jpg', 47),
(228, 'imagenes/img_666f824f545df_1718583887.jpg', 47),
(229, 'imagenes/img_666f824f6bd62_1718583887.jpg', 47),
(230, 'imagenes/img_666f824f76342_1718583887.jpg', 47),
(231, 'imagenes/img_666f83687534c_1718584168.jpg', 48),
(232, 'imagenes/img_666f8368ae5b9_1718584168.jpg', 48),
(233, 'imagenes/img_666f8368da011_1718584168.jpg', 48),
(234, 'imagenes/img_666f8368f3237_1718584168.jpg', 48),
(235, 'imagenes/img_666f836923efa_1718584169.jpg', 48),
(237, 'imagenes/img_666f8458e11f4_1718584408.jpg', 49),
(238, 'imagenes/img_666f845915f4a_1718584409.jpg', 49),
(239, 'imagenes/img_666f845924acb_1718584409.jpg', 49),
(240, 'imagenes/img_666f845932d15_1718584409.jpg', 49),
(241, 'imagenes/img_666f862c72558_1718584876.jpg', 50),
(242, 'imagenes/img_666f862c975f5_1718584876.jpg', 50),
(243, 'imagenes/img_666f862ca5bb1_1718584876.jpg', 50),
(244, 'imagenes/img_666f862cae422_1718584876.jpg', 50),
(245, 'imagenes/img_666f862cc1e0d_1718584876.jpg', 50),
(246, 'imagenes/img_666f8b8a4da5d_1718586250.jpeg', 51),
(247, 'imagenes/img_666f8b8a84529_1718586250.jpeg', 51),
(248, 'imagenes/img_666f8b8a9fdf4_1718586250.jpeg', 51),
(249, 'imagenes/img_666f8b8ace686_1718586250.jpeg', 51),
(250, 'imagenes/img_666f8b8b73cd6_1718586251.jpeg', 51),
(251, 'imagenes/img_666f8c97ed45e_1718586519.jpg', 52),
(252, 'imagenes/img_666f8c98b1bd2_1718586520.jpg', 52),
(253, 'imagenes/img_666f8c98c2bd3_1718586520.jpg', 52),
(254, 'imagenes/img_666f8c998dd96_1718586521.jpg', 52),
(255, 'imagenes/img_666f8c99cabc8_1718586521.jpg', 52),
(256, 'imagenes/img_666f8db75f77c_1718586807.jpeg', 53),
(257, 'imagenes/img_666f8db78505b_1718586807.jpeg', 53),
(258, 'imagenes/img_666f8db79b0db_1718586807.jpeg', 53),
(259, 'imagenes/img_666f8db7afd84_1718586807.jpeg', 53),
(260, 'imagenes/img_666f8db7cd1f7_1718586807.jpeg', 53),
(261, 'imagenes/img_666f90d99a54b_1718587609.jpeg', 54),
(262, 'imagenes/img_666f90d9b7153_1718587609.jpeg', 54),
(263, 'imagenes/img_666f90d9bfcce_1718587609.jpeg', 54),
(264, 'imagenes/img_666f90d9d2aa0_1718587609.jpeg', 54),
(265, 'imagenes/img_666f90da3e08a_1718587610.jpeg', 54),
(266, 'imagenes/img_666f91eff042c_1718587887.jpg', 55),
(267, 'imagenes/img_666f91f01bb16_1718587888.jpg', 55),
(268, 'imagenes/img_666f91f03ba0d_1718587888.jpg', 55),
(269, 'imagenes/img_666f91f05486a_1718587888.jpg', 55),
(270, 'imagenes/img_666f91f0652c0_1718587888.jpg', 55);

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
(26, 'juandi', '3225554856', 'juancho14@gmail.com', 5),
(27, 'juandi su amdre', '3225554856', 'juancho14@gmail.com', 3),
(28, 'kacho kiun kiun ', '645645453', 'cloy14q@gmail.com', 15),
(30, 'kacho kiun kiun', '3225554856', 'juancho14@gmail.com', 47);

--
-- Disparadores `solicitudes`
--
DELIMITER $$
CREATE TRIGGER `actualizacion_solicitud` AFTER UPDATE ON `solicitudes` FOR EACH ROW BEGIN
    INSERT INTO auditoria (accion, tabla_afectada, id_registro_afectado, usuario, fecha_hora, datos_antiguos, datos_nuevos)
    VALUES ('Actualizacion', 'solicitudes', NEW.idSolicitud, '85', NOW(), 
            CONCAT('Nombre: ', OLD.Nombre, '; Telefono: ', OLD.Telefono, '; Correo: ', OLD.Correo, 
                   '; idInmuebleInteres: ', OLD.idInmuebleInteres), 
            CONCAT('Nombre: ', NEW.Nombre, '; Telefono: ', NEW.Telefono, '; Correo: ', NEW.Correo, 
                   '; idInmuebleInteres: ', NEW.idInmuebleInteres));
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `eliminacion_solicitud` AFTER DELETE ON `solicitudes` FOR EACH ROW BEGIN
    INSERT INTO auditoria (accion, tabla_afectada, id_registro_afectado, usuario, fecha_hora, datos_antiguos)
    VALUES ('Eliminacion', 'solicitudes', OLD.idSolicitud, '85', NOW(), 
            CONCAT('Nombre: ', OLD.Nombre, '; Telefono: ', OLD.Telefono, '; Correo: ', OLD.Correo, 
                   '; idInmuebleInteres: ', OLD.idInmuebleInteres));
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insercion_solicitud` AFTER INSERT ON `solicitudes` FOR EACH ROW BEGIN
    INSERT INTO auditoria (accion, tabla_afectada, id_registro_afectado, usuario, fecha_hora, datos_nuevos)
    VALUES ('Insercion', 'solicitudes', NEW.idSolicitud, '85', NOW(), 
            CONCAT('Nombre: ', NEW.Nombre, '; Telefono: ', NEW.Telefono, '; Correo: ', NEW.Correo, 
                   '; idInmuebleInteres: ', NEW.idInmuebleInteres));
END
$$
DELIMITER ;

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
(5, 'Bodega'),
(6, 'Aparta Estudio');

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
(1, 42, 'Andres Steven ', 'Juan Perez', 'Cra 88f n 56 26', '2024-05-22', '10:30:00', '3209586712', 1, '5', '1000000'),
(2, 6, 'tamarindo', 'Laura Gomez', 'cra 54 n 88 h 24', '2024-04-30', '14:00:00', '2324324524', 2, '3', '1500000'),
(7, 90, 'UserEjemplo', 'luiz lopez', 'cra 67 u 78 67', '2024-06-25', '17:52:00', '4563234567', 1, '21', '180000000');

--
-- Disparadores `tblcita`
--
DELIMITER $$
CREATE TRIGGER `actualizacion_cita` AFTER UPDATE ON `tblcita` FOR EACH ROW BEGIN
    INSERT INTO auditoria (accion, tabla_afectada, id_registro_afectado, usuario, fecha_hora, datos_antiguos, datos_nuevos)
    VALUES ('Actualizacion', 'tblcita', NEW.IdCita, '85', NOW(), 
            CONCAT('IdUsuario: ', OLD.IdUsuario, '; Nombre_usuario: ', OLD.Nombre_usuario, '; Nombre_asesor: ', OLD.Nombre_asesor, 
                   '; Dirección: ', OLD.Dirección, '; Fecha: ', OLD.Fecha, '; Hora: ', OLD.Hora, '; Telefono: ', OLD.Telefono, 
                   '; codigoc: ', OLD.codigoc, '; infoinmueble: ', OLD.infoinmueble, '; Precio_final: ', OLD.Precio_final), 
            CONCAT('IdUsuario: ', NEW.IdUsuario, '; Nombre_usuario: ', NEW.Nombre_usuario, '; Nombre_asesor: ', NEW.Nombre_asesor, 
                   '; Dirección: ', NEW.Dirección, '; Fecha: ', NEW.Fecha, '; Hora: ', NEW.Hora, '; Telefono: ', NEW.Telefono, 
                   '; codigoc: ', NEW.codigoc, '; infoinmueble: ', NEW.infoinmueble, '; Precio_final: ', NEW.Precio_final));
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `eliminacion_cita` AFTER DELETE ON `tblcita` FOR EACH ROW BEGIN
    INSERT INTO auditoria (accion, tabla_afectada, id_registro_afectado, usuario, fecha_hora, datos_antiguos)
    VALUES ('Eliminacion', 'tblcita', OLD.IdCita, '85', NOW(), 
            CONCAT('IdUsuario: ', OLD.IdUsuario, '; Nombre_usuario: ', OLD.Nombre_usuario, '; Nombre_asesor: ', OLD.Nombre_asesor, 
                   '; Dirección: ', OLD.Dirección, '; Fecha: ', OLD.Fecha, '; Hora: ', OLD.Hora, '; Telefono: ', OLD.Telefono, 
                   '; codigoc: ', OLD.codigoc, '; infoinmueble: ', OLD.infoinmueble, '; Precio_final: ', OLD.Precio_final));
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insercion_cita` AFTER INSERT ON `tblcita` FOR EACH ROW BEGIN
    INSERT INTO auditoria (accion, tabla_afectada, id_registro_afectado, usuario, fecha_hora, datos_nuevos)
    VALUES ('Insercion', 'tblcita', NEW.IdCita, '85', NOW(), 
            CONCAT('IdUsuario: ', NEW.IdUsuario, '; Nombre_usuario: ', NEW.Nombre_usuario, '; Nombre_asesor: ', NEW.Nombre_asesor, 
                   '; Dirección: ', NEW.Dirección, '; Fecha: ', NEW.Fecha, '; Hora: ', NEW.Hora, '; Telefono: ', NEW.Telefono, 
                   '; codigoc: ', NEW.codigoc, '; infoinmueble: ', NEW.infoinmueble, '; Precio_final: ', NEW.Precio_final));
END
$$
DELIMITER ;

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
  `descripcion` varchar(500) DEFAULT NULL,
  `IdUsuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tblinmueble`
--

INSERT INTO `tblinmueble` (`IdInmueble`, `Titulo`, `Estado`, `Ubicacion`, `Precio`, `Localidad`, `Dirección`, `Estrato`, `Area_construida`, `NumeroPisos`, `Habitaciones`, `Baños`, `Cocina`, `Garaje`, `Patio`, `Estudio`, `Contacto`, `codigoc`, `descripcion`, `IdUsuario`) VALUES
(45, 'Cómodo Apartamento ', 'Disponible', 'ubicacion/ubicacion_666f27f638b9a_1718560758.png', '280000000', 'Engativá', 'Carrera 70 #80-15', 3, '85', 1, 3, 2, 1, '1', '1', '1', '3222545454', 2, 'Este apartamento en Engativá ofrece un ambiente cómodo y funcional. Con espacios bien distribuidos y acabados modernos, es ideal para parejas o familias pequeñas que buscan un lugar acogedor cerca de comercios y transporte público.', NULL),
(46, 'Espaciosa Casa ', 'Disponible', 'ubicacion/ubicacion_666f8110c94af_1718583568.png', '320000000', 'Bosa', 'Carrera 80 #25-45', 4, '180 ', 2, 4, 3, 1, '1', '1', '1', '3259415259', 1, 'Esta amplia casa en Bosa Occidental ofrece un diseño cómodo y funcional. Con espacios bien distribuidos y acabados de calidad, es ideal para familias que buscan confort y tranquilidad. La ubicación cercana a parques y servicios es perfecta para disfrutar en familia.', NULL),
(47, 'Amplia Casa ', 'Disponible', 'ubicacion/ubicacion_666f824f80039_1718583887.png', '450000000', 'Los Mártires', 'Carrera 13 #24-36', 4, '180', 2, 5, 4, 1, '1', '1', '0', '3262929626', 1, 'Esta espaciosa casa ubicada en el barrio Los Mártires ofrece confort y elegancia. Con una distribución perfecta para familias grandes, cuenta con amplias habitaciones y áreas sociales ideales para compartir momentos especiales. Su ubicación privilegiada cerca de comercios y transporte facilita la vida diaria. ¡No pierdas la oportunidad de vivir en este hogar lleno de historia y tradición.', NULL),
(48, 'Hermosa Casa ', 'En proceso de adquisición', 'ubicacion/ubicacion_666f836932306_1718584169.png', '300000000', 'San Cristóbal', 'Calle 123 #456', 4, '150', 2, 4, 3, 1, '1', '1', '1', '3545252525', 1, 'Esta encantadora casa en San Cristóbal cuenta con espacios amplios y luminosos, perfectos para disfrutar en familia. Con acabados modernos y una ubicación privilegiada, ofrece tranquilidad y comodidad. El jardín trasero es ideal para reuniones al aire libre. No pierdas la oportunidad de vivir en este hermoso hogar.', NULL),
(49, 'Apartamento Moderno ', 'No disponible', 'ubicacion/ubicacion_666f845942cf8_1718584409.png', '250000000', 'Modelia', 'Carrera 50 #80-30', 3, '100', 1, 3, 2, 1, '0', '0', '1', '3565959595', 2, 'Este encantador apartamento en Modelia ofrece un diseño moderno y funcional, ideal para personas que buscan comodidad y accesibilidad. Con espacios bien distribuidos y acabados de calidad, este inmueble es perfecto para parejas o pequeñas familias. Disfruta de la tranquilidad y cercanía a comercios y transporte público en este hogar acogedor.', NULL),
(50, 'Ciudad Bolívar', 'Disponible', 'ubicacion/ubicacion_666f862cdc03f_1718584876.png', '150000000', 'Ciudad Bolívar', 'Calle 90 Sur #22-10', 2, '75', 1, 3, 2, 1, '0', '0', '1', '3056592652', 2, 'Este apartamento en Ciudad Bolívar combina modernidad y funcionalidad. Con una distribución eficiente y acabados contemporáneos, es ideal para parejas o personas solteras que buscan comodidad y accesibilidad en una zona tranquila de la ciudad.', NULL),
(51, 'Amplia Casa ', 'Disponible', 'ubicacion/ubicacion_666f8baca49cc_1718586284.png', '550000000', 'Suba', 'Calle 139 #120-45', 4, '250', 2, 5, 4, 1, '1', '1', '1', '3225465656', 1, 'Esta espaciosa casa en Suba es ideal para familias que buscan un lugar amplio y cómodo. Con cinco habitaciones y cuatro baños, ofrece suficiente espacio para todos los miembros de la familia. La casa cuenta con un diseño moderno y acabados de alta calidad. Ubicada en una zona tranquila y bien conectada, está cerca de parques, colegios, y centros comerciales. Perfecta para quienes valoran el espacio y la tranquilidad.', NULL),
(52, 'Casa Moderna', 'Disponible', 'ubicacion/ubicacion_666f8c9a11b00_1718586522.png', '320000000', 'Rafael Uribe ', 'Carrera 13A #45-30', 3, '120', 2, 4, 3, 1, '1', '1', '1', '3056486565', 1, 'Esta casa moderna en Rafael Uribe Uribe ofrece un ambiente cómodo y funcional, ideal para familias que buscan un espacio acogedor. Con cuatro habitaciones y tres baños, esta propiedad brinda la comodidad necesaria para todos los miembros de la familia. Su diseño moderno y acabados de calidad, junto con la proximidad a parques y servicios, la hacen una opción atractiva para quienes buscan tranquilidad en una ubicación central.', NULL),
(53, 'Confortable Apartaestudio', 'Disponible', 'ubicacion/ubicacion_666f8db7e8919_1718586807.png', '135000000', 'Kennedy', 'Avenida Primero de Mayo #34-56', 3, '45', 1, 1, 1, 1, '0', '0', '1', '3056465565', 6, 'Este apartaestudio en Kennedy combina comodidad y funcionalidad en un espacio compacto. Con un diseño moderno y eficiente, es perfecto para solteros o parejas que buscan una vivienda accesible y bien ubicada. Cerca de transporte público y servicios, ofrece una excelente opción para quienes valoran la practicidad en su día a día.', NULL),
(54, 'Elegante Apartaestudio ', 'Disponible', 'ubicacion/ubicacion_666f90da4b3ae_1718587610.png', '270000000', 'Teusaquillo', 'Carrera 24 #45-70', 4, '60', 1, 1, 1, 1, '0', '0', '1', '3225465659', 6, 'Este elegante apartaestudio en Teusaquillo es ideal para quienes buscan un espacio moderno y bien ubicado. Con un diseño eficiente, cuenta con una habitación cómoda, un baño, y una cocina equipada, ofreciendo todo lo necesario para una vida confortable. Su ubicación céntrica facilita el acceso a universidades, centros culturales, y una variedad de opciones de entretenimiento y gastronomía. Perfecto para profesionales o estudiantes que desean vivir en el corazón de la ciudad.', NULL),
(55, 'Encantador Apartaestudio', 'Disponible', 'ubicacion/ubicacion_666f91f0741c2_1718587888.png', '320000000', 'La Candelaria', 'Calle 10 #3-15', 3, '55', 1, 1, 1, 1, '0', '1', '1', '3162549656', 6, 'Ubicado en el corazón histórico de Bogotá, este apartaestudio en La Candelaria combina encanto y funcionalidad. Su diseño acogedor y moderno, junto con un patio interno y acabados de calidad, lo hacen ideal para profesionales o parejas que buscan vivir en un ambiente lleno de cultura y tradición. A pocos pasos de los principales atractivos turísticos, universidades, y opciones gastronómicas, este espacio ofrece una experiencia única de vida urbana.', NULL);

--
-- Disparadores `tblinmueble`
--
DELIMITER $$
CREATE TRIGGER `tblinmueble_delete_audit` AFTER DELETE ON `tblinmueble` FOR EACH ROW BEGIN
    INSERT INTO auditoria (accion, tabla_afectada, id_registro_afectado, usuario, fecha_hora, datos_antiguos, datos_nuevos)
    VALUES ('ELIMINACION', 'tblinmueble', OLD.IdInmueble, '85', NOW(), CONCAT('Titulo: ', OLD.Titulo, ', Estado: ', OLD.Estado, ', Ubicacion: ', OLD.Ubicacion, ', Precio: ', OLD.Precio, ', Localidad: ', OLD.Localidad, ', Dirección: ', OLD.Dirección, ', Estrato: ', OLD.Estrato, ', Area_construida: ', OLD.Area_construida, ', NumeroPisos: ', OLD.NumeroPisos, ', Habitaciones: ', OLD.Habitaciones, ', Baños: ', OLD.Baños, ', Cocina: ', OLD.Cocina, ', Garaje: ', OLD.Garaje, ', Patio: ', OLD.Patio, ', Estudio: ', OLD.Estudio, ', Contacto: ', OLD.Contacto, ', codigoc: ', OLD.codigoc, ', Descripcion: ', OLD.descripcion), NULL);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tblinmueble_insert_audit` AFTER INSERT ON `tblinmueble` FOR EACH ROW BEGIN
    INSERT INTO auditoria (accion, tabla_afectada, id_registro_afectado, usuario, fecha_hora, datos_antiguos, datos_nuevos)
    VALUES ('INSERCION', 'tblinmueble', NEW.IdInmueble, '85', NOW(), NULL, CONCAT('Titulo: ', NEW.Titulo, ', Estado: ', NEW.Estado, ', Ubicacion: ', NEW.Ubicacion, ', Precio: ', NEW.Precio, ', Localidad: ', NEW.Localidad, ', Dirección: ', NEW.Dirección, ', Estrato: ', NEW.Estrato, ', Area_construida: ', NEW.Area_construida, ', NumeroPisos: ', NEW.NumeroPisos, ', Habitaciones: ', NEW.Habitaciones, ', Baños: ', NEW.Baños, ', Cocina: ', NEW.Cocina, ', Garaje: ', NEW.Garaje, ', Patio: ', NEW.Patio, ', Estudio: ', NEW.Estudio, ', Contacto: ', NEW.Contacto, ', codigoc: ', NEW.codigoc, ', Descripcion: ', NEW.descripcion));
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tblinmueble_update_audit` AFTER UPDATE ON `tblinmueble` FOR EACH ROW BEGIN
    INSERT INTO auditoria (accion, tabla_afectada, id_registro_afectado, usuario, fecha_hora, datos_antiguos, datos_nuevos)
    VALUES ('ACTUALIZACION', 'tblinmueble', NEW.IdInmueble, '85', NOW(), CONCAT('Titulo: ', OLD.Titulo, ', Estado: ', OLD.Estado, ', Ubicacion: ', OLD.Ubicacion, ', Precio: ', OLD.Precio, ', Localidad: ', OLD.Localidad, ', Dirección: ', OLD.Dirección, ', Estrato: ', OLD.Estrato, ', Area_construida: ', OLD.Area_construida, ', NumeroPisos: ', OLD.NumeroPisos, ', Habitaciones: ', OLD.Habitaciones, ', Baños: ', OLD.Baños, ', Cocina: ', OLD.Cocina, ', Garaje: ', OLD.Garaje, ', Patio: ', OLD.Patio, ', Estudio: ', OLD.Estudio, ', Contacto: ', OLD.Contacto, ', codigoc: ', OLD.codigoc, ', Descripcion: ', OLD.descripcion), CONCAT('Titulo: ', NEW.Titulo, ', Estado: ', NEW.Estado, ', Ubicacion: ', NEW.Ubicacion, ', Precio: ', NEW.Precio, ', Localidad: ', NEW.Localidad, ', Dirección: ', NEW.Dirección, ', Estrato: ', NEW.Estrato, ', Area_construida: ', NEW.Area_construida, ', NumeroPisos: ', NEW.NumeroPisos, ', Habitaciones: ', NEW.Habitaciones, ', Baños: ', NEW.Baños, ', Cocina: ', NEW.Cocina, ', Garaje: ', NEW.Garaje, ', Patio: ', NEW.Patio, ', Estudio: ', NEW.Estudio, ', Contacto: ', NEW.Contacto, ', codigoc: ', NEW.codigoc, ', Descripcion: ', NEW.descripcion));
END
$$
DELIMITER ;

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
(40, 'juan diego', 'juandiegorubiorodriguez14@gmail.com', '71cb80b7afea4fac72e89b782a4450d0', 'usuario'),
(85, 'isagi', 'solobluelock@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'administrador');

--
-- Disparadores `tblusuarios`
--
DELIMITER $$
CREATE TRIGGER `actualizacion_usuario` AFTER UPDATE ON `tblusuarios` FOR EACH ROW BEGIN
    INSERT INTO auditoria (accion, tabla_afectada, id_registro_afectado, usuario, fecha_hora, datos_antiguos, datos_nuevos)
    VALUES ('Actualizacion', 'tblusuarios', NEW.id, '85', NOW(), 
            CONCAT('Nombres: ', OLD.Nombres, '; Correo: ', OLD.Correo, '; Contraseña: ', OLD.Contraseña, '; Rol: ', OLD.rol), 
            CONCAT('Nombres: ', NEW.Nombres, '; Correo: ', NEW.Correo, '; Contraseña: ', NEW.Contraseña, '; Rol: ', NEW.rol));
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `eliminacion_usuario` AFTER DELETE ON `tblusuarios` FOR EACH ROW BEGIN
    INSERT INTO auditoria (accion, tabla_afectada, id_registro_afectado, usuario, fecha_hora, datos_antiguos)
    VALUES ('Eliminacion', 'tblusuarios', OLD.id, '85', NOW(), 
            CONCAT('Nombres: ', OLD.Nombres, '; Correo: ', OLD.Correo, '; Contraseña: ', OLD.Contraseña, '; Rol: ', OLD.rol));
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insercion_usuario` AFTER INSERT ON `tblusuarios` FOR EACH ROW BEGIN
    INSERT INTO auditoria (accion, tabla_afectada, id_registro_afectado, usuario, fecha_hora, datos_nuevos)
    VALUES ('Insercion', 'tblusuarios', NEW.id, '85', NOW(), 
            CONCAT('Nombres: ', NEW.Nombres, '; Correo: ', NEW.Correo, '; Contraseña: ', NEW.Contraseña, '; Rol: ', NEW.rol));
END
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `imagenesinmuebles`
--
ALTER TABLE `imagenesinmuebles`
  MODIFY `IdImagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=271;

--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `idSolicitud` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `tblcategoria`
--
ALTER TABLE `tblcategoria`
  MODIFY `IdCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tblcita`
--
ALTER TABLE `tblcita`
  MODIFY `IdCita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tblinmueble`
--
ALTER TABLE `tblinmueble`
  MODIFY `IdInmueble` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `tblusuarios`
--
ALTER TABLE `tblusuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

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
