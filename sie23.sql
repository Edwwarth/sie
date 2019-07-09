-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 09, 2019 at 03:08 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sie26`
--

-- --------------------------------------------------------

--
-- Table structure for table `Administrator`
--

CREATE TABLE `Administrator` (
  `idAdministrator` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `lastName` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `picture` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `mobile` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Administrator`
--

INSERT INTO `Administrator` (`idAdministrator`, `name`, `lastName`, `email`, `password`, `picture`, `phone`, `mobile`) VALUES
(1, 'administrator', 'administrator', 'admin@udistrital.edu.co', '202cb962ac59075b964b07152d234b70', NULL, '123', '123');

-- --------------------------------------------------------

--
-- Table structure for table `Cuestionario`
--

CREATE TABLE `Cuestionario` (
  `idCuestionario` int(11) NOT NULL,
  `participante_idParticipante` int(11) NOT NULL,
  `created_time` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Cuestionario`
--

INSERT INTO `Cuestionario` (`idCuestionario`, `participante_idParticipante`, `created_time`) VALUES
(29, 1, '2019-07-07 22:50:12');

-- --------------------------------------------------------

--
-- Table structure for table `Esquema`
--

CREATE TABLE `Esquema` (
  `idEsquema` int(11) NOT NULL,
  `pregunta_idPregunta` int(11) NOT NULL,
  `cuestionario_idCuestionario` int(11) NOT NULL,
  `respuesta_idRespuesta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Esquema`
--

INSERT INTO `Esquema` (`idEsquema`, `pregunta_idPregunta`, `cuestionario_idCuestionario`, `respuesta_idRespuesta`) VALUES
(45, 31, 29, 2),
(46, 32, 29, 5);

-- --------------------------------------------------------

--
-- Table structure for table `Evaluador`
--

CREATE TABLE `Evaluador` (
  `idEvaluador` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `imagen` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Evaluador`
--

INSERT INTO `Evaluador` (`idEvaluador`, `nombre`, `apellido`, `email`, `password`, `imagen`) VALUES
(1, 'Evaluador 1', 'Eval', 'eval@eval.com', '202cb962ac59075b964b07152d234b70', '');

-- --------------------------------------------------------

--
-- Table structure for table `LogAdministrator`
--

CREATE TABLE `LogAdministrator` (
  `idLogAdministrator` int(11) NOT NULL,
  `accion` varchar(45) NOT NULL,
  `informacion` text NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `ip` varchar(45) NOT NULL,
  `so` varchar(45) NOT NULL,
  `explorador` varchar(45) NOT NULL,
  `administrator_idAdministrator` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `LogAdministrator`
--

INSERT INTO `LogAdministrator` (`idLogAdministrator`, `accion`, `informacion`, `fecha`, `hora`, `ip`, `so`, `explorador`, `administrator_idAdministrator`) VALUES
(1, 'Create Evaluador', 'Nombre: Evaluador 1;; Apellido: Eval;; Email: eval@eval.com;; Password: 123', '2019-07-01', '18:55:25', '127.0.0.1', 'Linux', 'Firefox', 1),
(2, 'Create Participante', 'Nombre: Participante 1;; Apellido: Par;; Email: par@par.com;; Password: 123', '2019-07-01', '18:55:46', '127.0.0.1', 'Linux', 'Firefox', 1),
(3, 'Create Programa Academico', 'Nombre: Tecnología en sistematización de datos', '2019-07-01', '18:59:14', '127.0.0.1', 'Linux', 'Firefox', 1),
(4, 'Create Pregunta', 'Pregunta: Tecnología en gestión de la producción industrial', '2019-07-01', '18:59:36', '127.0.0.1', 'Linux', 'Firefox', 1),
(5, 'Create Pregunta', 'Pregunta: Tecnología en sistemas eléctricos de media y baja tensión', '2019-07-01', '18:59:45', '127.0.0.1', 'Linux', 'Firefox', 1),
(6, 'Create Pregunta', 'Pregunta: Tecnología en construcciones civiles', '2019-07-01', '18:59:54', '127.0.0.1', 'Linux', 'Firefox', 1),
(7, 'Create Pregunta', 'Pregunta: Tecnología en electrónica', '2019-07-01', '19:00:05', '127.0.0.1', 'Linux', 'Firefox', 1),
(8, 'Create Programa Academico', 'Nombre: Tecnología en gestión de la producción industrial', '2019-07-01', '19:00:26', '127.0.0.1', 'Linux', 'Firefox', 1),
(9, 'Create Programa Academico', 'Nombre: Tecnología en sistemas eléctricos de media y baja tensión', '2019-07-01', '19:00:37', '127.0.0.1', 'Linux', 'Firefox', 1),
(10, 'Create Programa Academico', 'Nombre: Tecnología en construcciones civiles', '2019-07-01', '19:00:49', '127.0.0.1', 'Linux', 'Firefox', 1),
(11, 'Create Programa Academico', 'Nombre: Tecnología en electrónica', '2019-07-01', '19:00:56', '127.0.0.1', 'Linux', 'Firefox', 1),
(12, 'Create Respuesta', 'Tipo: Muy Bajo', '2019-07-01', '19:10:41', '127.0.0.1', 'Linux', 'Firefox', 1),
(13, 'Create Respuesta', 'Tipo: Bajo', '2019-07-01', '19:10:45', '127.0.0.1', 'Linux', 'Firefox', 1),
(14, 'Create Respuesta', 'Tipo: Medio', '2019-07-01', '19:10:50', '127.0.0.1', 'Linux', 'Firefox', 1),
(15, 'Create Respuesta', 'Tipo: Alto', '2019-07-01', '19:10:57', '127.0.0.1', 'Linux', 'Firefox', 1),
(16, 'Create Respuesta', 'Tipo: Muy Alto', '2019-07-01', '19:11:04', '127.0.0.1', 'Linux', 'Firefox', 1),
(17, 'Edit Pregunta', 'Pregunta: Pregunta 1', '2019-07-01', '19:40:03', '127.0.0.1', 'Linux', 'Firefox', 1),
(18, 'Edit Pregunta', 'Pregunta: Pregunta 2', '2019-07-01', '19:40:11', '127.0.0.1', 'Linux', 'Firefox', 1),
(19, 'Edit Pregunta', 'Pregunta: Pregunta 3', '2019-07-01', '19:40:21', '127.0.0.1', 'Linux', 'Firefox', 1),
(20, 'Edit Pregunta', 'Pregunta: Pregunta 4', '2019-07-01', '19:40:30', '127.0.0.1', 'Linux', 'Firefox', 1),
(21, 'Create Valor', 'Valor: 1;; Pregunta: Pregunta 1;; Programa Academico: Tecnología en construcciones civiles;; Respuesta: Muy Bajo', '2019-07-01', '19:41:35', '127.0.0.1', 'Linux', 'Firefox', 1),
(22, 'Create Valor', 'Valor: 2;; Pregunta: Pregunta 1;; Programa Academico: Tecnología en gestión de la producción industrial;; Respuesta: Bajo', '2019-07-01', '19:41:50', '127.0.0.1', 'Linux', 'Firefox', 1),
(23, 'Create Valor', 'Valor: 2;; Pregunta: Pregunta 1;; Programa Academico: Tecnología en sistemas eléctricos de media y baja tensión;; Respuesta: Medio', '2019-07-01', '19:42:03', '127.0.0.1', 'Linux', 'Firefox', 1),
(24, 'Create Valor', 'Valor: 3;; Pregunta: Pregunta 1;; Programa Academico: Tecnología en electrónica;; Respuesta: Alto', '2019-07-01', '19:42:23', '127.0.0.1', 'Linux', 'Firefox', 1),
(25, 'Create Valor', 'Valor: 5;; Pregunta: Pregunta 1;; Programa Academico: Tecnología en sistematización de datos;; Respuesta: Muy Alto', '2019-07-01', '19:42:33', '127.0.0.1', 'Linux', 'Firefox', 1),
(26, 'Create Pregunta', 'Pregunta: Pregunta 5', '2019-07-01', '21:54:48', '127.0.0.1', 'Linux', 'Firefox', 1),
(27, 'Create Pregunta', 'Pregunta: ASHGSDAHJDSAG', '2019-07-01', '22:02:30', '127.0.0.1', 'Linux', 'Firefox', 1),
(28, 'Create Pregunta', 'Pregunta: ASHGSDAHJDSAG', '2019-07-01', '22:03:37', '127.0.0.1', 'Linux', 'Firefox', 1),
(29, 'Create Pregunta', 'Pregunta: ASHGSDAHJDSAG', '2019-07-01', '22:03:53', '127.0.0.1', 'Linux', 'Firefox', 1),
(30, 'Create Pregunta', 'Pregunta: ASHGSDAHJDSAG', '2019-07-01', '22:04:24', '127.0.0.1', 'Linux', 'Firefox', 1),
(31, 'Create Pregunta', 'Pregunta: ASHGSDAHJDSAG', '2019-07-01', '22:04:42', '127.0.0.1', 'Linux', 'Firefox', 1),
(32, 'Create Pregunta', 'Pregunta: ASHGSDAHJDSAG', '2019-07-01', '22:06:51', '127.0.0.1', 'Linux', 'Firefox', 1),
(33, 'Create Pregunta', 'Pregunta: ASHGSDAHJDSAG', '2019-07-01', '22:08:10', '127.0.0.1', 'Linux', 'Firefox', 1),
(34, 'Create Pregunta', 'Pregunta: ASHGSDAHJDSAG', '2019-07-01', '22:08:14', '127.0.0.1', 'Linux', 'Firefox', 1),
(35, 'Create Pregunta', 'Pregunta: ASHGSDAHJDSAG', '2019-07-01', '22:08:33', '127.0.0.1', 'Linux', 'Firefox', 1),
(36, 'Create Pregunta', 'Pregunta: ANSBAKJSH', '2019-07-01', '22:09:07', '127.0.0.1', 'Linux', 'Firefox', 1),
(37, 'Create Pregunta', 'Pregunta: ANSBAKJSH', '2019-07-01', '22:09:33', '127.0.0.1', 'Linux', 'Firefox', 1),
(38, 'Create Pregunta', 'Pregunta: ANSBAKJSH', '2019-07-01', '22:09:55', '127.0.0.1', 'Linux', 'Firefox', 1),
(39, 'Create Pregunta', 'Pregunta: ANSBAKJSH', '2019-07-01', '22:10:42', '127.0.0.1', 'Linux', 'Firefox', 1),
(40, 'Create Pregunta', 'Pregunta: ANSBAKJSH', '2019-07-01', '22:10:50', '127.0.0.1', 'Linux', 'Firefox', 1),
(41, 'Create Pregunta', 'Pregunta: ANSBAKJSH', '2019-07-01', '22:11:06', '127.0.0.1', 'Linux', 'Firefox', 1),
(42, 'Create Pregunta', 'Pregunta: ANSBAKJSH', '2019-07-01', '22:11:13', '127.0.0.1', 'Linux', 'Firefox', 1),
(43, 'Create Pregunta', 'Pregunta: ANSBAKJSH', '2019-07-01', '22:11:28', '127.0.0.1', 'Linux', 'Firefox', 1),
(44, 'Create Pregunta', 'Pregunta: ANSBAKJSH', '2019-07-01', '22:11:59', '127.0.0.1', 'Linux', 'Firefox', 1),
(45, 'Create Pregunta', 'Pregunta: ANSBAKJSH', '2019-07-01', '22:12:24', '127.0.0.1', 'Linux', 'Firefox', 1),
(46, 'Create Pregunta', 'Pregunta: ANSBAKJSH', '2019-07-01', '22:12:33', '127.0.0.1', 'Linux', 'Firefox', 1),
(47, 'Create Pregunta', 'Pregunta: ANSBAKJSH', '2019-07-01', '22:12:44', '127.0.0.1', 'Linux', 'Firefox', 1),
(48, 'Create Pregunta', 'Pregunta: ANSBAKJSH', '2019-07-01', '22:15:22', '127.0.0.1', 'Linux', 'Firefox', 1),
(49, 'Create Pregunta', 'Pregunta: ANSBAKJSH', '2019-07-01', '22:15:52', '127.0.0.1', 'Linux', 'Firefox', 1),
(50, 'Create Pregunta', 'Pregunta: ANSBAKJSH', '2019-07-01', '22:16:07', '127.0.0.1', 'Linux', 'Firefox', 1),
(51, 'Create Pregunta', 'Pregunta: ANSBAKJSH', '2019-07-01', '22:16:53', '127.0.0.1', 'Linux', 'Firefox', 1),
(52, 'Create Pregunta', 'Pregunta: ANSBAKJSH', '2019-07-01', '22:18:36', '127.0.0.1', 'Linux', 'Firefox', 1),
(53, 'Create Pregunta', 'Pregunta: ANSBAKJSH', '2019-07-01', '22:18:48', '127.0.0.1', 'Linux', 'Firefox', 1),
(54, 'Create Pregunta', 'Pregunta: ANSBAKJSH', '2019-07-01', '22:23:56', '127.0.0.1', 'Linux', 'Firefox', 1),
(55, 'Create Pregunta', 'Pregunta: ANSBAKJSH', '2019-07-01', '22:23:58', '127.0.0.1', 'Linux', 'Firefox', 1),
(56, 'Create Pregunta', 'Pregunta: ANSBAKJSH', '2019-07-01', '22:24:04', '127.0.0.1', 'Linux', 'Firefox', 1),
(57, 'Create Pregunta', 'Pregunta: ANSBAKJSH', '2019-07-01', '22:27:02', '127.0.0.1', 'Linux', 'Firefox', 1),
(58, 'Create Pregunta', 'Pregunta: ANSBAKJSH', '2019-07-01', '22:27:58', '127.0.0.1', 'Linux', 'Firefox', 1),
(59, 'Create Pregunta', 'Pregunta: ANSBAKJSH', '2019-07-01', '22:28:41', '127.0.0.1', 'Linux', 'Firefox', 1),
(60, 'Create Pregunta', 'Pregunta: Pregunta 6', '2019-07-01', '22:31:58', '127.0.0.1', 'Linux', 'Firefox', 1),
(61, 'Log In', '', '2019-07-06', '14:49:41', '127.0.0.1', 'Linux', 'Firefox', 1),
(62, 'Log In', '', '2019-07-06', '14:56:05', '127.0.0.1', 'Linux', 'Firefox', 1),
(63, 'Log In', '', '2019-07-07', '09:04:54', '127.0.0.1', 'Linux', 'Firefox', 1),
(64, 'Create Pregunta', 'Pregunta: Pregunta 2', '2019-07-07', '09:05:18', '127.0.0.1', 'Linux', 'Firefox', 1),
(65, 'Create Pregunta', 'Pregunta: Pregunta 2', '2019-07-07', '09:17:03', '127.0.0.1', 'Linux', 'Firefox', 1),
(66, 'Create Pregunta', 'Pregunta: Pregunta 2', '2019-07-07', '09:17:41', '127.0.0.1', 'Linux', 'Firefox', 1),
(67, 'Create Pregunta', 'Pregunta: Pregunta 2', '2019-07-07', '09:17:53', '127.0.0.1', 'Linux', 'Firefox', 1),
(68, 'Create Pregunta', 'Pregunta: Pregunta 2', '2019-07-07', '09:18:41', '127.0.0.1', 'Linux', 'Firefox', 1),
(69, 'Create Pregunta', 'Pregunta: Pregunta 3', '2019-07-07', '09:36:11', '127.0.0.1', 'Linux', 'Firefox', 1),
(70, 'Create Pregunta', 'Pregunta: Pregunta 3', '2019-07-07', '09:36:34', '127.0.0.1', 'Linux', 'Firefox', 1),
(71, 'Create Pregunta', 'Pregunta: Pregunta 3', '2019-07-07', '09:40:23', '127.0.0.1', 'Linux', 'Firefox', 1),
(72, 'Create Pregunta', 'Pregunta: Pregunta 3', '2019-07-07', '09:42:07', '127.0.0.1', 'Linux', 'Firefox', 1),
(73, 'Create Pregunta', 'Pregunta: Pregunta 3', '2019-07-07', '09:42:34', '127.0.0.1', 'Linux', 'Firefox', 1),
(74, 'Create Pregunta', 'Pregunta: Pregunta 3', '2019-07-07', '09:46:38', '127.0.0.1', 'Linux', 'Firefox', 1),
(75, 'Create Pregunta', 'Pregunta: Pregunta 3', '2019-07-07', '09:52:28', '127.0.0.1', 'Linux', 'Firefox', 1),
(76, 'Create Pregunta', 'Pregunta: Pregunta 3', '2019-07-07', '09:52:48', '127.0.0.1', 'Linux', 'Firefox', 1),
(77, 'Create Pregunta', 'Pregunta: Pregunta 3', '2019-07-07', '10:14:02', '127.0.0.1', 'Linux', 'Firefox', 1),
(78, 'Create Pregunta', 'Pregunta: Pregunta 3', '2019-07-07', '10:14:10', '127.0.0.1', 'Linux', 'Firefox', 1),
(79, 'Create Pregunta', 'Pregunta: Pregunta 3', '2019-07-07', '10:14:27', '127.0.0.1', 'Linux', 'Firefox', 1),
(80, 'Create Pregunta', 'Pregunta: Pregunta 3', '2019-07-07', '10:16:28', '127.0.0.1', 'Linux', 'Firefox', 1),
(81, 'Create Pregunta', 'Pregunta: Pregunta 7', '2019-07-07', '10:18:03', '127.0.0.1', 'Linux', 'Firefox', 1),
(82, 'Create Pregunta', 'Pregunta: Pregunta 7', '2019-07-07', '10:18:09', '127.0.0.1', 'Linux', 'Firefox', 1),
(83, 'Create Pregunta', 'Pregunta: Pregunta 7', '2019-07-07', '10:18:15', '127.0.0.1', 'Linux', 'Firefox', 1),
(84, 'Create Pregunta', 'Pregunta: Pregunta 7', '2019-07-07', '10:18:21', '127.0.0.1', 'Linux', 'Firefox', 1),
(85, 'Create Pregunta', 'Pregunta: Pregunta 7', '2019-07-07', '10:18:27', '127.0.0.1', 'Linux', 'Firefox', 1),
(86, 'Create Pregunta', 'Pregunta: Pregunta 7', '2019-07-07', '10:18:31', '127.0.0.1', 'Linux', 'Firefox', 1),
(87, 'Create Pregunta', 'Pregunta: Pregunta 7', '2019-07-07', '10:18:38', '127.0.0.1', 'Linux', 'Firefox', 1),
(88, 'Log In', '', '2019-07-07', '10:32:55', '127.0.0.1', 'Linux', 'Firefox', 1),
(89, 'Edit Pregunta', 'Pregunta: Pregunta 7', '2019-07-07', '11:51:21', '127.0.0.1', 'Linux', 'Firefox', 1),
(90, 'Create Pregunta', 'Pregunta: Pregunta 1', '2019-07-07', '11:54:40', '127.0.0.1', 'Linux', 'Firefox', 1),
(91, 'Edit Pregunta', 'Pregunta: Pregunta 1', '2019-07-07', '11:59:51', '127.0.0.1', 'Linux', 'Firefox', 1),
(92, 'Edit Pregunta', 'Pregunta: Pregunta 1', '2019-07-07', '11:59:57', '127.0.0.1', 'Linux', 'Firefox', 1),
(93, 'Edit Pregunta', 'Pregunta: Pregunta 1', '2019-07-07', '12:00:15', '127.0.0.1', 'Linux', 'Firefox', 1),
(94, 'Create Cuestionario', 'Respuesta: ;; Participante: Participante 1 Par', '2019-07-07', '12:03:36', '127.0.0.1', 'Linux', 'Firefox', 1),
(95, 'Create Cuestionario', 'Respuesta: ;; Participante: Participante 1 Par', '2019-07-07', '12:09:52', '127.0.0.1', 'Linux', 'Firefox', 1),
(96, 'Create Cuestionario', 'Respuesta: ;; Participante: Participante 1 Par', '2019-07-07', '12:10:37', '127.0.0.1', 'Linux', 'Firefox', 1),
(97, 'Create Cuestionario', 'Respuesta: ;; Participante: Participante 1 Par', '2019-07-07', '19:54:58', '127.0.0.1', 'Linux', 'Firefox', 1),
(98, 'Create Cuestionario', 'Respuesta: ;; Participante: Participante 1 Par', '2019-07-07', '19:56:26', '127.0.0.1', 'Linux', 'Firefox', 1),
(99, 'Create Cuestionario', 'Respuesta: ;; Participante: Participante 1 Par', '2019-07-07', '20:22:38', '127.0.0.1', 'Linux', 'Firefox', 1),
(100, 'Create Cuestionario', 'Respuesta: ;; Participante: Participante 1 Par', '2019-07-07', '20:35:06', '127.0.0.1', 'Linux', 'Firefox', 1),
(101, 'Create Cuestionario', 'Respuesta: ;; Participante: Participante 1 Par', '2019-07-07', '20:36:26', '127.0.0.1', 'Linux', 'Firefox', 1),
(102, 'Create Cuestionario', 'Respuesta: ;; Participante: Participante 1 Par', '2019-07-07', '20:36:41', '127.0.0.1', 'Linux', 'Firefox', 1),
(103, 'Create Cuestionario', 'Respuesta: ;; Participante: Participante 1 Par', '2019-07-07', '20:37:24', '127.0.0.1', 'Linux', 'Firefox', 1),
(104, 'Create Cuestionario', 'Respuesta: ;; Participante: Participante 1 Par', '2019-07-07', '20:37:26', '127.0.0.1', 'Linux', 'Firefox', 1),
(105, 'Create Cuestionario', 'Respuesta: ;; Participante: Participante 1 Par', '2019-07-07', '20:38:25', '127.0.0.1', 'Linux', 'Firefox', 1),
(106, 'Create Pregunta', 'Pregunta: Pregunta 2', '2019-07-07', '20:39:17', '127.0.0.1', 'Linux', 'Firefox', 1),
(107, 'Create Cuestionario', 'Respuesta: ;; Participante: Participante 1 Par', '2019-07-07', '20:39:30', '127.0.0.1', 'Linux', 'Firefox', 1),
(108, 'Create Cuestionario', 'Respuesta: ;; Participante: Participante 1 Par', '2019-07-07', '20:44:24', '127.0.0.1', 'Linux', 'Firefox', 1),
(109, 'Create Cuestionario', 'Respuesta: ;; Participante: Participante 1 Par', '2019-07-07', '20:46:18', '127.0.0.1', 'Linux', 'Firefox', 1),
(110, 'Create Cuestionario', 'Respuesta: ;; Participante: Participante 1 Par', '2019-07-07', '21:02:41', '127.0.0.1', 'Linux', 'Firefox', 1),
(111, 'Create Cuestionario', 'Respuesta: ;; Participante: Participante 1 Par', '2019-07-07', '21:02:54', '127.0.0.1', 'Linux', 'Firefox', 1),
(112, 'Create Cuestionario', 'Respuesta: ;; Participante: Participante 1 Par', '2019-07-07', '21:02:59', '127.0.0.1', 'Linux', 'Firefox', 1),
(113, 'Create Cuestionario', 'Respuesta: ;; Participante: Participante 1 Par', '2019-07-07', '21:03:26', '127.0.0.1', 'Linux', 'Firefox', 1),
(114, 'Create Cuestionario', 'Respuesta: ;; Participante: Participante 1 Par', '2019-07-07', '21:05:52', '127.0.0.1', 'Linux', 'Firefox', 1),
(115, 'Create Cuestionario', 'Respuesta: ;; Participante: Participante 1 Par', '2019-07-07', '21:06:58', '127.0.0.1', 'Linux', 'Firefox', 1),
(116, 'Create Cuestionario', 'Respuesta: ;; Participante: Participante 1 Par', '2019-07-07', '21:07:26', '127.0.0.1', 'Linux', 'Firefox', 1),
(117, 'Create Cuestionario', 'Respuesta: ;; Participante: Participante 1 Par', '2019-07-07', '21:07:37', '127.0.0.1', 'Linux', 'Firefox', 1),
(118, 'Create Cuestionario', 'Respuesta: ;; Participante: Participante 1 Par', '2019-07-07', '21:07:50', '127.0.0.1', 'Linux', 'Firefox', 1),
(119, 'Create Cuestionario', 'Respuesta: ;; Participante: Participante 1 Par', '2019-07-07', '21:08:02', '127.0.0.1', 'Linux', 'Firefox', 1),
(120, 'Create Cuestionario', 'Respuesta: ;; Participante: Participante 1 Par', '2019-07-07', '21:08:07', '127.0.0.1', 'Linux', 'Firefox', 1),
(121, 'Create Cuestionario', 'Respuesta: ;; Participante: Participante 1 Par', '2019-07-07', '21:08:14', '127.0.0.1', 'Linux', 'Firefox', 1),
(122, 'Create Cuestionario', 'Respuesta: ;; Participante: Participante 1 Par', '2019-07-07', '21:12:03', '127.0.0.1', 'Linux', 'Firefox', 1),
(123, 'Edit Cuestionario', 'Descripcion: ;; Participante: Participante 1 Par', '2019-07-07', '21:25:19', '127.0.0.1', 'Linux', 'Firefox', 1),
(124, 'Edit Cuestionario', 'Descripcion: ;; Participante: Participante 1 Par', '2019-07-07', '21:27:40', '127.0.0.1', 'Linux', 'Firefox', 1),
(125, 'Edit Cuestionario', 'Descripcion: ;; Participante: Participante 1 Par', '2019-07-07', '21:33:14', '127.0.0.1', 'Linux', 'Firefox', 1),
(126, 'Edit Cuestionario', 'Descripcion: ;; Participante: Participante 1 Par', '2019-07-07', '21:33:57', '127.0.0.1', 'Linux', 'Firefox', 1),
(127, 'Edit Cuestionario', 'Descripcion: ;; Participante: Participante 1 Par', '2019-07-07', '21:47:13', '127.0.0.1', 'Linux', 'Firefox', 1),
(128, 'Edit Cuestionario', 'Descripcion: ;; Participante: Participante 1 Par', '2019-07-07', '21:47:37', '127.0.0.1', 'Linux', 'Firefox', 1),
(129, 'Log In', '', '2019-07-07', '22:50:01', '127.0.0.1', 'Linux', 'Firefox', 1),
(130, 'Create Cuestionario', 'Respuesta: ;; Participante: Participante 1 Par', '2019-07-07', '22:50:12', '127.0.0.1', 'Linux', 'Firefox', 1);

-- --------------------------------------------------------

--
-- Table structure for table `LogEvaluador`
--

CREATE TABLE `LogEvaluador` (
  `idLogEvaluador` int(11) NOT NULL,
  `accion` varchar(45) NOT NULL,
  `informacion` text NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `ip` varchar(45) NOT NULL,
  `so` varchar(45) NOT NULL,
  `explorador` varchar(45) NOT NULL,
  `evaluador_idEvaluador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `LogParticipante`
--

CREATE TABLE `LogParticipante` (
  `idLogParticipante` int(11) NOT NULL,
  `accion` varchar(45) NOT NULL,
  `informacion` text NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `ip` varchar(45) NOT NULL,
  `so` varchar(45) NOT NULL,
  `explorador` varchar(45) NOT NULL,
  `participante_idParticipante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Participante`
--

CREATE TABLE `Participante` (
  `idParticipante` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `imagen` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Participante`
--

INSERT INTO `Participante` (`idParticipante`, `nombre`, `apellido`, `email`, `password`, `imagen`) VALUES
(1, 'Participante 1', 'Par', 'par@par.com', '202cb962ac59075b964b07152d234b70', '');

-- --------------------------------------------------------

--
-- Table structure for table `Pregunta`
--

CREATE TABLE `Pregunta` (
  `idPregunta` int(11) NOT NULL,
  `pregunta` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Pregunta`
--

INSERT INTO `Pregunta` (`idPregunta`, `pregunta`) VALUES
(31, 'Pregunta 1'),
(32, 'Pregunta 2');

-- --------------------------------------------------------

--
-- Table structure for table `ProgramaAcademico`
--

CREATE TABLE `ProgramaAcademico` (
  `idProgramaAcademico` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ProgramaAcademico`
--

INSERT INTO `ProgramaAcademico` (`idProgramaAcademico`, `nombre`) VALUES
(1, 'Tecnología en sistematización de datos'),
(2, 'Tecnología en gestión de la producción industrial'),
(3, 'Tecnología en sistemas eléctricos de media y baja tensión'),
(4, 'Tecnología en construcciones civiles'),
(5, 'Tecnología en electrónica');

-- --------------------------------------------------------

--
-- Table structure for table `Respuesta`
--

CREATE TABLE `Respuesta` (
  `idRespuesta` int(11) NOT NULL,
  `tipo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Respuesta`
--

INSERT INTO `Respuesta` (`idRespuesta`, `tipo`) VALUES
(1, 'Muy Bajo'),
(2, 'Bajo'),
(3, 'Medio'),
(4, 'Alto'),
(5, 'Muy Alto');

-- --------------------------------------------------------

--
-- Table structure for table `Valor`
--

CREATE TABLE `Valor` (
  `idValor` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  `pregunta_idPregunta` int(11) NOT NULL,
  `programaAcademico_idProgramaAcademico` int(11) NOT NULL,
  `respuesta_idRespuesta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Valor`
--

INSERT INTO `Valor` (`idValor`, `valor`, `pregunta_idPregunta`, `programaAcademico_idProgramaAcademico`, `respuesta_idRespuesta`) VALUES
(131, 1, 31, 1, 1),
(132, 6, 31, 2, 2),
(133, 999, 31, 2, 3),
(134, 4, 31, 3, 4),
(135, 5, 31, 4, 5),
(136, 5, 32, 3, 1),
(137, 4, 32, 5, 2),
(138, 1, 32, 5, 3),
(139, 2, 32, 1, 4),
(140, 3, 32, 5, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Administrator`
--
ALTER TABLE `Administrator`
  ADD PRIMARY KEY (`idAdministrator`);

--
-- Indexes for table `Cuestionario`
--
ALTER TABLE `Cuestionario`
  ADD PRIMARY KEY (`idCuestionario`),
  ADD KEY `participante_idParticipante` (`participante_idParticipante`);

--
-- Indexes for table `Esquema`
--
ALTER TABLE `Esquema`
  ADD PRIMARY KEY (`idEsquema`),
  ADD KEY `pregunta_idPregunta` (`pregunta_idPregunta`),
  ADD KEY `cuestionario_idCuestionario` (`cuestionario_idCuestionario`),
  ADD KEY `respuesta_idRespuesta` (`respuesta_idRespuesta`);

--
-- Indexes for table `Evaluador`
--
ALTER TABLE `Evaluador`
  ADD PRIMARY KEY (`idEvaluador`);

--
-- Indexes for table `LogAdministrator`
--
ALTER TABLE `LogAdministrator`
  ADD PRIMARY KEY (`idLogAdministrator`),
  ADD KEY `administrator_idAdministrator` (`administrator_idAdministrator`);

--
-- Indexes for table `LogEvaluador`
--
ALTER TABLE `LogEvaluador`
  ADD PRIMARY KEY (`idLogEvaluador`),
  ADD KEY `evaluador_idEvaluador` (`evaluador_idEvaluador`);

--
-- Indexes for table `LogParticipante`
--
ALTER TABLE `LogParticipante`
  ADD PRIMARY KEY (`idLogParticipante`),
  ADD KEY `participante_idParticipante` (`participante_idParticipante`);

--
-- Indexes for table `Participante`
--
ALTER TABLE `Participante`
  ADD PRIMARY KEY (`idParticipante`);

--
-- Indexes for table `Pregunta`
--
ALTER TABLE `Pregunta`
  ADD PRIMARY KEY (`idPregunta`);

--
-- Indexes for table `ProgramaAcademico`
--
ALTER TABLE `ProgramaAcademico`
  ADD PRIMARY KEY (`idProgramaAcademico`);

--
-- Indexes for table `Respuesta`
--
ALTER TABLE `Respuesta`
  ADD PRIMARY KEY (`idRespuesta`);

--
-- Indexes for table `Valor`
--
ALTER TABLE `Valor`
  ADD PRIMARY KEY (`idValor`),
  ADD KEY `pregunta_idPregunta` (`pregunta_idPregunta`),
  ADD KEY `programaAcademico_idProgramaAcademico` (`programaAcademico_idProgramaAcademico`),
  ADD KEY `respuesta_idRespuesta` (`respuesta_idRespuesta`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Administrator`
--
ALTER TABLE `Administrator`
  MODIFY `idAdministrator` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Cuestionario`
--
ALTER TABLE `Cuestionario`
  MODIFY `idCuestionario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `Esquema`
--
ALTER TABLE `Esquema`
  MODIFY `idEsquema` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `Evaluador`
--
ALTER TABLE `Evaluador`
  MODIFY `idEvaluador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `LogAdministrator`
--
ALTER TABLE `LogAdministrator`
  MODIFY `idLogAdministrator` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `LogEvaluador`
--
ALTER TABLE `LogEvaluador`
  MODIFY `idLogEvaluador` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `LogParticipante`
--
ALTER TABLE `LogParticipante`
  MODIFY `idLogParticipante` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Participante`
--
ALTER TABLE `Participante`
  MODIFY `idParticipante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Pregunta`
--
ALTER TABLE `Pregunta`
  MODIFY `idPregunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `ProgramaAcademico`
--
ALTER TABLE `ProgramaAcademico`
  MODIFY `idProgramaAcademico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Respuesta`
--
ALTER TABLE `Respuesta`
  MODIFY `idRespuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Valor`
--
ALTER TABLE `Valor`
  MODIFY `idValor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Cuestionario`
--
ALTER TABLE `Cuestionario`
  ADD CONSTRAINT `Cuestionario_ibfk_1` FOREIGN KEY (`participante_idParticipante`) REFERENCES `Participante` (`idParticipante`);

--
-- Constraints for table `Esquema`
--
ALTER TABLE `Esquema`
  ADD CONSTRAINT `Esquema_ibfk_1` FOREIGN KEY (`pregunta_idPregunta`) REFERENCES `Pregunta` (`idPregunta`),
  ADD CONSTRAINT `Esquema_ibfk_2` FOREIGN KEY (`cuestionario_idCuestionario`) REFERENCES `Cuestionario` (`idCuestionario`),
  ADD CONSTRAINT `Esquema_ibfk_3` FOREIGN KEY (`respuesta_idRespuesta`) REFERENCES `Respuesta` (`idRespuesta`);

--
-- Constraints for table `LogAdministrator`
--
ALTER TABLE `LogAdministrator`
  ADD CONSTRAINT `LogAdministrator_ibfk_1` FOREIGN KEY (`administrator_idAdministrator`) REFERENCES `Administrator` (`idAdministrator`);

--
-- Constraints for table `LogEvaluador`
--
ALTER TABLE `LogEvaluador`
  ADD CONSTRAINT `LogEvaluador_ibfk_1` FOREIGN KEY (`evaluador_idEvaluador`) REFERENCES `Evaluador` (`idEvaluador`);

--
-- Constraints for table `LogParticipante`
--
ALTER TABLE `LogParticipante`
  ADD CONSTRAINT `LogParticipante_ibfk_1` FOREIGN KEY (`participante_idParticipante`) REFERENCES `Participante` (`idParticipante`);

--
-- Constraints for table `Valor`
--
ALTER TABLE `Valor`
  ADD CONSTRAINT `Valor_ibfk_1` FOREIGN KEY (`pregunta_idPregunta`) REFERENCES `Pregunta` (`idPregunta`),
  ADD CONSTRAINT `Valor_ibfk_2` FOREIGN KEY (`programaAcademico_idProgramaAcademico`) REFERENCES `ProgramaAcademico` (`idProgramaAcademico`),
  ADD CONSTRAINT `Valor_ibfk_3` FOREIGN KEY (`respuesta_idRespuesta`) REFERENCES `Respuesta` (`idRespuesta`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
