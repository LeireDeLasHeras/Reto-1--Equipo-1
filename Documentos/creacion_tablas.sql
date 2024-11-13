-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql:3306
-- Generation Time: Nov 12, 2024 at 08:34 AM
-- Server version: 11.5.2-MariaDB-ubu2404
-- PHP Version: 8.2.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grupo1_2425`
--

-- --------------------------------------------------------

--
-- Table structure for table `Guia`
--

CREATE TABLE `Guia` (
  `idGuia` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha` date NOT NULL,
  `tema` varchar(255) NOT NULL,
  `fichero` varchar(255) DEFAULT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `Guia`
--

INSERT INTO `Guia` (`idGuia`, `titulo`, `descripcion`, `fecha`, `tema`, `fichero`, `idUsuario`) VALUES
(46, 'aaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaaaaaaaaaa', '2024-11-08', 'Piezas', './uploads/guias/pdf/Reto1_MER.jpg', 34),
(48, 'AAAAAAAAAAAA', 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', '2024-11-11', 'Seguridad', '', 34);

-- --------------------------------------------------------

--
-- Table structure for table `GuiasFavoritas`
--

CREATE TABLE `GuiasFavoritas` (
  `idUsuario` int(11) NOT NULL,
  `idGuia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `GuiasGuardadas`
--

CREATE TABLE `GuiasGuardadas` (
  `idUsuario` int(11) NOT NULL,
  `idGuia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `GuiasGuardadas`
--

INSERT INTO `GuiasGuardadas` (`idUsuario`, `idGuia`) VALUES
(37, 46);

-- --------------------------------------------------------

--
-- Table structure for table `Pregunta`
--

CREATE TABLE `Pregunta` (
  `idPregunta` int(10) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `tema` varchar(50) NOT NULL,
  `fecha` date NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `idUsuario` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `Pregunta`
--

INSERT INTO `Pregunta` (`idPregunta`, `titulo`, `descripcion`, `tema`, `fecha`, `imagen`, `idUsuario`) VALUES
(64, '09/11/2001', 'They hit the second tower', 'Aviones', '2024-11-08', NULL, 37),
(65, '09/11/2001', 'They hit the pentagon', 'Vuelos', '2024-11-08', NULL, 37),
(66, 'Zahit prus', 'zasdsadassssssssssasds', 'Seguridad', '2024-11-08', NULL, 30),
(67, 'Reparación Boeing 777', 'Zahir allonso es peruano maldita sea\r\n', 'Seguridad', '2024-11-08', NULL, 30),
(69, 'aaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'Seguridad', '2024-11-08', NULL, 34),
(71, 'Reparación Boeing 777', 'AAAAAAAAAAAAAAAAAAaaa', 'Piezas', '2024-11-11', NULL, 34),
(72, 'Zahir allonso peru', 'pppppppppppppppppppppppppppppppp', 'Seguridad', '2024-11-11', NULL, 34),
(73, 'Reparación Boeing 777', '', 'Seguridad', '2024-11-11', NULL, 34),
(74, 'Zahir allonso peru', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'Seguridad', '2024-11-11', NULL, 34),
(75, 'aaaaaaaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'Seguridad', '2024-11-11', NULL, 37);

-- --------------------------------------------------------

--
-- Table structure for table `PreguntasFavoritas`
--

CREATE TABLE `PreguntasFavoritas` (
  `idUsuario` int(11) NOT NULL,
  `idPregunta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `PreguntasFavoritas`
--

INSERT INTO `PreguntasFavoritas` (`idUsuario`, `idPregunta`) VALUES
(37, 64),
(34, 65),
(34, 71);

-- --------------------------------------------------------

--
-- Table structure for table `PreguntasGuardadas`
--

CREATE TABLE `PreguntasGuardadas` (
  `idUsuario` int(11) NOT NULL,
  `idPregunta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `PreguntasGuardadas`
--

INSERT INTO `PreguntasGuardadas` (`idUsuario`, `idPregunta`) VALUES
(37, 64),
(34, 71),
(37, 71);

-- --------------------------------------------------------

--
-- Table structure for table `Respuesta`
--

CREATE TABLE `Respuesta` (
  `idRespuesta` int(10) NOT NULL,
  `fecha` date NOT NULL,
  `descripcion` text NOT NULL,
  `fichero` varchar(255) DEFAULT NULL,
  `idUsuario` int(10) NOT NULL,
  `idPregunta` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `Respuesta`
--

INSERT INTO `Respuesta` (`idRespuesta`, `fecha`, `descripcion`, `fichero`, `idUsuario`, `idPregunta`) VALUES
(72, '2024-11-11', 'zaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', NULL, 37, 64),
(74, '2024-11-11', 'aaa', NULL, 34, 64),
(75, '2024-11-11', 'a', NULL, 34, 64),
(76, '2024-11-11', 'aaaa', NULL, 34, 64),
(78, '2024-11-11', 'a', NULL, 34, 65),
(79, '2024-11-12', 'fgdydhydfhdfhf', NULL, 37, 64);

-- --------------------------------------------------------

--
-- Table structure for table `RespuestasFavoritas`
--

CREATE TABLE `RespuestasFavoritas` (
  `idUsuario` int(11) NOT NULL,
  `idRespuesta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `RespuestasGuardadas`
--

CREATE TABLE `RespuestasGuardadas` (
  `idUsuario` int(11) NOT NULL,
  `idRespuesta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Tutorial`
--

CREATE TABLE `Tutorial` (
  `idTutorial` int(10) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `tema` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `enlace` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `idUsuario` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `Tutorial`
--

INSERT INTO `Tutorial` (`idTutorial`, `titulo`, `tema`, `descripcion`, `enlace`, `fecha`, `idUsuario`) VALUES
(7, '¿Puedes Venir?', 'Piezas', 'za', '2pFwQiwRbcg', '2024-10-30', 30),
(10, 'Makiman', 'Vuelos', 'qwertyuiopasdfghjklñzxcvbnm', 'IMdH647RNQQ', '2024-11-05', 34),
(11, 'Reparación Boeing 777', 'Seguridad', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '-8EWXMjmt70', '2024-11-07', 34),
(12, 'JESUS DE NAZARET HA BAJADO DEL CIELO', 'Seguridad', 'Increible', 'aFKyfi3qAeM', '2024-11-07', 34),
(15, 'Reparación Boeing 777', 'Vuelos', 'asssssssssssssss', '2rX5VeBPS8o', '2024-11-08', 30),
(16, 'Reparación Boeing 777', 'Piezas', 'AAAAAAAAAAAAAAAAAAA', '2rX5VeBPS8o', '2024-11-08', 30),
(18, 'Fani les gallines', 'Seguridad', 'Fani les gallines', 'KNkfmnNuIBo', '2024-11-11', 34),
(19, 'Mia Skylar VS J Red Pill', 'Seguridad', 'Mia Skylar VS J Red Pill', 'YIFKlh4LZ4U', '2024-11-11', 34);

-- --------------------------------------------------------

--
-- Table structure for table `TutorialesFavoritos`
--

CREATE TABLE `TutorialesFavoritos` (
  `idUsuario` int(11) NOT NULL,
  `idTutorial` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `TutorialesGuardados`
--

CREATE TABLE `TutorialesGuardados` (
  `idUsuario` int(11) NOT NULL,
  `idTutorial` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `TutorialesGuardados`
--

INSERT INTO `TutorialesGuardados` (`idUsuario`, `idTutorial`) VALUES
(37, 7);

-- --------------------------------------------------------

--
-- Table structure for table `Usuario`
--

CREATE TABLE `Usuario` (
  `idUsuario` int(10) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `correo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `Usuario`
--

INSERT INTO `Usuario` (`idUsuario`, `nombre`, `apellido`, `nickname`, `contrasena`, `tipo`, `correo`) VALUES
(7, 'Zahir', 'Allonso', 'PeruvianZaza', '$2y$10$OALz/U0Vty0O92/hzRalgObNZGVyq9LLzBC.y2q.6ZbXJeYyd2BhO', 'normal', 'zahir.allonso@egibide.org'),
(8, 'Joseba', 'Fernández', 'eljosebas', '$2y$10$mXzdMEXo3zHe8YB.xS/xoeqQ3CU9N2iuZZwZXol0El4/xWftF8VIK', 'normal', 'joseba@egibide.org'),
(11, 'Oier', 'Albeniz Ugarte', 'El_Neni', '$2y$10$lvqICZWZB1vij9hNi82fe.uVjKux69ukasgOAK1fWKRMvF/EorFFy', 'normal', 'elneni@egibide.org'),
(29, 'Jordi', 'Fernandez', 'joldin', '$2y$10$Ve00Z87pN9rSGrDAnDXKYup5JsZIyDMVZMq7sirpJ3EAbGtxe/wPW', 'normal', 'joldin@egibide.org'),
(30, 'Osrez', 'Pekar', 'sarasa_malandrin', '$2y$10$16FVCBLObggELSsBkiUGWuKtEuI4cBcqxMzQtD78P0i3L.8/43AiW', 'normal', 'maricamalandro@egibide.org'),
(34, 'Pru', 'Ebas', 'pruebas', '$2y$10$JNiWr4pNY1gzDIClxtmU4uwDu6gQxEOnH1EskqioCmtHWYEgqE4x.', 'admin', 'pruebas@egibide.org'),
(37, 'Leire', 'Heras', 'lele113', '$2y$10$SalcUwlhmaldG4Y4paZK6uhEvGO0BvjPkmNphv98Q.aoAwOOhJcpy', 'admin', 'leire@egibide.org'),
(38, 'Pablo', 'Palacios', 'Pabo', '$2y$10$KBOxO5hRaGi6YVsJCpgZtOqzignayCeNCng2RvSptKPUPPOetlZza', 'normal', 'ppalacios@egibide.org');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Guia`
--
ALTER TABLE `Guia`
  ADD PRIMARY KEY (`idGuia`),
  ADD KEY `Guia_ibfk_1` (`idUsuario`);

--
-- Indexes for table `GuiasFavoritas`
--
ALTER TABLE `GuiasFavoritas`
  ADD PRIMARY KEY (`idUsuario`,`idGuia`),
  ADD KEY `idGuia` (`idGuia`);

--
-- Indexes for table `GuiasGuardadas`
--
ALTER TABLE `GuiasGuardadas`
  ADD PRIMARY KEY (`idUsuario`,`idGuia`),
  ADD KEY `idGuia` (`idGuia`);

--
-- Indexes for table `Pregunta`
--
ALTER TABLE `Pregunta`
  ADD PRIMARY KEY (`idPregunta`),
  ADD KEY `Pregunta_ibfk_1` (`idUsuario`);

--
-- Indexes for table `PreguntasFavoritas`
--
ALTER TABLE `PreguntasFavoritas`
  ADD PRIMARY KEY (`idUsuario`,`idPregunta`),
  ADD KEY `idPregunta` (`idPregunta`);

--
-- Indexes for table `PreguntasGuardadas`
--
ALTER TABLE `PreguntasGuardadas`
  ADD PRIMARY KEY (`idUsuario`,`idPregunta`),
  ADD KEY `idPregunta` (`idPregunta`);

--
-- Indexes for table `Respuesta`
--
ALTER TABLE `Respuesta`
  ADD PRIMARY KEY (`idRespuesta`),
  ADD KEY `fk_idUsuario` (`idUsuario`),
  ADD KEY `fk_idPregunta` (`idPregunta`);

--
-- Indexes for table `RespuestasFavoritas`
--
ALTER TABLE `RespuestasFavoritas`
  ADD PRIMARY KEY (`idUsuario`,`idRespuesta`),
  ADD KEY `RespuestasFavoritas_ibfk_2` (`idRespuesta`);

--
-- Indexes for table `RespuestasGuardadas`
--
ALTER TABLE `RespuestasGuardadas`
  ADD PRIMARY KEY (`idUsuario`,`idRespuesta`),
  ADD KEY `RespuestasGuardadas_ibfk_2` (`idRespuesta`);

--
-- Indexes for table `Tutorial`
--
ALTER TABLE `Tutorial`
  ADD PRIMARY KEY (`idTutorial`),
  ADD KEY `Tutorial_ibfk_1` (`idUsuario`);

--
-- Indexes for table `TutorialesFavoritos`
--
ALTER TABLE `TutorialesFavoritos`
  ADD PRIMARY KEY (`idUsuario`,`idTutorial`),
  ADD KEY `idTutorial` (`idTutorial`);

--
-- Indexes for table `TutorialesGuardados`
--
ALTER TABLE `TutorialesGuardados`
  ADD PRIMARY KEY (`idUsuario`,`idTutorial`),
  ADD KEY `idTutorial` (`idTutorial`);

--
-- Indexes for table `Usuario`
--
ALTER TABLE `Usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Guia`
--
ALTER TABLE `Guia`
  MODIFY `idGuia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `Pregunta`
--
ALTER TABLE `Pregunta`
  MODIFY `idPregunta` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `Respuesta`
--
ALTER TABLE `Respuesta`
  MODIFY `idRespuesta` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `Tutorial`
--
ALTER TABLE `Tutorial`
  MODIFY `idTutorial` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `Usuario`
--
ALTER TABLE `Usuario`
  MODIFY `idUsuario` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Guia`
--
ALTER TABLE `Guia`
  ADD CONSTRAINT `Guia_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `Usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `GuiasFavoritas`
--
ALTER TABLE `GuiasFavoritas`
  ADD CONSTRAINT `GuiasFavoritas_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `Usuario` (`idUsuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `GuiasFavoritas_ibfk_2` FOREIGN KEY (`idGuia`) REFERENCES `Guia` (`idGuia`) ON DELETE CASCADE;

--
-- Constraints for table `GuiasGuardadas`
--
ALTER TABLE `GuiasGuardadas`
  ADD CONSTRAINT `GuiasGuardadas_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `Usuario` (`idUsuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `GuiasGuardadas_ibfk_2` FOREIGN KEY (`idGuia`) REFERENCES `Guia` (`idGuia`) ON DELETE CASCADE;

--
-- Constraints for table `Pregunta`
--
ALTER TABLE `Pregunta`
  ADD CONSTRAINT `Pregunta_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `Usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `PreguntasFavoritas`
--
ALTER TABLE `PreguntasFavoritas`
  ADD CONSTRAINT `PreguntasFavoritas_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `Usuario` (`idUsuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `PreguntasFavoritas_ibfk_2` FOREIGN KEY (`idPregunta`) REFERENCES `Pregunta` (`idPregunta`) ON DELETE CASCADE;

--
-- Constraints for table `PreguntasGuardadas`
--
ALTER TABLE `PreguntasGuardadas`
  ADD CONSTRAINT `PreguntasGuardadas_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `Usuario` (`idUsuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `PreguntasGuardadas_ibfk_2` FOREIGN KEY (`idPregunta`) REFERENCES `Pregunta` (`idPregunta`) ON DELETE CASCADE;

--
-- Constraints for table `Respuesta`
--
ALTER TABLE `Respuesta`
  ADD CONSTRAINT `fk_idPregunta` FOREIGN KEY (`idPregunta`) REFERENCES `Pregunta` (`idPregunta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idUsuario` FOREIGN KEY (`idUsuario`) REFERENCES `Usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `RespuestasFavoritas`
--
ALTER TABLE `RespuestasFavoritas`
  ADD CONSTRAINT `RespuestasFavoritas_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `Usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `RespuestasFavoritas_ibfk_2` FOREIGN KEY (`idRespuesta`) REFERENCES `Respuesta` (`idRespuesta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `RespuestasGuardadas`
--
ALTER TABLE `RespuestasGuardadas`
  ADD CONSTRAINT `RespuestasGuardadas_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `Usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `RespuestasGuardadas_ibfk_2` FOREIGN KEY (`idRespuesta`) REFERENCES `Respuesta` (`idRespuesta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Tutorial`
--
ALTER TABLE `Tutorial`
  ADD CONSTRAINT `Tutorial_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `Usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `TutorialesFavoritos`
--
ALTER TABLE `TutorialesFavoritos`
  ADD CONSTRAINT `TutorialesFavoritos_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `Usuario` (`idUsuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `TutorialesFavoritos_ibfk_2` FOREIGN KEY (`idTutorial`) REFERENCES `Tutorial` (`idTutorial`) ON DELETE CASCADE;

--
-- Constraints for table `TutorialesGuardados`
--
ALTER TABLE `TutorialesGuardados`
  ADD CONSTRAINT `TutorialesGuardados_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `Usuario` (`idUsuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `TutorialesGuardados_ibfk_2` FOREIGN KEY (`idTutorial`) REFERENCES `Tutorial` (`idTutorial`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
