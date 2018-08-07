-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2018 at 02:18 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proyectos_isban`
--

-- --------------------------------------------------------

--
-- Table structure for table `i18n_codes`
--

CREATE TABLE `i18n_codes` (
  `id` int(11) UNSIGNED NOT NULL,
  `acronym` char(6) NOT NULL,
  `data_type` char(25) NOT NULL,
  `language` char(6) NOT NULL,
  `code` char(40) NOT NULL,
  `acronym_code` char(47) NOT NULL,
  `message` text NOT NULL,
  `deleted` enum('Y','N') DEFAULT 'N',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `i18n_codes`
--

INSERT INTO `i18n_codes` (`id`, `acronym`, `data_type`, `language`, `code`, `acronym_code`, `message`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 'BAMOBI', 'CODIGO_ERROR_APP', ' es-ES', '000002', 'BAMOBI_000002', 'El usuario no tiene permisos para ejecutar la operación.', 'N', '2018-08-06 05:38:23', '0000-00-00 00:00:00'),
(2, 'BAMOBI', 'CODIGO_ERROR_APP', ' es-ES', '000001', 'BAMOBI_000001', 'Algun texto del codigo', 'N', '2018-08-06 07:46:35', '0000-00-00 00:00:00'),
(4, 'BAMOBI', 'CODIGO_ERROR_APP', ' ga-ES', '000001', 'BAMOBI_000002', 'Texto para codigo duplicado.', 'N', '2018-08-06 07:53:16', '0000-00-00 00:00:00'),
(143, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', 'OTP0001', 'TARSAN_OTP0001', 'Santander Codigo #1 para Cambio de Limites', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(144, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', 'R001', 'TARSAN_R001', 'R001. En estos momentos no podemos atenderle. Por favor contacte con Banca Electru00f3nica o diru00edjase a su oficina.', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(145, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', 'R002', 'TARSAN_R002', 'R002. En estos momentos no podemos atenderle. Por favor contacte con Banca Electru00f3nica o diru00edjase a su oficina.', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(146, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', 'R003', 'TARSAN_R003', 'Redsys: titular sin terminales activados en el sistema', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(147, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', 'R004', 'TARSAN_R004', 'Redsys: entidad no registrada en el sistema', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(148, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', 'R005', 'TARSAN_R005', 'Redsys: entidad sin aplicaciones registradas en el sistema', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(149, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', 'R007', 'TARSAN_R007', 'Redsys: se ha producido un error al sincronizar con CES', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(150, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', 'R666', 'TARSAN_R666', 'Redsys: no hay respuesta de Redsys', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(151, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', 'R996', 'TARSAN_R996', 'Redsys: firma del mensaje no vu00e1lida', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(152, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', 'R997', 'TARSAN_R997', 'Redsys: formato de mensaje no vu00e1lido o falta algu00fan campo necesario', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(153, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', 'R998', 'TARSAN_R998', 'Redsys: error en acceso a base de datos', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(154, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', 'R999', 'TARSAN_R999', 'Redsys: error general durante el procesamiento del mensaje', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(155, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00001', 'TARSAN_00001', 'El usuario no tiene relaciu00f3n con la tarjeta', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(156, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00002', 'TARSAN_00002', 'La tarjeta no estu00e1 en vigor', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(157, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00003', 'TARSAN_00003', 'No dispone de los permisos para realizar la operaciu00f3n', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(158, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00004', 'TARSAN_00004', 'Error en el procesamiento de la peticiu00f3n. Para mu00e1s informaciu00f3n llame a la Lu00ednea de Atenciu00f3n de Supernet 902 73 49 60', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(159, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00005', 'TARSAN_00005', 'Su clave personal estu00e1 revocada', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(160, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00006', 'TARSAN_00006', 'Debe informar los campos de la firma por posiciones', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(161, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00007', 'TARSAN_00007', 'El usuario no estu00e1 dado de alta en el servicio de OTP', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(162, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00008', 'TARSAN_00008', 'La clave de firma introducida es erru00f3nea. Por favor, vuelva a introducir su firma.', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(163, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00009', 'TARSAN_00009', 'Es la primera vez que firma una operativa', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(164, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00010', 'TARSAN_00010', 'La firma estu00e1 revocada', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(165, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00015', 'TARSAN_00015', 'RECARGA A TELu00c9FONO EN LISTA NEGRA', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(166, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00016', 'TARSAN_00016', 'listanegra@oesia.com', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(167, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00017', 'TARSAN_00017', 'Datos del envio:', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(168, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00018', 'TARSAN_00018', 'Fecha ejecuciu00f3n:', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(169, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00019', 'TARSAN_00019', 'Mu00f3vil:', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(170, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00020', 'TARSAN_00020', 'CBE:', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(171, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00021', 'TARSAN_00021', 'El usuario tiene restringido el servicio de transferencias', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(172, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00023', 'TARSAN_00023', 'Datos del cliente:', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(173, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00024', 'TARSAN_00024', 'Nombre del cliente:', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(174, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00025', 'TARSAN_00025', 'Nif del Ordenante:', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(175, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00026', 'TARSAN_00026', 'Telu00e9fono:', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(176, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00027', 'TARSAN_00027', 'Email:', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(177, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00028', 'TARSAN_00028', 'Direccion:', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(178, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00029', 'TARSAN_00029', 'Localidad:', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(179, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00030', 'TARSAN_00030', 'Provincia:', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(180, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00031', 'TARSAN_00031', 'Cu00f3digo Postal:', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(181, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00032', 'TARSAN_00032', 'Nu00famero movil:', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(182, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00033', 'TARSAN_00033', 'Datos de Supernet:', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(183, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00034', 'TARSAN_00034', 'Fecha ejecuciu00f3n:', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(184, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00035', 'TARSAN_00035', 'Hora ejecuciu00f3n:', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(185, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00036', 'TARSAN_00036', 'IP Conexiu00f3n', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(186, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00037', 'TARSAN_00037', 'bloqueousuario@oesia.com', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(187, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00038', 'TARSAN_00038', '(Sin Asunto)', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(188, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00039', 'TARSAN_00039', 'Ha superado el nu00famero mu00e1ximo de intentos de OTP y se ha revocado su clave de firma', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(189, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00040', 'TARSAN_00040', 'Clave de OTP Incorrecta', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(190, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00041', 'TARSAN_00041', 'Usuario no estu00e1 registrado en servicio OTP', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(191, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00042', 'TARSAN_00042', 'Se ha producido un error de conexiu00f3n en la llamada a 4B', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(192, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00043', 'TARSAN_00043', 'Se ha producido un error de la recarga en la llamada a 4B', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(193, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00044', 'TARSAN_00044', 'No se han encontrado registros en la BBDD', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(194, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00045', 'TARSAN_00045', 'El ticket no se encuentra en BBDD', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(195, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00046', 'TARSAN_00046', 'No se ha encontrado ningu00fan telu00e9fono asociado al cliente', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(196, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00047', 'TARSAN_00047', 'No se han encontrado registros en la BBDD', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(197, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00048', 'TARSAN_00048', 'Falta campo importe por rellenar', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(198, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00049', 'TARSAN_00049', 'El importe introducido no es correcto', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(199, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00050', 'TARSAN_00050', 'No se admiten recargas con decimales', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(200, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00051', 'TARSAN_00051', 'Falta campo obligatorio: Telu00e9fono Recarga', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(201, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00052', 'TARSAN_00052', 'El nu00famero de telu00e9fono de recarga no es correcto (Su00f3lo nu00fameros,9 posiciones)', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(202, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00053', 'TARSAN_00053', 'El Operador de la recarga no es vu00e1lido', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(203, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00054', 'TARSAN_00054', 'El importe no es vu00e1lido para ese Operador', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(204, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00055', 'TARSAN_00055', 'Falta campo obligatorio: PAN', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(205, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00056', 'TARSAN_00056', 'Falta campo obligatorio: Fecha Caducidad', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(206, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00057', 'TARSAN_00057', 'Movistar', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(207, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00058', 'TARSAN_00058', 'Vodafone', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(208, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00059', 'TARSAN_00059', 'Orange', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(209, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00060', 'TARSAN_00060', 'Yoigo', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(210, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00061', 'TARSAN_00061', 'Carrefour Mu00f3vil', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(211, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00062', 'TARSAN_00062', 'E-Plus', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(212, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00063', 'TARSAN_00063', 'Eroski Mu00f3vil', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(213, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00064', 'TARSAN_00064', 'Euskaltel', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(214, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00065', 'TARSAN_00065', 'Happy Mu00f3vil', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(215, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00066', 'TARSAN_00066', 'Lebara Mu00f3vil', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(216, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00067', 'TARSAN_00067', 'Mu00e1s Mu00f3vil', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(217, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00068', 'TARSAN_00068', 'ONO', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(218, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00069', 'TARSAN_00069', 'Orbitel Mu00f3vil', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(219, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00070', 'TARSAN_00070', 'Pepe Phone', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(220, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00071', 'TARSAN_00071', 'Simyo', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(221, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00072', 'TARSAN_00072', 'Vectone', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(222, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00074', 'TARSAN_00074', 'SANT-ENVIOS', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(223, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00075', 'TARSAN_00075', 'CODE', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(224, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00076', 'TARSAN_00076', 'CODIGO', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(225, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00077', 'TARSAN_00077', 'INFORMACION', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(226, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00078', 'TARSAN_00078', 'SEGURIDAD', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(227, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00079', 'TARSAN_00079', 'SUPERNET', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(228, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00080', 'TARSAN_00080', 'TRANSFER', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(229, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00081', 'TARSAN_00081', 'CODCONF', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(230, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00082', 'TARSAN_00082', 'INFOSNET', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(231, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00083', 'TARSAN_00083', 'SNETCOD', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(232, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00084', 'TARSAN_00084', 'Supernet informa: Estu00e1 ordenando una recarga de mu00f3viles de #1 al Tlf #2. Cu00f3digo de confirmaciu00f3n #3.', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(233, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00085', 'TARSAN_00085', 'Cu00f3digo de confirmaciu00f3n #3. Para recarga de mu00f3viles de #1 al Tlf #2. Mu00e1s informaciu00f3n Banca telefu00f3nica.', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(234, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00086', 'TARSAN_00086', 'Info: Cu00f3d #3 Para la recarga de mu00f3viles de #1 al Tlf #2. 902734960', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(235, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00087', 'TARSAN_00087', 'SPN: Cdgo Seguro #3 Para la recarga de mu00f3viles de #1 al Tlf #2.', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(236, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00088', 'TARSAN_00088', 'BS: Cdgo Seguridad #3. Para la operaciu00f3n de #1 al Tlf #2.', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(237, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00100', 'TARSAN_00100', 'Los datos de entrada no coinciden con los codificados en el token de seguridad', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(238, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00101', 'TARSAN_00101', 'Falta por informar campo obligatorio Ticket.', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(239, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00102', 'TARSAN_00102', 'Falta por informar campo obligatorio Cu00f3digo OTP.', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(240, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00103', 'TARSAN_00103', 'Fallo en el metodo java de acceso a technical facades configuration IndexOutOfBoundsException', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(241, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00104', 'TARSAN_00104', 'Ticket no encontrado', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(242, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00105', 'TARSAN_00105', 'El cu00f3digo de otp ha excedido el lu00edmite de tiempo', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(243, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00106', 'TARSAN_00106', 'Error en el procesamiento de la peticiu00f3n. Para mu00e1s informaciu00f3n llame a nuestro servicio de atenciu00f3n telefu00f3nica. Cu00f3digo de error: EVSMSXX', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(244, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00107', 'TARSAN_00107', 'Error tecnico en el metodo - TDFormatException', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(245, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00108', 'TARSAN_00108', 'La secuencia de llamadas es incorrecta (Paso de Token)', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(246, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00109', 'TARSAN_00109', 'Error tecnico en el metodo - UnsupportedEncodingException', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(247, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00110', 'TARSAN_00110', 'Error tecnico en el metodo - IOException', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(248, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00111', 'TARSAN_00111', 'La respuesta XML del servicio 4B esta vacia - xml vacio', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(249, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00112', 'TARSAN_00112', 'Error tecnico en el metodo - TDValidationException', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(250, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00113', 'TARSAN_00113', 'Error tecnico en el metodo - TDFormatException', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(251, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00114', 'TARSAN_00114', 'Error tecnico en el metodo - TDInitException', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(252, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00115', 'TARSAN_00115', 'Error tecnico en el metodo - HostApplicationException', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(253, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00116', 'TARSAN_00116', 'Error tecnico en el metodo - XMLConnectorException', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(254, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00117', 'TARSAN_00117', 'Error tecnico en el metodo - ParserConfigurationException', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(255, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00118', 'TARSAN_00118', 'Error tecnico en el metodo - UnsupportedEncodingException', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(256, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00119', 'TARSAN_00119', 'Error tecnico en el metodo - SAXException', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(257, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00120', 'TARSAN_00120', 'No se encuentra la personalizaciu00f3n de la tarjeta', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(258, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00121', 'TARSAN_00121', 'Error tecnico - HostApplicationException al obtener el servicio de configuracion', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(259, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00122', 'TARSAN_00122', 'Error tecnico - TechnicalFacadesConfigurationServiceException al obtener el servicio de configuracion', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(260, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00123', 'TARSAN_00123', 'No se ha encontrado la operadora indicada en las configuraciones de TechnicalFacades', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(261, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00124', 'TARSAN_00124', 'El importe indicado en la entrada es menor que el importe mu00ednimo permitido', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(262, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00125', 'TARSAN_00125', 'El importe indicado en la entrada es mayor que el importe maximo configurado en TechnicalFacades', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(263, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00126', 'TARSAN_00126', 'El importe indicado en la entrada es menor que el importe mu00ednimo permitido', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(264, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00131', 'TARSAN_00131', 'FRAUDE en RecargaECash en Movilidad', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(265, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00132', 'TARSAN_00132', 'Cu00f3digo seguro: #1 para Carga/Descarga tarjeta ECash', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(266, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00998', 'TARSAN_00998', 'El codigo de respuesta obtenido no es un numero entero', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(267, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '00999', 'TARSAN_00999', 'Codigo de respuesta obtenido del servicio 4B diferente de los esperados (2000, 1004, 1003, 1002, 1001, 1000 o 0).', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(268, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '01000', 'TARSAN_01000', 'Codigo de respuesta obtenido del servicio 4B - 1000', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(269, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '01001', 'TARSAN_01001', 'Codigo de respuesta obtenido del servicio 4B - 1001', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(270, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '01002', 'TARSAN_01002', 'Codigo de respuesta obtenido del servicio 4B - 1002', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(271, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '01003', 'TARSAN_01003', 'Codigo de respuesta obtenido del servicio 4B - 1003', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(272, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '01004', 'TARSAN_01004', 'Codigo de respuesta obtenido del servicio 4B - 1004', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(273, 'TARSAN', 'CODIGO_ERROR_APP', ' es-ES', '02000', 'TARSAN_02000', 'Codigo de respuesta obtenido del servicio 4B - 2000', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(274, 'TARSAN', 'CODIGO_MENSAJE_APP', ' es-ES', '00022', 'TARSAN_00022', 'Recarga realizada correctamente', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(275, 'TARSAN', 'CODIGO_MENSAJE_APP', ' es-ES', '00090', 'TARSAN_00090', 'Operaciu00f3n realizada correctamente', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(276, 'TARSAN', 'CODIGO_MENSAJE_APP', ' es-ES', '00103', 'TARSAN_00103', 'Usuario exceptuado de servicio de OTP', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(277, 'TARSAN', 'CODIGO_MENSAJE_APP', ' es-ES', '00107', 'TARSAN_00107', 'Confirmaciu00f3n de solicitud tarjeta e-cash realizada correctamente', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(278, 'TARSAN', 'CODIGO_MENSAJE_APP', ' es-ES', '00190', 'TARSAN_00190', 'Operaciu00f3n realizada correctamente (Consulta CVV2)', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00'),
(279, 'TARSAN', 'CODIGO_MENSAJE_APP', ' es-ES', '00191', 'TARSAN_00191', 'Operaciu00f3n realizada correctamente (Consulta imagen tarjeta)', 'N', '2018-08-06 08:05:19', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `i18n_codes`
--
ALTER TABLE `i18n_codes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `acronym` (`acronym`,`data_type`,`language`,`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `i18n_codes`
--
ALTER TABLE `i18n_codes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=280;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
