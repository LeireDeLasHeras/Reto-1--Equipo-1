CREATE TABLE `Guia` (
  `idGuia` int(10) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `decripcion` varchar(50) NOT NULL,
  `idUsuario` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;


CREATE TABLE `Pregunta` (
  `idPregunta` int(10) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `decripcion` varchar(50) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `fecha` date NOT NULL,
  `idUsuario` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

CREATE TABLE `Respuesta` (
  `idRespuesta` int(10) NOT NULL,
  `fecha` date NOT NULL,
  `decripcion` varchar(50) NOT NULL,
  `idUsuario` int(10) NOT NULL,
  `idPregunta` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

CREATE TABLE `Tutorial` (
  `idTutorial` int(10) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `decripcion` varchar(50) NOT NULL,
  `idUsuario` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

CREATE TABLE `Usuario` (
  `idUsuario` int(10) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `contrasena` varchar(50) NOT NULL,
  `tipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

ALTER TABLE `Guia`
  ADD PRIMARY KEY (`idGuia`),
  ADD KEY `idUsuario` (`idUsuario`);

ALTER TABLE `Pregunta`
  ADD PRIMARY KEY (`idPregunta`),
  ADD KEY `idUsuario` (`idUsuario`);

ALTER TABLE `Respuesta`
  ADD PRIMARY KEY (`idRespuesta`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idPregunta` (`idPregunta`);

ALTER TABLE `Tutorial`
  ADD PRIMARY KEY (`idTutorial`),
  ADD KEY `idUsuario` (`idUsuario`);

ALTER TABLE `Usuario`
  ADD PRIMARY KEY (`idUsuario`);

ALTER TABLE `Guia`
  ADD CONSTRAINT `Guia_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `Usuario` (`idUsuario`);

ALTER TABLE `Pregunta`
  ADD CONSTRAINT `Pregunta_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `Usuario` (`idUsuario`);

ALTER TABLE `Respuesta`
  ADD CONSTRAINT `Respuesta_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `Usuario` (`idUsuario`),
  ADD CONSTRAINT `Respuesta_ibfk_2` FOREIGN KEY (`idPregunta`) REFERENCES `Pregunta` (`idPregunta`);

ALTER TABLE `Tutorial`
  ADD CONSTRAINT `Tutorial_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `Usuario` (`idUsuario`);
COMMIT;