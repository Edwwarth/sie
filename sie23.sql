-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 29, 2019 at 07:46 PM
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
-- Database: `sie23`
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
  `respuesta` varchar(45) DEFAULT NULL,
  `participante_idParticipante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Cuestionario`
--

INSERT INTO `Cuestionario` (`idCuestionario`, `respuesta`, `participante_idParticipante`) VALUES
(1, 'Array', 1),
(2, '', 1),
(3, '', 1),
(4, '', 1),
(5, '', 1),
(6, '', 1),
(7, '', 1),
(8, '', 1),
(9, '', 1),
(10, '', 1),
(11, '', 1),
(12, '', 1),
(13, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Esquema`
--

CREATE TABLE `Esquema` (
  `idEsquema` int(11) NOT NULL,
  `pregunta_idPregunta` int(11) NOT NULL,
  `respuesta_idRespuesta` int(11) NOT NULL,
  `cuestionario_idCuestionario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Esquema`
--

INSERT INTO `Esquema` (`idEsquema`, `pregunta_idPregunta`, `respuesta_idRespuesta`, `cuestionario_idCuestionario`) VALUES
(31, 1, 5, 12),
(32, 2, 3, 12),
(33, 1, 5, 13),
(34, 2, 3, 13);

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
(1, 'Log In', '', '2019-06-26', '06:32:42', '127.0.0.1', 'Linux', 'Firefox', 1),
(2, 'Log In', '', '2019-06-26', '06:34:46', '127.0.0.1', 'Linux', 'Firefox', 1),
(3, 'Log In', '', '2019-06-26', '06:38:21', '127.0.0.1', 'Linux', 'Firefox', 1),
(4, 'Create Participante', 'Nombre: Participante;; Apellido: Par;; Email: participante@participante.com;; Password: 123', '2019-06-26', '06:38:54', '127.0.0.1', 'Linux', 'Firefox', 1),
(5, 'Create Cuestionario', 'Respuesta: Array;; Participante: Participante Par', '2019-06-26', '07:13:22', '127.0.0.1', 'Linux', 'Firefox', 1),
(6, 'Create Cuestionario', 'Respuesta: ;; Participante: Participante Par', '2019-06-26', '07:18:55', '127.0.0.1', 'Linux', 'Firefox', 1),
(7, 'Create Cuestionario', 'Respuesta: ;; Participante: Participante Par', '2019-06-26', '07:21:14', '127.0.0.1', 'Linux', 'Firefox', 1),
(8, 'Create Cuestionario', 'Respuesta: ;; Participante: Participante Par', '2019-06-26', '07:22:40', '127.0.0.1', 'Linux', 'Firefox', 1),
(9, 'Create Cuestionario', 'Respuesta: ;; Participante: Participante Par', '2019-06-26', '07:23:03', '127.0.0.1', 'Linux', 'Firefox', 1),
(10, 'Create Cuestionario', 'Respuesta: ;; Participante: Participante Par', '2019-06-26', '07:23:29', '127.0.0.1', 'Linux', 'Firefox', 1),
(11, 'Create Cuestionario', 'Respuesta: ;; Participante: Participante Par', '2019-06-26', '07:25:01', '127.0.0.1', 'Linux', 'Firefox', 1),
(12, 'Create Cuestionario', 'Respuesta: ;; Participante: Participante Par', '2019-06-26', '07:26:57', '127.0.0.1', 'Linux', 'Firefox', 1),
(13, 'Create Cuestionario', 'Respuesta: ;; Participante: Participante Par', '2019-06-26', '07:28:26', '127.0.0.1', 'Linux', 'Firefox', 1),
(14, 'Create Cuestionario', 'Respuesta: ;; Participante: Participante Par', '2019-06-26', '07:29:33', '127.0.0.1', 'Linux', 'Firefox', 1),
(15, 'Create Cuestionario', 'Respuesta: ;; Participante: Participante Par', '2019-06-26', '07:30:55', '127.0.0.1', 'Linux', 'Firefox', 1),
(16, 'Create Cuestionario', 'Respuesta: ;; Participante: Participante Par', '2019-06-26', '07:31:46', '127.0.0.1', 'Linux', 'Firefox', 1),
(17, 'Create Cuestionario', 'Respuesta: ;; Participante: Participante Par', '2019-06-26', '07:32:19', '127.0.0.1', 'Linux', 'Firefox', 1),
(18, 'Log In', '', '2019-06-26', '07:35:09', '127.0.0.1', 'Linux', 'Firefox', 1),
(19, 'Log In', '', '2019-06-29', '11:26:48', '127.0.0.1', 'Linux', 'Firefox', 1),
(20, 'Log In', '', '2019-06-29', '13:48:39', '127.0.0.1', 'Linux', 'Firefox', 1);

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
(1, 'Participante', 'Par', 'participante@participante.com', '202cb962ac59075b964b07152d234b70', '');

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
(1, 'Pregunta 1'),
(2, 'Tengo un pensamiento organizado, tiendo a armar esquemas, establecer un orden y sistematizar. 1');

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
(5, 'Tecnología en electrónica'),
(6, 'Tecnología en gestión de la producción industrial'),
(20, 'Ninguno');

-- --------------------------------------------------------

--
-- Table structure for table `Respuesta`
--

CREATE TABLE `Respuesta` (
  `idRespuesta` int(11) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `valor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Respuesta`
--

INSERT INTO `Respuesta` (`idRespuesta`, `tipo`, `valor`) VALUES
(0, 'Sin Respuesta', 0),
(1, 'Muy bajo', 1),
(2, 'Bajo', 2),
(3, 'Medio', 3),
(4, 'Alto', 4),
(5, 'Muy alto', 5);

-- --------------------------------------------------------

--
-- Table structure for table `Value`
--

CREATE TABLE `Value` (
  `idValue` int(11) NOT NULL,
  `programaAcademico_idProgramaAcademico` int(11) NOT NULL,
  `respuesta_idRespuesta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Value`
--

INSERT INTO `Value` (`idValue`, `programaAcademico_idProgramaAcademico`, `respuesta_idRespuesta`) VALUES
(8, 20, 0),
(9, 4, 1),
(10, 2, 2),
(11, 3, 2),
(12, 5, 3),
(13, 6, 4),
(14, 1, 5);

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
  ADD KEY `respuesta_idRespuesta` (`respuesta_idRespuesta`),
  ADD KEY `cuestionario_idCuestionario` (`cuestionario_idCuestionario`);

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
-- Indexes for table `Value`
--
ALTER TABLE `Value`
  ADD PRIMARY KEY (`idValue`),
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
  MODIFY `idCuestionario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `Esquema`
--
ALTER TABLE `Esquema`
  MODIFY `idEsquema` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `Evaluador`
--
ALTER TABLE `Evaluador`
  MODIFY `idEvaluador` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `LogAdministrator`
--
ALTER TABLE `LogAdministrator`
  MODIFY `idLogAdministrator` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
  MODIFY `idPregunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ProgramaAcademico`
--
ALTER TABLE `ProgramaAcademico`
  MODIFY `idProgramaAcademico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `Respuesta`
--
ALTER TABLE `Respuesta`
  MODIFY `idRespuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `Value`
--
ALTER TABLE `Value`
  MODIFY `idValue` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
  ADD CONSTRAINT `Esquema_ibfk_2` FOREIGN KEY (`respuesta_idRespuesta`) REFERENCES `Respuesta` (`idRespuesta`),
  ADD CONSTRAINT `Esquema_ibfk_3` FOREIGN KEY (`cuestionario_idCuestionario`) REFERENCES `Cuestionario` (`idCuestionario`);

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
-- Constraints for table `Value`
--
ALTER TABLE `Value`
  ADD CONSTRAINT `Value_ibfk_1` FOREIGN KEY (`programaAcademico_idProgramaAcademico`) REFERENCES `ProgramaAcademico` (`idProgramaAcademico`),
  ADD CONSTRAINT `Value_ibfk_2` FOREIGN KEY (`respuesta_idRespuesta`) REFERENCES `Respuesta` (`idRespuesta`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
